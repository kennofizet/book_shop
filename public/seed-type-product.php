<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "book_shop";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}else{
	$conn->query("SET NAMES 'utf8'");
	// $conn->query("SET DESCRIPTION 'utf8'");
}
for ($i=1; $i <1153 ; $i++) { 
	// echo $i;
	$sql = "
	INSERT INTO `type_products` (`name`, `description`, `parent`, `image`, `created_at`, `updated_at`) VALUES
	('hình ảnh từ người dùng', '<p>h&igrave;nh&nbsp;ảnh từ người d&ugrave;ng</p>', $i, '1603006860rGheR5lc08OyE5G2Mf8t_167e9836948a93235f7baa4e9f70ee81_jpg.jpg', '2020-10-18 00:41:00', '2020-10-18 00:41:00'),
	('hình ảnh từ người dùng', '<p>h&igrave;nh ảnh từ người d&ugrave;ng</p>', $i, '1603006916DjmgcfEeOjEUtwQufy4H_8557ed6cc680e4a18131e5ad10fb514f_jpg.jpg', '2020-10-18 00:41:56', '2020-10-18 00:41:56'),
	('hình ảnh từ người dùng', '<p>h&igrave;nh ảnh từ người d&ugrave;ng</p>', $i, '1603006950w4GlKZi0zneSZ46HWUGX_bdb83ad6d2f2b7085a6cbf07626e36e1_jpg.jpg', '2020-10-18 00:42:30', '2020-10-18 00:42:30');
	";
	if (mysqli_query($conn, $sql)) {
	  echo "New record created successfully". $i;
	  echo "<br>";
	} else {
	  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
}



mysqli_close($conn);
?>
