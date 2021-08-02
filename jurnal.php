<!doctype html>
<html lang="ru">
<?php require_once  ('blocks/head.php'); ?>

<body>
    <?php
        require_once "header.php";
        require_once ("libs/Mobile_Detect.php");
	    $detect = new Mobile_Detect;
        ( $detect->isMobile() ? $clmns=8 : $clmns=10 );
    ?>

    <div class="form_jurnal" id="jurnal">

        <div class="jurnal_table">

            <!--  ----------------------------------------  ПОИСК ПО НОМЕРУ --------------------------------->
            <?php if ( ((isset($_GET['j'])) && ($_GET['j']=="gn")) || (isset($_GET['gn'])) ): ?>
                <form class="form_group_gn" name="form_search_gn" action="<?=$_SERVER['PHP_SELF'];?>" method="get">
                    <label class="form_label">Введите номер ТС для поиска:</label>
                    <div style="width: 150px; padding-right: 20px">
                        <input class="form_input" type="text" required name="gn" placeholder="ВВЕДИТЕ Г/Н" maxlength="9" value="<?php echo $_GET['gn']??''; ?>">
                    </div>
                    <label class="form_label">    </label>
                    <button class="form_button_case" type="submit" name="search">ПОИСК</button>
                </form>
            <?php endif; ?>

            <!--  ----------------------------------------  ПОИСК ПО ДАТЕ --------------------------------->
            <?php if ( ((isset($_GET['j'])) && ($_GET['j']=="dat")) || ( (isset($_GET['dat1'])) && (isset($_GET['dat2'])) ) ): ?>
                <form class="form_group_gn" name="form_search_gn" action="<?=$_SERVER['PHP_SELF'];?>" method="get">
                    <label class="form_label">Введите интервал дат для поиска c </label>
                    <div style="width: 150px; padding-right: 20px">
                        <input class="form_input" type="date" required name="dat1" placeholder="c" value="<?php echo $_GET['dat1']??''; ?>">
                    </div>
                    <label class="form_label"> по </label>
                    <div style="width: 150px; padding-right: 20px">
                        <input class="form_input" type="date" required name="dat2" placeholder="по" value="<?php echo $_GET['dat2']??''; ?>">
                    </div>
                    <label class="form_label">    </label>
                    <button class="form_button_case" type="submit" name="search">ПОИСК</button>
                </form>
            <?php endif; ?>

            <table cols="<?php $clmns; ?>">

<!--  ----------------------------------------  ЗАГОЛОВОК ТАБЛИЦЫ --------------------------------->
                <?php
                if ( ((isset($_GET['j'])) && ($_GET['j']=="gn")) || (isset($_GET['gn'])) ){
                    if (isset($_GET['gn'])) {
                        if ($detect->isMobile()) {
                            echo "<h4>".TITLE_JURNAL.TITLE_JURNAL4."<b>".mb_strtoupper($_GET['gn'])."</b></h4>";
                        } else {
                            echo "<h4>".TITLE_JURNAL.TITLE_JURNAL4."<b>".mb_strtoupper($_GET['gn'])."</b>  <a href=".mb_strtoupper($_GET['gn']).
                                " class='jrn_word' id='gn'><img class='foto-img' src='img/word1.gif' onmouseout=\"this.src='img/word1.gif';\" onmouseover=\"this.src='img/word2.gif';\" alt='MS Word'></a></h4>";
                        }

                    } else {
                        echo "<h4>" . TITLE_JURNAL . TITLE_JURNAL4 . "<b>_________</b></h4>";
                    }
                } elseif ( ((isset($_GET['j'])) && ($_GET['j']=="dat")) || ( (isset($_GET['dat1'])) && (isset($_GET['dat2'])) ) ){
                    if ( (isset($_GET['dat1'])) && (isset($_GET['dat2'])) ) {
                        $d1=date("d.m.Y",strtotime($_GET['dat1']));
                        $d2=date("d.m.Y",strtotime($_GET['dat2']));
                        if ($detect->isMobile()) {
                            echo "<h4>".TITLE_JURNAL.TITLE_JURNAL5."<b> c ".$d1."</b> по <b>".$d2."</b></h4>";
                        } else {
                            echo "<h4>".TITLE_JURNAL.TITLE_JURNAL5."<b> c ".$d1."</b> по <b>".$d2."</b>  <a href=".mb_strtoupper($_GET['dat2']).
                                " class='jrn_word' id='gn'><img class='foto-img' src='img/word1.gif' onmouseout=\"this.src='img/word1.gif';\" onmouseover=\"this.src='img/word2.gif';\" alt='MS Word'></a></h4>";
                        }

                    } else {
                        echo "<h4>" . TITLE_JURNAL . TITLE_JURNAL5 . "<b>_________</b></h4>";
                    }
                } else {
                    if (isset($_GET['j'])) {
                        switch ($_GET['j']) {
                            case "all":
                                $s=TITLE_JURNAL3;
                                break;
                            case "today":
                                $s=date("d.m.Y");
                                break;
                            case "yesterday":
                                $s=date("d.m.Y");
                                $s=date("d.m.Y",strtotime("-1 days",strtotime($s)));
                                break;
                            case "gn": $s=$gn;
                        }
                        if ($detect->isMobile()) {
                            echo "<h4>" . TITLE_JURNAL . TITLE_JURNAL2 . "<b>" . $s . "</b></h4>";
                        } else {
                            echo "<h4>" . TITLE_JURNAL . TITLE_JURNAL2 . "<b>" . $s . "</b> <a href='" . $s . "' id=" . $_GET['j'] . " class='jrn_word'><img class='foto-img' src='img/word1.gif' onmouseout=\"this.src='img/word1.gif';\" onmouseover=\"this.src='img/word2.gif';\" alt='MS Word'></a></h4>";
                        }

                    }
                }
                ?>

                <thead>
                <span class="s_records" id="s_records">Количество записей:</span>
                <tr>
                    <th>№</th>
                    <th>Дата и время</th>
                    <th>Модель</th>
                    <th>Гос.номер</th>
                    <th>Адрес задержания</th>
                    <th>Основания</th>
                    <th>Стоянка</th>
                    <th>Протокол</th>

                    <?php if (!($detect->isMobile())) : ?>
                        <th>Фото</th>
                        <th>Шаблон</th>
                    <?php endif; ?>

                </tr>
                </thead>

                <tbody>
                    <?php require "db/table.php" ?>
                </tbody>
            </table>
            <span class="s_records_end" id="s_records_end">Количество записей:</span>
        </div>
    </div>
<!---->
<!--        <script type="text/javascript">-->
<!--            if (window.jQuery) alert("jQuery подключен");-->
<!--            else alert("jQuery не подключен");-->
<!--        </script>-->
<!---->
    <?php require_once "blocks/footer.php" ?>
    <script src="js/wrd_jrn.js"></script>
</body>
</html>

<!--<script>-->
<!--    $(document).ready(function(){-->
<!--        // $('#jrn_to_word').on('click', function(event){-->
<!--        $('body').on('click', '.jrn_word', function(event){-->
<!--            event.preventDefault();-->
<!--            alert('1');-->
<!--            //получение id формы-->
<!--            // var formID=$(this).attr('id');-->
<!--            // var formNm=$('#'+formID);-->
<!--            var val=document.getElementById("$_GET");-->
<!--            alert(val);-->
<!--            alert('2');-->
<!---->
<!--            $.ajax({-->
<!--                type: "POST",-->
<!--                url: "documents/word_jrn.php",-->
<!--                data: val,-->
<!--                processData: false,-->
<!--                contentType: false,-->
<!--                beforeSend:function()-->
<!--                {-->
<!--                    alert('Before');-->
<!--                    // $(form_data).html('<p style="text-align:center"> Отправка на ФТП... </p>');-->
<!--                    $('#cssload-wrapper').css('display', '');-->
<!--                },-->
<!--                success:function(){-->
<!--                    alert('success');-->
<!--                },-->
<!--                complete:function() {-->
<!--                    alert('complete');-->
<!--                    // $(form_data).html('<p style="text-align:center">ЗАВЕРШЕНО</p>');-->
<!--                    $('#cssload-wrapper').css('display', 'none');-->
<!--                    $('#cssload-wrapper')[0].reset();-->
<!--                    $('#jurnal')[0].reset();-->
<!--                },-->
<!--                error: function(jqXHR,text,error){-->
<!--                    alert(error);-->
<!--                }-->
<!--            });-->
<!--            return false;-->
<!--        });-->
<!--    });-->
<!--</script>-->
<!---->
