<?php
require_once './classes/Database.php';
/*
 *  kol kas trinimas implementuotas tik rankiniu budu nurodzius paveikslelio id
 */
    if($_POST['Submit']){
        $db = new Database();
        $db->delete_image($_POST['imageId']);
    }