<?php

require_once '../classes/Database.class.php';

class Article
{

    private PDO $db;

    public function __construct($dbConnection)
    {
        $this->db = $dbConnection;
    }

    public function addArticle($title, $content, $images, $themeID, $userID)
    {
        $stmt = $this->db->prepare("INSERT INTO articles (title, content, images, themeID, userID) VALUES (:title, :content, :images, :themeID, :userID)");
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':images', $images);
        $stmt->bindParam(':themeID', $themeID);
        $stmt->bindParam(':userID', $userID);
        $stmt->execute();

        return $this->db->lastInsertId();
    }


    public function addArticleTag($articleID, $tagID): bool
    {
        $stmt = $this->db->prepare("INSERT INTO article_tag (articleID, tagID) VALUES (:articleID, :tagID)");
        $stmt->bindParam(':articleID', $articleID);
        $stmt->bindParam(':tagID', $tagID);
        return $stmt->execute();
    }

    public function updateArticle($articleID, $title, $content, $tags, $images, $userID, $themeID)
    {
        $stmt = $this->db->prepare("UPDATE articles 
                                SET title = :title, content = :content, tags = :tags, images = :images, userID = :userID, themeID = :themeID
                                WHERE articleID = :articleID");
        $stmt->bindParam(":articleID", $articleID);
        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":content", $content);
        $stmt->bindParam(":tags", $tags);
        $stmt->bindParam(":images", $images);
        $stmt->bindParam(":userID", $userID);
        $stmt->bindParam(":themeID", $themeID);
        return $stmt->execute();
    }


    public function updateArticleStatus($articleID, $status)
    {
        $stmt = $this->db->prepare("UPDATE articles SET status = :status WHERE articleID = :articleID");
        $stmt->bindParam(':articleID', $articleID);
        $stmt->bindParam(':status', $status);
        return $stmt->execute();
    }


    public function deleteArticle($articleID)
    {
        $stmt = $this->db->prepare("DELETE FROM articles WHERE articleID = :articleID");
        $stmt->bindParam(':articleID', $articleID);
        return $stmt->execute();
    }
    public function getAllArticles(int $limit, int $offset): array
    {
        $stmt = $this->db->prepare("SELECT * FROM articles ORDER BY created_at DESC LIMIT :limit OFFSET :offset");
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getArticleByID($articleID): array
    {
        $stmt = $this->db->prepare("SELECT * FROM articles WHERE articleID = :articleID");
        $stmt->bindParam(':articleID', $articleID);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getTotalArticles(): int
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) as total FROM articles");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return (int)$result['total'];
    }

    public function getAuthorBy($articleID) {
            $stmt = $this->db->prepare("SELECT users.first_name FROM articles JOIN users ON articles.userID = users.userID WHERE articles.articleID = :articleID");
            $stmt->bindParam(':articleID', $articleID);
            $stmt->execute();
            return $stmt->fetchColumn();
        }





    }
