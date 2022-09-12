<?php
//форма добавления новой оплаты в финансах

$url_system=$_SERVER['DOCUMENT_ROOT'].'/';
include_once $url_system.'module/ajax_access.php';


//создание секрет для формы
/*
$secret=rand_string_string(4);
if(!isset($_SESSION['rema']))
{
    $_SESSION['rema'] = $secret;
} else
{
    $secret=$_SESSION['rema'];
}
*/


$status=0;


$class_bba='cost_bank1';

if((!isset($_SESSION["user_id"]))or(!is_numeric(id_key_crypt_encrypt($_SESSION["user_id"]))))
{
    goto end_code;
}

$id_user=id_key_crypt_encrypt($_SESSION["user_id"]);

//проверить есть ли переменная id и можно ли этому пользователю это делать
if (count($_GET) != 0)
{
    goto end_code;
}
$status_admin=0;


if ((!$role->permission('Промокоды','A'))and($sign_admin!=1))
{
    goto end_code;
}
//составление секретного ключа формы
//составление секретного ключа формы
//соль для данного действия
$token=token_access_compile($id_user,'bt_promo_add',$secret);
//составление секретного ключа формы
//составление секретного ключа формы
//составление секретного ключа формы







$status=1;



?>
<div id="Modal-one" class="box-modal table-modal eddd1 client_window"><div class="box-modal-pading">
        <div class="top_modal">



            <div class="box-modal_close arcticmodal-close"></div>
            <?
            echo'<h1 class="h111" mor="'.$token.'" for="'.htmlspecialchars(trim($id_user)).'"><span>Добавление нового промокода</span>

</h1>';
            ?>



        </div>
        <div class="center_modal">
            <?
            echo'<form class="js-form-promo-add" id="vino_xd_promo_add" style=" padding:0; margin:0;" method="post" enctype="multipart/form-data">';
            echo'<input type="hidden" value="'.htmlspecialchars(trim($id_user)).'" name="id">';
            echo'<input type="hidden" value="'.$token.'" name="tk">';
            echo'<input name="tk1" value="dsQ23RStsd2re" type="hidden">';
            //форма добавления задачи
            //форма добавления задачи


            $query_string='<div ><div class="add_sel_form add-new-olp" style="position:relative; margin-bottom: 0px; border:0px;">';


            $query_string.='<div class="pad10" style="padding: 0; z-index:100;"><span class="bookingBox_gr22"></span></div>';







            $query_string.='<div class="mobile-white" style="width:100%;"><div class="form_right_say_one " style="padding:0px; width:100%;">';







/*

            if(($more_city==1)and($_COOKIE["cc_town".$id_user]==0)) {




                ?>

                <?

                $os_say55 = array();
                $os_id_say55 = array();
                $su_say55=-1;

                $query_string.='<div style="margin-top: 30px;" >	';

                $query_string.='<div class="left_drop list_2018 menu1_prime"><label class="">Организация<span>*</span></label><div class="select eddd zin_2019"><a class="slct" list_number="t1" data_src=""></a><ul class="drop">';


                $result_8 = mysql_time_query($link,'Select a.name,a.id from a_company as a where a.id IN ('.$id_company_sql.')');

                $num_8 = $result_8->num_rows;
//$row_1 = mysqli_fetch_assoc($result2);
                if($result_8)
                {


                    while($row_8 = mysqli_fetch_assoc($result_8)){

                        if($su_say55==$row_8["id"])
                        {
                            $query_string.='<li class="sel_active"><a href="javascript:void(0);"  rel="'.$row_8["id"].'">'.$row_8["name"].'</a></li>';
                        } else
                        {
                            $query_string.='<li><a href="javascript:void(0);"  rel="'.$row_8["id"].'">'.$row_8["name"].'</a></li>';
                        }

                    }
                }



                $query_string.='</ul><input type="hidden" class="gloab "  name="org" id="pol_clients4554" value=""><div class="div_new_2018"><hr class="one"></div></div></div></div>';
                //echo $query_string;


                ?>

                <?







            } else
            {

                $result_uuyyt = mysql_time_query($link, 'select name from a_company where id="' . ht($id_company) . '"');
                $num_results_uuyyt = $result_uuyyt->num_rows;

                if ($num_results_uuyyt != 0) {
                    $row_uuyyt = mysqli_fetch_assoc($result_uuyyt);
                }


                $query_string.='<!--input start	-->	
        <div style="margin-top: 30px;" ><div class="input_2018"><label>Организация<span>*</span></label><input name="id_company_name" value="'.$row_uuyyt["name"].'" readonly id="date_124" class="input_new_2018 required    no_upperr" autocomplete="off" type="text"><input class="gloab gloab_potential gloab_turist" name="org" type="hidden" value="'.$id_company.'"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div>
<!--input end	-->	';

            }
*/







            $query_string.='<!--input start	-->		
	<div style="margin-top: 30px;" class="jj-l2"><div class="input_2018"><label>Название<span>*</span></label><input name="summ" value="" id="date_124" class="input_new_2018 required gloab gloab1  " autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name" joi=""></div></div></div>
</div>
<!--input end	-->';

            //$query_string.='<div class="add_say_two">';




            $query_string.='<div style="margin-top: 30px;">';

            $query_string.='<div class="div_textarea_otziv1 js-prs" >
			<div class="otziv_add">';


            $query_string.='<textarea cols="10" rows="1" placeholder="Комментарий" id="otziv_area_adaxx299" name="comment" class="di text_area_otziv no_comment_bill22 tyyo"></textarea>';

            $query_string.='</div>      
</div>  

        <script type="text/javascript"> 
	  $(function (){ 
$(\'#otziv_area_adaxx299\').autoResize({extraSpace : 10});
$(\'.tyyo\').trigger(\'keyup\');
});

	</script>
	</div>';


            $query_string.='</div>';

            //форма задачи
            if($status_admin==0)
            {
                $query_string.='<div class="center_vert right_task_ccb" style="width: 100%; margin-top:20px;"><div class="add_cff_fin js-add-buy-promo-add-x">Согласовать</div>';
            }


            $query_string.='<div class="task_cb_exit js-exit-window-add-task"  style="background-color: #eeefee;">


<div class="task_cb_head">
отменить
</div>
</div>';
            //$query_string.='</div> ';




            $query_string.='</div></div></div>';


            //форма добавления подборки
            //форма добавления подборки



















            echo $query_string;

            ?>
            </form>
            <?

            echo'<form id="js-form-add-fin" action="" method="POST" enctype="multipart/form-data"><input name="status" value="doc" type="hidden"></form>';

            ?>
        </div>



        <?

        //echo'<div id="no_rd" class="save_button add_say_cb" id_rel="'.$_GET["id"].'"><i>Добавить запись</i></div>';


        ?>

        <!--</div>-->

    </div></div>

<?





end_code:

if($status==0)
{
    //что то не так. Почему то бронировать нельзя
    header("HTTP/1.1 404 Not Found");
    header("Status: 404 Not Found");
    die ();
}
/*

						 $datetime1 = date_create('Y-m-d');
                         $datetime2 = date_create('2017-01-17');

                         $interval = date_create(date('Y-m-d'))->diff( $datetime2	);
                         $date_plus=$interval->days;
						 */
//echo(dateDiff_(date('Y-m-d'),'2017-01-17'));



?>
<script type="text/javascript">initializeTimer();</script>
<?
include_once $url_system.'template/form_js.php';
?>
<script type="text/javascript">


    $(document).ready(function(){
        Zindex();

        $('.money_mask1').inputmask("numeric", {
            radixPoint: ".",
            groupSeparator: " ",
            digits: 2,
            autoGroup: true,
            prefix: '', //No Space, this will truncate the first character
            rightAlign: false,
            oncleared: function () { self.Value(''); }
        });


        var id_tt=$('.js-tabs-menu').find('.active').attr('id');
        //alert(id_tt);
        $('.js-tabs_docc').hide();
        $('.js-tabs_'+id_tt).show();
        ToolTip();

        $(".slct").unbind('click.sys');
        $(".slct").bind('click.sys', slctclick);
        $(".drop").find("li").unbind('click');
        $(".drop").find("li").bind('click', dropli);
        $('#typesay').unbind('change', changesay);
        $('#typesay').bind('change', changesay);
        input_2018();

        $('.date_picker_x').inputmask("datetime",{
            mask: "1.2.y",
            placeholder: "dd.mm.yyyy",
            separator: ".",
            alias: "dd.mm.yyyy"
        });

        $(".slct").unbind('click.sys');
        $(".slct").bind('click.sys', slctclick);
        $(".drop").find("li").unbind('click');
        $(".drop").find("li").bind('click', dropli);

    });

    </script>