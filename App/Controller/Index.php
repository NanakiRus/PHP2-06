<?php

namespace App\Controller;

use App\Controller;
use App\Exception\Exception404;
use App\Models\Article;

class Index
    extends Controller
{

    protected function actionAll()
    {
        $this->view->news = Article::findAll();
        $this->view->test = \PHP_Timer::resourceUsage();
        $this->view->view(__DIR__ . '/../../template/template.php');
    }

    protected function actionOne()
    {
        if (isset($_GET['id'])) {
            $this->view->article = Article::findOneById($_GET['id']);
            $this->view->test = \PHP_Timer::resourceUsage();
            if (false === $this->view->article) {
                throw new Exception404('404 - документ не найден', $_GET['id']);
            } else {
                $this->view->view(__DIR__ . '/../../template/article.php');
            }
        }
    }

}