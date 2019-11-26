<?php

namespace MarieMarthe\Blog\Model;



 //Les méthodes de la classe AdminManager permettent de vérifier si un utilisateur existe
 //et de gérer ses propriétés (login, password).


class AdminManager extends Manager
{

    // Vérifie que l'utilisateur existe dans la BDD
    //$param $login
    // $param $password


    public function checkLogin($login, $password)
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

    public function newPassword($newpassword, $id)
    {
        $newpassword = password_hash($newpassword, $id);
        $req = 'UPDATE administrateur SET password = ? WHERE id = ?';
        $user = $this->executeRequest($req, array($newpassword, $id));
        return $user;
    }
    
}