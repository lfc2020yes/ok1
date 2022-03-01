<?

//РОБОТ ПО СОХРАНЕНИЕ СУММЫ ЗАКРЫТИЙ КАСС
//КАЖДЫЙ ДЕНЬ
//В 12.05 НОЧИ

$url_system='../';
//подключение к базе
include_once $url_system.'module/config.php';
//подключение написанных функций для сайта
include_once $url_system.'module/function.php';

include_once $url_system.'ilib/lib_interstroi.php';
$date_=date("Y-m-d").' '.date("H:i:s");

$result_uu = mysql_time_query($link, 'select * from a_company_office');

if ($result_uu) {
    $i = 0;
    while ($row_uu = mysqli_fetch_assoc($result_uu)) {


        mysql_time_query($link, 'INSERT INTO cash_spot_history(id_office,summ,date) VALUES( 
        "' . ht($row_uu["id"]) . '","' . ht($row_uu["cash_spot"]) . '","'.$date_.'")');


    }
}

$cron_message='Выполнено';
mysql_time_query($link,'INSERT INTO cron_history (datetimes,script,message) VALUES ("'.date("y.m.d").' '.date("H:i:s").'","cash_backup_1d_.php","'.ht($cron_message).'")');