<?
session_start();
$url_system=$_SERVER['DOCUMENT_ROOT'].'/'; include_once $url_system.'module/config.php'; include_once $url_system.'module/function.php'; include_once $url_system.'login/function_users.php'; initiate($link); include_once $url_system.'module/access.php';


$active_menu='users';  // в каком меню



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


if((isset($_POST['save_users']))and($_POST['save_users']==6))
{
	$token=htmlspecialchars($_POST['tk']);
	$id=htmlspecialchars($_GET['id']);
	
	
	//токен доступен в течении 120 минут
    if(token_access_new($token,'save_users',$id,"rema"))
    {
		//echo("!");
	//возможно проверка что этот пользователь это может делать
	 if (($role->permission('Сотрудники','U'))or($sign_admin==1)) {
         //вдруг мы заходим в сотрудника которого не можем смотреть
         $mass_ei = users_hierarchy_plus_disabled($id_user, $link);
         rm_from_array($id_user, $mass_ei);
         $mass_ei = array_unique($mass_ei);
//print_r ($mass_ei);

         if (array_search(ht($_GET['id']), $mass_ei) !== false) {

             $result_url = mysql_time_query($link, 'select A.* from r_user as A where A.id="' . htmlspecialchars(trim($_GET['id'])) . '"');
             $num_results_custom_url = $result_url->num_rows;
             if ($num_results_custom_url != 0) {

                 $row_list = mysqli_fetch_assoc($result_url);
                 //статус еще не забронировано

                 $stack_error = array();  // общий массив ошибок
                 $stack_offers = array();  // общий массив ошибок для предложений
                 $flag_podpis = 0;  //0 - все заполнено можно подписывать ready делать = 1


                 //print_r($stack_error);

                 if ((htmlspecialchars(trim($_POST['name_b'])) == '')) {
                     array_push($stack_error, "name_b");
                 }
                 if ((htmlspecialchars(trim($_POST['name_b1'])) == '')) {
                     array_push($stack_error, "name_b1");
                 }
                 if ((htmlspecialchars(trim($_POST['name_b1x'])) == '')) {
                     array_push($stack_error, "name_b1x");
                 }
                 if ((htmlspecialchars(trim($_POST['login_b'])) == '')) {
                     array_push($stack_error, "login_b");
                 } else {

                     $result_txs12 = mysql_time_query($link, 'Select a.id from r_user as a where a.login="' . htmlspecialchars(trim($_POST['login_b'])) . '" and not(a.id="' . htmlspecialchars($_GET['id']) . '")');

                     if ($result_txs12->num_rows != 0) {
                         array_push($stack_error, "login_b");
                     }
                     //если логин изменился то и пароль надо ввести обязательно старый или новый не важно
                     //чтобы сформировать новый оттиск пароля
                     $result_txs12 = mysql_time_query($link, 'Select a.login from r_user as a where a.id="' . ht($_GET['id']) . '"');

                     if ($result_txs12->num_rows != 0) {
                         $row_uul = mysqli_fetch_assoc($result_txs12);
                         if($row_uul["login"]!=ht(trim($_POST['login_b'])))
                         {
                             if ((htmlspecialchars(trim($_POST['password_b'])) == '')) {
                                 array_push($stack_error, "password_b");
                             }

                         }
                     }

                 }

                 if(htmlspecialchars(trim($_POST['password_b']))!='')
                 {

                     if(strlen($_POST['password_b'])<3)
                     {
                         array_push($stack_error, "password_b");
                     }

                 }


                 $subi=$_POST['role'];
                 $sel_role=0;
                 for ($i = 0; $i < (count($subi['type'])); $i++){

                     if((is_numeric($subi['type'][$i]))and($subi['val'][$i]=='1')and($subi['type'][$i]!='0'))
                     {
                         $sel_role=$subi['type'][$i];
                     }
                 }
                 if($sel_role!=0) {
                     //может ли он ставить эту роль она должна быть такой же или ниже по level
                     $result_uu = mysql_time_query($link, 'select sign_level,id from r_role where id="' . ht(ht($sel_role)) . '"');
                     $num_results_uu = $result_uu->num_rows;

                     if ($num_results_uu != 0) {
                         $row_uu = mysqli_fetch_assoc($result_uu);
                         $su_t = $row_uu["id_role"];
                         if (($row_uu["sign_level"] > $sign_level)or($row_uu["id"]==$id_role)) {
                             array_push($stack_error, "role");
                         }
                     }
                 }

                 if($sel_role==0)
                 {
                     array_push($stack_error, "role");
                 }


                 //есть ли ошибки по заполнению
                 //print_r($stack_error);


                 if (count($stack_error) == 0) {
                     //ошибок нет
                     //сохраняем наряд
                     $today[0] = date("y.m.d"); //присвоено 03.12.01
                     $today[1] = date("H:i:s"); //присвоит 1 элементу массива 17:16:17

                     $date_ = $today[0] . ' ' . $today[1];
                     $sql_password = '';
                     if ((htmlspecialchars(trim($_POST['password_b'])) != '')) {
                         $sql_password = ',password="' . password_crypt_x(htmlspecialchars($_GET['id']), htmlspecialchars(trim($_POST['password_b'])), htmlspecialchars(trim($_POST['login_b']))) . '"';


                     }

                     $phone_base=explode(" ",htmlspecialchars(trim($_POST['name_b1'])));
                     $phone_base1=explode("-",$phone_base[2]);

                     $phone_end=	$phone_base[1][1].$phone_base[1][2].$phone_base[1][3].$phone_base1[0].$phone_base1[1].$phone_base1[2];

                     mysql_time_query($link, 'update r_user set name_user="' . htmlspecialchars($_POST['name_b']) . '",name_small="' . htmlspecialchars($_POST['name_b1x']) . '",login="' . htmlspecialchars(trim($_POST['login_b'])) . '",id_role="' . ht($sel_role) . '"' . $sql_password . ',phone="' . ht($phone_end) . '" where id = "' . htmlspecialchars($_GET['id']) . '"');

                     //mysql_time_query($link, 'delete FROM r_user_object where id_user="' . htmlspecialchars(trim($_GET['id'])) . '"');

                     //проверяем уведомления
                     mysql_time_query($link,'delete FROM a_notification_user_option where id_user="'.ht($_GET['id']).'"');
//к каким категориям относится
                     if(isset($_POST['notis'])) {
                         $subi = $_POST['notis'];
                         for ($i = 0; $i < (count($subi['type'])); $i++) {

                             if ((is_numeric($subi['type'][$i])) and ($subi['val'][$i] == '1') and ($subi['type'][$i] != '0')) {
                                 //проверим можно ли это уведомление для этой роли
                                 $result_uuy = mysql_time_query($link, 'select id from a_notification_type_role where id_role="' . ht($sel_role) . '" and number_type="'.ht($subi['type'][$i]).'" and val=1');
                                 $num_results_uuy = $result_uuy->num_rows;

                                 if ($num_results_uuy != 0) {
                                     mysql_time_query($link, 'INSERT INTO a_notification_user_option (id_user,number_type,val) VALUES ("' . ht($_GET['id']) . '","' . ht($subi['type'][$i]) . '","1")');
                                 }


                             }
                         }
                     }

                     //кем руководит
                     $mass_ei=users_hierarchy_plus_disabled($id_user,$link);
                     //array_push($mass_ei, $id_user);
                     $mass_ei= array_unique($mass_ei);


                     mysql_time_query($link,'delete FROM r_user_subordinates where id_user="'.ht($_GET['id']).'"');
                     if(isset($_POST['kem'])) {
                         $subi = $_POST['kem'];
                         for ($i = 0; $i < (count($subi['type'])); $i++) {

                             if ((is_numeric($subi['type'][$i])) and ($subi['val'][$i] == '1') and ($subi['type'][$i] != '0')) {
                                 //проверим может ли он ставить в кем руководит этого пользователя


                                 if (array_search($subi['type'][$i], $mass_ei) !== false) {

                                     mysql_time_query($link, 'INSERT INTO r_user_subordinates (id_user,id_user_subordinates) VALUES ("' . ht($_GET['id']) . '","' . ht($subi['type'][$i]) . '")');

                                 }

                             }
                         }
                     }


                     //уведомление начальству что такой пользователь был изменен



                     $text_not='<a href="users/'.$id_user.'/">'.$name_user.'</a> изменил(а) данные по сотруднику <a href="users/'.ht($_GET['id']).'/">'.htmlspecialchars($_POST['name_b']).'</a>.';

                     $user_send_new= array();
                     $user_send_new=array_merge(UserNotNumber(7,$link));

                     rm_from_array(0,$user_send_new);
                     rm_from_array($id_user,$user_send_new);
                     $user_send_new= array_unique($user_send_new);


                     $mass_ei = all_chief($id_user, $link);
                     rm_from_array($id_user, $mass_ei);
                     $mass_ei = array_unique($mass_ei);

                     $end_mass=exception_role($user_send_new,$mass_ei);



                     notification_send_admin( $text_not,$end_mass,0,$link);



                     header("Location:" . $base_usr . "/users/?a=yes");
                     die();

                 }

             }
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




//проверить и перейти к последней себестоимости в которой был пользователь


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

if((!$role->permission('Сотрудники','R'))and($sign_admin!=1))
{
  header404(3,$echo_r);
}


$result_url=mysql_time_query($link,'select A.* from r_user as A where A.id="'.htmlspecialchars(trim($_GET['id'])).'"');
        $num_results_custom_url = $result_url->num_rows;
        if($num_results_custom_url==0)
        {
           header404(5,$echo_r);
		} else
		{
			$row_list = mysqli_fetch_assoc($result_url);
		}


//вдруг мы заходим в сотрудника которого не можем смотреть
$mass_ei=users_hierarchy_plus_disabled($id_user,$link);
rm_from_array($id_user,$mass_ei);
$mass_ei= array_unique($mass_ei);
//print_r ($mass_ei);

if(array_search(ht($_GET['id']),$mass_ei)===false)
{
    header404(58,$echo_r);
}



if($error_header==404)
{
	include $url_system.'module/error404.php';
	die();
}

//проверка адреса сайта на существование такой страницы
//проверка адреса сайта на существование такой страницы
//проверка адреса сайта на существование такой страницы


$status_edit='';
$status_class='';
$status_edit1='';
if (!$role->permission('Сотрудники','U'))
{	
   $status_edit='readonly';	
   $status_edit1='disabled';
   $status_class='grey_edit';		
}



include_once $url_system.'template/html.php'; include $url_system.'module/seo.php';

if($error_header!=404){ SEO('users_view','','','',$link); } else { SEO('0','','','',$link); }

include_once $url_system.'module/config_url.php'; include $url_system.'template/head.php';
?>
</head><body>
<?
echo'<div class="alert_wrapper"><div class="div-box"></div></div>';
include_once $url_system.'template/body_top.php';


//сообщения после добавление редактирования чего то
//сообщения после добавление редактирования чего то
//сообщения после добавление редактирования чего то

$echo_help=0;
if ((isset($stack_error))and(count($stack_error) != 0))
{
if(array_search('role',$stack_error)!==false) {

    echo '<script type="text/javascript">
        $(function (){
            alert_message(\'error\',\'заполните должность\');
            });
</script>';

} else {


    echo '<script type="text/javascript">
        $(function (){
            alert_message(\'error\',\'Не все поля заполнены\');
            });
</script>';
}
    $echo_help++;
}
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

	  include_once $url_system.'template/top_users_view.php';

	  	  echo'<form id="lalala_add_form" class="my_n" style=" padding:0; margin:0;" method="post" enctype="multipart/form-data"><input name="save_users" value="6" type="hidden">';
	  
	  	$token=token_access_compile($_GET['id'],'save_users',$secret);				
						
		echo'<input type="hidden" value="'.$token.'" name="tk">';

echo'<div id="fullpage" class="margin_60  form_531_booking">';
?>
      <div class="section" id="section0">
          <div class="height_100vh">


              <div class="oka_block_2019">

                  <?
echo'<div class="line_mobile_blue">Cотрудник -'.$row_list["name_user"].'</div>';

?>
                  <div class="div_ook" style="border-bottom: 1px solid rgba(0,0,0,0.05);">
                      <?
                      echo'<div class="form-panel">
	<div class="na-100" style="padding: 0px; padding-top:10px;">';
                      echo'<span class="h4-f">Должность в системе</span>';
                      echo'</div></div>';

                      echo'<div class="form-panel js-group-c js-tolko-one js-role-x">';


                      $su_t=0;
                      $result_uu = mysql_time_query($link, 'select id_role from r_user where id="' . ht(ht($_GET['id'])) . '"');
                      $num_results_uu = $result_uu->num_rows;

                      if ($num_results_uu != 0) {
                          $row_uu = mysqli_fetch_assoc($result_uu);
                          $su_t=$row_uu["id_role"];
                      }

                      $result_66 = mysql_time_query( $link, 'Select a.* from r_role as a where a.sign_level<="'.$sign_level.'" and not(a.id="'.$id_role.'") order by a.name_role' );
                      if ( $result_66 ) {
                          $i = 0;
                          while ( $row_66 = mysqli_fetch_assoc( $result_66 ) ) {

                              echo'<div class="na-50" style="padding: 0px;">';

                              echo'<div class="input-choice-click-left js-checkbox-group js-checkbox-role" style="margin-top: 0px; background-color: transparent;">
<div class="choice-head">'.$row_66["name_role"].'</div>
<div class="choice-radio"><div class="center_vert1">';
                              if($row_66["id"]==$su_t)
                              {
                                  echo'<i class="active_task_cb"></i><input name="role[type][]" value="'.$row_66["id"].'" type="hidden"><input name="role[val][]" value="1" type="hidden">';
                              } else
                              {
                                  echo'<i></i><input name="role[type][]" value="'.$row_66["id"].'" type="hidden"><input name="role[val][]" value="0" type="hidden">';
                              }


                              echo'</div></div></div></div>';




                          }
                      }





                      echo'</div>';
                      ?>
                  </div>



		
				

	<div class="div_ook" style="border-bottom: 1px solid rgba(0,0,0,0.05);">
	
<!--<span class="add_bo">Добавление новой заявки</span>	-->
<?
        echo'<div class="ok-block-input-2019"><div class="ok-input-title-2019 '.iclass_("name_b",$stack_error,"error_formi_2019").'"><label>Ваше ФИО</label><span class="h_input">Ваше ФИО</span><i></i><span class="ok-i-2019"><input '.$status_edit.' name="name_b" id="name_b" placeholder="Имя пользователя в системе" class="input_new_2019 '.iclass_("name_b",$stack_error,"error_formi").'" autocomplete="off" type="text" value="'.ipost_($_POST['name_b'],$row_list["name_user"]).'"><div class="div_new_2019"><hr class="one"><hr class="two"></div></span></div></div>';                                                                    ?>

                  <?
                  echo'<div class="ok-block-input-2019"><div class="ok-input-title-2019 '.iclass_("name_b1x",$stack_error,"error_formi_2019").'"><label>Краткое имя</label><span class="h_input">Краткое имя</span><i></i><span class="ok-i-2019"><input '.$status_edit.' name="name_b1x" id="name_b1x" placeholder="Номер для связи и уведомлений" class="input_new_2019 '.iclass_("name_b1x",$stack_error,"error_formi").'" autocomplete="off" type="text" value="'.ipost_($_POST['name_b1x'],$row_list["name_small"]).'"><div class="div_new_2019"><hr class="one"><hr class="two"></div></span></div></div>';                                                                                   ?>


                  <?
	echo'<div class="ok-block-input-2019"><div class="ok-input-title-2019 '.iclass_("name_b1",$stack_error,"error_formi_2019").'"><label>Телефон для связи</label><span class="h_input">Телефон для связи</span><i></i><span class="ok-i-2019"><input '.$status_edit.' name="name_b1" id="name_b1" placeholder="Номер для связи" class="input_new_2019 phone_us1 '.iclass_("name_b1",$stack_error,"error_formi").'" autocomplete="off" type="tel" value="'.ipost_($_POST['name_b1'],$row_list["phone"]).'"><div class="div_new_2019"><hr class="one"><hr class="two"></div></span></div></div>';
	        	        
	        ?>

    </div>
                  <div class="div_ook" style="border-bottom: 1px solid rgba(0,0,0,0.05);">

        <div class="help_div da_book1"><div class="not_boolingh"></div><span class="h5"><span>Логин - уникальный в системе, не менее 3 символов, должен начинаться с буквы. Пароль - не менее 3 символов. Только на английской раскладке</span></span></div>



        <?

        echo'<div class="ok-block-input-2019"><div class="ok-input-title-2019 '.iclass_("login_b",$stack_error,"error_formi_2019").'"><label>Логин Пользователя</label><span class="h_input">Логин Пользователя</span><i></i><span class="ok-i-2019"><input '.$status_edit.' name="login_b" id="login_b" placeholder="Логин в системе" class="input_new_2019 no_uppercase '.iclass_("login_b",$stack_error,"error_formi").'" autocomplete="off" type="text" value="'.ipost_($_POST['login_b'],$row_list["login"]).'"><div class="div_new_2019"><hr class="one"><hr class="two"></div></span></div></div>';                                                                                   ?>

        <?
        echo'<div class="ok-block-input-2019"><div class="ok-input-title-2019 '.iclass_("password_b",$stack_error,"error_formi_2019").'"><label>Пароль для входа</label><span class="h_input">Пароль для входа</span><i></i><span class="ok-i-2019"><input name="password_b" id="password_b" placeholder="Пароль" class="input_new_2019 '.iclass_("password_b",$stack_error,"error_formi").'" autocomplete="off" type="password" value=""><div class="div_new_2019"><hr class="one"><hr class="two"></div></span></div></div>';                                                                                   ?>




    </div>

                  <div class="div_ook" style="border-bottom: 1px solid rgba(0,0,0,0.05);">
                      <?
                      echo'<div class="form-panel">
	<div class="na-100" style="padding: 0px; padding-top:10px;">';
                      echo'<span class="h4-f">Кем руководит</span>';
                      echo'</div></div>';

                      echo'<div class="form-panel js-group-c">';


                      $mass_ei=users_hierarchy_plus_disabled($id_user,$link);
                      //array_push($mass_ei, $id_user);
                      $mass_ei= array_unique($mass_ei);



                      foreach ($mass_ei as $keys => $value)
                      {
                          $result_work_zz=mysql_time_query($link,'Select a.name_user,a.id from r_user as a where a.id="'.$value.'"');
                          $num_results_work_zz = $result_work_zz->num_rows;
                          if($num_results_work_zz!=0)
                          {

                              for ($i=0; $i<$num_results_work_zz; $i++)
                              {
                                  $row_66 = mysqli_fetch_assoc($result_work_zz);
                                  if($row_66["id"]!=$_GET["id"]) {
                                      echo '<div class="na-50" style="padding: 0px;">';

                                      echo '<div class="input-choice-click-left js-checkbox-group" style="margin-top: 0px; background-color: transparent;">
<div class="choice-head">' . $row_66["name_user"] . '</div>
<div class="choice-radio"><div class="center_vert1">';

                                      $result_uu = mysql_time_query($link, 'select id from r_user_subordinates where id_user="' . ht($_GET['id']) . '" and id_user_subordinates="' . $row_66["id"] . '"');
                                      $num_results_uu = $result_uu->num_rows;

                                      if ($num_results_uu != 0) {
                                          echo '<i class="active_task_cb"></i><input name="kem[type][]" value="' . $row_66["id"] . '" type="hidden"><input name="kem[val][]" value="1" type="hidden">';;
                                      } else {
                                          echo '<i></i><input name="kem[type][]" value="' . $row_66["id"] . '" type="hidden"><input name="kem[val][]" value="0" type="hidden">';
                                      }


                                      echo '</div></div></div></div>';
                                  }
                              }
                          }

                      }

                      echo'</div>';
                      ?>
                  </div>



                  <div class="div_ook">
                      <?
                      echo'<div class="form-panel">
	<div class="na-100" style="padding: 0px; padding-top:10px;">';
                      echo'<span class="h4-f">Уведомления</span>';
                      echo'</div></div>';

                      echo'<div class="form-panel js-panel-notif" ipo="'.$_GET["id"].'">';


                      $su_t=array();
                      if(!isset($_POST['notis']['type'][0]))
                      {
                          $result_66 = mysql_time_query( $link, 'Select b.number_type from a_notification_user_option as b where b.val=1 and b.id_user="' . ht($_GET["id"]) . '"' );
                          if ( $result_66 ) {
                              while ( $row_66 = mysqli_fetch_assoc( $result_66 ) ) {

                                  array_push( $su_t, $row_66[ "number_type" ] );

                              }
                          }
                      } else
                      {

                          $sub_type=$_POST['notis'];
                          for ($i = 0; $i < (count($sub_type['type'])); $i++){

                              if($sub_type['val'][$i]=='1')
                              {
                                  array_push( $su_t, $sub_type['type'][$i] );
                              }


                          }

                      }


                      $result_66 = mysql_time_query( $link, 'SELECT a.id_number,a.name FROM a_notification_type AS a,a_notification_type_role AS b, r_user AS c WHERE a.id_number=b.number_type AND b.id_role=c.id_role AND c.id="'.ht($_GET["id"]).'" ORDER BY a.id' );
                      if ( $result_66 ) {
                          $i = 0;
                          while ( $row_66 = mysqli_fetch_assoc( $result_66 ) ) {

                              echo'<div class="na-50" style="padding: 0px;">';

                              echo'<div class="input-choice-click-left js-checkbox-group" style="margin-top: 0px; background-color: transparent;">
<div class="choice-head">'.$row_66["name"].'</div>
<div class="choice-radio"><div class="center_vert1">';
                              if(in_array($row_66["id_number"], $su_t))
                              {
                                  echo'<i class="active_task_cb"></i><input name="notis[type][]" value="'.$row_66["id_number"].'" type="hidden"><input name="notis[val][]" value="1" type="hidden">';
                              } else
                              {
                                  echo'<i></i><input name="notis[type][]" value="'.$row_66["id_number"].'" type="hidden"><input name="notis[val][]" value="0" type="hidden">';
                              }


                              echo'</div></div></div></div>';




                          }
                      }





                      echo'</div>';
                      ?>
                  </div>





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
