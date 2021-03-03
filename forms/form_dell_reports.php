<?php
//форма добавления нового счета 

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
	


$result_t=mysql_time_query($link,'Select b.name,b.id_user,b.id from reports as b where b.id="'.htmlspecialchars(trim($_GET['id'])).'"');
$num_results_t = $result_t->num_rows;
if($num_results_t==0)
{	
		$debug=h4a(5,$echo_r,$debug);
		goto end_code;
	
} else
{
	$row_score = mysqli_fetch_assoc($result_t);
	/*
	if($row_score["status"]==3)
	{
		$debug=h4a(8,$echo_r,$debug);
		goto end_code;		
	}
	*/
}


if ((!$role->permission('Отчеты','D'))and($sign_admin!=1))
{
    goto end_code;	
}

if(($row_score["id_user"]!=$id_user)and($sign_admin!=1))
{
	goto end_code;	
}


/*
	if($sign_admin!=1)
	{
		goto end_code;	
	}
	*/
//составление секретного ключа формы
//составление секретного ключа формы
//соль для данного действия
$token=token_access_compile($_GET['id'],'dell_reports_xx',$secret);
//составление секретного ключа формы
//составление секретного ключа формы
//составление секретного ключа формы

	   

$status=1;
	   
	   ?>
<div id="Modal-one" class="box-modal table-modal eddd1"><div class="box-modal-pading">			    
<div class="top_modal">
	
	
	
  <div class="box-modal_close arcticmodal-close"></div>
  <? echo'<h1 class="h111" mor="'.$token.'" for="'.htmlspecialchars(trim($_GET['id'])).'"><span>Удаление Отчета</span></h1>'; ?>
  
  
  
</div>
<div class="center_modal">


<?
$date_base__=explode("-",$row_t["date"]);
$status_echo=$date_base__[2].'.'.$date_base__[1].'.'.$date_base__[0];				
echo'<div class="comme">Вы точно хотите удалить отчет №'.$row_score["id"].' - <b>'.$row_score["name"].'</b>?</div>';		
?>	


</div>		
<div class="bottom_modal">			
 <span class="clock_table"></span>
 		
<div id="no_rd" class="no_button"><i>Отменить</i></div>   	
<div id="button_dell_reports" class="save_button"><i>Удалить</i></div>
         

            
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

