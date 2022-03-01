<?php
//форма добавления новой оплаты в финансах

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


$status=0;


   $class_bba='cost_bank1';

if((!isset($_SESSION["user_id"]))or(!is_numeric(id_key_crypt_encrypt($_SESSION["user_id"]))))
{	
	goto end_code;
}

$id_user=id_key_crypt_encrypt($_SESSION["user_id"]);

//проверить есть ли переменная id и можно ли этому пользователю это делать
if ((count($_GET) != 0)and(count($_GET) != 1))
{
	goto end_code;	
}
$status_admin=0;




if ((!$role->permission('Касса','S'))and($sign_admin!=1))
{
    goto end_code;	
}
//составление секретного ключа формы
//составление секретного ключа формы
//соль для данного действия

//составление секретного ключа формы
//составление секретного ключа формы
//составление секретного ключа формы







$status=1;


$su_5=0;
$office=0;
if(( isset($_COOKIE["cc_office".$id_user]))and($_COOKIE["cc_office".$id_user]!='')and(is_numeric(trim($_COOKIE["cc_office".$id_user])))) {
    if (in_array($_COOKIE["cc_office" . $id_user], $mass_office)) {
        {
            $su_5 = $_COOKIE["cc_office" . $id_user];
        }
    }
}
if($su_5==0) {
    $result_work_zz = mysql_time_query($link, 'Select * from a_company_office as a where a.id IN (' . $id_office_sql . ') limit 1');
} else
{
    $result_work_zz = mysql_time_query($link, 'Select * from a_company_office as a where a.id IN (' . $id_office_sql . ') AND a.id="'.$su_5.'"');
}

$num_results_work_zz = $result_work_zz->num_rows;
if($num_results_work_zz!=0)
{

        $row_work_zz = mysqli_fetch_assoc($result_work_zz);
        $office=$row_work_zz["id"];

}


$token=token_access_compile($row_work_zz["id"],'bt_cash_yes_time',$secret);
?>
<div id="Modal-one" class="box-modal table-modal eddd1 client_window"><div class="box-modal-pading">
<div class="top_modal">
	
	
	
  <div class="box-modal_close arcticmodal-close"></div>
  <? 
  echo'<h1 class="h111" mor="'.$token.'" for="'.htmlspecialchars(trim($_GET['id'])).'"><span>Проверка кассы (<i style="border-bottom: 2px solid #fd8080 !important; font-style: normal;">'.$row_work_zz["object_name"].'</i>)</span></h1>';
  ?>
  
  
  
</div>
<div class="temp_form_cash">
        <?

$where_global=' where global=0';
if(($sign_level>=3)or($sign_admin==1))
{
    $where_global='';
}


?></div>
<div class="center_modal">
<?
$result_uutt = mysql_time_query($link, 'select cash_spot from a_company_office where id="'.ht($office).'"');
$num_results_uutt = $result_uutt->num_rows;
$cash=0;
if ($num_results_uutt != 0) {
    $row_uutt = mysqli_fetch_assoc($result_uutt);
    $cash=$row_uutt['cash_spot'];

}


echo'<form class="js-form-pay-cash" id="vino_xd_cash_pay" style=" padding:0; margin:0;" method="post" enctype="multipart/form-data">';
echo'<input type="hidden" value="'.htmlspecialchars(trim($_GET['id'])).'" name="id">';
echo'<input type="hidden" value="'.$token.'" name="tk">';
echo'<input name="tk1" value="dsQ23RStsd255" type="hidden">';
echo'<input name="summ" value="'.$cash.'" type="hidden">';
 //форма добавления задачи
 //форма добавления задачи


$query_string='<div ><div class="add_sel_form add-new-olp" style="position:relative; margin-bottom: 0px; border:0px;">';


$query_string.='<div class="pad10" style="padding: 0; z-index:100;"><span class="bookingBox_gr22"></span></div>';







$query_string.='<div class="mobile-white" style="width:100%;"><div class="form_right_say_one " style="padding:0px; width:100%;">';



$query_string.='<div class="mobile-white"><div class="comme">Вы подтвержаете что в кассе - <b>'.number_format(((float)$cash), 2, '.', ' ').'</b> ₽?<br><br></div></div>';

//echo '<div class="cash-content"><div class="money-summ money-cash-rub money-summ-white"><span style="color: #fff;" class="" old_number="0">'.number_format(((float)$cash), 2, '.', ' ').'</span></div></div>';


//$query_string.='<div class="add_say_two">';



$query_string.='</div>';
	 
//форма задачи
if($status_admin==0)
{
    $query_string.='<div class="center_vert right_task_ccb" style="width: 100%; margin-top:20px;"><div class="add_cff_fin js-add-buy-cash-time-x">Подтвердить</div>';
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
	 
	$('.date_picker_x').inputmask("datetime",{mask: "1.2.y", placeholder: "dd.mm.yyyy", separator: ".", alias: "dd.mm.yyyy"});
	 
	 		$(".slct").unbind('click.sys');
    $(".slct").bind('click.sys', slctclick);
	$(".drop").find("li").unbind('click');
	$(".drop").find("li").bind('click', dropli);
 
 });