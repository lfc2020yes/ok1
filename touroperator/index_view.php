<?
session_start();
$url_system=$_SERVER['DOCUMENT_ROOT'].'/'; include_once $url_system.'module/config.php'; include_once $url_system.'module/function.php'; include_once $url_system.'login/function_users.php'; initiate($link); include_once $url_system.'module/access.php';


$active_menu='touroperator';  // в каком меню



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
	if(token_access_yes($token,'save_touroperator',$id,120))
    {
		//echo("!");
	//возможно проверка что этот пользователь это может делать
	 if (($role->permission('Туроператоры','U'))or($sign_admin==1))
	 {
		 
		$result_url=mysql_time_query($link,'select A.* from booking_operator as A where A.id="'.htmlspecialchars(trim($_GET['id'])).'"');
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
			
		   
			mysql_time_query($link,'update booking_operator set name="'.htmlspecialchars($_POST['name_b']).'",phone="'.htmlspecialchars($_POST['phone_b']).'",login="'.htmlspecialchars(trim($_POST['login_b'])).'",comment="'.htmlspecialchars(trim($_POST['comment_b'])).'",password="'.htmlspecialchars($_POST['password_b']).'",url="'.htmlspecialchars($_POST['url_b']).'" where id = "'.htmlspecialchars($_GET['id']).'"');	
			

		   
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
if (( count($_GET) != 1 ) )
{
   header404(2,$echo_r);		
}

if((!$role->permission('Туроператоры','R'))and($sign_admin!=1))
{
  header404(3,$echo_r);
}


$result_url=mysql_time_query($link,'select A.* from booking_operator as A where A.visible=1 and A.id="'.htmlspecialchars(trim($_GET['id'])).'"');
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


$status_edit='';
$status_class='';
$status_edit1='';
if (!$role->permission('Туроператоры','U'))
{	
   $status_edit='readonly';	
   $status_edit1='disabled';
   $status_class='grey_edit';		
}



include_once $url_system.'template/html.php'; include $url_system.'module/seo.php';

if($error_header!=404){ SEO('touroperator_view','','','',$link); } else { SEO('0','','','',$link); }

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
echo'<div class="alert_wrapper"><div class="div-box"></div></div>';

	
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

	  include_once $url_system.'template/top_touroperator_view.php';

	  	  echo'<form id="lalala_add_form" class="my_n" style=" padding:0; margin:0;" method="post" enctype="multipart/form-data"><input name="save_booking" value="2" type="hidden">';
	  
	  	$token=token_access_compile($_GET['id'],'save_touroperator',$secret);				
						
		echo'<input type="hidden" value="'.$token.'" name="tk">'; 
	  
	 echo'<div id="fullpage" class="margin_60 margin_0 form_4_booking">';
	?>
	<div class="section" id="section0">
	<div class="height_100vh">
	
<?
$stack_error ??= array();
	?>




	<div class="div_ook">
	
<!--<span class="add_bo">Добавление новой заявки</span>	-->
	
			<div class="ok-block-input">
			  <div class="ok-input-title">Название туроператора<i></i></div>
			
			  <span class="ok-i">
        <?
        echo'<input name="name_b" '.$status_edit.' id="name_b" placeholder="Название туроператора" class="ok-input '.iclass_("name_b",$stack_error,"error_formi").'" autocomplete="off" type="text" value="'.ipost_(($_POST['name_b'] ?? ''),$row_list["name"]).'">';
        ?>
        </span>
	        </div>
	        
	        
	        
	        
	  				<div class="ok-block-input">
			  <div class="ok-input-title">Телефон<i></i></div>
			
			  <span class="ok-i">
        <?
        echo'<input name="phone_b" '.$status_edit.'  id="phone_b1" placeholder="Номер для связи" class="ok-input  '.iclass_("phone_b",$stack_error,"error_formi").'" autocomplete="off" type="text" value="'.ipost_(($_POST['phone_b'] ?? ''),$row_list["phone"]).'">';
		?>	
			</span>
	        </div>        
	        
<div class="ok-block-input">
			  <div class="ok-input-title">Сайт<i></i></div>
			
			  <span class="ok-i">
        <?
        echo'<input name="url_b" '.$status_edit.'  id="phone_b1" placeholder="Адрес сайта туроператора" class="ok-input '.iclass_("url_b",$stack_error,"error_formi").'" autocomplete="off" type="text" value="'.ipost_(($_POST['url_b'] ?? ''),$row_list["url"]).'">';
		?>	
			</span>
	</div>
	        	        
<?
//загрузить шаблон для договора
?>
<div class="input-block-2020">
<?php



$result_6 = mysql_time_query($link,'select A.* from image_attach as A WHERE A.for_what="6" and A.visible=1 and A.id_object="'.ht($_GET["id"]).'"');

$num_results_uu = $result_6->num_rows;

$class_aa='';
$style_aa='';
if($num_results_uu!=0)
{
    $class_aa='eshe-load-file';
    $style_aa='style="display: block;"';
}



echo'<div class="margin-input"><div class="img_invoice_div js-image-gl"><div class="list-image" '.$style_aa.'>';

if($num_results_uu!=0)
{
    $i=1;
    while($row_6 = mysqli_fetch_assoc($result_6)){
        echo'	<div number_li="'.$i.'" class="li-image yes-load"><span class="name-img"><a href="/upload/file/'.$row_6["id"].'_'.$row_6["name"].'.'.$row_6["type"].'">'.$row_6["name_user"].'</a></span><span class="del-img js-dell-image" id="'.$row_6["name"].'"></span><div class="progress-img"><div class="p-img" style="width: 0px; display: none;"></div></div></div>';
        $i++;
    }
}


echo'</div><input type="hidden" name="files_6" value=""><div type_load="6" id_object="'.ht($_GET["id"]).'" class="invoice_upload js-upload-file js-helps '.$class_aa.'"><span>прикрепите <strong>шаблон для договора</strong>, для этого выберите или перетащите файлы сюда </span><i>чтобы прикрепить ещё <strong>удалите старый шаблон</strong>, а затем выберите или перетащите его сюда</i><div class="help-icon-x" data-tooltip="Принимаем только в форматах .docx" >u</div></div></div></div>';
?>
</div>





			<div class="ok-block-input">
			  <div class="ok-input-title">Комментарий<i></i></div>
			
			  <span class="ok-i">
       
       
       <div class="div_textarea_otziv1" >
			<div class="otziv_add">
                 
                   <?
        echo'<textarea cols="10" rows="1" '.$status_edit.' placeholder="Ваши заметки и комментарии по поводу заявки" id="otziv_area_adaxx" name="comment_b" class="di text_area_otziv no_comment_bill">'.ipost_(($_POST['comment_b'] ?? ''),$row_list["comment"]).'</textarea>';
				?>
            </div>      
</div>  
       
       
       
       </span>
        
        <script type="text/javascript"> 
	  $(function (){ 
$('#otziv_area_adaxx').autoResize({extraSpace : 10,onResize: function() {} });
		  
		  
		  
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
<div class="oka22" style="width:100%;">

<div class="ok-block-input">
			  <div class="ok-input-title">Логин<i></i></div>
			
			  <span class="ok-i">
        <?
        echo'<input name="login_b" '.$status_edit.'  id="phone_b1" placeholder="ЛОГИН ЛИЧНОГО КАБИНЕТА" class="ok-input '.iclass_("login_b",$stack_error,"error_formi").'" autocomplete="off" type="text" value="'.ipost_(($_POST['login_b'] ?? ''),$row_list["login"]).'">';
		?>	
			</span>
	        </div>   	
                                                   
   <div class="ok-block-input">
			  <div class="ok-input-title">Пароль<i></i></div>
			
			  <span class="ok-i">
        <?
        echo'<input name="password_b" '.$status_edit.'  id="phone_b1" placeholder="ПАРОЛЬ ДЛЯ ВХОДА" class="ok-input '.iclass_("password_b",$stack_error,"error_formi").'" autocomplete="off" type="text" value="'.ipost_(($_POST['password_b'] ?? ''),$row_list["password"]).'">';
		?>	
			</span>
	        </div>               
</div>

</div>
</div>	         
	             
	                     
	 </div>
</div> 
  </form>
	  </div>  
	  <?
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

});
</script>
