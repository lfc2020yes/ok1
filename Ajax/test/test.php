<?php
//получение карточки клиента
$url_system=$_SERVER['DOCUMENT_ROOT'].'/';
include_once $url_system.'module/ajax_access.php';
header("Content-type: application/json");


$test='<div class="teps" rel_w="0" style="width: 0%;"><div class="peg_div"><div></div></div></div>

	<div class="trips-b-number">79</div>
	<div class="trips-b-info"><span class="label-task-gg ">Информация о туре
</span><div class="pass_wh_trips"><a class="js-client" iod="86"><span class="js-glu-f-86">Подгорный Владислав Игоревич</span></a></div><div class="pass_wh_trips"><span class="kuda-trips">ОАЭ, пв / аываыва</span>
<span class="date-trips">15.08.2020 / 18.08.2020</span></div><div class="pass_wh_trips"><label>Менеджер</label><span class="obi">Подгорный Владислав</span></div><div class="pass_wh_trips"><label>Номер заявки у ТО</label><span class="obi">авап</span></div><div class="pass_wh_trips"><label>Договор</label><span class="obi">13/08/2020 - 2 от 13.08.2020 <span doc="" class="oo_date  issue-block" style="font-size: 12px;" > (<div class="help-jj red-jj js-issue-doc" > не выдан </div >)<div class="form-rate-ok form-rate-ok-doc"><div class="rate-input"><div class="rates_visible"><div class="input_2018"><label>Когда выдан</label><input name="doc_date" value="" id="date_12466" class="input_new_2018 required date_picker_xe js-docc" autocomplete="off" type="text"><div class="div_new_2018"><hr class="one"><hr class="two"><div class="oper_name"></div></div></div>
</div></div><div class="rate-button js-ok-rate-doc">ok</div></div></span ></span></div><div class="pass_wh_trips"><label>Время вылетов
</label><span class="obi"><div style="display:none;" class="top_mi_n_m " data-tooltip="Вылетает на отдых"><div class="center_vert"><div class="c_start"><i></i><span class="js-mi-x1 mi_m">Не указано <span class="oo_date">(<div class="help-jj red-jj">не забудь</div>)</span></span></div></div></div><div class="" data-tooltip="Вылетает с отдыха"><div class="center_vert"><div class="c_end"><i></i><span class="js-mi-x2 mi_m">Не указано <span class="oo_date">(<div class="help-jj red-jj">не забудь</div>)</span></span></div></div></div></span></div></div><div class="trips-b-user js-trips-comm"><span class="label-task-gg ">Расчеты с туристом
</span><div class="gr-50" proccs="100">
    <div class="circle-container-trips" ><div class="circlestat_yes_vse"></div></div><span data-tooltip="клиент отдал" class="js-all-cost cost_circle rate_643">44 444.00</span><div data-tooltip="общая сумма" class="cost_all_trips">из <span class="cost_circle js-all-price-trips rate_643">44 444.00</span></div><div class="cost_all_trips hide-cost">остаток<span style="display:none;" class="cost_circle rate_xxx">&nbsp;</span></div></div></div><div class="trips-b-operator js-trips-comm" style=""><span class="label-task-gg ">Расчеты с туроператором
</span><div class="gr-50" proccs="0">
    <div class="circle-container-trips" ><div class="circlestat" data-dimension="80" data-text="0%" data-width="2" data-fontsize="16" data-percent="0" data-fgcolor="#25ae88" data-bgcolor="#e8eaed" data-fill="rgba(0,0,0,0)"></div></div><span data-tooltip="отдали туроператору" class="js-all-cost cost_circle rate_643">0.00</span><span data-tooltip="наш остаток" class="js-all-cost  hide-cost cost_circle rate_xxx">0.00</span><div data-tooltip="общая сумма" class="cost_all_trips">из <span class="cost_circle js-all-price-trips rate_643" style="color:#fd8080">0.00</span></div><div class="cost_all_trips hide-cost">остаток<span style="display:none;" class="cost_circle rate_xxx">&nbsp;</span></div></div><div rate="" class="visible_rate js-exc-cost"><div code="xxx" class="eye-wall-trips  eye-my">показать остаток</div><div code="643" class="eye-wall-trips">Общие цифры</div></div><div><div my="1" class="eye-srok-trips js-srok-my">срок оплаты</div></div><div class="sroki-2020-xto"><span data-tooltip="0 ₽" class="yellow_proc_sroki">100%</span> → 13.08.2020, Чт <span class="oo_date">(<div class="help-jj red-jj">Сегодня</div>)</span></div></div><div class="trips-b-comission" style=""><div class="commi-tips"><span class="name-trips-opi">Предполагаемая Комиссия</span><div><span class="cost_circle cost_circle_proc red-trips">0</span></div>

<div class="cost_all_trips"><span class="cost_circle">0</span></div>
</div>
<div class="commi-tips skidka-tips">
<span class="name-trips-opi">Скидка</span><div><span class="cost_circle cost_circle_proc green-trips">0</span></div>

<div class="cost_all_trips"><span class="cost_circle">0.00</span></div>
</div></div>';

$debug=0;

$aRes = array("debug"=>$debug,"test"=>$test);

/*
require_once $url_system.'Ajax/lib/Services_JSON.php';
$oJson = new Services_JSON();
//функция работает только с кодировкой UTF-8
echo $oJson->encode($aRes);
*/

echo json_encode($aRes);

?>