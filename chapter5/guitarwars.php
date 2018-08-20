<?php
require_once 'appvars.php';
require_once '../database/database.php';
require_once '../template/templater.php';
?>
<!DOCTYPE html>
<html>
    <?php Template::printHead('Guitar Wars - High Scores'); ?>
    <body>
        <div class="container" style="margin-top:30px">
            <div class="row">
                <div class="col-sm-12">
                    <h2>Guitar Wars - High Scores</h2>
                    <p>Welcome, Guitar Warrior, do you have what it takes to crack the high score list? If so, just <a href="addscore.php">add your own score</a>.</p>
                    <hr />
                    
                    <?php
                    // Connect to the database and retrieve the score data from MySQL
                    $pdo = Database::connect('headfirst');
                    
                    // Select Top 1 score value
                    $sql = "SELECT score FROM guitarwars ORDER BY score DESC LIMIT 1";
                    $topScore = $pdo->query($sql)->fetchColumn();
                    echo "<h1>Top score is: $topScore</h1>";
                    
                    // Select all data and order it
                    $sql = "SELECT * FROM guitarwars ORDER BY score DESC, date ASC";
                    echo '<table>';
                    foreach ($pdo->query($sql) as $row) {
                        // Display the score data
                        echo '<tr><td class="scoreinfo">';
                        echo '<span class="score">' . $row['score'] . '</span><br />';
                        echo '<strong>Name:</strong> ' . $row['name'] . '<br />';
                        echo '<strong>Date:</strong> ' . $row['date'] . '</td>';
                        if (is_file(GW_UPLOADPATH . $row['screenshot']) && filesize(GW_UPLOADPATH . $row['screenshot']) > 0) {
                            echo '<td><img src="' . GW_UPLOADPATH . $row['screenshot'] . '" alt="Verified" /></td></tr>';
                        } else {
                            echo '<td><img src="' . GW_UPLOADPATH . 'unverified.gif' . '" alt="Unverified score" /></td></tr>';
                        }
                    }
                    echo '</table>';
                    Database::disconnect();
                    ?>
                </div>
            </div>
        </div>
        <?php Template::printFooter(); ?>
    </body> 
</html>
