<?php
//показать еще клиентов кнопка в выборе клиента
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
$token=htmlspecialchars($_GET['tk']);
$disco=0;
$id=htmlspecialchars($_GET['id']);
$query=mb_convert_case(htmlspecialchars($_GET['query']), MB_CASE_LOWER, "UTF-8");
$query_string='';
$dom=0;
$status_echo='';
//проверка что есть такой город что это число
//проверка что пользователь зарегистрирован

$echo_r=0; //выводить или нет ошибку 0 -нет
$debug='';

//**************************************************
	
if(!token_access_new($token,'bt_choice_client',$id,"s_form_xx"))
{
   $debug=h4a(100,$echo_r,$debug);
   goto end_code;
}	
//**************************************************
if ((!$role->permission('Клиенты','R'))and($sign_admin!=1))
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
if ((count($_GET) != 8))
{
	goto end_code;	
}	
	
/*

$result_t=mysql_time_query($link,'Select b.id from k_clients as b where b.id="'.htmlspecialchars(trim($_GET['id'])).'" and b.visible=1');
$num_results_t = $result_t->num_rows;
if($num_results_t==0)
{	
		$debug=h4a(5,$echo_r,$debug);
		goto end_code;
	
} else
{
	$row_score = mysqli_fetch_assoc($result_t);
}

*/

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

if($_GET['tabs']==4)
{
//частник+турист
    if((isset($_GET['query']))&&($_GET['query']!=''))
    {
        $result_8 = mysql_time_query($link,'

select * from(     
   (   
SELECT A.id,A.fio,A.date_birthday,A.id_user,A.phone FROM k_clients AS A where A.visible=1 and ((A.potential=0)or(A.potential=2)) and A.id_a_company="'.htmlspecialchars(trim($id_company)).'" AND LOWER(A.fio) LIKE "'.$query.'%"   
)
UNION
(

SELECT A.id,A.fio,A.date_birthday,A.id_user,A.phone FROM k_clients AS A where A.visible=1 and ((A.potential=0)or(A.potential=2)) and A.id_a_company="'.htmlspecialchars(trim($id_company)).'" AND LOWER(A.fio) LIKE "%'.$query.'%"
AND A.fio NOT IN 
(SELECT A.fio FROM k_clients A WHERE A.visible=1 and ((A.potential=0)or(A.potential=2)) and A.id_a_company="'.htmlspecialchars(trim($id_company)).'" AND LOWER(A.fio) LIKE "'.$query.'%")
) 
UNION
(
SELECT A.id,A.fio,A.date_birthday,A.id_user,A.phone FROM k_clients AS A where A.visible=1 and ((A.potential=0)or(A.potential=2)) and A.id_a_company="'.htmlspecialchars(trim($id_company)).'" AND LOWER(A.phone) LIKE "%'.$query.'%" 
AND A.fio NOT IN 
(SELECT A.fio FROM k_clients A WHERE A.visible=1 and ((A.potential=0)or(A.potential=2)) and A.id_a_company="'.htmlspecialchars(trim($id_company)).'" AND LOWER(A.fio) LIKE "'.$query.'%")
AND A.fio NOT IN 
(SELECT A.fio FROM k_clients A WHERE A.visible=1 and ((A.potential=0)or(A.potential=2)) and A.id_a_company="'.htmlspecialchars(trim($id_company)).'" AND LOWER(A.fio) LIKE "%'.$query.'%")
ORDER BY A.fio
) 

UNION
(
SELECT A.id,A.fio,A.date_birthday,A.id_user,A.phone FROM k_clients AS A where A.visible=1 and ((A.potential=0)or(A.potential=2)) and A.id_a_company="'.htmlspecialchars(trim($id_company)).'" AND A.code="'.$query.'" 
AND A.fio NOT IN (SELECT A.fio FROM k_clients A WHERE A.visible=1 and ((A.potential=0)or(A.potential=2)) and A.id_a_company="'.htmlspecialchars(trim($id_company)).'" AND LOWER(A.fio) LIKE "'.$query.'%") AND A.fio 
NOT IN (SELECT A.fio FROM k_clients A WHERE A.visible=1 and ((A.potential=0)or(A.potential=2)) and A.id_a_company="'.htmlspecialchars(trim($id_company)).'" AND LOWER(A.fio) LIKE "%'.$query.'%") AND A.fio 
NOT IN (SELECT A.fio FROM k_clients A WHERE A.visible=1 and ((A.potential=0)or(A.potential=2)) and A.id_a_company="'.htmlspecialchars(trim($id_company)).'" AND LOWER(A.phone) LIKE "%'.$query.'%")
ORDER BY A.fio
) 

) Z order by Z.fio limit '.htmlspecialchars(trim($_GET['pg']*$_GET['all'])).','.htmlspecialchars(trim($_GET['all'])));
    } else
    {
        $result_8 = mysql_time_query($link,'SELECT A.id,A.fio,A.date_birthday,A.id_user,A.phone  FROM k_clients AS A WHERE A.visible=1 and ((A.potential=0)or(A.potential=2)) and A.id_a_company="'.htmlspecialchars(trim($id_company)).'" order by A.fio limit '.htmlspecialchars(trim($_GET['pg']*$_GET['all'])).','.htmlspecialchars(trim($_GET['all'])));
    }
}


if($_GET['tabs']==1)
{
//частник
if((isset($_GET['query']))&&($_GET['query']!=''))
{
  $result_8 = mysql_time_query($link,'

select * from(     
   (   
SELECT A.id,A.fio,A.date_birthday,A.id_user,A.phone FROM k_clients AS A where A.visible=1 and A.potential=0 and A.id_a_company="'.htmlspecialchars(trim($id_company)).'" AND LOWER(A.fio) LIKE "'.$query.'%"   
)
UNION
(

SELECT A.id,A.fio,A.date_birthday,A.id_user,A.phone FROM k_clients AS A where A.visible=1 and A.potential=0 and A.id_a_company="'.htmlspecialchars(trim($id_company)).'" AND LOWER(A.fio) LIKE "%'.$query.'%"
AND A.fio NOT IN 
(SELECT A.fio FROM k_clients A WHERE A.visible=1 and A.potential=0 and A.id_a_company="'.htmlspecialchars(trim($id_company)).'" AND LOWER(A.fio) LIKE "'.$query.'%")
) 
UNION
(
SELECT A.id,A.fio,A.date_birthday,A.id_user,A.phone FROM k_clients AS A where A.visible=1 and A.potential=0 and A.id_a_company="'.htmlspecialchars(trim($id_company)).'" AND LOWER(A.phone) LIKE "%'.$query.'%" 
AND A.fio NOT IN 
(SELECT A.fio FROM k_clients A WHERE A.visible=1 and A.potential=0 and A.id_a_company="'.htmlspecialchars(trim($id_company)).'" AND LOWER(A.fio) LIKE "'.$query.'%")
AND A.fio NOT IN 
(SELECT A.fio FROM k_clients A WHERE A.visible=1 and A.potential=0 and A.id_a_company="'.htmlspecialchars(trim($id_company)).'" AND LOWER(A.fio) LIKE "%'.$query.'%")
ORDER BY A.fio
) 

UNION
(
SELECT A.id,A.fio,A.date_birthday,A.id_user,A.phone FROM k_clients AS A where A.visible=1 and A.potential=0 and A.id_a_company="'.htmlspecialchars(trim($id_company)).'" AND A.code="'.$query.'" 
AND A.fio NOT IN (SELECT A.fio FROM k_clients A WHERE A.visible=1 and A.potential=0 and A.id_a_company="'.htmlspecialchars(trim($id_company)).'" AND LOWER(A.fio) LIKE "'.$query.'%") AND A.fio 
NOT IN (SELECT A.fio FROM k_clients A WHERE A.visible=1 and A.potential=0 and A.id_a_company="'.htmlspecialchars(trim($id_company)).'" AND LOWER(A.fio) LIKE "%'.$query.'%") AND A.fio 
NOT IN (SELECT A.fio FROM k_clients A WHERE A.visible=1 and A.potential=0 and A.id_a_company="'.htmlspecialchars(trim($id_company)).'" AND LOWER(A.phone) LIKE "%'.$query.'%")
ORDER BY A.fio
) 

) Z order by Z.fio limit '.htmlspecialchars(trim($_GET['pg']*$_GET['all'])).','.htmlspecialchars(trim($_GET['all'])));  
} else
{
$result_8 = mysql_time_query($link,'SELECT A.id,A.fio,A.date_birthday,A.id_user,A.phone  FROM k_clients AS A WHERE A.visible=1 and A.potential=0 and A.id_a_company="'.htmlspecialchars(trim($id_company)).'" order by A.fio limit '.htmlspecialchars(trim($_GET['pg']*$_GET['all'])).','.htmlspecialchars(trim($_GET['all'])));
}
} 
if($_GET['tabs']==2)
{
//организация	
if((isset($_GET['query']))&&($_GET['query']!=''))
{
  $result_8 = mysql_time_query($link,'

select * from(     
(   
SELECT A.id,A.name,A.code_inn,A.id_user FROM k_organization AS A where A.visible=1 and A.id_a_company="'.htmlspecialchars(trim($id_company)).'" AND LOWER(A.name) LIKE "'.$query.'%"   
)
UNION
(
SELECT A.id,A.name,A.code_inn,A.id_user FROM k_organization AS A where A.visible=1 and A.id_a_company="'.htmlspecialchars(trim($id_company)).'" AND LOWER(A.name) LIKE "%'.$query.'%"
AND A.name NOT IN 
(SELECT A.name FROM k_organization A WHERE A.visible=1 and A.id_a_company="'.htmlspecialchars(trim($id_company)).'" AND LOWER(A.name) LIKE "'.$query.'%")
) 
UNION
(
SELECT A.id,A.name,A.code_inn,A.id_user FROM k_organization AS A where A.visible=1 and A.id_a_company="'.htmlspecialchars(trim($id_company)).'" AND LOWER(A.code_inn) LIKE "'.$query.'%" 
AND A.name NOT IN 
(SELECT A.name FROM k_organization A WHERE A.visible=1 and A.id_a_company="'.htmlspecialchars(trim($id_company)).'" AND LOWER(A.name) LIKE "'.$query.'%")
AND A.name NOT IN 
(SELECT A.name FROM k_organization A WHERE A.visible=1 and A.id_a_company="'.htmlspecialchars(trim($id_company)).'" AND LOWER(A.name) LIKE "%'.$query.'%")
) 


) Z order by Z.name limit '.htmlspecialchars(trim($_GET['pg']*$_GET['all'])).','.htmlspecialchars(trim($_GET['all'])));  
}	else	
{	
$result_8 = mysql_time_query($link,'SELECT A.id,A.name,A.code_inn,A.id_user  FROM k_organization AS A WHERE A.visible=1 and A.id_a_company="'.htmlspecialchars(trim($id_company)).'" order by A.name limit '.htmlspecialchars(trim($_GET['pg']*$_GET['all'])).','.htmlspecialchars(trim($_GET['all'])));
}  

}

if($_GET['tabs']==3)
{
//потенциальный
if((isset($_GET['query']))&&($_GET['query']!=''))
{
  $result_8 = mysql_time_query($link,'

select * from(     
   (   
SELECT A.id,A.fio,A.date_birthday,A.id_user,A.phone FROM k_clients AS A where A.visible=1 and ((A.potential=1)or(A.potential=2)) and A.id_a_company="'.htmlspecialchars(trim($id_company)).'" AND LOWER(A.fio) LIKE "'.$query.'%"   
)
UNION
(

SELECT A.id,A.fio,A.date_birthday,A.id_user,A.phone FROM k_clients AS A where A.visible=1 and ((A.potential=1)or(A.potential=2)) and A.id_a_company="'.htmlspecialchars(trim($id_company)).'" AND LOWER(A.fio) LIKE "%'.$query.'%"
AND A.fio NOT IN 
(SELECT A.fio FROM k_clients A WHERE A.visible=1 and A.potential=1 and A.id_a_company="'.htmlspecialchars(trim($id_company)).'" AND LOWER(A.fio) LIKE "'.$query.'%")
) 
UNION
(
SELECT A.id,A.fio,A.date_birthday,A.id_user,A.phone FROM k_clients AS A where A.visible=1 and ((A.potential=1)or(A.potential=2)) and A.id_a_company="'.htmlspecialchars(trim($id_company)).'" AND LOWER(A.phone) LIKE "%'.$query.'%" 
AND A.fio NOT IN 
(SELECT A.fio FROM k_clients A WHERE A.visible=1 and ((A.potential=1)or(A.potential=2)) and A.id_a_company="'.htmlspecialchars(trim($id_company)).'" AND LOWER(A.fio) LIKE "'.$query.'%")
AND A.fio NOT IN 
(SELECT A.fio FROM k_clients A WHERE A.visible=1 and ((A.potential=1)or(A.potential=2)) and A.id_a_company="'.htmlspecialchars(trim($id_company)).'" AND LOWER(A.fio) LIKE "%'.$query.'%")
ORDER BY A.fio
) 

UNION
(
SELECT A.id,A.fio,A.date_birthday,A.id_user,A.phone FROM k_clients AS A where A.visible=1 and ((A.potential=1)or(A.potential=2)) and A.id_a_company="'.htmlspecialchars(trim($id_company)).'" AND A.code="'.$query.'" 
AND A.fio NOT IN (SELECT A.fio FROM k_clients A WHERE A.visible=1 and ((A.potential=1)or(A.potential=2)) and A.id_a_company="'.htmlspecialchars(trim($id_company)).'" AND LOWER(A.fio) LIKE "'.$query.'%") AND A.fio 
NOT IN (SELECT A.fio FROM k_clients A WHERE A.visible=1 and ((A.potential=1)or(A.potential=2)) and A.id_a_company="'.htmlspecialchars(trim($id_company)).'" AND LOWER(A.fio) LIKE "%'.$query.'%") AND A.fio 
NOT IN (SELECT A.fio FROM k_clients A WHERE A.visible=1 and ((A.potential=1)or(A.potential=2)) and A.id_a_company="'.htmlspecialchars(trim($id_company)).'" AND LOWER(A.phone) LIKE "%'.$query.'%")
ORDER BY A.fio
) 

) Z order by Z.fio limit '.htmlspecialchars(trim($_GET['pg']*$_GET['all'])).','.htmlspecialchars(trim($_GET['all'])));  
} else
{
$result_8 = mysql_time_query($link,'SELECT A.id,A.fio,A.date_birthday,A.id_user,A.phone  FROM k_clients AS A WHERE A.visible=1 and ((A.potential=1)or(A.potential=2)) and A.id_a_company="'.htmlspecialchars(trim($id_company)).'" order by A.fio limit '.htmlspecialchars(trim($_GET['pg']*$_GET['all'])).','.htmlspecialchars(trim($_GET['all'])));
}
} 

$pg=htmlspecialchars(trim($_GET['pg']+1));

$num_8 = $result_8->num_rows;	
if($result_8)
{	

  			  while($row_8 = mysqli_fetch_assoc($result_8)){

				 					 

						 
					  $query_string_xx='<div rel_notib="'.$row_8["id"].'" class="list_client_choice">';

if($_GET['tabs']==1)
{	
	

$query_string_xx.='<div class="h_cb"><span>'.$row_8["fio"].'</span>';
		
				  
$date_bb='';
	if($row_8["date_birthday"]!='0000-00-00')
	{

		$date_start1=explode("-",htmlspecialchars(trim($row_8["date_birthday"])));
				  
				   $startxr=$date_start1[2].'.'.$date_start1[1].'.'.$date_start1[0];
		$date_bb=$startxr;
	}
    if($row_8["phone"]!='') {
        $phone_format = '+7 (' . $row_8["phone"][0] . $row_8["phone"][1] . $row_8["phone"][2] . ') ' . $row_8["phone"][3] . $row_8["phone"][4] . $row_8["phone"][5] . '-' . $row_8["phone"][6] . $row_8["phone"][7] . '-' . $row_8["phone"][8] . $row_8["phone"][9];
    } else
    {
        $phone_format = 'Телефон не указан';
    }

    $query_string_xx.='<div class="date_cb" >'.$phone_format.' / '.$date_bb.'</div></div>';

} 
if($_GET['tabs']==2)				  
{
   $query_string_xx.='<div class="h_cb"><span>'.$row_8["name"].'</span>';		  
   $query_string_xx.='<div class="date_cb" >'.$row_8["code_inn"].'</div></div>';
}

if(($_GET['tabs']==3)or($_GET['tabs']==4))
{	
	

$query_string_xx.='<div class="h_cb"><span>'.$row_8["fio"].'</span>';

    if($row_8["phone"]!='') {
$phone_format='+7 ('.$row_8["phone"][0].$row_8["phone"][1].$row_8["phone"][2].') '.$row_8["phone"][3].$row_8["phone"][4].$row_8["phone"][5].'-'.$row_8["phone"][6].$row_8["phone"][7].'-'.$row_8["phone"][8].$row_8["phone"][9];
        } else
    {
        $phone_format = 'Телефон не указан';
    }
				  
$query_string_xx.='<div class="date_cb" >'.$phone_format.'</div></div>';
} 				  
	$result_status22=mysql_time_query($link,'SELECT b.name_user,b.name_small FROM r_user AS b WHERE b.id="'.htmlspecialchars(trim($row_8["id_user"])).'"');	
					 //echo('SELECT a.* FROM r_status AS a WHERE a.numer_status="'.$row1ss["status"].'" and a.id_system=13');
                if($result_status22->num_rows!=0)
                {  
                   $row_status22 = mysqli_fetch_assoc($result_status22);			  
$query_string_xx.='<div class="kto_clo">'.$row_status22['name_small'].'</div>';
				}
				  
		
			  
				  
				  
$query_string_xx.='';
				  
				  

			   

$query_string_xx.='</div>';
//$query_string_xx.='</div>';
				  
		  
				  

$query_string.=$query_string_xx;
								  
					 
				  
				  
				  
				  
				  
				  
			  }
	
$count_say=$pg*$_GET['all'];
	//выводить кнопку еще или нет
    if($_GET['tabs']==4)
    {
        if((isset($_GET['query']))&&($_GET['query']!=''))
        {
            $sql_gog2='select count(A.id) as cc from(     
   (   
SELECT A.id FROM k_clients AS A where A.visible=1 and ((A.potential=0)or(A.potential=2)) and A.id_a_company="'.htmlspecialchars(trim($id_company)).'" AND LOWER(A.fio) LIKE "'.$query.'%"   
)
UNION
(

SELECT A.id FROM k_clients AS A where A.visible=1 and ((A.potential=0)or(A.potential=2)) and A.id_a_company="'.htmlspecialchars(trim($id_company)).'" AND LOWER(A.fio) LIKE "%'.$query.'%"
AND A.fio NOT IN 
(SELECT A.fio FROM k_clients A WHERE A.visible=1 and ((A.potential=0)or(A.potential=2)) and A.id_a_company="'.htmlspecialchars(trim($id_company)).'" AND LOWER(A.fio) LIKE "'.$query.'%")
) 
UNION
(
SELECT A.id FROM k_clients AS A where A.visible=1 and ((A.potential=0)or(A.potential=2)) and A.id_a_company="'.htmlspecialchars(trim($id_company)).'" AND LOWER(A.phone) LIKE "%'.$query.'%" 
AND A.fio NOT IN 
(SELECT A.fio FROM k_clients A WHERE A.visible=1 and ((A.potential=0)or(A.potential=2)) and A.id_a_company="'.htmlspecialchars(trim($id_company)).'" AND LOWER(A.fio) LIKE "'.$query.'%")
AND A.fio NOT IN 
(SELECT A.fio FROM k_clients A WHERE A.visible=1 and ((A.potential=0)or(A.potential=2)) and A.id_a_company="'.htmlspecialchars(trim($id_company)).'" AND LOWER(A.fio) LIKE "%'.$query.'%")
) 

UNION
(
SELECT A.id FROM k_clients AS A where A.visible=1 and ((A.potential=0)or(A.potential=2)) and A.id_a_company="'.htmlspecialchars(trim($id_company)).'" AND A.code="'.$query.'" 
AND A.fio NOT IN (SELECT A.fio FROM k_clients A WHERE A.visible=1 and ((A.potential=0)or(A.potential=2)) and A.id_a_company="'.htmlspecialchars(trim($id_company)).'" AND LOWER(A.fio) LIKE "'.$query.'%") AND A.fio 
NOT IN (SELECT A.fio FROM k_clients A WHERE A.visible=1 and ((A.potential=0)or(A.potential=2)) and A.id_a_company="'.htmlspecialchars(trim($id_company)).'" AND LOWER(A.fio) LIKE "%'.$query.'%") AND A.fio 
NOT IN (SELECT A.fio FROM k_clients A WHERE A.visible=1 and ((A.potential=0)or(A.potential=2))0 and A.id_a_company="'.htmlspecialchars(trim($id_company)).'" AND LOWER(A.phone) LIKE "%'.$query.'%")
) 

) A';
        } else
        {
            $sql_gog2='select count(A.id) as cc from k_clients as A where A.visible=1 and ((A.potential=0)or(A.potential=2)) and A.id_a_company="'.htmlspecialchars(trim($id_company)).'"';
        }
    }

    if($_GET['tabs']==1)
{
if((isset($_GET['query']))&&($_GET['query']!=''))
{
	$sql_gog2='select count(A.id) as cc from(     
   (   
SELECT A.id FROM k_clients AS A where A.visible=1 and A.potential=0 and A.id_a_company="'.htmlspecialchars(trim($id_company)).'" AND LOWER(A.fio) LIKE "'.$query.'%"   
)
UNION
(

SELECT A.id FROM k_clients AS A where A.visible=1 and A.potential=0 and A.id_a_company="'.htmlspecialchars(trim($id_company)).'" AND LOWER(A.fio) LIKE "%'.$query.'%"
AND A.fio NOT IN 
(SELECT A.fio FROM k_clients A WHERE A.visible=1 and A.potential=0 and A.id_a_company="'.htmlspecialchars(trim($id_company)).'" AND LOWER(A.fio) LIKE "'.$query.'%")
) 
UNION
(
SELECT A.id FROM k_clients AS A where A.visible=1 and A.potential=0 and A.id_a_company="'.htmlspecialchars(trim($id_company)).'" AND LOWER(A.phone) LIKE "%'.$query.'%" 
AND A.fio NOT IN 
(SELECT A.fio FROM k_clients A WHERE A.visible=1 and A.potential=0 and A.id_a_company="'.htmlspecialchars(trim($id_company)).'" AND LOWER(A.fio) LIKE "'.$query.'%")
AND A.fio NOT IN 
(SELECT A.fio FROM k_clients A WHERE A.visible=1 and A.potential=0 and A.id_a_company="'.htmlspecialchars(trim($id_company)).'" AND LOWER(A.fio) LIKE "%'.$query.'%")
) 

UNION
(
SELECT A.id FROM k_clients AS A where A.visible=1 and A.potential=0 and A.id_a_company="'.htmlspecialchars(trim($id_company)).'" AND A.code="'.$query.'" 
AND A.fio NOT IN (SELECT A.fio FROM k_clients A WHERE A.visible=1 and A.potential=0 and A.id_a_company="'.htmlspecialchars(trim($id_company)).'" AND LOWER(A.fio) LIKE "'.$query.'%") AND A.fio 
NOT IN (SELECT A.fio FROM k_clients A WHERE A.visible=1 and A.potential=0 and A.id_a_company="'.htmlspecialchars(trim($id_company)).'" AND LOWER(A.fio) LIKE "%'.$query.'%") AND A.fio 
NOT IN (SELECT A.fio FROM k_clients A WHERE A.visible=1 and A.potential=0 and A.id_a_company="'.htmlspecialchars(trim($id_company)).'" AND LOWER(A.phone) LIKE "%'.$query.'%")
) 

) A';
} else
{	
	  $sql_gog2='select count(A.id) as cc from k_clients as A where A.visible=1 and A.potential=0 and A.id_a_company="'.htmlspecialchars(trim($id_company)).'"'; 
}
		} 
	if($_GET['tabs']==2)
		{
			//организация
if((isset($_GET['query']))&&($_GET['query']!=''))
{
	$sql_gog2='

select count(A.id) as cc from(     
(   
SELECT A.id FROM k_organization AS A where A.visible=1 and A.id_a_company="'.htmlspecialchars(trim($id_company)).'" AND LOWER(A.name) LIKE "'.$query.'%"   
)
UNION
(
SELECT A.id FROM k_organization AS A where A.visible=1 and A.id_a_company="'.htmlspecialchars(trim($id_company)).'" AND LOWER(A.name) LIKE "%'.$query.'%"
AND A.name NOT IN 
(SELECT A.name FROM k_organization A WHERE A.visible=1 and A.id_a_company="'.htmlspecialchars(trim($id_company)).'" AND LOWER(A.name) LIKE "'.$query.'%")
) 
UNION
(
SELECT A.id FROM k_organization AS A where A.visible=1 and A.id_a_company="'.htmlspecialchars(trim($id_company)).'" AND LOWER(A.code_inn) LIKE "'.$query.'%" 
AND A.name NOT IN 
(SELECT A.name FROM k_organization A WHERE A.visible=1 and A.id_a_company="'.htmlspecialchars(trim($id_company)).'" AND LOWER(A.name) LIKE "'.$query.'%")
AND A.name NOT IN 
(SELECT A.name FROM k_organization A WHERE A.visible=1 and A.id_a_company="'.htmlspecialchars(trim($id_company)).'" AND LOWER(A.name) LIKE "%'.$query.'%")
) 


) A';
} else
{	
	
		$sql_gog2='SELECT count(A.id) as cc  FROM k_organization AS A WHERE A.visible=1 and A.id_a_company="'.htmlspecialchars(trim($id_company)).'"';
	
}			
		}
	
		if($_GET['tabs']==3)
{
if((isset($_GET['query']))&&($_GET['query']!=''))
{
	$sql_gog2='select count(A.id) as cc from(     
   (   
SELECT A.id FROM k_clients AS A where A.visible=1 and ((A.potential=1)or(A.potential=2)) and A.id_a_company="'.htmlspecialchars(trim($id_company)).'" AND LOWER(A.fio) LIKE "'.$query.'%"   
)
UNION
(

SELECT A.id FROM k_clients AS A where A.visible=1 and ((A.potential=1)or(A.potential=2)) and A.id_a_company="'.htmlspecialchars(trim($id_company)).'" AND LOWER(A.fio) LIKE "%'.$query.'%"
AND A.fio NOT IN 
(SELECT A.fio FROM k_clients A WHERE A.visible=1 and ((A.potential=1)or(A.potential=2)) and A.id_a_company="'.htmlspecialchars(trim($id_company)).'" AND LOWER(A.fio) LIKE "'.$query.'%")
) 
UNION
(
SELECT A.id FROM k_clients AS A where A.visible=1 and ((A.potential=1)or(A.potential=2)) and A.id_a_company="'.htmlspecialchars(trim($id_company)).'" AND LOWER(A.phone) LIKE "%'.$query.'%" 
AND A.fio NOT IN 
(SELECT A.fio FROM k_clients A WHERE A.visible=1 and ((A.potential=1)or(A.potential=2)) and A.id_a_company="'.htmlspecialchars(trim($id_company)).'" AND LOWER(A.fio) LIKE "'.$query.'%")
AND A.fio NOT IN 
(SELECT A.fio FROM k_clients A WHERE A.visible=1 and ((A.potential=1)or(A.potential=2)) and A.id_a_company="'.htmlspecialchars(trim($id_company)).'" AND LOWER(A.fio) LIKE "%'.$query.'%")
) 

UNION
(
SELECT A.id FROM k_clients AS A where A.visible=1 and ((A.potential=1)or(A.potential=2)) and A.id_a_company="'.htmlspecialchars(trim($id_company)).'" AND A.code="'.$query.'" 
AND A.fio NOT IN (SELECT A.fio FROM k_clients A WHERE A.visible=1 and ((A.potential=1)or(A.potential=2)) and A.id_a_company="'.htmlspecialchars(trim($id_company)).'" AND LOWER(A.fio) LIKE "'.$query.'%") AND A.fio 
NOT IN (SELECT A.fio FROM k_clients A WHERE A.visible=1 and ((A.potential=1)or(A.potential=2)) and A.id_a_company="'.htmlspecialchars(trim($id_company)).'" AND LOWER(A.fio) LIKE "%'.$query.'%") AND A.fio 
NOT IN (SELECT A.fio FROM k_clients A WHERE A.visible=1 and ((A.potential=1)or(A.potential=2)) and A.id_a_company="'.htmlspecialchars(trim($id_company)).'" AND LOWER(A.phone) LIKE "%'.$query.'%")
) 

) A';
} else
{	
	  $sql_gog2='select count(A.id) as cc from k_clients as A where A.visible=1 and ((A.potential=1)or(A.potential=2)) and A.id_a_company="'.htmlspecialchars(trim($id_company)).'"';
}
		} 	
	
      $result_gog2=mysql_time_query($link,$sql_gog2);
      $num_results_gog2 =$result_gog2->num_rows;
      if($num_results_gog2!=0)
      { 
             $row_gog2 = mysqli_fetch_assoc($result_gog2);
		     if(($row_gog2["cc"]!=0)and($row_gog2["cc"]>$count_say))
			 {	
$eshe=1;
//$eshe_echo='<div class="cb_eshe" pg="'.$pg.'" start="0" all="'.$_GET['all'].'" ><span>показать еще</span></div>';				 
			 }
	  }		
	
	
}


$status_ee='ok';





	
end_code:

$aRes = array("debug"=>$debug,"status"   => $status_ee,"pg"   => $pg,"eshe" => $eshe,"echo"=>$query_string,"pg"=>$pg);
/*require_once $url_system.'Ajax/lib/Services_JSON.php';
$oJson = new Services_JSON();
//функция работает только с кодировкой UTF-8
echo $oJson->encode($aRes);
*/
echo json_encode($aRes);
?>