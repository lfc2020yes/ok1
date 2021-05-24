<?php
session_start();

//бухлатерия
$url_system=$_SERVER['DOCUMENT_ROOT'].'/'; include_once $url_system.'module/config.php'; include_once $url_system.'module/function.php'; include_once $url_system.'login/function_users.php'; initiate($link); include_once $url_system.'module/access.php';


//правам к просмотру к действиям
$hie = new hierarchy($link,$id_user);
//echo($id_user);
$hie_object=array();
$hie_town=array();
$hie_kvartal=array();
$hie_user=array();
$hie_object=$hie->obj;
$hie_kvartal=$hie->id_kvartal;
$hie_town=$hie->id_town;
$hie_user=$hie->user;



$sign_level=$hie->sign_level;
$sign_admin=$hie->admin;


$role->GetColumns();
$role->GetRows();
$role->GetPermission();
//правам к просмотру к действиям



$active_menu='accounting';  // в каком меню


$count_write=150;

$edit_price=0;
if ($role->is_column_edit('n_material','price'))
{
    $edit_price=1;
}


$echo_r=1; //выводить или нет ошибку 0 -нет
$error_header=0;
$url_404=$_SERVER['REQUEST_URI'];
//echo($url_404);
$D_404 = explode('/', $url_404);

//index.php не должно быть в $url_404
if (strripos($url_404, 'index.php') !== false) {
    header404(1,$echo_r);
}


if((!$role->permission('Бухгалтерия','R'))and($sign_admin!=1))
{
    header404(3,$echo_r);
}

if(isset($_GET["id"])) {
//если есть id то смотрим может ли он смотеть этот тур
    $result_t = mysql_time_query($link, 'select A.id from trips as A where A.id="' . ht($_GET['id']) . '" and A.visible=1');
    $num_results_t = $result_t->num_rows;
    if ($num_results_t == 0) {
        header404(322, $echo_r);
    }
}



if($error_header==404)
{
    include $url_system.'module/error404.php';
    die();
}


function download_send_headers($filename) {
    // disable caching
    $now = gmdate("D, d M Y H:i:s");
// disable caching
$now = gmdate("D, d M Y H:i:s");
header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
header("Last-Modified: {$now} GMT");

// force download
header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");

// disposition / encoding on response body
header("Content-Disposition: attachment;filename=data_export.csv");
header("Content-Transfer-Encoding: binary");
}

function array2csv(array &$array, $titles) {
    if (count($array) == 0) {
        return null;
    }
    ob_start();
    $df = fopen("php://output", 'w');
    fputcsv($df, $titles, ';');
    foreach ($array as $row) {
        fputcsv($df, $row, ';');
    }
    fclose($df);
    return ob_get_clean();
}








$zindex=110;

$os2 = array( "Текущий месяц","Прошлый месяц","За ".month_rus1(date_step_sql('m', '-2m')),"За ".month_rus1(date_step_sql('m', '-3m')),"Текущий год","Выбрать период");
$os_id2 = array("0","1","3","4","5","2");

/*
$os2 = array( "За все время","Сегодня","За 7 дней","В этом месяце","за 30 дней","Выбрать период");
	   $os_id2 = array("0","6","1","5","3","2");
*/
$su_2=0;
$date_su='';
if (( isset($_COOKIE["su_2bc".$id_user]))and(is_numeric($_COOKIE["su_2bc".$id_user]))and(array_search($_COOKIE["su_2bc".$id_user],$os_id2)!==false))
{
    $su_2=$_COOKIE["su_2bc".$id_user];
}
$val_su2=$os2[array_search($su_2, $os_id2)];


if ( isset($_COOKIE["suddbc".$id_user]))
{
    //$date_base__=explode(".",$_COOKIE["sudds"]);
    if (( isset($_COOKIE["su_2bc".$id_user]))and(is_numeric($_COOKIE["su_2bc".$id_user]))and($_COOKIE["su_2bc".$id_user]==2))
    {
        $date_su=$_COOKIE["suddbc_mor".$id_user];
        $val_su2=$_COOKIE["suddbc_mor".$id_user];
    }
}
$class_js_readonly ??= '';
$class_js_search ??= '';

$_COOKIE["su_2bc".$id_user] ??= '';
$_COOKIE["su_1cc".$id_user] ??= '';
//$_COOKIE["su_3pr".$id_user] ??= '';
$_COOKIE["su_4cc".$id_user] ??= '';
$_COOKIE["su_5bc".$id_user] ??= '';


$class_js_search='';
$class_js_readonly='';



$zindex--;



$os5 = array( "Мной");
$os_id5 = array("0");


//выводим и всех подчинненных, следовательно для простых менеджеров подчиненных нет
$mass_ei=users_hierarchy($id_user,$link);
rm_from_array($id_user,$mass_ei);
$mass_ei= array_unique($mass_ei);


foreach ($mass_ei as $keys => $value)
{
    $result_work_zz=mysql_time_query($link,'Select a.name_small,a.id from r_user as a where a.id="'.$value.'" and a.enabled=1');
    $num_results_work_zz = $result_work_zz->num_rows;
    if($num_results_work_zz!=0)
    {

        for ($i=0; $i<$num_results_work_zz; $i++)
        {
            $row_work_zz = mysqli_fetch_assoc($result_work_zz);
            array_push($os5, $row_work_zz["name_small"]);
            array_push($os_id5, $row_work_zz["id"]);
        }
    }

}


if(($sign_level==2)or($sign_level==3)or($sign_level==4))
{
    array_push($os5, 'Всеми подчиненными менеджерами');
    array_push($os_id5, 'all_subor');
}

$su_5=0;
if (( isset($_COOKIE["su_5bc".$id_user]))and(array_search($_COOKIE["su_5bc".$id_user],$os_id5)!==false))
{
    $su_5=$_COOKIE["su_5bc".$id_user];
}


$zindex--;





                    if((isset($_COOKIE["su_2bc".$id_user]))and(is_numeric($_COOKIE["su_2bc".$id_user]))and($_COOKIE["su_2bc".$id_user]==2))
                    {
                        $date_range=explode("/",$_COOKIE["suddbc".$id_user]);


                    }




//расширенный поиск

    $sql_su1 = '';
    $sql_su2 = '';
    $sql_su3 = '';
    $sql_su4 = '';
    $sql_su5 = '';
    $sql_su5_search = '';
    $sql_su7 = ' AND A.id_a_company="' . $id_company . '" ';

    //********************************************************************
//********************************************************************
//********************************************************************
    //тур оформлен
    //|
    //V
    $flag_vstt=0;
    if((string)$su_5=='0')
    {

        $query_user = $id_user;



    } else
    {

        $mass_ei=users_hierarchy($id_user,$link);
        rm_from_array($id_user,$mass_ei);
        $mass_ei= array_unique($mass_ei);

        if(((string)$su_5!='0')and(is_numeric($su_5)))
        {
            if (in_array($su_5, $mass_ei)) {
                $query_user=$su_5;
            }

        }

        if($su_5=='all_subor')
        {
            $flag_vstt=1;
        }

    }


    //выставленные
    if($flag_vstt==0)
    {
        $sql_su5=' AND ((A.id_user="'.$query_user.'"))';
    } else
    {
        if(count($mass_ei)!=0)
        {
            $io=0;
            $sql_su5=' AND (';

            foreach ($mass_ei as $key => $value)
            {
                if($io==0) {

                    $sql_su5.='((A.id_user="'.$value.'"))';

                } else
                {
                    $sql_su5.='or((A.id_user="'.$value.'"))';
                }
                $io++;

            }
            $sql_su5.=' )';
        }
    }


//Для поиска по id и номеру договора ищем по всем возможным для работника подчиненным

    if(count($mass_ei)!=0)
    {
        $io=0;
        $sql_su5_search=' AND (';

        foreach ($mass_ei as $key => $value)
        {
            if($io==0) {

                $sql_su5_search.='((A.id_user="'.$value.'"))';

            } else
            {
                $sql_su5_search.='or((A.id_user="'.$value.'"))';
            }
            $io++;

        }
        if($io!=0)
        {
            $sql_su5_search.='or((A.id_user="'.$id_user.'"))';
        } else
        {
            $sql_su5_search.='((A.id_user="'.$id_user.'"))';
        }

        $sql_su5_search.=' )';
    }



    //X
    //|
    //тур оформлен

//********************************************************************
//********************************************************************
//********************************************************************

    $sql_order = ' order by B.date_doc desc';




    $sql_order = '';
    $sql_columb='';

    $sql_table='';
    $sql_table1='';   //trips_payment_term - сроки
    $sql_table2='';   //trips_fly_history  - история вылетов
    $sql_table3='';

    $sql_svyz_table='';
    $sql_svyz_table1=''; //trips_payment_term - сроки
    $sql_svyz_table2=''; //trips_fly_history  - история вылетов


    ///поиск для расширенных фильтров



//********************************************************************
//********************************************************************
//********************************************************************
    /*
    $os2 = array( "За все время","Сегодня","За 7 дней","В этом месяце","за 30 дней","Выбрать период");
    $os_id2 = array("0","6","1","5","3","2");
    */
    //по умолчанию текущий месяц

    $date_start=date("Y-m").'-01';
    $date_end=date_step_sql('Y-m','+1m').'-01';


    //дата оформления
    //|
    //V

    if ($su_2 == 1) {
        //прошлый месяц
        $date_end=date("Y-m").'-01';
        $date_start=date_step_sql('Y-m','-1m').'-01';

    }
    if ($su_2 == 3) {
        //-1 месяц
        $date_end=date_step_sql('Y-m','-1m').'-01';
        $date_start=date_step_sql('Y-m','-2m').'-01';
    }
    if ($su_2 == 4) {
        //-2 месяц
        $date_end=date_step_sql('Y-m','-2m').'-01';
        $date_start=date_step_sql('Y-m','-3m').'-01';
    }
    if ($su_2 == 5) {
        //текущий год
        $date_end=date_step_sql('Y-m-d','+1d');
        $date_start=date('Y').'-01-01';
    }
    $sql_su2 = ' and B.date_doc>="' . $date_start . '" and  B.date_doc<"' . $date_end . '"';

    if ($su_2 == 2) {
        //Выбранные период пользователем
        $date_range = explode("/", $_COOKIE["suddbc" . $id_user]);
        $sql_su2 = ' and B.date_doc>="' . ht($date_range[0]) . '" and B.date_doc<="' . ht($date_range[1]) . '"';
    }
    //X
    //|
    //дата оформления

//********************************************************************
//********************************************************************
//********************************************************************


//********************************************************************
//********************************************************************
//********************************************************************


//********************************************************************
//********************************************************************
//********************************************************************


    $sql_su3='';
    $sql_table2=',trips_contract as B';
    $sql_svyz_table2=' AND B.id=A.id_contract ';


    $sql_columb.=',B.*';

    //$sql_su4 = ' and (SELECT yy.start_fly FROM trips_fly_history AS yy WHERE yy.id_trips=A.id ORDER BY yy.datetime DESC LIMIT 0,1)>="'.date("Y-m-d").' 00:00:00" ';
    //$sql_order = ' order by xx.datetimes DESC';


    $sql_order = ' order by A.datecreate DESC';



    $sql_table=$sql_table1.$sql_table2.$sql_table3;
    $sql_svyz_table=$sql_svyz_table1.$sql_svyz_table2;

    $sql_k = 'Select A.*
  
  from trips as A'.$sql_table.'
  
  where A.visible=1 '.$sql_svyz_table.' ' . $sql_su2 . ' ' . $sql_su1 . ' ' . $sql_su3 . ' ' . $sql_su4 . ' ' . $sql_su5 . ' ' . $sql_su7 . ' ' . $sql_order . ' ' . limitPage('n_st', $count_write);

//echo($sql_k);

    $sql_count = 'Select 
  
  count(DISTINCT A.id) as kol'.$sql_columb.'
  
  from trips as A'.$sql_table.'
  
  where A.visible=1 '.$sql_svyz_table.' ' . $sql_su2 . ' ' . $sql_su1 . ' ' . $sql_su3 . ' ' . $sql_su4 . ' ' . $sql_su5 . ' ' . $sql_su7;


    //echo($sql_count);



    $result_t2 = mysql_time_query($link, $sql_k);









$result_t221=mysql_time_query($link,$sql_count);
$row__221= mysqli_fetch_assoc($result_t221);



$num_results_t2 = $result_t2->num_rows;
if($num_results_t2!=0)
{

    $com=0;
    $cost=0;
    $count_y=0;
    $new_class_block='';

    $date_paid='';
    $data = array();
    for ($ksss=0; $ksss<$num_results_t2; $ksss++) {

        $row_88 = mysqli_fetch_assoc($result_t2);
        $data1 = array();
        include $url_system . 'accounting/code/block_doc1.php';
        //echo($task_cloud_block);
        //$data1 = array();

        array_push($data, $data1);



    }






}







$titles = array("id", "Название тура","Даты отдыха","Кол-во человек","Клиент","Туроператор","№ заявки","Договор","Оплачено туристом","Оплачено ТО","Менеджер","Комментарий");
function utf8to1251(&$text) {
    $text = iconv("utf-8", "windows-1251", $text); //without return
}
array_walk_recursive($titles, "utf8to1251");
array_walk_recursive($data, "utf8to1251");


download_send_headers("data_export.csv");
echo array2csv($data, $titles);
die();
?>