<?
//обращения вкладка "Журнал операций"
$name_form='008U';

if((!isset($token_inlude))or($token_inlude!='taabbssd32.dfDD'))
{
    goto end_code;
    $debug=h4a(3,$echo_r,$debug);
}

//$query_string.='<div class="strong_wh_2020">↓ Cформированные договора</div>';

/*$download='<span class="doc_add_number"><a class="ioo" href="'.$base_usr.'/tours/doc/doc-'.$IDOC.'_'.$new_id_version.'.docx">Договор №'.ht(trim($_POST['number_contract'])).'</a></span>';*/


$query_string ??='';

$query_string.='<div class="say_clients">';


//кто может добавлять комментарии

if($role->permission('Обращения','U'))
{
    $query_string.='<div class="js-add-comment-preorders"><div class="add_say_cbb_new"><div class="center_vert" style="width:100%"><span>Добавить комментарий</span></div></div></div>';
}

//форма добавления сообщения
//форма добавления сообщения

$su_say=2;
$query_string.='<div class="js-ssay"><div class="add_say_form js-add-form-plus-preorders">
<div class="form_right_say form_right_task_h">
<div class="add_say_two">
       <div class="div_textarea_say" >
	   <label>ваш комментарий</label>
			<div class="otziv_add">';


$query_string.='<textarea style="height:20px" cols="10" rows="1" placeholder="" name="comment_b" class="di text_area_otziv no_comment_bill js-comment-add-preorders-v"></textarea>

 <script type="text/javascript"> 
	  $(function (){ 
$(\'.js-comment-add-'.$name_form.'\').autoResize({extraSpace : 10});
$(\'.js-comment-add-'.$name_form.'\').trigger(\'keyup\');

ToolTip();
});

	</script>';

$query_string.='</div>      
</div>	
</div>';




$query_string.='</div>  <div class="add_say_yes"><div class="center_vert right_task_ccb" style="width: 100%;"><div class="add_cff js-add-cff js-add-comment-yes-preorders">добавить комментарий</div>




<div class="task_cb_exit js-exit-form-comm-preorders">


<div class="task_cb_head">
отменить
</div>
</div>


</div></div>		
</div></div>';


//форма добавления сообщения
//форма добавления сообщения


$echo_xx=1;
$count_say=700;
$redd__='';
$result_8 = mysql_time_query($link,'SELECT A.id,A.action_history,A.id_user, A.datetimes,A.edit,A.comment  FROM preorders_status_history_new AS A WHERE A.id_preorder="'.htmlspecialchars(trim($id)).'" order by A.id desc,A.datetimes desc');



$num_8 = $result_8->num_rows;
if($result_8)
{

    while($row_8 = mysqli_fetch_assoc($result_8)){
        $query_string_xx='<div rel_notibss="'.$row_8["id"].'" class="comm-preorders-block">';
        $query_string_xx.='<div class="h_cb_operation"><span>'.htmlspecialchars_decode($row_8["comment"]).'</span>';

        $query_string_xx.='<div class="date_cb" >'.time_stamp($row_8["datetimes"]).'</div></div>';


        $result_status22=mysql_time_query($link,'SELECT b.name_user,b.name_small FROM r_user AS b WHERE b.id="'.htmlspecialchars(trim($row_8["id_user"])).'"');
        //echo('SELECT a.* FROM r_status AS a WHERE a.numer_status="'.$row1ss["status"].'" and a.id_system=13');

        $query_string_xx.='<div class="user_cb">';

        if($result_status22->num_rows!=0)
        {
            $row_status22 = mysqli_fetch_assoc($result_status22);
            $query_string_xx.=''.$row_status22['name_small'].'';
        }

//только для своих общений
        if((($row_8["id_user"]==$id_user)or($sign_admin==1))and($row_8["edit"]==1))
        {
            $query_string_xx.='<div class="vip-ds"><i class="em2 js-com-preorders-del" data-tooltip="Удалить"></i></div>';

}

        $query_string_xx.='</div>';



/*
//только для своих общений
        if((($row_8["id_user"]==$id_user)or($sign_admin==1))and($row_8["edit"]==1))
        {
            $query_string_xx.='<div class="edit-menu-2019 com-task-edit-block"><i class="em2 js-com-trips-del" data-tooltip="Удалить"></i></div>';				  }
*/

        $query_string_xx.='</div>';
//$query_string_xx.='</div>';




        $query_string.=$query_string_xx;






    }




}
if($num_8==0)
{
    $query_string.='<div class="message_search_b message_clients_cb js-message-com-t"><span>Пока событий нет.</span></div>';
} else
{
    $query_string.='<div class="message_search_b message_clients_cb js-message-com-t" style="display:none;"><span>Пока событий нет.</span></div>';
}


$query_string.='</div>';


end_code:

?>