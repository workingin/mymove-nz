<?php
include("includes/controller.php");
$pagename = 'cms';
$container = '';

include_once 'class/Post.php';
require_once 'includes/cms_image_validation.php';
require_once 'includes/cms_content_validation.php';

if (!$session->isSuperAdmin()) {
    header("Location: " . $configs->homePage());
    exit;
}

mysqli_report(MYSQLI_REPORT_OFF);
$cmsDb = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($cmsDb->connect_error) {
    die("Error failed to connect to MySQL: " . $cmsDb->connect_error);
}
$cmsDb->set_charset("utf8mb4");
$post = new Post($cmsDb);

$post->id = !empty($_POST['id']) ? $_POST['id'] : ((isset($_GET['id']) && $_GET['id']) ? $_GET['id'] : '0');
$saveMessage = '';
$saveError = '';
$thumbnail = '';

if (!empty($_POST["savePost"])) {
    if ($_POST["title"] == '' || $_POST["message"] == '') {
        $saveError = 'Please fill in Title and Short Description.';
        Flash::error($saveError);
    } elseif (cmsCountWords($_POST["message"]) > CMS_SHORT_DESC_WORD_LIMIT) {
        $saveError = 'Short Description exceeds the ' . CMS_SHORT_DESC_WORD_LIMIT . ' word limit.';
        Flash::error($saveError);
    } elseif (cmsCountWords($_POST["longdesc"]) > CMS_LONG_DESC_WORD_LIMIT) {
        $saveError = 'Long Description exceeds the ' . CMS_LONG_DESC_WORD_LIMIT . ' word limit.';
        Flash::error($saveError);
    } else {

    $hasUpload = !empty($_FILES["fileToUpload"]["name"]);

    if ($hasUpload) {
        $validation = cmsValidateImageUpload($_FILES['fileToUpload']);
        if (!$validation['valid']) {
            $saveError = $validation['error'];
            Flash::error($saveError);
        } else {
            $filename = cmsGenerateImageFilename('thumb_', $validation['extension']);
            $target_file = 'img/' . $filename;
            if (cmsSaveOptimizedImage($_FILES['fileToUpload']['tmp_name'], $target_file, $validation['extension'])) {
                $thumbnail = $filename;
            } else {
                $saveError = 'Could not save uploaded image. Please try again.';
                Flash::error($saveError);
            }
        }
    }

    if ($saveError === '') {
    if ($thumbnail == "") {
        $thumbnail = $_POST["thumbnail2"];
    }

    $post->title = $_POST["title"];
    $post->message = $_POST["message"];
    $post->longdesc = $_POST["longdesc"];
    $post->filename = $_POST["filename"] ?? '0';
    $post->thumbnail = $thumbnail;
    $post->author_id = $_POST["author_id"];
    $post->category = $_POST["category"];
    $post->status = $_POST["status"] ?? 'draft';

    if ($post->id) {
        $post->updated = date('Y-m-d H:i:s');
        if ($post->update()) {
            Flash::success('Post updated successfully!');
            header("Location: cms.php");
            exit;
        }
        $saveError = 'Failed to update post. Please try again.' . (($post->error ?? '') ? ' (' . $post->error . ')' : '');
        Flash::error($saveError);
    } else {
        $post->userid = "1";
        $post->created = date('Y-m-d H:i:s');
        $post->updated = date('Y-m-d H:i:s');
        $lastInserId = $post->insert();
        if ($lastInserId) {
            Flash::success('Post saved successfully!');
            header("Location: cms.php");
            exit;
        }
        $saveError = 'Failed to save post. Please try again.' . (($post->error ?? '') ? ' (' . $post->error . ')' : '');
        Flash::error($saveError);
    }
    }
    }
}

$categories = $post->getCategories();

$postdetails = $post->getPost();
if (!empty($_POST['savePost']) && $saveError) {
    $postdetails = array(
        'title' => $_POST['title'] ?? '',
        'message' => $_POST['message'] ?? '',
        'longdesc' => $_POST['longdesc'] ?? '',
        'filename' => $_POST['filename'] ?? '0',
        'thumbnail' => $_POST['thumbnail2'] ?? '',
        'name' => '',
        'category_id' => $_POST['category'] ?? '',
        'status' => $_POST['status'] ?? 'draft',
        'author_id' => $_POST['author_id'] ?? '5'
    );
} elseif (!$postdetails) {
    $postdetails = array(
        'title' => '',
        'message' => '',
        'longdesc' => '',
        'filename' => '0',
        'thumbnail' => '',
        'name' => '',
        'category_id' => '',
        'status' => 'draft',
        'author_id' => '5'
    );
}

$pageTitle = $post->id ? 'Edit Post' : 'Add New Post';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="fonts/font-awesome/css/fontawesome-all.min.css" rel="stylesheet">
        <link href="css/navigation.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">

        <script src="//js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
        <script type="text/javascript">
            bkLib.onDomLoaded(function() {
                var uploadUri = 'nicUpload.php?admincms=cmsadmin';
                new nicEditor({ fullPanel: true }).panelInstance('message');
                new nicEditor({ fullPanel: true, uploadURI: uploadUri }).panelInstance('longdesc');
            });
        </script>
    </head>
    <body>
        <div id="page-wrapper">

            <nav id="side-menu" class="navbar-default navbar-static-side" role="navigation">
                <div id="sidebar-collapse">
                    <?php include('navigation.php'); ?>
                </div>
            </nav>

            <?php include('top-navbar.php'); ?>

            <div id="page-content" class="gray-bg">

                <div class="title-header white-bg">
                    <i class="fas fa-edit"></i>
                    <h2><?php echo $pageTitle; ?></h2>
                    <ol class="breadcrumb">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="cms.php">CMS</a></li>
                        <li class="active"><?php echo $pageTitle; ?></li>
                    </ol>
                </div>

                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <div class="panel">
                            <div class="panel-heading">
                                <h2 class="panel-title"><?php echo $pageTitle; ?></h2>
                            </div>
                            <div class="panel-body">

                                <form method="post" id="postForm" enctype="multipart/form-data" action="<?php echo $post->id ? 'compose_post.php?id=' . urlencode($post->id) : 'compose_post.php'; ?>">
                                    <?php if ($post->id) { ?>
                                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($post->id); ?>">
                                    <?php } ?>

                                    <div class="form-group">
                                        <label for="title" class="control-label">Title</label>
                                        <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($postdetails['title']); ?>" placeholder="Post title..">
                                    </div>

                                    <div class="form-group">
                                        <label for="message" class="control-label">Short Description</label>
                                        <textarea class="form-control" rows="5" id="message" name="message" placeholder="Short description"><?php echo htmlspecialchars($postdetails['message']); ?></textarea>
                                        <p class="help-block"><span id="messageWordCount">0</span> / <?php echo CMS_SHORT_DESC_WORD_LIMIT; ?> words</p>
                                        <p class="help-block text-danger" id="messageWordLimitError" style="display:none;">Short Description exceeds the <?php echo CMS_SHORT_DESC_WORD_LIMIT; ?> word limit.</p>
                                    </div>

                                    <div class="form-group">
                                        <label for="longdesc" class="control-label">Long Description</label>
                                        <textarea class="form-control" rows="5" id="longdesc" name="longdesc" placeholder="Long Description"><?php echo htmlspecialchars($postdetails['longdesc']); ?></textarea>
                                        <p class="help-block">Images inserted here must be JPEG, PNG, GIF, or WEBP and no larger than 2 MB.</p>
                                        <p class="help-block"><span id="longdescWordCount">0</span> / <?php echo CMS_LONG_DESC_WORD_LIMIT; ?> words</p>
                                        <p class="help-block text-danger" id="longdescWordLimitError" style="display:none;">Long Description exceeds the <?php echo CMS_LONG_DESC_WORD_LIMIT; ?> word limit.</p>
                                    </div>

                                    <div class="form-group">
                                        <label for="filename" class="control-label">Vimeo URL OR PDF File URL for Download</label>
                                        <textarea class="form-control" rows="3" id="filename" name="filename" placeholder="File Name/Vimeo URL.."><?php echo htmlspecialchars($postdetails['filename']); ?></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="fileToUpload" class="control-label">Image for Post</label>
                                        <input type="file" name="fileToUpload" id="fileToUpload" class="form-control" accept="image/jpeg,image/png,image/gif,image/webp,.jpg,.jpeg,.png,.gif,.webp">
                                        <p class="help-block" id="fileToUploadHelp">Allowed: JPEG, PNG, GIF, WEBP. Maximum size: 2 MB.</p>
                                        <p class="help-block text-danger" id="fileToUploadError" style="display:none;"></p>
                                        <input type="hidden" value="<?php echo htmlspecialchars($postdetails['thumbnail']); ?>" name="thumbnail2">
                                        <?php if (!empty($postdetails['thumbnail'])) { ?>
                                            <img src="img/<?php echo htmlspecialchars($postdetails['thumbnail']); ?>" style="width:200px; margin-top:10px;" alt="Current thumbnail">
                                        <?php } ?>
                                    </div>

                                    <div class="form-group">
                                        <label for="category">Category</label>
                                        <select class="form-control" id="category" name="category">
                                            <?php
                                            while ($category = $categories->fetch_assoc()) {
                                                $selected = ($category['id'] == ($postdetails['category_id'] ?? '')) ? 'selected="selected"' : '';
                                                echo "<option value='" . $category['id'] . "' $selected>" . htmlspecialchars($category['name']) . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="user">Users</label>
                                        <select class="form-control" id="user" name="author_id">
                                            <option value="5" <?php echo ($postdetails['author_id'] == '5' ? 'selected="selected"' : ''); ?>>Pat Vinay</option>
                                            <option value="6" <?php echo ($postdetails['author_id'] == '6' ? 'selected="selected"' : ''); ?>>Nassim Lalehzari</option>
                                            <option value="4" <?php echo ($postdetails['author_id'] == '4' ? 'selected="selected"' : ''); ?>>Zinny Cheng</option>
                                            <option value="7" <?php echo ($postdetails['author_id'] == '7' ? 'selected="selected"' : ''); ?>>Paul Goddard</option>
                                            <option value="8" <?php echo ($postdetails['author_id'] == '8' ? 'selected="selected"' : ''); ?>>Jo Bradshaw</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">Status</label><br>
                                        <label class="radio-inline">
                                            <input type="radio" name="status" id="publish" value="published" <?php if ($postdetails['status'] == 'published') { echo "checked"; } ?>> Publish
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="status" id="draft" value="draft" <?php if ($postdetails['status'] == 'draft') { echo "checked"; } ?>> Draft
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="status" id="archived" value="archived" <?php if ($postdetails['status'] == 'archived') { echo "checked"; } ?>> Archive
                                        </label>
                                    </div>

                                    <div class="form-group">
                                        <input type="submit" name="savePost" id="savePost" class="btn btn-main" value="Save">
                                        <a href="cms.php" class="btn btn-default">Cancel</a>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <?php include('rightsidebar.php'); ?>

        </div>

        <a href="#" id="to-top" class="to-top"><i class="fas fa-angle-double-up"></i></a>

        <?php include('inc/core-scripts.php'); ?>
        <script type="text/javascript">
            var CMS_IMAGE_MAX_BYTES = <?php echo CMS_IMAGE_MAX_BYTES; ?>;
            var CMS_IMAGE_MIME_TYPES = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
            var CMS_IMAGE_EXT_PATTERN = /\.(jpe?g|png|gif|webp)$/i;

            var CMS_SHORT_DESC_WORD_LIMIT = <?php echo CMS_SHORT_DESC_WORD_LIMIT; ?>;
            var CMS_LONG_DESC_WORD_LIMIT = <?php echo CMS_LONG_DESC_WORD_LIMIT; ?>;

            function countWordsFromHtml(html) {
                var tmp = document.createElement('div');
                tmp.innerHTML = html || '';
                var styleAndScriptTags = tmp.querySelectorAll('style, script');
                for (var i = 0; i < styleAndScriptTags.length; i++) {
                    styleAndScriptTags[i].remove();
                }
                var text = (tmp.textContent || tmp.innerText || '').trim();
                if (!text) {
                    return 0;
                }
                return text.split(/\s+/).length;
            }

            function getEditorHtml(fieldId) {
                if (typeof nicEditors !== 'undefined') {
                    var editor = nicEditors.findEditor(fieldId);
                    if (editor) {
                        return editor.getContent();
                    }
                }
                var el = document.getElementById(fieldId);
                return el ? el.value : '';
            }

            function refreshWordCount(fieldId, countElId, errorElId, limit) {
                var count = countWordsFromHtml(getEditorHtml(fieldId));
                var countEl = document.getElementById(countElId);
                var errorEl = document.getElementById(errorElId);
                var overLimit = count > limit;

                countEl.textContent = count;
                countEl.style.color = overLimit ? 'red' : '';
                errorEl.style.display = overLimit ? 'block' : 'none';
                errorEl.style.color = 'red';

                return overLimit;
            }

            function refreshAllWordCounts() {
                refreshWordCount('message', 'messageWordCount', 'messageWordLimitError', CMS_SHORT_DESC_WORD_LIMIT);
                refreshWordCount('longdesc', 'longdescWordCount', 'longdescWordLimitError', CMS_LONG_DESC_WORD_LIMIT);
            }

            document.addEventListener('DOMContentLoaded', function() {
                refreshAllWordCounts();
                setInterval(refreshAllWordCounts, 700);
            });

            function validatePostImageFile(file) {
                if (!file) {
                    return '';
                }
                if (file.size > CMS_IMAGE_MAX_BYTES) {
                    return 'Image must be 2 MB or smaller.';
                }
                if (CMS_IMAGE_MIME_TYPES.indexOf(file.type) === -1 && !CMS_IMAGE_EXT_PATTERN.test(file.name)) {
                    return 'Only JPEG, PNG, GIF, and WEBP images are allowed.';
                }
                return '';
            }

            function showFileUploadError(message) {
                var errorEl = document.getElementById('fileToUploadError');
                errorEl.textContent = message;
                errorEl.style.display = message ? 'block' : 'none';
				errorEl.style.color = 'red';
            }

            document.getElementById('fileToUpload').addEventListener('change', function() {
                var error = validatePostImageFile(this.files[0]);
                if (error) {
                    showFileUploadError(error);
                    this.value = '';
                } else {
                    showFileUploadError('');
                }
            });

            document.getElementById('postForm').addEventListener('submit', function(e) {
                if (typeof nicEditors !== 'undefined') {
                    for (var i = 0; i < nicEditors.editors.length; i++) {
                        nicEditors.editors[i].saveContent();
                    }
                }

                var fileInput = document.getElementById('fileToUpload');
                var error = validatePostImageFile(fileInput.files[0]);
                if (error) {
                    e.preventDefault();
                    showFileUploadError(error);
                    fileInput.focus();
                    return;
                }

                var messageOverLimit = refreshWordCount('message', 'messageWordCount', 'messageWordLimitError', CMS_SHORT_DESC_WORD_LIMIT);
                var longdescOverLimit = refreshWordCount('longdesc', 'longdescWordCount', 'longdescWordLimitError', CMS_LONG_DESC_WORD_LIMIT);
                if (messageOverLimit || longdescOverLimit) {
                    e.preventDefault();
                    var target = messageOverLimit ? 'messageWordLimitError' : 'longdescWordLimitError';
                    document.getElementById(target).scrollIntoView({ block: 'center' });
                }
            });
        </script>

    </body>
</html>
