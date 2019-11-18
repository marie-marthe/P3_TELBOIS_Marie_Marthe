<?php
namespace MarieMarthe\Blog\Controller;

use MarieMarthe\Blog\Model\CommentManager;
use MarieMarthe\Blog\Model\Manager;


// Chargement des classes
require_once 'model/Manager.php';
require_once 'model/ChapterManager.php';
require_once 'model/CommentManager.php';
require_once 'model/AdminManager.php';

class Frontend extends Manager
{

    public function connection($login, $password)
    {
        $adminManager = new \MarieMarthe\Blog\Model\AdminManager();
        $adminInfo = $adminManager->checkLogin($login, $password);
        
        if ($adminInfo) {
        
            $_SESSION['administrateur'] = true;
            $_SESSION['login'] = $adminInfo['login'];
            $this->setFlash('Vous êtes à présent connecté', 'info');
            header('Location: index.php?action=listChaptersBackend');
        } else {
            $this->setFlash('Identifiants incorrects', 'warning');
            include 'view/frontend/connexionView.php';
        }
    }

    public function listChapters()
    {
        $chapterManager = new \MarieMarthe\Blog\Model\ChapterManager();
        $chapters = $chapterManager->getChapters();
        
        include 'view/frontend/listChaptersView.php';
    }

    public function chapter()
    {
        $chapterManager = new \MarieMarthe\Blog\Model\ChapterManager();
        $commentManager = new \MarieMarthe\Blog\Model\CommentManager();

        $chapter = $chapterManager->getChapter($_GET['id']);
        $comments = $commentManager->getComments($_GET['id']);
    
        include 'view/frontend/chapterView.php';
    }

    public function comment()
    {
        $commentManager = new \MarieMarthe\Blog\Model\CommentManager();
        $comment = $commentManager->getComment($_GET['id']);

        include 'view/frontend/commentView.php';
    }

    public function addComment($chapterId, $author, $comment)
    {
        $commentManager = new \MarieMarthe\Blog\Model\CommentManager();

        $affectedLines = $commentManager->chapterComment($chapterId, $author, $comment);

        if ($affectedLines === false) {
            throw new Exception('Impossible d\'ajouter le commentaire !');
        } else {
            header('Location: index.php?action=chapter&id=' . $chapterId);
        }
    }

    public function signalComment($commentId, $chapterId)
    {
        $commentManager = new CommentManager();
        $signal = $commentManager->signalComment($commentId);
        if ($signal > 0) {
            header('Location: index.php?');
        } else {
            echo 'Ce commentaire est en attente de modération, je me dépêche ;)' ;
        }

        include 'view/frontend/commentView.php';
    }
}



