<?php
require_once '../database/database.php';
require_once '../template/templater.php';
require_once 'appvars.php';

function validate($name, $type, $size) {
    $errors = [];
    if (empty($name)) {
        array_push($errors, 'File must not be empty.');
    }
    if (!(($type == 'image/gif') 
            || ($type == 'image/jpeg') 
            || ($type == 'image/pjpeg') 
            || ($type == 'image/png'))) {
        array_push($errors, 'Unsupported file type. Please use jpeg, gif or png file types.');
    }
    if ($size > GW_MAXFILESIZE) {
        array_push($errors, 'File size should be less than 32KB.');
    }
    return $errors;
}
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
                        $userName = $_POST['name'];
                        $userScore = $_POST['score'];
                        $screenshot_name = $_FILES['screenshot']['name'];
                        $screenshot_type = $_FILES['screenshot']['type'];
                        $screenshot_size = $_FILES['screenshot']['size'];

                        $validationErrors = validate($screenshot_name, $screenshot_type, $screenshot_size);

                        if (!empty($validationErrors)) {
                            foreach ($validationErrors as $error) {
                                echo '<p class="error">' . $error . '</p>';
                            }
                        } else if ($_FILES['screenshot']['error'] == 0){
                            $target = GW_UPLOADPATH . $screenshot_name;
                            if (move_uploaded_file($_FILES['screenshot']['tmp_name'], $target)) {

                                // Connect to the database and insert values
                                $pdo = Database::connect('headfirst');
                                $sql = "INSERT INTO guitarwars VALUES (:id, :date, :name, :score, :screenshot)";
                                $query = $pdo->prepare($sql);
                                $query->execute(array(
                                    "id" => 0,
                                    "date" => date('Y-m-d H:i:s'),
                                    "name" => $userName,
                                    "score" => $userScore,
                                    "screenshot" => $screenshot_name
                                ));

                                // Confirm success with the user
                                echo '<p>Thanks for adding your new high score!</p>';
                                echo '<p><strong>Name:</strong> ' . $userName . '<br />';
                                echo '<strong>Score:</strong> ' . $userScore . '</p>';
                                echo '<img src="' . GW_UPLOADPATH . $screenshot_name . '" alt="Confirmation image" /><br />';
                                echo '<p><a href="guitarwars.php">&lt;&lt; Back to high scores</a></p>';

                                // Clear the score data to clear the form and disconnect from db
                                $userName = "";
                                $userScore = "";
                                Database::disconnect();
                                @unlink($_FILES['screenshot']['tmp_name']);
                            }
                        }
                    }
                    ?>
                    <hr />
                    <form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?php if (!empty($userName)) echo $userName; ?>" />
                        </div>

                        <div class="form-group">
                            <label for="score">Score:</label>
                            <input type="text" class="form-control" id="score" name="score" value="<?php if (!empty($userScore)) echo $userScore; ?>" />
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
        <?php Template::printFooter(); ?>
    </body> 
</html>
