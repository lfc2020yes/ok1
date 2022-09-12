<?
session_start();
$url_system=$_SERVER['DOCUMENT_ROOT'].'/'; include_once $url_system.'module/config.php'; include_once $url_system.'module/function.php'; include_once $url_system.'login/function_users.php'; initiate($link); include_once $url_system.'module/access.php';


$active_menu='settings';  // в каком меню



//правам к просмотру к действиям
$hie = new hierarchy($link,$id_user);
//echo($id_user);
$hie_object=array();
$hie_town=array();
$hie_kvartal=array();
$hie_user=array();	
$hie_object=$hie->obj;
$hie_kvartal=$hie->id_kvartal;
$hie_town=$hie->id_town;
$hie_user=$hie->user;

//узнаем хозяин ли это программы

$sign_level=$hie->sign_level;
$sign_admin=$hie->admin;


$role->GetColumns();
$role->GetRows();
$role->GetPermission();
//правам к просмотру к действиям
//$user_send_new=array();


//проверка адреса сайта на существование такой страницы
//проверка адреса сайта на существование такой страницы
//проверка адреса сайта на существование такой страницы
//      /invoices/add/
//    0    1      2  
$echo_r=1; //выводить или нет ошибку 0 -нет
$error_header=0;
$url_404=$_SERVER['REQUEST_URI'];
//echo($url_404);
$D_404 = explode('/', $url_404);

if (strripos($url_404, 'index.php') !== false) {
   header404(1,$echo_r);	
}

//**************************************************
if (( count($_GET) != 1 )and( count($_GET) != 0 ) )
{
   header404(2,$echo_r);		
}


if((!$role->permission('Настройки','R'))and($sign_admin!=1))
{
  header404(3,$echo_r);
}
/*
if((!$role->permission('Настройки','U'))and($system!=2))
{
  header404(3,$echo_r);
}
*/

$result_url=mysql_time_query($link,'select A.* from r_user as A where A.id="'.$id_user.'"');
        $num_results_custom_url = $result_url->num_rows;
        if($num_results_custom_url==0)
        {
           header404(5,$echo_r);
		} else
		{
			$row_list = mysqli_fetch_assoc($result_url);
		}




if($error_header==404)
{
	include $url_system.'module/error404.php';
	die();
}

//проверка адреса сайта на существование такой страницы
//проверка адреса сайта на существование такой страницы
//проверка адреса сайта на существование такой страницы



if((isset($_POST['save_users']))and($_POST['save_users']==902))
{
	$token=htmlspecialchars($_POST['tk']);
	$id=htmlspecialchars($id_user);
	
	
	//токен доступен в течении 120 минут
    if(token_access_new($token,'save_setting',$id,"rema"))
    {
		//echo("!");
	//возможно проверка что этот пользователь это может делать
	 if (($role->permission('Настройки','U'))or($sign_admin==1))
	 {
		 
		$result_url=mysql_time_query($link,'select A.* from r_user as A where A.id="'.htmlspecialchars(trim($id_user)).'"');
        $num_results_custom_url = $result_url->num_rows;
        if($num_results_custom_url!=0)
        {

			$row_list = mysqli_fetch_assoc($result_url);
			//статус еще не забронировано
		 
	$stack_error = array();  // общий массив ошибок
	$stack_offers = array();  // общий массив ошибок для предложений				
    $flag_podpis=0;  //0 - все заполнено можно подписывать ready делать = 1
			
				
	//print_r($stack_error);
	


if((htmlspecialchars(trim($_POST['name_b']))==''))
{
  array_push($stack_error, "name_b"); 
}
if((htmlspecialchars(trim($_POST['name_b1']))==''))
{
  array_push($stack_error, "name_b1"); 
}
if((htmlspecialchars(trim($_POST['name_b1x']))==''))
{
  array_push($stack_error, "name_b1x");
}
if((htmlspecialchars(trim($_POST['login_b']))==''))
{
  array_push($stack_error, "login_b"); 
}	else
{
	if($_POST['login_b']!=$row_list["login"])
	{
	$result_txs12=mysql_time_query($link,'Select a.id from r_user as a where a.login="'.htmlspecialchars(trim($_POST['login_b'])).'"');
      
	    if($result_txs12->num_rows!=0)
	    {   
			array_push($stack_error, "login_b"); 
		} 
		
		if((htmlspecialchars(trim($_POST['password_b']))==''))
{
  array_push($stack_error, "password_b"); 
}else
		{
			if(strlen($_POST['password_b'])<3)
			{
				  array_push($stack_error, "password_b"); 
			}
		}
		
	} else
	{
		if(htmlspecialchars(trim($_POST['password_b']))!='')
		{
			
			if(strlen($_POST['password_b'])<3)
			{
				  array_push($stack_error, "password_b"); 
			}
			
		}
	}
	
}		 
		 
		 				
			
		//print_r ($stack_error);	
	    if(count($stack_error)==0)
		{
		   //ошибок нет
		   //сохраняем наряд
			 $today[0] = date("y.m.d"); //присвоено 03.12.01
             $today[1] = date("H:i:s"); //присвоит 1 элементу массива 17:16:17

	         $date_=$today[0].' '.$today[1];

			$sql_password='';
			 if(($_POST['login_b']!=$row_list["login"])or($_POST['password_b']!=''))
	         {
				 //изменяет логин или пароль
				 $sql_password=',password="'.password_crypt_x(htmlspecialchars($id_user),htmlspecialchars(trim($_POST['password_b'])),htmlspecialchars(trim($_POST['login_b']))).'"';
			 }
			/*
			$enabled=1;
			if($_POST['radio_sms']==0)
			{
				$enabled=0;
			}
*/
            $phone_base=explode(" ",htmlspecialchars(trim($_POST['name_b1'])));
            $phone_base1=explode("-",$phone_base[2]);

            $phone_end=	$phone_base[1][1].$phone_base[1][2].$phone_base[1][3].$phone_base1[0].$phone_base1[1].$phone_base1[2];
			
			mysql_time_query($link,'update r_user set 
name_user="'.htmlspecialchars($_POST['name_b']).'",
name_small="'.htmlspecialchars($_POST['name_b1x']).'",
phone="'.$phone_end.'",login="'.htmlspecialchars(trim($_POST['login_b'])).'" '.$sql_password.' where id = "'.htmlspecialchars($id_user).'"');
			
			
			//проверяем уведомления
			mysql_time_query($link,'delete FROM a_notification_user_option where id_user="'.ht($id_user).'"');
//к каким категориям относится
            if(isset($_POST['notis'])) {
                $subi = $_POST['notis'];
                for ($i = 0; $i < (count($subi['type'])); $i++) {

                    if ((is_numeric($subi['type'][$i])) and ($subi['val'][$i] == '1') and ($subi['type'][$i] != '0')) {
                        mysql_time_query($link, 'INSERT INTO a_notification_user_option (id_user,number_type,val) VALUES ("' . ht($id_user) . '","' . ht($subi['type'][$i]) . '","1")');
                    }
                }
            }
			
		
			
  //добавляем уведомления о новом событии в системе
  //добавляем уведомления о новом событии в системе
  //добавляем уведомления о новом событии в системе	
//отправляем Всем кто хочет и кому можно получать уведомление об добавление новой заявки по тендеру

/*
if($system==0)
{*/
//если обычный пользователь системы
/*
			$ena='включены';
			if($row_list['sms_alert']==0)
			{
				$ena='выключены';
			}			

			$ena1='включены';
			if($_POST['radio_sms']==0)
			{
				$ena1='выключены';
			}				
	*/
  $text_not='<a href="users/'.$id_user.'/">Пользователь №'.$id_user.'</a> - '.$row_list['name_user'].' был изменен. Старые данные - '.$row_list['name_user'].'  ('.$row_list['phone'].'). Логин - '.$row_list['login'].'.  Новые данные - '.$_POST['name_b'].'  ('.$_POST['name_b1'].'). Логин - '.$_POST['login_b'].'.';
/*
$user_send_new= array();	
$user_send_new=array_merge(UserNotNumber(7,$link));
			
rm_from_array(0,$user_send_new);
rm_from_array($id_user,$user_send_new);			
$user_send_new= array_unique($user_send_new);

$mass_ei = users_hierarchy_plus_disabled($id_user, $link);
rm_from_array($id_user, $mass_ei);
$mass_ei = array_unique($mass_ei);

$end_mass=exception_role($user_send_new,$mass_ei);

notification_send_admin( $text_not,$end_mass,0,$link);
*/
//чьи изменения - кто делает - сообщение - номер уведомления в системе
notif_role_list($id_user,$id_user,$text_not,7);


			
//}
	
			 
  //добавляем уведомления о новом событии в системе
  //добавляем уведомления о новом событии в системе
  //добавляем уведомления о новом событии в системе				
			
			
			 header("Location:".$base_usr."/settings/?a=save");	
			 die();
		   
		}
			
	 }
}

}
	
	
}






/*
$secret=rand_string_string(4);
if(!isset($_SESSION['rema']))
{
    $_SESSION['rema'] = $secret;
} else
{
    $secret=$_SESSION['rema'];
}
*/






//проверить и перейти к последней себестоимости в которой был пользователь




$status_edit='';
$status_class='';
$status_edit1='';
if (!$role->permission('Настройки','U'))
{	
   $status_edit='readonly';	
   $status_edit1='disabled';
   $status_class='grey_edit';		
}



include_once $url_system.'template/html.php'; include $url_system.'module/seo.php';

if($error_header!=404){ SEO('setting_view','','','',$link); } else { SEO('0','','','',$link); }

include_once $url_system.'module/config_url.php'; include $url_system.'template/head.php';
?>
</head><body>
<?
echo'<div class="alert_wrapper"><div class="div-box"></div></div>';
include_once $url_system.'template/body_top.php';	
?>

<div class="container">
<?


		if ( isset($_COOKIE["iss"]))
		{
          if($_COOKIE["iss"]=='s')
		  {
			  echo'<div class="iss iss1 small">';
		  } else
		  {
			  echo'<div class="iss iss1 big">';
		  }
		} else
		{
			echo'<div class="iss iss1 small">';
		}


	
?>




<div class="left_block">
  <div class="content">

<?
                $act_='display:none;';
	            $act_1='';
	            if(cookie_work('it_','on','.',60,'0'))
	            {
		            $act_='';
					$act_1='on="show"';
	            }

	  include_once $url_system.'template/top_setting_view.php';

	  	  echo'<form id="lalala_add_form" class="my_n" style=" padding:0; margin:0;" method="post" enctype="multipart/form-data"><input name="save_users" value="902" type="hidden">';

	  	$token=token_access_compile($id_user,'save_setting',$secret);

		echo'<input type="hidden" value="'.$token.'" name="tk">';
	  
	 echo'<div id="fullpage" class="margin_60  form_54_booking">';
	?>
	<div class="section" id="section0">
	<div class="height_100vh">
	
	
		<div class="oka_block_2019">													

<?
echo'<div class="line_mobile_blue">'.$menu_h2[$menu_id_h2].'</div>';


?>
				
			
			
	<div class="div_ook">
	
	<?		
//если форма вернулась значит что то пошло не так. выводим сообщение об этом		
if((isset($_POST['save_users']))and($_POST['save_users']==902))
{
?>
<div class="help_div da_book1 da_book_red js-hide-help"><div class="not_boolingh"></div><span class="h5"><span>Что-то пошло не так. Пожалуйста попробуйте ещё раз. Либо поменяйте необходимые данные</span></span></div>
<script type="text/javascript">
$(function (){ setTimeout ( function () { $('.js-hide-help').slideUp("slow");	}, 5000 );});
</script>	
<?
}	else
{
	
  if (( isset($_GET["a"]))and($_GET["a"]=='save'))
    {
echo'<div class="help_div da_book1 js-hide-help"><div class="not_boolingh"></div><span class="h5"><span>Ваши настройки в системе успешно сохранены.</span></span></div>';
	?>
	
	<script type="text/javascript">
$(function (){ 
setTimeout ( function () { 
	
	$('.js-hide-help').slideUp("slow");	var title_url=$(document).attr('title'); var url=window.location.href; var url1 = removeParam("a", url); History.pushState('', title_url, url1);					 
						 
	}, 5000 );
});
</script>

	
	<?
		
	} else
	{
	
	echo'<div class="help_div da_book1"><div class="not_boolingh"></div><span class="h5"><span>Вас приветствует система управления электронной торговой
площадкой. Версия - '.$vprogramm.'. В этом разделе настроек вы можете изменить ваш пароль и логин, полученные вам по умолчанию. Загрузить профиль для узнаваемости, включить смс уведомления.</span></span></div>';
	}
	
}

		
		
	echo'<div class="ll_200"><div class="l_left">';	
		
	echo'<div class="ok-block-input-2019"><div class="ok-input-title-2019 '.iclass_("name_b",$stack_error,"error_formi_2019").'"><label>Ваше ФИО</label><span class="h_input">Ваше ФИО</span><i></i><span class="ok-i-2019"><input '.$status_edit.' name="name_b" id="name_b" placeholder="Имя пользователя в системе" class="input_new_2019 '.iclass_("name_b",$stack_error,"error_formi").'" autocomplete="off" type="text" value="'.ipost_($_POST['name_b'],$row_list["name_user"]).'"><div class="div_new_2019"><hr class="one"><hr class="two"></div></span></div></div>';                                                                                   ?>

        <?
        echo'<div class="ok-block-input-2019"><div class="ok-input-title-2019 '.iclass_("name_b1x",$stack_error,"error_formi_2019").'"><label>Краткое имя</label><span class="h_input">Краткое имя</span><i></i><span class="ok-i-2019"><input '.$status_edit.' name="name_b1x" id="name_b1x" placeholder="Номер для связи и уведомлений" class="input_new_2019 '.iclass_("name_b1x",$stack_error,"error_formi").'" autocomplete="off" type="text" value="'.ipost_($_POST['name_b1x'],$row_list["name_small"]).'"><div class="div_new_2019"><hr class="one"><hr class="two"></div></span></div></div>';                                                                                   ?>


        <?
	echo'<div class="ok-block-input-2019"><div class="ok-input-title-2019 '.iclass_("name_b1",$stack_error,"error_formi_2019").'"><label>Телефон для связи</label><span class="h_input">Телефон для связи</span><i></i><span class="ok-i-2019"><input '.$status_edit.' name="name_b1" id="name_b1" placeholder="Номер для связи и уведомлений" class="input_new_2019 phone_us1 '.iclass_("name_b1",$stack_error,"error_formi").'" autocomplete="off" type="tel" value="'.ipost_($_POST['name_b1'],$row_list["phone"]).'"><div class="div_new_2019"><hr class="one"><hr class="two"></div></span></div></div>';                                                                                   ?>                                                     	
		
    </div>
	 <div class="l_right">	
	 <div class="l_profile">Ваш профиль</div><div class="l_photo">		 		
	 <?
	 
	  $filename=$url_system.'img/users/'.$id_user.'_100x100.jpg';
if (file_exists($filename)) {	  

echo'<div class="cover--2"><img src="img/users/'.$id_user.'_100x100.jpg?a='.$row_list["img_xah"].'"></div>';
} else
{
//echo'<div class="users_rule" style="padding-left:22px;">';
	echo'<div class="cover--2"><img class="img-c" src="img/users/0_100x100.jpg"></div>';
}
	 //форма отправки файла

	 $top_dd='<form method="post" enctype="multipart/form-data"  class="form_up1 none" id="upload_sc_'.htmlspecialchars(trim($id_user)).'" id_sc="'.htmlspecialchars(trim($id_user)).'" name="upload'.htmlspecialchars(trim($id_user)).'"><input class="sc_sc_loos2" type="file" name="myfiles'.htmlspecialchars(trim($id_user)).'"></form>';

		 
	 
   echo'<i class="invoice_upload" id_upload="'.htmlspecialchars(trim($id_user)).'"  data-tooltip="загрузить фото"></i></div>';
		 
	
	        //загрузчиик
			echo'<div class="loaderr_scan scap_load_'.htmlspecialchars(trim($id_user)).'" style="width:100%"><div class="scap_load__" style="width: 0%;"></div></div>';		 
		 
		 echo'</div>';
		 ?>
</div>
		 			 		
	
<!--<span class="add_bo">Добавление новой заявки</span>	-->
	
		
		  
	<!--<span class="add_mobile_h"><label>Добавление компании<label></span>-->  
	
	<div class="help_div da_book1"><div class="not_boolingh"></div><span class="h5"><span>Логин - уникальный в системе, не менее 3 символов, должен начинаться с буквы. Пароль - не менее 3 символов. Только на английской раскладке</span></span></div>
				
	
	
    <?
	
	echo'<div class="ok-block-input-2019"><div class="ok-input-title-2019 '.iclass_("login_b",$stack_error,"error_formi_2019").'"><label>Логин Пользователя</label><span class="h_input">Логин Пользователя</span><i></i><span class="ok-i-2019"><input '.$status_edit.' name="login_b" id="login_b" placeholder="Логин в системе" class="input_new_2019 no_uppercase '.iclass_("login_b",$stack_error,"error_formi").'" autocomplete="off" type="text" value="'.ipost_($_POST['login_b'],$row_list["login"]).'"><div class="div_new_2019"><hr class="one"><hr class="two"></div></span></div></div>';                                                                                   ?>  		 			 		
		 			 			 			 			 			 		
    <?                                                            
	echo'<div class="ok-block-input-2019"><div class="ok-input-title-2019 '.iclass_("password_b",$stack_error,"error_formi_2019").'"><label>Пароль для входа</label><span class="h_input">Пароль для входа</span><i></i><span class="ok-i-2019"><input name="password_b" id="password_b" placeholder="Пароль" class="input_new_2019 '.iclass_("password_b",$stack_error,"error_formi").'" autocomplete="off" type="password" value=""><div class="div_new_2019"><hr class="one"><hr class="two"></div></span></div></div>';                                                                                   ?>                                                       
   
   
   </div>                        	                        	                        
	<?
echo'<div class="div_ook_grei">';                                                                                                       
                                                                                                                                                                                                                                                                                                               
		          
	          	          	$en_=0;
	$en_s='';
	

			   if(isset($_POST['radio_sms']))
			   {
			   if($_POST['radio_sms']==1)
			   {
		$en_=1;
		$en_s='active_radio-new';
			   }
			   } else
			   {				   
				   	if($row_list["sms_alert"]==1)
	{
		$en_=1;
		$en_s='active_radio-new';
	}
			   }
	?>
<div class="ok-block-input ok-2019">                    
  <?
			echo'<div class="form-panel">
	<div class="na-100" style="padding: 0px; padding-top:10px;">';
		echo'<span class="h4-f">Ваши уведомления</span>';
		echo'</div></div>';
				
				echo'<div class="form-panel">';	
	
	
	$su_t=array();	
		if(!isset($_POST['notis']['type'][0]))
		{	
	$result_66 = mysql_time_query( $link, 'Select b.number_type from a_notification_user_option as b where b.val=1 and b.id_user="' . ht($id_user) . '"' );
if ( $result_66 ) {
  while ( $row_66 = mysqli_fetch_assoc( $result_66 ) ) {

    array_push( $su_t, $row_66[ "number_type" ] );

  }
}
		} else
		{
			
$sub_type=$_POST['notis'];
for ($i = 0; $i < (count($sub_type['type'])); $i++){
	
if($sub_type['val'][$i]=='1')
{
	array_push( $su_t, $sub_type['type'][$i] );
}
	
	
}			
			
		}
	
	
$result_66 = mysql_time_query( $link, 'SELECT a.id_number,a.name FROM a_notification_type AS a,a_notification_type_role AS b, r_user AS c WHERE a.id_number=b.number_type AND b.id_role=c.id_role AND c.id="'.ht($id_user).'" ORDER BY a.id' );
if ( $result_66 ) {
  $i = 0;
  while ( $row_66 = mysqli_fetch_assoc( $result_66 ) ) {
	  
	  echo'<div class="na-50" style="padding: 0px;">';	

echo'<div class="input-choice-click-left js-checkbox-group" style="margin-top: 0px; background-color: transparent;">
<div class="choice-head">'.$row_66["name"].'</div>
<div class="choice-radio"><div class="center_vert1">';
	if(in_array($row_66["id_number"], $su_t))
	{
	echo'<i class="active_task_cb"></i><input name="notis[type][]" value="'.$row_66["id_number"].'" type="hidden"><input name="notis[val][]" value="1" type="hidden">';	
	} else
	{
	echo'<i></i><input name="notis[type][]" value="'.$row_66["id_number"].'" type="hidden"><input name="notis[val][]" value="0" type="hidden">';			
	}
	  
	  
echo'</div></div></div></div>';		
	
  
	  
	  
  }
}
	
	
	

	
	echo'</div>';	
  ?>
</div>    
        	          	          
                                
	        </div>	                              
	                                                                                          
	        
	        
	  	 </div>
	
	
	
	
	
</div>	         
	             
	                     
	 </div>
</div> 
  </form>
  
  <?  
  
  echo $top_dd;

 ?> 
  
	  </div>
	  <?
include_once $url_system.'template/left.php';
?>

</div>
</div><!--<script src="Js/rem.js" type="text/javascript"></script>-->
<?
echo'<script type="text/javascript">var b_co=\''.$b_co.'\'</script>';
echo'<script type="text/javascript">var b_cm=\''.$b_cm.'\'</script>';
?>
<div id="nprogress">
<div class="bar" role="bar" >
<div class="peg"></div>
</div>

</div>
</body></html>
<script type="text/javascript">
	$(document).ready(function() {
	/*
	$('#fullpage').fullpage({
		//options here
		scrollOverflow:true
	});
*/

		input_2019();

});
</script>
