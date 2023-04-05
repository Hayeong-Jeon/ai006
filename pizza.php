<!DOCTYPE html>
<html>
<head>
	<title>Pizza Menu</title>
</head>
<body>
	<h1>피자 토핑 선호도</h1>
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
		<label for="menu1">토핑 1:</label>
		<input type="text" id="menu1" name="menu1"><br>

		<label for="menu2">토핑 2:</label>
		<input type="text" id="menu2" name="menu2"><br>

		<label for="menu3">토핑 3:</label>
		<input type="text" id="menu3" name="menu3"><br>

		<label for="menu4">토핑 4:</label>
		<input type="text" id="menu4" name="menu4"><br>

		<label for="menu5">토핑 5:</label>
		<input type="text" id="menu5" name="menu5"><br>

		<input type="submit" value="등록">
	</form>

	<?php
	// Check if the form is submitted
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		// Get the values from the form
		$menu1 = $_POST["menu1"];
		$menu2 = $_POST["menu2"];
		$menu3 = $_POST["menu3"];
		$menu4 = $_POST["menu4"];
		$menu5 = $_POST["menu5"];

		// Connect to the database
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "pizza";
		$conn = mysqli_connect($servername, $username, $password, $dbname);

		// Check connection
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}

		// Insert the values into the menu table
		$sql = "INSERT INTO menu (menu1, menu2, menu3, menu4, menu5) VALUES ('$menu1', '$menu2', '$menu3', '$menu4', '$menu5')";
		if (mysqli_query($conn, $sql)) {
			echo "등록이 완료되었습니다.";
			// Redirect to pie.php after registration
			header("Location: pie.php");
			exit();
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}

		// Close the database connection
		mysqli_close($conn);
	}
	?>
</body>
</html>