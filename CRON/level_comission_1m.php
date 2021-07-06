<?

//РОБОТ ПО ФОРМИРОВАНИЮ УРОВНЕЙ КОМИССИЙ НА СЛЕДУЮЩИЙ МЕСЯЦ
//КАЖДЫЙ МЕСЯЦ ПЕРВОГО ЧИСЛА В 01.30 НОЧИ
//ПЕРЕНОСИМ СО СТАРОГО МЕСЯЦА НА НОВЫЙ ВСЕ УРОВНИ


$url_system='../';
//подключение к базе
include_once $url_system.'module/config.php';
//подключение написанных функций для сайта
include_once $url_system.'module/function.php';

include_once $url_system.'ilib/lib_interstroi.php';

$date_new=date("Y-m-").'01';
$date_old=date_step_sql('Y-m-','-1m').'01';

$result_uu_cs = mysql_time_query($link, 'select id from a_company');

if ($result_uu_cs) {
    while ($row_uu_cs = mysqli_fetch_assoc($result_uu_cs)) {
        $result_uu = mysql_time_query($link, 'select a.* from users_commission_level as a where a.dates="' . ht($date_old) . '" and a.id_company="' . $row_uu_cs["id"] . '"');

        if ($result_uu) {
            $i = 0;
            while ($row_uu = mysqli_fetch_assoc($result_uu)) {

                mysql_time_query($link, 'INSERT INTO users_commission_level(level,sum_start,sum_end,proc,dates,id_company) VALUES( 
        "' . ht($row_uu["level"]) . '","' . ht($row_uu["sum_start"]) . '","' . ht($row_uu["sum_end"]) . '","' . ht($row_uu["proc"]) . '","' . $date_new . '","' . ht($row_uu["id_company"]) . '")');

            }
        }
    }
}


$cron_message='Выполнено';
mysql_time_query($link,'INSERT INTO cron_history (id,datetimes,script,message) VALUES ("","'.date("y.m.d").' '.date("H:i:s").'","level_comission_1m.php","'.ht($cron_message).'")');