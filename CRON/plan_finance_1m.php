<?

//РОБОТ ПО ФОРМИРОВАНИЮ ПЕРЕНОСУ МЕСЯЧНЫХ ОПЕРАЦИЯ НА СЛЕДУЮЩИЙ МЕСЯЦ
//РОБОТ ПО ФОРМИРОВАНИЮ ПЕРЕНОСУ ПЛАНОВ ПО РАСХОДАМ/ДОХОДАМ НА СЛЕДУЮЩИЙ МЕСЯЦ
//КАЖДЫЙ МЕСЯЦ ПЕРВОГО ЧИСЛА В 01.30 НОЧИ
//ПЕРЕНОСИМ СО СТАРОГО МЕСЯЦА НА НОВЫЙ


$url_system='../';
//подключение к базе
include_once $url_system.'module/config.php';
//подключение написанных функций для сайта
include_once $url_system.'module/function.php';

include_once $url_system.'ilib/lib_interstroi.php';



//МЕСЯЧНЫХ ОПЕРАЦИЯ
//МЕСЯЧНЫХ ОПЕРАЦИЯ
//МЕСЯЧНЫХ ОПЕРАЦИЯ
$date_new=date("Y-m-").'01';
$date_old=date_step_sql('Y-m-','-1m').'01';

$result_uu_cs = mysql_time_query($link, 'select id from a_company');

if ($result_uu_cs) {
    while ($row_uu_cs = mysqli_fetch_assoc($result_uu_cs)) {
        $result_uu = mysql_time_query($link, 'select a.* from finance_operation as a where a.visible=1 and a.constant=1 and ((a.income=0)or(a.income=1)) and a.date>="' . ht($date_old) . '" and a.date<"' . ht($date_new) . '" and a.id_a_company="' . $row_uu_cs["id"] . '"');

        if ($result_uu) {
            $i = 0;
            while ($row_uu = mysqli_fetch_assoc($result_uu)) {

                $date_mass = explode("-", ht($row_uu["date"]));
                $date_new_x=date("Y-m-").$date_mass[2];

                mysql_time_query($link, 'INSERT INTO finance_operation(id_a_company,id_type,constant,income,date,date_create,sum,id_user,comment,visible) VALUES( 
        "' . ht($row_uu["id_a_company"]) . '","' . ht($row_uu["id_type"]) . '","' . ht($row_uu["constant"]) . '","' . ht($row_uu["income"]) . '","' . $date_new_x . '","' . ht($row_uu["date_create"]) . '","' . ht($row_uu["sum"]) . '","' . ht($row_uu["id_user"]) . '","' . ht($row_uu["comment"]) . '","1")');

            }
        }
    }
}
//МЕСЯЧНЫХ ОПЕРАЦИЯ
//МЕСЯЧНЫХ ОПЕРАЦИЯ
//МЕСЯЧНЫХ ОПЕРАЦИЯ

//ПЕРЕНОСУ ПЛАНОВ
//ПЕРЕНОСУ ПЛАНОВ
//ПЕРЕНОСУ ПЛАНОВ

$date_new=date("Y-m-").'01';
$date_old=date_step_sql('Y-m-','-1m').'01';

$result_uu_cs = mysql_time_query($link, 'select id from a_company');

if ($result_uu_cs) {
    while ($row_uu_cs = mysqli_fetch_assoc($result_uu_cs)) {
        $result_uu = mysql_time_query($link, 'select a.* from finance_plane as a where  a.date="' . ht($date_old) . '" and a.id_a_company="' . $row_uu_cs["id"] . '"');

        if ($result_uu) {
            $i = 0;
            while ($row_uu = mysqli_fetch_assoc($result_uu)) {

                mysql_time_query($link, 'INSERT INTO finance_plane(id_a_company,date,income,expense) VALUES( 
        "' . ht($row_uu["id_a_company"]) . '","' . $date_new . '","' . ht($row_uu["income"]) . '","' . ht($row_uu["expense"]) . '")');

            }
        }
    }
}

//ПЕРЕНОСУ ПЛАНОВ
//ПЕРЕНОСУ ПЛАНОВ
//ПЕРЕНОСУ ПЛАНОВ