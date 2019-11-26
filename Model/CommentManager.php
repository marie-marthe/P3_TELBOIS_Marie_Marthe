<?php

namespace MarieMarthe\Blog\Model;



class CommentManager extends Manager
{

    //Afficher les commentaires d'un chapitre
    //@param $chapterId
    // @return PDOStatement

    public function getComments($chapterId)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE chapter_id = ? ORDER BY comment_date DESC');
        $comments->execute(array($chapterId));

        return $comments;
    }


    //Afficher les commentaires d'un post
    //@param $commentId
    // @return PDOStatement

    public function getComment($commentId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE id = ?');
        $req->execute(array($commentId));
        $comment = $req->fetch();

        return $comment;
    }


    //Permet l'enregistrement d'un nouveau commentaire lors d'une saisie dans le formulaire présent dans chapterView.php
    //@param $author
    // @param $chapterId
    // @param $comment
    //@return bool


    public function chapterComment($chapterId, $author, $comment)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('INSERT INTO comments(chapter_id, author, comment, comment_date) VALUES(?, ?, ?, NOW())');
        $affectedLines = $comments->execute(array($chapterId, $author, $comment));

        return $affectedLines;
    }


    //Méthode pour enregistrer le signalement d'un commentaire dans la BDD.

    public function signalComment($commentId)
    {
        $db = $this-> dbConnect();
        $req = $db->prepare('UPDATE comments SET signal_comment = 1 WHERE id = ?');
        $req->execute(array($commentId));
        $signal = $req->rowCount(); 
       
        return $signal;         
    }


    //Méthode pour afficher un commentaire signalé

    public function getSignalComments()
    {
        $db = $this->dbConnect();
        $comments = $db->query('SELECT comments.id, chapters.title, comments.chapter_id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y \') AS comment_date_fr FROM comments INNER JOIN chapters ON chapters.id = comments.chapter_id WHERE signal_comment =1 ORDER BY comment_date DESC');
        
        return $comments;
      
    }



    //Méthode pour supprimer le commentaire de la BDD
    //(après signalement)


    public function deleteComment($id) 
    {
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM comments WHERE id = ?');
        $req->execute(array($id));
        $delete = $req->rowCount();
        
        return $delete;
    }

    //Méthode qui permet de valider le commentaire
    //(après signalement) via la méthode approveComment dans le Backend.

    public function approveComment($id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE comments SET signal_comment = 0 WHERE id = ?');
        $req->execute(array($id));
        $signal = $req->rowCount(); 
       
        return $signal;     
    }
}