<?
	$vipoll='';
$vipoll_flag=0;
	if($row_8["status"]==1)
	{
	   	$result_work_zz2=mysql_time_query($link,'SELECT A.action_history,A.id_user,A.datetimes FROM task_status_history_new AS A WHERE A.edit=0 AND A.id_task="'.$row_8["id"].'" ORDER BY datetimes DESC LIMIT 1');
	
        $num_results_work_zz2 = $result_work_zz2->num_rows;
	    if($num_results_work_zz2!=0)
	    {	
	$row_work_zz2 = mysqli_fetch_assoc($result_work_zz2);
			//echo($row_8["status"]);
			if($row_work_zz2["action_history"]==5)
			{
				$vipoll_flag=1;
				
		$result_work_zz1=mysql_time_query($link,'Select a.name_user from r_user as a where a.id="'.$row_work_zz2["id_user"].'"');
	 
        $num_results_work_zz1 = $result_work_zz1->num_rows;
	    if($num_results_work_zz1!=0)
	    {
			$row_work_zz1 = mysqli_fetch_assoc($result_work_zz1);
		}
//$D = explode(' ', $row_8["datetimes"]);

	$vipoll=$row_work_zz1["name_user"];	
	
	
		}
		}
	}
	
	//задача закрыта по причине неактуальности или невозможности ее решить
	if($row_8["status"]==2)
	{
	   	$result_work_zz2=mysql_time_query($link,'SELECT A.action_history,A.id_user,A.datetimes FROM task_status_history_new AS A WHERE A.edit=0 AND A.id_task="'.$row_8["id"].'" ORDER BY datetimes DESC LIMIT 1');
	
        $num_results_work_zz2 = $result_work_zz2->num_rows;
	    if($num_results_work_zz2!=0)
	    {	
	$row_work_zz2 = mysqli_fetch_assoc($result_work_zz2);
			//echo($row_8["status"]);
			if($row_work_zz2["action_history"]==8)
			{
				$vipoll_flag=2;
				
		$result_work_zz1=mysql_time_query($link,'Select a.name_user from r_user as a where a.id="'.$row_work_zz2["id_user"].'"');
	 
        $num_results_work_zz1 = $result_work_zz1->num_rows;
	    if($num_results_work_zz1!=0)
	    {
			$row_work_zz1 = mysqli_fetch_assoc($result_work_zz1);
		}
//$D = explode(' ', $row_8["datetimes"]);

	$vipoll=$row_work_zz1["name_user"];	
	
	
		}
		}			
	}

$query_string='<div class="jipp_fll"><div class="px_flex flex_edit_cb"><div class="essa_b">';

$query_string.='<div class="form_yes_4">';
$query_string.='<div class="div_textarea_say_task" >
	   <label>Текст задачи</label>
			<div class="otziv_add">';
 
        $query_string.='<textarea style="height:20px" cols="10" rows="1" placeholder="" name="comment_b" class="di text_area_otziv no_comment_bill yes_task_new_2020 js-edit-task-f-'.$name_form.'">'.$row_8["comment"].'</textarea>

 <script type="text/javascript"> 
	  $(function (){ 
$(\'.js-edit-task-f-'.$name_form.'\').autoResize({extraSpace : 10});
$(\'.js-edit-task-f-'.$name_form.'\').trigger(\'keyup\');

ToolTip();
});

	</script>';

                   
				
$query_string.='</div></div></div>';	 

$query_string.='</div></div>';

$query_string.='<div class="jkl_dd"><div class="center_vert" style="width: 100%;"><div class="add_cff12 js-save-info-task-cb">Сохранить изменения</div></div></div>';

$query_string.='</div>';

$query_string.='<div class="jipp_fll_start">';

$query_string.='<div class="px_flex"><div class="px_left"><div class="strong_wh">Дополнительная информация</div>';
	



                                                              
                                                                             		 			 		


$kem='';
	if($row_8["id_user"]!=0)
	{
		$result_work_zz1=mysql_time_query($link,'Select a.name_user from r_user as a where a.id="'.$row_8["id_user"].'"');
	 
        $num_results_work_zz1 = $result_work_zz1->num_rows;
	    if($num_results_work_zz1!=0)
	    {
			$row_work_zz1 = mysqli_fetch_assoc($result_work_zz1);
			$kem=$row_work_zz1["name_user"];
		}
	} else
	{
		$kem='Системная задача';
	}

$D = explode(' ', $row_8["date_create"]);

	$query_string.='<div class="pass_wh"><label>Кем выставлено</label><span>'.$kem.' ('.task_st($row_8["date_create"]).')</span></div>';
	
	//$D = explode(' ', $row_8["date_create"]);
	//$query_string.='<div class="pass_wh"><label>Добавлен</label><span>'.MaskDate_D_M_Y_ss($D[0]).'</span></div>';
	

	$query_string.='<div class="pass_wh"><label>Ответственные</label><span>';


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
				$query_string.=', '.$row_work_zz1["name_user"];
			} else
			{
				$query_string.= $row_work_zz1["name_user"];
			}
		}
}

$query_string.='</span></div>';



if(($vipoll_flag==1)or($vipoll_flag==0))
{

	$query_string.='<div class="pass_wh"><label>Выполнено</label><span>'.rooo($vipoll,'','—').'</span></div>';
} else
{
	$query_string.='<div class="pass_wh"><label>Закрыта</label><span>'.rooo($vipoll,'','—').'</span></div>';	
}
	
	
	$query_string.='</div><div class="px_right"><div class="strong_wh">Дата и связи</div>';
	
//если не исполнена то выводим когда надо исполнить сколько осталось дней
//если исполнена то выводим когда и насколько раньше чем время заданное
if($vipoll_flag==1)
{
	$query_string.='<div class="pass_wh"><label>Дата исполнения</label><span>'.task_iso($row_work_zz2["datetimes"],$row_8["ring_datetime"]).'</span></div>';	
} 
if($vipoll_flag==0)
{
	$query_string.='<div class="pass_wh"><label>Необходимо выполнить</label><span>'.task_neo($row_8["ring_datetime"]).'</span></div>';		
}
if($vipoll_flag==2)
{
	$query_string.='<div class="pass_wh"><label>Когда закрыта</label><span>'.task_st($row_work_zz2["datetimes"]).'</span></div>';		
}

$query_string.='<div class="pass_wh"><label>Связи</label>';

$id_user_ring='';
$firm_people=0;
$name_user_ring='';
$sv='';
$name_book='';
$id_book='';
			switch($row_8["action"])
              {
			case "5":{
			//улетают
			$result_ss = mysql_time_query($link,'SELECT A.title,A.id_client,B.fio,A.id FROM booking as A,k_clients as B WHERE A.id_client=B.id and A.id="'.ht($row_8["id_object"]).'" and A.visible=1');
        $num_ss = $result_ss->num_rows;	
        if($result_ss)
        {	
           $row_ss = mysqli_fetch_assoc($result_ss);
		   $name_book=$row_ss["title"];
			$id_book=$row_8["id_object"];
				$id_user_ring=$row_ss["id_client"];
$name_user_ring=$row_ss["fio"];
		}
		
			 
			 break;
		 }					  
			case "6":{
			//прилетают
			
			$result_ss = mysql_time_query($link,'SELECT A.title,A.id_client,B.fio,A.id FROM booking as A,k_clients as B WHERE A.id_client=B.id and A.id="'.ht($row_8["id_object"]).'" and A.visible=1');
        $num_ss = $result_ss->num_rows;	
        if($result_ss)
        {	
           $row_ss = mysqli_fetch_assoc($result_ss);
		   $id_user_ring=$row_ss["id_client"];
		   $name_user_ring=$row_ss["fio"];
		   $name_book=$row_ss["title"];
		   $id_book=$row_8["id_object"];	
		}
			
				 
			 
			 
			 break;
		 }					  
						  
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
		 case "13":{ 
			 //задача связанная просто с организацией
					$result_ss = mysql_time_query($link,'SELECT A.name,A.id FROM k_organization as A WHERE A.id="'.ht($row_8["id_object"]).'"');
        $num_ss = $result_ss->num_rows;	
        if($result_ss)
        {	
           $row_ss = mysqli_fetch_assoc($result_ss);	
		   $id_user_ring=$row_ss["id"] ?? '';
		   $name_user_ring=$row_ss["name"] ?? 'неизвестно';
			$firm_people=1;
		}
			 
			 
			 break; 
                  }
                case "15":
                case "16":
                case "19":
                case "17":
                case "18":
                {

                    $result_uuy = mysql_time_query($link, 'select A.id,A.shopper,A.id_shopper,A.hotel,A.id_country,A.place_name,A.date_start,A.date_end,A.number_to from trips as A where A.id="'.ht($row_8["id_object"]).'"');
                    $num_results_uuy = $result_uuy->num_rows;

                    if ($num_results_uuy != 0) {
                        $row_uuy = mysqli_fetch_assoc($result_uuy);
                        $id_user_ring=$row_uuy["id_shopper"];


                        if($row_uuy["shopper"]==1) {
                            //частное лицо
                            $shopper=0;
                            $result_uus = mysql_time_query($link, 'select fio from k_clients where id="'.ht($row_uuy["id_shopper"]) . '"');
                        } else
                        {
                            //2 фирма
                            $result_uus = mysql_time_query($link, 'select name as fio from k_organization where id="'.ht($row_uuy["id_shopper"]) . '"');
                            $firm_people=1;
                            $shopper = 1;  //фирма
                        }
                        $num_results_uus = $result_uus->num_rows;

                        if($num_results_uus!=0) {
                            $row_uus = mysqli_fetch_assoc($result_uus);
                            $name_user_ring=$row_uus["fio"];
                        }

                        $name_book=info_trips($row_8["id_object"],$link);

                        $id_book=$row_8["id_object"];

                    }

                    $time_z=$rrd1x[0].':'.$rrd1x[1];

                    break;
                }



			  }

$no_click_vis='';

if(($row_8["action"]==15)or($row_8["action"]==16)or($row_8["action"]==17)or($row_8["action"]==18)or($row_8["action"]==19))
{
    $sv = '<a class="link-task-okko" href="tours/.id-' . $id_book . '"><strong>' . $name_book . '</strong></a>';

    if(($row_8["action"]==15)or($row_8["action"]==16)) {
        if ($shopper == 0) {
            //частное лицо

            $sv .= ' <div class="js-client' . $no_click_vis . ' ring-user js-glu-f-' . $id_user_ring . '"  iod="' . $id_user_ring . '">«' . $name_user_ring . '»</div>';

        } else {
//      фирма

            $sv .= ' <div class="js-org' . $no_click_vis . ' ring-user js-glo-n-' . $id_user_ring . '"  iod="' . $id_user_ring . '">«' . $name_user_ring . '»</div>';

        }
    }




} else {
    if ($id_book != '') {
        $sv = '<a class="link-task-okko" href="booking/' . $id_book . '/"><strong>' . $name_book . '</strong></a><div class="js-client' . $no_click_vis . ' ring-user js-glu-f-' . $id_user_ring . '"  iod="' . $id_user_ring . '">«' . $name_user_ring . '»</div>';
    } else {
        if ($id_user_ring != '') {
            if ($firm_people == 0) {
                $sv = '<span class="js-client' . $no_click_vis . ' ring-user js-glu-f-' . $id_user_ring . '"  iod="' . $id_user_ring . '">«' . $name_user_ring . '»</span>';
            } else {
                $sv = '<span class="js-org' . $no_click_vis . ' ring-user js-glo-n-' . $id_user_ring . '"  iod="' . $id_user_ring . '">«' . $name_user_ring . '»</span>';
            }

        }
    }
}


$query_string.='<span>'.rooo($sv,'','—').'</span>';


$query_string.='</div>';	


$query_string.='</div></div>';


$query_string.='</div>';	
?>