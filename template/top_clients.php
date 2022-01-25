
    














<?

$count_all_bi[0]=0;
$count_all_bi[1]=0;
$count_all_bi[2]=0;

    $hdmi='';
	if($sign_admin!=1)
	{
		$hdmi=' a.id_user="'.$id_user.'" and ';					
	}

				$result_all=mysql_time_query($link,'SELECT count(a.id) as koll FROM k_clients AS a WHERE '.$hdmi.' a.visible=1 and a.id_a_company IN ('.$id_company.') and a.potential=0');

	echo('SELECT count(a.id) as koll FROM k_clients AS a WHERE '.$hdmi.' a.visible=1 and a.id_a_company IN ('.$id_company.') and a.potential=0');
                if($result_all->num_rows!=0)
                {  
                   $row_all = mysqli_fetch_assoc($result_all);
				   $count_all_bi[0]=$row_all["koll"];					
				}
							
						

				$result_all=mysql_time_query($link,'SELECT count(a.id) as koll FROM k_organization AS a WHERE   '.$hdmi.' a.visible=1 and a.id_a_company IN ('.$id_company.')');

                if($result_all->num_rows!=0)
                {  
                  $row_all = mysqli_fetch_assoc($result_all);
				  $count_all_bi[1]=$row_all["koll"];
				}

				$result_all=mysql_time_query($link,'SELECT count(a.id) as koll FROM k_clients AS a WHERE '.$hdmi.' a.visible=1 and a.id_a_company IN ('.$id_company.') and ((a.potential=1)or(a.potential=2))');

                if($result_all->num_rows!=0)
                {  
                   $row_all = mysqli_fetch_assoc($result_all);
				   $count_all_bi[2]=$row_all["koll"];					
				}
						

?>





<div class="menu-09  input-line" style="z-index:150;">
<!--<div class="menu-09 no-fixed-mobile input-line" style="z-index:150;">-->
 <div class="menu-09-left client-menu-left">
     <a href="/" class="menu-09-global"></a><a onclick="history.back();" class="menu-09-prev"><i></i></a>
	 
<div class="menu_client_w_org">
   <div class="mm_w">
	   <ul class="tabs_hedi js-tabs-menuxx">
		  <?
		   
			
       $tabs_menu_x = array( "Туристы","Организации","Потенциальные туристы");
	   $tabs_menu_x_id = array("0","1","2");
	   $tabs_menu_x_link = array("","?tabs=1","?tabs=2");   
	   	
		   
	    for ($i=0; $i<count($tabs_menu_x); $i++)
             {   
			   if($i!=0)
			   {
			
			   if((isset($_GET['tabs']))and($_GET['tabs']==$tabs_menu_x_id[$i]))
			   {
				   echo'<a href="clients/'.$tabs_menu_x_link[$i].'" class="tabsss_orgg active" id="'.$tabs_menu_x_id[$i].'">'.$tabs_menu_x[$i].'<span  class="menu-09-count">'.$count_all_bi[$i].'</span> </a>';
			   } else
			   {
				  echo'<a href="clients/'.$tabs_menu_x_link[$i].'" class="tabsss_orgg" id="'.$tabs_menu_x_id[$i].'">'.$tabs_menu_x[$i].'<span  class="menu-09-count">'.$count_all_bi[$i].'</span></a>';
			   }
				   
			   } else
			   {
			   
			   if((!isset($_GET['tabs']))or($_GET['tabs']==$tabs_menu_x_id[$i]))
			   {
				   echo'<a href="clients/'.$tabs_menu_x_link[$i].'" class="tabsss_orgg active" id="'.$tabs_menu_x_id[$i].'">'.$tabs_menu_x[$i].'<span  class="menu-09-count">'.$count_all_bi[$i].'</span> </a>';
			   } else
			   {
				  echo'<a href="clients/'.$tabs_menu_x_link[$i].'" class="tabsss_orgg" id="'.$tabs_menu_x_id[$i].'">'.$tabs_menu_x[$i].'<span  class="menu-09-count">'.$count_all_bi[$i].'</span></a>';
			   }
				   
				   
			   }
			 
			 }
?>

	   </ul>
   </div>
</div>		 
	 

 </div>
 <div class="menu-09-right client-menu-right">
 <?
	 
	 	 include_once $url_system.'module/notification.php';

	 
	if(isset($_GET["tabs"]))
	{
		if($_GET["tabs"]==1)
		{
		
		echo'<a tabs_g="1" data-tooltip="добавить организацию" class="add_invoice22 js-add_new_client hide-mobile">Добавить организацию<i></i></a>'; 
		} else
		{
		echo'<a tabs_g="2" data-tooltip="добавить потенциального туриста" class="add_invoice22 js-add_new_client hide-mobile">добавить потенциального туриста<i></i></a>';			
		}
		
		
	} else
	{
		echo'<a tabs_g="0" data-tooltip="добавить клиента" class="add_invoice22 js-add_new_client hide-mobile">Добавить клиента<i></i></a>'; 		
	}
	 
?>	
 	
<!--<div class="inline_reload js-reload-top"><a href="task/" class="show_reload ">Применить</a></div> -->
 	 	
</div></div>


<div class="mobile-bottom-z">
  <div class="mobile-new-2000">
	  <?
	  	if(isset($_GET["tabs"]))
	    {
					if($_GET["tabs"]==1)
		{
		
	       echo'<a tabs_g="1" class="js-add_new_client client_1 client_100" data-tooltip="добавить клиента">добавить клиента</a>';	
					} else
					{
		       echo'<a tabs_g="2" class="js-add_new_client client_1 client_100" data-tooltip="добавить потенциального туриста">добавить потен. туриста</a>';						
					}
		
		} else
		{
	       echo'<a tabs_g="0" class="js-add_new_client client_1 client_100" data-tooltip="добавить клиента">добавить клиента</a>';				
		}
	  ?>
  </div>
</div>	
