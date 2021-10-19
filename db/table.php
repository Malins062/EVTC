<?php
require_once ($_SERVER['DOCUMENT_ROOT'].'/libs/Mobile_Detect.php');
$detect = new Mobile_Detect;
( $detect->isMobile() ? $clmns=8 : $clmns=10 );
//include ( $_SERVER['DOCUMENT_ROOT'].'/evtc/blocks/cnst.php');
//var_dump($_GET);
if (
    ( (isset($_GET['j'])) && ($_GET['j']=="gn") && (!isset($_GET['gn'])) ) ||
    ( (isset($_GET['j'])) && ($_GET['j']=="dat") && ( (!isset($_GET['dat1'])) && (!isset($_GET['dat2'])) ) )
   ){
    echo "<td>-</td>";
    echo "<td>-</td>";
    echo "<td>-</td>";
    echo "<td>-</td>";
    echo "<td>-</td>";
    echo "<td>-</td>";
    echo "<td>-</td>";
    echo "<td>-</td>";
    if (!($detect->isMobile())){
        echo "<td>-</td>";
        echo "<td>-</td>";
    }
    echo "</tr>\n";
    echo "<span class='s_records0'>".TITLE_RECORDS."0</span>";

} else {

    set_time_limit(0);
//    $conn = oci_connect(DB_USER, DB_PASS, DB_CONNECT, DB_CHARSET);
    $conn = oci_connect("TC_OUT", "218_219", "10.50.109.15/BASE1161", "AL32UTF8");
    if (!$conn) {
        $m = oci_error();
        trigger_error(htmlentities($m['message'], ENT_QUOTES), E_USER_ERROR);
    } else {
        if ( (isset($_GET['j'])) || (isset($_GET['gn'])) || ( (isset($_GET['dat1'])) && (isset($_GET['dat2'])) ) ) {
            include('ftp_class.php');

            if (isset($_GET['gn'])) {
                $textsql="select to_char(date_z,'dd.mm.yyyy hh24:mi'), car_model, car_number, address, osn, st, protocol from TC_OUT.JURNAL where car_number like '".mb_strtoupper($_GET['gn'])."' order by date_z";
            } elseif ( (isset($_GET['dat1'])) && (isset($_GET['dat2'])) ) {
                $d1=date("d.m.Y",strtotime($_GET['dat1']));
                $d2=date("d.m.Y",strtotime($_GET['dat2']));
                $d2=date("d.m.Y",strtotime("+1 days",strtotime($d2)));
                $textsql="select to_char(date_z,'dd.mm.yyyy hh24:mi'), car_model, car_number, address, osn, st, protocol from TC_OUT.JURNAL where date_z>=to_date('".$d1."','dd.mm.yyyy') and date_z<=to_date('".$d2."','dd.mm.yyyy') order by date_z";
            } else {
                switch($_GET['j']){
                    case "all":
                        $textsql="select to_char(date_z,'dd.mm.yyyy hh24:mi'), car_model, car_number, address, osn, st, protocol from TC_OUT.JURNAL order by date_z";
                        break;
                    case "today":
                        $d1=date("d.m.Y");
                        $d2=date("d.m.Y",strtotime("+1 days",strtotime($d1)));
                        $textsql="select to_char(date_z,'dd.mm.yyyy hh24:mi'), car_model, car_number, address, osn, st, protocol from TC_OUT.JURNAL where date_z>=to_date('".$d1."','dd.mm.yyyy') and date_z<to_date('".$d2."','dd.mm.yyyy') order by date_z";
                        break;
                    case "yesterday":
                        $d1=date("d.m.Y");
                        $d2=date("d.m.Y",strtotime("-1 days",strtotime($d1)));
                        $textsql="select to_char(date_z,'dd.mm.yyyy hh24:mi'), car_model, car_number, address, osn, st, protocol from TC_OUT.JURNAL where date_z>=to_date('".$d2."','dd.mm.yyyy') and date_z<to_date('".$d1."','dd.mm.yyyy') order by date_z";
                        break;
                }
            }
            if ($textsql!="") {
                $res=OCI_Parse($conn,$textsql);
                oci_execute($res);
                $n=1;
                while (($row = oci_fetch_array($res, OCI_ASSOC)) != false) {
                    echo "<tr>\n";
                    echo "<td>".$n."</td>";
                    $n++;
                    $i = 1;
                    if (!($detect->isMobile())) {
                        $dateComp = "";
                        $protocol = "";
                        foreach ($row as $columnName => $columnValue) {
                            $value = $columnValue;
                            switch ($i) {
                                case 1:
                                    $dateComp = date_parse($columnValue);
                                    break;
                                case 7:
                                    $value = SERNUM_PROTOCOL . $columnValue;
                                    $protocol = $columnValue;
                                    break;
                            }
                            echo "<td>" . $value . "</td>";
                            $i++;
                        }
                        if ($dateComp != "") {
                            $dir = strtoupper($dateComp['year'] . '/' . $dateComp['month'] . '/' . $dateComp['day'] . '/' . $protocol);
                        } else {
                            $dir = '';
                        }
                        $dir = FTP_READ . $dir;
                        echo "<td> <a href='$dir' target='_blank'><img class='foto-img' src='img/foto1.png' onmouseout=\"this.src='img/foto1.png';\" onmouseover=\"this.src='img/foto2.png';\" alt='Фото'></a> </td>";
                        echo "<td> <a href='docs/".FNAME_XLS1."' target='_blank'><img class='foto-img' src='img/exel1.gif' onmouseout=\"this.src='img/exel1.gif';\" onmouseover=\"this.src='img/exel2.gif';\" alt='MS Word'></a> </td>";
                    } else {
                        foreach ($row as $columnName => $columnValue) {
                            echo "<td>" . $columnValue . "</td>";
                        }
                    }

                    echo "</tr>\n";

                }
                echo "<span class='s_records0' id='s_records0'>".TITLE_RECORDS.($n-1)."</span>";
                if (!isset($i)) {
                    echo "<td>-</td>";
                    echo "<td>-</td>";
                    echo "<td>-</td>";
                    echo "<td>-</td>";
                    echo "<td>-</td>";
                    echo "<td>-</td>";
                    echo "<td>-</td>";
                    echo "<td>-</td>";
                    if (!($detect->isMobile())) {
                        echo "<td>-</td>";
                        echo "<td>-</td>";
                    }
                    echo "</tr>\n";
                    echo "<span class='s_records0'>".TITLE_RECORDS."0</span>";
                }

                oci_free_statement($res);
            }
        }
        oci_close($conn);
    }

}

?>
