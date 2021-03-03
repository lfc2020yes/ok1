<div class="mobile">
<div class="burger js-burger">
		<div class="burger__line-1 "></div>
		<div class="burger__line-2 "></div>
		<div class="burger__line-3 "></div>
</div></div>

<div class="mobile1 burger_ok">
<div class="burger js-burger">
		<div class="burger__line-1 "></div>
		<div class="burger__line-2 "></div>
		<div class="burger__line-3 "></div>
</div></div>
 <div class="mobile-nav">
<span></span>
 </div>

 
 <div class="logo_2000">
  <a class="logo" href=""></a>
 </div>
 
 <div class="left_menu menu_flex scrollbar-inner">

  <div class="menu_x inner-content scrollbar-dynamic">


<?
if(isset($_SESSION['user_id']))
{
$result_uu=mysql_time_query($link,'select a.*,b.name_role,b.role from r_user as a,r_role as b where b.id=a.id_role and a.id="'.id_key_crypt_encrypt(htmlspecialchars(trim($_SESSION['user_id']))).'"');
   $num_results_uu = $result_uu->num_rows;

   if($num_results_uu!=0)
   {                 
	$row_uu = mysqli_fetch_assoc($result_uu);
   }
}

echo'<div class="users">';
	  $filename=$url_system.'img/users/'.$row_uu["id"].'_100x100.jpg';
if (file_exists($filename)) {	  

echo'<div class="cover--1"><img src="img/users/'.$row_uu["id"].'_100x100.jpg?a='.$row_uu["img_xah"].'"></div>
<div class="users_rule" tas="'.$row_uu["task_key"].'" not="'.$row_uu["noti_key"].'">';
} else
{
//echo'<div class="users_rule" style="padding-left:22px;">';
	echo'<div class="cover--1"><img src="img/users/0_100x100.jpg"></div>
<div class="users_rule" tas="'.$row_uu["task_key"].'" not="'.$row_uu["noti_key"].'">';
}



echo'<i>'.$row_uu["name_role"].'</i>
<strong>'.$row_uu["name_user"].'</strong>';

?>
</div></div> 
<?

$nav_text=array("Задачи","Финансы","Заявки","Обращения","Туры","Клиенты","Туроператоры","Сотрудники","Отчеты","Договора","Статистика","Настройки");
$nav_url=array("task","finance","booking","preorders","tours","clients","touroperator","users","reports","contracts","statistic_new","settings");
$nav_plus=array("1","0","0","1","2","1","0","0","0","0","0","0");
$nav_url_a=array("","","","","tours/add/","","","","","","","");

/*
$nav_text=array("Задачи","Заявки","Клиенты","Туроператоры","Работники","Отчеты","Статистика");
$nav_url=array("task","booking","clients","touroperator","users","reports","statistic");
$nav_plus=array("1","0","1","0","0","0","0");
$nav_url_a=array("","","","","","","");
*/


$found = array_search($active_menu,$nav_url);

?>
<ul class="nav">
<li class="line" style="padding-top: 0px;"><div></div></li>
	
	
<?

//выводим кошелек только для менеджеров	для новых туров
//|
//V
if($active_menu!='statistic_new')
{


    //Получаем комиссию пользователя и его бонусы
    $month_s=$date_start=date("Y-m-").'01';

    //есть ли запись с такой коммиссией по этому пользователю за данный месяц
    if($sign_admin==1)
    {
        $result_status22=mysql_time_query($link,'SELECT sum(a.sum) as sum from users_commission_trips as a,r_user as b where a.id_users=b.id and b.id_company="'.ht($id_company).'" and  not(a.id_users=0) and a.date="'.$month_s.'"');
    } else {
        if($sign_level==3)
        {
            //директор
            $mass_ei=users_hierarchy($id_user,$link);
            rm_from_array($id_user,$mass_ei);
            $mass_ei= array_unique($mass_ei);
            if(count($mass_ei)!=0)
            {
                $io=0;
                $sql_su5=' AND (';

                foreach ($mass_ei as $key => $value)
                {
                    if($io==0) {

                        $sql_su5.='((a.id_users="'.$value.'"))';

                    } else
                    {
                        $sql_su5.='or((a.id_users="'.$value.'"))';
                    }
                    $io++;

                }
                $sql_su5.=' )';
            }

            $result_status22=mysql_time_query($link,'SELECT sum(a.sum) as sum from users_commission_trips as a where not(a.id_users=0) '.$sql_su5.' and  a.date="'.$month_s.'"');



        } else {
        $result_status22 = mysql_time_query($link, 'SELECT a.sum from users_commission_trips as a where a.id_users="' . $id_user . '" and a.date="' . $month_s . '"');
    }
    }
    if($result_status22->num_rows!=0)
    {
        $row_status22 = mysqli_fetch_assoc($result_status22);
        //echo("!!");
    } else
    {
        $row_status22["sum"]=0;
    }


    $bonus=0;

    if($sign_admin==1)
    {

        $result_status223=mysql_time_query($link,'SELECT a.* from users_commission_trips as a,r_user as b where a.id_users=b.id and b.id_company="'.ht($id_company).'" and not(a.id_users=0) and  a.date="'.$month_s.'"');
        $num223 = $result_status223->num_rows;
        if($result_status223->num_rows!=0)
        {
            for ($i=0; $i<$num223; $i++)
            {
                $row223 = mysqli_fetch_assoc($result_status223);
                $result_status_b=mysql_time_query($link,'SELECT a.* from users_commission_level as a where a.sum_start<="'.$row223["sum"].'" and a.sum_end>"'.$row223["sum"].'"  and a.dates="'.date("Y-m-").'01" and a.id_company="'.ht($id_company).'"');

                if($result_status_b->num_rows!=0)
                {
                    $row_status_b = mysqli_fetch_assoc($result_status_b);
                    if($row_status_b["level"]!=1)
                    {
                        $bonus=$bonus+(($row223["sum"]*$row_status_b["proc"])/100);
                    }
                }
            }
        }


    } else {

        if($sign_level==3)
        {
            //директор
            $mass_ei=users_hierarchy($id_user,$link);
            rm_from_array($id_user,$mass_ei);
            $mass_ei= array_unique($mass_ei);
            if(count($mass_ei)!=0)
            {
                $io=0;
                $sql_su5=' AND (';

                foreach ($mass_ei as $key => $value)
                {
                    if($io==0) {

                        $sql_su5.='((a.id_users="'.$value.'"))';

                    } else
                    {
                        $sql_su5.='or((a.id_users="'.$value.'"))';
                    }
                    $io++;

                }
                $sql_su5.=' )';
            }

            $result_status223=mysql_time_query($link,'SELECT a.* from users_commission_trips as a where not(a.id_users=0) '.$sql_su5.' and  a.date="'.$month_s.'"');
            $num223 = $result_status223->num_rows;
            if($result_status223->num_rows!=0)
            {
                for ($i=0; $i<$num223; $i++)
                {
                    $row223 = mysqli_fetch_assoc($result_status223);
                    $result_status_b=mysql_time_query($link,'SELECT a.* from users_commission_level as a where a.sum_start<="'.$row223["sum"].'" and a.sum_end>"'.$row223["sum"].'"  and a.dates="'.date("Y-m-").'01" and a.id_company="'.ht($id_company).'"');

                    if($result_status_b->num_rows!=0)
                    {
                        $row_status_b = mysqli_fetch_assoc($result_status_b);
                        if($row_status_b["level"]!=1)
                        {
                            $bonus=$bonus+(($row223["sum"]*$row_status_b["proc"])/100);
                        }
                    }
                }
            }


        } else {

        $result_status_b = mysql_time_query($link, 'SELECT a.* from users_commission_level as a where a.sum_start<="' . $row_status22["sum"] . '" and a.sum_end>"' . $row_status22["sum"] . '" and a.dates="'.date("Y-m-").'01" and a.id_company="'.ht($id_company).'"');

        if ($result_status_b->num_rows != 0) {
            $row_status_b = mysqli_fetch_assoc($result_status_b);
            if ($row_status_b["level"] != 1) {
                $bonus = ($row_status22["sum"] * $row_status_b["proc"]) / 100;
            }
        }
    }
    }


    ?>

    <li class="not_li_sel">
        <a href="statistic_new/" data-tooltip="Посмотреть статистику" class="a_wwal a11">
            <div class=" bill_wallet">
                <div class=" cell_small">
                    <?
                    if(($sign_admin==1)or($sign_level==3)) {
                        echo'<div class="text_wallet1 padd" ><span class="bill_str1" > →</span >Все комиссии</div >';
                    } else
                    {
                        echo'<div class="text_wallet1 padd" ><span class="bill_str1" > →</span >комиссия</div >';
                    }

                    $class_modey='';
                    if($row_status22["sum"]>100000)
                    {
                        $class_modey='money-small';
                    }


                    echo'<span class="pay_summ_bill1 '.$class_modey.'">'.rtrim(rtrim(number_format($row_status22["sum"], 2, '.', ' '),'0'),'.').'</span>';
                    ?>

                </div>
                <div class=" cell_big">
                    <?
                    if(($sign_admin==1)or($sign_level==3))
                    {
                        echo'<div class="text_wallet1 padd"><span class="bill_str1">→</span>К выплате</div>';
                    } else
                    {
                        echo'<div class="text_wallet1 padd"><span class="bill_str1">→</span>Бонусы</div>';

                    }

                    echo'<span class="pay_summ_bill1 '.$class_modey.'">'.rtrim(rtrim(number_format($bonus, 2, '.', ' '),'0'),'.').'</span>';
                    ?>
                </div></div>
        </a>
    </li>

    <li class="line"><div></div></li>
    <!--<li><a href="/">Главная</a></li>-->
    <?
}

//X
//|
//выводим кошелек только для менеджеров	для новых туров




//уведомления
		 $result_t=mysql_time_query($link,'Select count(a.id) as cc from r_notification as a where a.status=1 and a.id_user="'.htmlspecialchars(trim($id_user)).'"');
         $num_results_t = $result_t->num_rows;
	     if($num_results_t!=0)
	     {				 
			 $row_t = mysqli_fetch_assoc($result_t);
			 if($row_t["cc"]!=0)
			 {
			 
echo'<li class="not_li"><a class="a11" href="notification/"><span class="float-noti-2020">Уведомления</span><i>'.$row_t["cc"].'</i></a></li>';
			 } else
			 {
echo'<li class="not_li" style=""><a class="a11" href="notification/"><span class="float-noti-2020">Уведомления</span><i style="display:none;"></i></a></li>';				 
			 }
		 } else 
		 {
echo'<li class="not_li" style=""><a class="a11" href="notification/"><span class="float-noti-2020">Уведомления</span><i style="display:none;"></i></a></li>';			 
		 }

	
    foreach ($nav_url as $key_nav => $value_nav) 
	{
	  if (($role->permission($nav_text[$key_nav],'R'))or($sign_admin==1))
	  {
	      $obi='';
          $obi1='';
          $obi_left='';
          $obi_right='';
	    if($nav_url[$key_nav]=='preorders')
        {
            $obi_left='<span class="left--mm-pre">';
            $obi_right='</span>';
            $result_uu = mysql_time_query($link, 'select count(id) as cc from preorders where id_user="' . ht($id_user) . '" and id_company="'.ht($id_company).'" and visible=1 and not(status IN("5","6"))');
            $num_results_uu = $result_uu->num_rows;

            if ($num_results_uu != 0) {
                $row_uu = mysqli_fetch_assoc($result_uu);
                if( $row_uu["cc"]==0) {
                    $obi = '<i style="display: none;"></i>';
                } else
                {
                    $obi = '<i>'.$row_uu["cc"].'</i>';
                }
            }

            $mass_ei=users_hierarchy($id_user,$link);
            rm_from_array($id_user,$mass_ei);
            $mass_ei= array_unique($mass_ei);

            if(count($mass_ei)>0)
            {

                //значит чем-то управляет
                $result_uu = mysql_time_query($link, 'select count(id) as cc from preorders where id_user IN('.implode(",", $mass_ei).') and id_company="'.ht($id_company).'" and visible=1 and not(status IN("5","6"))');

                $num_results_uu = $result_uu->num_rows;

                if ($num_results_uu != 0) {
                    $row_uu = mysqli_fetch_assoc($result_uu);
                    if ($row_uu["cc"] != 0) {
                        $obi1 = '<i class="yui-jooo" data-tooltip="кол-во открытых обращений ваших сотрудников">' . $row_uu["cc"] . '</i>';
                    }
                }
            }


        }


          if($nav_url[$key_nav]=='clients')
          {

                          $obi1 = '<i class="yui-jooo-sr js-search-global-page"  data-tooltip="Поиск клиента"></i>';
              $obi_left='<span class="left--mm-pre">';
              $obi_right='</span>';

          }


		if($found===$key_nav)
		{
		echo'<li class="actives"><a class="a11" href="'.$value_nav.'/">'.$obi_left.$nav_text[$key_nav].$obi_right.$obi.' '.$obi1.'</a>';
			
			if($nav_plus[$key_nav]==1)
			{
				echo'<div tabs_g="0" data-tooltip="добавить" class="add-menu-left js-'.$value_nav.'-add0"></div>';
			}
			if($nav_plus[$key_nav]==2)
			{
				echo'<a tabs_g="0" data-tooltip="добавить" href="'.$nav_url_a[$key_nav].'" class="add-menu-left js-'.$value_nav.'-add0"></a>';
			}
			
			
			echo'</li>';	
		} else
		{
		echo'<li><a class="a11"  href="'.$value_nav.'/">'.$obi_left.$nav_text[$key_nav].$obi_right.$obi.$obi1.'</a>';
		
				if($nav_plus[$key_nav]==1)
			{
				echo'<div tabs_g="0" data-tooltip="добавить" class="add-menu-left js-'.$value_nav.'-add0"></div>';
			}
				if($nav_plus[$key_nav]==2)
			{
				echo'<a tabs_g="0" data-tooltip="добавить" href="'.$nav_url_a[$key_nav].'" class="add-menu-left js-'.$value_nav.'-add0"></a>';
			}
			
		echo'</li>';
		}
	  }
	}
?>
        <li class="line"><div></div></li>
          <li style="margin-bottom:30px;"><a class="a11" href="quit/">Выход</a></li>
 <?         
	
?>
</ul></div></div>