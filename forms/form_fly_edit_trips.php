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



$result_t=mysql_time_query($link,'Select A.id from trips as A where A.visible=1 AND A.id="'.ht($_GET["id"]).'" and A.id_a_company="'.$id_company.'"');
$num_results_t = $result_t->num_rows;
if($num_results_t==0)
{	
		$debug=h4a(5,$echo_r,$debug);
		goto end_code;
	
} else
{
	$row_score = mysqli_fetch_assoc($result_t);

}


if ((!$role->permission('Туры','U'))and($sign_admin!=1))
{
    goto end_code;	
}

//составление секретного ключа формы
//составление секретного ключа формы
//соль для данного действия
$token=token_access_compile($_GET['id'],'bt_fly_edit',$secret);
//составление секретного ключа формы
//составление секретного ключа формы
//составление секретного ключа формы



$status=1;
	   



?>
<div id="Modal-one" class="box-modal table-modal eddd1 "><div class="box-modal-pading">			    
<div class="top_modal">
	
	
	
  <div class="box-modal_close arcticmodal-close"></div>
  <? echo'<h1 class="h111" mor="'.$token.'" for="'.htmlspecialchars(trim($_GET['id'])).'"><span>Уточнение времени и даты вылета туриста по туру №'.$_GET["id"].'</span></h1>'; ?>
  
  
  
</div>
<div class="center_modal">
<?
echo'<form id="vino_xd" style=" padding:0; margin:0;" method="get" enctype="multipart/form-data">';
echo'<input type="hidden" value="'.htmlspecialchars(trim($_GET['id'])).'" name="id">';
echo'<input type="hidden" value="'.$token.'" name="tk">';		

	$start_mi=$row_score["start_fly"];
	$end_mi=$row_score["end_fly"];		
	
	
		        //получаем посление даты из истории 
				$result_mi=mysql_time_query($link,'SELECT a.* FROM trips_fly_history AS a WHERE a.id_trips="'.htmlspecialchars(trim($_GET['id'])).'" order by a.datetime DESC limit 0,1');

                if($result_mi->num_rows!=0)
                {  
                   $row_mi = mysqli_fetch_assoc($result_mi);
					
				   $start_mi=$row_mi["start_fly"];
	               $end_mi=$row_mi["end_fly"];		
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

echo'<div style="margin-top: 30px;"><div class="input_2018"><label>Дата и время вылета<span>*</span></label><input name="start" value="'.$startx.'" id="date_124" class="input_new_2018 required date_time_picker  gloab" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>';		
	
echo'<div style="margin-top: 30px;"><div class="input_2018"><label>Дата и время отлета<span>*</span></label><input name="end" value="'.$endx.'" id="date_124" class="input_new_2018 required date_time_picker  gloab" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>';	
?>
</div>
	
</form>
</div>		
<div class="bottom_modal">			
 <span class="clock_table"></span>
 		
<div id="no_rd" class="no_button"><i>Отменить</i></div>   	
<div id="fly_booking_button_trips" class="save_button"><i>Сохранить</i></div>
         

            
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