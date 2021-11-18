// JavaScript Document
$(function (){

    $('.material-prime-v2').on("click",'.history_icon_level',HistoryN1);

	
});

//показать историю списания по материалу - наряды
function HistoryN1() {

    $('.history_act_mat').hide();

    var block_his=$(this).parents('.edit_panel11_mat').find('.history_act_mat');
    if(block_his.is(':visible'))
    {
        block_his.slideUp("slow");
    } else
    {
        block_his.slideDown("slow");
    }

}
