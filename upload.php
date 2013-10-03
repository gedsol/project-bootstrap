<?php
$directory_self = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']);
$uploadsDirectory = $_SERVER['DOCUMENT_ROOT'] . $directory_self. 'images/';
$fieldname = 'file';
$uploadFilename = $uploadsDirectory . $fieldname . ".jpg";
$errors = array(1 => 'php  server cannot accept file this big',
    2 => 'html form cannot accept file this big',
    3 => 'file upload was not complete',
    4 => 'no file was attached');
isset($_POST['submit'])
    or error('the upload form is needed',$directory_self);
($_FILES[$fieldname]['error'] == 0)
    or error($errors[$_FILES[$fieldname]['error']],$directory_self);
@is_uploaded_file($_FILES[$fieldname]["tmp_name"])
    or error('not an HTTP upload', $directory_self);
@getimagesize($_FILES[$fieldname]["tmp_name"])
    or error('only image uploads are allowed',$directory_self);
@file_exists($uploadFilename)
    or unlink($uploadFilename);
@move_uploaded_file($_FILES[$fieldname]["tmp_name"], $uploadFilename)
    or error("Server cannot handle the uploaded file",$directory_self);
header("Location: /");

function error($error, $dir)
{
    header("Refresh: 0; URL=\"$dir\"");
    $error = '"' . $error . '"';
    echo '<script>alert('. $error .')</script>';
    exit;
}

?> 