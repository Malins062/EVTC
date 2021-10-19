<?php
require($_SERVER['DOCUMENT_ROOT'].'/blocks/cnst.php');

if (isset($_POST['j'])) {
    set_time_limit(0);
    $conn = oci_connect("TC_OUT", "218_219", "10.50.109.15/BASE1161", "AL32UTF8");
    if (!$conn) {
        $m = oci_error();
        trigger_error(htmlentities($m['message'], ENT_QUOTES), E_USER_ERROR);
    } else {
        $title='Журнал';
        switch($_POST['j']){
            case "all":
                $textsql="select to_char(date_z,'dd.mm.yyyy hh24:mi'), car_model, car_number, address, osn, st, protocol from TC_OUT.JURNAL order by date_z";
                $title=TITLE_JURNAL.TITLE_JURNAL2.TITLE_JURNAL3;
                break;
            case "today":
                $d1=date("d.m.Y");
                $d2=date("d.m.Y",strtotime("+1 days",strtotime($d1)));
                $textsql="select to_char(date_z,'dd.mm.yyyy hh24:mi'), car_model, car_number, address, osn, st, protocol from TC_OUT.JURNAL where date_z>=to_date('".$d1."','dd.mm.yyyy') and date_z<to_date('".$d2."','dd.mm.yyyy') order by date_z";
                $title=TITLE_JURNAL.TITLE_JURNAL2.$d1;
                break;
            case "yesterday":
                $d1=date("d.m.Y");
                $d2=date("d.m.Y",strtotime("-1 days",strtotime($d1)));
                $textsql="select to_char(date_z,'dd.mm.yyyy hh24:mi'), car_model, car_number, address, osn, st, protocol from TC_OUT.JURNAL where date_z>=to_date('".$d2."','dd.mm.yyyy') and date_z<to_date('".$d1."','dd.mm.yyyy') order by date_z";
                $title=TITLE_JURNAL.TITLE_JURNAL2.$d2;
                break;
            case "gn":
                $textsql="select to_char(date_z,'dd.mm.yyyy hh24:mi'), car_model, car_number, address, osn, st, protocol from TC_OUT.JURNAL where car_number like '".mb_strtoupper($_POST['value'])."' order by date_z";
                $title=TITLE_JURNAL.TITLE_JURNAL4.mb_strtoupper($_POST['value']);
                break;
        }
        if ($textsql!="") {
            $res = OCI_Parse($conn, $textsql);
            oci_execute($res);
            $numRows=oci_fetch_all($res,$row);
            if ($numRows>0) {
                require $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';
                $template_document = new \PhpOffice\PhpWord\TemplateProcessor($_SERVER['DOCUMENT_ROOT'] . '/docs/template_jurnal.docx');
                $template_document = new \PhpOffice\PhpWord\TemplateProcessor($_SERVER['DOCUMENT_ROOT'] . '/docs/' . FNAME_JRN_DOT);
                $template_document->setValue('j_title', $title);
//                $template_document->Footer->setValue('j_ktitle', $title);

//                $template_document->cloneBlock('CLONE',$numRows);
                $template_document->cloneRow('j_1', $numRows);
//                $template_document->cloneRowAndSetValues('j_1',$row);

                for ($n=1; $n<($numRows+1); $n++) {

                    $template_document->setValue('j_1'.'#'.$n, $n);
                    $value = "";
                    $i = 2;
                    foreach ($row as $columnName => $columnValue) {
                        switch ($i) {
                            case 5:
                                $template_document->setValue('j_'.$i.'#'.$n, CITY.$columnValue[$n-1]);
                                break;
                            case 8:
                                $template_document->setValue('j_'.$i.'#'.$n, SERNUM_PROTOCOL.$columnValue[$n-1]);
                                break;
                            default:
                                $template_document->setValue('j_'.$i.'#'.$n, $columnValue[$n-1]);
                        }
                        $i++;
                    }
                }

//        $temp_file=tempnam(sys_get_temp_dir(),'PHPWord');
                $temp_file = $_SERVER['DOCUMENT_ROOT'] . '/docs/' . FNAME_JRN;
                $template_document->saveAs($temp_file);
//                sleep(10);
                echo $temp_file;
            } else {
                echo "NOT";
            }
        }
        oci_free_statement($res);
        oci_close($conn);
    }
}