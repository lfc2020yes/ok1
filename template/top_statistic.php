
    














<?
?>





<div class="menu-09  input-line" style="z-index:150;">
<!--<div class="menu-09 no-fixed-mobile input-line" style="z-index:150;">-->
 <div class="menu-09-left">
     <a href="/" class="menu-09-global"></a><a onclick="history.back();" class="menu-09-prev"><i></i></a>



     <div class="menu_client_w_org">
         <div class="mm_w">
             <ul class="tabs_hedi js-tabs-menuxx">
                 <?
                 $mass_ei = array();
                 $mass_ei=users_hierarchy($id_user,$link);
                 rm_from_array($id_user,$mass_ei);
                 $mass_ei= array_unique($mass_ei);

                 //print_r($mass_ei);

                 if(count($mass_ei)>0) {

                     $tabs_menu_x = array("Общая статистика", "Статистика по неделям");
                     $tabs_menu_x_id = array("0", "1");
                     $tabs_menu_x_link = array("", ".tabs-1");
                     $tabs_menu_x_class = array("", "click-history-pre");

                 } else
                 {
                     $tabs_menu_x = array("Ваша статистика");
                     $tabs_menu_x_id = array("0");
                     $tabs_menu_x_link = array("");

                 }


                 for ($i=0; $i<count($tabs_menu_x); $i++)
                 {
                     if($i!=0)
                     {

                         if((isset($_GET['tabs']))and($_GET['tabs']==$tabs_menu_x_id[$i]))
                         {
                             echo'<a href="statistic_new/'.$tabs_menu_x_link[$i].'" class="tabsss_orgg active '.$tabs_menu_x_class[$i].'" id="'.$tabs_menu_x_id[$i].'">'.$tabs_menu_x[$i].' </a>';
                         } else
                         {
                             echo'<a href="statistic_new/'.$tabs_menu_x_link[$i].'" class="tabsss_orgg '.$tabs_menu_x_class[$i].'" id="'.$tabs_menu_x_id[$i].'">'.$tabs_menu_x[$i].'</a>';
                         }

                     } else
                     {

                         if((!isset($_GET['tabs']))or($_GET['tabs']==$tabs_menu_x_id[$i]))
                         {
                             echo'<a href="statistic_new/'.$tabs_menu_x_link[$i].'" class="tabsss_orgg active '.$tabs_menu_x_class[$i].'" id="'.$tabs_menu_x_id[$i].'">'.$tabs_menu_x[$i].'</a>';
                         } else
                         {
                             echo'<a href="statistic_new/'.$tabs_menu_x_link[$i].'" class="tabsss_orgg '.$tabs_menu_x_class[$i].'" id="'.$tabs_menu_x_id[$i].'">'.$tabs_menu_x[$i].'</a>';
                         }


                     }

                 }
                 ?>

             </ul>
         </div>
     </div>

 </div>
 <div class="menu-09-right"><div class="fix-mobile-one">
 <?
	 
	 	 include_once $url_system.'module/notification.php';

	 	 echo'</div>';
 if((!isset($_GET['tabs']))) {
     if (($role->permission('Туры', 'S')) or ($sign_admin == 1)) {

         echo '<div class="menu_jjs fix-mobile-two" style=""><div class="more_supply1 menu_click"><i>3</i></div><div class="menu_supply menu_su1"><ul style="right: 10px; top: 10px; transform: scaleY(0);" class="drops no_active" data_src="0">

<li class="js-menu-jjs-b"><a  href="javascript:void(0);" rel="1">Выбрать все</a></li>
<li class="no-more-number js-menu-jjs-b"><a  href="javascript:void(0);" rel="2">Отменить выделение</a></li>
<li class="no-more-number js-menu-jjs-b"><a  href="javascript:void(0);" rel="3">На проверке</a></li>
<li class="no-more-number js-menu-jjs-b"><a  href="javascript:void(0);" rel="4">К оплате</a></li>
<li class="no-more-number js-menu-jjs-b"><a  href="javascript:void(0);" rel="5">Оплачено</a></li>
</ul></div></div>';
     }
 }
?>	

 	 	
</div></div>