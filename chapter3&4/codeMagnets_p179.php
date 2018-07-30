<?php
$from = 'andrew.flam@gmail.com';
$subject = $_POST['subject'];
$text = $_POST['message'];

$dbc = mysqli_connect('127.0.0.1', 'root', 'root', 'elvis_store')
        or die('Error conncting to MySQL server');

$query = "SELECT * FROM email_list";
$result = mysqli_query($dbc, $query)
        or die('Error while making database query');

while ($row = mysqli_fetch_array($result)) {
    $first_name = $row['first_name'];
    $last_name = $row['last_name'];
    $msg = "Dear $first_name $last_name,\n" . $text;
    $to = $row['email'];
    mail($to, $subject, $msg, 'From: ' . $from);
    echo 'Email sent to ' . $to . '<br/>';
}

mysqli_close($dbc);
?>
