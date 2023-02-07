<?php
//добавить новое обращение
$url_system=$_SERVER['DOCUMENT_ROOT'].'/';
include_once $url_system.'module/ajax_access.php';
header("Content-type: application/json");


//if(empty($_POST['preorders']['id_client'])) {  $_POST['preorders']['id_client']=0; }
//echo($_POST['task']['id_client']);
$temp='';
$status_ee='error';
$eshe=0;
$echo='';
$new=array();
$vid=0;
$debug='';
$count_all_all=0;
$basket='';
$token=htmlspecialchars($_POST['tk']);
$disco=0;

$id=htmlspecialchars($_POST['id']);
$dom=0;
$status_echo='';
//проверка что есть такой город что это число
//проверка что пользователь зарегистрирован

$echo_r=1; //выводить или нет ошибку 0 -нет
$debug='';

//**************************************************
if(!token_access_new($token,'bt_add_preorders',2021,"rema",2880))
{
   $debug=h4a(100,$echo_r,$debug);
   goto end_code;
}
	
	
	//echo(count($_POST));
/*
if ( count($_POST) != 3 ) 
{
   $debug=h4a(1,$echo_r,$debug);
   goto end_code;	
}
*/

//**************************************************
 if ((!$role->permission('Обращения','A'))and($sign_admin!=1))
{
  $debug=h4a(2,$echo_r,$debug);
  goto end_code;	
}
//**************************************************
 if(!isset($_SESSION["user_id"]))
{ 
  $status_ee='reg';	
  $debug=h4a(3,$echo_r,$debug);
  goto end_code;
}
//**************************************************
if ((!isset($_POST["id"])))
{
   $debug=h4a(4,$echo_r,$debug);
   goto end_code;	
}


if ((isset($_POST['preorders']["client_type"]))and(is_numeric($_POST['preorders']["id_client"]))and(($_POST['preorders']["client_type"]=='1')or($_POST['preorders']["client_type"]=='2')or($_POST['preorders']["client_type"]=='3')))
{
  //проверяем мог ли он привязать эту задачу к данному клиенту
  //если относится к той же компани что и пользователь добавл. задачу

		switch($_POST['preorders']["client_type"])
              {
		 case "1":{ 
			 //частное лицо
			 $sql_tt='Select b.id from k_clients as b where b.id="'.ht($_POST['preorders']['id_client']).'" and b.potential=0 and b.visible=1 and b.id_a_company IN ('.ht($id_company).')';
			 break; 
                  }	
		case "2":{ 
			 //организация
			 $sql_tt='Select b.id from k_organization as b where b.id="'.ht($_POST['preorders']['id_client']).'" and  b.visible=1 and b.id_a_company IN ('.ht($id_company).')';
			 break; 
                  }		
		 case "3":{ 
			 //потенциальный
			 $sql_tt='Select b.id from k_clients as b where b.id="'.ht($_POST['preorders']['id_client']).'" and b.potential=1 and b.visible=1 and b.id_a_company IN ('.ht($id_company).')';
			 break; 
                  }		
		}
	
  $result_t=mysql_time_query($link,$sql_tt);
	
	
	
           $num_results_t = $result_t->num_rows;
	       if($num_results_t==0)
	       {	
			      $debug=h4a(86,$echo_r,$debug);
                  goto end_code;
		   }
	
} else
{
    $debug=h4a(8699,$echo_r,$debug);
    goto end_code;
}



//**************************************************
//**************************************************
//**************************************************
//**************************************************


$status_ee='ok';

$type_c=2;
if(($_POST['preorders']["client_type"]==1)or($_POST['preorders']["client_type"]==3))
{
    $type_c=1;
}


$who_kto=ht($id_user);
if((isset($_POST["id_user_booking"]))and($_POST["id_user_booking"]!=0))
{

    $who_kto=ht($_POST["id_user_booking"]);

}


mysql_time_query($link, 'INSERT INTO preorders(id_company,id_user,id_type_clients,id_k_clients,id_booking_sourse,id_country,text,id_mark,date_create,visible,status,id_reasons) VALUES( 
"' . ht($_POST['id_org']) . '",
"' . $who_kto . '",
"'. $type_c.'",
"' . ht($_POST['preorders']['id_client']) . '",
"'.ht($_POST["type_booking"]).'",
"'.ht($_POST["id_country"]).'",
"'.ht($_POST["question"]).'",
"0",
"'.date("y.m.d").' '.date("H:i:s").'",
"1",
"1",
"0"
)');
$ID_N=mysqli_insert_id($link);
//добавим в историю о добавление обращения



if($who_kto!=$id_user)
{
    $text_not = 'Вам поступило новое обращение <a href="/preorders/.id-' . ht($ID_N) . '">Обращение №' . ht($ID_N) . '</a>';

    $user_send_new= array();
    $user_send_new=UserNotNumberUsers("13",$who_kto,$link);

    rm_from_array(0,$user_send_new);
    $user_send_new=array_unique($user_send_new);

/*
    $mass_ei = all_chief($id_user, $link);
    rm_from_array($id_user, $mass_ei);
    $mass_ei = array_unique($mass_ei);

    $end_mass=exception_role($user_send_new,$mass_ei);
*/
    notification_send($text_not,$user_send_new,$id_user,$link);
}




$comment='Обращение создано';
$comment_sys='';
mysql_time_query($link,'INSERT INTO preorders_status_history_new (id_preorder,action_history,id_user,datetimes,edit,comment,comment_sys) VALUES ("'.ht($ID_N).'","4",
		"'.ht($id_user).'",
		"'.date("Y-m-d").' '.date("H:i:s").'",
		"0",
		"'.ht($comment).'",
		"'.ht($comment_sys).'")');


if($sign_admin!=1)
{
    $text_not = 'Добавлено новое обращение <a href="/preorders/.id-' . ht($ID_N) . '">Обращение №' . ht($ID_N) . '</a>. Менеджер тура - '.$name_user;

    $user_send_new= array();
    $user_send_new=array_merge(UserNotNumber(13,$link));

    rm_from_array(0,$user_send_new);
    rm_from_array($id_user,$user_send_new);
    $user_send_new= array_unique($user_send_new);


    $mass_ei = all_chief($id_user, $link);
    rm_from_array($id_user, $mass_ei);
    $mass_ei = array_unique($mass_ei);

    $end_mass=exception_role($user_send_new,$mass_ei);



    notification_send( $text_not,$end_mass,$id_user,$link);


}


//если добавляют задачу с обращением
if(ht($_POST['preorders']["task"])==1)
{

    mysql_time_query($link,'INSERT INTO task_new (id_a_group,id_user,id_user_responsible,ring_datetime,comment,date_create,visible,status,click,action,id_object) VALUES ("'.ht($id_group_u).'","'.$id_user.'","'.$who_kto.'","'.ht($_POST['date_sele_task_form2']).' '.ht($_POST['task_time_form2']).':00","'.ht($_POST['task_comment']).'","'.date("y.m.d").' '.date("H:i:s").'","1","0","1","20","'.$ID_N.'")');


  $ID_N1=mysqli_insert_id($link);

//добавление истории по задаче
    AddHistoryTask('7',$id_user,$ID_N1,'','','','','','','',$link,'');
    UpdateTaskKey($id_user,$link);

    //добавляем в историю по обращению это действие
    $comment='создана задача → '.ht($_POST['task_comment']);
    $comment_sys='';
    mysql_time_query($link,'INSERT INTO preorders_status_history_new (id_preorder,action_history,id_user,datetimes,edit,comment,comment_sys) VALUES ("'.ht($ID_N).'","6",
		"'.ht($id_user).'",
		"'.date("Y-m-d").' '.date("H:i:s").'",
		"0",
		"'.ht($comment).'",
		"'.ht($comment_sys).'")');


}


//вывод нового обращения чтобы добавить в общий список
$result_t=mysql_time_query($link,'Select b.* from preorders as b where b.id="'.htmlspecialchars(trim($ID_N)).'" and b.visible=1');
$num_results_t = $result_t->num_rows;
if($num_results_t!=0)
{
    $row_8 = mysqli_fetch_assoc($result_t);
    $new_pre=1;
    include $url_system.'preorders/code/block_preorders.php';
    $temp.=$task_cloud_block;
}




end_code:

$aRes = array("debug"=>$debug,"status"   => $status_ee,"status_echo"   => $status_echo,"new" => $new1,"for_id"=>$id,"id" => htmlspecialchars($ID_N),"temp"=>$temp);
/*require_once $url_system.'Ajax/lib/Services_JSON.php';
$oJson = new Services_JSON();
//функция работает только с кодировкой UTF-8
echo $oJson->encode($aRes);
*/
echo json_encode($aRes);
?>