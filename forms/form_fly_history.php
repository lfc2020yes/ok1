<?php
//форма отказались от предложений

$url_system=$_SERVER['DOCUMENT_ROOT'].'/';
include_once $url_system.'module/ajax_access.php';


//создание секрет для формы
$secret=rand_string_string(4);
$_SESSION['s_form'] = $secret;

$status=0;





if((!isset($_SESSION["user_id"]))or(!is_numeric(id_key_crypt_encrypt($_SESSION["user_id"]))))
{	
	goto end_code;
}

$id_user=id_key_crypt_encrypt($_SESSION["user_id"]);

//проверить есть ли переменная id и можно ли этому пользователю это делать
if ((count($_GET) != 1)or(!isset($_GET["id"]))or((!is_numeric($_GET["id"])))) 
{
	goto end_code;	
}	
	


$result_t=mysql_time_query($link,'Select b.status,b.start_fly,b.end_fly from booking_offers as b where b.id="'.htmlspecialchars(trim($_GET['id'])).'"');
$num_results_t = $result_t->num_rows;
if($num_results_t==0)
{	
		$debug=h4a(5,$echo_r,$debug);
		goto end_code;
	
} else
{
	$row_score = mysqli_fetch_assoc($result_t);
	
	if(($row_score["status"]!=2))
	{
		$debug=h4a(8,$echo_r,$debug);
		goto end_code;		
	}
}


if ((!$role->permission('Заявки','U'))and($sign_admin!=1))
{
    goto end_code;	
}

//составление секретного ключа формы
//составление секретного ключа формы
//соль для данного действия
$token=token_access_compile($_GET['id'],'bt_fly_history',$secret);
//составление секретного ключа формы
//составление секретного ключа формы
//составление секретного ключа формы



$status=1;
	   



?>
<div id="Modal-one" class="box-modal table-modal eddd1 history_window1"><div class="box-modal-pading">			    
<div class="top_modal">
	
	
	
  <div class="box-modal_close arcticmodal-close"></div>
  <? echo'<h1 class="h111" mor="'.$token.'" for="'.htmlspecialchars(trim($_GET['id'])).'"><span>История изменения времени и даты вылета</span></h1>'; ?>
  
  
  
</div>
<div class="center_modal">
<?
echo'<form id="vino_xd" style=" padding:0; margin:0;" method="get" enctype="multipart/form-data">';
echo'<input type="hidden" value="'.htmlspecialchars(trim($_GET['id'])).'" name="id">';
echo'<input type="hidden" value="'.$token.'" name="tk">';		

echo'<div class="comme" style="margin-bottom:20px;">Здесь вы можете увидеть как менялись данные по вылету.</div>';	
			$result_mi=mysql_time_query($link,'SELECT a.id_users,a.start_fly,a.end_fly,a.datetime FROM booking_offers AS a WHERE a.id="'.htmlspecialchars(trim($_GET['id'])).'"');	

                if($result_mi->num_rows!=0)
                {  
                   $row_mi = mysqli_fetch_assoc($result_mi);
	$start_mi=$row_mi["start_fly"];
	$end_mi=$row_mi["end_fly"];	
					
	$start_happy=$row_mi["start_fly"];
	$end_happy=$row_mi["end_fly"];						
				}
	
			if($start_mi!='0000-00-00 00:00:00')
				  {
					   $date_start=explode(" ",htmlspecialchars(trim($start_mi)));
				   $date_start1=explode("-",htmlspecialchars(trim($date_start[0])));
				  $date_start2=explode(":",htmlspecialchars(trim($date_start[1])));
				   $startx='<i>'.$date_start1[2].'.'.$date_start1[1].'.'.$date_start1[0].'</i> '.$date_start2[0].':'.$date_start2[1];		
				  } else
				  {
					  $startx='';
				  }
					  if($end_mi!='0000-00-00 00:00:00')
				  {	
	   $date_end=explode(" ",htmlspecialchars(trim($end_mi)));
				   $date_end1=explode("-",htmlspecialchars(trim($date_end[0])));
				  $date_end2=explode(":",htmlspecialchars(trim($date_end[1])));
				   $endx='<i>'.$date_end1[2].'.'.$date_end1[1].'.'.$date_end1[0].'</i> '.$date_end2[0].':'.$date_end2[1];		} else
					  {
						$endx='';  
					  }
	$payuser='';

$result_tp=mysql_time_query($link,'Select b.name_small from r_user as b where b.id="'.$row_mi["id_users"].'"');
$num_results_tp = $result_tp->num_rows;
if($num_results_tp!=0)
{	
	$row_score12p = mysqli_fetch_assoc($result_tp);
	$payuser=$row_score12p["name_small"];
}
	
	
	//получаем начальные даты при продаже путевки
	echo'<div class="history_string_fly blue_history">
	   <div class="i_string">Время вылетов на момент подбора путевки<br> <span>'.time_stamp_dd1($row_mi["datetime"]).' - '.$payuser.'</span></div>
	   <div class="cost_string">'.$startx.'</div>';
	   echo'<div class="cost_string">'.$endx.'</div>';
	echo'</div>';	
	
	
	//получаем все даты по этому предложению по предложению
	$result_mi=mysql_time_query($link,'SELECT a.* FROM booking_offers_fly_history AS a WHERE a.id_offers="'.htmlspecialchars(trim($_GET['id'])).'" and not(a.datetime="'.$row_mi["datetime"].'") order by a.datetime');	
        $num_results_mi = $result_mi->num_rows;
	    if($num_results_mi!=0)
	    {
			   for ($itt=0; $itt<$num_results_mi; $itt++)
		       {			   			  			   
			       $row_mi = mysqli_fetch_assoc($result_mi);
				   
				   	$start_mi=$row_mi["start_fly"];
	$end_mi=$row_mi["end_fly"];		

			$razn_d=dateDiff_min($start_mi,$start_happy);	   
				   $class_start='';
				   if($razn_d>0)
				   {
					   //плохо отпуск уменьшился
					  $class_start='red_end'; 
				   }
				   if($razn_d<0)
				   {
					   //хорошо
					  $class_start='green_end'; 
				   }				   
	
			$razn_d=dateDiff_min($end_mi,$end_happy);	   
				   $class_end='';
				   if($razn_d<0)
				   {
					   //плохо отпуск уменьшился
					  $class_end='red_end'; 
				   }
				   if($razn_d>0)
				   {
					   //хорошо
					  $class_end='green_end'; 
				   }		   
				   
				   
			if($start_mi!='0000-00-00 00:00:00')
				  {
					   $date_start=explode(" ",htmlspecialchars(trim($start_mi)));
				   $date_start1=explode("-",htmlspecialchars(trim($date_start[0])));
				  $date_start2=explode(":",htmlspecialchars(trim($date_start[1])));
				   $startx='<i>'.$date_start1[2].'.'.$date_start1[1].'.'.$date_start1[0].'</i> '.$date_start2[0].':'.$date_start2[1];		
				  } else
				  {
					  $startx='';
				  }
					  if($end_mi!='0000-00-00 00:00:00')
				  {	
	   $date_end=explode(" ",htmlspecialchars(trim($end_mi)));
				   $date_end1=explode("-",htmlspecialchars(trim($date_end[0])));
				  $date_end2=explode(":",htmlspecialchars(trim($date_end[1])));
				   $endx='<i>'.$date_end1[2].'.'.$date_end1[1].'.'.$date_end1[0].'</i> '.$date_end2[0].':'.$date_end2[1];		} else
					  {
						$endx='';  
					  }
	$payuser='';

$result_tp=mysql_time_query($link,'Select b.name_small from r_user as b where b.id="'.$row_mi["id_user"].'"');
$num_results_tp = $result_tp->num_rows;
if($num_results_tp!=0)
{	
	$row_score12p = mysqli_fetch_assoc($result_tp);
	$payuser=$row_score12p["name_small"];
}
	
	
	//получаем начальные даты при продаже путевки
	echo'<div class="history_string_fly">
	   <div class="i_string">'.time_stamp_dd1($row_mi["datetime"]).'&nbsp;<span>('.$payuser.')</span></div>
	   <div class="cost_string time1_mi '.$class_start.'"><i class="oo_o"></i>'.$startx.'</div>';
	   echo'<div class="cost_string time2_mi '.$class_end.'"><i class="oo_o"></i>'.$endx.'</div>';
	echo'</div>';	
				   	$start_happy=$row_mi["start_fly"];
	$end_happy=$row_mi["end_fly"];	
			   }
		}
	
	//ИТОГИ
		//получаем начальные даты при продаже путевки
	echo'<div class="history_string_fly green_history">
	   <div class="i_string">Конечное время</div>
	   <div class="cost_string">'.$startx.'</div>';
	   echo'<div class="cost_string">'.$endx.'</div>';
	echo'</div>';	
    
?>
</div>
	
</form>
</div>		
<div class="bottom_modal">			
 <span class="clock_table"></span>
 		
            
</div>              
</div></div>
<?



 

end_code:		   
		   
if($status==0)
{
	//что то не так. Почему то бронировать нельзя
	header("HTTP/1.1 404 Not Found");
	header("Status: 404 Not Found");    
	die ();	
}
/*

						 $datetime1 = date_create('Y-m-d');
                         $datetime2 = date_create('2017-01-17');
						 
                         $interval = date_create(date('Y-m-d'))->diff( $datetime2	);				 
                         $date_plus=$interval->days;
						 */
						 //echo(dateDiff_(date('Y-m-d'),'2017-01-17'));
						 


?>
<script type="text/javascript">initializeTimer();</script>
<?
include_once $url_system.'template/form_js.php';
?>

 <script type="text/javascript">
 $(document).ready(function(){ 
	  input_2018();	
$('.money_mask1').inputmask("numeric", {
    radixPoint: ".",
    groupSeparator: " ",
    digits: 2,
    autoGroup: true,
    prefix: '', //No Space, this will truncate the first character
    rightAlign: false,
    oncleared: function () { self.Value(''); }
});
	 
		$('.date_time_picker').inputmask("datetime",{
    mask: "1.2.y h:s", 
    placeholder: "dd.mm.yyyy hh:mm",  
    separator: ".", 
    alias: "dd.mm.yyyy"
  });		 
	 
 });