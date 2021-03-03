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


//проверка адреса сайта на существование такой страницы
//проверка адреса сайта на существование такой страницы
//проверка адреса сайта на существование такой страницы
//      /invoices/add/
//    0    1      2
$echo_r=1; //выводить или нет ошибку 0 -нет
$error_header=0;
$url_404=$_SERVER['REQUEST_URI'];
//echo($url_404);
$D_404 = explode('/', $url_404);

if (strripos($url_404, 'index_view.php') !== false) {
    header404(1,$echo_r);
}

//**************************************************
if (( count($_GET) != 1 ) )
{
    header404(2,$echo_r);
}

if((!$role->permission('Туры','U'))and($sign_admin!=1))
{
    header404(3,$echo_r);
}


$result_url=mysql_time_query($link,'select A.* from trips as A where A.visible=1 and A.id="'.ht($_GET['id']).'"');
$num_results_custom_url = $result_url->num_rows;
if($num_results_custom_url==0)
{
    header404(5,$echo_r);
} else
{
    $row_list = mysqli_fetch_assoc($result_url);
}


if($error_header==404)
{
    include $url_system.'module/error404.php';
    die();
}

//проверка адреса сайта на существование такой страницы
//проверка адреса сайта на существование такой страницы
//проверка адреса сайта на существование такой страницы


include_once $url_system.'template/html.php'; include $url_system.'module/seo.php';

if($error_header!=404){ SEO('tours_view','','','',$link); } else { SEO('0','','','',$link); }

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

	  include_once $url_system.'template/top_tours_view.php';

	  echo'<form id="js-form-tender-edit" class="my_n js-form-tender-edit" style=" padding:0; margin:0;" method="post" enctype="multipart/form-data"><input name="save_tours" value="1" type="hidden">';

				echo'<input name="tk1" value="vWeVE8zAZZ" type="hidden">';
echo'<input name="id" value="'.$row_list["id"].'" type="hidden">';

	  	$token=token_access_compile($row_list["id"],'edit_tours',$secret);
						
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
		<div class="block-h1">Данные по туру</div>

		<?
		
		//номер договора в компании umatravel
$number_doc='';
	$result_status2d=mysql_time_query($link,'SELECT b.name,b.date_doc FROM trips_contract AS b WHERE b.id="'.ht($row_list['id_contract']).'"');
					 //echo('SELECT a.* FROM r_status AS a WHERE a.numer_status="'.$row1ss["status"].'" and a.id_system=13');
                if($result_status2d->num_rows!=0)
                {  
                   $row_status2d = mysqli_fetch_assoc($result_status2d);	
	
				//$number_doc=date('d').'/'.date('m').'/'.date('Y').' - '.($row_status2d["cc"]+1).' от '.date('d').' '.month_rus(date('m')).' '.date('Y');

				//$number_doc=date('d').'/'.date('m').'/'.date('Y').' - '.($row_status2d["cc"]+1);
				}
		?>
		
<!--input start	-->		
	<div style="margin-top: 30px;" ><div class="input_2018"><label>Номер договора<span>*</span></label><input name="number_contract" value="<? echo($row_status2d["name"]); ?>" id="date_124" class="input_new_2018 required  gloab  no_upperr js-in1" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
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
$query_string.=calendar_var($row_status2d["date_doc"],'#date_table_tours_add','#date_hidden_tours_add');
echo($query_string);
		
		?>

<!--input end	-->	
		
<!--input start	-->	
		<?
$result_uu_dop=mysql_time_query($link,'select name from booking_operator where id="'.ht($row_list["id_operator"]).'"');
$num_results_uu_dop = $result_uu_dop->num_rows;

if($num_results_uu_dop!=0)
{
    $row_uu_dop = mysqli_fetch_assoc($result_uu_dop);
}


	echo'<div style="margin-top: 30px; " class="input_doc_turs js-zindex">';

		echo'<div class="input_2018 input-search-list" list_number="s1">
            <i class="js-open-search"></i><span style="display:inline-block;" class="click-search-name">'.$row_uu_dop["name"].'</span>
			<label>Туроператор<span>*</span></label>
			
			<input name="operator" value="'.$row_uu_dop["name"].'" id="date_124" sopen="search_turoper" class="input_new_2018 required  gloab js-keyup-search js-in3" autocomplete="off" type="text">';

			echo'<input type="hidden" value="'.$row_list["id_operator"].'" class="js-hidden-search" name="id_operator">';
			?>
			<ul class="drop drop-search js-drop-search" style="transform: scaleY(0);">
			<?
		$result_work_zz=mysql_time_query($link,'Select a.* from booking_operator as a WHERE a.id_a_company="'.ht($id_company).'" and a.visible=1 ORDER BY a.eye DESC,a.id limit 0,15');				 
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

    $preo='';
    $name_preo='';
    $preo_dop='';
    if($row_list["id_booking"]!=0) {
        $preo = $row_list["id_booking"];
        $preo_dop='style="display:inline-block;"';
        $result_uu_dop = mysql_time_query($link, 'select a.id,a.date_create,a.id_type_clients,a.id_k_clients,a.id_country from preorders as a WHERE a.id_company="' . ht($id_company) . '" and a.visible=1 and a.id="' . ht($row_list["id_booking"]) . '"');
        $num_results_uu_dop = $result_uu_dop->num_rows;

        if ($num_results_uu_dop != 0) {
            $row_uu_dop = mysqli_fetch_assoc($result_uu_dop);
            $country = 'не указана';
            $result_uu1 = mysql_time_query($link, 'select name from trips_country where id="' . ht($row_uu_dop['id_country']) . '" and visible=1');
            $num_results_uu1 = $result_uu1->num_rows;

            if ($num_results_uu1 != 0) {
                $row_uu1 = mysqli_fetch_assoc($result_uu1);
                $country = $row_uu1["name"];
            }

            if ($row_uu_dop["id_type_clients"] == 1) {
                //частное лицо
                $result_uu78 = mysql_time_query($link, 'select fio from k_clients where id="' . ht($row_uu_dop["id_k_clients"]) . '"');
            } else {
                //2 фирма
                $result_uu78 = mysql_time_query($link, 'select name as fio from k_organization where id="' . ht($row_uu_dop["id_k_clients"]) . '"');
            }
            $num_results_uu78 = $result_uu78->num_rows;

            if ($num_results_uu78 != 0) {
                $row_uu78 = mysqli_fetch_assoc($result_uu78);
                $date_mass2 = explode(" ", ht($row_uu_dop['date_create']));
                $date_mass = explode("-", ht($date_mass2[0]));
                $date_start = $date_mass[2] . '.' . $date_mass[1] . '.' . $date_mass[0];
                $name_preo='№'.$row_uu_dop["id"].' / '.$date_start.' / '.$row_uu78["fio"].' / '.$country;

            }
        }
    }


    ?>


    <!--input start	-->
		<?
        echo'<div style="margin-top: 30px; " class="input_doc_turs js-zindex">';

		echo'<div class="input_2018 input-search-list" list_number="s2">
			<i class="js-open-search"></i><span '.$preo_dop.' class="click-search-name">'.$name_preo.'</span>
			<label>Обращение</label>';

			echo'<input name="preorders" value="'.$name_preo.'" id="date_124" sopen="search_preorders" class="input_new_2018 required  js-keyup-search js-in3" autocomplete="off" type="text">';

			echo'<input type="hidden" value="'.$preo.'" class="js-hidden-search" name="id_preorders">';
?>
			<ul class="drop drop-search js-drop-search" style="transform: scaleY(0);">
			<?
            $result_work_zz=mysql_time_query($link,'Select a.id,a.date_create,a.id_type_clients,a.id_k_clients,a.id_country from preorders as a WHERE a.id_company="'.ht($id_company).'" and a.visible=1 and a.id_user="'.ht($id_user).'" and not(a.status IN ("5","6")) ORDER BY a.date_create desc limit 0,15');
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






<?
      echo' <!--input start	-->
       <div style="margin-top: 30px;" ><div class="input_2018"><label>Номер заявки у туроператора<span>*</span></label><input name="turoper_booking" value="'.$row_list["number_to"].'" id="date_124" class="input_new_2018 required   gloab no_upperr" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
       </div>
       <!--input end	-->';
?>

       <!--input start	-->
<?

 $os_say55 = array();
 $os_id_say55 = array();
$su_say55_val='';
$su_say55_name='';
$class_label='';
 if($row_list["id_booking_sourse"]!=0)
 {
     $su_say55 = $row_list["id_booking_sourse"];
     $su_say55_val=$row_list["id_booking_sourse"];

     $result_uu22 = mysql_time_query($link, 'select name from booking_sourse where id="' . ht($row_list['id_booking_sourse']) . '"');
     $num_results_uu22 = $result_uu22->num_rows;

     if ($num_results_uu22 != 0) {
         $row_uu22 = mysqli_fetch_assoc($result_uu22);
         $su_say55_name=$row_uu22["name"];
     }
$class_label='active_label';

 } else {

     $su_say55 = -1;
 }



$query_string='<div style="margin-top: 30px;" class="input_doc_turs js-zindex">	';
	
$query_string.='<div class="left_drop list_2018 menu1_prime"><label class="'.$class_label.'">Рекламный источник<span>*</span></label><div class="select eddd zin_2019"><a class="slct" list_number="t1" data_src="'.$su_say55_val.'">'.$su_say55_name.'</a><ul class="drop">';

	
$result_8 = mysql_time_query($link,'select A.* from  booking_sourse as A where A.id_a_company="'.ht($id_company).'" and A.visible=1 order by A.displayOrder');
		
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
	 
	 

		   $query_string.='</ul><input type="hidden" class="gloab"  name="id_booking_sourse" id="pol_clients" value="'.$su_say55_val.'"><div class="div_new_2018"><hr class="one"></div></div></div></div>';
		echo $query_string;
		
		
	?>	
		<!--input end	-->
    <?
$password_class1='active_pass';
$password_class2='';
$password_val=1;
$password_i1='active_task_cb';
$password_i2='';
if($row_list["passport"]==2)
{
$password_class2='active_pass';
$password_class1='';
$password_val=2;

$password_i1='';
$password_i2='active_task_cb';

}

	
echo'<!--input start	-->		
<div class="password_turs">
<div id="1" class="input-choice-click-pass js-password-butt '.$password_class1.'">
<div class="choice-head">Заграничный Паспорт</div>
<div class="choice-radio"><div class="center_vert1"><i class="'.$password_i1.'"></i></div></div>
</div>	

<div id="2" class="input-choice-click-pass js-password-butt '.$password_class2.'">
<div class="choice-head">Внутренний Паспорт</div>
<div class="choice-radio"><div class="center_vert1"><i class="'.$password_i2.'"></i></div></div>
</div>
<input name="password" value="'.$password_val.'" type="hidden">	
</div>		
<!--input end -->	';
		?>
		</div>
		</div>

<?
$_POST['tours']['buy_id'] ??= '';
$_POST['tours']['buy_type']	 ??= '';


$result_uu = mysql_time_query($link, 'select a.fio,a.id,a.code,a.latin,a.date_birthday,a.inter_seria,a.inter_number,a.inter_kem,a.inter_kogda,a.inter_srok,a.inner_seria,a.inner_number,a.inner_kem,a.inner_kogda,a.pol,B.id_k_clients from k_clients as a,trips_clients_fly as B where B.id_trips="'.ht($row_list["id"]) .'" and B.id_k_clients=a.id');

$query_string_xx1='';
$echo_turist='';
if ($result_uu) {
    $i = 0;
    while ($row_t = mysqli_fetch_assoc($result_uu)) {
        if($i!=0) { $echo_turist .=','; }
        $echo_turist .= $row_t["id_k_clients"];
        $i++;
if($row_t["id"]!=$row_list["id_shopper"])
        {
        //карточка для туриста
        $query_string_xx1.='<div class="info-client-ruler active-turist-turs" type_co="1" id_rules="'.$row_t["id"].'">
	
	<div class="font-ranks js-dell-fly-tours" data-tooltip="Удалить" id_rel="'.$row_t["id"].'"><span class="font-ranks-inner">_</span><div></div></div>';

        $query_string_xx1.='<div class="sourse_1"><span class="span-44"></span></div><div class="flex_sourse">';

        $pol="<span class='pol-card js-glu-pol-".$row_t["id"]."' data-tooltip='мистер'>(MR)</span>";
        if($row_t["pol"]==2)
        {
            $pol="<span class='pol-card js-glu-pol-".$row_t["id"]."' data-tooltip='миссис'>(MRS)</span>";
        }

        $query_string_xx1.='<div class="name_docu"><span class="js-client js-glu-f-'.$row_t["id"].'" iod="'.$row_t["id"].'">'.$row_t["fio"].'</span>'.$pol.'</div>
	<div class="global_docu">
<div class="left_gl"><div class="icc_gl_1 js-glu-latin-'.$row_t["id"].'">'.rooo($row_t["latin"],'','—').'</div></div>';

        $date_bb='—';
        if($row_t["date_birthday"]!='0000-00-00')
        {
            $razn_d=dateDiff_F(date("y-m-d").' '.date("H:i:s"),$row_t["date_birthday"]." 00:00:00");

            $date_start1=explode("-",htmlspecialchars(trim($row_t["date_birthday"])));

            $startxr=$date_start1[2].'.'.$date_start1[1].'.'.$date_start1[0];
            $date_bb=$startxr.' ('.$razn_d.' '.PadejNumber($razn_d,'год,года,лет').')';
        }

        $query_string_xx1.='<div class="right_gl"><div class="icc_gl_2 js-glu-d-'.$row_t["id"].'">'.$date_bb.'</div></div>		
</div>	
	
	<div class="px_bg">	
		
	<div class="px_flex"><div class="px_left"><div class="strong_wh">Заграничный паспорт</div><div class="pass_wh">';

        if(($row_t["inter_seria"].$row_t["inter_number"].$row_t["inter_kem"]=='')and($row_t["inter_kogda"]=='0000-00-00')and($row_t["inter_srok"]=='0000-00-00'))
        {

            $query_string_xx1.='<span class="label-filled-int-'.$row_t["id"].'" style="display:none;"><label><span class="js-glu-ints-'.$row_t["id"].'">—</span> <span class="js-glu-intn-'.$row_t["id"].'">—</span></label>
	<label>Выдан <span class="js-glu-intk-'.$row_t["id"].'">—</span></label>
	<label><span class="js-glu-intko-'.$row_t["id"].'">—</span> / <span class="js-glu-intd-'.$row_t["id"].'">—</span></label></span>';

            $query_string_xx1.='<span class="label-empty-int-'.$row_t["id"].'"><label>—</label></span>';
        } else
        {

            $query_string_xx1.='<span class="label-filled-int-'.$row_t["id"].'"><label><span class="js-glu-ints-'.$row_t["id"].'">'.rooo($row_t["inter_seria"],'','—').'</span> <span class="js-glu-intn-'.$row_t["id"].'">'.rooo($row_t["inter_number"],'','—').'</span></label>
	<label>Выдан <span class="js-glu-intk-'.$row_t["id"].'">'.rooo($row_t["inter_kem"],'','—').'</span></label>
	<label><span class="js-glu-intko-'.$row_t["id"].'">'.rooo(MaskDate_D_M_Y_ss($row_t["inter_kogda"]),'00.00.0000','—').'</span> / <span class="js-glu-intd-'.$row_t["id"].'">'.rooo(MaskDate_D_M_Y_ss($row_t["inter_srok"]),'00.00.0000','—').'</span></label></span>';
            $query_string_xx1.='<span class="label-empty-int-'.$row_t["id"].'" style="display:none;"><label>—</label></span>';
        }

        $query_string_xx1.='</div></div><div class="px_right"><div class="strong_wh">Внутренний паспорт</div><div class="pass_wh">';
        if(($row_t["inner_seria"].$row_t["inner_number"].$row_t["inner_kem"]=='')and($row_t["inner_kogda"]=='0000-00-00'))
        {

            $query_string_xx1.='<span class="label-filled-inn-'.$row_t["id"].'" style="display:none;"><label><span class="js-glu-ines-'.$row_t["id"].'">—</span> <span class="js-glu-inen-'.$row_t["id"].'">—</span></label>
	<label>Выдан <span class="js-glu-inek-'.$row_t["id"].'">—</span></label>
	<label><span class="js-glu-ineko-'.$row_t["id"].'">—</span></label></span>';

            $query_string_xx1.='<span class="label-empty-inn-'.$row_t["id"].'"><label>—</label></span>';
        } else
        {

            $query_string_xx1.='<span class="label-filled-inn-'.$row_t["id"].'"><label><span class="js-glu-ines-'.$row_t["id"].'">'.rooo($row_t["inner_seria"],'','—').'</span> <span class="js-glu-inen-'.$row_t["id"].'">'.rooo($row_t["inner_number"],'','—').'</span></label>
	<label>Выдан <span class="js-glu-inek-'.$row_t["id"].'">'.rooo($row_t["inner_kem"],'','—').'</span></label>
	<label><span class="js-glu-ineko-'.$row_t["id"].'">'.rooo(MaskDate_D_M_Y_ss($row_t["inner_kogda"]),'00.00.0000','—').'</span></label></span>';

            $query_string_xx1.='<span class="label-empty-inn-'.$row_t["id"].'" style="display:none;"><label>—</label></span>';

        }

        $query_string_xx1.='</div></div></div>	
		
	</div>	
		</div>
		
</div>';
}

    }
}



$query_string_xx2='';

if($row_list["shopper"]==1)
{
    //частное
    $result_t=mysql_time_query($link,'Select a.fio,a.id,a.code,a.latin,a.date_birthday,a.inter_seria,a.inter_number,a.inter_kem,a.inter_kogda,a.inter_srok,a.inner_seria,a.inner_number,a.inner_kem,a.inner_kogda,a.pol from k_clients as a where a.visible=1 and a.potential=0 and a.id="'.ht($row_list['id_shopper']).'" and a.id_a_company="'.ht($id_company).'"');

} else
{
    //организация
    $result_t=mysql_time_query($link,'Select a.* from k_organization as a where a.visible=1 and a.id="'.ht($row_list['id_shopper']).'" and a.id_a_company="'.ht($id_company).'"');
}
$num_results_t = $result_t->num_rows;
if($num_results_t!=0)
{
    $row_t = mysqli_fetch_assoc($result_t);
    //карточка для покупателя+туриста если покупатель частное лицо
    if($row_list["shopper"]==1)
    {

        //частное лицо

        //определим летит он или он просто покупатель
        $result_uu = mysql_time_query($link, 'select id from trips_clients_fly where id_trips="' . ht($row_list["id"]) . '" and id_k_clients="'.$row_list["id_shopper"].'"');
        $num_results_uu = $result_uu->num_rows;

        $ccho_val=0;
        $active_turist='active-turist-turs';
        $ccho_class='';
        if ($num_results_uu == 0) {
            $ccho_val=1;
            $ccho_class='active_task_cb';
            $active_turist='';
        }



        $query_string_xx2='<div class="info-client-ruler '.$active_turist.'" type_co="1" id_rules="'.$row_t["id"].'">
	
	<div class="font-ranks js-dell-buy-tours" data-tooltip="Удалить" id_rel="'.$row_t["id"].'"><span class="font-ranks-inner">_</span><div></div></div>';


        $query_string_xx2.='<div class="sourse_1"><span class="span-44">1</span></div><div class="flex_sourse">';

        $pol="<span class='pol-card js-glu-pol-".$row_t["id"]."' data-tooltip='мистер'>(MR)</span>";
        if($row_t["pol"]==2)
        {
            $pol="<span class='pol-card js-glu-pol-".$row_t["id"]."' data-tooltip='миссис'>(MRS)</span>";
        }

        $query_string_xx2.='<div class="name_docu"><span class="js-client js-glu-f-'.$row_t["id"].'" iod="'.$row_t["id"].'">'.$row_t["fio"].'</span>'.$pol.'</div>
	<div class="global_docu">
<div class="left_gl"><div class="icc_gl_1 js-glu-latin-'.$row_t["id"].'">'.rooo($row_t["latin"],'','—').'</div></div>';

        $date_bb='—';
        if($row_t["date_birthday"]!='0000-00-00')
        {
            $razn_d=dateDiff_F(date("y-m-d").' '.date("H:i:s"),$row_t["date_birthday"]." 00:00:00");

            $date_start1=explode("-",htmlspecialchars(trim($row_t["date_birthday"])));

            $startxr=$date_start1[2].'.'.$date_start1[1].'.'.$date_start1[0];
            $date_bb=$startxr.' ('.$razn_d.' '.PadejNumber($razn_d,'год,года,лет').')';
        }

        $query_string_xx2.='<div class="right_gl"><div class="icc_gl_2 js-glu-d-'.$row_t["id"].'">'.$date_bb.'</div></div>		
</div>	
	
	<div class="px_bg">	
		
	<div class="px_flex"><div class="px_left"><div class="strong_wh">Заграничный паспорт</div><div class="pass_wh">';

        if(($row_t["inter_seria"].$row_t["inter_number"].$row_t["inter_kem"]=='')and($row_t["inter_kogda"]=='0000-00-00')and($row_t["inter_srok"]=='0000-00-00'))
        {

            $query_string_xx2.='<span class="label-filled-int-'.$row_t["id"].'" style="display:none;"><label><span class="js-glu-ints-'.$row_t["id"].'">—</span> <span class="js-glu-intn-'.$row_t["id"].'">—</span></label>
	<label>Выдан <span class="js-glu-intk-'.$row_t["id"].'">—</span></label>
	<label><span class="js-glu-intko-'.$row_t["id"].'">—</span> / <span class="js-glu-intd-'.$row_t["id"].'">—</span></label></span>';

            $query_string_xx2.='<span class="label-empty-int-'.$row_t["id"].'"><label>—</label></span>';
        } else
        {

            $query_string_xx2.='<span class="label-filled-int-'.$row_t["id"].'"><label><span class="js-glu-ints-'.$row_t["id"].'">'.rooo($row_t["inter_seria"],'','—').'</span> <span class="js-glu-intn-'.$row_t["id"].'">'.rooo($row_t["inter_number"],'','—').'</span></label>
	<label>Выдан <span class="js-glu-intk-'.$row_t["id"].'">'.rooo($row_t["inter_kem"],'','—').'</span></label>
	<label><span class="js-glu-intko-'.$row_t["id"].'">'.rooo(MaskDate_D_M_Y_ss($row_t["inter_kogda"]),'00.00.0000','—').'</span> / <span class="js-glu-intd-'.$row_t["id"].'">'.rooo(MaskDate_D_M_Y_ss($row_t["inter_srok"]),'00.00.0000','—').'</span></label></span>';
            $query_string_xx2.='<span class="label-empty-int-'.$row_t["id"].'" style="display:none;"><label>—</label></span>';
        }

        $query_string_xx2.='</div></div><div class="px_right"><div class="strong_wh">Внутренний паспорт</div><div class="pass_wh">';
        if(($row_t["inner_seria"].$row_t["inner_number"].$row_t["inner_kem"]=='')and($row_t["inner_kogda"]=='0000-00-00'))
        {

            $query_string_xx2.='<span class="label-filled-inn-'.$row_t["id"].'" style="display:none;"><label><span class="js-glu-ines-'.$row_t["id"].'">—</span> <span class="js-glu-inen-'.$row_t["id"].'">—</span></label>
	<label>Выдан <span class="js-glu-inek-'.$row_t["id"].'">—</span></label>
	<label><span class="js-glu-ineko-'.$row_t["id"].'">—</span></label></span>';

            $query_string_xx2.='<span class="label-empty-inn-'.$row_t["id"].'"><label>—</label></span>';
        } else
        {

            $query_string_xx2.='<span class="label-filled-inn-'.$row_t["id"].'"><label><span class="js-glu-ines-'.$row_t["id"].'">'.rooo($row_t["inner_seria"],'','—').'</span> <span class="js-glu-inen-'.$row_t["id"].'">'.rooo($row_t["inner_number"],'','—').'</span></label>
	<label>Выдан <span class="js-glu-inek-'.$row_t["id"].'">'.rooo($row_t["inner_kem"],'','—').'</span></label>
	<label><span class="js-glu-ineko-'.$row_t["id"].'">'.rooo(MaskDate_D_M_Y_ss($row_t["inner_kogda"]),'00.00.0000','—').'</span></label></span>';

            $query_string_xx2.='<span class="label-empty-inn-'.$row_t["id"].'" style="display:none;"><label>—</label></span>';

        }




        $query_string_xx2.='</div></div></div>	
		
	</div>	
		</div>
	
		
<div class="loli_turs1">	
<div class="loli_turs">
<div class="input-choice-click-pass js-loli-butt ">
<div class="choice-radio"><div class="center_vert1"><i class="'.$ccho_class.'"></i></div></div>
<div class="choice-head">Не летит, только покупает тур</div>

</div>	
<input name="radio_password" value="'.$ccho_val.'" type="hidden">	
</div>
</div>		
</div>';




    }
    if($row_list["shopper"]==2)
    {
        //организация
        $query_string_xx2.='<div class="info-client-ruler " type_co="2" id_rules="'.$row_t["id"].'">
	
	<div class="font-ranks js-dell-buy-tours" data-tooltip="Удалить" id_rel="'.$row_t["id"].'"><span class="font-ranks-inner">_</span><div></div></div>';


        $query_string_xx2.='<div class="flex_sourse mappi_sourse">';

        $query_string_xx2.='<div class="name_docu"><span class="js-org js-glo-n-'.$row_t["id"].'" iod="'.$row_t["id"].'">'.$row_t["name"].'</span><div class="code_clients"></div></div>
	<div class="global_docu">
<div class="left_gl">';

        $phone_format='+7 ('.$row_t["phone_contact"][0].$row_t["phone_contact"][1].$row_t["phone_contact"][2].') '.$row_t["phone_contact"][3].$row_t["phone_contact"][4].$row_t["phone_contact"][5].'-'.$row_t["phone_contact"][6].$row_t["phone_contact"][7].'-'.$row_t["phone_contact"][8].$row_t["phone_contact"][9];

        $query_string_xx2.='<div class="icc_gl_3 js-glo-t-'.$row_t["id"].'" data-tooltip="Телефон контактного лица">'.$phone_format.'</div></div>';



        $query_string_xx2.='<div class="right_gl"><div class="icc_gl_4 js-glo-e-'.$row_t["id"].'">'.rooo($row_score["email"],'','—').'</div></div>		
</div>	
	
	<div class="px_bg">	
		
	<div class="px_flex"><div class="px_left"><div class="strong_wh">Коды</div><div class="pass_wh">';

        if(($row_t["code_inn"].$row_t["code_kpp"].$row_t["code_ogrn"].$row_t["code_okpo"]==''))
        {
            $query_string_xx2.='<span class="label-filled-code-'.$row_t["id"].'" style="display:none;"><label data-tooltip="ИНН"><span class="js-glo-in-'.$row_t["id"].'">—</span></label>
	<label data-tooltip="КПП"><span class="js-glo-kp-'.$row_t["id"].'">—</span></label>
	<label data-tooltip="ОГРН"><span class="js-glo-og-'.$row_t["id"].'">—</span></label>
	<label data-tooltip="ОКПО"><span class="js-glo-ok-'.$row_t["id"].'">—</span></label></span>';
            $query_string_xx2.='<span class="label-empty-code-'.$row_t["id"].'"><label>—</label></span>';
        } else
        {

            $query_string_xx2.='<span class="label-filled-code-'.$row_t["id"].'"><label data-tooltip="ИНН"><span class="js-glo-in-'.$row_t["id"].'">'.rooo($row_t["code_inn"],'','—').'</span></label>
	<label data-tooltip="КПП"><span class="js-glo-kp-'.$row_t["id"].'">'.rooo($row_t["code_kpp"],'','—').'</span></label>
	<label data-tooltip="ОГРН"><span class="js-glo-og-'.$row_t["id"].'">'.rooo($row_t["code_ogrn"],'','—').'</span></label>
	<label data-tooltip="ОКПО"><span class="js-glo-ok-'.$row_t["id"].'">'.rooo($row_t["code_okpo"],'','—').'</span></label></span>';

            $query_string_xx2.='<span class="label-empty-code-'.$row_t["id"].'" style="display:none;"><label>—</label></span>';

        }

        $query_string_xx2.='</div></div><div class="px_right"><div class="strong_wh">Банковские реквизиты</div><div class="pass_wh">';
        if($row_t["bank_rs"].$row_t["bank_bik"].$row_t["bank_name"].$row_t["bank_ks"]=='')
        {
            $query_string_xx2.='<span class="label-filled-rek-'.$row_t["id"].'" style="display:none;"><label data-tooltip="РАСЧЕТНЫЙ СЧЕТ"><span class="js-glo-rs-'.$row_t["id"].'">—</span></label>
	<label data-tooltip="БИК"><span class="js-glo-bi-'.$row_t["id"].'">—</span></label>
	<label data-tooltip="БАНК"><span class="js-glo-ba-'.$row_t["id"].'">—</span></label>
	<label data-tooltip="Кор. счет"><span class="js-glo-ko-'.$row_t["id"].'">—</span></label></span>';

            $query_string_xx2.='<span class="label-empty-rek-'.$row_t["id"].'"><label>—</label></span>';
        } else
        {

            $query_string_xx2.='<span class="label-filled-rek-'.$row_t["id"].'"><label data-tooltip="РАСЧЕТНЫЙ СЧЕТ"><span class="js-glo-rs-'.$row_t["id"].'">'.rooo($row_t["bank_rs"],'','—').'</span></label>
	<label data-tooltip="БИК"><span class="js-glo-bi-'.$row_t["id"].'">'.rooo($row_t["bank_bik"],'','—').'</span></label>
	<label data-tooltip="БАНК"><span class="js-glo-ba-'.$row_t["id"].'">'.rooo($row_t["bank_name"],'','—').'</span></label>
	<label data-tooltip="Кор. счет"><span class="js-glo-ko-'.$row_t["id"].'">'.rooo($row_t["bank_ks"],'','—').'</span></label></span>';

            $query_string_xx2.='<span class="label-empty-rek-'.$row_t["id"].'" style="display:none;"><label>—</label></span>';
        }

        $query_string_xx2.='</div></div></div>	
		
	</div>	
		</div>
			
</div>';

    }

}


	$_POST['tours']['fly_id'] ??= '';
	$_POST['tours']['fly_count'] ??= '';





echo'<input type="hidden" class="tot_buy_id"  name="buy_id" value="'.ipost_($_POST['tours']['buy_id'],$row_list["id_shopper"]).'">		
<input type="hidden" class="tot_buy_type"  name="buy_type" value="'.ipost_($_POST['tours']['buy_type'],$row_list["shopper"]).'">			
<input type="hidden" class="tot_fly_id"  name="fly_id" value="'.ipost_($_POST['tours']['fly_id'],$echo_turist).'">
<input type="hidden" class="tot_fly_count"  name="fly_count" value="'.ipost_($_POST['tours']['fly_count'],$i).'">';

?>	
		
	   <div class="block-tours js-buy-my-tours" style="margin-top: 60px;">  
	<div class="block-add-tours">	
		
		<div class="block-h1">Покупатель тура</div>	
		
		<div class="buy_turs"  style="display: none;">


<div class="choice-head-buy js-buy-turs-client">Выберите покупателя тура</div></div>
<?
echo $query_string_xx2;
?>

	</div>	
	</div>	
		
		
		   <div class="block-tours js-fly-my-tours" style="margin-top: 60px;">
	<div class="block-add-tours">	
		
		<div class="block-h1">Дополнительные Туристы</div>
        <?php
        echo($query_string_xx1);
        ?>

		<div class="buy_turs">
<div class="choice-head-buy js-fly-turs-client">Выберите дополнительных туристов</div>
		</div>		
		
		</div></div>
		
		
		
		<div class="block-tours js-doc-info-tours" style="margin-top: 60px;">  
	<div class="block-add-tours">	
		<div class="block-h1">Данные по договору</div>
<?
		echo'<!--input start	-->		
	<div style="margin-top: 30px;" ><div class="input_2018"><label>Количество человек<span>*</span></label><input name="count_clients" value="'.$row_list["count_people"].'" id="date_124" class="input_new_2018 required   gloab no_upperr" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>
<!--input end	-->';


				

$result_uu_dop=mysql_time_query($link,'select name from trips_country where id="'.ht($row_list["id_country"]).'"');
$num_results_uu_dop = $result_uu_dop->num_rows;

if($num_results_uu_dop!=0)
{
    $row_uu_dop = mysqli_fetch_assoc($result_uu_dop);
}


echo'<!--input start	-->	
		
		<div class="eico_flex"><div class="eico_50">';
	
		
	echo'<div style="margin-top: 30px;" class="input_doc_turs js-zindex">';

		echo'<div class="input_2018 input-search-list" list_number="s4">
			<i class="js-open-search"></i><span style="display:inline-block;" class="click-search-name">'.$row_uu_dop["name"].'</span>
			<label>Тур<span>*</span></label>
			
			<input name="country" value="'.$row_uu_dop["name"].'" id="date_124" sopen="search_turcity" class="input_new_2018 required  gloab js-keyup-search " autocomplete="off" type="text">
			
			<input type="hidden" value="'.$row_list["id_country"].'" class="js-hidden-search" name="id_country">
			
			<ul class="drop drop-search js-drop-search" style="transform: scaleY(0);">';

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

            <?
		echo'<!--input start	-->		
	<div style="margin-top: 30px;" ><div class="input_2018"><label>Район</label><input name="place_name" value="'.$row_list["place_name"].'" id="date_124" class="input_new_2018 required" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>
<!--input end	-->

			</div></div>
	
		
<!--input start	-->		
	<div style="margin-top: 30px;" ><div class="input_2018"><label>Дата начала тура<span>*</span></label><input name="date_start" value="'.date_ex(0,$row_list["date_start"]).'" id="date_124" class="input_new_2018 required gloab  date_picker_xe js-date-nait1" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>
<!--input end	-->			
		
			<!--input start	-->		
	<div style="margin-top: 30px;" ><div class="input_2018"><label>Дата окончания тура<span>*</span></label><input name="date_end" value="'.date_ex(0,$row_list["date_end"]).'" id="date_124" class="input_new_2018 required gloab  date_picker_xe js-date-nait2" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>
<!--input end	-->				
		
			<!--input start	-->		
	<div style="margin-top: 30px;" ><div class="input_2018"><label>Количество ночей<span>*</span></label><input name="count_day" value="'.$row_list["count_day"].'" id="date_124" class="input_new_2018 required   gloab no_upperr js-date-nait-itog" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>
<!--input end	-->			
			<!--input start	-->		
	<div style="margin-top: 30px;" ><div class="input_2018"><label>Отель<span>*</span></label><input name="hotel" value="'.$row_list["hotel"].'" id="date_124" class="input_new_2018 required   gloab" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>
<!--input end	-->	
	
		
			<!--input start	-->		
	<div style="margin-top: 30px;" ><div class="input_2018"><label>Дата заезда в отель</label><input name="start_zae" value="'.date_ex(0,$row_list["date_start_race"]).'" id="date_124" class="input_new_2018 required  date_picker_xe" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>
<!--input end	-->			
		
			<!--input start	-->		
	<div style="margin-top: 30px;" ><div class="input_2018"><label>Дата выезда из отеля</label><input name="end_zae" value="'.date_ex(0,$row_list["date_end_race"]).'" id="date_124" class="input_new_2018 required  date_picker_xe" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>
<!--input end	-->	';

		?>
		
		
		

		<?
        $new_category='no-active-edit-20';

        $result_uu = mysql_time_query($link, 'select id from trips_room_category where id="' . ht($row_list["id_room_category"]) . '" and name="'.ht($row_list["room_category"]).'"');
        $num_results_uu = $result_uu->num_rows;

        if ($num_results_uu == 0) {
            $new_category='';
        }

		echo'<!--input list edit start-->	
		<div class="eico_flex js-edit-input-list '.$new_category.'"><div class="eico_50 js-zindex">
			<!--input start	-->';


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
	
	$su_1=$row_list["id_room_category"];
	
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
	echo'<div style="margin-top: 30px;" class="edit-pole-eico" ><div class="input_2018"><label></label><input name="room_category" value="'.$row_list["room_category"].'" id="date_124" class="input_new_2018 required" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div></div>';
			?>
<!--input end	-->			
			
			
			
		</div></div>
		<!--input list edit end-->	


    <?


    $new_category='no-active-edit-20';

    $result_uu = mysql_time_query($link, 'select id from trips_room_type where id="' . ht($row_list["id_room_type"]) . '" and name="'.ht($row_list["room_type"]).'"');
    $num_results_uu = $result_uu->num_rows;

    if ($num_results_uu == 0) {
        $new_category='';
    }


		echo'<!--input list edit start-->	 
		<div class="eico_flex js-edit-input-list '.$new_category.'"><div class="eico_50 js-zindex">
			<!--input start	-->';

		
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
	
				$su_1=$row_list["id_room_type"];
	
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
	echo'<div style="margin-top: 30px;" class="edit-pole-eico" ><div class="input_2018"><label></label><input name="room_type" value="'.$row_list["room_type"].'" id="date_124" class="input_new_2018 required " autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div></div>';
			?>
<!--input end	-->			
			
			
			
		</div></div>
		<!--input list edit end-->			
<?


$new_category='no-active-edit-20';

$result_uu = mysql_time_query($link, 'select id from trips_food_type where id="' . ht($row_list["id_food_type"]) . '" and name="'.ht($row_list["food_type"]).'"');
$num_results_uu = $result_uu->num_rows;

if ($num_results_uu == 0) {
    $new_category='';
}


		echo'<!--input list edit start-->	
		<div class="eico_flex js-edit-input-list '.$new_category.'"><div class="eico_50 js-zindex">
			<!--input start	-->';

		
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
	
				$su_1=$row_list["id_food_type"];
	
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
	echo'<div style="margin-top: 30px;" class="edit-pole-eico" ><div class="input_2018"><label></label><input name="food_type" value="'.$row_list["food_type"].'" id="date_124" class="input_new_2018 required   " autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div></div>';
			?>
<!--input end	-->			
			
			
			
		</div></div>
		<!--input list edit end-->			

		
		<div class="block-add-tours-plus">	
		<div class="block-h1-plus tuda-p">туда</div>
            <?

			echo'<!--input start	-->		
	<div style="margin-top: 30px;" ><div class="input_2018"><label>Маршрут перелета туда<span>*</span></label><input name="flight_there_route" value="'.$row_list["flight_there_route"].'" id="date_124" class="input_new_2018 required   gloab no_upperr" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>
<!--input end	-->	
		
<!--input start	-->		
	<div style="margin-top: 30px;" ><div class="input_2018"><label>Класс перелета туда<span>*</span></label><input name="flight_there_class" value="'.$row_list["flight_there_class"].'" id="date_124" class="input_new_2018 required   gloab no_upperr" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>
<!--input end	-->	
					<!--input start	-->		
	<div style="margin-top: 30px;" ><div class="input_2018"><label>Номер рейса туда<span>*</span></label><input name="flight_there_number" value="'.$row_list["flight_there_number"].'" id="date_124" class="input_new_2018 required   gloab no_upperr" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>
<!--input end	-->	';



            $new_category='no-active-edit-20';

            $result_uu = mysql_time_query($link, 'select id from trips_transfer_type where id="' . ht($row_list["flight_there_id_transfer_type"]) . '" and name="'.ht($row_list["flight_there_transfer_type"]).'"');



            $num_results_uu = $result_uu->num_rows;

            if ($num_results_uu == 0) {
                $new_category='';
            }


            echo'<!--input list edit start-->	
		<div class="eico_flex js-edit-input-list '.$new_category.'"><div class="eico_50 js-zindex">
			<!--input start	-->';

		
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
	
				$su_1=$row_list["flight_there_id_transfer_type"];
	
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
	echo'<div style="margin-top: 30px;" class="edit-pole-eico" ><div class="input_2018"><label></label><input name="flight_there_transfer_type" value="'.$row_list["flight_there_transfer_type"].'" id="date_124" class="input_new_2018 required" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div></div>';
			?>
<!--input end	-->			
			
			
			
		</div></div>
		<!--input list edit end-->			

<?


$new_category='no-active-edit-20';

$result_uu = mysql_time_query($link, 'select id from trips_flight_type where id="' . ht($row_list["flight_there_id_flight_type"]) . '" and name="'.ht($row_list["flight_there_flight_type"]).'"');
$num_results_uu = $result_uu->num_rows;

if ($num_results_uu == 0) {
    $new_category='';
}
		
echo'<!--input list edit start-->	
		<div class="eico_flex js-edit-input-list '.$new_category.'"><div class="eico_50 js-zindex"   >
			<!--input start	-->';

		
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
	
				$su_1=$row_list["flight_there_id_flight_type"];
	
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
	echo'<div style="margin-top: 30px;" class="edit-pole-eico" ><div class="input_2018"><label></label><input name="flight_there_flight_type" value="'.$row_list["flight_there_flight_type"].'" id="date_124" class="input_new_2018 required   " autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div></div>';
			?>
<!--input end	-->			
			
			
			
		</div></div>
		<!--input list edit end-->					
		</div>
		
			<div class="block-add-tours-plus">	
		<div class="block-h1-plus obr-p">обратно</div>
		
	<?
			echo'<!--input start	-->		
	<div style="margin-top: 30px;" ><div class="input_2018"><label>Маршрут перелета обратно<span>*</span></label><input name="flight_back_route" value="'.$row_list["flight_back_route"].'" id="date_124" class="input_new_2018 required   gloab no_upperr" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>
<!--input end	-->	
		
<!--input start	-->		
	<div style="margin-top: 30px;" ><div class="input_2018"><label>Класс перелета обратно<span>*</span></label><input name="flight_back_class" value="'.$row_list["flight_back_class"].'" id="date_124" class="input_new_2018 required   gloab no_upperr" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>
<!--input end	-->	
					<!--input start	-->		
	<div style="margin-top: 30px;" ><div class="input_2018"><label>Номер рейса обратно<span>*</span></label><input name="flight_back_number" value="'.$row_list["flight_back_number"].'" id="date_124" class="input_new_2018 required   gloab no_upperr" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>
<!--input end	-->	';
			?>

		<?

        $new_category='no-active-edit-20';

        $result_uu = mysql_time_query($link, 'select id from trips_transfer_type where id="' . ht($row_list["flight_class_id_transfer_type"]) . '" and name="'.ht($row_list["flight_class_transfer_type"]).'"');
        $num_results_uu = $result_uu->num_rows;

        if ($num_results_uu == 0) {
            $new_category='';
        }


		echo'<!--input list edit start-->	
		<div class="eico_flex js-edit-input-list '.$new_category.'"><div class="eico_50 js-zindex">
			<!--input start	-->';

		
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
	
				$su_1=$row_list["flight_class_id_transfer_type"];
	
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
	echo'<div style="margin-top: 30px;" class="edit-pole-eico" ><div class="input_2018"><label></label><input name="flight_class_transfer_type" value="'.$row_list["flight_class_transfer_type"].'" id="date_124" class="input_new_2018 required   " autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div></div>';
			?>
<!--input end	-->			
			
			
			
		</div></div>
		<!--input list edit end-->			

<?

$new_category='no-active-edit-20';

$result_uu = mysql_time_query($link, 'select id from trips_flight_type where id="' . ht($row_list["flight_class_id_flight_type"]) . '" and name="'.ht($row_list["flight_class_flight_type"]).'"');
$num_results_uu = $result_uu->num_rows;

if ($num_results_uu == 0) {
    $new_category='';
}

echo'<!--input list edit start-->	
		<div class="eico_flex js-edit-input-list '.$new_category.'"><div class="eico_50 js-zindex"   >
			<!--input start	-->	';

		
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
	
				$su_1=$row_list["flight_class_id_flight_type"];
	
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
	echo'<div style="margin-top: 30px;" class="edit-pole-eico" ><div class="input_2018"><label></label><input name="flight_class_flight_type" value="'.$row_list["flight_class_flight_type"].'" id="date_124" class="input_new_2018 required " autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div></div>';
			?>
<!--input end	-->			
							
				
				
				
				</div>
		
		
</div></div>
		
		<div class="block-add-tours-plus">	
		<div class="block-h1-plus">трансфер</div>

            <?


						echo'<!--input start	-->		
	<div style="margin-top: 30px;" ><div class="input_2018"><label>Маршрут трансфера<span>*</span></label><input name="transfer_route" value="'.$row_list["transfer_route"].'" id="date_124" class="input_new_2018 required   gloab" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>
<!--input end	-->	
			
								<!--input start	-->		
	<div style="margin-top: 30px;" ><div class="input_2018"><label>Тип трансфера<span>*</span></label><input name="transfer_type" value="'.$row_list["transfer_type"].'" id="date_124" class="input_new_2018 required   gloab " autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>
<!--input end	-->	
						<!--input start	-->		
	<div style="margin-top: 30px;" ><div class="input_2018"><label>Вид трансфера</label><input name="transfer_view" value="'.$row_list["transfer_view"].'" id="date_124" class="input_new_2018 required " autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>
<!--input end	-->';

						?>
			
			
			</div>
		
		<div class="nool-eico"></div>
		

<?

$result_uu = mysql_time_query($link, 'select A.name from trips_excursion as A where A.id_trips="'.ht($row_list["id"]) .'"');

$num_results_uu = $result_uu->num_rows;
if($num_results_uu!=0) {
    if ($result_uu) {
        $i = 0;


        while ($row_uu = mysqli_fetch_assoc($result_uu)) {
            $task_cloud_block = '';
            if ($i == 0) {
                echo '<div class="js-group contact-group">
							<!--input start	-->		
	<div style="margin-top: 30px;" ><div class="input_2018">
		<div data-tooltip="Добавить еще поле" class="add-group js-add-group"><div></div></div>
		<label>Экскурсионная программа</label><input name="excursion[name][]" value="' . $row_uu["name"] . '" id="date_124" class="input_new_2018 required no_upperr" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>
<!--input end	-->		
			</div>';
            } else {
                echo '<div class="js-group contact-group line-group">
							<!--input start	-->		
	<div style="margin-top: 30px;" ><div class="input_2018">
		<div data-tooltip="Добавить еще поле" class="add-group js-add-group"><div></div></div><div data-tooltip="Удалить" class="dell-group js-dell-group"><div></div><div></div></div>
		<label>Экскурсионная программа</label><input name="excursion[name][]" value="' . $row_uu["name"] . '" id="date_124" class="input_new_2018 required no_upperr" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>
<!--input end	-->		
			</div>';
            }
            $i++;
        }
    }

} else
{


				echo'<div class="js-group contact-group">
							<!--input start	-->		
	<div style="margin-top: 30px;" ><div class="input_2018">
		<div data-tooltip="Добавить еще поле" class="add-group js-add-group"><div></div></div>
		<label>Экскурсионная программа</label><input name="excursion[name][]" value="нет" id="date_124" class="input_new_2018 required no_upperr" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>
<!--input end	-->		
			</div>';
}


$result_uu = mysql_time_query($link, 'select A.name from trips_service as A where A.id_trips="'.ht($row_list["id"]) .'"');


$num_results_uu = $result_uu->num_rows;
if($num_results_uu!=0) {
    if ($result_uu) {
        $i = 0;


        while ($row_uu = mysqli_fetch_assoc($result_uu)) {
            $task_cloud_block = '';
            if ($i == 0) {
echo'				<div class="js-group contact-group">
							<!--input start	-->		
	<div style="margin-top: 30px;" ><div class="input_2018">
		<div data-tooltip="Добавить еще поле" class="add-group js-add-group"><div></div></div>
		<label>Дополнительные услуги</label><input name="service[name][]" value="'.$row_uu["name"].'" id="date_124" class="input_new_2018 required no_upperr" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>
<!--input end	-->		
			</div>';

            } else
            {
                echo'				<div class="js-group contact-group line-group">
							<!--input start	-->		
	<div style="margin-top: 30px;" ><div class="input_2018">
		<div data-tooltip="Добавить еще поле" class="add-group js-add-group"><div></div></div><div data-tooltip="Удалить" class="dell-group js-dell-group"><div></div><div></div></div>
		<label>Дополнительные услуги</label><input name="service[name][]" value="'.$row_uu["name"].'" id="date_124" class="input_new_2018 required no_upperr" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>
<!--input end	-->		
			</div>';

            }


            $i++;
        }
    }
} else
{
echo'				<div class="js-group contact-group">
							<!--input start	-->		
	<div style="margin-top: 30px;" ><div class="input_2018">
		<div data-tooltip="Добавить еще поле" class="add-group js-add-group"><div></div></div>
		<label>Дополнительные услуги</label><input name="service[name][]" value="нет" id="date_124" class="input_new_2018 required no_upperr" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>
<!--input end	-->		
			</div>';
}


$result_uu = mysql_time_query($link, 'select A.name from trips_insurance as A where A.id_trips="'.ht($row_list["id"]) .'"');


$num_results_uu = $result_uu->num_rows;
if($num_results_uu!=0) {
    if ($result_uu) {
        $i = 0;


        while ($row_uu = mysqli_fetch_assoc($result_uu)) {
            $task_cloud_block = '';
            if ($i == 0) {
                echo '<div class="js-group contact-group">
							<!--input start	-->		
	<div style="margin-top: 30px;" ><div class="input_2018">
		<div data-tooltip="Добавить еще поле" class="add-group js-add-group"><div></div></div>
		<label>Добровольное страхование<span>*</span></label><input name="insurance[name][]" value="'.$row_uu["name"].'" id="date_124" class="input_new_2018 required no_upperr gloab" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>
<!--input end	-->
			</div>';

            } else
            {
                echo '<div class="js-group contact-group line-group">
							<!--input start	-->		
	<div style="margin-top: 30px;" ><div class="input_2018">
		<div data-tooltip="Добавить еще поле" class="add-group js-add-group"><div></div></div><div data-tooltip="Удалить" class="dell-group js-dell-group"><div></div><div></div></div>
		<label>Добровольное страхование<span>*</span></label><input name="insurance[name][]" value="'.$row_uu["name"].'" id="date_124" class="input_new_2018 required no_upperr gloab" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>
<!--input end	-->
			</div>';


            }


            $i++;
        }
    }
} else {


    echo '<div class="js-group contact-group">
							<!--input start	-->		
	<div style="margin-top: 30px;" ><div class="input_2018">
		<div data-tooltip="Добавить еще поле" class="add-group js-add-group"><div></div></div>
		<label>Добровольное страхование<span>*</span></label><input name="insurance[name][]" value="да" id="date_124" class="input_new_2018 required no_upperr gloab" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>
<!--input end	-->
			</div>';

}
	?>
<div class="margin-input"><div class="js-edit-tender-form button-window">Сохранить изменения</div></div>

</span>
</div>	
</div>	
	  
	</div>  
</div> 
  </form>


<?
echo'<form id="js-form-edit-edit" action="tours/.id-'.$_GET["id"].'" method="post" enctype="multipart/form-data"><input name="status" value="1" type="hidden"></form>';

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
        UpdateNumberTuris();

});
</script>
