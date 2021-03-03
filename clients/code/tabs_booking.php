<?
$query_string='<div class="booking_clients">';
$echo_xx=1;
$redd__='';
$result_8 = mysql_time_query($link,'select A.*,B.name from  booking as A,booking_status as B WHERE A.visible=1 and A.status=B.result_number and B.id_system=1 and A.id_client="'.$id.'" order by A.datetime desc ');



$num_8 = $result_8->num_rows;	
//$row_1 = mysqli_fetch_assoc($result2);
if($result_8)
{	


	$com=0;
			    $cost=0;
				$count_y=0;
				$large_booking=1;  // краткий вывод
  			  while($row_8 = mysqli_fetch_assoc($result_8)){

				 					 

						 
					  $query_string_xx='<div rel_notib="'.$row_8["id"].'" class="booking_cb">';

	

$query_string_xx.='<div class="number_cb"><span><div>'.$row_8["id"].'</div></span></div>';
$query_string_xx.='<div class="h_cb"><a href="booking/'.$row_8["id"].'/"><span>'.$row_8["title"].'</span></a>';
			
$query_string_xx.='<div class="date_cb" data-tooltip="Заявка поступила">'.time_stamp($row_8["date_create"]).'</div>';	


		//если продана или частично выводим номер договора или просто пусто
		$number_doc='';
			
			
				$result_status22=mysql_time_query($link,'SELECT b.name FROM booking_offers AS a,booking_contract as b WHERE  (a.status=2) and a.id_booking="'.htmlspecialchars(trim($row_8["id"])).'" and a.id_contract=b.id');	
					 //echo('SELECT a.* FROM r_status AS a WHERE a.numer_status="'.$row1ss["status"].'" and a.id_system=13');
                if($result_status22->num_rows!=0)
                {  
                   $row_status22 = mysqli_fetch_assoc($result_status22);
				   $number_doc=$row_status22["name"];
				} 	
			
		$query_string_xx.='<div class="doc_cb">'.$number_doc.'</div>';					  				  
$query_string_xx.='</div>';
				  	   
			   
$query_string_xx.='<div class="right_cb">';
						 
if(($row_8["status"]==3)or($row_8["status"]==6))
{					
	if($redd__=='')
	{
	if($row_8["status"]==3)
    {		
	$query_string_xx.='<span data-tooltip="Забронировали" class="user_mat naryd_yes vot_ws"></span>';	
	}else
	{
		$query_string_xx.='<div class="status_bb'.$row_8["status"].'">'.$row_8["name"].'</div>';
	}
		
	} else
	{
		$query_string_xx.='<div class="status_bb5 red_bb5_attach" style="color:#fff;">Нет товарного чека <br>('.$row_8["name"].')</div>';
	}
} else{
		$query_string_xx.='<div class="status_bb'.$row_8["status"].'">'.$row_8["name"];
if($row_8["status"]==2)
{
	//позвонить

	
		//узнаем во сколько перезвонить
		$result_status2=mysql_time_query($link,'SELECT a.date FROM booking_status_history AS a WHERE a.id_booking="'.htmlspecialchars(trim($row_8['id'])).'"  order by datetime limit 1');	
					 //echo('SELECT a.* FROM r_status AS a WHERE a.numer_status="'.$row1ss["status"].'" and a.id_system=13');
                if($result_status2->num_rows!=0)
                {  
                   $row_status2 = mysqli_fetch_assoc($result_status2);
				}
			if(($row_status2["date"]!='')and($row_status2["date"]!='0000-00-00 00:00:00'))
			{
		
			$query_string_xx.='<br>'.time_future_($row_status2["date"]);			   
			   
			
			}
	
	
}
	//echo'<br>'.time_future_($row_8["date_phone"]);
	$query_string_xx.='</div>';
}				  				  
$query_string_xx.='</div>';

$query_string_xx.='</div>';
//$query_string_xx.='</div>';

$query_string.=$query_string_xx;
								  
					 
				  
				  
				  
				  
			  }
	

	
	
	
}


if($num_8==0)
{
	$query_string.='<div class="message_search_b message_clients_cb"><span>Информация о подборках данному туристу неизвестна</span></div>';
}

$query_string.='</div>';