<?php
//форма отказались от предложений

$url_system=$_SERVER['DOCUMENT_ROOT'].'/';
include_once $url_system.'module/ajax_access.php';


//создание секрет для формы
$secret=rand_string_string(4);
$_SESSION['s_form'] = $secret;

$status=0;



   $class_bba='cost_bank1';

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
	


$result_t=mysql_time_query($link,'Select b.id_user,b.status,b.date_prepaid,b.id_object from booking as b where b.id="'.htmlspecialchars(trim($_GET['id'])).'"');
$num_results_t = $result_t->num_rows;
if($num_results_t==0)
{	
		$debug=h4a(5,$echo_r,$debug);
		goto end_code;
	
} else
{
	$row_score = mysqli_fetch_assoc($result_t);
	
	if(($row_score["status"]!=6)and($row_score["status"]!=3))
	{
		$debug=h4a(8,$echo_r,$debug);
		goto end_code;		
	}
}


if ((!$role->permission('Заявки','A'))and($sign_admin!=1))
{
    goto end_code;	
}

	if((array_search($row_score["id_object"],$hie_object) === false)and($sign_admin!=1))
	{
		goto end_code;	
	}
//составление секретного ключа формы
//составление секретного ключа формы
//соль для данного действия
$token=token_access_compile($_GET['id'],'bt_booking_avanss123457',$secret);
//составление секретного ключа формы
//составление секретного ключа формы
//составление секретного ключа формы



$status=1;
	   



?>
<div id="Modal-one" class="box-modal table-modal eddd1 history_window1"><div class="box-modal-pading">			    
<div class="top_modal">
	
	
	
  <div class="box-modal_close arcticmodal-close"></div>
  <? echo'<h1 class="h111" mor="'.$token.'" for="'.htmlspecialchars(trim($_GET['id'])).'"><span>История платежей клиента</span></h1>'; ?>
  
  
  
</div>
<div class="center_modal">
<?
echo'<form id="vino_xd" style=" padding:0; margin:0;" method="get" enctype="multipart/form-data">';
echo'<input type="hidden" value="'.htmlspecialchars(trim($_GET['id'])).'" name="id">';
echo'<input type="hidden" value="'.$token.'" name="tk">';		


echo'<div class="comme" style="margin-bottom:20px;">Здесь вы можете увидеть историю платежей по данной заявке.</div>';
/*
	        $result_work_zz1=mysql_time_query($link,'Select a.* from booking_status_history as a where ((a.status=6)or(a.status=3)) and a.id_booking="'.htmlspecialchars(trim($_GET['id'])).'" order by a.datetime');
	*/ 
        $result_work_zz1=mysql_time_query($link,'Select a.* from booking_status_history as a where ((a.status=6)or(a.status=3)) and not(a.payment_method="") and a.id_booking="'.htmlspecialchars(trim($_GET['id'])).'" order by a.datetime');
		 
        $num_results_work_zz1 = $result_work_zz1->num_rows;
	    if($num_results_work_zz1!=0)
	    {
			$prepaid=0;
			$comi=0;
			$sum_umatravel_end=0;
		   for ($itt=0; $itt<$num_results_work_zz1; $itt++)
		   {			   			  			   
			   $row_work_zz1 = mysqli_fetch_assoc($result_work_zz1);
if($itt==0)
{
	$result_status21=mysql_time_query($link,'SELECT sum(a.commission) as com, sum(a.cost) as cost FROM booking_offers AS a WHERE a.id_booking="'.htmlspecialchars(trim($_GET['id'])).'" and a.status=2');	
					 //echo('SELECT a.* FROM r_status AS a WHERE a.numer_status="'.$row1ss["status"].'" and a.id_system=13');
                if($result_status21->num_rows!=0)
                {  
                   $row_status21 = mysqli_fetch_assoc($result_status21);
				} 
		 echo'<div class="history_string blue_history"><div class="i_string">Общая сумма по чеку клиента</div><div class="cost_string" style="width:25%">'.rtrim(rtrim(number_format($row_status21["cost"], 2, '.', ' '),'0'),'.').'<span>₽</span></div>';
	
		 echo'<div class="cost_bank_end" style="width:10%;">&nbsp;</div>';
		 echo'<div class="cost_bank_end"></div></div>';
	
}
			   

$payment='';

$result_tp=mysql_time_query($link,'Select b.name as cc from booking_payment_method as b where b.id="'.$row_work_zz1["payment_method"].'"');
$num_results_tp = $result_tp->num_rows;
if($num_results_tp!=0)
{	
	$row_score12p = mysqli_fetch_assoc($result_tp);
	$payment=$row_score12p["cc"];
}	
			   

$payuser='';

$result_tp=mysql_time_query($link,'Select b.name_small from r_user as b where b.id="'.$row_work_zz1["id_user"].'"');
$num_results_tp = $result_tp->num_rows;
if($num_results_tp!=0)
{	
	$row_score12p = mysqli_fetch_assoc($result_tp);
	$payuser=$row_score12p["name_small"];
}				   
			   
			   if( $row_work_zz1["status"]==3)
			   {
				   $why="Полная оплата";
			   } else
			   {
				   $why="Аванс";
			   }
			
			   if($row_work_zz1["proc_bank"]>0)
			   {
				   $class_bba='cost_bank';
			   } else
			   {
				   $class_bba='cost_bank1';
			   }
			   
			   echo'<div class="history_string1">
			       
			   <div class="i_string">'.$why.' <span>('.time_stamp_dd1($row_work_zz1["datetime"]).' - '.$payment.' - '.$payuser.')</span></div>';
				

				
				   
			   			   if( $row_work_zz1["status"]==6)
			   {
							   $prepaid=$prepaid+$row_work_zz1["prepaid"];
				   echo'<div data-tooltip="Сумма" class="cost_string">'.rtrim(rtrim(number_format($row_work_zz1["prepaid"], 2, '.', ' '),'0'),'.').'<span>₽</span></div>';
				   $sum_umatravel=($row_work_zz1["prepaid"]-$row_work_zz1["proc_bank"]);
				   			   
							   
			   } else
			   {
							   $prepaid=$row_status21["cost"];
				   echo'<div data-tooltip="Сумма" class="cost_string">'.rtrim(rtrim(number_format($row_status21["cost"], 2, '.', ' '),'0'),'.').'<span>₽</span></div>';
				   $sum_umatravel=($row_status21["cost"]-$row_work_zz1["proc_bank"]);			   
			   }
			   $sum_umatravel_end=$sum_umatravel_end+$sum_umatravel;

				   echo'<div data-tooltip="Комиссия за платеж"  class="'.$class_bba.'" >'.rtrim(rtrim(number_format($row_work_zz1["proc_bank"], 2, '.', ' '),'0'),'.').'<span>₽</span></div>';   
				   
				   echo'<div data-tooltip="Фирма получила"  class="cost_bank_end" >'.rtrim(rtrim(number_format($sum_umatravel, 2, '.', ' '),'0'),'.').'<span>₽</span></div>';  			   
				   
				   echo'</div>';
			   
			   $comi=$comi+$row_work_zz1["proc_bank"];
		   }
		}
	
		   echo'<div class="history_string1 red_history"><div class="i_string">Итого</div>
		    
		   
		   <div data-tooltip="Итого клиент заплатил" class="cost_string">'.rtrim(rtrim(number_format(($prepaid), 2, '.', ' '),'0'),'.').'<span>₽</span></div>';
	
			echo'<div data-tooltip="Итого Комиссия"  class="'.$class_bba.'" >'.rtrim(rtrim(number_format($comi, 2, '.', ' '),'0'),'.').'<span>₽</span></div>';
	
			echo'<div data-tooltip="Итого фирма получила"  class="cost_bank_end" >'.rtrim(rtrim(number_format($sum_umatravel_end, 2, '.', ' '),'0'),'.').'<span>₽</span></div>';  
	
	echo'</div>';
	$proc_realiz=0;
	if($row_status21["cost"]!=0)
	{
	$proc_realiz=round(($row_status21["com"]*100)/$row_status21["cost"],1); 
	}
	
	if( $row_score["status"]==3)
			   {
				   echo'<div class="history_string1 green_history"><div class="i_string">Итого комиссия по заявке</div>';
		
		$pl__='';
		$class_bba1='cost_bank2';
		   if($row_status21["com"]>0)
		   {
			   $pl__='+ ';
			   $class_bba1='cost_bank3';
		   }
		    
		echo'<div  class="new_i_string"></div>';
		
			echo'<div data-tooltip="Наш Процент"  class="'.$class_bba1.'" >'.$proc_realiz.'<span>%</span></div>';
		

		
		   echo'<div class="'.$class_bba1.'" style="width:15%;" data-tooltip="Наша комиссия" class="cost_string"><i style=" color:#fff; font-style: normal;   border-bottom: 1px solid #e2f59d;">'.$pl__.rtrim(rtrim(number_format(($row_status21["com"]), 2, '.', ' '),'0'),'.').'<span>₽</span></i></div></div>';
	} else
	{
						   echo'<div class="history_string1 green_history"><div class="i_string">Промежуточная комиссия по заявке</div>';
		
		$pl__='';
		$class_bba1='cost_bank2';
		   if($row_status21["com"]>0)
		   {
			   $pl__='+ ';
			   $class_bba1='cost_bank3';
		   }
		    
			echo'<div data-tooltip="Наш Процент"  class="'.$class_bba1.'" >'.$proc_realiz.'<span>%</span></div>';
		

		
		   echo'<div class="'.$class_bba1.'" style="width:15%;" data-tooltip="Наша комиссия" class="cost_string"><i style=" color:#fff; font-style: normal;   border-bottom: 1px solid #e2f59d;">'.$pl__.rtrim(rtrim(number_format(($row_status21["com"]), 2, '.', ' '),'0'),'.').'<span>₽</span></i></div></div>';
	}
	
?>
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
$('.money_mask1').inputmask("numeric", {
    radixPoint: ".",
    groupSeparator: " ",
    digits: 2,
    autoGroup: true,
    prefix: '', //No Space, this will truncate the first character
    rightAlign: false,
    oncleared: function () { self.Value(''); }
});
 });