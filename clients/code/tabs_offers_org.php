<?
$query_string='<div class="booking_clients">';
$echo_xx=1;
$redd__='';

//вывод по новым турам
$sql_k = '
select DISTINCT Z.id from(
   (
  Select

  DISTINCT A.id,
   A.date_start
  
  from trips as A

  where  A.visible=1 AND A.id_a_company="' . $id_company . '" and A.id_shopper="'.$id.'" and A.shopper=2
)

) Z order by Z.date_start DESC';


$result_88 = mysql_time_query($link,$sql_k );
$num_88 = $result_88->num_rows;
//$row_1 = mysqli_fetch_assoc($result2);
if($result_88) {


    $com = 0;
    $cost = 0;
    $count_y = 0;
    $large_booking = 1;  // краткий вывод
    while ($row_88 = mysqli_fetch_assoc($result_88)) {


        $result_uuy = mysql_time_query($link, 'select A.id,A.discount,A.doc, A.id_user,A.shopper,A.id_shopper,A.id_contract,A.comment,A.number_to,A.hotel,A.id_country,A.place_name,A.date_start,A.date_end,A.number_to,A.id_contract,A.cost_client,A.id_exchange,A.cost_operator_exchange,A.cost_operator,A.cost_client_exchange,A.buy_clients,A.buy_operator,A.paid_operator,A.paid_operator_rates,A.exchange_rates,A.paid_client,A.paid_client_rates,A.date_prepaid,A.datecreate,A.id_operator from trips as A where A.id="' . ht($row_88['id']) . '"');
        $num_results_uuy = $result_uuy->num_rows;

        if ($num_results_uuy != 0) {
            $row_8 = mysqli_fetch_assoc($result_uuy);
        }

        //определим он отдыхающий или покупатель
        $pokup = '<span class="uc1">ПОКУПАТЕЛЬ</span>';


        $kuda_trips='';
        $result_uu = mysql_time_query($link, 'select name from trips_country where id="' . ht($row_8["id_country"]) . '"');
        $num_results_uu = $result_uu->num_rows;

        if ($num_results_uu != 0) {
            $row_uu = mysqli_fetch_assoc($result_uu);
            $kuda_trips .= $row_uu["name"];
        }
        if ($row_8['place_name'] != '') {
            $kuda_trips .= ', ' . $row_8['place_name'];
        }
        if ($row_8['hotel'] != '') {
            $kuda_trips .= ' / ' . $row_8['hotel'];
        }

        $date_mass = explode("-", ht($row_8['date_start']));
        $date_start = $date_mass[2] . '.' . $date_mass[1] . '.' . $date_mass[0];

        $date_mass = explode("-", ht($row_8['date_end']));
        $date_end = $date_mass[2] . '.' . $date_mass[1] . '.' . $date_mass[0];


        $query_string_xx = '<div rel_notib="' . $row_88["id"] . '" class="booking_cbb">';


//$query_string_xx.='<div class="number_cb"><span>'.$row_8["id"].'</span></div>';
        $query_string_xx .= '<div class="h_cb"><a href="tours/.id-' . $row_8["id"] . '"><span>' . $kuda_trips . '</span></a>';

        $query_string_xx .= '<div class="date_cb" data-tooltip="тур оформлен">' .$pokup. time_stamp($row_8["datecreate"]) . '</div>';


        //если продана или частично выводим номер договора или просто пусто
        $number_doc = '';


        $result_uu = mysql_time_query($link, 'select name,date_doc from trips_contract where id="' . ht($row_8["id_contract"]) . '"');
        $num_results_uu = $result_uu->num_rows;

        if ($num_results_uu != 0) {
            $row_uu = mysqli_fetch_assoc($result_uu);
            $date_doc_ = explode("-", $row_uu["name"]);
            $date_r1 = explode("/", htmlspecialchars(trimc($date_doc_[0])));

            $date_ddd = $date_r1[0] . '.' . $date_r1[1] . '.' . $date_r1[2];

        }

        $query_string_xx .= '<div class="doc_cb">' . $row_uu["name"] . ' от ' . date_ex(0, $row_uu["date_doc"]) . '</div>';
        $query_string_xx .= '</div>';


        $query_string_xx .= '<div class="right_offers_cb">';


        $query_string_xx .= '<div class="fly_cb">' . $date_start . ' - ' . $date_end . '</div>';

        $result_uu = mysql_time_query($link, 'select name from booking_operator where id="' . ht($row_8['id_operator']) . '"');
        $num_results_uu = $result_uu->num_rows;

        if ($num_results_uu != 0) {
            $row_uu = mysqli_fetch_assoc($result_uu);
        }

        $query_string_xx .= '<span>' . $row_uu["name"] . '</span>';
        $query_string_xx .= '<div class="cost_cb">' . rtrim(rtrim(number_format($row_8["cost_client"], 2, '.', ' '), '0'), '.') . ' руб.</div>';

        $query_string_xx .= '</div>';

        $query_string_xx .= '</div>';
//$query_string_xx.='</div>';

        $query_string .= $query_string_xx;


    }
}


//вывод по старым заявкам история
$result_8 = mysql_time_query($link,'select A.*,B.name from  booking as A,booking_status as B WHERE A.visible=1 and A.status=B.result_number and B.id_system=1 and ((A.status=3)or(A.status=6)) and A.id_client="'.$id.'" order by A.datetime desc ');



$num_8 = $result_8->num_rows;
//$row_1 = mysqli_fetch_assoc($result2);
if($result_8)
{


    $com=0;
    $cost=0;
    $count_y=0;
    $large_booking=1;  // краткий вывод
    while($row_8 = mysqli_fetch_assoc($result_8)){




        $query_string_xx='<div rel_notib="'.$row_8["id"].'" class="booking_cbb">';



//$query_string_xx.='<div class="number_cb"><span>'.$row_8["id"].'</span></div>';
        $query_string_xx.='<div class="h_cb"><a href="booking/'.$row_8["id"].'/"><span>'.$row_8["title"].'</span></a>';

        $query_string_xx.='<div class="date_cb" data-tooltip="Заявка поступила">'.time_stamp($row_8["date_create"]).'</div>';


        //если продана или частично выводим номер договора или просто пусто
        $number_doc='';


        $result_status22=mysql_time_query($link,'SELECT b.name,c.name as operator,a.cost,a.id FROM booking_offers AS a,booking_contract as b,booking_operator as c WHERE c.id=a.id_operator and (a.status=2) and a.id_booking="'.htmlspecialchars(trim($row_8["id"])).'" and a.id_contract=b.id');
        //echo('SELECT a.* FROM r_status AS a WHERE a.numer_status="'.$row1ss["status"].'" and a.id_system=13');
        if($result_status22->num_rows!=0)
        {
            $row_status22 = mysqli_fetch_assoc($result_status22);
            $number_doc=$row_status22["name"];
        }

        $query_string_xx.='<div class="doc_cb">'.$number_doc.'</div>';
        $query_string_xx.='</div>';


        $query_string_xx.='<div class="right_offers_cb">';




        $result_status22_fly_end=mysql_time_query($link,'SELECT yy.end_fly,yy.start_fly FROM booking_offers_fly_history AS yy WHERE yy.id_offers="'.htmlspecialchars(trim($row_status22["id"])).'" ORDER BY yy.datetime DESC LIMIT 0,1');

        if($result_status22_fly_end->num_rows!=0)
        {
            $row_status22_fly_end = mysqli_fetch_assoc($result_status22_fly_end);
            $D = explode(' ', $row_status22_fly_end["start_fly"]);
            $D1 = explode(' ', $row_status22_fly_end["end_fly"]);
            $query_string_xx.='<div class="fly_cb">'.MaskDate_D_M_Y_ss($D[0]).' — '.MaskDate_D_M_Y_ss($D1[0]).'</div>';

        }

        $query_string_xx.='<span>'.$row_status22["operator"].'</span>';
        $query_string_xx.='<div class="cost_cb">'.rtrim(rtrim(number_format($row_status22["cost"], 2, '.', ' '),'0'),'.').' руб.</div>';

        $query_string_xx.='</div>';

        $query_string_xx.='</div>';
//$query_string_xx.='</div>';

        $query_string.=$query_string_xx;






    }





}

if(($num_8==0)and($num_88==0))
{
    $query_string.='<div class="message_search_b message_clients_cb"><span>Информация о путешествиях неизвестна</span></div>';
}

$query_string.='</div>';