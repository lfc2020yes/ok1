<div class="menu_top"><div class="menu1">
   <?  
    $id=0;	 
	$echo='';


	
	
	echo'<div rel_tabs="0" id="tabs2017"><ul class="tabs_hed">';
			foreach ($menu_b as $key => $val) {

			if($key==0)
			{
			$result_tcc=mysql_time_query($link,$menu_sql[$key]);	  
            $row__cc= mysqli_fetch_assoc($result_tcc);		
			$count_n=$row__cc["kol"];	
			} else
			{
			$count_n='';	
			}
				
	        if(($key==0)and(!isset($_GET[$var_get])))
			{
			 echo'<li class="tab active"><a id="'.$key.'" href="message/'.$menu_url[$key].'" class="active">'.$menu_b[$key].'<i>'.$count_n.'</i></a></li>';
			 $title_key=$key;	
			} else
			{
				
				
			if($_GET[$var_get]==$menu_get[$key])	
			{			
			  echo'<li class="tab active"><a id="'.$key.'" href="message/'.$menu_url[$key].'" class="active">'.$menu_b[$key].'<i>'.$count_n.'</i></a></li>';

			  $title_key=$key;	
			} else
			{
			echo'<li class="tab"><a  id="'.$key.'" href="message/'.$menu_url[$key].'">'.$menu_b[$key].'<i>'.$count_n.'</i></a></li>'; 	
			}
			}
			
			}
	echo'<div class="slider"></div></ul></div>';


	//$url_system=$_SERVER['DOCUMENT_ROOT'].'/';
     include_once $url_system.'module/notification.php';
	
	
	
?>
<!--
<div class="noti_block">
	<div class="title_noti">	
	<ul class="t_ul">
	  <li>Уведомления</li>
	  <li><i><span>3</span></i></li>
	</ul>
	</div>
	<div class="scro">
	
	<div class="block" rel_noti=""><div class="bb"></div>
	<div class="users"><img src="img/users/4_100x100.jpg"></div>
	<div class="text"><strong>Муромцев Е.В.</strong> создал новый <strong>наряд №45</strong>, по объекту -  дом №43 (Волгоград, 9й квартал)</div>
	<div class="ui"><div class="font-rank del_notif" data-tooltip="Удалить" id_rel="2"><span class="font-rank-inner">x</span></div></div>
	</div>
	
	<div class="block"><div class="bb"></div>
	<div class="users"><img src="img/users/5_100x100.jpg"></div>
	<div class="text"><strong>Муромцев Е.В.</strong> создал новый <strong>наряд №45</strong>, по объекту -  дом №43 (Волгоград, 9й квартал)</div>
	<div class="ui"><div class="font-rank del_notif" data-tooltip="Удалить" id_rel="1"><span class="font-rank-inner">x</span></div></div>
	</div>

			
	
	</div>
</div>
-->


</div>

</div>