<?
$menu_h2 = array("Ваши настройки", "Ваши данные в системе");

$menu_id_h2=1;
if ($role->permission('Настройки','U')) { $menu_id_h2=0; }

$flag_tov=0;

?>





<div class="menu-09  input-line" style="z-index:150;">
    <!--<div class="menu-09 no-fixed-mobile input-line" style="z-index:150;">-->
    <div class="menu-09-left">
        <a href="/" class="menu-09-global"></a><a onclick="history.back();" class="menu-09-prev"><i></i></a>

        <?

            echo'<span class="menu-09-pc-h" ><span >'.$menu_h2[$menu_id_h2].' </span ></span >';

        ?>

    </div>
    <div class="menu-09-right tours-right-block">
        <?


        include_once $url_system.'module/notification.php';

        if ($role->permission('Настройки','U'))
        {
            // echo'<div class="save_button add_invoicess1"><i>Сохранить</i></div>';

            if((isset($stack_error))and((count($stack_error)!=0)))
            {
                echo'<script type="text/javascript">
	$(function (){
	alert_message(\'error\',\'Ошибка! Не все поля заполнены\');
	});
</script>';
            }
            echo'<div class="menu-09-inline"><div data-tooltip="сохранить настройки" class="menu-09-button yellow-09 js-save-setting" style="margin-left: 0px; width: auto;"><span class="label--b">сохранить</span></div></div>';
        }

        ?>

        <!--<div class="inline_reload js-reload-top"><a href="task/" class="show_reload ">Применить</a></div> -->

    </div></div>

<!--
<div class="mobile-bottom-z">
    <div class="mobile-new-2000">
        <?
        if (($role->permission('Туры','A'))or($sign_admin==1))
        {
          //  echo'<a tabs_g="0" class="js-add_new_task client_1 client_100" data-tooltip="добавить новый тур">добавить тур</a>';
        }
        ?>
    </div>
</div>
-->
