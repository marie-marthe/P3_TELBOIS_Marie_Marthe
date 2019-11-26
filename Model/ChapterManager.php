<?php

namespace MarieMarthe\Blog\Model;




class ChapterManager extends Manager
{


     //Pour afficher tous les posts
     //@return PDOStatement

    public function getChapters()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM chapters ORDER BY creation_date');

        return $req;
    }


      //Pour afficher le contenu d'un chapitre
      //@param $chapterId
      //@return mixed
      //@throws ChapterManager


    public function getChapter($chapterId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM chapters WHERE id = ?');
        $req->execute(array($chapterId));
        $chapter = $req->fetch();

        return $chapter;
    }

    // Méthode ajouter un chapitre


    public function ajoutChapter($title, $content)
    {
        $db = $this->dbConnect();
        $chapter = $db->prepare('INSERT INTO chapters(title, content, creation_date) VALUES(?, ?, NOW())');
        $affectedLines = $chapter->execute(array($title, $content));

        return $affectedLines;
    }

    // Méthode mettre à jour un chapitre

    public function updateChapter($id, $title, $content)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE chapters SET title= :newTitle, content= :newContent WHERE id = :id');
        $req->bindValue(':id', $_GET['id'], \PDO::PARAM_INT);
        $req->bindValue(':newTitle', $_POST['title'], \PDO::PARAM_STR);
        $req->bindValue(':newContent', $_POST['content'], \PDO::PARAM_STR);
        $affectedLines = $req->execute(array(':id' => $id, ':newTitle' => $title,':newContent' => $content));

        return $affectedLines;
    }



    // Méthode supprimer un chapitre


    public function deleteChapter($id)
    {
        $db = $this->dbConnect();
        $comment = $db->prepare('DELETE FROM comments WHERE chapter_id = ?');
        $comment->execute([$id]);
        $req = $db->prepare('DELETE FROM chapters WHERE id = ? LIMIT 1');
        $req->execute(array($id));
        $delete = $req->rowCount();

        return $delete;
    }
}
