<?
//переход на вход в систему при отсутствии сессиии

   if(!isset($_SESSION['user_id']))
   {
	    
		header("Location: /login/?next=".base64_encode("https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']));
   
   } else
{     
     //
     //mysqli_query($link,'CALL set_user('.$id_user.')');
     
     include_once $url_system.'ilib/lib_interstroi.php'; 
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
                $id_group_company_list=$row_town_user['id_company'];
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

           // echo($id_company_sql);
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
$role=new RoleUser($link,$id_user);  //создаем класс прав
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