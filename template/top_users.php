
<?


?>





<div class="menu-09  input-line" style="z-index:150;">
    <!--<div class="menu-09 no-fixed-mobile input-line" style="z-index:150;">-->
    <div class="menu-09-left">
        <a href="/" class="menu-09-global"></a><a onclick="history.back();" class="menu-09-prev"><i></i></a>

        <?

            echo'<span class="menu-09-pc-h" ><span > Ваши сотрудники </span ></span >';

        ?>

    </div>
    <div class="menu-09-right tours-right-block">
        <?



        include_once $url_system.'module/notification.php';

        if (($role->permission('Сотрудники','A'))or($sign_admin==1))
        {

            echo'<a href="users/add/" data-tooltip="добавить сотрудника" class="add_invoice22 hide-mobile">добавить сотрудника<i></i></a>';
        }

        ?>

        <!--<div class="inline_reload js-reload-top"><a href="task/" class="show_reload ">Применить</a></div> -->

    </div></div>


<div class="mobile-bottom-z">
    <div class="mobile-new-2000">
        <?
        if (($role->permission('Сотрудники','A'))or($sign_admin==1))
        {
            echo'<a href="users/add/"  class=" client_1 client_100" data-tooltip="добавить сотрудника">добавить сотрудника</a>';
        }
        ?>
    </div>
</div>	
