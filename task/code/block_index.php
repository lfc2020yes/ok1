<?
$task_cloud_block='';
$yellow_all='';
$count_ring ??=0;
$class_ring ??='';	
$ring_ooo='';
	$no_click_vis = $no_click_vis ?? '';
//на главной блок уведомлений и задач
if($row_8["reminder"]==0)
				 {
//задачи и все что с ними связано
	$yellow_all='';
	$tclc='task-ring';
	if($row_8["flag"]==1)
	{
		$yellow_all='yellow_all';
		$tclc='task-ring-all';
	}
	
$pros ??= '';	
	
	if($pros==1)
	{
		$yellow_all='red_all';
	}

	$ring_o = $ring_o ?? '';
	if($ring_o==1)
	{
		$ring_ooo='ring_o';
	}
	

	
$task_cloud_block.='<div id_task="'.$row_8["id"].'" class="task_clock_selection '.$tclc.' '.$class_ring.' '.$yellow_all.'"><div class="task_clock_selection1">
					    <div class="clock_cbb"><i></i></div>
					    <div class="why_task_cbb">';
	if($row_8["flag"]==0)
	{
		$task_cloud_block.='<span>Задача №'.$row_8["id"].'</span>';
	} else
	{
		$task_cloud_block.='<span>Общая Задача №'.$row_8["id"].'</span>';
	}
					  
				      //определяем с каким клиентом связано в зависимости от типа задачи (action)
				  $id_user_ring='';
				  $name_user_ring='';
			switch($row_8["action"])
              {

            case "21":
			case "7":{ 
   //день рождение
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
				  
						  
		 case "9":{ 
			 //задача из подборок клиента
					$result_ss = mysql_time_query($link,'SELECT A.fio,A.id FROM k_clients as A,selection as B WHERE B.id="'.ht($row_8["id_object"]).'" and B.visible=1 and B.id_k_clients=A.id');
        $num_ss = $result_ss->num_rows;	
        if($result_ss)
        {	
           $row_ss = mysqli_fetch_assoc($result_ss);	
		   $id_user_ring=$row_ss["id"];
		   $name_user_ring=$row_ss["fio"];
		}
			 
			 
			 break; 
                  }
		 case "10":{ 
			 //задача из общения с клиентом
					$result_ss = mysql_time_query($link,'SELECT A.fio,A.id FROM k_clients as A,k_clients_commun as B WHERE B.id="'.ht($row_8["id_object"]).'" and B.visible=1 and B.id_client=A.id');
        $num_ss = $result_ss->num_rows;	
        if($result_ss)
        {	
           $row_ss = mysqli_fetch_assoc($result_ss);	
		   $id_user_ring=$row_ss["id"];
		   $name_user_ring=$row_ss["fio"];
		}
			 
			 
			 break; 
                  }	
		 case "11":{ 
			 //задача связанная просто с клиентом
					$result_ss = mysql_time_query($link,'SELECT A.fio,A.id FROM k_clients as A WHERE A.id="'.ht($row_8["id_object"]).'"');
        $num_ss = $result_ss->num_rows;	
        if($result_ss)
        {	
           $row_ss = mysqli_fetch_assoc($result_ss);	
		   $id_user_ring=$row_ss["id"];
		   $name_user_ring=$row_ss["fio"];
		}
			 
			 
			 break; 
                  }	
		 case "12":{ 
			 //задача связанная просто с потенциальным клиентом
					$result_ss = mysql_time_query($link,'SELECT A.fio,A.id FROM k_clients as A WHERE A.id="'.ht($row_8["id_object"]).'"');
        $num_ss = $result_ss->num_rows;	
        if($result_ss)
        {	
           $row_ss = mysqli_fetch_assoc($result_ss);	
		   $id_user_ring=$row_ss["id"];
		   $name_user_ring=$row_ss["fio"];
		}
			 
			 
			 break; 
                  }						  
		 case "13":{ 
			 //задача связанная просто с организацией
					$result_ss = mysql_time_query($link,'SELECT A.name,A.id FROM k_organization as A WHERE A.id="'.ht($row_8["id_object"]).'"');
        $num_ss = $result_ss->num_rows;	
        if($result_ss)
        {	
           $row_ss = mysqli_fetch_assoc($result_ss);	
		   $id_user_ring=$row_ss["id"] ?? 0;
		   $name_user_ring=$row_ss["name"] ?? 'Неизвестно';
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



            }
	
	
				  if($row_8["action"]=='13')
				  {
					 $task_cloud_block.=', <span class="js-org'.$no_click_vis.' ring-user js-glo-n-'.$id_user_ring.'"  iod="'.$id_user_ring.'">«'.$name_user_ring.'»</span>';				  
				  } else
				  {
					 if(($row_8["action"]!='14')and($row_8["action"]!='20'))
					 {
					  $task_cloud_block.=', <span class="js-client'.$no_click_vis.' ring-user js-glu-f-'.$id_user_ring.'"  iod="'.$id_user_ring.'">«'.$name_user_ring.'»</span>';
					 }
				  }


                     if(($row_8["action"]==15)or($row_8["action"]==16)or($row_8["action"]==17)or($row_8["action"]==18)or($row_8["action"]==19))
                     {

                         if(($row_8["action"]==15)or($row_8["action"]==16)) {
                             if ($shopper == 0) {
                                 //частное лицо
                                 $task_cloud_block.=', <span class="js-org'.$no_click_vis.' ring-user js-glo-n-'.$id_user_ring.'"  iod="'.$id_user_ring.'">«'.$name_user_ring.'»</span>';
                             } else {
//      фирма
                                 $task_cloud_block.=', <span class="js-org'.$no_click_vis.' ring-user js-glo-n-'.$id_user_ring.'"  iod="'.$id_user_ring.'">«'.$name_user_ring.'»</span>';
                             }
                         }


                         $task_cloud_block.='<div><a href="tours/.id-'.$row_8["id_object"].'"><strong>'.$name_book.'</strong></a></div>';



                     }

    if($row_8["action"]==20) {
        $task_cloud_block.=', <a class="ring-user bg-border"  href="preorders/.id-'.$row_8["id_object"].'"><strong>Обращение №'.$row_8["id_object"].'</strong></a>';

    }

	
					  $task_cloud_block.='<div class="ring-comm '.$ring_ooo.'">'.$row_8["comment"];
	
	
	
	
	$task_cloud_block.='</div>';
	
	                  if(($row_8["flag"]==1)and($no_click_vis!=1))
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
					
		  
					  $task_cloud_block.='</div>';
					  $rrd=explode(' ',$row_8["ring_datetime"]);	
				
				   $rrd1=explode(':',$rrd[1]);
					  $task_cloud_block.='<div class="ring-time">';

					  if(!isset($big_date)) {
                          if ($pros == 1) {

                              $clkk = '';
                              if (dateDiff_1(date("y-m-d") . ' ' . date("H:i:s"), $row_8["ring_datetime"]) >= 0) {
                                  $clkk = 'class="red__task"';
                              }


                              $task_cloud_block .= '<span ' . $clkk . '>' . time_task_umatravel1($row_8["ring_datetime"]) . '</span>';

                          } else {
                              $task_cloud_block .= '<div class="task__time1">' . $rrd1[0] . ':' . $rrd1[1] . '</div>';
                          }

                      } else
                      {
//выводим везде даты по задачам в конкретном клиенте
                          $clkk = '';
                          if (dateDiff_1(date("y-m-d") . ' ' . date("H:i:s"), $row_8["ring_datetime"]) >= 0) {
                              $clkk = 'class="red__task"';
                          }

                          $task_cloud_block .= '<span ' . $clkk . '>' . time_task_umatravel1($row_8["ring_datetime"]) . '</span>';
                      }



					 					  						if(($no_click_vis!=1)and($row_8["click"]==1))
			{
					  $task_cloud_block.='<div rel_taskk="'.$row_8["id"].'" data-tooltip="Отметить как выполнена" class="task__click1"></div>';
			} 
					  $task_cloud_block.='</div>
					  
					  </div></div>';
				  
				  $count_ring++;
			  }	 else
	 {
		 
		 //напоминалки напоминалки напоминалки напоминалки напоминалки напоминалки напоминалки
         //напоминалки напоминалки напоминалки напоминалки напоминалки напоминалки напоминалки
         //напоминалки напоминалки напоминалки напоминалки напоминалки напоминалки напоминалки
         //напоминалки напоминалки напоминалки напоминалки напоминалки напоминалки напоминалки
         //напоминалки напоминалки напоминалки напоминалки напоминалки напоминалки напоминалки

		 switch($row_8["action"])
              {
		 case "7":{ 
			 $task_cloud_block.='<div id_task="'.$row_8["id"].'" class="task_clock_selection birthday-ring '.$class_ring.'"><div class="task_clock_selection1">
					    <div class="clock_cbb"><i></i></div>
					    <div class="why_task_cbb">
					  <span>День рождения</span>, ';	
			 $result_ss = mysql_time_query($link,'SELECT A.fio,A.id FROM k_clients as A WHERE A.id="'.ht($row_8["id_object"]).'" and A.visible=1');
        $num_ss = $result_ss->num_rows;	
        if($result_ss)
        {	
           $row_ss = mysqli_fetch_assoc($result_ss);	
		   $id_user_ring=$row_ss["id"];
		   $name_user_ring=$row_ss["fio"];
		}
			 
		$task_cloud_block.='<span class="js-client'.$no_click_vis.' ring-user js-glu-f-'.$id_user_ring.'"  iod="'.$id_user_ring.'">«'.$name_user_ring.'»</span><div class="ring-comm '.$ring_ooo.'"></div>';
					
		  
					  $task_cloud_block.='</div>';
					  $rrd=explode(' ',$row_8["ring_datetime"]);	
				
				   $rrd1=explode(':',$rrd[1]);
					  $task_cloud_block.='<div class="ring-time">';


        if(isset($big_date))
             {
//выводим везде даты по задачам в конкретном клиенте
                 $clkk = '';
                 if (dateDiff_1(date("y-m-d") . ' ' . date("H:i:s"), $row_8["ring_datetime"]) >= 0) {
                     $clkk = 'class="red__task"';
                 }

                 $task_cloud_block .= '<span ' . $clkk . '>' . time_task_umatravel1($row_8["ring_datetime"]) . '</span>';
             }



					  						if($no_click_vis!=1)
			{
					  $task_cloud_block.='<div rel_taskk="'.$row_8["id"].'" data-tooltip="Отметить как выполнена" class="task__click1"></div>';
			}
					  
					  
					  $task_cloud_block.='</div>
					  
					  </div></div>';
				  
				  $count_ring++;	 
			 
			 
			 break;
		 }

             case "21":{
                 $task_cloud_block.='<div id_task="'.$row_8["id"].'" class="task_clock_selection intersrok-ring '.$class_ring.'"><div class="task_clock_selection1">
					    <div class="clock_cbb"><i></i></div>
					    <div class="why_task_cbb">
					  <span>'.$row_8["comment"].'</span>, ';
                 $result_ss = mysql_time_query($link,'SELECT A.fio,A.id FROM k_clients as A WHERE A.id="'.ht($row_8["id_object"]).'" and A.visible=1');
                 $num_ss = $result_ss->num_rows;
                 if($result_ss)
                 {
                     $row_ss = mysqli_fetch_assoc($result_ss);
                     $id_user_ring=$row_ss["id"];
                     $name_user_ring=$row_ss["fio"];
                 }

                 $task_cloud_block.='<span class="js-client'.$no_click_vis.' ring-user js-glu-f-'.$id_user_ring.'"  iod="'.$id_user_ring.'">«'.$name_user_ring.'»</span><div class="ring-comm '.$ring_ooo.'"></div>';


                 $task_cloud_block.='</div>';
                 $rrd=explode(' ',$row_8["ring_datetime"]);

                 $rrd1=explode(':',$rrd[1]);
                 $task_cloud_block.='<div class="ring-time">';


                 if(isset($big_date))
                 {
//выводим везде даты по задачам в конкретном клиенте
                     $clkk = '';
                     if (dateDiff_1(date("y-m-d") . ' ' . date("H:i:s"), $row_8["ring_datetime"]) >= 0) {
                         $clkk = 'class="red__task"';
                     }

                     $task_cloud_block .= '<span ' . $clkk . '>' . time_task_umatravel1($row_8["ring_datetime"]) . '</span>';
                 }



                 if($no_click_vis!=1)
                 {
                     $task_cloud_block.='<div rel_taskk="'.$row_8["id"].'" data-tooltip="Отметить как выполнена" class="task__click1"></div>';
                 }


                 $task_cloud_block.='</div>
					  
					  </div></div>';

                 $count_ring++;


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
                     $name_book='-';
                     $name_book=info_trips($row_8["id_object"],$link);


                 }

                 $time_z=$rrd1x[0].':'.$rrd1x[1];

                 break;
             }


		 }

		 if(($row_8["action"]==15)or($row_8["action"]==16))
         {
             //прилетают/позвращаются по турам
             $class_1r='flystart-ring';
             $class_2r='fly-ring-start';
             if($row_8["action"]==16)
             {
                 $class_1r='flyend-ring';
                 $class_2r='fly-ring-end';
             }


             $task_cloud_block.='<div id_task="'.$row_8["id"].'" class="task_clock_selection '.$class_1r.' '.$class_ring.'"><div class="task_clock_selection1">
					    <div class="clock_cbb"><i></i></div>
					    <div class="why_task_cbb">
					  <a href="tours/.id-'.$row_8["id_object"].'"><strong>'.$name_book.'</strong></a>, ';


             if ($shopper == 0) {
                 $task_cloud_block .= '<span class="js-client' . $no_click_vis . ' ring-user js-glu-f-' . $id_user_ring . '"  iod="' . $id_user_ring . '">«' . $name_user_ring . '»</span><div class="ring-comm ' . $ring_ooo . '"></div>';
             } else
             {
                 $task_cloud_block .= '<span class="js-org' . $no_click_vis . ' ring-user js-glo-n-' . $id_user_ring . '"  iod="' . $id_user_ring . '">«' . $name_user_ring . '»</span><div class="ring-comm ' . $ring_ooo . '"></div>';

                 //$task_cloud_block .= '<span class="js-org' . $no_click_vis . '" iod="' . $id_user_ring . '"><span class="js-glo-n-' . $id_user_ring . '">' . $name_user_ring . '</span></a></div>';
             }


             $task_cloud_block.='</div>';
             $rrd=explode(' ',$row_8["ring_datetime"]);

             $rrd1=explode(':',$rrd[1]);
             $task_cloud_block.='<div class="ring-time">';

if(isset($big_date)) {

//выводим везде даты по задачам в конкретном клиенте
        $clkk = '';
        if (dateDiff_1(date("y-m-d") . ' ' . date("H:i:s"), $row_8["ring_datetime"]) >= 0) {
            $clkk = 'class="red__task"';
        }

        $task_cloud_block .= '<span ' . $clkk . '>' . time_task_umatravel1($row_8["ring_datetime"]) . '</span>';
    }
else {
    $task_cloud_block .= '<div class="task__time1 ' . $class_2r . '">' . $rrd1[0] . ':' . $rrd1[1] . '</div>';
}
             if(($no_click_vis!=1)and($row_8["click"]==1))
             {
                 $task_cloud_block.='<div rel_taskk="'.$row_8["id"].'" data-tooltip="Отметить как выполнена" class="task__click1"></div>';
             }


             $task_cloud_block.='</div>
					  
					  </div></div>';

             $count_ring++;


         }


         if(($row_8["action"]==18)or($row_8["action"]==19))
         {
             //прилетают/позвращаются по турам
             $class_1r='flymoney-ring';
             $class_2r='';



             $task_cloud_block.='<div id_task="'.$row_8["id"].'" class="task_clock_selection '.$class_1r.' '.$class_ring.'"><div class="task_clock_selection1">
					    <div class="clock_cbb"><i></i></div>
					    <div class="why_task_cbb">
					  <a href="tours/.id-'.$row_8["id_object"].'"><strong>'.$name_book.'</strong></a>, ';
             if($row_8["action"]==18) {
                 $task_cloud_block .= '<span class="ring-user">Срок оплаты туроператору</span>';
             } else
             {
                 $task_cloud_block .= '<span class="ring-user">Срок оплаты от туриста</span>';
             }
             $task_cloud_block.='</div>';
             $rrd=explode(' ',$row_8["ring_datetime"]);

             $rrd1=explode(':',$rrd[1]);
             $task_cloud_block.='<div class="ring-time">';


             if(isset($big_date)) {

//выводим везде даты по задачам в конкретном клиенте
                     $clkk = '';
                     if (dateDiff_1(date("y-m-d") . ' ' . date("H:i:s"), $row_8["ring_datetime"]) >= 0) {
                         $clkk = 'class="red__task"';
                     }

                     $task_cloud_block .= '<span ' . $clkk . '>' . time_task_umatravel1($row_8["ring_datetime"]) . '</span>';
                 }
              else {

                 $task_cloud_block .= '<div class="task__time1 '.$class_2r.'"></div>';
}
             if(($no_click_vis!=1)and($row_8["click"]==1))
             {
                 $task_cloud_block.='<div rel_taskk="'.$row_8["id"].'" data-tooltip="Отметить как выполнена" class="task__click1"></div>';
             }


             $task_cloud_block.='</div>
					  
					  </div></div>';

             $count_ring++;


         }


         if(($row_8["action"]==17))
         {
             //прилетают/позвращаются по турам
             $class_1r='flychat-ring';
             $class_2r='';



             $task_cloud_block.='<div id_task="'.$row_8["id"].'" class="task_clock_selection '.$class_1r.' '.$class_ring.'"><div class="task_clock_selection1">
					    <div class="clock_cbb"><i></i></div>
					    <div class="why_task_cbb">
					  <a href="tours/.id-'.$row_8["id_object"].'"><strong>'.$name_book.'</strong></a>, ';

                 $task_cloud_block .= '<span class="ring-user">Узнать впечатление по туру</span>';

             $task_cloud_block.='</div>';
             $rrd=explode(' ',$row_8["ring_datetime"]);

             $rrd1=explode(':',$rrd[1]);
             $task_cloud_block.='<div class="ring-time">';

             if(isset($big_date)) {

//выводим везде даты по задачам в конкретном клиенте
                 $clkk = '';
                 if (dateDiff_1(date("y-m-d") . ' ' . date("H:i:s"), $row_8["ring_datetime"]) >= 0) {
                     $clkk = 'class="red__task"';
                 }

                 $task_cloud_block .= '<span ' . $clkk . '>' . time_task_umatravel1($row_8["ring_datetime"]) . '</span>';
             }
             else {


                 $task_cloud_block .= '<div class="task__time1 '.$class_2r.'"></div>';
}
             if(($no_click_vis!=1)and($row_8["click"]==1))
             {
                 $task_cloud_block.='<div rel_taskk="'.$row_8["id"].'" data-tooltip="Отметить как выполнена" class="task__click1"></div>';
             }


             $task_cloud_block.='</div>
					  
					  </div></div>';

             $count_ring++;


         }


	 }
?>