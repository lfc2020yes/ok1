<?php
//узнаем все задачи на завтра, послезавтра, сегодня, просроченные
/*
task[0]
task[1]
	

task[..][0]   когда задача 
	0-сегодня
	1-завтра
	2-послезавтра
	3-просроченная
	
task[..][1]   что за задача
	1-просто задача
	2-общая задача
	3-день рождение
	4-вылет	
	5-прилет
6-вылет туры
7-прилет туры
8-срок оплаты
9-впечатление



task[..][2]   номер id задачи

task[..][3]   с кем связана задача 
	0-не с кем
	1-частник или потенциальный
	2-организация

task[..][4]	 имя связи (Сержик Анатолий...)
task[..][5]  текст задачи
task[..][6]	 время выполнения для 1-2-3 блока 12:00 для 4 блока (вчера)
task[..][7]  кто ответственный
	0 - никто
	1- имя того кто взялся
task[..][8]	 ты или нет взялся за задачу
	0 - не я
	1 - я взялся
task[..][9]	id booking
task[..][10] title booking	
task[..][11] шв с кем связана задача


task_day[0][..]  все id задачи на сегодня
task_day[1][..]  все id задачи на завтра
task_day[2][..]  все id задачи на послезавтра
task_day[3][..]  все id задачи просроченные
	*/
	
$url_system=$_SERVER['DOCUMENT_ROOT'].'/';
include_once $url_system.'module/ajax_access.php';
header("Content-type: application/json");

$status_ee='error';
$eshe=0;
$echo_m=0;
$echo='';
$vid=0;
$debug='';
$count_all_all=0;
$tk='';

$token=htmlspecialchars($_GET['tk']);
$id_dialog = isset($_GET['id_dialog']) ? $_GET['id_dialog'] : '';
//$id_dialog = htmlspecialchars($_GET['id_dialog']) ?? '';
//проверка что есть такой город что это число
//проверка что пользователь зарегистрирован
if(isset($_SESSION["user_id"]))
{ 
if(token_access_task($link,$token,'update_task_cloud',$id_user,5))
{
	$key_new='';
	$result_t=mysql_time_query($link,'Select a.task_key from r_user as a where a.id="'.htmlspecialchars(trim($id_user)).'"');
	$num_results_t = $result_t->num_rows;
if($num_results_t!=0)
{	
	$row_t = mysqli_fetch_assoc($result_t);
	$key_new=$row_t["task_key"];
}
	

		 //узнаем что обновилось
	
	$status_ee='ok';
	$task = array();
	$task_day=array(array());
	$kkey=0;
	
	$when = array("0", "1", "2", "3");	
	
	for ($p=0; $p<4; $p++)
{
		$date_end_plus3=date_step_sql('Y-m-d','+'.$p.'d');
		if($p<3)
		{
		$result_8 = mysql_time_query($link,'
select * from( 
(
select A.*,0 as flag from  task_new as A WHERE A.id_user_responsible="'.ht($id_user).'" and A.visible=1 and A.id_a_company="'.ht($id_company).'" and A.status=0 and  LOWER(A.ring_datetime) LIKE "'.$date_end_plus3.' %"
)
UNION
(
select A.*,1 as flag from  task_new as A WHERE A.id_user_responsible LIKE "'.$id_user.',%" and A.visible=1 and A.id_a_company="'.ht($id_company).'" and A.status=0 and  LOWER(A.ring_datetime) LIKE "'.$date_end_plus3.' %"
)
UNION
(
select A.*,1 as flag from  task_new as A WHERE A.id_user_responsible LIKE "%,'.$id_user.',%" and A.visible=1 and A.id_a_company="'.ht($id_company).'" and A.status=0 and  LOWER(A.ring_datetime) LIKE "'.$date_end_plus3.' %"
)
UNION
(
select A.*,1 as flag from  task_new as A WHERE A.id_user_responsible LIKE "%,'.$id_user.'" and A.visible=1 and A.id_a_company="'.ht($id_company).'" and A.status=0 and  LOWER(A.ring_datetime) LIKE "'.$date_end_plus3.' %"
)


) Z order by Z.reminder,Z.ring_datetime 

');
		} else{
			//теперь найдем данные для просроченных задач
					$result_8 = mysql_time_query($link,'
select * from( 
(
select A.*,0 as flag from  task_new as A WHERE A.id_user_responsible="'.ht($id_user).'" and A.visible=1 and A.id_a_company="'.ht($id_company).'" and A.reminder=0 and A.status=0 and  LOWER(A.ring_datetime)<"'.date("Y-m-d").' 00:00:00"
)
UNION
(
select A.*,1 as flag from  task_new as A WHERE A.id_user_responsible LIKE "'.$id_user.',%" and A.visible=1 and A.id_a_company="'.ht($id_company).'" and A.reminder=0 and A.status=0 and  LOWER(A.ring_datetime)<"'.date("Y-m-d").' 00:00:00"
)
UNION
(
select A.*,1 as flag from  task_new as A WHERE A.id_user_responsible LIKE "%,'.$id_user.',%" and A.visible=1 and A.id_a_company="'.ht($id_company).'" and A.reminder=0 and A.status=0 and  LOWER(A.ring_datetime)<"'.date("Y-m-d").' 00:00:00"
)
UNION
(
select A.*,1 as flag from  task_new as A WHERE A.id_user_responsible LIKE "%,'.$id_user.'" and A.visible=1 and A.id_a_company="'.ht($id_company).'" and A.reminder=0 and A.status=0 and LOWER(A.ring_datetime)<"'.date("Y-m-d").' 00:00:00"
)


) Z order by Z.ring_datetime desc 

');
		}

	
	
$num_8 = $result_8->num_rows;	
	$task_day[$p]=array();
if(($result_8)and($num_8>0))
{
	$id_bb=0;
	
  	 while($row_8 = mysqli_fetch_assoc($result_8)){
		 
		$task_day[$p][$id_bb]=$row_8["id"];  
		 $id_bb++;
		 
$task[$kkey][0]=$when[$p];
		 
		 
	$task[$kkey][1]=1;	 
		 
		 if($row_8["flag"]==1)
		 {
$task[$kkey][1]=2;
		 }
		 
		 
		 
		 
	
$task[$kkey][2]=$row_8["id"];


				  $id_user_ring='0';
				  $name_user_ring='';
		 $type_svyz=0;
		 
		 		   $task[$kkey][9]=0;
		   $task[$kkey][10]='';
		 
			switch($row_8["action"])
              {
					
			case "5":{
			//улетают
			$name_book='-';
			$result_ss = mysql_time_query($link,'SELECT A.title,A.id_client,B.fio,A.id FROM booking as A,k_clients as B WHERE A.id_client=B.id and A.id="'.ht($row_8["id_object"]).'" and A.visible=1');
        $num_ss = $result_ss->num_rows;	
        if($result_ss)
        {	
           $row_ss = mysqli_fetch_assoc($result_ss);
		   $task[$kkey][9]=$row_ss["id"];
		   $task[$kkey][10]=$row_ss["title"];
		   $id_user_ring=$row_ss["id_client"];
		   $name_user_ring=$row_ss["fio"];	
			$type_svyz=1;
			$task[$kkey][1]=4;
		}



			
			 
			 break;
		 }
                case "15":
                case "16":
                case "17":
                case "18":
                case "19":

                    {
//вылетают/прилетают новые туры
                    $name_book='-';

                    $result_uuy = mysql_time_query($link, 'select A.id,A.shopper,A.id_shopper,A.hotel,A.id_country,A.place_name,A.date_start,A.date_end,A.number_to from trips as A where A.id="'.ht($row_8["id_object"]).'"');
                    $num_results_uuy = $result_uuy->num_rows;

                    if ($num_results_uuy != 0) {
                        $row_uuy = mysqli_fetch_assoc($result_uuy);
                        $id_user_ring=$row_uuy["shopper"].'-'.$row_uuy["id_shopper"];


                        if($row_uuy["shopper"]==1) {
                            //частное лицо
                            $result_uus = mysql_time_query($link, 'select fio from k_clients where id="'.ht($row_uuy["id_shopper"]) . '"');
                        } else
                        {
                            //2 фирма
                            $result_uus = mysql_time_query($link, 'select name as fio from k_organization where id="'.ht($row_uuy["id_shopper"]) . '"');
                            $shopper = 1;  //фирма
                        }
                        $num_results_uus = $result_uus->num_rows;

                        if($num_results_uus!=0) {
                            $row_uus = mysqli_fetch_assoc($result_uus);
                            $name_user_ring=$row_uus["fio"];
                        }
                        $task[$kkey][9]=$row_8["id_object"];
                        $task[$kkey][10]=info_trips($row_8["id_object"],$link);
                        $type_svyz=1;

                        if($row_8["action"]==15)
                        {
                            $task[$kkey][1] = 6;
                        }
                        if($row_8["action"]==16)
                        {
                            $task[$kkey][1] = 7;
                        }
                            if($row_8["action"]==17)
                                {
                                    $task[$kkey][1] = 9;
                                }
                                if($row_8["action"]==18)
                                    {
                                        $task[$kkey][1] = 10;
                                    }
                        if($row_8["action"]==19)
                        {
                            $task[$kkey][1] = 8;
                        }
                                }



                    break;
                }

						  
			case "6":{
			//прилетают
			
			$result_ss = mysql_time_query($link,'SELECT A.title,A.id_client,B.fio,A.id FROM booking as A,k_clients as B WHERE A.id_client=B.id and A.id="'.ht($row_8["id_object"]).'" and A.visible=1');
        $num_ss = $result_ss->num_rows;	
        if($result_ss)
        {	
           $row_ss = mysqli_fetch_assoc($result_ss);
		   $id_user_ring=$row_ss["id_client"];
		   $name_user_ring=$row_ss["fio"];
		   $task[$kkey][9]=$row_ss["id"];
		   $task[$kkey][10]=$row_ss["title"];
			$type_svyz=1;
			$task[$kkey][1]=5;
		} 
			
				 
			 
			 
			 break;
		 }





						  
			case "7":{ 
   //день рождение
			 $result_ss = mysql_time_query($link,'SELECT A.fio,A.id FROM k_clients as A WHERE A.id="'.ht($row_8["id_object"]).'" and A.visible=1');
        $num_ss = $result_ss->num_rows;	
        if($result_ss)
        {	
           $row_ss = mysqli_fetch_assoc($result_ss);	
		   $id_user_ring=$row_ss["id"];
		   $name_user_ring=$row_ss["fio"];
			$type_svyz=1;
			$task[$kkey][1]=3;
		}
 
			 
			 
			 break;
		 }
				  
						  
		 case "9":{ 
			 //задача из подборок клиента
					$result_ss = mysql_time_query($link,'SELECT A.fio,A.id FROM k_clients as A,selection as B WHERE B.id="'.ht($row_8["id_object"]).'" and B.visible=1 and B.id_k_clients=A.id');
        $num_ss = $result_ss->num_rows;	
        if($result_ss)
        {	
           $row_ss = mysqli_fetch_assoc($result_ss);	
		   $id_user_ring=$row_ss["id"];
		   $name_user_ring=$row_ss["fio"];
			$type_svyz=1;
		}
			 
			 
			 break; 
                  }
		 case "10":{ 
			 //задача из общения с клиентом
					$result_ss = mysql_time_query($link,'SELECT A.fio,A.id FROM k_clients as A,k_clients_commun as B WHERE B.id="'.ht($row_8["id_object"]).'" and B.visible=1 and B.id_client=A.id');
        $num_ss = $result_ss->num_rows;	
        if($result_ss)
        {	
           $row_ss = mysqli_fetch_assoc($result_ss);	
		   $id_user_ring=$row_ss["id"];
		   $name_user_ring=$row_ss["fio"];
			$type_svyz=1;
		}
			 
			 
			 break; 
                  }	
		 case "11":{ 
			 //задача связанная просто с клиентом
					$result_ss = mysql_time_query($link,'SELECT A.fio,A.id FROM k_clients as A WHERE A.id="'.ht($row_8["id_object"]).'"');
        $num_ss = $result_ss->num_rows;	
        if($result_ss)
        {	
           $row_ss = mysqli_fetch_assoc($result_ss);	
		   $id_user_ring=$row_ss["id"];
		   $name_user_ring=$row_ss["fio"];
			$type_svyz=1;
		}
			 
			 
			 break; 
                  }	
		 case "12":{ 
			 //задача связанная просто с потенциальным клиентом
					$result_ss = mysql_time_query($link,'SELECT A.fio,A.id FROM k_clients as A WHERE A.id="'.ht($row_8["id_object"]).'"');
        $num_ss = $result_ss->num_rows;	
        if($result_ss)
        {	
           $row_ss = mysqli_fetch_assoc($result_ss);	
		   $id_user_ring=$row_ss["id"];
		   $name_user_ring=$row_ss["fio"];
			$type_svyz=1;
		}
			 
			 
			 break; 
                  }						  
		 case "13":{ 
			 //задача связанная просто с организацией
					$result_ss = mysql_time_query($link,'SELECT A.name,A.id FROM k_organization as A WHERE A.id="'.ht($row_8["id_object"]).'"');
        $num_ss = $result_ss->num_rows;	
        if($result_ss)
        {	
           $row_ss = mysqli_fetch_assoc($result_ss);	
		   $id_user_ring=$row_ss["id"] ?? '';
		   $name_user_ring=$row_ss["name"] ?? '';
			$type_svyz=2;
		}
			 
			 
			 break; 
                  }							  
			  }		 
		 
$task[$kkey][3]=$type_svyz;		 
$task[$kkey][4]=$name_user_ring;
$task[$kkey][11]=$id_user_ring;
		 
		 
$task[$kkey][5]=$row_8["comment"];
			if($p<3)
		{	 
	$rrd=explode(' ',$row_8["ring_datetime"]);	
				
$rrd1=explode(':',$rrd[1]);	 
		 
$task[$kkey][6]=$rrd1[0].':'.$rrd1[1];
			} else
			{
				$task[$kkey][6]=time_task_umatravel1($row_8["ring_datetime"]);
			}
		 if($row_8["myself"]!=0)
		 {
	$result_status22=mysql_time_query($link,'SELECT b.name_user,b.name_small FROM r_user AS b WHERE b.id="'.htmlspecialchars(trim($row_8["myself"])).'"');	
					 //echo('SELECT a.* FROM r_status AS a WHERE a.numer_status="'.$row1ss["status"].'" and a.id_system=13');
                if($result_status22->num_rows!=0)
                {  
                   $row_status22 = mysqli_fetch_assoc($result_status22);			 
                   $task[$kkey][7]=$row_status22["name_small"];		 					
				} else
				{
					 $task[$kkey][7]=0;	
				}
			 
		 } else
		 {
			 $task[$kkey][7]=0;	
		 }
		 
		 
		 if($row_8["myself"]==$id_user)
		 {
            $task[$kkey][8]=1;
		 } else
		 {
			$task[$kkey][8]=0;
		 }

		 
		 
		 
		 
		 
		 
		 $kkey++;
	
}
}	
}
	
	
 
}

		  } else
	  {
		  $status_ee='reg';
	  }


$aRes = array("status"   => $status_ee,"cloud" =>  $task,"cloud_day" =>  $task_day,"key"=>$key_new);
/*require_once $url_system.'Ajax/lib/Services_JSON.php';
$oJson = new Services_JSON();
//функция работает только с кодировкой UTF-8
echo $oJson->encode($aRes);
*/
echo json_encode($aRes);
?>