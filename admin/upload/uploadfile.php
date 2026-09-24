<form  method="post" class="wpcf7-form init" enctype="multipart/form-data" action="fileupload.php" required>  
<input type="hidden" name="qnr" value="<?echo $qnr;?>">

<ul><input type="hidden" name="job" value="<?echo $applyvariable;?>">
 <div class="row">

<select name="filecategory" required class="wpcf7-form-control wpcf7-select" aria-invalid="false">
    <option value="">Select Category</option>
    <option value="1-2 Years">Health & Safety Info</option>
    <option value="2-4 Years">Industry & Training Info</option>
  <input  type="text" name="filetitle" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" placeholder="File Title">
       </div>
	<input id="aa" class="confirmationx" style="margin-left:40px;" onchange="pressed()" type="file"  required name="fileToUpload" size="40"  accept=".jpg,.jpeg,.png,.gif,.pdf,.doc,.docx,.ppt,.pptx,.odt,.avi,.ogg,.m4a,.mov,.mp3,.mp4,.mpg,.wav,.wmv" aria-invalid="false">
      <label id="fileLabel" style="color: #000;font-weight: bold; ">Upload Document</label></span>

        <br></p><p> 
 </div>
   <p> 
<input type="submit" value="Apply Now" style="font-size:18px;cursor:pointer;" class="wpcf7-form-control wpcf7-submit">
</p>
</form>