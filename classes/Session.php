<?php
/*
 * klase atsakinga uz vartotojo autorizacija
 */
class Session {
    const username = "root";
    const password = "root";
    public function __construct($auth){
        session_start();                        //pratesia arba pradeda nauja sesija
        if(isset($_POST['button'])){            //jei paspaustas login mygtukas
            if($_POST['button']=='Login'){
                if(($_POST['username'] == self::username) && ($_POST['password'] == self::password)){
                    $_SESSION['auth']="1";
                    return;
                }
                else{
                    $_SESSION['auth']="0";
                    return;
                }
            }
            elseif($_POST['button']=='Logout'){     //jei atsijungia
                if(isset($_SESSION['auth']) && "1" == $_SESSION['auth']){
                    $_SESSION['auth']="0";
                    session_destroy();
                    return;
                }
            }
        }
    }
    public function isTrue(){               //tikrina sesijos statusa
        if(isset($_SESSION['auth'])){
            return $_SESSION['auth']==1;
        }
        else return false;
    }
}