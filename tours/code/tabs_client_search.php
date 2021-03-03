<?
//вывод список клиентов


$echo_xx=1;
$count_say=15;
$redd__='';
$query_string='';
$result_8 = mysql_time_query($link,'SELECT A.id,A.fio,A.date_birthday,A.id_user,A.phone  FROM k_clients AS A WHERE A.visible=1 and A.potential=0 and A.id_a_company="'.htmlspecialchars(trim($id_company)).'" order by A.fio limit 0,'.$count_say);



$num_8 = $result_8->num_rows;	
if($result_8)
{	

  			  while($row_8 = mysqli_fetch_assoc($result_8)){

				 					 

						 
					  $query_string_xx='<div rel_notib="'.$row_8["id"].'" class="list_client_choice">';

	

$query_string_xx.='<div class="h_cb"><span>'.$row_8["fio"].'</span>';
		
				  
$date_bb='';
	if($row_8["date_birthday"]!='0000-00-00')
	{

		$date_start1=explode("-",htmlspecialchars(trim($row_8["date_birthday"])));
				  
				   $startxr=$date_start1[2].'.'.$date_start1[1].'.'.$date_start1[0];
		$date_bb=$startxr;
	}


                  if($row_8["phone"]!='') {
                      $phone_format = '+7 (' . $row_8["phone"][0] . $row_8["phone"][1] . $row_8["phone"][2] . ') ' . $row_8["phone"][3] . $row_8["phone"][4] . $row_8["phone"][5] . '-' . $row_8["phone"][6] . $row_8["phone"][7] . '-' . $row_8["phone"][8] . $row_8["phone"][9];
                  } else
                  {
                      $phone_format = 'Телефон не указан';
                  }

                  $query_string_xx.='<div class="date_cb" >'.$phone_format.' / '.$date_bb.'</div></div>';
				  
				  
	$result_status22=mysql_time_query($link,'SELECT b.name_user,b.name_small FROM r_user AS b WHERE b.id="'.htmlspecialchars(trim($row_8["id_user"])).'"');	
					 //echo('SELECT a.* FROM r_status AS a WHERE a.numer_status="'.$row1ss["status"].'" and a.id_system=13');
                if($result_status22->num_rows!=0)
                {  
                   $row_status22 = mysqli_fetch_assoc($result_status22);			  
$query_string_xx.='<div class="kto_clo">'.$row_status22['name_small'].'</div>';
				}
				  
		
			  
				  
				  
$query_string_xx.='';
				  
				  

			   

$query_string_xx.='</div>';
//$query_string_xx.='</div>';
				  
		  
				  

$query_string.=$query_string_xx;
								  
					 
				  
				  
				  
				  
			  }
	

	//выводить кнопку еще или нет
	  $sql_gog2='select count(A.id) as cc from k_clients as A where A.visible=1 and A.potential=0 and A.id_a_company="'.htmlspecialchars(trim($id_company)).'"';  
	
	//echo($sql_gog2);
      $result_gog2=mysql_time_query($link,$sql_gog2);
      $num_results_gog2 =$result_gog2->num_rows;
      if($num_results_gog2!=0)
      { 
             $row_gog2 = mysqli_fetch_assoc($result_gog2);
		     if(($row_gog2["cc"]!=0)and($row_gog2["cc"]>$count_say))
			 {	
	            $query_string.='<div class="cb_eshe_client js-eshe-client-x" pg="1" start="0" all="'.$count_say.'" ><span>показать еще</span></div>';
			 }
	  }		
	
	
}
if($num_8==0)
{
	$query_string.='<div class="message_search_b message_clients_cb js-message-search-cc"><span>УПСС! Ни одного клиента не найдено. </span></div>';
} else
{
	$query_string.='<div class="message_search_b message_clients_cb js-message-search-cc" style="display:none;"><span>УПСС! Ни одного клиента не найдено.</span></div>';	
}


$query_string.='</div>';