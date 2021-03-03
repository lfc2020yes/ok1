<?


$flag_tov=0;

?>


<div class="oka_menu_top joii">
 <div class="oka_left_center" style="padding-left: 70px; width: 700px;"><a href="reports/" class="close_prime_dom"><i></i></a>


<?
echo'<span class="add_bo"> Отчет по рекламному туру  -  №'.$row_list["id"];

	 
		   $result_txs=mysql_time_query($link,'Select a.name_user,a.timelast,a.id from r_user as a where a.id="'.$row_list["id_user"].'"');
	            if($result_txs->num_rows!=0)
	            {   
		          $rowxs = mysqli_fetch_assoc($result_txs);
									  $online='';	
				// if(online_user($rowxs["timelast"],$rowxs["id"],$id_user)) { $online='<div class="online"></div>';}	
					
			  echo'<div class="ktoo1">'.$rowxs["name_user"].'</div>';
				} 
	 
	 
	 echo'</span>';

	 
?>	

 </div>
 <div class="oka_right index_booking" style="width: 100%;">

 <?
	 
	 	 include_once $url_system.'module/notification.php';

?>	
 	 	
  	<?
		//заказать


		
		
if ((($role->permission('Отчеты','U'))and($row_list["id_user"]==$id_user))or($sign_admin==1))
{
	     // echo'<div class="save_button add_invoicess1"><i>Сохранить</i></div>';
			echo'<div data-tooltip="сохранить отчет" class="add_invoice save_reports" style="margin-left: 0px; display:none;">сохранить отчет</div>';
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
  


