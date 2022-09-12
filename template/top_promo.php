
<?


?>





<div class="menu-09  input-line" style="z-index:150;">
    <!--<div class="menu-09 no-fixed-mobile input-line" style="z-index:150;">-->
    <div class="menu-09-left">
        <a href="/" class="menu-09-global"></a><a onclick="history.back();" class="menu-09-prev"><i></i></a>

        <?
if($id_role!=7)
{
    echo '<span class="menu-09-pc-h" ><span > Промокоды партнеров </span ></span >';
} else {

    echo '<span class="menu-09-pc-h" ><span > Ваши промокоды </span ></span >';
}
        ?>

    </div>
    <div class="menu-09-right tours-right-block">
        <?



        include_once $url_system.'module/notification.php';

        if (($role->permission('Промокоды','A'))or($sign_admin==1))
        {
            echo'<a  data-tooltip="добавить промокод" class="add_invoice22 hide-mobile js-add-promocod">добавить промокод<i></i></a>';
        }

        ?>

        <!--<div class="inline_reload js-reload-top"><a href="task/" class="show_reload ">Применить</a></div> -->

    </div></div>

