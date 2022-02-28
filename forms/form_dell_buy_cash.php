<?php
//форма удаления платежа в турах

$url_system=$_SERVER['DOCUMENT_ROOT'].'/';
include_once $url_system.'module/ajax_access.php';


//создание секрет для формы
/*
$secret=rand_string_string(4);
if(!isset($_SESSION['rema']))
{
    $_SESSION['rema'] = $secret;
} else
{
    $secret=$_SESSION['rema'];
}
*/

$status=0;



//платеж его или кем он руководит
//платеж существует
//платеж по туру  компании в которой он работает
//у него есть права на редактирование турами

if((!isset($_SESSION["user_id"]))or(!is_numeric(id_key_crypt_encrypt($_SESSION["user_id"]))))
{	
	goto end_code;
}

$id_user=id_key_crypt_encrypt($_SESSION["user_id"]);

//проверить есть ли переменная id и можно ли этому пользователю это делать
if ((count($_GET) != 1)or(!isset($_GET["id_buy"]))or((!is_numeric($_GET["id_buy"]))))
{
	goto end_code;	
}


$status_admin=0;

//операцию можно удалить в течение часа после ее добавления
//проверять что операция в том офисе к которому он имеет отношение
//удалить может только тот кто ее создал
$dateTime = new DateTime();
date_modify($dateTime, "-1 hour"); // на 1 час назад
$date_new = date_format($dateTime, "Y-m-d H:i:s");

$result_t=mysql_time_query($link,'Select b.* from cash_operation as b where b.id="'.htmlspecialchars(trim($_GET['id_buy'])).'" and b.id_user="'.ht($id_user).'" and b.date>"'.$date_new.'" and b.id_office IN ('.ht($id_office_sql).')');
$num_results_t = $result_t->num_rows;
if($num_results_t==0)
{	
		$debug=h4a(5,$echo_r,$debug);
		goto end_code;
	
} else
{
	$row_uu = mysqli_fetch_assoc($result_t);
}


if ((!$role->permission('Касса','D'))and($sign_admin!=1))
{
    goto end_code;	
}

//составление секретного ключа формы
//составление секретного ключа формы
//соль для данного действия
$token=token_access_compile($_GET['id_buy'],'dell_buy_cash',$secret);

//составление секретного ключа формы
//составление секретного ключа формы
//составление секретного ключа формы

	   

$status=1;
	   
	   ?>
<div id="Modal-one" class="box-modal table-modal eddd1 buy_trips_window1"><div class="box-modal-pading">
<div class="top_modal">
	
	
	
  <div class="box-modal_close arcticmodal-close"></div>
  <? echo'<h1 class="h111" mor="'.$token.'" for="'.htmlspecialchars(trim($_GET['id_buy'])).'"><span>Удаление операции</span></h1>'; ?>
  
  
  
</div>
<div class="center_modal"><div class="mobile-white">


<?
$date_base__=explode("-",$row_t["date"]);
$status_echo=$date_base__[2].'.'.$date_base__[1].'.'.$date_base__[0];				
echo'<div class="comme">Вы точно хотите удалить операцию <b>№'.$_GET["id_buy"].'</b>?</div><br><br>';



$edit_moo=0;
        include $url_system.'cash/code/block_buy.php';



echo $query_string;





?>





</div>		</div>
        <div class="bottom_modal">
 <span class="clock_table"></span>
 		
<div id="no_rd223" class="no_button js-exit-window-add-task"><i>Отменить</i></div>

    <?
    if($status_admin==0)
    {
        echo'<div id="button_dell_buy_cash" class="save_button js-dell-buy-cash-b"><i>Удалить</i></div>';
    }
    ?>


         

            
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

