<?php
require_once 'appvars.php';
require_once '../database/database.php';
require_once '../template/templater.php';

$pdo = Database::connect('headfirst');
$sql = "SELECT * FROM guitarwars ORDER BY score DESC, date ASC";
echo '<table>';
foreach ($pdo->query($sql) as $row) {
    echo '<tr><td><strong>' . $row['name'] . '</strong></td>';
    echo '<td>' . $row['date'] . '</td>';
    echo '<td>' . $row['score'] . '</td>';
    echo '<td><a href="removescore.php?id=' . $row['id'] . 
            '&amp;date=' . $row['date'] .
            '&amp;name=' . $row['name'] . 
            '&amp;score=' . $row['score'] .
            '&amp;screenshot=' . $row['screenshot'] . 
            '">Delete</a></td></tr>';
}
echo '</table>';
Database::disconnect();
