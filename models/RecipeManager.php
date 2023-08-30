<?php

require_once('Manager.php');
require_once('entities/RecipeEntity.php');
/**
 * Summary of RecipeManager
 */
class RecipeManager extends Manager
// get all
// get one
// insert
// delete
// update(optional)
{

    public function getRecipes(): array
    {
        $req = $this->db->query('
        SELECT * 
        FROM recipes 
        ORDER BY name DESC  
    '); // this query gives you all the recipes from DB ordered by name
        $rows = $req->fetchAll(PDO::FETCH_ASSOC);
        $result = [];
        foreach ($rows as $row) {
            $result[] = new ArticleEntity($row['id'], $row['title'], $row['content'], $row['created_at']);
        }
        return $result;
    }

    public function getArticle(int $id): ArticleEntity // this query gives you one recipe by id
    {
        $req = $this->db->prepare('
        SELECT *
        FROM articles 
        WHERE id = ? 
    ');
        $req->execute([$id]);

        $result = $req->fetch(PDO::FETCH_ASSOC); // gives back only one row each call (if you will use loop, use while!)
        return new ArticleEntity($result['id'], $result['title'], $result['content'], $result['created_at']);
    }

    public function insertArticle(ArticleEntity $articleEntity) // inserts new recipe into the DB
    {
        $req = $this->db->prepare("INSERT INTO articles (title, content)
    VALUES (?, ?)");
        $req->execute([$articleEntity->getTitle(), $articleEntity->getContent()]);
    }

}