<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pizza";
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM menu ORDER BY id DESC LIMIT 5";
$result = mysqli_query($conn, $sql);

$data = array(
    array('Menu Item', 'Number of Orders')
);

while ($row = mysqli_fetch_assoc($result)) {
    $menu_items = array(
        $row['menu1'],
        $row['menu2'],
        $row['menu3'],
        $row['menu4'],
        $row['menu5']
    );

    foreach ($menu_items as $menu_item) {
        $found = false;

        foreach ($data as &$data_item) {
            if ($data_item[0] == $menu_item) {
                $data_item[1] += 1;
                $found = true;
                break;
            }
        }

        if (!$found) {
            $data[] = array($menu_item, 1);
        }
    }
}

array_multisort(array_column($data, 1), SORT_DESC, $data);

mysqli_close($conn);

$jsonData = json_encode($data);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pizza Menu</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = new google.visualization.arrayToDataTable(<?php echo $jsonData; ?>);

            var options = {
                title: 'Pizza Menu',
                is3D: false,
                pieHole: 0.4
            };

			var chart = new google.visualization.PieChart(document.getElementById('piechart'));
			chart.draw(data, options);
		}

		setInterval(function() {
			drawChart();
		}, 5000);
	</script>
</head>
<body>
	<div id="piechart" style="width: 900px; height: 500px;"></div>
</body>
</html>
