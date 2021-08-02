<!doctype html>
<html lang="ru">
<?php require  ('blocks/head.php'); ?>
<body>
    <?php require "header.php" ?>
    <div class="container mt-4">
        <form id="forminput1" action="" method="post">
            <h3>Введите полную информацию о задержанном ТС:</h3><br>
            <textarea rows="10" cols="80" name="text" class="form-control" placeholder="Проговорите полные данные"></textarea><br>
            <button type="submit" name="insert1" class="btn btn-success">Внести данные в журнал</button>
        </form>
    </div>
    <?php require "footer.php" ?>
</body>
</html>
