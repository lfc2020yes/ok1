<?
session_start();
$url_system=$_SERVER['DOCUMENT_ROOT'].'/'; include_once $url_system.'module/config.php'; include_once $url_system.'module/function.php'; include_once $url_system.'login/function_users.php'; initiate($link); include_once $url_system.'module/access.php';


$active_menu='affiliates';  // в каком меню



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

//создателю
//админу
//всем кто выше поо левал


if((isset($_POST['save_users']))and($_POST['save_users']==5))
{
	$token=htmlspecialchars($_POST['tk']);
	
	
	//токен доступен в течении 120 минут
    if(token_access_new($token,'add_affiliates',2005,"rema"))
    {
		//echo("!");
	//возможно проверка что этот пользователь это может делать
	 if (($role->permission('Партнеры','A'))or($sign_admin==1))
	 {	
	$stack_error = array();  // общий массив ошибок

	//print_r($stack_error);
	//исполнитель			

         if ((htmlspecialchars(trim($_POST['name_b'])) == '')) {
             array_push($stack_error, "name_b");
         }
         if ((htmlspecialchars(trim($_POST['name_b1'])) == '')) {
             array_push($stack_error, "name_b1");
         }
         if ((htmlspecialchars(trim($_POST['name_b1x'])) == '')) {
             array_push($stack_error, "name_b1x");
         }
if((htmlspecialchars(trim($_POST['login_b']))==''))
{
  array_push($stack_error, "login_b"); 
} else
{
	
	$result_txs12=mysql_time_query($link,'Select a.id from r_user as a where a.login="'.htmlspecialchars(trim($_POST['login_b'])).'"');
      
	    if($result_txs12->num_rows!=0)
	    {   
			array_push($stack_error, "login_b"); 
		}
	
}
		 
		 
		 
if((htmlspecialchars(trim($_POST['password_b']))==''))
{
  array_push($stack_error, "password_b"); 
}
         if(htmlspecialchars(trim($_POST['password_b']))!='')
         {

             if(strlen($_POST['password_b'])<3)
             {
                 array_push($stack_error, "password_b");
             }

         }


         $org=$_POST['org'];
         $sel_org='';
         for ($i = 0; $i < (count($org['type'])); $i++){

             if((is_numeric($org['type'][$i]))and($org['val'][$i]=='1')and($org['type'][$i]!='0'))
             {
                 if($sel_org=='') {
                     $sel_org = $org['type'][$i];
                 } else
                 {
                     $sel_org .=','.$org['type'][$i];
                 }
             }
         }
         if($sel_org=='')
         {
             $sel_org=$id_company;
         }




	    //есть ли ошибки по заполнению
		//print_r($stack_error);
	    if(count($stack_error)==0)
		{
		   //ошибок нет
		   //сохраняем наряд
			 $today[0] = date("y.m.d"); //присвоено 03.12.01
             $today[1] = date("H:i:s"); //присвоит 1 элементу массива 17:16:17

	         $date_=$today[0].' '.$today[1];
			
			$enabled=1;


			$noti_key=new_key($link,10);
            $noti_task=new_key_task($link,10);

            $phone_base=explode(" ",htmlspecialchars(trim($_POST['name_b1'])));
            $phone_base1=explode("-",$phone_base[2]);

            $phone_end=	$phone_base[1][1].$phone_base[1][2].$phone_base[1][3].$phone_base1[0].$phone_base1[1].$phone_base1[2];


			 mysql_time_query($link,'INSERT INTO r_user (id_company,name_user,name_small,login,id_role,enabled,phone,noti_key,task_key) VALUES ("'.$sel_org.'","'.htmlspecialchars(trim($_POST['name_b'])).'","'.htmlspecialchars(trim($_POST['name_b1x'])).'","'.htmlspecialchars(trim($_POST['login_b'])).'","7","'.$enabled.'","'.htmlspecialchars($phone_end).'","'.$noti_key.'","'.$noti_task.'")');
			 
			 $ID_N=mysqli_insert_id($link);

            mysql_time_query($link,'INSERT INTO affiliates (id_users,
id_a_group,sfera,telegram,date_create) VALUES ("'.$ID_N.'","'.$id_group_u.'","'.htmlspecialchars(trim($_POST['sfera_b1'])).'","'.htmlspecialchars(trim($_POST['telega_b1'])).'","'.$date_.'")');

			 $password=password_crypt_x($ID_N,htmlspecialchars(trim($_POST['password_b'])),htmlspecialchars(trim($_POST['login_b'])));
			 mysql_time_query($link,'update r_user set password="'.$password.'" where id = "'.$ID_N.'"');


            //уведомление начальству что такой пользователь был изменен



            $text_not='<a href="users/'.$id_user.'/">'.$name_user.'</a> добавил(а) нового партнера <a href="affiliates/'.ht($ID_N).'/">'.htmlspecialchars($_POST['name_b']).'</a>.';

            $user_send_new= array();
            $user_send_new=array_merge(UserNotNumber(17,$link));

            rm_from_array(0,$user_send_new);
            rm_from_array($id_user,$user_send_new);
            $user_send_new= array_unique($user_send_new);


            $mass_ei = all_chief($id_user, $link);
            rm_from_array($id_user, $mass_ei);
            $mass_ei = array_unique($mass_ei);

            $end_mass=exception_role($user_send_new,$mass_ei);



            notification_send_admin( $text_not,$end_mass,0,$link);



            //отправляем данные партнеру по смс с его личным входом в партнерку
            //sms партнеру
//отправляем sms уведомления
            include_once $url_system.'module/config_sms.php';
            $sms_phone=SearchSmsUser($link,$ID_N);
            if($sms_phone) {
//	79021296867
//отправляем смс мне на телефон что пришла свободная заявка
//$sms='Вам поступила новая задача №'.$ID_N.' на исполнение. Подробности: www.ok.i-s.group/task/'.$ID_N.'/';

//
                $sms = 'Добро пожаловать в партнерскую программу UMATRAVEL. Ваши данные для входа \n Логин:'.trim($_POST['login_b']).' \n Пароль:'.trim($_POST['password_b']).' \n https://ok.umatravel.club/';



                $ksms = send_sms("api.smsfeedback.ru", 80, $smsfeedbackname, $smsfeedbackpasswd, $sms_phone, $sms, $smspodpis);
                $ksms1 = explode(';', $ksms);
                $key_sms = $ksms1[0];

//заносим в базу что такая смс отправлена или нет
                $send = 0;
                if ($ksms1[0] == 'accepted') {
                    $send = 1;
                }

                mysql_time_query($link, 'INSERT INTO sms (id_user,text,datetimes,phone,send,response) VALUES ("' . $ID_N . '","' . htmlspecialchars(trim($sms)) . '","' . date("y.m.d") . ' ' . date("H:i:s") . '","' . $sms_phone . '","' . $send . '","' . htmlspecialchars(trim($ksms)) . '")');

            }

            header("Location:".$base_usr."/affiliates/?a=add");
			 die();
		   
		}
	

}

}
	
	
}


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

if((!$role->permission('Партнеры','A'))and($sign_admin!=1))
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

if($error_header!=404){ SEO('affiliates_add','','','',$link); } else { SEO('0','','','',$link); }

include_once $url_system.'module/config_url.php'; include $url_system.'template/head.php';
?>
</head><body>
<?
echo'<div class="alert_wrapper"><div class="div-box"></div></div>';
include_once $url_system.'template/body_top.php';
?>

<div class="container">
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

	
/*	
        $result_town=mysql_time_query($link,'select A.id_town,B.town,A.kvartal from i_kvartal as A,i_town as B where A.id_town=B.id and A.id="'.$row_list["id_kvartal"].'"');
        $num_results_custom_town = $result_town->num_rows;
        if($num_results_custom_town!=0)
        {
			$row_town = mysqli_fetch_assoc($result_town);	
		}	
*/
$status_edit='';
$status_class='';
$status_edit1='';
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

	  include_once $url_system.'template/top_affiliates_add.php';

	  echo'<form id="lalala_add_form" class="my_n" style=" padding:0; margin:0;" method="post" enctype="multipart/form-data"><input name="save_users" value="5" type="hidden">';

$token=token_access_compile(2005,'add_affiliates',$secret);

echo'<input type="hidden" value="'.$token.'" name="tk">';

echo'<div id="fullpage" class="margin_60  form_532_affiliates">';
?>
      <div class="section" id="section0">
          <div class="height_100vh">


              <div class="oka_block_2019">

                  <?
                  echo'<div class="line_mobile_blue">Добавление нового партнера</div>';

                  ?>






                  <div class="div_ook" style="border-bottom: 1px solid rgba(0,0,0,0.05);">

                      <!--<span class="add_bo">Добавление новой заявки</span>	-->
                      <?
                      echo'<div class="ok-block-input-2019"><div class="ok-input-title-2019 '.iclass_("name_b",$stack_error,"error_formi_2019").'"><label>ФИО</label><span class="h_input">ФИО партнера</span><i></i><span class="ok-i-2019"><input '.$status_edit.' name="name_b" id="name_b" placeholder="" class="input_new_2019 '.iclass_("name_b",$stack_error,"error_formi").'" autocomplete="off" type="text" value="'.ipost_($_POST['name_b'],'').'"><div class="div_new_2019"><hr class="one"><hr class="two"></div></span></div></div>';                                                                    ?>

                      <?
                      echo'<div class="ok-block-input-2019"><div class="ok-input-title-2019 '.iclass_("name_b1x",$stack_error,"error_formi_2019").'"><label>Краткое имя в системе</label><span class="h_input">Краткое имя</span><i></i><span class="ok-i-2019"><input '.$status_edit.' name="name_b1x" id="name_b1x" placeholder="" class="input_new_2019 '.iclass_("name_b1x",$stack_error,"error_formi").'" autocomplete="off" type="text" value="'.ipost_($_POST['name_b1x'],'').'"><div class="div_new_2019"><hr class="one"><hr class="two"></div></span></div></div>';                                                                                   ?>


                      <?
                      echo'<div class="ok-block-input-2019"><div class="ok-input-title-2019 '.iclass_("name_b1",$stack_error,"error_formi_2019").'"><label>Телефон для связи</label><span class="h_input">Телефон для связи</span><i></i><span class="ok-i-2019"><input '.$status_edit.' name="name_b1" id="name_b1" placeholder="" class="input_new_2019 phone_us1 '.iclass_("name_b1",$stack_error,"error_formi").'" autocomplete="off" type="tel" value="'.ipost_($_POST['name_b1'],'').'"><div class="div_new_2019"><hr class="one"><hr class="two"></div></span></div></div>';
                      ?>

                      <?
                      echo'<div class="ok-block-input-2019"><div class="ok-input-title-2019 '.iclass_("sfera_b1",$stack_error,"error_formi_2019").'"><label>Сфера деятельности</label><span class="h_input">Сфера деятельности</span><i></i><span class="ok-i-2019"><input '.$status_edit.' name="sfera_b1" id="sfera_b1" placeholder="" class="input_new_2019 '.iclass_("sfera_b1",$stack_error,"error_formi").'" autocomplete="off" type="text" value="'.ipost_($_POST['sfera_b1'],'').'"><div class="div_new_2019"><hr class="one"><hr class="two"></div></span></div></div>';
                      ?>

                      <?
                      echo'<div class="ok-block-input-2019"><div class="ok-input-title-2019 '.iclass_("telega_b1",$stack_error,"error_formi_2019").'"><label>TELEGRAM @</label><span class="h_input">TELEGRAM @</span><i></i><span class="ok-i-2019"><input '.$status_edit.' name="telega_b1" id="telega_b1" placeholder="" class="input_new_2019 '.iclass_("telega_b1",$stack_error,"error_formi").'" autocomplete="off" type="text" value="'.ipost_($_POST['telega_b1'],'').'"><div class="div_new_2019"><hr class="one"><hr class="two"></div></span></div></div>';
                      ?>



                  </div>
                  <div class="div_ook" style="border-bottom: 1px solid rgba(0,0,0,0.05);">

                      <div class="help_div da_book1"><div class="not_boolingh"></div><span class="h5"><span>Логин (он же Email) - уникальный в системе, не менее 3 символов, должен начинаться с буквы. Пароль - не менее 3 символов. Только на английской раскладке</span></span></div>



                      <?

                      echo'<div class="ok-block-input-2019"><div class="ok-input-title-2019 '.iclass_("login_b",$stack_error,"error_formi_2019").'"><label>Email Пользователя</label><span class="h_input">Логин Пользователя</span><i></i><span class="ok-i-2019"><input '.$status_edit.' name="login_b" id="login_b" placeholder="Логин в системе" class="input_new_2019 no_uppercase '.iclass_("login_b",$stack_error,"error_formi").'" autocomplete="off" type="text" value="'.ipost_($_POST['login_b'],'').'"><div class="div_new_2019"><hr class="one"><hr class="two"></div></span></div></div>';                                                                                   ?>

                      <?
                      echo'<div class="ok-block-input-2019"><div class="ok-input-title-2019 '.iclass_("password_b",$stack_error,"error_formi_2019").'"><label>Пароль для входа</label><span class="h_input">Пароль для входа</span><i></i><span class="ok-i-2019"><input name="password_b" id="password_b" placeholder="Пароль" class="input_new_2019 '.iclass_("password_b",$stack_error,"error_formi").'" autocomplete="off" type="password" value=""><div class="div_new_2019"><hr class="one"><hr class="two"></div></span></div></div>';                                                                                   ?>




                  </div>


<?
$style_ruki='';
if($more_city==1)
{
?>

                  <div class="div_ook" style="border-bottom: 1px solid rgba(0,0,0,0.05);">
                      <?
                      echo'<div class="form-panel">
	<div class="na-100" style="padding: 0px; padding-top:10px;">';
                      echo'<span class="h4-f">Организация</span>';
                      echo'</div></div>';

                      echo'<div class="form-panel js-company-xx">';



                          $result_work_zz=mysql_time_query($link,'Select a.name,a.id from a_company as a where a.id IN ('.$id_company_sql.')');
                          $num_results_work_zz = $result_work_zz->num_rows;
                          if($num_results_work_zz!=0)
                          {

                              for ($i=0; $i<$num_results_work_zz; $i++)
                              {
                                  $row_66 = mysqli_fetch_assoc($result_work_zz);

                                  echo '<div class="na-50" style="padding: 0px;">';

                                  echo '<div class="input-choice-click-left js-checkbox-group js-checkbox-company" style="margin-top: 0px; background-color: transparent;">
<div class="choice-head">' . $row_66["name"] . '</div>
<div class="choice-radio"><div class="center_vert1">';


                                  echo '<i></i><input name="org[type][]" value="' . $row_66["id"] . '" type="hidden"><input name="org[val][]" value="0" type="hidden">';



                                  echo '</div></div></div></div>';

                              }
                          }



                      echo'</div>';
                      ?>
                  </div>


                  <?
    $style_ruki='display: none;';

}
                  ?>










              </div>
          </div>





      </div>
  </div>
    </form>
</div>
    <?
    include_once $url_system.'template/left.php';
    ?>

</div>
</div><script src="Js/rem.js" type="text/javascript"></script>
<?
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
        /*
    $('#fullpage').fullpage({
        //options here
        scrollOverflow:true
    });
*/

        //input_2018();
        input_2019();

    });
</script>
