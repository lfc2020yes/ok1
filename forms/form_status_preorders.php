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
if (count($_GET) != 1)
{
	goto end_code;	
}
$status_admin=0;




if ((!$role->permission('Обращения','U'))and($sign_admin!=1))
{
    goto end_code;	
}
//составление секретного ключа формы
//составление секретного ключа формы
//соль для данного действия
$token=token_access_compile($_GET["id"],'bt_status_preorders',$secret);
//составление секретного ключа формы
//составление секретного ключа формы
//составление секретного ключа формы







$status=1;



?>
<div id="Modal-one" class="box-modal js-box-modal-two table-modal eddd1  client_window"><div class="box-modal-pading">
<div class="top_modal">
	
	
	
  <div class="box-modal_close arcticmodal-close"></div>
  <? 
  echo'<h1 class="h111" mor="'.$token.'" for="'.htmlspecialchars(trim($_GET['id'])).'"><span>Изменение статуса обращения №'.$_GET["id"].'</span></h1>';
  ?>
  
  
  
</div>
<div class="center_modal">
<?
echo'<form class="js-form-status-preorders" id="vino_xd_preorders" style=" padding:0; margin:0;" method="post" enctype="multipart/form-data">';
echo'<input type="hidden" value="'.htmlspecialchars(trim($_GET['id'])).'" name="id">';
echo'<input type="hidden" value="'.$token.'" name="tk">';
echo'<input name="tk1" value="dsQ23RStsd2re" type="hidden">';
	//форма добавления задачи
//форма добавления задачи

$query_string='<div ><div class="add_sel_form add-new-olp" style="position:relative; margin-bottom: 0px; border:0px;">';


$query_string.='<div class="pad10" style="padding: 0; z-index:100;"><span class="bookingBox_gr22"></span></div>';







$query_string.='<div class="mobile-white" style="width:100%;"><div class="form_right_say_one " style="padding:0px; width:100%;">';





//$query_string.='<div class="add_say_two">';



$query_string.='    <!--input start	-->';


 $os_say55 = array();
 $os_id_say55 = array();
	$su_say55=-1;

$query_string.='<div style="margin-top: 30px;
    position: relative;" class="js-zindex js-vid-oper">	';

$query_string.='<div class="left_drop list_2018 menu1_prime"><label class="active_label">Статус<span>*</span></label><div class="select eddd zin_2019"><a class="slct" list_number="t3" data_src="5">Оформлен договор</a><ul class="drop">';

//если оплачивает клиент
//если начальный аванс был наличкой - то остальные платежи только наличкой
//если начальный аванс был не наличкой - то все методы оплаты

$result_8 = mysql_time_query($link,'select A.* from  preorders_status as A where A.visible=1 and A.id_company="'.$id_company.'" order by A.displayOrder');

$num_8 = $result_8->num_rows;
//$row_1 = mysqli_fetch_assoc($result2);
if($result_8)
{
    while($row_8 = mysqli_fetch_assoc($result_8)){

if($row_8["number"]==5)
                  {

                      $query_string .= '<li class="sel_active"><a href="javascript:void(0);"  rel="' . $row_8["number"] . '">' . $row_8["name"] . '</a></li>';
                  } else
                  {
                      $query_string .= '<li><a href="javascript:void(0);"  rel="' . $row_8["number"] . '">' . $row_8["name"] . '</a></li>';
                  }


			 }
}



		   $query_string.='</ul><input type="hidden" class="gloab js-status-preorder-yes" name="id_status" id="status_dd" value="5"><div class="div_new_2018"><hr class="one"></div></div></div></div>';




		$query_string.='<!--input end	-->';


$query_string .= '<div style="margin-top: 30px;" class="input_doc_turs js-zindex js-status-doc-5">';

    $query_string .= '<div class="input_2018 input-search-list" list_number="s7">
        <i class="js-open-search"></i>
        <label>Договор</label>

        <input name="trips" value="" id="date_124" sopen="search_doc" class="input_new_2018 required  js-keyup-search " autocomplete="off" type="text">

        <input type="hidden" value="0" class="js-hidden-search gloab2" name="id_trips">

        <ul class="drop drop-search js-drop-search" style="transform: scaleY(0);">';

            $result_work_zz=mysql_time_query($link,'Select a.*,b.name,b.date_doc,a.id,a.shopper,a.id_shopper from trips as a,trips_contract as b WHERE a.visible=1 and a.id_booking=0 and a.id_a_company="'.$id_company.'" and a.id_contract=b.id ORDER BY a.datecreate DESC limit 0,30');
            $num_results_work_zz = $result_work_zz->num_rows;
            if($num_results_work_zz!=0)
            {

                for ($i=0; $i<$num_results_work_zz; $i++)
                {
                    $row_work_zz = mysqli_fetch_assoc($result_work_zz);


                    if($row_work_zz["shopper"]==1) {
                        //частное лицо
                        $result_uu78 = mysql_time_query($link, 'select fio from k_clients where id="'.ht($row_work_zz["id_shopper"]) . '"');
                    } else
                    {
                        //2 фирма
                        $result_uu78 = mysql_time_query($link, 'select name as fio from k_organization where id="'.ht($row_work_zz["id_shopper"]) . '"');
                    }
                    $num_results_uu78 = $result_uu78->num_rows;

                    if($num_results_uu78!=0) {
                        $row_uu78 = mysqli_fetch_assoc($result_uu78);


                        $query_string .= '<li><a href="javascript:void(0);" rel="' . $row_work_zz["id"] . '">' . $row_work_zz["name"] . ' ('.$row_uu78["fio"].')</a></li>';
                    }
                }
            }

    $query_string .= '</ul>

        <div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>';


$query_string.='    <!--input start	-->';


$os_say55 = array();
$os_id_say55 = array();
$su_say55=-1;

$query_string.='<div style="margin-top: 30px;
    position: relative; display: none;" class="js-zindex js-status-doc-6">	';

$query_string.='<div class="left_drop list_2018 menu1_prime"><label >Причина<span>*</span></label><div class="select eddd zin_2019"><a class="slct" list_number="t12" data_src=""></a><ul class="drop">';

//если оплачивает клиент
//если начальный аванс был наличкой - то остальные платежи только наличкой
//если начальный аванс был не наличкой - то все методы оплаты

$result_8 = mysql_time_query($link,'select A.* from  preorders_reasons as A where A.visible=1 and A.id_company="'.$id_company.'"');

$num_8 = $result_8->num_rows;
//$row_1 = mysqli_fetch_assoc($result2);
if($result_8)
{
    while($row_8 = mysqli_fetch_assoc($result_8)){



            $query_string .= '<li><a href="javascript:void(0);"  rel="' . $row_8["id"] . '">' . $row_8["name"] . '</a></li>';



    }
}



$query_string.='</ul><input type="hidden" class="gloab1 " name="reason" id="id_reason" value=""><div class="div_new_2018"><hr class="one"></div></div></div></div>';




$query_string.='<!--input end	-->';




$query_string.='</div>';
	 
//форма задачи
if($status_admin==0)
{
    $query_string.='<div class="center_vert right_task_ccb" style="width: 100%; margin-top:20px;"><div class="add_cff_fin js-add-status-preorder-x">Изменить</div>';
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
     $('.js-box-modal-two').on("change keyup input click",'.js-vibor-date1 span',js_vibor_date1);	//быстрые даты
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