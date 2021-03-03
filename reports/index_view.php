<?
session_start();
$url_system=$_SERVER['DOCUMENT_ROOT'].'/'; include_once $url_system.'module/config.php'; include_once $url_system.'module/function.php'; include_once $url_system.'login/function_users.php'; initiate($link); include_once $url_system.'module/access.php';


$active_menu='reports';  // в каком меню



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


if((isset($_POST['save_reports']))and($_POST['save_reports']==6))
{
	$token=htmlspecialchars($_POST['tk']);
	$id=htmlspecialchars($_GET['id']);
	
	
	//токен доступен в течении 120 минут
	if(token_access_yes($token,'save_reports',$id,120))
    {
		//echo("!");
	//возможно проверка что этот пользователь это может делать
	 if (($role->permission('Отчеты','U'))or($sign_admin==1))
	 {
		 
		$result_url=mysql_time_query($link,'select A.* from reports as A where A.id="'.htmlspecialchars(trim($_GET['id'])).'"');
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
if((htmlspecialchars(trim($_POST['phone_b']))==''))
{
  array_push($stack_error, "phone_b"); 
}

if((($row_list["id_user"]!=$id_user)))
{	
array_push($stack_error, "users_b"); 
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
				

			
			mysql_time_query($link,'update reports set name="'.htmlspecialchars($_POST['name_b']).'",country="'.htmlspecialchars($_POST['phone_b']).'",date_="'.htmlspecialchars(trim($_POST['date_b'])).'",comment="'.htmlspecialchars($_POST['comment_b']).'" where id = "'.htmlspecialchars($_GET['id']).'"');	
			
			
	//добавляем уведомления о новом наряде
				  //добавляем уведомления о новом наряде
				  //добавляем уведомления о новом наряде	
				  $user_send= array();	
				  $user_send_new= array();		

                  $user_send_new=array_merge($hie->boss['4']);

   //создателя договора	
		$text_not='<a href="reports/'.$_GET['id'].'/">Отчет по рекламному туру №'.$_GET['id'].'</a> - "'.htmlspecialchars(trim($_POST['name_b'])).'" был изменен';
        $user_send_new= array_unique($user_send_new);	
		notification_send($text_not,$user_send_new,$id_user,$link);
			 
    //добавляем уведомления о новом наряде
				  //добавляем уведомления о новом наряде
				  //добавляем уведомления о новом наряде	

		
			
			
		 header("Location:".$base_usr."/reports/");	
			 die();
		   
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

if((!$role->permission('Отчеты','R'))and($sign_admin!=1))
{
  header404(3,$echo_r);
}


$result_url=mysql_time_query($link,'select A.* from reports as A where A.id="'.htmlspecialchars(trim($_GET['id'])).'"');
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
if(($sign_admin!=1))
{
if ((!$role->permission('Отчеты','U'))or($row_list["id_user"]!=$id_user))
{	
   $status_edit='readonly';	
   $status_edit1='disabled';
   $status_class='grey_edit';		
}
}



include_once $url_system.'template/html.php'; include $url_system.'module/seo.php';

if($error_header!=404){ SEO('reports_view','','','',$link); } else { SEO('0','','','',$link); }

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

	  include_once $url_system.'template/top_reports_view.php';

	  	  echo'<form id="lalala_add_form" class="my_n" style=" padding:0; margin:0;" method="post" enctype="multipart/form-data"><input name="save_reports" value="6" type="hidden">';
	  
	  	$token=token_access_compile($_GET['id'],'save_reports',$secret);				
						
		echo'<input type="hidden" value="'.$token.'" name="tk">'; 
	  
	 echo'<div id="fullpage" class="margin_60 margin_0 form_4_booking">';
	?>
	<div class="section" id="section0">
	<div class="height_1000vh">

	
	<div class="section" id="section0">
	<div class="height_1000vh">

		

	<div class="div_ook">
	
<!--<span class="add_bo">Добавление новой заявки</span>	-->
	
		
		  
		  	
		  		
		  			
		  				
		  						<div class="ok-block-input">
			  <div class="ok-input-title">Название тура<i></i></div>
			
			  <span class="ok-i">
        <?
        echo'<input name="name_b" '.$status_edit.' id="name_b" placeholder="Название вашего отчета?" class="ok-input '.iclass_("name_b",$stack_error,"error_formi").'" autocomplete="off" type="text" value="'.ipost_($_POST['name_b'],$row_list["name"]).'">';
        ?>
        </span>
         </div>
        <?
		if (($row_list["id_user"]!=$id_user)and($sign_admin!=1))
{					
	?>
				<div class="ok-block-input">
			  <div class="ok-input-title">Страна<i></i></div>
			
			  <span class="ok-i">
        <?
        echo'<input name="phone_b" '.$status_edit.'  id="phone_b" placeholder="Страна тура" class="ok-input  '.iclass_("phone_b",$stack_error,"error_formi").'" autocomplete="off" type="text" value="'.ipost_($_POST['phone_b'],$row_list["country"]).'">';
		?>	
			</span>
		</div>
	
			<div class="ok-block-input">
			  <div class="ok-input-title">Дата поездки<i></i></div>
			
			  <span class="ok-i">
			  	
			  	<?
				  
				  $today[0] = date("Y-m-d"); //присвоено 03.12.01 
			  				      		  
		    echo'<input id="date_hidden_table_gr1" name="date_naryad" value="'.ipost_($_POST['date_naryad'],date_fik($row_list["date_"])).'" class="ok-input '.iclass_("date_b",$stack_error,"error_formi").'"  readonly="true" type="text">';								   



			  	?>
			  	
			  </span>
	        </div>		
	
	
	<?
}
									
		?>
        
        
        
        
	       
	        
	      </div>
        
        <?
				if (($row_list["id_user"]==$id_user)or($sign_admin==1))
{
	?>
	<div class="oka_block">
<div class="oka1">  
	        
	        
				<div class="ok-block-input">
			  <div class="ok-input-title">Страна<i></i></div>
			
			  <span class="ok-i">
        <?
        echo'<input name="phone_b" '.$status_edit.'  id="phone_b" placeholder="Страна тура" class="ok-input  '.iclass_("phone_b",$stack_error,"error_formi").'" autocomplete="off" type="text" value="'.ipost_($_POST['phone_b'],$row_list["country"]).'">';
		?>	
			</span>
	        </div>        
	        
   	        
	        
	
	        
			<div class="ok-block-input">
			  <div class="ok-input-title">Дата поездки<i></i></div>
			
			  <span class="ok-i">
			  	
			  	<?
				  
				  $today[0] = date("Y-m-d"); //присвоено 03.12.01 
			  				      		  
		    echo'<input id="date_hidden_table_gr1" name="date_naryad" value="'.ipost_($_POST['date_naryad'],"").'" class="ok-input '.iclass_("date_b",$stack_error,"error_formi").'"  readonly="true" type="text">
			<input id="date_hidden_table_gr2" name="date_b" value="'.ipost_($_POST['date_b'],$row_list["date_"]).'" readonly="true" type="hidden">';								   



			  	?>
			  	
			  </span>
	        </div>	 	                

</div>
<div class="oka2">	        
<?
if (((!$role->permission('Отчеты','U'))or($row_list["id_user"]!=$id_user))and($sign_admin!=1))
{
echo'<div class="no_edit_cal"></div>';	
}
	
	
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

	var yuu='<? echo($row_list["date_"]); ?>';
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
	<?
}
		?>
        
        
                               
	 </div> 
	 </div> 
				
				
<?

	?>

	  	           
	  	</div>                     
	 </div> 
	 
	     
<div class="section" id="section2">
<div class="height_100vh">

<div class="oka_block">

<div class="oka23" style="width:100%;">

<div class="ok-block-input">
			  <div class="ok-input-title">Общие впечатления<i></i></div>
			
			  <span class="ok-i">
       
     
<script src="/PLUGIN/ckeditor4/ckeditor.js" type="text/javascript"></script>
				  
				  
				  
       <div class="div_textarea_otziv1" >
			<div class="otziv_add">
                 
                   <?
				echo'<textarea cols="10" rows="1" '.$status_edit.' placeholder="Ваши заметки и впечатления по поводу рекламного тура" id="otziv_area_adaxx" name="comment_b" class="di text_area_otziv no_comment_bill">'.ipost_($_POST['comment_b'],$row_list["comment"]).'</textarea>';
				?>
				
				<script type="text/javascript">
var ckeditor = CKEDITOR.replace('otziv_area_adaxx');
</script>
				
            </div>      
</div>  
       
       
       
       </span>
        
        <script type="text/javascript"> 
	  $(function (){ 
//$('#otziv_area_adaxx').autoResize({extraSpace : 10});
$('#otziv_area_adaxx').trigger('keyup');

ToolTip();
});

	</script>
        
	        </div>             
</div>

</div>

</div>	         
	             
	                     
	 </div>
	 
	<div class="section" id="section3">
	<div class="height_1000vh">
	<div class="div_ook">

	

	<div class="ok-block-input"><div class="ok-input-title">Загруженные фото и документы<i></i></div></div>
	<?
$result_score=mysql_time_query($link,'Select a.* from reports_attach as a where a.id_reports="'.htmlspecialchars(trim($_GET['id'])).'"');
	
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
		echo'<i for="'.$row_score["id"].'" data-tooltip="Удалить файл" class="del_image_reports"></i>';
		}
		
		
		if(($row_score["type"]=='jpg')or($row_score["type"]=='jpeg'))
		{
		
		echo'<a target="_blank" href="reports/scan/'.$row_score["id"].'_'.$row_score["name"].'.'.$row_score["type"].'" rel="'.$row_score["id"].'"><div style=" background-image: url(reports/scan/'.$row_score["id"].'_'.$row_score["name"].'.'.$row_score["type"].')"></div></a></li>';
		} else
		{
			
			echo'<a target="_blank" href="reports/scan/'.$row_score["id"].'_'.$row_score["name"].'.'.$row_score["type"].'" rel="'.$row_score["id"].'"><div class="doc_pdf">'.$row_score["type"].'</div></a></li>';		
			
		}
	}
	
	echo'</ul></div>';	
} else
{
	echo'<div class="img_invoice"><ul></ul></div>';	
}
	  	if(($row_list["id_user"]==$id_user)or($sign_admin==1))
	{
			//кнопка выбрать фйл
			echo'<div id_upload="'.htmlspecialchars(trim($_GET['id'])).'" data-tooltip="загрузить файл" class="invoice_upload">Перетащите файл, который Вы хотите прикрепить</div>';
	}
			
	        //форма отправки файла
			$top_dd='<form  class="form_up" id="upload_sc_'.htmlspecialchars(trim($_GET['id'])).'" id_sc="'.htmlspecialchars(trim($_GET['id'])).'" name="upload'.htmlspecialchars(trim($_GET['id'])).'"><input class="sc_sc_loos2" type="file" name="myfile'.htmlspecialchars(trim($_GET['id'])).'"></form>';
			
	
	        //загрузчиик
			echo'<div class="loaderr_scan scap_load_'.htmlspecialchars(trim($_GET['id'])).'" style="width:100%"><div class="scap_load__" style="width: 0%;"></div></div>';
			
	
	?>
</div>
 
 
 
  			
	
	
	</div>
	</div>
	</div>
	 
	 
	 <div class="section" id="section4">
	<div class="oka_block_1">
	<div class="oka1_1">
	 
	 
	 <?
	 
					
  $result_t2=mysql_time_query($link,'Select 
  
  DISTINCT b.*
  
  from reports_answers as b where b.visible=1 and b.id_reports="'.htmlspecialchars(trim($_GET['id'])).'" and b.id_answers=0 order by b.datetimes desc');
	  
		
		
		$sql_count='Select 
  
  count(DISTINCT b.id) as kol
  
  from reports_answers as b where b.visible=1 and b.id_reports="'.htmlspecialchars(trim($_GET['id'])).'" and b.id_answers=0';
			

$result_t221=mysql_time_query($link,$sql_count);	  
$row__221= mysqli_fetch_assoc($result_t221);	  

//echo' <h3 class="head_h" style=" margin-bottom:0px;">Cнабжение<i>'.$row__221["kol"].'</i><div></div></h3> ';	
	

echo'<div class="okss"><span class="title_book yop_booking"><i class="smena_">'.$row__221["kol"].'</i><span class="smena_1">'.PadejNumber($row__221["kol"],'Вопрос к отчету,Вопроса к отчету,Вопросов к отчету').'</span></span></div>';
		
		
	                  $num_results_t2 = $result_t2->num_rows;
	              if($num_results_t2!=0)
	              {
	
				$com=0;
			    $cost=0;
					  $count_y=0;

					  
					  ?>	
				  
					<?  
					  $copy=0;
					  
					  $ty_style='';
					  
					  if($row_list["id_user"]==$id_user)
					  {
					  
					  $ty_style='active_operator_x';
					  }
					  
					  
	       for ($ksss=0; $ksss<$num_results_t2; $ksss++)
                     {

					$row_8= mysqli_fetch_assoc($result_t2);
	
			 

$cll='';
//забронировано						 


echo'<div class="answer_block '.$ty_style.'" op_rel="'.$row_8["id"].'">';
						 
echo'<div class="open_operator"></div>';						 

echo'<span class="h57"><span>'.$row_8["text"].'</span>';

						 
$result_txs=mysql_time_query($link,'Select a.name_user,a.timelast,a.id from r_user as a where a.id="'.$row_8["id_users"].'"');
	            if($result_txs->num_rows!=0)
	            {   
		          $rowxs = mysqli_fetch_assoc($result_txs);
									  $online='';	
				// if(online_user($rowxs["timelast"],$rowxs["id"],$id_user)) { $online='<div class="online"></div>';}	
					
			  echo'<div class="ktoo2">'.$rowxs["name_user"].'</div>';
				} 						 
						 
	$result_txs1=mysql_time_query($link,'Select a.* from reports_answers as a where a.visible=1 and a.id_reports="'.htmlspecialchars(trim($_GET['id'])).'" and a.id_answers="'.$row_8["id"].'"');
	            if($result_txs1->num_rows!=0)
	            {   
		          $rowxs1 = mysqli_fetch_assoc($result_txs1);
				  echo'<span class="yes_ans">(Есть ответ)</span>';	
					
				}
						 
						 
						 
						 
						 echo'</span>';	
					
if($row_8["id_users"]==$id_user)
{		
echo'<div class="font-ranks edit_answer_" data-tooltip="Изменить" id_rel="'.$row_8["id"].'"><span class="font-ranks-inner">}</span></div>';					
} else
{
		echo'<div class="font-ranks"></div>';
}

if(($sign_admin==1)or($row_8["id_users"]==$id_user))
{
echo'<div class="font-ranks del_answer_" data-tooltip="Удалить" id_rel="'.$row_8["id"].'"><span class="font-ranks-inner">x</span></div>';
}	else
{
	echo'<div class="font-ranks"></div>';
}
						 
					  if($row_list["id_user"]==$id_user)
					  {
						  ?>
						  <div class="answer_ rois">
       
       
       <div class="div_textarea_otziv17" ><div class="otziv_add">
                 
                   <?
        echo'<textarea cols="10" rows="1" placeholder="Ваш ответ на вопрос" id="otziv_area_adaxx_'.$row_8["id"].'" name="ann_b" class="di text_area_otziv no_comment_bill ann_b">'.$rowxs1["text"].'</textarea>';
				?>
            </div>      
</div>  
       
       
       
      
        
        <script type="text/javascript"> 
	  $(function (){ 
		  <?
echo "$('#otziv_area_adaxx_".$row_8["id"]."').autoResize({extraSpace : 10});
$('#otziv_area_adaxx_".$row_8["id"]."').trigger('keyup');";
						  ?>

});

	</script>
        <div class="save_anna"  data-tooltip="сохранить ответь">сохранить</div>
	        </div>  
					<?	  
						  
					  } else
						{  
						 
						 
	         if($result_txs1->num_rows!=0)
	            { 					 
echo'<div class="answer_ rois">'.nl2br($rowxs1["text"]).'</div>';						 
				}
							
						}
						 						
echo'</div>';						 


								  
						 
					 }
 
					  

					  
					  
 } else
				  {
					  
//echo'<div class="booking_div da_book1"><div class="not_booling"></div><span class="h4"><span>Вопросов по отчету пока нет.</span></span></div>';
					  
				  }	
		
		
	if($row_list["id_user"]!=$id_user)	
	{
	echo'<div class="add_sourse_reports" for="'.$_GET['id'].'">Добавить вопрос к отчету</div>';	
	}
		
		
	 ?>

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
