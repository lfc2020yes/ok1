<?
/*<script type="text/javascript" src="Js/forms.js?<? echo($vs); ?>"></script>*/


$local='C:/OpenServer/domains/'.$local_host.'';
if($_SERVER['DOCUMENT_ROOT']!=$local)
{
echo'<script language="JavaScript" type="text/javascript" src="/public/forms.map.min.js?cb=1679947240056"></script>'; 
} else
{
echo'<script language="JavaScript" type="text/javascript" src="/public/forms.map.js?cb=1679947240056"></script>';	
}

	
?>