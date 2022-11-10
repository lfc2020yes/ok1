<?

//ПАРТНЕРКА
//РОБОТ ПО ПРОВЕРКЕ ТУРОВ КОТОРЫЕ В ПАРТНЕРКАХ РАЗБЛОКИРОВКА ЕСЛИ ПРИЛЕТЕЛИ
//КАЖДЫЙ ДЕНЬ

$url_system='../';
//подключение к базе
include_once $url_system.'module/config.php';
//подключение написанных функций для сайта
include_once $url_system.'module/function.php';
include_once $url_system.'ilib/lib_interstroi.php';



        $result_uu = mysql_time_query($link, 'select * from affiliates_history_trips');

        if ($result_uu) {
            $i = 0;

            while ($row_uu = mysqli_fetch_assoc($result_uu)) {
                $flag=0;
                $block = 1;
                $result_tr = mysql_time_query($link, 'Select 
  
  DISTINCT b.id_affiliates,b.date_end,
    (SELECT yy.start_fly FROM trips_fly_history AS yy WHERE yy.id_trips=b.id ORDER BY yy.datetime DESC LIMIT 0,1) AS fly_start,(SELECT yy.end_fly FROM trips_fly_history AS yy WHERE yy.id_trips=b.id ORDER BY yy.datetime DESC LIMIT 0,1) AS fly_end
  
  from trips as b where b.id="' . ht($row_uu["id_trips"]) . '" and not(b.id_affiliates=0)');
                $num_results_tr = $result_tr->num_rows;

                if ($num_results_tr != 0) {
                    $row_tr = mysqli_fetch_assoc($result_tr);

                    $flag=1;
                    //если он прилетел, то разблокируем деньги
                    if (($row_tr["fly_start"] != '') and ($row_tr["fly_start"] != '0000-00-00 00:00:00') and ($row_tr["fly_end"] != '') and ($row_tr["fly_end"] != '0000-00-00 00:00:00')) {

                        if ((date_end_today($row_tr["fly_start"])) and (date_end_today($row_tr["fly_end"]))) {
                            //по датам он прилетел деньги можно разблокировать сразу

                            $block = 0;
                        }
                    } else
                    {
                        //возможно он покупал какой то санаторий без вылетов на самолете
                        //проверяем по датам в договоре
                        echo($row_tr["date_end"]. '00:00:00');
                        if (date_end_today($row_tr["date_end"]. '00:00:00'))
                        {
                            $block = 0;
                        }

                    }

                }


                //удаляем из вопросов
                //исправляем тур
                if($flag==1)
                {

                    mysql_time_query($link, 'update affiliates_history_trips set
                    
                    block="'.$block.'"
                    
                    where id = "' . ht($row_uu['id']) . '"');

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
mysql_time_query($link,'INSERT INTO cron_history (datetimes,script,message) VALUES ("'.date("Y-m-d").' '.date("H:i:s").'","affiliates_trips_fly_1d_.php","'.ht($cron_message).'")');