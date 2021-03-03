<?php
//изменить сроки оплаты по туру
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
$token=htmlspecialchars($_POST['tk']);
$disco=0;
$ID_N='';
$temp='';
$radio_potential='';

$id=2020;
$token=ht($_POST["tk"]);

$dom=0;
$status_echo='';
//проверка что есть такой город что это число
//проверка что пользователь зарегистрирован

$echo_r=1; //выводить или нет ошибку 0 -нет
$debug='';

//**************************************************
//2 дня
if(!token_access_new($token,'bt_edit_srok',$_POST["id"],"rema",2880))
{
    $debug=h4a(100,$echo_r,$debug);
    goto end_code;
}




/*
if ( count($_GET) != 4 )
{
$debug=h4a(1,$echo_r,$debug);
goto end_code;
}
*/
//**************************************************
if ((!$role->permission('Туры','U'))and($sign_admin!=1))
{
    $debug=h4a(2,$echo_r,$debug);
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
if(((!isset($_POST['tk1']))or(trim($_POST['tk1'])!='dsQ42DFSs4d2re')))
{
    $debug=h4a(77,$echo_r,$debug);
    goto end_code;
}

$result_t=mysql_time_query($link,'Select A.id,A.id_exchange from trips as A where A.visible=1 AND A.id="'.ht($_POST["id"]).'" and A.id_a_company="'.$id_company.'"');
$num_results_t = $result_t->num_rows;
if($num_results_t==0)
{
    $debug=h4a(5,$echo_r,$debug);
    goto end_code;

} else
{
    $row_uu = mysqli_fetch_assoc($result_t);

}


//**************************************************
//**************************************************
/*
id=51&
tk=51.eda3eb4f64e3999ca260107659cf40ee.62749b5207ea5e8f62749b5284cf5e8f6274f3452797eca24ec19b527f474ec1&
tk1=dsQ23RSasd2sa&
kto_komy=1&
operation=2&
summ=2+000&
curs=67.40&
com_proc=0&
com_rub=0&
method=2&
task%5Btask_date%5D=9+%D0%98%D1%8E%D0%BB%D1%8F+2020&
buy_date=2020-07-09&
comment=
*/



$stack_error = array();  // общий массив ошибок


$insurance=$_POST['srok'];
for ($i = 0; $i < (count($insurance['proc'])); $i++){

    if((ht($insurance['proc'][$i])=='')or((int)ht($insurance['proc'][$i])>100)or(!is_numeric(trimc($insurance['proc'][$i])))or((int)ht($insurance['proc'][$i])==0))
    {
        array_push($stack_error, "proc");
        break;
    }

}

$insurance=$_POST['srok'];
for ($i = 0; $i < (count($insurance['date'])); $i++){

    if(!validateDate($insurance['date'][$i],'d.m.Y'))
    {
        array_push($stack_error, "date");
        break;
    }

}




//print_r ($stack_error);
if(count($stack_error)!=0)
{
    goto end_code;
}

//проверим поменялось ли вообще что то в сроках
$yes_edit=0;
$insurance=$_POST['srok'];
for ($i = 0; $i < (count($insurance['proc'])); $i++){

    $result_uu_srok = mysql_time_query($link, 'select A.* from trips_payment_term as A where 
A.id_trips="' . ht($_POST["id"]) . '" and A.type="'.ht($_POST["my"]).'" and A.visible=1 and A.proc="'.ht((float)$insurance['proc'][$i]).'" and A.date="'.ht(date_ex(1,$insurance['date'][$i])).'" and A.visible=1');

    $num_results_uu_srok = $result_uu_srok->num_rows;
    if($num_results_uu_srok==0)
    {
        $yes_edit++;

        break;
    }
}




if($yes_edit==0)
{
    $result_uu = mysql_time_query($link, 'select count(A.id) as cc from trips_payment_term as A where A.id_trips="' . ht($_POST["id"]) . '" and A.type="'.ht($_POST["my"]).'" and A.visible=1');
    $num_results_uu = $result_uu->num_rows;

    if ($num_results_uu != 0) {
        $row_uu = mysqli_fetch_assoc($result_uu);

        if(count($insurance)!=$row_uu["cc"])
        {
            //удалили какую то запись а все остальные остались такие же
            $yes_edit++;
        }

    }
}





$status_ee='ok';

if( $yes_edit==0)
{
    //ничего не изменилось в записях
    goto end_code;
}
$old_srok='не задано';
$result_uu_srok = mysql_time_query($link, 'select A.* from trips_payment_term as A where 
A.id_trips="' . ht($_POST["id"]) . '" and A.type="'.ht($_POST["my"]).'" and A.visible=1 order by A.date');

if ($result_uu_srok) {
    $i = 1;
    $old_srok='';
    $num_results_uu_srok = $result_uu_srok->num_rows;
    while ($row_uu_srok = mysqli_fetch_assoc($result_uu_srok)) {

if($i!=1)
{
    $old_srok.=', ';
}
        $old_srok.=$row_uu_srok["proc"].'% до '.date_ex(0,$row_uu_srok['date']);
$i++;
    }
}

mysql_time_query($link, 'update trips_payment_term set
visible="0"
where id_trips = "' . ht($_POST['id']) . '" and type="'.ht($_POST["my"]).'" and visible=1');

$new_srok='';
$insurance=$_POST['srok'];
for ($i = 0; $i < (count($insurance['proc'])); $i++){

    if($i!=0) {$new_srok.=', ';}
    $new_srok.=$insurance['proc'][$i].'% до '.$insurance['date'][$i];

    mysql_time_query($link, 'INSERT INTO trips_payment_term(id_trips,type,proc,date,visible) VALUES( 
"' . ht($_POST['id']) . '","' . ht($_POST["my"]) . '","'.ht($insurance['proc'][$i]).'","'.ht(date_ex(1,$insurance['date'][$i])).'","1")');

}

$action=7;
$comment_his='Изменение сроков оплаты для клиента. Было → '.$old_srok.', стало → '.$new_srok;
if($_POST["my"]==1)
{
    $action=6;
    $comment_his='Изменение сроков оплаты туроператору. Было → '.$old_srok.', стало → '.$new_srok;
}


    //добавить в историю это действие
    AddHistoryTrips($action,$id_user,ht($_POST['id']),$comment_his,'','','','','','','руб.','',$link,'');


//определяем если есть сроки оплаты какие части стали оплачены а какие наоборот перестали быть
//определяем если есть сроки оплаты какие части стали оплачены а какие наоборот перестали быть
//|
//V
//-> клиент -> оператор
$trips_call=$_POST["id"];
for ($i = 0; $i < 2; $i++) {

    $procr = proc_call($trips_call, $i,$link); //определяем какой процент оплачен

    $result_uuее = mysql_time_query($link, 'select A.id,A.proc from trips_payment_term as A where 
A.id_trips="' . ht($trips_call) . '" and A.type="'.$i.'" and A.visible=1 order by A.date');

    if ($result_uuее) {
        while ($row_uuее = mysqli_fetch_assoc($result_uuее)) {
            $yes = 1;
            if ($row_uuее["proc"] > $procr) {
                $yes = 0;
            }
            mysql_time_query($link, 'update trips_payment_term set yes="' . $yes . '" where id = "' . ht($row_uuее['id']) . '"');
        }
    }
}
//A
//|
//определяем если есть сроки оплаты какие части стали оплачены а какие наоборот перестали быть
//определяем если есть сроки оплаты какие части стали оплачены а какие наоборот перестали быть


//Удаляем напоминания и задачи по оплате так как сроки изменились. новые задачи сформируются сами

//Удаляем и задачу по впечатлениям. Она сформируется сама автоматически по новым датам в течении часа


if($_POST["my"]==0) {
    //клиент
    $result_ss = mysql_time_query($link, 'SELECT A.id,A.id_user_responsible FROM task_new as A WHERE A.id_object="' . ht($_POST["id"]) . '" and A.visible=1 and A.action="19" and A.status=0');
} else
{
    //туроператор
    $result_ss = mysql_time_query($link, 'SELECT A.id,A.id_user_responsible FROM task_new as A WHERE A.id_object="' . ht($_POST["id"]) . '" and A.visible=1 and A.action="18" and A.status=0');
}

$num_ss = $result_ss->num_rows;
if($num_ss!=0)
{
    $row_ss = mysqli_fetch_assoc($result_ss);
    mysql_time_query($link,'delete FROM task_new where id="'.ht($row_ss["id"]).'"');
    UpdateTaskKey($row_ss["id_user_responsible"],$link);
}




end_code:

$aRes = array("debug"=>$debug,"status"   => $status_ee,"status_echo" => $status_echo,"count" => $dom,"for_id"=>ht($_POST["id"]),"id" => htmlspecialchars($ID_N),"error" =>  $stack_error,"download" => $download);
/*require_once $url_system.'Ajax/lib/Services_JSON.php';
$oJson = new Services_JSON();
//функция работает только с кодировкой UTF-8
echo $oJson->encode($aRes);
*/
echo json_encode($aRes);



?>