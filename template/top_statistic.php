
    














<?
?>





<div class="menu-09  input-line" style="z-index:150;">
<!--<div class="menu-09 no-fixed-mobile input-line" style="z-index:150;">-->
 <div class="menu-09-left">
     <a href="/" class="menu-09-global"></a><a onclick="history.back();" class="menu-09-prev"><i></i></a><span class="menu-09-pc-h">	 
	 <?
     if(($sign_admin==1)or($sign_level>1))
     {
         echo'<span>Статистика ваших менеджеров</span>';

     } else
     {
         echo'<span>Ваша статистика</span>';
     }

     /*
	 	if($sign_admin!=1)
	{
	  echo'<span>Ваша статистика</span>';
		} else
		{
		echo'<span>Статистика ваших менеджеров</span>';	
		}
     */
?>
     </span>
     

 </div>
 <div class="menu-09-right"><div class="fix-mobile-one">
 <?
	 
	 	 include_once $url_system.'module/notification.php';

	 	 echo'</div>';
 if (($role->permission('Туры','S'))or($sign_admin==1)) {

     echo '<div class="menu_jjs fix-mobile-two" style=""><div class="more_supply1 menu_click"><i>3</i></div><div class="menu_supply menu_su1"><ul style="right: 10px; top: 10px; transform: scaleY(0);" class="drops no_active" data_src="0">

<li class="js-menu-jjs-b"><a  href="javascript:void(0);" rel="1">Выбрать все</a></li>
<li class="no-more-number js-menu-jjs-b"><a  href="javascript:void(0);" rel="2">Отменить выделение</a></li>
<li class="no-more-number js-menu-jjs-b"><a  href="javascript:void(0);" rel="3">На проверке</a></li>
<li class="no-more-number js-menu-jjs-b"><a  href="javascript:void(0);" rel="4">К оплате</a></li>
<li class="no-more-number js-menu-jjs-b"><a  href="javascript:void(0);" rel="5">Оплачено</a></li>
</ul></div></div>';
 }
?>	

 	 	
</div></div>