<?php
//форма отказались от предложений

$url_system=$_SERVER['DOCUMENT_ROOT'].'/';
include_once $url_system.'module/ajax_access.php';


//создание секрет для формы
$secret=rand_string_string(4);
$_SESSION['s_form'] = $secret;

$status=0;





class rbc{
    const url = 'http://cbrates.rbc.ru/tsv/';
    const file = '.tsv';
    private $date = 0;
    public function __construct($date = null){
        if ($date == null){
            $date = time();
        }
        $this -> date = $date;
    }
    public function curs($currency_code){
        $url = self::url;
        $curs = 0;
        try{
            if (!is_numeric($currency_code)){
                throw new Exception('Передан неверный код валюты');
            }
            $url .= $currency_code . '/';
            if ($this -> date <= 0){
                throw new Exception('Передана неверная дата');
            }
            $url .= date('Y/m/d', $this -> date);
            $url .= self::file;

            $page = file_get_contents($url);
            $curs = $this -> parse($page);
        }
        catch (Exception $e) {
            echo 'Не удалось получить курс валюты. ',  $e -> getMessage();
        }
        return $curs;
    }
    private function parse($file){
        if (empty($file)){
            throw new Exception('Возможно указан неверный код валюты, также возможно на указанную дату еще не установлен курс валюты, либо сервер "cbrates.rbc.ru" недоступен.');
        }
        $curs = explode("\t", $file);
        if (!empty($curs[1])){
            return $curs[1];
        }
        else{
            throw new Exception('Сервер не выдал результатов по данной валюте на указнную дату');
        }
    }
}







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
	


$result_t=mysql_time_query($link,'Select b.id_user,b.status,b.id_object from booking as b where b.id="'.htmlspecialchars(trim($_GET['id'])).'"');
$num_results_t = $result_t->num_rows;
if($num_results_t==0)
{	
		$debug=h4a(5,$echo_r,$debug);
		goto end_code;
	
} else
{
	$row_score = mysqli_fetch_assoc($result_t);
	
	if($row_score["status"]==3)
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
$token=token_access_compile($_GET['id'],'bt_booking_avanss',$secret);
//составление секретного ключа формы
//составление секретного ключа формы
//составление секретного ключа формы

$result_t1=mysql_time_query($link,'Select b.cost,b.id from booking_offers as b where b.id_booking="'.htmlspecialchars(trim($_GET['id'])).'" and b.status="2"');
$num_results_t1 = $result_t1->num_rows;
if($num_results_t1!=0)
{	
   $row_score1 = mysqli_fetch_assoc($result_t1);
}




$status=1;
	   



?>
<div id="Modal-one" class="box-modal table-modal eddd1"><div class="box-modal-pading">			    
<div class="top_modal">
	
	
	
  <div class="box-modal_close arcticmodal-close"></div>
  <? echo'<h1 class="h111" mor="'.$token.'" for="'.htmlspecialchars(trim($_GET['id'])).'"><span>Частичная оплата по заявке</span></h1>'; ?>
  
  
  
</div>
<div class="center_modal">
<?
echo'<form id="vino_xd" style=" padding:0; margin:0;" method="get" enctype="multipart/form-data">';
echo'<input type="hidden" value="'.htmlspecialchars(trim($_GET['id'])).'" name="id">';
echo'<input type="hidden" value="'.$token.'" name="tk">';		


echo'<div class="comme">Укажите крайний срок оплаты и внесенную первоначальную сумму.</div>';
if($num_results_t1==1)
{


	
echo'<div style="margin-top: 30px;">
<div class="input_2018 active_in_2018"><label>Цена по чеку клиента</label><input name="offers[0][client_cost]" value="'.$row_score1["cost"].'" readonly="true" id="date_124" class="input_new_2018 required money_mask1 gloab" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><hr class="tree"></div></div>
</div>';

echo'<div style="margin-top: 30px;">
<div class="input_2018"><label>Аванс</label><input name="avanss" value="" id="date_1w24" class="input_new_2018 required money_mask1 gloab" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><hr class="tree"></div></div>
</div>';

echo'<div style="margin-top: 30px;">	';
	
echo'<div class="left_drop menu1_prime"><label>Способ оплаты</label><div class="select eddd zin_2019"><a class="slct" list_number="t1" data_src=""></a><ul class="drop">';
		   
		$result_8 = mysql_time_query($link,'select A.* from  booking_payment_method as A where A.visible=1 and A.method=1 order by A.displayOrder');
$num_8 = $result_8->num_rows;	
//$row_1 = mysqli_fetch_assoc($result2);
if($result_8)
{	
	 
  			  while($row_8 = mysqli_fetch_assoc($result_8)){ 
				  
				   echo'<li class="form_offers_"><a href="javascript:void(0);"  rel="'.$row_8["id"].'">'.$row_8["name"].'</a></li>';
			   
			 }
}
		   echo'</ul><input type="hidden" class="gloab1" name="payment_method" id="payment_method" value=""><div class="div_new_2018_"><hr class="one"></div></div></div>'; 	
	echo'</div>';	
?>	
<div style="margin-top: 30px;">
<div class="input_2018"><label>Крайний срок оплаты клиентом</label><input readonly="true" name="date_123" value="" id="date_table_gr22" class="input_new_2018 required gloab " autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"></div></div>
</div> 

 <?     
 echo'<input id="date_hidden_table_gr33" name="date_naryad" value="" type="hidden">';

		
		echo'<div class="pad10" style="padding: 0;"><span class="bookingBox_gr22"></span></div>';
	
?>
	<script type="text/javascript" src="Js/jquery-ui-1.9.2.custom.min.js"></script>
	<script type="text/javascript" src="Js/jquery.datepicker.extension.range.min.js"></script>		            
 <script type="text/javascript">var disabledDays = [];
 $(document).ready(function(){           
            $("#date_table_gr22").datepicker({ 
altField:'#date_hidden_table_gr33',
onClose : function(dateText, inst){
	    //date_graf();
        //alert(dateText); // Âûáðàííàÿ äàòà 
		
    },
altFormat:'yy-mm-dd',
defaultDate:null,
beforeShowDay: disableAllTheseDays,
dateFormat: "d MM yy", 
firstDay: 1,
minDate: "0d", maxDate: "+2Y",
onSelect: function(dateText) {
    	// extensionRange - объект расширения
	//alert(dateText);
				//	var theDate = $(inst).datepicker.formatDate('DD, MM d, yy', $(inst).datepicker.('getDate'));
$("#date_table_gr22").parents('.input_2018').addClass('active_in_2018');
	},
beforeShow:function(textbox, instance){
	//alert('before');
	
	setTimeout(function () {
            instance.dpDiv.css({
                position: 'absolute',
				top: 0,
                left: 0
            });
		

		var html = $('.ui-datepicker:last'); 
		//$('.ui-datepicker').remove();
		$('.bookingBox_gr22').append(html);
        }, 10);
	
 
} });
 });
	 
function resizeDatepicker() {
    setTimeout(function() { $('.bookingBox_gr22 > .ui-datepicker').width('100%'); }, 10);
}	 

function jopacalendar(queryDate,queryDate1,date_all) 
	{
	
if(date_all!='')
	{
var dateParts = queryDate.match(/(\d+)/g), realDate = new Date(dateParts[0], dateParts[1] -1, dateParts[2]); 
var dateParts1 = queryDate1.match(/(\d+)/g), realDate1 = new Date(dateParts1[0], dateParts1[1] -1, dateParts1[2]); 	 	 
	}
	}	 
	 
</script>	 

	<?

	
	
echo'<input type="hidden" value="'.$row_score1["id"].'" name="offers[0][id]">';	
} else
{
$result_t2=mysql_time_query($link,'Select b.cost,b.id from booking_offers as b where b.id_booking="'.htmlspecialchars(trim($_GET['id'])).'" and b.status="2"');
$num_results_t2 = $result_t2->num_rows;
if($num_results_t2!=0)
{	
		   for ($i=0; $i<$num_results_t2; $i++)
		   {			   			  			   
               $row_score2 = mysqli_fetch_assoc($result_t2);
			   echo'<div class="copp_s">
				   <div class="copp_number"><span class="span-44 active-44" data-tooltip="выбор клиента">'.($i+1).'</span></div>
				   <div class="copp_number1">';
				?>
				
				
				<?	

	
echo'<div style="">
<div class="input_2018 active_in_2018"><label>Цена по чеку клиента</label><input name="offers['.$i.'][client_cost]" value="'.$row_score2["cost"].'" id="date_124" class="input_new_2018 required money_mask1 gloab" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><hr class="tree"></div></div>
</div>';
			   
			   
			   
			   
			  echo'<input type="hidden" value="'.$row_score2["id"].'" name="offers['.$i.'][id]">';	 
?>	
				
				<?
				echo'</div>
			   </div>';	   
		   }
}
	echo'<div style="margin-top: 30px;">
<div class="input_2018"><label>Аванс</label><input name="avanss" value="" id="date_1w24" class="input_new_2018 required money_mask1 gloab" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><hr class="tree"></div></div>
</div>';

?>
<div style="margin-top: 30px;">
<div class="input_2018"><label>Крайний срок оплаты клиентом</label><input readonly="true" name="date_123" value="" id="date_table_gr22" class="input_new_2018 required gloab " autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"></div></div>
</div> 

 <?     
 echo'<input id="date_hidden_table_gr33" name="date_naryad" value="" type="hidden">';

		
		echo'<div class="pad10" style="padding: 0;"><span class="bookingBox_gr22"></span></div>';
	
?>
	<script type="text/javascript" src="Js/jquery-ui-1.9.2.custom.min.js"></script>
	<script type="text/javascript" src="Js/jquery.datepicker.extension.range.min.js"></script>		            
 <script type="text/javascript">var disabledDays = [];
 $(document).ready(function(){           
            $("#date_table_gr22").datepicker({ 
altField:'#date_hidden_table_gr33',
onClose : function(dateText, inst){
	    //date_graf();
        //alert(dateText); // Âûáðàííàÿ äàòà 
		
    },
altFormat:'yy-mm-dd',
defaultDate:null,
beforeShowDay: disableAllTheseDays,
dateFormat: "d MM yy", 
firstDay: 1,
minDate: "0d", maxDate: "+2Y",
onSelect: function(dateText) {
    	// extensionRange - объект расширения
	//alert(dateText);
				//	var theDate = $(inst).datepicker.formatDate('DD, MM d, yy', $(inst).datepicker.('getDate'));
$("#date_table_gr22").parents('.input_2018').addClass('active_in_2018');
	},
beforeShow:function(textbox, instance){
	//alert('before');
	
	setTimeout(function () {
            instance.dpDiv.css({
                position: 'absolute',
				top: 0,
                left: 0
            });
		

		var html = $('.ui-datepicker:last'); 
		//$('.ui-datepicker').remove();
		$('.bookingBox_gr22').append(html);
        }, 10);
	
 
} });
 });
	 
function resizeDatepicker() {
    setTimeout(function() { $('.bookingBox_gr22 > .ui-datepicker').width('100%'); }, 10);
}	 

function jopacalendar(queryDate,queryDate1,date_all) 
	{
	
if(date_all!='')
	{
var dateParts = queryDate.match(/(\d+)/g), realDate = new Date(dateParts[0], dateParts[1] -1, dateParts[2]); 
var dateParts1 = queryDate1.match(/(\d+)/g), realDate1 = new Date(dateParts1[0], dateParts1[1] -1, dateParts1[2]); 	 	 
	}
	}	 
	 
</script>	 

	<?
	
}
?>


</form>
</div>		
<div class="bottom_modal">			
 <span class="clock_table"></span>
 		
<div id="no_rd" class="no_button"><i>Отменить</i></div>   	
<div id="button_bron_booking_avaa" class="save_button"><i>Внести аванс</i></div>
         

            
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
 });