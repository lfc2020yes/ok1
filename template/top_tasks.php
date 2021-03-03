
<?
	

?>





<div class="menu-09  input-line" style="z-index:150;">
<!--<div class="menu-09 no-fixed-mobile input-line" style="z-index:150;">-->
 <div class="menu-09-left client-menu-left">
     <a href="/" class="menu-09-global"></a><a onclick="history.back();" class="menu-09-prev"><i></i></a>
	 <span class="menu-09-pc-h"><span>Ваши задачи</span></span>
	 
	 

 </div>
 <div class="menu-09-right client-menu-right">
 <?
	 
	 	 include_once $url_system.'module/notification.php';

	 if (($role->permission('Задачи','A'))or($sign_admin==1))
{

		echo'<a tabs_g="0" data-tooltip="добавить задачу" class="add_invoice22 js-add_new_task hide-mobile">добавить задачу<i></i></a>'; 		
	 }
	 
?>	
 	
<!--<div class="inline_reload js-reload-top"><a href="task/" class="show_reload ">Применить</a></div> -->
 	 	
</div></div>


<div class="mobile-bottom-z">
  <div class="mobile-new-2000">
	  <?
	 if (($role->permission('Задачи','A'))or($sign_admin==1))
{
	       echo'<a tabs_g="0" class="js-add_new_task client_1 client_100" data-tooltip="добавить задачу">добавить задачу</a>';				
		}
	  ?>
  </div>
</div>	
