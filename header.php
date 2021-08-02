<header>
    <div class="logo">
        <a href="index.php"><img class="logo-img" src="img/logo.jpg" alt="Logo"></a>
    </div>
    <nav class="top_menu" id="menu">
        <ul>
            <li><a href="#">ЖУРНАЛ</a>
                <ul>
                    <li><a href="jurnal.php?j=today" id="today">За сегодня</a></li>
                    <li><a href="jurnal.php?j=yesterday" id="yesterday">За вчера</a></li>
                    <li><a href="jurnal.php?j=dat" id="dat">Поиск за период </a></li>
<!--                    <li><a href="jurnal.php?j=all" id="all">Все данные</a></li>-->
                    <li><a href="jurnal.php?j=gn" id="gn">Поиск по Г/Н...</a></li>
                </ul>
            </li>
            <li><a href="#">ВНЕСТИ ДАННЫЕ</a>
                <ul>
                    <li><a href="input2.php" id="nav_2">Все сведения...</a></li>
                    <li><a href="input3.php" id="nav_3">Добавить ФОТО...</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <?php include "blocks/pb_progress.php" ?>
</header>

