<?php
//добавить новый тур
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

if(!token_access_new($token,'add_tours',$id,"rema",2880))
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
 if ((!$role->permission('Туры','A'))and($sign_admin!=1))
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
if(((!isset($_POST['tk1']))or(trim($_POST['tk1'])!='vWeVE8zAZe')))
{
  $debug=h4a(77,$echo_r,$debug);
  goto end_code;	
}

//**************************************************
//**************************************************
/*
save_tours=1&
tk1=vWeVE8zAZe&
tk=2020.aa4e7adc4b3b7a8e7cc99ffcab24e4ba.75cbe848f31fc21979f8e84868db5cb6ebfbe848c725638179f8e84827db40c4&
number_contract=17%2F04%2F2020+-+1&
doc_date=17+%D0%90%D0%BF%D1%80%D0%B5%D0%BB%D1%8F+2020&
date_sele_doc=2020-04-17&
id_operator=ANEX+Tour&
hidden_search_1=7&
id_booking_sourse=2&
id_exchange=1&
password=1&
buy_id=35&
buy_type=1&
fly_id=35%2C50&
fly_count=2&
radio_password=0&
city=%D0%A3%D0%BB%D1%8C%D1%8F%D0%BD%D0%BE%D0%B2%D1%81%D0%BA&
manager=%D0%92%D0%BB%D0%B0%D0%B4%D0%B8%D1%81%D0%BB%D0%B0%D0%B2+%D0%98%D0%B3%D0%BE%D1%80%D0%B5%D0%B2%D0%B8%D1%87&
count_clients=2&
id_country=%D0%A2%D1%83%D1%80%D1%86%D0%B8%D1%8F&
hidden_search_1=1&
place_name=&
date_start=17.04.2020&
date_end=20.04.2020&
count_day=3&
hotel=SAN+BILL%2B&offers%5B0%5D%5B%5D=&offers%5B0%5D%5B%5D=&
id_room_category=1&
room_category=Standart+(%D0%A1%D1%82%D0%B0%D0%BD%D0%B4%D0%B0%D1%80%D1%82)&
id_room_type=1&
room_type=DBL+(%D0%94%D0%B2%D1%83%D1%85%D0%BC%D0%B5%D1%81%D1%82%D0%BD%D1%8B%D0%B9+%D0%BD%D0%BE%D0%BC%D0%B5%D1%80)&
id_food_type=1&

food_type=AI+(%D0%92%D1%81%D0%B5+%D0%B2%D0%BA%D0%BB%D1%8E%D1%87%D0%B5%D0%BD%D0%BE)&
flight_there_route=%D0%A1%D0%90%D0%9C%D0%90%D0%A0%D0%90-%D0%90%D0%9B%D0%90%D0%9D%D0%98%D0%AF&
flight_there_class=%D1%8D%D0%BA%D0%BE%D0%BD%D0%BE%D0%BC&
flight_there_number=ZFD2002&
start_fly=&
flight_there_id_transfer_type=1&
flight_there_transfer_type=%D0%B0%D0%B2%D0%B8%D0%B0&
flight_there_id_flight_type=1&
flight_there_flight_type=%D1%87%D0%B0%D1%80%D1%82%D0%B5%D1%80&
flight_back_route=%D0%90%D0%9B%D0%90%D0%9D%D0%98%D0%AF-%D0%9C%D0%9E%D0%A1%D0%9A%D0%92%D0%90&
flight_back_class=%D1%8D%D0%BA%D0%BE%D0%BD%D0%BE%D0%BC&
flight_back_number=ZGG-100&
end_fly=&

flight_class_id_transfer_type=1&
flight_class_transfer_type=%D0%B0%D0%B2%D0%B8%D0%B0&
flight_class_id_flight_type=1&
flight_class_flight_type=%D1%87%D0%B0%D1%80%D1%82%D0%B5%D1%80&
transfer_route=AIRPORT-HOTEL-AIRPORT&
transfer_type=%D0%B3%D1%80%D1%83%D0%BF%D0%BF%D0%BE%D0%B2%D0%BE%D0%B9&
transfer_view=%D0%B0%D0%B2%D1%82%D0%BE%D0%B1%D1%83%D1%81&

excursion%5Bname%5D%5B%5D=%D0%BD%D0%B5%D1%82&
service%5Bname%5D%5B%5D=%D0%BD%D0%B5%D1%82&
insurance%5Bname%5D%5B%5D=%D0%B4%D0%B0&
cost_client=234+000
*/

 $stack_error = array();  // общий массив ошибок

if((!isset($_POST['number_contract']))or(trim($_POST['number_contract'])=='')) { array_push($stack_error, "number_contract"); }

if((isset($_POST['number_contract']))and(trim($_POST['number_contract'])!='')) {
//27/06/2019 - 90
//или
//27/09/2020 - 80В
    $date_doc_ = explode("-", ht(trim($_POST['number_contract'])));
    $date_r = explode(" ", htmlspecialchars(trim($date_doc_[1])));
    $date_r1 = explode("/", htmlspecialchars(trim($date_doc_[0])));
    $stringx = trim($date_r[0]);
    $stringx = preg_replace('/[^0-9]/', '', $stringx);


    if(strpos($date_doc_[1], '/')!=false)
    {
        //недопустимое значение договора
        //  27/06/2019 - 90/2  - нельзя использовать
        array_push($stack_error, "number_contract_format");
    }

    $result_uu = mysql_time_query($link, 'select a.id from trips_contract as a,trips as b where a.id=b.id_contract and b.visible=1 and  a.id_a_company="' . ht($id_company) . '" and  a.number="' . ht($stringx) . '" and a.years="' . trim($date_r1[2]) . '"');
    $num_results_uu = $result_uu->num_rows;
    $number_d = 0;
    if ($num_results_uu != 0) {
        //значит такой номер договора по компании в этом году уже занят
        array_push($stack_error, "number_contract_busy");

        //определяем какой следующий точно свободен в этом году по этой компании


        $result_status2d = mysql_time_query($link, 'SELECT MAX(b.number) AS cc FROM trips_contract AS b,trips as a WHERE b.id_a_company="' . ht($id_company) . '" and a.visible=1 and a.id_contract=b.id and b.years="' . date('Y') . '"');
        //echo('SELECT a.* FROM r_status AS a WHERE a.numer_status="'.$row1ss["status"].'" and a.id_system=13');
        if ($result_status2d->num_rows != 0) {
            $row_status2d = mysqli_fetch_assoc($result_status2d);
            $number_d = (int)$row_status2d["cc"] + 1;
        }

    }
}

if((!isset($_POST['id_operator']))or(trim($_POST['id_operator'])=='')) { array_push($stack_error, "id_operator"); }
if((!isset($_POST['id_booking_sourse']))or(trim($_POST['id_booking_sourse'])=='')) { array_push($stack_error, "id_booking_sourse"); }
if((!isset($_POST['id_exchange']))or(trim($_POST['id_exchange'])=='')) { array_push($stack_error, "id_exchange"); }


$date_valid=0;
	if(!validateDate($_POST['date_sele_doc'],'Y-m-d'))    
	{
		   array_push($stack_error, "date_sele_doc"); 
		   $date_valid=1;
	}
	


if((!isset($_POST['buy_id']))or(trim($_POST['buy_id'])=='')or(!is_numeric($_POST['buy_id']))) { array_push($stack_error, "buy_id"); }
if((!isset($_POST['count_clients']))or(trim($_POST['count_clients'])=='')) { array_push($stack_error, "count_clients"); }

if((!isset($_POST['id_country']))or(trim($_POST['id_country'])=='')or(trim($_POST['id_country'])==0)) { array_push($stack_error, "id_country"); }

	if(!validateDate($_POST['date_start'],'d.m.Y'))    
	{
		   array_push($stack_error, "date_start"); 
		   $date_valid=1;
	}
	if(!validateDate($_POST['date_end'],'d.m.Y'))    
	{
		   array_push($stack_error, "date_end"); 
		   $date_valid=1;
	}

if((!isset($_POST['count_day']))or(trim($_POST['count_day'])=='')) { array_push($stack_error, "count_day"); }
if((!isset($_POST['hotel']))or(trim($_POST['hotel'])=='')) { array_push($stack_error, "hotel"); }
if((!isset($_POST['id_country']))or(trim($_POST['id_country'])=='')) { array_push($stack_error, "id_country"); }
if((!isset($_POST['flight_there_route']))or(trim($_POST['flight_there_route'])=='')) { array_push($stack_error, "flight_there_route"); }
if((!isset($_POST['flight_there_class']))or(trim($_POST['flight_there_class'])=='')) { array_push($stack_error, "flight_there_class"); }
if((!isset($_POST['flight_there_number']))or(trim($_POST['flight_there_number'])=='')) { array_push($stack_error, "flight_there_number"); }

if((!isset($_POST['flight_back_route']))or(trim($_POST['flight_back_route'])=='')) { array_push($stack_error, "flight_back_route"); }
if((!isset($_POST['flight_back_class']))or(trim($_POST['flight_back_class'])=='')) { array_push($stack_error, "flight_back_class"); }
if((!isset($_POST['flight_back_number']))or(trim($_POST['flight_back_number'])=='')) { array_push($stack_error, "flight_back_number"); }


if((!isset($_POST['transfer_route']))or(trim($_POST['transfer_route'])=='')) { array_push($stack_error, "transfer_route"); }
/*if((!isset($_POST['transfer_clas']))or(trim($_POST['transfer_class'])=='')) { array_push($stack_error, "transfer_class"); }
*/
if((!isset($_POST['transfer_type']))or(trim($_POST['transfer_type'])=='')) { array_push($stack_error, "transfer_type"); }

if((!isset($_POST['cost_client']))or(trim($_POST['cost_client'])=='')or(!is_numeric(trimc($_POST['cost_client'])))) { array_push($stack_error, "cost_client"); }	
//**************************************************
//**************************************************

//если тур не рублевый то курс ТО должен быть обязателен
$result_uu_ratett=mysql_time_query($link,'select a.char,a.small_name,a.code from booking_exchange as a  where a.id="'.ht($_POST["id_exchange"]).'"');
$num_results_uu_ratett = $result_uu_ratett->num_rows;

if($num_results_uu_ratett!=0) {
    $row_uu_ratett = mysqli_fetch_assoc($result_uu_ratett);
}

if ($row_uu_ratett["char"] != "₽") {
    if((!isset($_POST['exchange_rates']))or(trim($_POST['exchange_rates'])=='')or(trim($_POST['exchange_rates'])==0)or(!is_numeric(trimc($_POST['exchange_rates'])))) { array_push($stack_error, "exchange_rates"); }
}



//для покупателя организации проверки пока нет, если надо будет добавить сюда
if(($_POST["buy_type"]==2)and($_POST["buy_id"]!=''))
{

    $result_uu_fly=mysql_time_query($link,'select a.* from k_organization as a where a.id="'.ht($_POST["buy_id"]).'"');

    $num_results_uu_fly = $result_uu_fly->num_rows;

    if($num_results_uu_fly!=0) {
        $row_uu_fly = mysqli_fetch_assoc($result_uu_fly);
        if (($row_uu_fly["name"] == '') or ($row_uu_fly["head"] == '') or ($row_uu_fly["organ_face"] == '')or ($row_uu_fly["adress_post"] == '')or ($row_uu_fly["adress_ur"] == '')or ($row_uu_fly["contact_face"] == '')or ($row_uu_fly["phone_contact"] == '')or ($row_uu_fly["code_inn"] == '')or ($row_uu_fly["code_ogrn"] == '')or ($row_uu_fly["bank_rs"] == '')or ($row_uu_fly["bank_ks"] == '')or ($row_uu_fly["bank_bik"] == '')or ($row_uu_fly["bank_name"] == '')or ($row_uu_fly["email"] == '')or ($row_uu_fly["head"] == '')) {
            array_push($stack_error, "no_all_info_org");
        }

        $docx_org_name=$row_uu_fly["name"];
        $docx_org_face1=$row_uu_fly["head"];
        $docx_org_face=$row_uu_fly["organ_face"];
        $docx_org_adress_post=$row_uu_fly["adress_post"];
        $docx_org_adress_ur=$row_uu_fly["adress_ur"];
        $docx_org_contact=$row_uu_fly["contact_face"];
        $docx_org_contact_tel=$row_uu_fly["phone_contact"];
        $docx_org_inn=$row_uu_fly["code_inn"];
        $docx_org_ogrn=$row_uu_fly["code_ogrn"];
        $docx_org_rs=$row_uu_fly["bank_rs"];
        $docx_org_ks=$row_uu_fly["bank_ks"];
        $docx_org_bik=$row_uu_fly["bank_bik"];
        $docx_org_bank=$row_uu_fly["bank_name"];
        $docx_org_email=$row_uu_fly["email"];


        //проверка паспортных данных руководителя
        if (($row_uu_fly["face_address"] == '') or ($row_uu_fly["face_seria"] == '') or ($row_uu_fly["face_number"] == '')or ($row_uu_fly["face_kem"] == '')or ($row_uu_fly["face_kogda"] == '0000-00-00'))
        {
            array_push($stack_error, "no_all_info_rf_org");
        }

        $docx_org_rf=$row_uu_fly["face_seria"].' '.$row_uu_fly["face_number"].' выдан '.$row_uu_fly["face_kem"].' '.date_ex(0,$row_uu_fly["face_kogda"]);
        $docx_org_address=$row_uu_fly["face_address"];
        $docx_org_head=$row_uu_fly["head"];

    }



}
//проверим вдруг паспортные данные покупателя частного лица пустые
if(($_POST["buy_type"]==1)and($_POST["buy_id"]!=''))
{
	
  $sql_fly='';
  if((isset($_POST['password']))and($_POST['password']==1))	  
  {
	//заграничный
  $sql_fly=' inter_seria as seria,inter_number as number,inter_srok as kogda ';
  } else
  {
	//внутренний
  $sql_fly=' inner_seria as seria,inner_number as number,inner_kogda as kogda ';	
  }
	  
  $result_uu_fly=mysql_time_query($link,'select adress,phone,fio,email, date_birthday,  '.$sql_fly.' from k_clients where id="'.ht($_POST["buy_id"]).'"');

  $num_results_uu_fly = $result_uu_fly->num_rows;

   if($num_results_uu_fly!=0)
   {                 
	  $row_uu_fly = mysqli_fetch_assoc($result_uu_fly);
	  if(($row_uu_fly["number"]=='')or($row_uu_fly["seria"]=='')or($row_uu_fly["kogda"]==''))
	  {
		array_push($stack_error, "no_all_password_buy");  
	  }
	  if(($row_uu_fly["adress"]=='')or($row_uu_fly["phone"]==''))
	  {
		array_push($stack_error, "no_phone_tell_buy");  
	  }	 else
	  {
		  $docx_buy_name=$row_uu_fly["fio"];
		  $docx_buy_adress=$row_uu_fly["adress"];
		  $docx_buy_phone=$row_uu_fly["phone"];
		  $docx_buy_email=$row_uu_fly["email"];
		  
		  if($row_uu_fly["date_birthday"]!='0000-00-00')
		  {
		     $date_ex66=explode("-",ht($row_uu_fly["date_birthday"]));	
		     $docx_buy_birthday=$date_ex66[2].'.'.$date_ex66[1].'.'.$date_ex66[0];
		  }
	  }
   }	
	
	
$result_uu=mysql_time_query($link,'select inner_kem,inner_seria,inner_number from k_clients where id="'.ht($_POST["buy_id"]).'"');
   $num_results_uu = $result_uu->num_rows;

   if($num_results_uu!=0)
   {                 
	$row_uu = mysqli_fetch_assoc($result_uu);
	//данные внутреннего паспорта не задаты
	  if(($row_uu["inner_kem"]=='')or($row_uu["inner_seria"]=='')or($row_uu["inner_number"]==''))
	  {
			  array_push($stack_error, "no_all_password_x");
	  } else
	  {
		  $docx_fly_rf=$row_uu["inner_seria"].' '.$row_uu["inner_number"].' - '.$row_uu["inner_kem"];
	  }
	   
	   
   }
   	
	
	
}

$err_flyy=0;
if ( $_POST[ "fly_count" ] != 0 ) {
  $fly_kto = explode( ",", ht( $_POST[ "fly_id" ] ) );
  foreach ( $fly_kto as $key => $value ) {
	  
	    $sql_fly='';
  if((isset($_POST['password']))and($_POST['password']==1))	  
  {
	//заграничный
  $sql_fly=' inter_seria as seria,inter_number as number,inter_srok as kogda ';
  } else
  {
	//внутренний
  $sql_fly=' inner_seria as seria,inner_number as number,inner_kogda as kogda ';	
  }
	  
  $result_uu_fly=mysql_time_query($link,'select '.$sql_fly.' from k_clients where id="'.ht($value).'"');

  $num_results_uu_fly = $result_uu_fly->num_rows;

   if($num_results_uu_fly!=0)
   {                 
	  $row_uu_fly = mysqli_fetch_assoc($result_uu_fly);
	  if(($row_uu_fly["number"]=='')or($row_uu_fly["seria"]=='')or($row_uu_fly["kogda"]==''))
	  {
 
		  $err_flyy++;
	  }
   }
	  
  }
}
if($err_flyy!=0)
{
		array_push($stack_error, "no_all_password_fly"); 	
}


//print_r ($stack_error);
if(count($stack_error)!=0)
{
  goto end_code;
}

$status_ee='ok';



 $date_=date("y.m.d").' '.date("H:i:s");


//добавление номера договора umatravel
//27/06/2019 - 90
//или
//27/09/2020 - 80В
$date_doc_=explode("-",ht(trim($_POST['number_contract'])));
$date_r=explode(" ",htmlspecialchars(trim($date_doc_[1])));
$date_r1=explode("/",htmlspecialchars(trim($date_doc_[0])));

//setlocale("Russia_Russian");

$stringx=trim($date_r[0]);
$stringx = preg_replace('/[^0-9]/', '', $stringx);
$date_r[0]=$stringx;
mysql_time_query($link,'INSERT INTO trips_contract (id_a_company,years,number,name,date_doc,datetime,id_user) VALUES ("'.ht($id_company).'","'.htmlspecialchars(trim($date_r1[2])).'","'.htmlspecialchars(trim($date_r[0])).'","'.ht(trim($_POST['number_contract'])).'","'.ht($_POST["date_sele_doc"]).'","'.date("y.m.d").' '.date("H:i:s").'","'.$id_user.'")');

$IDOC=mysqli_insert_id($link); 	

//проверим в какой валюте тур
 $avans_rates=0;
$result_uu=mysql_time_query($link,'select a.char from booking_exchange as a  where a.id="'.ht($_POST["id_exchange"]).'"');
   $num_results_uu = $result_uu->num_rows;

   if($num_results_uu!=0)
   {                 
	$row_uu = mysqli_fetch_assoc($result_uu);
	   if($row_uu["char"]=="₽")
	   {
		   //тур рублевый и к валюте не привязан
		   $cost_client=trimc($_POST["cost_client"]);
           $cost_client_exchange=0;
           $exchange_rates=0;
		   $docx_rates='';
		    $docx_rates1='';
		    $docx_rates2='';
		   //$
		   if (( $_POST[ "avans_client" ] != 0 )and( $_POST[ "avans_client" ] != '' )) {
		   
		   $docx_rates3=number_format(((float)trimc($_POST["cost_client"])-(float)trimc($_POST[ "avans_client" ])), 2, '.', ' ').' РУБ';
			   
		   } else
		   {
			$docx_rates3=number_format(((float)trimc($_POST["cost_client"])), 2, '.', ' ').' РУБ';
		   }


	   } else
	   {
		   $cost_client=trimc($_POST["cost_client"]);
		   $exchange_rates=$_POST["exchange_rates"];
		   $cost_client_exchange=number_format(((float)$cost_client/(float)$exchange_rates), 2, '.', '');
		   
		   
		   $date_extt=explode("-",htmlspecialchars(trim($_POST["date_sele_doc"])));	
$date_extt=$date_extt[2].'.'.$date_extt[1].'.'.$date_extt[0];
		   
		   $docx_rates='('.number_format(((float)$cost_client/(float)$exchange_rates), 2, '.', ' ').''.$row_uu["char"].', по курсу '.$_POST["exchange_rates"].' на '.$date_extt.')';
		   
		   
		   if (( $_POST[ "avans_client" ] != 0 )and( $_POST[ "avans_client" ] != '' )) {
			   $avans_rates=number_format(((float)trimc($_POST[ "avans_client" ])/(float)$exchange_rates), 2, '.', '');
			   
			   $docx_rates1='('.number_format(((float)trimc($_POST[ "avans_client" ])/(float)$exchange_rates), 2, '.', ' ').''.$row_uu["char"].', по курсу '.$_POST["exchange_rates"].' на '.$date_extt.')';
			   
			   $docx_rates2='('.number_format((((float)trimc($_POST["cost_client"])-(float)trimc($_POST[ "avans_client" ]))/(float)$exchange_rates), 2, '.', ' ').''.$row_uu["char"].', по курсу '.$_POST["exchange_rates"].' на '.$date_extt.')';
			   
			   $docx_rates3=number_format((((float)trimc($_POST["cost_client"])-(float)trimc($_POST[ "avans_client" ]))/(float)$exchange_rates), 2, '.', ' ').''.$row_uu["char"].', сумма в рублях высчитывается по официальному курсу туроператора на момент окончательной оплаты';
			   
			   
		   } else
		   {
			   $docx_rates1='(0'.$row_uu["char"].', по курсу '.$_POST["exchange_rates"].' на '.$date_extt.')';
			   
			   $docx_rates2=$docx_rates;
			   $docx_rates3=number_format(((float)trimc($_POST["cost_client"])), 2, '.', ' ').' '.$row_uu["char"].', сумма в рублях высчитывается по официальному курсу туроператора на момент окончательной оплаты';
			   
		   }
	   }
   }

//дата начала тура
$date_ex=explode(".",htmlspecialchars(trim($_POST["date_start"])));	
$date_start=$date_ex[2].'-'.$date_ex[1].'-'.$date_ex[0];
//дата окончания тура
$date_ex=explode(".",htmlspecialchars(trim($_POST["date_end"])));	
$date_end=$date_ex[2].'-'.$date_ex[1].'-'.$date_ex[0];

$date_start_race='0000-00-00';
$date_end_race='0000-00-00';
//дата заезда в отель
if(validateDate($_POST['start_zae'],'d.m.Y')) {

    $date_start_race=date_ex(1,$_POST['start_zae']);

}
//дата выезда из отеля
if(validateDate($_POST['end_zae'],'d.m.Y')) {

    $date_end_race=date_ex(1,$_POST['end_zae']);

}



//дата последнего срока оплаты если не вся сумма отдается
$end_date_buy='';
$buy_client=0;
if(validateDate($_POST['avans_end_date'],'d.m.Y')) {

    if((trimc($_POST["avans_client"])!='')and(trimc($_POST["cost_client"])!='')and(trimc($_POST["cost_client"])!=0)and(trimc($_POST["avans_client"])!=trimc($_POST["cost_client"]))) {

        $date_end1e = explode(".", ht($_POST['avans_end_date']));
        $end_date_buy = $date_end1e[2].'.'.$date_end1e[1].'.'.$date_end1e[0];

    }
}
if((trimc($_POST["avans_client"])!='')and(trimc($_POST["cost_client"])!='')and(trimc($_POST["cost_client"])!=0)and(trimc($_POST["avans_client"])==trimc($_POST["cost_client"]))) {
    $buy_client=1;
}


//увеличиваем страну на один для статистики и вывода популярных в которую тур регистрируется
mysql_time_query($link, 'update trips_country set eye = eye+1 where id ="' . ht($_POST['id_country']) . '"');


$preorders=0;
if(($_POST["id_preorders"]!=0)and($_POST["id_preorders"]!=''))
{

    $result_url1=mysql_time_query($link,'select A.id,A.status,A.id_user,B.name from preorders as A,preorders_status as B where B.number=A.status and B.id_company="'.$id_company.'" and A.id="'.ht($_POST["id_preorders"]).'" and A.id_company="'.$id_company.'" and A.id_user="'.$id_user.'"');
    $num_results_custom_url1 = $result_url1->num_rows;
    if($num_results_custom_url1!=0) {
        $row_list222 = mysqli_fetch_assoc($result_url1);
        $preorders=ht($_POST["id_preorders"]);


        $st_old12=$row_list222["name"];
        $reason=0;
        mysql_time_query($link, 'update preorders set
    
    status="5",
    id_reasons="0"
    
    where id = "' . ht($_POST["id_preorders"]) . '"');


        //заносим историю по туру
        mysql_time_query($link,'INSERT INTO preorders_status_history_new (id_preorder,action_history,id_user,datetimes,edit,comment,comment_sys) VALUES ("'.ht($_POST["id_preorders"]).'","7","'.ht($id_user).'","'.date("y.m.d").' '.date("H:i:s").'","0","Изменение статуса обращения → c \"'.$st_old12.'\" на \"Оформлен договор\"","")');





    }
}


//добавление нового тура в базу
mysql_time_query($link,'INSERT INTO trips (
                          
id_user,    
id_a_company,                           
datecreate,                                    
id_booking_sourse,          
shopper,                 
id_shopper,     
id_exchange,                                 
id_booking,                   
id_operator,                       
id_contract,                                
comment,                                                 
passport,                                  
cost_client,            
cost_client_exchange,  
exchange_rates, 
cost_operator,               
cost_operator_exchange,
exchange_rates_operator,
paid_client,
paid_client_rates,                 
discount,           
commission,          
number_to,          
id_why_annulation,         
doc,    
status,    
hotel,        
id_room_type,                         
room_type,                                          
id_room_category,                     
room_category,                         
id_food_type,                         
food_type,                                     
date_start,                
date_end, 
date_start_race,
date_end_race,                 
id_country,                          
place_name,                 
count_people,                   
count_day,                            
transfer_route,    
transfer_type,            
transfer_view,    
flight_there_route,           
flight_there_number,                  
flight_there_class,    
flight_there_id_transfer_type,  
flight_there_transfer_type,     
flight_there_id_flight_type, 
flight_there_flight_type,         
flight_back_route,           
flight_back_number,                              
flight_back_class,                  
flight_class_id_transfer_type, 
flight_class_transfer_type,              
flight_class_id_flight_type,  
flight_class_flight_type,                        
visible,
date_prepaid,
buy_clients,
buy_operator,
date_buy_all
                                                                                
) VALUES( 

"'.ht($id_user).'",
"'.ht($id_company).'",
"'.ht($date_).'",
"'.ht($_POST["id_booking_sourse"]).'",
"'.ht($_POST["buy_type"]).'",
"'.ht($_POST["buy_id"]).'",
"'.ht($_POST["id_exchange"]).'",
"'.$preorders.'",
"'.ht($_POST["id_operator"]).'",
"'.$IDOC.'",
"",
"'.ht($_POST["password"]).'",
"'.ht($cost_client).'",
"'.ht($cost_client_exchange).'",
"'.ht($exchange_rates).'",
"0",
"0",
"0",
"0",
"0",
"0",
"0",
"'.ht($_POST["turoper_booking"]).'",
"0",
"0000-00-00",
"1",
"'.ht($_POST["hotel"]).'",
"'.ht($_POST["id_room_type"]).'",
"'.ht($_POST["room_type"]).'",
"'.ht($_POST["id_room_category"]).'",
"'.ht($_POST["room_category"]).'",
"'.ht($_POST["id_food_type"]).'",
"'.ht($_POST["food_type"]).'",
"'.$date_start.'",
"'.$date_end.'",
"'.$date_start_race.'",
"'.$date_end_race.'",
"'.ht($_POST["id_country"]).'",
"'.ht($_POST["place_name"]).'",
"'.ht($_POST["count_clients"]).'",
"'.ht($_POST["count_day"]).'",
"'.ht($_POST["transfer_route"]).'",
"'.ht($_POST["transfer_type"]).'",
"'.ht($_POST["transfer_view"]).'",
"'.ht($_POST["flight_there_route"]).'",
"'.ht($_POST["flight_there_number"]).'",
"'.ht($_POST["flight_there_class"]).'",
"'.ht($_POST["flight_there_id_transfer_type"]).'",
"'.ht($_POST["flight_there_transfer_type"]).'",
"'.ht($_POST["flight_there_id_flight_type"]).'",
"'.ht($_POST["flight_there_flight_type"]).'",
"'.ht($_POST["flight_back_route"]).'",
"'.ht($_POST["flight_back_number"]).'",
"'.ht($_POST["flight_back_class"]).'",
"'.ht($_POST["flight_class_id_transfer_type"]).'",
"'.ht($_POST["flight_class_transfer_type"]).'",
"'.ht($_POST["flight_class_id_flight_type"]).'",
"'.ht($_POST["flight_class_flight_type"]).'",
"1","0000-00-00","'.$buy_client.'","0","0000-00-00 00:00:00")');

$new_id_trips=mysqli_insert_id($link);


if($preorders!=0)
{
    $name_book=info_trips($new_id_trips,$link);

    mysql_time_query($link,'INSERT INTO preorders_status_history_new (id_preorder,action_history,id_user,datetimes,edit,comment,comment_sys) VALUES ("'.ht($_POST["id_preorders"]).'","8","'.ht($id_user).'","'.date("y.m.d").' '.date("H:i:s").'","0","Оформлен договор по туру <a class=\"preorders-a\" href=\"tours/.id-'.$new_id_trips.'\"><strong>'.$name_book.'</strong></a>","")');

}


//сроки по оплате если это авансовая оплата
if(validateDate($_POST['avans_end_date'],'d.m.Y')) {

    if((trimc($_POST["avans_client"])!='')and(trimc($_POST["cost_client"])!='')and(trimc($_POST["cost_client"])!=0)and(trimc($_POST["avans_client"])!=trimc($_POST["cost_client"]))) {


        mysql_time_query($link, 'INSERT INTO trips_payment_term(id_trips,type,proc,date,visible) 
VALUES( 
        "' . ht($new_id_trips) . '",
        "0",
        "100",
        "'.ht(date_ex(1,$_POST['avans_end_date'])).'",
        "1"
        )');





    }
}



//заносим туристов которые летят по этому туру

$docx_fly_kto=[];
$index_m=0;
if ( $_POST[ "fly_count" ] != 0 ) {
  $fly_kto = explode( ",", ht( $_POST[ "fly_id" ] ) );
  foreach ( $fly_kto as $key => $value ) {

    mysql_time_query( $link, 'INSERT INTO trips_clients_fly(id_trips,id_k_clients) VALUES( 
"' . ht( $new_id_trips ) . '","' . ht( $value ) . '")' );

$sql_fly='';
if((isset($_POST['password']))and($_POST['password']==1))	  
{
$sql_fly=', inter_seria as seria,inter_number as number,inter_srok as kogda ';
} else
{
$sql_fly=', inner_seria as seria,inner_number as number,inner_kogda as kogda ';	
}
	  
$result_uu_fly=mysql_time_query($link,'select latin,pol,date_birthday '.$sql_fly.' from k_clients where id="'.ht( $value ).'"');

$num_results_uu_fly = $result_uu_fly->num_rows;

   if($num_results_uu_fly!=0)
   {                 
	$row_uu_fly = mysqli_fetch_assoc($result_uu_fly);
   
      $pol='MR';
	  if($row_uu_fly['pol']==2)
	  {
		  $pol='MRS';
	  }
	   
	   $birthday='';
		if(validateDate($row_uu_fly['date_birthday'],'Y-m-d'))    
	{
       $date_end1=explode("-",ht($row_uu_fly['date_birthday']));	
       $birthday=$date_end1[2].'.'.$date_end1[1].'.'.$date_end1[0];
	}
 
	   $do='';
		if(validateDate($row_uu_fly['kogda'],'Y-m-d'))    
	{
       $date_end12=explode("-",ht($row_uu_fly['kogda']));	
       $do=$date_end12[2].'.'.$date_end12[1].'.'.$date_end12[0];
	}	   
	   
	  
	     $docx_fly_kto[$index_m]['LATIN_FIO']= $row_uu_fly['latin'];
	     $docx_fly_kto[$index_m]['MRS']=$pol;
		 $docx_fly_kto[$index_m]['DATE_BIRTHDAY']=$birthday;
	   
	   if((isset($_POST['password']))and($_POST['password']==1))	  
{
	   
		 $docx_fly_kto[$index_m]['password_fly']=$row_uu_fly['seria'].' '.$row_uu_fly['number'].' до '.$do;
			 
	   } else
	   {
		 $docx_fly_kto[$index_m]['password_fly']=$row_uu_fly['seria'].' '.$row_uu_fly['number'].' выдан '.$do;  
	   }
			 
	     $index_m++;
   }
  }
}
	if(validateDate(htmlspecialchars(trim($_POST['start_fly'])),'d.m.Y H:i'))
	{
//изменения данных по предложению
$date_start=explode(" ",htmlspecialchars(trim($_POST['start_fly'])));
$date_start1=explode(".",htmlspecialchars(trim($date_start[0])));
$startx=$date_start1[2].'-'.$date_start1[1].'-'.$date_start1[0].' '.$date_start[1].':00';	
	} else
	{
		$startx='0000-00-00';
	}
	
	if(validateDate(htmlspecialchars(trim($_POST['end_fly'])),'d.m.Y H:i'))
	{
$date_end=explode(" ",htmlspecialchars(trim($_POST['end_fly'])));
$date_end1=explode(".",htmlspecialchars(trim($date_end[0])));		
$endx=$date_end1[2].'-'.$date_end1[1].'-'.$date_end1[0].' '.$date_end[1].':00';	
	} else
	{
		$endx='0000-00-00';
	}

//02/01/2020
if(validateDate(htmlspecialchars(trim($_POST['avans_end_date'])),'d.m.Y'))
{
    $date_end=explode(".",htmlspecialchars(trim($_POST['avans_end_date'])));

    $docx_end_cost='Полная оплата до '.$date_end[0].'/'.$date_end[1].'/'.$date_end[2];
} else
{
    $docx_end_cost='-';
}

//заносим время вылетов и прилета в историю вылетов по туру
mysql_time_query($link,'INSERT INTO trips_fly_history (id_trips,start_fly,end_fly,datetime,id_user) VALUES ("' . ht( $new_id_trips ) . '","'.htmlspecialchars($startx).'","'.htmlspecialchars($endx).'","'.date("y.m.d").' '.date("H:i:s").'","'.$id_user.'")');



//заносим оплату по туру аванс
if (( $_POST[ "avans_client" ] != 0 )and( $_POST[ "avans_client" ] != '' )) {


	$medhod=2;
    if(($_POST["buy_type"]==2)and($_POST["buy_id"]!='')) {

        $medhod=1;

    }
	
	    mysql_time_query( $link, 'INSERT INTO trips_payment(
                          
id_trips,                                            
id_user,                                 
who,         
id_operation,              
id_payment_method,                 
sum,  
sum_rate,                                        
rate,                                             
perc_commission,   
commission,                                     
comment,                                           
date_payment,                                           
date_create,                                                      
visible) VALUES( 

"' . ht( $new_id_trips ) . '",
"' . ht( $id_user ) . '",
"0",
"1",
"'.$medhod.'",
"'.ht(trimc($_POST["avans_client"])).'",
"'.ht($avans_rates).'",
"'.ht($exchange_rates).'",
"0",
"0",
"Аванс",
"'.date("y.m.d").'",
"'.ht($date_).'",
"1")' );





}

$paid_client=$_POST["avans_client"];   //Сколько оплатил в рублях клиент
$paid_client_rates=$avans_rates;       //сколько оплатил в валюте клиент




//изменяем общую оплату в туре за тур

mysql_time_query($link,'update trips set

paid_client="'.ht(trimc($paid_client)).'",
paid_client_rates="'.ht($paid_client_rates).'"

where id = "'.ht($new_id_trips).'"');



//определяем если есть сроки оплаты какие части стали оплачены а какие наоборот перестали быть
//определяем если есть сроки оплаты какие части стали оплачены а какие наоборот перестали быть
//|
//V
//-> клиент -> оператор
$trips_call=$new_id_trips;
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





//узнаем откуда узнал об этом
$result_uu=mysql_time_query($link,'select name from booking_sourse where id="'.ht($_POST["id_booking_sourse"]).'"');
   $num_results_uu = $result_uu->num_rows;

   if($num_results_uu!=0)
   {                 
	$row_uu = mysqli_fetch_assoc($result_uu);
	$docx_fly_sourse= $row_uu["name"]; 
   }

//страна куда летит
$result_uu=mysql_time_query($link,'select name from trips_country where id="'.ht($_POST["id_country"]).'"');
   $num_results_uu = $result_uu->num_rows;

   if($num_results_uu!=0)
   {                 
	$row_uu = mysqli_fetch_assoc($result_uu);
	$docx_fly_country= $row_uu["name"]; 
   }


$docx_food='';
//тип питания
if(isset($_POST["id_food_type"]))
{
	
   $result_uu=mysql_time_query($link,'select name from trips_food_type where id="'.ht($_POST["id_food_type"]).'"');
   $num_results_uu = $result_uu->num_rows;

   if($num_results_uu!=0)
   {                 
	$row_uu = mysqli_fetch_assoc($result_uu);
	//$docx_fly_country= $row_uu["name"]; 
	   
	   if((isset($_POST["food_type"]))and($row_uu["name"]!=$_POST["food_type"]))
	   {
		   $docx_food= $_POST["food_type"]; 
	   } else
	   {
		  $docx_food= $row_uu["name"];  
	   }
   }
	
}


$docx_room='';	
//тип питания
if(isset($_POST["id_room_category"]))
{
	
   $result_uu=mysql_time_query($link,'select name from trips_room_type where id="'.ht($_POST["id_room_category"]).'"');
   $num_results_uu = $result_uu->num_rows;

   if($num_results_uu!=0)
   {                 
	$row_uu = mysqli_fetch_assoc($result_uu);
	//$docx_fly_country= $row_uu["name"]; 
	   
	   if((isset($_POST["room_category"]))and($row_uu["name"]!=$_POST["room_category"]))
	   {
		   $docx_room = $_POST["room_category"]; 
	   } else
	   {
		  $docx_room = $row_uu["name"];  
	   }
   }
	
}


//добавляем экскурсии если они есть
$excursion=$_POST['excursion'];
$docx_excursion= array() ;
for ($i = 0; $i < (count($excursion['name'])); $i++){
	
	if((ht($excursion['name'][$i])!='')and(ht($excursion['name'][$i])!='нет'))
	{	
	$docx_excursion[] =$excursion['name'][$i];
		
      mysql_time_query($link,'INSERT INTO trips_excursion (id_trips,name) VALUES ("'. ht( $new_id_trips ).'","'.ht($excursion['name'][$i]).'")');
		
	}
	
}
//добавляем страховок если они есть
$insurance=$_POST['insurance'];
$docx_insurance= array() ;
for ($i = 0; $i < (count($insurance['name'])); $i++){
	
	if((ht($insurance['name'][$i])!='')and(ht($insurance['name'][$i])!='нет'))
	{	
	$docx_insurance[] =$insurance['name'][$i];
		
      mysql_time_query($link,'INSERT INTO trips_insurance (id_trips,name) VALUES ("'. ht( $new_id_trips ).'","'.ht($insurance['name'][$i]).'")');
		
	}
	
}


//добавляем дополнительных услуг
$service=$_POST['service'];
$docx_service= array() ;
for ($i = 0; $i < (count($service['name'])); $i++){
	
	if((ht($service['name'][$i])!='')and(ht($service['name'][$i])!='нет'))
	{	
	$docx_service[] =$service['name'][$i];
		
      mysql_time_query($link,'INSERT INTO trips_service (id_trips,name) VALUES ("'. ht( $new_id_trips ).'","'.ht($service['name'][$i]).'")');
		
	}
	
}


//делаем документы doc договор
//require_once $url_system.'library/PhpWord/PHPWord.php';

require $url_system.'vendor/autoload.php';


if($_POST["buy_type"]==1) {
    $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($url_system . 'doc/template/temp_doc1.docx');
} else
{
    $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($url_system . 'doc/template/org_temp_doc1.docx');
}

if($_POST["buy_type"]==2) {
    //для организации
    $templateProcessor->setValue('firm_name', $docx_org_name);
    $templateProcessor->setValue('firm_face', $docx_org_face);

    $templateProcessor->setValue('firm_inn', $docx_org_inn);
    $templateProcessor->setValue('firm_ogrnip', $docx_org_ogrn);
    $templateProcessor->setValue('firm_rs', $docx_org_rs);
    $templateProcessor->setValue('firm_ks', $docx_org_ks);
    $templateProcessor->setValue('firm_bik', $docx_org_bik);
    $templateProcessor->setValue('firm_bank', $docx_org_bank);
    $templateProcessor->setValue('firm_uradress', $docx_org_adress_ur);
    $templateProcessor->setValue('firm_poct', $docx_org_adress_post);
    $templateProcessor->setValue('firm_tel', $docx_org_contact_tel);
    $templateProcessor->setValue('firm_email', $docx_org_email);
}


$templateProcessor->setValue('flight_there_route', $_POST['flight_there_route']);
$templateProcessor->setValue('flight_there_class', $_POST['flight_there_class']);
$templateProcessor->setValue('flight_there_number', $_POST['flight_there_number']);
$templateProcessor->setValue('start_fly', $_POST['start_fly']);

$templateProcessor->setValue('flight_back_route', $_POST['flight_back_route']);
$templateProcessor->setValue('flight_back_class', $_POST['flight_back_class']);
$templateProcessor->setValue('flight_back_number', $_POST['flight_back_number']);
$templateProcessor->setValue('end_fly',  $_POST['end_fly']);

$templateProcessor->setValue('fly_name', $docx_buy_name);
$templateProcessor->setValue('fly_birthday', $docx_buy_birthday);
$templateProcessor->setValue('FLY_NAME', $docx_buy_name);
$templateProcessor->setValue('FLY_ADRESS', $docx_buy_adress);
$templateProcessor->setValue('fly_phone', $docx_buy_phone);
$templateProcessor->setValue('fly_email', $docx_buy_email);
$templateProcessor->setValue('FLY_SOURSE', $docx_fly_sourse);

$templateProcessor->setValue('place_name', $_POST['place_name']);
$templateProcessor->setValue('country_name', $docx_fly_country);

$templateProcessor->setValue('date_start', $_POST['date_start']);
$templateProcessor->setValue('date_end',$_POST['date_end']);

$templateProcessor->setValue('TRANSFER_ROUTE', $_POST['transfer_route']);
$templateProcessor->setValue('TRANSFER_TYPE', $_POST['transfer_type']);
$templateProcessor->setValue('hotel', $_POST['hotel']);

$templateProcessor->setValue('booking',$_POST['turoper_booking']);
$templateProcessor->setValue('end_cost',$docx_end_cost);

$templateProcessor->setValue('count_clients', $_POST['count_clients'].' '. PadejNumber($_POST['count_clients'],'человек,человека,человек'));

$templateProcessor->setValue('room', $docx_room);
$templateProcessor->setValue('food', $docx_food);

$templateProcessor->setValue('RF', $docx_fly_rf);


//прикрепляем файл туроператора и склеиваем их



//стоимость тура заносим в базу
//cost_client
//exchange_rates - курс
//avans_client - аванс

$docx_cost='';
$docx_cost_text='';

if((isset($_POST["cost_client"]))and($_POST["cost_client"]!=''))
{
	$docx_cost=rtrim(rtrim(number_format((float)trimc($_POST["cost_client"]), 2, '.', ' '),'0'),'.').' ';
	$docx_cost_text=num2str((float)trimc($_POST["cost_client"]));
}

$templateProcessor->setValue('x_cost', $docx_cost);
$templateProcessor->setValue('X_COST_TEXT', $docx_cost_text);

//авансы
$docx_avans=0;
$docx_avans_text='0 РУБ 00 КОП ';

if((isset($_POST["avans_client"]))and($_POST["avans_client"]!='')and($_POST["avans_client"]!=0))
{
	$docx_avans=rtrim(rtrim(number_format((float)trimc($_POST["avans_client"]), 2, '.', ' '),'0'),'.');
	$docx_avans_text=num2str((float)trimc($_POST["avans_client"]));
}

$templateProcessor->setValue('x_avans', $docx_avans);
$templateProcessor->setValue('X_AVANS_TEXT', $docx_avans_text);

//доплатить
$docx_dop=$docx_cost;
$docx_dop_text=$docx_cost_text;
if((isset($_POST["avans_client"]))and($_POST["avans_client"]!='')and($_POST["avans_client"]!=0))
{
	$docx_dop=rtrim(rtrim(number_format(((float)trimc($_POST["cost_client"])-(float)trimc($_POST["avans_client"])), 2, '.', ' '),'0'),'.');
	$docx_dop_text=num2str(((float)trimc($_POST["cost_client"])-(float)trimc($_POST["avans_client"])));
}

$templateProcessor->setValue('x_dop', $docx_dop);
$templateProcessor->setValue('X_DOP_TEXT', $docx_dop_text);


$templateProcessor->setValue('rates', $docx_rates);
$templateProcessor->setValue('rates1', $docx_rates1);
$templateProcessor->setValue('rates2', $docx_rates2);
$templateProcessor->setValue('rates3', $docx_rates3);

$templateProcessor->setValue('number_contract', $_POST['number_contract']);
if(isset($date_r[0]))
{
  $templateProcessor->setValue('number', $date_r[0]);
}
$templateProcessor->cloneRowAndSetValues('LATIN_FIO', $docx_fly_kto);
	
if(isset($_POST["doc_date"]))
{
 $date_rtyy=explode(" ",htmlspecialchars(trim($_POST["doc_date"])));
	$date=$date_rtyy[1].' '.$date_rtyy[2];
	$day=$date_rtyy[0];
	$templateProcessor->setValue('date', $date);
	$templateProcessor->setValue('day', $day);
}
//экскурсии
if(count($docx_excursion)!=0)
{
$templateProcessor->cloneRow('excursion', count($docx_excursion));	
foreach ( $docx_excursion as $key => $value ) {
   $templateProcessor->setValue('excursion#'.($key+1), $value);
}
	
} else
{
  $templateProcessor->setValue('excursion','______________________________________________________________________________________________');
}
//страховки
if(count($docx_insurance)!=0)
{
$templateProcessor->cloneRow('insurance', count($docx_insurance));	
foreach ( $docx_insurance as $key => $value ) {
   $templateProcessor->setValue('insurance#'.($key+1), $value);
}
	
} else
{
  $templateProcessor->setValue('insurance','______________________________________________________________________________________________');
}

//услуги
if(count($docx_service)!=0)
{
$templateProcessor->cloneRow('service', count($docx_service));	
foreach ( $docx_service as $key => $value ) {
   $templateProcessor->setValue('service#'.($key+1), $value);
}
	
} else
{
  $templateProcessor->setValue('service','______________________________________________________________________________________________');
}

$templateProcessor->saveAs($url_system.'tours/doc/intermediate/'.$IDOC.'_template1.docx');

if($_POST["buy_type"]==1) {
    $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($url_system . 'doc/template/temp_doc3.docx');
} else
{
    $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($url_system . 'doc/template/org_temp_doc3.docx');
}

if($_POST["buy_type"]==2) {

//для организации
$templateProcessor->setValue('fio_org', $docx_org_head);
$templateProcessor->setValue('address_org', $docx_org_address);
$templateProcessor->setValue('rf_org', $docx_org_rf);

}


$templateProcessor->setValue('flight_there_route', $_POST['flight_there_route']);
$templateProcessor->setValue('flight_there_class', $_POST['flight_there_class']);
$templateProcessor->setValue('flight_there_number', $_POST['flight_there_number']);
$templateProcessor->setValue('start_fly', $_POST['start_fly']);

$templateProcessor->setValue('flight_back_route', $_POST['flight_back_route']);
$templateProcessor->setValue('flight_back_class', $_POST['flight_back_class']);
$templateProcessor->setValue('flight_back_number', $_POST['flight_back_number']);
$templateProcessor->setValue('end_fly',  $_POST['end_fly']);

$templateProcessor->setValue('fly_name', $docx_buy_name);
$templateProcessor->setValue('fly_birthday', $docx_buy_birthday);
$templateProcessor->setValue('FLY_NAME', $docx_buy_name);
$templateProcessor->setValue('FLY_ADRESS', $docx_buy_adress);
$templateProcessor->setValue('fly_phone', $docx_buy_phone);
$templateProcessor->setValue('fly_email', $docx_buy_email);
$templateProcessor->setValue('FLY_SOURSE', $docx_fly_sourse);

$templateProcessor->setValue('place_name', $_POST['place_name']);
$templateProcessor->setValue('country_name', $docx_fly_country);

$templateProcessor->setValue('date_start', $_POST['date_start']);
$templateProcessor->setValue('date_end',$_POST['date_end']);

$templateProcessor->setValue('TRANSFER_ROUTE', $_POST['transfer_route']);
$templateProcessor->setValue('TRANSFER_TYPE', $_POST['transfer_type']);
$templateProcessor->setValue('hotel', $_POST['hotel']);

$templateProcessor->setValue('booking',$_POST['turoper_booking']);
$templateProcessor->setValue('end_cost',$docx_end_cost);

$templateProcessor->setValue('count_clients', $_POST['count_clients'].' '. PadejNumber($_POST['count_clients'],'человек,человека,человек'));

$templateProcessor->setValue('room', $docx_room);
$templateProcessor->setValue('food', $docx_food);

$templateProcessor->setValue('RF', $docx_fly_rf);


//прикрепляем файл туроператора и склеиваем их



//стоимость тура заносим в базу
//cost_client
//exchange_rates - курс
//avans_client - аванс

$docx_cost='';
$docx_cost_text='';

if((isset($_POST["cost_client"]))and($_POST["cost_client"]!=''))
{
    $docx_cost=rtrim(rtrim(number_format((float)trimc($_POST["cost_client"]), 2, '.', ' '),'0'),'.').' ';
    $docx_cost_text=num2str((float)trimc($_POST["cost_client"]));
}

$templateProcessor->setValue('x_cost', $docx_cost);
$templateProcessor->setValue('X_COST_TEXT', $docx_cost_text);

//авансы
$docx_avans=0;
$docx_avans_text='0 РУБ 00 КОП ';

if((isset($_POST["avans_client"]))and($_POST["avans_client"]!='')and($_POST["avans_client"]!=0))
{
    $docx_avans=rtrim(rtrim(number_format((float)trimc($_POST["avans_client"]), 2, '.', ' '),'0'),'.');
    $docx_avans_text=num2str((float)trimc($_POST["avans_client"]));
}

$templateProcessor->setValue('x_avans', $docx_avans);
$templateProcessor->setValue('X_AVANS_TEXT', $docx_avans_text);

//доплатить
$docx_dop=$docx_cost;
$docx_dop_text=$docx_cost_text;
if((isset($_POST["avans_client"]))and($_POST["avans_client"]!='')and($_POST["avans_client"]!=0))
{
    $docx_dop=rtrim(rtrim(number_format(((float)trimc($_POST["cost_client"])-(float)trimc($_POST["avans_client"])), 2, '.', ' '),'0'),'.');
    $docx_dop_text=num2str(((float)trimc($_POST["cost_client"])-(float)trimc($_POST["avans_client"])));
}

$templateProcessor->setValue('x_dop', $docx_dop);
$templateProcessor->setValue('X_DOP_TEXT', $docx_dop_text);


$templateProcessor->setValue('rates', $docx_rates);
$templateProcessor->setValue('rates1', $docx_rates1);
$templateProcessor->setValue('rates2', $docx_rates2);
$templateProcessor->setValue('rates3', $docx_rates3);

$templateProcessor->setValue('number_contract', $_POST['number_contract']);
if(isset($date_r[0]))
{
    $templateProcessor->setValue('number', $date_r[0]);
}

if(isset($_POST["doc_date"]))
{
    $date_rtyy=explode(" ",htmlspecialchars(trim($_POST["doc_date"])));
    $date=$date_rtyy[1].' '.$date_rtyy[2];
    $day=$date_rtyy[0];
    $templateProcessor->setValue('date', $date);
    $templateProcessor->setValue('day', $day);
}

$templateProcessor->saveAs($url_system.'tours/doc/intermediate/'.$IDOC.'_template3.docx');




//добавить версию к этому договору
$datse_=date("Y-m-d").' '.date("H:i:s");
mysql_time_query($link,'INSERT INTO trips_contract_version (id_trips_contract,id_user,date_create) VALUES (
'.$IDOC.',
'.ht($id_user).',
"'.$datse_.'")');

$new_id_version=mysqli_insert_id($link);



//смотрим есть ли шаблон у этого оператора чтобы добавить в договор
$result_6 = mysql_time_query($link,'select A.* from image_attach as A WHERE A.for_what="6" and A.visible=1 and A.id_object="'.ht($_POST["id_operator"]).'"');

$num_results_uu = $result_6->num_rows;
$flag_t_oper=0;
if($num_results_uu!=0)
{
    $row_6 = mysqli_fetch_assoc($result_6);
    $file_template_operator='upload/file/'.$row_6["id"].'_'.$row_6["name"].'.'.$row_6["type"].'';
    $flag_t_oper=1;
}


use DocxMerge\DocxMerge;

$dm = new DocxMerge();
if($flag_t_oper==1) {
    $dm->merge([
        $url_system . 'tours/doc/intermediate/'.$IDOC.'_template1.docx',
        $url_system . $file_template_operator,
        $url_system . 'tours/doc/intermediate/'.$IDOC.'_template3.docx'
    ], $url_system . "tours/doc/doc-".$IDOC."_".$new_id_version.".docx");

    chmod($url_system . "tours/doc/doc-".$IDOC."_".$new_id_version.".docx", 0644);

} else
{
    $dm->merge([
        $url_system . 'tours/doc/intermediate/'.$IDOC.'_template1.docx',
        $url_system . 'tours/doc/intermediate/'.$IDOC.'_template3.docx'
    ], $url_system . "tours/doc/doc-".$IDOC."_".$new_id_version.".docx");
    chmod($url_system . "tours/doc/doc-".$IDOC."_".$new_id_version.".docx", 0644);
}


$download='<span class="doc_add_number"><a class="ioo" href="'.$base_usr.'/tours/doc/doc-'.$IDOC.'_'.$new_id_version.'.docx">Договор №'.ht(trim($_POST['number_contract'])).'</a></span>';



//удалить промежуточные шаблоны
$uploadfile = $_SERVER["DOCUMENT_ROOT"].'/tours/doc/intermediate/'.$IDOC.'_template3.docx';
if (file_exists($uploadfile)) {
	unlink($uploadfile);
}
$uploadfile = $_SERVER["DOCUMENT_ROOT"].'/tours/doc/intermediate/'.$IDOC.'_template1.docx';
if (file_exists($uploadfile)) {
    unlink($uploadfile);
}



$text_not = 'Добавлен новый <a href="/tours/.id-' . ht($new_id_trips) . '">Тур №' . ht($new_id_trips) . '</a>. Менеджер тура - '.$name_user;

$user_send_new= array();
$user_send_new=array_merge(UserNotNumber(1,$link));

rm_from_array(0,$user_send_new);
rm_from_array($id_user,$user_send_new);
$user_send_new= array_unique($user_send_new);


$mass_ei = all_chief($id_user, $link);
rm_from_array($id_user, $mass_ei);
$mass_ei = array_unique($mass_ei);

$end_mass=exception_role($user_send_new,$mass_ei);



notification_send( $text_not,$end_mass,$id_user,$link);






end_code:

$aRes = array("debug"=>$debug,"status"   => $status_ee,"status_echo"   => $status_echo,"count" => $dom,"for_id"=>$new_id_trips,"id" => htmlspecialchars($ID_N),"error" =>  $stack_error,"download" => $download,"number"=>$number_d);
/*require_once $url_system.'Ajax/lib/Services_JSON.php';
$oJson = new Services_JSON();
//функция работает только с кодировкой UTF-8
echo $oJson->encode($aRes);
*/
echo json_encode($aRes);



?>