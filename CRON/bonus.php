<?

//БОНУСЫ РАБОТНИКОВ ПЕРЕСЧЕТ САМОСТОЯТЕЛЬНЫЙ

$url_system='../';
//подключение к базе
$url_system=$_SERVER['DOCUMENT_ROOT'].'/';
//header("Content-type: application/json");
session_start();
//подключение к базе
include_once $url_system.'module/config.php';
//подключение написанных функций для сайта
include_once $url_system.'module/function.php';
//проверка авторизации
include_once $url_system.'login/function_users.php'; 
initiate($link);
if((isset($_SESSION["user_id"])))
{	
 $id_user=id_key_crypt_encrypt(htmlspecialchars(trim($_SESSION['user_id'])));

$auth_key_query = mysql_time_query($link,"SELECT id,name_user FROM r_user WHERE id='".safe_var($id_user)."'");
		$num_results = $auth_key_query->num_rows;
        if($num_results!=0)
        {	       
$row_town_user = mysqli_fetch_assoc($auth_key_query);
$name_user=$row_town_user['name_user'];
        }     



 //считываем все необходимые доступы для этого пользователя
 include_once $url_system.'ilib/lib_interstroi.php'; 
 $role=new RoleUser($link,$id_user);  //создаем класс прав
 $role->GetColumns();
 $role->GetRows();
 $role->GetPermission();

 $hie = new hierarchy($link,$id_user);

$hie_object=array();
$hie_town=array();
$hie_kvartal=array();
$hie_user=array();	
$hie_object=$hie->obj;
$hie_kvartal=$hie->id_kvartal;
$hie_town=$hie->id_town;
$hie_user=$hie->user;

 $sign_level=$hie->sign_level;
 $sign_admin=$hie->admin;
}

$error_number='';
//правам к просмотру к действиям

if( count($_GET)!= 1 )
{	 
           header("HTTP/1.1 404 Not Found");
	       header("Status: 404 Not Found");
	       $error_header=404;
	$error_number=1;
}
/*
if ($sign_admin!=1)
{	
           header("HTTP/1.1 404 Not Found");
	       header("Status: 404 Not Found");
	       $error_header=404;		
		$error_number=2;
}
*/
if($error_header==404)
{
	echo'ошибка - №'.$error_number;
	die();
}

/*
include_once $url_system.'module/config.php';
//подключение написанных функций для сайта
include_once $url_system.'module/function.php';

include_once $url_system.'ilib/lib_interstroi.php'; 
*/

if($_GET["m"]=='last')
{
//ПЕРЕСЧЕТ КОМИССИИ У ПОЛЬЗОВАТЕЛЕЙ ЗА ПРОШЛЫЙ МЕСЯЦ
$date_end=date("Y-m-").'01 00:00:00';
$date_start=date_step_sql('Y-m','-1m').'-01 00:00:00';

$month_s=$date_start=date("Y-").date("m", mktime(date("G"), date("i"), date("s"), (date("n")-1),date("j"), date("Y"))).'-01';
//echo($date_start.'/'.$date_end);
$month_s==$date_start=date_step_sql('Y-m','-1m').'-01';

$result_8 = mysql_time_query($link,'SELECT A.id FROM r_user AS A');
$num_8 = $result_8->num_rows;	
if($result_8)
{	
  while($row_8 = mysqli_fetch_assoc($result_8)){ 
	  $commission=0;
	  
	  			  	   $result_status21=mysql_time_query($link,'SELECT sum(a.commission) as comm FROM booking_offers AS a,booking_status_history as b,booking as c WHERE c.id=a.id_booking and a.id_booking=b.id_booking and a.status=2 and c.visible=1 and b.status=3 and c.id_user="'.$row_8["id"].'" and b.datetime>="'.$date_start.'" and b.datetime<"'.$date_end.'"');	
		
       if($result_status21->num_rows!=0)
       {  
           $row_status21 = mysqli_fetch_assoc($result_status21);		   
		   //есть ли запись с такой коммиссией по этому пользователю за данный месяц
		    $result_status22=mysql_time_query($link,'SELECT a.id from users_commission as a where a.id_users="'.$row_8["id"].'" and a.date="'.$month_s.'"');	
		
           if($result_status22->num_rows!=0)
           { 
			   mysql_time_query($link,'update users_commission set sum="'.$row_status21["comm"].'" where id_users="'.$row_8["id"].'" and date="'.$month_s.'"');

		   } else
		   {
			   mysql_time_query($link,'INSERT INTO users_commission (id_users,date,sum) VALUES ("'.$row_8["id"].'","'.$month_s.'","'.$row_status21["comm"].'")');
		   }
		   
		   
	   } 	
	  
  }
}
		echo('Бонусы за предыдущий месяц обновлены!');
}

if($_GET["m"]=='now')
{
//ПЕРЕСЧЕТ КОМИССИИ У ПОЛЬЗОВАТЕЛЕЙ ЗА ТЕКУЩИЙ МЕСЯЦ
$date_start=date("Y-m-").'01 00:00:00';
$date_end=date_step_sql('Y-m','+1m').'-01 00:00:00';

$month_s=$date_start=date("Y-m-").'01';
//echo($date_start.'/'.$date_end);


$result_8 = mysql_time_query($link,'SELECT A.id FROM r_user AS A');
$num_8 = $result_8->num_rows;	
if($result_8)
{	
  while($row_8 = mysqli_fetch_assoc($result_8)){ 
	  $commission=0;
	  
	  			  	   $result_status21=mysql_time_query($link,'SELECT sum(a.commission) as comm FROM booking_offers AS a,booking_status_history as b,booking as c WHERE c.id=a.id_booking and a.id_booking=b.id_booking and a.status=2 and c.visible=1 and b.status=3 and c.id_user="'.$row_8["id"].'" and b.datetime>="'.$date_start.'" and b.datetime<"'.$date_end.'"');	
		
       if($result_status21->num_rows!=0)
       {  
           $row_status21 = mysqli_fetch_assoc($result_status21);		   
		   //есть ли запись с такой коммиссией по этому пользователю за данный месяц
		    $result_status22=mysql_time_query($link,'SELECT a.id from users_commission as a where a.id_users="'.$row_8["id"].'" and a.date="'.$month_s.'"');	
		
           if($result_status22->num_rows!=0)
           { 
			   mysql_time_query($link,'update users_commission set sum="'.$row_status21["comm"].'" where id_users="'.$row_8["id"].'" and date="'.$month_s.'"');

		   } else
		   {
			   mysql_time_query($link,'INSERT INTO users_commission (id_users,date,sum) VALUES ("'.$row_8["id"].'","'.$month_s.'","'.$row_status21["comm"].'")');
		   }
		   
		   
	   } 	
	  
  }
}
	echo('Бонусы за текущий месяц обновлены!');
}

?>
