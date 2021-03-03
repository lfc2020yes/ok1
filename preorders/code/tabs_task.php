<?
//загрузить дополнительные прикреплленные файлы и документы по клиенту частное лицо

$query_string.='<div class="input-block-2020">';


$result_8 = mysql_time_query($link,'SELECT * FROM((select A.*,0 as flag from  task_new as A,preorders as K WHERE K.id=A.id_object and A.id_user_responsible="' . ht($id_user) . '" and A.visible=1 and A.id_a_company="' . ht($id_company) . '" and A.status=0 and A.action=20 and A.id_object="' . ht($row_8["id"]) . '"  
  )) LL order by LL.ring_datetime');

$max_day_ring=10;
$num_8 = $result_8->num_rows;
//$pros=1;

if($num_8>0) {


    if ($num_8 > 0) {
        $query_string .= '<div class="ring_block preorders-viv js-ring-3" style="margin-bottom: 20px;">';
    } else {
        $query_string .= '<div style="display:none; margin-bottom: 20px;"  class="ring_block ring-block-line js-ring-3">';
    }
    $query_string .= '<div class="h1-ring"><span>задачи по обращению №' . $row_8["id"] . '</span><i></i></div>';
    if (($num_8 - $max_day_ring) > 0) {
        $query_string .= '<div max="' . $max_day_ring . '" class="eshe-ring js-eshe-ring"><span class="ring-x1">еще ' . ($num_8 - $max_day_ring) . '</span><span class="ring-x2">Скрыть</span></div>';
    } else {
        $query_string .= '<div style="display:none;" max="' . $max_day_ring . '" class="eshe-ring js-eshe-ring"><span class="ring-x1">еще ' . ($num_8 - $max_day_ring) . '</span><span class="ring-x2">Скрыть</span></div>';
    }

    $query_string .= '<div class="block-ring-x">';
    if (($result_8) and ($num_8 > 0)) {
        $count_ring = 0;
        $class_ring = '';
        while ($row_8 = mysqli_fetch_assoc($result_8)) {
            if ($count_ring >= $max_day_ring) {
                $class_ring = 'max-day-ring';
            }
            $big_date = 1;

            $zad=dateDiff_1(date("y-m-d").' '.date("H:i:s"),$row_8["ring_datetime"]);
            $pros=0;
            if(($zad>0)and($row_8["status"]==0))
            {

                $pros=1;
            }


            include $url_system . 'task/code/block_index.php';
            $query_string .= $task_cloud_block;


        }
    }
    $query_string .= '</div>';
    $query_string .= '</div>';

} else
{
    $query_string.='<div class="message_search_b message_clients_cb js-message-com-t"><span>Пока задачи по данному обращению отсутствуют.</span></div>';
}

$query_string.='</div>';
