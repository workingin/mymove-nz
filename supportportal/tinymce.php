<!DOCTYPE html>
<html>
<head>
  <script src="https://cdn.tiny.cloud/1/a32hib0qq37ghvk5u2kr2c2uvr88qmlck3r9y0sazdpi1hqj/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
</head>
<body>
  <textarea>
    Welcome to TinyMCE!
  </textarea>
  <script type="text/javascript">

tinymce.init({
    selector: "textarea",
    menubar: false,
    toolbar: "bold italic underline"
});
</script>

<form method="post" action="dump.php">
    <textarea name="content"></textarea>
</form>
</body>
</html>