<?php
$c=OCILogon("scott", "tiger", "orcl");
if ( ! $c ) {
    echo "Невозможно подключится к базе: " . var_dump( OCIError() );
    die();
}

// Удаляем старую табоицу
$s = OCIParse($c, "drop table tab1");
OCIExecute($s, OCI_DEFAULT);

// Создаем новую таблицу
$s = OCIParse($c, "create table tab1 (col1 number, col2 varchar2(30))");
OCIExecute($s, OCI_DEFAULT);

// Заносим строку в только что созданную таблицу
$s = OCIParse($c, "insert into tab1 values (1, 'Frank')");
OCIExecute($s, OCI_DEFAULT);

// Заносим данные в таблицу используя конструкцию "bind"
$var1 = 2;
$var2 = "Scott";
$s = OCIParse($c, "insert into tab1 values (:bind1, :bind2)");
OCIBindByName($s, ":bind1", $var1);
OCIBindByName($s, ":bind2", $var2);
OCIExecute($s, OCI_DEFAULT);

// Производим выборку из базы данных
$s = OCIParse($c, "select * from tab1");
OCIExecute($s, OCI_DEFAULT);
while (OCIFetch($s)) {
    echo "COL1=" . ociresult($s, "COL1") .
        ", COL2=" . ociresult($s, "COL2") . "\n";
}

// Выполняем commit;
OCICommit($c);

// Отключаемся от базы данных
OCILogoff($c);
?> 