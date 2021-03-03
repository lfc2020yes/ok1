

<div class="menu-09  input-line" style="z-index:150;">
    <!--<div class="menu-09 no-fixed-mobile input-line" style="z-index:150;">-->
    <div class="menu-09-left">
        <a href="/" class="menu-09-global"></a><a onclick="history.back();" class="menu-09-prev"><i></i></a>

        <?

        echo'<span class="menu-09-pc-h" ><span >  Добавление нового сотрудника </span ></span >';

        ?>

    </div>
    <div class="menu-09-right tours-right-block">
        <?



        include_once $url_system.'module/notification.php';

        if ($role->permission('Сотрудники','A'))
        {
            // echo'<div class="save_button add_invoicess1"><i>Сохранить</i></div>';
            /*
                    if((isset($stack_error))and((count($stack_error)!=0)))
                    {
                    echo'<script type="text/javascript">
                $(function (){
                alert_message(\'error\',\'Ошибка! Не все поля заполнены\');
                });
            </script>';
                    }*/
            echo'<div class="menu-09-inline"><div data-tooltip="добавить сотрудника" class="menu-09-button yellow-09 js-add-users" style="margin-left: 0px; width: auto;"><span class="label--b">Добавить</span></div></div>';
        }

        ?>

        <!--<div class="inline_reload js-reload-top"><a href="task/" class="show_reload ">Применить</a></div> -->

    </div></div>





