<?php
require_once 'appvars.php';
require_once '../database/database.php';
require_once '../template/templater.php';

if( isset($_GET['id']) &&
    isset($_GET['date']) &&
    isset($_GET['name']) &&
    isset($_GET['score']) &&
    isset($_GET['screenshot'])) {
    
    $id = $_GET['id'];
    $date = $_GET['date'];
    $name = $_GET['name'];
    $score = $_GET['score'];
    $screenshot = $_GET['screenshot'];
} else if ( isset ($_POST['id']) &&
            isset ($_POST['name']) &&
            isset ($_POST['score'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $score = $_POST['score'];
} else {
    echo '<p class="error">Delete error. Rating not selected.</p>';
}

if(isset($_POST['submit'])) {
    if($_POST['confirm'] == 'Yes') {
        @unlink(GW_UPLOADPATH . $screenshot);
        
        $pdo = Database::connect('headfirst');
        $sql = "DELETE FROM guitarwars WHERE id = $id";
        $query = $pdo->prepare($sql);
        $query->execute(array($id));
        Database::disconnect();
        
        echo '<p>Rating with score ' . $score . ' for user ' . $name .
                ' was successfully deleted.</p>';
    } else {
        echo 'Rating was not deleted.';
    }
} else if ( isset($id) &&
            isset($name) &&
            isset($date) &&
            isset($score) &&
            isset($screenshot)) {
        echo '<p>Are you sure to delete this rating?</p>';
        echo '<p><strong>Name: </strong>' . $name . '<br />' .
                '<strong>Date: </strong>' . $date . '<br />' .
                '<strong>Score: </score>' . $score . '</p>';
        echo '<form method="post" action="removescore.php">';
        echo '<input type="radio" name="confirm" value="Yes" /> Yes ';
        echo '<input type="radio" name="confirm" value="No" checked="checked" /> No <br />';
        echo '<input type="submit" value="Submit" name="submit" />';
        echo '<input type="hidden" name="id" value="' . $id . '" />';
        echo '<input type="hidden" name="name" value="' . $name . '" />';
        echo '<input type="hidden" name="score" value="' . $score . '" />';
        echo '</form>';
}

echo '<p><a href="admin.php">&lt;&lt; Back to admin page</a></p>';

?>
