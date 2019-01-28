<?php
$auth = $_REQUEST['AUTH_ID'];
$domain = ($_REQUEST['PROTOCOL'] == 0 ? 'http' : 'https') . '://'.$_REQUEST['DOMAIN'];

$res = file_get_contents($domain.'/rest/user.current.json?auth='.$auth);
$arRes = json_decode($res, true);
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="//api.bitrix24.com/api/v1/"></script>
</head>
<body>
<div id="Departments">Loading Department List...</div>
<p></p>
<p></p>
<p><a href="index2.php">Org chart</a></p>
</body>
</html>
<script>
BX24.callMethod('department.get', {}, function(r){
	var deptDiv=document.getElementById("Departments")
	deptDiv.innerHTML="";
	for (dept of r.data())
	{
		deptDiv.innerHTML=deptDiv.innerHTML + "<p>"+dept.NAME+"</p>";
	}

});

</script>

