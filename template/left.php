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

echo'<div class="users" >';
	  $filename=$url_system.'img/users/'.$row_uu["id"].'_100x100.jpg';
if (file_exists($filename)) {	  

echo'<div class="cover--1"><img src="img/users/'.$row_uu["id"].'_100x100.jpg?a='.$row_uu["img_xah"].'"></div>
<div id_hax="'.$id_user.'" class="users_rule" tas="'.$row_uu["task_key"].'" not="'.$row_uu["noti_key"].'">';
} else
{
//echo'<div class="users_rule" style="padding-left:22px;">';
	echo'<div class="cover--1"><img src="img/users/0_100x100.jpg"></div>
<div id_hax="'.$id_user.'" class="users_rule" tas="'.$row_uu["task_key"].'" not="'.$row_uu["noti_key"].'">';
}



echo'<i>'.$row_uu["name_role"].'</i>
<strong>'.$row_uu["name_user"].'</strong>';

?>
</div></div> 
<?
/*
$nav_text=array("Задачи","Финансы","Заявки","Обращения","Туры","Клиенты","Туроператоры","Сотрудники","Отчеты","Бухгалтерия","Договора","Статистика","Настройки");
$nav_url=array("task","finance","booking","preorders","tours","clients","touroperator","users","reports","accounting","contracts","statistic_new","settings");
$nav_plus=array("1","0","0","1","2","1","0","0","0","0","0","0","0");
$nav_url_a=array("","","","","tours/add/","","","","","","","","");
*/


$nav_text=array("Задачи","Финансы","Обращения","Туры","Клиенты","Туроператоры","Сотрудники","Отчеты","Бухгалтерия","Договора","Статистика","Партнеры","Комиссии","Промокоды","Настройки");
$nav_url=array("task","finance","preorders","tours","clients","touroperator","users","reports","accounting","contracts","statistic_new","affiliates","commission","promo","settings");
$nav_plus=array("1","0","1","2","1","0","0","0","0","0","0","0","0","0","0");
$nav_url_a=array("","","","tours/add/","","","","","","","","","","","");


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
    if(($more_city==1)and($row_uu["id_role"]!=7))
    {
    ?>
    <li class="not_li_sel" style="overflow: visible; padding: 0px 15px;">
        <?

        $su_5=0;

        if(( isset($_COOKIE["cc_town".$id_user]))and($_COOKIE["cc_town".$id_user]!='')and(is_numeric(trim($_COOKIE["cc_town".$id_user])))) {

            if (in_array($_COOKIE["cc_town" . $id_user], $mass_city)) {

                {
                    $su_5 = $_COOKIE["cc_town" . $id_user];
                }
            }
        }

        $os5 = array( "Все организации");
        $os_id5 = array("0");


        $result_work_zz=mysql_time_query($link,'Select a.name,a.id from a_company as a where a.id IN ('.$id_company_sql.')');
        $num_results_work_zz = $result_work_zz->num_rows;
        if($num_results_work_zz!=0)
        {

            for ($i=0; $i<$num_results_work_zz; $i++)
            {
                $row_work_zz = mysqli_fetch_assoc($result_work_zz);
                array_push($os5, $row_work_zz["name"]);
                array_push($os_id5, $row_work_zz["id"]);
            }
        }



        echo'<span class="city_ses"><div class="left_drop menu1_prime book_menu_sel js--sort gop_io '.$class_js_search.'" style="height: 31px; margin-top: 0px !important; z-index:'.$zindex.'"><div class="select eddd"><a style="font-size: 13px;
color: rgba(0,0,0,0.7);" class="slct" list_number="t6" data_src="'.$su_5.'">'.$os5[array_search($su_5, $os_id5)].'</a><ul class="drop">';
        //$os_id2[array_search($su_2, $os_id2)]
        $zindex--;

        for ($i=0; $i<count($os5); $i++)
        {
            //echo($su_5.'-'.$os_id5[$i].'<br>');
            if($su_5==$os_id5[$i])
            {
                echo'<li class="sel_active"><a href="javascript:void(0);"  rel="'.$os_id5[$i].'">'.$os5[$i].'</a></li>';
            } else
            {
                echo'<li><a href="javascript:void(0);"  rel="'.$os_id5[$i].'">'.$os5[$i].'</a></li>';
            }

        }
        echo'</ul><input type="hidden" '.$class_js_readonly.' name="city_oo" id="city_oo" value="'.$su_5.'"></div></div></span>';



        ?>


<?
    }

/*
    //выводим кошелек для партнеров
    if(($row_uu["id_role"]==7))
    {

        $result_uu_aff = mysql_time_query($link, 'select all_comission,paid_comission,block_comission from affiliates where id_users="' . ht($row_uu["id"]) . '"');
        $num_results_uu_aff = $result_uu_aff->num_rows;

        if ($num_results_uu_aff != 0) {
            $row_uu_aff = mysqli_fetch_assoc($result_uu_aff);
        }

        ?>

    <li class="not_li_sel">
        <a class="a_wwal a11">
            <div class=" bill_wallet bill_wallet_affiliates">
                <div class=" cell_small">
                    <?

                        echo'<div class="text_wallet1 padd" ><span class="bill_str1" > →</span >Бонусы</div >';




                    echo'<span class="pay_summ_bill1 '.$class_modey.'">'.rtrim(rtrim(number_format(($row_uu_aff["all_comission"]-$row_uu_aff["paid_comission"]), 2, '.', ' '),'0'),'.').'</span>';
                    ?>

                </div>
                <div class=" cell_big cell_big_affiliates">
                    <?

                        echo'<div class="text_wallet1 padd"><span class="bill_str1">→</span>К выплате</div>';


                    echo'<span class="pay_summ_bill1 '.$class_modey.'">'.rtrim(rtrim(number_format(($row_uu_aff["all_comission"]-$row_uu_aff["paid_comission"]-$row_uu_aff["block_comission"]), 2, '.', ' '),'0'),'.');

                    echo'</span>';





                    ?>
                </div></div>
        </a>
    </li>

    <li class="line"><div></div></li>
    <!--<li><a href="/">Главная</a></li>-->
<?

    }
*/

//выводим кошелек только для менеджеров	для новых туров
//|
//V
if(($active_menu!='statistic_new')and($row_uu["id_role"]!=7))
{


    //Получаем комиссию пользователя и его бонусы
    $month_s=$date_start=date("Y-m-").'01';

    //есть ли запись с такой коммиссией по этому пользователю за данный месяц
    if($sign_admin==1)
    {

        //управляющий организацией - вообще все коммиссии всех
        $result_status22=mysql_time_query($link,'SELECT sum(a.sum) as sum,sum(a.sum_fix) as sum_fix,sum(a.sum_com) as sum_com from users_commission_trips as a,r_user as b where a.id_users=b.id and b.id_company IN ('.ht($id_company).') and  not(a.id_users=0) and a.date="'.$month_s.'"');
    } else {

        if($sign_level==3)
        {
            //директор,Документовед и все комиссии подчиненных
            //он сам не может делать туры
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

            $result_status22=mysql_time_query($link,'SELECT sum(a.sum) as sum,sum(a.sum_fix) as sum_fix,sum(a.sum_com) as sum_com from users_commission_trips as a where not(a.id_users=0) '.$sql_su5.' and  a.date="'.$month_s.'"');

           // echo('SELECT sum(a.sum) as sum,sum(a.sum_fix) as sum_fix from users_commission_trips as a where not(a.id_users=0) '.$sql_su5.' and  a.date="'.$month_s.'"');

        } else {


            //для конкретного пользователя
        $result_status22 = mysql_time_query($link, 'SELECT a.sum,a.sum_fix,a.sum_com from users_commission_trips as a where a.id_users="' . $id_user . '" and a.date="' . $month_s . '"');
    }
    }
    if($result_status22->num_rows!=0)
    {
        $row_status22 = mysqli_fetch_assoc($result_status22);
        //echo("!!");
    } else
    {
        $row_status22["sum"]=0;
        $row_status22["sum_fix"]=0;
        $row_status22["sum_com"]=0;
    }


    $bonus=0;

    if($sign_admin==1)
    {
      //для управляющего у которого вообще все в подчинение


        $result_status223=mysql_time_query($link,'SELECT a.* from users_commission_trips as a,r_user as b where a.id_users=b.id and b.id_company IN ('.ht($id_company).') and not(a.id_users=0) and  a.date="'.$month_s.'"');
        $num223 = $result_status223->num_rows;
        if($result_status223->num_rows!=0)
        {
            for ($i=0; $i<$num223; $i++)
            {
                $row223 = mysqli_fetch_assoc($result_status223);


                //проверяем вдруг для этого менеджера свои level условия а не общие
                $result_status_b=mysql_time_query($link,'SELECT a.* from users_commission_level as a where a.id_users="'.$row223["id_users"].'" and a.sum_start<="'.$row223["sum"].'" and a.sum_end>"'.$row223["sum"].'"  and a.dates="'.date("Y-m-").'01" and a.id_company IN ('.ht($id_company).')');

                if($result_status_b->num_rows==0)
                {

                    $result_status_b=mysql_time_query($link,'SELECT a.* from users_commission_level as a where a.id_users=0 and a.sum_start<="'.$row223["sum"].'" and a.sum_end>"'.$row223["sum"].'"  and a.dates="'.date("Y-m-").'01" and a.id_company IN ('.ht($id_company).')');

                }


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
            //директор у которого могут быть не все в подчинение
            //директоров может быть много в каждом городе свой

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



                    $result_status_b = mysql_time_query($link, 'SELECT a.* from users_commission_level as a where a.id_users="'.$row223["id_users"].'" and a.sum_start<="' . $row223["sum"] . '" and a.sum_end>"' . $row223["sum"] . '"  and a.dates="' . date("Y-m-") . '01" and a.id_company IN (' . ht($id_company) . ')');

                    if($result_status_b->num_rows==0) {


                        $result_status_b = mysql_time_query($link, 'SELECT a.* from users_commission_level as a where a.id_users=0 and a.sum_start<="' . $row223["sum"] . '" and a.sum_end>"' . $row223["sum"] . '"  and a.dates="' . date("Y-m-") . '01" and a.id_company IN (' . ht($id_company) . ')');

                    }

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
//это просто менеджер который видет только сколько ему выплата должна быть


            $result_status_b = mysql_time_query($link, 'SELECT a.* from users_commission_level as a where a.id_users="'.$id_user.'" and a.sum_start<="' . $row_status22["sum"] . '" and a.sum_end>"' . $row_status22["sum"] . '" and a.dates="' . date("Y-m-") . '01" and a.id_company IN (' . ht($id_company) . ')');

            if($result_status_b->num_rows==0) {

                $result_status_b = mysql_time_query($link, 'SELECT a.* from users_commission_level as a where a.id_users=0 and a.sum_start<="' . $row_status22["sum"] . '" and a.sum_end>"' . $row_status22["sum"] . '" and a.dates="' . date("Y-m-") . '01" and a.id_company IN (' . ht($id_company) . ')');


            }


        if ($result_status_b->num_rows != 0) {
            $row_status_b = mysqli_fetch_assoc($result_status_b);
            if ($row_status_b["level"] != 1) {
                $bonus = ($row_status22["sum"] * $row_status_b["proc"]) / 100;
            }
        }
    }
    }


    ?>

    <li class="not_li_sel" style="padding-left:15px;padding-right:15px;">
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

                    if(($sign_level==3)or($sign_level==4)) {
                        //генеральный директор + директор + Документовед
                        //видят где все бонусы + комиссии туров которые они дали с фиксированной оплатой
                        //чтобы видеть общую ситуацию


                        echo '<span class="pay_summ_bill1 ' . $class_modey . '">' . rtrim(rtrim(number_format(($row_status22["sum"] + $row_status22["sum_com"]), 2, '.', ' '), '0'), '.') . '</span>';
                    } else
                    {
                        echo '<span class="pay_summ_bill1 ' . $class_modey . '">' . rtrim(rtrim(number_format(($row_status22["sum"]), 2, '.', ' '), '0'), '.') . '</span>';
                    }

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

                    echo'<span class="pay_summ_bill1 '.$class_modey.'">'.rtrim(rtrim(number_format(($bonus+$row_status22["sum_fix"]), 2, '.', ' '),'0'),'.').'</span>';
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
            $result_uu = mysql_time_query($link, 'select count(id) as cc from preorders where id_user="' . ht($id_user) . '" and id_company IN ('.ht($id_company).') and visible=1 and not(status IN("5","6"))');
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
                $result_uu = mysql_time_query($link, 'select count(id) as cc from preorders where id_user IN('.implode(",", $mass_ei).') and id_company IN ('.ht($id_company).') and visible=1 and not(status IN("5","6"))');

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