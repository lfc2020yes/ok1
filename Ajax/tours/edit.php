<?php
//редактировать существующий тур
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
$disco=0;
$ID_N='';
$temp='';
$radio_potential='';

$id=ht($_POST['id']);
$token=ht($_POST["tk"]);

$dom=0;
$status_echo='';
//проверка что есть такой город что это число
//проверка что пользователь зарегистрирован

$echo_r=1; //выводить или нет ошибку 0 -нет
$debug='';

//**************************************************
//2 дня
if(!token_access_new($token,'edit_tours',$id,"rema",2880))
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
if(((!isset($_POST['tk1']))or(trim($_POST['tk1'])!='vWeVE8zAZZ')))
{
  $debug=h4a(77,$echo_r,$debug);
  goto end_code;	
}



$mas_responsible=array();
$status_admin=0;
$result_uu_gl = mysql_time_query($link, 'select A.*  from trips as A where A.id="' . ht($_POST['id']) . '"');
$num_results_uu_gl = $result_uu_gl->num_rows;

if ($num_results_uu_gl != 0) {
    $row_uu_gl = mysqli_fetch_assoc($result_uu_gl);
    array_push($mas_responsible,$row_uu_gl["id_user"]);
    $status_admin=$row_uu_gl['status_admin'];
} else
{
    $debug=h4a(95,$echo_r,$debug);
    goto end_code;
}

if($status_admin!=0) {
    $debug=h4a(002,$echo_r,$debug);
    goto end_code;
}


$tabs_menu_x_visible[4]=0;
if($row_uu_gl["id_user"]!=0)
{
    if(($sign_admin!=1))
    {

        if($row_uu_gl["id_user"]==$id_user)
        {
            $tabs_menu_x_visible[4]="1";
        }

        if (in_array($id_user, $mas_responsible))
        {
            $tabs_menu_x_visible[4]="1";
        } else
        {
            //может он управляющий кого то кто должен выполнить эту задачу тогда ему тоже можно ее выполнить
            $subo_x = array();
            foreach ($mas_responsible as $key => $value)
            {
                $subo_x = array_merge($subo_x, all_chief($value,$link));

            }
            $subo_x= array_unique($subo_x);


            if ((in_array($id_user, $subo_x)))
            {
                $tabs_menu_x_visible[4]="1";
            }

        }
    }  else
    {
        $tabs_menu_x_visible[4]="1";
    }

}

if($tabs_menu_x_visible[4]!="1")
{
    $debug=h4a(6,$echo_r,$debug);
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

    $result_uu = mysql_time_query($link, 'select a.id from trips_contract as a,trips as b where a.id=b.id_contract and b.visible=1 and  a.id_a_company IN (' . ht($id_group_company_list) . ') and  a.number="' . ht($stringx) . '" and a.years="' . trim($date_r1[2]) . '" and not(b.id="'.ht($_POST["id"]).'")');
    $num_results_uu = $result_uu->num_rows;
    $number_d = 0;
    if ($num_results_uu != 0) {
        //значит такой номер договора по компании в этом году уже занят
        array_push($stack_error, "number_contract_busy");

        //определяем какой следующий точно свободен в этом году по этой компании


        $result_status2d = mysql_time_query($link, 'SELECT MAX(b.number) AS cc FROM trips_contract AS b,trips as a WHERE b.id_a_company IN (' . ht($id_group_company_list) . ') and a.visible=1 and a.id_contract=b.id and b.years="' . date('Y') . '"');
        //echo('SELECT a.* FROM r_status AS a WHERE a.numer_status="'.$row1ss["status"].'" and a.id_system=13');
        if ($result_status2d->num_rows != 0) {
            $row_status2d = mysqli_fetch_assoc($result_status2d);
            $number_d = (int)$row_status2d["cc"] + 1;
        }

    }
}





if((!isset($_POST['id_operator']))or(trim($_POST['id_operator'])=='')) { array_push($stack_error, "id_operator"); }
if((!isset($_POST['id_booking_sourse']))or(trim($_POST['id_booking_sourse'])=='')) { array_push($stack_error, "id_booking_sourse"); }


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

//**************************************************
//**************************************************



//для покупателя организации проверки пока нет, если надо будет добавить сюда
if(($_POST["buy_type"]==2)and($_POST["buy_id"]!=''))
{

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


//изменения по договору если есть такие

$result_status2d=mysql_time_query($link,'SELECT b.name,b.date_doc FROM trips_contract AS b WHERE b.id="'.ht($row_uu_gl['id_contract']).'"');
//echo('SELECT a.* FROM r_status AS a WHERE a.numer_status="'.$row1ss["status"].'" and a.id_system=13');
if($result_status2d->num_rows!=0) {
    $row_status2d = mysqli_fetch_assoc($result_status2d);
    $array_param_old=array($row_status2d["name"],date_ex(0,$row_status2d["date_doc"]));
}

$array_param_new=array(trim($_POST['number_contract']),date_ex(0,$_POST['date_sele_doc']));
$array_param_comment=array('номер договора','дата договора');
$history_edit=AddHistoryTripsAll($_POST["id"],
    $array_param_old,
    $array_param_new,
    $array_param_comment,
    $link);
if($history_edit!='0')
{
    //что-то поменялось
    $text_history='Изменение данных по договору → '.$history_edit;


    $date_doc_=explode("-",ht(trim($_POST['number_contract'])));
    $date_r=explode(" ",htmlspecialchars(trim($date_doc_[1])));
    $date_r1=explode("/",htmlspecialchars(trim($date_doc_[0])));

    $stringx=trim($date_r[0]);
    $stringx = preg_replace('/[^0-9]/', '', $stringx);
    $date_r[0]=$stringx;

    mysql_time_query($link, 'update trips_contract set
    
    years="'.htmlspecialchars(trim($date_r1[2])).'",
    number="'.htmlspecialchars(trim($date_r[0])).'",
    name="'.ht(trim($_POST['number_contract'])).'",
    date_doc="'.ht($_POST["date_sele_doc"]).'"
    
    where id = "' . ht($row_uu_gl['id_contract']) . '"');

    mysql_time_query($link,'INSERT INTO trips_status_history_new (id_trips,action_history,id_user,datetimes,edit,comment,comment_sys) VALUES ("'.ht($_POST["id"]).'","18",
		"'.ht($id_user).'",
		"'.date("Y-m-d").' '.date("H:i:s").'",
		"0",
		"'.ht($text_history).'",
		"")');


}
//изменения по туристам если есть




//изменения по экскурсиям
//изменения по доп услугам
//изменения по страховке

//изменения общих данных тура





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


/**************************/
/**************************/
/**************************/
//туристы

$izm=0;
$task_cloud_block1='';
if ( $_POST[ "fly_count" ] != 0 ) {
    $fly_kto = explode(",", ht($_POST["fly_id"]));
    foreach ($fly_kto as $key => $value) {

/*        mysql_time_query($link, 'INSERT INTO trips_clients_fly(id_trips,id_k_clients) VALUES(
"' . ht($new_id_trips) . '","' . ht($value) . '")');
*/
        $result_uu1 = mysql_time_query($link, 'select A.fio from k_clients as A where A.id="'.ht($value) .'"');
        $num_results_uu1 = $result_uu1->num_rows;

        if ($num_results_uu1 != 0) {
            $row_uu1 = mysqli_fetch_assoc($result_uu1);
            if($key!=0) { $task_cloud_block1.=', ';
            }
            $task_cloud_block1.='<a class="js-client" iod="'.$row_uu1["id_k_clients"].'"><span class="js-glu-f-'.$row_uu1["id_k_clients"].'">'.$row_uu1["fio"].'</span></a>';
        }

        $result_uu = mysql_time_query($link, 'select id from trips_clients_fly where id_trips="' . ht($_POST["id"]). '" and id_k_clients="'.ht($value).'"');
        $num_results_uu = $result_uu->num_rows;

        if ($num_results_uu == 0) {
            //Значит такой записи нет
            $izm++;
        }


    }
    $result_uu = mysql_time_query($link, 'select count(id) as dd from trips_clients_fly where id_trips="' . ht($_POST["id"]). '"');
    $row_uu = mysqli_fetch_assoc($result_uu);

    if(($izm==0)and(count($fly_kto)!=$row_uu["dd"]))
    {
        $izm++;
        //какую то запись удалили
    }
}

if($izm!=0)
{

    $result_uu = mysql_time_query($link, 'select A.fio,B.id_k_clients from k_clients as A,trips_clients_fly as B where B.id_trips="'.ht($_POST["id"]) .'" and B.id_k_clients=A.id');
    $query_string='';
    if ($result_uu) {
        $i = 0;
        while ($row_uu = mysqli_fetch_assoc($result_uu)) {
            $task_cloud_block='';
            if($i!=0) { $task_cloud_block.=', ';
            }
            $task_cloud_block.='<a class="js-client" iod="'.$row_uu["id_k_clients"].'"><span class="js-glu-f-'.$row_uu["id_k_clients"].'">'.$row_uu["fio"].'</span></a>';

            $query_string.=$task_cloud_block;

            $i++;
        }
    }

    $array_param_old=array($query_string);
    $array_param_new=array( $task_cloud_block1);
    $array_param_comment=array('изменились');

    $history_edit=AddHistoryTripsAll($_POST["id"],
        $array_param_old,
        $array_param_new,
        $array_param_comment,
        $link);
    $text_history='Изменение данных по туристам → '.$history_edit;

    mysql_time_query($link,'INSERT INTO trips_status_history_new (id_trips,action_history,id_user,datetimes,edit,comment,comment_sys) VALUES ("'.ht($_POST["id"]).'","19",
		"'.ht($id_user).'",
		"'.date("Y-m-d").' '.date("H:i:s").'",
		"0",
		"'.ht($text_history).'",
		"")');


    mysql_time_query($link,'delete FROM trips_clients_fly where id_trips="' . ht($_POST["id"]). '"');

    if ( $_POST[ "fly_count" ] != 0 ) {
        $fly_kto = explode(",", ht($_POST["fly_id"]));
        foreach ($fly_kto as $key => $value) {

        mysql_time_query($link, 'INSERT INTO trips_clients_fly(id_trips,id_k_clients) VALUES(
"' . ht($_POST["id"]) . '","' . ht($value) . '")');
        }
    }




}


/**************************/
/**************************/
/**************************/
//экскурсии

$izm=0;
$task_cloud_block1='';
$vsego=0;
$excursion=$_POST['excursion'];
for ($i = 0; $i < (count($excursion['name'])); $i++){
    if((ht($excursion['name'][$i])!='')and(ht($excursion['name'][$i])!='нет')) {
        if($vsego!=0) { $task_cloud_block1.=', ';
        }
        $task_cloud_block1.=$excursion['name'][$i];

        $vsego++;


        $result_uu = mysql_time_query($link, 'select id from trips_excursion where id_trips="' . ht($_POST["id"]) . '" and name="' . ht($excursion['name'][$i]) . '"');
        $num_results_uu = $result_uu->num_rows;

        if ($num_results_uu == 0) {
            //Значит такой записи нет
            $izm++;
        }

    }
    }

    $result_uu = mysql_time_query($link, 'select count(id) as dd from trips_excursion where id_trips="' . ht($_POST["id"]). '"');
    $row_uu = mysqli_fetch_assoc($result_uu);

    if(($izm==0)and($vsego!=$row_uu["dd"]))
    {
        $izm++;
        //какую то запись удалили
    }


if($izm!=0)
{

    $result_uu = mysql_time_query($link, 'select * from trips_excursion where id_trips="' . ht($_POST["id"]) . '"');
    $query_string='';
    if ($result_uu) {
        $i = 0;
        while ($row_uu = mysqli_fetch_assoc($result_uu)) {
            $task_cloud_block='';
            if($i!=0) { $task_cloud_block.=', ';
            }
            $task_cloud_block.=$row_uu["name"];

            $query_string.=$task_cloud_block;

            $i++;
        }
    }
    if($i==0)
    {
        $query_string.='—';
    }

    $array_param_old=array($query_string);
    $array_param_new=array($task_cloud_block1);
    $array_param_comment=array('изменились');

    $history_edit=AddHistoryTripsAll($_POST["id"],
        $array_param_old,
        $array_param_new,
        $array_param_comment,
        $link);
    $text_history='Изменение данных по экскурсиям → '.$history_edit;

    mysql_time_query($link,'INSERT INTO trips_status_history_new (id_trips,action_history,id_user,datetimes,edit,comment,comment_sys) VALUES ("'.ht($_POST["id"]).'","20",
		"'.ht($id_user).'",
		"'.date("Y-m-d").' '.date("H:i:s").'",
		"0",
		"'.ht($text_history).'",
		"")');


    mysql_time_query($link,'delete FROM trips_excursion where id_trips="' . ht($_POST["id"]). '"');


    $excursion=$_POST['excursion'];
    for ($i = 0; $i < (count($excursion['name'])); $i++){

        if((ht($excursion['name'][$i])!='')and(ht($excursion['name'][$i])!='нет'))
        {
            mysql_time_query($link,'INSERT INTO trips_excursion (id_trips,name) VALUES ("'. ht( $_POST["id"] ).'","'.ht($excursion['name'][$i]).'")');

        }

    }



}

/**************************/
/**************************/
/**************************/

/**************************/
/**************************/
/**************************/
//страховка

$izm=0;
$task_cloud_block1='';
$vsego=0;
$excursion=$_POST['insurance'];
for ($i = 0; $i < (count($excursion['name'])); $i++){
    if((ht($excursion['name'][$i])!='')and(ht($excursion['name'][$i])!='нет')) {
        if($vsego!=0) { $task_cloud_block1.=', ';
        }
        $task_cloud_block1.=$excursion['name'][$i];

        $vsego++;


        $result_uu = mysql_time_query($link, 'select id from trips_insurance where id_trips="' . ht($_POST["id"]) . '" and name="' . ht($excursion['name'][$i]) . '"');
        $num_results_uu = $result_uu->num_rows;

        if ($num_results_uu == 0) {
            //Значит такой записи нет
            $izm++;
        }

    }
}

$result_uu = mysql_time_query($link, 'select count(id) as dd from trips_insurance where id_trips="' . ht($_POST["id"]). '"');
$row_uu = mysqli_fetch_assoc($result_uu);

if(($izm==0)and($vsego!=$row_uu["dd"]))
{
    $izm++;
    //какую то запись удалили
}


if($izm!=0)
{

    $result_uu = mysql_time_query($link, 'select * from trips_insurance where id_trips="' . ht($_POST["id"]) . '"');
    $query_string='';
    if ($result_uu) {
        $i = 0;
        while ($row_uu = mysqli_fetch_assoc($result_uu)) {
            $task_cloud_block='';
            if($i!=0) { $task_cloud_block.=', ';
            }
            $task_cloud_block.=$row_uu["name"];

            $query_string.=$task_cloud_block;

            $i++;
        }
    }
    if($i==0)
    {
        $query_string.='—';
    }

    $array_param_old=array($query_string);
    $array_param_new=array($task_cloud_block1);
    $array_param_comment=array('изменились');

    $history_edit=AddHistoryTripsAll($_POST["id"],
        $array_param_old,
        $array_param_new,
        $array_param_comment,
        $link);

    $text_history='Изменение данных по страховкам → '.$history_edit;

    mysql_time_query($link,'INSERT INTO trips_status_history_new (id_trips,action_history,id_user,datetimes,edit,comment,comment_sys) VALUES ("'.ht($_POST["id"]).'","21",
		"'.ht($id_user).'",
		"'.date("Y-m-d").' '.date("H:i:s").'",
		"0",
		"'.ht($text_history).'",
		"")');


    mysql_time_query($link,'delete FROM trips_insurance where id_trips="' . ht($_POST["id"]). '"');


    $excursion=$_POST['insurance'];
    for ($i = 0; $i < (count($excursion['name'])); $i++){

        if((ht($excursion['name'][$i])!='')and(ht($excursion['name'][$i])!='нет'))
        {
            mysql_time_query($link,'INSERT INTO trips_insurance (id_trips,name) VALUES ("'. ht( $_POST["id"] ).'","'.ht($excursion['name'][$i]).'")');

        }

    }



}

/**************************/
/**************************/
/**************************/
/**************************/
/**************************/
/**************************/
//доп. услуги

$izm=0;
$task_cloud_block1='';
$vsego=0;
$excursion=$_POST['service'];
for ($i = 0; $i < (count($excursion['name'])); $i++){
    if((ht($excursion['name'][$i])!='')and(ht($excursion['name'][$i])!='нет')) {
        if($vsego!=0) { $task_cloud_block1.=', ';
        }
        $task_cloud_block1.=$excursion['name'][$i];

        $vsego++;


        $result_uu = mysql_time_query($link, 'select id from trips_service where id_trips="' . ht($_POST["id"]) . '" and name="' . ht($excursion['name'][$i]) . '"');
        $num_results_uu = $result_uu->num_rows;

        if ($num_results_uu == 0) {
            //Значит такой записи нет
            $izm++;
        }

    }
}

$result_uu = mysql_time_query($link, 'select count(id) as dd from trips_service where id_trips="' . ht($_POST["id"]). '"');
$row_uu = mysqli_fetch_assoc($result_uu);

if(($izm==0)and($vsego!=$row_uu["dd"]))
{
    $izm++;
    //какую то запись удалили
}


if($izm!=0)
{

    $result_uu = mysql_time_query($link, 'select * from trips_service where id_trips="' . ht($_POST["id"]) . '"');
    $query_string='';
    if ($result_uu) {
        $i = 0;
        while ($row_uu = mysqli_fetch_assoc($result_uu)) {
            $task_cloud_block='';
            if($i!=0) { $task_cloud_block.=', ';
            }
            $task_cloud_block.=$row_uu["name"];

            $query_string.=$task_cloud_block;

            $i++;
        }
    }
    if($i==0)
    {
        $query_string.='—';
    }

    $array_param_old=array($query_string);
    $array_param_new=array($task_cloud_block1);
    $array_param_comment=array('изменились');

    $history_edit=AddHistoryTripsAll($_POST["id"],
        $array_param_old,
        $array_param_new,
        $array_param_comment,
        $link);
    $text_history='Изменение данных по доп. услугам → '.$history_edit;

    mysql_time_query($link,'INSERT INTO trips_status_history_new (id_trips,action_history,id_user,datetimes,edit,comment,comment_sys) VALUES ("'.ht($_POST["id"]).'","22",
		"'.ht($id_user).'",
		"'.date("Y-m-d").' '.date("H:i:s").'",
		"0",
		"'.ht($text_history).'",
		"")');


    mysql_time_query($link,'delete FROM trips_service where id_trips="' . ht($_POST["id"]). '"');


    $excursion=$_POST['service'];
    for ($i = 0; $i < (count($excursion['name'])); $i++){

        if((ht($excursion['name'][$i])!='')and(ht($excursion['name'][$i])!='нет'))
        {
            mysql_time_query($link,'INSERT INTO trips_service (id_trips,name) VALUES ("'. ht( $_POST["id"] ).'","'.ht($excursion['name'][$i]).'")');

        }

    }



}

/**************************/
/**************************/
/**************************/
/**************************/
//изменение покупателя тура

$array_param_old=array(trim($row_uu_gl["shopper"]),$row_uu_gl["id_shopper"]);
$array_param_new=array(trim($_POST["buy_type"]),$_POST["buy_id"]);
$array_param_comment=array(' ',' ');
$history_edit=AddHistoryTripsAll($_POST["id"],
    $array_param_old,
    $array_param_new,
    $array_param_comment,
    $link);
if($history_edit!='0') {
    //что-то поменялось
    $text_history='Изменение покупателя тура → с ';

    //был
    $task_cloud_block='';
    if($row_uu_gl["shopper"]==1) {
        //частное лицо
        $result_uux = mysql_time_query($link, 'select fio from k_clients where id="'.ht($row_uu_gl["id_shopper"]) . '"');
    } else
    {
        //2 фирма
        $result_uux = mysql_time_query($link, 'select name as fio from k_organization where id="'.ht($row_uu_gl["id_shopper"]) . '"');
    }
    $num_results_uux = $result_uux->num_rows;

    if($num_results_uux!=0)
    {
        $row_uux = mysqli_fetch_assoc($result_uux);
        if($row_uu_gl["shopper"]==1) {
            //частное лицо
            $text_history.='<a class="js-client" iod="'.$row_uu_gl["id_shopper"].'"><span class="js-glu-f-'.$row_uu_gl["id_shopper"].'">'.$row_uux["fio"].'</span></a>';
        } else
        {
//      фирма
            $text_history.='<div class="pass_wh_trips2"><a class="js-org" iod="'.$row_uu_gl["id_shopper"].'"><span class="js-glo-n-'.$row_uu_gl["id_shopper"].'">'.$row_uux["fio"].'</span></a>';
        }
    }
    //стал
    $text_history.=' на ';
    if($_POST["buy_type"]==1) {
        //частное лицо
        $result_uux = mysql_time_query($link, 'select fio from k_clients where id="'.ht($_POST["buy_id"]) . '"');
    } else
    {
        //2 фирма
        $result_uux = mysql_time_query($link, 'select name as fio from k_organization where id="'.ht($_POST["buy_id"]) . '"');
    }
    $num_results_uux = $result_uux->num_rows;

    if($num_results_uux!=0)
    {
        $row_uux = mysqli_fetch_assoc($result_uux);
        if($row_uu_gl["shopper"]==1) {
            //частное лицо
            $text_history.='<a class="js-client" iod="'.$_POST["buy_id"].'"><span class="js-glu-f-'.$_POST["buy_id"].'">'.$row_uux["fio"].'</span></a>';
        } else
        {
//      фирма
            $text_history.='<div class="pass_wh_trips2"><a class="js-org" iod="'.$_POST["buy_id"].'"><span class="js-glo-n-'.$_POST["buy_id"].'">'.$row_uux["fio"].'</span></a>';
        }
    }




    mysql_time_query($link, 'update trips set
    
    id_shopper="'.ht($_POST["buy_id"]).'",
    shopper="'.ht($_POST["buy_type"]).'"
    
    where id = "' . ht($_POST['id']) . '"');

    mysql_time_query($link,'INSERT INTO trips_status_history_new (id_trips,action_history,id_user,datetimes,edit,comment,comment_sys) VALUES ("'.ht($_POST["id"]).'","23",
		"'.ht($id_user).'",
		"'.date("Y-m-d").' '.date("H:i:s").'",
		"0",
		"'.ht($text_history).'",
		"")');


}



/**************************/
/**************************/
//общие изменения по самому туру


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

//туроператор
$result_uu=mysql_time_query($link,'select name from booking_operator where id="'.ht($_POST["id_operator"]).'"');
$num_results_uu = $result_uu->num_rows;

if($num_results_uu!=0)
{
    $row_uu = mysqli_fetch_assoc($result_uu);
    $docx_fly_operator= $row_uu["name"];
}

//какой пасспорт для договора нужен
$docx_passw='заграничный';
if($_POST["password"]==2)
{
    $docx_passw='внутренний';
}


//обращение
$preorders=0;
if(($_POST["id_preorders"]!=0)and($_POST["id_preorders"]!=''))
{

    $result_url1=mysql_time_query($link,'select A.id,A.status,A.id_user,B.name from preorders as A,preorders_status as B where B.number=A.status and B.id_company="'.$id_company.'" and A.id="'.ht($_POST["id_preorders"]).'" and A.id_company="'.$id_company.'" and A.id_user="'.$id_user.'"');
    $num_results_custom_url1 = $result_url1->num_rows;
    if($num_results_custom_url1!=0) {
        $row_list222 = mysqli_fetch_assoc($result_url1);
        $preorders=ht($_POST["id_preorders"]);

if($preorders!=$row_uu_gl["id_booking"]) {
    $st_old12 = $row_list222["name"];
    $reason = 0;
    mysql_time_query($link, 'update preorders set
    
    status="5",
    id_reasons="0"
    
    where id = "' . ht($_POST["id_preorders"]) . '"');


    //заносим историю по туру
    mysql_time_query($link, 'INSERT INTO preorders_status_history_new (id_preorder,action_history,id_user,datetimes,edit,comment,comment_sys) VALUES ("' . ht($_POST["id_preorders"]) . '","7","' . ht($id_user) . '","' . date("y.m.d") . ' ' . date("H:i:s") . '","0","Изменение статуса обращения → c \"' . $st_old12 . '\" на \"Оформлен договор\"","")');

    $name_book=info_trips($_POST["id"],$link);

    mysql_time_query($link,'INSERT INTO preorders_status_history_new (id_preorder,action_history,id_user,datetimes,edit,comment,comment_sys) VALUES ("'.ht($_POST["id_preorders"]).'","8","'.ht($id_user).'","'.date("y.m.d").' '.date("H:i:s").'","0","Оформлен договор по туру <a class=\"preorders-a\" href=\"tours/.id-'.ht($_POST["id"]).'\"><strong>'.$name_book.'</strong></a>","")');

}

//вдруг старое обращение было не 0 а тоже какое то тогда ему месяем статус ведь теперь оно не связано с туром
        if(($row_uu_gl["id_booking"]!=0)and($preorders!=$row_uu_gl["id_booking"]))
        {
            //откатываем к статусу который последний перед оформленным

        $result_uuol = mysql_time_query($link, 'SELECT id,name FROM preorders_status WHERE id_company="'.$id_company.'" AND number<"5" AND not(number=5) AND visible=1 ORDER BY displayOrder DESC LIMIT 1');
        $num_results_uuol = $result_uuol->num_rows;

        if ($num_results_uuol != 0) {
            $row_uuol = mysqli_fetch_assoc($result_uuol);
            //заносим историю по туру
            mysql_time_query($link, 'INSERT INTO preorders_status_history_new (id_preorder,action_history,id_user,datetimes,edit,comment,comment_sys) VALUES ("' . ht($row_uu_gl["id_booking"]) . '","7","' . ht($id_user) . '","' . date("y.m.d") . ' ' . date("H:i:s") . '","0","Изменение статуса обращения → c \"Оформлен договор\" на \"'.$row_uuol["name"].'\"","")');

            mysql_time_query($link, 'update preorders set
    
    status="'.$row_uuol["id"].'",
    id_reasons="0"
    
    where id = "' . ht($row_uu_gl["id_booking"]) . '"');



        }

        }



    }
}




$array_param_new=array(
    $docx_fly_sourse,
    $docx_fly_operator,
    $docx_passw,
    $_POST["turoper_booking"],
    $_POST["hotel"],
    $_POST["room_type"],
    $_POST["room_category"],
    $_POST["food_type"],
    $date_start,
    $date_end,
    $date_start_race,
    $date_end_race,
    $docx_fly_country,
    $_POST["place_name"],
    $_POST["count_clients"],
    $_POST["count_day"],
    $_POST["transfer_route"],
    $_POST["transfer_type"],
    $_POST["transfer_view"],
    $_POST["flight_there_route"],
    $_POST["flight_there_number"],
    $_POST["flight_there_class"],
    $_POST["flight_there_transfer_type"],
    $_POST["flight_there_flight_type"],
    $_POST["flight_back_route"],
    $_POST["flight_back_number"],
    $_POST["flight_back_class"],
    $_POST["flight_class_transfer_type"],
    $_POST["flight_class_flight_type"],
    '№'.$preorders);

//старые значения находим. то что было до этого
//узнаем откуда узнал об этом
$docx_fly_sourse='';
$result_uu=mysql_time_query($link,'select name from booking_sourse where id="'.ht($row_uu_gl["id_booking_sourse"]).'"');
$num_results_uu = $result_uu->num_rows;

if($num_results_uu!=0)
{
    $row_uu = mysqli_fetch_assoc($result_uu);
    $docx_fly_sourse= $row_uu["name"];
}

//страна куда летит
$docx_fly_country='';
$result_uu=mysql_time_query($link,'select name from trips_country where id="'.ht($row_uu_gl["id_country"]).'"');
$num_results_uu = $result_uu->num_rows;

if($num_results_uu!=0)
{
    $row_uu = mysqli_fetch_assoc($result_uu);
    $docx_fly_country= $row_uu["name"];
}








//туроператор
$docx_fly_operator='';

$result_uu=mysql_time_query($link,'select name from booking_operator where id="'.ht($row_uu_gl["id_operator"]).'"');
$num_results_uu = $result_uu->num_rows;

if($num_results_uu!=0)
{
    $row_uu = mysqli_fetch_assoc($result_uu);
    $docx_fly_operator= $row_uu["name"];
}

//какой пасспорт для договора нужен
$docx_passw='заграничный';
if($row_uu_gl["passport"]==2)
{
    $docx_passw='внутренний';
}

$array_param_old=array(
    $docx_fly_sourse,
    $docx_fly_operator,
    $docx_passw,
    $row_uu_gl["number_to"],
    $row_uu_gl["hotel"],
    $row_uu_gl["room_type"],
    $row_uu_gl["room_category"],
    $row_uu_gl["food_type"],
    $row_uu_gl["date_start"],
    $row_uu_gl["date_end"],
    $row_uu_gl["date_start_race"],
    $row_uu_gl["date_end_race"],
    $docx_fly_country,
    $row_uu_gl["place_name"],
    $row_uu_gl["count_people"],
    $row_uu_gl["count_day"],
    $row_uu_gl["transfer_route"],
    $row_uu_gl["transfer_type"],
    $row_uu_gl["transfer_view"],
    $row_uu_gl["flight_there_route"],
    $row_uu_gl["flight_there_number"],
    $row_uu_gl["flight_there_class"],
    $row_uu_gl["flight_there_transfer_type"],
    $row_uu_gl["flight_there_flight_type"],
    $row_uu_gl["flight_back_route"],
    $row_uu_gl["flight_back_number"],
    $row_uu_gl["flight_back_class"],
    $row_uu_gl["flight_class_transfer_type"],
    $row_uu_gl["flight_class_flight_type"],
    '№'.$row_uu_gl["id_booking"]
    );



$array_param_comment=array(
    'рекламный источник',
    'туроператор',
    'паспорт для договора',
    'Номер заявки у туроператора',
    'отель','тип номера',
    'категория номера',
    'тип питания',
    'дата начала тура',
    'дата окончания тура',
    'дата заезда в отель',
    'дата выезда из отеля',
    'страна','район',
    'кол-во человек',
    'кол-во ночей',
    'маршрут трансфера',
    'тип трансфера',
    'вид трансфера',
    'маршрут перелета туда',
    'номер рейса туда',
    'класс перелета туда',
    'тип транспорта туда',
    'тип рейса туда',
    'маршрут перелета обратно',
    'номер рейса обратно',
    'класс перелета обратно',
    'тип транспорта обратно',
    'тип рейса обратно',
    'обращение');
$history_edit=AddHistoryTripsAll($_POST["id"],
    $array_param_old,
    $array_param_new,
    $array_param_comment,
    $link);
if($history_edit!='0')
{
    //что-то поменялось
    $text_history='Изменение данных по туру → '.$history_edit;


    mysql_time_query($link, 'update trips set
    
id_booking_sourse="'.ht($_POST["id_booking_sourse"]).'",                                                         
id_operator="'.ht($_POST["id_operator"]).'",
passport="'.ht($_POST["password"]).'",                                         
number_to="'.ht($_POST["turoper_booking"]).'",             
hotel="'.ht($_POST["hotel"]).'", 
id_booking="'.ht($preorders).'", 
   
id_room_type="'.ht($_POST["id_room_type"]).'",                         
room_type="'.ht($_POST["room_type"]).'",                                         
id_room_category="'.ht($_POST["id_room_category"]).'",                   
room_category="'.ht($_POST["room_category"]).'",                       
id_food_type="'.ht($_POST["id_food_type"]).'",                        
food_type="'.ht($_POST["food_type"]).'",                                   
date_start="'.$date_start.'",               
date_end="'.$date_end.'",
date_start_race="'.$date_start_race.'",
date_end_race="'.$date_end_race.'",                
id_country="'.ht($_POST["id_country"]).'",                         
place_name="'.ht($_POST["place_name"]).'",                
count_people="'.ht($_POST["count_clients"]).'",                  
count_day="'.ht($_POST["count_day"]).'",                          
transfer_route="'.ht($_POST["transfer_route"]).'",   
transfer_type="'.ht($_POST["transfer_type"]).'",           
transfer_view="'.ht($_POST["transfer_view"]).'",   
flight_there_route="'.ht($_POST["flight_there_route"]).'",         
flight_there_number="'.ht($_POST["flight_there_number"]).'",                  
flight_there_class="'.ht($_POST["flight_there_class"]).'",   
flight_there_id_transfer_type="'.ht($_POST["flight_there_id_transfer_type"]).'", 
flight_there_transfer_type="'.ht($_POST["flight_there_transfer_type"]).'",   
flight_there_id_flight_type="'.ht($_POST["flight_there_id_flight_type"]).'",
flight_there_flight_type="'.ht($_POST["flight_there_flight_type"]).'",        
flight_back_route="'.ht($_POST["flight_back_route"]).'",       
flight_back_number="'.ht($_POST["flight_back_number"]).'",                             
flight_back_class="'.ht($_POST["flight_back_class"]).'",                 
flight_class_id_transfer_type="'.ht($_POST["flight_class_id_transfer_type"]).'", 
flight_class_transfer_type="'.ht($_POST["flight_class_transfer_type"]).'",              
flight_class_id_flight_type="'.ht($_POST["flight_class_id_flight_type"]).'", 
flight_class_flight_type="'.ht($_POST["flight_class_flight_type"]).'"
    
    where id = "' . ht($_POST["id"]) . '"');

    mysql_time_query($link,'INSERT INTO trips_status_history_new (id_trips,action_history,id_user,datetimes,edit,comment,comment_sys) VALUES ("'.ht($_POST["id"]).'","11",
		"'.ht($id_user).'",
		"'.date("Y-m-d").' '.date("H:i:s").'",
		"0",
		"'.ht($text_history).'",
		"")');


}

/**************************/
/**************************/


end_code:

$aRes = array("debug"=>$debug,"status"   => $status_ee,"status_echo"   => $status_echo,"count" => $dom,"for_id"=>$id,"id" => htmlspecialchars($ID_N),"error" =>  $stack_error,"download" => $download,"number"=>$number_d);
/*require_once $url_system.'Ajax/lib/Services_JSON.php';
$oJson = new Services_JSON();
//функция работает только с кодировкой UTF-8
echo $oJson->encode($aRes);
*/
echo json_encode($aRes);



?>