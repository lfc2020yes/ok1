<?
//вывод задачи и уведомлений в разделе задачи
$task_cloud_block='';
$new_sayx='';
$no_click_vis ??= '';
if((isset($new_sa))and($new_sa==1))
{
	$new_sayx='new-say';
} 
	/*
	10 -100
	n  - x
	*/
	$const_day=10; //считаем что 10 дней это 100 процентов просрочка
	$PROC=0;
	$zad=dateDiff_1(date("y-m-d").' '.date("H:i:s"),$row_8["ring_datetime"]);
	$pros=0;
	if(($zad>0)and($row_8["status"]==0))
			   {
		$PROC=round($zad*100/$const_day);
		if($PROC>100)
		{
			$PROC=100;
		}
		$pros=1;
	}

	
	
	  $rrdx=explode(' ',$row_8["ring_datetime"]);	
	  $rrd1x=explode(':',$rrdx[1]);
	
	
	$comment_b='';
	$svyz='—';
$time_z='—';
//$task_cloud_block.=$row_8["action"];
	if($row_8["reminder"]==0)
	{
			//задача
					  $id_user_ring='';
				  $name_user_ring='';
				  $shopper=0;  //частное лицо
			  switch($row_8["action"])
              {
					  /*
				case "5":{
			//улетают в отпуск
			$comment_b='Уточнить время вылета туристов';
					
			$result_ss = mysql_time_query($link,'SELECT A.title,A.id_client,B.fio,A.id FROM booking as A,k_clients as B WHERE A.id_client=B.id and A.id="'.ht($row_8["id_object"]).'" and A.visible=1');
        $num_ss = $result_ss->num_rows;	
        if($result_ss)
        {	
           $row_ss = mysqli_fetch_assoc($result_ss);
		   $id_user_ring=$row_ss["id_client"];
		   $name_user_ring=$row_ss["fio"];
		}	 
			 
			 
			 break;
		 }	
		 */
			case "6":{
			//прилетают с отпуска
			$comment_b='Узнать впечатление туриста';
			$result_ss = mysql_time_query($link,'SELECT A.title,A.id_client,B.fio,A.id FROM booking as A,k_clients as B WHERE A.id_client=B.id and A.id="'.ht($row_8["id_object"]).'" and A.visible=1');
        $num_ss = $result_ss->num_rows;	
        if($result_ss)
        {	
           $row_ss = mysqli_fetch_assoc($result_ss);
		   $id_user_ring=$row_ss["id_client"];
		   $name_user_ring=$row_ss["fio"];
		}	 
			 
			 
			 break;
		 }					  
						  
			case "7":{ 
   //день рождение
			$comment_b='Поздравить с днем рождением';
			 			 $result_ss = mysql_time_query($link,'SELECT A.fio,A.id FROM k_clients as A WHERE A.id="'.ht($row_8["id_object"]).'" and A.visible=1');
        $num_ss = $result_ss->num_rows;	
        if($result_ss)
        {	
           $row_ss = mysqli_fetch_assoc($result_ss);	
		   $id_user_ring=$row_ss["id"];
		   $name_user_ring=$row_ss["fio"];
		}
				
			 break;
		 }
                  case "21":{
                      //заканчивается срок действия паспорта
                      $comment_b=$row_8["comment"];
                      $result_ss = mysql_time_query($link,'SELECT A.fio,A.id FROM k_clients as A WHERE A.id="'.ht($row_8["id_object"]).'" and A.visible=1');
                      $num_ss = $result_ss->num_rows;
                      if($result_ss)
                      {
                          $row_ss = mysqli_fetch_assoc($result_ss);
                          $id_user_ring=$row_ss["id"];
                          $name_user_ring=$row_ss["fio"];
                      }

                      break;
                  }



                  case "19":
                  case "17":
                  case "18":
                  {
                      //улетают в отпуск новые туры
                      if($row_8["action"]==17)
                      {
                          $comment_b = 'Узнать впечатление по туру';
                      }
                      if($row_8["action"]==18)
                      {
                          $comment_b = 'Внести оплату туроператору';
                      }
                      if($row_8["action"]==19)
                      {
                          $comment_b = 'Взять оплату с клиента по туру';
                      }

                      $result_uuy = mysql_time_query($link, 'select A.id,A.shopper,A.id_shopper,A.hotel,A.id_country,A.place_name,A.date_start,A.date_end,A.number_to from trips as A where A.id="'.ht($row_8["id_object"]).'"');
                      $num_results_uuy = $result_uuy->num_rows;

                      if ($num_results_uuy != 0) {
                          $row_uuy = mysqli_fetch_assoc($result_uuy);
                          $id_user_ring=$row_uuy["id_shopper"];


                          if($row_uuy["shopper"]==1) {
                              //частное лицо
                              $result_uus = mysql_time_query($link, 'select fio from k_clients where id="'.ht($row_uuy["id_shopper"]) . '"');
                          } else
                          {
                              //2 фирма
                              $result_uus = mysql_time_query($link, 'select name as fio from k_organization where id="'.ht($row_uuy["id_shopper"]) . '"');
                              $shopper = 1;  //фирма
                          }
                          $num_results_uus = $result_uus->num_rows;

                          if($num_results_uus!=0) {
                              $row_uus = mysqli_fetch_assoc($result_uus);
                              $name_user_ring=$row_uus["fio"];
                          }

                          $name_book=info_trips($row_8["id_object"],$link);


                      }

                      $time_z=$rrd1x[0].':'.$rrd1x[1];

                      break;
                  }
				  
						  
		 case "9":{ 
			 //задача из подборок клиента
					$comment_b=$row_8["comment"];
			 $result_ss = mysql_time_query($link,'SELECT A.fio,A.id FROM k_clients as A,selection as B WHERE B.id="'.ht($row_8["id_object"]).'" and B.visible=1 and B.id_k_clients=A.id');
        $num_ss = $result_ss->num_rows;	
        if($result_ss)
        {	
           $row_ss = mysqli_fetch_assoc($result_ss);	
		   $id_user_ring=$row_ss["id"];
		   $name_user_ring=$row_ss["fio"];
		}
			 
			 $time_z=$rrd1x[0].':'.$rrd1x[1];
			 break; 
                  }
		 case "10":{ 
			 //задача из общения с клиентом
				$comment_b=$row_8["comment"];	
			 $result_ss = mysql_time_query($link,'SELECT A.fio,A.id FROM k_clients as A,k_clients_commun as B WHERE B.id="'.ht($row_8["id_object"]).'" and B.visible=1 and B.id_client=A.id');
        $num_ss = $result_ss->num_rows;	
        if($result_ss)
        {	
           $row_ss = mysqli_fetch_assoc($result_ss);	
		   $id_user_ring=$row_ss["id"];
		   $name_user_ring=$row_ss["fio"];
		}
			  $time_z=$rrd1x[0].':'.$rrd1x[1];
			 break; 
                  }	
		 case "11":{ 
			 //задача связанная просто с клиентом
					$comment_b=$row_8["comment"];
			 $result_ss = mysql_time_query($link,'SELECT A.fio,A.id FROM k_clients as A WHERE A.id="'.ht($row_8["id_object"]).'"');
        $num_ss = $result_ss->num_rows;	
        if($result_ss)
        {	
           $row_ss = mysqli_fetch_assoc($result_ss);	
		   $id_user_ring=$row_ss["id"];
		   $name_user_ring=$row_ss["fio"];
		}
			 
			  $time_z=$rrd1x[0].':'.$rrd1x[1];
			 break; 
                  }	
		 case "12":{ 
			 //задача связанная просто с клиентом
				$comment_b=$row_8["comment"];	
			 $result_ss = mysql_time_query($link,'SELECT A.fio,A.id FROM k_clients as A WHERE A.id="'.ht($row_8["id_object"]).'"');
        $num_ss = $result_ss->num_rows;	
        if($result_ss)
        {	
           $row_ss = mysqli_fetch_assoc($result_ss);	
		   $id_user_ring=$row_ss["id"];
		   $name_user_ring=$row_ss["fio"];
		}
			  $time_z=$rrd1x[0].':'.$rrd1x[1];
			 break; 
                  }						  
		 case "13":{ 
			 //задача связанная просто с организацией
				$comment_b=$row_8["comment"];	
			 $result_ss = mysql_time_query($link,'SELECT A.name,A.id FROM k_organization as A WHERE A.id="'.ht($row_8["id_object"]).'"');
			//echo('SELECT A.name,A.id FROM k_organization as A WHERE A.id="'.ht($row_8["id_object"]).'"');
        $num_ss = $result_ss->num_rows;	
        if($result_ss)
        {	
           $row_ss = mysqli_fetch_assoc($result_ss);	
		   $id_user_ring=$row_ss["id"] ?? 0;
		   $name_user_ring=$row_ss["name"] ?? '';
		}
			  $time_z=$rrd1x[0].':'.$rrd1x[1];
			 break; 
                  }	
		 case "14":{ 
			 //задача без связей
				$comment_b=$row_8["comment"];	
			 
			  $time_z=$rrd1x[0].':'.$rrd1x[1];
			 break; 
                  }
         case "20":{
                      //задача связанная с обращением
                      $comment_b=$row_8["comment"];


                      $time_z=$rrd1x[0].':'.$rrd1x[1];
                      break;
                  }
              }
		
		
		
						  if($row_8["action"]=='13')
				  {
					 $svyz='<span class="js-org'.$no_click_vis.' ring-user js-glo-n-'.$id_user_ring.'"  iod="'.$id_user_ring.'">'.$name_user_ring.'</span>';				  
				  } else
				  {
					 if($row_8["action"]!='14')
					 {
					  $svyz='<span class="js-client'.$no_click_vis.' ring-user js-glu-f-'.$id_user_ring.'"  iod="'.$id_user_ring.'">'.$name_user_ring.'</span>';
					 }
				  }
					  
					  
	if($row_8["action"]==6)
	{
		$svyz='<span class="js-client'.$no_click_vis.' ring-user js-glu-f-'.$id_user_ring.'"  iod="'.$id_user_ring.'">'.$name_user_ring.'</span><div><a class="ari" href="booking/'.$row_ss["id"].'/">'.$row_ss["title"].'</a></div>';
	}

        if(($row_8["action"]==17)or($row_8["action"]==18)or($row_8["action"]==19))
        {
            $svyz='';

            $svyz.='<div style="margin-top: 5px;"><a class="ari" href="tours/.id-'.$row_8["id_object"].'">Обращение №'.$row_8["id_object"].'</a></div>';



        }
        //echo($row_8["action"]);
        if(($row_8["action"]==20))
        {
            $svyz='';

            $svyz.='<div style="margin-top: 5px;"><a class="ari" href="preorders/.id-'.$row_8["id_object"].'">Обращение №'.$row_8["id_object"].'</a></div>';



        }


		
			} else
		{
			//напоминалка
            $shopper=0;



			  switch($row_8["action"])
              {
				case "5":{
			//улетают в отпуск
			$comment_b='Уточнить время вылета туристов';
			$result_ss = mysql_time_query($link,'SELECT A.title,A.id_client,B.fio,A.id FROM booking as A,k_clients as B WHERE A.id_client=B.id and A.id="'.ht($row_8["id_object"]).'" and A.visible=1');
        $num_ss = $result_ss->num_rows;	
        if($result_ss)
        {	
           $row_ss = mysqli_fetch_assoc($result_ss);
		   $id_user_ring=$row_ss["id_client"];
		   $name_user_ring=$row_ss["fio"];
		   $name_book=$row_ss["title"];	
		}
			
			 $time_z=$rrd1x[0].':'.$rrd1x[1];		
			 
			 
			 break;
		 }						  
			case "6":{
			//прилетают с отпуска
			$comment_b='Уточнить время вылета туристов с отпуска';
			$result_ss = mysql_time_query($link,'SELECT A.title,A.id_client,B.fio,A.id FROM booking as A,k_clients as B WHERE A.id_client=B.id and A.id="'.ht($row_8["id_object"]).'" and A.visible=1');
        $num_ss = $result_ss->num_rows;	
        if($result_ss)
        {	
           $row_ss = mysqli_fetch_assoc($result_ss);
		   $id_user_ring=$row_ss["id_client"];
		   $name_user_ring=$row_ss["fio"];
		   $name_book=$row_ss["title"];	
		}
				 
			  $time_z=$rrd1x[0].':'.$rrd1x[1];
			 
			 break;
		 }


                  case "15":
                  case "16":
                  case "19":
                  case "17":
                  case "18":
                      {
                      //улетают в отпуск новые туры
                          if($row_8["action"]==15) {
                              $comment_b = 'Вылетают';
                          }
                          if($row_8["action"]==16)
                          {
                              $comment_b = 'Прилетают';
                          }
                          if($row_8["action"]==17)
                          {
                              $comment_b = 'Узнать впечатление по туру';
                          }
                          if($row_8["action"]==18)
                          {
                              $comment_b = 'Срок оплаты туроператору';
                          }
                          if($row_8["action"]==19)
                          {
                              $comment_b = 'Срок оплаты от клиента';
                          }

                                      $result_uuy = mysql_time_query($link, 'select A.id,A.shopper,A.id_shopper,A.hotel,A.id_country,A.place_name,A.date_start,A.date_end,A.number_to from trips as A where A.id="'.ht($row_8["id_object"]).'"');
                      $num_results_uuy = $result_uuy->num_rows;

                      if ($num_results_uuy != 0) {
                          $row_uuy = mysqli_fetch_assoc($result_uuy);
                          $id_user_ring=$row_uuy["id_shopper"];


                          if($row_uuy["shopper"]==1) {
                              //частное лицо
                              $result_uus = mysql_time_query($link, 'select fio from k_clients where id="'.ht($row_uuy["id_shopper"]) . '"');
                          } else
                          {
                              //2 фирма
                              $result_uus = mysql_time_query($link, 'select name as fio from k_organization where id="'.ht($row_uuy["id_shopper"]) . '"');
                              $shopper = 1;  //фирма
                          }
                          $num_results_uus = $result_uus->num_rows;

                          if($num_results_uus!=0) {
                              $row_uus = mysqli_fetch_assoc($result_uus);
                              $name_user_ring=$row_uus["fio"];
                          }

                          $name_book=info_trips($row_8["id_object"],$link);


                      }

                      $time_z=$rrd1x[0].':'.$rrd1x[1];

                      break;
                  }


						  
			case "7":{ 
   //день рождение
			$comment_b='Поздравить с днем рождением';
			$result_ss = mysql_time_query($link,'SELECT A.fio,A.id FROM k_clients as A WHERE A.id="'.ht($row_8["id_object"]).'" and A.visible=1');
        $num_ss = $result_ss->num_rows;	
        if($result_ss)
        {	
           $row_ss = mysqli_fetch_assoc($result_ss);	
		   $id_user_ring=$row_ss["id"];
		   $name_user_ring=$row_ss["fio"];
		}
  
			 break;
		 }
                  case "21":{
                      //заканчивается срок действия паспорта
                      $comment_b=$row_8["comment"];
                      $result_ss = mysql_time_query($link,'SELECT A.fio,A.id FROM k_clients as A WHERE A.id="'.ht($row_8["id_object"]).'" and A.visible=1');
                      $num_ss = $result_ss->num_rows;
                      if($result_ss)
                      {
                          $row_ss = mysqli_fetch_assoc($result_ss);
                          $id_user_ring=$row_ss["id"];
                          $name_user_ring=$row_ss["fio"];
                      }

                      break;
                  }
						  
					  
			  }
		
			  if(($row_8["action"]=='7')or($row_8["action"]=='21'))
				  {
					 $svyz='<span class="js-client'.$no_click_vis.' ring-user js-glu-f-'.$id_user_ring.'"  iod="'.$id_user_ring.'">'.$name_user_ring.'</span>';				  
				  } else
				  {
					 
					  
					  
	if(($row_8["action"]==6)or($row_8["action"]==5))
	{
		$svyz='<span class="js-client'.$no_click_vis.' ring-user js-glu-f-'.$id_user_ring.'"  iod="'.$id_user_ring.'">'.$name_user_ring.'</span><div style="margin-top: 5px;"><a class="ari" href="booking/'.$row_ss["id"].'/">'.$row_ss["title"].'</a></div>';
	}

                      if(($row_8["action"]==15)or($row_8["action"]==16)or($row_8["action"]==17)or($row_8["action"]==18)or($row_8["action"]==19))
                      {
                          $svyz='';

                          if(($row_8["action"]==15)or($row_8["action"]==16)) {
                              if ($shopper == 0) {
                                  //частное лицо
                                  $svyz .= '<div class="pass_wh_trips"><a class="js-client" iod="' . $id_user_ring . '"><span class="js-glu-f-' . $id_user_ring . '">' . $name_user_ring . '</span></a></div>';
                              } else {
//      фирма
                                  $svyz .= '<div class="pass_wh_trips"><a class="js-org" iod="' . $id_user_ring . '"><span class="js-glo-n-' . $id_user_ring . '">' . $name_user_ring . '</span></a></div>';
                              }
                          }


                          $svyz.='<div style="margin-top: 5px;"><a class="ari" href="tours/.id-'.$row_8["id_object"].'">'.$name_book.'</a></div>';
                          
                          
                          
                      }
	
	
	
			  }
			
		}	
	
	
	
	
	
	
	
	
$task_cloud_block.='<div class="task_block_global '.$new_sayx.'" id_task="'.$row_8["id"].'"><div class="teps" rel_w="'.$PROC.'" style="width: 0%;"><div class="peg_div"><div></div></div></div>

	<div class="task-b-number">'.$row_8["id"].'</div>
	<div class="task-b-date"><span class="label-task-gg ">Дата
</span>';
	
	           $prs=0;
$clkk1='';
               $d_day=dateDiff_1(date("y-m-d").' '.date("H:i:s"),$row_8["ring_datetime"]);
			   if(($d_day>0)and($row_8["status"]==0))
			   {
				  $clkk='class="red__task"';
				   $clkk1='red-jjx';
				  $prs=1; 
			   }
					
		  

					//echo($clkk1);
				$task_cloud_block.=task_neo1($row_8["ring_datetime"],$clkk1);			
			
		if(($row_8["status"]==0) and ($prs==1))
		{
			$task_cloud_block.='<div class="pr-x">Просрочка '.abs($d_day).' '.PadejNumber(abs($d_day),'день,дня,дней').'</div>';
		} else
		{
			if($row_8["status"]==0)
			{
				$task_cloud_block.='<div class="ot-x">Открыто</div>';
			}
			if($row_8["status"]==1)
			{
				$result_work_zz2=mysql_time_query($link,'SELECT A.action_history,A.id_user,A.datetimes FROM task_status_history_new AS A WHERE A.edit=0 AND A.id_task="'.$row_8["id"].'" ORDER BY datetimes DESC LIMIT 1');
	
        $num_results_work_zz2 = $result_work_zz2->num_rows;
	    if($num_results_work_zz2!=0)
	    {	
	$row_work_zz2 = mysqli_fetch_assoc($result_work_zz2);
		}
				$task_cloud_block.='<div class="vip-x">Выполнено</div><span class="kog-za">'.task_st1($row_work_zz2["datetimes"]).'</span>';
			}			
			if($row_8["status"]==2)
			{
					   	$result_work_zz2=mysql_time_query($link,'SELECT A.action_history,A.id_user,A.datetimes FROM task_status_history_new AS A WHERE A.edit=0 AND A.id_task="'.$row_8["id"].'" ORDER BY datetimes DESC LIMIT 1');
	
        $num_results_work_zz2 = $result_work_zz2->num_rows;
	    if($num_results_work_zz2!=0)
	    {	
	$row_work_zz2 = mysqli_fetch_assoc($result_work_zz2);
		}
				$task_cloud_block.='<div class="za-x">Закрыто</div><span class="kog-za">'.task_st1($row_work_zz2["datetimes"]).'</span>';
			}			
		}

	
	$task_cloud_block.='</div>
	<div class="task-b-time"><span class="'.$clkk1.'">'.$time_z.'</span></div>
	<div class="task-b-responsible">';

$task_cloud_block.='<span class="label-task-gg ">Ответственные
</span>';

$mas_responsible=explode(",",$row_8["id_user_responsible"]);
foreach ($mas_responsible as $key => $value) 
{
	
	      
	   
	   	$result_work_zz1=mysql_time_query($link,'Select a.name_user from r_user as a where a.id="'.ht($value).'"');
	 
        $num_results_work_zz1 = $result_work_zz1->num_rows;
	    if($num_results_work_zz1!=0)
	    {
			$row_work_zz1 = mysqli_fetch_assoc($result_work_zz1);
			if($key!=0)
			{
				$query_string.=',</div> <div>'.$row_work_zz1["name_user"];
			} else
			{
				$query_string= '<div>'.$row_work_zz1["name_user"];
			}
		}
}
$query_string.='</div>';
$task_cloud_block.= $query_string;



$task_cloud_block.='</div>
	<div class="task-b-comment"><span class="label-task-gg ">Цель задачи
</span><span class="spans ggh-e">'.$comment_b.'</span>';

if(($row_8["status"]=='2')or($row_8["status"]=='1'))
{
	if($row_8["status"]=='2')
	{
	  $datt='8';
	}
	if($row_8["status"]=='1')
	{
	  $datt='5';
	}	
	
	$result_work_zz2=mysql_time_query($link,'SELECT A.action_history,A.id_user,A.datetimes FROM task_status_history_new AS A WHERE A.edit=0 and A.action_history="'.$datt.'" AND A.id_task="'.$row_8["id"].'" ORDER BY datetimes DESC LIMIT 1');
	
    $num_results_work_zz2 = $result_work_zz2->num_rows;
	if($num_results_work_zz2!=0)
	{	
	       $row_work_zz2 = mysqli_fetch_assoc($result_work_zz2);
	}
		$result_work_zz1=mysql_time_query($link,'Select a.name_user from r_user as a where a.id="'.$row_work_zz2["id_user"].'"');
	 $kem='';
        $num_results_work_zz1 = $result_work_zz1->num_rows;
	    if($num_results_work_zz1!=0)
	    {
			$row_work_zz1 = mysqli_fetch_assoc($result_work_zz1);
			$kem=$row_work_zz1["name_user"];
		}	
	
	$task_cloud_block.='<div class="oto-z">'.$kem.' ('.task_st1($row_work_zz2["datetimes"]).')</div>';
	
	$result_work_zz2=mysql_time_query($link,'SELECT B.comment FROM  task_status_history_new AS B WHERE B.edit=1 AND B.id<(
SELECT A.id FROM task_status_history_new AS A WHERE A.edit=0 AND A.id_task="'.$row_8["id"].'" ORDER BY datetimes DESC LIMIT 1)
AND B.id_task="'.$row_8["id"].'" ORDER BY datetimes DESC LIMIT 1');
	
    $num_results_work_zz2 = $result_work_zz2->num_rows;
	if($num_results_work_zz2!=0)
	{	
	       $row_work_zz2 = mysqli_fetch_assoc($result_work_zz2);
	}
	
	
	
	$task_cloud_block.='<div class="oto-z">'.$row_work_zz2["comment"].'</div>';
}

	                  if((count($mas_responsible)>1)and($row_8["status"]==0)and(in_array($id_user, $mas_responsible)))
					  {
						 $task_cloud_block.='<div class="ring-comm-option">';
						 
						 $val_self=0; 
						 $val_class='';
						 $val_name=''; 
						 if($row_8["myself"]!=0)
						 {
							 //кто то уже взял на себя
							
							  if($row_8["myself"]==$id_user)
						      {
								  //вы решили выполнить эту задачу сами
								  $val_class="active_task_cb";
								  $val_name='Вы взялись за выполнение';
								  $val_self=1;
							  } else
							  {
								  //кто-то решил выполнить находим кто
								  	$result_status22=mysql_time_query($link,'SELECT b.name_user,b.name_small FROM r_user AS b WHERE b.id="'.htmlspecialchars(trim($row_8["myself"])).'"');	
					 //echo('SELECT a.* FROM r_status AS a WHERE a.numer_status="'.$row1ss["status"].'" and a.id_system=13');
                if($result_status22->num_rows!=0)
                {  
                   $row_status22 = mysqli_fetch_assoc($result_status22);	
								  
				}
								  $val_name='Задачу выполняет → <strong>'.$row_status22["name_small"].'</strong></span>';
								  $val_self=2;	
								  
							  }
							 
						 } else
						 {
							 $val_name='Забрать задачу на себя';
						 }
						  
						  $task_cloud_block.='<div class="input-choice-click-task js-choice-task-y">
<div class="choice-head">'.$val_name.'</div>
<div class="choice-radio"><div class="center_vert1">';
if(($row_8["myself"]!=$id_user)and($row_8["myself"]!=0))
{
	  $task_cloud_block.='<i style="display:none;"></i>';
} else
{
  $task_cloud_block.='<i class="'.$val_class.'"></i>';
}
						  
						  
$task_cloud_block.='<input name="" id="" value="'.$val_self.'" type="hidden"></div></div></div>';
						 
						 $task_cloud_block.='</div>'; 
					  }


$task_cloud_block.='</div><div class="task-b-svyz"><span class="label-task-gg ">Связи
</span>'.$svyz.'</div><div class="task-b-user"><span class="label-task-gg ">Кем выставлено
</span>';
	
			$result_work_zz1=mysql_time_query($link,'Select a.name_user from r_user as a where a.id="'.$row_8["id_user"].'"');
	 $kem='системная задача';
        $num_results_work_zz1 = $result_work_zz1->num_rows;
	    if($num_results_work_zz1!=0)
	    {
			$row_work_zz1 = mysqli_fetch_assoc($result_work_zz1);
			$kem=$row_work_zz1["name_user"];
		}
	$task_cloud_block.='<div class="titi-kem">'.$kem.'</div>';
if(!empty($row_8["date_create"]))
{
	$rrd=explode(' ',$row_8["date_create"]);	
				$rrd0=explode('-',$rrd[0]);
				$rrd1=explode(':',$rrd[1]);
	$task_cloud_block.='<div class="titi">'.$rrd0[2].'.'.$rrd0[1].'.'.$rrd0[0].' '.$rrd1[0].':'.$rrd1[1].'</div>';
} else
{
	$task_cloud_block.='<div class="titi">Неизвестно</div>';	
}
	//$task_cloud_block.='<div class="titi">'.$rrd0[2].'.'.$rrd0[1].'.'.$rrd0[0].' '.$rrd1[0].':'.$rrd1[1].'</div>';
$tabs_menu_x_visible[2]="0";
$mas_responsible=explode(",",$row_8["id_user_responsible"]);
		   if($row_8["status"]==0)
		   {
if(($sign_admin!=1))
{
if (in_array($id_user, $mas_responsible)) 
{
	$tabs_menu_x_visible[2]="1";
} else
{
	//может он управляющий кого то кто должен выполнить эту задачу тогда ему тоже можно ее выполнить
	 $subo_x = array();
	foreach ($mas_responsible as $key => $value) 
    {
	   $subo_x = array_merge($subo_x, all_chief($value,$link));	   
		
	}
	$subo_x= array_unique($subo_x);
	
	
	if ((in_array($id_user, $subo_x))) 
    {
		$tabs_menu_x_visible[2]="1";
	}		
			
}		   
}  else
{
	$tabs_menu_x_visible[2]="1";
}
			   
}

    //определяем может ли он выполнить эту задачу
    //определяем может ли он выполнить эту задачу
    //определяем может ли он выполнить эту задачу
if(($tabs_menu_x_visible[2]=="1")and($row_8['click']==1))
{
	$task_cloud_block.='<div class="vip-ds"><div rel_taskk="'.$row_8["id"].'" data-tooltip="Отметить как выполнена" class="task__click1"></div></div>';
}


$task_cloud_block.='</div>';



$task_cloud_block.='</div>';	

?>