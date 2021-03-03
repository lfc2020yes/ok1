<?
session_start();
$url_system=$_SERVER['DOCUMENT_ROOT'].'/'; include_once $url_system.'module/config.php'; include_once $url_system.'module/function.php'; include_once $url_system.'login/function_users.php'; initiate($link); include_once $url_system.'module/access.php';


$active_menu='booking';  // в каком меню



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

$sign_level=$hie->sign_level;
$sign_admin=$hie->admin;


$role->GetColumns();
$role->GetRows();
$role->GetPermission();
//правам к просмотру к действиям
//$user_send_new=array();


if((isset($_POST['save_booking']))and($_POST['save_booking']==2))
{
	$token=htmlspecialchars($_POST['tk']);
	$id=htmlspecialchars($_GET['id']);
	
	
	//токен доступен в течении 120 минут
	if(token_access_yes($token,'save_bookings',$id,120))
    {
		//echo("!");
	//возможно проверка что этот пользователь это может делать
	 if (($role->permission('Заявки','A'))or($sign_admin==1))
	 {
		 
		$result_url=mysql_time_query($link,'select A.* from booking as A where A.id="'.htmlspecialchars(trim($_GET['id'])).'"');
        $num_results_custom_url = $result_url->num_rows;
        if($num_results_custom_url!=0)
        {

			$row_list = mysqli_fetch_assoc($result_url);
			//статус еще не забронировано
			if(($row_list["status"]!=3)and($row_list["status"]!=6))
			{	 
		 
		 
	$stack_error = array();  // общий массив ошибок
	$stack_offers = array();  // общий массив ошибок для предложений				
    $flag_podpis=0;  //0 - все заполнено можно подписывать ready делать = 1
			
				
	//print_r($stack_error);
			
	if((htmlspecialchars(trim($_POST['sourse_b']))=='')or(htmlspecialchars(trim($_POST['sourse_b']))=='0'))
{
  array_push($stack_error, "sourse_b"); 
  $flag_podpis++; 	
}
	$sql_ob='';			
	if((isset($_POST["dot_b_op"]))and((htmlspecialchars(trim($_POST['dot_b_op']))=='')or(htmlspecialchars(trim($_POST['dot_b_op']))=='0'))) { array_push($stack_error, "dot_b_op"); $flag_podpis++; 	   }
	
	//вдруг он не может этот объект поставить проверим входит ли он в его привилегии
	if(isset($_POST["dot_b_op"]))
	{
							   
	                if(array_search($_POST["dot_b_op"],$hie_object) === false) 
	                {
						array_push($stack_error, "dot_b_op"); $flag_podpis++; 
					}
		if((htmlspecialchars(trim($_POST['dot_b_op']))!='')and(htmlspecialchars(trim($_POST['dot_b_op']))!='0'))
		{
		  $sql_ob=',id_object="'.htmlspecialchars(trim($_POST["dot_b_op"])).'"';
		}
		
	}
				
	if((htmlspecialchars(trim($_POST['name_b']))==''))
{
  array_push($stack_error, "name_b"); 
  $flag_podpis++; 	
}				
				
if((htmlspecialchars(trim($_POST['client_new1_search']))==0))
{			
	
				
if((htmlspecialchars(trim($_POST['phone_b']))==''))
{
  //array_push($stack_error, "phone_b"); 
  $flag_podpis++; 	
}	
}

if((htmlspecialchars(trim($_POST['client_new1_search']))==0))
{					
				
if((htmlspecialchars(trim($_POST['name_client_b']))==''))
{
  array_push($stack_error, "name_client_b"); 
  $flag_podpis++; 	
}	
} else
{
		if((htmlspecialchars(trim($_POST['id_search_client1']))==0))
{
  array_push($stack_error, "name_client_id");
			 $flag_podpis++; 
}
}
				
				
if((htmlspecialchars(trim($_POST['date_b']))==''))
{
  array_push($stack_error, "date_b"); 
  $flag_podpis++; 	
}		 
		 
	    //есть ли ошибки по заполнению
		//print_r($stack_error);
				
				
			
	    if(count($stack_error)==0)
		{
		   //ошибок нет
		   //сохраняем наряд
			 $today[0] = date("y.m.d"); //присвоено 03.12.01
             $today[1] = date("H:i:s"); //присвоит 1 элементу массива 17:16:17

	         $date_=$today[0].' '.$today[1];
			
			
			$id_client=0;
			if((htmlspecialchars(trim($_POST['client_new1_search']))==1))
             {	
				$id_client=htmlspecialchars(trim($_POST['id_search_client1']));
			}
		   
			mysql_time_query($link,'update booking set title="'.htmlspecialchars($_POST['name_b']).'"'.$sql_ob.',datetime="'.htmlspecialchars($_POST['date_b']).'",id_booking_sourse="'.htmlspecialchars(trim($_POST['sourse_b'])).'",id_client="'.$id_client.'",phone="'.htmlspecialchars(trim($_POST['phone_b'])).'",name="'.htmlspecialchars($_POST['name_client_b']).'",comment="'.htmlspecialchars($_POST['comment_b']).'" where id = "'.htmlspecialchars($_GET['id']).'"');	
			
			$works=$_POST['sourse'];
			$count_offers_booking=0;  //количество предложений
			
        foreach ($works as $key => $value) 
	    {
			   //смотрим вдруг было удалено это предложение	 
			   if($value['id']!='') 
			   {
				 /*
				$_POST['sourse'][0]["id"]
				*/		
				$result_tx=mysql_time_query($link,'Select a.id,a.id_booking from booking_offers as a where a.id="'.htmlspecialchars(trim($value['id'])).'"');
                $num_results_tx = $result_tx->num_rows;
	            if($num_results_tx!=0)
	            {  
		           //такое предложение есть
				  
		           $rowx = mysqli_fetch_assoc($result_tx);		
					if($rowx["id_booking"]==$_GET["id"])
					{
						//оно соответствует данной заявки
						$count_offers_booking++;
				   $operator=$value['operator'];
				   $rules=$value['rules'];
				   $hotel=$value['hotel'];
				   $cost=trimc($value['cost']);
				   $date_fly=$value['date_fly'];	
				   $start=$value['start'];
				   $end=$value['end'];
				   $discount=trimc($value['discount']);
				   $proc=trimc($value['proc']);		
					//echo($cost);
					
				   if(($operator==0)or($operator=='')or(!is_numeric($operator))) { $flag_podpis++; array_push($stack_offers, $key."_operator");  }					
				   
				   if(($proc==0)or($proc=='')or(!is_numeric($proc))) { $flag_podpis++; array_push($stack_offers, $key."_proc");  }		
						
				   if((!is_numeric($cost))or($cost<=0)) { $flag_podpis++; array_push($stack_offers, $key."_cost"); }		
				   if($discount=='') { $flag_podpis++; array_push($stack_offers, $key."_discount"); }
				   /*
				   if($start=='') { $flag_podpis++; array_push($stack_offers, $key."_start"); }
				   if($end=='') { $flag_podpis++; array_push($stack_offers, $key."_end"); }
					*/
				   if($date_fly=='') { $flag_podpis++; array_push($stack_offers, $key."_date_fly"); }
				   if($hotel=='') { $flag_podpis++; array_push($stack_offers, $key."_hotel"); }
				   if($rules=='') { $flag_podpis++; array_push($stack_offers, $key."_rules"); }	
						
				   $date_start=explode(" ",htmlspecialchars(trim($start)));
				   $date_start1=explode(".",htmlspecialchars(trim($date_start[0])));		
				   $startx=$date_start1[2].'-'.$date_start1[1].'-'.$date_start1[0].' '.$date_start[1].':00';		
						
				     $date_end=explode(" ",htmlspecialchars(trim($end)));
				   $date_end1=explode(".",htmlspecialchars(trim($date_end[0])));		
				   $endx=$date_end1[2].'-'.$date_end1[1].'-'.$date_end1[0].' '.$date_end[1].':00';			
						
						
				   mysql_time_query($link,'update booking_offers set 
				     id_operator="'.htmlspecialchars($operator).'",
					 rules="'.htmlspecialchars(trim($rules)).'",
					 hotel="'.htmlspecialchars(trim($hotel)).'",
					 cost="'.htmlspecialchars(trim($cost)).'",
					 date_fly="'.htmlspecialchars(trim($date_fly)).'",
					 discount="'.htmlspecialchars(trim($discount)).'",
					 proc="'.htmlspecialchars(trim($proc)).'",
					 start_fly="'.htmlspecialchars(trim($startx)).'", 
					 end_fly="'.htmlspecialchars(trim($endx)).'"
					 
					 where id = "'.htmlspecialchars($value['id']).'"');		
						
				}
				}
			   }
			
		}
	    if((count($stack_offers)==0)and($count_offers_booking!=0)and($flag_podpis==0))
		{
			//нет ошибок по преложениям и есть реальные предложения
			//значит можно забронировать ready=1 делаем
			mysql_time_query($link,'update booking set ready="1" where id = "'.htmlspecialchars($_GET['id']).'"');
		} else
		{
			mysql_time_query($link,'update booking set ready="0" where id = "'.htmlspecialchars($_GET['id']).'"');
		}

		   
		}
			}
	 }
}

}
	
	
}







$secret=rand_string_string(4);
$_SESSION['s_t'] = $secret;	





//проверить и перейти к последней себестоимости в которой был пользователь


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

if (strripos($url_404, 'index_view.php') !== false) {
   header404(1,$echo_r);	
}

//**************************************************
if (( count($_GET) != 1 ) and( count($_GET) != 2 ) )
{
   header404(2,$echo_r);		
}

if((!$role->permission('Заявки','R'))and($sign_admin!=1))
{
  header404(3,$echo_r);
}


$result_url=mysql_time_query($link,'select A.* from booking as A where A.visible=1 and A.id="'.htmlspecialchars(trim($_GET['id'])).'"');
        $num_results_custom_url = $result_url->num_rows;
        if($num_results_custom_url==0)
        {
           header404(5,$echo_r);
		} else
		{
			$row_list = mysqli_fetch_assoc($result_url);
		}
//echo(array_search($row_list["id_object"],$hie_object));
if((array_search($row_list["id_object"],$hie_object) === false)and($sign_admin!=1)) 
{
	   header404(7,$echo_r);
}


if($error_header==404)
{
	include $url_system.'module/error404.php';
	die();
}

//проверка адреса сайта на существование такой страницы
//проверка адреса сайта на существование такой страницы
//проверка адреса сайта на существование такой страницы


$status_edit='';
$status_class='';
$status_edit1='';
if(($row_list["status"]==3)or($row_list["status"]==6))		
{	
   $status_edit='readonly';	
   $status_edit1='disabled';
   $status_class='grey_edit';		
}



include_once $url_system.'template/html.php'; include $url_system.'module/seo.php';

if($error_header!=404){ SEO('booking_view','','','',$link); } else { SEO('0','','','',$link); }

include_once $url_system.'module/config_url.php'; include $url_system.'template/head.php';
?>
</head><body>
<?
include_once $url_system.'template/body_top.php';	
?>

<div class="container">
<?

	
		if ( isset($_COOKIE["iss"]))
		{
          if($_COOKIE["iss"]=='s')
		  {
			  echo'<div class="iss small">';
		  } else
		  {
			  echo'<div class="iss big">';			  
		  }
		} else
		{
			echo'<div class="iss small">';	
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

	  include_once $url_system.'template/top_booking_view.php';

	  	  echo'<form action="booking/'.$_GET["id"].'/save/" id="lalala_add_form" class="my_n" style=" padding:0; margin:0;" method="post" enctype="multipart/form-data"><input name="save_booking" value="2" type="hidden">';
	  
	  	$token=token_access_compile($_GET['id'],'save_bookings',$secret);				
						
		echo'<input type="hidden" value="'.$token.'" name="tk">'; 
	  
	 echo'<div id="fullpage" class="margin_60 margin_0 form_2_booking">';
	?>
	<div class="section" id="section0">
	<div class="height_100vh7">
	
<?
	if($row_list["status"]==6)		
{		

	$result_status21=mysql_time_query($link,'SELECT sum(a.cost) as cost FROM booking_offers AS a WHERE a.id_booking="'.htmlspecialchars(trim($_GET['id'])).'" and a.status=2');	
					 //echo('SELECT a.* FROM r_status AS a WHERE a.numer_status="'.$row1ss["status"].'" and a.id_system=13');
                if($result_status21->num_rows!=0)
                {  
                   $row_status21 = mysqli_fetch_assoc($result_status21);
				} 	

		$result_status22=mysql_time_query($link,'SELECT sum(a.prepaid) as prepaid FROM booking_status_history AS a WHERE a.status=6 and  a.id_booking="'.htmlspecialchars(trim($_GET['id'])).'"');	
					 //echo('SELECT a.* FROM r_status AS a WHERE a.numer_status="'.$row1ss["status"].'" and a.id_system=13');
                if($result_status22->num_rows!=0)
                {  
                   $row_status22 = mysqli_fetch_assoc($result_status22);
				} 
	
	
	
	
	
echo'<div class="oka_block column_flex"><div class="div_ook_grei1 grenn_f">

			<div class="ok-block-inputx">
			 <div class="ok-input-titlex top_okkk">Долг клиента - '.rtrim(rtrim(number_format(($row_status21["cost"]-$row_status22["prepaid"]), 2, '.', ' '),'0'),'.').' руб.</div>
			 <div class="ok-input-titlex top_okkk">Крайний срок - <span class="classredd33">'.date_fik($row_list["date_prepaid"]).'</span></div>
		
			<div class="ok-input-titlex top_okkk click_history_avans" op_uo="'.$row_list["id"].'"><div class="dr_hop">История платежей</div></div>
				
		</div></div></div>	';	
	
	}
	
	?>

	<div class="div_ook">
	
	
<?
	//сообщения после добавление редактирования чего то	
//сообщения после добавление редактирования чего то
//сообщения после добавление редактирования чего то
	
	$echo_help=0;
    if (( isset($_GET["a"]))and($_GET["a"]=='yes'))
    {
echo'<div class="help_div da_book1 js-hide-help"><div class="not_boolingh"></div><span class="h5"><span>Новая заявка добавлена в систему. Осталось добавить к ней ваши предложения.</span></span></div>';
		$echo_help++;
	}
    if (( isset($_GET["a"]))and($_GET["a"]=='save'))
    {
		
		//если можно только позвонить или отказались
		//echo(count($stack_error).'<br>');
		//echo(count($stack_offers).'<br>');
		//echo(count($count_offers_booking).'<br>');
		//echo(count($flag_podpis).'<br>');
		
		//если можно купить
		if((count($stack_offers)==0)and($count_offers_booking!=0)and($flag_podpis==0))
		{
			echo'<div class="help_div da_book1 js-hide-help"><div class="not_boolingh"></div><span class="h5"><span>Ваша заявка готова чтобы ее отметить как купленную.</span></span></div>';
		$echo_help++;
		}
		//echo(count($stack_offers));
		if(((count($stack_error)==0))and(count($stack_offers)!=0))
		{		
echo'<div class="help_div da_book1 da_book_red js-hide-help"><div class="not_boolingh"></div><span class="h5"><span>Что-то пошло не так. Пожалуйста внимательно заполняйте ваши предложения. Поля «возможная скидка» и «наш возможный процент» не требуют точности, но тоже являются ключевыми.</span></span></div>';
		$echo_help++;			
		}
		if(((count($stack_error)==0))and(count($stack_offers)==0)and($flag_podpis==1))
		{		
			echo'<div class="help_div da_book1 js-hide-help"><div class="not_boolingh"></div><span class="h5"><span>Данные по заявке успешно изменены</span></span></div>';
		$echo_help++;		
		}		
		
		//echo(count($stack_offers));
		//если ошибки какие то
		if((count($stack_error)!=0))
		{					
echo'<div class="help_div da_book1 da_book_red js-hide-help"><div class="not_boolingh"></div><span class="h5"><span>Что-то пошло не так. Пожалуйста попробуйте ещё раз. Либо не все ключевые данные заполнены по заявке. Они подсвечиваются красным</span></span></div>';
		$echo_help++;
		}
				
		
	}	
	if($echo_help!=0)
	{
?>
<script type="text/javascript">
$(function (){ 
setTimeout ( function () { 
	
	$('.js-hide-help').slideUp("slow");	var title_url=$(document).attr('title'); var url=window.location.href; var url1 = removeParam("a", url); History.pushState('', title_url, url1);					 
						 
	}, 10000 );
});
</script>
<?	
	}
//сообщения после добавление редактирования чего то	
//сообщения после добавление редактирования чего то
//сообщения после добавление редактирования чего то
	
		
		?>
		
<!--<span class="add_bo">Добавление новой заявки</span>	-->
	
			<div class="ok-block-input">
			  <div class="ok-input-title">Название заявки<i></i></div>
			
			  <span class="ok-i">
        <?
        echo'<input name="name_b" '.$status_edit.' id="name_b" placeholder="Название новой заявки?" class="ok-input '.iclass_("name_b",$stack_error,"error_formi").'" autocomplete="off" type="text" value="'.ipost_($_POST['name_b'],$row_list["title"]).'">';
        ?>
        </span>
	        </div>
	        
			<div class="ok-block-input">
			  <div class="ok-input-title">Комментарий<i></i></div>
			
			  <span class="ok-i">
       
       
       <div class="div_textarea_otziv1" >
			<div class="otziv_add">
                 
                   <?
        echo'<textarea cols="10" rows="1" '.$status_edit.' placeholder="Ваши заметки и комментарии по поводу заявки" id="otziv_area_adaxx" name="comment_b" class="di text_area_otziv no_comment_bill">'.ipost_($_POST['comment_b'],$row_list["comment"]).'</textarea>';
				?>
            </div>      
</div>  
       
       
       
       </span>
        
        <script type="text/javascript"> 
	  $(function (){ 
$('#otziv_area_adaxx').autoResize({extraSpace : 10,onResize: function() {$.fn.fullpage.destroy('All');} });
		  
		  
		  
//$('#otziv_area_adaxx').trigger('keyup');

ToolTip();
});

	</script>
        
	        </div>	        
	        
	        
	  	 </div>
	  	 
	  	      
	  	           
	  	</div>                     
	 </div> 
	 
	     
<div class="section" id="section2">
<div class="height_100vh">

<div class="oka_block">
<div class="oka1">

	<?
if((($row_list["status"]==3)or($row_list["status"]==6))and($row_list["id_client"]!=0))		
{	
//купили, значит связана с клиентом наверно	
	
	$result_tty=mysql_time_query($link,'Select b.code,b.fio,b.phone from k_clients as b where b.id="'.htmlspecialchars(trim($row_list["id_client"])).'"');
$num_results_tty = $result_tty->num_rows;
if($num_results_tty!=0)
{	

	$row_tty = mysqli_fetch_assoc($result_tty);	
		   $phone_format='+7 ('.$row_tty["phone"][0].$row_tty["phone"][1].$row_tty["phone"][2].') '.$row_tty["phone"][3].$row_tty["phone"][4].$row_tty["phone"][5].'-'.$row_tty["phone"][6].$row_tty["phone"][7].'-'.$row_tty["phone"][8].$row_tty["phone"][9];	
	
	?>
	<div class="ok-block-input"><div class="ok-input-title">Наш Клиент<i></i></div></div>
	<?
	
	echo'<a class="svyz_client js-client" iod="'.$row_list["id_client"].'">
	<div class="svyz_1"><span>'.$row_tty["fio"].'</span></div>
	<div class="svyz_2">'.$phone_format.'</div>
	<div class="svyz_3">[code - '.$row_tty["code"].']</div>
	</a>';
} else
{
//значит старая заявка и связана просто с именем и телефоном	
?>
	
	
				<div class="ok-block-input">
			  <div class="ok-input-title">Телефон<i></i></div>
			
			  <span class="ok-i">
        <?
        echo'<input name="phone_b"  id="phone_b" '.$status_edit.' placeholder="Номер клиента для связи" class="ok-input phone_us1 '.iclass_("phone_b",$stack_error,"error_formi").'" autocomplete="off" type="text" value="'.ipost_($_POST['phone_b'],$row_list["phone"]).'">';
		?>	
			</span>
	        </div>
			<div class="ok-block-input">
			  <div class="ok-input-title">Имя<i></i></div>
			
			  <span class="ok-i"><?
        echo'<input name="name_client_b" id="name_client_b" '.$status_edit.' placeholder="Имя вашего клиента" class="ok-input '.iclass_("name_client_b",$stack_error,"error_formi").'" autocomplete="off" type="text" value="'.ipost_($_POST['name_client_b'],$row_list["name"]).'">';
				  ?>
        </span>
	        </div>	
<?	
	}
	
} else
{		
//проверим это уже связана заявка с клиентом или нет
$sss_us=0;
if(($row_list["id_client"]!=0)and($row_list["id_client"]!=''))
{
	$sss_us=1;
} 
	
	
echo'<div class="div_ook_grei_client_add">';
	
if(ipost_($_POST["client_new1_search"],$sss_us)!=0)
{
	$active_radio2='active_radio';
	$active_radio1='';
	$radio_bk=1;
} else
{
	$active_radio1='active_radio';
	$active_radio2='';
	$radio_bk=0;
}
	
	
?>
			<div class="ok-block-input">
					 
			 
			  <span class="ok-i jipp_34">

<div class="radioselect">

<?


	  
	echo'<div class="radio_material add_radio_yy_client '.$active_radio1.'" radio_id="0"><div class="table r_mat"><div class="table-cell radio_wall"><div class="st_div_radio  radio_checkbox"><i></i></div><input class="rt_wall_radio radio_0" name="radio_r0" value="0" type="hidden"></div><div class="table-cell name_radio wallr1 xx_32">Неизвестный клиент</div></div></div>';
	  
	  
	echo'<div class="radio_material add_radio_yy_client '.$active_radio2.'" radio_id="1"><div class="table r_mat"><div class="table-cell radio_wall"><div class="st_div_radio  radio_checkbox"><i></i></div><input class="rt_wall_radio radio_1" name="radio_r1" value="1" type="hidden"></div><div class="table-cell name_radio wallr1 xx_32">Найти клиента</div></div></div>';	  
	  
		

echo'<input value="'.$radio_bk.'" id="radio_bk66" class="radio_b" name="client_new1_search" type="hidden">	';
		?>
</div>
 </span>
	        </div>

</div>	
	<?
	if(ipost_($_POST["client_new1_search"],$sss_us)!=0)
    {
	echo'<div class="one_client_box_add" style="display:none;">';
	} else
	{
	echo'<div class="one_client_box_add" >';	
	}
	
	?>	
	
	
			<div class="ok-block-input">
			  <div class="ok-input-title">Телефон<i></i></div>
			
			  <span class="ok-i">
        <?
        echo'<input name="phone_b"  id="phone_b" '.$status_edit.' placeholder="Номер клиента для связи" class="ok-input phone_us1 '.iclass_("phone_b",$stack_error,"error_formi").'" autocomplete="off" type="text" value="'.ipost_($_POST['phone_b'],$row_list["phone"]).'">';
		?>	
			</span>
	        </div>
			<div class="ok-block-input">
			  <div class="ok-input-title">Имя<i></i></div>
			
			  <span class="ok-i"><?
        echo'<input name="name_client_b" id="name_client_b" '.$status_edit.' placeholder="Имя вашего клиента" class="ok-input '.iclass_("name_client_b",$stack_error,"error_formi").'" autocomplete="off" type="text" value="'.ipost_($_POST['name_client_b'],$row_list["name"]).'">';
				  ?>
        </span>
	        </div>	    
	  <?      	
	
	echo'</div>';
	
		if(ipost_($_POST["client_new1_search"],$sss_us)==0)
    {
	echo'<div class="two_client_box_add" style="display:none;">';
	} else
	{
	echo'<div class="two_client_box_add" >';	
	}
	
	
	echo'<div class="help_search_client">Для поиска клиента введите Имя, фамилию, отчество или все сразу. Так же клиента можно найти по телефону (без первой 8/+7) или по специальному коду клиента</div>';
	
	
	echo'<input type="hidden" value="'.ipost_($_POST["id_search_client1"],$row_list["id_client"]).'" name="id_search_client1">';
	
	?>
	<div class="fox_search_client1">
			
			<?
			if(ipost_($_POST["id_search_client1"],$row_list["id_client"])!=0)
        {
	
			$result_tty=mysql_time_query($link,'Select b.code,b.fio,b.phone from k_clients as b where b.id="'.htmlspecialchars(trim(ipost_($_POST["id_search_client1"],$row_list["id_client"]))).'"');
$num_results_tty = $result_tty->num_rows;
if($num_results_tty!=0)
{	

	$row_tty = mysqli_fetch_assoc($result_tty);	
		   $phone_format='+7 ('.$row_tty["phone"][0].$row_tty["phone"][1].$row_tty["phone"][2].') '.$row_tty["phone"][3].$row_tty["phone"][4].$row_tty["phone"][5].'-'.$row_tty["phone"][6].$row_tty["phone"][7].'-'.$row_tty["phone"][8].$row_tty["phone"][9];			
				
				echo'<div class="end_search1" style="display: block;"><div class="end_search_flex1"><div class="end_one1">'.$row_tty["fio"].' ['.$row_tty["code"].']</div><div class="end_two1">'.$phone_format.'</div></div></div>';
}
			} else
			{
			
			echo'<div class="end_search1"><div class="end_search_flex1"><div class="end_one1"></div><div class="end_two1"></div></div></div>';
			}
				

		echo'<div class="fox_search_result1" style="display: none;"></div>';
			
	
			
	echo'<input type="text" id="fox_search_client_i1" name="names_ss1" value="" placeholder="Фамилия, Телефон или код клиента" class="input_fit fit_add_search new_search_add_book '.iclass_("name_client_id",$stack_error,"error_2019_in").'" autocomplete="off">';
		
		
		
		echo'<span class="fox_dell1">x</span>	
		</div>';
	
	
	
	echo'</div>';
	
	
	

	        

}
?>
	
			<div class="ok-block-input">
			  <div class="ok-input-title">Дата обращения<i></i></div>
			
			  <span class="ok-i">
			  	
			  	<?
				  
				 $today[0] = date("Y-m-d"); //присвоено 03.12.01 
			  				
				  //2019-06-20 -> 19 Июня 2019
				  $date_ob=explode("-",htmlspecialchars(trim($row_list["datetime"])));
				  
				    switch($date_ob[1])
  {
   case "1": $mont1="Января"; break;
   case "2": $mont1="Февраля"; break;
   case "3": $mont1="Марта"; break;
   case "4": $mont1="Апреля"; break;
   case "5": $mont1="Мая"; break;
   case "6": $mont1="Июня"; break;
   case "7": $mont1="Июля"; break;
   case "8": $mont1="Августа"; break;
   case "9": $mont1="Сентября"; break;
   case "10": $mont1="Октября"; break;
   case "11": $mont1="Ноября"; break;
   case "12": $mont1="Декабря"; break;
  }
				  
					$date_ob1=$date_ob[2].' '.$mont1.' '.$date_ob[0];  
		    echo'<input id="date_hidden_table_gr1" name="date_naryad" value="'.ipost_($_POST['date_naryad'],$date_ob1).'" class="ok-input '.iclass_("date_b",$stack_error,"error_formi").'"  readonly="true" type="text">
			<input id="date_hidden_table_gr2" name="date_b" value="'.ipost_($_POST['date_b'],$row_list["datetime"]).'" readonly="true" type="hidden">';								   

			  	?>
			  	
			  </span>
	        </div>	 	                

</div>
<div class="oka2">
<?
	
if(($row_list["status"]==3)or($row_list["status"]==6))		
{	
	?>
	<div class="ok-block-input"><div class="ok-input-title">Загруженные документы<i></i></div></div>
	<?
$result_score=mysql_time_query($link,'Select a.* from booking_attach as a where a.id_booking="'.htmlspecialchars(trim($_GET['id'])).'"');
	
echo'<div class="img_invoice_div">';

$num_results_score = $result_score->num_rows;
if($num_results_score!=0)
{	  
echo'<div class="img_invoice"  style="display:block;"><ul>';
	
	for ($ss=0; $ss<$num_results_score; $ss++)
	{			   			  			   
	    $row_score = mysqli_fetch_assoc($result_score);	
		echo'<li sop="'.$row_score["id"].'">';
		
		
		if($sign_admin==1)
		{
		echo'<i for="'.$row_score["id"].'" data-tooltip="Удалить файл" class="del_image_invoice"></i>';
		}
		
		
		if(($row_score["type"]=='jpg')or($row_score["type"]=='jpeg'))
		{
		
		echo'<a target="_blank" href="booking/scan/'.$row_score["id"].'_'.$row_score["name"].'.'.$row_score["type"].'" rel="'.$row_score["id"].'"><div style=" background-image: url(booking/scan/'.$row_score["id"].'_'.$row_score["name"].'.'.$row_score["type"].')"></div></a></li>';
		} else
		{
			
			echo'<a target="_blank" href="booking/scan/'.$row_score["id"].'_'.$row_score["name"].'.'.$row_score["type"].'" rel="'.$row_score["id"].'"><div class="doc_pdf">'.$row_score["type"].'</div></a></li>';		
			
		}
	}
	
	echo'</ul></div>';	
} else
{
	echo'<div class="img_invoice"><ul></ul></div>';	
}
	  
			//кнопка выбрать фйл
			echo'<div id_upload="'.htmlspecialchars(trim($_GET['id'])).'" data-tooltip="загрузить 	товарный чек" class="invoice_upload">Перетащите файл, который Вы хотите прикрепить</div>';
			
	        //форма отправки файла
			$top_dd='<form  class="form_up" id="upload_sc_'.htmlspecialchars(trim($_GET['id'])).'" id_sc="'.htmlspecialchars(trim($_GET['id'])).'" name="upload'.htmlspecialchars(trim($_GET['id'])).'"><input class="sc_sc_loo12" type="file" name="myfile'.htmlspecialchars(trim($_GET['id'])).'"></form>';
			
	
	        //загрузчиик
			echo'<div class="loaderr_scan scap_load_'.htmlspecialchars(trim($_GET['id'])).'" style="width:100%"><div class="scap_load__" style="width: 0%;"></div></div>';
			
	
	?>
</div>
 
 
 
  <?
	
			 

	
	
	
} else
{
	
echo'<div id="date_table_gr1" '.$status_edit1.'></div>';
?>
<script type="text/javascript" src="Js/jquery-ui-1.9.2.custom.min.js"></script>
	<script type="text/javascript" src="Js/jquery.datepicker.extension.range.min.js"></script>
<script type="text/javascript">var disabledDays = [];
 $(document).ready(function(){           
            $("#date_table_gr1").datepicker({ 
				inline: true,		
altField:"#date_hidden_table_gr1",
onClose : function(dateText){
	  
        //alert(dateText); // Âûáðàííàÿ äàòà 
		
    },
altFormat:"d MM yy",
		
defaultDate:null,
beforeShowDay: disableAllTheseDays,
dateFormat: "yy-mm-dd", 
firstDay: 1,
minDate: "-2Y", maxDate: "+2Y",
				onSelect: function(dateText) {
    	// extensionRange - объект расширения
	//alert(dateText);
				//	var theDate = $(inst).datepicker.formatDate('DD, MM d, yy', $(inst).datepicker.('getDate'));
$("#date_hidden_table_gr2").val(dateText);
$('.button_yes_no').hide(); $('.save_booking').show(); 
	
    }	

				/*
beforeShow:function(textbox, instance){
	//alert('before');
	setTimeout(function () {
            instance.dpDiv.css({
                position: 'absolute',
				top: 0,
                left: 0
            });
		//$('.bookingBox_gr1').append($('#ui-datepicker-div'));
		
		//$('#ui-datepicker-div').appendTo($('.bookingBox_gr1'));
		//$('.ui-datepicker').hide();
		//$('#ui-datepicker-div').show();
        }, 10);
	
    $('.bookingBox_gr1').append($('#ui-datepicker-div'));
    $('#ui-datepicker-div').hide();
    //$('#ui-datepicker-div').hide();
}*/});

//$("#date_table_gr1").datepicker( "option", "disabled", true );

	 
<?
?>		 
//$('#date_table1').datepicker('setDate', ['+1d', '+30d']);
});
	 


	 
function resizeDatepicker() {
    setTimeout(function() { $('.bookingBox_gr1 > .ui-datepicker').width('100%'); }, 10);
}	 

function jopacalendar(queryDate,queryDate1,date_all) 
	{
	
if(date_all!='')
	{
var dateParts = queryDate.match(/(\d+)/g), realDate = new Date(dateParts[0], dateParts[1] -1, dateParts[2]); 
var dateParts1 = queryDate1.match(/(\d+)/g), realDate1 = new Date(dateParts1[0], dateParts1[1] -1, dateParts1[2]); 	 	 
	}
	}
	<?
if($_POST['date_b']!='')
{
	?>
	
$(document).ready(function(){	

	var yuu='<? echo($_POST['date_b']); ?>';
	dateParts = yuu.match(/(\d+)/g), realDate = new Date(dateParts[0], dateParts[1] - 1, dateParts[2]);
	$('#date_table_gr1').datepicker({ dateFormat: 'yy-mm-dd' }); // format to show
    $('#date_table_gr1').datepicker('setDate', realDate);
});
	<?
} else
{
	?>
	
$(document).ready(function(){	

	var yuu='<? echo($row_list["datetime"]); ?>';
	dateParts = yuu.match(/(\d+)/g), realDate = new Date(dateParts[0], dateParts[1] - 1, dateParts[2]);
	$('#date_table_gr1').datepicker({ dateFormat: 'yy-mm-dd' }); // format to show
    $('#date_table_gr1').datepicker('setDate', realDate);
});
	<?	
}
	?> 

            </script>	 
          <?
}
	?>
             
               
</div>

</div>
</div>	         
	             
	                     
	 </div> 
	 

	 
	<div class="section" id="section3">
	<div class="height_100vh8" style="background-color: #e8eaed;">
	<div class="sourse_b">
	<?
		//Выводим предложения если они есть
		
	$read='';	   
if(($row_list["status"]==3)or($row_list["status"]==6))
{
	$read='readonly="true"';
	$read1='readonly';
} 	
		
		
	echo'<div class="okss"><span class="title_book"><i class="count_offers_ajax">'.$row_scores["cc"].'</i><span class="padej_offers">'.PadejNumber($row_scores["cc"],'предложение,предложения,предложений').'</span></span></div>';
	
	//name="material['.$rr.'][idd]"	
		 $rr=0;
		$rr1=0;
		$tyy=1000;
	$result_sourse = mysql_time_query($link,'select A.*,(select B.name from booking_operator as B where B.id=A.id_operator) as name from  booking_offers as A WHERE  A.visible=1 and A.id_booking="'.htmlspecialchars(trim($_GET['id'])).'"');
$num_sourse = $result_sourse->num_rows;	
//$row_1 = mysqli_fetch_assoc($result2);
if($result_sourse)
{	
  			  while($row_sourse = mysqli_fetch_assoc($result_sourse)){ 	
		 $rr++;
				  $tyy--;
		
	echo'<div class="booking_sourse"  number_sourse="'.$rr.'" id_offers="'.$row_sourse["id"].'">';
if(($row_list["status"]!=3)and($row_list["status"]!=6))
{	
	echo'<div class="font-ranks del_booking_sourse" data-tooltip="Удалить предложение" id_rel="'.$row_sourse["id"].'"><span class="font-ranks-inner">x</span><div></div></div>';
}
	echo'<div class="sourse_1">';
				  $class_44='';
				  $ttt='';
				  if($row_sourse["status"]==2)
				  {
					  $class_44='active-44';
					  $ttt='data-tooltip="выбор клиента"';
				  }
				  echo'<span class="span-44 '.$class_44.'" '.$ttt.'>'.$rr.'</span>';
					  
					  
					 echo'</div>';
	
	echo'<div class="flex_sourse"><div class="sourse_2">'; 
		
	/*
	     $os = array( "дата поставки", "по алфавиту","новые");
	   $os_id = array("0", "1", "2");	
		
		$su_1=0;
		if (( isset($_COOKIE["su_1"]))and(is_numeric($_COOKIE["su_1"]))and(array_search($_COOKIE["su_1"],$os_id)!==false))
		{
			$su_1=$_COOKIE["su_1"];
		}
		
		
		   echo'<div class="left_drop menu1_prime"><label>Оператор</label><div class="select eddd"><a class="slct" list_number="t1" data_src="'.$os_id[$su_1].'">'.$os[$su_1].'</a><ul class="drop">';
		   for ($i=0; $i<count($os); $i++)
             {   
			   if($su_1==$os_id[$i])
			   {
				   echo'<li class="sel_active"><a href="javascript:void(0);"  rel="'.$os_id[$i].'">'.$os[$i].'</a></li>';
			   } else
			   {
				  echo'<li><a href="javascript:void(0);"  rel="'.$os_id[$i].'">'.$os[$i].'</a></li>'; 
			   }
			 
			 }
		   echo'</ul><input type="hidden" name="sort1" id="sort1" value="'.$os[$su_1].'"><div class="div_new_2018_"><hr class="one"></div></div></div>'; 
*/

		$label_style='';
		$name_operator='';
				  $id_operator='';
		if(isset($_POST['sourse'][$rr1]["operator"]))
		{
			if($_POST['sourse'][$rr1]["operator"]!='')
			{
				$label_style='class="active_label"';
				$id_operator=$_POST['sourse'][$rr1]["operator"];
		$result_t1=mysql_time_query($link,'Select a.name from booking_operator as a where a.id="'.htmlspecialchars(trim($_POST['sourse'][$rr1]["operator"])).'"');
       $num_results_t1 = $result_t1->num_rows;
	   if($num_results_t1!=0)
	   {
		   $row_t1 = mysqli_fetch_assoc($result_t1);
		   $name_operator=$row_t1["name"];
	   }
				
				
			}
		} else
		{
			if($row_sourse["id_operator"]!='')
			{
				$label_style='class="active_label"';
				$name_operator=$row_sourse["name"];
				$id_operator=$row_sourse["id_operator"];
			}
		}
				  
		
		   echo'<div class="left_drop menu1_prime" style="z-index:'.$tyy.'"><label '.$label_style.'>Туроператор<span>*</span></label><div class="select eddd"><a class="slct" list_number="t1" data_src="'.$id_operator.'">'.$name_operator.'</a><ul class="drop">';
		   
		$result_8 = mysql_time_query($link,'select A.* from  booking_operator as A where A.visible=1 order by A.name');
$num_8 = $result_8->num_rows;	
//$row_1 = mysqli_fetch_assoc($result2);
if($result_8)
{	
	 
  			  while($row_8 = mysqli_fetch_assoc($result_8)){ 
				  if($row_8["id"]==$id_operator)
				  {
				   echo'<li class="form_offers_ sel_active"><a href="javascript:void(0);"  rel="'.$row_8["id"].'">'.$row_8["name"].'</a></li>';	  
				  } else
				  {
				   echo'<li class="form_offers_"><a href="javascript:void(0);"  rel="'.$row_8["id"].'">'.$row_8["name"].'</a></li>';
				  }
			 }
}
		   echo'</ul><input type="hidden" '.$read1.'  name="sourse['.$rr1.'][operator]" id="operator_'.$rr1.'" value="'.ipost_($_POST['sourse'][$rr1]["operator"],$row_sourse["id_operator"]).'"><div class="div_new_2018_ '.iclass_($rr1."_operator",$stack_offers,"error_2018").'"><hr class="one"></div></div></div>'; 	
	echo'</div>';		
				  
	
	echo'<div class="sourse_2"><div class="input_2018 '.iclass_($rr1."_date_fly",$stack_offers,"error_2018").'"><label>Дата и город вылета<span>*</span></label><input '.$read.' name="sourse['.$rr1.'][date_fly]" value="'.ipost_($_POST['sourse'][$rr1]["date_fly"],$row_sourse["date_fly"]).'" id="date_fly_'.$rr1.'" class="input_new_2018 required form_offers_ " autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"></div></div></div>';				  
	
	$start_mi=$row_sourse["start_fly"];
	$end_mi=$row_sourse["end_fly"];	
	$class_mi='';
				  
	//получаем последние даты вылетов если путевка куплена полностью или частичто (3,6)			  
	if((($row_list["status"]==3)or($row_list["status"]==6))and($row_sourse["status"]==2))			  
	{
		        $class_mi='mi_m';
		        //получаем посление даты из истории 
				$result_mi=mysql_time_query($link,'SELECT a.* FROM booking_offers_fly_history AS a WHERE a.id_offers="'.$row_sourse["id"].'" order by a.datetime DESC limit 0,1');	

                if($result_mi->num_rows!=0)
                {  
                   $row_mi = mysqli_fetch_assoc($result_mi);
				   $start_mi=$row_mi["start_fly"];
	               $end_mi=$row_mi["end_fly"];		
				} 
		
	}
				  
				  
				  if($start_mi!='0000-00-00 00:00:00')
				  {
					   $date_start=explode(" ",htmlspecialchars(trim($start_mi)));
				   $date_start1=explode("-",htmlspecialchars(trim($date_start[0])));
				  $date_start2=explode(":",htmlspecialchars(trim($date_start[1])));
				   $startx=$date_start1[2].'.'.$date_start1[1].'.'.$date_start1[0].' '.$date_start2[0].':'.$date_start2[1];		
				  } else
				  {
					  $startx='';
				  }
					  if($end_mi!='0000-00-00 00:00:00')
				  {	
	   $date_end=explode(" ",htmlspecialchars(trim($end_mi)));
				   $date_end1=explode("-",htmlspecialchars(trim($date_end[0])));
				  $date_end2=explode(":",htmlspecialchars(trim($date_end[1])));
				   $endx=$date_end1[2].'.'.$date_end1[1].'.'.$date_end1[0].' '.$date_end2[0].':'.$date_end2[1];		} else
					  {
						$endx='';  
					  }
				  
	echo'<div class="sourse_2"><div class="input_2018 '.iclass_($rr1."_start",$stack_offers,"error_2018").'">';
		if($class_mi!='')
		{
			echo'<div class="mi_mo"></div>';
			echo'<div class="mi_history" data-tooltip="Посмотреть историю вылетов"></div>';
		}
				  
				  echo'<label>Дата и время вылета</label><input '.$read.'  name="sourse['.$rr1.'][start]" value="'.ipost_($_POST['sourse'][$rr1]["start"],$startx).'" id="start_'.$rr1.'" class="input_new_2018 required time_input date_time_picker form_offers_ js-mi-x1 '.$class_mi.'" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"></div></div></div>';			

	echo'<div class="sourse_2"><div class="input_2018 '.iclass_($rr1."_end",$stack_offers,"error_2018").'">';
	if($class_mi!='')
		{
			echo'<div class="mi_mo"></div>';
		    echo'<div class="mi_history" data-tooltip="Посмотреть историю вылетов"></div>';
		}
	echo'<label>Дата и время отлета</label><input '.$read.' name="sourse['.$rr1.'][end]" value="'.ipost_($_POST['sourse'][$rr1]["end"],$endx).'" id="end_'.$rr1.'" class="input_new_2018 required time_input date_time_picker form_offers_ js-mi-x2 '.$class_mi.'" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"></div></div></div>';			
				  
		
	echo'<div class="sourse_3 xx_23"><div class="input_2018 '.iclass_($rr1."_rules",$stack_offers,"error_2018").'"><label>Условия<span>*</span></label><input '.$read.' name="sourse['.$rr1.'][rules]" value="'.ipost_($_POST['sourse'][$rr1]["rules"],$row_sourse["rules"]).'" id="rules_'.$rr1.'" class="input_new_2018 required form_offers_ " autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"></div></div></div>';
	
	echo'<div class="sourse_3"><div class="input_2018 '.iclass_($rr1."_hotel",$stack_offers,"error_2018").'"><label>Отель<span>*</span></label><input '.$read.'  name="sourse['.$rr1.'][hotel]" value="'.ipost_($_POST['sourse'][$rr1]["hotel"],$row_sourse["hotel"]).'" id="hotel_'.$rr1.'" class="input_new_2018 required form_offers_ " autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"></div></div></div>';		
	
	echo'<div class="sourse_2"><div data-tooltip="Стоимость с топливным сбором" class="input_2018 '.iclass_($rr1."_cost",$stack_offers,"error_2018").'">';
if(($row_list["status"]==3)or($row_list["status"]==6))		
{	
echo'<label>Стоимость по чеку</label>';	
} else
{
echo'<label>Стоимость с топливом<span>*</span></label>';
}
	echo'<input '.$read.'  name="sourse['.$rr1.'][cost]" value="'.ipost_($_POST['sourse'][$rr1]["cost"],$row_sourse["cost"]).'" id="cost_'.$rr1.'" class="input_new_2018 required money_mask form_offers_ " autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><hr class="tree"></div></div></div>';		

		

	

				  
if((($row_list["status"]==3)or($row_list["status"]==6))and($row_sourse["status"]==2))		
{					

	echo'<div class="sourse_2"><div class="input_2018 '.iclass_($rr1."_discount",$stack_offers,"erro_formi_2018").'"><label>Цена туроператора</label><input '.$read.' name="sourse['.$rr1.'][cost_opp]" value="'.ipost_($_POST['sourse'][$rr1]["cost_opp"],$row_sourse["cost_operator"]).'" id="discount_'.$rr1.'" class="input_new_2018 required money_mask form_offers_ " autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><hr class="tree"></div></div></div>';	
	
} else
{				  
	echo'<div class="sourse_2"><div class="input_2018 '.iclass_($rr1."_discount",$stack_offers,"erro_formi_2018").'"><label>Возможная скидка<span class="bluu">*</span></label><input '.$read.' name="sourse['.$rr1.'][discount]" value="'.ipost_($_POST['sourse'][$rr1]["discount"],$row_sourse["discount"]).'" id="discount_'.$rr1.'" class="input_new_2018 required money_mask  form_offers_ " autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><hr class="tree"></div></div></div>';
}	
$proc_realiz=0;				  

if((($row_list["status"]==3)or($row_list["status"]==6))and($row_sourse["status"]==2))		
{
	//выводим процент от продажи
	$proc_realiz=round(($row_sourse["commission"]*100)/$row_sourse["cost"],1);
	
	//echo'!!!!';	
	echo'<div class="sourse_2"><div class="input_2018 '.iclass_($rr1."_proc1",$stack_offers,"erro_formi_2018").'"><label>Наш Процент - %</label><input '.$read.' name="sourse['.$rr1.'][proc1]" value="'.$proc_realiz.'" id="proc1_'.$rr1.'" class="input_new_2018 required  form_offers_ count_mask" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"></div></div></div>';	
		

	
} else
{	

		echo'<div class="sourse_2"><div class="input_2018 '.iclass_($rr1."_proc",$stack_offers,"erro_formi_2018").'"><label>Возможная комиссия<span class="bluu">*</span></label><input '.$read.' name="sourse['.$rr1.'][proc]" value="'.ipost_($_POST['sourse'][$rr1]["proc"],$row_sourse["proc"]).'" id="proc_'.$rr1.'" class="input_new_2018 required  form_offers_ money_mask" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><hr class="tree"></div></div></div>';	
	
}
if((($row_list["status"]==3)or($row_list["status"]==6))and($row_sourse["status"]==2))		
{	
		echo'<div class="sourse_2"><div class="input_2018 '.iclass_($rr1."_numbr",$stack_offers,"erro_formi_2018").'"><label>Номер заявки в ТО</label><input '.$read.' name="sourse['.$rr1.'][number1]" value="'.$row_sourse["number_op"].'" id="number1_'.$rr1.'" class="input_new_2018 required  form_offers_ count_mask" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"></div></div></div>';	
	echo'<div class="sourse_2 doc_uma">'; 
	
	if($row_sourse["status"]==2)
				  {
					
$doc_uma='неизвество';

$result_tp=mysql_time_query($link,'Select b.name as cc from booking_contract as b where b.id="'.htmlspecialchars(trim($row_sourse['id_contract'])).'"');
$num_results_tp = $result_tp->num_rows;
if($num_results_tp!=0)
{	
	$row_score12p = mysqli_fetch_assoc($result_tp);
	$doc_uma=$row_score12p["cc"];
}
						  
echo('<span>№ договора - '.$doc_uma.'</span>');						  
						  
						  
				  }
	
	
	echo'</div>';
} else
{
	echo'<div class="sourse_2">';
	
	 
	echo'</div>';
}
				  
				  
		echo'<input type=hidden value="'.ipost_($_POST['sourse'][$rr1]["id"],$row_sourse["id"]).'" name="sourse['.$rr1.'][id]">';
	echo'</div>';
		$class_edit_comment='';		  

			
					//выводим комментарий пользователя по отдыху или кнопку добавить комментарий
			//только если он уже вернулся
			//если это его заявка или он админ
				  
		if((($row_list["status"]==3)or($row_list["status"]==6))and($row_sourse["status"]==2))		
        {		
			if(($row_list["id_user"]==$id_user)or($sign_admin==1))
			{   
			   if(dateDiff_1(date("y-m-d").' '.date("H:i:s"),$end_mi)>=0)
			   {
				  $class_edit_comment='js--edit--ccomment';
			   }
			}

	

			   if(dateDiff_1(date("y-m-d").' '.date("H:i:s"),$end_mi)>=0)
			   {
				   
				   
if($row_sourse["comment_client"]!='')
{
	
	echo'<div class="comment_offers '.$class_edit_comment.'">'.$row_sourse["comment_client"].'</div>';
} else
{
	echo'<div class="comment_offers"><div class="add_comment_offers '.$class_edit_comment.'">Добавить впечатление туриста</div></div>';
}
				  
			   }
				
			
			
						
		}
				  
				  echo'</div>';	
		$rr1++;
			  }
}
if(($row_list["status"]!=3)and($row_list["status"]!=6))
{
	
	echo'<span class="replace_mm" style="display: none;"><div class="booking_sourse"  number_sourse="IDMIDD" id_offers="IDMID"><div class="font-ranks del_booking_sourse" data-tooltip="Удалить предложение" id_rel="IDMID"><span class="font-ranks-inner">x</span><div></div></div><div class="sourse_1"><span class="span-44">IDMIDD</span></div>';
	echo'<div class="flex_sourse"><div class="sourse_2">'; 
	echo'<div class="left_drop menu1_prime"><label>Туроператор<span>*</span></label><div class="select eddd"><a class="slct" list_number="t1" data_src=""></a><ul class="drop">';
		   
		$result_8 = mysql_time_query($link,'select A.* from  booking_operator as A where A.visible=1 order by A.name');
$num_8 = $result_8->num_rows;	
//$row_1 = mysqli_fetch_assoc($result2);
if($result_8)
{	
	 
  			  while($row_8 = mysqli_fetch_assoc($result_8)){ 
				  
				   echo'<li class="form_offers_"><a href="javascript:void(0);"  rel="'.$row_8["id"].'">'.$row_8["name"].'</a></li>';
			   
			 }
}
		   echo'</ul><input type="hidden"  name="sourse[SIDMIDS][operator]" id="operator_SIDMIDS" value=""><div class="div_new_2018_"><hr class="one"></div></div></div>'; 	
	echo'</div>';		
		

	echo'<div class="sourse_2"><div class="input_2018"><label>Дата и город вылета<span>*</span></label><input '.$read.' name="sourse[SIDMIDS][date_fly]" value="" id="date_fly_SIDMIDS" class="input_new_2018 required form_offers_" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"></div></div></div>';			

	echo'<div class="sourse_2"><div class="input_2018"><label>Дата и время вылета</label><input '.$read.'  name="sourse[SIDMIDS][start]" value="" id="start_SIDMIDS" class="input_new_2018 required time_input date_time_picker form_offers_" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"></div></div></div>';			

	echo'<div class="sourse_2"><div class="input_2018"><label>Дата и время отлета</label><input '.$read.' name="sourse[SIDMIDS][end]" value="" id="end_SIDMIDS" class="input_new_2018 required time_input date_time_picker form_offers_" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"></div></div></div>';		
	
	
	echo'<div class="sourse_3 xx_23"><div class="input_2018"><label>Условия<span>*</span></label><input '.$read.' name="sourse[SIDMIDS][rules]" value="" id="rules_SIDMIDS" class="input_new_2018 required form_offers_" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"></div></div></div>';
	
	echo'<div class="sourse_3"><div class="input_2018"><label>Отель<span>*</span></label><input '.$read.'  name="sourse[SIDMIDS][hotel]" value="" id="hotel_SIDMIDS" class="input_new_2018 required form_offers_" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"></div></div></div>';		
	
	echo'<div class="sourse_2"><div class="input_2018"><label>Стоимость с топливом<span>*</span></label><input '.$read.'  name="sourse[SIDMIDS][cost]" value="" id="cost_SIDMIDS" class="input_new_2018 required money_mask form_offers_" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><hr class="tree"></div></div></div>';		

		

	echo'<div class="sourse_2"><div class="input_2018"><label>Возможная скидка<span class="bluu">*</span></label><input '.$read.' name="sourse[SIDMIDS][discount]" value="" id="discount_SIDMIDS" class="input_new_2018 money_mask required form_offers_" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><hr class="tree"></div></div></div>';		

	
	echo'<div class="sourse_2"><div class="input_2018"><label>Возможная комиссия<span class="bluu">*</span></label><input '.$read.' name="sourse[SIDMIDS][proc]" value="" id="proc_SIDMIDS" class="input_new_2018 required money_mask form_offers_" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><hr class="tree"></div></div></div>';			

	echo'<div class="sourse_2">';
	
					 
	
	
	
	echo'</div>';
	
	
	
	echo'<input type=hidden value="IDMID" name="sourse[SIDMIDS][id]">';	
	echo'</div></div></span>';		
		
		}
		
	//echo($row_list["status"]);	
		
if(($row_list["status"]!=3)and($row_list["status"]!=6))
{
	
	echo'<div class="add_sourse_booking" for="'.$row_list["id"].'">Добавить ваше предложение</div>';
		}
		?>
	</div></div>	 
	</div>	
	 
<div class="section" id="section3">
<div class="height_100vh8">
	


<div class="oka_block column_flex"> 

<div class="div_ook_grei1">

			<div class="ok-block-input">
			 <div class="ok-input-title">Источник обращения<i></i></div>
		</div></div></div>	 
			 <?
		
	echo'<div class="div_ook_grei sourse_error'.iclass_("sourse_b",$stack_error,"error_formi").'">';
?>
			<div class="ok-block-input">
					 
			 
			  <span class="ok-i">
			<?  	
echo'<div class="cha_1 active_option cha_77 ">';		
				
			
					$result_work_zz=mysql_time_query($link,'Select a.* from booking_sourse as a where a.visible=1 order by a.displayOrder');

						 
		//echo 'Select a.*,b.id as idd,b.id_user,b.id_object from z_doc_material as a,z_doc as b,i_material as c where a.id_i_material=c.id and a.id_doc=b.id and a.id_stock="'.$row__2["id_stock"].'"  and b.id_object in('.implode(',', $hie->obj ).') AND a.status NOT IN ("1","8","10","3","5","4") '.$sql_su2_.' '.$sql_su3_.' '.$sql_su1_;				 
						 
						 
        $num_results_work_zz = $result_work_zz->num_rows;
	    if($num_results_work_zz!=0)
	    {

	
	
		  $id_work=0;
		   $rr=explode(',',$row_list["id_booking_sourse"]);
		   for ($i=0; $i<$num_results_work_zz; $i++)
		   {			   			  			   
			   $row_work_zz = mysqli_fetch_assoc($result_work_zz);

			   	 $rtt='';
			   $rtt_value="0";
			   if(isset($_POST['material_r'.$row_work_zz["id"]]))
			   {
			   if($_POST['material_r'.$row_work_zz["id"]]==1)
			   {
				  	 $rtt='active_wall'; 
				   $rtt_value="1";
			   }
			   } else
			   {
				   
				   	$found = array_search($row_work_zz["id"],$rr);   
	                if($found !== false) 
	                {
						  	 $rtt='active_wall'; 
				           $rtt_value="1";
	                }
			   }
			    
			   

				  echo'<div class="wallet_material  '.$rtt.'" wall_id="'.$row_work_zz["id"].'">
			  <div class="table w_mat">
			      <div class="table-cell one_wall"><div class="st_div_wall  wallet_checkbox"><i></i></div><input class="rt_wall yop_'.$row_work_zz["id"].'" name="material_r'.$row_work_zz["id"].'" value="'.ipost_($_POST['material_r'.$row_work_zz["id"]],$rtt_value).'" type="hidden"></div>';				
				
					
			      echo'<div class="table-cell name_wall wall1">'.$row_work_zz["name"].'</div>
			      
			  </div>
			</div>';
						  
					
				
			   
			   
			   
		   }
		echo'<input '.$status_edit.' type="hidden" value="'.ipost_($_POST['sourse_b'],$row_list["id_booking_sourse"]).'" id="sourse_b" class="sourse_b" name="sourse_b">';
			
		}
				
			?>
			
			
	
			</div>				  	
			  	
			  </span>
	        </div>

</div>



<?
	if(count($hie_object)>1)
	{
?>

<div class="oka_block column_flex"> 

<div class="div_ook_grei1 new_grei">

			<div class="ok-block-input">
			 <div class="ok-input-title">Точка продаж<i></i></div>
		</div></div></div>	 
<?
	echo'<div class="div_ook_grei sourse_error1 '.iclass_("dot_b_op",$stack_error,"error_formi").'">';
?>
			<div class="ok-block-input">
					 
			 
			  <span class="ok-i jipp_34">

<div class="radioselect">

<?

foreach ($hie_object as &$value) {
    
  $result_tor=mysql_time_query($link,'Select b.object_name,b.id from i_object as b where b.id="'.htmlspecialchars(trim($value)).'"');
  $num_results_tor = $result_tor->num_rows;
  if($num_results_tor!=0)
  { 	
	$row_tor = mysqli_fetch_assoc($result_tor);
	$rtt_value="0";
	  $rtt='';
	  
	if($row_list["id_object"]==$row_tor["id"])
	{
		$rtt='active_radio'; 
		$rtt_value="1";
	}
	  
	  
	echo'<div class="radio_material add_radio_yy '.$rtt.'" radio_id="'.$value.'"><div class="table r_mat"><div class="table-cell radio_wall"><div class="st_div_radio  radio_checkbox"><i></i></div><input class="rt_wall_radio radio_'.$value.'" name="radio_r'.$value.'" value="'.ipost_($_POST['radio_r'.$row_tor["id"]],$rtt_value).'" type="hidden"></div><div class="table-cell name_radio wallr1 xx_32">'.$row_tor["object_name"].'</div></div></div>';
	  
  }
	
}		

echo'<input '.$status_edit.' value="'.ipost_($_POST['dot_b_op'],$row_list["id_object"]).'" id="radio_bk" class="radio_b" name="dot_b_op" type="hidden">	';
		?>
</div>
 </span>
	        </div>

</div>
<?
	}
?>
	
	
	
	</div></div>
	
	 
</div> 
 <?
 echo'<input id="count_sourse" name="count_sourse" value="'.$num_sourse.'" type="hidden">';
 echo'<input id="count_sourse1" name="count_sourse1" value="'.($num_sourse-1).'" type="hidden">';	
 ?>
  </form>
	  
<?

echo $top_dd;

echo'</div>';

include_once $url_system.'template/left.php';
?>

</div>
</div><script src="Js/rem.js" type="text/javascript"></script>
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
		
		input_2018();	

		//$('.date_time_picker').datetimepicker();
		$('.date_time_picker').inputmask("datetime",{
    mask: "1.2.y h:s", 
    placeholder: "dd.mm.yyyy hh:mm",  
    separator: ".", 
    alias: "dd.mm.yyyy"
  });
		
});
</script>
