<?

//РОБОТ ПО ФОРМИРОВАНИЮ НАПОМИНАЛОК ЗАДАЧ ДЛЯ ПОЛЬЗОВАТЕЛЕЙ
//КАЖДЫЙ ЧАС
//НАПОМИНАЛКИ НА 3 ДНЯ ВПЕРЕД (СЕГОДНЯ/ЗАВТРА/ПОСЛЕЗАВТРА)

$url_system='../';
//подключение к базе
include_once $url_system.'module/config.php';
//подключение написанных функций для сайта
include_once $url_system.'module/function.php';

include_once $url_system.'ilib/lib_interstroi.php'; 





//ПЕРЕСЧЕТ КОМИССИИ У ПОЛЬЗОВАТЕЛЕЙ ЗА ТЕКУЩИЙ МЕСЯЦ НОВЫЕ ТУРЫ
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
	  
	  			  	   $result_status21=mysql_time_query($link,'SELECT sum(a.commission) as comm FROM trips AS a WHERE  a.status=1 and a.visible=1 and a.id_user="'.$row_8["id"].'" and a.date_buy_all>="'.$date_start.'" and a.date_buy_all<"'.$date_end.'"');
		
       if($result_status21->num_rows!=0)
       {  
           $row_status21 = mysqli_fetch_assoc($result_status21);		   
		   //есть ли запись с такой коммиссией по этому пользователю за данный месяц
		    $result_status22=mysql_time_query($link,'SELECT a.id from users_commission_trips as a where a.id_users="'.$row_8["id"].'" and a.date="'.$month_s.'"');

           if($row_status21["comm"]=='')
           {
               $row_status21["comm"]=0;
           }

           if($result_status22->num_rows!=0)
           { 
			   mysql_time_query($link,'update users_commission_trips set sum="'.$row_status21["comm"].'" where id_users="'.$row_8["id"].'" and date="'.$month_s.'"');
			   echo 'update users_commission_trips set sum="'.$row_status21["comm"].'" where id_users="'.$row_8["id"].'" and date="'.$month_s.'"<br>';
		   } else
		   {
			   mysql_time_query($link,'INSERT INTO users_commission_trips (id_users,date,sum) VALUES ("'.$row_8["id"].'","'.$month_s.'","'.$row_status21["comm"].'")');
		   }
		   
		   
	   } 	
	  
  }
}

