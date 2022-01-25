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
if (count($_GET) !=0)
{
	goto end_code;	
}
/*
$status_admin=0;
$mas_responsible=array();
$result_t=mysql_time_query($link,'Select A.id,A.id_exchange,A.id_user,A.cost_client,A.cost_client_exchange,A.exchange_rates,A.cost_operator,A.cost_operator_exchange,A.discount,A.exchange_rates_operator,A.status_admin from trips as A where A.visible=1 AND A.id="'.ht($_GET["id"]).'" and A.id_a_company="'.$id_company.'"');
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
*/

if ((!$role->permission('Финансы','U'))and($sign_admin!=1))
{
    goto end_code;
}
$date_new=date("Y-m-").'01';

$result_uu = mysql_time_query($link, 'select * from finance_plane where id_a_company IN ('.ht($id_company).') and date="'.$date_new.'"');

$num_results_uu = $result_uu->num_rows;

if ($num_results_uu != 0) {
    $row_score = mysqli_fetch_assoc($result_uu);
} else
{
    $debug=h4a(5,$echo_r,$debug);
    goto end_code;
}


//составление секретного ключа формы
//составление секретного ключа формы
//соль для данного действия
$token=token_access_compile($id_company,'bt_edit_plane',$secret);
//составление секретного ключа формы
//составление секретного ключа формы
//составление секретного ключа формы







$status=1;


?>
<div id="Modal-one" class="box-modal table-modal eddd1 client_window"><div class="box-modal-pading">
<div class="top_modal">
	
	
	
  <div class="box-modal_close arcticmodal-close"></div>
  <? 
  echo'<h1 class="h111" mor="'.$token.'" for="'.htmlspecialchars(trim($_GET['id_buy'])).'"><span>Изменение Ваших планов на месяц</span></h1>';

  //token_access_compile($_GET['id_buy'],'bt_edit_21',$secret);

  ?>
  
  
  
</div>
<div class="center_modal"><div class="mobile-white">
<?
echo'<form class="js-form-price-plane" id="vino_xd_plane_price_edit" style=" padding:0; margin:0;" method="post" enctype="multipart/form-data">';
echo'<input type="hidden" value="'.htmlspecialchars(trim($_GET['id'])).'" name="id">';
echo'<input type="hidden" value="'.$token.'" name="tk">';
echo'<input name="tk1" value="dsQ6dsf4adfd2hh" type="hidden">';
	//форма добавления задачи
//форма добавления задачи




//echo $query_string;




$query_string='<div >';


$query_string.='<div class="pad10" style="padding: 0; z-index:100;"><span class="bookingBox_gr22"></span></div>';





$query_string.='<div class="form_right_say_one " style="width:100%;">';

//$query_string.='<div class="strong_wh_2020">↓ Планы на текущий месяц</div>';

$query_string.='<!--input start	-->		
	<div style="margin-top: 30px;" class="jj-l2"><div class="input_2018"><label>Доход (рубли)<span>*</span></label><input name="summ" value="'.$row_score["income"].'" id="date_124" class="input_new_2018 required gloab money_mask1 " autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><hr class="tree"><div class="oper_name" joi=""></div></div></div>
</div>
<!--input end	-->';


$query_string .= '<!--input start	-->		
	<div style="margin-top: 30px;" class="jj-l2"><div class="input_2018"><label>Расход (рубли)<span>*</span></label><input name="summ1" value="' . $row_score["expense"] . '" id="date_124" class="input_new_2018 required money_mask1 gloab" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><hr class="tree"><div class="oper_name" joi=""></div></div></div>
</div>
<!--input end	-->';



//форма задачи

$query_string.='<div class="center_vert right_task_ccb" style="width: 100%; margin-top:20px;"><div class="add_cff_buy js-edit-price-plane-but-x">Изменить</div>';



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