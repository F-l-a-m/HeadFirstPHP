<?php
$email = $_POST['email'];

$dbc = mysqli_connect('127.0.0.1', 'root', 'root', 'elvis_store')
        or die('Error conncting to MySQL server');

$query = "DELETE FROM email_list WHERE email = '$email'";
$result = mysqli_query($dbc, $query)
        or die('Error while making database query');

echo "Email $email successfully deleted from mailing list";
mysqli_close($dbc);
?>
