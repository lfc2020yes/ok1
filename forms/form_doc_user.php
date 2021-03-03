<?php
//форма информация о туристе
//$name_form='002U';

$url_system=$_SERVER['DOCUMENT_ROOT'].'/';
include_once $url_system.'module/ajax_access.php';


//создание секрет для формы
$secret=rand_string_string(4);
$_SESSION['s_form'] = $secret;

$status=0;
$id=htmlspecialchars($_GET['id']);


   $class_bba='cost_bank1';

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
	


$result_t=mysql_time_query($link,'Select b.* from k_clients as b where b.id="'.htmlspecialchars(trim($_GET['id'])).'" and b.visible=1');
$num_results_t = $result_t->num_rows;
if($num_results_t==0)
{	
		$debug=h4a(5,$echo_r,$debug);
		goto end_code;
	
} else
{
	$row_score = mysqli_fetch_assoc($result_t);
}

if ((!$role->permission('Клиенты','R'))and($sign_admin!=1))
{
    goto end_code;	
}

//составление секретного ключа формы
//составление секретного ключа формы
//соль для данного действия
$token=token_access_compile($_GET['id'],'bt_client_info',$secret);
//составление секретного ключа формы
//составление секретного ключа формы
//составление секретного ключа формы
$status=1;

echo'<div id="Modal-one" class="box-modal table-modal eddd1 history_window1 client_window">';
?>	
<div class="box-modal-pading">			    
<div class="top_modal">
	
  <div class="box-modal_close arcticmodal-close"></div>
  <? echo'<h1 class="h111" mor="'.$token.'" for="'.htmlspecialchars(trim($_GET['id'])).'"><span>Информация о туристе</span></h1>'; ?>
  
  
  
</div>
<div class="center_modal">
<?
echo'<form id="vino_xd_cb" style=" padding:0; margin:0;" method="get" enctype="multipart/form-data">';
echo'<input type="hidden" value="'.htmlspecialchars(trim($_GET['id'])).'" name="id">';
echo'<input type="hidden" value="'.$token.'" name="tk">';		

$pol="<span class='pol-card' data-tooltip='мистер'>(MR)</span>";	
		if($row_score["pol"]==2)
		{
			$pol="<span class='pol-card' data-tooltip='миссис'>(MRS)</span>";	
		}
	
echo'<div class="name_docu" is_sha="'.ht($_GET['id']).'"><div class="name-doc1">'.$row_score["fio"].$pol.'</div>';


if (($role->permission('Обращения','A'))or($sign_admin==1))
{
    echo'<div class="name-doc1x" data-tooltip="Добавить обращение клиента"><div class="clock_cbb js-add-search-preorders-kclient"><i></i></div></div>';
}

if (($role->permission('Задачи','A'))or($sign_admin==1))
{
		echo'<div class="name-doc2" data-tooltip="Добавить задачу по клиенту"><div class="clock_cbb js-add-search-task-kclient"><i></i></div></div>';
	}

		echo'</div>';
	
echo'<div class="global_docu">
<div class="left_gl">';
echo'<div class="icc_gl_1">'.rooo($row_score["latin"],'','—').'</div>';

	$date_bb='—';
	if($row_score["date_birthday"]!='0000-00-00')
	{
 $razn_d=dateDiff_F(date("y-m-d").' '.date("H:i:s"),$row_score["date_birthday"]." 00:00:00");	
		
		$date_start1=explode("-",htmlspecialchars(trim($row_score["date_birthday"])));
				  
				   $startxr=$date_start1[2].'.'.$date_start1[1].'.'.$date_start1[0];
		$date_bb=$startxr.' ('.$razn_d.' '.PadejNumber($razn_d,'год,года,лет').')';
	}
	
echo'<div class="icc_gl_2">'.$date_bb.'</div>';
echo'</div>	
<div class="right_gl">';
	
	
	// $phone_format='+7 ('.$row_score["phone"][0].$row_score["phone"][1].$row_score["phone"][2].') '.$row_score["phone"][3].$row_score["phone"][4].$row_score["phone"][5].'-'.$row_score["phone"][6].$row_score["phone"][7].'-'.$row_score["phone"][8].$row_score["phone"][9];
if($row_score["phone"]!='') {
    $phone_format = phone_format($row_score["phone"]);
}
echo'<div class="icc_gl_3">'.rooo($phone_format,'','—').'</div>';


	
echo'<div class="icc_gl_4">'.rooo($row_score["email"],'','—').'</div>';	
echo'</div>		
</div>';	
	

//вывод задачи если она есть


//общие задачи, личные задачи невыполненные
$p=0;
$date_end_plus3=date_step_sql('Y-m-d','+'.$p.'d');


//создание временной таблицы

$result_8 = mysql_time_query($link,'CREATE TEMPORARY TABLE task_temp  as ( SELECT * FROM(

  (
    select A.*,0 as flag from  task_new as A WHERE A.id_user_responsible="' . ht($id_user) . '" and A.visible=1 and A.id_a_company="' . ht($id_company) . '" and A.status=0 and A.action IN ("7", "11","12") and A.id_object="' . ht($_GET["id"]) . '"
  )
  
  UNION
  (
    select A.*,0 as flag from  task_new as A,k_clients_commun as K WHERE K.id=A.id_object and A.id_user_responsible="' . ht($id_user) . '" and A.visible=1 and A.id_a_company="' . ht($id_company) . '" and A.status=0 and A.action=10 and K.id_client="' . ht($_GET["id"]) . '"  
  )
  UNION
  (
    select A.*,0 as flag from  task_new as A,trips as K WHERE K.id=A.id_object and A.id_user_responsible="' . ht($id_user) . '" and A.visible=1 and A.id_a_company="' . ht($id_company) . '" and A.status=0 and A.action IN ("15", "16","17","19") and K.id_shopper="' . ht($_GET["id"]) . '" and K.shopper=1
  ) 
  UNION
  (
    select A.*,0 as flag from  task_new as A,preorders as K WHERE K.id=A.id_object and A.id_user_responsible="' . ht($id_user) . '" and A.visible=1 and A.id_a_company="' . ht($id_company) . '" and A.status=0 and A.action=20 and K.id_k_clients="' . ht($_GET["id"]) . '"  
  )  
  
 
 ) LL )');


//добавление во временную таблицу значений
mysql_time_query($link, 'INSERT INTO task_temp (
    select A.*,1 as flag from  task_new as A WHERE A.id_user_responsible LIKE "'.$id_user.',%" and A.visible=1 and A.id_a_company="' . ht($id_company) . '" and A.status=0 and A.action IN ("7", "11","12") and A.id_object="' . ht($_GET["id"]) . '"
  )
  
  UNION
  (
    select A.*,1 as flag from  task_new as A,k_clients_commun as K WHERE K.id=A.id_object and A.id_user_responsible LIKE "'.$id_user.',%" and A.visible=1 and A.id_a_company="' . ht($id_company) . '" and A.status=0 and A.action=10 and K.id_client="' . ht($_GET["id"]) . '"  
  )
  UNION
  (
    select A.*,1 as flag from  task_new as A,trips as K WHERE K.id=A.id_object and A.id_user_responsible LIKE "'.$id_user.',%" and A.visible=1 and A.id_a_company="' . ht($id_company) . '" and A.status=0 and A.action IN ("15", "16","17","19") and K.id_shopper="' . ht($_GET["id"]) . '" and K.shopper=1
  ) 
  UNION
  (
    select A.*,1 as flag from  task_new as A,preorders as K WHERE K.id=A.id_object and A.id_user_responsible LIKE "'.$id_user.',%" and A.visible=1 and A.id_a_company="' . ht($id_company) . '" and A.status=0 and A.action=20 and K.id_k_clients="' . ht($_GET["id"]) . '"  
    )');


//добавление во временную таблицу значений
mysql_time_query($link, 'INSERT INTO task_temp (
    select A.*,1 as flag from  task_new as A WHERE A.id_user_responsible LIKE "%,'.$id_user.',%" and A.visible=1 and A.id_a_company="' . ht($id_company) . '" and A.status=0 and A.action IN ("7", "11","12") and A.id_object="' . ht($_GET["id"]) . '"
  )
  
  UNION
  (
    select A.*,1 as flag from  task_new as A,k_clients_commun as K WHERE K.id=A.id_object and A.id_user_responsible LIKE "%,'.$id_user.',%" and A.visible=1 and A.id_a_company="' . ht($id_company) . '" and A.status=0 and A.action=10 and K.id_client="' . ht($_GET["id"]) . '"  
  )
  UNION
  (
    select A.*,1 as flag from  task_new as A,trips as K WHERE K.id=A.id_object and A.id_user_responsible LIKE "%,'.$id_user.',%" and A.visible=1 and A.id_a_company="' . ht($id_company) . '" and A.status=0 and A.action IN ("15", "16","17","19") and K.id_shopper="' . ht($_GET["id"]) . '" and K.shopper=1
  ) 
  UNION
  (
    select A.*,1 as flag from  task_new as A,preorders as K WHERE K.id=A.id_object and A.id_user_responsible LIKE "%,'.$id_user.',%" and A.visible=1 and A.id_a_company="' . ht($id_company) . '" and A.status=0 and A.action=20 and K.id_k_clients="' . ht($_GET["id"]) . '"  
    )');

//добавление во временную таблицу значений
mysql_time_query($link, 'INSERT INTO task_temp (
    select A.*,1 as flag from  task_new as A WHERE A.id_user_responsible LIKE "%,'.$id_user.'" and A.visible=1 and A.id_a_company="' . ht($id_company) . '" and A.status=0 and A.action IN ("7", "11","12") and A.id_object="' . ht($_GET["id"]) . '"
  )
  
  UNION
  (
    select A.*,1 as flag from  task_new as A,k_clients_commun as K WHERE K.id=A.id_object and A.id_user_responsible LIKE "%,'.$id_user.'" and A.visible=1 and A.id_a_company="' . ht($id_company) . '" and A.status=0 and A.action=10 and K.id_client="' . ht($_GET["id"]) . '"  
  )
  UNION
  (
    select A.*,1 as flag from  task_new as A,trips as K WHERE K.id=A.id_object and A.id_user_responsible LIKE "%,'.$id_user.'" and A.visible=1 and A.id_a_company="' . ht($id_company) . '" and A.status=0 and A.action IN ("15", "16","17","19") and K.id_shopper="' . ht($_GET["id"]) . '" and K.shopper=1
  ) 
  UNION
  (
    select A.*,1 as flag from  task_new as A,preorders as K WHERE K.id=A.id_object and A.id_user_responsible LIKE "%,'.$id_user.'" and A.visible=1 and A.id_a_company="' . ht($id_company) . '" and A.status=0 and A.action=20 and K.id_k_clients="' . ht($_GET["id"]) . '"  
    )');


$result_8 = mysql_time_query($link,'
select * from task_temp as Z where not((Z.reminder=1)and(LOWER(Z.ring_datetime)<"'.date("Y-m-d").' 00:00:00")) order by Z.ring_datetime

');

$max_day_ring=1;
$num_8 = $result_8->num_rows;
$pros=1;
if($num_8>0)
{
    echo'<div class="ring_block ring-block-line js-ring-3" style="margin-bottom: 20px;">';
} else
{
    echo'<div style="display:none; margin-bottom: 20px;"  class="ring_block ring-block-line js-ring-3">';
}
echo'<div class="h1-ring"><span>задачи по клиенту</span><i></i></div>';
if(($num_8-$max_day_ring)>0)
{
    echo'<div max="'.$max_day_ring.'" class="eshe-ring js-eshe-ring"><span class="ring-x1">еще '.($num_8-$max_day_ring).'</span><span class="ring-x2">Скрыть</span></div>';
} else
{
    echo'<div style="display:none;" max="'.$max_day_ring.'" class="eshe-ring js-eshe-ring"><span class="ring-x1">еще '.($num_8-$max_day_ring).'</span><span class="ring-x2">Скрыть</span></div>';
}

echo'<div class="block-ring-x">';
if(($result_8)and($num_8>0))
{
    $count_ring=0;
    $class_ring='';
    while($row_8 = mysqli_fetch_assoc($result_8)){
        if($count_ring>=$max_day_ring)
        {
            $class_ring='max-day-ring';
        }
$big_date=1;
        include $url_system.'task/code/block_index.php';
        echo($task_cloud_block);



    }
}
echo'</div>';
echo'</div>';

/*

echo'<div class="task_clock_task_2021"><div class="task_clock_selection1">
					    <div class="clock_cbb"><i></i></div>
					    <div class="why_task_cbb">
					  <span>Сделать предложения по Турции</span><i>26 января <div class="help-jj">(Завтра)</div> - 12:30</i>
					  </div>
					  </div></div>';

*/



//меню с нужными вкладками
	?>
<div class="menu_client_w">
   <div class="mm_w">
	   <ul class="tabs_hedi js-tabs-menu">
		  <?
          $tabs_menu_x = array("о туристе", "подборки", "обращения", "путешествия", "общение","файлы");
          if($row_score["potential"]!=2) {
              $tabs_menu_potential = array("1", "1", "1", "0", "1","1");
          } else
          {
              $tabs_menu_potential = array("1", "0", "0", "1", "0","1");
          }
		   
	   $tabs_menu_x_id = array("0","4","1","2","3","5");
	    for ($i=0; $i<count($tabs_menu_x); $i++)
             {   
			  if($row_score["potential"]==0)
			  {
			     if($_GET['tabs']==$tabs_menu_x_id[$i])
			     {
				    echo'<li class="tabsss active" id="'.$tabs_menu_x_id[$i].'">'.$tabs_menu_x[$i].'</li>';
			     } else
			     {
				    echo'<li class="tabsss" id="'.$tabs_menu_x_id[$i].'">'.$tabs_menu_x[$i].'</li>';
			     }
			  } else
			  {
				  if($tabs_menu_potential[$i]==1)
				  {
					  if($_GET['tabs']==$tabs_menu_x_id[$i])
			     {
				    echo'<li class="tabsss active" id="'.$tabs_menu_x_id[$i].'">'.$tabs_menu_x[$i].'</li>';
			     } else
			     {
				    echo'<li class="tabsss" id="'.$tabs_menu_x_id[$i].'">'.$tabs_menu_x[$i].'</li>';
			     }
				  }
				  
				  
			  }
			 }
?>

	   </ul>
   </div>
</div>	
<div class="px_bg">
<?
// о туристе
if($_GET['tabs']==0)
{
include $url_system.'clients/code/tabs_about.php'; 
echo($query_string);	
}
// заявки
if($row_score["potential"]!=2) {
    if ($_GET['tabs'] == 1) {
        include $url_system . 'clients/code/tabs_booking.php';
        echo($query_string);
    }
}

if($row_score["potential"]!=2) {
    if ($_GET['tabs'] == 4) {
        include $url_system . 'clients/code/tabs_podborki.php';
        echo($query_string);
    }
}
	
// путешествия что покупал
if(($row_score["potential"]==0)or($row_score["potential"]==2))
{
if($_GET['tabs']==2)
{
include $url_system.'clients/code/tabs_offers.php'; 
echo($query_string);		
}
}

if($row_score["potential"]!=2) {
// общение с туристом 
    if ($_GET['tabs'] == 3) {
        include $url_system . 'clients/code/tabs_say.php';
        echo($query_string);
    }
}
if ($_GET['tabs'] == 5) {
//файлы
    include $url_system . 'clients/code/tabs_file.php';
    echo($query_string);
}
	
?>	
	</div>
	<?

	
		  
?>
</form>
</div>		
<div class="bottom_modal">			
 <span class="clock_table"></span>
	<div class="js-tabs_docc js-tabs_0 tabs_11_2">
 <?	
if (($role->permission('Клиенты','U'))or($sign_admin==1))
{
echo'<div id="no_rdx" class="save_button edit_client_cb   js-edit-2020-user" id_rel="'.$_GET["id"].'"><i>Редактировать</i></div>';
}
		
		$result_status22=mysql_time_query($link,'SELECT count(a.id) as cc FROM booking AS a WHERE a.id_client="'.htmlspecialchars(trim($_GET["id"])).'"');	
					 //echo('SELECT a.* FROM r_status AS a WHERE a.numer_status="'.$row1ss["status"].'" and a.id_system=13');
                if($result_status22->num_rows!=0)
                {  
                   $row_status22 = mysqli_fetch_assoc($result_status22);
				} 			   
			   
if((($sign_admin==1)or($row_score["id_user"]==$id_user))and($row_status22["cc"]==0))
{
echo'<div id="" class="no_button del_client_cb del_clients_" id_rel="'.$_GET["id"].'"><i>Удалить</i></div>';
}		
		
?>


		</div>
	<!--<div class="js-tabs_docc js-tabs_3">-->
		
 <?	
	
//echo'<div id="no_rd" class="save_button add_say_cb" id_rel="'.$_GET["id"].'"><i>Добавить запись</i></div>';
         

 ?> 		
		
		<!--</div>-->
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
	 

var id_tt=$('.js-tabs-menu').find('.active').attr('id');
	 //alert(id_tt);
		$('.js-tabs_docc').hide();
		$('.js-tabs_'+id_tt).show();	 
	 ToolTip();
	
	 		$(".slct").unbind('click.sys');
		$(".slct").bind('click.sys', slctclick);
		$(".drop").find("li").unbind('click');
		$(".drop").find("li").bind('click', dropli);
	 $('#typesay').unbind('change', changesay);
	 $('#typesay').bind('change', changesay);
	 input_2018();
	 
	 		$('.date_picker_x').inputmask("datetime",{
    mask: "1.2.y", 
    placeholder: "dd.mm.yyyy",  
    separator: ".", 
    alias: "dd.mm.yyyy"
  });
		
	 
 });
	 </script>