<?

//РОБОТ ПО ПРЕВРАЩЕНИЮ НЕВЫПОЛНЕННЫХ (ПРОСРОЧЕННЫЕ) НАПОМИНАЛОК В ПРОСРОЧЕННЫЕ ЗАДАЧИ
//КАЖДЫЙ ДЕНЬ
//В 1.10 НОЧИ

$url_system='../';
//подключение к базе
include_once $url_system.'module/config.php';
//подключение написанных функций для сайта
include_once $url_system.'module/function.php';

include_once $url_system.'ilib/lib_interstroi.php'; 


//КРОМЕ НАПОМИНАЛОК О ТОМ ЧТО КЛИЕНТ УЛЕТАЕТ НА ОТДЫХ И С ОТДЫХА. ЕСЛИ НЕ ВЫПОЛНИЛИ ТО ПРОСТО НАДЕЮТСЯ ЧТО УЛЕТЕЛИ

$date_ring=date_step_sql('Y-m-d','0d');




//Уведомляем всех руководителей что просрочена оплата по туру от клиента или туроператору
$result_uu = mysql_time_query($link, 'select * from task_new where visible=1 and ((action=18)or(action=19)) and  reminder=1 and status=0 and ring_datetime<"'.$date_ring.' 00:00:00"');

if ($result_uu) {
    $i = 0;
    while ($row_uu = mysqli_fetch_assoc($result_uu)) {

        $result_uutt = mysql_time_query($link, 'select a.id_user,b.name_user,b.id_company from trips as a,r_user as b where b.id=a.id_user and a.id="' . ht($row_uu['id_object']) . '"');
        $num_results_uutt = $result_uutt->num_rows;

        if ($num_results_uutt != 0) {
            $row_uutt = mysqli_fetch_assoc($result_uutt);


            $komy='туроператору';
            $id_number=2;
            if($row_uu["action"]==19) {
                $komy = 'от клиента';
                $id_number=3;
            }



            $text_not = 'Просрочка по оплате '.$komy.'. <a href="/tours/.id-' . ht($row_uu['id_object']) . '">Тур №' . ht($row_uu['id_object']) . '</a>. Менеджер тура - '.$row_uutt["name_user"];

            $text_not1 = 'Просрочка по оплате '.$komy.'. <a href="/tours/.id-' . ht($row_uu['id_object']) . '">Тур №' . ht($row_uu['id_object']) . '</a>.';

            $user_send_new= array();
            $user_send_new=array_merge(UserNotNumberCompany($id_number,$row_uutt["id_company"],$link));

            rm_from_array(0,$user_send_new);

            $mass_ei = all_chief($row_uutt["id_user"], $link);  //находим кто руководит ним выше до верхушки
            $mass_ei = array_unique($mass_ei);

            $end_mass=exception_role($user_send_new,$mass_ei);  //формируем кто кто подписан на такое уведомление и есть в руководителях

            foreach ($end_mass as $keys => $value)
            {

                if($value!=$row_uutt["id_user"])
                {
                    //если это не менеджер которому принадлежит тур
                    notification_send( $text_not,[$value],0,$link);
                } else
                {
                    //это его тур
                    notification_send( $text_not1,[$value],0,$link);
                }

            }


           // notification_send( $text_not,$end_mass,0,$link);


        }

    }
}


mysql_time_query($link,'update task_new set reminder=0 where visible=1 and not(action=5) and not(action=6) and not(action=15) and not(action=16) and reminder=1 and status=0 and ring_datetime<"'.$date_ring.' 00:00:00"');




//НАПОМИНАЛКИ ПО ВЫЛЕТУ ПРИЛЕТУ ПРОСРОЧЕННЫЕ СКРЫВАЕМ ИХ НЕ НАДО УЖЕ ВИДЕТЬ ОНИ НЕАКТУАЛЬНЫ
mysql_time_query($link,'update task_new set visible=0 where visible=1 and ((action=5)or(action=6)or(action=15)or(action=16)) and reminder=1 and status=0 and ring_datetime<"'.$date_ring.' 00:00:00"');

//echo('update task_new set reminder=0 where visible=1 and reminder=1 and status=0 and ring_datetime<"'.$date_ring.' 00:00:00"');


$cron_message='Выполнено';
mysql_time_query($link,'INSERT INTO cron_history (id,datetimes,script,message) VALUES ("","'.date("y.m.d").' '.date("H:i:s").'","not_to_task_1d_.php","'.ht($cron_message).'")');