<?php
//форма добавления новой оплаты по туру

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
if (count($_GET) != 2)
{
	goto end_code;	
}


$result_t=mysql_time_query($link,'Select A.id,A.id_exchange from trips as A where A.visible=1 AND A.id="'.ht($_GET["id"]).'" and A.id_a_company IN ('.$id_company.')');
$num_results_t = $result_t->num_rows;
if($num_results_t==0)
{
    $debug=h4a(5,$echo_r,$debug);
    goto end_code;

} else
{
    $row_score = mysqli_fetch_assoc($result_t);

}


if ((!$role->permission('Туры','U'))and($sign_admin!=1))
{
    goto end_code;
}
//составление секретного ключа формы
//составление секретного ключа формы
//соль для данного действия
$token=token_access_compile($_GET['id'],'bt_edit_srok',$secret);
//составление секретного ключа формы
//составление секретного ключа формы
//составление секретного ключа формы







$status=1;

?>
<div id="Modal-one" class="box-modal table-modal eddd1 client_window"><div class="box-modal-pading">
<div class="top_modal">
	
	
	
  <div class="box-modal_close arcticmodal-close"></div>
  <?
  $vff='клиента';
  if($_GET["my"]==1)
  {
      $vff='туроператору';
  }
  echo'<h1 class="h111" mor="'.$token.'" for="'.htmlspecialchars(trim($_GET['id_buy'])).'"><span>Сроки оплат '.$vff.' по туру №'.$_GET["id"].'</span></h1>';

  //token_access_compile($_GET['id_buy'],'bt_edit_21',$secret);

  ?>
  
  
  
</div>
<div class="center_modal">
<?
echo'<form class="js-form-srok-trips" id="vino_xd_trips_srok_edit" style=" padding:0; margin:0;" method="post" enctype="multipart/form-data">';
echo'<input type="hidden" value="'.htmlspecialchars(trim($_GET['id'])).'" name="id">';
echo'<input type="hidden" value="'.htmlspecialchars(trim($_GET['my'])).'" name="my">';
echo'<input type="hidden" value="'.$token.'" name="tk">';
echo'<input name="tk1" value="dsQ42DFSs4d2re" type="hidden">';
	//форма добавления задачи
//форма добавления задачи




//echo $query_string;




$query_string='<div>';


$query_string.='<div class="pad10" style="padding: 0; z-index:100;"><span class="bookingBox_gr22"></span></div>';


$query_string.='<div class="butt-srok-add js-butt-srok-add">добавить срок оплаты</div>';

$query_string.='<div class="form_right_say_one " style="width:100%;">';


$result_uu_srok = mysql_time_query($link, 'select A.* from trips_payment_term as A where 
A.id_trips="' . ht($_GET["id"]) . '" and A.type="'.ht($_GET["my"]).'" and A.visible=1 order by A.date');

if ($result_uu_srok) {
    $i = 1;
    $num_results_uu_srok = $result_uu_srok->num_rows;
    while ($row_uu_srok = mysqli_fetch_assoc($result_uu_srok)) {

        //yes-buy-y
        $dis_srok='';
        if($i==$num_results_uu_srok)
        {
            $query_string.='<div class="flexx sroki-tabl js-temp-kk">';
            $dis_srok='readonly';
        } else
        {
            $query_string.='<div class="flexx sroki-tabl">';
        }
        $i++;

        $query_string.='<div class="tolko_50">';

$query_string.='<!--input start	-->		
<div style="margin-top: 30px;" class="rates_visible"><div class="input_2018"><label>Оплата не менее</label><input name="srok[proc][]" '.$dis_srok.' value="'.(int)$row_uu_srok["proc"].'" id="date_124" class="input_new_2018 required gloab  money_mask1 js-proc-form-x" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><hr class="four"><hr class="strelka"><div class="oper_name"></div></div></div>
</div>
<!--input end	-->';

$query_string.='</div>
<div class="tolko_50">';
$query_string.='	<div style="margin-top: 30px;" class="rates_visible"><div class="input_2018"><label>До Даты<span>*</span></label><input name="srok[date][]" value="'.date_ex(0,$row_uu_srok["date"]).'" id="date_124" class="input_new_2018 required gloab  date_picker_xe" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>';

$query_string.='</div>';
        
        

        $query_string.='</div>';
    }
}
if($num_results_uu_srok==0)
{
    //если пока ничего не задано из сроков


        $query_string.='<div class="flexx sroki-tabl js-temp-kk">';
        $dis_srok='readonly';

    $query_string.='<div class="tolko_50">';

    $query_string.='<!--input start	-->		
<div style="margin-top: 30px;" class="rates_visible"><div class="input_2018"><label>Оплата не менее</label><input name="srok[proc][]" '.$dis_srok.' value="100" id="date_124" class="input_new_2018 required gloab  money_mask1 js-proc-form-x" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><hr class="four"><hr class="strelka"><div class="oper_name"></div></div></div>
</div>
<!--input end	-->';

    $query_string.='</div>
<div class="tolko_50">';
    $query_string.='	<div style="margin-top: 30px;" class="rates_visible"><div class="input_2018"><label>До Даты<span>*</span></label><input name="srok[date][]" value="'.date("d.m.Y").'" id="date_124" class="input_new_2018 required gloab  date_picker_xe" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>';

    $query_string.='</div>';



    $query_string.='</div>';

}


$query_string.='</div>';
	 
//форма задачи
$query_string.='<div class="center_vert right_task_ccb" style="width: 100%; margin-top:20px;"><div class="add_cff_buy js-edit-srok-trips-but-x">Изменить</div>



<div class="task_cb_exit js-exit-window-add-task"  style="background-color: #fff;">


<div class="task_cb_head">
отменить
</div>
</div></div>';



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


 sroki_yes();

     $('.date_picker_xe').inputmask("datetime",{
         mask: "1.2.y",
         placeholder: "dd.mm.yyyy",
         separator: ".",
         alias: "dd.mm.yyyy"
     });

	 
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