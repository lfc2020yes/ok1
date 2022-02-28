<div class="menu-09 input-line ">
 <div class="menu-09-left">
     <a href="/" class="menu-09-global"></a>
 </div>
 <div class="menu-09-right js-09">
<?
include_once $url_system.'module/notification.php';


if (($role->permission('Касса','A'))or($sign_admin==1))
{
    echo'<a href="cash/" class="search_client_fast" style="margin-left: 0px;"><span>Касса</span></a>';
}


 if (($role->permission('Клиенты','R'))or($sign_admin==1))
{	 
	 echo'<div class="search_client_fast js-search-global-page"><span>Поиск клиента</span></div>';
 }
	 
	 
 if (($role->permission('Клиенты','A'))or($sign_admin==1))
{

	 echo'<a data-tooltip="добавить клиента"
		tabs_g="0"  class="add_clients hide-mobile js-add_new_client">Добавить клиента</a>';
	 
 }
if (($role->permission('Туры','A'))or($sign_admin==1))
{

    echo'<a style="margin-left: 0px;" href="tours/add/" data-tooltip="добавить тур" class="add_invoice hide-mobile">Добавить тур<i></i></a>';

}
?>
	 
	 
</div>
</div>


<div class="mobile-bottom-z js-mobile-bottom-z">
  <div class="mobile-new-2000">



      <?
      if (($role->permission('Туры','A'))or($sign_admin==1))
      {
          echo'<a class="book_1" href="tours/add/" data-tooltip="добавить тур">добавить тур</a>';
      }

	   if (($role->permission('Клиенты','A'))or($sign_admin==1))
{
	echo'<a class="client_1 js-add_new_client" tabs_g="0" >добавить клиента</a>';		
	   }
	  ?>
  </div>
</div>	



