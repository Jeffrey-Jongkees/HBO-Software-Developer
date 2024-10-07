<?php

require_once 'Database.php'; 

class Article {
    public $name;
    public $price;
    public $id;
    private $db;

    public function __construct($name, $price, $id=null) {
        $this->name = $name;
        $this->price = $price;
        $this->id = $id;
        $this->db = (new Database())->getConnection(); // Connect to the database
    }

    public function createArticle() {
        // query the database to add an article
        $sql = "INSERT INTO article (Naam, Prijs) VALUES (:naam, :prijs)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['naam' => $this->name, 'prijs' => $this->price]);

        return $stmt;
    }

    public function readArticle() {
        // query the database for a specific article by ID
        $sql = $this->db->prepare("SELECT * FROM article WHERE ID = :id");
        $sql->execute(['id' => $this->id]);
        $article = $sql->fetch(PDO::FETCH_ASSOC);

        if ($article) {
            $this->name = $article['Naam'];
            $this->price = $article['Prijs'];
        }

        return $article; 
    }

    public function readAllArticles() {
        // query the database for all articles
        $sql = $this->db->prepare("SELECT * FROM article");
        $sql->execute();
        $articles = $sql->fetchAll(PDO::FETCH_ASSOC);

        return $articles;
    }

    public function updateArticle() {
        // query the database to update an article
        $sql = $this->db->prepare("UPDATE article SET Naam=:naam, Prijs=:prijs WHERE ID =:id");
        $sql->execute(['naam' => $this->name, 'prijs' => $this->price, 'id' => $this->id]);

        return $sql->rowCount();
    }

    public function deleteArticle() {
        // query the database to delete an article
        $sql = $this->db->prepare("DELETE FROM article WHERE ID = :id");
        $sql->execute(['id' => $this->id]);
    }
}
?>
