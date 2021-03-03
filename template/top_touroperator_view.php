<?


$flag_tov=0;

?>


<div class="oka_menu_top joii">
 <div class="oka_left_center" style="padding-left: 70px; width: 700px;"><a href="touroperator/" class="close_prime_dom"><i></i></a>


<?
echo'<span class="add_bo"> Туроператор - '.$row_list["name"];

	 echo'</span>';

	 
?>	

 </div>
 <div class="oka_right index_booking" style="width: 100%;">

 <?
	 
	 	 include_once $url_system.'module/notification.php';

?>	
 	 	
  	<?
		//заказать


		
		
if ($role->permission('Туроператоры','U'))
{
	     // echo'<div class="save_button add_invoicess1"><i>Сохранить</i></div>';
			echo'<div data-tooltip="сохранить туроператора" class="add_invoice save_booking" style="margin-left: 0px;">сохранить</div>';
		  if((isset($stack_error))and((count($stack_error)!=0)))
          {	
		      echo'<div class="error_text_add">Не все поля заполнены для сохранения</div>';	
		  } else
		  {
			 echo'<div style="display:none;" class="error_text_add"></div>';  
		  }			
		} 			
			
			
			

?>
 	
 </div>
 
 </div>
  


