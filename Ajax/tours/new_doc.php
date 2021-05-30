<?php
//получить нового договора

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
$disco=0;
$id=htmlspecialchars($_GET['id']);
$dom=0;
$status_echo='';
//проверка что есть такой город что это число
//проверка что пользователь зарегистрирован

$echo_r=1; //выводить или нет ошибку 0 -нет
$debug='';
$stack_error = array();  // общий массив ошибок


//**************************************************
//mysql_time_query($link, 'delete FROM trips_status_history_new where id="' . ht($_GET['sel']) . '"');
//**************************************************
if ((!$role->permission('Туры','U'))and($sign_admin!=1))
{
    $debug=h4a(12,$echo_r,$debug);
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


if((!isset($_SESSION["user_id"]))or(!is_numeric(id_key_crypt_encrypt($_SESSION["user_id"]))))
{
    goto end_code;
}

$id_user=id_key_crypt_encrypt($_SESSION["user_id"]);

//проверить есть ли переменная id и можно ли этому пользователю это делать
if ((count($_GET) != 2))
{
    goto end_code;
}



$status_admin=0;
$result_t=mysql_time_query($link,'Select A.* from trips as A where A.visible=1 AND A.id="'.ht($id).'" and A.id_a_company="'.$id_company.'"');
$num_results_t = $result_t->num_rows;
if($num_results_t==0)
{
    $debug=h4a(5,$echo_r,$debug);
    goto end_code;

} else
{
    $row_8 = mysqli_fetch_assoc($result_t);
    //$mas_responsible=explode(",",$row_8["id_user_responsible"]);
    $status_admin=$row_8['status_admin'];
}

if(($status_admin!=0)and($sign_level<3)) {
    $debug=h4a(002,$echo_r,$debug);
    goto end_code;
}


//проверим вдруг данных организации не хватает
if(($row_8["shopper"]==2)and($row_8["id_shopper"]!=''))
{

    $result_uu_fly=mysql_time_query($link,'select a.* from k_organization as a where a.id="'.ht($row_8["id_shopper"]).'"');

    $num_results_uu_fly = $result_uu_fly->num_rows;

    if($num_results_uu_fly!=0) {
        $row_uu_fly = mysqli_fetch_assoc($result_uu_fly);
        if (($row_uu_fly["name"] == '') or ($row_uu_fly["head"] == '') or ($row_uu_fly["organ_face"] == '')or ($row_uu_fly["adress_post"] == '')or ($row_uu_fly["adress_ur"] == '')or ($row_uu_fly["contact_face"] == '')or ($row_uu_fly["phone_contact"] == '')or ($row_uu_fly["code_inn"] == '')or ($row_uu_fly["code_ogrn"] == '')or ($row_uu_fly["bank_rs"] == '')or ($row_uu_fly["bank_ks"] == '')or ($row_uu_fly["bank_bik"] == '')or ($row_uu_fly["bank_name"] == '')or ($row_uu_fly["email"] == '')or ($row_uu_fly["head"] == '')) {
            array_push($stack_error, "no_all_info_org");
        }

        $docx_org_name=$row_uu_fly["name"];
        $docx_org_face1=$row_uu_fly["head"];
        $docx_org_face=$row_uu_fly["organ_face"];
        $docx_org_adress_post=$row_uu_fly["adress_post"];
        $docx_org_adress_ur=$row_uu_fly["adress_ur"];
        $docx_org_contact=$row_uu_fly["contact_face"];
        $docx_org_contact_tel=$row_uu_fly["phone_contact"];
        $docx_org_inn=$row_uu_fly["code_inn"];
        $docx_org_ogrn=$row_uu_fly["code_ogrn"];
        $docx_org_rs=$row_uu_fly["bank_rs"];
        $docx_org_ks=$row_uu_fly["bank_ks"];
        $docx_org_bik=$row_uu_fly["bank_bik"];
        $docx_org_bank=$row_uu_fly["bank_name"];
        $docx_org_email=$row_uu_fly["email"];

        //проверка паспортных данных руководителя
        if (($row_uu_fly["face_address"] == '') or ($row_uu_fly["face_seria"] == '') or ($row_uu_fly["face_number"] == '')or ($row_uu_fly["face_kem"] == '')or ($row_uu_fly["face_kogda"] == '0000-00-00'))
        {
            array_push($stack_error, "no_all_info_rf_org");
        }

        $docx_org_rf=$row_uu_fly["face_seria"].' '.$row_uu_fly["face_number"].' выдан '.$row_uu_fly["face_kem"].' '.date_ex(0,$row_uu_fly["face_kogda"]);
        $docx_org_address=$row_uu_fly["face_address"];
        $docx_org_head=$row_uu_fly["head"];


    }

}


//проверить вдруг паспортных данных покупателя не хватает
if(($row_8["shopper"]==1)and($row_8["id_shopper"]!=''))
{

    $sql_fly='';
    if((isset($row_8['passport']))and($row_8['passport']==1))
    {
        //заграничный
        $sql_fly=' inter_seria as seria,inter_number as number,inter_srok as kogda ';
    } else
    {
        //внутренний
        $sql_fly=' inner_seria as seria,inner_number as number,inner_kogda as kogda ';
    }

    $result_uu_fly=mysql_time_query($link,'select adress,phone,fio,email, date_birthday,  '.$sql_fly.' from k_clients where id="'.ht($row_8["id_shopper"]).'"');

    $num_results_uu_fly = $result_uu_fly->num_rows;

    if($num_results_uu_fly!=0)
    {
        $row_uu_fly = mysqli_fetch_assoc($result_uu_fly);
        if(($row_uu_fly["number"]=='')or($row_uu_fly["seria"]=='')or($row_uu_fly["kogda"]==''))
        {
            array_push($stack_error, "no_all_password_buy");
        }
        if(($row_uu_fly["adress"]=='')or($row_uu_fly["phone"]==''))
        {
            array_push($stack_error, "no_phone_tell_buy");
        }	 else
        {
            $docx_buy_name=$row_uu_fly["fio"];
            $docx_buy_adress=$row_uu_fly["adress"];
            $docx_buy_phone=$row_uu_fly["phone"];
            $docx_buy_email=$row_uu_fly["email"];

            if($row_uu_fly["date_birthday"]!='0000-00-00')
            {
                $date_ex66=explode("-",ht($row_uu_fly["date_birthday"]));
                $docx_buy_birthday=$date_ex66[2].'.'.$date_ex66[1].'.'.$date_ex66[0];
            }
        }
    }


    $result_uu=mysql_time_query($link,'select inner_kem,inner_seria,inner_number from k_clients where id="'.ht($row_8["id_shopper"]).'"');
    $num_results_uu = $result_uu->num_rows;

    if($num_results_uu!=0)
    {
        $row_uu = mysqli_fetch_assoc($result_uu);
        //данные внутреннего паспорта не задаты
        if(($row_uu["inner_kem"]=='')or($row_uu["inner_seria"]=='')or($row_uu["inner_number"]==''))
        {
            array_push($stack_error, "no_all_password_x");
        } else
        {
            $docx_fly_rf=$row_uu["inner_seria"].' '.$row_uu["inner_number"].' - '.$row_uu["inner_kem"];
        }


    }



}




//проверить вдруг паспортных данных туристов по туру не хватает
$err_flyy=0;


$result_uu = mysql_time_query($link, 'select id_k_clients from trips_clients_fly where id_trips="' . ht($id) . '"');
$num_results_uu = $result_uu->num_rows;

if ($num_results_uu != 0) {
    //$row_uu = mysqli_fetch_assoc($result_uu);
    while ($row_uu = mysqli_fetch_assoc($result_uu)) {
        $sql_fly = '';
        if ((isset($row_8['passport'])) and ($row_8['passport'] == 1)) {
            //заграничный
            $sql_fly = ' inter_seria as seria,inter_number as number,inter_srok as kogda ';
        } else {
            //внутренний
            $sql_fly = ' inner_seria as seria,inner_number as number,inner_kogda as kogda ';
        }

        $result_uu_fly = mysql_time_query($link, 'select ' . $sql_fly . ' from k_clients where id="' . ht($row_uu["id_k_clients"]) . '"');

       // echo ($row_8['passport']);

        $num_results_uu_fly = $result_uu_fly->num_rows;

        if ($num_results_uu_fly != 0) {
            $row_uu_fly = mysqli_fetch_assoc($result_uu_fly);
            if (($row_uu_fly["number"] == '') or ($row_uu_fly["seria"] == '') or ($row_uu_fly["kogda"] == '')) {

                $err_flyy++;
            }
        }
    }
}
if($err_flyy!=0)
{
    array_push($stack_error, "no_all_password_fly");
}

if(count($stack_error)!=0)
{
    goto end_code;
}


//**************************************************
//**************************************************
//**************************************************
//**************************************************


$status_ee='ok';



//02/01/2020
$result_uu = mysql_time_query($link, 'select A.* from trips_payment_term as A where A.id_trips="' . ht($id) . '" and A.visible=1 and A.proc="100" AND A.type=0 order by A.id limit 0,1');
$num_results_uu = $result_uu->num_rows;

if ($num_results_uu != 0) {
    $row_uu = mysqli_fetch_assoc($result_uu);
    $date_end=explode(".",htmlspecialchars(trim(date_ex(0,$row_uu['date']))));
    $docx_end_cost='Полная оплата до '.$date_end[0].'/'.$date_end[1].'/'.$date_end[2];
} else
{
    $docx_end_cost='-';
}




//узнаем откуда узнал об этом
$result_uu=mysql_time_query($link,'select name from booking_sourse where id="'.ht($row_8["id_booking_sourse"]).'"');
$num_results_uu = $result_uu->num_rows;

if($num_results_uu!=0)
{
    $row_uu = mysqli_fetch_assoc($result_uu);
    $docx_fly_sourse= $row_uu["name"];
}

//страна куда летит
$result_uu=mysql_time_query($link,'select name from trips_country where id="'.ht($row_8["id_country"]).'"');
$num_results_uu = $result_uu->num_rows;

if($num_results_uu!=0)
{
    $row_uu = mysqli_fetch_assoc($result_uu);
    $docx_fly_country= $row_uu["name"];
}


$docx_food='';
//тип питания
    $result_uu=mysql_time_query($link,'select name from trips_food_type where id="'.ht($row_8["id_food_type"]).'"');
    $num_results_uu = $result_uu->num_rows;

    if($num_results_uu!=0)
    {
        $row_uu = mysqli_fetch_assoc($result_uu);
        //$docx_fly_country= $row_uu["name"];

        if((isset($row_8["food_type"]))and($row_uu["name"]!=$row_8["food_type"]))
        {
            $docx_food= $row_8["food_type"];
        } else
        {
            $docx_food= $row_uu["name"];
        }
    }




$docx_room='';
//тип питания

    $result_uu=mysql_time_query($link,'select name from trips_room_type where id="'.ht($row_8["id_room_category"]).'"');
    $num_results_uu = $result_uu->num_rows;

    if($num_results_uu!=0)
    {
        $row_uu = mysqli_fetch_assoc($result_uu);
        //$docx_fly_country= $row_uu["name"];

        if((isset($row_8["room_category"]))and($row_uu["name"]!=$row_8["room_category"]))
        {
            $docx_room = $row_8["room_category"];
        } else
        {
            $docx_room = $row_uu["name"];
        }
    }


//echo("!".$docx_room);

//добавляем экскурсии если они есть
$docx_excursion= array() ;
$result_uu = mysql_time_query($link, 'select name from trips_excursion where id_trips="' . ht($id) . '"');
if ($result_uu) {
    $i = 0;
    while ($row_uu = mysqli_fetch_assoc($result_uu)) {

        $docx_excursion[] =$row_uu['name'];

    }
}
//добавляем страховок если они есть
$docx_insurance= array() ;
$result_uu = mysql_time_query($link, 'select name from trips_insurance where id_trips="' . ht($id) . '"');
if ($result_uu) {
    $i = 0;
    while ($row_uu = mysqli_fetch_assoc($result_uu)) {

        $docx_insurance[] =$row_uu['name'];

    }
}


//добавляем дополнительных услуг
$docx_service= array() ;
$result_uu = mysql_time_query($link, 'select name from trips_service where id_trips="' . ht($id) . '"');
if ($result_uu) {
    $i = 0;
    while ($row_uu = mysqli_fetch_assoc($result_uu)) {

        $docx_service[] =$row_uu['name'];

    }
}


//делаем документы doc договор
//require_once $url_system.'library/PhpWord/PHPWord.php';

require $url_system.'vendor/autoload.php';

$date_start='';
$date_end='';
$result_uu = mysql_time_query($link, 'select start_fly,end_fly from trips_fly_history where id_trips="' . ht($id) . '" order by datetime DESC limit 0,1');
$num_results_uu = $result_uu->num_rows;

if ($num_results_uu != 0) {
    $row_uu = mysqli_fetch_assoc($result_uu);
    $date_start=$row_uu["start_fly"];
    $date_end=$row_uu["end_fly"];
}


if($row_8["shopper"]==2) {

    $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($url_system . 'doc/template/org_temp_doc1.docx');
}else
{
    $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($url_system . 'doc/template/temp_doc1.docx');
}
if($row_8["shopper"]==2) {
    //для организации
    $templateProcessor->setValue('firm_name', $docx_org_name);
    $templateProcessor->setValue('firm_face', $docx_org_face);

    $templateProcessor->setValue('firm_inn', $docx_org_inn);
    $templateProcessor->setValue('firm_ogrnip', $docx_org_ogrn);
    $templateProcessor->setValue('firm_rs', $docx_org_rs);
    $templateProcessor->setValue('firm_ks', $docx_org_ks);
    $templateProcessor->setValue('firm_bik', $docx_org_bik);
    $templateProcessor->setValue('firm_bank', $docx_org_bank);
    $templateProcessor->setValue('firm_uradress', $docx_org_adress_ur);
    $templateProcessor->setValue('firm_poct', $docx_org_adress_post);
    $templateProcessor->setValue('firm_tel', $docx_org_contact_tel);
    $templateProcessor->setValue('firm_email', $docx_org_email);
}

$templateProcessor->setValue('flight_there_route', $row_8['flight_there_route']);
$templateProcessor->setValue('flight_there_class', $row_8['flight_there_class']);
$templateProcessor->setValue('flight_there_number', $row_8['flight_there_number']);
$templateProcessor->setValue('start_fly', date_ex_plus_time(0,$date_start));

$templateProcessor->setValue('flight_back_route', $row_8['flight_back_route']);
$templateProcessor->setValue('flight_back_class', $row_8['flight_back_class']);
$templateProcessor->setValue('flight_back_number', $row_8['flight_back_number']);
$templateProcessor->setValue('end_fly',  date_ex_plus_time(0,$date_end));


$templateProcessor->setValue('fly_name', $docx_buy_name);
$templateProcessor->setValue('fly_birthday', $docx_buy_birthday);
$templateProcessor->setValue('FLY_NAME', $docx_buy_name);
$templateProcessor->setValue('FLY_ADRESS', $docx_buy_adress);
$templateProcessor->setValue('fly_phone', $docx_buy_phone);
$templateProcessor->setValue('fly_email', $docx_buy_email);

$templateProcessor->setValue('FLY_SOURSE', $docx_fly_sourse);

$templateProcessor->setValue('place_name', $row_8['place_name']);
$templateProcessor->setValue('country_name', $docx_fly_country);

$templateProcessor->setValue('date_start', date_ex(0,$row_8['date_start']));
$templateProcessor->setValue('date_end',date_ex(0,$row_8['date_end']));

$templateProcessor->setValue('TRANSFER_ROUTE', $row_8['transfer_route']);
$templateProcessor->setValue('TRANSFER_TYPE', $row_8['transfer_type']);
$templateProcessor->setValue('hotel', $row_8['hotel']);

$templateProcessor->setValue('booking',$row_8['number_to']);
$templateProcessor->setValue('end_cost',$docx_end_cost);

$templateProcessor->setValue('count_clients', $row_8['count_people'].' '. PadejNumber($row_8['count_people'],'человек,человека,человек'));

$templateProcessor->setValue('room', $docx_room);
$templateProcessor->setValue('food', $docx_food);

$templateProcessor->setValue('RF', $docx_fly_rf);


//прикрепляем файл туроператора и склеиваем их



//стоимость тура заносим в базу
//cost_client
//exchange_rates - курс
//avans_client - аванс

$docx_cost='';
$docx_cost_text='';

if((isset($row_8["cost_client"]))and($row_8["cost_client"]!=''))
{
    $docx_cost=rtrim(rtrim(number_format((float)trimc($row_8["cost_client"]), 2, '.', ' '),'0'),'.').' ';
    $docx_cost_text=num2str((float)trimc($row_8["cost_client"]));
}

$templateProcessor->setValue('x_cost', $docx_cost);
$templateProcessor->setValue('X_COST_TEXT', $docx_cost_text);

//авансы
$docx_avans=0;
$docx_avans_text='0 РУБ 00 КОП ';

$result_uu = mysql_time_query($link, 'select A.sum as ssum from trips_payment A where A.id_trips="' . ht($id) . '" and A.visible=1 and A.who=0 and A.id_operation=1 order by A.date_payment limit 0,1');
$num_results_uu = $result_uu->num_rows;

if ($num_results_uu != 0) {
    $row_uu = mysqli_fetch_assoc($result_uu);

    $trips_avv=$row_uu["ssum"];

    if((isset($row_uu["ssum"]))and($row_uu["ssum"]!='')and($row_uu["ssum"]!=0))
    {
        $docx_avans=rtrim(rtrim(number_format((float)trimc($row_uu["ssum"]), 2, '.', ' '),'0'),'.');
        $docx_avans_text=num2str((float)trimc($row_uu["ssum"]));
    }
}





$templateProcessor->setValue('x_avans', $docx_avans);
$templateProcessor->setValue('X_AVANS_TEXT', $docx_avans_text);

//доплатить
$docx_dop=$docx_cost;
$docx_dop_text=$docx_cost_text;
if((isset($row_uu["ssum"]))and($row_uu["ssum"]!='')and($row_uu["ssum"]!=0))
{
    $docx_dop=rtrim(rtrim(number_format(((float)trimc($row_8["cost_client"])-(float)trimc($row_uu["ssum"])), 2, '.', ' '),'0'),'.');

    $docx_dop_text=num2str(((float)trimc($row_8["cost_client"])-(float)trimc($row_uu["ssum"])));
}

$templateProcessor->setValue('x_dop', $docx_dop);
$templateProcessor->setValue('X_DOP_TEXT', $docx_dop_text);



$result_uu = mysql_time_query($link, 'select name from trips_contract where id="' . ht($row_8['id_contract']) . '"');
$num_results_uu = $result_uu->num_rows;

if ($num_results_uu != 0) {
    $row_uuss = mysqli_fetch_assoc($result_uu);
    $date_doc_=explode("-",ht(trim($row_uuss['name'])));
    $date_r=explode(" ",htmlspecialchars(trim($date_doc_[1])));
    $date_r1=explode("/",htmlspecialchars(trim($date_doc_[0])));


    $date_ddd=$date_r1[0].'.'.$date_r1[1].'.'.$date_r1[2];

}


//проверим в какой валюте тур
$avans_rates=0;
$result_uu=mysql_time_query($link,'select a.char from booking_exchange as a  where a.id="'.ht($row_8["id_exchange"]).'"');
$num_results_uu = $result_uu->num_rows;

if($num_results_uu!=0)
{
    $row_uu = mysqli_fetch_assoc($result_uu);
    if($row_uu["char"]=="₽")
    {
        //тур рублевый и к валюте не привязан
        $cost_client=trimc($row_8["cost_client"]);
        $cost_client_exchange=0;
        $exchange_rates=0;
        $docx_rates='';
        $docx_rates1='';
        $docx_rates2='';
        //$
        if ((  $trips_avv != 0 )and(  $trips_avv != '' )) {

            $docx_rates3=number_format(((float)trimc($row_8["cost_client"])-(float)trimc( $trips_avv)), 2, '.', ' ').' РУБ';

        } else
        {
            $docx_rates3=number_format(((float)trimc($row_8["cost_client"])), 2, '.', ' ').' РУБ';
        }


    } else
    {
        $cost_client=trimc($row_8["cost_client"]);
        //$exchange_rates=$_POST["exchange_rates"];
        $cost_client_exchange=number_format(((float)$row_8["cost_client_exchange"]), 2, '.', '');

/*
        $date_extt=explode("-",htmlspecialchars(trim($_POST["date_sele_doc"])));
        $date_extt=$date_extt[2].'.'.$date_extt[1].'.'.$date_extt[0];
*/
        $docx_rates='('.number_format(((float)$row_8["cost_client_exchange"]), 2, '.', ' ').''.$row_uu["char"].', по курсу '.$row_8["exchange_rates"].' на '.$date_ddd.')';


        if ((  $trips_avv != 0 )and(  $trips_avv != '' )) {
            $avans_rates=number_format(((float)trimc($trips_avv)/(float)$row_8["exchange_rates"]), 2, '.', '');

            $docx_rates1='('.number_format(((float)trimc($trips_avv)/(float)$row_8["exchange_rates"]), 2, '.', ' ').''.$row_uu["char"].', по курсу '.$row_8["exchange_rates"].' на '.$date_ddd.')';

            $docx_rates2='('.number_format((((float)trimc($row_8["cost_client"])-(float)trimc($trips_avv))/(float)$row_8["exchange_rates"]), 2, '.', ' ').''.$row_uu["char"].', по курсу '.$row_8["exchange_rates"].' на '.$date_ddd.')';

            $docx_rates3=number_format((((float)trimc($row_8["cost_client"])-(float)trimc($trips_avv))/(float)$row_8["exchange_rates"]), 2, '.', ' ').''.$row_uu["char"].', сумма в рублях высчитывается по официальному курсу туроператора на момент окончательной оплаты';


        } else
        {
            $docx_rates1='(0'.$row_uu["char"].', по курсу '.$row_8["exchange_rates"].' на '.$date_ddd.')';

            $docx_rates2=$docx_rates;
            $docx_rates3=number_format(((float)trimc($row_8["cost_client"])), 2, '.', ' ').' '.$row_uu["char"].', сумма в рублях высчитывается по официальному курсу туроператора на момент окончательной оплаты';

        }
    }
}


$templateProcessor->setValue('rates', $docx_rates);
$templateProcessor->setValue('rates1', $docx_rates1);
$templateProcessor->setValue('rates2', $docx_rates2);
$templateProcessor->setValue('rates3', $docx_rates3);



$templateProcessor->setValue('number_contract', $row_uuss['name']);

if(isset($date_r[0]))
{
    $templateProcessor->setValue('number', $date_r[0]);
}


$docx_fly_kto=[];
$index_m=0;
$result_uu = mysql_time_query($link, 'select id_k_clients from trips_clients_fly where id_trips="' . ht($id) . '"');
$num_results_uu = $result_uu->num_rows;

if ($num_results_uu != 0) {
    while ($row_uu = mysqli_fetch_assoc($result_uu)) {

        $sql_fly='';
        if((isset($row_8['passport']))and($row_8['passport']==1))
        {
            $sql_fly=', inter_seria as seria,inter_number as number,inter_srok as kogda ';
        } else
        {
            $sql_fly=', inner_seria as seria,inner_number as number,inner_kogda as kogda ';
        }

        $result_uu_fly=mysql_time_query($link,'select latin,pol,date_birthday '.$sql_fly.' from k_clients where id="'.ht($row_uu["id_k_clients"] ).'"');

        $num_results_uu_fly = $result_uu_fly->num_rows;

        if($num_results_uu_fly!=0)
        {
            $row_uu_fly = mysqli_fetch_assoc($result_uu_fly);

            $pol='MR';
            if($row_uu_fly['pol']==2)
            {
                $pol='MRS';
            }

            $birthday='';
            if(validateDate($row_uu_fly['date_birthday'],'Y-m-d'))
            {
                $date_end1=explode("-",ht($row_uu_fly['date_birthday']));
                $birthday=$date_end1[2].'.'.$date_end1[1].'.'.$date_end1[0];
            }

            $do='';
            if(validateDate($row_uu_fly['kogda'],'Y-m-d'))
            {
                $date_end12=explode("-",ht($row_uu_fly['kogda']));
                $do=$date_end12[2].'.'.$date_end12[1].'.'.$date_end12[0];
            }


            $docx_fly_kto[$index_m]['LATIN_FIO']= $row_uu_fly['latin'];
            $docx_fly_kto[$index_m]['MRS']=$pol;
            $docx_fly_kto[$index_m]['DATE_BIRTHDAY']=$birthday;

            if((isset($row_8['passport']))and($row_8['passport']==1))
            {

                $docx_fly_kto[$index_m]['password_fly']=$row_uu_fly['seria'].' '.$row_uu_fly['number'].' до '.$do;

            } else
            {
                $docx_fly_kto[$index_m]['password_fly']=$row_uu_fly['seria'].' '.$row_uu_fly['number'].' выдан '.$do;
            }

            $index_m++;
        }
    }
}


$templateProcessor->cloneRowAndSetValues('LATIN_FIO', $docx_fly_kto);



$result_uu = mysql_time_query($link, 'select name from trips_contract where id="' . ht($row_8['id_contract']) . '"');
$num_results_uu = $result_uu->num_rows;

if ($num_results_uu != 0) {
    $row_uuss = mysqli_fetch_assoc($result_uu);
    $date_doc_=explode("-",ht(trim($row_uuss['name'])));
    $date_r=explode(" ",htmlspecialchars(trim($date_doc_[1])));
    $date_r1=explode("/",htmlspecialchars(trim($date_doc_[0])));


    $date_ddd=$date_r1[0].'.'.$date_r1[1].'.'.$date_r1[2];

    $day=$date_r1[0];
    $date=month_rus($date_r1[1]).' '.$date_r1[2];
    $templateProcessor->setValue('date', $date);
    $templateProcessor->setValue('day', $day);

}



//экскурсии
if(count($docx_excursion)!=0)
{
    $templateProcessor->cloneRow('excursion', count($docx_excursion));
    foreach ( $docx_excursion as $key => $value ) {
        $templateProcessor->setValue('excursion#'.($key+1), $value);
    }

} else
{
    $templateProcessor->setValue('excursion','______________________________________________________________________________________________');
}
//страховки
if(count($docx_insurance)!=0)
{
    $templateProcessor->cloneRow('insurance', count($docx_insurance));
    foreach ( $docx_insurance as $key => $value ) {
        $templateProcessor->setValue('insurance#'.($key+1), $value);
    }

} else
{
    $templateProcessor->setValue('insurance','______________________________________________________________________________________________');
}

//услуги
if(count($docx_service)!=0)
{
    $templateProcessor->cloneRow('service', count($docx_service));
    foreach ( $docx_service as $key => $value ) {
        $templateProcessor->setValue('service#'.($key+1), $value);
    }

} else
{
    $templateProcessor->setValue('service','______________________________________________________________________________________________');
}

$templateProcessor->saveAs($url_system.'tours/doc/intermediate/'.$row_8['id_contract'].'_template1.docx');

if($row_8["shopper"]==2) {

    $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($url_system . 'doc/template/org_temp_doc3.docx');
} else
{
    $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($url_system . 'doc/template/temp_doc3.docx');
}

if($row_8["shopper"]==2) {

//для организации
//templateProcessor->setValue('fio_org', $docx_org_face1);
//$templateProcessor->setValue('address_org', $_POST['flight_there_route']);
//$templateProcessor->setValue('rf_org', $_POST['flight_there_class']);
//для организации
    $templateProcessor->setValue('fio_org', $docx_org_head);
    $templateProcessor->setValue('address_org', $docx_org_address);
    $templateProcessor->setValue('rf_org', $docx_org_rf);


}


$templateProcessor->setValue('flight_there_route', $row_8['flight_there_route']);
$templateProcessor->setValue('flight_there_class', $row_8['flight_there_class']);
$templateProcessor->setValue('flight_there_number', $row_8['flight_there_number']);
$templateProcessor->setValue('start_fly', date_ex_plus_time(0,$date_start));

$templateProcessor->setValue('flight_back_route', $row_8['flight_back_route']);
$templateProcessor->setValue('flight_back_class', $row_8['flight_back_class']);
$templateProcessor->setValue('flight_back_number', $row_8['flight_back_number']);
$templateProcessor->setValue('end_fly',  date_ex_plus_time(0,$date_end));

$templateProcessor->setValue('fly_name', $docx_buy_name);
$templateProcessor->setValue('fly_birthday', $docx_buy_birthday);
$templateProcessor->setValue('FLY_NAME', $docx_buy_name);
$templateProcessor->setValue('FLY_ADRESS', $docx_buy_adress);
$templateProcessor->setValue('fly_phone', $docx_buy_phone);
$templateProcessor->setValue('fly_email', $docx_buy_email);
$templateProcessor->setValue('FLY_SOURSE', $docx_fly_sourse);






$templateProcessor->setValue('place_name', $row_8['place_name']);
$templateProcessor->setValue('country_name', $docx_fly_country);

$templateProcessor->setValue('date_start', date_ex(0,$row_8['date_start']));
$templateProcessor->setValue('date_end',date_ex(0,$row_8['date_end']));

$templateProcessor->setValue('TRANSFER_ROUTE', $row_8['transfer_route']);
$templateProcessor->setValue('TRANSFER_TYPE', $row_8['transfer_type']);
$templateProcessor->setValue('hotel', $row_8['hotel']);

$templateProcessor->setValue('booking',$row_8['number_to']);
$templateProcessor->setValue('end_cost',$docx_end_cost);

$templateProcessor->setValue('count_clients', $row_8['count_people'].' '. PadejNumber($row_8['count_people'],'человек,человека,человек'));

$templateProcessor->setValue('room', $docx_room);
$templateProcessor->setValue('food', $docx_food);

$templateProcessor->setValue('RF', $docx_fly_rf);



//прикрепляем файл туроператора и склеиваем их



//стоимость тура заносим в базу
//cost_client
//exchange_rates - курс
//avans_client - аванс

$docx_cost='';
$docx_cost_text='';

if((isset($row_8["cost_client"]))and($row_8["cost_client"]!=''))
{
    $docx_cost=rtrim(rtrim(number_format((float)trimc($row_8["cost_client"]), 2, '.', ' '),'0'),'.').' ';
    $docx_cost_text=num2str((float)trimc($row_8["cost_client"]));
}

$templateProcessor->setValue('x_cost', $docx_cost);
$templateProcessor->setValue('X_COST_TEXT', $docx_cost_text);

//авансы
/*
$docx_avans=0;
$docx_avans_text='0 РУБ 00 КОП ';

if((isset($_POST["avans_client"]))and($_POST["avans_client"]!='')and($_POST["avans_client"]!=0))
{
    $docx_avans=rtrim(rtrim(number_format((float)trimc($_POST["avans_client"]), 2, '.', ' '),'0'),'.');
    $docx_avans_text=num2str((float)trimc($_POST["avans_client"]));
}
*/
$templateProcessor->setValue('x_avans', $docx_avans);
$templateProcessor->setValue('X_AVANS_TEXT', $docx_avans_text);

//доплатить
/*
$docx_dop=$docx_cost;
$docx_dop_text=$docx_cost_text;
if((isset($_POST["avans_client"]))and($_POST["avans_client"]!='')and($_POST["avans_client"]!=0))
{
    $docx_dop=rtrim(rtrim(number_format(((float)trimc($_POST["cost_client"])-(float)trimc($_POST["avans_client"])), 2, '.', ' '),'0'),'.');
    $docx_dop_text=num2str(((float)trimc($_POST["cost_client"])-(float)trimc($_POST["avans_client"])));
}
*/
$templateProcessor->setValue('x_dop', $docx_dop);
$templateProcessor->setValue('X_DOP_TEXT', $docx_dop_text);


$templateProcessor->setValue('rates', $docx_rates);
$templateProcessor->setValue('rates1', $docx_rates1);
$templateProcessor->setValue('rates2', $docx_rates2);
$templateProcessor->setValue('rates3', $docx_rates3);

$templateProcessor->setValue('number_contract', $row_uuss['name']);
if(isset($date_r[0]))
{
    $templateProcessor->setValue('number', $date_r[0]);
}

$result_uu = mysql_time_query($link, 'select name from trips_contract where id="' . ht($row_8['id_contract']) . '"');
$num_results_uu = $result_uu->num_rows;

if ($num_results_uu != 0) {
    $row_uuss = mysqli_fetch_assoc($result_uu);
    $date_doc_=explode("-",ht(trim($row_uuss['name'])));
    $date_r=explode(" ",htmlspecialchars(trim($date_doc_[1])));
    $date_r1=explode("/",htmlspecialchars(trim($date_doc_[0])));


    $date_ddd=$date_r1[0].'.'.$date_r1[1].'.'.$date_r1[2];

    $day=$date_r1[0];
    $date=month_rus($date_r1[1]).' '.$date_r1[2];
    $templateProcessor->setValue('date', $date);
    $templateProcessor->setValue('day', $day);

}

$templateProcessor->saveAs($url_system.'tours/doc/intermediate/'.$row_8['id_contract'].'_template3.docx');




//добавить версию к этому договору
$datse_=date("Y-m-d").' '.date("H:i:s");
mysql_time_query($link,'INSERT INTO trips_contract_version (id_trips_contract,id_user,date_create) VALUES (
'.$row_8['id_contract'].',
'.ht($id_user).',
"'.$datse_.'")');

$new_id_version=mysqli_insert_id($link);



//смотрим есть ли шаблон у этого оператора чтобы добавить в договор
$result_6 = mysql_time_query($link,'select A.* from image_attach as A WHERE A.for_what="6" and A.visible=1 and A.id_object="'.ht($row_8["id_operator"]).'"');

$num_results_uu = $result_6->num_rows;
$flag_t_oper=0;
if($num_results_uu!=0)
{
    $row_6 = mysqli_fetch_assoc($result_6);
    $file_template_operator='upload/file/'.$row_6["id"].'_'.$row_6["name"].'.'.$row_6["type"].'';
    $flag_t_oper=1;
}


use DocxMerge\DocxMerge;

$dm = new DocxMerge();
if($flag_t_oper==1) {
    $dm->merge([
        $url_system . 'tours/doc/intermediate/'.$row_8['id_contract'].'_template1.docx',
        $url_system . $file_template_operator,
        $url_system . 'tours/doc/intermediate/'.$row_8['id_contract'].'_template3.docx'
    ], $url_system . "tours/doc/doc-".$row_8['id_contract']."_".$new_id_version.".docx");
    chmod($url_system . "tours/doc/doc-".$row_8['id_contract']."_".$new_id_version.".docx", 0644);
} else
{
    $dm->merge([
        $url_system . 'tours/doc/intermediate/'.$row_8['id_contract'].'_template1.docx',
        $url_system . 'tours/doc/intermediate/'.$row_8['id_contract'].'_template3.docx'
    ], $url_system . "tours/doc/doc-".$row_8['id_contract']."_".$new_id_version.".docx");
    chmod($url_system . "tours/doc/doc-".$row_8['id_contract']."_".$new_id_version.".docx", 0644);

}


$date_doc_=explode("-",$row_uuss["name"]);
$date_r1=explode("/",htmlspecialchars(trimc($date_doc_[0])));

$date_ddd=$date_r1[0].'.'.$date_r1[1].'.'.$date_r1[2];


$download='<div class="comm-trips-block new-say-doc">

<div class="h_cb"><a><span>'.$row_uuss["name"].' от '.$date_ddd.' <span class="vers-doc-color green-trips "></span></span></a><div class="date_cb">'.time_stamp($datse_).'</div></div>


<div class="user_cb">'.$name_user.'
<div class="vip-ds"><a target="_blank" href="https://www.ok.umatravel.club/tours/doc/doc-'.$row_8['id_contract'].'_'.$new_id_version.'.docx" data-tooltip="Открыть документ" class="trips__click1"></a></div>
</div>
</div>';



//удалить промежуточные шаблоны
$uploadfile = $_SERVER["DOCUMENT_ROOT"].'/tours/doc/intermediate/'.$row_8['id_contract'].'_template3.docx';
if (file_exists($uploadfile)) {
    //unlink($uploadfile);
}
$uploadfile = $_SERVER["DOCUMENT_ROOT"].'/tours/doc/intermediate/'.$row_8['id_contract'].'_template1.docx';
if (file_exists($uploadfile)) {
    //unlink($uploadfile);
}


//добавить в историю это действие
AddHistoryTrips('12',$id_user,$id,'','','','','','','','руб.','',$link,'');

//уведомление
//уведомление
//уведомление

$text_not = 'Создана новая версия договора по <a href="/tours/.id-' . ht($id) . '">Туру №' . ht($id) . '</a>.';

$user_send_new= array();
$user_send_new=array_merge(UserNotNumber(11,$link));

rm_from_array(0,$user_send_new);
rm_from_array($id_user,$user_send_new);
$user_send_new= array_unique($user_send_new);


$mass_ei = all_chief($row_8["id_user"], $link);
rm_from_array($id_user, $mass_ei);
$mass_ei = array_unique($mass_ei);

$end_mass=exception_role($user_send_new,$mass_ei);



notification_send( $text_not,$end_mass,$id_user,$link);





end_code:

$aRes = array("debug"=>$debug,"status"   => $status_ee,"status_echo"   => $status_echo,"query" => $query_string,"download"=>$download,"error" =>  $stack_error);
/*require_once $url_system.'Ajax/lib/Services_JSON.php';
$oJson = new Services_JSON();
//функция работает только с кодировкой UTF-8
echo $oJson->encode($aRes);
*/
echo json_encode($aRes);
?>