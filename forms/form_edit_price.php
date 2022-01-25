<?php
//форма изменения общей стоимости тура, скидка

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
if (count($_GET) != 1)
{
	goto end_code;	
}
$status_admin=0;
$mas_responsible=array();
$result_t=mysql_time_query($link,'Select A.id,A.id_exchange,A.id_user,A.cost_client,A.cost_client_exchange,A.exchange_rates,A.cost_operator,A.cost_operator_exchange,A.discount,A.exchange_rates_operator,A.status_admin from trips as A where A.visible=1 AND A.id="'.ht($_GET["id"]).'" and A.id_a_company IN ('.$id_company.')');
$num_results_t = $result_t->num_rows;
if($num_results_t==0)
{
    $debug=h4a(5,$echo_r,$debug);
    goto end_code;
} else
{
    $row_score = mysqli_fetch_assoc($result_t);
    $status_admin=$row_score['status_admin'];
    array_push($mas_responsible,$row_score["id_user"]);
}


//доступна форма только для тех чью это туры и если кто-то управляет этим человек чей это тур и + админы
$tabs_menu_x_visible[4]=0;
if($row_score["id_user"]!=0)
{
    if(($sign_admin!=1))
    {

        if($row_score["id_user"]==$id_user)
        {
            $tabs_menu_x_visible[4]="1";
        }

        if (in_array($id_user, $mas_responsible))
        {
            $tabs_menu_x_visible[4]="1";
        } else
        {
            //может он управляющий кого то кто должен выполнить эту задачу тогда ему тоже можно ее выполнить
            $subo_x = array();
            foreach ($mas_responsible as $key => $value)
            {
                $subo_x = array_merge($subo_x, all_chief($value,$link));

            }
            $subo_x= array_unique($subo_x);


            if ((in_array($id_user, $subo_x)))
            {
                $tabs_menu_x_visible[4]="1";
            }

        }
    }  else
    {
        $tabs_menu_x_visible[4]="1";
    }

}

if($tabs_menu_x_visible[4]!="1")
{
    $debug=h4a(6,$echo_r,$debug);
    goto end_code;
}


if ((!$role->permission('Туры','U'))and($sign_admin!=1))
{
    goto end_code;
}
//составление секретного ключа формы
//составление секретного ключа формы
//соль для данного действия
$token=token_access_compile($_GET['id'],'bt_edit_price',$secret);
//составление секретного ключа формы
//составление секретного ключа формы
//составление секретного ключа формы







$status=1;

$result_uu_rate=mysql_time_query($link,'select a.char,a.small_name,a.code from booking_exchange as a  where a.id="'.ht($row_score["id_exchange"]).'"');
$num_results_uu_rate = $result_uu_rate->num_rows;

if($num_results_uu_rate!=0) {
    $row_uu_rate = mysqli_fetch_assoc($result_uu_rate);
}

$style_kurs=0; //рублевый тур по умолчанию
if ($row_uu_rate["char"] != "₽") {
//значит выводим в валюте потому что остаток клиент отдает в валюте
    $style_kurs=1;

}

?>
<div id="Modal-one" class="box-modal table-modal eddd1 buy_trips_window1 client_window"><div class="box-modal-pading">
<div class="top_modal">
	
	
	
  <div class="box-modal_close arcticmodal-close"></div>
  <? 
  echo'<h1 class="h111" mor="'.$token.'" for="'.htmlspecialchars(trim($_GET['id_buy'])).'"><span>Изменение Общей стоимости тура №'.$_GET["id"].'</span></h1>';

  //token_access_compile($_GET['id_buy'],'bt_edit_21',$secret);

  ?>
  
  
  
</div>
<div class="center_modal"><div class="mobile-white">
<?
echo'<form class="js-form-price-trips" id="vino_xd_trips_price_edit" style=" padding:0; margin:0;" method="post" enctype="multipart/form-data">';
echo'<input type="hidden" value="'.htmlspecialchars(trim($_GET['id'])).'" name="id">';
echo'<input type="hidden" value="'.$token.'" name="tk">';
echo'<input name="tk1" value="dsQ642dSadfd2re" type="hidden">';
	//форма добавления задачи
//форма добавления задачи




//echo $query_string;




$query_string='<div >';


$query_string.='<div class="pad10" style="padding: 0; z-index:100;"><span class="bookingBox_gr22"></span></div>';





$query_string.='<div class="form_right_say_one " style="width:100%;">';

$query_string.='<div class="strong_wh_2020">↓ Данные по клиенту</div>';

$query_string.='<!--input start	-->		
	<div style="margin-top: 30px;" class="jj-l2"><div class="input_2018"><label>Общая стоимость тура для туриста со скидкой (рубли)<span>*</span></label><input name="summ" value="'.$row_score["cost_client"].'" id="date_124" class="input_new_2018 required gloab money_mask1 js-upload-kurs js-upload-kurs1" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><hr class="tree"><div class="oper_name" joi=""></div></div></div>
</div>
<!--input end	-->';


if($style_kurs==1) {

    $query_string .= '<!--input start	-->		
<div style="margin-top: 30px;" ><div class="input_2018"><label>Курс '.$row_uu_rate["small_name"].'<span>*</span></label><input name="curs" value="'.$row_score["exchange_rates"].'" id="date_124" char="'.$row_uu_rate["char"].'" class="input_new_2018 required gloab money_mask1 js-upload-kurs js-upload-kurs2" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><hr class="tree"><div class="oper_name"></div></div></div>
</div>
<!--input end	-->';

}

$query_string.='<div class="flexx">
<div class="tolko_50">';

$query_string.='<!--input start	-->		
<div style="margin-top: 30px;" class="rates_visible"><div class="input_2018"><label>Скидка клиенту</label><input name="com_proc" value="0" id="date_124" class="input_new_2018 required   money_mask1 js-active-label js-comm-proc" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><hr class="four"><hr class="strelka"><div class="oper_name"></div></div></div>
</div>
<!--input end	-->';

$query_string.='</div>
<div class="tolko_50">';
$query_string.='<!--input start	-->		
<div style="margin-top: 30px;" class="rates_visible"><div class="input_2018 active-commi-buy1"><label>Итого скидка</label><input name="com_rub" value="'.$row_score["discount"].'" id="date_124" class="input_new_2018 required   money_mask1 js-active-label js-comm-rub" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><hr class="tree"><div class="oper_name"></div></div></div>
</div>
<!--input end	-->';
$query_string.='</div>
</div>';


$query_string.='<div class="strong_wh_2020" style="margin-top:30px;">↓ Данные по туроператору</div>';


$query_string .= '<!--input start	-->		
	<div style="margin-top: 30px;" class="jj-l2"><div class="input_2018"><label>Общая сумма к оплате туроператору (рубли)</label><input name="summ1" value="' . $row_score["cost_operator"] . '" id="date_124" class="input_new_2018 required money_mask1 js-upload-kurs-oper js-upload-kurs1-p" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><hr class="tree"><div class="oper_name" joi=""></div></div></div>
</div>
<!--input end	-->';

if($style_kurs==1) {

    $query_string .= '<!--input start	-->		
<div style="margin-top: 30px;" ><div class="input_2018"><label>Курс '.$row_uu_rate["small_name"].'</label><input name="curs1" value="'.$row_score["exchange_rates_operator"].'" id="date_124" char="'.$row_uu_rate["char"].'" class="input_new_2018 required money_mask1 js-upload-kurs-oper js-upload-kurs2-p" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><hr class="tree"><div class="oper_name"></div></div></div>
</div>
<!--input end	-->';

}


//форма задачи
if($status_admin==0)
{
$query_string.='<div class="center_vert right_task_ccb" style="width: 100%; margin-top:20px;"><div class="add_cff_buy js-edit-price-trips-but-x">Изменить</div>';
}


$query_string.='<div class="task_cb_exit js-exit-window-add-task"  style="background-color: #fff;">


<div class="task_cb_head">
отменить
</div>
</div></div></div>';



$query_string.=' 		
</div></div>';


//форма добавления подборки
//форма добавления подборки



echo $query_string;





?>
</form>
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

     //рассчитать в процентах скиндку
$('.js-form-price-trips').find('.js-upload-kurs2,.js-comm-rub,.js-upload-kurs1-p').trigger('click');


	 
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