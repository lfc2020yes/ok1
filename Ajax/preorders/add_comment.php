<?php
//добавление комментария к туру

$name_form='003U';
$key_form='bt_task_info';

//показать еще сообщения общения в клиенте
$url_system=$_SERVER['DOCUMENT_ROOT'].'/';
include_once $url_system.'module/ajax_access.php';
header("Content-type: application/json");

$status_ee='error';
$eshe=0;
$echo='';
$vid=0;
$debug='';
$count_all_all=0;
$basket='';
//$token=htmlspecialchars($_GET['tk']);
$disco=0;
$id=htmlspecialchars($_GET['id']);
$query_string='';
$dom=0;
$status_echo='';
//проверка что есть такой город что это число
//проверка что пользователь зарегистрирован

$echo_r=0; //выводить или нет ошибку 0 -нет
$debug='';

//**************************************************

//**************************************************
if ((!$role->permission('Обращения','U'))and($sign_admin!=1))
{
	  $debug=h4a(12,$echo_r,$debug);
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


if((!isset($_SESSION["user_id"]))or(!is_numeric(id_key_crypt_encrypt($_SESSION["user_id"]))))
{	
	goto end_code;
}

$id_user=id_key_crypt_encrypt($_SESSION["user_id"]);

//проверить есть ли переменная id и можно ли этому пользователю это делать
if ((count($_GET) != 3))
{
	goto end_code;	
}


$mas_responsible=array();
$result_uu = mysql_time_query($link, 'select A.id,A.id_user  from preorders as A where A.id_company IN ('.$id_company.') and A.id="' . ht($_GET['id']) . '"');
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




/*	
0 5
5 5
10 5
15 5	
*/
//**************************************************
//**************************************************
//**************************************************
//**************************************************

$status_ee='ok';


mysql_time_query($link,'INSERT INTO preorders_status_history_new (id_preorder,action_history,id_user,datetimes,edit,comment,comment_sys) VALUES ("'.ht($_GET['id']).'","15","'.ht($id_user).'","'.date("y.m.d").' '.date("H:i:s").'","1","'.ht($_GET['text']).'","")');


$ID_N=mysqli_insert_id($link);  



$result_8 = mysql_time_query($link,'SELECT A.*  FROM preorders_status_history_new AS A WHERE  A.id="'.$ID_N.'"');


$num_8 = $result_8->num_rows;	
if($num_8!=0)
{	

  			  $row_8 = mysqli_fetch_assoc($result_8);

    $query_string_xx='<div rel_notibss="'.$row_8["id"].'" class="comm-preorders-block new-say-com-t">';
    $query_string_xx.='<div class="h_cb"><a><span>'.$row_8["comment"].'</span></a>';

    $query_string_xx.='<div class="date_cb" >'.time_stamp($row_8["datetimes"]).'</div></div>';


    $result_status22=mysql_time_query($link,'SELECT b.name_user,b.name_small FROM r_user AS b WHERE b.id="'.htmlspecialchars(trim($row_8["id_user"])).'"');
    //echo('SELECT a.* FROM r_status AS a WHERE a.numer_status="'.$row1ss["status"].'" and a.id_system=13');

    $query_string_xx.='<div class="user_cb">';

    if($result_status22->num_rows!=0)
    {
        $row_status22 = mysqli_fetch_assoc($result_status22);
        $query_string_xx.=''.$row_status22['name_small'].'';
    }

//только для своих общений

        $query_string_xx.='<div class="vip-ds"><i class="em2 js-com-preorders-del" data-tooltip="Удалить"></i></div>';



    $query_string_xx.='</div>';



    /*
    //только для своих общений
            if((($row_8["id_user"]==$id_user)or($sign_admin==1))and($row_8["edit"]==1))
            {
                $query_string_xx.='<div class="edit-menu-2019 com-task-edit-block"><i class="em2 js-com-trips-del" data-tooltip="Удалить"></i></div>';				  }
    */

    $query_string_xx.='</div>';
//$query_string_xx.='</div>';













}


	
end_code:

$aRes = array("debug"=>$debug,"status"   => $status_ee,"echo"=>$query_string_xx);
/*require_once $url_system.'Ajax/lib/Services_JSON.php';
$oJson = new Services_JSON();
//функция работает только с кодировкой UTF-8
echo $oJson->encode($aRes);
*/
echo json_encode($aRes);
?>