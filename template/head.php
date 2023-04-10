<?
$local='C:/OpenServer/domains/'.$local_host.'';
if($_SERVER['DOCUMENT_ROOT']!=$local)
{
echo'<link href="/public/main.min.css?cb=1681113197118" type="text/css" rel="stylesheet" />
<script language="JavaScript" type="text/javascript" src="/public/index.map.min.js?cb=1681113197118"></script>'; 
} else
{
echo'<link href="/.src/css/main.css?cb=1681113197118" type="text/css" rel="stylesheet" />
<script language="JavaScript" type="text/javascript" src="/public/index.map.js?cb=1681113197118"></script>';	
}


?>
<!--
<script src="https://cdn.amcharts.com/lib/4/core.js"></script>
<script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>
-->