<?

$url_system=$_SERVER['DOCUMENT_ROOT'].'/';

include_once $url_system.'module/config_time.php';
include_once $url_system.'module/version.php';

define('ENCRYPTION_KEY', 'qeda38s23kldfgd0');




$base_usr="https://www.ok.umatravel.club";
$base_usr_start="https://www.ok.umatravel.club?a=yes";

$local_host="www.ok.umatravel.club"; //как называет домен в локалке
//echo($_SERVER['DOCUMENT_ROOT']);

$local='C:/OpenServer/domains/'.$local_host.'';


if($_SERVER['DOCUMENT_ROOT']!=$local)
{
$base_usr="https://www.ok.umatravel.club";
$base_usr_start="https://www.ok.umatravel.club";
$base_ograph="www.ok.umatravel.club";
	
$dblocation = "localhost";
$dbname = "u0468554_qwik";
$dbuser = "u0468554_umatask";
$dbpasswd = "3k(jn}VE+J3h";	

} else
{
$base_usr="https://www.ok.umatravel.club";
$base_usr_start="https://www.ok.umatravel.club";
$base_ograph="www.ok.umatravel.club";
	
$dblocation = "localhost";
$dbname = "qwic";
$dbuser = "mysql";
$dbpasswd = "mysql";	
} 



 
 
/*   
$dblocation = "localhost";
$dbname = "u0468554_qwik";
$dbuser = "u0468554_umatask";
$dbpasswd = "3k(jn}VE+J3h";	
*/   
/* Подключение к серверу MySQL */ 
$link = mysqli_connect( 
            $dblocation,  /* Хост, к которому мы подключаемся */ 
            $dbuser,       /* Имя пользователя */ 
            $dbpasswd,   /* Используемый пароль */ 
            $dbname);     /* База данных для запросов по умолчанию */ 



if (!$link) { 
   printf("Невозможно подключиться к базе данных. Код ошибки: %s\n", mysqli_connect_error()); 
   exit; 
} 

//mysqli_query($link,'SET NAMES cp1251');
mysqli_query($link,'SET NAMES utf8');

mysqli_query($link,'CALL set_value_trigger(0)');

$region=1; //регион сайта
$time_sql=1; //собирать статистику

function mysql_time_query($link,$query)
{
global $time_sql;	
if($time_sql==1){ 
  $start_time = microtime(true);
  $ti_sql=$query;	
}	
if ($result = mysqli_query($link,$query)) {
   

} else
{
	echo'ошибка в запросе -'.$query;
}

$second_write=2;  // минимум секунд выполнения запроса для записи для наблюдений

if($time_sql==1){ 
    $query_time = round(((microtime(true)-$start_time)),2);
	if($query_time>$second_write) 
	{ 
	    $today[0] = date("y.m.d"); $today[1] = date("H:i:s"); $date_=$today[0].' '.$today[1];		
		mysqli_query($link,'insert into time_sql  values ("'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'].'","'.htmlspecialchars(trim($ti_sql)).'","'.$query_time.'","'.$date_.'")');
	}
}
	 
return $result;

}

?>