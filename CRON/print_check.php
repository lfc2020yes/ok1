<? //include $url_system.'php/seo/seo.php';
session_start();
$url_system='../../';
setlocale(LC_CTYPE, array('ru_RU.CP1251', "ru_RU","ru","rus_RUS"));
//проверить является ли он владельцем акции
//если нет послать его в раздел купоны
//если он то вывесте его акцию название и список купленных пользователей

include $url_system.'module/config.php';
  function time_stamp($date_time) 
{ 

//2011-01-19 15:07:31

$date_elements  = explode(" ",$date_time);
$date_elements1  = explode(":",$date_elements[1]);
$date_elements2  = explode("-",$date_elements[0]);


$session_time=mktime($date_elements1[0], $date_elements1[1], $date_elements1[2], $date_elements2[1], $date_elements2[2], $date_elements2[0]);
$time_difference = time() - $session_time; 
$minutes = round($time_difference / 60 );
//Minutes
$vremy='';

/*
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
*/



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
	
	 $chislo=$date_elements2[2];
	 if($chislo<10)
	 {
	 	 $chislo=$date_elements2[2][1];
	 }
	
      $vremy=$chislo." ".$montw1." ".$date_elements2[0]." г.";
	  return $vremy;	


} 

  function minut_stamp($date_time) 
{ 

//2011-01-19 15:07:31

$date_elements  = explode(" ",$date_time);
$date_elements1  = explode(":",$date_elements[1]);
$date_elements2  = explode("-",$date_elements[0]);

	
      $vremy=$date_elements1[0].":".$date_elements1[1];
	  return $vremy;	


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


function NumToIndex4($num)
{
 $octatok1=$num%100; 
 if((($num>=11)and($num<=14))or(($octatok1>=11)and($octatok1<=14))) { $ind=2; } else
 {
	
   $octatok=$num%10;
   if($octatok==0) { $ind=2; } else
   {
	  if($octatok==1) { $ind=0; } else
	  { 
   if ($octatok>4) $ind=2; else $ind=1; 
	  }
   }
 }
 return $ind;
}


function PadejToStr4($Age,$type)
{
  $SKL=explode(',',$type);
  $ind=NumToIndex4($Age);
	



  return $SKL[$ind];	
  
}
if((isset($_SESSION['user_name']))and((isset($_SESSION['user_id']))))
{  
    $id_user_view=htmlspecialchars(trim($_SESSION['user_id']));

    $results_user=mysql_time_query('SELECT A.*,B.lastname,B.firstname from orders as A,users as B where A.id_user=B.id  AND A.id="'.htmlspecialchars(trim($_GET['id'])).'"');
	
	 
  $num_results_user = mysql_num_rows($results_user);		  
  if($num_results_user==0)
  {
	  //это не его купон или вообще такого нет
	   header("Location: http://www.metall73.ru/profile/admin.php?m1=zakaz");
  } else
  {
	  $row = mysql_fetch_array($results_user);
  }
  
   } else
   {
	    header("Location: http://www.metall73.ru/login/?to=2&s=".base64_encode("http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']));
   }
$region_arr=array();

  $result=mysql_time_query('select * from city where visible=1');
  //echo'select * from city where id="'.$region.'"';
  $num_results = mysql_num_rows($result);
	     for($i_url=1; $i_url<= $num_results; $i_url++)
         {	  
		 
            $row_aaa = mysql_fetch_array($result);															
$region_arr[$row_aaa["id"]]= strtolower($row_aaa["city"]);
		 }
?>
<head>

<meta content="text/html; charset=windows-1251" http-equiv="Content-Type">
<script language="javascript" type="text/javascript" src="/Js/new/jquery-1.3.min.js"></script>
<?
  if($num_results_user==0)
  {
echo'<title>Страница не найдена</title>';	  
  } else
  {
echo'<title>Товарный Чек №'.$row["id"].'</title>';
  }
?>
<base href="http://www.metall73.ru/" >

<style>
            body {
                font-family: arial, helvetica, sans-serif;
                font-size: 12px;
            }

            td {
                vertical-align: top;
            }

            .check {
                margin: 20px;
                border: 1px solid black;
                padding: 20px;
				width:19.5cm;
				height:25cm;
				
            }

            .kuponLogo {
                font-size: 60px;
                font-weight: bold;
                float: left
            }
            .kuponLogo span {
                font-size: 30px;
            }

            .kuponNumb {
                float: right;
                font-size: 20px;
                font-weight: bold;
                padding-top: 10px;
            }

            .clear {
                clear: both;
            }

            h2,h4 {
                padding: 0;
                margin: 0;
            }

            .kuponCont {
                border-top: 1px dashed black;
            }

            ul {
                list-style: square;
                margin: 0;
                padding: 0;
                padding: 10px 20px;
                font-size: 12px;
            }


.pokup_kup  td{ padding-top:5px; padding-bottom:5px;}

.even {
    background: none repeat scroll 0 0 #f2f5f7;
}

.table_check td { padding:3px;}

table.table_check tbody tr td
{
	border-right:1px solid #000; 	
}

table.table_check tbody tr td.rigths
{
	border-right:0px;
}


table.table_check tbody tr td.ty {
  border-top:1px solid #000; /* четные строки */
  /* border-bottom:... нижняя граница...если нужна*/
}
table.table_check tbody tr.odd td.ty {
  border-top: 1px solid #000; /* аналогично нечетные строки */
}

.line_red { border-bottom:1px solid #ff4800; }
            p {
                margin: 5px 0;
            }
            /*
            img {
                margin-top: -150px;
            }
			*/
      
.hh { font-size:18px; margin-bottom:10px; border-bottom:2px solid #000; width:100%; font-weight:bold;}	  
.input_print { border:1px solid #ffd800;}	        
        </style>

<link rel="stylesheet" type="text/css" media="print" href="style/print.css" />


<script type="text/javascript" src="/Ajax/lib/JsHttpRequest/JsHttpRequest.js"></script>
<script language="javascript" type="text/javascript" src="/js/mosse_ajax.js"></script>
<script language="javascript" type="text/javascript" src="/js/jquery-latest.min.js"></script>

</head>
<body>
<div id="debug"></div>

<?

 $sql3='SELECT A.check from orders as A where A.id="'.htmlspecialchars(trim($_GET['id'])).'"';
 $result3=mysql_time_query($sql3); 
 $row3 = mysql_fetch_array($result3);
 



echo' <div class="no_print" style=" width:19.5cm; margin-left:20px;">';
 
if($row3["check"]!='')          
{
 echo'<span id="flag_ch" class="no_print" style="background-color:#e10624; border-bottom:1px solid #c20721; padding-left:4px; padding-right:4px; padding-bottom:0px; color:#fff; font-size:9px; margin-right:5px;">Не соответствует заказу</span> <br><br>';
} else
{
 echo'<span id="flag_ch" class="no_print" style=" display:none; background-color:#e10624; border-bottom:1px solid #c20721; padding-left:4px; padding-right:4px; padding-bottom:0px; color:#fff; font-size:9px; margin-right:5px;">Не соответствует заказу</span> <br><br>';
	
}
          
 echo'        <span onclick="LoadCheck('.htmlspecialchars(trim($_GET['id'])).');" class="no_print" style="cursor:pointer; background-color:#ffd800; padding:5px;">Пересчитать</span>          
</div>';

  if($row3["check"]!='')          
  {
	  echo'<div class="check" >'.$row3["check"].'</div>';
	  
	echo'<div id="template" style="display:none;">'.$row3["check"].'</div>'; 
	?>
	<script type="text/javascript">
$(document).ready(function(){

 var template=$("#template").html();
 template=template.replace(/ccxx/g,"xxjj");
	$("#template").html(template);
})
   
</script>
<?	
	 
  } else
  {
?>		

		  <div class="check" >
          
       
          
  <?
$i_input=1;
$tt_da='';



  echo'<div>Поставщик: ООО "ПОВОЛЖСКИЙ МЕТАЛЛОЦЕНТР", ИНН 7325166273 </div><br>';
  $tt_da.='<div>Поставщик: ООО "ПОВОЛЖСКИЙ МЕТАЛЛОЦЕНТР", ИНН 7325166273 </div><br>';




  
  echo'<div style="float:right; font-size: 18px; font-weight: bold; margin-bottom: 10px;">'.minut_stamp($row["date_time"]).'</div><div class="hh">Товарный чек №'.htmlspecialchars(trim($_GET['id']-7123)).' от ';
  $tt_da.='<div style="float:right; font-size: 18px; font-weight: bold; margin-bottom: 10px;">'.minut_stamp($row["date_time"]).'</div><div class="hh">Товарный чек №'.htmlspecialchars(trim($_GET['id']-7123)).' от ';
  
  
  echo'<span><input id="checcxxk_'.$i_input.'" style="font-family: arial; font-size:18px; font-weight:bold;" class="input_print" type="text" onblur="input_check(this,'.$i_input.','.htmlspecialchars(trim($_GET['id'])).');" onkeyup="input_check(this,'.$i_input.','.htmlspecialchars(trim($_GET['id'])).');" value="'.time_stamp($row["date_time"]).'"></span>'; 
  $tt_da.='<span><input id="chexxjjk_'.$i_input.'" style="font-family: arial; font-size:18px; font-weight:bold;" class="input_print" type="text" onblur="input_check(this,'.$i_input.','.htmlspecialchars(trim($_GET['id'])).');" onkeyup="input_check(this,'.$i_input.','.htmlspecialchars(trim($_GET['id'])).');" value="'.time_stamp($row["date_time"]).'"></span>'; 
  
  $i_input=$i_input+1;
  
  echo'</div><div style="float:left; font-size: 12px; margin-bottom: 10px;">Артикул заказа #'.htmlspecialchars(trim($_GET['id'])).'</div><div style="text-align:right; width:100%;"><strong>Урицкого, 33</strong></div><br><br>';  
  $tt_da.='</div><div style="float:left; font-size: 12px; margin-bottom: 10px;">Артикул заказа #'.htmlspecialchars(trim($_GET['id'])).'</div><div style="text-align:right; width:100%;"><strong>Урицкого, 33</strong></div><br><br>'; 

	   

echo'<table class="table_check"  width="100%" style=" border:2px solid #000; border-color:#000;  color: #000; font-size:12px; font-family:arial;" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center"><b>№</b></td>
    <td align="center"><b>Наименование</b></td>	
    <td align="center" colspan="2"><b>Количество</b></td>
    <td align="center"><b>Цена</b></td>
    <td align="center" class="rigths"><b>Сумма</b></td>
  </tr>';
$tt_da.= '<table class="table_check"  width="100%" style=" border:2px solid #000; border-color:#000;  color: #000; font-size:12px; font-family:arial;" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center"><b>№</b></td>
    <td align="center"><b>Наименование</b></td>	
    <td align="center" colspan="2"><b>Количество</b></td>
    <td align="center"><b>Цена</b></td>
    <td align="center" class="rigths"><b>Сумма</b></td>
  </tr>'; 
  
 
 $sql2='SELECT A.*,B.name,C.name as names from order_goods as A, goods as B, unit as C where A.id_goods=B.id AND A.id_unit=C.id AND A.id_order="'.htmlspecialchars(trim($_GET['id'])).'" order by  A.sum';	

//echo($sql);


   $result2=mysql_time_query($sql2);
   $num_results2 = mysql_num_rows($result2);
 
    for ($j=0; $j<$num_results2; $j++)
    {
  	   	   
	    $row2 = mysql_fetch_array($result2); 
		
		

 	$results_god=mysql_time_query('select * from goods where id="'.$row2["id_goods"].'"');
    $row_goods = mysql_fetch_array($results_god);
	

 	$results_currency=mysql_time_query('select value from unit where id="'.$row2["id_unit"].'"');
    $row_currency = mysql_fetch_array($results_currency);	


	$cena=0;		 
						 
  switch($row_currency["value"])
    {
   case "t": $cena=$row_goods["costt"]; break;
   
   case "th": { 		
   
  switch($row_goods["id_function"])
  {
	 case "4":   $cena=$row_goods["cost"];  break; 

	 case "2": $cena=$row_goods["cost"]; break; 
	 case "3": $cena=$row_goods["cost"]; break;	 
	 case "6": $cena=(($row_goods["cost"]*$row_goods["length"])/1000); break;
	 case "8": $cena=$row_goods["cost"]; break; 	
	 
	 	 case "9": $cena=($row_goods["cost"]*$row_goods["length"]); break; 	 
	 
	 default: $cena=(($row_goods["cost"]*$row_goods["length"])/1000);
  }
		
		 break;
		}
   
   case "m2": $cena=((1000000*$row_goods["cost"])/($row_goods["length"]*$row_goods["width"])); break;
   case "m22":  $cena=(($row_goods["cost"]*1000000)/($row_goods["length"]*$row_goods["width"])); break;
   case "m":  $cena=$row_goods["cost"]; break;
   
      case "kg":{ 		
   
  switch($row_goods["id_function"])
  {
	 case "9": $cena=($row_goods["cost"]); break;
     case "10": $cena=(((1/$row_goods["gravity"])*$row_goods["cost"])); break;
  } break;
		 }
   
   case "m3": $cena=$row_goods["costt"]; break;
  }

		
		
echo'<tr><td class="ty" width="3%" align="center">'.($j+1).'</td><td class="ty" width="50%" align="left"><span><input id="checcxxk_'.$i_input.'" style="font-family: arial; font-size:12px; width:100%; text-align:left;" class="input_print" type="text" onblur="input_check(this,'.$i_input.','.htmlspecialchars(trim($_GET['id'])).');" onkeyup="input_check(this,'.$i_input.','.htmlspecialchars(trim($_GET['id'])).');" value="'.$row2["name"].'"></span>';
$tt_da.='<tr><td class="ty" width="3%" align="center">'.($j+1).'</td><td class="ty" width="50%" align="left"><span><input id="chexxjjk_'.$i_input.'" style="font-family: arial; font-size:12px; width:100%; text-align:left;" class="input_print" type="text" onblur="input_check(this,'.$i_input.','.htmlspecialchars(trim($_GET['id'])).');" onkeyup="input_check(this,'.$i_input.','.htmlspecialchars(trim($_GET['id'])).');" value="'.$row2["name"].'"></span>';
	
	$i_input=$i_input+1;
	
	echo'</td><td class="ty" width="12%" align="right"><span><input id="checcxxk_'.$i_input.'" style="font-family: arial; font-size:12px; width:100%; text-align:right;" class="input_print" type="text" onblur="input_check(this,'.$i_input.','.htmlspecialchars(trim($_GET['id'])).');" onkeyup="input_check(this,'.$i_input.','.htmlspecialchars(trim($_GET['id'])).');" value="'.$row2["count"].'"></span>';
$tt_da.='</td><td class="ty" width="12%" align="right"><span><input id="chexxjjk_'.$i_input.'" style="font-family: arial; font-size:12px; width:100%; text-align:right;" class="input_print" type="text" onblur="input_check(this,'.$i_input.','.htmlspecialchars(trim($_GET['id'])).');" onkeyup="input_check(this,'.$i_input.','.htmlspecialchars(trim($_GET['id'])).');" value="'.$row2["count"].'"></span>';	
	
	$i_input=$i_input+1;
	
	echo'</td>
	<td class="ty" width="5%" align="left">
	
	<span><input id="checcxxk_'.$i_input.'" style="font-family: arial; font-size:12px; width:100%; text-align:left;" class="input_print" type="text" onblur="input_check(this,'.$i_input.','.htmlspecialchars(trim($_GET['id'])).');" onkeyup="input_check(this,'.$i_input.','.htmlspecialchars(trim($_GET['id'])).');" value="'.$row2["names"].'"></span>';
	
$tt_da.='</td>
	<td class="ty" width="5%" align="left">
	
	<span><input id="chexxjjk_'.$i_input.'" style="font-family: arial; font-size:12px; width:100%; text-align:left;" class="input_print" type="text" onblur="input_check(this,'.$i_input.','.htmlspecialchars(trim($_GET['id'])).');" onkeyup="input_check(this,'.$i_input.','.htmlspecialchars(trim($_GET['id'])).');" value="'.$row2["names"].'"></span>';	
	
	$i_input=$i_input+1;
	
	
	echo'</td>	
	<td class="ty" width="15%" align="right">
	
	<span><input id="checcxxk_'.$i_input.'" style="font-family: arial; font-size:12px; width:100%; text-align:right;" class="input_print" type="text" onblur="input_check(this,'.$i_input.','.htmlspecialchars(trim($_GET['id'])).');" onkeyup="input_check(this,'.$i_input.','.htmlspecialchars(trim($_GET['id'])).');" value="'.number_format($cena, 2, ',', ' ').'"></span>';
	
$tt_da.='</td>	
	<td class="ty" width="15%" align="right">
	
	<span><input id="chexxjjk_'.$i_input.'" style="font-family: arial; font-size:12px; width:100%; text-align:right;" class="input_print" type="text" onblur="input_check(this,'.$i_input.','.htmlspecialchars(trim($_GET['id'])).');" onkeyup="input_check(this,'.$i_input.','.htmlspecialchars(trim($_GET['id'])).');" value="'.number_format($cena, 2, ',', ' ').'"></span>';	
	
	$i_input=$i_input+1;
	
	
	echo'</td>
	<td class="ty rigths" width="100px" align="right"><div style="width:100px">
	
	<span><input id="checcxxk_'.$i_input.'" style="font-family: arial; font-size:12px; width:100%; text-align:right;" class="input_print" type="text" onblur="input_check(this,'.$i_input.','.htmlspecialchars(trim($_GET['id'])).');" onkeyup="input_check(this,'.$i_input.','.htmlspecialchars(trim($_GET['id'])).');" value="'.number_format($row2["sum"], 2, ',', ' ').'"></span></div>';

$tt_da.='</td>
	<td class="ty rigths" width="100px" align="right"><div style="width:100px">
	
	<span><input id="chexxjjk_'.$i_input.'" style="font-family: arial; font-size:12px; width:100%; text-align:right;" class="input_print" type="text" onblur="input_check(this,'.$i_input.','.htmlspecialchars(trim($_GET['id'])).');" onkeyup="input_check(this,'.$i_input.','.htmlspecialchars(trim($_GET['id'])).');" value="'.number_format($row2["sum"], 2, ',', ' ').'"></span></div>';
	
	$i_input=$i_input+1;
	
	
	echo'</td></tr>';	
	
$tt_da.='</td></tr>';			
		
    }

$obshay_summa=$row["sum"];

//доставка
if($row["delivery_cost"]!=0)
{
	$obshay_summa=$obshay_summa+$row["delivery_cost"];
		$j=$j+1;
echo'<tr style="background: none repeat scroll 0 0 #f1ffe8;"><td class="ty" width="3%" align="center">'.$j.'</td><td class="ty" width="50%" align="left">
	
	<span><input id="checcxxk_'.$i_input.'" style=" background:none; font-family: arial;  font-size:12px; width:100%; text-align:left;" class="input_print" type="text" onblur="input_check(this,'.$i_input.','.htmlspecialchars(trim($_GET['id'])).');" onkeyup="input_check(this,'.$i_input.','.htmlspecialchars(trim($_GET['id'])).');" value="Доставка"></span>';
	
$tt_da.='<tr style="background: none repeat scroll 0 0 #f1ffe8;"><td class="ty" width="3%" align="center">'.$j.'</td><td class="ty" width="50%" align="left">
	
	<span><input id="chexxjjk_'.$i_input.'" style=" background:none; font-family: arial;  font-size:12px; width:100%; text-align:left;" class="input_print" type="text" onblur="input_check(this,'.$i_input.','.htmlspecialchars(trim($_GET['id'])).');" onkeyup="input_check(this,'.$i_input.','.htmlspecialchars(trim($_GET['id'])).');" value="Доставка"></span>';	
	
	$i_input=$i_input+1;
	
	echo'</td>
	<td class="ty" width="12%" align="right">
	
	<span><input id="checcxxk_'.$i_input.'" style="background:none; font-family: arial; font-size:12px; width:100%; text-align:right;" class="input_print" type="text" onblur="input_check(this,'.$i_input.','.htmlspecialchars(trim($_GET['id'])).');" onkeyup="input_check(this,'.$i_input.','.htmlspecialchars(trim($_GET['id'])).');" value="1"></span>';
	
$tt_da.='</td>
	<td class="ty" width="12%" align="right">
	
	<span><input id="chexxjjk_'.$i_input.'" style="background:none; font-family: arial; font-size:12px; width:100%; text-align:right;" class="input_print" type="text" onblur="input_check(this,'.$i_input.','.htmlspecialchars(trim($_GET['id'])).');" onkeyup="input_check(this,'.$i_input.','.htmlspecialchars(trim($_GET['id'])).');" value="1"></span>';
	
	$i_input=$i_input+1;
	
	echo'</td>
	<td class="ty" width="5%" align="left">
	
	<span><input id="checcxxk_'.$i_input.'" style="background:none; font-family: arial; font-size:12px; width:100%; text-align:left;" class="input_print" type="text" onblur="input_check(this,'.$i_input.','.htmlspecialchars(trim($_GET['id'])).');" onkeyup="input_check(this,'.$i_input.','.htmlspecialchars(trim($_GET['id'])).');" value="-"></span>';
	
$tt_da.='</td>
	<td class="ty" width="5%" align="left">
	
	<span><input id="chexxjjk_'.$i_input.'" style="background:none; font-family: arial; font-size:12px; width:100%; text-align:left;" class="input_print" type="text" onblur="input_check(this,'.$i_input.','.htmlspecialchars(trim($_GET['id'])).');" onkeyup="input_check(this,'.$i_input.','.htmlspecialchars(trim($_GET['id'])).');" value="-"></span>';	
	
	$i_input=$i_input+1;
	
	echo'</td>
	
	<td class="ty" width="15%" align="right">
	
	<span><input id="checcxxk_'.$i_input.'" style="background:none; font-family: arial; font-size:12px; width:100%; text-align:right;" class="input_print" type="text" onblur="input_check(this,'.$i_input.','.htmlspecialchars(trim($_GET['id'])).');" onkeyup="input_check(this,'.$i_input.','.htmlspecialchars(trim($_GET['id'])).');" value="'.number_format($row["delivery_cost"], 2, ',', ' ').'"></span>';

$tt_da.='</td>
	
	<td class="ty" width="15%" align="right">
	
	<span><input id="chexxjjk_'.$i_input.'" style="background:none; font-family: arial; font-size:12px; width:100%; text-align:right;" class="input_print" type="text" onblur="input_check(this,'.$i_input.','.htmlspecialchars(trim($_GET['id'])).');" onkeyup="input_check(this,'.$i_input.','.htmlspecialchars(trim($_GET['id'])).');" value="'.number_format($row["delivery_cost"], 2, ',', ' ').'"></span>';
	
	$i_input=$i_input+1;
	
	echo'</td>
	<td class="ty rigths" width="100px" style=" width:100px;" align="right"><div style="width:100px">
	
	<span><input id="checcxxk_'.$i_input.'" style="background:none; font-family: arial; font-size:12px; width:100%; text-align:right;" class="input_print" type="text" onblur="input_check(this,'.$i_input.','.htmlspecialchars(trim($_GET['id'])).');" onkeyup="input_check(this,'.$i_input.','.htmlspecialchars(trim($_GET['id'])).');" value="'.number_format($row["delivery_cost"], 2, ',', ' ').'"></span>';

$tt_da.='</td>
	<td class="ty rigths" width="100px" style=" width:100px;" align="right"><div style="width:100px">
	
	<span><input id="chexxjjk_'.$i_input.'" style="background:none; font-family: arial; font-size:12px; width:100%; text-align:right;" class="input_print" type="text" onblur="input_check(this,'.$i_input.','.htmlspecialchars(trim($_GET['id'])).');" onkeyup="input_check(this,'.$i_input.','.htmlspecialchars(trim($_GET['id'])).');" value="'.number_format($row["delivery_cost"], 2, ',', ' ').'"></span>';
	
	$i_input=$i_input+1;
	
	echo'</div></td></tr>';		

$tt_da.='</div></td></tr>';			
	
}

if($row["cutting"]!=0)
{
	$obshay_summa=$obshay_summa+$row["cutting"];
	$j=$j+1;
echo'  <tr style="background: none repeat scroll 0 0 #e8f8ff;"><td class="ty" width="3%" align="center">'.$j.'</td>
    <td class="ty" width="50%" align="left">
	
	<span><input id="checcxxk_'.$i_input.'" style="background:none; font-family: arial; font-size:12px; width:100%; text-align:left;" class="input_print" type="text" onblur="input_check(this,'.$i_input.','.htmlspecialchars(trim($_GET['id'])).');" onkeyup="input_check(this,'.$i_input.','.htmlspecialchars(trim($_GET['id'])).');" value="Резка металла"></span>';
	
$tt_da.='  <tr style="background: none repeat scroll 0 0 #e8f8ff;"><td class="ty" width="3%" align="center">'.$j.'</td>
    <td class="ty" width="50%" align="left">
	
	<span><input id="chexxjjk_'.$i_input.'" style="background:none; font-family: arial; font-size:12px; width:100%; text-align:left;" class="input_print" type="text" onblur="input_check(this,'.$i_input.','.htmlspecialchars(trim($_GET['id'])).');" onkeyup="input_check(this,'.$i_input.','.htmlspecialchars(trim($_GET['id'])).');" value="Резка металла"></span>';
	
	$i_input=$i_input+1;
	
	echo'</td>
	<td class="ty" width="12%" align="right">
	
	<span><input id="checcxxk_'.$i_input.'" style="background:none; font-family: arial; font-size:12px; width:100%; text-align:right;" class="input_print" type="text" onblur="input_check(this,'.$i_input.','.htmlspecialchars(trim($_GET['id'])).');" onkeyup="input_check(this,'.$i_input.','.htmlspecialchars(trim($_GET['id'])).');" value="1"></span>';
	
$tt_da.='</td>
	<td class="ty" width="12%" align="right">
	
	<span><input id="chexxjjk_'.$i_input.'" style="background:none; font-family: arial; font-size:12px; width:100%; text-align:right;" class="input_print" type="text" onblur="input_check(this,'.$i_input.','.htmlspecialchars(trim($_GET['id'])).');" onkeyup="input_check(this,'.$i_input.','.htmlspecialchars(trim($_GET['id'])).');" value="1"></span>';	
	
	$i_input=$i_input+1;
	
	echo'</td>
	<td class="ty" width="5%" align="left">
	
	<span><input id="checcxxk_'.$i_input.'" style="background:none; font-family: arial; font-size:12px; width:100%; text-align:left;" class="input_print" type="text" onblur="input_check(this,'.$i_input.','.htmlspecialchars(trim($_GET['id'])).');" onkeyup="input_check(this,'.$i_input.','.htmlspecialchars(trim($_GET['id'])).');" value="-"></span>';
	
$tt_da.='</td>
	<td class="ty" width="5%" align="left">
	
	<span><input id="chexxjjk_'.$i_input.'" style="background:none; font-family: arial; font-size:12px; width:100%; text-align:left;" class="input_print" type="text" onblur="input_check(this,'.$i_input.','.htmlspecialchars(trim($_GET['id'])).');" onkeyup="input_check(this,'.$i_input.','.htmlspecialchars(trim($_GET['id'])).');" value="-"></span>';	
	
	$i_input=$i_input+1;
	
	echo'</td>
	
	<td class="ty" width="15%" align="right">
	
	<span><input id="checcxxk_'.$i_input.'" style="background:none; font-family: arial; font-size:12px; width:100%; text-align:right;" class="input_print" type="text" onblur="input_check(this,'.$i_input.','.htmlspecialchars(trim($_GET['id'])).');" onkeyup="input_check(this,'.$i_input.','.htmlspecialchars(trim($_GET['id'])).');" value="'.number_format($row["cutting"], 2, ',', ' ').'"></span>';
	
$tt_da.='</td>
	
	<td class="ty" width="15%" align="right">
	
	<span><input id="chexxjjk_'.$i_input.'" style="background:none; font-family: arial; font-size:12px; width:100%; text-align:right;" class="input_print" type="text" onblur="input_check(this,'.$i_input.','.htmlspecialchars(trim($_GET['id'])).');" onkeyup="input_check(this,'.$i_input.','.htmlspecialchars(trim($_GET['id'])).');" value="'.number_format($row["cutting"], 2, ',', ' ').'"></span>';	
	
	$i_input=$i_input+1;
	
	echo'</td>
	<td class="ty rigths" width="100px" align="right"><div style="width:100px">
	
	<span><input id="checcxxk_'.$i_input.'" style="background:none; font-family: arial; font-size:12px; width:100%; text-align:right;" class="input_print" type="text" onblur="input_check(this,'.$i_input.','.htmlspecialchars(trim($_GET['id'])).');" onkeyup="input_check(this,'.$i_input.','.htmlspecialchars(trim($_GET['id'])).');" value="'.number_format($row["cutting"], 2, ',', ' ').'"></span>';
	
$tt_da.='</td>
	<td class="ty rigths" width="100px" align="right"><div style="width:100px">
	
	<span><input id="chexxjjk_'.$i_input.'" style="background:none; font-family: arial; font-size:12px; width:100%; text-align:right;" class="input_print" type="text" onblur="input_check(this,'.$i_input.','.htmlspecialchars(trim($_GET['id'])).');" onkeyup="input_check(this,'.$i_input.','.htmlspecialchars(trim($_GET['id'])).');" value="'.number_format($row["cutting"], 2, ',', ' ').'"></span>';	
	
	$i_input=$i_input+1;
	
	echo'</div></td></tr>';	

$tt_da.='</div></td></tr>';	
		
}

//бонусы

if($row["bonus"]!=0)
{
	$obshay_summa=$obshay_summa-$row["bonus"];
	$j=$j+1;
echo'  <tr style="background: none repeat scroll 0 0 #e8f8ff;"><td class="ty" width="3%" align="center">'.$j.'</td>
    <td class="ty" width="50%" align="left">
	
	<span><input id="checcxxk_'.$i_input.'" style="background:none; font-family: arial; font-size:12px; width:100%; text-align:left;" class="input_print" type="text" onblur="input_check(this,'.$i_input.','.htmlspecialchars(trim($_GET['id'])).');" onkeyup="input_check(this,'.$i_input.','.htmlspecialchars(trim($_GET['id'])).');" value="Бонусы"></span>';
	
$tt_da.='  <tr style="background: none repeat scroll 0 0 #e8f8ff;"><td class="ty" width="3%" align="center">'.$j.'</td>
    <td class="ty" width="50%" align="left">
	
	<span><input id="chexxjjk_'.$i_input.'" style="background:none; font-family: arial; font-size:12px; width:100%; text-align:left;" class="input_print" type="text" onblur="input_check(this,'.$i_input.','.htmlspecialchars(trim($_GET['id'])).');" onkeyup="input_check(this,'.$i_input.','.htmlspecialchars(trim($_GET['id'])).');" value="Бонусы"></span>';
	
	$i_input=$i_input+1;
	
	echo'</td>
	<td class="ty" width="12%" align="right">
	
	<span><input id="checcxxk_'.$i_input.'" style="background:none; font-family: arial; font-size:12px; width:100%; text-align:right;" class="input_print" type="text" onblur="input_check(this,'.$i_input.','.htmlspecialchars(trim($_GET['id'])).');" onkeyup="input_check(this,'.$i_input.','.htmlspecialchars(trim($_GET['id'])).');" value="'.$row["bonus"].'"></span>';
	
$tt_da.='</td>
	<td class="ty" width="12%" align="right">
	
	<span><input id="chexxjjk_'.$i_input.'" style="background:none; font-family: arial; font-size:12px; width:100%; text-align:right;" class="input_print" type="text" onblur="input_check(this,'.$i_input.','.htmlspecialchars(trim($_GET['id'])).');" onkeyup="input_check(this,'.$i_input.','.htmlspecialchars(trim($_GET['id'])).');" value="'.$row["bonus"].'"></span>';	
	
	$i_input=$i_input+1;
	
	echo'</td>
	<td class="ty" width="5%" align="left">
	
	<span><input id="checcxxk_'.$i_input.'" style="background:none; font-family: arial; font-size:12px; width:100%; text-align:left;" class="input_print" type="text" onblur="input_check(this,'.$i_input.','.htmlspecialchars(trim($_GET['id'])).');" onkeyup="input_check(this,'.$i_input.','.htmlspecialchars(trim($_GET['id'])).');" value="б."></span>';
	
$tt_da.='</td>
	<td class="ty" width="5%" align="left">
	
	<span><input id="chexxjjk_'.$i_input.'" style="background:none; font-family: arial; font-size:12px; width:100%; text-align:left;" class="input_print" type="text" onblur="input_check(this,'.$i_input.','.htmlspecialchars(trim($_GET['id'])).');" onkeyup="input_check(this,'.$i_input.','.htmlspecialchars(trim($_GET['id'])).');" value="б."></span>';	
	
	$i_input=$i_input+1;
	
	echo'</td>
	
	<td class="ty" width="15%" align="right">
	
	<span><input id="checcxxk_'.$i_input.'" style="background:none; font-family: arial; font-size:12px; width:100%; text-align:right;" class="input_print" type="text" onblur="input_check(this,'.$i_input.','.htmlspecialchars(trim($_GET['id'])).');" onkeyup="input_check(this,'.$i_input.','.htmlspecialchars(trim($_GET['id'])).');" value="'.number_format(1, 2, ',', ' ').'"></span>';
	
$tt_da.='</td>
	
	<td class="ty" width="15%" align="right">
	
	<span><input id="chexxjjk_'.$i_input.'" style="background:none; font-family: arial; font-size:12px; width:100%; text-align:right;" class="input_print" type="text" onblur="input_check(this,'.$i_input.','.htmlspecialchars(trim($_GET['id'])).');" onkeyup="input_check(this,'.$i_input.','.htmlspecialchars(trim($_GET['id'])).');" value="'.number_format(1, 2, ',', ' ').'"></span>';	
	
	$i_input=$i_input+1;
	
	echo'</td>
	<td class="ty rigths" width="100px" align="right"><div style="width:100px">
	
	<span><input id="checcxxk_'.$i_input.'" style="background:none; font-family: arial; font-size:12px; width:100%; text-align:right;" class="input_print" type="text" onblur="input_check(this,'.$i_input.','.htmlspecialchars(trim($_GET['id'])).');" onkeyup="input_check(this,'.$i_input.','.htmlspecialchars(trim($_GET['id'])).');" value="- '.number_format($row["bonus"], 2, ',', ' ').'"></span>';
	
$tt_da.='</td>
	<td class="ty rigths" width="100px" align="right"><div style="width:100px">
	
	<span><input id="chexxjjk_'.$i_input.'" style="background:none; font-family: arial; font-size:12px; width:100%; text-align:right;" class="input_print" type="text" onblur="input_check(this,'.$i_input.','.htmlspecialchars(trim($_GET['id'])).');" onkeyup="input_check(this,'.$i_input.','.htmlspecialchars(trim($_GET['id'])).');" value="- '.number_format($row["bonus"], 2, ',', ' ').'"></span>';	
	
	$i_input=$i_input+1;
	
	echo'</div></td></tr>';	

$tt_da.='</div></td></tr>';	
		
}
echo'</table><table class="table_check"  width="100%" style=" border:0px solid #000; border-color:#000;  color: #000; font-size:12px; font-family:arial;" border="0" cellspacing="0" cellpadding="0"><tr><td class="rigths" align="right"><strong>итого:</strong></td><td class="rigths" align="right" width="100px"><div style="width:100px"><span class="line_red"><span><input id="checcxxk_'.$i_input.'" style=" font-weight:bold; font-family: arial; font-size:12px; width:100%; text-align:right;" class="input_print" type="text" onblur="input_check(this,'.$i_input.','.htmlspecialchars(trim($_GET['id'])).');" onkeyup="input_check(this,'.$i_input.','.htmlspecialchars(trim($_GET['id'])).');" value="'.number_format($obshay_summa, 2, ',', ' ').'"></span>';

$tt_da.='</table><table class="table_check"  width="100%" style=" border:0px solid #000; border-color:#000;  color: #000; font-size:12px; font-family:arial;" border="0" cellspacing="0" cellpadding="0"><tr><td class="rigths" align="right"><strong>итого:</strong></td><td class="rigths" align="right" width="100px"><div style="width:100px"><span class="line_red"><span><input id="chexxjjk_'.$i_input.'" style=" font-weight:bold; font-family: arial; font-size:12px; width:100%; text-align:right;" class="input_print" type="text" onblur="input_check(this,'.$i_input.','.htmlspecialchars(trim($_GET['id'])).');" onkeyup="input_check(this,'.$i_input.','.htmlspecialchars(trim($_GET['id'])).');" value="'.number_format($obshay_summa, 2, ',', ' ').'"></span>';

	$i_input=$i_input+1;
	
echo'</span></div></td></tr></table>';
$tt_da.='</span></div></td></tr></table>';
$obshay_summa=number_format($obshay_summa, 2, '.', '');
  
  echo'<br><div>Всего наименований&nbsp;'.$j.', на сумму <span><input id="checcxxk_'.$i_input.'" style="font-family: arial; font-size:12px; width:200px; text-align:left;" class="input_print" type="text" onblur="input_check(this,'.$i_input.','.htmlspecialchars(trim($_GET['id'])).');" onkeyup="input_check(this,'.$i_input.','.htmlspecialchars(trim($_GET['id'])).');" value="'.number_format($obshay_summa, 2, ',', ' ').'  руб."></span>';

$tt_da.='<br><div>Всего наименований&nbsp;'.$j.', на сумму <span><input id="chexxjjk_'.$i_input.'" style="font-family: arial; font-size:12px; width:200px; text-align:left;" class="input_print" type="text" onblur="input_check(this,'.$i_input.','.htmlspecialchars(trim($_GET['id'])).');" onkeyup="input_check(this,'.$i_input.','.htmlspecialchars(trim($_GET['id'])).');" value="'.number_format($obshay_summa, 2, ',', ' ').'  руб."></span>';
  
  $i_input=$i_input+1;

  
  echo'</div><div><span><input id="checcxxk_'.$i_input.'" style=" font-weight:bold; font-family: arial; font-size:12px; width:100%; text-align:left;" class="input_print" type="text" onblur="input_check(this,'.$i_input.','.htmlspecialchars(trim($_GET['id'])).');" onkeyup="input_check(this,'.$i_input.','.htmlspecialchars(trim($_GET['id'])).');" value="'.ucfirst(num2str($obshay_summa)).'"></span>';

$tt_da.='</div><div><span><input id="chexxjjk_'.$i_input.'" style=" font-weight:bold; font-family: arial; font-size:12px; width:100%; text-align:left;" class="input_print" type="text" onblur="input_check(this,'.$i_input.','.htmlspecialchars(trim($_GET['id'])).');" onkeyup="input_check(this,'.$i_input.','.htmlspecialchars(trim($_GET['id'])).');" value="'.ucfirst(num2str($obshay_summa)).'"></span>';  

  $i_input=$i_input+1;
  
  echo'</div><div style="height:10px;" class="hh"></div>

<br>
<br><br><div style="float:left;"><strong>Продавец</strong> _________________________</div><div style="float:right;"><strong>Покупатель</strong> _________________________</div>';
$tt_da.='</div><div style="height:10px;" class="hh"></div><br><br><br><div style="float:left;"><strong>Продавец</strong> _________________________</div><div style="float:right;"><strong>Покупатель</strong> _________________________</div>';	
	                                                                                                                 
  
  ?>
  <br>
  
  </div>
<?
  
  
echo'<div id="template" style="display:none;">'.$tt_da.'</div>';
  }
  ?>



</body>
</html>

