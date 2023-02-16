<?php
//добавить новое обращение
$url_system=$_SERVER['DOCUMENT_ROOT'].'/';
include_once $url_system.'module/ajax_access.php';
header("Content-type: application/json");


//if(empty($_POST['preorders']['id_client'])) {  $_POST['preorders']['id_client']=0; }
//echo($_POST['task']['id_client']);
$temp='';
$status_ee='error';
$eshe=0;
$echo='';
$new=array();
$vid=0;
$debug='';
$count_all_all=0;
$basket='';
$token=htmlspecialchars($_POST['tk']);
$disco=0;

$id=htmlspecialchars($_POST['id']);
$dom=0;
$status_echo='';
//проверка что есть такой город что это число
//проверка что пользователь зарегистрирован

$echo_r=1; //выводить или нет ошибку 0 -нет
$debug='';

//**************************************************
if(!token_access_new($token,'bt_preorders_edit',$id,"rema",2880))
{
   $debug=h4a(100,$echo_r,$debug);
   goto end_code;
}
	
	
	//echo(count($_POST));
/*
if ( count($_POST) != 3 ) 
{
   $debug=h4a(1,$echo_r,$debug);
   goto end_code;	
}
*/

//**************************************************
 if ((!$role->permission('Обращения','U'))and($sign_admin!=1))
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
if ((!isset($_POST["id"])))
{
   $debug=h4a(4,$echo_r,$debug);
   goto end_code;	
}

$class_js_script='';
$class_js_scrip1='';

$new=0;
if ((isset($_POST['preorders']["client_new"]))and($_POST['preorders']["client_new"]=='1')and(trim($_POST['client_phone'])!=''))
{

    //+7 (902) 129-68-34
    $phone_end='';

    if(trim($_POST['client_phone'])!='') {
        $phone_base = explode(" ", htmlspecialchars(trim($_POST['client_phone'])));
        $phone_base1 = explode("-", $phone_base[2]);
        $phone_end = $phone_base[1][1] . $phone_base[1][2] . $phone_base[1][3] . $phone_base1[0] . $phone_base1[1] . $phone_base1[2];
    }

    if(strlen($phone_end)!=10)
    {
        $debug=h4a("199",$echo_r,$debug);
        goto end_code;
    } else
    {
        $new=1;
    }
} else {


    if ((isset($_POST['preorders']["client_type"])) and (is_numeric($_POST['preorders']["id_client"])) and (($_POST['preorders']["client_type"] == '0') or ($_POST['preorders']["client_type"] == '1') or ($_POST['preorders']["client_type"] == '2'))) {
  //проверяем мог ли он привязать эту задачу к данному клиенту
  //если относится к той же компани что и пользователь добавл. задачу

		switch($_POST['preorders']["client_type"])
              {
            case "0":
            {
                //частное лицо
                $sql_tt = 'Select b.id,b.fio,b.phone from k_clients as b where b.id="' . ht($_POST['preorders']['id_client']) . '" and b.potential=0 and b.visible=1 and b.id_a_company IN (' . ht($id_company) . ')';
                break;
            }
            case "1":
            {
                //потенциальный турист
                $sql_tt = 'Select b.id,b.fio,b.phone from k_clients as b where b.id="' . ht($_POST['preorders']['id_client']) . '" and b.potential=1 and b.visible=1 and b.id_a_company IN (' . ht($id_company) . ')';
                break;
            }
            case "2":
            {
                //с кем то летел
                $sql_tt = 'Select b.id,b.fio,b.phone from k_clients as b where b.id="' . ht($_POST['preorders']['id_client']) . '" and b.potential=2 and b.visible=1 and b.id_a_company IN (' . ht($id_company) . ')';
                break;
            }
		}
	
  $result_t=mysql_time_query($link,$sql_tt);
	
	
	
           $num_results_t = $result_t->num_rows;
	       if($num_results_t==0)
	       {	
			      $debug=h4a(86,$echo_r,$debug);
                  goto end_code;
		   } else
           {
               $row_uu_op = mysqli_fetch_assoc($result_t);
           }
	
} else
{
    $new=2;
}
    /*
    $debug=h4a(8699,$echo_r,$debug);
    goto end_code;
    */
}


$result_t=mysql_time_query($link,'Select A.* from preorders as A where A.visible=1 AND A.id="'.ht($id).'" and A.id_company IN ('.$id_company.')');
$num_results_t = $result_t->num_rows;
if($num_results_t==0)
{
    $debug=h4a(5,$echo_r,$debug);
    goto end_code;

} else {
    $row_uu = mysqli_fetch_assoc($result_t);
}
if ((!$role->permission('Обращения','U'))and($sign_admin!=1))
{
    $debug=h4a(05,$echo_r,$debug);
    goto end_code;
}

if(($row_uu['id_user']!=$id_user)and($sign_admin!=1))
{
    $debug=h4a(655,$echo_r,$debug);
    goto end_code;
}

if(($row_8["status"]==5)or($row_8["status"]==6)) {

    $debug=h4a(5112,$echo_r,$debug);
    goto end_code;
}

//**************************************************
//**************************************************
//**************************************************
//**************************************************


$status_ee='ok';



if($new==1)
{

    $org=$id_company;
    //echo($_POST['offers'][0]["id_company"]);
    if(is_numeric($row_uu['id_company']))
    {
        $org=ht($row_uu['id_company']);
    }

    $code=1;
    $result_tcc=mysql_time_query($link,'Select max(b.code) as cc from k_clients as b');
    $num_results_tcc = $result_tcc->num_rows;
    if($num_results_tcc!=0)
    {

        $row_tcc = mysqli_fetch_assoc($result_tcc);
        $code= (int)$row_tcc["cc"]+1;
    }


    $today[0] = date("y.m.d"); //присвоено 03.12.01
    $today[1] = date("H:i:s"); //присвоит 1 элементу массива 17:16:17

    $date_=$today[0].' '.$today[1];



    //потенциальный клиент
    mysql_time_query($link,'INSERT INTO k_clients (id_a_company,code,potential,latin,adress,id_company,id_user,fio,phone,email,date_birthday,datetime,comment,inter_seria,inter_number,inter_kem,inter_kogda,inter_srok,inner_seria,inner_number,inner_kem,inner_kogda,visible,pol) VALUES( 
"'.ht($org).'","'.ht($code).'","1","",
"","0",
"'.ht($id_user).'",
"'.ht($_POST['client_fio']).' ",
"'.$phone_end.'",
"",
"0000-00-00",
"'.$date_.'",
"",
"",
"",
"",
"0000-00-00",
"0000-00-00",
"",
"",
"",
"0000-00-00",
"1","1")');


//добавить особенности клиента
//$_POST['options_b']

    $ID_UU=mysqli_insert_id($link);
    $type_c=1;

} else
{
    if($new==2)
    {
        //  echo("!3");
        //нет связи с клиентом вообще
        $ID_UU=0;
        $type_c=1;

    } else {
        $ID_UU = ht($_POST['preorders']['id_client']);
    }
}






$type_c=1;
if(($_POST['preorders']["client_type"]==0)or($_POST['preorders']["client_type"]==1)or($_POST['preorders']["client_type"]==2))
{
    $type_c=1;
}

$booking_new='-';
$result_uu226 = mysql_time_query($link, 'select name from booking_sourse where visible=1 and id="' . ht($_POST["type_booking"]) . '"');
$num_results_uu226 = $result_uu226->num_rows;

if ($num_results_uu226 != 0) {
    $row_uu226 = mysqli_fetch_assoc($result_uu226);
    $booking_new=$row_uu226["name"];
}

$country_new='не указано';
$result_uu226 = mysql_time_query($link, 'select name from trips_country where visible=1 and id="' . ht($_POST["id_country"]) . '"');
$num_results_uu226 = $result_uu226->num_rows;

if ($num_results_uu226 != 0) {
    $row_uu226 = mysqli_fetch_assoc($result_uu226);
    $country_new=$row_uu226["name"];
}


if($ID_UU!=0) {
    $class_js_script='js-client';
    $class_js_scrip1='js-glu-f-';



    $sql_tt_x='Select b.id,b.fio,b.phone from k_clients as b where b.id="'.ht($ID_UU).'" and b.visible=1 and b.id_a_company IN ('.ht($id_company).')';



    $name_hh='';


    $result_xs = mysql_time_query($link, $sql_tt_x);
    $num_results_xs = $result_xs->num_rows;

    if ($num_results_xs != 0) {
        $row_xs = mysqli_fetch_assoc($result_xs);


        if (trim($row_xs["fio"]) == '') {
            //$name_hh='';
            $name_hh = phone_format($row_xs['phone']);
        } else {
            $name_hh = $row_xs['fio'];
        }
    }

    $array_param_new = array(
        '<a class=\"preorders-a ' . $class_js_script . '\" iod=\"' . $ID_UU . '\"><strong class=\"' . $class_js_script1 . '' . $ID_UU . '\">' . $name_hh . '</strong></a>',
        $_POST["question"],
        $booking_new,
        $country_new
    );
} else
{
    $array_param_new = array(
        'Не известен',
        $_POST["question"],
        $booking_new,
        $country_new
    );
}
//старые значения находим. то что было до этого





$booking_new='-';
$result_uu226 = mysql_time_query($link, 'select name from booking_sourse where visible=1 and id="' . ht($row_uu["id_booking_sourse"]) . '"');
$num_results_uu226 = $result_uu226->num_rows;

if ($num_results_uu226 != 0) {
    $row_uu226 = mysqli_fetch_assoc($result_uu226);
    $booking_new=$row_uu226["name"];
}

$country_new='не указано';
$result_uu226 = mysql_time_query($link, 'select name from trips_country where visible=1 and id="' . ht($row_uu["id_country"]) . '"');
$num_results_uu226 = $result_uu226->num_rows;

if ($num_results_uu226 != 0) {
    $row_uu226 = mysqli_fetch_assoc($result_uu226);
    $country_new=$row_uu226["name"];
}

$class_js_script='js-client';
$class_js_scrip1='js-glu-f-';
if($row_uu["id_k_clients"]!=0)
{



    $sql_tt_x='Select b.id,b.fio,b.phone from k_clients as b where b.id="'.ht($row_uu["id_k_clients"]).'" and b.visible=1 and b.id_a_company IN ('.ht($id_company).')';



    $name_hh='';


    $result_xs = mysql_time_query($link, $sql_tt_x);
    $num_results_xs = $result_xs->num_rows;

    if ($num_results_xs != 0) {
        $row_xs = mysqli_fetch_assoc($result_xs);


        if (trim($row_xs["fio"]) == '') {
            //$name_hh='';
            $name_hh = phone_format($row_xs['phone']);
        } else {
            $name_hh = $row_xs['fio'];
        }
    }


    $array_param_old=array(
        '<a class=\"preorders-a '.$class_js_script.'\" iod=\"'.$row_uu["id_k_clients"].'\"><strong class=\"'.$class_js_script1.''.$row_uu["id_k_clients"].'\">'.$name_hh.'</strong></a>',
        $row_uu["text"],
        $booking_new,
        $country_new

    );


} else
{

    $array_param_old=array(
        'не известен',
        $row_uu["text"],
        $booking_new,
        $country_new

    );

}







$array_param_comment=array(
    'Клиент',
    'Комментарий',
    'Рекламный источник',
    'Страна');
$history_edit=AddHistoryPreordersAll($_POST["id"],
    $array_param_old,
    $array_param_new,
    $array_param_comment,
    $link);
if($history_edit!='0')
{
    //что-то поменялось
    $text_history='Изменение данных по обращению → '.$history_edit;


    mysql_time_query($link, 'update preorders set
    
id_type_clients="'.$type_c.'",                                                         
id_k_clients="'.ht($ID_UU).'",
id_booking_sourse="'.ht($_POST["type_booking"]).'",                                         
id_country="'.ht($_POST["id_country"]).'",             
text="'.ht($_POST["question"]).'"
    
    where id = "' . ht($_POST["id"]) . '"');

    mysql_time_query($link,'INSERT INTO preorders_status_history_new (id_preorder,action_history,id_user,datetimes,edit,comment,comment_sys) VALUES ("'.ht($_POST["id"]).'","2",
		"'.ht($id_user).'",
		"'.date("Y-m-d").' '.date("H:i:s").'",
		"0",
		"'.$text_history.'",
		"")');


}





end_code:

$aRes = array("debug"=>$debug,"status"   => $status_ee,"status_echo"   => $status_echo,"new" => $new1,"for_id"=>$id,"id" => ht($id),"temp"=>$temp);
/*require_once $url_system.'Ajax/lib/Services_JSON.php';
$oJson = new Services_JSON();
//функция работает только с кодировкой UTF-8
echo $oJson->encode($aRes);
*/
echo json_encode($aRes);
?>