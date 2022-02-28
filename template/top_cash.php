
<?


?>





<div class="menu-09  input-line" style="z-index:150;">
    <!--<div class="menu-09 no-fixed-mobile input-line" style="z-index:150;">-->
    <div class="menu-09-left">
        <a href="/" class="menu-09-global"></a><a onclick="history.back();" class="menu-09-prev"><i></i></a>

        <?

            echo'<span class="menu-09-pc-h" ><span > Онлайн Касса </span ></span >';




                 $su_5=0;

                 if(( isset($_COOKIE["cc_office".$id_user]))and($_COOKIE["cc_office".$id_user]!='')and(is_numeric(trim($_COOKIE["cc_office".$id_user])))) {
                     if (in_array($_COOKIE["cc_office" . $id_user], $mass_office)) {
                         {
                             $su_5 = $_COOKIE["cc_office" . $id_user];
                         }
                     }
                 }

                 $os5 = array();
                 $os_id5 = array();


                 $result_work_zz=mysql_time_query($link,'Select * from a_company_office as a where a.id IN ('.$id_office_sql.')');
                 $num_results_work_zz = $result_work_zz->num_rows;
                 if($num_results_work_zz!=0)
                 {

                     for ($i=0; $i<$num_results_work_zz; $i++)
                     {
                         $row_work_zz = mysqli_fetch_assoc($result_work_zz);
                         array_push($os5, $row_work_zz["object_name"]);
                         array_push($os_id5, $row_work_zz["id"]);

                         if($su_5==0)
                         {
                             $su_5=$row_work_zz["id"];
                         }


                     }
                 }



                 echo'<span class="cash-office"><div class="left_drop menu1_prime book_menu_sel book_menu_sel_2 js--sort gop_io '.$class_js_search.'" style="height: 31px; margin-top: 0px !important; z-index:'.$zindex.'"><div class="select eddd"><a style="font-size: 13px; border-bottom: 2px solid #fd8080 !important;" class="slct" list_number="t6" data_src="'.$su_5.'">'.$os5[array_search($su_5, $os_id5)].'</a><ul class="drop">';
                 //$os_id2[array_search($su_2, $os_id2)]
                 $zindex--;

                 for ($i=0; $i<count($os5); $i++)
                 {
                     //echo($su_5.'-'.$os_id5[$i].'<br>');
                     if($su_5==$os_id5[$i])
                     {
                         echo'<li class="sel_active"><a href="javascript:void(0);"  rel="'.$os_id5[$i].'">'.$os5[$i].'</a></li>';
                     } else
                     {
                         echo'<li><a href="javascript:void(0);"  rel="'.$os_id5[$i].'">'.$os5[$i].'</a></li>';
                     }

                 }
                 echo'</ul><input type="hidden" '.$class_js_readonly.' name="office_oo" id="office_oo" value="'.$su_5.'"></div></div></span>';



                 ?>


        <?


        $result_uu = mysql_time_query($link, 'select cash_spot from a_company_office where id="'.ht($su_5).'"');
        $num_results_uu = $result_uu->num_rows;
        $cash=0.00;
        if ($num_results_uu != 0) {
            $row_uu = mysqli_fetch_assoc($result_uu);
            $cash=explode(".", ht($row_uu['cash_spot']));

        }

        ?>

    </div>
    <div class="menu-09-right tours-right-block">
        <?



        include_once $url_system.'module/notification.php';

        if (($role->permission('Касса','A'))or($sign_admin==1))
        {

           // echo'<a data-tooltip="добавить операцию" class="add_invoice22 hide-mobile js-add-finance">добавить операцию<i></i></a>';
            echo'<a data-tooltip="добавить операцию" tabs_g="0" class="add_clients hide-mobile js-add-cash add_cash" marked="1">Добавить операцию</a>';
        }

        ?>

        <!--<div class="inline_reload js-reload-top"><a href="task/" class="show_reload ">Применить</a></div> -->

    </div></div>


<div class="mobile-bottom-z">
    <div class="mobile-new-2000">
        <?
        if (($role->permission('Касса','A'))or($sign_admin==1))
        {
            echo'<a class=" client_1 client_100 js-add-cash" data-tooltip="добавить операцию">добавить операцию</a>';
        }
        ?>
    </div>
</div>	
