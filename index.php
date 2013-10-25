<?php
require_once './classes/Database.php';
require_once './classes/Session.php';
require_once './vendor/autoload.php';
class Controller{
    public function generateIndex(){
        $auth = new Session(true);
        $db = new Database();
        $images = $db->get_images();
        $loader = new Twig_Loader_Filesystem('./templates');
        $twig = new Twig_Environment($loader, array(/*'cache' => './template_cache'*/));
        echo $twig->render('images.html.twig', array('images' => $images , 'auth' => $auth->isTrue()));
    }
}

$page = new Controller();
$page->generateIndex();
