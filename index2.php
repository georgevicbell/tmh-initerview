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
 <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {packages:["orgchart"]});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
	BX24.callMethod('department.get', {}, function(r){
      
	var data = new google.visualization.DataTable();
	
	data.addColumn('string', 'Name');
        data.addColumn('string', 'Manager');
        data.addColumn('string', 'ToolTip');

        // For each orgchart box, provide the name, manager, and tooltip to show.
       for (dept of r.data())
       {
	       var parentName="";
	       for (findDept of r.data())
	       {
		       if (dept.PARENT==findDept.ID)
			  parentName=findDept.NAME;
	       }       
	        data.addRows([
                        [dept.NAME, parentName, '']
                ]);
        }
/*	data.addRows([
          [{v:'Mike', f:'Mike<div style="color:red; font-style:italic">President</div>'},
           '', 'The President'],
          [{v:'Jim', f:'Jim<div style="color:red; font-style:italic">Vice President</div>'},
           'Mike', 'VP'],
          ['Alice', 'Mike', ''],
          ['Bob', 'Jim', 'Bob Sponge'],
          ['Carol', 'Bob', '']
        ]);
 */
        // Create the chart.
        var chart = new google.visualization.OrgChart(document.getElementById('chart_div'));
        // Draw the chart, setting the allowHtml option to true for the tooltips.
        chart.draw(data, {allowHtml:true});
       		});
	}
   </script>
    </head>
  <body>
    <div id="chart_div"></div>
    <p><a href="index.php">Department List</a></p>  
  </body>
</html>

