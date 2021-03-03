
<?
	

?>





<div class="menu-09  input-line" style="z-index:150;">
<!--<div class="menu-09 no-fixed-mobile input-line" style="z-index:150;">-->
 <div class="menu-09-left">
     <a href="/" class="menu-09-global"></a><a onclick="history.back();" class="menu-09-prev"><i></i></a>

     <?
     if(isset($_GET["id"]))
         {

             echo'<span class="menu-09-pc-h" ><span > Просмотр информации по туру №'.$_GET["id"].' </span ></span >';

         } else {
       echo'<span class="menu-09-pc-h" ><span > Оформленные туры </span ></span >';
	 }
	 ?>

 </div>
 <div class="menu-09-right tours-right-block">
 <?

$class_eye='tours-eas-open';
 if(cookie_work('eye_t_'.$id_user.'_1','1','.',60,'0')) {
     $class_eye='';
 }
 $class_eye1='tours-eas-open';
 if(cookie_work('eye_t_'.$id_user.'_2','1','.',60,'0')) {
     $class_eye1='';
 }
 echo'<div spp="1" class="tours-eas js-touroper-eye '.$class_eye.'">Расчеты с туроператором</div>';
 echo'<div spp="2" class="tours-eas js-commi-eye '.$class_eye1.'">Комиссия</div>';


	 	 include_once $url_system.'module/notification.php';

	 if (($role->permission('Туры','A'))or($sign_admin==1))
{

		echo'<a href="tours/add/" data-tooltip="добавить новый тур" class="add_invoice22 hide-mobile">добавить тур<i></i></a>';
	 }
	 
?>	
 	
<!--<div class="inline_reload js-reload-top"><a href="task/" class="show_reload ">Применить</a></div> -->
 	 	
</div></div>


<div class="mobile-bottom-z">
  <div class="mobile-new-2000">
	  <?
	 if (($role->permission('Туры','A'))or($sign_admin==1))
{
	       echo'<a href="tours/add/" class="client_1 client_100" data-tooltip="добавить новый тур">добавить тур</a>';
}
	  ?>
  </div>
</div>	
