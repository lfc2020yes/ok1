<?
//вывод блока заявки на главной,в статистике, в клиенте
$query_string_xx='';
$cll='';
//забронировано						 
if(($row_8["status"]==3)or($row_8["status"]==6))
{
  $cll='da_book';
}		
//забронировали но нужен загрузить товарный чек						 
$redd__='';
if(($row_8["status"]==3)or($row_8["status"]==6))
{
	

						 
						 
		$result_scorex1=mysql_time_query($link,'SELECT COUNT(DISTINCT b.id) AS vv FROM booking_attach AS b WHERE b.visible=1 and b.id_booking="'.htmlspecialchars(trim($row_8["id"])).'"');
	    $num_results_scorex1 = $result_scorex1->num_rows;
			   
        if($num_results_scorex1!=0)
        {
			$row_scorex1 = mysqli_fetch_assoc($result_scorex1);
			if($row_scorex1["vv"]==0)
			{
				 $redd__='red_attach';
			}
        }
						 
}
						 

						 
					  $query_string_xx.='<div rel_notib="'.$row_8["id"].'" class="booking_div '.$cll.' '.$redd__.'">';

$result_9 = mysql_time_query($link,'select A.id from task as A WHERE A.status="0" and  A.id_user="'.htmlspecialchars(trim($id_user)).'" and A.id_booking="'.htmlspecialchars(trim($row_8["id"])).'" and A.date<="'.date("Y-m-d").'"');
$num_9 = $result_9->num_rows;	
$style_not='';
				  
if($num_9!=0)
{
	$style_not='yes_bbs';
}
				  
$query_string_xx.='<div class="not_booling '.$style_not.'"></div>';
	

$query_string_xx.='<div class="h4"><a href="booking/'.$row_8["id"].'/"><span>'.$row_8["title"].'</span></a><div class="number_zayy">('.$row_8["id"].')</div>';
/*
if($sign_admin==1)
{
	*/
$result_txs=mysql_time_query($link,'Select a.id,a.name_user,a.timelast from r_user as a where a.id="'.htmlspecialchars(trim($row_8["id_user"])).'"');
      
	    if($result_txs->num_rows!=0)
	    {   
		//такая работа есть
		$rowxs = mysqli_fetch_assoc($result_txs);
		$online='';	
			/*
		if(online_user($rowxs["timelast"],$rowxs["id"],$id_user)) { $online='<div class="online"></div>';}		
		echo'<div class="yop_count1"><div  sm="'.$row__2["sign_user"].'"   data-tooltip="'.$rowxs["name_user"].'" class="user_soz send_mess">'.$online.avatar_img('<img src="img/users/',$row__2["sign_user"],'_100x100.jpg">').'</div></div>';
		*/
			$query_string_xx.='<div class="ktoo">'.$rowxs["name_user"].'</div>';	
	    }			
	
	

if($sign_admin==1)
{
$query_string_xx.='<div class="font-ranks del_booking_" data-tooltip="Удалить" id_rel="'.$row_8["id"].'"><span class="font-ranks-inner">_</span></div>';
}

$query_string_xx.='</div>';
$query_string_xx.='<div class="hide_book"></div>';
$result_91 = mysql_time_query($link,'select count(A.id) as cc from booking_offers as A WHERE A.id_booking="'.htmlspecialchars(trim($row_8["id"])).'" and  A.visible=1');
$num_91 = $result_91->num_rows;	
		$count_offers='-';
if($num_91!=0)
{				  
	$row_91 = mysqli_fetch_assoc($result_91);	
	$count_offers=$row_91["cc"];
} 

//смотрим нужно ли ему показывать комиссию или нет.			   
//показывать если он админ или это его заявка
$pok_com=0;
if($row_8["id_user"]==$id_user)
{
	$pok_com=1;
}

			   
if((($sign_admin==1)or($pok_com==1))and($row_8["status"]==3))
{
	
$result_status21=mysql_time_query($link,'SELECT sum(a.commission) as com, sum(a.cost) as cost FROM booking_offers AS a WHERE a.id_booking="'.htmlspecialchars(trim($row_8["id"])).'" and a.status=2');	
					 //echo('SELECT a.* FROM r_status AS a WHERE a.numer_status="'.$row1ss["status"].'" and a.id_system=13');
                if($result_status21->num_rows!=0)
                {  
                   $row_status21 = mysqli_fetch_assoc($result_status21);
				} 	
	$proc_realiz=round(($row_status21["com"]*100)/$row_status21["cost"],1); 
	
	
					$com=$com+$row_status21["com"];
			    $cost=$cost+$proc_realiz;
	$count_y++;

			 				 		$pl__='';

		   if($row_status21["com"]>0)
		   {
			   $pl__='+ ';
		
		   }
	
$query_string_xx.='<div class="yop_commi" data-tooltip="Итоговая Комиссия"><div><span>'.$pl__.rtrim(rtrim(number_format($row_status21["com"], 2, '.', ' '),'0'),'.').' руб.</span><i>'.$proc_realiz.'%</i></div></div>';
}
			   
if((($sign_admin==1)or($pok_com==1))and($row_8["status"]==6))
{
	
$result_status21=mysql_time_query($link,'SELECT sum(a.commission) as com, sum(a.cost) as cost FROM booking_offers AS a WHERE a.id_booking="'.htmlspecialchars(trim($row_8["id"])).'" and a.status=2');	
					 //echo('SELECT a.* FROM r_status AS a WHERE a.numer_status="'.$row1ss["status"].'" and a.id_system=13');
                if($result_status21->num_rows!=0)
                {  
                   $row_status21 = mysqli_fetch_assoc($result_status21);
				} 	
	$proc_realiz=round(($row_status21["com"]*100)/$row_status21["cost"],1); 
	
	
					$com=$com+$row_status21["com"];
			    $cost=$cost+$proc_realiz;
	$count_y++;

			 				 		$pl__='';

		   if($row_status21["com"]>0)
		   {
			   $pl__='+ ';
		
		   }
	
$query_string_xx.='<div class="yop_commi" data-tooltip="Промежуточная Комиссия"><div><span>'.$pl__.rtrim(rtrim(number_format($row_status21["com"], 2, '.', ' '),'0'),'.').' руб.</span><i>'.$proc_realiz.'%</i></div></div>';
}			   
			   
						 
$query_string_xx.='<div class="yop_count" data-tooltip="Кол-во предложений"><i></i>'.$count_offers.' <span>'.PadejNumber($count_offers,'предложение,предложения,предложений').'</span></div>';



if(isset($_COOKIE["su_1"])==1)
{						 
$query_string_xx.='<div class="yop_count1" data-tooltip="Изменился статус"><i></i>'.time_stamp($row_8["date_create"]).'</div>';	
} else
{
$query_string_xx.='<div class="yop_count1" data-tooltip="Заявка поступила"><i></i>'.time_stamp($row_8["date_create"]).'</div>';
}
$query_string_xx.='<div class="right_booking">';
						 
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

if(($row_8["id_client"]!=0)and($large_booking==0))
{
$result_txs=mysql_time_query($link,'Select a.fio,a.code,a.phone from k_clients as a where a.id="'.htmlspecialchars(trim($row_8["id_client"])).'"');
      
	    if($result_txs->num_rows!=0)
	    {   
		//такая работа есть
		$rowxs = mysqli_fetch_assoc($result_txs);
		$query_string_xx.='<div class="clients_h_new"><div class="center_vert1"><a 
		
		class="js-client" iod="'.$row_8["id_client"].'"
		><span>'.$rowxs["fio"].'</span></a><div class="code_clients">[code - '.$rowxs["code"].']</div></div></div>';
		$phone_format='+7 ('.$rowxs["phone"][0].$rowxs["phone"][1].$rowxs["phone"][2].') '.$rowxs["phone"][3].$rowxs["phone"][4].$rowxs["phone"][5].'-'.$rowxs["phone"][6].$rowxs["phone"][7].'-'.$rowxs["phone"][8].$rowxs["phone"][9];	
			   	
		$query_string_xx.='<div class="phone_h_new"><div class="center_vert1"><span data-tooltip="Телефон">'.$phone_format.'</span></div></div>';
			
		//если продана или частично выводим номер договора или просто пусто
		$number_doc='';
			
			
				$result_status22=mysql_time_query($link,'SELECT b.name FROM booking_offers AS a,booking_contract as b WHERE  (a.status=2) and a.id_booking="'.htmlspecialchars(trim($row_8["id"])).'" and a.id_contract=b.id');	
					 //echo('SELECT a.* FROM r_status AS a WHERE a.numer_status="'.$row1ss["status"].'" and a.id_system=13');
                if($result_status22->num_rows!=0)
                {  
                   $row_status22 = mysqli_fetch_assoc($result_status22);
					$number_doc=$row_status22["name"];
				} 	
			
		$query_string_xx.='<div class="doc_h_new"><div class="center_vert1"><span>'.$number_doc.'</span></div></div>';	
			
		}
}

$query_string_xx.='</div>';


if (!isset($echo_xx))
{
	echo($query_string_xx);
}
								  
?>						 
					 