<?
  //шаблон вывода организаций

$temp='';			   
					 


$temp.='<div class="clients_org '.$new_class_block.'" op_rel="'.$row_8["id"].'">';
						 
$temp.='<div class="open_operator"></div>';						 

$temp.='<div class="clients_h4 org_h4_">';		
	

			   
			   
$temp.='<a class="js-org" iod="'.$row_8["id"].'"><span class="js-glo-n-'.$row_8["id"].'">'.$row_8["name"].'</span>';

						 $temp.='</a>';	
	
			   
		  /*
		$result_status22=mysql_time_query($link,'SELECT count(a.id) as cc FROM booking AS a WHERE a.id_org="'.htmlspecialchars(trim($row_8["id"])).'"');	
					 //echo('SELECT a.* FROM r_status AS a WHERE a.numer_status="'.$row1ss["status"].'" and a.id_system=13');
                if($result_status22->num_rows!=0)
                {  
                   $row_status22 = mysqli_fetch_assoc($result_status22);
				} 			   
			     */
if((($sign_admin==1)or($row_8["id_user"]==$id_user)))
{
$temp.='<div class="font-ranks del_org_" data-tooltip="Удалить" id_rel="'.$row_8["id"].'"><span class="font-ranks-inner">_</span></div>';
}	else
{
	$temp.='<div class="font-ranks"></div>';
}		
$temp.='<div class="code_clients js-glo-d-'.$row_8["id"].'" data-tooltip="Руководитель">'.$row_8["head"].'</div>';
//выводим инфу по общению последнему и вылету и прилету если есть такое
		
	   
//Узнаем есть ли у него возвращения обратно
$result_status22_fly_end=mysql_time_query($link,'Select 
  
  DISTINCT h.id,
  (SELECT yy.end_fly FROM trips_fly_history AS yy WHERE yy.id_trips=h.id ORDER BY yy.datetime DESC LIMIT 0,1) AS end_fly

  from trips as h,trips_fly_history as xx
  where xx.id_trips=h.id and (SELECT ysy.start_fly FROM trips_fly_history AS ysy WHERE ysy.id_trips=h.id ORDER BY ysy.datetime DESC LIMIT 0,1)>="'.date("Y-m-d").' 00:00:00" and (SELECT ysy.end_fly FROM trips_fly_history AS ysy WHERE ysy.id_trips=h.id ORDER BY ysy.datetime DESC LIMIT 0,1)<"'.date("Y-m-d").' 00:00:00" and h.visible=1 and h.shopper=2 and h.id_shopper="'.htmlspecialchars(trim($row_8["id"])).'"');

                if($result_status22_fly_end->num_rows!=0) {
					while ($row_status22_fly_end = mysqli_fetch_assoc($result_status22_fly_end)) {

						if ($row_status22_fly_end["end_fly"] != '0000-00-00 00:00:00') {
							$date_end = explode(" ", htmlspecialchars(trim($row_status22_fly_end["end_fly"])));
							$date_end1 = explode("-", htmlspecialchars(trim($date_end[0])));
							$date_end2 = explode(":", htmlspecialchars(trim($date_end[1])));
							$endxdd = $date_end1[2] . '.' . $date_end1[1] . '.' . $date_end1[0] . ' ' . $date_end2[0] . ':' . $date_end2[1] . '';

							$temp .= '<div class="fly_comm home_fly">' . $endxdd . ' – ' . $row_status22_fly_end["title"] . '</div>';
						}
					}
				}
//Узнаем улетает ли он куда нибудь
		$result_status22_fly_end=mysql_time_query($link,'Select 
  
  DISTINCT h.id,
  (SELECT yy.start_fly FROM trips_fly_history AS yy WHERE yy.id_trips=h.id ORDER BY yy.datetime DESC LIMIT 0,1) AS start_fly

  from trips as h,trips_fly_history as xx
  where xx.id_trips=h.id and (SELECT ysy.start_fly FROM trips_fly_history AS ysy WHERE ysy.id_trips=h.id ORDER BY ysy.datetime DESC LIMIT 0,1)>"'.date("Y-m-d").' 00:00:00" and h.visible=1 and  h.shopper=2 and h.id_shopper="'.htmlspecialchars(trim($row_8["id"])).'"');

                if($result_status22_fly_end->num_rows!=0) {
					while ($row_status22_fly_end = mysqli_fetch_assoc($result_status22_fly_end)) {

						if ($row_status22_fly_end["start_fly"] != '0000-00-00 00:00:00') {
							$date_end = explode(" ", htmlspecialchars(trim($row_status22_fly_end["start_fly"])));
							$date_end1 = explode("-", htmlspecialchars(trim($date_end[0])));
							$date_end2 = explode(":", htmlspecialchars(trim($date_end[1])));
							$endxdd = $date_end1[2] . '.' . $date_end1[1] . '.' . $date_end1[0] . ' ' . $date_end2[0] . ':' . $date_end2[1] . '';


							$temp .= '<div class="fly_comm">' . $endxdd . ' – <a class="gray-info-trips" target="blank" href="tours/.id-' . $row_status22_fly_end["id"] . '">' . info_trips($row_status22_fly_end["id"], $link) . '</a></div>';
						}
					}
				}
			   
		   
			   		
$temp.='</div>';			   				
				
$temp.='<div class="yes_dop_org">';
								
			$result_status22=mysql_time_query($link,'SELECT count(a.id) as cc FROM trips AS a WHERE  a.shopper=2 and a.id_shopper="'.htmlspecialchars(trim($row_8["id"])).'"');
					 //echo('SELECT a.* FROM r_status AS a WHERE a.numer_status="'.$row1ss["status"].'" and a.id_system=13');
                if($result_status22->num_rows!=0)
                {  
                   $row_status22 = mysqli_fetch_assoc($result_status22);
					if( $row_status22["cc"]!=0)
					{
						$temp.='<div class="turs_cll yest_cl js-org-dop" tabs="1" data-tooltip="Туры" iod="'.$row_8["id"].'"><i></i></div>';
					} else
					{
						$temp.='<div class="turs_cll js-org-dop" tabs="1" iod="'.$row_8["id"].'" data-tooltip="Туры"><i></i></div>';
					}
				} 			   
	
				//$temp.='<div class="turs_cll" data-tooltip="Туры"><i></i></div>';
				
				
$temp.='</div>';				
				
						 	
				//$copy++;
			   
			  
$temp.='<div class="tell_o phone_clients_x11"><span class="js-glo-a-'.$row_8["id"].'" data-tooltip="Юридический адрес">'.$row_8["adress_ur"].'</span>';		   
$temp.='</div>';

$temp.='<div class="tell_o phone_org_x"><div class="center_vert1"><span data-tooltip="Дата добавления">'.time_stamp($row_8["datetimes"]).'</span></div>';		   
$temp.='</div>';	
	
			   
		/*	   
		if ((( isset($_COOKIE["su_1c"]))and(is_numeric($_COOKIE["su_1c"]))and(array_search($_COOKIE["su_1c"],$os_id)!==false))and($_COOKIE["su_1c"]!=2))
		{			*/
$temp.='<div class="comment_o rois comment_clients">'.$row_8["comment"].'</div>';
	//	}

						 
$temp.='</div>';						 

?>
								  
						 
					 
			   
			   
		   