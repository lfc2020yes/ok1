<div class="menu-09 input-line">
    <div class="menu-09-left">
        <a href="/" class="menu-09-global"></a><a onclick="history.back();" class="menu-09-prev"><i></i></a><span class="menu-09-pc-h"><span>Новый тур</span></span>
    </div>
    <div class="menu-09-right js-09">
        <?
        include_once $url_system.'module/notification.php';
        if (($role->permission('Клиенты','R'))or($sign_admin==1))
        {
            echo'<div style="margin-right: 30px;" class="search_client_fast js-search-global-page"><span>Поиск клиента</span></div>';
        }
        ?>

    </div>
</div>