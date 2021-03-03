<?
//загрузить дополнительные прикреплленные файлы и документы по клиенту частное лицо

$query_string.='<div class="input-block-2020">';




$result_6 = mysql_time_query($link,'select A.* from image_attach as A WHERE A.for_what="10" and A.visible=1 and A.id_object="'.ht($id).'"');

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
        $query_string.='	<div number_li="'.$i.'" class="li-image yes-load"><span class="name-img"><a href="/upload/file/'.$row_6["id"].'_'.$row_6["name"].'.'.$row_6["type"].'">'.$row_6["name_user"].'</a></span><span class="del-img js-dell-image" id="'.$row_6["name"].'"></span><div class="progress-img"><div class="p-img" style="width: 0px; display: none;"></div></div></div>';
        $i++;
    }
}


$query_string.='</div><input type="hidden" name="files_10" value=""><div type_load="10" id_object="'.ht($id).'" class="invoice_upload js-upload-file js-helps '.$class_aa.'"><span>прикрепите <strong>дополнительные документы</strong>, для этого выберите или перетащите файлы сюда </span><i>чтобы прикрепить ещё <strong>необходимые документы</strong>,выберите или перетащите их сюда</i><div class="help-icon-x" data-tooltip="Принимаем только в форматах .pdf, .jpg, .jpeg, .png, .doc , .docx , .zip" >u</div></div></div></div>';

$query_string.='</div>';
