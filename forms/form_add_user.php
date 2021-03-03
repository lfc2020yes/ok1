<?php
//форма информация о туристе

$url_system=$_SERVER['DOCUMENT_ROOT'].'/';
include_once $url_system.'module/ajax_access.php';


//создание секрет для формы
$secret=rand_string_string(4);
$_SESSION['s_form'] = $secret;

$status=0;


   $class_bba='cost_bank1';

if((!isset($_SESSION["user_id"]))or(!is_numeric(id_key_crypt_encrypt($_SESSION["user_id"]))))
{	
	goto end_code;
}

$id_user=id_key_crypt_encrypt($_SESSION["user_id"]);

//проверить есть ли переменная id и можно ли этому пользователю это делать
if ((count($_GET) != 1)and (count($_GET) != 2))
{
	goto end_code;	
}	
	


if ((!$role->permission('Клиенты','A'))and($sign_admin!=1))
{
    goto end_code;	
}
$_GET['id']=$id_user;
//составление секретного ключа формы
//составление секретного ключа формы
//соль для данного действия
$token=token_access_compile($_GET['id'],'bt_client_add',$secret);
//составление секретного ключа формы
//составление секретного ключа формы
//составление секретного ключа формы



$status=1;
	   



?>
<div id="Modal-one" class="box-modal table-modal eddd1 history_window1 client_window"><div class="box-modal-pading">			    
<div class="top_modal">
	
	
	
  <div class="box-modal_close arcticmodal-close"></div>
  <? 
  echo'<h1 class="h111" mor="'.$token.'" for="'.htmlspecialchars(trim($_GET['id'])).'"><span>Добавить туриста</span></h1>'; 
  ?>
  
  
  
</div>
<div class="center_modal">
<?
echo'<form id="vino_xd_cb" style=" padding:0; margin:0;" method="get" enctype="multipart/form-data">';
echo'<input type="hidden" value="'.htmlspecialchars(trim($_GET['id'])).'" name="id">';
echo'<input type="hidden" value="'.$token.'" name="tk">';		
echo'<input type="hidden" value="0" name="temp">';

		 if(isset($_GET['posta']))
		 {
echo'<input type="hidden" value="'.$_GET['posta'].'" name="posta">';
		 }	
	
	
//меню с нужными вкладками
	?>
<div class="menu_client_w">
   <div class="mm_w">
	   <ul class="tabs_hedi tabs_hedi_add js-tabs-menu">
		  <?
		
	   $tabs_get=$_GET['tabs'];
		   if($_GET['tabs']==2)
		   {
			   $tabs_get=0;
		   }
			
       $tabs_menu_x = array( "Частное лицо", "Организация");
	   $tabs_menu_x_id = array("0","1");	
	    for ($i=0; $i<count($tabs_menu_x); $i++)
             {   
			   if($tabs_get==$tabs_menu_x_id[$i])
			   {
				   echo'<li class="tabsss1 active" id="'.$tabs_menu_x_id[$i].'">'.$tabs_menu_x[$i].'</li>';
			   } else
			   {
				  echo'<li class="tabsss1" id="'.$tabs_menu_x_id[$i].'">'.$tabs_menu_x[$i].'</li>';
			   }
			 
			 }
?>

	   </ul>
   </div>
</div>	
<div class="px_bg">
<?
// о туристе
if(($_GET['tabs']==0)or($_GET['tabs']==2))
{
include $url_system.'clients/code/tabs_add_face.php'; 
echo($query_string);	
}
// заявки
if($_GET['tabs']==1)
{
include $url_system.'clients/code/tabs_organ.php'; 
echo($query_string);		
}	

	

	
	
?>	
	</div>
	<?

	
		  
?>
</form>
</div>		
<div class="bottom_modal" style="text-align: center;">			
 <span class="clock_table"></span>
	<div class="js-tabs_docc js-tabs_0 tabs_11_2">
 <?	
		   
			   

echo'<div id="no_rd" class="no_button del_client_cb"><i>Отменить добавление</i></div>';
		
		
?>


		</div>
	<div class="js-tabs_docc js-tabs_1">
		 <?	
		   
			   

echo'<div id="no_rd" class="no_button del_client_cb"><i>Отменить добавление</i></div>';
		
		
?>
	</div>	
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
include_once $url_system.'template/form_js.php';
?>

 <script type="text/javascript">
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
	 
	 		$(".slct").unbind('click.sys');
    $(".slct").bind('click.sys', slctclick);
	$(".drop").find("li").unbind('click');
	$(".drop").find("li").bind('click', dropli);
		
	 
 });