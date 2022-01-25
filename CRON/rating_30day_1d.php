<?

//РОБОТ ПО ФОРМИРОВАНИЮ РЕЙТИНГОВ УЧАСТНИКОВ
//КАЖДЫЙ ДЕНЬ В 02.00 НОЧИ
//СЧИТАЕТ ЗА ПРОШЛЫЙ ДЕНЬ


$url_system='../';
//подключение к базе
include_once $url_system.'module/config.php';
//подключение написанных функций для сайта
include_once $url_system.'module/function.php';

include_once $url_system.'ilib/lib_interstroi.php';

//по убыванию
function cmp($a, $b)
{
    $result = 0;
    if ($b["ball"] > $a["ball"]) {
        $result = 1;
    } else if ($b["ball"] < $a["ball"]) {
        $result = -1;
    }
    return $result;
}
//по возрастанию
function cmp1($a, $b)
{
    $result = 0;
    if ($a["proc"] > $b["proc"]) {
        $result = 1;
    } else if ($a["proc"] < $b["proc"]) {
        $result = -1;
    }
    return $result;
    // return strcmp((float)$a["proc"], (float)$b["proc"]);
}

//рейтинг на лучшего продавана месяца
//50% успеха количество продаж
//50% успеха сумма комисий
//********************************************************************
//********************************************************************
//********************************************************************
//|
//V
$number_ra=1;

$date_start=date("Y-m-").'01';
$date_end=date_step_sql('Y-m-d','+0d');
$month_s=date("Y-m-");
//если сегодня начало нового месяца
if(date("j")==1)
{
    //берем весь период прошлого месяца чтобы подвести конечные итоги
    $date_start=date_step_sql('Y-m-','-1m').'01';
    $date_end=date_step_sql('Y-m-d','-1d');
    $month_s=date_step_sql('Y-m-','-1m');
}

//узнаем максимальное количество у кого комиссии



$result_uu_cs = mysql_time_query($link, 'select id from a_company');

if ($result_uu_cs) {
    while ($row_uu_cs = mysqli_fetch_assoc($result_uu_cs)) {

        $max_comission=0;
        $max_count=0;
        $comission = array();
        $count = array();
        $id_users = array();

        $ball=array();

       $LIKE=' and ((A.id_company LIKE "'.ht($row_uu_cs["id"]).',%")or(A.id_company LIKE "%,'.ht($row_uu_cs["id"]).',%")or(A.id_company LIKE "%,'.ht($row_uu_cs["id"]).'")or(A.id_company="'.ht($row_uu_cs["id"]).'")) ';

$result_8 = mysql_time_query($link,'SELECT A.id FROM r_user AS A where A.enabled="1"  AND A.id_role IN(2,3) '.$LIKE);
$num_8 = $result_8->num_rows;
if($result_8) {
    $n=0;
    while ($row_8 = mysqli_fetch_assoc($result_8)) {

        array_push($id_users, $row_8["id"]);
        //$ball['id_users'][]=$row_8["id"];
        //array_push($ball['id_users'], $row_8["id"]);

        $ball[$n]['id_users']=$row_8["id"];

        $result_status21 = mysql_time_query($link, 'SELECT sum(a.commission) as comm FROM trips AS a WHERE a.id_a_company="'.$row_uu_cs["id"].'" and  a.status=1 and a.visible=1 and a.id_user="' . $row_8["id"] . '" and a.date_buy_all>="' . $date_start . '" and a.date_buy_all<="' . $date_end . '"');

        if ($result_status21->num_rows != 0) {
            $row_status21 = mysqli_fetch_assoc($result_status21);

            if ($row_status21["comm"] == '') {
                $row_status21["comm"] = 0;
            }
        }
        if ($row_status21["comm"] > $max_comission) {
            $max_comission = $row_status21["comm"];
        }
        array_push($comission, $row_status21["comm"]);
        //$ball['comission'][]=$row_status21["comm"];
        //array_push($ball['comission'], $row_status21["comm"]);
        $ball[$n]['comission']=$row_status21["comm"];
        $ball[$n]['id_company']=$row_uu_cs["id"];

        //узнаем сколько всего оформленных туров в этом месяце
        $result_uu = mysql_time_query($link, 'select count(A.id) as kol from trips as A where  A.id_a_company="'.$row_uu_cs["id"].'" and A.visible=1 and A.id_user="' . $row_8["id"] . '" and A.datecreate like "' . $month_s . '%"');

        $num_results_uu = $result_uu->num_rows;
        if ($num_results_uu != 0) {
            $row_uu = mysqli_fetch_assoc($result_uu);
            if ($row_uu["kol"] == '') {
                $row_uu["kol"] = 0;
            }

        }
        if ($row_uu["kol"] > $max_count) {
            $max_count = $row_uu["kol"];
        }
        array_push($count, $row_uu["kol"]);
        //$ball['count'][]=$row_uu["kol"];
        //array_push($ball['count'], $row_uu["kol"]);
        $ball[$n]['count']=$row_uu["kol"];
        $n++;
    }
}

//$comission = array();
//$count = array();

//echo($max_count);

//добавление в многомерный массив общего балла
foreach ($id_users as $key => $value) {

    if ($comission[$key] > 0) {
        $ball1 = ((($comission[$key] * 100 / $max_comission) / 10) );
        if ($ball1 < 0) {
            $ball1 = 0;
        }
    } else {
        $ball1 = 0;
    }
    if ($count[$key] > 0) {
        $ball2 = ((($count[$key] * 100 / $max_count) / 10) );
        if ($ball2 < 0) {
            $ball2 = 0;
        }
    } else {
        $ball2 = 0;
    }

    $ball_end=($ball1 + $ball2) / 2;
    if($ball_end>0.5)
    {
        $ball_end=$ball_end-0.5;
    }
    $ball_end = round($ball_end, 1);
    $ball[$key]['ball'] = $ball_end;

}

//сортировка двухмерного массива по баллу

usort($ball, "cmp");


        foreach ($ball as $key => $value) {

    //узнаем какое место было до этого позавчера по конкретной компании
    $date_end=date_step_sql('Y-m-d','-2d');
    $result_uu = mysql_time_query($link, 'select A.numbers from users_rating as A where A.id_a_company="'.$value["id_company"].'" and A.number_rating="'.$number_ra.'" and A.id_users="' . ht($value["id_users"]) . '" and A.date="'.$date_end.'"');
    $num_results_uu = $result_uu->num_rows;

    $number_old=0;
    if ($num_results_uu != 0) {
        $row_uu = mysqli_fetch_assoc($result_uu);
        $number_old=$row_uu["numbers"];
    }


    if($key==0)
    {
        //и сегодня не 2 число месяца когда новые рейтинги только появились
        if(date('j')!=2)
        {

            if($number_old!=($key+1))
            {
                //У нас новый лидер рейтинга

                $result_uuee = mysql_time_query($link, 'select name from rating where id="' . ht($number_ra) . '"');
                $num_results_uuee = $result_uuee->num_rows;

                if ($num_results_uuee != 0) {
                    $row_uuee = mysqli_fetch_assoc($result_uuee);
                }


                $text_not='В Рейтинге «'.$row_uuee["name"].'» новый лидер.';

                $user_send_new= array();
                $user_send_new=array_merge(UserNotNumberCompany(4,$row_uu_cs["id"],$link));

                rm_from_array(0,$user_send_new);



                $user_send_new= array_unique($user_send_new);

                notification_send( $text_not,$user_send_new,0,$link);

            }

        }


    }





    mysql_time_query($link, 'INSERT INTO users_rating(id_users,id_a_company, number_rating,date,numbers,numbers_old,rates) VALUES( 
    "' . ht($value["id_users"]) . '",
    "' . ht($row_uu_cs["id"]) . '",
    "'.$number_ra.'",
    "'.date_step_sql('Y-m-d','-1d').'",
    "'.($key+1).'",
    "'.$number_old.'",
    "'.$value["ball"].'"
    
    )');

}

    }
}


//добавление победителя за прошлый месяц если сегодня первое число
if(date("j")==1) {
    //берем весь период прошлого месяца чтобы подвести конечные итоги
    $date_start = date_step_sql('Y-m-', '-1m') . '01';
    $date_end = date_step_sql('Y-m-d', '-1d');
    $month_s = date_step_sql('Y-m-', '-1m');


    $result_uu_cs = mysql_time_query($link, 'select id from a_company');

    if ($result_uu_cs) {
        while ($row_uu_cs = mysqli_fetch_assoc($result_uu_cs)) {

            $result_uu_rate = mysql_time_query($link, 'select A.id_users from users_rating as A where A.number_rating="' . $number_ra . '" and A.id_a_company="' . ht($row_uu_cs["id"]) . '" and  A.numbers="1" and A.date="' . $date_end . '"');
            $num_results_uu_rate = $result_uu_rate->num_rows;

            if ($num_results_uu_rate != 0) {
                $row_uu_rate = mysqli_fetch_assoc($result_uu_rate);
                mysql_time_query($link, 'INSERT INTO `users_rating_record` (
                
  `id_a_company`,
  `date`,
  `number_rating`,
  `id_users_winner`
) 
VALUES
(
    
    "' . ht($row_uu_cs["id"]) . '",
    "' . $date_start . '",
    "' . $number_ra . '",
    "' . ht($row_uu_rate["id_users"]) . '"
)');


            }

        }


    }
}
//узнаем максимальное количество у кого комиссии








//X
//|
//********************************************************************
//********************************************************************
//********************************************************************
//рейтинг на лучшего продавана месяца


//рейтинг Сногсшибательная щедрость
//у кого самая маленькая комиссия или вообще отрицательная тот выигрывает антирейтинг так сказать
//********************************************************************
//********************************************************************
//********************************************************************
//|
//V
$number_ra=2;



$date_start=date("Y-m-").'01';
$date_end=date_step_sql('Y-m-d','+0d');
$month_s=date("Y-m-");
//если сегодня начало нового месяца
if(date("j")==1)
{
    //берем весь период прошлого месяца чтобы подвести конечные итоги
    $date_start=date_step_sql('Y-m-','-1m').'01';
    $date_end=date_step_sql('Y-m-d','-1d');
    $month_s=date_step_sql('Y-m-','-1m');
}

//узнаем максимальное количество у кого комиссии



$result_uu_cs = mysql_time_query($link, 'select id from a_company');

if ($result_uu_cs) {
    while ($row_uu_cs = mysqli_fetch_assoc($result_uu_cs)) {

        $max_comission=0;
        $max_count=0;
        $proc = array();
        $id_users = array();

        $ball=array();


        $result_8 = mysql_time_query($link,'SELECT A.id FROM r_user AS A where A.enabled="1" and A.id_company="'.$row_uu_cs["id"].'"  AND A.id_role IN(2,3)');
        $num_8 = $result_8->num_rows;
        if($result_8) {
            $n=0;
            while ($row_8 = mysqli_fetch_assoc($result_8)) {

                array_push($id_users, $row_8["id"]);
                //$ball['id_users'][]=$row_8["id"];
                //array_push($ball['id_users'], $row_8["id"]);

                $ball[$n]['id_users']=$row_8["id"];
                $ball[$n]['id_company']=$row_uu_cs["id"];


                $result_status21 = mysql_time_query($link, 'SELECT MIN(A.commission*100/A.cost_client) AS mi FROM trips AS A WHERE A.id_a_company="'.$row_uu_cs["id"].'" and A.visible=1 AND A.id_user="' . $row_8["id"] . '" AND A.date_buy_all LIKE "'.$month_s.'%"');

                if ($result_status21->num_rows != 0) {
                    $row_status21 = mysqli_fetch_assoc($result_status21);

                    if ($row_status21["mi"] == '') {
                        $row_status21["mi"] = 0;
                    }
                }

                array_push($proc, $row_status21["mi"]);
                //$ball['comission'][]=$row_status21["comm"];
                //array_push($ball['comission'], $row_status21["comm"]);
                $ball[$n]['proc']=round($row_status21["mi"],1);

                $n++;
            }
        }

//$comission = array();
//$count = array();

        //echo($max_count);

//print_r ($ball);

//сортировка двухмерного массива по баллу
//echo('<br><br>');
        usort($ball, "cmp1");
//        print_r ($ball);
$nn=1;
        foreach ($ball as $key => $value) {
            if ($value["proc"] > 0) {
                //узнаем какое место было до этого позавчера
                $date_end = date_step_sql('Y-m-d', '-2d');
                $result_uu = mysql_time_query($link, 'select A.numbers from users_rating as A where A.number_rating="' . $number_ra . '" and A.id_a_company="'.$value["id_company"].'" and A.id_users="' . ht($value["id_users"]) . '" and A.date="' . $date_end . '"');
                $num_results_uu = $result_uu->num_rows;

                $number_old = 0;
                if ($num_results_uu != 0) {
                    $row_uu = mysqli_fetch_assoc($result_uu);
                    $number_old = $row_uu["numbers"];
                }

                mysql_time_query($link, 'INSERT INTO users_rating(id_users,id_a_company, number_rating,date,numbers,numbers_old,rates) VALUES( 
    "' . ht($value["id_users"]) . '",
    "' . ht($row_uu_cs["id"]) . '",
    "' . $number_ra . '",
    "' . date_step_sql('Y-m-d', '-1d') . '",
    "' . ($nn) . '",
    "' . $number_old . '",
    "' . $value["proc"] . '"
    
    )');
                $nn++;

            }
        }
    }
}

//добавление победителя за прошлый месяц если сегодня первое число
if(date("j")==1) {
    //берем весь период прошлого месяца чтобы подвести конечные итоги
    $date_start = date_step_sql('Y-m-', '-1m') . '01';
    $date_end = date_step_sql('Y-m-d', '-1d');
    $month_s = date_step_sql('Y-m-', '-1m');


    $result_uu_cs = mysql_time_query($link, 'select id from a_company');

    if ($result_uu_cs) {
        while ($row_uu_cs = mysqli_fetch_assoc($result_uu_cs)) {

            $result_uu_rate = mysql_time_query($link, 'select A.id_users from users_rating as A where A.number_rating="' . $number_ra . '" and A.id_a_company="' . ht($row_uu_cs["id"]) . '" and  A.numbers="1" and A.date="' . $date_end . '"');
            $num_results_uu_rate = $result_uu_rate->num_rows;

            if ($num_results_uu_rate != 0) {
                $row_uu_rate = mysqli_fetch_assoc($result_uu_rate);
                mysql_time_query($link, 'INSERT INTO `users_rating_record` (
                
  `id_a_company`,
  `date`,
  `number_rating`,
  `id_users_winner`
) 
VALUES
(
    
    "' . ht($row_uu_cs["id"]) . '",
    "' . $date_start . '",
    "' . $number_ra . '",
    "' . ht($row_uu_rate["id_users"]) . '"
)');


            }

        }


    }
}



//X
//|
//********************************************************************
//********************************************************************
//********************************************************************
//рейтинг Лучший критик и комментатор
//учитываются какое количество из прилетевних туристов опрошено и добавлено впечатлений в этом месяце
//учитывается кол-во таких прилетевших (но это только 25% от общей оценки)
//получается что нужно не только опрашивать всех но и продавать путевки чтобы рейтинг этот был выше

$number_ra=3;



$date_start=date("Y-m-").'01';
$date_end=date_step_sql('Y-m-d','+0d');
$month_s=date("Y-m-");
//если сегодня начало нового месяца
if(date("j")==1)
{
    //берем весь период прошлого месяца чтобы подвести конечные итоги
    $date_start=date_step_sql('Y-m-','-1m').'01';
    $date_end=date_step_sql('Y-m-d','-1d');
    $month_s=date_step_sql('Y-m-','-1m');
}

//узнаем максимальное количество у кого комиссии



$result_uu_cs = mysql_time_query($link, 'select id from a_company');

if ($result_uu_cs) {
    while ($row_uu_cs = mysqli_fetch_assoc($result_uu_cs)) {

        $max_count=0;
        $max_sr_len=0;
        $count = array();
        $id_users = array();
        $comm = array();
        $sr_len = array();

        $ball=array();


        $result_8 = mysql_time_query($link,'SELECT A.id FROM r_user AS A where A.enabled="1" and A.id_company="'.$row_uu_cs["id"].'" AND A.id_role IN(2,3)');
        $num_8 = $result_8->num_rows;
        if($result_8) {
            $n=0;
            while ($row_8 = mysqli_fetch_assoc($result_8)) {

                array_push($id_users, $row_8["id"]);
                $ball[$n]['id_users']=$row_8["id"];
                $ball[$n]['id_company']=$row_uu_cs["id"];


$result_status21 = mysql_time_query($link, 'SELECT count(A.id) as mi FROM trips AS A WHERE A.id_a_company="'.$row_uu_cs["id"].'" and A.visible=1 AND A.id_user="' . $row_8["id"] . '" and (SELECT yy.end_fly FROM trips_fly_history AS yy WHERE yy.id_trips=A.id ORDER BY yy.datetime DESC LIMIT 0,1)>="' . $date_start . ' 00:00:00" and (SELECT yy.end_fly FROM trips_fly_history AS yy WHERE yy.id_trips=A.id ORDER BY yy.datetime DESC LIMIT 0,1)<"' . $date_end . ' 00:00:00"');

                if ($result_status21->num_rows != 0) {
                    $row_status21 = mysqli_fetch_assoc($result_status21);

                    if ($row_status21["mi"] == '') {
                        $row_status21["mi"] = 0;
                    }
                }

                array_push($count, $row_status21["mi"]);
                $ball[$n]['count']=round($row_status21["mi"],1);

                if ($row_status21["mi"] > $max_count) {
                    $max_count = $row_status21["mi"];
                }


//******************************
//******************************

$result_status21 = mysql_time_query($link, 'SELECT A.comment FROM trips AS A WHERE A.id_a_company="'.$row_uu_cs["id"].'" and A.visible=1 AND A.id_user="' . $row_8["id"] . '" and (SELECT yy.end_fly FROM trips_fly_history AS yy WHERE yy.id_trips=A.id ORDER BY yy.datetime DESC LIMIT 0,1)>="' . $date_start . ' 00:00:00" and (SELECT yy.end_fly FROM trips_fly_history AS yy WHERE yy.id_trips=A.id ORDER BY yy.datetime DESC LIMIT 0,1)<"' . $date_end . ' 00:00:00" and not(A.comment="")');

                $count_len=0;
                $count_mi=0;
                if ($result_status21) {
                    while ($row_uu21 = mysqli_fetch_assoc($result_status21)) {
                        if(trim($row_uu21["comment"])!='') {
                            $count_len = $count_len + strlen($row_uu21["comment"]);
                            $count_mi++;
                        }
                    }
                }

//******************************
//******************************

/*
                $result_status21 = mysql_time_query($link, 'SELECT count(A.id) as mi FROM trips AS A WHERE A.visible=1 AND A.id_user="' . $row_8["id"] . '" and (SELECT yy.end_fly FROM trips_fly_history AS yy WHERE yy.id_trips=A.id ORDER BY yy.datetime DESC LIMIT 0,1)>="' . $date_start . ' 00:00:00" and (SELECT yy.end_fly FROM trips_fly_history AS yy WHERE yy.id_trips=A.id ORDER BY yy.datetime DESC LIMIT 0,1)<"' . $date_end . ' 00:00:00" and not(A.comment="")');
*/
/*
                if ($result_status21->num_rows != 0) {
                    $row_status21 = mysqli_fetch_assoc($result_status21);

                    if ($row_status21["mi"] == '') {
                        $row_status21["mi"] = 0;
                    }
                }

                array_push($comm, $row_status21["mi"]);
                $ball[$n]['comm']=round($row_status21["mi"],1);
                $n++;
*/
if($count_mi!=0) {
    $srr = round(($count_len / $count_mi), 1);
    array_push($comm, $count_mi);
    array_push($sr_len, $srr);
    $ball[$n]['comm'] = round($count_mi, 1);
    $ball[$n]['sr_len'] = round(($count_len / $count_mi), 1);

    if ($srr > $max_sr_len) {
        $max_sr_len = $srr;
    }
} else
{
    array_push($comm, 0);
    array_push($sr_len, 0);
    $ball[$n]['comm'] = 0;
    $ball[$n]['sr_len'] = 0;
}
                $n++;
            }
        }

//$comission = array();
//$count = array();

        //echo($max_count);
//добавление в многомерный массив общего балла
        foreach ($id_users as $key => $value) {

            if ($comm[$key] > 0) {
                $ball1 = ((($comm[$key] * 100 / $count[$key]) / 10) );
                if ($ball1 < 0) {
                    $ball1 = 0;
                }
            } else {
                $ball1 = 0;
            }
            if ($count[$key] > 0) {
                $ball2 = ((($sr_len[$key] * 100 / $max_sr_len) / 10) );
                if ($ball2 < 0) {
                    $ball2 = 0;
                }
            } else {
                $ball2 = 0;
            }

            $ball_end=($ball1 + $ball2) / 2;

           /* if($ball_end>0.5)
            {
                $ball_end=$ball_end-0.5;
            }
           */
            $ball_end = round($ball_end, 1);
            $ball[$key]['ball'] = $ball_end;

        }

//сортировка двухмерного массива по баллу

        usort($ball, "cmp");

        //print_r($ball);

        foreach ($ball as $key => $value) {

                //узнаем какое место было до этого позавчера
                $date_end = date_step_sql('Y-m-d', '-2d');
                $result_uu = mysql_time_query($link, 'select A.numbers from users_rating as A where A.id_a_company="'.ht($value["id_company"]).'" and A.number_rating="' . $number_ra . '" and A.id_users="' . ht($value["id_users"]) . '" and A.date="' . $date_end . '"');
                $num_results_uu = $result_uu->num_rows;

                $number_old = 0;
                if ($num_results_uu != 0) {
                    $row_uu = mysqli_fetch_assoc($result_uu);
                    $number_old = $row_uu["numbers"];
                }

            if($key==0)
            {
                //и сегодня не 2 число месяца когда новые рейтинги только появились
                if(date('j')!=2)
                {

                    if($number_old!=($key+1))
                    {
                        //У нас новый лидер рейтинга

                        $result_uuee = mysql_time_query($link, 'select name from rating where id="' . ht($number_ra) . '"');
                        $num_results_uuee = $result_uuee->num_rows;

                        if ($num_results_uuee != 0) {
                            $row_uuee = mysqli_fetch_assoc($result_uuee);
                        }


                        $text_not='В Рейтинге «'.$row_uuee["name"].'» новый лидер.';

                        $user_send_new= array();
                        $user_send_new=array_merge(UserNotNumberCompany(4,$row_uu_cs["id"],$link));

                        rm_from_array(0,$user_send_new);



                        $user_send_new= array_unique($user_send_new);

                        notification_send( $text_not,$user_send_new,0,$link);

                    }

                }


            }



                mysql_time_query($link, 'INSERT INTO users_rating(id_users,id_a_company, number_rating,date,numbers,numbers_old,rates) VALUES( 
    "' . ht($value["id_users"]) . '",
    "' . ht($row_uu_cs["id"]) . '",
    "' . $number_ra . '",
    "' . date_step_sql('Y-m-d', '-1d') . '",
    "' . ($key + 1) . '",
    "' . $number_old . '",
    "' . $value["ball"] . '"
    
    )');

//echo($value["ball"]);
        }
    }
}

//добавление победителя за прошлый месяц если сегодня первое число
if(date("j")==1) {
    //берем весь период прошлого месяца чтобы подвести конечные итоги
    $date_start = date_step_sql('Y-m-', '-1m') . '01';
    $date_end = date_step_sql('Y-m-d', '-1d');
    $month_s = date_step_sql('Y-m-', '-1m');


    $result_uu_cs = mysql_time_query($link, 'select id from a_company');

    if ($result_uu_cs) {
        while ($row_uu_cs = mysqli_fetch_assoc($result_uu_cs)) {

            $result_uu_rate = mysql_time_query($link, 'select A.id_users from users_rating as A where A.number_rating="' . $number_ra . '" and A.id_a_company="' . ht($row_uu_cs["id"]) . '" and  A.numbers="1" and A.date="' . $date_end . '"');
            $num_results_uu_rate = $result_uu_rate->num_rows;

            if ($num_results_uu_rate != 0) {
                $row_uu_rate = mysqli_fetch_assoc($result_uu_rate);
                mysql_time_query($link, 'INSERT INTO `users_rating_record` (
                
  `id_a_company`,
  `date`,
  `number_rating`,
  `id_users_winner`
) 
VALUES
(
    
    "' . ht($row_uu_cs["id"]) . '",
    "' . $date_start . '",
    "' . $number_ra . '",
    "' . ht($row_uu_rate["id_users"]) . '"
)');


            }

        }


    }
}

//X
//|
//********************************************************************
//********************************************************************
//********************************************************************
//рейтинг Лучший критик и комментатор


$cron_message='Выполнено';
mysql_time_query($link,'INSERT INTO cron_history (id,datetimes,script,message) VALUES ("","'.date("y.m.d").' '.date("H:i:s").'","rating_30day_1d.php","'.ht($cron_message).'")');