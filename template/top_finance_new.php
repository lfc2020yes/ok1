
    














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

                 $mass_ei=users_hierarchy($id_user,$link);
                 rm_from_array($id_user,$mass_ei);
                 $mass_ei= array_unique($mass_ei);

                 if(count($mass_ei)>0) {

                     $tabs_menu_x = array("Финансовый учет", "План продаж");
                     $tabs_menu_x_id = array("0", "1");
                     $tabs_menu_x_link = array("", ".tabs-1");
                     $tabs_menu_x_class = array("", "click-history-pre");

                 } else
                 {
                     $tabs_menu_x = array("Финансовый учет");
                     $tabs_menu_x_id = array("0");
                     $tabs_menu_x_link = array("");

                 }


                 for ($i=0; $i<count($tabs_menu_x); $i++)
                 {
                     if($i!=0)
                     {

                         if((isset($_GET['tabs']))and($_GET['tabs']==$tabs_menu_x_id[$i]))
                         {
                             echo'<a href="finance/'.$tabs_menu_x_link[$i].'" class="tabsss_orgg active '.$tabs_menu_x_class[$i].'" id="'.$tabs_menu_x_id[$i].'">'.$tabs_menu_x[$i].' </a>';
                         } else
                         {
                             echo'<a href="finance/'.$tabs_menu_x_link[$i].'" class="tabsss_orgg '.$tabs_menu_x_class[$i].'" id="'.$tabs_menu_x_id[$i].'">'.$tabs_menu_x[$i].'</a>';
                         }

                     } else
                     {

                         if((!isset($_GET['tabs']))or($_GET['tabs']==$tabs_menu_x_id[$i]))
                         {
                             echo'<a href="finance/'.$tabs_menu_x_link[$i].'" class="tabsss_orgg active '.$tabs_menu_x_class[$i].'" id="'.$tabs_menu_x_id[$i].'">'.$tabs_menu_x[$i].'</a>';
                         } else
                         {
                             echo'<a href="finance/'.$tabs_menu_x_link[$i].'" class="tabsss_orgg '.$tabs_menu_x_class[$i].'" id="'.$tabs_menu_x_id[$i].'">'.$tabs_menu_x[$i].'</a>';
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

 if (($role->permission('Финансы','A'))or($sign_admin==1))
 {

     echo'<a data-tooltip="добавить операцию" class="add_invoice22 hide-mobile js-add-finance">добавить операцию<i></i></a>';
 }

	 	 echo'</div>';
?>	

 	 	
</div></div>

    <div class="mobile-bottom-z">
        <div class="mobile-new-2000">
            <?
            if (($role->permission('Сотрудники','A'))or($sign_admin==1))
            {
                echo'<a class=" client_1 client_100 js-add-finance" data-tooltip="добавить операцию">добавить операцию</a>';
            }
            ?>
        </div>
    </div>