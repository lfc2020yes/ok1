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




if ((!$role->permission('Касса','A'))and($sign_admin!=1))
{
    goto end_code;	
}
//составление секретного ключа формы
//составление секретного ключа формы
//соль для данного действия
$token=token_access_compile('2022','bt_cash_buy',$secret);
//составление секретного ключа формы
//составление секретного ключа формы
//составление секретного ключа формы







$status=1;


$su_5=0;

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

}



?>
<div id="Modal-one" class="box-modal table-modal eddd1 client_window"><div class="box-modal-pading">
<div class="top_modal">
	
	
	
  <div class="box-modal_close arcticmodal-close"></div>
  <? 
  echo'<h1 class="h111" mor="'.$token.'" for="'.htmlspecialchars(trim($_GET['id'])).'"><span>Новая операция (<i style="border-bottom: 2px solid #fd8080 !important; font-style: normal;">'.$row_work_zz["object_name"].'</i>)</span></h1>';
  ?>
  
  
  
</div>
<div class="temp_form_cash">
        <?

$where_global=' where global=0';
if(($sign_level>=3)or($sign_admin==1))
{
    $where_global='';
}

$result_uu_te = mysql_time_query($link, 'select * from cash_operation_template '.$where_global);
        $id_from='';
        $id_where='';
        $where_more=0;
        $cclass='';
if ($result_uu_te) {
    $i = 0;
    while ($row_uu_te = mysqli_fetch_assoc($result_uu_te)) {
        if((isset($_GET["id"]))and($_GET["id"]==$row_uu_te["id"]))
        {
            echo '<div temp="' . $row_uu_te["id"] . '" foo="' . $row_uu_te["id_from"] . '.' . $row_uu_te["id_where"] . '.'.$row_uu_te["where_more"].'" class="buy-cash-22 js-add-cash-form select-cash-form">' . $row_uu_te["title"] . '</div>';
            $id_from=$row_uu_te["id_from"];
            $id_where=$row_uu_te["id_where"];
            $where_more=$row_uu_te["where_more"];
            $cclass="active_label";
        } else {
            echo '<div temp="' . $row_uu_te["id"] . '" foo="' . $row_uu_te["id_from"] . '.' . $row_uu_te["id_where"] . '.'.$row_uu_te["where_more"].'" class="buy-cash-22 js-add-cash-form">' . $row_uu_te["title"] . '</div>';
        }
    }
}

?></div>
<div class="center_modal">
<?
echo'<form class="js-form-pay-cash" id="vino_xd_cash_pay" style=" padding:0; margin:0;" method="post" enctype="multipart/form-data">';
echo'<input type="hidden" value="'.htmlspecialchars(trim($_GET['id'])).'" name="id">';
echo'<input type="hidden" value="'.$token.'" name="tk">';
echo'<input name="tk1" value="dsQ23RStsd255" type="hidden">';
 //форма добавления задачи
 //форма добавления задачи


$query_string='<div ><div class="add_sel_form add-new-olp" style="position:relative; margin-bottom: 0px; border:0px;">';


$query_string.='<div class="pad10" style="padding: 0; z-index:100;"><span class="bookingBox_gr22"></span></div>';







$query_string.='<div class="mobile-white" style="width:100%;"><div class="form_right_say_one " style="padding:0px; width:100%;">';




$query_string.='<div class="flexx flexx-cash-2022">
<div class="tolko_50">';


$query_string.='    <!--input start	-->';


$os_say55 = array();
$os_id_say55 = array();
$su_say55=-1;
$vibor='';

if($id_from!='')
{
    $su_say55=$id_from;
    $result_uu5 = mysql_time_query($link, 'select title from cash_from_where where id="' . ht($id_from) . '"');
    $num_results_uu5 = $result_uu5->num_rows;

    if ($num_results_uu5 != 0) {
        $row_uu5 = mysqli_fetch_assoc($result_uu5);
        $vibor=$row_uu5["title"];
    }
}

$query_string.='<div style="margin-top: 30px;
    position: relative;" class="js-zindex js-ot">	';

$query_string.='<div class="left_drop list_2018 menu1_prime"><label class="'.$cclass.'">Откуда<span>*</span></label><div class="select eddd zin_2019"><a class="slct" list_number="t3" data_src="'.$id_from.'">'.$vibor.'</a><ul class="drop js-visible-mt-x">';

//если оплачивает клиент
//если начальный аванс был наличкой - то остальные платежи только наличкой
//если начальный аванс был не наличкой - то все методы оплаты

$where_global=' and A.admin=0';
if(($sign_level>=3)or($sign_admin==1))
{
    $where_global='';
}

$result_8 = mysql_time_query($link,'select A.* from  cash_from_where as A where A.from=1 '.$where_global.' order by A.id');

$num_8 = $result_8->num_rows;
//$row_1 = mysqli_fetch_assoc($result2);
if($result_8)
{

    /*
                   $query_string.='<li class="sel_active"><a href="javascript:void(0);"  rel="'.$os_id_say55[array_search(1, $os_id_say55)].'">'.$os_say55[array_search(0, $os_id_say55)].'</a></li>';
    */

    while($row_8 = mysqli_fetch_assoc($result_8)){

        if($su_say55==$row_8["id"])
        {
            $query_string.='<li class="sel_active"><a href="javascript:void(0);"   rel="'.$row_8["id"].'">'.$row_8["title"].'</a></li>';
        } else {

            $query_string .= '<li><a href="javascript:void(0);"  rel="' . $row_8["id"] . '">' . $row_8["title"] . '</a></li>';
        }

    }
}



$query_string.='</ul><input type="hidden" class="gloab gloab1" name="cash_from" id="vid_finance" value="'.$id_from.'"><div class="div_new_2018"><hr class="one"></div></div></div></div>';




$query_string.='<!--input end	-->';


$query_string.='</div>';


$query_string.='<div class="tolko_50 tolko_50_cash">';


$query_string.='    <!--input start	-->';


$os_say55 = array();
$os_id_say55 = array();
$su_say55=-1;
$vibor='';

if($id_where!='')
{
    $su_say55=$id_from;
    $result_uu5 = mysql_time_query($link, 'select title from cash_from_where where id="' . ht($id_where) . '"');
    $num_results_uu5 = $result_uu5->num_rows;

    if ($num_results_uu5 != 0) {
        $row_uu5 = mysqli_fetch_assoc($result_uu5);
        $vibor=$row_uu5["title"];
    }
}

$query_string.='<div style="margin-top: 30px;
    position: relative;" class="js-zindex js-ky">	';

$query_string.='<div class="left_drop list_2018 menu1_prime"><label class="'.$cclass.'">Куда<span>*</span></label><div class="select eddd zin_2019"><a class="slct" list_number="t3" data_src="'.$id_where.'">'.$vibor.'</a><ul class="drop js-visible-mt-x">';

//если оплачивает клиент
//если начальный аванс был наличкой - то остальные платежи только наличкой
//если начальный аванс был не наличкой - то все методы оплаты

$where_global=' and A.admin=0';
if(($sign_level>=3)or($sign_admin==1))
{
    $where_global='';
}

$result_8 = mysql_time_query($link,'select A.* from  cash_from_where as A where A.where=1 '.$where_global.' order by A.id');

$num_8 = $result_8->num_rows;
//$row_1 = mysqli_fetch_assoc($result2);
if($result_8)
{

    /*
                   $query_string.='<li class="sel_active"><a href="javascript:void(0);"  rel="'.$os_id_say55[array_search(1, $os_id_say55)].'">'.$os_say55[array_search(0, $os_id_say55)].'</a></li>';
    */

    while($row_8 = mysqli_fetch_assoc($result_8)){

        if($su_say55==$row_8["id"])
        {
            $query_string.='<li class="sel_active"><a href="javascript:void(0);"   rel="'.$row_8["id"].'">'.$row_8["title"].'</a></li>';
        } else {

            $query_string .= '<li><a href="javascript:void(0);"  rel="' . $row_8["id"] . '">' . $row_8["title"] . '</a></li>';
        }

    }
}



$query_string.='</ul><input type="hidden" class="gloab gloab1 js-cash-where" name="cash_where" id="vid_finance" value="'.$id_where.'"><div class="div_new_2018"><hr class="one"></div></div></div></div>';




$query_string.='<!-- input end -->';


$query_string.='</div>
</div>';


$class_where='';
if($where_more==0)
{
    $class_where='display:none;';
}

$query_string.='<!--input start	-->	
<div style="margin-top: 30px; '.$class_where.'" class="jj-l2 js-sh"><div class="input_2018"><label>Куда подробнее<span>*</span></label><input name="where_more" value="" id="date_124" class="input_new_2018 required gloab1" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name" joi=""></div></div></div>
</div>
<!--input end	-->';


$query_string.='<!--input start	-->		
	<div style="margin-top: 30px;" class="jj-l2"><div class="input_2018"><label>Сумма (рубли)<span>*</span></label><input name="summ" value="" id="date_124" class="input_new_2018 required gloab gloab1 money_mask1" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><hr class="tree"><div class="oper_name" joi=""></div></div></div>
</div>
<!--input end	-->';

//$query_string.='<div class="add_say_two">';


$query_string.='<div style="margin-top: 30px;">';

      $query_string.='<div class="div_textarea_otziv1 js-prs" >
			<div class="otziv_add">';
                 
                   
        $query_string.='<textarea cols="10" rows="1" placeholder="Комментарий" id="otziv_area_adaxx299" name="comment" class="di text_area_otziv no_comment_bill22 tyyo"></textarea>';
				
            $query_string.='</div>      
</div>  

        <script type="text/javascript"> 
	  $(function (){ 
$(\'#otziv_area_adaxx299\').autoResize({extraSpace : 10});
$(\'.tyyo\').trigger(\'keyup\');
});

	</script>
	</div>';


$query_string.='</div>';
	 
//форма задачи
if($status_admin==0)
{
    $query_string.='<div class="center_vert right_task_ccb" style="width: 100%; margin-top:20px;"><div class="add_cff_fin js-add-buy-cash-but-x">Провести</div>';
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