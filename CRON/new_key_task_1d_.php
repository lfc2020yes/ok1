<?

//РОБОТ ПО ОБНОВЛЕНИЮ task_key У ВСЕХ ПОЛЬЗОВАТЕЛЕЙ ПРИ НАСТУПЛЕНИИ НОВОГО ДНЯ
//КАЖДЫЙ ДЕНЬ
//В 12.05 НОЧИ

$url_system='../';
//подключение к базе
include_once $url_system.'module/config.php';
//подключение написанных функций для сайта
include_once $url_system.'module/function.php';

include_once $url_system.'ilib/lib_interstroi.php'; 

		 $result_t=mysql_time_query($link,'select A.id from r_user as A where A.enabled=1');
         $num_results_t = $result_t->num_rows;
	     if($num_results_t!=0)
	     {	
           while($row_8 = mysqli_fetch_assoc($result_t)){ 			   
			   UpdateTaskKey($row_8["id"],$link);	  
           }
			 
		 }


$cron_message='Выполнено';
mysql_time_query($link,'INSERT INTO cron_history (id,datetimes,script,message) VALUES ("","'.date("y.m.d").' '.date("H:i:s").'","new_key_task_1d_.php","'.ht($cron_message).'")');