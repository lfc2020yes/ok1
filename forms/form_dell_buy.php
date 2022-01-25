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
if ((count($_GET) != 2)or(!isset($_GET["id"]))or((!is_numeric($_GET["id"])))) 
{
	goto end_code;	
}


$status_admin=0;
$result_t=mysql_time_query($link,'Select A.id,A.status_admin from trips as A where A.visible=1 AND A.id="'.ht($_GET["id"]).'" and A.id_a_company IN ('.$id_company.')');
$num_results_t = $result_t->num_rows;
if($num_results_t==0)
{	
		$debug=h4a(5,$echo_r,$debug);
		goto end_code;
	
} else
{
	$row_score = mysqli_fetch_assoc($result_t);
    $status_admin=$row_score['status_admin'];
}

$mas_responsible=array();
$result_uu = mysql_time_query($link, 'select A.id_user  from trips_payment as A where A.id="' . ht($_GET['id_buy']) . '"');
$num_results_uu = $result_uu->num_rows;

if ($num_results_uu != 0) {
    $row_uu = mysqli_fetch_assoc($result_uu);
    array_push($mas_responsible,$row_uu["id_user"]);
} else
{
    $debug=h4a(95,$echo_r,$debug);
    goto end_code;
}



$tabs_menu_x_visible[4]=0;
if($row_uu["id_user"]!=0)
{
    if(($sign_admin!=1))
    {

        if($row_uu["id_user"]==$id_user)
        {
            $tabs_menu_x_visible[4]="1";
        }

        if (in_array($id_user, $mas_responsible))
        {
            $tabs_menu_x_visible[4]="1";
        } else
        {
            //может он управляющий кого то кто должен выполнить эту задачу тогда ему тоже можно ее выполнить
            $subo_x = array();
            foreach ($mas_responsible as $key => $value)
            {
                $subo_x = array_merge($subo_x, all_chief($value,$link));

            }
            $subo_x= array_unique($subo_x);


            if ((in_array($id_user, $subo_x)))
            {
                $tabs_menu_x_visible[4]="1";
            }

        }
    }  else
    {
        $tabs_menu_x_visible[4]="1";
    }

}

if($tabs_menu_x_visible[4]!="1")
{
    $debug=h4a(6,$echo_r,$debug);
    goto end_code;
}


if ((!$role->permission('Туры','U'))and($sign_admin!=1))
{
    goto end_code;	
}

//составление секретного ключа формы
//составление секретного ключа формы
//соль для данного действия
$token=token_access_compile($_GET['id_buy'],'dell_buy_trips',$secret);

//составление секретного ключа формы
//составление секретного ключа формы
//составление секретного ключа формы

	   

$status=1;
	   
	   ?>
<div id="Modal-one" class="box-modal table-modal eddd1 buy_trips_window1"><div class="box-modal-pading">
<div class="top_modal">
	
	
	
  <div class="box-modal_close arcticmodal-close"></div>
  <? echo'<h1 class="h111" mor="'.$token.'" for="'.htmlspecialchars(trim($_GET['id_buy'])).'"><span>Удаление оплаты</span></h1>'; ?>
  
  
  
</div>
<div class="center_modal"><div class="mobile-white">


<?
$date_base__=explode("-",$row_t["date"]);
$status_echo=$date_base__[2].'.'.$date_base__[1].'.'.$date_base__[0];				
echo'<div class="comme">Вы точно хотите удалить оплату <b>№'.$_GET["id_buy"].'</b> по туру <b>№'.$_GET["id"].'</b>?</div><br><br>';



$result_uu = mysql_time_query($link, 'select A.*,B.name from trips_payment as A, booking_payment_method as B where A.id="'.ht($_GET["id_buy"]).'" and A.id_payment_method=B.id');

$num_results_uu = $result_uu->num_rows;

if ($result_uu) {
    $i = 0;
    while ($row_uu = mysqli_fetch_assoc($result_uu)) {

        include $url_system.'tours/code/block_buy.php';
    }
}

echo $query_string;





?>





</div></div>
<div class="bottom_modal">			
 <span class="clock_table"></span>
 		
<div id="no_rd" class="no_button"><i>Отменить</i></div>

    <?
    if($status_admin==0)
    {

        echo'<div id="button_dell_buy" class="save_button js-dell-buy-trips-b"><i>Удалить</i></div>';

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

