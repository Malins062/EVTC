<!doctype html>
<html lang="ru" xmlns="http://www.w3.org/1999/html">
<?php include ('blocks/head.php'); ?>
<body>
    <?php include('header.php'); ?>

    <form class="form" name="f_input2" id="f_input2" method="post" action="" enctype="multipart/form-data">
        <h1 class="form_title">Данные задерживаемого ТС</h1>

        <div class="form_group">
            <label class="form_label">Дата:</label>
            <input class="form_input" id="i2_date" type="date" required name="i2_date"  placeholder="Дата" value="<?php echo date("Y-m-d");?>">
        </div>

        <div class="form_group">
            <div><label class="form_label">Время:</label></div>
            <input class="form_input" id="i2_time" type="time" step="60" required name="i2_time" value="<?php echo date("H:i"); ?>" placeholder="Время">
        </div>

        <div class="form_group">
            <label class="form_label">Модель ТС:</label>
            <input class="form_input" type="text" required name="i2_model" placeholder="ВВЕДИТЕ МОДЕЛЬ ТС" maxlength="25" title="Не более 25 символов">
        </div>

        <div class="form_group">
            <label class="form_label">Номер ТС:</label>
            <input class="form_input" type="text" required name="i2_nomer" placeholder="ВВЕДИТЕ ГОС.РЕГ. ЗНАК ТС" maxlength="9" title="Государственный регистрационный знак, задерживаемого транспротного средства">
        </div>

        <div class="form_group">
            <label class="form_label">Адрес задержания ТС: <b><u><?php echo CITY; ?></b></u> </label>
            <input class="form_input" type="text" required name="i2_address" placeholder="ВВЕДИТЕ АДРЕС ЗАДЕРЖАНИЯ ТС" maxlength="50" title="Не более 100 символов">
        </div>

        <div class="form_group">
            <label class="form_label">Основания задержания:</label>
            <select required name="i2_osn" class="form_input">
                <option value="ОСТАНОВКА ТС В ЗОНЕ ДЕЙСТВИЯ ЗНАКА 3.27 (П.П.1.3) СТ.12.16 Ч.4">ОСТАНОВКА ТС В ЗОНЕ ДЕЙСТВИЯ ЗНАКА 3.27 (П.П.1.3)</option>
                <option value="ОСТАНОВКА НА ПЕШЕХОДНОМ ПЕРЕХОДЕ ИЛИ БЛИЖЕ 5М ПЕРЕД НИМ (П.П.12.4) СТ.12.9 Ч.3">ОСТАНОВКА ТС НА ПЕШЕХОДНОМ ПЕРЕХОДЕ ИЛИ БЛИЖЕ 5М ПЕРЕД НИМ (П.П.12.4)</option>
                <option value="ОСТАНОВКА ТС НА ТРОТУАРЕ ПРИ ОТСУТСТВИИ ЗНАКА 6.4 (П.П.12.2) СТ.12.9 Ч.3">ОСТАНОВКА ТС НА ТРОТУАРЕ ПРИ ОТСУТСТВИИ ЗНАКА 6.4 (П.П.12.2)</option>
                <option value="СТОЯНКА ТС БЕЗ ТАБЛИЧКИ 'ИНВАЛИД', В ЗОНЕ ДЕЙСТВИЯ ЗНАКА 3.28 СТ.12.16 Ч.4">СТОЯНКА ТС БЕЗ ТАБЛИЧКИ "ИНВАЛИД", В ЗОНЕ ДЕЙСТВИЯ ЗНАКА 3.28</option>
                <option value="СТОЯНКА ТС БЕЗ ТАБЛИЧКИ 'ИНВАЛИД', В ЗОНЕ ДЕЙСТВИЯ ЗНАКА 3.29 СТ.12.16 Ч.4">СТОЯНКА ТС БЕЗ ТАБЛИЧКИ "ИНВАЛИД", В ЗОНЕ ДЕЙСТВИЯ ЗНАКА 3.29 (НЕЧЕТНЫЕ ЧИСЛА)</option>
                <option value="СТОЯНКА ТС БЕЗ ТАБЛИЧКИ 'ИНВАЛИД', В ЗОНЕ ДЕЙСТВИЯ ЗНАКА 3.30 СТ.12.16 Ч.4">СТОЯНКА ТС БЕЗ ТАБЛИЧКИ "ИНВАЛИД", В ЗОНЕ ДЕЙСТВИЯ ЗНАКА 3.30 (ЧЕТНЫЕ ЧИСЛА)</option>
                <option value="СТОЯНКА ТС БЕЗ ТАБЛИЧКИ 'ИНВАЛИД', В ЗОНЕ ДЕЙСТВИЯ ЗНАКА 6.4 (П.П.1.3) СТ.12.19 Ч.2">СТОЯНКА ТС БЕЗ ТАБЛИЧКИ "ИНВАЛИД", В ЗОНЕ ДЕЙСТВИЯ ЗНАКА 6.4 (П.П.1.3)</option>
                <option value="ОСТАНОВКА/СТОЯНКА ТС ДАЛЕЕ 1-ГО РЯДА КРАЯ ПРОЕЗЖЕЙ ЧАСТИ (П.П.12.2) СТ.12.19 Ч.2">ОСТАНОВКА/СТОЯНКА ТС ДАЛЕЕ 1-ГО РЯДА КРАЯ ПРОЕЗЖЕЙ ЧАСТИ (П.П.12.2)</option>
                <option value="ОСТАНОВКА/СТОЯНКА ТС, КОТОРОЕ ПОВЛЕКЛО СОЗДАНИЕ ПОМЕХ ДЛЯ ДРУГИХ ТС (П.П.12.4) СТ.12.19 Ч.3.2">ОСТАНОВКА/СТОЯНКА ТС, КОТОРОЕ ПОВЛЕКЛО СОЗДАНИЕ ПОМЕХ ДЛЯ ДРУГИХ ТС (П.П.12.4)</option>
                <option value="ОСТАНОВКА ТС, БЛИЖЕ 15М ОТ ООТ ЛИБО В МЕСТЕ ООТ (П.П.12.4) СТ.12.19 Ч.4">ОСТАНОВКА ТС, БЛИЖЕ 15М ОТ ООТ ЛИБО В МЕСТЕ ООТ (П.П.12.4)</option>
            </select>
        </div>

        <div class="form_group">
            <label class="form_label">Номер протокола: <b><u><?php echo SERNUM_PROTOCOL; ?></b></u> </label>
            <input class="form_input" type="text" pattern="[0-9]{6}" required name="i2_protocol" placeholder="ВВЕДИТЕ НОМЕР ПРОТОКОЛА ЗАДЕРЖАНИЯ" maxlength="6" minlength="6" title="6 цифр">
        </div>

        <div class="form_group">
            <label class="form_label">Стоянка:</label>
            <select required name="i2_st" class="form_input">
                <option value="СОЛНЕЧНАЯ">СОЛНЕЧНАЯ</option>
                <option value="КАШИРИНА">КАШИРИНА</option>
                <option value="СЕМИНАРСКАЯ">СЕМИНАРСКАЯ</option>
            </select>
        </div>

        <div class="form_group">
            <label class="form_label">Фото протокола (не более 3 Мб):</label>
            <input class="form_input" type="file" id="file1" required name="i2_protocol_scan" accept="image/jpeg" placeholder="Фото протокола (размер не более 3 Мб)" title="ФОТО протокола задержания ТС (размер не более 3 Мб)">
        </div>

        <div class="form_group">
            <label class="form_label">Фото ТС (не более 3 Мб):</label>
            <input class="form_input" type="file" id="file2" required name="i2_tc_scan" accept="image/jpeg" placeholder="Фото ТС (размер не более 3 Мб)" title="ФОТО места нарушения транспортным средством (размер не более 3 Мб)">
        </div>

        <div class="form_group_btn">
            <button class="form_button" type="submit" name="insert_2" id="insert_2">Внести данные в журнал</button>
<!--            <button class="form_button" type="reset" name="insert_2" id="insert_2">Очистить</button>-->
        </div>

    </form>

<!--    <script type="text/javascript">-->
<!--        if (window.jQuery) alert("jQuery подключен");-->
<!--        else alert("jQuery не подключен");-->
<!--    </script>-->
<!---->
    <?php include "blocks/footer.php" ?>

    <script src="js/input2.js"></script>

</body>
</html>

