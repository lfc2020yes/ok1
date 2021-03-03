<?
$count_all_clients=0;
				$result_all=mysql_time_query($link,'SELECT count(a.id) as koll FROM booking AS a WHERE a.visible=1 and a.id_object in('.implode(',',$hie->obj).')');	

                if($result_all->num_rows!=0)
                {  
                   $row_all = mysqli_fetch_assoc($result_all);
				   $count_all_clients=$row_all["koll"];
				}

?>



<div class="menu-09  input-line" style="z-index:150;">
<!--<div class="menu-09 no-fixed-mobile input-line" style="z-index:150;">-->
 <div class="menu-09-left">
     <a href="/" class="menu-09-global"></a><a onclick="history.back();" class="menu-09-prev"><i></i></a><span class="menu-09-pc-h"><span>Заявки туристов</span>
     <span all="8" class="menu-09-count">(<? echo($count_all_clients); ?>)</span>     
     
     
     </span>
     

 </div>
 <div class="menu-09-right">
 <?
	 
	 	 include_once $url_system.'module/notification.php';

?>	
 	<a href="booking/add/" data-tooltip="добавить заявку" class="add_invoice22">Добавить заявку<i></i></a> 	
 	
<!--<div class="inline_reload js-reload-top"><a href="task/" class="show_reload ">Применить</a></div> -->
 	 	
</div></div>


<div class="mobile-bottom-z">

	<div class="add_booking_mm2"><a href="booking/add/" data-tooltip="добавить заявку">добавить заявку</a></div>	
	
</div>	

