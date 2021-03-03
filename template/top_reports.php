<div class="oka_menu_top joii">
 <div class="oka_left_center" style="padding-left: 70px; width: 95%;"><a onclick="history.back();" class="close_prime_dom dom_134"><i></i></a>
<span class="add_bo">Отчеты по рекламным турам</span>


<?
//echo'<span class="add_bo" style="padding-right:30px; margin-right:30px; border-right: 1px solid #efeff0;">Заявки</span>';

?>
    
    
   
</div>
 <div class="oka_right index_booking">



 <?
	 
	 	 include_once $url_system.'module/notification.php';
if(($role->permission('Отчеты','A'))or($sign_admin==1))
{
  echo'<a href="reports/add/" data-tooltip="добавить отчет" class="add_invoice22">добавить отчет<i></i></a>';
}
?>	
 	 	
 
 </div>
 
 </div>
    