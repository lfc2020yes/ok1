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
	



$result_t=mysql_time_query($link,'Select b.*,r.id_company from k_organization as b,r_user as r where b.id="'.ht($_GET['id']).'" and b.visible=1 and b.id_user=r.id');

//echo('Select b.*,r.id_company from k_clients as b,r_user as r where b.id="'.ht($_GET['id']).'" and b.visible=1 and b.id_user=r.id');
$num_results_t = $result_t->num_rows;
if($num_results_t==0)
{	
		$debug=h4a(5,$echo_r,$debug);
		goto end_code;
	
} else
{
	$row_score = mysqli_fetch_assoc($result_t);
	/*
	//получать обновленные данные по клиентам только своей компании umatravel или другой
	if($row_score["id_company"]!=$id_company)
	{
		$debug=h4a(8,$echo_r,$debug);
		goto end_code;		
	}
*/


    $date_mass56 = explode(",", ht($id_company));
    if(array_search($row_score["id_company"], $date_mass56, true)===FALSE)
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
			 //название
			 if($c_op[$op]==1) { $echo.=$row_score["name"]; } else { $echo.='0'; } break; 
                  }	
		
		

		 case "1":{ 
			 //директор
			 if($c_op[$op]==1) { 
				 

                if($row_score["head"]!='')
                {  
                   		   
					$echo.='/-'.$row_score["head"];
				} else
				{
					$echo.='/-dell';
				}
				 
				  } else { $echo.='/-0'; } break; 
                  }		
		 case "2":{ 
			 //юр адресс
			 if($c_op[$op]==1) { 
				 

                if($row_score["adress_ur"]!='')
                {  
                   		   
					$echo.='/-'.$row_score["adress_ur"];
				} else
				{
					$echo.='/-dell';
				}
				 
				  } else { $echo.='/-0'; } break; 
                  }	
				
				
					 case "3":{ 
			 //телефон
			 if($c_op[$op]==1) {  $phone_format='+7 ('.$row_score["phone_contact"][0].$row_score["phone_contact"][1].$row_score["phone_contact"][2].') '.$row_score["phone_contact"][3].$row_score["phone_contact"][4].$row_score["phone_contact"][5].'-'.$row_score["phone_contact"][6].$row_score["phone_contact"][7].'-'.$row_score["phone_contact"][8].$row_score["phone_contact"][9];	 
								
				$echo.='/-'.$phone_format; } else { $echo.='/-0'; } break; 
                  }		
			case "4":{ 
			 //email
			 if($c_op[$op]==1) { if($row_score["email"]!='') { $echo.='/-'.$row_score["email"]; } else {$echo.='/-—';}} else { $echo.='/-0'; } break; 
                  }
				
				case "5":{ 
			 //ИНН
			 if($c_op[$op]==1) { if($row_score["code_inn"]!='') { $echo.='/-'.$row_score["code_inn"]; } else {$echo.='/-—';}} else { $echo.='/-0'; } break; 
                  }				
			case "6":{ 
			 //КПП
			 if($c_op[$op]==1) { if($row_score["code_kpp"]!='') { $echo.='/-'.$row_score["code_kpp"]; } else {$echo.='/-—';}} else { $echo.='/-0'; } break; 
                  }			
				case "7":{ 
			 //ОГРН
			 if($c_op[$op]==1) { if($row_score["code_ogrn"]!='') { $echo.='/-'.$row_score["code_ogrn"]; } else {$echo.='/-—';}} else { $echo.='/-0'; } break; 
                  }	
				case "8":{ 
			 //ОКПО
			 if($c_op[$op]==1) { if($row_score["code_okpo"]!='') { $echo.='/-'.$row_score["code_okpo"]; } else {$echo.='/-—';}} else { $echo.='/-0'; } break; 
                  }					
				case "9":{ 
			 //РАСЧЕТНЫЙ СЧЕТ
			 if($c_op[$op]==1) { if($row_score["bank_rs"]!='') { $echo.='/-'.$row_score["bank_rs"]; } else {$echo.='/-—';}} else { $echo.='/-0'; } break; 
                  }	
				case "10":{ 
			 //БИК
			 if($c_op[$op]==1) { if($row_score["bank_bik"]!='') { $echo.='/-'.$row_score["bank_bik"]; } else {$echo.='/-—';}} else { $echo.='/-0'; } break; 
                  }
				case "11":{ 
			 //БАНК
			 if($c_op[$op]==1) { if($row_score["bank_name"]!='') { $echo.='/-'.$row_score["bank_name"]; } else {$echo.='/-—';}} else { $echo.='/-0'; } break; 
                  }					
				case "12":{ 
			 //Кор. счет	
			 if($c_op[$op]==1) { if($row_score["bank_ks"]!='') { $echo.='/-'.$row_score["bank_ks"]; } else {$echo.='/-—';}} else { $echo.='/-0'; } break; 
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