<?php

require __DIR__ . '/../autoload.php';

$article = \App\Models\Article::findOne(1);

assert(is_object($article));
assert($article instanceof \App\Models\Article);
assert('СМИ показали новую «первую леди» Белоруссии' == $article->title);