<?php
namespace MarieMarthe\Blog\Controller;

use \MarieMarthe\Blog\Model\Manager;
// Chargement des classes
require_once 'model/ChapterManager.php';
require_once 'model/CommentManager.php';
require_once 'model/AdminManager.php';
require_once 'model/Manager.php';

class Backend extends Manager
{

    // constructeur de la partie backend
    // on initialise la variable interface sur Admin
    // fonction qui vérifie si l'admin est loggé pour accéder aux fonctionnalités
    public function __construct()
    {
        parent::__construct();
        if (!$this->isAdmin()) {
            $this->setFlash('Vous n\'êtes pas autorisé à accéder à cette page', $this::FLASH_ERROR);
           
        }
    }

    function listChaptersBackend()
    {
        $chapterManager = new \MarieMarthe\Blog\Model\ChapterManager();
        $chapters = $chapterManager->getChapters();

        include 'view/backend/listChaptersViewBackend.php';
    }

    function chapterBackend()
    {
        $chapterManager = new \MarieMarthe\Blog\Model\ChapterManager();
        $commentManager = new \MarieMarthe\Blog\Model\CommentManager();
        $chapter = $chapterManager->getChapter($_GET['id']);
        $comments = $commentManager->getComments($_GET['id']);

        include 'view/backend/chapterViewBackend.php';
    }

    //ajouter un chapitre
    function addChapter($title, $content)
    {
        $chapterManager = new \MarieMarthe\Blog\Model\ChapterManager();
        $affectedLines = $chapterManager->ajoutChapter($title, $content);
    
        if ($affectedLines === true) {
            header('Location: index.php?action=listChaptersBackend');
            
        } else {
            throw new Exception('Impossible d\'ajouter le chapitre !');
        }
    }

    //Modifier un chapitre
    function modifyChapter($id, $title, $content)
    {    
        $chapterManager = new \MarieMarthe\Blog\Model\ChapterManager();
        $affectedLines = $chapterManager->updateChapter($id, $title, $content);
        
        if ($affectedLines === false) {
            throw new Exception('Impossible de modifier ce chapitre !');
        } else {
            header('Location: index.php?action=listChaptersBackend');
        }
    }

    // Effacer un article
    function deleteChapter($id)
    {
        $chapterManager = new \MarieMarthe\Blog\Model\ChapterManager();
        $supprimChapter = $chapterManager->deleteChapter($id);
        
        if ($supprimChapter > 0) {
            header('Location: index.php?action=listChaptersBackend');
        } else {
            throw new Exception('Impossible de supprimer ce chapitre !');
        }

    }

    function commentBackend($id)
    {
        $commentManager = new \MarieMarthe\Blog\Model\CommentManager();
        $comment = $commentManager->getComment($_GET['id']);

        include 'view/frontend/commentView.php';
    }

        //Signaler un commentaire
    function signalCommentBackend() 
    {
        $commentManager = new \MarieMarthe\Blog\Model\CommentManager();
        $comments = $commentManager->getSignalComments();
        
        include 'view/backend/signalCommentView.php';
    }
    // Effacer un commentaire
    function deleteComment($id)
    {
        $commentManager = new \MarieMarthe\Blog\Model\CommentManager();
        $supprimComment = $commentManager->deleteComment($id);

        if ($supprimComment > 0) {
            header('Location: index.php?action=commentSignal');
        } else {
            throw new Exception('Impossible de supprimer ce commentaire !');
        }
    }

    //Moderer un commentaire
    function approveComment($id)
    {
        $commentManager = new \MarieMarthe\Blog\Model\CommentManager();
        $commentApprove = $commentManager->approveComment($id);

        if ($commentApprove > 0) {
            header('Location: index.php?action=commentSignal');
        } else {
            throw new Exception('Impossible d\'approuver ce commentaire !');
        }
    }

    // function déconnecte un admin en réinitiallisant les varibles SESSION
    // On renvoie sur la page d'accueil
    function logOut()
    {
        session_destroy();
        session_start();
        $this->setFlash('Vous êtes à présent déconnecté', 'info');
        header('Location:index.php');
    }
}

