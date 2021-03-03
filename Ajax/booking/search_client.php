<?php
//забронировали заявку
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
$query=mb_convert_case(htmlspecialchars($_GET['search']), MB_CASE_LOWER, "UTF-8");
$id=htmlspecialchars($_GET['id']);
$dom=0;
$status_echo='';
//проверка что есть такой город что это число
//проверка что пользователь зарегистрирован

$echo_r=0; //выводить или нет ошибку 0 -нет
$debug='';

//**************************************************
	/*
if(!token_access_new($token,'bt_booking_end_client',$id,"s_form"))
{
   $debug=h4a(100,$echo_r,$debug);
   goto end_code;
}
*/	
	
	/*
if ( count($_GET) != 4 ) 
{
   $debug=h4a(1,$echo_r,$debug);
   goto end_code;	
}
*/
//**************************************************
 if ((!$role->permission('Заявки','A'))and($sign_admin!=1))
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
if ((!isset($_GET['search'])))
{
   $debug=h4a(4,$echo_r,$debug);
   goto end_code;	
}

if(($_GET['search']=='')or(strlen($_GET['search'])<='2'))
{
	   $debug=h4a(224,$echo_r,$debug);
   goto end_code;	
}

//**************************************************
/*
$result_t=mysql_time_query($link,'Select b.id_user,b.status,b.ready,b.id_object from booking as b where b.id="'.htmlspecialchars(trim($_GET['id'])).'"');
           $num_results_t = $result_t->num_rows;
	       if($num_results_t!=0)
	       {	
			 
			 $row_t = mysqli_fetch_assoc($result_t);
			   
		   } else
		   {
			      $debug=h4a(6,$echo_r,$debug);
   goto end_code;	
		   }
*/

//**************************************************
//**************************************************
//**************************************************
//**************************************************


$status_ee='ok';


function search_text_strong_2019($regime,$search,$beginText)
{
//$regime    //Режим поиска (1 - точный поиск, 0 - вхождение)
//$search    // Что ищем (в примере: $search = "про"; )
//$beginText // Текст по которому необходимо провести поиск
 
/* Точный поиск. (Найдёт: "...не [B]про[/B] меня", 
Не найдёт "Этот ком[U]про[/U]мат не..." - ) отдельное слово */

if($regime == 1)                                       
  { $patterns = "/(\b".$search."\b)+/i"; }// Регулярное выражение
 
 
/* Отдельное слово и Вхождение в другие слова. 
(Найдёт: "...не [B]про[/B] меня", 
Найдёт: "Этот ком[B]про[/B]мат не...") */
else                                                       
  { $patterns = "/(".$search.")+/i"; }// Регулярное выражение
 
$replace = "<strong>$1</strong>";// На что заменить

setlocale(LC_ALL, 'ru_RU.CP1251'); 
$endText = PREG_REPLACE($patterns,$replace,$beginText);// Замена
 
return $endText;
}



  $sql='

select * from(     
   (   
SELECT A.fio,A.id,A.phone,A.code FROM k_clients AS A where A.visible=1 AND LOWER(A.fio) LIKE "'.$query.'%"   
)
UNION
(

SELECT A.fio,A.id,A.phone,A.code FROM k_clients AS A where A.visible=1 AND LOWER(A.fio) LIKE "%'.$query.'%"
AND A.fio NOT IN 
(SELECT A.fio FROM k_clients A WHERE A.visible=1 AND LOWER(A.fio) LIKE "'.$query.'%")
) 
UNION
(
SELECT A.fio,A.id,A.phone,A.code FROM k_clients AS A where A.visible=1 AND LOWER(A.phone) LIKE "%'.$query.'%" 
AND A.fio NOT IN 
(SELECT A.fio FROM k_clients A WHERE A.visible=1 AND LOWER(A.fio) LIKE "'.$query.'%")
AND A.fio NOT IN 
(SELECT A.fio FROM k_clients A WHERE A.visible=1 AND LOWER(A.fio) LIKE "%'.$query.'%")
ORDER BY A.fio
) 

UNION
(
SELECT A.fio,A.id,A.phone,A.code FROM k_clients AS A where A.visible=1 AND A.code="'.$query.'" 
AND A.fio NOT IN (SELECT A.fio FROM k_clients A WHERE A.visible=1 AND LOWER(A.fio) LIKE "'.$query.'%") AND A.fio 
NOT IN (SELECT A.fio FROM k_clients A WHERE A.visible=1 AND LOWER(A.fio) LIKE "%'.$query.'%") AND A.fio 
NOT IN (SELECT A.fio FROM k_clients A WHERE A.visible=1 AND LOWER(A.phone) LIKE "%'.$query.'%")
ORDER BY A.fio
) 

) Z order by Z.fio limit 0,10';  


//echo($sql);

$query_string='';

$result_work_zz=mysql_time_query($link,$sql);
$num_results_work_zz = $result_work_zz->num_rows;
	    if($num_results_work_zz!=0)
	    {
		   for ($i=0; $i<$num_results_work_zz; $i++)
		   {			   			  			   
			   $row_work_zz = mysqli_fetch_assoc($result_work_zz);	
			   
			   
			   $phone_format='+7 ('.$row_work_zz["phone"][0].$row_work_zz["phone"][1].$row_work_zz["phone"][2].') '.$row_work_zz["phone"][3].$row_work_zz["phone"][4].$row_work_zz["phone"][5].'-'.$row_work_zz["phone"][6].$row_work_zz["phone"][7].'-'.$row_work_zz["phone"][8].$row_work_zz["phone"][9];
			   
			   
			  $query_string.='<div id="'.$row_work_zz["id"].'" class="string_res"><div class="flex_search"><div class="name_search_x">'.search_text_strong(0,$query,$row_work_zz["fio"]).' ['.$row_work_zz["code"].']</div>
			   <div class="phone_search_x">'.search_text_strong(0,$query,$phone_format).'</div></div></div>';
 
			   
		   }	
		} else
		{
						  $query_string.='<div id="'.$row_work_zz["id"].'" class="string_res"><div class="flex_search"><div class="name_search_x">Ничего не найдено</div>
			   <div class="phone_search_x"></div></div></div>';
		}


end_code:

$aRes = array("debug"=>$debug,"status"   => $status_ee,"status_echo"   => $status_echo,"query" => $query_string,"echo"=>$echo);
/*require_once $url_system.'Ajax/lib/Services_JSON.php';
$oJson = new Services_JSON();
//функция работает только с кодировкой UTF-8
echo $oJson->encode($aRes);
*/
echo json_encode($aRes);
?>