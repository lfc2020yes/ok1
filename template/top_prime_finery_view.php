<div class="menu_top" style="border-bottom:0; box-shadow: 0 20px 30px -30px rgba(0, 0, 0, 0.6);"><div class="menu1">
  <?
   echo'<h3 class="head_h" style=" margin-bottom:0px; float:left;"> Наряд №'.$_GET['id'].'<div></div></h3>';
	
	
	//если не пользователь ее создатель выводим историю создателей и подписавших
	/*
	if($id_user!=$row_list["id_user"])
	{
	*/
	   //смотрим подписан ли он создателем
	   $hie1 = new hierarchy($link,$row_list["id_user"]);
	   $sign_level1=$hie1->sign_level;
       $sign_admin1=$hie1->admin;
	   $stack_users = array();		
	   for ($is=($sign_level1-1); $is<=3; $is++)
       {
		   		if($row_list["id_signed".$is]!=0)
				{
					  array_push($stack_users, $row_list["id_signed".$is]); 
				}
				/*	
					echo'<div  data-tooltip="Создан/Подписан - " class="user_soz"><img src="img/users/'.$rowx["id_signed".$i].'_100x100.jpg"></div>';
				} else
				{
				    echo'<div  data-tooltip="Создан - " class="user_soz n_yes"><img src="img/users/4_100x100.jpg"></div>';	
				}
				*/
	   }
	  // print_r($stack_users);
	   for ($is=0; $is<count($stack_users); $is++)
       {	
		   if(($is==0)and($stack_users[$is]==$row_list["id_user"]))
		   {
			   $result_txs=mysql_time_query($link,'Select a.name_user,a.timelast,a.id from r_user as a where a.id="'.htmlspecialchars(trim($stack_users[$is])).'"');
	            if($result_txs->num_rows!=0)
	            {   
		          $rowxs = mysqli_fetch_assoc($result_txs);
									  $online='';	
				  if(online_user($rowxs["timelast"],$rowxs["id"],$id_user)) { $online='<div class="online"></div>';}	
			   echo'<div sm="'.$stack_users[$is].'"  data-tooltip="Создан/Подписан - '.$rowxs["name_user"].'" class="user_soz n_yes send_mess">'.$online.avatar_img('<img src="img/users/',$stack_users[$is],'_100x100.jpg">').'</div>';
				}
		   } else
		   {
			   if(($is==0))
			   {
				   $result_txs=mysql_time_query($link,'Select a.name_user,a.timelast,a.id from r_user as a where a.id="'.htmlspecialchars(trim($row_list["id_user"])).'"');
	               if($result_txs->num_rows!=0)
	               {   
		       
		            $rowxs = mysqli_fetch_assoc($result_txs);
					   $online='';	
				  if(online_user($rowxs["timelast"],$rowxs["id"],$id_user)) { $online='<div class="online"></div>';}
				    echo'<div sm="'.$row_list["id_user"].'"  data-tooltip="Создан - '.$rowxs["name_user"].'" class="user_soz send_mess">'.$online.avatar_img('<img src="img/users/',$row_list["id_user"],'_100x100.jpg">').'</div>';	
		           }
			   }
			    $hiex = new hierarchy($link,$stack_users[$is]);
	            $sign_levelx=$hiex->sign_level;
                $sign_adminx=$hiex->admin;
			    $but_text='Подписан';
			   //echo($is);
			    if(($sign_adminx!=1)and($sign_levelx==2)and($row_list["signedd_nariad"]==1)and(($is+1)==count($stack_users)))
				{
					$but_text='Утвержден';
				}
			   	if(($sign_adminx!=1)and($sign_levelx==2)and($row_list["signedd_nariad"]!=1))
				{
					$but_text='Согласовать';
				}
			   	if(($sign_adminx!=1)and($sign_levelx==2)and($row_list["signedd_nariad"]==1)and(($is+1)<count($stack_users)))
				{
					$but_text='Согласовать';
				}
			   	if($sign_levelx==3)
				{
					$but_text='Утвержден';
				}
			    
			   	$result_txs=mysql_time_query($link,'Select a.name_user,a.timelast,a.id from r_user as a where a.id="'.htmlspecialchars(trim($stack_users[$is])).'"');
	            if($result_txs->num_rows!=0)
	            {   
		          $rowxs = mysqli_fetch_assoc($result_txs);
										   $online='';	
				  if(online_user($rowxs["timelast"],$rowxs["id"],$id_user)) { $online='<div class="online"></div>';}
			      echo'<div sm="'.$stack_users[$is].'"  data-tooltip="'.$but_text.' - '.$rowxs["name_user"].'" class="user_soz n_yes send_mess">'.$online.avatar_img('<img src="img/users/',$stack_users[$is],'_100x100.jpg">').'</div>';
				}
		   }
		   
		   
	   }
	//если нет подписанных то выводит просто создателя наряда
	if(count($stack_users)==0)
	{
		$result_txs=mysql_time_query($link,'Select a.name_user,a.timelast,a.id from r_user as a where a.id="'.htmlspecialchars(trim($row_list["id_user"])).'"');
      
	    if($result_txs->num_rows!=0)
	    {   
		//такая работа есть
		$rowxs = mysqli_fetch_assoc($result_txs);
								   $online='';	
				  if(online_user($rowxs["timelast"],$rowxs["id"],$id_user)) { $online='<div class="online"></div>';}
		echo'<div sm="'.$row_list["id_user"].'"  data-tooltip="Создан - '.$rowxs["name_user"].'" class="user_soz send_mess">'.$online.avatar_img('<img src="img/users/',$row_list["id_user"],'_100x100.jpg">').'</div>';
	    }
	}
	
	if($row_list["signedd_nariad"]==1)
	{
	   //утвержден проведен
	   echo'<div data-tooltip="Утвержден" class="user_soz naryd_yes"></div>';	
	}
	
	
		//определяем есть ли в наряде служебные записки
		$slyjj=0;
		$slyjj=memo_count_nariad($link,$_GET["id"]);					
		//определяем есть ли подпись снизу
		$niz_podpis=-1;
		$niz_podpis=down_signature($sign_level,$sign_admin,$link,$_GET["id"]);
	//echo($slyjj);
	//вывод статусов по наряду для пользователя
	if(($sign_level==1)and($sign_admin!=1))
	{
		if(($row_list["id_signed0"]!=0)and($row_list["id_signed1"]==0)and($row_list["signedd_nariad"]==0)and($slyjj==0))
		{
			echo'<div class="status_nana">подписан на утверждение</div>';
		}
		if(($row_list["id_signed0"]!=0)and($row_list["id_signed1"]==0)and($row_list["signedd_nariad"]==0)and($slyjj!=0))
		{
			echo'<div class="status_nana">подписан на согласование</div>';
		}		
		if(($row_list["id_signed1"]!=0)and($row_list["signedd_nariad"]==0))
		{
			echo'<div class="status_nana">подписан на утверждение</div>';
		}	
		if(($row_list["signedd_nariad"]==1))
		{
			echo'<div class="status_nana">утвержден</div>';
		}	
	}
	if(($sign_level==2)and($sign_admin!=1))
	{	
        if(($row_list["signedd_nariad"]==1))
		{
			echo'<div class="status_nana">утвержден</div>';
		}
		
		if(($podpis==0)and($slyjj!=0)and($row_list["signedd_nariad"]==0))
		{
			echo'<div class="status_nana">Подписан на утверждение</div>';	
		}			
	}
	if(($sign_level==3)and($sign_admin!=1))
	{	
        if(($row_list["signedd_nariad"]==1))
		{
			echo'<div class="status_nana">утвержден</div>';
		}
	}
	
	if(($sign_admin==1))
	{
		if(($row_list["id_signed0"]!=0)and($row_list["id_signed1"]==0)and($row_list["signedd_nariad"]==0)and($slyjj==0))
		{
			echo'<div class="status_nana">подписан на утверждение</div>';
		}
		if(($row_list["id_signed0"]!=0)and($row_list["id_signed1"]==0)and($row_list["signedd_nariad"]==0)and($slyjj!=0))
		{
			echo'<div class="status_nana">подписан на согласование</div>';
		}
		if(($row_list["id_signed0"]!=0)and($row_list["id_signed1"]!=0)and($row_list["signedd_nariad"]==0)and($slyjj!=0))
		{
			echo'<div class="status_nana">подписан на утверждение</div>';
		}	
	
		if(($row_list["id_signed0"]==0)and($row_list["id_signed1"]!=0)and($row_list["signedd_nariad"]==0)and($slyjj!=0))
		{
			echo'<div class="status_nana">подписан на утверждение</div>';
		}			
		if(($row_list["signedd_nariad"]==1))
		{
			echo'<div class="status_nana">утвержден</div>';
		}		
	}
	
		if(($row_list["signedd_nariad"]==1)and(($role->permission('Печать наряда','R'))or($sign_admin==1)))
	{
	   //утвержден проведен
	   echo'<a target="_blank" href="finery/print/'.$_GET["id"].'/" data-tooltip="Печатать наряд" class="user_soz naryd_print"></a>';	
	}
	
	
	//}
	//проверить что кнопку можно выводить пользователю добавить в наряд
	if((isset($_GET["id"]))and(sign_naryd_level($link,$id_user,$sign_level,$_GET["id"],$sign_admin)))
	{
	  echo'<a href="prime/'.$row_list["id_object"].'/add/'.$_GET['id'].'/" data-tooltip="добавить работы" class="add_work_nary"><i></i></a>';
	}
    
	if(($sign_level==1)and($sign_admin!=1))
	{	
		//прораб
		//сохранить
		//подписать
		//подписано
		
			
	
		if(($row_list["ready"]==1)and($podpis==1))
	    {
		 //все заполнено и не подписано им или выше	
		echo'<form id="lalala_pod_form" action="finery/sign/'.$_GET["id"].'/" style=" padding:0; margin:0;" method="post" enctype="multipart/form-data">
  <input name="tk_sign" value="'.token_access_compile($_GET['id'],'sign_naryd_plus',$secret).'" type="hidden">
</form>';	
          echo'<div class="save_button pod_nar pod_pro"><i>Подписать</i></div><div style="display:none;" class="save_button add_nar"><i>Сохранить</i></div>';
	 	   if((isset($stack_error))and((count($stack_error)!=0)))
           {	
		      echo'<div class="error_text_add">Не все поля заполнены для сохранения</div>';	
		   } else
		   {
			 echo'<div style="display:none;" class="error_text_add"></div>';  
		   }
	    }	
		if(($row_list["ready"]==0)and($podpis==1))
	    {
		 //все заполнено и не подписано им или выше	
          echo'<div class="save_button add_nar"><i>Сохранить</i></div>';
		  if((isset($stack_error))and((count($stack_error)!=0)))
          {	
		      echo'<div class="error_text_add">Не все поля заполнены для сохранения</div>';	
		  } else
		  {
			 echo'<div style="display:none;" class="error_text_add"></div>';  
		  }	
	    }	
		/*
		if(($podpis==0)and($row_list["signedd_nariad"]==0))
		{
			echo'<div class="save_button green_nar"><i>Подписан</i></div><div class="error_text_green">Не допускается изменения в наряде</div>';	
		}
		*/
		
	}
	if(($sign_level==2)and($sign_admin!=1))
	{	
		//начальник участка
		//сохранить
		//утвердить - если все заполнено и нет служебных записок
		//согласовать - если все заполнено но есть служебные записки
		//снять подпись снизу - если не он сам создатель наряда и не утверждено и не согласовано им или выше
		
		

		//echo($slyjj);
		
		if(($row_list["ready"]==1)and($podpis==1))
	    {
		 //все заполнено и не подписано им или выше	
            if($slyjj==0)
			{
			echo'<form id="lalala_seal_form" action="finery/seal/'.$_GET["id"].'/" style=" padding:0; margin:0;" method="post" enctype="multipart/form-data">
  <input name="tk_sign" value="'.token_access_compile($_GET['id'],'seal_naryd_xx',$secret).'" type="hidden">
</form>';	
			echo'<div class="save_button pod_nar ut_nar"><i>Утвердить</i></div><div style="display:none;" class="save_button add_nar"><i>Сохранить</i></div>';
			} else
			{
			echo'<form id="lalala_pod_form" action="finery/sign/'.$_GET["id"].'/" style=" padding:0; margin:0;" method="post" enctype="multipart/form-data">
  <input name="tk_sign" value="'.token_access_compile($_GET['id'],'sign_naryd_plus',$secret).'" type="hidden">
</form>';	
			echo'<div class="save_button pod_nar sog_nar sogl_pro"><i>Согласовать</i></div><div style="display:none;" class="save_button add_nar"><i>Сохранить</i></div>';	
			}
	 	   if((isset($stack_error))and((count($stack_error)!=0)))
           {	
		      echo'<div class="error_text_add">Не все поля заполнены для сохранения</div>';	
		   } else
		   {
			 echo'<div style="display:none;" class="error_text_add"></div>';  
		   }
	    }

		if(($row_list["ready"]==0)and($podpis==1))
	    {
		 //все заполнено и не подписано им или выше	
          echo'<div class="save_button add_nar"><i>Сохранить</i></div>';
		  if((isset($stack_error))and((count($stack_error)!=0)))
          {	
		      echo'<div class="error_text_add">Не все поля заполнены для сохранения</div>';	
		  } else
		  {
			 echo'<div style="display:none;" class="error_text_add"></div>';  
		  }	
	    }	
		
		//echo($niz_podpis);
		//echo($niz_podpis);
		if(($niz_podpis!=-1)and($podpis==1))
		{
			//cнять подпись
			echo'<form id="lalala_shoot_form" action="finery/shoot/'.$_GET["id"].'/" style=" padding:0; margin:0;" method="post" enctype="multipart/form-data">
  <input name="tk_sign" value="'.token_access_compile($_GET['id'],'shoot_naryd_user',$secret).'" type="hidden">
</form>';	
			echo'<div class="save_button pod_del shoot"><i>Снять подпись</i></div>';
		}

		
	}	
	if(($sign_level==3)and($sign_admin!=1))
	{	
		//главный инженер
		//сохранить
		//утвердить - если он согласен со всеми служебными записками
		//снять подпись снизу - если не он сам создатель наряда и не не утвержено
		
		//echo($niz_podpis);
		
		
			
		if(($row_list["ready"]==1)and($podpis==1))
	    {
		 //все заполнено и не подписано им или выше	
            if(decision_memo($link,$_GET["id"])==0)
			{
			echo'<form id="lalala_seal_form" action="finery/seal/'.$_GET["id"].'/" style=" padding:0; margin:0;" method="post" enctype="multipart/form-data">
  <input name="tk_sign" value="'.token_access_compile($_GET['id'],'seal_naryd_xx',$secret).'" type="hidden">
</form>';	
			echo'<div class="save_button pod_nar ut_nar"><i>Утвердить</i></div><div style="display:none;" class="save_button add_nar"><i>Сохранить</i></div>';
			} else
			{
			echo'<div class="save_button add_nar"><i>Сохранить</i></div>';	
			}
	 	   if((isset($stack_error))and((count($stack_error)!=0)))
           {	
		      echo'<div class="error_text_add">Не все поля заполнены для сохранения</div>';	
		   } else
		   {
			 echo'<div style="display:none;" class="error_text_add"></div>';  
		   }
	    }	
			
		
		if(($row_list["ready"]==0)and($podpis==1))
	    {
		 //все заполнено и не подписано им или выше	
          echo'<div class="save_button add_nar"><i>Сохранить</i></div>';
		  if((isset($stack_error))and((count($stack_error)!=0)))
          {	
		      echo'<div class="error_text_add">Не все поля заполнены для сохранения</div>';	
		  } else
		  {
			 echo'<div style="display:none;" class="error_text_add"></div>';  
		  }	
	    }		
			
			
		if(($niz_podpis!=-1)and($podpis==1))
		{
			//cнять подпись
			echo'<form id="lalala_shoot_form" action="finery/shoot/'.$_GET["id"].'/" style=" padding:0; margin:0;" method="post" enctype="multipart/form-data">
  <input name="tk_sign" value="'.token_access_compile($_GET['id'],'shoot_naryd_user',$secret).'" type="hidden">
</form>';	
			echo'<div class="save_button pod_del shoot"><i>Снять подпись</i></div>';
		}		
		
		
	}		
	if($sign_admin==1)
	{
	   //директор
	   //сохранить
	   //утвердить
	   //распровести
	   if($podpis==0)
	   {
	     echo'<div class="save_button rasp_nar"><i>Распровести</i></div>';	
		   echo'<form id="lalala_disband_form" action="finery/disband/'.$_GET["id"].'/" style=" padding:0; margin:0;" method="post" enctype="multipart/form-data">
  <input name="tk_sign" value="'.token_access_compile($_GET['id'],'disband_naryd_admin',$secret).'" type="hidden">
</form>';	
	   }
		
	
		if(($row_list["ready"]==1)and($podpis==1))
	    {
		 //все заполнено и не подписано им или выше	
            if(decision_memo($link,$_GET["id"])==0)
			{
				echo'<form id="lalala_seal_form" action="finery/seal/'.$_GET["id"].'/" style=" padding:0; margin:0;" method="post" enctype="multipart/form-data">
  <input name="tk_sign" value="'.token_access_compile($_GET['id'],'seal_naryd_xx',$secret).'" type="hidden">
</form>';
			echo'<div class="save_button pod_nar ut_nar"><i>Утвердить</i></div><div style="display:none;" class="save_button add_nar"><i>Сохранить</i></div>';
			} else
			{
			echo'<div class="save_button add_nar"><i>Сохранить</i></div>';	
			}
	 	   if((isset($stack_error))and((count($stack_error)!=0)))
           {	
		      echo'<div class="error_text_add">Не все поля заполнены для сохранения</div>';	
		   } else
		   {
			 echo'<div style="display:none;" class="error_text_add"></div>';  
		   }
	    }	
		
		
		
		if(($row_list["ready"]==0)and($podpis==1))
	    {
		 //все заполнено и не подписано им или выше	
          echo'<div class="save_button add_nar"><i>Сохранить</i></div>';
		  if((isset($stack_error))and((count($stack_error)!=0)))
          {	
		      echo'<div class="error_text_add">Не все поля заполнены для сохранения</div>';	
		  } else
		  {
			 echo'<div style="display:none;" class="error_text_add"></div>';  
		  }	
	    }		
			
			
		if(($niz_podpis!=-1)and($podpis==1))
		{
			//cнять подпись
			echo'<form id="lalala_shoot_form" action="finery/shoot/'.$_GET["id"].'/" style=" padding:0; margin:0;" method="post" enctype="multipart/form-data">
  <input name="tk_sign" value="'.token_access_compile($_GET['id'],'shoot_naryd_user',$secret).'" type="hidden">
</form>';	
			echo'<div class="save_button pod_del shoot"><i>Снять подпись</i></div>';
		}		
		
		
		
	}

include_once $url_system.'module/notification.php';
?>
	</div></div>
	