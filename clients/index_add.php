<?
session_start();

$active_menu='clients';  // в каком меню


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
//print_r($hie_object);

if((isset($_POST['save_clients']))and($_POST['save_clients']==1))
{
	$token=htmlspecialchars($_POST['tk']);
	
	
	//токен доступен в течении 120 минут
	if(token_access_yes($token,'add_clients_lf',2005,120))
    {
		//echo("!");
	//возможно проверка что этот пользователь это может делать
	 if (($role->permission('Клиенты','A'))or($sign_admin==1))
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
if((htmlspecialchars(trim($_POST['phone_b']))==''))
{
  array_push($stack_error, "phone_b"); 
}	
		 
if((htmlspecialchars(trim($_POST['day_b']))==''))
{
  array_push($stack_error, "day_b"); 
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
			
			 
			$object=0;	 
			
$date_end1=explode(".",htmlspecialchars(trim($_POST["day_b"])));	
$date_cl=$date_end1[2].'-'.$date_end1[1].'-'.$date_end1[0];
	
//+7 (902) 129-68-34
$phone_base=explode(" ",htmlspecialchars(trim($_POST["phone_b"])));	
$phone_base1=explode("-",$phone_base[2]);	

$phone_end=	$phone_base[1][1].$phone_base[1][2].$phone_base[1][3].$phone_base1[0].$phone_base1[1].$phone_base1[2];


	$result_tcc=mysql_time_query($link,'Select max(b.code) as cc from k_clients as b');
           $num_results_tcc = $result_tcc->num_rows;
	       if($num_results_tcc!=0)
	       {	
			 
			 $row_tcc = mysqli_fetch_assoc($result_tcc);
			  $code= (int)$row_tcc["cc"]+1;
		   }			
			
			
			 mysql_time_query($link,'INSERT INTO k_clients (code,id_company,id_user,company,fio,phone,email,date_birthday,datetime,comment,visible) VALUES ("'.$code.'","0","'.$id_user.'","'.htmlspecialchars(trim($_POST['company_b'])).'","'.htmlspecialchars(trim($_POST['name_b'])).'","'.htmlspecialchars(trim($phone_end)).'","'.htmlspecialchars(trim($_POST['email_b'])).'","'.htmlspecialchars(trim($date_cl)).'","'.$date_.'","'.htmlspecialchars(trim($_POST['comment_b'])).'","1")');
			 
			 $ID_N=mysqli_insert_id($link);  
	
			if($_POST['sourse_b']!='')
{	
	$c_op=explode(',',$_POST['sourse_b']);
	 for ($op=0; $op<count($c_op); $op++)
     {
	 mysql_time_query($link,'INSERT INTO k_clients_options (id_k_clients,id_option) VALUES ("'.$ID_N.'","'.htmlspecialchars(trim($c_op[$op])).'")');
	 }
			
}
			

			
			 header("Location:".$base_usr."/clients/?a=yes");	
			 die();
		   
		}
	

}

}
	
	
}



$secret=rand_string_string(4);
$_SESSION['s_t'] = $secret;	



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

if((!$role->permission('Клиенты','A'))and($sign_admin!=1))
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

if($error_header!=404){ SEO('clients_add','','','',$link); } else { SEO('0','','','',$link); }

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

	  include_once $url_system.'template/top_clients_add.php';

	  echo'<form id="lalala_add_form" class="my_n" style=" padding:0; margin:0;" method="post" enctype="multipart/form-data"><input name="save_clients" value="1" type="hidden">';
	  
	  	$token=token_access_compile(2005,'add_clients_lf',$secret);				
						
		echo'<input type="hidden" value="'.$token.'" name="tk">'; 
	  
	 echo'<div id="fullpage" class="margin_60 form_20_booking">';
	?>
	<div class="section" id="section0">
	<div class="height_100vh">

	<?
	//если форма вернулась значит что то пошло не так. выводим сообщение об этом		
if((isset($_POST['save_clients']))and($_POST['save_clients']==1))
{
?>
<div class="div_ook js-hide-div p_bot">
<div class="help_div da_book1 da_book_red js-hide-help"><div class="not_boolingh"></div><span class="h5"><span>Что-то пошло не так. Пожалуйста попробуйте ещё раз. Либо поменяйте необходимые данные</span></span></div>
<script type="text/javascript">
$(function (){ setTimeout ( function () { $('.js-hide-div').slideUp("slow");	}, 5000 );});
</script>
</div>	
<?
}
?>

	<div class="div_ook">

	
		
<!--<span class="add_bo">Добавление новой заявки</span>	-->
	
			<div class="ok-block-input">
			  <div class="ok-input-title">ФИО клиента<i></i></div>
			
			  <span class="ok-i">
        <?
        echo'<input name="name_b" id="name_b" placeholder="ФИО КЛИЕНТА" class="ok-input '.iclass_("name_b",$stack_error,"error_formi").' no_upperr" autocomplete="off" type="text" value="'.ipost_($_POST['name_b'],"").'">';
        ?>
        </span>
	        </div>
		
		
					<div class="ok-block-input">
			  <div class="ok-input-title">Телефон<i></i></div>
			
			  <span class="ok-i">
        <?
        echo'<input name="phone_b"  id="phone_b" placeholder="Номер клиента для связи" class="ok-input phone_us1 '.iclass_("phone_b",$stack_error,"error_formi").'" autocomplete="off" type="text" value="'.ipost_($_POST['phone_b'],"").'">';
		?>	
			</span>
	        </div>
		
		
					<div class="ok-block-input">
			  <div class="ok-input-title">День роджения<i></i></div>
			
			  <span class="ok-i">
        <?
        echo'<input name="day_b"  id="day_b" placeholder="Номер клиента для связи" class="ok-input date_picker_x '.iclass_("day_b",$stack_error,"error_formi").'" autocomplete="off" type="text" value="'.ipost_($_POST['day_b'],"").'">';
		?>	
			</span>
	        </div>

				<div class="ok-block-input">
			  <div class="ok-input-title">Почта</div>
			
			  <span class="ok-i">
        <?
        echo'<input name="email_b" id="email_b" placeholder="ЭЛЕКТРОННАЯ ПОЧТА" class="ok-input '.iclass_("email_b",$stack_error,"error_formi").' no_upperr" autocomplete="off" type="text" value="'.ipost_($_POST['email_b'],"").'">';
        ?>
        </span>
	        </div>	
	
	
						<div class="ok-block-input">
			  <div class="ok-input-title">Компания</div>
			
			  <span class="ok-i">
        <?
        echo'<input name="company_b" id="company_b" placeholder="Из какой компании" class="ok-input '.iclass_("company_b",$stack_error,"error_formi").'" autocomplete="off" type="text" value="'.ipost_($_POST['company_b'],"").'">';
        ?>
        </span>
	        </div>	
		
	        
			<div class="ok-block-input">
			  <div class="ok-input-title">Комментарий<i></i></div>
			
			  <span class="ok-i">
       
       
       <div class="div_textarea_otziv1" >
			<div class="otziv_add">
                 
                   <?
        echo'<textarea cols="10" rows="1" placeholder="Ваши заметки и комментарии по поводу клиента" id="otziv_area_adaxx" name="comment_b" class="di text_area_otziv no_comment_bill">'.ipost_($_POST['comment_b'],"").'</textarea>';
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
	  	 
	  	      
<!--	  	           
	  	</div>                     
	 </div> 
	 
	     
<div class="section" id="section2">
<div class="height_100vh">
-->
<div class="oka_block" style="margin-bottom: 40px">


</div>
	
	
	
</div></div> 
	  
	
<div class="section" id="section3">
<div class="height_100vh4">
<div class="oka_block column_flex"> 

<div class="div_ook_grei1">

			<div class="ok-block-input">
			 <div class="ok-input-title">Особенности клиента</div>
		</div></div></div>	 
			 <?
		
	echo'<div class="div_ook_grei sourse_error '.iclass_("sourse_b",$stack_error,"error_formi").'">';
?>
			<div class="ok-block-input">
					 
			 
			  <span class="ok-i">
			<?  	
echo'<div class="cha_1 active_option cha_77 ">';		
				
			
					$result_work_zz=mysql_time_query($link,'Select a.* from options_client as a where a.visible=1 order by a.displayOrder');

						 
		//echo 'Select a.*,b.id as idd,b.id_user,b.id_object from z_doc_material as a,z_doc as b,i_material as c where a.id_i_material=c.id and a.id_doc=b.id and a.id_stock="'.$row__2["id_stock"].'"  and b.id_object in('.implode(',', $hie->obj ).') AND a.status NOT IN ("1","8","10","3","5","4") '.$sql_su2_.' '.$sql_su3_.' '.$sql_su1_;				 
						 
						 
        $num_results_work_zz = $result_work_zz->num_rows;
	    if($num_results_work_zz!=0)
	    {

	
	
		  $id_work=0;
			
		   for ($i=0; $i<$num_results_work_zz; $i++)
		   {			   			  			   
			   $row_work_zz = mysqli_fetch_assoc($result_work_zz);

			   	 $rtt='';
			   if($_POST['material_r'.$row_work_zz["id"]]==1)
			   {
				  	 $rtt='active_wall'; 
			   }
			    
			   

				  echo'<div class="wallet_material  '.$rtt.'" wall_id="'.$row_work_zz["id"].'">
			  <div class="table w_mat">
			      <div class="table-cell one_wall"><div class="st_div_wall  wallet_checkbox"><i></i></div><input class="rt_wall yop_'.$row_work_zz["id"].'" name="material_r'.$row_work_zz["id"].'" value="'.ipost_($_POST['material_r'.$row_work_zz["id"]],"0").'" type="hidden"></div>';				
				
					
			      echo'<div class="table-cell name_wall wall1">'.$row_work_zz["name"].'</div>
			      
			  </div>
			</div>';
						  
					
				
			   
			   
			   
		   }
		echo'<input type="hidden" value="'.ipost_($_POST['sourse_b'],"").'" id="sourse_b" class="sourse_b" name="sourse_b">';
			
		}
				
			?>
			
			
	
			</div>				  	
			  	
			  </span>
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
		 
		$('.date_picker_x').inputmask("datetime",{
    mask: "1.2.y", 
    placeholder: "dd.mm.yyyy",  
    separator: ".", 
    alias: "dd.mm.yyyy"
  });
	
		

});
</script>
