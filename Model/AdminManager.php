<?php

namespace MarieMarthe\Blog\Model;



class AdminManager extends Manager
{
    public function checkLogin($login,$password)
    {  
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT login, password FROM administrateur WHERE login = ?');
        $req->execute(array($login));
        $admin = $req->fetch();
        $hash = sha1($_POST['password']);
       
        if ($admin['password'] == $hash) {
            $adminInfo = array(
               'login' => $admin['login']
            );
            return $adminInfo;
        } else {
            echo 'Erreur de mot de passe';
            return false;
        }

    }

    public function isAdmin()
    {
        if (isset($_SESSION['administrateur']) && !empty($_SESSION['administrateur'])) {
            return $_SESSION['administrateur'] === true;
        }
        return false;

    }
    
}