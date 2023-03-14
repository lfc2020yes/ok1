<?php
//форма редактирования операции в финансах

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

if (count($_GET) != 1)
{
    goto end_code;
}
$status=0;


   $class_bba='cost_bank1';

if((!isset($_SESSION["user_id"]))or(!is_numeric(id_key_crypt_encrypt($_SESSION["user_id"]))))
{	
	goto end_code;
}

$id_user=id_key_crypt_encrypt($_SESSION["user_id"]);

//проверить есть ли переменная id и можно ли этому пользователю это делать


$result_t=mysql_time_query($link,'Select A.* from preorders as A where A.visible=1 AND A.id="'.ht($_GET["id_buy"]).'" and A.id_company="'.$id_company.'"');
$num_results_t = $result_t->num_rows;
if($num_results_t==0)
{
    $debug=h4a(5,$echo_r,$debug);
    goto end_code;

} else {
    $row_uu = mysqli_fetch_assoc($result_t);
}


if ((!$role->permission('Обращения','U'))and($sign_admin!=1))
{
    goto end_code;
}

if (((!$role->permission('Обращения','U'))or($sign_level<=1))or($row_uu["status"]!=1)) {
    goto end_code;
}

if(($row_uu["status"]!=1)) {

    goto end_code;
}

//составление секретного ключа формы
//составление секретного ключа формы
//соль для данного действия
$token=token_access_compile(ht($_GET["id_buy"]),'bt_preorders_transfer',$secret);
//составление секретного ключа формы
//составление секретного ключа формы
//составление секретного ключа формы







$status=1;



?>
<div id="Modal-one" class="box-modal js-box-modal-two table-modal eddd1  history_window1 client_window "><div class="box-modal-pading">
<div class="top_modal">
	
	
	
  <div class="box-modal_close arcticmodal-close"></div>
  <?
  echo'<h1 class="h111" mor="'.$token.'" for="'.htmlspecialchars(trim($_GET['id_buy'])).'"><span>Передача обращения №'.$_GET["id_buy"].'</span></h1>';
  ?>
  
  
  
</div>
<div class="center_modal">
<?
echo'<form class="js-form-preorders" id="vino_xd_preorders" style=" padding:0; margin:0;" method="post" enctype="multipart/form-data">';
echo'<input type="hidden" value="'.htmlspecialchars(trim($_GET['id_buy'])).'" name="id">';
echo'<input type="hidden" value="'.$token.'" name="tk">';
echo'<input name="tk1" value="dsQ23RStsd2re" type="hidden">';


//форма добавления задачи
//форма добавления задачи


$query_string='<div ><div class="add_sel_form add-new-olp" style="position:relative; margin-bottom: 0px; display:block; border:0px;">';


$query_string.='<div class="pad10" style="padding: 0; z-index:100;"><span class="bookingBox_gr22"></span></div>';





$query_string.='<div class="mobile-white" style="width:100%;"><div class="form_right_say_one " style="padding:0px; width:100%;">';










//выводим и всех подчинненных, следовательно для простых менеджеров подчиненных нет

$os5 = array();
$os_id5 = array();

$mass_ei=users_hierarchy($id_user,$link);
rm_from_array($id_user,$mass_ei);
$mass_ei= array_unique($mass_ei);

$num_results_work_zz=0;


if($row_uu["id_user"]!=$id_user)
{
    array_push($os5, 'Себе');
    array_push($os_id5, $id_user);
}


foreach ($mass_ei as $keys => $value)
{
    if($row_uu["id_user"]!=$value)
    {
    $result_work_zz=mysql_time_query($link,'Select a.name_small,a.id from r_user as a where a.id="'.$value.'" and a.enabled=1');
    $num_results_work_zz = $result_work_zz->num_rows;
    if($num_results_work_zz!=0)
    {

        for ($i=0; $i<$num_results_work_zz; $i++)
        {
            $row_work_zz = mysqli_fetch_assoc($result_work_zz);
            array_push($os5, $row_work_zz["name_small"]);
            array_push($os_id5, $row_work_zz["id"]);
        }
    }
}
}




if($num_results_work_zz!=0) {
    $su_5="0";

    $query_string .= '<div style="margin-top: 30px;
    position: relative;" class="js-zindex js-vid-oper">';

    $query_string .= '<div class="left_drop list_2018 menu1_prime"><label class="active_label">Менеджер<span>*</span></label><div class="select eddd zin_2019"><a class="slct" list_number="t3" data_src="">Не выбрано</a><ul class="drop js-visible-mt">';

    for ($i = 0; $i < count($os5); $i++) {
        //echo(parseInt($su_5).'='.$os_id5[$i].'<br>');
        if ($su_5 == $os_id5[$i]) {
            $query_string .= '<li class="sel_active"><a href="javascript:void(0);"  rel="' . $os_id5[$i] . '">' . $os5[$i] . '</a></li>';
        } else {
            $query_string .= '<li><a href="javascript:void(0);"  rel="' . $os_id5[$i] . '">' . $os5[$i] . '</a></li>';
        }

    }

    $query_string .= '</ul><input type="hidden" class="gloab " name="id_user_booking" id="vid_finance" value="0"><div class="div_new_2018"><hr class="one"></div></div></div></div>';
}




$query_string.='</div>';

//форма задачи
if($status_admin==0)
{
    $query_string.='<div class="center_vert right_task_ccb" style="width: 100%; margin-top:20px;"><div class="add_cff_fin js-transfer-preorder-x">Передать</div>';
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


     $(function (){
     Zindex();
     NumberBlockFile();
	 
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
     AutoResizeTF();
	 
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


	setTimeout(function () {


             const phoneEl = $('.js-mask-input-tel')[0];
             let phoneMask = IMask(phoneEl, {
                 mask: '{+7} (#00) 000-00-00',
                 definitions: {
                     '#': /[012345679]/
                 }
             });

    }, 1000);


 
 });