<?php
//получать обновленные данные по клиентам
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
if ((!$role->permission('Клиенты','R'))and($sign_admin!=1))
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
if ((count($_GET) != 4))
{
	goto end_code;	
}	
	



$result_t=mysql_time_query($link,'Select b.*,r.id_company from k_clients as b,r_user as r where b.id="'.ht($_GET['id']).'" and b.visible=1 and b.id_user=r.id');

//echo('Select b.*,r.id_company from k_clients as b,r_user as r where b.id="'.ht($_GET['id']).'" and b.visible=1 and b.id_user=r.id');
$num_results_t = $result_t->num_rows;
if($num_results_t==0)
{	
		$debug=h4a(5,$echo_r,$debug);
		goto end_code;
	
} else
{
	$row_score = mysqli_fetch_assoc($result_t);
	
	//получать обновленные данные по клиентам только своей компании umatravel или другой
	if($row_score["id_company"]!=$id_company)
	{
		$debug=h4a(8,$echo_r,$debug);
		goto end_code;		
	}
}





//Фио
//День рождение
//последнее сообщение
//вылет
//прилет
//телефон

//пол
//латиница

//загран серия
//загран номер
//загран кем
//загран когда выдан
//загран до какого

//внпаспорт серия
//внпаспорт номер
//внпаспорт кем
//внпаспорт когда выдан


//если что то надо получить то 1 иначе 0

//**************************************************
//**************************************************
//**************************************************
//**************************************************

$status_ee='ok';


$c_op=explode(',',ht($_GET['arr']));

for ($op=0; $op<count($c_op); $op++)
{
		switch($op)
              {
		 case "0":{ 
			 //фио
			 if($c_op[$op]==1) { $echo.=$row_score["fio"]; } else { $echo.='0'; } break; 
                  }	
		
		 case "1":{ 
			 //день рождение
			 		 if($c_op[$op]==1) { 
				if($row_score["date_birthday"]!='0000-00-00')
				{
				  $razn_d=dateDiff_F(date("y-m-d").' '.date("H:i:s"),$row_score["date_birthday"]." 00:00:00");	
		
		$date_start1=explode("-",htmlspecialchars(trim($row_score["date_birthday"])));
				  
				   $startxr=$date_start1[2].'.'.$date_start1[1].'.'.$date_start1[0];
		$date_bb=$startxr.' ('.$razn_d.' '.PadejNumber($razn_d,'год,года,лет').')';
				$echo.='/-'.$date_bb;	
					
					
				} else{
					$echo.='/-—';
				}} else { $echo.='/-0'; } break; 
                  }			

		 case "2":{ 
			 //последнее сообщение
			 if($c_op[$op]==1) { 
				 
		$result_status22_comm=mysql_time_query($link,'SELECT A.comment  FROM k_clients_commun AS A WHERE A.visible=1 and A.id_client="'.ht($_GET['id']).'" order by A.datetimes desc limit 0,1');	
	
                if($result_status22_comm->num_rows!=0)
                {  
                   $row_status22_comm = mysqli_fetch_assoc($result_status22_comm);			   
					$echo.='/-'.$row_status22_comm["comment"];
				} else
				{
					$echo.='/-dell';
				}
				 
				  } else { $echo.='/-0'; } break; 
                  }		
		 case "3":{ 
			 //вылет
			 if($c_op[$op]==1) { $echo.='/-0'; } else { $echo.='/-0'; } break; 
                  }		
		 case "4":{ 
			 //прилет
			 if($c_op[$op]==1) { $echo.='/-0'; } else { $echo.='/-0'; } break; 
                  }		
		 case "5":{ 
			 //телефон
			 if($c_op[$op]==1) {
			     if($row_score["phone"]!='') {
                     $phone_format = '+7 (' . $row_score["phone"][0] . $row_score["phone"][1] . $row_score["phone"][2] . ') ' . $row_score["phone"][3] . $row_score["phone"][4] . $row_score["phone"][5] . '-' . $row_score["phone"][6] . $row_score["phone"][7] . '-' . $row_score["phone"][8] . $row_score["phone"][9];
                 } else
                 {
                     $phone_format = 'НЕ УКАЗАН';
                 }
								
				$echo.='/-'.$phone_format; } else { $echo.='/-0'; } break; 
                  }		
				
				 case "6":{ 
			 //пол
			 if($c_op[$op]==1) { $echo.='/-'.$row_score["pol"]; } else { $echo.='/-0'; } break; 
                  }	
				
				case "7":{ 
			 //фио латинскими
			 if($c_op[$op]==1) { if($row_score["latin"]!='') {$echo.='/-'.$row_score["latin"];} else {$echo.='/-—';}} else { $echo.='/-0'; } break; 
                  }	
				case "8":{ 
			 //загран серия
			 if($c_op[$op]==1) { if($row_score["inter_seria"]!='') { $echo.='/-'.$row_score["inter_seria"]; } else {$echo.='/-—';}} else { $echo.='/-0'; } break; 
                  }				
				case "9":{ 
			 //загран номер
			 if($c_op[$op]==1) { if($row_score["inter_number"]!='') { $echo.='/-'.$row_score["inter_number"]; } else {$echo.='/-—';}} else { $echo.='/-0'; } break; 
                  }	
				case "10":{ 
			 //загран кем выдан
			 if($c_op[$op]==1) { if($row_score["inter_kem"]!='') { $echo.='/-'.$row_score["inter_kem"]; } else {$echo.='/-—';}} else { $echo.='/-0'; } break; 
                  }	
				case "11":{ 
			 //загран когда выдан
			 if($c_op[$op]==1) { 
				if($row_score["inter_kogda"]!='0000-00-00')
				{
				 $echo.='/-'.rooo(MaskDate_D_M_Y_ss($row_score["inter_kogda"]),'00.00.0000','0');
				} else{
					$echo.='/-—';
				}} else { $echo.='/-0'; } break; 
                  }	
				case "12":{ 
			 //загран по какое действителен
			 if($c_op[$op]==1) { 
				 if($row_score["inter_srok"]!='0000-00-00')
				{
				 
				 $echo.='/-'.rooo(MaskDate_D_M_Y_ss($row_score["inter_srok"]),'00.00.0000','0'); } else{
					$echo.='/-—';
				}} else { $echo.='/-0'; } break; 
                  }	
				
			case "13":{ 
			 //внутр.пасспорт серия
			 if($c_op[$op]==1) { if($row_score["inner_seria"]!='') { $echo.='/-'.$row_score["inner_seria"]; } else{
					$echo.='/-—';
				}} else { $echo.='/-0'; } break; 
                  }				
				case "14":{ 
			 //внутр.пасспорт номер
			 if($c_op[$op]==1) { if($row_score["inner_number"]!='') { $echo.='/-'.$row_score["inner_number"]; } else{
					$echo.='/-—';
				}} else { $echo.='/-0'; } break; 
                  }	
				case "15":{ 
			 //внутр.пасспорт кем выдан
			 if($c_op[$op]==1) { if($row_score["inner_kem"]!='') { $echo.='/-'.$row_score["inner_kem"]; }  else{
					$echo.='/-—';
				}}
					else { $echo.='/-0'; } break; 
                  }	
				case "16":{ 
			 //внутр.пасспорт когда выдан
			 if($c_op[$op]==1) { 
				if($row_score["inner_kogda"]!='0000-00-00')
				{ 
				 
				 $echo.='/-'.rooo(MaskDate_D_M_Y_ss($row_score["inner_kogda"]),'00.00.0000','0'); } else{
					$echo.='/-—';
				}} else { $echo.='/-0'; } break; 
                  }		
				
		}
	
}


	
end_code:

$aRes = array("debug"=>$debug,"status"   => $status_ee,"echo"=>$echo);
/*require_once $url_system.'Ajax/lib/Services_JSON.php';
$oJson = new Services_JSON();
//функция работает только с кодировкой UTF-8
echo $oJson->encode($aRes);
*/
echo json_encode($aRes);
?>