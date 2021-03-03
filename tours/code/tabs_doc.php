<?
//туры вкладка "документы"

if((!isset($token_inlude))or($token_inlude!='taabbssd32.dfDS'))
{
    goto end_code;
    $debug=h4a(3,$echo_r,$debug);
}

//$query_string.='<div class="strong_wh_2020">↓ Cформированные договора</div>';

/*$download='<span class="doc_add_number"><a class="ioo" href="'.$base_usr.'/tours/doc/doc-'.$IDOC.'_'.$new_id_version.'.docx">Договор №'.ht(trim($_POST['number_contract'])).'</a></span>';*/

$result_uu = mysql_time_query($link, 'select A.*,B.id,B.name from trips_contract_version as A, trips_contract as B where B.id="' . ht($row_8['id_contract']) . '" and B.id=A.id_trips_contract order by A.date_create DESC');

$num_results_uu = $result_uu->num_rows;

if ($result_uu) {
    $i = 0;
    while ($row_uu = mysqli_fetch_assoc($result_uu)) {

        $i++;
        $date_doc_=explode("-",$row_uu["name"]);
        $date_r1=explode("/",htmlspecialchars(trimc($date_doc_[0])));

        $date_ddd=$date_r1[0].'.'.$date_r1[1].'.'.$date_r1[2];

        //$query_string.=''.$row_uu["name"].' от '.$date_ddd.'';
        $query_string_xx='';

        $result_status22=mysql_time_query($link,'SELECT b.name_user,b.name_small FROM r_user AS b WHERE b.id="'.htmlspecialchars(trim($row_uu["id_user"])).'"');


        //echo('SELECT a.* FROM r_status AS a WHERE a.numer_status="'.$row1ss["status"].'" and a.id_system=13');
        if($result_status22->num_rows!=0)
        {
            $row_status22 = mysqli_fetch_assoc($result_status22);
            $query_string_xx.=''.$row_status22['name_small'].'';
        }

        if($i==1)
        {
            $class_ver='green-trips ';
        } else
        {
            $class_ver='red-trips ';
        }

        $query_string.='<div class="comm-trips-block">

<div class="h_cb"><a><span>'.$row_uu["name"].' от '.$date_ddd.' <span class="vers-doc-color '.$class_ver.'"> (Версия №'.$num_results_uu.')</span></span></a><div class="date_cb">'.time_stamp($row_uu["date_create"]).'</div></div>


<div class="user_cb">'.$query_string_xx.'
<div class="vip-ds"><a  target="_blank" href="'.$base_usr.'/tours/doc/doc-'.$row_uu["id"].'_'.$row_uu["version"].'.docx"  data-tooltip="Открыть документ" class="trips__click1"></a></div>
</div>
</div>';
        $num_results_uu--;

    }
}


$query_string.='<div class="js-new-doc-trips" style="margin-top:15px;"><div class="add_say_cbb_new"><div class="center_vert" style="width:100%"><span>Создать новую версию договора</span></div></div></div>';

//загрузить дополнительные прикреплленные файлы и документы

$query_string.='<div class="input-block-2020">';



$status_admin=0;
$result_ss_new1 = mysql_time_query($link, 'select status_admin from trips where id="' . ht($row_8["id"]) . '"');
$num_results_ss_new1 = $result_ss_new1->num_rows;

if ($num_results_ss_new1 != 0) {

    $row_uuxx = mysqli_fetch_assoc($result_ss_new1);
    $status_admin=$row_uuxx['status_admin'];

}



    $result_6 = mysql_time_query($link,'select A.* from image_attach as A WHERE A.for_what="8" and A.visible=1 and A.id_object="'.ht($row_8["id"]).'"');

    $num_results_uu = $result_6->num_rows;

    $class_aa='';
    $style_aa='';
    if($num_results_uu!=0)
    {
        $class_aa='eshe-load-file';
        $style_aa='style="display: block;"';
    }



$query_string.='<div class="margin-input"><div class="img_invoice_div js-image-gl"><div class="list-image" '.$style_aa.'>';

    if($num_results_uu!=0)
    {
        $i=1;
        while($row_6 = mysqli_fetch_assoc($result_6)){
            $query_string.='	<div number_li="'.$i.'" class="li-image yes-load"><span class="name-img"><a href="/upload/file/'.$row_6["id"].'_'.$row_6["name"].'.'.$row_6["type"].'">'.$row_6["name_user"].'</a></span>';


            if($status_admin==0) {
                $query_string .= '<span class="del-img js-dell-image" id="' . $row_6["name"] . '"></span>';
            }

	$query_string.='<div class="progress-img"><div class="p-img" style="width: 0px; display: none;"></div></div></div>';
            $i++;
        }
    }


$query_string.='</div><input type="hidden" name="files_8" value=""><div type_load="8" id_object="'.ht($row_8["id"]).'" class="invoice_upload js-upload-file js-helps '.$class_aa.'"><span>прикрепите <strong>дополнительные документы</strong>, для этого выберите или перетащите файлы сюда </span><i>чтобы прикрепить ещё <strong>необходимые документы</strong>,выберите или перетащите их сюда</i><div class="help-icon-x" data-tooltip="Принимаем только в форматах .pdf, .jpg, .jpeg, .png, .doc , .docx , .zip" >u</div></div></div></div>';

$query_string.='</div>';



end_code:

?>