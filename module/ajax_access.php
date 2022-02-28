<?
//защита от доступа к ajax файлам напрямую


function reset_url($url) {
    $value = str_replace ( "http://", "", $url );
    $value = str_replace ( "https://", "", $value );
    $value = str_replace ( "www.", "", $value );
    $value = explode ( "/", $value );
    $value = reset ( $value );
    return $value;
}

$_SERVER['HTTP_REFERER'] = reset_url ( $_SERVER['HTTP_REFERER'] );
$_SERVER['HTTP_HOST'] = reset_url ( $_SERVER['HTTP_HOST'] );
 
if ($_SERVER['HTTP_HOST'] != $_SERVER['HTTP_REFERER']) {

    // @header ( 'Location: ' . $config['http_home_url'] );
	header("HTTP/1.1 404 Not Found");
	header("Status: 404 Not Found");
    die ();
}
     
     
 
if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    /* значит ajax-запрос */
     
    /* обрабатываем */
     
} else {

	header("HTTP/1.1 404 Not Found");
	header("Status: 404 Not Found");    
	die ();
}

//Проверяем вдруг это взлом. смотрим есть ли такой тип, относятся ли эти условия поиска к этому типу, существует ли сортировка
//если есть n_st смотрим число ли это, append тоже проверяем



define( '_SECRETJ', 7 );

//Проверяем чтобы доступ напрямую был закрыт для этого файла
//Пишем в файле который присоединяем в ajax
//if (!defined('_SECRETJ')){  header("HTTP/1.1 404 Not Found"); header("Status: 404 Not Found"); die(); }
//Проверяем чтобы доступ напрямую был закрыт для этого файла


//header("Content-type: application/json");
session_start();
//подключение к базе
include_once $url_system.'module/config.php';
//подключение написанных функций для сайта
include_once $url_system.'module/function.php';
//проверка авторизации
include_once $url_system.'login/function_users.php'; 
initiate($link);
if((isset($_SESSION["user_id"])))
{	
 $id_user=id_key_crypt_encrypt(htmlspecialchars(trim($_SESSION['user_id'])));


$auth_key_query = mysql_time_query($link,"SELECT id,name_user,id_company,id_role,id_office FROM r_user WHERE id='".safe_var($id_user)."'");
		$num_results = $auth_key_query->num_rows;
        if($num_results!=0)
        {	       
$row_town_user = mysqli_fetch_assoc($auth_key_query);
$name_user=$row_town_user['name_user'];




            $id_company_sql = $row_town_user['id_company'];
            $id_office_sql=$row_town_user['id_office'];
            $more_city=0;
            if (is_numeric(trim($row_town_user['id_company']))) {
                $id_company = $row_town_user['id_company'];
                $mass_city[0]=$row_town_user['id_company'];
            } else
            {
                $mass_city = explode(",", ht($row_town_user['id_company']));
                $more_city=1;
                $id_company = $row_town_user['id_company'];

                //значит у него несколько организаций и смотрим выбрана ли какая то определенно
                if(( isset($_COOKIE["cc_town".$id_user]))and($_COOKIE["cc_town".$id_user]!='')and(is_numeric(trim($_COOKIE["cc_town".$id_user])))) {

                    if (in_array($_COOKIE["cc_town".$id_user], $mass_city)) {

                        $id_company = $_COOKIE["cc_town".$id_user];

                    }


                }

            }

            //определяем к какой группе копманий относится пользователь
            //определяем к какой группе копманий относится пользователь
            $id_group_u=0;
            $result_gr = mysql_time_query($link, 'select id_group from a_company_group where id_a_company="' . ht($mass_city[0]) . '"');
            $num_results_gr = $result_gr->num_rows;

            if ($num_results_gr != 0) {
                $row_gr = mysqli_fetch_assoc($result_gr);
                $id_group_u=$row_gr["id_group"];

                $result_gr1 = mysql_time_query($link, 'select company_list from a_group where id="' . ht($id_group_u) . '"');
                $num_results_gr1 = $result_gr1->num_rows;

                if ($num_results_gr1 != 0) {
                    $row_gr1 = mysqli_fetch_assoc($result_gr1);
                    $id_group_company_list=$row_gr1["company_list"];
                }



            }
            //определяем к какой группе копманий относится пользователь
            //определяем к какой группе копманий относится пользователь


            //определяем возможные для него офисы работы
            if (is_numeric(trim($row_town_user['id_office']))) {
                $mass_office[0]=$row_town_user['id_office'];
            } else {
                $mass_office = explode(",", ht($row_town_user['id_office']));
            }
            //определяем возможные для него офисы работы


$id_role=$row_town_user['id_role'];				
        }     



 //считываем все необходимые доступы для этого пользователя
 include_once $url_system.'ilib/lib_interstroi.php'; 
 $role=new RoleUser($link,$id_user);  //создаем класс прав
 $role->GetColumns();
 $role->GetRows();
 $role->GetPermission();

 $hie = new hierarchy($link,$id_user);

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
}


//создание секрет для формы
$secret=rand_string_string(16);
//echo($secret);
if(!isset($_SESSION['rema']))
{
    $_SESSION['rema'] = $secret;
} else
{
    $secret=$_SESSION['rema'];
}
?>