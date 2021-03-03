<?
$count_offers=0;
$result_scores=mysql_time_query($link,'Select count(a.id) as cc from booking_offers as a where a.id_booking="'.htmlspecialchars(trim($_GET['id'])).'" and a.visible=1');
$num_results_scores = $result_scores->num_rows;
if($num_results_scores!=0)
{	  
  $row_scores = mysqli_fetch_assoc($result_scores);
  $count_offers=$row_scores["cc"];
}

$flag_tov=0;

?>
<div class="oka_menu_top joii"><div class="oka_left_center" style="padding-left: 70px; width: 700px;"><a onclick="history.back();" class="close_prime_dom"><i></i></a>	 
<?

echo'<span class="add_bo">Заявка №'.$row_list["id"];

$result_txs=mysql_time_query($link,'Select a.name_user,a.timelast,a.id from r_user as a where a.id="'.$row_list["id_user"].'"');
if($result_txs->num_rows!=0)
	 {   
		          $rowxs = mysqli_fetch_assoc($result_txs);
									  $online='';	
				// if(online_user($rowxs["timelast"],$rowxs["id"],$id_user)) { $online='<div class="online"></div>';}	
					
			  echo'<div class="ktoo1">'.$rowxs["name_user"].'</div>';
				} 
//}
	 echo'</span>';
	 
?>	

 </div>
 <div class="oka_right index_booking" style="width: 100%;">

 <?
	 
	 	 include_once $url_system.'module/notification.php';

?>	
 	 	
  	<?
		//заказать
	 if(($row_list["status"]!=3)and($row_list["status"]!=6))
	 {	 
		 //echo(array_search($row_list["id_object"],$hie_object) !== false);
		if(((array_search($row_list["id_object"],$hie_object) !== false)or($sign_admin==1))and($count_offers!=0))
		{ 
		 
		if($row_list["ready"]==0)
		{
/*echo'<form id="lalala_pod_form" action="invoices/take/'.$_GET["id"].'/" style=" padding:0; margin:0;" method="post" enctype="multipart/form-data">
  <input name="tk_sign" value="'.token_access_compile($_GET['id'],'take_invoices_2018',$secret).'" type="hidden">
</form>';	
*/			echo'<span class="button_yes_no" for="'.$row_list["id"].'">';
	 if($row_list["status"]!=4)
	 {	
		 echo'<div data-tooltip="отказались от предложений" class="add_invoice noo_booking">отказались</div>';
	 }
		 if($row_list["status"]!=1)
	 {		
		 echo'<div data-tooltip="думают" class="add_invoice think_booking">думают</div>';	
	 }
			
	
			echo'</span>';	
			
		echo'<div style="display:none;" data-tooltip="сохранить заявку" class="add_invoice save_booking">сохранить</div>';	
					
			
			
	 	   if((isset($stack_error))and((count($stack_error)!=0)))
           {	
		      echo'<div class="error_text_add">Не все поля заполнены для сохранения</div>';	
		   } else
		   {
			 echo'<div style="display:none;" class="error_text_add"></div>';  
		   }		
			
			
		}
		if($row_list["ready"]==1)
		{			
			
	echo'<span class="button_yes_no" for="'.$row_list["id"].'">';
	 if($row_list["status"]!=4)
	 {	
		 echo'<div data-tooltip="отказались от предложений" class="add_invoice noo_booking">отказались</div>';
	 }
			
	 if($row_list["status"]!=6)
	 {			
			
		 if($row_list["status"]!=1)
	 {		
		 echo'<div data-tooltip="думают" class="add_invoice think_booking">думают</div>';	
	 }		
			
			
		 echo'<div data-tooltip="необходимо перезвонить" class="add_invoice call_booking">позвонить</div>';
	 }
			/*
			echo'<form id="lalala_seal_form" action="booking/bron/'.$_GET["id"].'/" style=" padding:0; margin:0;" method="post" enctype="multipart/form-data">
  <input name="tk_sign" value="'.token_access_compile($_GET['id'],'bron_booking_x2x',$secret).'" type="hidden">
</form>';
	*/
			
		echo'<div data-tooltip="Купили путевку" class="add_invoice yess_booking">Купили</div>';	
		echo'</span>';	
		echo'<div style="display:none;" data-tooltip="сохранить заявку" class="add_invoice save_booking">сохранить</div>';	
					
			
			
	 	   if((isset($stack_error))and((count($stack_error)!=0)))
           {	
		      echo'<div class="error_text_add">Не все поля заполнены для сохранения</div>';	
		   } else
		   {
			 echo'<div style="display:none;" class="error_text_add"></div>';  
		   }
			
			
			
		} 
			
		}
		else
		{
		
		
		if(((array_search($row_list["id_object"],$hie_object) !== false)or($sign_admin==1))and(($row_list["status"]!=3)))
		{
	     // echo'<div class="save_button add_invoicess1"><i>Сохранить</i></div>';
			echo'<div data-tooltip="сохранить заявку" class="add_invoice save_booking" style="margin-left: 0px;">сохранить</div>';
		  if((isset($stack_error))and((count($stack_error)!=0)))
          {	
		      echo'<div class="error_text_add">Не все поля заполнены для сохранения</div>';	
		  } else
		  {
			 echo'<div style="display:none;" class="error_text_add"></div>';  
		  }			
		} 			
			
			
		} 	
	 } else
	 {
		 
		 

		 
		  if($sign_admin==1)
		 {
			 echo'<div class="dis_bron" dis="'.$row_list["id"].'" data-tooltip="отменить покупку"></div>';
		 }	 
		 
		 
		$result_scorex1=mysql_time_query($link,'SELECT COUNT(DISTINCT b.id) AS vv FROM booking_attach AS b WHERE b.visible=1 and b.id_booking="'.htmlspecialchars(trim($_GET['id'])).'"');
	    $num_results_scorex1 = $result_scorex1->num_rows;
			   
        if($num_results_scorex1!=0)
        {
			$row_scorex1 = mysqli_fetch_assoc($result_scorex1);
			if($row_scorex1["vv"]==0)
			{
		 	echo'<div class="attach_no">нет товарного чека</div>';	
			}
		} 
		 
		 
			$result_status2=mysql_time_query($link,'SELECT a.comment FROM booking_status_history AS a WHERE a.id_booking="'.htmlspecialchars(trim($_GET['id'])).'"  order by datetime desc limit 1');	
		 
		 	$result_status2=mysql_time_query($link,'SELECT a.id_exchange,a.exchange_rates,b.name,b.char FROM booking_offers AS a,booking_exchange as b WHERE b.id=a.id_exchange and a.id_booking="'.htmlspecialchars(trim($_GET['id'])).'" and a.status=2  ');	
		 
					 //echo('SELECT a.* FROM r_status AS a WHERE a.numer_status="'.$row1ss["status"].'" and a.id_system=13');
            if($result_status2->num_rows!=0)
            {  
              $row_status2 = mysqli_fetch_assoc($result_status2);
		    } 
		 
		    echo'<div  data-tooltip="Курс валюты на момент покупки у ТО" class="dollor_yes"><span>'.$row_status2["char"].' '.number_format($row_status2["exchange_rates"], 2, '.', ' ').'</span></div>';
		 
		 
		 				$result_status21=mysql_time_query($link,'SELECT sum(a.commission) as com, sum(a.cost) as cost FROM booking_offers AS a WHERE a.id_booking="'.htmlspecialchars(trim($_GET['id'])).'" and a.status=2');	
					 //echo('SELECT a.* FROM r_status AS a WHERE a.numer_status="'.$row1ss["status"].'" and a.id_system=13');
                if($result_status21->num_rows!=0)
                {  
                   $row_status21 = mysqli_fetch_assoc($result_status21);
				} 
		 
		 
		 
		 
		 
		 
		 $proc_realiz=round(($row_status21["com"]*100)/$row_status21["cost"],1); 
		 
		 
		 //смотрим нужно ли ему показывать комиссию или нет.			   
//показывать если он админ или это его заявка
$pok_com=0;
if($row_list["id_user"]==$id_user)
{
	$pok_com=1;
}
		 
		 if(($sign_admin==1)or($pok_com==1))
		 {
			 				 		$pl__='';

		   if($row_status21["com"]>0)
		   {
			   $pl__='+ ';
		
		   }
			 
			 if($row_list["status"]==6)
	         {
		 echo'<div for="'.$row_list["id"].'" class="pribll win_pribl" data-tooltip="промежуточная комиссия">'.$pl__.rtrim(rtrim(number_format($row_status21["com"], 2, '.', ' '),'0'),'.').' руб.<i>'.$proc_realiz.'%</i></div>';
			 } else
			 {
				 

				 
		 echo'<div for="'.$row_list["id"].'" class="pribll win_pribl" data-tooltip="Итоговая комиссия">'.$pl__.rtrim(rtrim(number_format($row_status21["com"], 2, '.', ' '),'0'),'.').' руб.<i>'.$proc_realiz.'%</i></div>';				 
			 }
		 }
		 
	 if($row_list["status"]==6)
	 {	 
		 echo'<span class="button_yes_no" for="'.$row_list["id"].'">';		 
		 echo'<div data-tooltip="Аванс" class="add_invoice yess_booking">Аванс</div>';			 
		 echo'</span>';
	 }
		 
	 }
?>
 	
 </div>
 
 </div>
  


