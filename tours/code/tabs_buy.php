<?
//туры вкладка "платежи"

if((!isset($token_inlude))or($token_inlude!='taabbssd32.dfDS'))
{
    goto end_code;
    $debug=h4a(3,$echo_r,$debug);
}

$result_uu = mysql_time_query($link, 'select A.*,B.name from trips_payment as A, booking_payment_method as B where A.id_trips="'.ht($id).'" and A.id_payment_method=B.id and A.visible=1 order by A.date_payment DESC,date_create DESC');

$num_results_uu = $result_uu->num_rows;

if ($result_uu) {
    $i = 0;
    while ($row_uu = mysqli_fetch_assoc($result_uu)) {
        $edit_moo=1;
        include $url_system.'tours/code/block_buy.php';


    }
}

end_code:

?>