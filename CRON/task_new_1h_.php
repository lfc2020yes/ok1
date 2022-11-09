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


//ДАТЬ ЗАДАЧУ ПОЗДРАВИТЬ КЛИЕНТА С ДНЕМ РОЖДЕНИЕМ
//СЕГОДНЯ
//ЗАВТРА
//ПОСЛЕЗАВТРА

for ($xx=0; $xx<3; $xx++)
{

$date_ring=date_step_sql('Y-m-d','+'.$xx.'d');
$date_birth=date_step_sql('-m-d','+'.$xx.'d');
$result_8 = mysql_time_query($link,'SELECT A.id,A.fio,A.date_birthday,A.id_user,A.code,A.id_a_company FROM k_clients AS A,r_user as B WHERE ((A.potential=0)or(A.potential=1)) and  A.visible=1 and A.id_user=B.id and LOWER(A.date_birthday) LIKE "%'.$date_birth.'"');
	
$num_8 = $result_8->num_rows;	
if($result_8)
{	
  while($row_8 = mysqli_fetch_assoc($result_8)){

     // echo($row_8["id_a_company"]);

			   $text_task="Поздравить с днем рождения";
	  
	  
      TASK_SEND_NEW($date_ring.' 23:59:59',$text_task,$row_8["id"],1,7,$link,0, $row_8["id_user"],$row_8["id_a_company"]);
	  echo $text_task.'-'.$row_8["id_user"].'-'.$row_8["id"].'<br>';
  }
}
}




//********************************************************************
//********************************************************************
//********************************************************************
//ДАТЬ НАПОМИНАЛКУ О  ВЫЛЕТЕ КЛИЕНТА НА ОТДЫХ НОВЫЕ ТУРЫ
//СЕГОДНЯ
//ЗАВТРА
//ПОСЛЕЗАВТРА
//|
//V

    $date_end_plus3 = date_step_sql('Y-m-d', '+3d');
    $result_8 = mysql_time_query($link, 'SELECT DISTINCT A.id,A.id_user,
(SELECT yy.start_fly FROM trips_fly_history AS yy WHERE yy.id_trips=A.id ORDER BY yy.datetime DESC LIMIT 0,1) AS start_fly,A.id_a_company FROM trips AS A,trips_fly_history AS D WHERE D.id_trips=A.id AND (SELECT ysy.start_fly FROM trips_fly_history AS ysy WHERE ysy.id_trips=A.id ORDER BY ysy.datetime DESC LIMIT 0,1)>="' . date("Y-m-d") . ' 00:00:00" and (SELECT ysy.start_fly FROM trips_fly_history AS ysy WHERE ysy.id_trips=A.id ORDER BY ysy.datetime DESC LIMIT 0,1)<"' . $date_end_plus3 . ' 00:00:00" AND A.visible=1');

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
//СЕГОДНЯ
//ЗАВТРА
//ПОСЛЕЗАВТРА
//|
//V

    $date_end_plus3 = date_step_sql('Y-m-d', '+3d');
    $result_8 = mysql_time_query($link, 'SELECT DISTINCT A.id,A.id_user,
(SELECT yy.end_fly FROM trips_fly_history AS yy WHERE yy.id_trips=A.id ORDER BY yy.datetime DESC LIMIT 0,1) AS end_fly,A.id_a_company FROM trips AS A,trips_fly_history AS D WHERE D.id_trips=A.id AND (SELECT ysy.end_fly FROM trips_fly_history AS ysy WHERE ysy.id_trips=A.id ORDER BY ysy.datetime DESC LIMIT 0,1)>="' . date("Y-m-d") . ' 00:00:00" and (SELECT ysy.end_fly FROM trips_fly_history AS ysy WHERE ysy.id_trips=A.id ORDER BY ysy.datetime DESC LIMIT 0,1)<"' . $date_end_plus3 . ' 00:00:00" AND A.visible=1');
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
	  
	  			  	   $result_status21=mysql_time_query($link,'SELECT sum(a.commission) as comm FROM trips AS a WHERE  a.status=1 and a.commission_fix=0 and a.visible=1 and a.id_user="'.$row_8["id"].'" and a.date_buy_all>="'.$date_start.'" and a.date_buy_all<"'.$date_end.'"');

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




//ПЕРЕСЧЕТ ФИКСИРОВАННЫХ ОПЛАТ У ПОЛЬЗОВАТЕЛЕЙ ЗА ТЕКУЩИЙ МЕСЯЦ НОВЫЕ ТУРЫ
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

        $result_status21=mysql_time_query($link,'SELECT sum(a.commission_fix) as comm,sum(a.commission) as comm1 FROM trips AS a WHERE  a.status=1 and not(a.commission_fix=0) and a.visible=1 and a.id_user="'.$row_8["id"].'" and a.date_buy_all>="'.$date_start.'" and a.date_buy_all<"'.$date_end.'"');

        //echo 'SELECT sum(a.commission_fix) as comm,sum(a.commission) as comm1 FROM trips AS a WHERE  a.status=1 and not(a.commission_fix=0) and a.visible=1 and a.id_user="'.$row_8["id"].'" and a.date_buy_all>="'.$date_start.'" and a.date_buy_all<"'.$date_end.'"';

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




//ПЕРЕСЧЕТ КОМИССИИ У ПОЛЬЗОВАТЕЛЕЙ ЗА ТЕКУЩИЙ МЕСЯЦ СТАРЫЕ ЗАЯВКИ
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


//********************************************************************
//********************************************************************
//********************************************************************
//ДАТЬ НАПОМИНАЛКУ О  ПРЕДСТОЯЩЕЙ ОПЛАТЕ ОТ КЛИЕНТА ПО ТУРУ
//СЕГОДНЯ
//ЗАВТРА
//ПОСЛЕЗАВТРА
//|
//V

$date_start_plus3 = date_step_sql('Y-m-d', '+0d');
$date_end_plus3 = date_step_sql('Y-m-d', '+3d');

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
//СЕГОДНЯ
//ЗАВТРА
//ПОСЛЕЗАВТРА
//|
//V

$date_start_plus3 = date_step_sql('Y-m-d', '+0d');
$date_end_plus3 = date_step_sql('Y-m-d', '+3d');

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
//ДАТЬ ЗАДАЧУ О  ПРОШЕДШЕЙ ОПЛАТЕ ТУРОПЕРАТОРУ
//МИНУС 1 МЕСЯЦ НАЗАД И ДО СЕГОДНЯ
//БЫВАЕТ КОГДА СРОКИ ОПЛАТЫ ИЗМЕНИЛИ УЖЕ НА ПРОШЕДШИЕ ДАТЫ
//|
//V

$date_start_plus3 = date_step_sql('Y-m-d', '-1m');
$date_end_plus3 = date_step_sql('Y-m-d', '+0d');

$result_8 = mysql_time_query($link, 'SELECT A.id_trips,A.date,B.id_user,B.id_a_company FROM trips_payment_term AS A,trips as B WHERE A.id_trips=B.id and B.visible=1 and B.status=1 and A.type=1 and A.yes=0 and A.date>="' . $date_start_plus3 . ' 00:00:00" and A.date<"' . $date_end_plus3 . ' 00:00:00" AND A.visible=1');

$num_8 = $result_8->num_rows;
if ($result_8) {
    while ($row_8 = mysqli_fetch_assoc($result_8)) {


        $text_task = "Срок оплаты туроператору";

        TASK_SEND_NEW_NO_REMINDER($row_8["date"].' 23:59:59', $text_task, $row_8["id_trips"], 0, 18, $link, 0, $row_8["id_user"], $row_8["id_a_company"]);
        echo $text_task . '-' . $row_8["id_user"] . '-' . $row_8["id"] . '<br>';
        // }

    }
}


//X
//|
//ДАТЬ ЗАДАЧУ О  ПРОШЕДШЕЙ ОПЛАТЕ ТУРОПЕРАТОРУ
//********************************************************************
//********************************************************************
//********************************************************************

//********************************************************************
//********************************************************************
//********************************************************************
//ДАТЬ ЗАДАЧУ О  ПРОШЕДШЕЙ ОПЛАТЕ КЛИЕНТУ
//МИНУС 1 МЕСЯЦ НАЗАД И ДО СЕГОДНЯ
//БЫВАЕТ КОГДА СРОКИ ОПЛАТЫ ИЗМЕНИЛИ УЖЕ НА ПРОШЕДШИЕ ДАТЫ
//|
//V
$date_start_plus3 = date_step_sql('Y-m-d', '-1m');
$date_end_plus3 = date_step_sql('Y-m-d', '+0d');

$result_8 = mysql_time_query($link, 'SELECT A.id_trips,A.date,B.id_user,B.id_a_company FROM trips_payment_term AS A,trips as B WHERE A.id_trips=B.id and B.visible=1 and B.status=1 and A.type=0 and A.yes=0 and A.date>="' . $date_start_plus3 . ' 00:00:00" and A.date<"' . $date_end_plus3 . ' 00:00:00" AND A.visible=1');

$num_8 = $result_8->num_rows;
if ($result_8) {
    while ($row_8 = mysqli_fetch_assoc($result_8)) {


        $text_task = "Срок оплаты от туриста";

        TASK_SEND_NEW_NO_REMINDER($row_8["date"].' 23:59:59', $text_task, $row_8["id_trips"], 0, 19, $link, 0, $row_8["id_user"], $row_8["id_a_company"]);
        echo $text_task . '-' . $row_8["id_user"] . '-' . $row_8["id"] . '<br>';
        // }

    }
}

//X
//|
//ДАТЬ ЗАДАЧУ О  ПРОШЕДШЕЙ ОПЛАТЕ КЛИЕНТУ
//********************************************************************
//********************************************************************
//********************************************************************


//********************************************************************
//********************************************************************
//********************************************************************
//ПРОСМОТРЕТЬ ВСЕ ПРОСРОЧЕННЫЕ ЗАДАЧИ ПО СРОКАМ ТУРОПЕРАТОРУ И КЛИЕНТУ И ЕСЛИ ЧТО-ТО ОПЛАТИЛИ ВЫПОЛНИТЬ АВТОМАТИЧЕСКИ
//18 - туроператор
//19 - клиент/фирма
//|
//V

$date_start_plus3 = date_step_sql('Y-m-d', '+0d').' '.date("H:i:s");

$result_8 = mysql_time_query($link, 'SELECT A.* FROM task_new AS A WHERE A.visible=1 and A.status=0 and A.reminder=0 and  A.ring_datetime<"' . $date_start_plus3 .'" and ((A.action=18)or(A.action=19))');


$num_8 = $result_8->num_rows;
if ($result_8) {
    while ($row_8 = mysqli_fetch_assoc($result_8)) {

//смотрим может эта задача уже выполнена или вообще ее нет уже
        $type=0;
        if($row_8["action"]==18)
        {
            $type=1;
        }
        $date_mass = explode(" ", ht($row_8['ring_datetime']));


        $result_uu = mysql_time_query($link, 'select A.id from trips_payment_term as A where id_trips="' . ht($row_8['id_object']) . '" and A.visible=1 and A.yes=0 and A.type="'.$type.'" and A.date="'.$date_mass[0].'"');
        $num_results_uu = $result_uu->num_rows;

        if ($num_results_uu == 0) {

            mysql_time_query($link, 'update task_new set status="1" where id = "'.ht($row_8['id']).'"');
            $mas_responsible=explode(",",$row_8["id_user_responsible"]);
            foreach ($mas_responsible as $key => $value)
            {
                UpdateTaskKey($value,$link);
            }
        }
    }
}


//X
//|
//ПРОСМОТРЕТЬ ВСЕ ПРОСРОЧЕННЫЕ ЗАДАЧИ ПО СРОКАМ ТУРОПЕРАТОРУ И КЛИЕНТУ И ЕСЛИ ЧТО-ТО ОПЛАТИЛИ ВЫПОЛНИТЬ АВТОМАТИЧЕСКИ
//********************************************************************
//********************************************************************
//********************************************************************


//********************************************************************
//********************************************************************
//********************************************************************
//ПРОСМОТРЕТЬ ВСЕ БУДУЩИЕ НАПОМИНАЛКИ ПО СРОКАМ ОПЛАТЫ ТУРОПЕРАТОРУ И КЛИЕНТУ И ЕСЛИ ЧТО-ТО ОПЛАТИЛИ ВЫПОЛНИТЬ АВТОМАТИЧЕСКИ
//18 - туроператор
//19 - клиент/фирма
//|
//V

$date_start_plus3 = date_step_sql('Y-m-d', '+0d').' 00:00:00';

$result_8 = mysql_time_query($link, 'SELECT A.* FROM task_new AS A WHERE A.visible=1 and A.status=0 and A.reminder=1 and  A.ring_datetime>"' . $date_start_plus3 .'" and ((A.action=18)or(A.action=19))');


$num_8 = $result_8->num_rows;
if ($result_8) {
    while ($row_8 = mysqli_fetch_assoc($result_8)) {

//смотрим может эта задача уже выполнена или вообще ее нет уже
        $type=0;
        if($row_8["action"]==18)
        {
            $type=1;
        }
        $date_mass = explode(" ", ht($row_8['ring_datetime']));


        $result_uu = mysql_time_query($link, 'select A.id from trips_payment_term as A where id_trips="' . ht($row_8['id_object']) . '" and A.visible=1 and A.yes=0 and A.type="'.$type.'" and A.date="'.$date_mass[0].'"');
        $num_results_uu = $result_uu->num_rows;

        if ($num_results_uu == 0) {

            mysql_time_query($link, 'update task_new set status="1" where id = "'.ht($row_8['id']).'"');

            $mas_responsible=explode(",",$row_8["id_user_responsible"]);
            foreach ($mas_responsible as $key => $value)
            {
                UpdateTaskKey($value,$link);
            }


        }
    }
}


//X
//|
//ПРОСМОТРЕТЬ ВСЕ ПРОСРОЧЕННЫЕ ЗАДАЧИ ПО СРОКАМ ТУРОПЕРАТОРУ И КЛИЕНТУ И ЕСЛИ ЧТО-ТО ОПЛАТИЛИ ВЫПОЛНИТЬ АВТОМАТИЧЕСКИ
//********************************************************************
//********************************************************************
//********************************************************************
$cron_message='Выполнено';
mysql_time_query($link,'INSERT INTO cron_history (datetimes,script,message) VALUES ("'.date("Y-m-d").' '.date("H:i:s").'","task_new_1h_.php","'.ht($cron_message).'")');