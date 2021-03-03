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
if ((count($_GET) != 2)or(!isset($_GET["id"]))or((!is_numeric($_GET["id"])))) 
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
$token=token_access_compile($_GET['id'],'bt_booking_end',$secret);
//составление секретного ключа формы
//составление секретного ключа формы
//составление секретного ключа формы

$result_t1=mysql_time_query($link,'Select b.cost,b.id,b.start_fly,b.end_fly from booking_offers as b where b.id_booking="'.htmlspecialchars(trim($_GET['id'])).'" and b.status="2"');
$num_results_t1 = $result_t1->num_rows;
if($num_results_t1!=0)
{	
   $row_score1 = mysqli_fetch_assoc($result_t1);
}




$status=1;
	   



?>
<div id="Modal-one" class="box-modal table-modal eddd1 client_800"><div class="box-modal-pading">			    
<div class="top_modal">
	
	
	
  <div class="box-modal_close arcticmodal-close"></div>
  <? echo'<h1 class="h111" mor="'.$token.'" for="'.htmlspecialchars(trim($_GET['id'])).'"><span>Купили по заявке</span></h1>'; ?>
  
  
  
</div>
<div class="center_modal">
<?
echo'<form id="vino_xd" style=" padding:0; margin:0;" method="get" enctype="multipart/form-data">';
echo'<input type="hidden" value="'.htmlspecialchars(trim($_GET['id'])).'" name="id">';
echo'<input type="hidden" value="'.$token.'" name="tk">';		


echo'<div class="comme">Не забудьте, что после бронирования вам необходимо прикрепить к данной заявке в системе товарный чек клиента. Фото или скан.</div>';
if($num_results_t1==1)
{

			$result_t2t=mysql_time_query($link,'Select c.name from booking_offers as b,booking_operator as c where c.id=b.id_operator and b.id_booking="'.htmlspecialchars(trim($_GET['id'])).'" and b.status="2"');
            $num_results_t2t = $result_t2t->num_rows;
            if($num_results_t2t!=0)
            {
				$row_status222t = mysqli_fetch_assoc($result_t2t);
				//$cost_cl=$row_status222["cost"];
			}
	echo'<div class="modal_50_50 "><div class="modal_left">';
		
	echo'<div style="margin-top: 30px;"><div class="input_2018"><label>Номер заявки в ТО<span>*</span></label><input name="offers[0][operator_number]" value="" id="date_124" class="input_new_2018 required  gloab" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name">'.$row_status222t["name"].'</div></div></div>
</div>';	


echo'<div style="margin-top: 30px;" class="val_rate">	';
	
echo'<div class="left_drop menu1_prime"><label>Валюта<span>*</span></label><div class="select eddd zin_2019"><a class="slct" list_number="t1" data_src=""></a><ul class="drop">';
		   
		$result_8 = mysql_time_query($link,'select A.* from  booking_exchange as A');
$num_8 = $result_8->num_rows;	
//$row_1 = mysqli_fetch_assoc($result2);
if($result_8)
{	
	 
  			  while($row_8 = mysqli_fetch_assoc($result_8)){ 
				  
				   $today = new rbc();	
                   $rrub=$today -> curs($row_8['code']);	
				  
				   echo'<li class="form_offers_"><a href="javascript:void(0);"  rel="'.$row_8["id"].'" value_e="'.$rrub.'" char="'.$row_8["char"].'">'.$row_8["name"].'</a></li>';
			   
			 }
}
		   echo'</ul><input type="hidden" class="gloab1"  name="offers[0][exchange]" id="exchange_rates" value=""><div class="div_new_2018_"><hr class="one"></div></div></div></div>';	
	
	
	

	
echo'<div style="margin-top: 30px;" class="rates_value">
<div class="input_2018 active_in_2018"><label>Курс валюты на момент покупки у ТО <i style="color: #fd8080; font-style:normal;">(внимательно проверить)</i><span>*</span></label><input name="offers[0][exchange_rates]" value="" id="date_124" class="input_new_2018 required money_mask1 gloab exchange_rates" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><hr class="tree"></div></div>
</div>'; 	
	

echo'<div style="margin-top: 30px;" class="jj-l">
<div class="input_2018"><label>Наша цена у ТО (конечная)<span>*</span></label><input name="offers[0][operator_cost]" value="" id="date_124" data-tooltip="сумма которую мы заплатили туропературу + коммиссия банка если она была" class="input_new_2018 required money_mask1 gloab cost_to_1 to_1" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><hr class="tree"><div class="oper_name" joi="'.$row_status222t["name"].'">'.$row_status222t["name"].'</div></div></div>
</div>';	

echo'<div style="margin-top: 30px;" class="jj-l">
<div class="input_2018"><label>Стоимость тура для клиента у ТО<span>*</span></label><input name="offers[0][operator_client_cost]" value="" id="date_124" data-tooltip="" class="input_new_2018 required money_mask1 gloab cost_to_1 to_2" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><hr class="tree"><div class="oper_name" joi="'.$row_status222t["name"].'">'.$row_status222t["name"].'</div></div></div>
</div>';		

echo'<div style="margin-top: 30px;">
<div class="input_2018 active_in_2018"><label>Цена по чеку клиента <i style="color: #fd8080; font-style:normal;">(проверить)</i><span>*</span></label><input name="offers[0][client_cost]" value="'.$row_score1["cost"].'" id="date_124" class="input_new_2018 required money_mask1 gloab to_3" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><hr class="tree"></div><div class="oper_name">umatravel</div></div>
</div>';
	

	echo'</div><div class="modal_right">';
	

//номер договора в компании umatravel
$number_doc='';
	$result_status2d=mysql_time_query($link,'SELECT MAX(b.number) AS cc FROM booking_contract AS b WHERE b.years="'.date('Y').'"');	
					 //echo('SELECT a.* FROM r_status AS a WHERE a.numer_status="'.$row1ss["status"].'" and a.id_system=13');
                if($result_status2d->num_rows!=0)
                {  
                   $row_status2d = mysqli_fetch_assoc($result_status2d);	
	
				//$number_doc=date('d').'/'.date('m').'/'.date('Y').' - '.($row_status2d["cc"]+1).' от '.date('d').' '.month_rus(date('m')).' '.date('Y');

				$number_doc=date('d').'/'.date('m').'/'.date('Y').' - '.($row_status2d["cc"]+1);					
					
echo'<div style="margin-top: 30px;"><div class="input_2018"><label>Номер договора <i style="color: #fd8080; font-style:normal;">(проверить)</i><span>*</span></label><input name="offers[0][doc_number]" value="'.$number_doc.'" id="date_124" class="input_new_2018 required  gloab" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name">umatravel</div></div></div>
</div>';		
				}	
	
	
	if($_GET["options"]==0)
	{
	//полная оплата	
echo'<div style="margin-top: 30px;">	';
	
echo'<div class="left_drop menu1_prime"><label>Способ оплаты<span>*</span></label><div class="select eddd zin_2019"><a class="slct" list_number="t1" data_src=""></a><ul class="drop">';

		$result_8 = mysql_time_query($link,'select A.* from  booking_payment_method as A where A.visible=1 order by A.displayOrder');
	
	
	
$num_8 = $result_8->num_rows;	
//$row_1 = mysqli_fetch_assoc($result2);
if($result_8)
{	
	 
  			  while($row_8 = mysqli_fetch_assoc($result_8)){ 
				  
				   echo'<li class="form_offers_"><a href="javascript:void(0);"  rel="'.$row_8["id"].'" comm="'.$row_8["comm"].'">'.$row_8["name"].'</a></li>';
			   
			 }
}
		   echo'</ul><input type="hidden" class="gloab1"  name="offers[0][client_payment_method]" id="payment_method" value=""><div class="div_new_2018_"><hr class="one"></div></div></div>'; 	
	echo'</div>';	

	
	
echo'<div style="margin-top: 30px;" class="proc_bank">
<div class="input_2018 active_in_2018"><label>Уплатили банку за выдачу рассрочки/кредита<span>*</span></label><input name="offers[0][proc_bank]" value="" id="date_124" class="input_new_2018 required money_mask1 pp_bank" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><hr class="tree"></div></div>
</div>'; 	
	}
	
				  					  if($row_score1["start_fly"]!='0000-00-00 00:00:00')
				  {	
					   $date_start=explode(" ",htmlspecialchars(trim($row_score1["start_fly"])));
				   $date_start1=explode("-",htmlspecialchars(trim($date_start[0])));
				  $date_start2=explode(":",htmlspecialchars(trim($date_start[1])));
				   $startx=$date_start1[2].'.'.$date_start1[1].'.'.$date_start1[0].' '.$date_start2[0].':'.$date_start2[1];		
				  } else
				{
					$startx='';					  
				}
			
				   if($row_score1["end_fly"]!='0000-00-00 00:00:00')
				  {	
	   $date_end=explode(" ",htmlspecialchars(trim($row_score1["end_fly"])));
				   $date_end1=explode("-",htmlspecialchars(trim($date_end[0])));
				  $date_end2=explode(":",htmlspecialchars(trim($date_end[1])));
				   $endx=$date_end1[2].'.'.$date_end1[1].'.'.$date_end1[0].' '.$date_end2[0].':'.$date_end2[1];		} else
				   {
					  $endx=''; 
				   }

echo'<div style="margin-top: 30px;"><div class="input_2018"><label>Дата и время вылета<span>*</span></label><input name="offers[0][start_flyy]" value="'.$startx.'" id="date_124" class="input_new_2018 required date_time_picker  gloab" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>';		
	
echo'<div style="margin-top: 30px;"><div class="input_2018"><label>Дата и время отлета<span>*</span></label><input name="offers[0][end_flyy]" value="'.$endx.'" id="date_124" class="input_new_2018 required date_time_picker  gloab" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>';	
	
echo'<input type="hidden" value="'.$row_score1["id"].'" name="offers[0][id]">';	
echo'<input type="hidden" value="'.htmlspecialchars(trim($_GET['options'])).'" name="offers[0][options]">';		
} /*else
{
$result_t2=mysql_time_query($link,'Select b.cost,b.id,c.name from booking_offers as b,booking_operator as c where c.id=b.id_operator and  b.id_booking="'.htmlspecialchars(trim($_GET['id'])).'" and b.status="2"');
$num_results_t2 = $result_t2->num_rows;
if($num_results_t2!=0)
{	
		   for ($i=0; $i<$num_results_t2; $i++)
		   {			   			  			   
               $row_score2 = mysqli_fetch_assoc($result_t2);
			   echo'<div class="copp_s">
				   <div class="copp_number"><span class="span-44 active-44" data-tooltip="выбор клиента">'.($i+1).'</span></div>
				   <div class="copp_number1">';
				
	echo'<div ><div class="input_2018"><label>Номер заявки в ТО</label><input name="offers['.$i.'][operator_number]" value="" id="date_124" class="input_new_2018 required  gloab" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name">'.$row_score2["name"].'</div></div></div>
</div>';	
	
	
	?>
				
				<div style="margin-top: 30px;">
				<?
echo'<div class="input_2018"><label>Конечная цена туроператора</label><input name="offers['.$i.'][operator_cost]" value="" id="date_124" data-tooltip="сумма которую мы заплатили туропературу + коммиссия банка если она была" class="input_new_2018 required money_mask1 gloab" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><hr class="tree"><div class="oper_name">'.$row_score2["name"].'</div></div></div>
</div>';	
			   
			   
			   

	
echo'<div style="margin-top: 30px;">
<div class="input_2018 active_in_2018"><label>Цена по чеку клиента</label><input name="offers['.$i.'][client_cost]" value="'.$row_score2["cost"].'" id="date_124" class="input_new_2018 required money_mask1 gloab" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><hr class="tree"></div></div>
</div>';
			  echo'<input type="hidden" value="'.$row_score2["id"].'" name="offers['.$i.'][id]">';	 
?>	
				
				<?
				echo'</div>
			   </div>';	   
		   }
}
	
$today = new rbc();	
$rrub=$today -> curs(840);	
	
echo'<div style="margin-top: 30px;">
<div class="input_2018 active_in_2018"><label>Курс доллара</label><input name="dollor" value="'.$rrub.'" id="date_124" class="input_new_2018 required money_mask1 gloab" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><hr class="tree"></div></div>
</div>'; 
	
	
}*/
?>

	

	
	
	
	
	
<div class="radioselect" style="margin-top:20px;">

<div class="radio_material" radio_id="1"><div class="table r_mat"><div class="table-cell radio_wall"><div class="st_div_radio  radio_checkbox"><i></i></div><input class="rt_wall_radio radio_1" name="radio_doc" value="0" type="hidden"></div><div class="table-cell name_radio wallr1">Договор клиенту распечатан и отдан</div></div></div>		

</div>	


</div></div>	
	
</form>
</div>		
<div class="bottom_modal">			
 <span class="clock_table"></span>
 		
<div id="no_rd" class="no_button"><i>Отменить</i></div>   	
<div id="button_bron_booking" class="save_button greii_d"><i>Купили</i></div>
         

            
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