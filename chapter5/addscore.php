<?php
require_once 'appvars.php';
require_once '../database/database.php';
require_once '../template/templater.php';
?>
<!DOCTYPE html>
<html>
    <?php Template::printHead('Guitar Wars - Add Your High Score'); ?>
    <body>
        <div class="container" style="margin-top:30px">
            <div class="row">
                <div class="col-sm-12">
                    <h2>Guitar Wars - Add Your High Score</h2>
                    <?php
                    if (isset($_POST['submit'])) {
                        // Grab the score data from the POST
                        $name = $_POST['name'];
                        $score = $_POST['score'];
                        $screenshot = $_FILES['screenshot']['name'];

                        if (!empty($name) && !empty($score) && !empty($screenshot)) {
                            $target = GW_UPLOADPATH . $screenshot;
                            if (move_uploaded_file($_FILES['screenshot']['tmp_name'], $target)) {

                                // Connect to the database and insert values
                                $pdo = Database::connect('headfirst');
                                $sql = "INSERT INTO guitarwars VALUES (:id, :date, :name, :score, :screenshot)";
                                $query = $pdo->prepare($sql);
                                $query->execute(array(
                                    "id" => 0,
                                    "date" => date('Y-m-d H:i:s'),
                                    "name" => $name,
                                    "score" => $score,
                                    "screenshot" => $screenshot
                                ));

                                // Confirm success with the user
                                echo '<p>Thanks for adding your new high score!</p>';
                                echo '<p><strong>Name:</strong> ' . $name . '<br />';
                                echo '<strong>Score:</strong> ' . $score . '</p>';
                                echo '<img src="'.GW_UPLOADPATH.$screenshot.'" alt="Confirmation image" /><br />';
                                echo '<p><a href="guitarwars.php">&lt;&lt; Back to high scores</a></p>';

                                // Clear the score data to clear the form and disconnect from db
                                $name = "";
                                $score = "";
                                Database::disconnect();
                            }
                        } else {
                            echo '<p class="error">Please enter all of the information to add your high score.</p>';
                        }
                    }
                    ?>
                    <hr />
                    <form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <input type="hidden" name="MAX_FILE_SIZE" value="32768" />

                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?php if (!empty($name)) echo $name; ?>" />
                        </div>

                        <div class="form-group">
                            <label for="score">Score:</label>
                            <input type="text" class="form-control" id="score" name="score" value="<?php if (!empty($score)) echo $score; ?>" />
                        </div>

                        <div class="form-group">
                            <label for="screenshot">Image file</label>
                            <input type="file" class="form-control" id="screenshot" name="screenshot" />
                        </div>

                        <hr />
                        <input type="submit" value="Add" name="submit" />
                    </form>
                </div>
            </div>
        </div>
    </body> 
</html>
