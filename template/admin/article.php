<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<div class="container">
    <article>
            <form method="post" action="/obychenie/Php2-06/admin/index.php?act=CU">
                <!-- Присвоение необходимо, что-бы избежать повторных запросов к БД -->
                <p><?php if (false !== ($author = $article->author)) {
                    echo $author->firstname . ' ' . $author->lastname;
                    } else {
                        echo 'Автор не указан';
                    } ?></p>
                <input type="hidden" name="id" value="<?php echo $article->id; ?>">
                <p><input type="text" class="form-control" name="title" value="<?php echo $article->title; ?>"></p>
                <p><textarea name="text" class="form-control" rows="3"><?php echo $article->text; ?></textarea></p>
                <input value="Сохранить" class="btn btn-default btn-lg" type="submit">
                <a class="btn btn-default btn-lg" href="/obychenie/Php2-06/admin/index.php?act=Delete&id=<?php echo $article->id; ?>">Удалить</a>
            </form>
    </article>
</div>

</body>
</html>