<?
  //шаблон вывода организаций

$temp='';			   
					 
       $os = array( "По алфавиту","Новые","По вылету","Сейчас Отдыхают","Отдохнули");
	   $os_id = array("0","1","2","3","4");

       $os2 = array( "Не важно", "сегодня","завтра","в этом месяце","в следующем месяце","выбрать");
	   $os_id2 = array("0", "1","3","4","5","2");	

$temp.='<div class="clients_block '.$new_class_block.'" op_rel="'.$row_8["id"].'">';
						 
$temp.='<div class="open_operator"></div>';						 

$temp.='<div class="clients_h4 clients_h4_">';		
	

			   
			   
$temp.='<a class="js-client" iod="'.$row_8["id"].'"><span class="js-glu-f-'.$row_8["id"].'">'.$row_8["fio"].'</span>';

						 $temp.='</a>';	
	$temp.='<div class="code_clients">[code - '.$row_8["code"].']</div>';
			   

		$result_status22=mysql_time_query($link,'SELECT count(a.id) as cc FROM booking AS a WHERE a.id_client="'.htmlspecialchars(trim($row_8["id"])).'"');	
					 //echo('SELECT a.* FROM r_status AS a WHERE a.numer_status="'.$row1ss["status"].'" and a.id_system=13');
                if($result_status22->num_rows!=0)
                {  
                   $row_status22 = mysqli_fetch_assoc($result_status22);
				} 			   
			   
if((($sign_admin==1)or($row_8["id_user"]==$id_user))and($row_status22["cc"]==0))
{
$temp.='<div class="font-ranks del_clients_" data-tooltip="Удалить" id_rel="'.$row_8["id"].'"><span class="font-ranks-inner">_</span></div>';
}	else
{
	$temp.='<div class="font-ranks"></div>';
}		

//выводим инфу по общению последнему и вылету и прилету если есть такое
		
	   
			   
		$result_status22_comm=mysql_time_query($link,'SELECT A.comment  FROM k_clients_commun AS A WHERE A.visible=1 and A.id_client="'.htmlspecialchars(trim($row_8["id"])).'" order by A.datetimes desc limit 0,1');	
	
	//$temp.='SELECT A.comment  FROM k_clients_commun AS A WHERE A.visible=1 and A.id_client="'.htmlspecialchars(trim($row_8["id"])).'" order by A.datetimes desc limit 0,1';
	
					 //echo('SELECT a.* FROM r_status AS a WHERE a.numer_status="'.$row1ss["status"].'" and a.id_system=13');
                if($result_status22_comm->num_rows!=0)
                {  
                   $row_status22_comm = mysqli_fetch_assoc($result_status22_comm);			   
$temp.='<div class="commun js-glu-s-'.$row_8["id"].'">'.$row_status22_comm["comment"].'</div>';
				} else
				{
					$temp.='<div class="commun js-glu-s-'.$row_8["id"].'" style="display:none;"></div>';
				}
 
			   		
$temp.='</div>';			   				
				
$temp.='<div class="yes_dop_us">';
								

				//$temp.='<div class="turs_cll" data-tooltip="Туры"><i></i></div>';
				
						$result_status22_fly_end1=mysql_time_query($link,'SELECT count(A.id) as cc  FROM k_clients_commun AS A WHERE A.visible=1 and A.id_client="'.htmlspecialchars(trim($row_8["id"])).'"');

                if($result_status22_fly_end1->num_rows!=0)
                {  
					$row_status22_fly_end1 = mysqli_fetch_assoc($result_status22_fly_end1);
					if($row_status22_fly_end1["cc"]!=0)
					{
				$temp.='<div class="send_cll yest_cl js-client-dop" tabs="3" iod="'.$row_8["id"].'" data-tooltip="Общение"><i></i></div>';
					} else
					{
						$temp.='<div class="send_cll js-client-dop" tabs="3" iod="'.$row_8["id"].'" data-tooltip="Общение"><i></i></div>';
					}
					
				}
				
$temp.='</div>';				
				
						 	
				//$copy++;
			   if($row_8["phone"]!='') {
				   $phone_format = '+7 (' . $row_8["phone"][0] . $row_8["phone"][1] . $row_8["phone"][2] . ') ' . $row_8["phone"][3] . $row_8["phone"][4] . $row_8["phone"][5] . '-' . $row_8["phone"][6] . $row_8["phone"][7] . '-' . $row_8["phone"][8] . $row_8["phone"][9];
			   } else
			   {
				   $phone_format = 'НЕ УКАЗАН';
			   }

if((($_COOKIE["su_1c".$id_user]!=2)and($_COOKIE["su_1c".$id_user]!=3)and($_COOKIE["su_1c".$id_user]!=4))or(($_COOKIE["su_7c".$id_user]!='')and(isset($_COOKIE["su_7c".$id_user]))))
			{			   
$temp.='<div class="tell_o phone_clients_x phone_1_search"><span class="js-glu-t-'.$row_8["id"].'" data-tooltip="Телефон" >'.$phone_format.'</span>';
} else
{
$temp.='<div class="tell_o phone_clients_x"><span data-tooltip="Телефон" class="js-glu-t-'.$row_8["id"].'">'.$phone_format.'</span>';	
}
	

			   
$temp.='</div>';
			   
			   
		/*	   
		if ((( isset($_COOKIE["su_1c"]))and(is_numeric($_COOKIE["su_1c"]))and(array_search($_COOKIE["su_1c"],$os_id)!==false))and($_COOKIE["su_1c"]!=2))
		{			*/
$temp.='<div class="comment_o rois comment_clients">'.$row_8["comment"].'</div>';
	//	}

						 
$temp.='</div>';						 

			   
		   
?>
								  
						 
					 
			   
			   
		   