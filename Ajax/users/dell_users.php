<?php
//получение материалов из счета при выборе текущего счета
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

$id=htmlspecialchars($_GET['id']);
$dom=0;
$status_echo='';
//проверка что есть такой город что это число
//проверка что пользователь зарегистрирован

$echo_r=0; //выводить или нет ошибку 0 -нет
$debug='';

//**************************************************
	
if(!token_access_new($token,'dell_users_xx',$id,"s_form"))
{
   $debug=h4a(100,$echo_r,$debug);
   goto end_code;
}
	
	
	
if ( count($_GET) != 3 ) 
{
   $debug=h4a(1,$echo_r,$debug);
   goto end_code;	
}
//**************************************************

 if ((!$role->permission('Пользователи','D'))and($sign_admin!=1))
{
  $debug=h4a(2,$echo_r,$debug);
  goto end_code;	
}

		$result_status22=mysql_time_query($link,'SELECT a.id as cc FROM booking AS a WHERE a.id_user="'.htmlspecialchars(trim($_GET['id'])).'"');	
					 //echo('SELECT a.* FROM r_status AS a WHERE a.numer_status="'.$row1ss["status"].'" and a.id_system=13');
                if($result_status22->num_rows!=0)
                {  
					  $debug=h4a(334,$echo_r,$debug);
  goto end_code;	
				}

/*
 if ($sign_admin!=1)
{
  $debug=h4a(2,$echo_r,$debug);
  goto end_code;	
}
*/
//**************************************************
 if(!isset($_SESSION["user_id"]))
{ 
  $status_ee='reg';	
  $debug=h4a(3,$echo_r,$debug);
  goto end_code;
}
//**************************************************
if ((!isset($_GET["id"]))) 
{
   $debug=h4a(4,$echo_r,$debug);
   goto end_code;	
}
//**************************************************
$result_t=mysql_time_query($link,'Select b.id from r_user as b where b.id="'.htmlspecialchars(trim($_GET['id'])).'"');
           $num_results_t = $result_t->num_rows;
	       if($num_results_t!=0)
	       {	
			 
			 $row_t = mysqli_fetch_assoc($result_t);
		   
		     //проверяем может ли видеть этот наряд
			   /*
	if($row_t["status"]==3)
	{
				    $debug=h4a(5,$echo_r,$debug);
   goto end_code;	
			 }
			   */
		   } else
		   {
			      $debug=h4a(6,$echo_r,$debug);
   goto end_code;	
		   }
/*
	if(($row_t["id_user"]!=$id_user)and($sign_admin!=1))
	{
		goto end_code;	
	}
*/
//**************************************************
//**************************************************
//**************************************************
//**************************************************


$status_ee='ok';

mysql_time_query($link,'delete FROM r_user where id="'.htmlspecialchars(trim($_GET['id'])).'"');
mysql_time_query($link,'delete FROM r_user_object where id_user="'.htmlspecialchars(trim($_GET['id'])).'"');

end_code:

$aRes = array("debug"=>$debug,"status"   => $status_ee,"status_echo"   => $status_echo,"count" => $dom,"echo"=>$echo);
/*require_once $url_system.'Ajax/lib/Services_JSON.php';
$oJson = new Services_JSON();
//функция работает только с кодировкой UTF-8
echo $oJson->encode($aRes);
*/
echo json_encode($aRes);

?>