<?php

class Comment extends Database
{

    /**
     * Afficher les commentaires d'un article
     * article/commentaires
     */

    public function getCommentsFromArticle($articleId)
    {
        $sql = 'SELECT id, pseudo, content, createdAt FROM comment WHERE article_id = ? ORDER BY createdAt DESC';
        return $this->createQuery($sql, [$articleId]);
    }



    /**
     * Méthode pour supprimer le commentaire de la BDD
     * (après signalement)
     */
    public function delete($id)
    {
        $sql = 'DELETE FROM comment WHERE id = ?';
        $comment = $this->executeRequest($sql, array($id));
        return $comment;
    }
}