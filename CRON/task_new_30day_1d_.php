<?

//РОБОТ ПО ФОРМИРОВАНИЮ НАПОМИНАЛОК ЗАДАЧ ДЛЯ ПОЛЬЗОВАТЕЛЕЙ
//КАЖДЫЙ ДЕНЬ В 12.00
//НАПОМИНАЛКИ НА 31 ДЕНЬ ВПЕРЕД
//РАБОТАЕТ С +3 дня и +31 день
//ТАК КАК СЕГОДНЯ ЗАВТРА ПОСЛЕЗАВТРА ОБРАБАТЫВАЕТ ДРУГОЙ СКРИПТ КОТОРЫЙ ВЫПОЛНЯЕТСЯ КАЖДЫЙ ЧАС

$url_system='../';
//подключение к базе
include_once $url_system.'module/config.php';
//подключение написанных функций для сайта
include_once $url_system.'module/function.php';

include_once $url_system.'ilib/lib_interstroi.php';



//********************************************************************
//********************************************************************
//********************************************************************
//ДАТЬ ЗАДАЧУ НАПОМНИТЬ КЛИЕНТУ О ЗАКАНЧИВАНИЕ СРОКА ДЕЙСТВИЯ ПАСПОРТА
//ЗА ПОЛ ГОДА ВПЕРЕД
//|
//V

for ($xx=0; $xx<31; $xx++)
{

    $date_ring=date_step_sql('Y-m-d','+'.(3+$xx).'d');
    $date_birth=date_step_sql('Y-m-d','+'.(186+$xx).'d');

   //echo($date_birth.'<br>');

    $result_8 = mysql_time_query($link,'SELECT A.id,A.fio,A.date_birthday,A.id_user,A.code,A.id_a_company,A.inter_srok FROM k_clients AS A,r_user as B WHERE  A.visible=1 and A.id_user=B.id and A.inter_srok="'.$date_birth.'"');

    $num_8 = $result_8->num_rows;
    if($result_8)
    {
        while($row_8 = mysqli_fetch_assoc($result_8)){
            $date_mass = explode("-", ht($row_8['inter_srok']));
            $date_start = $date_mass[2] . '.' . $date_mass[1] . '.' . $date_mass[0];
            $text_task="Заканчивает срок действия паспорта-".$date_start;


            TASK_SEND_NEW($date_ring.' 23:59:59',$text_task,$row_8["id"],1,21,$link,0, $row_8["id_user"],$row_8["id_a_company"]);
            echo $text_task.'-'.$row_8["id_user"].'-'.$row_8["id"].'<br>';
        }
    }
}
//X
//|
//ДАТЬ ЗАДАЧУ НАПОМНИТЬ КЛИЕНТУ О ЗАКАНЧИВАНИЕ СРОКА ДЕЙСТВИЯ ПАСПОРТА
//********************************************************************
//********************************************************************
//********************************************************************



//********************************************************************
//********************************************************************
//********************************************************************
//ДАТЬ ЗАДАЧУ ПОЗДРАВИТЬ КЛИЕНТА С ДНЕМ РОЖДЕНИЕМ
//НА МЕСЯЦ ВПЕРЕД
//|
//V

for ($xx=0; $xx<31; $xx++)
{

$date_ring=date_step_sql('Y-m-d','+'.(3+$xx).'d');
$date_birth=date_step_sql('-m-d','+'.(3+$xx).'d');
$result_8 = mysql_time_query($link,'SELECT A.id,A.fio,A.date_birthday,A.id_user,A.code,A.id_a_company FROM k_clients AS A,r_user as B WHERE ((A.potential=0)or(A.potential=1)) and  A.visible=1 and A.id_user=B.id and LOWER(A.date_birthday) LIKE "%'.$date_birth.'"');
	
$num_8 = $result_8->num_rows;	
if($result_8)
{	
  while($row_8 = mysqli_fetch_assoc($result_8)){ 
			   $text_task="Поздравить с днем рождения";
	  
	  
      TASK_SEND_NEW($date_ring.' 23:59:59',$text_task,$row_8["id"],1,7,$link,0, $row_8["id_user"],$row_8["id_a_company"]);
	  echo $text_task.'-'.$row_8["id_user"].'-'.$row_8["id"].'<br>';
  }
}
}
//X
//|
//ДАТЬ ЗАДАЧУ ПОЗДРАВИТЬ КЛИЕНТА С ДНЕМ РОЖДЕНИЕМ
//********************************************************************
//********************************************************************
//********************************************************************


//********************************************************************
//********************************************************************
//********************************************************************
//ДАТЬ НАПОМИНАЛКУ О  ВЫЛЕТЕ КЛИЕНТА НА ОТДЫХ НОВЫЕ ТУРЫ
//НА 31 ДЕНЬ ВПЕРЕД
//|
//V

    $date_start_plus3 = date_step_sql('Y-m-d', '+3d');
    $date_end_plus3 = date_step_sql('Y-m-d', '+35d');
    $result_8 = mysql_time_query($link, 'SELECT DISTINCT A.id,A.id_user,
(SELECT yy.start_fly FROM trips_fly_history AS yy WHERE yy.id_trips=A.id ORDER BY yy.datetime DESC LIMIT 0,1) AS start_fly,A.id_a_company FROM trips AS A,trips_fly_history AS D WHERE D.id_trips=A.id AND (SELECT ysy.start_fly FROM trips_fly_history AS ysy WHERE ysy.id_trips=A.id ORDER BY ysy.datetime DESC LIMIT 0,1)>="' . $date_start_plus3 . ' 00:00:00" and (SELECT ysy.start_fly FROM trips_fly_history AS ysy WHERE ysy.id_trips=A.id ORDER BY ysy.datetime DESC LIMIT 0,1)<"' . $date_end_plus3 . ' 00:00:00" AND A.visible=1');
    $num_8 = $result_8->num_rows;
    if ($result_8) {
        while ($row_8 = mysqli_fetch_assoc($result_8)) {

            $razn_d = dateDiff_1(date("y-m-d") . ' ' . date("H:i:s"), $row_8["start_fly"]);

            //echo($razn_d.' ');
            //if($razn_d==-1)
            // {
            $text_task = "Турист улетает";

            TASK_SEND_NEW($row_8["start_fly"], $text_task, $row_8["id"], 0, 15, $link, 0, $row_8["id_user"], $row_8["id_a_company"]);
            echo $text_task . '-' . $row_8["id_user"] . '-' . $row_8["id"] . '<br>';
            // }

        }
    }
//X
//|
//ДАТЬ НАПОМИНАЛКУ О ВЫЛЕТЕ КЛИЕНТА НА ОТДЫХ НОВЫЕ ТУРЫ
//********************************************************************
//********************************************************************
//********************************************************************


//********************************************************************
//********************************************************************
//********************************************************************
//ДАТЬ НАПОМИНАЛКУ О ВОЗВРАТЕ КЛИЕНТА С ОТДЫХА НОВЫЕ ТУРЫ + ВПЕЧАТЛЕНИЕ О ТУРЕ
//НА 31 ДЕНЬ ВПЕРЕД
//|
//V
    $date_start_plus3 = date_step_sql('Y-m-d', '+3d');
    $date_end_plus3 = date_step_sql('Y-m-d', '+35d');
    $result_8 = mysql_time_query($link, 'SELECT DISTINCT A.id,A.id_user,
(SELECT yy.end_fly FROM trips_fly_history AS yy WHERE yy.id_trips=A.id ORDER BY yy.datetime DESC LIMIT 0,1) AS end_fly,A.id_a_company FROM trips AS A,trips_fly_history AS D WHERE D.id_trips=A.id AND (SELECT ysy.end_fly FROM trips_fly_history AS ysy WHERE ysy.id_trips=A.id ORDER BY ysy.datetime DESC LIMIT 0,1)>="' . $date_start_plus3 . ' 00:00:00" and (SELECT ysy.end_fly FROM trips_fly_history AS ysy WHERE ysy.id_trips=A.id ORDER BY ysy.datetime DESC LIMIT 0,1)<"' . $date_end_plus3 . ' 00:00:00" AND A.visible=1');
    $num_8 = $result_8->num_rows;
    if ($result_8) {
        while ($row_8 = mysqli_fetch_assoc($result_8)) {

            $razn_d = dateDiff_1(date("y-m-d") . ' ' . date("H:i:s"), $row_8["start_fly"]);

            //echo($razn_d.' ');
            //if($razn_d==-1)
            // {
            $text_task = "Турист улетает с отдыха";

            TASK_SEND_NEW($row_8["end_fly"], $text_task, $row_8["id"], 0, 16, $link, 0, $row_8["id_user"], $row_8["id_a_company"]);
            echo $text_task . '-' . $row_8["id_user"] . '-' . $row_8["id"] . '<br>';
            // }

            //добавляем напоминалку о впечатление о туре если его еще нет
            $result_uu = mysql_time_query($link, 'select comment from trips where id="' . ht($row_8["id"]) . '"');
            $num_results_uu = $result_uu->num_rows;

            if ($num_results_uu != 0) {
                $row_uu = mysqli_fetch_assoc($result_uu);
                if($row_uu["comment"]=='')
                {
                    //еще нет впечатления даем задачу после двух дней как прилетел узнать

                    $text_task = "Турист вернулся с отдыха. Узнать впечатление о туре";

                    $date_mass = explode(" ", ht($row_8["end_fly"]));
                    //узнаем какая будет дата через 2 дня как вернулся
                    $date_plus_2=date_step($date_mass[0],2);

                    TASK_SEND_NEW($date_plus_2.' 23:59:59', $text_task, $row_8["id"], 1, 17, $link, 0, $row_8["id_user"], $row_8["id_a_company"]);
                    echo $text_task . '-' . $row_8["id_user"] . '-' . $row_8["id"] . '<br>';
                }


            }


        }
    }

//X
//|
//ДАТЬ НАПОМИНАЛКУ О ВОЗВРАТЕ КЛИЕНТА С ОТДЫХА НОВЫЕ ТУРЫ
//********************************************************************
//********************************************************************
//********************************************************************




//********************************************************************
//********************************************************************
//********************************************************************
//ПЕРЕСЧЕТ КОМИССИИ У ПОЛЬЗОВАТЕЛЕЙ ЗА ТЕКУЩИЙ МЕСЯЦ  ПО СТАРЫМ ЗАЯВКАМ
//|
//V

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


		    if($row_status21["comm"]=='')
            {
                $row_status21["comm"]=0;
            }

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
//X
//|
//ПЕРЕСЧЕТ КОМИССИИ У ПОЛЬЗОВАТЕЛЕЙ ЗА ТЕКУЩИЙ МЕСЯЦ  ПО СТАРЫМ ЗАЯВКАМ
//********************************************************************
//********************************************************************
//********************************************************************

//********************************************************************
//********************************************************************
//********************************************************************
//ДАТЬ НАПОМИНАЛКУ О  ПРЕДСТОЯЩЕЙ ОПЛАТЕ ОТ КЛИЕНТА ПО ТУРУ
//НА 31 ДЕНЬ ВПЕРЕД
//|
//V

    $date_start_plus3 = date_step_sql('Y-m-d', '+3d');
    $date_end_plus3 = date_step_sql('Y-m-d', '+35d');

    $result_8 = mysql_time_query($link, 'SELECT A.id_trips,A.date,B.id_user,B.id_a_company FROM trips_payment_term AS A,trips as B WHERE A.id_trips=B.id and B.visible=1 and B.status=1 and A.type=0 and A.yes=0 and A.date>="' . $date_start_plus3 . ' 00:00:00" and A.date<"' . $date_end_plus3 . ' 00:00:00" AND A.visible=1');

    //echo('SELECT A.id_trips,A.date,B.id_user,B.id_a_company FROM trips_payment_term AS A,trips as B WHERE A.id_trips=B.id and B.visible=1 and B.status=1 and A.type=0 and A.yes=0 and A.date>="' . $date_start_plus3 . ' 00:00:00" and A.date<"' . $date_end_plus3 . ' 00:00:00" AND A.visible=1<br><br>');


    $num_8 = $result_8->num_rows;
    if ($result_8) {
        while ($row_8 = mysqli_fetch_assoc($result_8)) {


            $text_task = "Срок оплаты от туриста";

            TASK_SEND_NEW($row_8["date"].' 23:59:59', $text_task, $row_8["id_trips"], 0, 19, $link, 0, $row_8["id_user"], $row_8["id_a_company"]);
            echo $text_task . '-' . $row_8["id_user"] . '-' . $row_8["id"] . '<br>';
            // }

        }
    }


//X
//|
//ДАТЬ НАПОМИНАЛКУ О  ПРЕДСТОЯЩЕЙ ОПЛАТЕ ОТ КЛИЕНТА ПО ТУРУ
//********************************************************************
//********************************************************************
//********************************************************************


//********************************************************************
//********************************************************************
//********************************************************************
//ДАТЬ НАПОМИНАЛКУ О  ПРЕДСТОЯЩЕЙ ОПЛАТЕ ТУРОПЕРАТОРУ
//НА 31 ДЕНЬ ВПЕРЕД
//|
//V

    $date_start_plus3 = date_step_sql('Y-m-d', '+3d');
    $date_end_plus3 = date_step_sql('Y-m-d', '+35d');

    $result_8 = mysql_time_query($link, 'SELECT A.id_trips,A.date,B.id_user,B.id_a_company FROM trips_payment_term AS A,trips as B WHERE A.id_trips=B.id and B.visible=1 and B.status=1 and A.type=1 and A.yes=0 and A.date>="' . $date_start_plus3 . ' 00:00:00" and A.date<"' . $date_end_plus3 . ' 00:00:00" AND A.visible=1');

    //echo('SELECT A.id_trips,A.date,B.id_user,B.id_a_company FROM trips_payment_term AS A,trips as B WHERE A.id_trips=B.id and B.visible=1 and B.status=1 and A.type=0 and A.yes=0 and A.date>="' . $date_start_plus3 . ' 00:00:00" and A.date<"' . $date_end_plus3 . ' 00:00:00" AND A.visible=1<br><br>');


    $num_8 = $result_8->num_rows;
    if ($result_8) {
        while ($row_8 = mysqli_fetch_assoc($result_8)) {


            $text_task = "Срок оплаты туроператору";

            TASK_SEND_NEW($row_8["date"].' 23:59:59', $text_task, $row_8["id_trips"], 0, 18, $link, 0, $row_8["id_user"], $row_8["id_a_company"]);
            echo $text_task . '-' . $row_8["id_user"] . '-' . $row_8["id"] . '<br>';
            // }

        }
    }


//X
//|
//ДАТЬ НАПОМИНАЛКУ О  ПРЕДСТОЯЩЕЙ ОПЛАТЕ ТУРОПЕРАТОРУ
//********************************************************************
//********************************************************************
//********************************************************************


//********************************************************************
//********************************************************************
//********************************************************************
//ПЕРЕСЧЕТ КОМИССИИ У ПОЛЬЗОВАТЕЛЕЙ ЗА ТЕКУЩИЙ МЕСЯЦ НОВЫЕ ТУРЫ
//|
//V
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

        $result_status21=mysql_time_query($link,'SELECT sum(a.commission) as comm FROM trips AS a WHERE a.commission_fix=0 and a.status=1 and a.visible=1 and a.id_user="'.$row_8["id"].'" and a.date_buy_all>="'.$date_start.'" and a.date_buy_all<"'.$date_end.'"');

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

            } else
            {
                mysql_time_query($link,'INSERT INTO users_commission_trips (id_users,date,sum) VALUES ("'.$row_8["id"].'","'.$month_s.'","'.$row_status21["comm"].'")');
            }


        }

    }
}
//X
//|
//ПЕРЕСЧЕТ КОМИССИИ У ПОЛЬЗОВАТЕЛЕЙ ЗА ТЕКУЩИЙ МЕСЯЦ НОВЫЕ ТУРЫ
//********************************************************************
//********************************************************************
//********************************************************************




//********************************************************************
//********************************************************************
//********************************************************************
//ПЕРЕСЧЕТ ФИКСИРОВАННЫХ ОПЛАТ У ПОЛЬЗОВАТЕЛЕЙ ЗА ТЕКУЩИЙ МЕСЯЦ НОВЫЕ ТУРЫ
//|
//V
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

        $result_status21=mysql_time_query($link,'SELECT sum(a.commission_fix) as comm,sum(a.commission) as comm1 FROM trips AS a WHERE not(a.commission_fix=0) and a.status=1 and a.visible=1 and a.id_user="'.$row_8["id"].'" and a.date_buy_all>="'.$date_start.'" and a.date_buy_all<"'.$date_end.'"');

        if($result_status21->num_rows!=0)
        {
            $row_status21 = mysqli_fetch_assoc($result_status21);
            //есть ли запись с такой коммиссией по этому пользователю за данный месяц
            $result_status22=mysql_time_query($link,'SELECT a.id from users_commission_trips as a where a.id_users="'.$row_8["id"].'" and a.date="'.$month_s.'"');

            if($row_status21["comm"]=='')
            {
                $row_status21["comm"]=0;
            }
            if($row_status21["comm1"]=='')
            {
                $row_status21["comm1"]=0;
            }

            if($result_status22->num_rows!=0)
            {
                mysql_time_query($link,'update users_commission_trips set sum_fix="'.$row_status21["comm"].'",sum_com="'.$row_status21["comm1"].'" where id_users="'.$row_8["id"].'" and date="'.$month_s.'"');
            } else
            {
                mysql_time_query($link,'INSERT INTO users_commission_trips (id_users,date,sum,sum_fix,sum_com) VALUES ("'.$row_8["id"].'","'.$month_s.'","0","'.$row_status21["comm"].'","'.$row_status21["comm1"].'")');
            }
        }
    }
}
//X
//|
//ПЕРЕСЧЕТ ФИКСИРОВАННЫХ ОПЛАТ У ПОЛЬЗОВАТЕЛЕЙ ЗА ТЕКУЩИЙ МЕСЯЦ НОВЫЕ ТУРЫ
//********************************************************************
//********************************************************************
//********************************************************************




$cron_message='Выполнено';
mysql_time_query($link,'INSERT INTO cron_history (id,datetimes,script,message) VALUES ("","'.date("y.m.d").' '.date("H:i:s").'","task_new_30day_1d_.php","'.ht($cron_message).'")');

