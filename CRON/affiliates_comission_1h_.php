<?

//ПАРТНЕРКА
//РОБОТ ПО ФОРМИРОВАНИЮ КОМИССИЙ ПАРТНЕРОВ
//КАЖДЫЙ ЧАС

$url_system='../';
//подключение к базе
include_once $url_system.'module/config.php';
//подключение написанных функций для сайта
include_once $url_system.'module/function.php';
include_once $url_system.'ilib/lib_interstroi.php';

$result_8 = mysql_time_query($link,'SELECT A.id FROM r_user AS A where A.id_role=7');
$num_8 = $result_8->num_rows;	
if($result_8) {
    while ($row_8 = mysqli_fetch_assoc($result_8)) {
        $commission_all = 0;
        $commission_block = 0;
        $block = 1; //по умолчанию деньги в блокировки


        $result_uu = mysql_time_query($link, 'select sum(comission) as opop from affiliates_history_trips where id_users="'.ht($row_8['id']).'" and block=1');
        $num_results_uu = $result_uu->num_rows;

        if ($num_results_uu != 0) {
            $row_uu = mysqli_fetch_assoc($result_uu);
            if(($row_uu["opop"]!='')and($row_uu["opop"]!=0)) {
                $commission_block = $row_uu["opop"];
            }
            }

        $result_uu = mysql_time_query($link, 'select sum(comission) as opop from affiliates_history_trips where id_users="'.ht($row_8['id']).'"');
        $num_results_uu = $result_uu->num_rows;

        if ($num_results_uu != 0) {
            $row_uu = mysqli_fetch_assoc($result_uu);
            if(($row_uu["opop"]!='')and($row_uu["opop"]!=0)) {
                $commission_all = $row_uu["opop"];
            }
        }



            //обновляем данные по партнеру
            mysql_time_query($link, 'update affiliates set
            
            all_comission="'.$commission_all.'",
            block_comission="'.$commission_block.'"
            
            where id_users = "'.ht($row_8['id']).'"');


        }

}


//X
//|
//ПРОСМОТРЕТЬ ВСЕ ПРОСРОЧЕННЫЕ ЗАДАЧИ ПО СРОКАМ ТУРОПЕРАТОРУ И КЛИЕНТУ И ЕСЛИ ЧТО-ТО ОПЛАТИЛИ ВЫПОЛНИТЬ АВТОМАТИЧЕСКИ
//********************************************************************
//********************************************************************
//********************************************************************
$cron_message='Выполнено';
mysql_time_query($link,'INSERT INTO cron_history (datetimes,script,message) VALUES ("'.date("Y-m-d").' '.date("H:i:s").'","affiliates_comission_1h_.php","'.ht($cron_message).'")');