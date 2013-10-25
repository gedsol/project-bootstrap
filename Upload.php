<?php

try{
    if($_POST['submit']){
        require_once './classes/Uploader.php';
        $loader = new Uploader();
        $loader->upload();
        header("Location: /");
    }
}
catch (Exception $e){
    echo $e->getMessage();
    exit;
}
