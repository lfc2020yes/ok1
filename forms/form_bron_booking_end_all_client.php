<?php
//форма какой клиент забронировал

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
	


$result_t=mysql_time_query($link,'Select b.id_user,b.status,b.id_object,b.phone,b.name,b.id_client from booking as b where b.id="'.htmlspecialchars(trim($_GET['id'])).'"');
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
$token=token_access_compile($_GET['id'],'bt_booking_end_client',$secret);
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
<div id="Modal-one" class="box-modal table-modal eddd1 client_700"><div class="box-modal-pading">			    
<div class="top_modal">
	
	
	
  <div class="box-modal_close arcticmodal-close"></div>
  <? echo'<h1 class="h111" mor="'.$token.'" for="'.htmlspecialchars(trim($_GET['id'])).'"><span>Данные по клиенту</span></h1>'; ?>
  
  
  
</div>
<div class="center_modal">
<?
echo'<form id="vino_xd" style=" padding:0; margin:0;" method="get" enctype="multipart/form-data">';
echo'<input type="hidden" value="'.htmlspecialchars(trim($_GET['id'])).'" name="id">';
echo'<input type="hidden" value="'.$token.'" name="tk">';		


echo'<div class="comme">Добавьте данные по клиенту или выберите уже из существующей базы.</div>';
/*if($num_results_t1==1)
{*/

			$result_t2t=mysql_time_query($link,'Select c.name from booking_offers as b,booking_operator as c where c.id=b.id_operator and b.id_booking="'.htmlspecialchars(trim($_GET['id'])).'" and b.status="2"');
            $num_results_t2t = $result_t2t->num_rows;
            if($num_results_t2t!=0)
            {
				$row_status222t = mysqli_fetch_assoc($result_t2t);
				//$cost_cl=$row_status222["cost"];
			}
	
	
echo'<div class="div_ook_grei_client">';
	
if($row_score["id_client"]!=0)
{
	$active_radio2='active_radio';
	$active_radio1='';
	$radio_bk=1;
} else
{
	$active_radio1='active_radio';
	$active_radio2='';
	$radio_bk=0;
}
	
	
?>
			<div class="ok-block-input">
					 
			 
			  <span class="ok-i jipp_34">

<div class="radioselect">

<?


	  
	echo'<div class="radio_material add_radio_yy_client '.$active_radio1.'" radio_id="0"><div class="table r_mat"><div class="table-cell radio_wall"><div class="st_div_radio  radio_checkbox"><i></i></div><input class="rt_wall_radio radio_0" name="radio_r0" value="0" type="hidden"></div><div class="table-cell name_radio wallr1 xx_32">Новый клиент</div></div></div>';
	  
	  
	echo'<div class="radio_material add_radio_yy_client '.$active_radio2.'" radio_id="1"><div class="table r_mat"><div class="table-cell radio_wall"><div class="st_div_radio  radio_checkbox"><i></i></div><input class="rt_wall_radio radio_1" name="radio_r1" value="1" type="hidden"></div><div class="table-cell name_radio wallr1 xx_32">Найти клиента</div></div></div>';	  
	  
		

echo'<input value="'.$radio_bk.'" id="radio_bk" class="radio_b" name="client_new_search" type="hidden">	';
		?>
</div>
 </span>
	        </div>

</div>	
	
	<?
	if($row_score["id_client"]!=0)
    {
	echo'<div class="one_client_box" style="display:none;">';
	} else
	{
	echo'<div class="one_client_box" >';	
	}
	?>
		<div class="modal_50_50 "><div class="modal_left">
	<?
	
	
	
	echo'<div style="margin-top: 30px;"><div class="input_2018"><label>ФИО<span>*</span></label><input name="offers[0][client_fio]" value="'.$row_score["name"].'" id="date_124" class="input_new_2018 required  gloab" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>';	


	

echo'<div style="margin-top: 30px;">
<div class="input_2018"><label>Телефон<span>*</span></label><input name="offers[0][client_phone]" value="'.$row_score["phone"].'" id="date_124" data-tooltip="" class="input_new_2018 required gloab phone_us1" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>';	

echo'<div style="margin-top: 30px;">
<div class="input_2018"><label>День рождения<span>*</span></label><input name="offers[0][client_date]" value="" id="date_124" class="input_new_2018 required gloab date_picker_x" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div>
</div></div>';

			echo'</div>
				<div class="modal_right">';

	
echo'<div style="margin-top: 30px;"><div class="input_2018"><label>Почта</label><input name="offers[0][client_email]" value="" id="date_124" class="input_new_2018 required no_upper" style="text-transform:normal;" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>';		
				
	
	

echo'<div style="margin-top: 30px;">
<div class="input_2018 "><label>Компания</label><input name="offers[0][client_company]" value="" id="date_124" class="input_new_2018 required " autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div>
</div></div>';	
			
		echo'</div></div>';	
			
echo'<div style="margin-top: 30px;">';
?>
      <div class="div_textarea_otziv1" >
			<div class="otziv_add">
                 
                   <?
        echo'<textarea cols="10" rows="1" placeholder="Ваш комментарий" id="otziv_area_adaxx2" name="offers[0][client_comment]" class="di text_area_otziv no_comment_bill22"></textarea>';
				?>
            </div>      
</div>  

        <script type="text/javascript"> 
	  $(function (){ 
$('#otziv_area_adaxx2').autoResize({extraSpace : 10});
$('#otziv_area_adaxx2').trigger('keyup');
});

	</script>
	</div>
	
		
	
		
<div class="oka_block column_flex"> 

<div class="div_ook_grei1 add_client">

			<div class="ok-block-input">
			 <div class="ok-input-title">Особенности клиента<i></i></div>
		</div></div></div>	 
			 <?
		
	echo'<div class="div_ook_grei add_client1">';
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
		   $rr=explode(',','');
		   for ($i=0; $i<$num_results_work_zz; $i++)
		   {			   			  			   
			   $row_work_zz = mysqli_fetch_assoc($result_work_zz);

			   	 $rtt='';
			   $rtt_value="0";
			   if(isset($_POST['options_r'.$row_work_zz["id"]]))
			   {
			   if($_POST['options_r'.$row_work_zz["id"]]==1)
			   {
				  	 $rtt='active_wall'; 
				   $rtt_value="1";
			   }
			   } else
			   {
				   
				   	$found = array_search($row_work_zz["id"],$rr);   
	                if($found !== false) 
	                {
						  	 $rtt='active_wall'; 
				           $rtt_value="1";
	                }
			   }
			    
			   

				  echo'<div class="wallet_material wallet_client  '.$rtt.'" wall_id="'.$row_work_zz["id"].'">
			  <div class="table w_mat">
			      <div class="table-cell one_wall">
				  <div class="st_div_wall  wallet_checkbox"><i></i></div>
				  
				  <input class="rt_wall yop_'.$row_work_zz["id"].'" name="options_r'.$row_work_zz["id"].'" value="'.ipost_($_POST['options_r'.$row_work_zz["id"]],$rtt_value).'" type="hidden">
				  </div>';				
				
					
			      echo'<div class="table-cell name_wall wall1">'.$row_work_zz["name"].'</div>
			      
			  </div>
			</div>';
						  
					
				
			   
			   
			   
		   }
		echo'<input  type="hidden" value="'.ipost_($_POST['options_b'],'').'" id="options_b" class="sourse_b" name="options_b">';
			
		}
				
			?>
			
			
	
			</div>				  	
			  	
			  </span>
		
	        </div>
</div>
		
		
	</div>	
<?
if($row_score["id_client"]!=0)
{
  echo'<div class="two_client_box">';
} else
				
echo'<div class="two_client_box" style="display: none;">';

echo'<input type="hidden" value="'.$row_score["id_client"].'" name="id_search_client">';
		?>
		

	<!--<div class="comme">Введите телефон клиента или фамилию.</div>-->
		<div class="fox_search_client">
			
			<?
			if($row_score["id_client"]!=0)
        {
	
			$result_tty=mysql_time_query($link,'Select b.code,b.fio,b.phone from k_clients as b where b.id="'.htmlspecialchars(trim($row_score["id_client"])).'"');
$num_results_tty = $result_tty->num_rows;
if($num_results_tty!=0)
{	

	$row_tty = mysqli_fetch_assoc($result_tty);	
		   $phone_format='+7 ('.$row_tty["phone"][0].$row_tty["phone"][1].$row_tty["phone"][2].') '.$row_tty["phone"][3].$row_tty["phone"][4].$row_tty["phone"][5].'-'.$row_tty["phone"][6].$row_tty["phone"][7].'-'.$row_tty["phone"][8].$row_tty["phone"][9];			
				
				echo'<div class="end_search" style="display: block;"><div class="end_search_flex"><div class="end_one">'.$row_tty["fio"].' ['.$row_tty["code"].']</div><div class="end_two">'.$phone_format.'</div></div></div>';
}
			} else
			{
			
			echo'<div class="end_search"><div class="end_search_flex"><div class="end_one"></div><div class="end_two"></div></div></div>';
			}
				

		echo'<div class="fox_search_result" style="display: none;"></div>';
			
	?>
			
	<input type="text" id="fox_search_client_i" name="names_ss" value="" placeholder="Фамилия, Телефон или код клиента" class="input_fit" autocomplete="off">	
			<span class="fox_dell">x</span>	
		</div>
		
	</div>
<?	
	

echo'<input type="hidden" value="'.$row_score1["id"].'" name="offers[0][id]">';
echo'<input type="hidden" value="'.htmlspecialchars(trim($_GET['options'])).'" name="offers[0][options]">';
/*} else
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


					</form></div></div>
<div class="bottom_modal">			
 <span class="clock_table"></span>
 		
<div id="no_rd" class="no_button"><i>Отменить</i></div>   	
<div id="button_bron_booking_client" class="save_button"><i>Далее</i></div>
         

            
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
	 
		$('.date_picker_x').inputmask("datetime",{
    mask: "1.2.y", 
    placeholder: "dd.mm.yyyy",  
    separator: ".", 
    alias: "dd.mm.yyyy"
  });
			 
	 
 });