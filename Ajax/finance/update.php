<?php
//получать обновленные данные по финансам
$url_system=$_SERVER['DOCUMENT_ROOT'].'/';
include_once $url_system.'module/ajax_access.php';
header("Content-type: application/json");

$status_ee='error';
$eshe=0;
$echo='';
$vid=0;
$debug='';
$count_all_all=0;
$basket='';
$token=htmlspecialchars($_GET['tk']);
$disco=0;
$id=htmlspecialchars($_GET['id']);
$query_string='';
$dom=0;
$status_echo='';

//проверка что есть такой город что это число
//проверка что пользователь зарегистрирован

$echo_r=0; //выводить или нет ошибку 0 -нет
$debug='';

//**************************************************
	//echo($_SESSION['s_form_two']);
/*
if(!token_access_new($token,'bt_client_info',$id,"s_form"))
{
   $debug=h4a(100,$echo_r,$debug);
   goto end_code;
}
*/
//**************************************************
if ((!$role->permission('Финансы','U'))and($sign_admin!=1))
{
	$debug=h4a(12,$echo_r,$debug);
    goto end_code;	
}
//**************************************************
 if(!isset($_SESSION["user_id"]))
{ 
  $status_ee='reg';	
  $debug=h4a(3,$echo_r,$debug);
  goto end_code;
}
//**************************************************


if((!isset($_SESSION["user_id"]))or(!is_numeric(id_key_crypt_encrypt($_SESSION["user_id"]))))
{	
	goto end_code;
}

$id_user=id_key_crypt_encrypt($_SESSION["user_id"]);

//проверить есть ли переменная id и можно ли этому пользователю это делать
if ((count($_GET) != 2))
{
	goto end_code;	
}

//Доходы и Расходы
//График продаж
//Структура доходов
//Структура расходов


//если что то надо получить то 1 иначе 0

//**************************************************
//**************************************************
//**************************************************
//**************************************************

$status_ee='ok';


$c_op=explode(',',ht($_GET['arr']));

$xy=array();
$raz_array=array();
$doxod_array=array();
//по умолчанию текущий месяц
$date_start=date("Y-m-").'01';
$date_end=date_step_sql('Y-m-', '+1m').'01';
$more_mon=0;
$os2 = array( "Текущий месяц","Прошлый месяц","За ".month_rus1(date_step_sql('m', '-2m')),"За ".month_rus1(date_step_sql('m', '-3m')),"Выбрать период");
$os_id2 = array("0","1","3","4","2");

if (( isset($_COOKIE["su_2f".$id_user]))and(is_numeric($_COOKIE["su_2f".$id_user]))and(array_search($_COOKIE["su_2f".$id_user],$os_id2)!==false)and($_COOKIE["su_2f".$id_user]==1))
{
    //находим прошлый месяц
    $date_start=date_step_sql('Y-m-', '-1m').'01';
    $date_end=date("Y-m-").'01';
}

if (( isset($_COOKIE["su_2f".$id_user]))and(is_numeric($_COOKIE["su_2f".$id_user]))and(array_search($_COOKIE["su_2f".$id_user],$os_id2)!==false)and($_COOKIE["su_2f".$id_user]==3))
{
    //находим -2 месяца назад
    $date_start=date_step_sql('Y-m-', '-2m').'01';
    $date_end=date_step_sql('Y-m-', '-1m').'01';


}
if (( isset($_COOKIE["su_2f".$id_user]))and(is_numeric($_COOKIE["su_2f".$id_user]))and(array_search($_COOKIE["su_2f".$id_user],$os_id2)!==false)and($_COOKIE["su_2f".$id_user]==4))
{
    //находим -3 месяца назад
    $date_start=date_step_sql('Y-m-', '-3m').'01';
    $date_end=date_step_sql('Y-m-', '-2m').'01';
}



if (( isset($_COOKIE["su_2f".$id_user]))and(is_numeric($_COOKIE["su_2f".$id_user]))and(array_search($_COOKIE["su_2f".$id_user],$os_id2)!==false)and($_COOKIE["su_2f".$id_user]==2))
{

    $month_rus1='с '.$_COOKIE["sudds_mor".$id_user];

    $date_range=explode("/",$_COOKIE["suddf".$id_user]);
    $date_start=ht(trim($date_range[0]));
    $date_st = explode("-", ht($date_start));
    $date_start=$date_st[0].'-'.$date_st[1].'-01';
    //echo($date_start.' / ');
    $date_end=ht(trim($date_range[1]));

    $date_en = explode("-", ht($date_end));
    $date_end=date_step_sql_more($date_en[0].'-'.$date_en[1].'-01','+1m');
    //echo($date_end);
    $more_mon=1;
}

//рассчитаем доходы и расходы за выбранный период


//расходы
$rasx=0;
$result_uu = mysql_time_query($link, 'select sum(A.sum) as ss  from finance_operation as A where A.income=0 and A.visible=1 and A.id_a_company IN ('.ht($id_company).') and  A.date>="' . ht($date_start) . '" and  A.date<="' . ht($date_end) . '"');
$num_results_uu = $result_uu->num_rows;

if ($num_results_uu != 0) {
    $row_uu = mysqli_fetch_assoc($result_uu);
    if($row_uu["ss"]!='') {
        $rasx = $row_uu["ss"];
    }
}
//расходы на выплату бонусов за выбранный период
if($more_mon==0)
{
    $bonus=0;
    $result_status223=mysql_time_query($link,'SELECT a.* from users_commission_trips as a,r_user as b where a.id_users=b.id and b.id_company="'.$id_company.'" and a.date="'.$date_start.'"');
    $num223 = $result_status223->num_rows;
    if($result_status223->num_rows!=0)
    {
        for ($i=0; $i<$num223; $i++)
        {
            $row223 = mysqli_fetch_assoc($result_status223);
            $result_status_b=mysql_time_query($link,'SELECT a.* from users_commission_level as a where a.sum_start<="'.$row223["sum"].'" and a.sum_end>"'.$row223["sum"].'" and a.dates="'.$date_start.'" and a.id_company="'.ht($id_company).'"');

            if($result_status_b->num_rows!=0)
            {
                $row_status_b = mysqli_fetch_assoc($result_status_b);
                if($row_status_b["level"]!=1)
                {
                    $bonus=$bonus+(($row223["sum"]*$row_status_b["proc"])/100);
                }
            }
        }
    }


}else
{
    //идем по месяцам и считаем сколько выплатили каждому с учетом уровней бонусов за месяц. (бонусные периоды могут быть разные в зависимости от месяца)
    $bonus=0;
    $date_start_while=$date_start;
    while ($date_start_while!= $date_end) {

        // echo($date_start.' () ');

        $result_status223=mysql_time_query($link,'SELECT a.* from users_commission_trips as a,r_user as b where a.id_users=b.id and b.id_company="'.$id_company.'" and a.date="'.$date_start_while.'"');
        $num223 = $result_status223->num_rows;
        if($result_status223->num_rows!=0)
        {
            for ($i=0; $i<$num223; $i++)
            {
                $row223 = mysqli_fetch_assoc($result_status223);
                $result_status_b=mysql_time_query($link,'SELECT a.* from users_commission_level as a where a.sum_start<="'.$row223["sum"].'" and a.sum_end>"'.$row223["sum"].'" and a.dates="'.$date_start_while.'" and a.id_company="'.ht($id_company).'"');

                if($result_status_b->num_rows!=0)
                {
                    $row_status_b = mysqli_fetch_assoc($result_status_b);
                    if($row_status_b["level"]!=1)
                    {
                        $bonus=$bonus+(($row223["sum"]*$row_status_b["proc"])/100);
                    }
                }
            }
        }


        $date_start_while=date_step_sql_more($date_start_while,'+1m');

    }


}
//echo($bonus);
$rasx=$rasx+$bonus;
if($bonus!=0)
{

    $raz_array[]=['name'=>'Выплата Бонусов','val'=>round($bonus)];
}

//доходы



$dox=0;
$result_uu = mysql_time_query($link, 'select sum(A.sum) as ss  from finance_operation as A where A.income=1 and A.visible=1 and A.id_a_company IN ('.ht($id_company).') and  A.date>="' . ht($date_start) . '" and  A.date<="' . ht($date_end) . '"');
$num_results_uu = $result_uu->num_rows;

if ($num_results_uu != 0) {
    $row_uu = mysqli_fetch_assoc($result_uu);
    if($row_uu["ss"]!='') {
        $dox = $row_uu["ss"];
    }
}

//доходы с бонусов
$dox_bonus =0;
$result_status22=mysql_time_query($link,'SELECT sum(a.sum) as summ from users_commission_trips as a,r_user as b where a.id_users=b.id and b.id_company="'.ht($id_company).'" and  not(a.id_users=0) and a.date>="' . ht($date_start) . '" and  a.date<="' . ht($date_end) . '"');

$num_results_22 = $result_status22->num_rows;

if ($num_results_22 != 0) {
    $row_uu = mysqli_fetch_assoc($result_status22);
    if($row_uu["summ"]!='') {
        $dox_bonus = $row_uu["summ"];
    }
}
$dox=$dox+$dox_bonus;
if($dox_bonus!=0)
{

    $doxod_array[]=['name'=>'Комиссии с продаж','val'=>round($dox_bonus)];
}

//echo($dox_bonus);

//вывод денег
$viv=0;
$result_uu = mysql_time_query($link, 'select sum(A.sum) as ss  from finance_operation as A where A.income=2 and A.visible=1 and A.id_a_company IN ('.ht($id_company).') and  A.date>="' . ht($date_start) . '" and  A.date<="' . ht($date_end) . '"');
$num_results_uu = $result_uu->num_rows;

if ($num_results_uu != 0) {
    $row_uu = mysqli_fetch_assoc($result_uu);
    if($row_uu["ss"]!='') {
        $viv = $row_uu["ss"];
    }
}


//подсчитаем прибыль
$pri=$dox-$rasx;
$sim='';
if($pri>0)
{
    $sim='+';
}
if($pri<0)
{
    $sim='-';
}

//планы за период
$ss=0;
$ss1=0;
$result_uu = mysql_time_query($link, 'select sum(A.income) as ss,sum(A.expense) as ss1   from finance_plane as A where A.id_a_company IN ('.ht($id_company).') and  A.date>="' . ht($date_start) . '" and  A.date<="' . ht($date_end) . '"');
$num_results_uu = $result_uu->num_rows;

if ($num_results_uu != 0) {
    $row_uu = mysqli_fetch_assoc($result_uu);
    if($row_uu["ss"]!='') {
        $ss = $row_uu["ss"];
    }
    if($row_uu["ss1"]!='') {
        $ss1 = $row_uu["ss1"];
    }
}

$max = max($rasx, $dox, $ss, $ss1);

if($rasx!=$max) { $rasx1=round($rasx*100/$max); } else {$rasx1=100;}
if($dox!=$max) { $dox1=round($dox*100/$max); } else {$dox1=100;}
if($ss!=$max) { $ss11=round($ss*100/$max); } else {$ss11=100;}
if($ss1!=$max) { $ss12=round($ss1*100/$max); } else {$ss12=100;}
$class_one='';
if($dox<$ss) {
    $class_one = 'two-gr-line';
}

$dox_format=rtrim(rtrim(number_format(($dox), 2, '.', ' '),'0'),'.');
if($dox_format=='') {$dox_format=0;}

$dplane_format=rtrim(rtrim(number_format(($ss), 2, '.', ' '),'0'),'.');
if($dplane_format=='') {$dplane_format=0;}


$graf_title_one=' <div class="title-graf '.$class_one.'"><div><span class="cost_circle">+'.$dox_format.'</span>(факт)</div><div class="plan-f js-place-finance" data-tooltip="Изменить план"><span class="cost_circle">+'.$dplane_format.'</span>(план)</div></div>';
$graf_title_two='';
if($dox<$ss)
{
    $graf_title_two=$graf_title_one;
    $graf_title_one='';
}


$echo.='<div class="two-finance">

<div class="h1-fin">Доходы и Расходы';

if($more_mon==1)
{
    $echo.='<span class="more-month-fin">('.date_fik($date_start).' - '.date_fik($date_end).')</span>';
}

$echo.='</div>

<div class="fin-na-100">
<div class="fin-50">
<label>Прибыль</label>
<span class="cost_circle"><i>'.$sim.'</i>'.rtrim(rtrim(number_format((abs($pri)), 2, '.', ' '),'0'),'.').'</span>
</div>
<div class="fin-50">
<label>Вывод денег</label>
<span class="cost_circle">'.rtrim(rtrim(number_format((abs($viv)), 2, '.', ' '),'0'),'.').'</span>
</div>
</div>


<div class="finance-line">
<label>Доходы</label>
<div class="finance-graf">

<div class="line-fin green-fin" rel_w="'.$dox1.'"  style="width:0%">'.$graf_title_one.'</div>
<div class="line-fin green-l-fin"  rel_w="'.$ss11.'" style="width:0%">'.$graf_title_two.'</div>

</div>';


$class_one='';
if($rasx<$ss1) {
    $class_one = 'two-gr-line';
}

$dox_format=rtrim(rtrim(number_format(($rasx), 2, '.', ' '),'0'),'.');
if($dox_format=='') {$dox_format=0;}
$dplane_format=rtrim(rtrim(number_format(($ss1), 2, '.', ' '),'0'),'.');
if($dplane_format=='') {$dplane_format=0;}

$graf_title_one=' <div class="title-graf '.$class_one.'"><div><span class="cost_circle">-'.$dox_format.'</span>(факт)</div><div class="plan-f js-place-finance" data-tooltip="Изменить план"><span class="cost_circle">-'.$dplane_format.'</span>(план)</div></div>';

$graf_title_two='';
if($rasx<$ss1)
{
    $graf_title_two=$graf_title_one;
    $graf_title_one='';
}


$echo.='<label style="margin-top: 20px;">Расходы</label>
<div class="finance-graf">

<div class="line-fin red-fin" rel_w="'.$rasx1.'" style="width:0%">'.$graf_title_one.'</div>
<div class="line-fin orance-fin" rel_w="'.$ss12.'" style="width:0%">'.$graf_title_two.'</div>

</div>


</div>
</div>';



for ($op=0; $op<count($c_op); $op++)
{
		switch($op)
              {
		 case "0":{ 
			 //Доходы и Расходы

              break;
                  }	
		
		 case "1":{ 
			 //График продаж
			 		 if($c_op[$op]==1) {


                         if($more_mon==1)
                         {

                             $date_start_while=$date_start;
                             while ($date_start_while!= $date_end) {

                                 //какой то период выбран значит по нему и выводим
                                 $date_start_while22=date_step_sql_more($date_start_while,'+1m');

                                 $result_status22 = mysql_time_query($link, 'SELECT sum(a.sum) as summ from users_commission_trips as a,r_user as b where a.id_users=b.id and b.id_company="' . ht($id_company) . '" and  not(a.id_users=0) and a.date>="' . ht($date_start_while) . '" and  a.date<"' . ht($date_start_while22) . '"');


                                 $num_results_uu = $result_status22->num_rows;
                                 $hits=0;
                                 if ($num_results_uu != 0) {
                                     $row_uu = mysqli_fetch_assoc($result_status22);
                                     if (($row_uu["summ"] != '') and ($row_uu["summ"] != 0)) {
                                         $hits=round($row_uu["summ"]);
                                     }

                                 }

                                 $result_uu = mysql_time_query($link, 'select count(id) as ss from trips where visible=1 and id_a_company IN ('.ht($id_company).') and datecreate>="'.$date_start_while.'" and datecreate<"'.$date_start_while22.'"');
                                 $num_results_uu = $result_uu->num_rows;
                                 $views=0;
                                 if ($num_results_uu != 0) {
                                     $row_uu = mysqli_fetch_assoc($result_uu);
                                     if (($row_uu["ss"] != '') and ($row_uu["ss"] != 0)) {
                                         $views=$row_uu["ss"];
                                     }
                                 }
                                 $date_mass = explode("-", ht($date_start_while));
                                 //$xy[]['date']=$date_start_while;


                                 $xy[] = ['views' => $views, 'hits' => $hits, 'date' => $date_start_while];
                                 $date_start_while=date_step_sql_more($date_start_while,'+1m');
                             }
                         } else
                         {
//echo($date_end);
                             $date_start_while=date_step_sql_more($date_end,'-5m');;

                             while ($date_start_while!= $date_end) {

                                 //какой то период выбран значит по нему и выводим
                                 $date_start_while22=date_step_sql_more($date_start_while,'+1m');

                                 $result_status22 = mysql_time_query($link, 'SELECT sum(a.sum) as summ from users_commission_trips as a,r_user as b where a.id_users=b.id and b.id_company="' . ht($id_company) . '" and  not(a.id_users=0) and a.date>="' . ht($date_start_while) . '" and  a.date<"' . ht($date_start_while22) . '"');


                                 $num_results_uu = $result_status22->num_rows;
                                 $hits=0;
                                 if ($num_results_uu != 0) {
                                     $row_uu = mysqli_fetch_assoc($result_status22);
                                     if (($row_uu["summ"] != '') and ($row_uu["summ"] != 0)) {
                                         $hits=round($row_uu["summ"]);
                                     }

                                 }

                                 $result_uu = mysql_time_query($link, 'select count(id) as ss from trips where visible=1 and id_a_company IN ('.ht($id_company).') and datecreate>="'.$date_start_while.'" and datecreate<"'.$date_start_while22.'"');
                                 $num_results_uu = $result_uu->num_rows;
                                 $views=0;
                                 if ($num_results_uu != 0) {
                                     $row_uu = mysqli_fetch_assoc($result_uu);
                                     if (($row_uu["ss"] != '') and ($row_uu["ss"] != 0)) {
                                         $views=$row_uu["ss"];
                                     }
                                 }
                                 $date_mass = explode("-", ht($date_start_while));
                                 //$xy[]['date']=$date_start_while;


                                 $xy[] = ['views' => $views, 'hits' => $hits, 'date' => $date_start_while];
                                 $date_start_while=date_step_sql_more($date_start_while,'+1m');
                             }

                         }

			}  break;
                  }			

		 case "2":{
             //Структура доходов
			 if($c_op[$op]==1) {


                 $result_uu = mysql_time_query($link, 'select distinct A.id_type,C.name,(select sum(b.sum) from finance_operation as b where b.income=1 and b.id_type=A.id_type and b.visible=1 and b.id_a_company IN ('.ht($id_company).') and  b.date>="' . ht($date_start) . '" and  b.date<="' . ht($date_end) . '" ) as ss  from finance_operation as A, finance_operation_type as C where C.id=A.id_type and A.income=1 and A.visible=1 and A.id_a_company IN ('.ht($id_company).') and  A.date>="' . ht($date_start) . '" and  A.date<="' . ht($date_end) . '"');
                 $num_results_uu = $result_uu->num_rows;

                 if ($num_results_uu != 0) {
                     while ($row_uu = mysqli_fetch_assoc($result_uu)) {
                         if (($row_uu["ss"] != '') and ($row_uu["ss"] != 0)) {
                             $doxod_array[] = ['name' => $row_uu["name"], 'val' => round($row_uu["ss"])];
                         }
                     }
                 }
                 //сортируем двухмерный массив
                 $volume  = array_column($doxod_array, 'val');
                 $edition = array_column($doxod_array, 'name');

                 array_multisort($volume, SORT_DESC, $edition, SORT_ASC, $doxod_array);





				  }  break;
                  }		
		 case "3":{
             //Структура расходов
			 if($c_op[$op]==1) {


                 $result_uu = mysql_time_query($link, 'select distinct A.id_type,C.name,(select sum(b.sum) from finance_operation as b where b.income=0 and b.id_type=A.id_type and b.visible=1 and b.id_a_company IN ('.ht($id_company).') and  b.date>="' . ht($date_start) . '" and  b.date<="' . ht($date_end) . '" ) as ss  from finance_operation as A, finance_operation_type as C where C.id=A.id_type and A.income=0 and A.visible=1 and A.id_a_company IN ('.ht($id_company).') and  A.date>="' . ht($date_start) . '" and  A.date<="' . ht($date_end) . '"');



                 $num_results_uu = $result_uu->num_rows;

                 if ($num_results_uu != 0) {
                     while ($row_uu = mysqli_fetch_assoc($result_uu)) {
                         if (($row_uu["ss"] != '') and ($row_uu["ss"] != 0)) {
                             $raz_array[] = ['name' => $row_uu["name"], 'val' => round($row_uu["ss"])];
                         }
                     }
                 }
                 $volume  = array_column($raz_array, 'val');
                 $edition = array_column($raz_array, 'name');

                 array_multisort($volume, SORT_DESC, $edition, SORT_ASC, $raz_array);



             }  break;
                  }		

		}
	
}


	
end_code:
/*
$xy=array();
$raz_array=array();
$doxod_array=array();
*/
//chart
//chart1
//chart2

$aRes = array("debug"=>$debug,"status"   => $status_ee,"echo"=>$echo,"chart2"=>$xy,"chart"=>$doxod_array,"chart1"=>$raz_array);
/*require_once $url_system.'Ajax/lib/Services_JSON.php';
$oJson = new Services_JSON();
//функция работает только с кодировкой UTF-8
echo $oJson->encode($aRes);
*/
echo json_encode($aRes);
?>