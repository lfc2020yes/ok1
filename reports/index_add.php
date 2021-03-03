<?
session_start();

$active_menu='reports';  // в каком меню


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


if((isset($_POST['save_reports']))and($_POST['save_reports']==1))
{
	$token=htmlspecialchars($_POST['tk']);
	
	
	//токен доступен в течении 120 минут
	if(token_access_yes($token,'add_reports',2005,120))
    {
		//echo("!");
	//возможно проверка что этот пользователь это может делать
	 if (($role->permission('Отчеты','A'))or($sign_admin==1))
	 {	
	$stack_error = array();  // общий массив ошибок

	//print_r($stack_error);
	//исполнитель			

if((htmlspecialchars(trim($_POST['name_b']))==''))
{
  array_push($stack_error, "name_b"); 
}
if((htmlspecialchars(trim($_POST['phone_b']))==''))
{
  array_push($stack_error, "phone_b"); 
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
			
			
			
			 mysql_time_query($link,'INSERT INTO reports (id_user,name,date_,country,comment,datetimes,visible) VALUES ("'.$id_user.'","'.htmlspecialchars(trim($_POST['name_b'])).'","'.htmlspecialchars(trim($_POST['date_b'])).'","'.htmlspecialchars(trim($_POST['phone_b'])).'","'.htmlspecialchars(trim($_POST['comment_b'])).'","'.$date_.'",1)');
			 
			 $ID_N=mysqli_insert_id($link);  
			
			
				//добавляем уведомления о новом наряде
				  //добавляем уведомления о новом наряде
				  //добавляем уведомления о новом наряде	
				  $user_send= array();	
				  $user_send_new= array();		

                  $user_send_new=array_merge($hie->boss['4']);

   //создателя договора	
		$text_not='<a href="reports/'.$ID_N.'/">Отчет по рекламному туру №'.$ID_N.'</a> - '.htmlspecialchars(trim($_POST['name_b'])).' был добавлен в систему';
        $user_send_new= array_unique($user_send_new);	
		notification_send($text_not,$user_send_new,$id_user,$link);
			 
    //добавляем уведомления о новом наряде
				  //добавляем уведомления о новом наряде
				  //добавляем уведомления о новом наряде	
			
			
			 header("Location:".$base_usr."/reports/".$ID_N.'/');	
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

if((!$role->permission('Отчеты','A'))and($sign_admin!=1))
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

if($error_header!=404){ SEO('reports_add','','','',$link); } else { SEO('0','','','',$link); }

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

	  include_once $url_system.'template/top_reports_add.php';

	  echo'<form id="lalala_add_form" class="my_n" style=" padding:0; margin:0;" method="post" enctype="multipart/form-data"><input name="save_reports" value="1" type="hidden">';
	  
	  	$token=token_access_compile(2005,'add_reports',$secret);				
						
		echo'<input type="hidden" value="'.$token.'" name="tk">'; 
	  
	 echo'<div id="fullpage" class="margin_60 form_30_booking">';
	?>
	<div class="section" id="section0">
	<div class="height_100vh">

		

	<div class="div_ook">
	
<!--<span class="add_bo">Добавление новой заявки</span>	-->
	
		
		  
		  	
		  		
		  			
		  				
		  						<div class="ok-block-input">
			  <div class="ok-input-title">Название тура<i></i></div>
			
			  <span class="ok-i">
        <?
        echo'<input name="name_b" id="name_b" placeholder="Название вашего отчета?" class="ok-input '.iclass_("name_b",$stack_error,"error_formi").'" autocomplete="off" type="text" value="'.ipost_($_POST['name_b'],"").'">';
        ?>
        </span>
	        </div>
	        
	      </div>
        
          <div class="oka_block">
<div class="oka1">  
	        
	        
				<div class="ok-block-input">
			  <div class="ok-input-title">Страна<i></i></div>
			
			  <span class="ok-i">
        <?
        echo'<input name="phone_b"  id="phone_b" placeholder="Страна тура" class="ok-input  '.iclass_("phone_b",$stack_error,"error_formi").'" autocomplete="off" type="text" value="'.ipost_($_POST['phone_b'],"").'">';
		?>	
			</span>
	        </div>        
	        
   	        
	        
	
	        
			<div class="ok-block-input">
			  <div class="ok-input-title">Дата поездки<i></i></div>
			
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
	                                
	 <!--       
	        
				        
	        
	        
      -->
	                                
	        
	        
	        
	  	 </div>
	  	 
	  	      
	  	           
	  	</div>                     
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
				echo'<textarea cols="10" rows="1" '.$status_edit.' placeholder="Ваши заметки и впечатления по поводу рекламного тура" id="otziv_area_adaxx" name="comment_b" class="di text_area_otziv no_comment_bill">'.ipost_($_POST['comment_b'],"").'</textarea>';
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

});
</script>
