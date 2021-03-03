<?
session_start();

$active_menu='booking';  // в каком меню


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

if((isset($_POST['save_booking']))and($_POST['save_booking']==1))
{
	$token=htmlspecialchars($_POST['tk']);
	
	
	//токен доступен в течении 120 минут
	if(token_access_yes($token,'add_booking_lf',2005,120))
    {
		//echo("!");
	//возможно проверка что этот пользователь это может делать
	 if (($role->permission('Заявки','A'))or($sign_admin==1))
	 {	
	$stack_error = array();  // общий массив ошибок

	//print_r($stack_error);
	//исполнитель			
	if((htmlspecialchars(trim($_POST['sourse_b']))=='')or(htmlspecialchars(trim($_POST['sourse_b']))=='0'))
{
  array_push($stack_error, "sourse_b"); 
}
	
	if(isset($_POST["dot_b_op"]))
	{		
		if((htmlspecialchars(trim($_POST['dot_b_op']))=='')or(htmlspecialchars(trim($_POST['dot_b_op']))=='0')) { array_push($stack_error, "dot_b_op");  }
	} else
	{
			if(count($hie_object)>1)
	        {
				array_push($stack_error, "dot_b_op");
			}
	}
		 
		 
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
		//   array_push($stack_error, "name_client_b"); 
if((htmlspecialchars(trim($_POST['client_new1_search']))==0))
{		 
		 
if((htmlspecialchars(trim($_POST['name_client_b']))==''))
{
  array_push($stack_error, "name_client_b"); 
}	
} else
{
	 //array_push($stack_error, "name_client_id"); 
	//связали с клиентом сразу
	if((htmlspecialchars(trim($_POST['id_search_client1']))==0))
{
  array_push($stack_error, "name_client_id"); 
}
	
}
		 
		 
	if((htmlspecialchars(trim($_POST['date_b']))==''))
{
  array_push($stack_error, "date_b"); 
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
			if(isset($_POST["dot_b_op"]))
	       {
			   $object=$_POST["dot_b_op"];
		   } else
		   {
			   $object=$hie_object[0];
		   }
			  $id_client=0;
			$name_client=htmlspecialchars(trim($_POST['name_client_b']));
				$phone_client=htmlspecialchars(trim($_POST['phone_b']));
			if((htmlspecialchars(trim($_POST['client_new1_search']))==1))
             {	
				$id_client=htmlspecialchars(trim($_POST['id_search_client1']));
				$name_client='';
				$phone_client='';	
			}
			
			 mysql_time_query($link,'INSERT INTO booking (id_user,id_object,title,datetime,id_booking_sourse,id_client,phone,name,status,comment,date_create,visible) VALUES ("'.$id_user.'","'.htmlspecialchars(trim($object)).'","'.htmlspecialchars(trim($_POST['name_b'])).'","'.htmlspecialchars(trim($_POST['date_b'])).'","'.htmlspecialchars(trim($_POST['sourse_b'])).'","'.$id_client.'","'.$phone_client.'","'.$name_client.'","5","'.htmlspecialchars(trim($_POST['comment_b'])).'","'.$date_.'","1")');
			 
			 $ID_N=mysqli_insert_id($link);  
			
			
//изменение статуса добавление в историю     
mysql_time_query($link,'INSERT INTO booking_status_history (id_booking,id_user,datetime,status,comment) VALUES ("'.$ID_N.'","'.$id_user.'","'.date("y.m.d").' '.date("H:i:s").'","5","")');
//изменение статуса добавление в историю
			
			
			 header("Location:".$base_usr."/booking/".$ID_N.'/yes/');	
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

if((!$role->permission('Заявки','A'))and($sign_admin!=1))
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

if($error_header!=404){ SEO('booking_add','','','',$link); } else { SEO('0','','','',$link); }

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

	  include_once $url_system.'template/top_booking_add.php';

	  echo'<form id="lalala_add_form" class="my_n" style=" padding:0; margin:0;" method="post" enctype="multipart/form-data"><input name="save_booking" value="1" type="hidden">';
	  
	  	$token=token_access_compile(2005,'add_booking_lf',$secret);				
						
		echo'<input type="hidden" value="'.$token.'" name="tk">'; 
	  
	 echo'<div id="fullpage" class="margin_60 form_1_booking">';
	?>
	<div class="section" id="section0">
	<div class="height_100vh">

		
	<?
	//если форма вернулась значит что то пошло не так. выводим сообщение об этом		
if((isset($_POST['save_booking']))and($_POST['save_booking']==1))
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
			  <div class="ok-input-title">Название заявки<i></i></div>
			
			  <span class="ok-i">
        <?
        echo'<input name="name_b" id="name_b" placeholder="Название новой заявки?" class="ok-input '.iclass_("name_b",$stack_error,"error_formi").'" autocomplete="off" type="text" value="'.ipost_($_POST['name_b'],"").'">';
        ?>
        </span>
	        </div>
	        
			<div class="ok-block-input">
			  <div class="ok-input-title">Комментарий<i></i></div>
			
			  <span class="ok-i">
       
       
       <div class="div_textarea_otziv1" >
			<div class="otziv_add">
                 
                   <?
        echo'<textarea cols="10" rows="1" placeholder="Ваши заметки и комментарии по поводу заявки" id="otziv_area_adaxx" name="comment_b" class="di text_area_otziv no_comment_bill">'.ipost_($_POST['comment_b'],"").'</textarea>';
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
<div class="oka1">
<?
	
echo'<div class="div_ook_grei_client_add">';
/*	
if(ipost_($_POST["client_new1_search"],0)!=0)
{
*/
	$active_radio2='active_radio';
	$active_radio1='';
	$radio_bk=1;
/*
	} else
{
	$active_radio1='active_radio';
	$active_radio2='';
	$radio_bk=0;
}
*/	
	
?>
			<div class="ok-block-input">
					 
			 
			  <span class="ok-i jipp_34">

<div class="radioselect">

<?

/*
	  
	echo'<div class="radio_material add_radio_yy_client '.$active_radio1.'" radio_id="0"><div class="table r_mat"><div class="table-cell radio_wall"><div class="st_div_radio  radio_checkbox"><i></i></div><input class="rt_wall_radio radio_0" name="radio_r0" value="0" type="hidden"></div><div class="table-cell name_radio wallr1 xx_32">Неизвестный клиент</div></div></div>';
*/	  
	  
	echo'<div class="radio_material add_radio_yy_client '.$active_radio2.'" radio_id="1"><div class="table r_mat"><div class="table-cell radio_wall"><div class="st_div_radio  radio_checkbox"><i></i></div><input class="rt_wall_radio radio_1" name="radio_r1" value="1" type="hidden"></div><div class="table-cell name_radio wallr1 xx_32">Найти клиента</div></div></div>';	  
	  
		

echo'<input value="'.$radio_bk.'" id="radio_bk66" class="radio_b" name="client_new1_search" type="hidden">	';
		?>
</div>
 </span>
	        </div>

</div>	
	<?
	/*
	if(ipost_($_POST["client_new1_search"],0)!=0)
    {
	echo'<div class="one_client_box_add" style="display:none;">';
	} else
	{*/
	echo'<div class="one_client_box_add" style="display:none;">';	
	//}
	
	?>
	
			<div class="ok-block-input">
			  <div class="ok-input-title">Телефон<i></i></div>
			
			  <span class="ok-i">
        <?
        echo'<input name="phone_b"  id="phone_b" placeholder="Номер клиента для связи" class="ok-input phone_us1 '.iclass_("phone_b",$stack_error,"error_formi").'" autocomplete="off" type="text" value="'.ipost_($_POST['phone_b'],"").'">';
		?>	
			</span>
	        </div>
			<div class="ok-block-input">
			  <div class="ok-input-title">Имя<i></i></div>
			
			  <span class="ok-i"><?
        echo'<input name="name_client_b" id="name_client_b" placeholder="Имя вашего клиента" class="ok-input '.iclass_("name_client_b",$stack_error,"error_formi").'" autocomplete="off" type="text" value="'.ipost_($_POST['name_client_b'],"").'">';
				  ?>
        </span>
	        </div>	 
	
	<?
	echo'</div>';
	/*
		if(ipost_($_POST["client_new1_search"],0)==0)
    {
	echo'<div class="two_client_box_add" style="display:none;">';
	} else
	{*/
	echo'<div class="two_client_box_add" >';	
	//}
	
	
	echo'<div class="help_search_client">Для поиска клиента введите Имя, фамилию, отчество или все сразу. Так же клиента можно найти по телефону (без первой 8/+7) или по специальному коду клиента</div>';
	
	
	echo'<input type="hidden" value="'.ipost_($_POST["id_search_client1"],0).'" name="id_search_client1">';
	
	?>
	<div class="fox_search_client1">
			
			<?
			if(ipost_($_POST["id_search_client1"],0)!=0)
        {
	
			$result_tty=mysql_time_query($link,'Select b.code,b.fio,b.phone from k_clients as b where b.id="'.htmlspecialchars(trim($_POST["id_search_client1"])).'"');
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
	?>
	        
			<div class="ok-block-input">
			  <div class="ok-input-title">Дата обращения<i></i></div>
			
			  <span class="ok-i">
			  	
			  	<?
				  
				 $today[0] = date("Y-m-d"); //присвоено 03.12.01 
			  				      		  
		    echo'<input id="date_hidden_table_gr1" name="date_naryad" value="'.ipost_($_POST['date_naryad'],"").'" class="ok-input"  readonly="true" type="text">
			<input id="date_hidden_table_gr2" name="date_b" value="'.ipost_($_POST['date_b'],$today[0]).'" readonly="true" type="hidden">';								   

			  	?>
			  	
			  </span>
	        </div>	 	                

</div>
<div class="oka2">

<div id="date_table_gr1"></div>
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
}
	?> 

            </script>	  
</div>

</div>
	
	
	
</div></div> 
	  
	
<div class="section" id="section3">
<div class="height_100vh">
<div class="oka_block column_flex"> 

<div class="div_ook_grei1">

			<div class="ok-block-input">
			 <div class="ok-input-title">Источник обращения<i></i></div>
		</div></div></div>	 
			 <?
		
	echo'<div class="div_ook_grei sourse_error '.iclass_("sourse_b",$stack_error,"error_formi").'">';
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
	  
	 $rtt='';
			   if($_POST['radio_r'.$row_tor["id"]]==1)
			   {
				  	 $rtt='active_wall'; 
			   }  
	  
	echo'<div class="radio_material '.$rtt.' add_radio_yy" radio_id="'.$row_tor["id"].'"><div class="table r_mat"><div class="table-cell radio_wall"><div class="st_div_radio  radio_checkbox"><i></i></div><input class="rt_wall_radio radio_'.$row_tor["id"].'" name="radio_r'.$row_tor["id"].'" value="'.ipost_($_POST['radio_r'.$row_tor["id"]],"0").'" type="hidden"></div><div class="table-cell name_radio wallr1 xx_32">'.$row_tor["object_name"].'</div></div></div>';
	  
  }
	
}		

		

echo'<input value="'.ipost_($_POST['dot_b_op'],"").'" id="radio_bk" class="radio_b" name="dot_b_op" type="hidden">';
		?>
</div>
 </span>
	        </div>

</div>
<?
	}
	  ?>
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
		$('#name_b').focus();
		
	$('#fullpage').fullpage({
		//options here
		scrollOverflow:true
	});


});
</script>
