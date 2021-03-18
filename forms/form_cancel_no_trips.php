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


$class_bba='cost_bank1';

if((!isset($_SESSION["user_id"]))or(!is_numeric(id_key_crypt_encrypt($_SESSION["user_id"]))))
{
    goto end_code;
}

$id_user=id_key_crypt_encrypt($_SESSION["user_id"]);

//проверить есть ли переменная id и можно ли этому пользователю это делать
if (count($_GET) != 1)
{
    goto end_code;
}
$status_admin=0;




if ((!$role->permission('Туры','U'))and($sign_admin!=1))
{
    goto end_code;
}

$result_t=mysql_time_query($link,'Select A.id,A.status,A.id_exchange from trips as A where A.visible=1 AND A.id="'.ht($_GET["id"]).'" and A.id_a_company="'.$id_company.'"');
$num_results_t = $result_t->num_rows;
if($num_results_t==0)
{
    $debug=h4a(5,$echo_r,$debug);
    goto end_code;
} else
{
    $row_score = mysqli_fetch_assoc($result_t);
}

if($row_score["status"]!=2)
{
    $debug=h4a(59,$echo_r,$debug);
    goto end_code;
}


//составление секретного ключа формы
//составление секретного ключа формы
//соль для данного действия
$token=token_access_compile($_GET["id"],'bt_del_cancel_trips',$secret);
//составление секретного ключа формы
//составление секретного ключа формы
//составление секретного ключа формы







$status=1;

	   ?>
<div id="Modal-one" class="box-modal table-modal eddd1 "><div class="box-modal-pading">
<div class="top_modal">
	
	
	
  <div class="box-modal_close arcticmodal-close"></div>
  <? echo'<h1 class="h111" mor="'.$token.'" for="'.htmlspecialchars(trim($_GET['id'])).'"><span>Отмена аннулирования</span></h1>'; ?>
  
  
  
</div>
<div class="center_modal"><div class="mobile-white">


<?
$date_base__=explode("-",$row_t["date"]);
$status_echo=$date_base__[2].'.'.$date_base__[1].'.'.$date_base__[0];				
echo'<div class="comme">Вы точно хотите отменить аннуляцию по туру <b>№'.$_GET["id"].'</b>?</div><br><br>';







?>





</div></div>
<div class="bottom_modal">			
 <span class="clock_table"></span>
<?
    if($status_admin==0)
    {

    echo'<div class="center_vert right_task_ccb" style="width: 100%; "><div class="add_cff_fin js-del-cancel-trips-x">Подтвердить</div>';

     }

  ?>
   <div class="task_cb_exit js-exit-window-add-task"  style="background-color: #eeefee;">


        <div class="task_cb_head">
            отменить
        </div>
    </div>


         

            
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

