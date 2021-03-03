<?
  //шаблон вывода организаций

/*
            (SELECT yy.start_fly FROM trips_fly_history AS yy WHERE yy.id_trips=b.id ORDER BY yy.datetime DESC LIMIT 0,1) AS start_fly,
  (SELECT yy.end_fly FROM trips_fly_history AS yy WHERE yy.id_trips=b.id ORDER BY yy.datetime DESC LIMIT 0,1) AS end_fly,
b.shopper,
b.id_shopper,
b.id_operator,
b.id_contract,
b.number_to,
b.hotel,
b.id_country,
b.place_name
  */


$temp='';			   
					 
       $os = array( "По алфавиту","Новые","По вылету","Сейчас Отдыхают","Отдохнули","По вылету (Туры)");
	   $os_id = array("0","1","2","3","4","5");

       $os2 = array( "Не важно", "сегодня","завтра","в этом месяце","в следующем месяце","выбрать");
	   $os_id2 = array("0", "1","3","4","5","2");	

$temp.='<div class="clients_block '.$new_class_block.'" op_rel="'.$row_8["id"].'">';
						 
$temp.='<div class="open_operator"></div>';

	if ((( isset($_COOKIE["su_1c".$id_user]))and(is_numeric($_COOKIE["su_1c".$id_user]))and(array_search($_COOKIE["su_1c".$id_user],$os_id)!==false))and(($_COOKIE["su_1c".$id_user]==2)or($_COOKIE["su_1c".$id_user]==3)or($_COOKIE["su_1c".$id_user]==4)or($_COOKIE["su_1c".$id_user]==5))and(((isset($_COOKIE["su_7c".$id_user]))and($_COOKIE["su_7c".$id_user]==''))or(!isset($_COOKIE["su_7c".$id_user]))))
		{
$temp.='<div class="clients_h5 clients_h5_">';		
	} else
	{
$temp.='<div class="clients_h4 clients_h4_">';		
	}

			   
			   
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
		if ((( isset($_COOKIE["su_1c".$id_user]))and(is_numeric($_COOKIE["su_1c".$id_user]))and(array_search($_COOKIE["su_1c".$id_user],$os_id)!==false))or(!isset($_COOKIE["su_1c".$id_user])))
		{
			if((( isset($_COOKIE["su_1c".$id_user]))and($_COOKIE["su_1c".$id_user]!=2)and($_COOKIE["su_1c".$id_user]!=3)and($_COOKIE["su_1c".$id_user]!=4)and($_COOKIE["su_1c".$id_user]!=5))or((isset($_COOKIE["su_7c".$id_user]))and($_COOKIE["su_7c".$id_user]!='')))
			{	
//Узнаем есть ли у него возвращения обратно по старым заявкам
$result_status22_fly_end=mysql_time_query($link,'Select 
  
  DISTINCT h.id as id_booking,
  (SELECT yy.end_fly FROM booking_offers_fly_history AS yy WHERE yy.id_offers=w.id ORDER BY yy.datetime DESC LIMIT 0,1) AS end_fly,
  h.title,w.id as id_offers
  from k_clients as b,booking as h,booking_offers as w,booking_offers_fly_history as xx
  where xx.id_offers=w.id and w.id_booking=h.id and xx.end_fly>="'.date("Y-m-d").' 00:00:00" and xx.start_fly<"'.date("Y-m-d").' 00:00:00" and ((h.status=3)or(h.status=6))  and h.visible=1  and h.id_client=b.id and b.visible=1 AND w.status=2 and b.id="'.htmlspecialchars(trim($row_8["id"])).'"');

                if($result_status22_fly_end->num_rows!=0)
                {  
                   $row_status22_fly_end = mysqli_fetch_assoc($result_status22_fly_end);	
					
									  if($row_status22_fly_end["end_fly"]!='0000-00-00 00:00:00')
				  {	
	   $date_end=explode(" ",htmlspecialchars(trim($row_status22_fly_end["end_fly"])));
				   $date_end1=explode("-",htmlspecialchars(trim($date_end[0])));
				  $date_end2=explode(":",htmlspecialchars(trim($date_end[1])));
				   $endxdd=$date_end1[2].'.'.$date_end1[1].'.'.$date_end1[0].' '.$date_end2[0].':'.$date_end2[1].'';		
					
					$temp.='<div class="fly_comm home_fly">'.$endxdd.' – '.$row_status22_fly_end["title"].'</div>';
				  }
				}			   
//Узнаем улетает ли он куда нибудь по старым заявкам
		$result_status22_fly_end=mysql_time_query($link,'Select 
  
  DISTINCT h.id as id_booking,
 (SELECT yy.start_fly FROM booking_offers_fly_history AS yy WHERE yy.id_offers=w.id ORDER BY yy.datetime DESC LIMIT 0,1) AS start_fly,
  h.title,w.id as id_offers
  from k_clients as b,booking as h,booking_offers as w,booking_offers_fly_history as xx
  where xx.id_offers=w.id and w.id_booking=h.id and xx.start_fly>="'.date("Y-m-d").' 00:00:00" and ((h.status=3)or(h.status=6))  and h.visible=1  and h.id_client=b.id and b.visible=1 AND w.status=2 and b.id="'.htmlspecialchars(trim($row_8["id"])).'"');

                if($result_status22_fly_end->num_rows!=0)
                {  
                   $row_status22_fly_end = mysqli_fetch_assoc($result_status22_fly_end);	
					
				  if($row_status22_fly_end["start_fly"]!='0000-00-00 00:00:00')
				  {	
	   $date_end=explode(" ",htmlspecialchars(trim($row_status22_fly_end["start_fly"])));
				   $date_end1=explode("-",htmlspecialchars(trim($date_end[0])));
				  $date_end2=explode(":",htmlspecialchars(trim($date_end[1])));
				   $endxdd=$date_end1[2].'.'.$date_end1[1].'.'.$date_end1[0].' '.$date_end2[0].':'.$date_end2[1].'';		
					
					$temp.='<div class="fly_comm">'.$endxdd.' – '.$row_status22_fly_end["title"].'</div>';
				  }
				}





				//Узнаем есть ли у него возвращения обратно по новым турам как покупатель
				$result_status22_fly_end=mysql_time_query($link,'Select 
  
  DISTINCT h.id,
  (SELECT yy.end_fly FROM trips_fly_history AS yy WHERE yy.id_trips=h.id ORDER BY yy.datetime DESC LIMIT 0,1) AS end_fly

  from trips as h,trips_fly_history as xx
  where xx.id_trips=h.id and (SELECT ysy.start_fly FROM trips_fly_history AS ysy WHERE ysy.id_trips=h.id ORDER BY ysy.datetime DESC LIMIT 0,1)<="'.date("Y-m-d").' 00:00:00" and (SELECT ysy.end_fly FROM trips_fly_history AS ysy WHERE ysy.id_trips=h.id ORDER BY ysy.datetime DESC LIMIT 0,1)>"'.date("Y-m-d").' 00:00:00" and h.visible=1 and h.shopper=1 and h.id_shopper="'.htmlspecialchars(trim($row_8["id"])).'"');

				if($result_status22_fly_end->num_rows!=0) {

					while ($row_status22_fly_end = mysqli_fetch_assoc($result_status22_fly_end)) {

						if ($row_status22_fly_end["end_fly"] != '0000-00-00 00:00:00') {
							$date_end = explode(" ", htmlspecialchars(trim($row_status22_fly_end["end_fly"])));
							$date_end1 = explode("-", htmlspecialchars(trim($date_end[0])));
							$date_end2 = explode(":", htmlspecialchars(trim($date_end[1])));
							$endxdd = $date_end1[2] . '.' . $date_end1[1] . '.' . $date_end1[0] . ' ' . $date_end2[0] . ':' . $date_end2[1] . '';

							$temp .= '<div class="fly_comm home_fly">' . $endxdd . ' – ' . info_trips($row_status22_fly_end["id"], $link) . '</div>';
						}
					}
				}



				//Узнаем есть ли у него возвращения обратно по новым турам как участник
				$result_status22_fly_end=mysql_time_query($link,'Select 
  
  DISTINCT h.id,
  (SELECT yy.end_fly FROM trips_fly_history AS yy WHERE yy.id_trips=h.id ORDER BY yy.datetime DESC LIMIT 0,1) AS end_fly

  from trips as h,trips_fly_history as xx,trips_clients_fly as f
  where f.id_trips=h.id and xx.id_trips=h.id and (SELECT ysy.start_fly FROM trips_fly_history AS ysy WHERE ysy.id_trips=h.id ORDER BY ysy.datetime DESC LIMIT 0,1)<="'.date("Y-m-d").' 00:00:00" and (SELECT ysy.end_fly FROM trips_fly_history AS ysy WHERE ysy.id_trips=h.id ORDER BY ysy.datetime DESC LIMIT 0,1)>"'.date("Y-m-d").' 00:00:00" and h.visible=1 and ((h.shopper=2) OR((h.shopper=1)AND NOT(h.id_shopper="'.ht($row_8["id"]).'"))) and f.id_k_clients="'.htmlspecialchars(trim($row_8["id"])).'"');

				if($result_status22_fly_end->num_rows!=0) {
					while ($row_status22_fly_end = mysqli_fetch_assoc($result_status22_fly_end)) {

						if ($row_status22_fly_end["end_fly"] != '0000-00-00 00:00:00') {
							$date_end = explode(" ", htmlspecialchars(trim($row_status22_fly_end["end_fly"])));
							$date_end1 = explode("-", htmlspecialchars(trim($date_end[0])));
							$date_end2 = explode(":", htmlspecialchars(trim($date_end[1])));
							$endxdd = $date_end1[2] . '.' . $date_end1[1] . '.' . $date_end1[0] . ' ' . $date_end2[0] . ':' . $date_end2[1] . '';

							$temp .= '<div class="fly_comm home_fly">' . $endxdd . ' – ' . info_trips($row_status22_fly_end["id"], $link) . '</div>';
						}
					}
				}




//Узнаем улетает ли он куда нибудь по турам как покупатель
				$result_status22_fly_end=mysql_time_query($link,'Select 
  
  DISTINCT h.id,
  (SELECT yy.start_fly FROM trips_fly_history AS yy WHERE yy.id_trips=h.id ORDER BY yy.datetime DESC LIMIT 0,1) AS start_fly

  from trips as h,trips_fly_history as xx
  where xx.id_trips=h.id and (SELECT ysy.start_fly FROM trips_fly_history AS ysy WHERE ysy.id_trips=h.id ORDER BY ysy.datetime DESC LIMIT 0,1)>"'.date("Y-m-d").' 00:00:00" and h.visible=1 and  h.shopper=1 and h.id_shopper="'.htmlspecialchars(trim($row_8["id"])).'"');

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


//Узнаем улетает ли он куда нибудь по турам как участник
				$result_status22_fly_end=mysql_time_query($link,'Select 
  
  DISTINCT h.id,
  (SELECT yy.start_fly FROM trips_fly_history AS yy WHERE yy.id_trips=h.id ORDER BY yy.datetime DESC LIMIT 0,1) AS start_fly

  from trips as h,trips_fly_history as xx,trips_clients_fly as f
  where f.id_trips=h.id and xx.id_trips=h.id and (SELECT ysy.start_fly FROM trips_fly_history AS ysy WHERE ysy.id_trips=h.id ORDER BY ysy.datetime DESC LIMIT 0,1)>"'.date("Y-m-d").' 00:00:00" and h.visible=1 and ((h.shopper=2) OR((h.shopper=1)AND NOT(h.id_shopper="'.ht($row_8["id"]).'")))  and f.id_k_clients="'.htmlspecialchars(trim($row_8["id"])).'"');


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


			}
				  }	   
			   		
$temp.='</div>';			   				
				
$temp.='<div class="yes_dop_us">';


$result_uu = mysql_time_query($link, 'select count(a.id) as cc,(select count(aa.id) from trips as aa,trips_clients_fly as bb where bb.id_trips=aa.id and aa.visible=1 and bb.id_k_clients="'.ht($row_8["id"]) . '" and ((aa.shopper=2)or(aa.shopper=1 and not(aa.id_shopper="'.ht($row_8["id"]).'"))) ) as cc1 from trips as a where a.id_shopper="'.ht($row_8["id"]) . '" and a.visible=1 and a.shopper=1');
$num_results_uu = $result_uu->num_rows;

if ($num_results_uu != 0) {
	$row_uu = mysqli_fetch_assoc($result_uu);
}



			$result_status22=mysql_time_query($link,'SELECT count(a.id) as cc FROM booking AS a WHERE  ((a.status=3) or (a.status=6)) and a.id_client="'.htmlspecialchars(trim($row_8["id"])).'"');	
					 //echo('SELECT a.* FROM r_status AS a WHERE a.numer_status="'.$row1ss["status"].'" and a.id_system=13');
                if($result_status22->num_rows!=0)
                {  
                   $row_status22 = mysqli_fetch_assoc($result_status22);
					if((( $row_status22["cc"]!=0)and($row_status22["cc"]!=''))or(( $row_uu["cc"]!=0)and($row_uu["cc"]!=''))or(( $row_uu["cc1"]!=0)and($row_uu["cc1"]!='')))
					{
						$temp.='<div class="turs_cll yest_cl js-client-dop" tabs="2" data-tooltip="Туры" iod="'.$row_8["id"].'"><i></i></div>';
					} else
					{
						$temp.='<div class="turs_cll js-client-dop" tabs="2" iod="'.$row_8["id"].'" data-tooltip="Туры"><i></i></div>';
					}
				} 			   
	
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
			   
			   /* $phone_format='+7 ('.$row_8["phone"][0].$row_8["phone"][1].$row_8["phone"][2].') '.$row_8["phone"][3].$row_8["phone"][4].$row_8["phone"][5].'-'.$row_8["phone"][6].$row_8["phone"][7].'-'.$row_8["phone"][8].$row_8["phone"][9];
*/
$phone_format=phone_format($row_8["phone"]);



/*
if((($_COOKIE["su_1c".$id_user]!=2)and($_COOKIE["su_1c".$id_user]!=3)and($_COOKIE["su_1c".$id_user]!=4))or((isset($_COOKIE["su_7c".$id_user]))and($_COOKIE["su_7c".$id_user]!='')))
			{			   
$temp.='<div class="tell_o phone_clients_x phone_1_search"><span class="js-glu-t-'.$row_8["id"].'" data-tooltip="Телефон" >'.$phone_format.'</span>';
} else
{
$temp.='<div class="tell_o phone_clients_x"><span data-tooltip="Телефон" class="js-glu-t-'.$row_8["id"].'">'.$phone_format.'</span>';	
}
*/
if(((isset($_COOKIE["su_1c".$id_user]))and($_COOKIE["su_1c".$id_user]==2)and($_COOKIE["su_1c".$id_user]==3)and($_COOKIE["su_1c".$id_user]==4)and($_COOKIE["su_1c".$id_user]==5))or((!isset($_COOKIE["su_7c".$id_user])))or((isset($_COOKIE["su_7c".$id_user]))and($_COOKIE["su_7c".$id_user]=='')))
{
	$temp.='<div class="tell_o phone_clients_x"><span data-tooltip="Телефон" class="js-glu-t-'.$row_8["id"].'">'.$phone_format.'</span>';	
} else
{
$temp.='<div class="tell_o phone_clients_x phone_1_search"><span class="js-glu-t-'.$row_8["id"].'" data-tooltip="Телефон" >'.$phone_format.'</span>';	
}


	
	if (( isset($_COOKIE["su_2c".$id_user]))and(is_numeric($_COOKIE["su_2c".$id_user]))and(array_search($_COOKIE["su_2c".$id_user],$os_id2)!==false)and($_COOKIE["su_2c".$id_user]!=0))
	{			   
		 $razn_d=dateDiff_F(date("y-m-d").' '.date("H:i:s"),$row_8["date_birthday"]." 00:00:00");	
		
		$date_start1=explode("-",htmlspecialchars(trim($row_8["date_birthday"])));
				  
				   $startxr=$date_start1[2].'.'.$date_start1[1].'.'.$date_start1[0];		
		
		   $temp.='<div class="birth_cl"><span>'.$startxr.'</span>';	
	       $temp.=' (<span data-tooltip="Сколько исполнилось(ца)">'.$razn_d.' '.PadejNumber($razn_d,'год,года,лет').'</span>)</div>';
		
	}
			   
$temp.='</div>';
			   


//если сортировка по вылету отлету то выводим другие столбцы
	if ((( isset($_COOKIE["su_1c".$id_user]))and(is_numeric($_COOKIE["su_1c".$id_user]))and(array_search($_COOKIE["su_1c".$id_user],$os_id)!==false))and(($_COOKIE["su_1c".$id_user]==2)or($_COOKIE["su_1c".$id_user]==3)or($_COOKIE["su_1c".$id_user]==4)or($_COOKIE["su_1c".$id_user]==5))and(((isset($_COOKIE["su_7c".$id_user]))and($_COOKIE["su_7c".$id_user]==''))or(!isset($_COOKIE["su_7c".$id_user]))))
		{

			if(($_COOKIE["su_1c".$id_user]!=5))
			{

		//страна откуда куда вылетает
		$temp.='<div class="clients_city" data-tooltip="Откуда Вылет">'.$row_8["date_fly"].'</div>';
		
		//название заявки
		$temp.='<div class="clients_booking booking_name_client" data-tooltip="название заявки"><div class="center_vert"><a href="booking/'.$row_8["id_booking"].'/"><span>'.$row_8["title"].'</span></a></div></div>';
		
		//номер заявки в то
				$result_status22d=mysql_time_query($link,'SELECT a.name FROM booking_operator AS a WHERE  a.id="'.htmlspecialchars(trim($row_8["id_operator"])).'"');	
					 //echo('SELECT a.* FROM r_status AS a WHERE a.numer_status="'.$row1ss["status"].'" and a.id_system=13');
                if($result_status22d->num_rows!=0)
                {  
                   $row_status22d = mysqli_fetch_assoc($result_status22d);
				} 
		
		$temp.='<div class="clients_to" data-tooltip="Номер заявки в ТО"><div class="center_vert">'.$row_8["number_op"].' ';
		
		if($row_status22d["name"]!='')
		{
		$temp.='<i>('.$row_status22d["name"].')</i>';
		}
			
			
			$temp.='</div></div>';
		
		$class_start='';
		$class_end='';
		
		
		if($_COOKIE["su_1c".$id_user]!=4)
		{
		
		if($row_8["start_fly"]!='0000-00-00 00:00:00')
				  {
					   $date_start=explode(" ",htmlspecialchars(trim($row_8["start_fly"])));
				   $date_start1=explode("-",htmlspecialchars(trim($date_start[0])));
				  $date_start2=explode(":",htmlspecialchars(trim($date_start[1])));
				   $startx=$date_start1[2].'.'.$date_start1[1].'.'.$date_start1[0].' <strong>'.$date_start2[0].':'.$date_start2[1].'</strong>';		
			//echo(dateDiff_1(date("y-m-d").' '.date("H:i:s"),$row_8["start_fly"]));
			   if((dateDiff_1(date("y-m-d").' '.date("H:i:s"),$row_8["start_fly"])>=-3)and(dateDiff_1(date("y-m-d").' '.date("H:i:s"),$row_8["start_fly"])<=0))
			   {
				   $class_start='date_red';
			   }
			   if((dateDiff_1(date("y-m-d").' '.date("H:i:s"),$row_8["start_fly"])<-3)and(dateDiff_1(date("y-m-d").' '.date("H:i:s"),$row_8["start_fly"])>=-7))
			   {
				   $class_start='date_green';
			   }
			
				  } else
				  {
					  $startx='';
				  }
		
		
					  if($row_8["end_fly"]!='0000-00-00 00:00:00')
				  {	
	   $date_end=explode(" ",htmlspecialchars(trim($row_8["end_fly"])));
				   $date_end1=explode("-",htmlspecialchars(trim($date_end[0])));
				  $date_end2=explode(":",htmlspecialchars(trim($date_end[1])));
				   $endx=$date_end1[2].'.'.$date_end1[1].'.'.$date_end1[0].' <strong>'.$date_end2[0].':'.$date_end2[1].'</strong>';	
					  
			   if((dateDiff_1(date("y-m-d").' '.date("H:i:s"),$row_8["end_fly"])>=-3)and(dateDiff_1(date("y-m-d").' '.date("H:i:s"),$row_8["end_fly"])<=0))
			   {
				   $class_end='date_red';
			   }
			   if((dateDiff_1(date("y-m-d").' '.date("H:i:s"),$row_8["end_fly"])<-3)and(dateDiff_1(date("y-m-d").' '.date("H:i:s"),$row_8["end_fly"])>=-7))
			   {
				   $class_end='date_green';
			   }					  
					  
					  
					  } else
					  {
						$endx='';  
					  }
				
		//вылетает	
		
		
		
	$d_day=dateDiff_1(date("y-m-d").' '.date("H:i:s"),$row_8["start_fly"]);				  
//echo($d_day);			
$echo_j='';		

if(($d_day>-6)and($d_day<0))
{	
	if($d_day==-1)
	{
		$echo_j='<div class="help-jj">(Завтра)</div>';	
	} else
	{	
	    $echo_j='<div class="help-jj">(Через '.abs($d_day).' '.PadejNumber(abs($d_day),'день,дня,дней').')</div>';
	}
}
if(($d_day==0))
{	
	$echo_j='<div class="help-jj">(Сегодня)</div>';	
}

		
		
		
		$temp.='<div id_fly="'.$row_8["id_offers"].'" class="clients_fly_date '.$class_start.'" data-tooltip="Вылетает на отдых"><div class="center_vert"><div class="c_start"><i></i><span>'.$startx.'</span>'.$echo_j.'</div></div></div>';
		
	}

		
		
		//прилетает
		
$d_day='';
	$d_day=dateDiff_1(date("y-m-d").' '.date("H:i:s"),$row_8["end_fly"]);				  
//echo($d_day);		
		//echo($row_8["end_fly"]);
$echo_j='';		

if(($d_day>-6)and($d_day<0))
{	
	if($d_day==-1)
	{
		$echo_j='<div class="help-jj">(Завтра)</div>';	
	} else
	{	
	    $echo_j='<div class="help-jj">(Через '.abs($d_day).' '.PadejNumber(abs($d_day),'день,дня,дней').')</div>';
	}
}
if(($d_day==0))
{	
	$echo_j='<div class="help-jj">(Сегодня)</div>';	
}
		$row_8["status"] ??= '';
if((($d_day>0))and($row_8["status"]!=2))
{	
	$echo_j='<div class="help-jj">(На отдыхе)</div>';	
}				  
	
		
	if($_COOKIE["su_1c".$id_user]==4)
	{	
				  if($row_8["end_fly"]!='0000-00-00 00:00:00')
				  {	
	   $date_end=explode(" ",htmlspecialchars(trim($row_8["end_fly"])));
				   $date_end1=explode("-",htmlspecialchars(trim($date_end[0])));
				  $date_end2=explode(":",htmlspecialchars(trim($date_end[1])));
				   $endx=$date_end1[2].'.'.$date_end1[1].'.'.$date_end1[0].' <strong>'.$date_end2[0].':'.$date_end2[1].'</strong>';	
					  
			   if((dateDiff_1(date("y-m-d").' '.date("H:i:s"),$row_8["end_fly"])<=3)and(dateDiff_1(date("y-m-d").' '.date("H:i:s"),$row_8["end_fly"])>=0)and($row_8["comment_client"]==''))
			   {
				   $class_end='date_green';
			   }
			   if((dateDiff_1(date("y-m-d").' '.date("H:i:s"),$row_8["end_fly"])>3)and($row_8["comment_client"]==''))
			   {
				   $class_end='date_red';
			   }					  
					  
					  
					  } else
					  {
						$endx='';  
					  }
	
		//прилетает
		
$d_day='';
	$d_day=dateDiff_1(date("y-m-d").' '.date("H:i:s"),$row_8["end_fly"]);				  
//echo($d_day);		
		//echo($row_8["end_fly"]);
$echo_j='';		

if(($d_day>-6)and($d_day<0))
{	
	if($d_day==-1)
	{
	} else
	{	
	    $echo_j='<div class="help-jj">('.abs($d_day).' '.PadejNumber(abs($d_day),'день назад,дня назад,дней назад').')</div>';
	}
}
if(($d_day==0))
{	
	$echo_j='<div class="help-jj">(Сегодня)</div>';	
}				  
			if(($row_8["comment_client"]==''))
		{	
		$temp.='<div id_offers="'.$row_8["id_offers"].'" class="clients_comment grey_coi"><div class="center_vert" style="width: 100%;">';
			} else
			{
			$temp.='<div id_offers="'.$row_8["id_offers"].'" class="clients_comment" ><div class="center_vert" style="width: 100%;">';			
			}
		if(($row_8["comment_client"]==''))
		{
					if((($row_8["stt1"]==3)or($row_8["stt1"]==6))and($row_8["stt"]==2))		
        {		
			if(($row_8["uss"]==$id_user)or($sign_admin==1))
			{ 
			$temp.='<div class="add_cff">добавить впечатление</div>';
			}
					}
			
		}
		
		$temp.='</div></div>';
		
		
			$temp.='<div id_fly="'.$row_8["id_offers"].'" class="clients_fly_date '.$class_end.'" data-tooltip="Прилетел с отдыха"><div class="center_vert"><div class="c_end"><i></i><span>'.$endx.'</span>'.$echo_j.'</div></div></div>';	
		
	} else{		
		
		
		$temp.='<div id_fly="'.$row_8["id_offers"].'" class="clients_fly_date '.$class_end.'" data-tooltip="Прилетает с отдыха"><div class="center_vert"><div class="c_end"><i></i><span>'.$endx.'</span>'.$echo_j.'</div></div></div>';
	}

		} else
	{
		//выводов по турам

		$result_uu = mysql_time_query($link, 'select b.id,(SELECT yy.start_fly FROM trips_fly_history AS yy WHERE yy.id_trips=b.id ORDER BY yy.datetime DESC LIMIT 0,1) AS start_fly,
  (SELECT yy.end_fly FROM trips_fly_history AS yy WHERE yy.id_trips=b.id ORDER BY yy.datetime DESC LIMIT 0,1) AS end_fly,
b.shopper,
b.id_shopper,
b.id_operator,
b.id_contract,
b.number_to,
b.hotel,
b.id_country,
b.place_name from trips as b where id="' . ht($row_8['id_trips']) . '"');
		$num_results_uu = $result_uu->num_rows;

		if ($num_results_uu != 0) {
			$row_uu = mysqli_fetch_assoc($result_uu);
		}

		$result_uu1 = mysql_time_query($link, 'select name,date_doc from trips_contract where id="' . ht($row_uu["id_contract"]) . '"');
		$num_results_uu1 = $result_uu1->num_rows;

		if ($num_results_uu1 != 0) {
			$row_uu1 = mysqli_fetch_assoc($result_uu1);
			$date_doc_=explode("-",$row_uu1["name"]);
			$date_r1=explode("/",htmlspecialchars(trimc($date_doc_[0])));

			$date_ddd=$date_r1[0].'.'.$date_r1[1].'.'.$date_r1[2];

		}




		//страна откуда куда вылетает
		$temp.='<div class="clients_city" data-tooltip="Договор">'.$row_uu1["name"].' от '.date_ex(0,$row_uu1["date_doc"]).'</div>';


		$kuda_trips='';


		$result_uu2 = mysql_time_query($link, 'select name from trips_country where id="' . ht($row_uu["id_country"]) . '"');
		$num_results_uu2 = $result_uu2->num_rows;

		if ($num_results_uu2 != 0) {
			$row_uu2 = mysqli_fetch_assoc($result_uu2);
			$kuda_trips.=$row_uu2["name"];
		}


		if($row_uu['place_name']!='')
		{
			$kuda_trips.=', '.$row_uu['place_name'];
		}
		if($row_uu['hotel']!='')
		{
			$kuda_trips.=' / '.$row_uu['hotel'];
		}

		//название заявки
		$temp.='<div class="clients_booking booking_name_client" data-tooltip="тур"><div class="center_vert"><a href="tours/.id-'.$row_uu["id"].'"><span>'.$kuda_trips.'</span></a></div></div>';

		//номер заявки в то
		$result_status22d=mysql_time_query($link,'SELECT a.name FROM booking_operator AS a WHERE  a.id="'.htmlspecialchars(trim($row_uu["id_operator"])).'"');
		//echo('SELECT a.* FROM r_status AS a WHERE a.numer_status="'.$row1ss["status"].'" and a.id_system=13');
		if($result_status22d->num_rows!=0)
		{
			$row_status22d = mysqli_fetch_assoc($result_status22d);
		}

		$temp.='<div class="clients_to" data-tooltip="Номер заявки в ТО"><div class="center_vert">'.$row_uu["number_to"].' ';

		if($row_status22d["name"]!='')
		{
			$temp.='<i>('.$row_status22d["name"].')</i>';
		}


		$temp.='</div></div>';

		$class_start='';
		$class_end='';



			if($row_uu["start_fly"]!='0000-00-00 00:00:00')
			{
				$date_start=explode(" ",htmlspecialchars(trim($row_uu["start_fly"])));
				$date_start1=explode("-",htmlspecialchars(trim($date_start[0])));
				$date_start2=explode(":",htmlspecialchars(trim($date_start[1])));
				$startx=$date_start1[2].'.'.$date_start1[1].'.'.$date_start1[0].' <strong>'.$date_start2[0].':'.$date_start2[1].'</strong>';
				//echo(dateDiff_1(date("y-m-d").' '.date("H:i:s"),$row_8["start_fly"]));
				if((dateDiff_1(date("y-m-d").' '.date("H:i:s"),$row_uu["start_fly"])>=-3)and(dateDiff_1(date("y-m-d").' '.date("H:i:s"),$row_uu["start_fly"])<=0))
				{
					$class_start='date_red';
				}
				if((dateDiff_1(date("y-m-d").' '.date("H:i:s"),$row_uu["start_fly"])<-3)and(dateDiff_1(date("y-m-d").' '.date("H:i:s"),$row_uu["start_fly"])>=-7))
				{
					$class_start='date_green';
				}

			} else
			{
				$startx='';
			}


			if($row_uu["end_fly"]!='0000-00-00 00:00:00')
			{
				$date_end=explode(" ",htmlspecialchars(trim($row_uu["end_fly"])));
				$date_end1=explode("-",htmlspecialchars(trim($date_end[0])));
				$date_end2=explode(":",htmlspecialchars(trim($date_end[1])));
				$endx=$date_end1[2].'.'.$date_end1[1].'.'.$date_end1[0].' <strong>'.$date_end2[0].':'.$date_end2[1].'</strong>';

				if((dateDiff_1(date("y-m-d").' '.date("H:i:s"),$row_uu["end_fly"])>=-3)and(dateDiff_1(date("y-m-d").' '.date("H:i:s"),$row_uu["end_fly"])<=0))
				{
					$class_end='date_red';
				}
				if((dateDiff_1(date("y-m-d").' '.date("H:i:s"),$row_uu["end_fly"])<-3)and(dateDiff_1(date("y-m-d").' '.date("H:i:s"),$row_uu["end_fly"])>=-7))
				{
					$class_end='date_green';
				}


			} else
			{
				$endx='';
			}

			//вылетает



			$d_day=dateDiff_1(date("y-m-d").' '.date("H:i:s"),$row_uu["start_fly"]);
//echo($d_day);
			$echo_j='';

			if(($d_day>-6)and($d_day<0))
			{
				if($d_day==-1)
				{
					$echo_j='<div class="help-jj">(Завтра)</div>';
				} else
				{
					$echo_j='<div class="help-jj">(Через '.abs($d_day).' '.PadejNumber(abs($d_day),'день,дня,дней').')</div>';
				}
			}
			if(($d_day==0))
			{
				$echo_j='<div class="help-jj">(Сегодня)</div>';
			}




			$temp.='<div class="clients_fly_date '.$class_start.'" data-tooltip="Вылетает на отдых"><div class="center_vert"><div class="c_start"><i></i><span>'.$startx.'</span>'.$echo_j.'</div></div></div>';





		//прилетает

		$d_day='';
		$d_day=dateDiff_1(date("y-m-d").' '.date("H:i:s"),$row_uu["end_fly"]);
//echo($d_day);
				//echo($row_8["end_fly"]);
				$echo_j='';

				if(($d_day>-6)and($d_day<0))
				{
					if($d_day==-1)
					{
						$echo_j='<div class="help-jj">(Завтра)</div>';
					} else
					{
						$echo_j='<div class="help-jj">(Через '.abs($d_day).' '.PadejNumber(abs($d_day),'день,дня,дней').')</div>';
					}
				}
				if(($d_day==0))
				{
					$echo_j='<div class="help-jj">(Сегодня)</div>';
				}
				$row_uu["status"] ??= '';
				if((($d_day>0)))
				{
					$echo_j='<div class="help-jj">(На отдыхе)</div>';
				}


				if($_COOKIE["su_1c".$id_user]==4)
				{
					if($row_8["end_fly"]!='0000-00-00 00:00:00')
					{
						$date_end=explode(" ",htmlspecialchars(trim($row_8["end_fly"])));
						$date_end1=explode("-",htmlspecialchars(trim($date_end[0])));
						$date_end2=explode(":",htmlspecialchars(trim($date_end[1])));
						$endx=$date_end1[2].'.'.$date_end1[1].'.'.$date_end1[0].' <strong>'.$date_end2[0].':'.$date_end2[1].'</strong>';

						if((dateDiff_1(date("y-m-d").' '.date("H:i:s"),$row_8["end_fly"])<=3)and(dateDiff_1(date("y-m-d").' '.date("H:i:s"),$row_8["end_fly"])>=0)and($row_8["comment_client"]==''))
						{
							$class_end='date_green';
						}
						if((dateDiff_1(date("y-m-d").' '.date("H:i:s"),$row_8["end_fly"])>3)and($row_8["comment_client"]==''))
						{
							$class_end='date_red';
						}


					} else
					{
						$endx='';
					}

					//прилетает

					$d_day='';
					$d_day=dateDiff_1(date("y-m-d").' '.date("H:i:s"),$row_8["end_fly"]);
//echo($d_day);
					//echo($row_8["end_fly"]);
					$echo_j='';

					if(($d_day>-6)and($d_day<0))
					{
						if($d_day==-1)
						{
						} else
						{
							$echo_j='<div class="help-jj">('.abs($d_day).' '.PadejNumber(abs($d_day),'день назад,дня назад,дней назад').')</div>';
						}
					}
					if(($d_day==0))
					{
						$echo_j='<div class="help-jj">(Сегодня)</div>';
					}
					if(($row_8["comment_client"]==''))
					{
						$temp.='<div id_offers="'.$row_8["id_offers"].'" class="clients_comment grey_coi"><div class="center_vert" style="width: 100%;">';
					} else
					{
						$temp.='<div id_offers="'.$row_8["id_offers"].'" class="clients_comment" ><div class="center_vert" style="width: 100%;">';
					}
					if(($row_8["comment_client"]==''))
					{
						if((($row_8["stt1"]==3)or($row_8["stt1"]==6))and($row_8["stt"]==2))
						{
							if(($row_8["uss"]==$id_user)or($sign_admin==1))
							{
								$temp.='<div class="add_cff">добавить впечатление</div>';
							}
						}

					}

					$temp.='</div></div>';


					$temp.='<div id_fly="'.$row_8["id_offers"].'" class="clients_fly_date '.$class_end.'" data-tooltip="Прилетел с отдыха"><div class="center_vert"><div class="c_end"><i></i><span>'.$endx.'</span>'.$echo_j.'</div></div></div>';

				} else{


					$temp.='<div  class="clients_fly_date '.$class_end.'" data-tooltip="Прилетает с отдыха"><div class="center_vert"><div class="c_end"><i></i><span>'.$endx.'</span>'.$echo_j.'</div></div></div>';
				}
		}


	    }
			   
		/*	   
		if ((( isset($_COOKIE["su_1c"]))and(is_numeric($_COOKIE["su_1c"]))and(array_search($_COOKIE["su_1c"],$os_id)!==false))and($_COOKIE["su_1c"]!=2))
		{			*/
$temp.='<div class="comment_o rois comment_clients">'.$row_8["comment"].'</div>';
	//	}

						 
$temp.='</div>';						 

			   
		   
?>
								  
						 
					 
			   
			   
		   