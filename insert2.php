<?php
include('blocks/cnst.php');

if ( isset($_POST['i2_date']) && isset($_POST['i2_time']) && isset($_POST['i2_model']) && isset($_POST['i2_osn']) &&
    isset($_POST['i2_nomer']) && isset($_POST['i2_address']) && isset($_POST['i2_protocol']) &&
    isset($_POST['i2_st']) ) {
    $i2["date"]=$_POST['i2_date'].' '.$_POST['i2_time'];
    $i2["model"]=mb_strtoupper($_POST['i2_model']);
    $i2["nomer"]=mb_strtoupper(trim($_POST['i2_nomer']));
    $i2["address"]=CITY.mb_strtoupper($_POST['i2_address']);
    $i2["osn"]=mb_strtoupper($_POST['i2_osn']);
    $i2["protocol"]=$_POST['i2_protocol'];
    $i2["st"]=$_POST['i2_st'];
    $i2["ip"]=$_SERVER['REMOTE_ADDR'];
    //    var_dump($_POST);
//    var_dump($_FILES);
//    var_dump($i2);
//    exit();
// ----------------------------------- ЗАГРУЗКА В БД -------------------------------------------
    set_time_limit(0);
//    $conn = oci_connect(DB_USER, DB_PASS, DB_CONNECT, DB_CHARSET);

    $conn = oci_connect("TC_OUT", "218_219", "10.50.109.15/BASE1161", "AL32UTF8");
    if (!$conn) {
        $m = oci_error();
        trigger_error(htmlentities($m['message'], ENT_QUOTES), E_USER_ERROR);
        exit;
    }

    $s = oci_Parse($conn, "insert into jurnal values (to_date(:bind1,'yyyy-mm-dd hh24:mi:ss'), :bind2, :bind3, :bind4, :bind5, :bind6, :bind7, to_date(:bind8,'yyyy-mm-dd hh24:mi:ss'), :bind9)");

    if($s != false){
        // parsing empty query != false
        $i2["date_in"]=date("Y-m-d H:i:s");
        OCIBindByName($s, ":bind1", $i2["date"]);
        OCIBindByName($s, ":bind2", $i2["model"]);
        OCIBindByName($s, ":bind3", $i2["nomer"]);
        OCIBindByName($s, ":bind4", $i2["address"]);
        OCIBindByName($s, ":bind5", $i2["osn"]);
        OCIBindByName($s, ":bind6", $i2["st"]);
        OCIBindByName($s, ":bind7", $i2["protocol"]);
        OCIBindByName($s, ":bind8", $i2["date_in"]);
        OCIBindByName($s, ":bind9", $i2["ip"]);
//        OCIBindByName($s, ":bind8", $i2["time"]);
//    OCIBindByName($s, ":bind9", $_FILES['i2_protocol_scan']);
//    OCIBindByName($s, ":bind10", $_FILES['i2_tc_scan']);


        if(oci_execute($s, OCI_DEFAULT)){
//            echo "<script>alert(\"Данные успешно внесены в журнал!\");</script>";
//            echo "Данные успешно внесены в журнал!";
//            echo "<script>alert(\"Данные успешно внесены в журнал!\");</script>";
//            var_dump($_POST." YES");

        }
        else{
            $e = oci_error($s);
            echo $s.' | '. $e['message'];
//            echo "<script>alert(\"Ошибка 1!\");</script>";
        }
    }
    else{
        $e = oci_error($conn);
        echo $s.' | '. $e['message'];
//        echo "<script>alert(\"Ошибка 2!\");</script>";
    }

    oci_commit($conn);
    oci_close($conn);
//    var_dump($_POST);

// ----------------------------------- ЗАГРУЗКА НА ФТП ------------------------------
    if ($_FILES['i2_protocol_scan']['name']!="" || $_FILES['i2_tc_scan']['name']!="") {
        include('db/ftp_class.php');

        set_time_limit(300);

        $i2["file1"]=$_FILES['i2_protocol_scan']['name'];
        $i2["file2"]=$_FILES['i2_tc_scan']['name'];

        // *** Create the FTP object
        $ftpObj = new FTPClient();

        // *** Connect
        if ($ftpObj->connect(FTP_HOST, FTP_USER, FTP_PASS)) {

//            print_r($ftpObj->getMessages());

            $dateComp = date_parse($i2["date"]);
            $dir = strtoupper($dateComp['year'] . '/' . $dateComp['month'] . '/' . $dateComp['day'] . '/' . $i2["protocol"]);
//var_dump($i2);
//        echo "\n".$dir. "\n";
//          iconv(mb_detect_encoding($i2["file2"],mb_detect_order(),true),'windows-1251',$i2["file2"]);
//        echo "\n".$dir. "\n";

            // *** Make directory
            $ftpObj->makeSubDirs("", $dir);
//            print_r($ftpObj->getMessages());

            if ($_FILES['i2_protocol_scan']['name']!=""){

                $fileFrom = $_FILES['i2_protocol_scan']['tmp_name'];
//        $fileTo = $dir . '/' . $i2["file1"];
                $fileTo = $i2["file1"];
                $ftpObj->uploadFile($fileFrom, $fileTo);

                sleep(2);
//            print_r($ftpObj->getMessages());

            }

            if ($_FILES['i2_tc_scan']['name']!=""){
                $fileFrom = $_FILES['i2_tc_scan']['tmp_name'];
                $fileTo = $i2["file2"];

                $ftpObj->uploadFile($fileFrom, $fileTo);

//            print_r($ftpObj->getMessages());
            }
//            echo "Данные успешно загружены в архив!";
//            echo "<script>alert(\"Данные успешно загружены в архив!\");</script>";
        }
    }
} else {
//    echo "<script>alert(\"Не хватает данных!\");</script>";
}

//header('Location: input2.php');
//exit();
?>