<?
//добавление нового тура

session_start();

$active_menu='tours';  // в каком меню

$url_system=$_SERVER['DOCUMENT_ROOT'].'/'; include_once $url_system.'module/config.php'; include_once $url_system.'module/function.php'; include_once $url_system.'login/function_users.php'; initiate($link); include_once $url_system.'module/access.php';






//правам к просмотру к действиям
$hie = new hierarchy($link,$id_user);
//echo($id_user);
$hie_object=array();
$hie_town=array();
$hie_kvartal=array();
$hie_user=array();	
$hie_object=$hie->obj;
$hie_kvartal=$hie->id_kvartal;
$hie_town=$hie->id_town;
$hie_user=$hie->user;

$sign_level=$hie->sign_level;
$sign_admin=$hie->admin;


$role->GetColumns();
$role->GetRows();
$role->GetPermission();
//правам к просмотру к действиям
//$user_send_new=array();

//создателю
//админу
//всем кто выше поо левал
//print_r($hie_object);

//$secret=rand_string_string(4);
//$_SESSION['s_t'] = $secret;	
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

//89084835233

//проверить и перейти к последней себестоимости в которой был пользователь

//проверка адреса сайта на существование такой страницы
//проверка адреса сайта на существование такой страницы
//проверка адреса сайта на существование такой страницы
//      /finery/add/28/
//     0   1     2  3

$error_header=0;
$url_404=$_SERVER['REQUEST_URI'];
//echo($url_404);
$D_404 = explode('/', $url_404);


if (strripos($url_404, 'index_add.php') !== false) {
   header404(1,$echo_r);	
}

if ( count($_GET) != 0 )
{
   header404(2,$echo_r);		
}

if((!$role->permission('Туры','A'))and($sign_admin!=1))
{
  header404(3,$echo_r);
}

//если такой страницы нет или не может быть выведена с такими параметрами
if($error_header==404)
{
	include $url_system.'module/error404.php';
	die();
}

//проверка адреса сайта на существование такой страницы
//проверка адреса сайта на существование такой страницы
//проверка адреса сайта на существование такой страницы


include_once $url_system.'template/html.php'; include $url_system.'module/seo.php';

if($error_header!=404){ SEO('tours_add','','','',$link); } else { SEO('0','','','',$link); }

include_once $url_system.'module/config_url.php'; include $url_system.'template/head.php';
?>
</head><body><div class="container">
<?

	
        if ( isset($_COOKIE["iss"]))
		{
          if($_COOKIE["iss"]=='s')
		  {
			  echo'<div class="iss small">';
		  } else
		  {
			  echo'<div class="iss big">';			  
		  }
		} else
		{
			echo'<div class="iss small">';	
		}
echo'<div class="alert_wrapper"><div class="div-box"></div></div>';
	
/*	
        $result_town=mysql_time_query($link,'select A.id_town,B.town,A.kvartal from i_kvartal as A,i_town as B where A.id_town=B.id and A.id="'.$row_list["id_kvartal"].'"');
        $num_results_custom_town = $result_town->num_rows;
        if($num_results_custom_town!=0)
        {
			$row_town = mysqli_fetch_assoc($result_town);	
		}	
*/	
?>

<div class="left_block">
  <div class="content">

<?
                $act_='display:none;';
	            $act_1='';
	            if(cookie_work('it_','on','.',60,'0'))
	            {
		            $act_='';
					$act_1='on="show"';
	            }

	  include_once $url_system.'template/top_tours_add.php';

	  echo'<form id="js-form-tender-new" class="my_n js-form-tender-new" style=" padding:0; margin:0;" method="post" enctype="multipart/form-data"><input name="save_tours" value="1" type="hidden">';

				echo'<input name="tk1" value="vWeVE8zAZe" type="hidden">';
	  
	  	$token=token_access_compile(2020,'add_tours',$secret);				
						
		echo'<input type="hidden" value="'.$token.'" name="tk">'; 
	  
	 echo'<div id="fullpage" class="margin_60 js-form-add-tours">';
	?>
	<span class="section" id="section0">
	<div class="height_100vh">

		
	<?
	//если форма вернулась значит что то пошло не так. выводим сообщение об этом		
if((isset($_POST['save_tours']))and($_POST['save_tours']==1))
{
?>
<div class="div_ook js-hide-div p_bot">
<div class="help_div da_book1 da_book_red js-hide-help"><div class="not_boolingh"></div><span class="h5"><span>Что-то пошло не так. Пожалуйста попробуйте ещё раз. Либо поменяйте необходимые данные</span></span></div>
<script type="text/javascript">
$(function (){ setTimeout ( function () { $('.js-hide-div').slideUp("slow");	}, 5000 );});
</script>
</div>	
<?
}
?>		


	<div class="div_ook">


        <div class="block-tours js-doc-create create-block" style="margin-top: 60px;">
            <div class="block-add-tours">

                <div class="block-h1">Документы</div>
<span class="js-alert-doc">

</span>
            </div>
        </div>


<span class="js-doc-yes-hide">
   <div class="block-tours">  
	<div class="block-add-tours">	
		<div class="pad10" style="padding: 0; position:relative; z-index: 1000"><span class="CalBox_Tours"></span></div>
		<div class="block-h1">Оформление нового тура</div>

		<?
		
		//номер договора в компании umatravel
$number_doc='';
	$result_status2d=mysql_time_query($link,'SELECT MAX(b.number) AS cc FROM trips_contract AS b,trips as a WHERE b.id_a_company IN ('.ht($id_group_company_list).') and a.visible=1 and a.id_contract=b.id and b.years="'.date('Y').'"');
					 //echo('SELECT a.* FROM r_status AS a WHERE a.numer_status="'.$row1ss["status"].'" and a.id_system=13');
                if($result_status2d->num_rows!=0)
                {  
                   $row_status2d = mysqli_fetch_assoc($result_status2d);	
	
				//$number_doc=date('d').'/'.date('m').'/'.date('Y').' - '.($row_status2d["cc"]+1).' от '.date('d').' '.month_rus(date('m')).' '.date('Y');

				$number_doc=date('d').'/'.date('m').'/'.date('Y').' - '.($row_status2d["cc"]+1);
				}
		?>
		
<!--input start	-->		
	<div style="margin-top: 30px;" ><div class="input_2018"><label>Номер договора<span>*</span></label><input name="number_contract" value="<? echo($number_doc); ?>" id="date_124" class="input_new_2018 required  gloab  no_upperr js-in1" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>
<!--input end	-->		
	<?	
	
	echo'<script type="text/javascript" src="Js/jquery-ui-1.9.2.custom.min.js"></script>
	<script type="text/javascript" src="Js/jquery.datepicker.extension.range.min.js"></script>';	
		
	?>	
<!--input start	-->		
		<?
$query_string='<div style="margin-top: 30px; " class="js-zindex"><div class="input_2018"><label>Дата договора</label><input readonly="true" name="doc_date" value="" id="date_table_tours_add" class="input_new_2018 required gloab js-in2" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"></div></div>
</div><input id="date_hidden_tours_add"  name="date_sele_doc" value="" type="hidden">';
		
$query_string.=calendar_add('.CalBox_Tours','#date_table_tours_add','#date_hidden_tours_add');
$query_string.=calendar_var(date('Y').'-'.date('m').'-'.date('d'),'#date_table_tours_add','#date_hidden_tours_add');		
echo($query_string);
		
		?>

<!--input end	-->	
		
<!--input start	-->	
		<?
	echo'<div style="margin-top: 30px; " class="input_doc_turs js-zindex">';
		?>
		<div class="input_2018 input-search-list" list_number="s1">
			<i class="js-open-search"></i><span class="click-search-name"></span>
			<label>Туроператор<span>*</span></label>
			
			<input name="operator" value="" id="date_124" sopen="search_turoper" class="input_new_2018 required  gloab js-keyup-search js-in3" autocomplete="off" type="text">
			
			<input type="hidden" value="0" class="js-hidden-search" name="id_operator">
			
			<ul class="drop drop-search js-drop-search" style="transform: scaleY(0);">
			<?

            //если у пользователя много организаций то выводить все туроператоры по всем организациям
            //а если это москва но нужны туроператоры общего филиала



		$result_work_zz=mysql_time_query($link,'Select a.* from booking_operator as a WHERE a.id_a_company IN ('.ht($id_group_company_list).') and a.visible=1 ORDER BY a.eye DESC,a.id limit 0,15');
        $num_results_work_zz = $result_work_zz->num_rows;
	    if($num_results_work_zz!=0)
	    {

		   for ($i=0; $i<$num_results_work_zz; $i++)
		   {			   			  			   
			   $row_work_zz = mysqli_fetch_assoc($result_work_zz);
			   echo '<li><a href="javascript:void(0);" rel="'.$row_work_zz["id"].'">'.$row_work_zz["name"].'</a></li>';
		   }			
		}
			?>
			</ul>
			
			<div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>
<!--input end	-->




       <!--input start	-->
		<?
        echo'<div style="margin-top: 30px; " class="input_doc_turs js-zindex">';
        ?>
		<div class="input_2018 input-search-list" list_number="s2">
			<i class="js-open-search"></i><span class="click-search-name"></span>
			<label>Обращение (№ или ФИО туриста)</label>

			<input name="preorders" value="" id="date_124" sopen="search_preorders" class="input_new_2018 required  js-keyup-search js-in3" autocomplete="off" type="text">

			<input type="hidden" value="0" class="js-hidden-search" name="id_preorders">

			<ul class="drop drop-search js-drop-search" style="transform: scaleY(0);">
			<?
            $result_work_zz=mysql_time_query($link,'Select a.id,a.date_create,a.id_type_clients,a.id_k_clients,a.id_country from preorders as a WHERE a.id_company IN ('.ht($id_company).') and a.visible=1 and a.id_user="'.ht($id_user).'" and not(a.status IN ("5","6")) ORDER BY a.date_create desc limit 0,15');
            $num_results_work_zz = $result_work_zz->num_rows;
            if($num_results_work_zz!=0)
            {

                for ($i=0; $i<$num_results_work_zz; $i++)
                {
                    $row_work_zz = mysqli_fetch_assoc($result_work_zz);
$country='не указана';
                    $result_uu1 = mysql_time_query($link, 'select name from trips_country where id="' . ht($row_work_zz['id_country']) . '" and visible=1');
                    $num_results_uu1 = $result_uu1->num_rows;

                    if ($num_results_uu1 != 0) {
                        $row_uu1 = mysqli_fetch_assoc($result_uu1);
                        $country=$row_uu1["name"];
                    }

                    if($row_work_zz["id_type_clients"]==1) {
                        //частное лицо
                        $result_uu78 = mysql_time_query($link, 'select fio from k_clients where id="'.ht($row_work_zz["id_k_clients"]) . '"');
                    } else
                    {
                        //2 фирма
                        $result_uu78 = mysql_time_query($link, 'select name as fio from k_organization where id="'.ht($row_work_zz["id_k_clients"]) . '"');
                    }
                    $num_results_uu78 = $result_uu78->num_rows;

                    if($num_results_uu78!=0) {
                        $row_uu78 = mysqli_fetch_assoc($result_uu78);
                        $date_mass2 = explode(" ", ht($row_work_zz['date_create']));
                        $date_mass = explode("-", ht($date_mass2[0]));
                        $date_start = $date_mass[2] . '.' . $date_mass[1] . '.' . $date_mass[0];

                        echo '<li><a href="javascript:void(0);" rel="' . $row_work_zz["id"] . '">№'.$row_work_zz["id"].' / '.$date_start.' / '.$row_uu78["fio"].' / '.$country.'</a></li>';
                    }
                }
            }
            ?>
			</ul>

			<div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>
    <!--input end	-->


       <!--input start	-->
       <div style="margin-top: 30px;" ><div class="input_2018"><label>Номер заявки у туроператора<span>*</span></label><input name="turoper_booking" value="" id="date_124" class="input_new_2018 required   gloab no_upperr" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
       </div>
       <!--input end	-->


       <!--input start	-->
<?

 $os_say55 = array();
 $os_id_say55 = array();	 
	$su_say55=-1; 	 
	 
$query_string='<div style="margin-top: 30px;" class="input_doc_turs js-zindex">	';
	
$query_string.='<div class="left_drop list_2018 menu1_prime"><label class="">Рекламный источник<span>*</span></label><div class="select eddd zin_2019"><a class="slct" list_number="t1" data_src=""></a><ul class="drop">';

	
$result_8 = mysql_time_query($link,'select A.* from  booking_sourse as A where A.id_a_company IN('.ht($id_group_company_list).') and A.visible=1 order by A.displayOrder');
		
$num_8 = $result_8->num_rows;	
//$row_1 = mysqli_fetch_assoc($result2);
if($result_8)
{	
	
	/*
				   $query_string.='<li class="sel_active"><a href="javascript:void(0);"  rel="'.$os_id_say55[array_search(1, $os_id_say55)].'">'.$os_say55[array_search(0, $os_id_say55)].'</a></li>';
	*/
	 
  			  while($row_8 = mysqli_fetch_assoc($result_8)){ 
				  
				 if($su_say55==$row_8["id"])
			   {
				   $query_string.='<li class="sel_active"><a href="javascript:void(0);"  rel="'.$row_8["id"].'">'.$row_8["name"].'</a></li>';
			   } else
			   {
				  $query_string.='<li><a href="javascript:void(0);"  rel="'.$row_8["id"].'">'.$row_8["name"].'</a></li>'; 
			   }
			   
			 }
}
	 
	 

		   $query_string.='</ul><input type="hidden" class="gloab"  name="id_booking_sourse" id="pol_clients" value=""><div class="div_new_2018"><hr class="one"></div></div></div></div>';			
		echo $query_string;
		
		
	?>	
		<!--input end	-->	
	
	
<!--input start	-->		
<div class="password_turs">
<div id="1" class="input-choice-click-pass js-password-butt active_pass">
<div class="choice-head">Заграничный Паспорт</div>
<div class="choice-radio"><div class="center_vert1"><i class="active_task_cb"></i></div></div>
</div>	

<div id="2" class="input-choice-click-pass js-password-butt">
<div class="choice-head">Внутренний Паспорт</div>
<div class="choice-radio"><div class="center_vert1"><i></i></div></div>
</div>
<input name="password" value="1" type="hidden">	
</div>		
<!--input end -->	
		
		</div>
		</div>

<?
$_POST['tours']['buy_id'] ??= '';
$_POST['tours']['buy_type']	 ??= '';
	$_POST['tours']['fly_id'] ??= '';
	$_POST['tours']['fly_count'] ??= '';
echo'<input type="hidden" class="tot_buy_id"  name="buy_id" value="'.ipost_($_POST['tours']['buy_id'],"").'">		
<input type="hidden" class="tot_buy_type"  name="buy_type" value="'.ipost_($_POST['tours']['buy_type'],"").'">			
<input type="hidden" class="tot_fly_id"  name="fly_id" value="'.ipost_($_POST['tours']['fly_id'],"").'">
<input type="hidden" class="tot_fly_count"  name="fly_count" value="'.ipost_($_POST['tours']['fly_count'],"0").'">';	

?>	
		
	   <div class="block-tours js-buy-my-tours" style="margin-top: 60px;">  
	<div class="block-add-tours">	
		
		<div class="block-h1">Покупатель тура</div>	
		
		<div class="buy_turs">
<div class="choice-head-buy js-buy-turs-client">Выберите покупателя тура</div>
		</div>	
	</div>	
	</div>	
		
		
		   <div class="block-tours js-fly-my-tours" style="margin-top: 60px; display: none;">  
	<div class="block-add-tours">	
		
		<div class="block-h1">Дополнительные Туристы</div>	
		
		<div class="buy_turs">
<div class="choice-head-buy js-fly-turs-client">Выберите дополнительных туристов</div>
		</div>		
		
		</div></div>
		
		
		
		<div class="block-tours js-doc-info-tours" style="margin-top: 60px;">  
	<div class="block-add-tours">	
		<div class="block-h1">Данные по договору</div>
		

	<?
            if(($more_city==1)and($_COOKIE["cc_town".$id_user]==0)) {




        ?>
               <!--input start	-->
<?

 $os_say55 = array();
 $os_id_say55 = array();
	$su_say55=-1;

$query_string='<div style="margin-top: 30px;" class="input_doc_turs js-zindex">	';

$query_string.='<div class="left_drop list_2018 menu1_prime"><label class="">Организация<span>*</span></label><div class="select eddd zin_2019"><a class="slct" list_number="t1" data_src=""></a><ul class="drop">';


$result_8 = mysql_time_query($link,'Select a.name,a.id from a_company as a where a.id IN ('.$id_company_sql.')');

$num_8 = $result_8->num_rows;
//$row_1 = mysqli_fetch_assoc($result2);
if($result_8)
{

	/*
				   $query_string.='<li class="sel_active"><a href="javascript:void(0);"  rel="'.$os_id_say55[array_search(1, $os_id_say55)].'">'.$os_say55[array_search(0, $os_id_say55)].'</a></li>';
	*/

  			  while($row_8 = mysqli_fetch_assoc($result_8)){

				 if($su_say55==$row_8["id"])
			   {
				   $query_string.='<li class="sel_active"><a href="javascript:void(0);"  rel="'.$row_8["id"].'">'.$row_8["name"].'</a></li>';
			   } else
			   {
				  $query_string.='<li><a href="javascript:void(0);"  rel="'.$row_8["id"].'">'.$row_8["name"].'</a></li>';
			   }

			 }
}



		   $query_string.='</ul><input type="hidden" class="gloab"  name="id_company" id="pol_clients4554" value=""><div class="div_new_2018"><hr class="one"></div></div></div></div>';
		echo $query_string;


	?>
		<!--input end	-->
        <?







            } else
            {

                $result_uuyyt = mysql_time_query($link, 'select name from a_company where id="' . ht($id_company) . '"');
                $num_results_uuyyt = $result_uuyyt->num_rows;

                if ($num_results_uuyyt != 0) {
                    $row_uuyyt = mysqli_fetch_assoc($result_uuyyt);
                }


                echo'<!--input start	-->	
        <div style="margin-top: 30px;" ><div class="input_2018"><label>Организация</label><input name="id_company_name" value="'.$row_uuyyt["name"].'" readonly id="date_124" class="input_new_2018 required    no_upperr" autocomplete="off" type="text"><input name="id_company" type="hidden" value="'.$id_company.'"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>
<!--input end	-->	';

            }
      ?>

		<!--input start	-->		
		<?
	echo'<div style="margin-top: 30px;" ><div class="input_2018"><label>Менеджер</label><input name="manager" value="'.$name_user.'" id="date_124" class="input_new_2018 required  no_upperr" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>';
		?>
<!--input end	-->			
		<!--input start	-->		
	<div style="margin-top: 30px;" ><div class="input_2018"><label>Количество человек<span>*</span></label><input name="count_clients" value="" id="date_124" class="input_new_2018 required   gloab no_upperr" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>
<!--input end	-->		
				
		
<!--input start	-->	
		<?
		echo'<div class="eico_flex"><div class="eico_50">';
	
		
	echo'<div style="margin-top: 30px;" class="input_doc_turs js-zindex">';
		?>
		<div class="input_2018 input-search-list" list_number="s4">
			<i class="js-open-search"></i><span class="click-search-name"></span>
			<label>Тур<span>*</span></label>
			
			<input name="country" value="" id="date_124" sopen="search_turcity" class="input_new_2018 required  gloab js-keyup-search " autocomplete="off" type="text">
			
			<input type="hidden" value="0" class="js-hidden-search" name="id_country">
			
			<ul class="drop drop-search js-drop-search" style="transform: scaleY(0);">
			<?
		$result_work_zz=mysql_time_query($link,'Select a.* from trips_country as a WHERE a.visible=1 ORDER BY a.eye DESC,a.id limit 0,30');				 
        $num_results_work_zz = $result_work_zz->num_rows;
	    if($num_results_work_zz!=0)
	    {

		   for ($i=0; $i<$num_results_work_zz; $i++)
		   {			   			  			   
			   $row_work_zz = mysqli_fetch_assoc($result_work_zz);
			   echo '<li><a href="javascript:void(0);" rel="'.$row_work_zz["id"].'">'.$row_work_zz["name"].'</a></li>';
		   }			
		}
			?>
			</ul>
			
			<div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>
<!--input end	-->		
			<?
		echo'</div><div class="eico_50">';
			?>
		
		<!--input start	-->		
	<div style="margin-top: 30px;" ><div class="input_2018"><label>Район</label><input name="place_name" value="" id="date_124" class="input_new_2018 required" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>
<!--input end	-->				
			</div></div>
	
		
<!--input start	-->		
	<div style="margin-top: 30px;" ><div class="input_2018"><label>Дата начала тура<span>*</span></label><input name="date_start" value="" id="date_124" class="input_new_2018 required gloab  date_picker_xe js-date-nait1" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>
<!--input end	-->			
		
			<!--input start	-->		
	<div style="margin-top: 30px;" ><div class="input_2018"><label>Дата окончания тура<span>*</span></label><input name="date_end" value="" id="date_124" class="input_new_2018 required gloab  date_picker_xe js-date-nait2" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>
<!--input end	-->				
		
			<!--input start	-->		
	<div style="margin-top: 30px;" ><div class="input_2018"><label>Количество ночей<span>*</span></label><input name="count_day" value="" id="date_124" class="input_new_2018 required   gloab no_upperr js-date-nait-itog" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>
<!--input end	-->			
			<!--input start	-->		
	<div style="margin-top: 30px;" ><div class="input_2018"><label>Отель<span>*</span></label><input name="hotel" value="" id="date_124" class="input_new_2018 required   gloab" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>
<!--input end	-->			
		
			<!--input start	-->		
	<div style="margin-top: 30px;" ><div class="input_2018"><label>Дата заезда в отель</label><input name="start_zae" value="" id="date_124" class="input_new_2018 required  date_picker_xe" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>
<!--input end	-->			
		
			<!--input start	-->		
	<div style="margin-top: 30px;" ><div class="input_2018"><label>Дата выезда из отеля</label><input name="end_zae" value="" id="date_124" class="input_new_2018 required  date_picker_xe" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>
<!--input end	-->		
		
		
		
		<!--input list edit start-->	
		<div class="eico_flex js-edit-input-list no-active-edit-20"><div class="eico_50 js-zindex">
			<!--input start	-->	
		<?
		
 $os = array();
	   $os_id = array();	
				
		$result_6 = mysql_time_query($link,"select A.id,A.name from trips_room_category as A where A.visible=1 order by A.displayOrder");
//$row_1 = mysqli_fetch_assoc($result2);
if($result_6)
{ 
   while($row_6 = mysqli_fetch_assoc($result_6)){ 
	   array_push($os,$row_6["name"]); 
	   array_push($os_id,$row_6["id"]); 
   }
}
	
				$su_1=1;
	
	$class_s='';
	if($su_1!=-1)
	{
		$class_s='active_in_2018';
	}
		
		
echo'<div style="margin-top: 30px;" >	';
	
echo'<div class="left_drop menu1_prime"><label class="active_label">Категория номера<span>*</span></label><div class="select eddd zin_2019"><a class="slct" list_number="t5" data_src="'.$os_id[array_search($su_1, $os_id)].'">'.$os[array_search($su_1, $os_id)].'</a><ul class="drop">';


	 
	 for ($i=0; $i<count($os); $i++)
             {   
			   if($su_1==$os_id[$i])
			   {
				   echo'<li class="sel_active"><a href="javascript:void(0);"  rel="'.$os_id[$i].'">'.$os[$i].'</a></li>';
			   } else
			   {
				  echo'<li><a href="javascript:void(0);"  rel="'.$os_id[$i].'">'.$os[$i].'</a></li>'; 
			   }
			 
			 }
	 
	 

		   echo'</ul><input type="hidden" class="gloab js-list-vibor"  name="id_room_category" id="pol_clients" value="'.$su_1.'"><div class="div_new_2018_"><hr class="one"></div></div></div></div>';	
		
		echo'<i class="edit-input-list-butt js-edit-eico" data-tooltip="Изменить"></i>';
		
		?>
		<!--input end	-->		
		</div><div class="eico_50">
		
			
			
			
			<!--input start	-->		
			<?
	echo'<div style="margin-top: 30px;" class="edit-pole-eico" ><div class="input_2018"><label></label><input name="room_category" value="'.$os[array_search($su_1, $os_id)].'" id="date_124" class="input_new_2018 required" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div></div>';
			?>
<!--input end	-->			
			
			
			
		</div></div>
		<!--input list edit end-->	
		
		
		<!--input list edit start-->	 
		<div class="eico_flex js-edit-input-list no-active-edit-20"><div class="eico_50 js-zindex">
			<!--input start	-->	
		<?
		
 $os = array();
	   $os_id = array();	
				
		$result_6 = mysql_time_query($link,"select A.id,A.name from trips_room_type as A where A.visible=1 order by A.displayOrder");
//$row_1 = mysqli_fetch_assoc($result2);
if($result_6)
{ 
   while($row_6 = mysqli_fetch_assoc($result_6)){ 
	   array_push($os,$row_6["name"]); 
	   array_push($os_id,$row_6["id"]); 
   }
}
	
				$su_1=1;
	
	$class_s='';
	if($su_1!=-1)
	{
		$class_s='active_in_2018';
	}
		
		
echo'<div style="margin-top: 30px;" >	';
	
echo'<div class="left_drop menu1_prime"><label class="active_label">Тип номера<span>*</span></label><div class="select eddd zin_2019"><a class="slct" list_number="t6" data_src="'.$os_id[array_search($su_1, $os_id)].'">'.$os[array_search($su_1, $os_id)].'</a><ul class="drop">';


	 
	 for ($i=0; $i<count($os); $i++)
             {   
			   if($su_1==$os_id[$i])
			   {
				   echo'<li class="sel_active"><a href="javascript:void(0);"  rel="'.$os_id[$i].'">'.$os[$i].'</a></li>';
			   } else
			   {
				  echo'<li><a href="javascript:void(0);"  rel="'.$os_id[$i].'">'.$os[$i].'</a></li>'; 
			   }
			 
			 }
	 
	 

		   echo'</ul><input type="hidden" class="gloab js-list-vibor"  name="id_room_type" id="pol_clients" value="'.$su_1.'"><div class="div_new_2018_"><hr class="one"></div></div></div></div>';	
		
		
				echo'<i class="edit-input-list-butt js-edit-eico" data-tooltip="Изменить"></i>';
		?>
		<!--input end	-->		
		</div><div class="eico_50">
		
			
			
			
			<!--input start	-->		
			<?
	echo'<div style="margin-top: 30px;" class="edit-pole-eico" ><div class="input_2018"><label></label><input name="room_type" value="'.$os[array_search($su_1, $os_id)].'" id="date_124" class="input_new_2018 required " autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div></div>';
			?>
<!--input end	-->			
			
			
			
		</div></div>
		<!--input list edit end-->			

		<!--input list edit start-->	
		<div class="eico_flex js-edit-input-list no-active-edit-20"><div class="eico_50 js-zindex">
			<!--input start	-->	
		<?
		
 $os = array();
	   $os_id = array();	
				
		$result_6 = mysql_time_query($link,"select A.id,A.name from trips_food_type as A where A.visible=1 order by A.displayOrder");
//$row_1 = mysqli_fetch_assoc($result2);
if($result_6)
{ 
   while($row_6 = mysqli_fetch_assoc($result_6)){ 
	   array_push($os,$row_6["name"]); 
	   array_push($os_id,$row_6["id"]); 
   }
}
	
				$su_1=1;
	
	$class_s='';
	if($su_1!=-1)
	{
		$class_s='active_in_2018';
	}
		
		
echo'<div style="margin-top: 30px;">	';
	
echo'<div class="left_drop menu1_prime"><label class="active_label"> 
Тип питания<span>*</span></label><div class="select eddd zin_2019"><a class="slct" list_number="t7" data_src="'.$os_id[array_search($su_1, $os_id)].'">'.$os[array_search($su_1, $os_id)].'</a><ul class="drop">';


	 
	 for ($i=0; $i<count($os); $i++)
             {   
			   if($su_1==$os_id[$i])
			   {
				   echo'<li class="sel_active"><a href="javascript:void(0);"  rel="'.$os_id[$i].'">'.$os[$i].'</a></li>';
			   } else
			   {
				  echo'<li><a href="javascript:void(0);"  rel="'.$os_id[$i].'">'.$os[$i].'</a></li>'; 
			   }
			 
			 }
	 
	 

		   echo'</ul><input type="hidden" class="gloab js-list-vibor"  name="id_food_type" id="pol_clients" value="'.$su_1.'"><div class="div_new_2018_"><hr class="one"></div></div></div></div>';	
		
				echo'<i class="edit-input-list-butt js-edit-eico" data-tooltip="Изменить"></i>';
		
		?>
		<!--input end	-->		
		</div><div class="eico_50">
		
			
			
			
			<!--input start	-->		
			<?
	echo'<div style="margin-top: 30px;" class="edit-pole-eico" ><div class="input_2018"><label></label><input name="food_type" value="'.$os[array_search($su_1, $os_id)].'" id="date_124" class="input_new_2018 required   " autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div></div>';
			?>
<!--input end	-->			
			
			
			
		</div></div>
		<!--input list edit end-->			

		
		<div class="block-add-tours-plus">	
		<div class="block-h1-plus tuda-p">↓ туда</div>
			<!--input start	-->		
	<div style="margin-top: 30px;" ><div class="input_2018"><label>Маршрут перелета туда<span>*</span></label><input name="flight_there_route" value="" id="date_124" class="input_new_2018 required   gloab no_upperr" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>
<!--input end	-->	
		
<!--input start	-->		
	<div style="margin-top: 30px;" ><div class="input_2018"><label>Класс перелета туда<span>*</span></label><input name="flight_there_class" value="эконом" id="date_124" class="input_new_2018 required   gloab no_upperr" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>
<!--input end	-->	
					<!--input start	-->		
	<div style="margin-top: 30px;" ><div class="input_2018"><label>Номер рейса туда<span>*</span></label><input name="flight_there_number" value="" id="date_124" class="input_new_2018 required   gloab no_upperr" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>
<!--input end	-->	
					<!--input start	-->		
	<div style="margin-top: 30px;" ><div class="input_2018"><label>Дата и время вылета</label><input name="start_fly" value="" id="date_124" class="input_new_2018 required  date_time_picker " autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>
<!--input end	-->			
		
		<!--input list edit start-->	
		<div class="eico_flex js-edit-input-list no-active-edit-20"><div class="eico_50 js-zindex">
			<!--input start	-->	
		<?
		
 $os = array();
	   $os_id = array();	
				
		$result_6 = mysql_time_query($link,"select A.id,A.name from trips_transfer_type as A order by A.id");
//$row_1 = mysqli_fetch_assoc($result2);
if($result_6)
{ 
   while($row_6 = mysqli_fetch_assoc($result_6)){ 
	   array_push($os,$row_6["name"]); 
	   array_push($os_id,$row_6["id"]); 
   }
}
	
				$su_1=1;
	
	$class_s='';
	if($su_1!=-1)
	{
		$class_s='active_in_2018';
	}
		
		
echo'<div style="margin-top: 30px;" >	';
	
echo'<div class="left_drop menu1_prime"><label class="active_label"> 
Тип транспорта туда<span>*</span></label><div class="select eddd zin_2019"><a class="slct" list_number="t8" data_src="'.$os_id[array_search($su_1, $os_id)].'">'.$os[array_search($su_1, $os_id)].'</a><ul class="drop">';


	 
	 for ($i=0; $i<count($os); $i++)
             {   
			   if($su_1==$os_id[$i])
			   {
				   echo'<li class="sel_active"><a href="javascript:void(0);"  rel="'.$os_id[$i].'">'.$os[$i].'</a></li>';
			   } else
			   {
				  echo'<li><a href="javascript:void(0);"  rel="'.$os_id[$i].'">'.$os[$i].'</a></li>'; 
			   }
			 
			 }
	 
	 

		   echo'</ul><input type="hidden" class="gloab js-list-vibor"  name="flight_there_id_transfer_type" id="pol_clients" value="'.$su_1.'"><div class="div_new_2018_"><hr class="one"></div></div></div></div>';	
		
				echo'<i class="edit-input-list-butt js-edit-eico" data-tooltip="Изменить"></i>';
		
		?>
		<!--input end	-->		
		</div><div class="eico_50">
		
			
			
			
			<!--input start	-->		
			<?
	echo'<div style="margin-top: 30px;" class="edit-pole-eico" ><div class="input_2018"><label></label><input name="flight_there_transfer_type" value="'.$os[array_search($su_1, $os_id)].'" id="date_124" class="input_new_2018 required" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div></div>';
			?>
<!--input end	-->			
			
			
			
		</div></div>
		<!--input list edit end-->			

		
<!--input list edit start-->	
		<div class="eico_flex js-edit-input-list no-active-edit-20"><div class="eico_50 js-zindex"   >
			<!--input start	-->	
		<?
		
 $os = array();
	   $os_id = array();	
				
		$result_6 = mysql_time_query($link,"select A.id,A.name from trips_flight_type as A order by A.id");
//$row_1 = mysqli_fetch_assoc($result2);
if($result_6)
{ 
   while($row_6 = mysqli_fetch_assoc($result_6)){ 
	   array_push($os,$row_6["name"]); 
	   array_push($os_id,$row_6["id"]); 
   }
}
	
				$su_1=1;
	
	$class_s='';
	if($su_1!=-1)
	{
		$class_s='active_in_2018';
	}
		
		
echo'<div style="margin-top: 30px;">	';
	
echo'<div class="left_drop menu1_prime"><label class="active_label"> 
Тип рейса туда</label><div class="select eddd zin_2019"><a class="slct" list_number="t9" data_src="'.$os_id[array_search($su_1, $os_id)].'">'.$os[array_search($su_1, $os_id)].'</a><ul class="drop">';


	 
	 for ($i=0; $i<count($os); $i++)
             {   
			   if($su_1==$os_id[$i])
			   {
				   echo'<li class="sel_active"><a href="javascript:void(0);"  rel="'.$os_id[$i].'">'.$os[$i].'</a></li>';
			   } else
			   {
				  echo'<li><a href="javascript:void(0);"  rel="'.$os_id[$i].'">'.$os[$i].'</a></li>'; 
			   }
			 
			 }
	 
	 

		   echo'</ul><input type="hidden" class="js-list-vibor"  name="flight_there_id_flight_type" id="pol_clients" value="'.$su_1.'"><div class="div_new_2018_"><hr class="one"></div></div></div></div>';	
		
				echo'<i class="edit-input-list-butt js-edit-eico" data-tooltip="Изменить"></i>';
		
		?>
		<!--input end	-->		
		</div><div class="eico_50">
		
			
			<!--input start	-->		
			<?
	echo'<div style="margin-top: 30px;" class="edit-pole-eico" ><div class="input_2018"><label></label><input name="flight_there_flight_type" value="'.$os[array_search($su_1, $os_id)].'" id="date_124" class="input_new_2018 required   " autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div></div>';
			?>
<!--input end	-->			
			
			
			
		</div></div>
		<!--input list edit end-->					
		</div>
		
			<div class="block-add-tours-plus">	
		<div class="block-h1-plus obr-p">↓ обратно</div>
		
		
			<!--input start	-->		
	<div style="margin-top: 30px;" ><div class="input_2018"><label>Маршрут перелета обратно<span>*</span></label><input name="flight_back_route" value="" id="date_124" class="input_new_2018 required   gloab no_upperr" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>
<!--input end	-->	
		
<!--input start	-->		
	<div style="margin-top: 30px;" ><div class="input_2018"><label>Класс перелета обратно<span>*</span></label><input name="flight_back_class" value="эконом" id="date_124" class="input_new_2018 required   gloab no_upperr" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>
<!--input end	-->	
					<!--input start	-->		
	<div style="margin-top: 30px;" ><div class="input_2018"><label>Номер рейса обратно<span>*</span></label><input name="flight_back_number" value="" id="date_124" class="input_new_2018 required   gloab no_upperr" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>
<!--input end	-->	

					<!--input start	-->		
	<div style="margin-top: 30px;" ><div class="input_2018"><label>Дата и время вылета</label><input name="end_fly" value="" id="date_124" class="input_new_2018 required  date_time_picker " autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>
<!--input end	-->					
		
		<!--input list edit start-->	
		<div class="eico_flex js-edit-input-list no-active-edit-20"><div class="eico_50 js-zindex">
			<!--input start	-->	
		<?
		
 $os = array();
	   $os_id = array();	
				
		$result_6 = mysql_time_query($link,"select A.id,A.name from trips_transfer_type as A order by A.id");
//$row_1 = mysqli_fetch_assoc($result2);
if($result_6)
{ 
   while($row_6 = mysqli_fetch_assoc($result_6)){ 
	   array_push($os,$row_6["name"]); 
	   array_push($os_id,$row_6["id"]); 
   }
}
	
				$su_1=1;
	
	$class_s='';
	if($su_1!=-1)
	{
		$class_s='active_in_2018';
	}
		
		
echo'<div style="margin-top: 30px;" >	';
	
echo'<div class="left_drop menu1_prime"><label class="active_label"> 
Тип транспорта обратно</label><div class="select eddd zin_2019"><a class="slct" list_number="t10" data_src="'.$os_id[array_search($su_1, $os_id)].'">'.$os[array_search($su_1, $os_id)].'</a><ul class="drop">';


	 
	 for ($i=0; $i<count($os); $i++)
             {   
			   if($su_1==$os_id[$i])
			   {
				   echo'<li class="sel_active"><a href="javascript:void(0);"  rel="'.$os_id[$i].'">'.$os[$i].'</a></li>';
			   } else
			   {
				  echo'<li><a href="javascript:void(0);"  rel="'.$os_id[$i].'">'.$os[$i].'</a></li>'; 
			   }
			 
			 }
	 
	 

		   echo'</ul><input type="hidden" class=" js-list-vibor"  name="flight_class_id_transfer_type" id="pol_clients" value="'.$su_1.'"><div class="div_new_2018_"><hr class="one"></div></div></div></div>';	
		
				echo'<i class="edit-input-list-butt js-edit-eico" data-tooltip="Изменить"></i>';
		
		?>
		<!--input end	-->		
		</div><div class="eico_50">
		
			
			
			
			<!--input start	-->		
			<?
	echo'<div style="margin-top: 30px;" class="edit-pole-eico" ><div class="input_2018"><label></label><input name="flight_class_transfer_type" value="'.$os[array_search($su_1, $os_id)].'" id="date_124" class="input_new_2018 required   " autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div></div>';
			?>
<!--input end	-->			
			
			
			
		</div></div>
		<!--input list edit end-->			

		
<!--input list edit start-->	
		<div class="eico_flex js-edit-input-list no-active-edit-20"><div class="eico_50 js-zindex"   >
			<!--input start	-->	
		<?
		
 $os = array();
	   $os_id = array();	
				
		$result_6 = mysql_time_query($link,"select A.id,A.name from trips_flight_type as A order by A.id");
//$row_1 = mysqli_fetch_assoc($result2);
if($result_6)
{ 
   while($row_6 = mysqli_fetch_assoc($result_6)){ 
	   array_push($os,$row_6["name"]); 
	   array_push($os_id,$row_6["id"]); 
   }
}
	
				$su_1=1;
	
	$class_s='';
	if($su_1!=-1)
	{
		$class_s='active_in_2018';
	}
		
		
echo'<div style="margin-top: 30px;">	';
	
echo'<div class="left_drop menu1_prime"><label class="active_label"> 
Тип рейса обратно</label><div class="select eddd zin_2019"><a class="slct" list_number="t11" data_src="'.$os_id[array_search($su_1, $os_id)].'">'.$os[array_search($su_1, $os_id)].'</a><ul class="drop">';


	 
	 for ($i=0; $i<count($os); $i++)
             {   
			   if($su_1==$os_id[$i])
			   {
				   echo'<li class="sel_active"><a href="javascript:void(0);"  rel="'.$os_id[$i].'">'.$os[$i].'</a></li>';
			   } else
			   {
				  echo'<li><a href="javascript:void(0);"  rel="'.$os_id[$i].'">'.$os[$i].'</a></li>'; 
			   }
			 
			 }
	 
	 

		   echo'</ul><input type="hidden" class=" js-list-vibor"  name="flight_class_id_flight_type" id="pol_clients" value="'.$su_1.'"><div class="div_new_2018_"><hr class="one"></div></div></div></div>';	
		
				echo'<i class="edit-input-list-butt js-edit-eico" data-tooltip="Изменить"></i>';
		
		?>
		<!--input end	-->		
		</div><div class="eico_50">
		
			
			<!--input start	-->		
			<?
	echo'<div style="margin-top: 30px;" class="edit-pole-eico" ><div class="input_2018"><label></label><input name="flight_class_flight_type" value="'.$os[array_search($su_1, $os_id)].'" id="date_124" class="input_new_2018 required " autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div></div>';
			?>
<!--input end	-->			
							
				
				
				
				</div>
		
		
</div></div>
		
		<div class="block-add-tours-plus">	
		<div class="block-h1-plus">↓ трансфер</div>
			
						<!--input start	-->		
	<div style="margin-top: 30px;" ><div class="input_2018"><label>Маршрут трансфера<span>*</span></label><input name="transfer_route" value="AIRPORT-HOTEL-AIRPORT" id="date_124" class="input_new_2018 required   gloab" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>
<!--input end	-->	
			
								<!--input start	-->		
	<div style="margin-top: 30px;" ><div class="input_2018"><label>Тип трансфера<span>*</span></label><input name="transfer_type" value="групповой" id="date_124" class="input_new_2018 required   gloab " autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>
<!--input end	-->	
						<!--input start	-->		
	<div style="margin-top: 30px;" ><div class="input_2018"><label>Вид трансфера</label><input name="transfer_view" value="автобус" id="date_124" class="input_new_2018 required " autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>
<!--input end	-->			
			
			
			</div>
		
		<div class="nool-eico"></div>
		
		
				<div class="js-group contact-group">
							<!--input start	-->		
	<div style="margin-top: 30px;" ><div class="input_2018">
		<div data-tooltip="Добавить еще поле" class="add-group js-add-group"><div></div></div>
		<label>Экскурсионная программа</label><input name="excursion[name][]" value="нет" id="date_124" class="input_new_2018 required no_upperr" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>
<!--input end	-->		
			</div>
				<div class="js-group contact-group">
							<!--input start	-->		
	<div style="margin-top: 30px;" ><div class="input_2018">
		<div data-tooltip="Добавить еще поле" class="add-group js-add-group"><div></div></div>
		<label>Дополнительные услуги</label><input name="service[name][]" value="нет" id="date_124" class="input_new_2018 required no_upperr" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>
<!--input end	-->		
			</div>
				<div class="js-group contact-group">
							<!--input start	-->		
	<div style="margin-top: 30px;" ><div class="input_2018">
		<div data-tooltip="Добавить еще поле" class="add-group js-add-group"><div></div></div>
		<label>Добровольное страхование<span>*</span></label><input name="insurance[name][]" value="да" id="date_124" class="input_new_2018 required no_upperr gloab" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>
<!--input end	-->		
			</div>
		
		
		
		
	<div class="block-add-tours-plus">	
		<div class="block-h1-plus">↓ стоимость</div>
		
	<!--input start	-->		
<?

		       $os4 = array();
	   $os_id4 = array();	
		$os_id_char4 = array();	
		
	 $result_work_zz=mysql_time_query($link,'Select a.* from booking_exchange as a where a.id_a_company IN ('.ht($id_group_company_list).')');
        $num_results_work_zz = $result_work_zz->num_rows;
	    if($num_results_work_zz!=0)
	    {

		   for ($i=0; $i<$num_results_work_zz; $i++)
		   {			   			  			   
			   $row_work_zz = mysqli_fetch_assoc($result_work_zz);
			   array_push($os4, $row_work_zz["name"]);
			   array_push($os_id4, $row_work_zz["id"]);
			   array_push($os_id_char4, $row_work_zz["char"]);
		   }
		}
	 
	 
	 
		$su_4=1;  //id значения (не порядковый номер в массиве $os_id4)
		/*
		if (( isset($_COOKIE["su_4c".$id_user]))and(is_numeric($_COOKIE["su_4c".$id_user]))and(array_search($_COOKIE["su_4c".$id_user],$os_id4)!==false))
		{
			$su_4=$_COOKIE["su_4c".$id_user];
		}	 
	 */
$query_string='<div style="margin-top: 30px; " class="val_rate input_doc_turs js-zindex">	';
	
$query_string.='<div class="left_drop menu1_prime"><label class="active_label">Валюта<span>*</span></label><div class="select eddd zin_2019"><a class="slct" list_number="t2" data_src="'.$os_id4[array_search($su_4, $os_id4)].'">'.$os4[array_search($su_4, $os_id4)].'</a><ul class="drop">';

		
   for ($i=0; $i<count($os4); $i++)
             {   
			   if($su_4==$os_id4[$i])
			   {
				   $query_string.='<li class="sel_active"><a href="javascript:void(0);" char="'.$os_id_char4[$i].'"  rel="'.$os_id4[$i].'">'.$os4[$i].'</a></li>';
			   } else
			   {
				  $query_string.='<li><a href="javascript:void(0);"  char="'.$os_id_char4[$i].'"  rel="'.$os_id4[$i].'">'.$os4[$i].'</a></li>'; 
			   }
			 
			 }
	 
	 

		   $query_string.='</ul><input type="hidden" class="gloab"  name="id_exchange" id="exchange_rates" value="'.$os_id4[array_search($su_4, $os_id4)].'"><div class="div_new_2018_"><hr class="one"></div></div></div></div>';			
		echo $query_string;
		
	?>	
		<!--input end	-->		
		
		<!--input start	-->		
		
	<div style="margin-top: 30px;" class="rates_visible"><div class="input_2018"><label>Курс валюты (рубли)</label><input name="exchange_rates" value="" id="date_124" class="input_new_2018 required   money_mask xexchange_rates" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><hr class="tree"><div class="oper_name"></div></div></div>
</div>

<!--input end	-->		
		
		<!--input start	-->		
	<div style="margin-top: 30px;" class="jj-l"><div class="input_2018"><label>Стоимость тура (рубли)<span>*</span></label><input name="cost_client" value="" id="date_124" class="input_new_2018 required gloab money_mask xcost_to_1 to_1 js-xx_end_date" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><hr class="tree"><div class="oper_name" joi=""></div></div></div>
</div>
<!--input end	-->	
		
			
			
<!--input start	-->		
		
	<div style="margin-top: 30px;" class="jj-l"><div class="input_2018"><label>Аванс (рубли)<span>*</span></label><input name="avans_client" value="" id="date_124" class="input_new_2018 required  gloab money_mask xcost_to_1 to_2 js-xx_end_date" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><hr class="tree"><div class="oper_name" joi=""></div></div></div>
</div>

<!--input end	-->			
					
<!--input start	-->		
	<div style="margin-top: 30px; display:none;" class="js-date_polnay"><div class="input_2018"><label>Полная оплата до</label><input name="avans_end_date" value="" id="date_124" class="input_new_2018 required  date_picker_xe " autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>
<!--input end	-->				
	
					
		
				
</div>

    <div class="block-add-tours-plus">

        <div class="input-choice-click js-option-fix-com">
            <div class="choice-head">Фиксированная выплата менеджеру</div>
            <div class="choice-radio"><div class="center_vert1"><i class=""></i><input name="kakay_com" id="kakay_com" value="0" type="hidden"></div></div>
        </div>


        <!--input start	-->
        <div style="margin-top: 30px; display: none;" class="jj-fix"><div class="input_2018"><label>Фиксированная выплата<span>*</span></label><input name="fix_tour_pay" value="" id="date_124" class="input_new_2018 required gloab_fix money_mask" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><hr class="tree"><div class="oper_name" joi=""></div></div></div>
        </div>
        <!--input end	-->
    </div>

    <div class="block-add-tours-plus">
        <div class="block-h1-plus">↓ ПРОМОКОД</div>


        <!--input start	-->
        <?
        echo'<div style="margin-top: 30px; " class="input_doc_turs js-zindex">';
        ?>
        <div class="input_2018 input-search-list" list_number="s1">
            <i class="js-open-search"></i><span class="click-search-name"></span>
            <label>Промокод</label>

            <input name="promo" value="" id="date_124" sopen="search_promokod" class="input_new_2018 required  js-keyup-search js-in3" autocomplete="off" type="text">

            <input type="hidden" value="0" class="js-hidden-search" name="id_affiliates">

            <ul class="drop drop-search js-drop-search" style="transform: scaleY(0);">
                <?

                //если у пользователя много организаций то выводить все туроператоры по всем организациям
                //а если это москва но нужны туроператоры общего филиала

                echo '<li><a href="javascript:void(0);" rel="0">Нет</a></li>';

                $result_work_zz=mysql_time_query($link,'Select a.* from affiliates_promo_code as a,affiliates as b WHERE a.id_users=b.id_users and b.
id_a_group="'.$id_group_u.'" and a.visible=1 and a.status=2 and  a.date_end>="'.date("Y-m-d").'" order by a.name');
                $num_results_work_zz = $result_work_zz->num_rows;
                if($num_results_work_zz!=0)
                {
                    for ($i=0; $i<$num_results_work_zz; $i++)
                    {
                        $row_work_zz = mysqli_fetch_assoc($result_work_zz);
                        echo '<li><a href="javascript:void(0);" rel="'.$row_work_zz["id"].'">'.$row_work_zz["name"].'</a></li>';
                    }
                }
                ?>
            </ul>

            <div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
    </div>
    <!--input end	-->


    </div>


		
<div class="margin-input"><div class="js-add-tender-form button-window">Оформить тур</div></div>		

</span>
</div>	
</div>	
	  
	</div>  
</div> 
  </form>


<?
echo'<form id="js-form-edit-edit-a" action="tours/.id-" method="post" enctype="multipart/form-data"><input name="status" value="doc" type="hidden"></form>';

?>

	  </div>  
<?
include_once $url_system.'template/left.php';
?>

</div>
</div><script src="Js/rem.js" type="text/javascript"></script>
<?
$b_co ??='';
$b_cm ??='';
echo'<script type="text/javascript">var b_co=\''.$b_co.'\'</script>';
echo'<script type="text/javascript">var b_cm=\''.$b_cm.'\'</script>';
?>
<div id="nprogress">
<div class="bar" role="bar" >
<div class="peg"></div>
</div>
	
</div>

</body></html>
<script type="text/javascript">
	$(document).ready(function() {

 input_2018();	


});
</script>
