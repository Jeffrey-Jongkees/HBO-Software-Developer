<?php

require_once 'models/article.php';


class ArticleController {
    public function create() {
        require_once 'view/create.php';
    }

    public function index() {
        $controller = new ArticleController();
        $articles = $controller->readAllArticles();
        require_once 'view/articles.php';
    }

    public function readAllArticles() {
        $article = new Article(null, null);
        return $article->readAllArticles();
    }

    public function edit($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['naam'];
            $price = $_POST['prijs'];
            if(!empty($name) && !empty($price)) {
                $article = new Article($name, $price, $id);
                $article->updateArticle();
                header('Location: article');
                exit();
            }elseif(empty($name) || empty($price)){
                echo "Beide velden moeten ingevuld zijn";
                $article = new Article(null, null, $id);
                $article->readArticle();
            }
        }else {
            $article = new Article(null, null, $id);
            $article->readArticle();
        }
        require_once 'view/edit.php';
    }

    public function delete($id) {
        $article = new Article(null, null, $id);
        $article->deleteArticle();
        require_once 'view/delete.php';
        header('Location: article');
        exit();
    }

    public function submit() {
        require_once 'view/create.php';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['naam'];
            $price = $_POST['prijs'];
            if(!empty($name) && !empty($price)) {
                $article = new Article($name, $price);
                $article->createArticle();
                echo "Artikel toegevoegd";
            }else {
                echo "Er is geen naam of prijs ingevoerd, deze velden zijn verplicht";
            }
        }else {
            echo "Artikel niet toegevoegd, er is iets mis gegaan met de post request";
        }
    }   

}
?>