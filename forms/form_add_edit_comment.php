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
	


$result_t=mysql_time_query($link,'Select b.status,b.end_fly,a.status as st,a.id_user,b.comment_client from booking_offers as b,booking as a where a.id=b.id_booking and b.id="'.htmlspecialchars(trim($_GET['id'])).'"');
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

		if(($row_score["st"]!=3)and($row_score["st"]!=6)and($row_score["status"]!=2))		
        {	
					$debug=h4a(8554,$echo_r,$debug);
		            goto end_code;					
		}

		if(($row_score["id_user"]!=$id_user)and($sign_admin!=1))
		{ 
					$debug=h4a(8553,$echo_r,$debug);
		            goto end_code;			
		}
			
		

//составление секретного ключа формы
//составление секретного ключа формы
//соль для данного действия
$token=token_access_compile($_GET['id'],'bt_add_edit_comment',$secret);
//составление секретного ключа формы
//составление секретного ключа формы
//составление секретного ключа формы



$status=1;
	   



?>
<div id="Modal-one" class="box-modal table-modal eddd1 "><div class="box-modal-pading">			    
<div class="top_modal">
	
	
	
  <div class="box-modal_close arcticmodal-close"></div>
  <? echo'<h1 class="h111" mor="'.$token.'" for="'.htmlspecialchars(trim($_GET['id'])).'"><span>Впечатление туриста</span></h1>'; ?>
  
  
  
</div>
<div class="center_modal">


<div class="ok-block-input">
			  <!--<div class="ok-input-title">Узнайте Впечатление<i></i></div>-->
			
			  <span class="ok-i">
       
       
       <div class="div_textarea_otziv1" >
			<div class="otziv_add">
                 
                   <?
        echo'<textarea cols="10" rows="1" placeholder="Ваш турист доволен отдыхом?" id="otziv_area_adaxx2" name="comment_b" class="di text_area_otziv no_comment_bill">'.$row_score["comment_client"].'</textarea>';
				?>
            </div>      
</div>  
       
       
       
       </span>
        
        <script type="text/javascript"> 
	  $(function (){ 
$('#otziv_area_adaxx2').autoResize({extraSpace : 10});
$('#otziv_area_adaxx2').trigger('keyup');

ToolTip();
});

	</script>
        
	        </div>    		
	
</div>		
<div class="bottom_modal">			
 <span class="clock_table"></span>
 		
<div id="no_rd" class="no_button"><i>Отменить</i></div>   	
<div id="save_comment_button_x" class="save_button"><i>Сохранить</i></div>
         

            
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