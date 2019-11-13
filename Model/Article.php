<?php

class Article extends Database
{


    /**
     * Pour afficher tous les articles */

    public function getArticles()
    {
        $sql = 'SELECT id, title, content, author, createdAt FROM article ORDER BY id DESC';
        return $this->createQuery($sql);
    }


    /**
     * Pour afficher le contenu d'un article */

    public function getArticle($articleId)
    {
        $sql = 'SELECT id, title, content, author, createdAt FROM article WHERE id = ?';
        return $this->createQuery($sql, [$articleId]);

    }

    /**
     * Méthode ajouter un article
     */
    public function addArticle($title, $content)
    {
        $sql = 'INSERT INTO article(title, content, createdAt)' . ' values(?,?, NOW())';
        $article = $this->executeRequest($sql, array($title, $content));
        return $article;
    }

    /**
     * Méthode mettre à jour un Article
     */
    public function updateArticle($title, $content, $id)
    {
        $sql = 'UPDATE article SET title = ? , content = ? WHERE id = ?';
        $article = $this->executeRequest($sql, array($title, $content, $id));
        return $article;
    }

    /**
     * Méthode supprimer un Article
     */
    public function deletePArticle($id)
    {
        $sql = 'DELETE FROM post WHERE id = ?';
        $article = $this->executeRequest($sql, array($id));
        return $article;
    }

}