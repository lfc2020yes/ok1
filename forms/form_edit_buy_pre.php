<?php
//форма редактирования операции в финансах

$url_system=$_SERVER['DOCUMENT_ROOT'].'/';
include_once $url_system.'module/ajax_access.php';


//создание секрет для формы
/*
$secret=rand_string_string(4);
if(!isset($_SESSION['rema']))
{
    $_SESSION['rema'] = $secret;
} else
{
    $secret=$_SESSION['rema'];
}
*/

if (count($_GET) != 1)
{
    goto end_code;
}
$status=0;


   $class_bba='cost_bank1';

if((!isset($_SESSION["user_id"]))or(!is_numeric(id_key_crypt_encrypt($_SESSION["user_id"]))))
{	
	goto end_code;
}

$id_user=id_key_crypt_encrypt($_SESSION["user_id"]);

//проверить есть ли переменная id и можно ли этому пользователю это делать


$result_t=mysql_time_query($link,'Select A.* from preorders as A where A.visible=1 AND A.id="'.ht($_GET["id_buy"]).'" and A.id_company="'.$id_company.'"');
$num_results_t = $result_t->num_rows;
if($num_results_t==0)
{
    $debug=h4a(5,$echo_r,$debug);
    goto end_code;

} else {
    $row_uu = mysqli_fetch_assoc($result_t);
}


if ((!$role->permission('Обращения','U'))and($sign_admin!=1))
{
    goto end_code;	
}

if(($row_uu['id_user']!=$id_user)and($sign_admin!=1))
{
    goto end_code;
}

if(($row_uu["status"]==5)or($row_uu["status"]==6)) {

    goto end_code;
}

//составление секретного ключа формы
//составление секретного ключа формы
//соль для данного действия
$token=token_access_compile(ht($_GET["id_buy"]),'bt_preorders_edit',$secret);
//составление секретного ключа формы
//составление секретного ключа формы
//составление секретного ключа формы







$status=1;



?>
<div id="Modal-one" class="box-modal js-box-modal-two table-modal eddd1  history_window1 client_window "><div class="box-modal-pading">
<div class="top_modal">
	
	
	
  <div class="box-modal_close arcticmodal-close"></div>
  <?
  echo'<h1 class="h111" mor="'.$token.'" for="'.htmlspecialchars(trim($_GET['id_buy'])).'"><span>Изменение Обращения №'.$_GET["id_buy"].'</span></h1>';
  ?>
  
  
  
</div>
<div class="center_modal">
<?
echo'<form class="js-form-preorders" id="vino_xd_preorders" style=" padding:0; margin:0;" method="post" enctype="multipart/form-data">';
echo'<input type="hidden" value="'.htmlspecialchars(trim($_GET['id_buy'])).'" name="id">';
echo'<input type="hidden" value="'.$token.'" name="tk">';
echo'<input name="tk1" value="dsQ23RStsd2re" type="hidden">';
$poten=0;
switch($row_uu["id_type_clients"])
{
    case "1":{
        //частное лицо
        $sql_tt='Select b.id,b.fio,b.potential from k_clients as b where b.id="'.ht($row_uu["id_k_clients"]).'" and b.potential=0 and b.visible=1 and b.id_a_company IN ('.ht($id_company).')';
        $poten=1;
        break;
    }
    case "2":{
        //организация
        $sql_tt='Select b.id,b.name as fio,5 as potential from k_organization as b where b.id="'.ht($row_uu["id_k_clients"]).'" and  b.visible=1 and b.id_a_company IN ('.ht($id_company).')';
        $poten=2;
        break;
    }
}
$name_kl='';
$result_t11=mysql_time_query($link,$sql_tt);
$num_results_t11 = $result_t11->num_rows;
if($num_results_t11!=0) {
    $row_t11 = mysqli_fetch_assoc($result_t11);
    $name_kl=$row_t11["fio"];
    if(($row_t11["potential"]==1)or($row_t11["potential"]==2))
    {
        $poten=3;
    }
    echo '<input type="hidden" value="'.$row_uu["id_k_clients"].'" class="js-id-client-task" name="preorders[id_client]">';

    echo '<input type="hidden" value="'.$poten.'" class="js-client-type-task" name="preorders[client_type]">';

} else {
    echo '<input type="hidden" value="" class="js-id-client-task" name="preorders[id_client]">';
    echo '<input type="hidden" value="" class="js-client-type-task" name="preorders[client_type]">';
}
	//форма добавления задачи
//форма добавления задачи


$query_string='<div ><div class="add_sel_form add-new-olp" style="position:relative; margin-bottom: 0px; display:block; border:0px;">';


$query_string.='<div class="pad10" style="padding: 0; z-index:100;"><span class="bookingBox_gr22"></span></div>';





$query_string.='<div class="mobile-white" style="width:100%;"><div class="form_right_say_one " style="padding:0px; width:100%;">';


if($name_kl=='') {
    $query_string .= '<div class="input-choice-click js-option-task-user js-task-user-sv">
<div class="choice-head">Связать с клиентом<span class="sv-user-taskx js-sv-user-task"><i>→</i><span></span></span></div>
<div class="choice-radio"><div class="center_vert1"><i></i><input name="" id="taskusersv" value="0" type="hidden"></div></div></div>';
} else
{
    $query_string .= '<div class="input-choice-click js-option-task-user js-task-user-sv">
<div class="choice-head">Связать с клиентом<span class="sv-user-taskx js-sv-user-task" style="display: inline;"><i>→</i><span>'.$name_kl.'</span></span></div>
<div class="choice-radio"><div class="center_vert1"><i class="active_task_cb"></i><input name="" id="taskusersv" value="1" type="hidden"></div></div></div>';
}



$query_string.='    <!--input start	-->';


$os_say55 = array();
$os_id_say55 = array();

$su_say55=$row_uu["id_booking_sourse"];

$result_uu77 = mysql_time_query($link, 'select name from booking_sourse where id="' . ht($row_uu["id_booking_sourse"]) . '"');
$num_results_uu77 = $result_uu77->num_rows;

if ($num_results_uu77 != 0) {
    $row_uu77 = mysqli_fetch_assoc($result_uu77);
}

$query_string.='<div style="margin-top: 30px;
    position: relative;" class="js-zindex js-vid-oper">	';

$query_string.='<div class="left_drop list_2018 menu1_prime"><label class="active_label">Рекламный источник<span>*</span></label><div class="select eddd zin_2019"><a class="slct" list_number="t3" data_src="'.$row_uu["id_booking_sourse"].'">'.$row_uu77["name"].'</a><ul class="drop js-visible-mt">';

//если оплачивает клиент
//если начальный аванс был наличкой - то остальные платежи только наличкой
//если начальный аванс был не наличкой - то все методы оплаты



$result_89 = mysql_time_query($link,'select A.* from  booking_sourse as A where A.visible=1 and A.id_a_company IN ('.$id_group_company_list.') order by A.displayOrder');

$num_89 = $result_89->num_rows;
//$row_1 = mysqli_fetch_assoc($result2);
if($result_89)
{

    /*
                   $query_string.='<li class="sel_active"><a href="javascript:void(0);"  rel="'.$os_id_say55[array_search(1, $os_id_say55)].'">'.$os_say55[array_search(0, $os_id_say55)].'</a></li>';
    */

    while($row_89 = mysqli_fetch_assoc($result_89)){


if($row_uu["id_booking_sourse"]==$row_89["id"])
{
    $query_string .= '<li class="sel_active"><a href="javascript:void(0);"  rel="' . $row_89["id"] . '">' . $row_89["name"] . '</a></li>';
} else {
    $query_string .= '<li><a href="javascript:void(0);"  rel="' . $row_89["id"] . '">' . $row_89["name"] . '</a></li>';
}

    }
}



$query_string.='</ul><input type="hidden" class="gloab " name="type_booking" id="vid_finance" value="'.$row_uu["id_booking_sourse"].'"><div class="div_new_2018"><hr class="one"></div></div></div></div>';




$query_string.='<!--input end	-->';



$query_string.='<!--input start	--><div style="margin-top: 30px;" class="jj-l2"><div class="input_2018"><label>Комментарий<span>&nbsp;</span></label><div class="otziv_add">';
$query_string.='<textarea cols="10" rows="1" placeholder="" id="quies" name="question" class="di text_area_otziv   input_new_2018  gloab  js-autoResize-form" >'.$row_uu["text"].'</textarea>';
$query_string.='</div><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name" joi=""></div></div>';
$query_string.='</div></div><!--input end	-->';

$class_country = '';
$name_country='';
if($row_uu["id_country"]!=0) {

$result_uu77 = mysql_time_query($link, 'select name from trips_country where id="' . ht($row_uu["id_country"]) . '" and visible=1');
    $num_results_uu77 = $result_uu77->num_rows;

    if ($num_results_uu77 != 0) {
        $row_uu77 = mysqli_fetch_assoc($result_uu77);
        $class_country = 'active_in_2018';
        $name_country=$row_uu77["name"];
    }
}
$query_string .= '<!--input start	--><div style="margin-top: 30px;" class="input_doc_turs js-zindex">';

$query_string .= '<div class="input_2018 input-search-list '.$class_country.'" list_number="s7">
        <i class="js-open-search"></i><span class="click-search-name">'.$name_country.'</span>
        <label>Страна</label>

        <input name="country" value="'.$name_country.'" id="date_124" sopen="search_turcity" class="input_new_2018 required  js-keyup-search " autocomplete="off" type="text">

        <input type="hidden" value="'.$row_uu["id_country"].'" class="js-hidden-search" name="id_country">

        <ul class="drop drop-search js-drop-search" style="transform: scaleY(0);">';

$result_work_zz=mysql_time_query($link,'Select a.* from trips_country as a WHERE a.visible=1 ORDER BY a.eye DESC,a.id limit 0,30');
$num_results_work_zz = $result_work_zz->num_rows;
if($num_results_work_zz!=0)
{

    for ($i=0; $i<$num_results_work_zz; $i++)
    {
        $row_work_zz = mysqli_fetch_assoc($result_work_zz);
        $query_string .= '<li><a href="javascript:void(0);" rel="'.$row_work_zz["id"].'">'.$row_work_zz["name"].'</a></li>';
    }
}

$query_string .= '</ul>

        <div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>';



$query_string.='</div>';

//форма задачи
if($status_admin==0)
{
    $query_string.='<div class="center_vert right_task_ccb" style="width: 100%; margin-top:20px;"><div class="add_cff_fin js-update-preorder-x">Изменить</div>';
}


$query_string.='<div class="task_cb_exit js-exit-window-add-task"  style="background-color: #eeefee;">


<div class="task_cb_head">
отменить
</div>
</div>';
//$query_string.='</div> ';




$query_string.='</div></div></div>';


//форма добавления подборки
//форма добавления подборки



















echo $query_string;

?>
    </form>
    <?

    echo'<form id="js-form-add-fin" action="" method="POST" enctype="multipart/form-data"><input name="status" value="doc" type="hidden"></form>';

    ?>
</div>



        <?

        //echo'<div id="no_rd" class="save_button add_say_cb" id_rel="'.$_GET["id"].'"><i>Добавить запись</i></div>';


        ?>

        <!--</div>-->

    </div></div>

<?




end_code:		   
		   
if($status==0)
{
	//что то не так. Почему то бронировать нельзя
	header("HTTP/1.1 404 Not Found");
	header("Status: 404 Not Found");    
	die ();	
}
/*

						 $datetime1 = date_create('Y-m-d');
                         $datetime2 = date_create('2017-01-17');
						 
                         $interval = date_create(date('Y-m-d'))->diff( $datetime2	);				 
                         $date_plus=$interval->days;
						 */
						 //echo(dateDiff_(date('Y-m-d'),'2017-01-17'));
						 


?>
<script type="text/javascript">initializeTimer();</script>
<?
include_once $url_system.'template/form_js.php';
?>
 <script type="text/javascript">
	 
	 
 $(document).ready(function(){
     Zindex();
	 
$('.money_mask1').inputmask("numeric", {
    radixPoint: ".",
    groupSeparator: " ",
    digits: 2,
    autoGroup: true,
    prefix: '', //No Space, this will truncate the first character
    rightAlign: false,
    oncleared: function () { self.Value(''); }
});
	 

var id_tt=$('.js-tabs-menu').find('.active').attr('id');
	 //alert(id_tt);
		$('.js-tabs_docc').hide();
		$('.js-tabs_'+id_tt).show();	 
	 ToolTip();
	
	 		$(".slct").unbind('click.sys');
		$(".slct").bind('click.sys', slctclick);
		$(".drop").find("li").unbind('click');
		$(".drop").find("li").bind('click', dropli);
	 $('#typesay').unbind('change', changesay);
	 $('#typesay').bind('change', changesay);
	 input_2018();
     AutoResizeTF();
	 
	 		$('.date_picker_x').inputmask("datetime",{
    mask: "1.2.y", 
    placeholder: "dd.mm.yyyy",  
    separator: ".", 
    alias: "dd.mm.yyyy"
  });
	 
	 		$(".slct").unbind('click.sys');
    $(".slct").bind('click.sys', slctclick);
	$(".drop").find("li").unbind('click');
	$(".drop").find("li").bind('click', dropli);
 
 });