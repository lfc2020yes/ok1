<?php
//форма выбора клиента, организации

//опции для формы
/*
url: 'forms/form_choice_client.php?tabs=1',
several - выбор сразу нескольких 0 - нет 1- да - если нет параметра то один
tabs - какое меню по умолчанию активно 1 - первая вкладка 2 - вторая
tabss - какие вкладки буду видны all - все 1-первая 2-вторая 3-третья - если нет параметра то все 0 - вкладок вообще нет
postа - что выполнять после нажатия кнопки выбрать функция
new - выводить кнопку новый клиент, новая организация если нет переменной выводить и если = 1 , 0 - кнопок нет
*/	


$url_system=$_SERVER['DOCUMENT_ROOT'].'/';
include_once $url_system.'module/ajax_access.php';


//создание секрет для формы
$secret=rand_string_string(4);
$_SESSION['s_form_xx'] = $secret;

$status=0;
//$id=htmlspecialchars($_GET['id']);


   $class_bba='cost_bank1';

if((!isset($_SESSION["user_id"]))or(!is_numeric(id_key_crypt_encrypt($_SESSION["user_id"]))))
{	
	goto end_code;
}

$id_user=id_key_crypt_encrypt($_SESSION["user_id"]);

//проверить есть ли переменная id и можно ли этому пользователю это делать
/*
if ((count($_GET) != 2)or(!isset($_GET["id"]))or((!is_numeric($_GET["id"])))) 
{
	goto end_code;	
}	
*/	

/*
$result_t=mysql_time_query($link,'Select b.* from k_clients as b where b.id="'.htmlspecialchars(trim($_GET['id'])).'" and b.visible=1');
$num_results_t = $result_t->num_rows;
if($num_results_t==0)
{	
		$debug=h4a(5,$echo_r,$debug);
		goto end_code;
	
} else
{
	$row_score = mysqli_fetch_assoc($result_t);
}
*/

if ((!$role->permission('Клиенты','R'))and($sign_admin!=1))
{
    goto end_code;	
}

//echo($_GET['id']);

//составление секретного ключа формы
//составление секретного ключа формы
//соль для данного действия
$token=token_access_compile($id_user,'bt_choice_client',$secret);
//составление секретного ключа формы
//составление секретного ключа формы
//составление секретного ключа формы



$status=1;
	   



?>
<div id="Modal-one" class="box-modal table-modal eddd1 history_window1 client_window"><div class="box-modal-pading">			    
<div class="top_modal">
	
	
	
  <div class="box-modal_close arcticmodal-close"></div>
  <? echo'<h1 class="h111 js-s_form_xx" mor="'.$token.'" for="'.htmlspecialchars(trim($id_user)).'"><span>Выбор клиента</span></h1>'; ?>
  
  
  
</div>
<div class="center_modal">
<?
echo'<form id="vino_xd_cb" style=" padding:0; margin:0;" method="get" enctype="multipart/form-data">';
echo'<input type="hidden" value="'.( isset($_GET['id']) ? htmlspecialchars(trim($_GET['id'])) : '').'" name="id">';
echo'<input type="hidden" value="'.$token.'" name="tk">';		
		 if(isset($_GET['several']))
		 {
echo'<input type="hidden" value="'.$_GET['several'].'" name="several_choice">';
		 } else
		 {
echo'<input type="hidden" value="0" name="several_choice">';			 
		 }
//меню с нужными вкладками
	
	
		 if(isset($_GET['posta']))
		 {
echo'<input type="hidden" value="'.$_GET['posta'].'" name="posta">';
		 }

	 if((isset($_GET['tabss']))and($_GET['tabss']=='0'))
		 {
		 echo'<div class="menu_client_w" style="display:none;">';
	 } else
	 {
		 echo'<div class="menu_client_w">';
	 }
	 
	?>
   <div class="mm_w">
	   <ul class="tabs_hedi js-tabs-menu-choiche">
		  <?
		 if(isset($_GET['tabss']))
		 {
			 if($_GET['tabss']=='all')
			 {
		       $tabs_menu_x = array("Частное лицо", "Организация","Потенциальный турист");	   
	           $tabs_menu_x_id = array("1","2","3"); 
			 }
			 if($_GET['tabss']=='1')
			 {
		       $tabs_menu_x = array("Частное лицо");	   
	           $tabs_menu_x_id = array("1"); 
			 }
			 if($_GET['tabss']=='2')
			 {
		       $tabs_menu_x = array("Организация");	   
	           $tabs_menu_x_id = array("2"); 
			 }
			 if($_GET['tabss']=='3')
			 {
		       $tabs_menu_x = array("Потенциальный турист");	   
	           $tabs_menu_x_id = array("2"); 
			 }			 
			 if($_GET['tabss']=='0')
			 {
		       $tabs_menu_x = array("Частное лицо");	   
	           $tabs_menu_x_id = array("1"); 
			 }
		 } else
		 {
			        
	   		
       $tabs_menu_x = array("Частное лицо", "Организация");	   
	   $tabs_menu_x_id = array("1","2");	
		 }
		   
		   
	    for ($i=0; $i<count($tabs_menu_x); $i++)
        {  
			if((isset($_GET['tabs'])))	
            { 
			    if($_GET['tabs']==$tabs_menu_x_id[$i])
			     {
				    echo'<li class="tabsss_choice active" id="'.$tabs_menu_x_id[$i].'">'.$tabs_menu_x[$i].'</li>';
			     } else
			     {
				    echo'<li class="tabsss_choice" id="'.$tabs_menu_x_id[$i].'">'.$tabs_menu_x[$i].'</li>';
			     }
			
			} else
			{
			if($i==0)
			{
			  echo'<li class="tabsss_choice active" id="'.$tabs_menu_x_id[$i].'">'.$tabs_menu_x[$i].'</li>';
			} else
			{
			  echo'<li class="tabsss_choice" id="'.$tabs_menu_x_id[$i].'">'.$tabs_menu_x[$i].'</li>';
			}
			}
	    }
?>

	   </ul>
   </div>
</div>	
<?

?>	
	
	
<div class="px_bg">
	

<div class="choice-client-2019 js-choice-cch">

<div class="choice-input">

	
<input name="choice-input-keyup" placeholder="Фамилия, телефон или код клиента" value="" class="choice-input-keyup js-choice-keyup" autocomplete="off" type="text">	
<input type="hidden" value="0"  class="js-choice-client-hidden">	
	
	
</div>

<div class="help-icon-x js-help-search-2021" data-tooltip="Имя, Фамилия, Телефон. Телефон без 8, или +7, или часть номера">u</div>

<div class="choice-input-icon">
	
	<div class="icon-search-2019 js-icon-load">
<svg fill="#3f3f3f" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" focusable="false" viewBox="-3 -3 24 24"><path  class="icon__fill" d="M14.32 12.906l3.387 3.387a1 1 0 0 1-1.414 1.414l-3.387-3.387a8 8 0 1 1 1.414-1.414zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z"></path></svg>
	</div>
	
	</div>	

</div>	
	<div class="list-scroll-client">
	
<?
// частное лицо
if($_GET['tabs']==1)
{
include $url_system.'tours/code/tabs_client_search.php'; 
echo($query_string);		
}

//Частное лицо+туристы
if($_GET['tabs']==4)
{
    include $url_system.'tours/code/tabs_client_search_plus.php';
    echo($query_string);
}

//организация
if($_GET['tabs']==2)
{
include $url_system.'tours/code/tabs_org_search.php'; 
echo($query_string);		
}


	

	
	
?>
		</div>
	</div>
	<?

	
		  
?>
</form>
</div>		
<div class="bottom_modal">	
	
	
	
 <span class="clock_table"></span>
<div class="ne_znay_flex">
 <?	
if (($role->permission('Клиенты','A'))or($sign_admin==1))
{
	if((!isset($_GET["new"]))or($_GET["new"]==1))
	{
echo'<div class="znay_f1"><div id="no_rdx" class="save_button new_open_client js-new_open_client" tabs_g="0"><i>Новый клиент</i></div></div>';
	}
}
		

echo'<div class="znay_f2"><div class="list_choice_yes">


</div></div>';
	
	
echo'<div class="znay_f3"><div id="no_rdx" class="save_button choice_client_cb js-choice-yyy" id_rel="0" tabs="1"><i>Выбрать</i></div></div>';		
		

	echo'</div>';
?>


		
	<!--<div class="js-tabs_docc js-tabs_3">-->
		
 <?	
	
//echo'<div id="no_rd" class="save_button add_say_cb" id_rel="'.$_GET["id"].'"><i>Добавить запись</i></div>';
         

 ?> 		
		
		<!--</div>-->
</div>              
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
//include_once $url_system.'template/form_js.php';
?>

 <script type="text/javascript">
     ToolTip();
	 /*
 $(document).ready(function(){ 
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
		
	 
 });
 */
	 </script>