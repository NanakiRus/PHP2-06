<?php

namespace App\Controller;

use App\Controller;
use App\Exception\ExceptionMulti;
use App\Models\Article;
use App\Exception\Exception404;

class Admin
    extends Controller
{

    protected function actionAll()
    {
        $this->view->news = Article::findAll();
        $this->view->view(__DIR__ . '/../../template/admin/template.php');
    }

    protected function actionOne()
    {
        if (isset($_GET['id'])) {
            $this->view->article = Article::findOneById($_GET['id']);
            if (false === $this->view->article) {
                throw new Exception404('404 - документ не найден', $_GET['id']);
            } else {
                $this->view->view(__DIR__ . '/../../template/admin/article.php');
            }
        }
    }

    protected function actionDelete()
    {
        if (isset($_GET['id'])) {
            $news = Article::findOneById((int)$_GET['id']);
            $news->delete();
        }
        header('Location: /obychenie/Php2-06/admin/index.php');
        die;
    }

    protected function actionCU()
    {
        if (isset($_POST['id']) && '' !== $_POST['id']) {
            $article = Article::findOneById((int)$_POST['id']);

            if (false === $article) {
                $article = new Article();
            }

        } else {
            $article = new Article();
        }

        if (isset($_POST['id']) && '' !== $_POST['id']) {
            $article->id = $_POST['id'];
        }

        if (isset($_POST)) {
            $article->fill($_POST);
            $article->save();
        }

        /*if (isset($_POST['title']) && isset($_POST['text'])) {
            $article->title = $_POST['title'];
            $article->text = $_POST['text'];
            $article->save();
        }*/
        header('Location: /obychenie/Php2-06/admin/index.php');
        die;
    }


}