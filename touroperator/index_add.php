<?
session_start();

$active_menu='touroperator';  // в каком меню


$url_system=$_SERVER['DOCUMENT_ROOT'].'/'; include_once $url_system.'module/config.php'; include_once $url_system.'module/function.php'; include_once $url_system.'login/function_users.php'; initiate($link); include_once $url_system.'module/access.php';





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

//создателю
//админу
//всем кто выше поо левал


if((isset($_POST['save_operator']))and($_POST['save_operator']==1))
{
	$token=htmlspecialchars($_POST['tk']);
	
	
	//токен доступен в течении 120 минут
	if(token_access_yes($token,'add_touroper',2005,120))
    {
		//echo("!");
	//возможно проверка что этот пользователь это может делать
	 if (($role->permission('Туроператоры','A'))or($sign_admin==1))
	 {	
	$stack_error = array();  // общий массив ошибок

	//print_r($stack_error);
	//исполнитель			

if((htmlspecialchars(trim($_POST['name_b']))==''))
{
  array_push($stack_error, "name_b"); 
}	
		 /*
	if((htmlspecialchars(trim($_POST['phone_b']))==''))
{
  array_push($stack_error, "phone_b"); 
}
*/	 
		 
	    //есть ли ошибки по заполнению
		//print_r($stack_error);
	    if(count($stack_error)==0)
		{
		   //ошибок нет
		   //сохраняем наряд
			 $today[0] = date("y.m.d"); //присвоено 03.12.01
             $today[1] = date("H:i:s"); //присвоит 1 элементу массива 17:16:17

	         $date_=$today[0].' '.$today[1];
			
			
			
			 mysql_time_query($link,'INSERT INTO booking_operator (name,url,login,password,comment,phone) VALUES ("'.htmlspecialchars(trim($_POST['name_b'])).'","'.htmlspecialchars(trim($_POST['url_b'])).'","'.htmlspecialchars(trim($_POST['login_b'])).'","'.htmlspecialchars(trim($_POST['password_b'])).'","'.htmlspecialchars(trim($_POST['comment_b'])).'","'.htmlspecialchars(trim($_POST['phone_b'])).'")');
			 
			 $ID_N=mysqli_insert_id($link);  
			
			
			 header("Location:".$base_usr."/touroperator/".$ID_N.'/');	
			 die();
		   
		}
	

}

}
	
	
}



$secret=rand_string_string(4);
//$_SESSION['s_t'] = $secret;
if(!isset($_SESSION['s_t']))
{
    $_SESSION['s_t'] = $secret;
} else
{
    $secret=$_SESSION['s_t'];
}


//89084835233

//проверить и перейти к последней себестоимости в которой был пользователь

//проверка адреса сайта на существование такой страницы
//проверка адреса сайта на существование такой страницы
//проверка адреса сайта на существование такой страницы
//      /finery/add/28/
//     0   1     2  3

$error_header=0;
$url_404=$_SERVER['REQUEST_URI'];
//echo($url_404);
$D_404 = explode('/', $url_404);


if (strripos($url_404, 'index_add.php') !== false) {
   header404(1,$echo_r);	
}

if ( count($_GET) != 0 )
{
   header404(2,$echo_r);		
}

if((!$role->permission('Туроператоры','A'))and($sign_admin!=1))
{
  header404(3,$echo_r);
}

//если такой страницы нет или не может быть выведена с такими параметрами
if($error_header==404)
{
	include $url_system.'module/error404.php';
	die();
}

//проверка адреса сайта на существование такой страницы
//проверка адреса сайта на существование такой страницы
//проверка адреса сайта на существование такой страницы


include_once $url_system.'template/html.php'; include $url_system.'module/seo.php';

if($error_header!=404){ SEO('touroperator_add','','','',$link); } else { SEO('0','','','',$link); }

include_once $url_system.'module/config_url.php'; include $url_system.'template/head.php';
?>
</head><body><div class="container">
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

	
/*	
        $result_town=mysql_time_query($link,'select A.id_town,B.town,A.kvartal from i_kvartal as A,i_town as B where A.id_town=B.id and A.id="'.$row_list["id_kvartal"].'"');
        $num_results_custom_town = $result_town->num_rows;
        if($num_results_custom_town!=0)
        {
			$row_town = mysqli_fetch_assoc($result_town);	
		}	
*/	
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

	  include_once $url_system.'template/top_touroperator_add.php';

	  echo'<form id="lalala_add_form" class="my_n" style=" padding:0; margin:0;" method="post" enctype="multipart/form-data"><input name="save_operator" value="1" type="hidden">';
	  
	  	$token=token_access_compile(2005,'add_touroper',$secret);				
						
		echo'<input type="hidden" value="'.$token.'" name="tk">'; 
	  
	 echo'<div id="fullpage" class="margin_60 form_3_booking">';
	?>
	<div class="section" id="section0">
	<div class="height_100vh">

		

	<div class="div_ook">
	
<!--<span class="add_bo">Добавление новой заявки</span>	-->
	
		
		  
		  	
		  		
		  			
		  				
		  						<div class="ok-block-input">
			  <div class="ok-input-title">Название туроператора<i></i></div>
			
			  <span class="ok-i">
        <?
        echo'<input name="name_b" id="name_b" placeholder="Название нового туроператора?" class="ok-input '.iclass_("name_b",$stack_error,"error_formi").'" autocomplete="off" type="text" value="'.ipost_($_POST['name_b'],"").'">';
        ?>
        </span>
	        </div>
	        
	        
	        
	        
				<div class="ok-block-input">
			  <div class="ok-input-title">Телефон<i></i></div>
			
			  <span class="ok-i">
        <?
        echo'<input name="phone_b"  id="phone_b1" placeholder="Номер для связи" class="ok-input  '.iclass_("phone_b",$stack_error,"error_formi").'" autocomplete="off" type="text" value="'.ipost_($_POST['phone_b'],"").'">';
		?>	
			</span>
	        </div>        
	        
<div class="ok-block-input">
			  <div class="ok-input-title">Сайт<i></i></div>
			
			  <span class="ok-i">
        <?
        echo'<input name="url_b"  id="phone_b1" placeholder="Адрес сайта туроператора" class="ok-input '.iclass_("url_b",$stack_error,"error_formi").'" autocomplete="off" type="text" value="'.ipost_($_POST['url_b'],"").'">';
		?>	
			</span>
	        </div>   	        
	        
	        
	        
	        
			<div class="ok-block-input">
			  <div class="ok-input-title">Комментарий<i></i></div>
			
			  <span class="ok-i">
       
       
       <div class="div_textarea_otziv1" >
			<div class="otziv_add">
                 
                   <?
        echo'<textarea cols="10" rows="1" placeholder="Ваши заметки и комментарии по поводу туроператора" id="otziv_area_adaxx" name="comment_b" class="di text_area_otziv no_comment_bill">'.ipost_($_POST['comment_b'],"").'</textarea>';
				?>
            </div>      
</div>  
       
       
       
       </span>
        
        <script type="text/javascript"> 
	  $(function (){ 
$('#otziv_area_adaxx').autoResize({extraSpace : 10});
$('#otziv_area_adaxx').trigger('keyup');

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
        echo'<input name="login_b"  id="phone_b1" placeholder="ЛОГИН ЛИЧНОГО КАБИНЕТА" class="ok-input '.iclass_("login_b",$stack_error,"error_formi").'" autocomplete="off" type="text" value="'.ipost_($_POST['login_b'],"").'">';
		?>	
			</span>
	        </div>   	
                                                   
   <div class="ok-block-input">
			  <div class="ok-input-title">Пароль<i></i></div>
			
			  <span class="ok-i">
        <?
        echo'<input name="password_b"  id="phone_b1" placeholder="ПАРОЛЬ ДЛЯ ВХОДА" class="ok-input '.iclass_("password_b",$stack_error,"error_formi").'" autocomplete="off" type="text" value="'.ipost_($_POST['password_b'],"").'">';
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
		
	$('#fullpage').fullpage({
		//options here
		scrollOverflow:true
	});


});
</script>
