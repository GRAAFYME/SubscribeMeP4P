<?php echo $error;?>

<?php echo form_open_multipart('upload/do_upload');?>

<input type="file"  name="userfile" size="20"  />

<br /><br />

<input type="submit" value="upload" class="button" onClick="return confirm ('Weet u zeker dat u dit bestand wilt uploaden?')" />