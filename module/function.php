<?




//формирование списка кому нужны новые уведомления с учетом руводства
function notif_role_list($id_user,$id_user_send,$text,$number_notif)
{
    global $link;
    $user_send_new= array();
    $user_send_new=array_merge(UserNotNumber($number_notif,$link));

    rm_from_array(0,$user_send_new);  //удаляем 0
    rm_from_array($id_user,$user_send_new); //удаляем того кто это делал действие
    $user_send_new= array_unique($user_send_new);

    //echo'<br>кто подписан на такие уведомления<br>';
    //print_r($user_send_new);


    $mass_ei = all_chief($id_user, $link);  //находим кто руководит ним выше до верхушки
    rm_from_array($id_user, $mass_ei); //удаляем того кто это делал действие
    $mass_ei = array_unique($mass_ei);

    //echo'<br>кто руководит от тура пляшем<br>';
    //print_r($mass_ei);

    $end_mass=exception_role($user_send_new,$mass_ei);  //формируем кто кто подписан на такое уведомление и есть в руководителях

    //echo'<br>итог<br>';
    //print_r($end_mass);

    notification_send( $text,$end_mass,$id_user_send,$link);

}


function exception_role($user_send_new,$mass_ei)
{
    $mass_end=array();
    foreach ($user_send_new as $index => $value) {

        if (array_search($value, $mass_ei) !== false) {

            array_push($mass_end, $value);

        }
    }
    return $mass_end;
}



/**
 * получаем по туру краткое описание --> Россия, СоЧИ / HIPSTER 3***
 * @param $id
 * @param $link
 */
function info_trips($id,$link)
{

    $result_uuy = mysql_time_query($link, 'select A.id,A.hotel,A.id_country,A.place_name from trips as A where A.id="' . ht($id) . '"');
    $num_results_uuy = $result_uuy->num_rows;

    if ($num_results_uuy != 0) {
        $row_8 = mysqli_fetch_assoc($result_uuy);


        $kuda_trips='';
        $result_uu = mysql_time_query($link, 'select name from trips_country where id="' . ht($row_8["id_country"]) . '"');
        $num_results_uu = $result_uu->num_rows;

        if ($num_results_uu != 0) {
            $row_uu = mysqli_fetch_assoc($result_uu);
            $kuda_trips .= $row_uu["name"];
        }
        if ($row_8['place_name'] != '') {
            $kuda_trips .= ', ' . $row_8['place_name'];
        }
        if ($row_8['hotel'] != '') {
            $kuda_trips .= ' / ' . $row_8['hotel'];
        }

        return $kuda_trips;
    }

}


/**
 * проверка покупателя на процент 10% или 15%
 *
 */


/**
 * узнать по партнерки тур или нет и сколько считать процент 10% или 15%
 *
 */
function partners_trips($id_trips,$id_company,$link)
{
    $proc_promo=0;
    $result_uu = mysql_time_query($link, 'select a.shopper,a.id_shopper,b.id_affiliates from trips as a,k_clients as b where a.id="' . ht($id_trips) . '" and a.shopper=1 and a.id_shopper=b.id');
    $num_results_uu = $result_uu->num_rows;

    if ($num_results_uu != 0) {
        $row_uu = mysqli_fetch_assoc($result_uu);
        if($row_uu["id_affiliates"]!=0)
        {

            $result_promo = mysql_time_query($link, 'select id from r_user where id="' . ht( $row_uu["id_affiliates"]) . '" and id_role="7" and enabled="1"');

            $num_results_promo = $result_promo->num_rows;

            if ($num_results_promo != 0) {
                //покупатель связан с партнеркой + партнер действующий
                //покупал ли этот покупатель уже туры которые состоялись
                $sql_k = '
select DISTINCT Z.id from(
   (
  Select

  DISTINCT A.id,
   A.date_start
  
  from trips as A

  where A.status=1 AND  A.visible=1 AND A.id_a_company IN (' . $id_company . ') and A.id_affiliates="'.$row_uu["id_affiliates"].'" and not(A.id="'.ht($id_trips).'") and A.shopper=1 and A.id_shopper="'.$row_uu["id_shopper"].'"
)

) Z order by Z.date_start DESC';

                //echo  $sql_k;

                $result_88 = mysql_time_query($link,$sql_k );
                $num_88 = $result_88->num_rows;
if($num_88!=0)
{
    //а вдруг это первый по времени тур
    $sql_k22 = '
select DISTINCT Z.id from(
   (
  Select

  DISTINCT A.id,
   A.datecreate
  
  from trips as A

  where A.status=1 AND  A.visible=1 AND A.id_a_company IN (' . $id_company . ') and A.id_affiliates="'.$row_uu["id_affiliates"].'"  and A.shopper=1 and A.id_shopper="'.$row_uu["id_shopper"].'"
)

) Z order by Z.datecreate limit 1';


    $result_perv = mysql_time_query($link,$sql_k22 );
    $num_perv = $result_perv->num_rows;
    if($num_perv!=0)
    {
        $row_perv = mysqli_fetch_assoc($result_perv);
        if($row_perv["id"]==$id_trips)
        {
            $proc_promo=15;
        } else
        {
            $proc_promo=10;
        }
    }



} else
{
    //Он еще не покупал и не летал никуда
    $proc_promo=15;
}
            }
        }
    }

    return $proc_promo;
}

/**
 * добавление комиссии  партнеру после полной оплаты
 *
 */
function commission_add_ship($id_trips,$comm,$proc,$link)
{
    global $url_system;
    global $id_user;

    if($comm!=0) {
        $result_tr = mysql_time_query($link, 'Select 
  
  DISTINCT b.id_affiliates,
    (SELECT yy.start_fly FROM trips_fly_history AS yy WHERE yy.id_trips=b.id ORDER BY yy.datetime DESC LIMIT 0,1) AS fly_start,(SELECT yy.end_fly FROM trips_fly_history AS yy WHERE yy.id_trips=b.id ORDER BY yy.datetime DESC LIMIT 0,1) AS fly_end
  
  from trips as b where b.id="' . ht($id_trips) . '" and not(b.id_affiliates=0)');
        $num_results_tr = $result_tr->num_rows;

        if ($num_results_tr != 0) {
            $row_tr = mysqli_fetch_assoc($result_tr);

            $block=1; //по умолчанию деньги в блокировки
            //если он прилетел, то разблокируем деньги

    if(($row_tr["fly_start"]!='')and($row_tr["fly_start"]!='0000-00-00 00:00:00')and($row_tr["fly_end"]!='')and($row_tr["fly_end"]!='0000-00-00 00:00:00'))
    {
        if((date_end_today($row_tr["fly_start"]))and(date_end_today($row_tr["fly_end"])))
        {
            //по датам он прилетел деньги можно разблокировать сразу
            $block=0;
        }
    }




            $result_uu = mysql_time_query($link, 'select id from affiliates_history_trips where id_trips="' . ht($id_trips) . '"');
            $num_results_uu = $result_uu->num_rows;

            if ($num_results_uu == 0) {
                $date_ = date("y.m.d") . ' ' . date("H:i:s");

                mysql_time_query($link, 'INSERT INTO affiliates_history_trips(id_users,id_trips,comission,proc,block,datetimes) VALUES( 
        "' . ht($row_tr["id_affiliates"]) . '","' . ht($id_trips) . '","'.$comm.'","'.$proc.'","'.$block.'","' . $date_ . '")');
                //уведомление партнеру

                $text_not = 'Тур №' . ht($id_trips) . ' был забронирован и оплачен. +'.$comm.' RUB';
                $user_send_new= array();
                array_push($user_send_new, $row_tr["id_affiliates"]);
                notification_send( $text_not,$user_send_new,$id_user,$link);




                //sms партнеру
//отправляем sms уведомления
                include_once $url_system.'module/config_sms.php';
                $sms_phone=SearchSmsUser($link,$row_tr["id_affiliates"]);
                if($sms_phone)
                {
//	79021296867
//отправляем смс мне на телефон что пришла свободная заявка
//$sms='Вам поступила новая задача №'.$ID_N.' на исполнение. Подробности: www.ok.i-s.group/task/'.$ID_N.'/';

//
                    $sms='Вам бонус +'.$comm.' RUB https://ok.umatravel.club/';
//$sms='Новая задача «'.mb_strimwidth(trim($_POST['comment_b']), 0, smscount($sms), "",'utf-8').'...» www.ok.i-s.group/task/'.$ID_N.'/';



                    $ksms=send_sms("api.smsfeedback.ru", 80,$smsfeedbackname, $smsfeedbackpasswd,$sms_phone, $sms, $smspodpis);
                    $ksms1=explode(';',$ksms);
                    $key_sms=$ksms1[0];

//заносим в базу что такая смс отправлена или нет
                    $send=0;
                    if($ksms1[0]=='accepted')
                    {
                        $send=1;
                    }

                    mysql_time_query($link,'INSERT INTO sms (id_user,text,datetimes,phone,send,response) VALUES ("'.$row_tr["id_affiliates"].'","'.htmlspecialchars(trim($sms)).'","'.date("y.m.d").' '.date("H:i:s").'","'.$sms_phone.'","'.$send.'","'.htmlspecialchars(trim($ksms)).'")');

                }

            }
        }
    }
}

//проверяем включены ли у него смс уведомления
//0 - нет или не заполнен телефон или неправильный формат
//если все ок - возвращает номер телефона в нужном формате для отправки смс
function SearchSmsUser($link,$id)
{
    $er=0;
    $result_tx=mysql_time_query($link,'Select a.phone from r_user as a where a.id="'.htmlspecialchars(trim($id)).'"');
    $rowx = mysqli_fetch_assoc($result_tx);
    if(trim($rowx["phone"])!='')
    {
        //смотрим соответствует ли формат номера нужному нам
        //+7 (000) 000-00-00
        $phoneNumber = preg_replace('/\s|\+|-|—|\(|\)/','', $rowx["phone"]); // удалим пробелы, и прочие не нужные знаки
        //echo($phoneNumber);
        if((is_numeric($phoneNumber))and(strlen($phoneNumber) == 10))
        {

                $er='7'.$phoneNumber;


        }


    }
    return $er;
}

/**
 * рассчитать конечную комиссию  партнера по туру с учетом всех потерь и комиссий перечислений
 *
 */

function comiss_end_ship($id_trips,$link)
{
    global $id_company;
    $comm_rub=0;
    $ppro=0;
    $result_uu = mysql_time_query($link, 'select id_exchange,paid_client,paid_operator,id,id_promo from trips  where id="' . ht($id_trips) . '"');
    $num_results_uu = $result_uu->num_rows;

    if ($num_results_uu != 0) {
        $row_8 = mysqli_fetch_assoc($result_uu);


        $result_uu_rate = mysql_time_query($link, 'select a.char,a.small_name,a.code from booking_exchange as a  where a.id="' . ht($row_8["id_exchange"]) . '"');
        $num_results_uu_rate = $result_uu_rate->num_rows;

        if ($num_results_uu_rate != 0) {
            $row_uu_rate = mysqli_fetch_assoc($result_uu_rate);
        }


        if ($row_uu_rate["char"] == "₽") {
            //только рублевый тур
            //все оплатили
            $comm_rub=$row_8["paid_client"]-$row_8["paid_operator"];
        } else
        {
            //валютный тур
            $comm_rub=$row_8["paid_client"]-$row_8["paid_operator"];
        }


        //еще есть потери от комиссий

        $result_poteri = mysql_time_query($link, 'select sum(A.commission) as vse from trips_payment as A where A.id_trips="' . ht($row_8["id"]) . '" and A.visible=1');
        $num_results_poteri = $result_poteri->num_rows;

        if ($num_results_poteri != 0) {
            $row_poteri = mysqli_fetch_assoc($result_poteri);
            $comm_rub=$comm_rub-$row_poteri["vse"];
        }

        //еще есть потери от партнерки если связано
        //партнерская комиссия если есть

        $proc_ship=partners_trips($row_8["id"],$id_company,$link);
//echo($proc_ship);
        if($proc_ship!=0)
        {
            //потери которые еще состоялись
            $ppro=round((($comm_rub*$proc_ship)/100),2);
            //$comm_rub=$comm_rub-$ppro;


        }

    }
    return  $ppro;
}


/**
 * рассчитать конечную комиссию по туру с учетом всех потерь и комиссий перечислений
 *
 */

function comiss_end_call($id_trips,$link)
{
    global $id_company;
    $comm_rub=0;
    $result_uu = mysql_time_query($link, 'select id_exchange,paid_client,paid_operator,id,id_promo from trips  where id="' . ht($id_trips) . '"');
    $num_results_uu = $result_uu->num_rows;

    if ($num_results_uu != 0) {
        $row_8 = mysqli_fetch_assoc($result_uu);


        $result_uu_rate = mysql_time_query($link, 'select a.char,a.small_name,a.code from booking_exchange as a  where a.id="' . ht($row_8["id_exchange"]) . '"');
        $num_results_uu_rate = $result_uu_rate->num_rows;

        if ($num_results_uu_rate != 0) {
            $row_uu_rate = mysqli_fetch_assoc($result_uu_rate);
        }


        if ($row_uu_rate["char"] == "₽") {
            //только рублевый тур
                //все оплатили
                $comm_rub=$row_8["paid_client"]-$row_8["paid_operator"];
        } else
        {
            //валютный тур
                $comm_rub=$row_8["paid_client"]-$row_8["paid_operator"];
        }


        //еще есть потери от комиссий

        $result_poteri = mysql_time_query($link, 'select sum(A.commission) as vse from trips_payment as A where A.id_trips="' . ht($row_8["id"]) . '" and A.visible=1');
        $num_results_poteri = $result_poteri->num_rows;

        if ($num_results_poteri != 0) {
            $row_poteri = mysqli_fetch_assoc($result_poteri);
            $comm_rub=$comm_rub-$row_poteri["vse"];
        }

        //еще есть потери от партнерки если связано
        //партнерская комиссия если есть
        $ppro=0;
        $proc_ship=partners_trips($row_8["id"],$id_company,$link);
//echo($proc_ship);
        if($proc_ship!=0)
        {
            //потери которые еще состоялись
            $ppro=round((($comm_rub*$proc_ship)/100),2);
            //$comm_rub=$comm_rub-$ppro;
            $comm_rub=$comm_rub - $ppro;

        }

    }
    return  $comm_rub;
}


/**
 * определяем какой процент оплачен по туру
 * @param $id_trips id тура
 * @param $type тип 0-клиент 1-оператор
 */

function proc_call($id_trips,$type,$link)
{
    $procr=0;

    $result_uu_rate=mysql_time_query($link,'select a.char,a.small_name,a.code,b.paid_client,b.cost_client,b.paid_client_rates,b.cost_client_exchange,b.paid_operator,b.cost_operator,b.paid_operator_rates,b.cost_operator_exchange,b.buy_clients,b.buy_operator from booking_exchange as a,trips as b  where b.id_exchange=a.id and b.id="'.ht($id_trips).'"');
    $num_results_uu_rate = $result_uu_rate->num_rows;

    if($num_results_uu_rate!=0) {
        $row_uu_rate = mysqli_fetch_assoc($result_uu_rate);


        if ($type == 0) {
            //клиент
if($row_uu_rate["buy_clients"]!=1) {
//определим сколько выплатил клиент
    if ($row_uu_rate["char"] == "₽") {

        $sum_rub = (float)$row_uu_rate["paid_client"];
        $procr = floor(($sum_rub * 100) / $row_uu_rate["cost_client"]);

    } else {
        //значит выводим в валюте потому что остаток клиент отдает в валюте

        $sum_rub = (float)$row_uu_rate["paid_client_rates"];
        $procr = floor(($sum_rub * 100) / $row_uu_rate["cost_client_exchange"]);
    }
} else
{
    $procr=100;
}
        }
        if ($type == 1) {
            //оператор
            if($row_uu_rate["buy_operator"]!=1) {
                if ($row_uu_rate["char"] == "₽") {

                    $sum_rub = (float)$row_uu_rate["paid_operator"];
                    if ($row_uu_rate["cost_operator"] > 0) {
                        $procr = floor(($sum_rub * 100) / $row_uu_rate["cost_operator"]);
                    } else {
                        $procr = 0;
                    }

                } else {
                    //значит выводим в валюте потому что остаток клиент отдает в валюте

                    $sum_rub = (float)$row_uu_rate["paid_operator_rates"];
                    if ($row_uu_rate["cost_operator_exchange"] > 0) {

                        $procr = floor(($sum_rub * 100) / $row_uu_rate["cost_operator_exchange"]);
                    } else {
                        $procr = 0;
                    }
                }
            } else
            {
                $procr=100;
            }
        }
    }
    return $procr;
}








//перевод даты из формата 15.07.2020 в формат 2020-07-15 (sql)  -> ex=1
//перевод даты из формата 2020-07-15 (sql) в формат 15.07.2020  -> ex=0

function date_ex($ex,$date)
{
    if(($date!='')and($date!='00.00.0000')and($date!='0000-00-00'))
    {
    if($ex==1) {
        $date_ex = explode(".", htmlspecialchars(trim($date)));
        $date_start = $date_ex[2] . '-' . $date_ex[1] . '-' . $date_ex[0];
    } else
    {
        $date_ex = explode("-", htmlspecialchars(trim($date)));
        $date_start = $date_ex[2] . '.' . $date_ex[1] . '.' . $date_ex[0];
    }
    }
    return  $date_start;
}


function date_ex_plus_time($ex,$date)
{
    if(($date!='')and($date!='00.00.0000 00:00:00')and($date!='0000-00-00 00:00:00'))
    {
        if($ex==1) {
            $date_ex2 = explode(" ", htmlspecialchars(trim($date)));
            $date_ex = explode(".", $date_ex2[0]);
            $date_start = $date_ex[2] . '-' . $date_ex[1] . '-' . $date_ex[0].' '.$date_ex2[1];
        } else
        {
            $date_ex2 = explode(" ", htmlspecialchars(trim($date)));
            $date_ex = explode("-", $date_ex2[0]);
            $date_start = $date_ex[2] . '.' . $date_ex[1] . '.' . $date_ex[0].' '.$date_ex2[1];
        }
    }
    return  $date_start;
}


//название для файлов на сервере
function rand_string_string_image($len, $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789_')
{
    $string = ''; for ($i = 0; $i < $len; $i++)
{
    $pos = rand(0, strlen($chars)-1);
    $string .= $chars[$pos];
}
    return $string;
}

/**
 * Возвращает сумму прописью
 * @author runcore
 * @uses morph(...)
 */
function num2str($num) {
    $nul='ноль';
    $ten=array(
        array('','один','два','три','четыре','пять','шесть','семь', 'восемь','девять'),
        array('','одна','две','три','четыре','пять','шесть','семь', 'восемь','девять'),
    );
    $a20=array('десять','одиннадцать','двенадцать','тринадцать','четырнадцать' ,'пятнадцать','шестнадцать','семнадцать','восемнадцать','девятнадцать');
    $tens=array(2=>'двадцать','тридцать','сорок','пятьдесят','шестьдесят','семьдесят' ,'восемьдесят','девяносто');
    $hundred=array('','сто','двести','триста','четыреста','пятьсот','шестьсот', 'семьсот','восемьсот','девятьсот');
    $unit=array( // Units
        array('копейка' ,'копейки' ,'копеек',	 1),
        array('рубль'   ,'рубля'   ,'рублей'    ,0),
        array('тысяча'  ,'тысячи'  ,'тысяч'     ,1),
        array('миллион' ,'миллиона','миллионов' ,0),
        array('миллиард','милиарда','миллиардов',0),
    );
    //
    list($rub,$kop) = explode('.',sprintf("%015.2f", floatval($num)));
    $out = array();
    if (intval($rub)>0) {
        foreach(str_split($rub,3) as $uk=>$v) { // by 3 symbols
            if (!intval($v)) continue;
            $uk = sizeof($unit)-$uk-1; // unit key
            $gender = $unit[$uk][3];
            list($i1,$i2,$i3) = array_map('intval',str_split($v,1));
            // mega-logic
            $out[] = $hundred[$i1]; # 1xx-9xx
            if ($i2>1) $out[]= $tens[$i2].' '.$ten[$gender][$i3]; # 20-99
            else $out[]= $i2>0 ? $a20[$i3] : $ten[$gender][$i3]; # 10-19 | 1-9
            // units without rub & kop
            if ($uk>1) $out[]= morph($v,$unit[$uk][0],$unit[$uk][1],$unit[$uk][2]);
        } //foreach
    }
    else $out[] = $nul;
    $out[] = morph(intval($rub), $unit[1][0],$unit[1][1],$unit[1][2]); // rub
    $out[] = $kop.' '.morph($kop,$unit[0][0],$unit[0][1],$unit[0][2]); // kop
    return trim(preg_replace('/ {2,}/', ' ', join(' ',$out)));
}

/**
 * Склоняем словоформу
 * @ author runcore
 */
function morph($n, $f1, $f2, $f5) {
    $n = abs(intval($n)) % 100;
    if ($n>10 && $n<20) return $f5;
    $n = $n % 10;
    if ($n>1 && $n<5) return $f2;
    if ($n==1) return $f1;
    return $f5;
}



//функция приведения телефона к виду нормальному
//9021296867 
function phone_format($phone)
{
	$new_format='';
	  for ($ist=0; $ist<10; $ist++)
  {
	
	if(isset($phone[$ist]))
	{
		$var_char=$phone[$ist];		
	} else
	{
		$var_char=' ';		
	}
		  
	switch($ist)
     {
		 case "0":{
			 //свободный комментарий
			 $new_format.='+7 ('.$var_char;
			 
			 break; 
                  }
		 case "1":
		 case "2":
		 case "4":
		case "5":
		case "7":
        case "9":
			{
			 $new_format.=$var_char;			 			 
			 break; 
		 }
		 case "3":{
			  $new_format.=') '.$var_char;
			 
			 break; 
		 }
		 case "6":
		 case "8":
			{
			 $new_format.='-'.$var_char;
			 
			 break; 
		 }	
			}
	  }
	return $new_format;

	  }

//проверка ввода валидности даты
function validateDate($date, $format = 'd.m.Y H:i:s')
{
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}
/*
var_dump(validateDate('2012-02-28 12:12:12')); # true
var_dump(validateDate('2012-02-30 12:12:12')); # false
var_dump(validateDate('2012-02-28', 'Y-m-d')); # true
var_dump(validateDate('28/02/2012', 'd/m/Y')); # true
var_dump(validateDate('30/02/2012', 'd/m/Y')); # false
var_dump(validateDate('14:50', 'H:i')); # true
var_dump(validateDate('14:77', 'H:i')); # false
*/

//взятие файла с последней версией
/*
index-0.0.2.js
main-0.4.6.js
*/	
/*
version_file('/Js/','index','js')

function ve($dir,$name,$extension)
{
	$end_version='';
	
	$scan_result = scandir( $dir );
    foreach ( $scan_result as $key => $value ) {	

		if ( !in_array( $value, array( '.', '..' ) ) ) {
			
			  $type = explode( '.', $value ); 
              $type = array_reverse( $type );
              if( in_array( $type[0], $extension ) ) {
				
				  	$type1 = explode( '-', $value ); 
                    if( in_array( $type1[0], $name ) ) {
						
					}
				  
			  }
			
		}
		
	}
	
return 	$dir.$name.$end_version.'.'.$extension;
	
}
*/	
//обновление ключа по задачам для обновления на всех страницах
function UpdateTaskKey($id_user_responsible,$link)
{
	$noti_key=new_key_task($link,10);
    mysql_time_query($link,'update r_user set task_key="'.$noti_key.'" where id = "'.ht($id_user_responsible).'"');
}


function calendar_var($date,$id_cal,$id_hid)
{

if($date!='')
{
	
$query_string='<script type="text/javascript"> $(document).ready(function(){
	 var date_v11=\''.$date.'\';
	 	
		$(\''.$id_hid.'\').val(\''.$date.'\');
	
	var dateParts = date_v11.match(/(\d+)/g), realDate = new Date(dateParts[0], dateParts[1] -1, dateParts[2]); 

$(\''.$id_cal.'\').datepicker({ dateFormat: \'yy-mm-dd\' });		
$(\''.$id_cal.'\').datepicker(\'setDate\', realDate);	 
	
	});
	</script>';
}	
	return 	$query_string;
}

function calendar_add($box,$id_cal,$id_hid)
{
	
$query_string='<script type="text/javascript">var disabledDays = [];
 $(document).ready(function(){        
   $("'.$id_cal.'").datepicker({ 
altField:\''.$id_hid.'\',
onClose : function(dateText, inst){	
    },
altFormat:\'yy-mm-dd\',
defaultDate:null,
beforeShowDay: disableAllTheseDays,
dateFormat: "d MM yy", 
firstDay: 1,
minDate: "-3M", 
maxDate: "+3M",
onSelect: function(dateText) {

$("'.$id_cal.'").parents(\'.input_2018\').addClass(\'active_in_2018\');
	},
beforeShow:function(textbox, instance){	
	setTimeout(function () {
            instance.dpDiv.css({
                position: \'absolute\',
				top: 0,
                left: 0
            });
		

		var html = $(\'.ui-datepicker:last\'); 
		$(\''.$box.'\').append(html);
        }, 10);
	
 
} });
 });
	 
function resizeDatepicker() {
    setTimeout(function() { $(\''.$box.' > .ui-datepicker\').width(\'100%\'); }, 10);
}	 

function jopacalendar(queryDate,queryDate1,date_all) 
	{
	
if(date_all!=\'\')
	{
var dateParts = queryDate.match(/(\d+)/g), realDate = new Date(dateParts[0], dateParts[1] -1, dateParts[2]); 
var dateParts1 = queryDate1.match(/(\d+)/g), realDate1 = new Date(dateParts1[0], dateParts1[1] -1, dateParts1[2]); 	 	 
	}
	}	 
	 
</script>';
	
return 	$query_string;
	
}


 function ht($varr)
{
return(htmlspecialchars(trim($varr)));
	
}


 function htd($varr)
{
//return(htmlspecialchars_decode($varr));
	 
	 return html_entity_decode($varr, ENT_NOQUOTES, 'utf-8');
	
}


 function password_crypt_x($id_user,$pas,$email)
{
$chars = $email.$email.$email.$email.$email.$email;
$posl_chifra_id=$id_user%10;
$ch=10+$posl_chifra_id;	
$st=$email.$email;
$st_1 = substr($st, 0, $posl_chifra_id);
$st_2= substr($st, $posl_chifra_id);
$crypt=sha1($st_1.$id_user.$pas.$chars[$ch].$st_2); 	
return($crypt);	
}

// rooo($row["name"],'','—')
function rooo($row, $val,$roo)
{
  $echo=$roo;
  if($row!=$val)
  {
	$echo=$row;
  }	
	return $echo;
}

function h4a($er,$echo,$debug)
{
    global $link;
        $date_ = date("y.m.d") . ' ' . date("H:i:s");
        $url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        //echo $url;

        mysql_time_query($link, 'INSERT INTO debug(url,datetime,error,debug) VALUES( 
    "' . ht($url) . '","' . ht($date_) . '","' . $er . '","")');

	if($echo==0)
	{

	$url_system=$_SERVER['DOCUMENT_ROOT'].'/';
   header("HTTP/1.1 404 Not Found");
   header("Status: 404 Not Found");
   die();	
	} else
	{
		$debug.=''.$er;
		return $debug;
	}	
}

function header404($er,$echo)
{
	$url_system=$_SERVER['DOCUMENT_ROOT'].'/';
   header("HTTP/1.1 404 Not Found");
   header("Status: 404 Not Found");
	if($echo!=0)
	{
	echo($er);
	}
   include $url_system.'module/error404.php';
   die();
}

		  
//выводить аватар или заглушку
function avatar_img($img_start,$id,$img_end)
{
	$url_system1=$_SERVER['DOCUMENT_ROOT'].'/';
	$filename=$url_system1.'img/users/'.$id.'_100x100.jpg';
    if (file_exists($filename)) {
		return ($img_start.$id.$img_end);
    } else
    {
	   return ($img_start.'0'.$img_end);
    }
}


//выделение тегом в тексте нужного текста
function search_text_strong($regime,$search,$beginText)
{
	$search=mb_convert_case($search, MB_CASE_LOWER, "UTF-8");
	$beginText=mb_convert_case($beginText, MB_CASE_LOWER, "UTF-8");
	
//$regime    //Режим поиска (1 - точный поиск, 0 - вхождение)
//$search    // Что ищем (в примере: $search = "про"; )
//$beginText // Текст по которому необходимо провести поиск
 
/* Точный поиск. (Найдёт: "...не [B]про[/B] меня", 
Не найдёт "Этот ком[U]про[/U]мат не..." - ) отдельное слово */

if($regime == 1)                                       
  { $patterns = "/(\b".$search."\b)+/i"; }// Регулярное выражение
 
 
/* Отдельное слово и Вхождение в другие слова. 
(Найдёт: "...не [B]про[/B] меня", 
Найдёт: "Этот ком[B]про[/B]мат не...") */
else                                                       
  { $patterns = "/(".$search.")+/i"; }// Регулярное выражение
 
$replace = "<strong>$1</strong>";// На что заменить

setlocale(LC_ALL, 'ru_RU.CP1251'); 
$endText = PREG_REPLACE($patterns,$replace,$beginText);// Замена
 
return $endText;
}
	

//определение количества непрочитанных сообщений с этим пользователем
function no_view_message($id,$id_user,$link)
{
	$count_new_message=0;
	$result_tx=mysql_time_query($link,'select count(a.id) as kol from r_message as a where a.status=1 and a.id_user="'.htmlspecialchars(trim($id_user)).'" and a.id_sign="'.htmlspecialchars(trim($id)).'"');
        $num_results_tx = $result_tx->num_rows;
	    if($num_results_tx!=0)
	    { 
			$rowx = mysqli_fetch_assoc($result_tx);
			$count_new_message=$rowx["kol"];
		}
  return $count_new_message;
}
	


//открытие нового диалога при отправки сообщения
/*
id- кому отправили
id_user - кто отправил	
*/
function dialog($id,$id_user,$link)
{
	    //изменяем если нужно диалог у того кому отправили
		$result_tx=mysql_time_query($link,'Select a.* from r_dialog as a where a.id_user="'.htmlspecialchars(trim($id)).'" and a.dialog_user="'.htmlspecialchars(trim($id_user)).'"');
        $num_results_tx = $result_tx->num_rows;
	    if($num_results_tx==0)
	    {  
		  mysql_time_query($link,'INSERT INTO r_dialog (id_user,dialog_user) VALUES ("'.htmlspecialchars(trim($id)).'","'.htmlspecialchars(trim($id_user)).'")');		  	
		}
	
	    //изменяем если нужно диалог тот кто отправил
		$result_tx=mysql_time_query($link,'Select a.* from r_dialog as a where a.id_user="'.htmlspecialchars(trim($id_user)).'" and a.dialog_user="'.htmlspecialchars(trim($id)).'"');
        $num_results_tx = $result_tx->num_rows;
	    if($num_results_tx==0)
	    {  
		  mysql_time_query($link,'INSERT INTO r_dialog (id_user,dialog_user) VALUES ("'.htmlspecialchars(trim($id_user)).'","'.htmlspecialchars(trim($id)).'")');		  	
		}			
	
}


//Узнаем онлайн пользователь или нет
function online_user($times,$id_user,$you_id)
{
	//echo($id_user);
	//echo($you_id);
  $conts_razn= 5*60; //5 минут	
  $time_yes=time();
  if((($time_yes-$times)<$conts_razn)and($id_user!=$you_id))
  {
	  return true;
  } else
  {
	  return false;
  }

}

//получение даты с шагом от какой то даты
//только в формате Y-m-d
//date_step('2020-07-01','+1m')
function date_step_sql_more($date,$step)
{
    $char='-';

    $maski1 = explode('-', $date);
    $maski= array('Y','m','d');

    $m=0; $d=0; $y=0;
    $minus_plus=$step[0];
    $na=substr($step, 1);
    $na=substr($na, 0, -1);



    if($step[(strlen($step)-1)]=='Y')
    {
        $y=(int)($minus_plus.$na);
    }
    if($step[(strlen($step)-1)]=='m')
    {
        $m=(int)($minus_plus.$na);
    }
    if($step[(strlen($step)-1)]=='d')
    {
        $d=(int)($minus_plus.$na);
    }
    $date_step='';
    for ($ksss=0; $ksss<count($maski); $ksss++)
    {
        if($ksss==0)
        {
            $date_step=date($maski[$ksss], mktime(date("G"), date("i"), date("s"), ((int)date_minus_null($maski1[1])+$m),((int)date_minus_null($maski1[2])+$d), ((int)date_minus_null($maski1[0])+$y)));
        } else
        {
            $date_step=$date_step.$char.date($maski[$ksss], mktime(date("G"), date("i"), date("s"), ((int)date_minus_null($maski1[1])+$m),((int)date_minus_null($maski1[2])+$d), ((int)date_minus_null($maski1[0])+$y)));
        }
    }

    return  $date_step;
}


//получение даты с шагом
//date_step('Y-m-d','+14Y')
function date_step_sql($mask,$step)
{
	$char='';
	if (strpos($mask, '-') !== false) { $char='-'; }
	if (strpos($mask, '.') !== false) { $char='.'; }
	if (strpos($mask, ':') !== false) { $char=':'; }
	if (strpos($mask, '/') !== false) { $char='/'; }	
	if($char!='') {
        $maski = explode($char, $mask);
    } else
    {
        $maski = explode('-', $mask);
    }
  $m=0; $d=0; $y=0;
$minus_plus=$step[0];	
$na=substr($step, 1);	
$na=substr($na, 0, -1);
	
	
	
  if($step[(strlen($step)-1)]=='Y')
  {	
	  $y=(int)($minus_plus.$na);
  }
  if($step[(strlen($step)-1)]=='m')
  {	
	  $m=(int)($minus_plus.$na);
  }
  if($step[(strlen($step)-1)]=='d')
  {	
	  $d=(int)($minus_plus.$na);
  }	
	$date_step='';
		       for ($ksss=0; $ksss<count($maski); $ksss++)
               {
				  if($ksss==0) 
				  {
					  $date_step=date($maski[$ksss], mktime(date("G"), date("i"), date("s"), (date("n")+$m),(date("j")+$d), (date("Y")+$y)));
				  } else
				  {
					  $date_step=$date_step.$char.date($maski[$ksss], mktime(date("G"), date("i"), date("s"), (date("n")+$m),(date("j")+$d), (date("Y")+$y)));
				  }
			   } 
  
	return  $date_step;
}


//ОТПРАВКА ЗАДАЧИ ПО МАССИВУ ОБЪЕКТОВ
//ОТПРАВКА УВЕДОМЛЕНИЯ ВСЕМ КРОМЕ АДМИНА ЧТО ПОСТУПИЛА НОВАЯ ЗАДАЧА


function TASK_SEND($text,$object_mass,$id_object,$click,$action,$link,$user_mass= array())
{
	$today = date("y.m.d"); //присвоено 03.12.01
	
	//задачи по точки продаж
	foreach ($object_mass as $keys => $value) 
	{		
		$code='';
		if($action==7) {$code='user';}
		mysql_time_query($link,'INSERT INTO task (id_user,id_object,title,id_booking,date,status,click,action,code) VALUES ("0","'.$value.'","'.htmlspecialchars(trim($text)).'","'.$id_object.'","'.$today.'","0","'.$click.'","'.$action.'","'.$code.'")');
		$ID_N=mysqli_insert_id($link);  
		
		mysql_time_query($link,'INSERT INTO task_status_history (id_task,id_user,datetime,status) VALUES ("'.$ID_N.'","0","'.date("y.m.d").' '.date("H:i:s").'","0")');
		
		$result_8 = mysql_time_query($link,'select distinct A.id_user from r_user_object as A,r_user as B WHERE A.id_user=B.id and not(B.id_role=1) and A.enabled=1 and A.id_object="'.$value.'"');
$num_8 = $result_8->num_rows;	
//$row_1 = mysqli_fetch_assoc($result2);
if($result_8)
{	
  while($row_8 = mysqli_fetch_assoc($result_8)){ 
		
		
		$text1='Вам поступила новая задача - '.$text;
		
		mysql_time_query($link,'INSERT INTO r_notification (id_user,notification,sign_user,datetime ) VALUES ("'.$row_8["id_user"].'","'.htmlspecialchars(trim($text1)).'","0","'.date("y.m.d").' '.date("H:i:s").'")');
		$noti_key=new_key($link,10);
		mysql_time_query($link,'update r_user set noti_key="'.$noti_key.'" where id = "'.htmlspecialchars(trim($row_8["id_user"])).'"');
  }
}
		
	}
	
	//задачи по клиентам
	foreach ($user_mass as $keys => $value) 
	{	
		//добавление задачи
		$code='';
		if($action==7) {$code='user';}
		mysql_time_query($link,'INSERT INTO task (id_user,id_object,title,id_booking,date,status,click,action,code ) VALUES ("'.$value.'","0","'.htmlspecialchars(trim($text)).'","'.$id_object.'","'.$today.'","0","'.$click.'","'.$action.'","'.$code.'")');
		$ID_N=mysqli_insert_id($link);  
		
		//добавление в историю задач
		mysql_time_query($link,'INSERT INTO task_status_history (id_task,id_user,datetime,status) VALUES ("'.$ID_N.'","0","'.date("y.m.d").' '.date("H:i:s").'","0")');
				
		//уведомление о новой задаче
		$text1='Вам поступила новая задача - '.$text;
		mysql_time_query($link,'INSERT INTO r_notification (id_user,notification,sign_user,datetime ) VALUES ("'.$value.'","'.htmlspecialchars(trim($text1)).'","0","'.date("y.m.d").' '.date("H:i:s").'")');
		$noti_key=new_key($link,10);
		mysql_time_query($link,'update r_user set noti_key="'.$noti_key.'" where id = "'.$value.'"');

		
	}	
	
	
}

//удалить запись по оплате со всеми изменениями в базе
function dell_buy_trips($id_buy,$link)
{


    $result_8 = mysql_time_query($link, 'select A.* from trips_payment as A where A.id="' . ht($id_buy) . '"');
    $num_results_8 = $result_8->num_rows;

    if ($num_results_8 != 0) {
        $row_8 = mysqli_fetch_assoc($result_8);


        $result_uu = mysql_time_query($link, 'select A.id_exchange,
A.cost_client,                     
A.cost_client_exchange,                   
A.exchange_rates,                             
A.cost_operator,                                 
A.cost_operator_exchange,                            
A.paid_client,                           
A.paid_client_rates,                                
A.paid_operator,                  
A.paid_operator_rates,                  
A.discount,                                                      
A.commission,
A.buy_clients,                   
A.buy_operator
   
   from trips as A where A.id="' . ht($row_8["id_trips"]) . '"');

        $num_results_uu = $result_uu->num_rows;



        if ($num_results_uu != 0) {
            $row_uu = mysqli_fetch_assoc($result_uu);

            $new_paid_client = $row_uu["paid_client"];
            $new_paid_client_rates = $row_uu["paid_client_rates"];
            $new_paid_operator = $row_uu["paid_operator"];
            $new_paid_operator_rates = $row_uu["paid_operator_rates"];
            $new_buy_client = $row_uu["buy_clients"];
            $new_buy_operator = $row_uu["buy_operator"];

            $result_uu_rate = mysql_time_query($link, 'select a.char,a.small_name,a.code from booking_exchange as a  where a.id="' . ht($row_uu["id_exchange"]) . '"');
            $num_results_uu_rate = $result_uu_rate->num_rows;

            if ($num_results_uu_rate != 0) {
                $row_uu_rate = mysqli_fetch_assoc($result_uu_rate);
            }

            $style_kurs = 0;
            if ($row_uu_rate["char"] == "₽") {
//рублевый тур

            } else {
//значит выводим в валюте потому что остаток клиент отдает в валюте
                $style_kurs = 1;

            }


            if ($row_8["who"] == 0) {
                //клиент
                if ($row_8["id_operation"] == 1) {
                    //оплата клиентом
if($style_kurs==0)
{
    //рублевый
    $new_paid_client = round(((float)$row_uu["paid_client"]-(float)$row_8["sum"]),2);
    if($new_paid_client<round($row_uu["cost_client"],2))
    {
        $new_buy_client=0;
    }
} else
{
    //валютный
    $new_paid_client = round(((float)$row_uu["paid_client"]-(float)$row_8["sum"]),2);
    $new_paid_client_rates = round(((float)$row_uu["paid_client_rates"]-(float)$row_8["sum_rate"]),2);
    if($new_paid_client_rates<round($row_uu["cost_client_exchange"],2))
    {
        $new_buy_client=0;
    }
}

                }
                if ($row_8["id_operation"] == 2) {
                    //возврат клиенту
                    if($style_kurs==0)
                    {
                        //рублевый
                        $new_paid_client = round(((float)$row_uu["paid_client"]+(float)$row_8["sum"]),2);
                        if($new_paid_client<round($row_uu["cost_client"],2))
                        {
                            $new_buy_client=0;
                        }
                    } else
                    {
                        //валютный
                        $new_paid_client = round(((float)$row_uu["paid_client"]+(float)$row_8["sum"]),2);
                        $new_paid_client_rates = round(((float)$row_uu["paid_client_rates"]+(float)$row_8["sum_rate"]),2);
                        if($new_paid_client_rates<round($row_uu["cost_client_exchange"],2))
                        {
                            $new_buy_client=0;
                        }
                    }
                }
            }
            if ($row_8["who"] == 1) {
                //туроператор
                if ($row_8["id_operation"] == 1) {
                    //оплата туроператору
                    if($style_kurs==0)
                    {
                        //рублевый
                        $new_paid_operator = round(((float)$row_uu["paid_operator"]-(float)$row_8["sum"]),2);
                        if($new_paid_operator<round($row_uu["cost_operator"],2))
                        {
                            $new_buy_operator=0;
                        }
                    } else
                    {
                        //валютный
                        $new_paid_operator = round(((float)$row_uu["paid_operator"]-(float)$row_8["sum"]),2);
                        $new_paid_operator_rates = round(((float)$row_uu["paid_operator_rates"]-(float)$row_8["sum_rate"]),2);
                        if($new_paid_operator_rates<round($row_uu["cost_operator_exchange"],2))
                        {
                            $new_buy_operator=0;
                        }
                    }



                }
                if ($row_8["id_operation"] == 2) {
                    //возврат от туроператора
                    if($style_kurs==0)
                    {
                        //                        //рублевый
                        $new_paid_operator = round(((float)$row_uu["paid_operator"]+(float)$row_8["sum"]),2);
                        if($new_paid_operator<round($row_uu["cost_operator"],2))
                        {
                            $new_buy_operator=0;
                        }
                    } else
                    {
                        //валютный
                        $new_paid_operator = round(((float)$row_uu["paid_operator"]+(float)$row_8["sum"]),2);
                        $new_paid_operator_rates = round(((float)$row_uu["paid_operator_rates"]+(float)$row_8["sum_rate"]),2);
                        if($new_paid_operator_rates<round($row_uu["cost_operator_exchange"],2))
                        {
                            $new_buy_operator=0;
                        }
                    }
                }
            }

            mysql_time_query($link, 'update trips set
            
paid_client="'.$new_paid_client.'",                               
paid_client_rates="'.$new_paid_client_rates.'",                            
paid_operator="'.$new_paid_operator.'",               
paid_operator_rates="'.$new_paid_operator_rates.'", 
buy_clients="'.$new_buy_client.'",                  
buy_operator="'.$new_buy_operator.'" 
            
            where id = "' . ht($row_8["id_trips"]) . '"');


        }
    }
}


function AddHistoryPreordersAll($id_task,
                            $array_param_old,
                            $array_param_new,
                            $array_param_comm,
                            $link
)
{
    $edit=0;
    $comment='';
    $zap=0;
    //формируем запись что изменилось в историю
    foreach ( $array_param_old as $key => $value ) {

        if($value!=$array_param_new[$key])
        {
            //что то изменилось в этом свойстве
            if($zap!=0) {$comment .= ', ';}
            $comment .= $array_param_comm[$key].' с '.$value.' на '.$array_param_new[$key].'';

            $zap++;

        }

    }
    if($zap!=0)
    {
        return $comment;
    } else
    {
        return '0';
    }



}

//СМОТРИМ ЕСТЬ ЛИ ИЗМЕНЕНИЯ И ФОРМИРУЕМ ТЕКСТ ДЛЯ ИСТОРИИ ТУРА
function AddHistoryTripsAll($id_task,
                            $array_param_old,
                            $array_param_new,
                            $array_param_comm,
                            $link
                            )
{
    $edit=0;
    $comment='';
    $zap=0;
    //формируем запись что изменилось в историю
    foreach ( $array_param_old as $key => $value ) {

        if($value!=$array_param_new[$key])
        {
            //что то изменилось в этом свойстве
            if($zap!=0) {$comment .= ', ';}
                    $comment .= $array_param_comm[$key].' с '.$value.' на '.$array_param_new[$key].'';

            $zap++;

        }

    }
    if($zap!=0)
    {
        return $comment;
    } else
    {
        return '0';
    }



}


//ДОБАВЛЕНИЕ ИСТОРИИ ПО ТУРУ ИЗМЕНЕНИЕ времени вылета
function AddHistoryTripsFly($action,
                              $id_user,
                              $id_task,
                              $array_param_old,
                              $array_param_new,
                              $link,
                              $comment_sys)
{
    $edit=0;
    $comment='Изменение времени вылета по туру №'.$id_task.' → ';
    $zap=0;
    //формируем запись что изменилось в историю
    foreach ( $array_param_old as $key => $value ) {

        if($value!=$array_param_new[$key])
        {
            //что то изменилось в этом свойстве
            if($zap!=0) {$comment .= ', ';}
            switch($key) {
                case "0":
                {
                    //Турист вылетает на отдых
                    $comment .= 'время вылета на отдых с '.task_st1($value).' на '.task_st1($array_param_new[$key]).'';
                    break;
                }
                case "1":
                {
                    //Турист вылетает с отдых
                    $comment .= 'время вылета c отдых с '.task_st1($value).' на '.task_st1($array_param_new[$key]).'';
                    break;
                }

            }
            $zap++;

        }

    }

    mysql_time_query($link,'INSERT INTO trips_status_history_new (id_trips,action_history,id_user,datetimes,edit,comment,comment_sys) VALUES ("'.ht($id_task).'","'.ht($action).'",
		"'.ht($id_user).'",
		"'.date("Y-m-d").' '.date("H:i:s").'",
		"'.$edit.'",
		"'.ht($comment).'",
		"'.ht($comment_sys).'")');

}


//ДОБАВЛЕНИЕ ИСТОРИИ ПО ТУРУ ИЗМЕНЕНИЕ СТОИМОСТИ
function AddHistoryTripsPrice($action,
                            $id_user,
                            $id_task,
                            $rate,
                            $array_param_old,
                            $array_param_new,
                            $link,
                            $comment_sys)
{
    $edit=0;
    $comment='Изменение стоимости по туру №'.$id_task.' → ';
    $zap=0;
    //формируем запись что изменилось в историю
    foreach ( $array_param_old as $key => $value ) {

        if($value!=$array_param_new[$key])
        {
            //что то изменилось в этом свойстве
            if($zap!=0) {$comment .= ', ';}
            switch($key) {
                case "0":
                {
                    //Стоимость для клиента
                    $comment .= 'Стоимость тура для клиента с '.number_format(((float)$value), 2, '.', ' ').' руб. на '.number_format(((float)$array_param_new[$key]), 2, '.', ' ').' руб.';

                    break;
                }
                case "1":
                {
                    //Курс валюты для клиента
                    $comment .= 'курс '.$rate.' с '.number_format(((float)$value), 2, '.', ' ').' руб. на '.number_format(((float)$array_param_new[$key]), 2, '.', ' ').' руб.';

                    break;
                }
                case "2":
                {
                    //Стоимость туроператора
                    $comment .= 'Стоимость тура ТО с '.number_format(((float)$value), 2, '.', ' ').' руб. на '.number_format(((float)$array_param_new[$key]), 2, '.', ' ').' руб.';
                    break;

                }
                case "3":
                {
                    //курс
                    $comment .= 'курс '.$rate.' ТО с '.number_format(((float)$value), 2, '.', ' ').' руб. на '.number_format(((float)$array_param_new[$key]), 2, '.', ' ').' руб.';
                    break;
                }
                case "4":
                {
                    //скидка
                    $comment .= 'скидка с '.number_format(((float)$value), 2, '.', ' ').' руб. на '.number_format(((float)$array_param_new[$key]), 2, '.', ' ').' руб.';
                    break;
                }


            }
            $zap++;

        }

    }

    mysql_time_query($link,'INSERT INTO trips_status_history_new (id_trips,action_history,id_user,datetimes,edit,comment,comment_sys) VALUES ("'.ht($id_task).'","'.ht($action).'",
		"'.ht($id_user).'",
		"'.date("Y-m-d").' '.date("H:i:s").'",
		"'.$edit.'",
		"'.ht($comment).'",
		"'.ht($comment_sys).'")');

}

//ДОБАВЛЕНИЕ ИСТОРИИ ПО ТУРУ ИЗМЕНЕНИЕ ОПЛАТЫ
function AddHistoryTripsPay($action,
                            $id_user,
                            $id_task,
                            $id_buy,
                            $array_param_old,
                            $array_param_new,
                            $link,
                            $comment_sys)
{
    $edit=0;
    $comment='Изменение оплаты по туру №'.$id_buy.' → ';
    $zap=0;
    //формируем запись что изменилось в историю
    foreach ( $array_param_old as $key => $value ) {

        if($value!=$array_param_new[$key])
        {
            //что то изменилось в этом свойстве
            if($zap!=0) {$comment .= ', ';}
            switch($key) {
                case "0":
            {
                //от туриста -туроператору
                if($value=='1')
                {
                    $comment .= 'оплата была от туриста, стала туроператору';
                }  else
                {
                    $comment .= 'оплата была туроператору, стала от туриста';
                }

                break;
            }
                case "1":
                {
                    //тип оплаты
                    if($value=='1')
                    {
                        $comment .= 'тип оплаты с оплаты на возврат';
                    }  else
                    {
                        $comment .= 'тип оплаты с возврата на оплату';
                    }

                    break;
                }
                case "2":
                {
                    //сумма
                    $comment .= 'сумма с '.number_format(((float)$value), 2, '.', ' ').' руб. на '.number_format(((float)$array_param_new[$key]), 2, '.', ' ').' руб.';
                    break;
                }
                case "3":
                {
                    //курс
                    $comment .= 'курс с '.number_format(((float)$value), 2, '.', ' ').' руб. на '.number_format(((float)$array_param_new[$key]), 2, '.', ' ').' руб.';
                    break;
                }
                case "4":
                {
                    //комиссия
                    $comment .= 'комиссия с '.number_format(((float)$value), 2, '.', ' ').' руб. на '.number_format(((float)$array_param_new[$key]), 2, '.', ' ').' руб.';
                    break;
                }
                case "5":
                {
                    //способ оплаты

                    $result_uu = mysql_time_query($link, 'select name from booking_payment_method where id="' . ht($value) . '"');
                    $num_results_uu = $result_uu->num_rows;

                    if ($num_results_uu != 0) {
                        $row_uu_old = mysqli_fetch_assoc($result_uu);
                    }
                    $result_uu1 = mysql_time_query($link, 'select name from booking_payment_method where id="' . ht($value) . '"');
                    $num_results_uu1 = $result_uu1->num_rows;

                    if ($num_results_uu1 != 0) {
                        $row_uu_new = mysqli_fetch_assoc($result_uu1);
                    }

                    $comment .= 'способ оплаты с '.$row_uu_old["name"].' на '.$row_uu_new["name"];
                    break;
                }
                case "6":
                {
                    //дата платежа
                    $comment .= 'дата оплаты с '.date_ex(0,$value).' на '.date_ex(0,$array_param_new[$key]);
                    break;
                }
                case "7":
                {
                    //комментарий
                    $comment .= 'комментарий с "'.$value.'" на "'.$array_param_new[$key].'"';
                    break;
                }

            }
            $zap++;

        }

    }


    mysql_time_query($link,'INSERT INTO trips_status_history_new (id_trips,action_history,id_user,datetimes,edit,comment,comment_sys) VALUES ("'.ht($id_task).'","'.ht($action).'",
		"'.ht($id_user).'",
		"'.date("Y-m-d").' '.date("H:i:s").'",
		"'.$edit.'",
		"'.ht($comment).'",
		"'.ht($comment_sys).'")');

}



//ДОБАВЛЕНИЕ ИСТОРИИ ПО ТУРУ
function AddHistoryTrips($action,$id_user,$id_task,$comment,$sum,$commi,$cost_operator_old,$cost_operator_new,$cost_client_old,$cost_client_new,$valuta,$id_buy,$link,$comment_sys)
{
    $edit=0;
    //$comment_sys='';  //Системный комментарий чтобы найти потом корни изменений
    switch($action)
    {
        case "1":{
            //Оформлен тур
            $comment='Оформлен тур';
            //$edit=1;

            break;
        }
        case "2":{
            //Добавление входящей оплаты.
            $comment='Добавление входящей оплаты на сумму '.$sum.' '.$valuta.', комиссия '.$commi.' '.$valuta.'';
            //$comment_sys='Текст задачи изменился с ('.$text.') на ('.$text_new.')';

            break;
        }
        case "3":{
            //Добавление исходящей оплаты
            $comment='Добавление исходящей оплаты на сумму '.$sum.' '.$valuta.', комиссия '.$commi.' '.$valuta.'';

            break;
        }
        case "4":{
            //Изменение стоимости к оплате туроператору
            $comment='Изменение стоимости к оплате туроператору c '.$cost_operator_old.' '.$valuta.' → '.$cost_operator_new.' '.$valuta.'';

            break;
        }
        case "5":{
            //Изменение стоимости для туриста
            $comment='Изменение стоимости для туриста c '.$cost_client_old.' '.$valuta.' → '.$cost_client_new.' '.$valuta.'';

            break;
        }
        /*
        case "6":{
            //Изменены сроки оплаты туроператору
            $result_uuее = mysql_time_query($link, 'select A.* from trips_payment_term as A where 
A.id_trips="' . ht($id_task) . '" and A.type=1 and A.visible=1 order by A.proc');
            $task_cloud_block='';

            if ($result_uuее) {
                $i = 0;
                while ($row_uuее = mysqli_fetch_assoc($result_uuее)) {
if($i!=0)
{
    $task_cloud_block .=', ';
}

   $r_old=explode('-',$row_uuее["date"]);

   $task_cloud_block .=''.(int)$row_uuее["proc"].'% до '.$r_old[2].'.'.$r_old[1].'.'.$r_old[0];
$i++;
                }
            }


            $comment='Изменены сроки оплаты туроператору на '.$task_cloud_block;

            break;
        }
        case "7":{
            //Изменены сроки оплаты для клиента
            $result_uuее = mysql_time_query($link, 'select A.* from trips_payment_term as A where 
A.id_trips="' . ht($id_task) . '" and A.type=0 and A.visible=1 order by A.proc');
            $task_cloud_block='';

            if ($result_uuее) {
                $i = 0;
                while ($row_uuее = mysqli_fetch_assoc($result_uuее)) {
                    if($i!=0)
                    {
                        $task_cloud_block .=', ';
                    }


   $r_old=explode('-',$row_uuее["date"]);

   $task_cloud_block .=''.(int)$row_uuее["proc"].'% до '.$r_old[2].'.'.$r_old[1].'.'.$r_old[0];
$i++;
                }
            }


            $comment='Изменены сроки оплаты  для клиента на '.$task_cloud_block;

            break;
        }
        */
        case "8":{
        //тур аннулирован
        $comment='тур аннулирован';

        break;
    }
        case "9":{
            //Добавление возврата входящей оплаты
            $comment='Добавление возврата входящей оплаты на сумму '.$sum.' '.$valuta.', комиссия '.$commi.' '.$valuta.'';

            break;
        }
        case "10":{
            //Добавление возврата входящей оплаты
            $comment='Добавление возврата исходящей оплаты на сумму '.$sum.' '.$valuta.', комиссия '.$commi.' '.$valuta.'';

            break;
        }
        case "12":{
        //Добавление новой версии договора.
        $comment='Формирование новой версии договора';

        break;
    }
        case "13":{
            //удаление записи по оплате


            $result_uu = mysql_time_query($link, 'select A.* from trips_payment as A where A.id="' . ht($id_buy) . '"');
            $num_results_uu = $result_uu->num_rows;

            if ($num_results_uu != 0) {
                $row_uu = mysqli_fetch_assoc($result_uu);

                if($row_uu["who"]==0)
                {
                    //клиент
                    if($row_uu["id_operation"]==1)
                    {
                        //оплата клиентом
                        $comment='Удаление входящей оплаты от клиента №'.$id_buy.' на сумму '.number_format(((float)$row_uu["sum"]), 2, '.', ' ').' руб.';
                    }
                    if($row_uu["id_operation"]==2)
                    {
                        //возврат клиенту
                        $comment='Удаление исходящей оплаты от клиента (возврат) №'.$id_buy.' на сумму '.number_format(((float)$row_uu["sum"]), 2, '.', ' ').' руб.';
                    }
                }
                if($row_uu["who"]==1)
                {
                    //туроператор
                    if($row_uu["id_operation"]==1)
                    {
                        //оплата туроператору
                        $comment='Удаление исходящей оплаты туроператору №'.$id_buy.' на сумму '.number_format(((float)$row_uu["sum"]), 2, '.', ' ').' руб.';
                    }
                    if($row_uu["id_operation"]==2)
                    {
                        //возврат от туроператора
                        $comment='Удаление входящей оплаты от туроператора (возврат) №'.$id_buy.' на сумму '.number_format(((float)$row_uu["sum"]), 2, '.', ' ').' руб.';
                    }
                }
            }





            break;
        }

        case "24":{
            //Документы отданы клиенту
            $comment='Документы туристу выданы';
            break;
        }
        case "25":{
            //Документы отданы клиенту
            $comment='Отмена выдачи Документов туристу';
            break;
        }
    }


    mysql_time_query($link,'INSERT INTO trips_status_history_new (id_trips,action_history,id_user,datetimes,edit,comment,comment_sys) VALUES ("'.ht($id_task).'","'.ht($action).'",
		"'.ht($id_user).'",
		"'.date("Y-m-d").' '.date("H:i:s").'",
		"'.$edit.'",
		"'.ht($comment).'",
		"'.ht($comment_sys).'")');

}

//ДОБАВЛЕНИЕ ИСТОРИИ ПО ЗАДАЧЕ
function AddHistoryTask($action,$id_user,$id_task,$comment,$text,$date,$komy,$text_new,$date_new,$komy_new,$link,$comment_sys)
{
	$edit=0;
	//$comment_sys='';  //Системный комментарий чтобы найти потом корни изменений
	switch($action)
     {
		 case "1":{
			 //свободный комментарий
			 $edit=1;
			 
			 break; 
                  }
		 case "2":{
			 //Редактирование текста задачи.
			 $comment='Редактирование текста задачи';
			 $comment_sys='Текст задачи изменился с ('.$text.') на ('.$text_new.')';
			 
			 break; 
                  }
		 case "3":{
			 //Задача отложена
			 $rrd_old=explode(' ',$date);
			 $rrd2_old=explode('-',$rrd_old[0]);
			 $rrd1_old=explode(':',$rrd_old[1]);

			 $rrd_new=explode(' ',$date_new);
			 $rrd2_new=explode('-',$rrd_new[0]);
			 $rrd1_new=explode(':',$rrd_new[1]);			 
			 
			 $comment='Задача отложена с '.$rrd2_old[2].'.'.$rrd2_old[1].'.'.$rrd2_old[0].' '.$rrd1_old[0].':'.$rrd1_old[1].' до '.$rrd2_new[2].'.'.$rrd2_new[1].'.'.$rrd2_new[0].' '.$rrd1_new[0].':'.$rrd1_new[1].'.';
			 
			 break; 
                  }
		 case "4":{
			 //Задача передана
			 $ot='';
			 $kk='';
			 $result_ss = mysql_time_query($link,'SELECT A.name_small FROM r_user as A WHERE A.id="'.ht($komy).'"');
        $num_ss = $result_ss->num_rows;	
        if($result_ss)
        {	
           $row_ss = mysqli_fetch_assoc($result_ss);
			 $ot=$row_ss["name_small"];
		}
					 $result_ss = mysql_time_query($link,'SELECT A.name_small FROM r_user as A WHERE A.id="'.ht($komy_new).'"');
        $num_ss = $result_ss->num_rows;	
        if($result_ss)
        {	
           $row_ss = mysqli_fetch_assoc($result_ss);
			 $kk=$row_ss["name_small"];
		}	 
			 
			 $comment='Задача передана от '.$ot.' к '.$kk.'';
			 
			 break; 
                  }
		 case "5":{
			 //Задача выполнена
			 $comment='Задача выполнена';
			 
			 break; 
                  }
		 case "6":{
			 //Задача удалена
			 $comment='Задача удалена';
			 
			 break; 
                  }
		 case "7":{
			 //Задача создана
			 $comment='Задача создана';
			 
			 break; 
                  }			
		 case "8":{
			 //Задача создана
			 $comment='Задача закрыта';
			 
			 break; 
                  }				
	}
	
	
	mysql_time_query($link,'INSERT INTO task_status_history_new (id_task,action_history,id_user,datetimes,edit,comment,comment_sys) VALUES ("'.ht($id_task).'","'.ht($action).'",
		"'.ht($id_user).'",
		"'.date("Y-m-d").' '.date("H:i:s").'",
		"'.$edit.'",
		"'.ht($comment).'",
		"'.ht($comment_sys).'")');
	
}

function GETGROUPCO($id_company)
{
    global $link;
    $id_group_u1 = 0;

    if (is_numeric(trim($id_company))) {
        $mass_city[0] = $id_company;
    } else {
        $mass_city = explode(",", ht($id_company));
    }

        $result_gr = mysql_time_query($link, 'select id_group from a_company_group where id_a_company="'.$mass_city[0].'"');
        $num_results_gr = $result_gr->num_rows;

        if ($num_results_gr != 0) {
            $row_gr = mysqli_fetch_assoc($result_gr);
            $id_group_u1 = $row_gr["id_group"];
        }
        return $id_group_u1;
}


//ВЫПОЛНИТЬ АВТОМАТИЧЕСКИ ЗАДАЧУ ЕСЛИ ТАКАЯ ЕСТЬ В СИСТЕМЕ
function TASK_MAKE($id_object,$action,$link,$id_company,$id_user)
{
    $today = date("Y-m-d") . ' ' . date("H:i:s"); //присвоено 03.12.01


    //проверим может уже есть такая напоминалка то оставляем ее или добавляем новую
    $result_8 = mysql_time_query($link, 'SELECT A.id,A.id_user_responsible FROM task_new AS A WHERE 
	
	A.id_a_group IN (' . GETGROUPCO($id_company) . ') and 
	A.action="' . ht($action) . '" and
	A.id_object="' . ht($id_object) . '" and A.visible=1 and A.status=0');


    $num_8 = $result_8->num_rows;
    if ($num_8 != 0) {

            while ($row_8 = mysqli_fetch_assoc($result_8)) {

                mysql_time_query($link, 'update task_new set
        
        status="1"
        
        where id = "' . ht($row_8['id']) . '"');

                AddHistoryTask('5',$id_user,$row_8['id'],'','','','','','','',$link,'Выполнена из панели тура');


                $mas_responsible=explode(",",$row_8["id_user_responsible"]);
                foreach ($mas_responsible as $key => $value)
                {
                    UpdateTaskKey($value,$link);
                }



            }






    }
}


//ОТПРАВКА ЗАДАЧ

function TASK_SEND_NEW_NO_REMINDER($ring,$text,$id_object,$click,$action,$link,$id_user,$id_user_responsible,$id_company)
{
    $today = date("Y-m-d").' '.date("H:i:s"); //присвоено 03.12.01


    //проверим может уже есть такая напоминалка то оставляем ее или добавляем новую
    $result_8 = mysql_time_query($link,'SELECT A.id FROM task_new AS A WHERE A.id_user="'.ht($id_user).'" and 
	
	A.id_a_group IN ('.GETGROUPCO($id_company).') and 
	A.ring_datetime="'.ht($ring).'" and 
	A.reminder=0 and
	A.comment="'.ht($text).'" and
	A.click="'.ht($click).'" and
	A.action="'.ht($action).'" and
	A.id_object="'.ht($id_object).'"');

    $num_8 = $result_8->num_rows;
    if($num_8==0)
    {


        mysql_time_query($link,'INSERT INTO task_new (id_a_group,id_user,id_user_responsible,reminder,ring_datetime,comment,date_create,visible,status,click,action,id_object) VALUES ("'.GETGROUPCO($id_company).'","'.ht($id_user).'","'.ht($id_user_responsible).'",0,
		"'.ht($ring).'",
		"'.ht($text).'",
		"'.$today.'",
		"1",
		"0",
		"'.ht($click).'",
		"'.ht($action).'",
		"'.ht($id_object).'")');

        $ID_N=mysqli_insert_id($link);

        //добавление в историю задач
        //mysql_time_query($link,'INSERT INTO task_status_history (id,id_task,id_user,datetime,status) VALUES ("","'.$ID_N.'","0","'.date("y.m.d").' '.date("H:i:s").'","0")');


        //добавление истории по задаче
        AddHistoryTask('7',0,$ID_N,'','','','','','','',$link,'Создана CRON');

        UpdateTaskKey($id_user_responsible,$link);
        /*
        $noti_key=new_key_task($link,10);
        mysql_time_query($link,'update r_user set task_key="'.$noti_key.'" where id = "'.ht($id_user_responsible).'"');
        */

        /*
        //уведомление о новой задаче
        $text1='Вам поступила новая задача - '.$text;

        mysql_time_query($link,'INSERT INTO r_notification (id_user,notification,sign_user,datetime ) VALUES ("'.$value.'","'.htmlspecialchars(trim($text1)).'","0","'.date("y.m.d").' '.date("H:i:s").'")');
        $noti_key=new_key($link,10);
        mysql_time_query($link,'update r_user set noti_key="'.$noti_key.'" where id = "'.$value.'"');
*/

    }


}


//ОТПРАВКА НАПОМИНАЛОК

function TASK_SEND_NEW($ring,$text,$id_object,$click,$action,$link,$id_user,$id_user_responsible,$id_company)
{
	$today = date("Y-m-d").' '.date("H:i:s"); //присвоено 03.12.01
	
	
	//проверим может уже есть такая напоминалка то оставляем ее или добавляем новую
	$result_8 = mysql_time_query($link,'SELECT A.id FROM task_new AS A WHERE A.id_user="'.ht($id_user).'" and 
	
	A.id_a_group IN ('.GETGROUPCO($id_company).') and 
	A.ring_datetime="'.ht($ring).'" and 
	A.reminder=1 and
	A.comment="'.ht($text).'" and
	A.click="'.ht($click).'" and
	A.action="'.ht($action).'" and
	A.id_object="'.ht($id_object).'"');
	
$num_8 = $result_8->num_rows;	
	if($num_8==0)
	{
	
	
		mysql_time_query($link,'INSERT INTO task_new (id_a_group,id_user,id_user_responsible,reminder,ring_datetime,comment,date_create,visible,status,click,action,id_object) VALUES ("'.GETGROUPCO($id_company).'","'.ht($id_user).'","'.ht($id_user_responsible).'",1,
		"'.ht($ring).'",
		"'.ht($text).'",
		"'.$today.'",
		"1",
		"0",
		"'.ht($click).'",
		"'.ht($action).'",
		"'.ht($id_object).'")');
	
		$ID_N=mysqli_insert_id($link);  
		
		//добавление в историю задач
		//mysql_time_query($link,'INSERT INTO task_status_history (id,id_task,id_user,datetime,status) VALUES ("","'.$ID_N.'","0","'.date("y.m.d").' '.date("H:i:s").'","0")');
		
		
		//добавление истории по задаче
        AddHistoryTask('7',0,$ID_N,'','','','','','','',$link,'Создана CRON');
		
		UpdateTaskKey($id_user_responsible,$link);
		/*
		$noti_key=new_key_task($link,10);
        mysql_time_query($link,'update r_user set task_key="'.$noti_key.'" where id = "'.ht($id_user_responsible).'"'); 	
		*/
		
		/*		
		//уведомление о новой задаче
		$text1='Вам поступила новая задача - '.$text;
	
		mysql_time_query($link,'INSERT INTO r_notification (id_user,notification,sign_user,datetime ) VALUES ("'.$value.'","'.htmlspecialchars(trim($text1)).'","0","'.date("y.m.d").' '.date("H:i:s").'")');
		$noti_key=new_key($link,10);
		mysql_time_query($link,'update r_user set noti_key="'.$noti_key.'" where id = "'.$value.'"');
*/
	
	}	
	
	
}

//отправка уведомлений системных с приоритетом
function notification_send_system($text,$mass,$id_user,$link)
{
	$today[0] = date("y.m.d"); //присвоено 03.12.01
    $today[1] = date("H:i:s"); //присвоит 1 элементу массива 17:16:17
	$date_=$today[0].' '.$today[1];
	
    foreach ($mass as $keys => $value) 
	{		
		
		
		mysql_time_query($link,'INSERT INTO r_notification (id_user,notification,sign_user,datetime,priority ) VALUES ("'.$value.'","'.htmlspecialchars(trim($text)).'","'.$id_user.'","'.$date_.'","1")');
		
		$noti_key=new_key($link,10);
		mysql_time_query($link,'update r_user set noti_key="'.$noti_key.'" where id = "'.htmlspecialchars(trim($value)).'"');  
	}
}

//отправка уведомлений пользователям
function notification_send($text,$mass,$id_user,$link)
{
	$today[0] = date("y.m.d"); //присвоено 03.12.01
    $today[1] = date("H:i:s"); //присвоит 1 элементу массива 17:16:17
	$date_=$today[0].' '.$today[1];
	
    foreach ($mass as $keys => $value) 
	{		
		mysql_time_query($link,'INSERT INTO r_notification (id_user,notification,sign_user,datetime ) VALUES ("'.$value.'","'.htmlspecialchars(trim($text)).'","'.$id_user.'","'.$date_.'")');
		$noti_key=new_key($link,10);
		mysql_time_query($link,'update r_user set noti_key="'.$noti_key.'" where id = "'.htmlspecialchars(trim($value)).'"');  
	}
}
//получение нового ключа для уведомлений пользователю
function new_key($link,$len, $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789')
{
	   do {
    $string = ''; 
	
	for ($i = 0; $i < $len; $i++) 
	{ 
	   $pos = rand(0, strlen($chars)-1); 
	   $string .= $chars[$pos];
	}

	$results1222=mysql_time_query($link,'select count(id) as r from r_user where noti_key="'.$string.'"');
	$row1222 = mysqli_fetch_assoc($results1222);
	
	
   } while($row1222["r"]!=0);
   
	return $string; 

}

//получение нового ключа для задач пользователю
function new_key_task($link,$len, $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789')
{
	   do {
    $string = ''; 
	
	for ($i = 0; $i < $len; $i++) 
	{ 
	   $pos = rand(0, strlen($chars)-1); 
	   $string .= $chars[$pos];
	}

	$results1222=mysql_time_query($link,'select count(id) as r from r_user where task_key="'.$string.'"');
	$row1222 = mysqli_fetch_assoc($results1222);
	
	
   } while($row1222["r"]!=0);
   
	return $string; 

}


function pad($fio,$n) {
	$rr=explode(';',$fio);
	return($rr[$n]);
}

//по всем ли служебкам есть решения и притом положительные для заявок
function decision_memo_app($link,$id_naryad)
{
		$result_tx=mysql_time_query($link,'Select count(a.id) as cc from z_doc_material as a where ((a.id_sign_mem=0 and a.signedd_mem=0 and not(a.memorandum=""))or(not(a.id_sign_mem=0)and a.signedd_mem=0 and not(a.memorandum="")))and( a.id_doc="'.htmlspecialchars(trim($id_naryad)).'")');	
	   	$rowx = mysqli_fetch_assoc($result_tx);	
	
	    return ($rowx["cc"]);
}

//по всем ли служебкам есть решения и притом положительные для нарядов
function decision_memo($link,$id_naryad)
{
		$result_tx=mysql_time_query($link,'Select count(a.id) as cc from n_work as a where ((a.id_sign_mem=0 and a.signedd_mem=0)or(not(a.id_sign_mem=0)and a.signedd_mem=0))and( a.id_nariad="'.htmlspecialchars(trim($id_naryad)).'")');	
	   	$rowx = mysqli_fetch_assoc($result_tx);	


		$result_tx1=mysql_time_query($link,'SELECT  COUNT(a.id) AS cc FROM n_material AS a, n_work AS b WHERE ((a.id_sign_mem=0 AND a.signedd_mem=0)or(not(a.id_sign_mem=0)and a.signedd_mem=0))AND( b.id_nariad="'.htmlspecialchars(trim($id_naryad)).'")AND(a.id_nwork=b.id)');
	    $rowx1 = mysqli_fetch_assoc($result_tx1);
	
	    return ($rowx["cc"]+$rowx1["cc"]);
}


//количество служ. записок по наряду
function memo_count_nariad($link,$id_naryad)
{
		$result_tx=mysql_time_query($link,'Select count(a.id) as cc from n_work as a where ((a.id_sign_mem=0 and a.signedd_mem=0)or not(a.id_sign_mem=0))and( a.id_nariad="'.htmlspecialchars(trim($id_naryad)).'")');	
	   	$rowx = mysqli_fetch_assoc($result_tx);
	
	   $result_tx1=mysql_time_query($link,'SELECT  COUNT(a.id) AS cc FROM n_material AS a, n_work AS b WHERE ((a.id_sign_mem=0 AND a.signedd_mem=0)OR not(a.id_sign_mem=0))AND( b.id_nariad="'.htmlspecialchars(trim($id_naryad)).'")AND(a.id_nwork=b.id)');
	   $rowx1 = mysqli_fetch_assoc($result_tx1);
			
	
	    return ($rowx["cc"]+$rowx1["cc"]);
}

//Определяем есть ли у этого наряда подпись ниже чем сам пользователь
//вдруг он сформировал этот наряд
function down_signature($sign_level,$sign_admin,$link,$id_naryad)
{
	//echo($sign_level);
	$sign_sign=$sign_level;
	$mojno=-1; //никем не  подписан ниже
	if($sign_admin==1) {$sign_sign=4;}
	
	if($sign_sign>1)
	{	
	
		$result_tx=mysql_time_query($link,'Select a.id_signed0,a.id_signed1,a.id_signed2,a.signedd_nariad from n_nariad as a where a.id="'.htmlspecialchars(trim($id_naryad)).'"');
        $num_results_tx = $result_tx->num_rows;
	    if($num_results_tx!=0)
	    {  
		  //такая работа есть
		  $rowx = mysqli_fetch_assoc($result_tx);
			$stack_sign = -1;
			//echo($sign_sign);
			  for ($i=($sign_sign-2); $i>=0; $i--)
              {
				if($rowx["id_signed".$i]!=0)
				{
					$stack_sign=$i;
					break;
				}
					
			  }
			  if($stack_sign!=-1)
			  {
				$mojno=$stack_sign; // подписан ниже
			  }
		}
	}
	return $mojno;
}

//функция проверки что наряд не подписан им и выше
function sign_naryd_level($link,$id_user,$sign_level,$id_naryad,$sign_admin)
{
	$mojno=0;  //по умолчанию подписан им или выше или проведен
	$result_tx=mysql_time_query($link,'Select a.id_signed0,a.id_signed1,a.id_signed2,a.signedd_nariad from n_nariad as a where a.id="'.htmlspecialchars(trim($id_naryad)).'"');
    $num_results_tx = $result_tx->num_rows;
	if($num_results_tx!=0)
	  {  
		//такая работа есть
		$rowx = mysqli_fetch_assoc($result_tx);
		if($rowx["signedd_nariad"]!=1)
		{
			
			$stack_sign = 0;
			if($sign_admin!=1)
			{	
				//echo($sign_level);
			  for ($i=($sign_level-1); $i<=3; $i++)
              {
				if($rowx["id_signed".$i]!=0)
				{
					$stack_sign++;
					break;
				}
					
			  }
			  if($stack_sign==0)
			  {
				$mojno=1; //никем не подписан
			  }	
			}else
			{
				$stack_sign++;
				$mojno=1;
			}
			

		}
	  }
	
	return $mojno;
}



//составление токена для формы
function token_access_compile($var,$sale,$secret)
{
		//$sale='edit_house';
		//$var= 92
		$posl_chifra_id2=htmlspecialchars(trim($var))%10; // остаток от деления  92 - 10*9 = 2
		$timeet=time();  //1335939007
		$st_time1 = substr($timeet, 0, $posl_chifra_id2); // с 0 символа по n символ = 133
        $st_time2= substr($timeet, ((int)$posl_chifra_id2));	// c n символа до конда = 5939007

    //echo'<br>до encode -'.$secret[2].$st_time2.$st_time1.$secret[3].' получилось-'.encode_x($secret[2].$st_time2.$st_time1.$secret[3],$secret).'<br>';
    //echo'<br>до encode -'.$secret[2].$st_time2.$st_time1.$secret[3].' получилось-'.encode_x($secret[2].$st_time2.$st_time1.$secret[3],$secret).'<br>';

		return htmlspecialchars(trim($var)).'.'.md5($secret.htmlspecialchars(trim($var)).$secret[0].$sale).'.'.encode_x($secret[2].$st_time2.$st_time1.$secret[3],$secret);

       /* echo('-'.$timeet);
        echo('-'.$st_time1);
		echo('-'.$secret[2].$st_time2.$st_time1.$secret[3]);
		echo('-'.decode_x(encode_x($secret[2].$st_time2.$st_time1.$secret[3],$secret),$secret));

    $id_p=$var;
    $token1[2]=$secret[2].$st_time2.$st_time1.$secret[3];
    $strt= substr($token1[2], 1,(strlen($token1[2])-2));
    echo('-'.$strt);
    $posl_chifra_idx=$id_p%10;  // остаток от деления  92 - 10*9 = 2
    $st_time11 = substr($strt, 0, (strlen($strt)-((int)$posl_chifra_idx)));
    $st_time22= substr($strt, (strlen($strt)-((int)$posl_chifra_idx)));

    $timeform=$st_time22.$st_time11;
    echo('-'.$timeform);
*/
		//1595502658
        //15
        //  95502658


}


//проверка токена ajax формы
//true все ок
//false токен не подходит

function token_access_new($token,$sale,$id,$name_session,$minutes=30)
{
  $error_t=false;
  $v_error='';

  if(isset($_SESSION[$name_session]))
  {
/*
    if(isset($name_session))
    {*/
   //расшифровка токена
   //расшифровка токена

     // 170.798c56e633d1d1ea045b1e5ca2779498.s 5KzioLlSmIVRL9j 5sMbF7Qn0FmKLCJpRn6Og/Vrw=

   $token1=explode(".", $token);
   //соль для данного действия
   //$sale='edit_house';

      //xGLbxvu9lOEP

   $id_p=$token1[0];
   $secr=$_SESSION[$name_session];
   //$secr=$name_session;

   $rrr=md5($secr.$id_p.$secr[0].$sale);

   //echo'/1';
   //echo'/'.$rrr;
        //echo'/'.$token1[1];

   if(($rrr==$token1[1])and($id_p==$id))
   {
       //echo'/2';
       //$dsds=$token1[2];
       //$asd=decode_x($token1[2],$secr);
       $token1[2]=decode_x($token1[2],$secr);



       //echo'<br>получили - '.$dsds.'  после  decode -'.$token1[2].'<br>';
      // echo'<br>получили - '.$dsds.'  после  decode -'.$asd.'<br>';
	 $strt= substr($token1[2], 1,(strlen($token1[2])-2));
	 $posl_chifra_idx=$id_p%10;  // остаток от деления  92 - 10*9 = 2
	 $st_time11 = substr($strt, 0, (strlen($strt)-((int)$posl_chifra_idx)));
     $st_time22= substr($strt, (strlen($strt)-((int)$posl_chifra_idx)));
			
     $timeform=$st_time22.$st_time11;
     //echo('<br>'.$timeform);
         //1595452530
       //ºó9545255017
         //1595452617ºó

	 $time_sei=time();
	 $razn=60*$minutes; //30 минут
	 if((((int)$time_sei-(int)$timeform)<=$razn)and($timeform<=$time_sei))
	 {
	  $error_t=true; 
	 } else { $v_error='time_error ('.$time_sei.' >= '.$timeform.') session = '.$secr.'';	}
	
} else { $v_error='id!=id session = '.$secr.' id_token='.$id_p.' id-проверки -'.$id;	}
	
} else { $v_error='session_no - '.$name_session;	}
	
if($v_error!='')
{
    global $link;


    mysql_time_query($link,'insert into v_error (module,error,date_error)  values ("'.htmlspecialchars($_SERVER['REQUEST_URI']).'","'.htmlspecialchars($v_error).'","'.date("y.m.d").' '.date("H:i:s").'")');
		
}
	//echo($v_error);
return $error_t;
}


function token_access_yes($token,$sale,$id,$minutes=30)
{
  $error_t=false;
  if(isset($_SESSION['s_t']))
  {

   //расшифровка токена
   //расшифровка токена
			
   $token1=explode(".", $token);
   //соль для данного действия
   //$sale='edit_house';
			
   $id_p=$token1[0];
   $secr=$_SESSION['s_t'];

   $rrr=md5($secr.$id_p.$secr[0].$sale);
   if(($rrr==$token1[1])and($id_p==$id))
   {
	 $token1[2]=decode_x($token1[2],$secr);		
	 $strt= substr($token1[2], 1,(strlen($token1[2])-2));
	 $posl_chifra_idx=$id_p%10;
	 $st_time11 = substr($strt, 0, (strlen($strt)-$posl_chifra_idx));
     $st_time22= substr($strt, (strlen($strt)-$posl_chifra_idx));
			
     $timeform=$st_time22.$st_time11;
	 $time_sei=time();
	 $razn=60*$minutes; //30 минут
	 if((($time_sei-$timeform)<=$razn)and($timeform<=$time_sei))
	 {
	  $error_t=true; 
	 }
	
}
	
}
return $error_t;
}

function token_access_not($link,$token,$sale,$id,$minutes=1)
{
  $v_error='';		
  $error_t=false;
  if(isset($_SESSION['s_not']))
  {

   //расшифровка токена
   //расшифровка токена
			
   $token1=explode(".", $token);
   //соль для данного действия
   //$sale='edit_house';
			
   $id_p=$token1[0];
   $secr=$_SESSION['s_not'];

   $rrr=md5($secr.$id_p.$secr[0].$sale);
   if(($rrr==$token1[1])and($id_p==$id))
   {
	 $token1[2]=decode_x($token1[2],$secr);		
	 $strt= substr($token1[2], 1,(strlen($token1[2])-2));
	 $posl_chifra_idx=$id_p%10;
	 $st_time11 = substr($strt, 0, (strlen($strt)-$posl_chifra_idx));
     $st_time22= substr($strt, (strlen($strt)-$posl_chifra_idx));
			
     $timeform=$st_time22.$st_time11;
	 $time_sei=time();
	 $razn=60*$minutes; //30 минут
	   
	 if((($time_sei-$timeform)<=$razn)and($timeform<=$time_sei))
	 {
	  $error_t=true; 
	 } else { $v_error='time_error ($time_sei - '.$time_sei.',$timeform - '.$timeform.',$razn - '.$razn.')';	}
	
} else { $v_error='id!=id secr - '.$secr;	}
	
} else { $v_error='session_no - '.$name_session;	}
	
if($v_error!='')
{
  // mysqli_query($link,'insert into v_error (module,error,date_error)  values ("'.htmlspecialchars($_SERVER['REQUEST_URI']).'","'.htmlspecialchars($v_error).'","'.date("y.m.d").' '.date("H:i:s").'")'); 		   
		
}	
return $error_t;
}

function token_access_task($link,$token,$sale,$id,$minutes=1)
{
  $v_error='';		
  $error_t=false;
  if(isset($_SESSION['s_task']))
  {

   //расшифровка токена
   //расшифровка токена
			
   $token1=explode(".", $token);
   //соль для данного действия
   //$sale='edit_house';
			
   $id_p=$token1[0];
   $secr=$_SESSION['s_task'];

   $rrr=md5($secr.$id_p.$secr[0].$sale);
   if(($rrr==$token1[1])and($id_p==$id))
   {
	 $token1[2]=decode_x($token1[2],$secr);		
	 $strt= substr($token1[2], 1,(strlen($token1[2])-2));
	 $posl_chifra_idx=$id_p%10;
	 $st_time11 = substr($strt, 0, (strlen($strt)-$posl_chifra_idx));
     $st_time22= substr($strt, (strlen($strt)-$posl_chifra_idx));
			
     $timeform=$st_time22.$st_time11;
	 $time_sei=time();
	 $razn=60*$minutes; //30 минут
	   
	 if((($time_sei-$timeform)<=$razn)and($timeform<=$time_sei))
	 {
	  $error_t=true; 
	 } else { $v_error='time_error ($time_sei - '.$time_sei.',$timeform - '.$timeform.',$razn - '.$razn.')';	}
	
} else { $v_error='id!=id secr - '.$secr;	}
	
} else { $v_error='session_no - '.$name_session;	}
	
if($v_error!='')
{
  // mysqli_query($link,'insert into v_error (module,error,date_error)  values ("'.htmlspecialchars($_SERVER['REQUEST_URI']).'","'.htmlspecialchars($v_error).'","'.date("y.m.d").' '.date("H:i:s").'")'); 		   
		
}	
return $error_t;
}

//добавление нужно класса к инпут полям в случае ошибки в стеке по это полю
function iclass_($name_var,$stack_error,$class_name_error)
{
   if(isset($stack_error))
   {
	$found = array_search($name_var,$stack_error);   
	if($found !== false) 
	{
	   return $class_name_error;
	} else
	{
	   return "";		
	}
   } else
	{
	   return "";
	}   
	
}


//подчеркивание красным сумм с минусом и выделение красным если нужно
function mor_class($var,$var_format,$red=0)
{
	$class='';
	if(($red==1)and($var<0))  { $class='morr1';}
	if($var<0) {  $class.=' morr'; }
	if($class!='') { return '<span class="'.$class.'">'.$var_format.'</span>';} else { return $var_format; }
	
}


function ipost_x($vars,$rows,$ret,$table=false,$name_rows=false,$link=false)
{
	
	if((isset($vars))and($vars!=''))
	{
		if(($table)and($name_rows)and($link))
		{
		  $result_i=mysql_time_query($link,'Select a.'.$name_rows.' from '.$table.' as a where a.id="'.htmlspecialchars(trim($vars)).'"');
          $num_results_i = $result_i->num_rows;
	      if($num_results_i!=0)
	      {
		     $row_i = mysqli_fetch_assoc($result_i);
			 return htd($row_i[$name_rows]);
		  } else
		  {
			 return $ret;
		  }		  
		} else
		{
		  return htd($vars);
		}
	} else
	{
		if($rows!='')
		{
			if(($table)and($name_rows)and($link))
		{
		  $result_i=mysql_time_query($link,'Select a.'.$name_rows.' from '.$table.' as a where a.id="'.htmlspecialchars(trim($rows)).'"');
          $num_results_i = $result_i->num_rows;
	      if($num_results_i!=0)
	      {
		     $row_i = mysqli_fetch_assoc($result_i);
			 return htd($row_i[$name_rows]);
		  } else
		  {
			 return htd($ret);
		  }		  
		} else
		{
		  return htd($rows);
		}
		} else
		{		
	       return htd($ret);
		}
	}
	
}


//вывод value полей при отправле форм
//ret - значение по умолчанию "" или 0 допустим
//vars - переменная $_POST['bb'] или $_GET[]
function ipost_($vars,$ret,$table=false,$name_rows=false,$link=false)
{
	
	if((isset($vars))and($vars!=''))
	{
		if(($table)and($name_rows)and($link))
		{
		  $result_i=mysql_time_query($link,'Select a.'.$name_rows.' from '.$table.' as a where a.id="'.htmlspecialchars(trim($vars)).'"');
          $num_results_i = $result_i->num_rows;
	      if($num_results_i!=0)
	      {
		     $row_i = mysqli_fetch_assoc($result_i);
			 return htd($row_i[$name_rows]);
		  } else
		  {
			 return "";
		  }		  
		} else
		{
		  return (htd($vars));
		}
	} else
	{

	return $ret;
		
	}
	
}

//разница минут между двумя датами
function dateDiff_min($dt1, $dt2, $timeZone = 'GMT') {
    $tZone = new DateTimeZone($timeZone);
    $dt1 = new DateTime($dt1, $tZone);
    $dt2 = new DateTime($dt2, $tZone);
    $ts1 = $dt1->format('Y-m-d H:i:s');
    $ts2 = $dt2->format('Y-m-d H:i:s');
    $diff = strtotime($ts1)-strtotime($ts2);
    $diff/= 60;
    return floor($diff);
}


//разница дней между двумя датами
function DateDiFormat($dt1, $dt2,$format = 'd.m.Y H:i:s') {
$timeZone = 'GMT';
    $tZone = new DateTimeZone($timeZone);

    $dt1 = new DateTime($dt1, $tZone);
    $dt2 = new DateTime($dt2, $tZone);
    $ts1 = $dt1->format($format);
    $ts2 = $dt2->format($format);
    $diff = strtotime($ts1)-strtotime($ts2);
    $diff/= 3600*24;
    return floor($diff);
}



//разница дней между двумя датами
function dateDiff_1($dt1, $dt2, $timeZone = 'GMT') {
    $tZone = new DateTimeZone($timeZone);
    $dt1 = new DateTime($dt1, $tZone);
    $dt2 = new DateTime($dt2, $tZone);
    $ts1 = $dt1->format('Y-m-d');
    $ts2 = $dt2->format('Y-m-d');
    $diff = strtotime($ts1)-strtotime($ts2);
    $diff/= 3600*24;
    return floor($diff);
}

//разница дней между двумя датами по модулю
function dateDiff_($dt1, $dt2, $timeZone = 'GMT') {
    $tZone = new DateTimeZone($timeZone);
    $dt1 = new DateTime($dt1, $tZone);
    $dt2 = new DateTime($dt2, $tZone);
    $ts1 = $dt1->format('Y-m-d');
    $ts2 = $dt2->format('Y-m-d');
    $diff = abs(strtotime($ts1)-strtotime($ts2));
    $diff/= 3600*24;
    return floor($diff);
}


function dateDiff_F($dt1, $dt2, $timeZone = 'GMT') {
    $tZone = new DateTimeZone($timeZone);
    $dt1 = new DateTime($dt1, $tZone);
    $dt2 = new DateTime($dt2, $tZone);
    $ts1 = $dt1->format('Y-m-d');
    $ts2 = $dt2->format('Y-m-d');
    $diff = abs(strtotime($ts1)-strtotime($ts2));
    $diff/= 3600*24;
    return floor($diff/365);
}

function send_sms($host, $port, $login, $password, $phone, $text, $sender = false, $wapurl = false )
{
    $fp = fsockopen($host, $port, $errno, $errstr);
    if (!$fp) {
        return "errno: $errno \nerrstr: $errstr\n";
    }
    fwrite($fp, "GET /messages/v2/send/" .
        "?phone=" . rawurlencode($phone) .
        "&text=" . rawurlencode($text) .
        ($sender ? "&sender=" . rawurlencode($sender) : "") .
        ($wapurl ? "&wapurl=" . rawurlencode($wapurl) : "") .
        "  HTTP/1.0\n");
    fwrite($fp, "Host: " . $host . "\r\n");
    if ($login != "") {
        fwrite($fp, "Authorization: Basic " . 
            base64_encode($login. ":" . $password) . "\n");
    }
    fwrite($fp, "\n");
    $response = "";
    while(!feof($fp)) {
        $response .= fread($fp, 1);
    }
    fclose($fp);
    list($other, $responseBody) = explode("\r\n\r\n", $response, 2);
    return $responseBody;
}

function sms_podver($link,$len, $chars = '0123456789') 
{ 
   do {
    $string = ''; 
	
	for ($i = 0; $i < $len; $i++) 
	{ 
	   if($i!=0)
	   {
	     $pos = rand(0, strlen($chars)-1); 
	   } else
	   {
		 $pos = rand(1, strlen($chars)-1);  
	   }
	   $string .= $chars[$pos];
	}

	$results1222=mysql_time_query($link,'select count(id) as r from poddomen_all_reserver_code where code="'.$string.'"');
	$row1222 = mysqli_fetch_assoc($results1222);
	
	
   } while($row1222["r"]!=0);
   
	return $string; 
 }



function encode_x($unencoded,$key){//Шифруем
    /*
$string=base64_encode($unencoded);//Переводим в base64
echo'<br><br>';
echo $string.'<br>';
$arr=array();//Это массив
$x=0;
	$newstr='';
while ($x++< strlen($string)) {//Цикл
$arr[$x-1] = md5(md5($key.$string[$x-1]).$key);//Почти чистый md5
$newstr = $newstr.$arr[$x-1][4].$arr[$x-1][7].$arr[$x-1][2].$arr[$x-1][8];//Склеиваем символы
    echo $newstr.'   - md5-'.$arr[$x-1].' что - '.$key.$string[$x-1].'<br>';
}
    echo'<br><br>';
return $newstr;//Вертаем строку*/

    //$string=base64_encode($unencoded);
    $encrypt_method = "AES-256-CBC";
    $key = hash('sha256', $key);
    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', ENCRYPTION_KEY), 0, 16);
    $output = base64_encode(openssl_encrypt($unencoded, $encrypt_method, $key, 0, $iv));

    return $output;
}

function decode_x($encoded, $key){//расшифровываем
       //    150b9d7a1714bc17150b195d150b21d4c7670cff74fa38d8150b195d83f5bc17
    //Mjk5MTYyMjQzM192f55
    /*
$strofsym="qwertyuiopasdfghjklzxcvbnm1234567890QWERTYUIOPASDFGHJKLZXCVBNM=";//Символы, с которых состоит base64-ключ
$x=1;
    echo'<br><br>';
    echo $encoded.'<br>';
while ($x<= strlen($strofsym)) {//Цикл
$tmp = md5(md5($key.$strofsym[$x-1]).$key);//Хеш, который соответствует символу, на который его заменят.
$encoded = str_replace($tmp[4].$tmp[7].$tmp[2].$tmp[8], $strofsym[$x-1], $encoded);//Заменяем №3,6,1,2 из хеша на символ

    echo $encoded.' что- '.$key.$strofsym[$x-1].'   - md5-'.$tmp.' - кусок -'.$tmp[4].$tmp[7].$tmp[2].$tmp[8].'  на - '.$strofsym[$x-1].'<br>';
    $x++;
}
    echo'<br><br>';
return base64_decode($encoded);//Вертаем расшифрованную строку*/

    $encrypt_method = "AES-256-CBC";
    $key = hash('sha256', $key);
    //echo '<br>key - '.$key.'<br>';
    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', ENCRYPTION_KEY), 0, 16);
    //echo '<br>iv - '.$iv.'<br>';
    $output = openssl_decrypt(base64_decode($encoded), $encrypt_method, $key, 0, $iv);

    return $output;


}



function rand_string_string($len, $chars = 'QWERTYUIOPASDFGHJKLZXCVBNM0123456789qwertyuiopasdfghjklzxcvbnm')
 { 
    $string = ''; for ($i = 0; $i < $len; $i++) 
	{ 
	   $pos = rand(0, strlen($chars)-1); 
	   $string .= $chars[$pos];
	} 
	return $string; 
 } 


//удаление первого 0 у числа   02 -> 2
function null_dell($number)
{
 if($number[0]=='0')
 {
	return $number[1];
 } else
 {
 return $number;
 }
}


//переводит элементы любого массива в нужную кодировку
function iconvArray ($inputArray,$newEncoding,$oldEncoding)
{
  $outputArray=array ();
  if ($newEncoding!=''){
    if (!empty ($inputArray)){
      foreach ($inputArray as $key => $element){
         if (!is_array($element)){
			//echo(mb_detect_encoding($element));
            $element=iconv($oldEncoding,$newEncoding,$element);
         } else 
		 {
			$element=iconvArray($element, $newEncoding,$oldEncoding);
         }
         $outputArray[$key]=$element;
     }
   }   
 }
 return $outputArray;
}


//удаление из массива элемента по значению
function rm_from_array($needle, &$array, $all = true){
    if(!$all){
        if(FALSE !== $key = array_search($needle,$array)) unset($array[$key]);
        return;
    }
    foreach(array_keys($array,$needle) as $key){
        unset($array[$key]);
    }
}

function limit_spec($count,$current_position,$n_st)
{
	$limit='';
	if($n_st!=null)
	{
		$limit=' '.((($n_st-1)*$count)+$current_position).',1';
	} else
	{
	   $limit=' '.$current_position.',1';	
	}
	return $limit;
}


function current_massiv($massiv_obr,$ist)
{
	$current_position=0;
	while ($fruit_name = current($massiv_obr)) {
        if ($fruit_name == ($ist+1)) {
			$current_position=key($massiv_obr);
        }
        next($massiv_obr);
        }
		return $current_position;
}

function compare ($v1, $v2) {
    /* Сравниваем значение по ключу st */
    if ($v1["st"] == $v2["st"]) return 0;
    return ($v1["st"] < $v2["st"])? -1: 1;
  }

function hop_mass($list_start,$list_step,$count_write)
{
  $mass_pos=array();	
  $mass_pos[0]=$list_start;
  //выводить спец с шагом не меньше 3 и 3 - минимум
  for ($ist=1; $ist<=(($count_write*2)/3); $ist++)
  {	
    $mass_pos[$ist]=$mass_pos[$ist-1]+$list_step;
  }
  return $mass_pos;
}


//массив с числами меньше заданного
function mass_del(&$mass,$value)
{
  $mass_new = array();	
  
  for ($ist=0; $ist<count($mass); $ist++)
  {	
	  if($mass[$ist]<=$value)
	  {
		  $mass_new[$ist]=$mass[$ist];
	  } else
	  {
		  break;	  
	  }
  }
  return $mass_new;
  //return array ($stat,$plplpl,$award,$pro_st,$name_user,$avatar,$online,$profession);
}





//Обрезает строчку до определенного символа, с учетом слов и знаков припинания
function cat_string($string,$count)
{
	if(strlen($string)<=$count)
	{
	return $string;
	} else
	{
	$string = strip_tags($string);
    $string = substr($string, 0, $count);
    $string = rtrim($string, "!,.-:?");
    $string = substr($string, 0, strrpos($string, ' '));
    return $string." ...";
	}
}


function request_url()
{
  $result = ''; // Пока результат пуст
  $default_port = 80; // Порт по-умолчанию
 
  // А не в защищенном-ли мы соединении?
  if (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS']=='on')) {
    // В защищенном! Добавим протокол...
    $result .= 'https://';
    // ...и переназначим значение порта по-умолчанию
    $default_port = 443;
  } else {
    // Обычное соединение, обычный протокол
    $result .= 'http://';
  }
  // Имя сервера, напр. site.com или www.site.com
  $result .= $_SERVER['SERVER_NAME'];
 
  // А порт у нас по-умолчанию?
  if ($_SERVER['SERVER_PORT'] != $default_port) {
    // Если нет, то добавим порт в URL
    $result .= ':'.$_SERVER['SERVER_PORT'];
  }
  // Последняя часть запроса (путь и GET-параметры).
  $result .= $_SERVER['REQUEST_URI'];
  // Уфф, вроде получилось!
  return $result;
}

//3 Марта 2017 г.
//3 Марта 2017 г. - 3 Марта 2017 г.
function date_fik($D,$D1 = '')
{	
  if($D=='') {return "";} else
  {
	  
  if($D1!='')
  {

	    $F= explode('-', $D);
	  $F1= explode('-', $D1);

  switch($F[1])
  {
   case "1": $mont="Января"; break;
   case "2": $mont="Февраля"; break;
   case "3": $mont="Марта"; break;
   case "4": $mont="Апреля"; break;
   case "5": $mont="Мая"; break;
   case "6": $mont="Июня"; break;
   case "7": $mont="Июля"; break;
   case "8": $mont="Августа"; break;
   case "9": $mont="Сентября"; break;
   case "10": $mont="Октября"; break;
   case "11": $mont="Ноября"; break;
   case "12": $mont="Декабря"; break;
  }
    switch($F1[1])
  {
   case "1": $mont1="Января"; break;
   case "2": $mont1="Февраля"; break;
   case "3": $mont1="Марта"; break;
   case "4": $mont1="Апреля"; break;
   case "5": $mont1="Мая"; break;
   case "6": $mont1="Июня"; break;
   case "7": $mont1="Июля"; break;
   case "8": $mont1="Августа"; break;
   case "9": $mont1="Сентября"; break;
   case "10": $mont1="Октября"; break;
   case "11": $mont1="Ноября"; break;
   case "12": $mont1="Декабря"; break;
  }

  $DD=date_minus_null($F[2])." ".$mont." ".$F[0]." г. - ".date_minus_null($F1[2])." ".$mont1." ".$F1[0]." г.";
  
  return $DD;
	  
  } else
	 { 
	  
  //echo($D);
  $F= explode('-', $D);

  switch($F[1])
  {
   case "1": $mont="Января"; break;
   case "2": $mont="Февраля"; break;
   case "3": $mont="Марта"; break;
   case "4": $mont="Апреля"; break;
   case "5": $mont="Мая"; break;
   case "6": $mont="Июня"; break;
   case "7": $mont="Июля"; break;
   case "8": $mont="Августа"; break;
   case "9": $mont="Сентября"; break;
   case "10": $mont="Октября"; break;
   case "11": $mont="Ноября"; break;
   case "12": $mont="Декабря"; break;
  }
  

  $DD=date_minus_null($F[2])." ".$mont." ".$F[0]." г.";
  
  return $DD;
  }
  }
}

//преобразование даты к формату 05 Декабря 2009, 14:47
function MaskDate($D)
{
  //echo($D);
  $D = explode(' ', $D);
  $F= explode('-', $D[0]);
  $G= explode(':', $D[1]);

  switch($F[1])
  {
   case "1": $mont="января"; break;
   case "2": $mont="февраля"; break;
   case "3": $mont="марта"; break;
   case "4": $mont="апреля"; break;
   case "5": $mont="мая"; break;
   case "6": $mont="июня"; break;
   case "7": $mont="июля"; break;
   case "8": $mont="августа"; break;
   case "9": $mont="сентября"; break;
   case "10": $mont="октября"; break;
   case "11": $mont="ноября"; break;
   case "12": $mont="декабря"; break;
  }
  
  if($G[0]=='')
  {
  $DD=$F[2]." ".$mont." ".$F[0];	  
  } else
  {
  
  $DD=$F[2]." ".$mont." ".$F[0]." ".$G[0].":".$G[1];
  }
  return $DD;

}

//вывод цветных комментариев
function CommentsColor($count,$class_dop)
{
  if($count!=0)
  {	
    if($count<5)
	{
	   //синий	
	   echo('<div class="comment_tip2 '.$class_dop.'">'.$count.'</div>');
	} 
    if(($count<10)and($count>=5))
	{
	   //желтый	
	   echo('<div class="comment_tip  '.$class_dop.'">'.$count.'</div>');
	} 
    if($count>=10)
	{
	   //красный
	   echo('<div class="comment_tip1  '.$class_dop.'">'.$count.'</div>');
	} 	
  }	
}
function CommentsColorAjax($count,$class_dop)
{
  if($count!=0)
  {	
    if($count<5)
	{
	   //синий	
	   return('<div class="comment_tip2 '.$class_dop.'">'.$count.'</div>');
	} 
    if(($count<10)and($count>=5))
	{
	   //желтый	
	    return('<div class="comment_tip  '.$class_dop.'">'.$count.'</div>');
	} 
    if($count>=10)
	{
	   //красный
	    return('<div class="comment_tip1  '.$class_dop.'">'.$count.'</div>');
	} 	
  }	
}


//автоматическое определение limita у sql запроса для постраничного вывода
function limitPage($varpage,$countwrite)
{
	//$varpage - название GET переменной которая передает номер страницы
	//$countwrite - количество выводимого на одной странице
  $count_otziv=0;
  $kol_st_n=0;
  if(isset($_GET[$varpage]))
  {
   if (is_numeric($_GET[$varpage])) {	
	  $number_st=$_GET[$varpage];
      $flag_ot=$_GET[$varpage];
	} else
	{
      $number_st=1;
      $flag_ot=1;	
	}
	
  } else
  {
    $number_st=1;
    $flag_ot=1;
  }
  
  if($number_st==1)
  {
    $number_st=0;
  } else
  {
    $number_st=($number_st*$countwrite)-$countwrite;
  }

$limit=' limit '.$number_st.','.$countwrite;

return $limit;
}


//определение номера активной страницы для постраничного вывода
function NumberPageActive($varpage)
{
	//$varpage - название GET переменной которая передает номер страницы
	//$countwrite - количество выводимого на одной странице
  if(isset($_GET[$varpage]))
  {
   if (is_numeric($_GET[$varpage])) {	
      $flag_ot=$_GET[$varpage];
	} else
	{
      $flag_ot=1;	
	}
	
  } else
  {
    $flag_ot=1;
  }

return $flag_ot;
}


function CountNews($sql,$link)
{
	$count_otziv=0;
	$result_st=mysql_time_query($link,$sql);
    $num_results_st = $result_st->num_rows; 
    if($num_results_st<>0)
    {
       $row_st = mysqli_fetch_assoc($result_st);
	   $count_otziv=$row_st['kol'];
	}
return $count_otziv;	
}


function CountPage($sql,$link,$countwrite)
{
	$count_otziv=0;
	$result_st=mysql_time_query($link,$sql);
    $num_results_st = $result_st->num_rows; 
    if($num_results_st<>0)
    {
       $row_st = mysqli_fetch_assoc($result_st);
	   $count_otziv=ceil($row_st['kol']/$countwrite);
	}
return $count_otziv;	
}


//функция постраничные ссылки для статей, новостей, отзывов
function displayPageLink_new($link_one,$link_start, $link_end, $flag_ot, $count_otziv,$count_list,$count_visible,$class,$type)
{
	$style='';
/*		
        http://www.ulyanovskmenu.ru/place/kedy/news.php?page=2?go=news
		----------------------------------------------------- --------
		                $link_start                           $link_end


        http://www.ulyanovskmenu.ru/place/kedy/news/2/news/
		-------------------------------------------- ------
		                $link_start                 $link_end	
		$link_start="http://www.ulyanovskmenu.ru/place/kedy/news/"               
		$link_end="/news/"				
*/	
	

     //$link_one       - ссылка первой страницы (чтобы не было дублей)
	 //$link_start     - начало ссылки
	 //$link_end       - конец ссылки
	 //$count_list     - после какого номера страницы начинать движение остальных       const=10
	 //$count_visible  - количество страниц видимых (10 -  1 2 3 4 5 6 7 8 9 10 ...)    const=20
     //$flag_ot        - номер активной страницы
     //$count_otziv    - количество страниц всего
	 //$class          - какой класс
	 //$type           - тип вывода 1-с кнопка предыдушая-следующая   0 - с кнопка первая-последняя

    
    echo'<div class="pgs '.$style.'"><ul class="pgs_ul">';


     if($flag_ot<=$count_list)
	 {
		//вывод если страница не больше чем когда первые страницы будут не видны 
		if(($type==1)and($flag_ot!=1))
		{
			if(($flag_ot-1)==1)
			{
		       echo'<li class="pgs_li lefts"><a href="'.$link_one.'"><i></i></a></li>';
			} else
			{
				echo'<li class="pgs_li lefts"><a href="'.$link_start.($flag_ot-1).$link_end.'"><i></i></a></li>';
			}
		}
		 
		 
        for($i=1; (($i<=$count_visible)and($i<=$count_otziv)); $i++)
        {
          if($flag_ot==$i) { echo"<li class='pgs_li here'>".$i."</li>"; } 
		  else { 
		  if($i==1)
		  {
		    echo"<li class='pgs_li'><a href='".$link_one."'>".$i."</a></li>"; 
		  } else
		  {
			echo"<li class='pgs_li'><a href='".$link_start.$i.$link_end."'>".$i."</a></li>";   
		  }
		  }
        }
		if(($i<$count_otziv)and($type==0)) { echo"<li class='pgs_li end'><a href='".$link_start.$i.$link_end."'>...</a></li>";	}
		
		
		if(($type==1)and($flag_ot!=$count_otziv))
		{
		    echo'<li class="pgs_li rights"><a href="'.$link_start.($flag_ot+1).$link_end.'"><i></i></a></li>';		 
		}
		
	 }
	 else
	 {
		
		if(($flag_ot+$count_list)<=$count_otziv)
		{

		  $end_st=$flag_ot-$count_list;	
		  
		  if($type==0)
		  {  
		    if($end_st==1)
		    {					
		      echo"<li class='pgs_li end'><a href='".$link_one."'>...</a></li>";
			} else
			{
			  echo"<li class='pgs_li end'><a href='".$link_start.$end_st.$link_end."'>...</a></li>";
			}
		  }
		  if(($type==1)and($flag_ot!=1))
		  {
			if(($flag_ot-1)==1)
			{
		       echo'<li class="pgs_li lefts"><a href="'.$link_one.'"><i></i></a></li>';
			} else
			{
				echo'<li class="pgs_li lefts"><a href="'.$link_start.($flag_ot-1).$link_end.'"><i></i></a></li>';
			}
		  }  
		  
		  
		  for($i=($end_st+1); (($i<=($count_visible+$end_st))and($i<=$count_otziv)); $i++)
          {
            if($flag_ot==$i) { echo"<li class='pgs_li here'>".$i."</li>"; } 
		    else { 
			
			//echo"<li class='pgs_li'><a href='".$link_start.$i.$link_end."'>".$i."</a></li>"; 
		  if($i==1)
		  {
		    echo"<li class='pgs_li'><a href='".$link_one."'>".$i."</a></li>"; 
		  } else
		  {
			echo"<li class='pgs_li'><a href='".$link_start.$i.$link_end."'>".$i."</a></li>";   
		  }
			
			
			}
          }
		  if(($i<=$count_otziv)and($type==0)) { echo"<li class='pgs_li end'><a href='".$link_start.$i.$link_end."'>...</a></li>";	}

		  if((($flag_ot+1)<=$count_otziv)and($type==1)) { echo"<li class='pgs_li rights'><a href='".$link_start.($flag_ot+1).$link_end."'><i></i></a></li>";	}		  
		  
		  
		  
		} else
		{
          $end_st=$count_otziv-$count_visible;
		  if($end_st<0)
		  {
			 $end_st=0; 
		  }
		  if(($end_st>0)and($type==0))
		  {
			  if($end_st==1)
			  {
		          echo"<li class='pgs_li end'><a href='".$link_one."'>...</a></li>";	
			  } else
			  {
				  echo"<li class='pgs_li end'><a href='".$link_start.$end_st.$link_end."'>...</a></li>";  
			  }
		  }
		  
		  
		  if(($type==1)and(($flag_ot-1)>=1))
		  {
			  /*
		  if(($end_st>0)and($type==1))
		  {
			  */
			  if(($flag_ot-1)==1)
			  {  
		         echo"<li class='pgs_li lefts'><a href='".$link_one."'><i></i></a></li>";	
			  } else
			  {
				 echo"<li class='pgs_li lefts'><a href='".$link_start.($flag_ot-1).$link_end."'><i></i></a></li>"; 
			  }
		  }		  
		  
          for($i=($end_st+1); (($i<=($count_visible+$end_st))and($i<=$count_otziv)); $i++)
          {
            if($flag_ot==$i) { echo"<li class='pgs_li here'>".$i."</li>"; } 
		    else { 
			
			if($i==1)
			{
			  echo"<li class='pgs_li'><a href='".$link_one."'>".$i."</a></li>"; 
			} else
			{
				echo"<li class='pgs_li'><a href='".$link_start.$i.$link_end."'>".$i."</a></li>"; 
			}
			
			}
          }
		  
		  if((($flag_ot+1)<=$count_otziv)and($type==1)) { echo"<li class='pgs_li rights'><a href='".$link_start.($flag_ot+1).$link_end."'><i></i></a></li>";	}	
		  
		}		 
	 }
       echo'</ul></div>'; 
 }



function EmailNameNik($email,$name,$nik)
{
	$namess=$nik;
	if($nik=='')
	{
		if($name=='')
		{
			$namess=$email;
		} else
		{
			$namess=$name;
		}
	}
	return $namess;
}

function MaskDate_D_M_Y_ss($D)
{
  if($D!='')	
  {
  //echo($D);
  $D = explode('-', $D);

  $DD=$D[2].".".$D[1].".".$D[0];
  return $DD;
  } else
  {
	 return ''; 
  }

}


function infoUser_new(&$USER,$id_us,$link)
{
$USER=array(); 	

/*
status            //статус пользователя
profession        //деятельность фотограф, ресторатор, программист
online            //онлайн или нет
avatar            //аватар
avatar_info       
avatar_rand
avatar_rand_sm
award             //медали
name_user         //имя или ник
pro_st            //про иконки
firstname         //имя
lastname          //фамилия
nik               //никнейм
birthday          //день рождение
city              //город
pol               //пол
key               //ключ для отправки сообщений
workers           //работник компании или нет. A - администратор 1 - работник компании 0 - обычный пользователь
*/

$USER["status"]='';  
$USER["key"]='';    
$USER["profession"]=''; 
$USER["award"]='';      
$USER["pro_st"]='';     
$USER["name_user"]='';
$USER["pol"]=0; 
$USER["nik"]='';
$USER["birthday"]='0000-00-00'; 
$USER["city"]='';   
$USER["workers"]='0'; 
$USER["last_visit"]='0000-00-00'; 


   $result_authority=mysql_time_query($link,'select C.nik,C.namess,C.last_visit,C.workers,C.avatar, C.avatar_rand_sm, A.*,B.name from users_authority as A,users_profession as B,users as C where C.id=A.id_users AND A.profession=B.id  AND A.id_users="'.$id_us.'"');
   $num_results_authority = $result_authority->num_rows; 
   
   if($num_results_authority<>0)
   {
	   $row_authority = mysqli_fetch_assoc($result_authority);
	   $USER["last_visit"]=$row_authority["last_visit"];
	   $USER["rating"]=0;
	   
	   

	   $USER["avatar"]=0;
	   $USER["avatar"]=$row_authority["avatar"];
	   $USER["avatar_rand_sm"]=$row_authority["avatar_rand_sm"];
	   /////////////////////////////////////////////////////////////////////
       if($row_authority["status"]=="0")
	   {
		  //если конкретный статус не установлен , определяем его по рейтингу типа заведения
		  //если ты в разделе "сауны" у тебя один статус в этом ты профи, но в тоже время ты можешь быть не профи в боулинге или кафе.
		  $USER["rating"]=0;
		  $result_importance1=mysql_time_query($link,'select rest_rating as rrr from users_rating where id_users="'.$id_us.'"');
          $num_results_importance1 = $result_importance1->num_rows;
		  if($num_results_importance1<>0)
		  {
			  $row_importance1 = mysqli_fetch_assoc($result_importance1);
			  $USER["rating"]=$row_importance1["rrr"];
		  }
          if($USER["rating"]!=0)
		  {
            $row_status = mysqli_fetch_assoc(mysql_time_query($link,'select * from users_status_const where start_limit<="'.$rating_200.'" order by end_limit desc limit 0,1'));
		    $USER["status"]=$row_status["name"];
		  } else
		  {
			$USER["status"]="аноним";  
		  }		  
		  
	   } else
	   {
		  $USER["status"]=$row_authority["status"];
		  
		  $result_importance1=mysql_time_query($link,'select rest_rating as rrr from users_rating where id_users="'.$id_us.'"');
          $num_results_importance1 = $result_importance1->num_rows;
		  if($num_results_importance1<>0)
		  {
			  $row_importance1 = mysqli_fetch_assoc($result_importance1);
			  $USER["rating"]=$row_importance1["rrr"];
		  }		  
		  
	   }
       $USER["profession"]=$row_authority["name"]; 	   
       if($row_authority["nik"]!="")
	   {
		 $USER["name_user"]=$row_authority["nik"];
	   } else
	   {
		 $USER["name_user"]=$row_authority["namess"];
		 
		 
		 
	   }
	   $USER["nik"]=$row_authority["nik"];  
	   $USER["workers"]=$row_authority["workers"];  	   
	   
	   //$name_user='<a  href="http://www.ulyanovskmenu.ru/users/'.$id_us.'/">'.$name_user.'</a>';
   //}
	   
	   $plplpl='';

	   if($row_authority["award"]!=0)
	   {	   
	      $award="";

          $result_award1=mysql_time_query($link,'select * from users_award as A where A.id IN ('.$row_authority["award"].')');

          $num_results_award1 = $result_award1->num_rows;

	      for ($iaw=0; $iaw<$num_results_award1; $iaw++)
          {
		    $row_award1 = mysqli_fetch_assoc($result_award1);
			
			if($iaw==0)
			{
					   $USER["award"]=$USER["award"].'<img onmouseover="ShowCloud( \''.$row_award1["text"].'\' );" onmouseout="HideCloud();" border=0  src="'.$row_award1["img_link"].'"/>';				
			} else
			{
			
					   $USER["award"]=$USER["award"].'<img onmouseover="ShowCloud( \''.$row_award1["text"].'\' );" onmouseout="HideCloud();" border=0 style=" padding-left:4px; " src="'.$row_award1["img_link"].'"/>';
			}
		  }
	   } else
	   {
		  $USER["award"]="";
	   }

	   /////////////////////////////////////////////////////////////////////
	   if($row_authority["pro"]!=0)
	   {	
          $pro_st="";

          $result_pro1=mysql_time_query($link,'select * from users_pro as A where A.id IN ('.$row_authority["pro"].')');
          $num_results_pro1 = $result_pro1->num_rows;

	      for ($ipr=0; $ipr<$num_results_pro1; $ipr++)
          {
		    $row_pro1 = mysqli_fetch_assoc($result_pro1);
			
			if($ipr==0)
			{
			$USER["pro_st"]=$USER["pro_st"].'<img onmouseover="ShowCloud( \''.$row_pro1["text"].'\' );" onmouseout="HideCloud();" border=0 src="'.$row_pro1["img_link"].'"/>';
			} else
			{			
			$USER["pro_st"]=$USER["pro_st"].'<img onmouseover="ShowCloud( \''.$row_pro1["text"].'\' );" onmouseout="HideCloud();" border=0 style=" padding-left:4px; " src="'.$row_pro1["img_link"].'"/>';
			}

		  }	   	   
	   } else
	   {
		  $USER["pro_st"]="";   
	   }


   }
   

   
   return $USER;	
}


//обход функции rand() в mysql для более быстрого выполнения запросов
//$link
//$sql - обычный sql запрос без limit и rand. Обязательно перед главным from ставить указатель **
//$rand - количество элементов которые надо получить
function  mysql_time_query_rand($link,$sql,$rand)
{
   $sql1='';
   //перевести запрос во все маленькие буквы
   $sql = mb_strtolower($sql);
   //удалить кусок до части from
   list($j,$sql1) = explode("**", $sql);
   $result_1 = mysql_time_query($link,"SELECT count(*) as b ".$sql1);
   $row_1 = mysqli_fetch_assoc($result_1);
   $row_count=$row_1["b"];
   $result_1->close();
   if(($row_count-$rand)<0)
   {
	 $rand_row = 0;   
   } else
   {
     $rand_row = rand(0, ($row_count-$rand));
   }
   $result_tany=mysql_time_query($link,$j.''.$sql1." limit ".$rand_row.",".$rand);
   //echo($j.''.$sql1." limit ".$rand_row.",".$rand);
   return $result_tany;
}


//поиск в кукки нужно переменной и значения разделенные каким то разделителем
//возвращает или false если нет такого значения или true соответственно
//если $work = add то если нет то добавится если же $work=0 то просто проверится есть или нет

function cookie_work ($var,$value,$explode,$hour,$work)
{
        $kk=0;$Po='';$hh=0;		
		if ( isset($_COOKIE[$var]))
		{
		   $D = explode($explode, $_COOKIE[$var]);
           for ($i=0; $i<count($D); $i++)
		   {
		      $hh=1;
			  if($D[$i]==$value) { $kk=1;}
		   }
		}
		//echo($work);
		//сессия существует но такого значения в ней нет
		if($work=='add')
		{
		if(($kk==0)and($hh==1))
		{
		   for ($i=0; $i<count($D); $i++)
		   { 
		      if($i==0)
			  {
			     $Po=$D[$i];
			  } else
			  {
			    $Po=$Po.'.'.$D[$i];
			  }
		    
		   }
		   $Po=$Po.'.'.$value;		   
		   setcookie ($var, $Po,mktime (date("H")+$hour),"/");

		}
		
		
		//сессии нет вообще
		if($hh==0)
		{
		  $Po=$value;
		   setcookie ($var, $Po,mktime (date("H")+$hour),"/");		   		  
		}
		}
	
	if($kk==1)
	{
		return true;
	} else
	{
	    return false;	
	}
	
}

//убрать первый 0 для часов
//02 - 2
//12 - 12
function date_minus_null($time) 
{ 
   if($time[0]==0)
   {
	 return   $time[1]; 
   } else
   {
	  return   $time;  
   }
}


//проверка осталось ли до даты меньше чем step дней
function time_compare_step($date_time,$clock_region,$step) 
{ 
//0 - прошло
//1 - не прошло

	
	
	
//2011-01-19 15:07:31

if($date_time!=null)
{
	
	
$date_elements  = explode(" ",$date_time);
$date_elements1  = explode(":",$date_elements[1]);
$date_elements2  = explode("-",$date_elements[0]);

$date_elements2=date("Y", mktime($date_elements1[0], $date_elements1[1], $date_elements1[2], $date_elements2[1],($date_elements2[2]-$step), $date_elements2[0])).'-'.date("m", mktime($date_elements1[0], $date_elements1[1], $date_elements1[2], $date_elements2[1],($date_elements2[2]-$step), $date_elements2[0])).'-'.date("d", mktime($date_elements1[0], $date_elements1[1], $date_elements1[2], $date_elements2[1],($date_elements2[2]-$step), $date_elements2[0]));		

$date_elements2	 = explode("-",$date_elements2);
//echo(date_minus_null($date_elements1[0])+1);

$session_time=mktime((date_minus_null($date_elements1[0])-$clock_region), $date_elements1[1], $date_elements1[2], $date_elements2[1], $date_elements2[2], $date_elements2[0]);
$time_difference = time() - $session_time; 
$minutes = round($time_difference / 60 );
//echo($minutes);
//Minutes
$vremy=0;
if($minutes <=0)
{
	$vremy=1;
}
return $vremy;
} else
{
	return 1;
}
} 

//проверка прошло ли событие или нет
function time_compare($date_time,$clock_region) 
{ 
//0 - прошло
//1 - не прошло

//2011-01-19 15:07:31

if($date_time!=null)
{

$date_elements  = explode(" ",$date_time);
$date_elements1  = explode(":",$date_elements[1]);
$date_elements2  = explode("-",$date_elements[0]);

//echo(date_minus_null($date_elements1[0])+1);

$session_time=mktime((date_minus_null($date_elements1[0])-$clock_region), $date_elements1[1], $date_elements1[2], $date_elements2[1], $date_elements2[2], $date_elements2[0]);
$time_difference = time() - $session_time; 
$minutes = round($time_difference / 60 );
//echo($minutes);
//Minutes
$vremy=0;
if($minutes <=0)
{
	$vremy=1;
}
return $vremy;
} else
{
	return 1;
}
}

function month_rus1($mon)
{
    switch($mon)
    {
        case "01": { $montw1="январь";  break; }
        case "02": { $montw1="февраль"; break; }
        case "03": { $montw1="март"; break; }
        case "04": {  $montw1="апрель"; break; }
        case "05": {  $montw1="май"; break; }
        case "06": {  $montw1="июнь"; break; }
        case "07": {   $montw1="июль"; break; }
        case "08": {  $montw1="август"; break; }
        case "09": { $montw1="сентябрь"; break; }
        case "10": {  $montw1="октябрь"; break; }
        case "11": {  $montw1="ноябрь"; break; }
        case "12": {   $montw1="декабрь"; break; }
    }
    return  $montw1;
}

function month_rus($mon)
{
	switch($mon)
   {
   case "01": { $montw1="января";  break; }
   case "02": { $montw1="февраля"; break; }
   case "03": { $montw1="марта"; break; }
   case "04": {  $montw1="апреля"; break; }
   case "05": {  $montw1="мая"; break; }
   case "06": {  $montw1="июня"; break; }
   case "07": {   $montw1="июля"; break; }
   case "08": {  $montw1="августа"; break; }
   case "09": { $montw1="сентября"; break; }
   case "10": {  $montw1="октября"; break; }
   case "11": {  $montw1="ноября"; break; }
   case "12": {   $montw1="декабря"; break; }
   }
   return  $montw1;
}


//приведение даты к виду сегодня, вчера, или когда то там
function time_stamp_mess($date_time) 
{ 

//2011-01-19 15:07:31
//->>
	
$date_elements  = explode(" ",$date_time);
$date_elements1  = explode(":",$date_elements[1]);
$date_elements2  = explode("-",$date_elements[0]);


$session_time=mktime($date_elements1[0], $date_elements1[1], $date_elements1[2], $date_elements2[1], $date_elements2[2], $date_elements2[0]);
$time_difference = time() - $session_time; 
$minutes = round($time_difference / 60 );
//Minutes
$vremy='';


//проверяем сегодня ли это было
if($date_elements[0]==date("Y").'-'.date("m").'-'.date("d"))
{
      $vremy="сегодня";
	  return $vremy;	
}

//проверяем вчера ли это было
if($date_elements[0]==date("Y", mktime(date("G"), date("i"), date("s"), date("n"),(date("j")-1), date("Y"))).'-'.date("m", mktime(date("G"), date("i"), date("s"), date("n"),(date("j")-1), date("Y"))).'-'.date("d", mktime(date("G"), date("i"), date("s"), date("n"),(date("j")-1), date("Y"))))
{
      $vremy="вчера";
	  return $vremy;	
}

//в этом ли году
//echo($date_elements2[0]);	
if($date_elements2[0]==date("Y"))
{
   $montw1='';
   switch($date_elements2[1])
   {
   case "01": { $montw1="января";  break; }
   case "02": { $montw1="февраля"; break; }
   case "03": { $montw1="марта"; break; }
   case "04": {  $montw1="апреля"; break; }
   case "05": {  $montw1="мая"; break; }
   case "06": {  $montw1="июня"; break; }
   case "07": {   $montw1="июля"; break; }
   case "08": {  $montw1="августа"; break; }
   case "09": { $montw1="сентября"; break; }
   case "10": {  $montw1="октября"; break; }
   case "11": {  $montw1="ноября"; break; }
   case "12": {   $montw1="декабря"; break; }
   }
	
	
      $vremy=$date_elements2[2]." ".$montw1;
	  return $vremy;	 	
} else
{
	
   $montw1='';
   switch($date_elements2[1])
   {
   case "01": { $montw1="января";  break; }
   case "02": { $montw1="февраля"; break; }
   case "03": { $montw1="марта"; break; }
   case "04": {  $montw1="апреля"; break; }
   case "05": {  $montw1="мая"; break; }
   case "06": {  $montw1="июня"; break; }
   case "07": {   $montw1="июля"; break; }
   case "08": {  $montw1="августа"; break; }
   case "09": { $montw1="сентября"; break; }
   case "10": {  $montw1="октября"; break; }
   case "11": {  $montw1="ноября"; break; }
   case "12": {   $montw1="декабря"; break; }
   }	
	
      $vremy=$date_elements2[2]." ".$montw1." ".$date_elements2[0];
	  return $vremy;	
}

} 

//функция какая дата будет через step дней
//2018-03-19 5дней -> 2018-03-24
function date_step($date,$day)
{
	$date_elements2  = explode("-",$date);
	
	
	$date_new=date("Y", mktime(date("G"), date("i"), date("s"), $date_elements2[1],($date_elements2[2]+$day), $date_elements2[0])).'-'.date("m", mktime(date("G"), date("i"), date("s"), $date_elements2[1],($date_elements2[2]+$day), $date_elements2[0])).'-'.date("d", mktime(date("G"), date("i"), date("s"), $date_elements2[1],($date_elements2[2]+$day), $date_elements2[0]));
	return $date_new;
}


//приведение даты к виду  - 14:25
function time_stamp_time($date_time) 
{ 

//2011-01-19 15:07:31
//->>
	
$date_elements  = explode(" ",$date_time);
$date_elements1  = explode(":",$date_elements[1]);
$date_elements2  = explode("-",$date_elements[0]);



	  return $date_elements1[0].':'.$date_elements1[1];	


} 


//приведение даты к виду завтра в 15:00, послезавтра в 15:00,07 октября в 15:00, 6 июля 2018 г. в 15:00
function time_future_($date_time) 
{ 

//2011-01-19 15:07:31
//->>
	
$date_elements  = explode(" ",$date_time);
$date_elements1  = explode(":",$date_elements[1]);
$date_elements2  = explode("-",$date_elements[0]);


$session_time=mktime($date_elements1[0], $date_elements1[1], $date_elements1[2], $date_elements2[1], $date_elements2[2], $date_elements2[0]);
$time_difference = time() - $session_time; 
$minutes = round($time_difference / 60 );
//Minutes
$vremy='';


//проверяем сегодня ли это было
if($date_elements[0]==date("Y").'-'.date("m").'-'.date("d"))
{
      $vremy="сегодня в ".$date_elements1[0].':'.$date_elements1[1];
	  return $vremy;	
}

//проверяем может завтра
if($date_elements[0]==date("Y", mktime(date("G"), date("i"), date("s"), date("n"),(date("j")+1), date("Y"))).'-'.date("m", mktime(date("G"), date("i"), date("s"), date("n"),(date("j")+1), date("Y"))).'-'.date("d", mktime(date("G"), date("i"), date("s"), date("n"),(date("j")+1), date("Y"))))
{
      $vremy="завтра в ".$date_elements1[0].':'.$date_elements1[1];
	  return $vremy;	
}

//в этом ли году
//echo($date_elements2[0]);	
if($date_elements2[0]==date("Y"))
{
	//echo("!");
   $montw1='';
   switch($date_elements2[1])
   {
   case "01": { $montw1="января";  break; }
   case "02": { $montw1="февраля"; break; }
   case "03": { $montw1="марта"; break; }
   case "04": {  $montw1="апреля"; break; }
   case "05": {  $montw1="мая"; break; }
   case "06": {  $montw1="июня"; break; }
   case "07": {   $montw1="июля"; break; }
   case "08": {  $montw1="августа"; break; }
   case "09": { $montw1="сентября"; break; }
   case "10": {  $montw1="октября"; break; }
   case "11": {  $montw1="ноября"; break; }
   case "12": {   $montw1="декабря"; break; }
   }
	
	
      $vremy=$date_elements2[2]." ".$montw1." в ".$date_elements1[0].':'.$date_elements1[1];
	  return $vremy;	 	
} else
{
	
   $montw1='';
   switch($date_elements2[1])
   {
   case "01": { $montw1="января";  break; }
   case "02": { $montw1="февраля"; break; }
   case "03": { $montw1="марта"; break; }
   case "04": {  $montw1="апреля"; break; }
   case "05": {  $montw1="мая"; break; }
   case "06": {  $montw1="июня"; break; }
   case "07": {   $montw1="июля"; break; }
   case "08": {  $montw1="августа"; break; }
   case "09": { $montw1="сентября"; break; }
   case "10": {  $montw1="октября"; break; }
   case "11": {  $montw1="ноября"; break; }
   case "12": {   $montw1="декабря"; break; }
   }	
	
      $vremy=$date_elements2[2]." ".$montw1." ".$date_elements2[0]." в ".$date_elements1[0].':'.$date_elements1[1];
	  return $vremy;	
}

} 



function time_stamp_dd($date_time) 
{ 

//2011-01-19 15:07:31
//->>
	
//$date_elements1  = explode(":",$date_elements[1]);
$date_elements2  = explode("-",$date_time);


$session_time=mktime(0, 0, 0, $date_elements2[1], $date_elements2[2], $date_elements2[0]);
$time_difference = time() - $session_time; 
$minutes = round($time_difference / 60 );
//Minutes
$vremy='';


//проверяем сегодня ли это было
if($date_time==date("Y").'-'.date("m").'-'.date("d"))
{
      $vremy="сегодня";
	  return $vremy;	
}

//проверяем вчера ли это было
if($date_time==date("Y", mktime(date("G"), date("i"), date("s"), date("n"),(date("j")-1), date("Y"))).'-'.date("m", mktime(date("G"), date("i"), date("s"), date("n"),(date("j")-1), date("Y"))).'-'.date("d", mktime(date("G"), date("i"), date("s"), date("n"),(date("j")-1), date("Y"))))
{
      $vremy="вчера";
	  return $vremy;	
}

//в этом ли году
//echo($date_elements2[0]);	
if($date_elements2[0]==date("Y"))
{
	//echo("!");
   $montw1='';
   switch($date_elements2[1])
   {
   case "01": { $montw1="января";  break; }
   case "02": { $montw1="февраля"; break; }
   case "03": { $montw1="марта"; break; }
   case "04": {  $montw1="апреля"; break; }
   case "05": {  $montw1="мая"; break; }
   case "06": {  $montw1="июня"; break; }
   case "07": {   $montw1="июля"; break; }
   case "08": {  $montw1="августа"; break; }
   case "09": { $montw1="сентября"; break; }
   case "10": {  $montw1="октября"; break; }
   case "11": {  $montw1="ноября"; break; }
   case "12": {   $montw1="декабря"; break; }
   }
	
	
      $vremy=$date_elements2[2]." ".$montw1;
	  return $vremy;	 	
} else
{
	
   $montw1='';
   switch($date_elements2[1])
   {
   case "01": { $montw1="января";  break; }
   case "02": { $montw1="февраля"; break; }
   case "03": { $montw1="марта"; break; }
   case "04": {  $montw1="апреля"; break; }
   case "05": {  $montw1="мая"; break; }
   case "06": {  $montw1="июня"; break; }
   case "07": {   $montw1="июля"; break; }
   case "08": {  $montw1="августа"; break; }
   case "09": { $montw1="сентября"; break; }
   case "10": {  $montw1="октября"; break; }
   case "11": {  $montw1="ноября"; break; }
   case "12": {   $montw1="декабря"; break; }
   }	
	
      $vremy=$date_elements2[2]." ".$montw1." ".$date_elements2[0];
	  return $vremy;	
}

} 

function time_stamp_dd1($date_time) 
{ 

//2011-01-19 15:07:31
//->>
	
$date_elements1  = explode(" ",$date_time);
$date_elements2  = explode("-",$date_elements1[0]);


$session_time=mktime(0, 0, 0, $date_elements2[1], $date_elements2[2], $date_elements2[0]);
$time_difference = time() - $session_time; 
$minutes = round($time_difference / 60 );
//Minutes
$vremy='';


//проверяем сегодня ли это было
if($date_elements1[0]==date("Y").'-'.date("m").'-'.date("d"))
{
      $vremy="сегодня";
	  return $vremy;	
}

//проверяем вчера ли это было
if($date_elements1[0]==date("Y", mktime(date("G"), date("i"), date("s"), date("n"),(date("j")-1), date("Y"))).'-'.date("m", mktime(date("G"), date("i"), date("s"), date("n"),(date("j")-1), date("Y"))).'-'.date("d", mktime(date("G"), date("i"), date("s"), date("n"),(date("j")-1), date("Y"))))
{
      $vremy="вчера";
	  return $vremy;	
}

//в этом ли году
//echo($date_elements2[0]);	
if($date_elements2[0]==date("Y"))
{
	//echo("!");
   $montw1='';
   switch($date_elements2[1])
   {
   case "01": { $montw1="января";  break; }
   case "02": { $montw1="февраля"; break; }
   case "03": { $montw1="марта"; break; }
   case "04": {  $montw1="апреля"; break; }
   case "05": {  $montw1="мая"; break; }
   case "06": {  $montw1="июня"; break; }
   case "07": {   $montw1="июля"; break; }
   case "08": {  $montw1="августа"; break; }
   case "09": { $montw1="сентября"; break; }
   case "10": {  $montw1="октября"; break; }
   case "11": {  $montw1="ноября"; break; }
   case "12": {   $montw1="декабря"; break; }
   }
	
	
      $vremy=$date_elements2[2]." ".$montw1;
	  return $vremy;	 	
} else
{
	
   $montw1='';
   switch($date_elements2[1])
   {
   case "01": { $montw1="января";  break; }
   case "02": { $montw1="февраля"; break; }
   case "03": { $montw1="марта"; break; }
   case "04": {  $montw1="апреля"; break; }
   case "05": {  $montw1="мая"; break; }
   case "06": {  $montw1="июня"; break; }
   case "07": {   $montw1="июля"; break; }
   case "08": {  $montw1="августа"; break; }
   case "09": { $montw1="сентября"; break; }
   case "10": {  $montw1="октября"; break; }
   case "11": {  $montw1="ноября"; break; }
   case "12": {   $montw1="декабря"; break; }
   }	
	
      $vremy=$date_elements2[2]." ".$montw1." ".$date_elements2[0];
	  return $vremy;	
}

} 

//проверка прошла или нет дата
function date_end_today($date_time)
{
    $date_elements  = explode(" ",$date_time);
    $date_elements1  = explode(":",$date_elements[1]);
    $date_elements2  = explode("-",$date_elements[0]);


    $session_time=mktime($date_elements1[0], $date_elements1[1], $date_elements1[2], $date_elements2[1], $date_elements2[2], $date_elements2[0]);
    $time_difference = time() - $session_time;



    if($time_difference>0)
    {

        return 1; //прошло уже
    } else
    {

        return 0; //еще будет или идет
    }
}

//приведение даты к виду 5,10,15,20,25 минут назад и так далее
function time_stamp($date_time) 
{ 

//2011-01-19 15:07:31
//->>
	
$date_elements  = explode(" ",$date_time);
$date_elements1  = explode(":",$date_elements[1]);
$date_elements2  = explode("-",$date_elements[0]);


$session_time=mktime($date_elements1[0], $date_elements1[1], $date_elements1[2], $date_elements2[1], $date_elements2[2], $date_elements2[0]);
$time_difference = time() - $session_time; 
$minutes = round($time_difference / 60 );
//Minutes
$vremy='';

if($minutes <=180)
{


   if($minutes<=10)
   {
      $vremy="5 минут назад";
	  return $vremy;
   }

   if($minutes<=15)
   {
      $vremy="10 минут назад";
	  return $vremy;
   }
   if($minutes<=20)
   {
      $vremy="15 минут назад";
	  return $vremy;
   }
   if($minutes<=25)
   {
      $vremy="20 минут назад";
	  return $vremy;
   }
   if($minutes<=30)
   {
      $vremy="25 минут назад";
	  return $vremy;
   }   
   if($minutes<=60)
   {
      $vremy="полчаса назад";
	  return $vremy;
   }
   if($minutes<=90)
   {
      $vremy="час назад";
	  return $vremy;
   }  
   if($minutes<=120)
   {
      $vremy="полтора часа назад";
	  return $vremy;
   } 
   
   if($minutes<=180)
   {
      $vremy="два часа назад";
	  return $vremy;
   }   

      $vremy="три часа назад";
	  return $vremy;
}

//проверяем сегодня ли это было
if($date_elements[0]==date("Y").'-'.date("m").'-'.date("d"))
{
      $vremy="сегодня в ".$date_elements1[0].':'.$date_elements1[1];
	  return $vremy;	
}

//проверяем вчера ли это было
if($date_elements[0]==date("Y", mktime(date("G"), date("i"), date("s"), date("n"),(date("j")-1), date("Y"))).'-'.date("m", mktime(date("G"), date("i"), date("s"), date("n"),(date("j")-1), date("Y"))).'-'.date("d", mktime(date("G"), date("i"), date("s"), date("n"),(date("j")-1), date("Y"))))
{
      $vremy="вчера в ".$date_elements1[0].':'.$date_elements1[1];
	  return $vremy;	
}

//в этом ли году
//echo($date_elements2[0]);	
if($date_elements2[0]==date("Y"))
{
	//echo("!");
   $montw1='';
   switch($date_elements2[1])
   {
   case "01": { $montw1="января";  break; }
   case "02": { $montw1="февраля"; break; }
   case "03": { $montw1="марта"; break; }
   case "04": {  $montw1="апреля"; break; }
   case "05": {  $montw1="мая"; break; }
   case "06": {  $montw1="июня"; break; }
   case "07": {   $montw1="июля"; break; }
   case "08": {  $montw1="августа"; break; }
   case "09": { $montw1="сентября"; break; }
   case "10": {  $montw1="октября"; break; }
   case "11": {  $montw1="ноября"; break; }
   case "12": {   $montw1="декабря"; break; }
   }
	
	
      $vremy=$date_elements2[2]." ".$montw1." в ".$date_elements1[0].':'.$date_elements1[1];
	  return $vremy;	 	
} else
{
	
   $montw1='';
   switch($date_elements2[1])
   {
   case "01": { $montw1="января";  break; }
   case "02": { $montw1="февраля"; break; }
   case "03": { $montw1="марта"; break; }
   case "04": {  $montw1="апреля"; break; }
   case "05": {  $montw1="мая"; break; }
   case "06": {  $montw1="июня"; break; }
   case "07": {   $montw1="июля"; break; }
   case "08": {  $montw1="августа"; break; }
   case "09": { $montw1="сентября"; break; }
   case "10": {  $montw1="октября"; break; }
   case "11": {  $montw1="ноября"; break; }
   case "12": {   $montw1="декабря"; break; }
   }	
	
      $vremy=$date_elements2[2]." ".$montw1." ".$date_elements2[0]." в ".$date_elements1[0].':'.$date_elements1[1];
	  return $vremy;	
}

} 

function task_iso($date_end,$date_start)
{
		$echo_j='';
	$d_day=dateDiff_1($date_start,$date_end);
					
if($d_day>0)
{	
	//раньше
	$echo_j='(<div class="help-jj">Раньше на '.abs($d_day).' '.PadejNumber(abs($d_day),'день,дня,дней').'</div>)';
} else{
if($d_day==0)
{
    //в срок
	$echo_j='(<div class="help-jj">Точно в срок</div>)';	
}else
{
    //позже просрочка
	$echo_j='(<div class="help-jj red-jj">Просрочка - '.abs($d_day).' '.PadejNumber(abs($d_day),'день,дня,дней').'</div>)';
}
}
$date_elements  = explode(" ",$date_end);
$date_elements1  = explode(":",$date_elements[1]);
$date_elements2  = explode("-",$date_elements[0]);
	
return 	$date_elements2[2].'.'.$date_elements2[1].'.'.$date_elements2[0].' '.$echo_j;
}


function task_st($date_start)
{
	
	
$date_elements  = explode(" ",$date_start);
$date_elements1  = explode(":",$date_elements[1]);
$date_elements2  = explode("-",$date_elements[0]);
	
return 	$date_elements2[2].'.'.$date_elements2[1].'.'.$date_elements2[0].' - '.$date_elements1[0].':'.$date_elements1[1];
}
function task_st1($date_start)
{
	
	
$date_elements  = explode(" ",$date_start);
$date_elements1  = explode(":",$date_elements[1]);
$date_elements2  = explode("-",$date_elements[0]);
	
return 	$date_elements2[2].'.'.$date_elements2[1].'.'.$date_elements2[0].' '.$date_elements1[0].':'.$date_elements1[1];
}

function trips_neo($date_start,$ex = 0)
{
    $echo_j='';
    if($ex==0) {
        $d_day = dateDiff_1(date("Y-m-d") . ' ' . date("H:i:s"), $date_start);
        $endx=$date_start;
    } else
    {
        $date_end=explode(" ",htmlspecialchars(trim($date_start)));
        $date_end1=explode(".",htmlspecialchars(trim($date_end[0])));
        $endx=$date_end1[2].'-'.$date_end1[1].'-'.$date_end1[0].' '.$date_end[1].':00';


        $d_day = dateDiff_1(date("Y-m-d") . ' ' . date("H:i").':00', $endx);
    }

    if(($d_day>0))
    {
        if($d_day==1)
        {
            $echo_j='(<div class="help-jj">Вчера</div>)';
        } else
        {
            if(($d_day==2))
            {
                $echo_j='(<div class="help-jj">Позавчера</div>)';
            }
        }
    } else
    {

        if(abs($d_day)==0)
        {
            $echo_j='(<div class="help-jj red-jj">Сегодня</div>)';
        } else
        {

            if(abs($d_day)==1)
            {
                $echo_j='(<div class="help-jj red-jj">Завтра</div>)';
            } else
            {
                if((abs($d_day)==2))
                {
                    $echo_j='(<div class="help-jj red-jj">Послезавтра</div>)';
                } else
                {
                    if(abs($d_day)<5) {
                        $echo_j = '(<div class="help-jj orange-jj">Через ' . abs($d_day) . ' ' . PadejNumber(abs($d_day), 'день,дня,дней') . '</div>)';
                    }
                }
            }
        }
    }


    $date_elements  = explode(" ",$endx);
    $date_elements1  = explode(":",$date_elements[1]);
    $date_elements2  = explode("-",$date_elements[0]);

    return 	$date_elements2[2].'.'.$date_elements2[1].'.'.$date_elements2[0].' в '.$date_elements1[0].':'.$date_elements1[1].' <span class="oo_date">'.$echo_j.'</span>';
}

function task_neo($date_start)
{
		$echo_j='';
	$d_day=dateDiff_1(date("Y-m-d").' '.date("H:i:s"),$date_start);
			
if(($d_day>0))
{	
	if($d_day==1)
	{
		$echo_j='(<div class="help-jj red-jj">Вчера</div>)';	
	} else
	{	
	    if(($d_day==2))
{	
	$echo_j='(<div class="help-jj red-jj">Позавчера</div>)';	
} else
		{
			$echo_j='(<div class="help-jj red-jj">Просрочка - '.abs($d_day).' '.PadejNumber(abs($d_day),'день,дня,дней').'</div>)';
		}
	}
} else
{
	
	if(abs($d_day)==0)
	{	
		$echo_j='(<div class="help-jj red-jj">Сегодня</div>)';
	} else
	{
	
	if(abs($d_day)==1)
	{
		$echo_j='(<div class="help-jj">Завтра</div>)';	
	} else
	{	
	    if((abs($d_day)==2))
{	
	$echo_j='(<div class="help-jj">Послезавтра</div>)';	
} else
		{
			$echo_j='(<div class="help-jj">Через '.abs($d_day).' '.PadejNumber(abs($d_day),'день,дня,дней').'</div>)';
		}
	}
	}
}
	
	
$date_elements  = explode(" ",$date_start);
$date_elements1  = explode(":",$date_elements[1]);
$date_elements2  = explode("-",$date_elements[0]);
	
return 	$date_elements2[2].'.'.$date_elements2[1].'.'.$date_elements2[0].' в '.$date_elements1[0].':'.$date_elements1[1].' '.$echo_j;
}

function task_neo_plus($date_start)
{
    $echo_j='';
    $d_day=dateDiff_1(date("Y-m-d").' '.date("H:i:s"),$date_start);

    if(($d_day>0))
    {
        if($d_day==1)
        {
            $echo_j='(<div class="help-jj red-jj">Вчера</div>)';
        } else
        {
            if(($d_day==2))
            {
                $echo_j='(<div class="help-jj red-jj">Позавчера</div>)';
            } else
            {
                $echo_j='(<div class="help-jj red-jj">Просрочка - '.abs($d_day).' '.PadejNumber(abs($d_day),'день,дня,дней').'</div>)';
            }
        }
    } else
    {

        if(abs($d_day)==0)
        {
            $echo_j='(<div class="help-jj red-jj">Сегодня</div>)';
        } else
        {

            if(abs($d_day)==1)
            {
                $echo_j='(<div class="help-jj orange-jj">Завтра</div>)';
            } else
            {
                if((abs($d_day)==2))
                {
                    $echo_j='(<div class="help-jj">Послезавтра</div>)';
                } else
                {
                    $echo_j='(<div class="help-jj">Через '.abs($d_day).' '.PadejNumber(abs($d_day),'день,дня,дней').'</div>)';
                }
            }
        }
    }


    $date_elements  = explode(" ",$date_start);
    $date_elements1  = explode(":",$date_elements[1]);
    $date_elements2  = explode("-",$date_elements[0]);

    //echo(date('w',$date_elements[0]));

    return 	$date_elements2[2].'.'.$date_elements2[1].'.'.$date_elements2[0].', '.day_nedeli_x_small($date_elements[0]).' <span class="oo_date">'.$echo_j.'</span>';
}

function task_neo1($date_start,$class)
{
	$echo_j='';
	$d_day=dateDiff_1(date("Y-m-d").' '.date("H:i:s"),$date_start);
	$date_elements  = explode(" ",$date_start);
$date_elements1  = explode(":",$date_elements[1]);
$date_elements2  = explode("-",$date_elements[0]);		
if(($d_day>0))
{	
	if($d_day==1)
	{
		$echo_j='<div class="help-jjx '.$class.'">Вчера</div>';	
	} else
	{	

	    $echo_j='<div class="help-jjx '.$class.'">'.$date_elements2[2].'.'.$date_elements2[1].'.'.$date_elements2[0].'</div>';
		
	}
} else
{
	
	if(abs($d_day)==0)
	{	
		$echo_j='<div class="help-jjx yellow-jjx">Сегодня</div>';
	} else
	{
	
	if(abs($d_day)==1)
	{
		$echo_j='<div class="help-jjx">Завтра</div>';	
	} else
	{	

			$echo_j='<div class="help-jjx">'.$date_elements2[2].'.'.$date_elements2[1].'.'.$date_elements2[0].'</div>';
		
	}
	}
}
	
	
	
return 	$echo_j;
}

function time_task_umatravel1($date_time) 
{ 

//2011-01-19 15:07:31
//->>
	
$date_elements  = explode(" ",$date_time);
$date_elements1  = explode(":",$date_elements[1]);
$date_elements2  = explode("-",$date_elements[0]);


	
   $montw1='';
   switch($date_elements2[1])
   {
   case "01": { $montw1="января";  break; }
   case "02": { $montw1="февраля"; break; }
   case "03": { $montw1="марта"; break; }
   case "04": {  $montw1="апреля"; break; }
   case "05": {  $montw1="мая"; break; }
   case "06": {  $montw1="июня"; break; }
   case "07": {   $montw1="июля"; break; }
   case "08": {  $montw1="августа"; break; }
   case "09": { $montw1="сентября"; break; }
   case "10": {  $montw1="октября"; break; }
   case "11": {  $montw1="ноября"; break; }
   case "12": {   $montw1="декабря"; break; }
   }	
	
	$echo_j='';
	$d_day=dateDiff_1(date("y-m-d").' '.date("H:i:s"),$date_time);
					
if(($d_day<3)and($d_day>0))
{	
	if($d_day==1)
	{
		$echo_j='<div class="help-jj">Вчера</div>';	
	} else
	{	
	    if(($d_day==2))
{	
	$echo_j='<div class="help-jj">Позавчера</div>';	
} else{
			$echo_j='<div class="help-jj">'.$date_elements2[2]." ".$montw1." ".$echo_j." - ".$date_elements1[0].':'.$date_elements1[1].'</div>';
		}
	}
} else
{
	$echo_j='<div class="help-jj">'.$date_elements2[2]." ".$montw1.'</div>';
}
					

/*					
if((($d_day>0))and($row_8["status"]!=2))
{	
	$echo_j='<div class="help-jj">(Просрочка '.abs($d_day).' '.PadejNumber(abs($d_day),'день,дня,дней').')</div>';	
}		
*/	
	
	
      
	  return $echo_j;	


} 

//функция вывода даты для задач уматревал
function time_task_umatravel($date_time) 
{ 

//2011-01-19 15:07:31
//->>
	
$date_elements  = explode(" ",$date_time);
$date_elements1  = explode(":",$date_elements[1]);
$date_elements2  = explode("-",$date_elements[0]);


	
   $montw1='';
   switch($date_elements2[1])
   {
   case "01": { $montw1="января";  break; }
   case "02": { $montw1="февраля"; break; }
   case "03": { $montw1="марта"; break; }
   case "04": {  $montw1="апреля"; break; }
   case "05": {  $montw1="мая"; break; }
   case "06": {  $montw1="июня"; break; }
   case "07": {   $montw1="июля"; break; }
   case "08": {  $montw1="августа"; break; }
   case "09": { $montw1="сентября"; break; }
   case "10": {  $montw1="октября"; break; }
   case "11": {  $montw1="ноября"; break; }
   case "12": {   $montw1="декабря"; break; }
   }	
	
	$echo_j='';
	$d_day=dateDiff_1(date("y-m-d").' '.date("H:i:s"),$date_time);
					
if(($d_day>-3)and($d_day<0))
{	
	if($d_day==-1)
	{
		$echo_j='<div class="help-jj">(Завтра)</div>';	
	} else
	{	
	    //$echo_j='<div class="help-jj">(Через '.abs($d_day).' '.PadejNumber(abs($d_day),'день,дня,дней').')</div>';
		//$echo_j=date_fik1($row_status22task["ring_datetime"]);
	}
}
					
if(($d_day==0))
{	
	$echo_j='<div class="help-jj">(Сегодня)</div>';	
}
/*					
if((($d_day>0))and($row_8["status"]!=2))
{	
	$echo_j='<div class="help-jj">(Просрочка '.abs($d_day).' '.PadejNumber(abs($d_day),'день,дня,дней').')</div>';	
}		
*/	
	
	
      $vremy=$date_elements2[2]." ".$montw1." ".$echo_j." - ".$date_elements1[0].':'.$date_elements1[1];
	  return $vremy;	


} 


//вывод времени и даты вылета
function time_fly($date_time) 
{ 

//2011-01-19 15:07:31
//->>
	
$date_elements  = explode(" ",$date_time);
$date_elements1  = explode(":",$date_elements[1]);
$date_elements2  = explode("-",$date_elements[0]);


	
   $montw1='';
   switch($date_elements2[1])
   {
   case "01": { $montw1="января";  break; }
   case "02": { $montw1="февраля"; break; }
   case "03": { $montw1="марта"; break; }
   case "04": {  $montw1="апреля"; break; }
   case "05": {  $montw1="мая"; break; }
   case "06": {  $montw1="июня"; break; }
   case "07": {   $montw1="июля"; break; }
   case "08": {  $montw1="августа"; break; }
   case "09": { $montw1="сентября"; break; }
   case "10": {  $montw1="октября"; break; }
   case "11": {  $montw1="ноября"; break; }
   case "12": {   $montw1="декабря"; break; }
   }	
	
      $vremy=$date_elements2[2]." ".$montw1." в ".$date_elements1[0].':'.$date_elements1[1];
	  return $vremy;	


} 


/*комментарии*/

/*Смотрим нет ли в тексте ссылок и скриптов*/
function SpamLog($input)
{
  $spam=0;
  $r =array("<a","<?","?>","<\a","<A","<\A","<script","<\script","<SCRIPT");
  for ($i=0; $i<4; $i++)
  {
    if(substr_count(strtolower($input),$r[$i])!=0)
    {
      $spam=1;	 
    }

  }
  return $spam;
}

//проверяет нет ли в тексте слов больше 100 символов, относить такие тексты к спаму
function SpamLine($input)
{
  $spam=0;
  $slova  = explode(" ",$input);
  for ($i=0; $i<count($slova); $i++)
  {
	if(strlen($slova[$i])>100)
    {
      $spam=1;	  
    }

  }

  return $spam;
}
/*  закрытие и открытие тегов в полученной строке*/
function searchtags( $html )
{
    $spam=0;
	preg_match_all ( "#<([/]{0,1}[a-z]+)( .*)?(?!/)>#iU", $html, $result );
    $openedtags = $result[1];
 
	$len_opened = count ( $openedtags );
	if($len_opened!=0)
	{
		$spam=1;
	}
   return $spam;
}

//удаление пробельный символов
function trimc($input)
{
	return str_replace(' ', '', $input);
}


function del_spec_tag($input)
{

// $document на выходе должен содержать HTML-документ. 
// Необходимо удалить все HTML-теги, секции javascript, 
// пробельные символы. Также необходимо заменить некоторые 
// HTML-сущности на их эквивалент. 

$search = array ("'<script[^>]*?>.*?</script>'si",  // Вырезает javaScript 
                 "'<[\/\!]*?[^<>]*?>'si",           // Вырезает HTML-теги 
                 "'([\r\n])[\s]+'",                 // Вырезает пробельные символы 
                 "'&(quot|#34);'i",                 // Заменяет HTML-сущности 
                 "'&(amp|#38);'i", 
                 "'&(lt|#60);'i", 
                 "'&(gt|#62);'i", 
                 "'&(nbsp|#160);'i", 
                 "'&(iexcl|#161);'i", 
                 "'&(cent|#162);'i", 
                 "'&(pound|#163);'i", 
                 "'&(copy|#169);'i", 
                 "'&#(\d+);'e",                    // интерпретировать как php-код 
                 "#\[[/]{0,1}[a-z ]+\]#");                    // интерпретировать как php-код 

$replace = array ("", 
                  "", 
                  "\\1", 
                  "\"", 
                  "&", 
                  "<", 
                  ">", 
                  " ", 
                  chr(161), 
                  chr(162), 
                  chr(163), 
                  chr(169), 
                  "chr(\\1)",
				  ""); 

$input = preg_replace($search, $replace, $input);
return $input;
}

function day_nedeli_x($number)
{

  switch($number)
   {
   case "0": {  $wr="Воскресенье";  break; }
   case "1": {  $wr="Понедельник"; break; }
   case "2": {  $wr="Вторник"; break; }
   case "3": {  $wr="Среда"; break; }
   case "4": {  $wr="Четверг"; break; }
   case "5": {  $wr="Пятница"; break; }
   case "6": {  $wr="Суббота";  break; }
   } 

	return $wr;
	
}

function day_nedeli_x_small($dat2)
{
    $date=explode("-", $dat2);
    $dow = date("w", mktime(0, 0, 0, $date[1], $date[2], $date[0]));

    switch($dow)
    {
        case "0": {  $wr="Вс";  break; }
        case "1": {  $wr="Пн"; break; }
        case "2": {  $wr="Вт"; break; }
        case "3": {  $wr="Ср"; break; }
        case "4": {  $wr="Чт"; break; }
        case "5": {  $wr="Пт"; break; }
        case "6": {  $wr="Сб";  break; }
    }

    return $wr;

}


function NumToIndexPadej($num)
{
 $octatok=$num%10;
	
	
	$ind=2;
	if(($octatok==1)and($num!=11)) { $ind=0;  }
    if(($octatok>1)and($octatok<5)and(($num<11)or($num>14))) {  $ind=1;  }
 return $ind;

}
/*
         1    3    10
$skl='акцию,акции,акций';
 PadejNumber($count_otziv,$skl)
*/
function PadejNumber($Age,$type)
{
  $SKL=explode(',',$type);
  $ind=NumToIndexPadej($Age);
	

  return $SKL[$ind];	
}
//склеить 2 массива
function array_concat() {
	$args = func_get_args();
	foreach ($args as $ak => $av) {
		$args[$ak] = array_values($av);
	}
	return call_user_func_array('array_merge', $args);
}
function br2nl($str)
{
$str = preg_replace("/(\n|\r)/", "", $str);
return preg_replace("//i", "\r\n", $str);
}


//получить иерархию всех подчиненных для пользователя
/*
21 ->
12 -> 1 ->
	        48
36 -> 2 ->
7  ->	

users_hierarchy(21,$link)  [1,48]
users_hierarchy(7,$link)  [2,48]
	*/
function users_hierarchy($id_user,$link)
{
	    $subor = array();

	    global $more_city;
	    global $id_company;

	    $ccom='';
    if(($more_city==1)and(is_numeric($id_company)))
    {
        $ccom= ' and ((b.id_company LIKE "'.ht($id_company).',%")or(b.id_company LIKE "%,'.ht($id_company).',%")or(b.id_company LIKE "%,'.ht($id_company).'")or(b.id_company="'.ht($id_company).'")) ';
    }


		$result_work_zz=mysql_time_query($link,'Select a.id_user_subordinates from r_user_subordinates as a,r_user as b where b.id=a.id_user_subordinates '.$ccom.' and b.enabled=1 and a.id_user="'.$id_user.'"');


        $num_results_work_zz = $result_work_zz->num_rows;
	    if($num_results_work_zz!=0)
	    {
		   for ($i=0; $i<$num_results_work_zz; $i++)
		   {			   			  			   
			   $row_work_zz = mysqli_fetch_assoc($result_work_zz);
			   //добавляем его в подчиненных и смотрим вдруг у него тоже подчиненные
			   array_push($subor,$row_work_zz['id_user_subordinates']);
			   if($row_work_zz['id_user_subordinates']!=$id_user)
			   {
				   //print_r (users_hierarchy($row_work_zz['id_user_subordinates'],$link));
				   $subor=array_merge($subor, (users_hierarchy($row_work_zz['id_user_subordinates'],$link)));
			   }
		   }
		}
		return $subor;
}

//получить иерархию всех подчиненных для пользователя и даже заблокированных
/*
21 ->
12 -> 1 ->
	        48
36 -> 2 ->
7  ->

users_hierarchy(21,$link)  [1,48]
users_hierarchy(7,$link)  [2,48]
	*/
function users_hierarchy_plus_disabled($id_user,$link)
{
    $subor = array();
    $result_work_zz=mysql_time_query($link,'Select a.id_user_subordinates from r_user_subordinates as a,r_user as b where b.id=a.id_user_subordinates and a.id_user="'.$id_user.'"');
    $num_results_work_zz = $result_work_zz->num_rows;
    if($num_results_work_zz!=0)
    {

        for ($i=0; $i<$num_results_work_zz; $i++)
        {
            $row_work_zz = mysqli_fetch_assoc($result_work_zz);
            //добавляем его в подчиненных и смотрим вдруг у него тоже подчиненные
            array_push($subor,$row_work_zz['id_user_subordinates']);
            if($row_work_zz['id_user_subordinates']!=$id_user)
            {
                //echo("!");
                //print_r (users_hierarchy($row_work_zz['id_user_subordinates'],$link));
                $subor=array_merge($subor, (users_hierarchy_plus_disabled($row_work_zz['id_user_subordinates'],$link)));
            }
        }
    }
    return $subor;
}


//узнаем всех начальников пользователя по id
/*
21 ->
12 -> 1 ->
	        48
36 -> 2 ->
7  ->	

all_chief(2,$link)  [36,7]
*/	
function all_chief($id_user,$link)
{
	    $subor = array();
		$result_work_zz=mysql_time_query($link,'Select a.id_user from r_user_subordinates as a where a.id_user_subordinates="'.$id_user.'"');				 
        $num_results_work_zz = $result_work_zz->num_rows;
	    if($num_results_work_zz!=0)
	    {

		   for ($i=0; $i<$num_results_work_zz; $i++)
		   {			   			  			   
			   $row_work_zz = mysqli_fetch_assoc($result_work_zz);
			   //добавляем его в подчиненных и смотрим вдруг у него тоже подчиненные
			   array_push($subor,$row_work_zz['id_user']);
			   
			   $subor=array_merge($subor, (all_chief($row_work_zz['id_user'],$link)));
		   }
		}
		return $subor;
}


//получить иерархию подчиненных для пользователя
function all_manager($id_company,$link)
{


    $LIKE='';
    if(is_numeric($id_company))
    {
        $LIKE=' and ((a.id_company LIKE "'.ht($id_company).',%")or(a.id_company LIKE "%,'.ht($id_company).',%")or(a.id_company LIKE "%,'.ht($id_company).'")or(a.id_company="'.ht($id_company).'")) ';
    } else
    {
        $date_new_ada = explode(",", ht($id_company));
        for ($ada = 0; $ada < count($date_new_ada); $ada++) {

            if($LIKE=='')
            {
                $LIKE=' and ( ((a.id_company LIKE "'.ht($date_new_ada[$ada]).',%")or(a.id_company LIKE "%,'.ht($date_new_ada[$ada]).',%")or(a.id_company LIKE "%,'.ht($date_new_ada[$ada]).'")or(a.id_company="'.ht($date_new_ada[$ada]).'")) ';
            } else
            {
                $LIKE.='or ((a.id_company LIKE "'.ht($date_new_ada[$ada]).',%")or(a.id_company LIKE "%,'.ht($date_new_ada[$ada]).',%")or(a.id_company LIKE "%,'.ht($date_new_ada[$ada]).'")or(a.id_company="'.ht($date_new_ada[$ada]).'")) ';
            }

        }
        if($LIKE!='')
        {
            $LIKE.=') ';
        }


    }


	    $subor = array();
		$result_work_zz=mysql_time_query($link,'Select a.id from r_user as a where a.id_role IN ("2", "3") '.$LIKE);
        $num_results_work_zz = $result_work_zz->num_rows;
	    if($num_results_work_zz!=0)
	    {

		   for ($i=0; $i<$num_results_work_zz; $i++)
		   {			   			  			   
			   $row_work_zz = mysqli_fetch_assoc($result_work_zz);
			   //добавляем его в подчиненных и смотрим вдруг у него тоже подчиненные
			   array_push($subor,$row_work_zz['id']);
		   }
		}
		return $subor;
}


//получение владельца компании по id компании
function adminOC($link,$id_company)
{
 $mass_a=array();
   $result_authority=mysql_time_query($link,'select C.id_user from r_user_company as C where C.id="'.htmlspecialchars(trim($id_company)).'"');
   $num_results_authority = $result_authority->num_rows; 
   
   if($num_results_authority<>0)
   {
	  while($row_8 = mysqli_fetch_assoc($result_authority)){ 
		  array_push($mass_a,$row_8["id_user"]);
	  }
	   
	   
   }
	return $mass_a;
}

//получение массива всех администраторов компании по id компании
function adminAC($link,$id_company)
{
 $mass_a=array();


    $LIKE='';
    if(is_numeric($id_company))
    {
        $LIKE=' and ((C.id_company LIKE "'.ht($id_company).',%")or(C.id_company LIKE "%,'.ht($id_company).',%")or(C.id_company LIKE "%,'.ht($id_company).'")or(C.id_company="'.ht($id_company).'")) ';
    } else
    {
        $date_new_ada = explode(",", ht($id_company));
        for ($ada = 0; $ada < count($date_new_ada); $ada++) {

            if($LIKE=='')
            {
                $LIKE=' and ( ((C.id_company LIKE "'.ht($date_new_ada[$ada]).',%")or(C.id_company LIKE "%,'.ht($date_new_ada[$ada]).',%")or(C.id_company LIKE "%,'.ht($date_new_ada[$ada]).'")or(C.id_company="'.ht($date_new_ada[$ada]).'")) ';
            } else
            {
                $LIKE.='or ((C.id_company LIKE "'.ht($date_new_ada[$ada]).',%")or(C.id_company LIKE "%,'.ht($date_new_ada[$ada]).',%")or(C.id_company LIKE "%,'.ht($date_new_ada[$ada]).'")or(C.id_company="'.ht($date_new_ada[$ada]).'")) ';
            }

        }
        if($LIKE!='')
        {
            $LIKE.=') ';
        }


    }




   $result_authority=mysql_time_query($link,'select C.id from r_user as C,r_role as D where D.id=C.id_role and D.role="admin_company" '.$LIKE);
   $num_results_authority = $result_authority->num_rows; 
   
   if($num_results_authority<>0)
   {
	  while($row_8 = mysqli_fetch_assoc($result_authority)){ 
		  array_push($mass_a,$row_8["id"]);
	  }
	   
	   
   }
	return $mass_a;
}

//получение массива всех главных администраторов системы в целом
function adminAS($link)
{
 $mass_a=array();
   $result_authority=mysql_time_query($link,'select C.id from r_user as C,r_role as D where D.id=C.id_role and D.admin="1"');
   $num_results_authority = $result_authority->num_rows; 
   
   if($num_results_authority<>0)
   {
	  while($row_8 = mysqli_fetch_assoc($result_authority)){ 
		  array_push($mass_a,$row_8["id"]);
	  }
	   
	   
   }
	return $mass_a;
}

//узнаем управляющий ли он или может главный админ всей системы
// 1 - управляющий
// 2 - админ всей системы
// 3 - администратор компании
function companyA($link,$id_user)
{
	$sysu=0;
	
   $result_authority=mysql_time_query($link,'select C.id_company,D.system,D.admin,D.role from r_user as C,r_role as D where D.id=C.id_role and C.id="'.htmlspecialchars(trim($id_user)).'"');
   $num_results_authority = $result_authority->num_rows; 
   
   if($num_results_authority<>0)
   {
	   $row_authority = mysqli_fetch_assoc($result_authority);
	   if(($row_authority["id_company"]==0)and($row_authority["system"]==1)and($row_authority["admin"]==0))
	   {
		   $sysu=1;
	   }
	   if(($row_authority["id_company"]==0)and($row_authority["system"]==1)and($row_authority["admin"]==1))
	   {
		   $sysu=2;
	   }
	   	   if($row_authority["role"]=='admin_company')
	   {
		   $sysu=3;
	   }
   }
	return $sysu;
}

//получение пользователей управления которые должны получить уведомление по номеру уведомления но в определенной компании
function UserNotNumberCompany($number,$id_company,$link)
{

    $LIKE='';
    if(is_numeric($id_company))
    {
        $LIKE=' and ((C.id_company LIKE "'.ht($id_company).',%")or(C.id_company LIKE "%,'.ht($id_company).',%")or(C.id_company LIKE "%,'.ht($id_company).'")or(C.id_company="'.ht($id_company).'")) ';
    } else
    {
        $date_new_ada = explode(",", ht($id_company));
        for ($ada = 0; $ada < count($date_new_ada); $ada++) {

            if($LIKE=='')
            {
                $LIKE=' and ( ((C.id_company LIKE "'.ht($date_new_ada[$ada]).',%")or(C.id_company LIKE "%,'.ht($date_new_ada[$ada]).',%")or(C.id_company LIKE "%,'.ht($date_new_ada[$ada]).'")or(C.id_company="'.ht($date_new_ada[$ada]).'")) ';
            } else
            {
                $LIKE.='or ((C.id_company LIKE "'.ht($date_new_ada[$ada]).',%")or(C.id_company LIKE "%,'.ht($date_new_ada[$ada]).',%")or(C.id_company LIKE "%,'.ht($date_new_ada[$ada]).'")or(C.id_company="'.ht($date_new_ada[$ada]).'")) ';
            }

        }
        if($LIKE!='')
        {
            $LIKE.=') ';
        }


    }



    $mass_a=array();
    $result_authority=mysql_time_query($link,'SELECT C.id FROM a_notification_user_option AS A,a_notification_type_role AS B,r_user AS C WHERE A.number_type="'.ht($number).'" AND A.val=1 AND C.id=A.id_user AND C.id_role=B.id_role AND B.number_type="'.ht($number).'" AND B.val=1 '.$LIKE);
    $num_results_authority = $result_authority->num_rows;

    if($num_results_authority<>0)
    {
        while($row_8 = mysqli_fetch_assoc($result_authority)){
            array_push($mass_a,$row_8["id"]);
        }


    }
    return $mass_a;
}


//получение пользователей управления которые должны получить уведомление по номеру уведомления
function UserNotNumber($number,$link)
{
    $mass_a=array();
    $result_authority=mysql_time_query($link,'SELECT C.id FROM a_notification_user_option AS A,a_notification_type_role AS B,r_user AS C WHERE A.number_type="'.ht($number).'" AND A.val=1 AND C.id=A.id_user AND C.id_role=B.id_role AND B.number_type="'.ht($number).'" AND B.val=1');
    $num_results_authority = $result_authority->num_rows;

    if($num_results_authority<>0)
    {
        while($row_8 = mysqli_fetch_assoc($result_authority)){
            array_push($mass_a,$row_8["id"]);
        }


    }
    return $mass_a;
}

//получение пользователя с определенным id если у него включено это уведомление
function UserNotNumberUsers($number,$id,$link)
{
    $mass_a=array();
    $result_authority=mysql_time_query($link,'SELECT C.id FROM a_notification_user_option AS A,a_notification_type_role AS B,r_user AS C WHERE C.id="'.ht($id).'" and A.number_type="'.ht($number).'" AND A.val=1 AND C.id=A.id_user AND C.id_role=B.id_role AND B.number_type="'.ht($number).'" AND B.val=1');

    $num_results_authority = $result_authority->num_rows;

    if($num_results_authority<>0)
    {
        while($row_8 = mysqli_fetch_assoc($result_authority)){
            array_push($mass_a,$row_8["id"]);
        }


    }
    return $mass_a;
}

//отправка уведомлений администраторам системных с приоритетом
function notification_send_admin($text,$mass,$id_user,$link)
{
    $today[0] = date("y.m.d"); //присвоено 03.12.01
    $today[1] = date("H:i:s"); //присвоит 1 элементу массива 17:16:17
    $date_=$today[0].' '.$today[1];

    foreach ($mass as $keys => $value)
    {


        mysql_time_query($link,'INSERT INTO r_notification (id_user,notification,sign_user,datetime,priority ) VALUES ("'.$value.'","'.htmlspecialchars(trim($text)).'","'.$id_user.'","'.$date_.'","1")');

        $noti_key=new_key_admin($link,10);
        mysql_time_query($link,'update r_user set noti_key="'.$noti_key.'" where id = "'.htmlspecialchars(trim($value)).'"');
    }
}




//получение нового ключа для уведомлений администраторам
function new_key_admin($link,$len, $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789')
{
    do {
        $string = '';

        for ($i = 0; $i < $len; $i++)
        {
            $pos = rand(0, strlen($chars)-1);
            $string .= $chars[$pos];
        }

        $results1222=mysql_time_query($link,'select count(id) as r from r_user where noti_key="'.$string.'"');
        $row1222 = mysqli_fetch_assoc($results1222);


    } while($row1222["r"]!=0);

    return $string;

}


?>