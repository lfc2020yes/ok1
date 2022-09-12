<?php
//добавить новую оплату/возврат по туру !!
$url_system=$_SERVER['DOCUMENT_ROOT'].'/';
include_once $url_system.'module/ajax_access.php';
header("Content-type: application/json");

$status_ee='error';
$eshe=0;
$echo='';
$vid=0;
$debug='';
$count_all_all=0;
$basket='';
$token=htmlspecialchars($_POST['tk']);
$disco=0;
$ID_N='';
$temp='';
$radio_potential='';
$dom='';

$id=ht($_POST["id"]);
$token=ht($_POST["tk"]);

$dom=0;
$status_echo='';
//проверка что есть такой город что это число
//проверка что пользователь зарегистрирован

$echo_r=1; //выводить или нет ошибку 0 -нет
$debug='';


//**************************************************
//2 дня
if(!token_access_new($token,'bt_promo_add',$id,"rema",2880))
{
    $debug=h4a(100,$echo_r,$debug);
    goto end_code;
}




/*
if ( count($_GET) != 4 )
{
$debug=h4a(1,$echo_r,$debug);
goto end_code;
}
*/
//**************************************************
if ((!$role->permission('Промокоды','A'))and($sign_admin!=1))
{
    $debug=h4a(2,$echo_r,$debug);
    goto end_code;
}
//**************************************************
if(!isset($_SESSION["user_id"]))
{
    $status_ee='reg';
    $debug=h4a(3,$echo_r,$debug);
    goto end_code;
}
//**************************************************
if(((!isset($_POST['tk1']))or(trim($_POST['tk1'])!='dsQ23RStsd2re')))
{
    $debug=h4a(77,$echo_r,$debug);
    goto end_code;
}



//**************************************************
//**************************************************
/*
id=&
tk=2021.4e0044a738d1c0d5b2be7fd066e6330f.Sm9pTmt6TThYNlByd3drVW1BNUhqUT09&tk1=dsQ23RStsd2re&
kto_komy=1&
type_fin=1&
summ=3+422&
vid_fin=8&
task%5Btask_date%5D=16+%D0%A1%D0%B5%D0%BD%D1%82%D1%8F%D0%B1%D1%80%D1%8F+2020&
buy_date=2020-09-16&
comment=
*/


$stack_error = array();  // общий массив ошибок

if ((!isset($_POST['summ'])) or (trim($_POST['summ']) == '')) {
    array_push($stack_error, "sum");
}


//**************************************************
//**************************************************



//print_r ($stack_error);
if(count($stack_error)!=0)
{
    goto end_code;
}

$status_ee='ok';

$date_end=date_step_sql('Y-m-d', '+1m');

$date1_=date("Y-m-d").' '.date("H:i:s");

$date_=$date_end.' '.date("H:i:s");
mysql_time_query($link, 'INSERT INTO affiliates_promo_code(id_users,name,comment,visible,status,date_end,date_create) VALUES( 
"' . ht($id_user) . '","' . ht($_POST['summ']) . '","' . ht($_POST['comment']) . '","1","1","'.$date_.'","'.$date1_.'")');


$new_id_payment=mysqli_insert_id($link);




$text_not = 'Добавлен новый промокод <a href="/promo/">'.$_POST['summ'].'</a>. Партнер - '.$name_user;

$user_send_new= array();
$user_send_new=array_merge(UserNotNumber(18,$link));

rm_from_array(0,$user_send_new);
rm_from_array($id_user,$user_send_new);
$user_send_new= array_unique($user_send_new);


$mass_ei = all_chief($id_user, $link);
rm_from_array($id_user, $mass_ei);
$mass_ei = array_unique($mass_ei);

$end_mass=exception_role($user_send_new,$mass_ei);



$result_de = mysql_time_query($link, 'select * from affiliates_promo_code where id_users="' . ht($id_user) . '" and visible=1  and id="'.$new_id_payment.'"');
$num_results_de = $result_de->num_rows;

if ($result_de) {
    while ($row_de = mysqli_fetch_assoc($result_de)) {

        $date_mass = explode(" ", ht($row_de['date_end']));
        $date_mass1 = explode("-", ht($date_mass[0]));
        $date_start = $date_mass1[2] . '.' . $date_mass1[1] . '.' . $date_mass1[0];


        $d_day=dateDiff_1(date("y-m-d").' '.date("H:i:s"),$row_de['date_end']);
        $class_promo='';
        $status='Действует';

        $class_ppr='';
        if(($d_day>0)and($row_de['status']==2))
        {
            $class_promo='red-promo';
            $class_ppr='red-ppr';
            $status='Акция завершена';
        }

        if($row_de['status']==0)
        {
            $status='Сохранен';
        }
        if($row_de['status']==1)
        {
            $status='На согласовании';
            $class_promo='yellow-promo';
        }
        if($row_de['status']==3)
        {
            $status='Отклонен';
            $class_promo='red-promo';
        }


        $promo.='<div class="promo-block">
                <div class="promo-white '.$class_ppr.'">

                    <div class="promo-60">
                        <div class="title-60"><span class="'.$class_promo.'"></span> <div>'.$status.'</div></div>
                        <div class="promo-img"><div class="title-p">' . $row_de["name"] . '</div></div>
                    </div>
                    <div class="promo-40">
                        <span>' . $row_de["bonus"] . '</span>
                        <div class="promo-d">Действует до ' . $date_start . '</div>

                        <div class="rating-ship-x">';

        $count_promi = 0;
        $result_uuvv = mysql_time_query($link, 'select count(id) as cc from trips where id_promo="' . ht($row_de["id"]) . '"');
        $num_results_uuvv = $result_uuvv->num_rows;

        if ($num_results_uuvv != 0) {
            $row_uuvv = mysqli_fetch_assoc($result_uuvv);
            if ($row_uuvv["cc"] != '') {
                $count_promi = $row_uuvv["cc"];
            }
        }

        $promo.='<span class="name-border">Использовали</span><div><span class="cost_border ">' . $count_promi . '</span></div>

                        </div>


                    </div>

                </div>
            </div>';

    }
}

//все ок, отправляем уведомления
include $url_system.'module/config_mail.php';
// отправка письма на почту
$text="<HTML>\r\n";
$text.="<HEAD>\r\n";
$text.="<META http-equiv=Content-Type content='html; charset=windows-1251'>\r\n";
$text.="</HEAD>\r\n";
$text.="<BODY>\r\n";


$text.="<br><span style=\"color: #66757f; font-family: 'Helvetica Neue Light',Helvetica,Arial,sans-serif; font-size: 16px; font-weight: 300;\">Заявка на согласование промокода</span><br><br>";






$text.='<div style=" width:100%; height:1px; border-top:1px solid #e1e8ed;"></div>';

$text.="<br><span style=\" color: #292f33; font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 24px; font-weight: 300; line-height: 30px; margin: 0; padding: 0; text-align: left;\">При заполнении формы были указаны следующие данные</span><br><br>
<span style=\"color: #292f33;
    font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif;
    font-size: 16px;
    font-weight: 400;
    line-height: 22px;
    margin: 0;
    padding: 0;
    text-align: left;\">
Имя: ".$name_user."<br>
Промокод: ".ht($_POST['summ'])."<br>
Сообщение: ".ht($_POST['comment'])."
</span><br><br>
<span style=\"color: #292f33;
    font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif;
    font-size: 16px;
    font-weight: 400;
    line-height: 22px;
    margin: 0;
    padding: 0;
    text-align: left;\">Данные были отправлены с формы заявок по адресу <a style=\"color:#292f33; border-bottom: 1px solid #4bcaff; text-decoration: none;\" href=\"https://www.ok.umatravel.club\">www.ok.umatravel.club</a></span>\r\n";



$text.="</BODY>\r\n";
$text.="</HTML>";

//mail($_POST["login"],"www.ulmenu.ru: Подтверждение регистрации",$text,$header);
// /отправка письма на почту

SMTP_MAIL($mail_ulmenu,'password',"Согласование нового промокода с umatravel.club",$text,$mail_admin);





end_code:

$aRes = array("debug"=>$debug,"status"   => $status_ee,"status_echo" => $status_echo,"blocks" => $dom,"for_id"=>ht($_POST["id"]),"id" => htmlspecialchars($_POST["id"]),"error" =>  $stack_error,"promo" => $promo);

/*require_once $url_system.'Ajax/lib/Services_JSON.php';
$oJson = new Services_JSON();
//функция работает только с кодировкой UTF-8
echo $oJson->encode($aRes);
*/
echo json_encode($aRes);



?>