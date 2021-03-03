<?php
//форма информация о туристе

$url_system=$_SERVER['DOCUMENT_ROOT'].'/';
include_once $url_system.'module/ajax_access.php';


//создание секрет для формы
$secret=rand_string_string(4);
$_SESSION['s_form'] = $secret;

$status=0;
$id=htmlspecialchars($_GET['id']);


   $class_bba='cost_bank1';

if((!isset($_SESSION["user_id"]))or(!is_numeric(id_key_crypt_encrypt($_SESSION["user_id"]))))
{	
	goto end_code;
}

$id_user=id_key_crypt_encrypt($_SESSION["user_id"]);

//проверить есть ли переменная id и можно ли этому пользователю это делать
if ((count($_GET) != 2)or(!isset($_GET["id"]))or((!is_numeric($_GET["id"])))) 
{
	goto end_code;	
}	
	


$result_t=mysql_time_query($link,'Select b.* from k_organization as b where b.id="'.htmlspecialchars(trim($_GET['id'])).'" and b.visible=1');
$num_results_t = $result_t->num_rows;
if($num_results_t==0)
{	
		$debug=h4a(5,$echo_r,$debug);
		goto end_code;
	
} else
{
	$row_score = mysqli_fetch_assoc($result_t);
}


if ((!$role->permission('Клиенты','R'))and($sign_admin!=1))
{
    goto end_code;	
}

//составление секретного ключа формы
//составление секретного ключа формы
//соль для данного действия
$token=token_access_compile($_GET['id'],'bt_org_info',$secret);
//составление секретного ключа формы
//составление секретного ключа формы
//составление секретного ключа формы



$status=1;
	   



?>
<div id="Modal-one" class="box-modal table-modal eddd1 history_window1 client_window"><div class="box-modal-pading">			    
<div class="top_modal">
	
	
	
  <div class="box-modal_close arcticmodal-close"></div>
  <? echo'<h1 class="h111" mor="'.$token.'" for="'.htmlspecialchars(trim($_GET['id'])).'"><span>Информация об организации</span></h1>'; ?>
  
  
  
</div>
<div class="center_modal">
<?
echo'<form id="vino_xd_cb" style=" padding:0; margin:0;" method="get" enctype="multipart/form-data">';
echo'<input type="hidden" value="'.htmlspecialchars(trim($_GET['id'])).'" name="id">';
echo'<input type="hidden" value="'.$token.'" name="tk">';		


echo'<div class="name_docu">'.$row_score["name"].'</div>';
echo'<div class="global_docu">	
<div class="left_gl" style="width:100%">';
	 $phone_format='+7 ('.$row_score["phone_contact"][0].$row_score["phone_contact"][1].$row_score["phone_contact"][2].') '.$row_score["phone_contact"][3].$row_score["phone_contact"][4].$row_score["phone_contact"][5].'-'.$row_score["phone_contact"][6].$row_score["phone_contact"][7].'-'.$row_score["phone_contact"][8].$row_score["phone_contact"][9];
echo'<div class="icc_gl_3" data-tooltip="Телефон контактного лица">'.$phone_format.'</div>';


	
echo'<div class="icc_gl_4">'.rooo($row_score["email"],'','—').'</div>';	
echo'</div>		
</div>';	
		
//меню с нужными вкладками
	?>
<div class="menu_client_w" >
   <div class="mm_w">
	   <ul class="tabs_hedi js-tabs-menu_org">
		  <?
		   
			
       $tabs_menu_x = array( "об организации","путешествия","файлы");
	   $tabs_menu_x_id = array("0","1","2");	
	    for ($i=0; $i<count($tabs_menu_x); $i++)
             {   
			   if($_GET['tabs']==$tabs_menu_x_id[$i])
			   {
				   echo'<li class="tabsss_org active" id="'.$tabs_menu_x_id[$i].'">'.$tabs_menu_x[$i].'</li>';
			   } else
			   {
				  echo'<li class="tabsss_org" id="'.$tabs_menu_x_id[$i].'">'.$tabs_menu_x[$i].'</li>';
			   }
			 
			 }
?>

	   </ul>
   </div>
</div>	
<div class="px_bg">
<?
// об организации
if($_GET['tabs']==0)
{
include $url_system.'clients/code/tabs_about_org.php'; 
echo($query_string);	
}
// путешествия
if($_GET['tabs']==1)
{
include $url_system.'clients/code/tabs_offers_org.php'; 
echo($query_string);		
}	
// файлы
if($_GET['tabs']==2)
{
include $url_system.'clients/code/tabs_file_org.php';
echo($query_string);		
}	
	

	
	
?>	
	</div>
	<?

	
		  
?>
</form>
</div>		
<div class="bottom_modal">			
 <span class="clock_table"></span>
	<div class="js-tabs_docc js-tabs_0 tabs_11_2">
 <?	
if (($role->permission('Клиенты','U'))or($sign_admin==1))
{
echo'<div id="no_rdx_org" class="save_button edit_org_cb js-edit-org-2020" id_rel="'.$_GET["id"].'"><i>Редактировать</i></div>';
}
		/*
		$result_status22=mysql_time_query($link,'SELECT count(a.id) as cc FROM booking AS a WHERE a.id_org="'.htmlspecialchars(trim($_GET["id"])).'"');	
					 //echo('SELECT a.* FROM r_status AS a WHERE a.numer_status="'.$row1ss["status"].'" and a.id_system=13');
                if($result_status22->num_rows!=0)
                {  
                   $row_status22 = mysqli_fetch_assoc($result_status22);
				} 			   
			*/   
if((($sign_admin==1)or($row_score["id_user"]==$id_user)))
{
echo'<div id="" class="no_button del_client_cb del_org_" id_rel="'.$_GET["id"].'"><i>Удалить</i></div>';
}		
		
?>


		</div>
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
	 

var id_tt=$('.js-tabs-menu_org').find('.active').attr('id');
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