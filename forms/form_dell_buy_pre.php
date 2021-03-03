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
$result_t=mysql_time_query($link,'Select b.* from preorders as b where b.id="'.htmlspecialchars(trim($_GET['id_buy'])).'" and b.visible=1 and b.id_company="'.ht($id_company).'"');
$num_results_t = $result_t->num_rows;
if($num_results_t==0)
{	
		$debug=h4a(5,$echo_r,$debug);
		goto end_code;
	
} else
{
	$row_uu = mysqli_fetch_assoc($result_t);
}


if ((!$role->permission('Обращения','D'))and($sign_admin!=1))
{
    goto end_code;	
}


if(($row_uu['id_user']!=$id_user)and($sign_admin!=1))
{
    goto end_code;
}

//составление секретного ключа формы
//составление секретного ключа формы
//соль для данного действия
$token=token_access_compile($_GET['id_buy'],'dell_buy_preorders',$secret);

//составление секретного ключа формы
//составление секретного ключа формы
//составление секретного ключа формы

	   

$status=1;
	   
	   ?>
<div id="Modal-one" class="box-modal table-modal eddd1 buy_trips_window1"><div class="box-modal-pading">
<div class="top_modal">
	
	
	
  <div class="box-modal_close arcticmodal-close"></div>
  <? echo'<h1 class="h111" mor="'.$token.'" for="'.htmlspecialchars(trim($_GET['id_buy'])).'"><span>Удаление Обращения №'.$_GET['id_buy'].'</span></h1>'; ?>
  
  
  
</div>
<div class="center_modal"><div class="mobile-white">


<?

echo'<div class="comme">Вы точно хотите удалить обращение <b>№'.$_GET['id_buy'].'</b>?</div><br><br>';



?>





</div>		</div>
        <div class="bottom_modal">
 <span class="clock_table"></span>
 		
<div id="no_rd223" class="no_button js-exit-window-add-task"><i>Отменить</i></div>

    <?
    if($status_admin==0)
    {

        echo'<div id="button_dell_buy_pre" class="save_button js-dell-buy-pre-b"><i>Удалить</i></div>';

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

