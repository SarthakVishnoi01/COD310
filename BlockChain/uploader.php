<?php
  $file_result = "";

  if ($_FILES["file"]["error"] > 0)
  {
    $file_result .= "No File Uploaded ";
    $file_result .= "Error COde " . $_FILES["file"]["error"] . "<br>";
  } else {

    $file_result .=
    "Upload: " . $_FILES["file"]["name"] . "<br>" .
    "Type: " . $_FILES["file"]["type"] . "<br>" .
    "Size: " . ($_FILES["file"]["size"]/1024) . "<br>" .
    "Temp File: " . $_FILES["file"]["tmp_name"] . "<br>";

    move_uploaded_file($_FILES["file"]["tmp_name"], "full/path/on/server" . $_FILES["file"]["name"]);

    $file_result .= "File Uploaded Successfully!";
  }
?>
