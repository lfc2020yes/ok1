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
$token=isset($_GET['tk']) ? htmlspecialchars($_GET['tk']) : '';
$disco=0;
$query=mb_convert_case(htmlspecialchars($_GET['search']), MB_CASE_LOWER, "UTF-8");
$id=isset($_GET['id']) ? htmlspecialchars($_GET['id']) : '';
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
if ((!isset($_GET['search'])))
{
   $debug=h4a(4,$echo_r,$debug);
   goto end_code;	
}
/*
if(($_GET['search']=='')or(strlen($_GET['search'])<'1'))
{
	   $debug=h4a(224,$echo_r,$debug);
   goto end_code;	
}
*/
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

if($query!='')
{

    //echo('!'.$id_group_company_list);

  $sql='

select * from(     
   (   
SELECT A.id,A.name FROM affiliates_promo_code AS A,affiliates as B where A.id_users=B.id_users and A.date_end>="'.date("Y-m-d").'" and B.
id_a_group='.ht($id_group_u).' and A.status=2 and A.date_end>="'.date("Y-m-d").'" AND  A.visible=1 AND LOWER(A.name) LIKE "'.$query.'%"   
)
UNION
(

SELECT A.id,A.name FROM affiliates_promo_code AS A,affiliates as B where  A.id_users=B.id_users and B.
id_a_group='.ht($id_group_u).' and A.status=2 and A.date_end>="'.date("Y-m-d").'" AND A.visible=1 AND LOWER(A.name_search) LIKE "%'.$query.'%"
AND A.id NOT IN 
(SELECT A.id FROM affiliates_promo_code A,affiliates as B WHERE  A.id_users=B.id_users and B.
id_a_group='.ht($id_group_u).' and A.status=2 and A.date_end>="'.date("Y-m-d").'" AND A.visible=1 AND LOWER(A.name) LIKE "'.$query.'%")
) 

) Z order by Z.name limit 0,15';  
} else
{
	$sql='Select a.* from affiliates_promo_code as a,affiliates as b WHERE a.id_users=b.id_users and b.
id_a_group="'.$id_group_u.'" and a.status=2 and a.visible=1 and a.date_end>="'.date("Y-m-d").'" order by a.name limit 0,15';
}

//echo($sql);

$query_string='';


$query_string.='<li><a href="javascript:void(0);" rel="0">Нет</a></li>';

$result_work_zz=mysql_time_query($link,$sql);
$num_results_work_zz = $result_work_zz->num_rows;
	    if($num_results_work_zz!=0)
	    {
		   for ($i=0; $i<$num_results_work_zz; $i++)
		   {			   			  			   
			   $row_work_zz = mysqli_fetch_assoc($result_work_zz);	
			   if($query!='')
			   {
			   $query_string.='<li><a href="javascript:void(0);" rel="'.$row_work_zz["id"].'">'.search_text_strong(0,$query,$row_work_zz["name"]).'</a></li>';
			   } else
			   {
			   $query_string.='<li><a href="javascript:void(0);" rel="'.$row_work_zz["id"].'">'.$row_work_zz["name"].'</a></li>';
			   }
			   
			   
		   }	
		} else
		{
			
						   $query_string.='<li><a href="javascript:void(0);" rel="0">Ничего не найдено</a></li>';
			

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