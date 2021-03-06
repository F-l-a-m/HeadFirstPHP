<!DOCTYPE html>
<html>
    <?php
    require '../template/templater.php';
    Template::printHead('Aliens Abducted Me - Report an Abduction');
    ?>
    <body>
        <div class="container" style="margin-top:30px">
            <div class="row">
                <div class="col-sm-12">
                    <h2>Aliens Abducted Me - Report an Abduction</h2>
                    <?php
                    require '../database/database.php';
                    $connection = Database::connect('aliendatabase');

                    $firstname = $_POST['firstname'];
                    $lastname = $_POST['lastname'];
                    $when_it_happened = $_POST['whenithappened'];
                    $how_long = $_POST['howlong'];
                    $how_many = $_POST['howmany'];
                    $alien_description = $_POST['aliendescription'];
                    $what_they_did = $_POST['whattheydid'];
                    $fang_spotted = $_POST['fangspotted'];
                    $email = $_POST['email'];
                    $other = $_POST['other'];

                    $sql = "INSERT INTO aliens_abduction ( "
                            . "first_name, "
                            . "last_name, "
                            . "when_it_happened, "
                            . "how_long, "
                            . "how_many, "
                            . "alien_description, "
                            . "what_they_did, "
                            . "fang_spotted, "
                            . "other, "
                            . "email) "
                            . "VALUES ("
                            . ":firstname, "
                            . ":lastname, "
                            . ":when_it_happened, "
                            . ":how_long, "
                            . ":how_many, "
                            . ":alien_description, "
                            . ":what_they_did, "
                            . ":fang_spotted, "
                            . ":other, "
                            . ":email)";
                    $query = $connection->prepare($sql);
                    $query->execute(array(
                        "firstname" => $firstname,
                        "lastname" => $lastname,
                        "when_it_happened" => $when_it_happened,
                        "how_long" => $how_long,
                        "how_many" => $how_many,
                        "alien_description" => $alien_description,
                        "what_they_did" => $what_they_did,
                        "fang_spotted" => $fang_spotted,
                        "other" => $other,
                        "email" => $email
                    ));
                    Database::disconnect();

                    echo 'Thanks for submitting the form.<br />';
                    echo 'You were abducted ' . $when_it_happened;
                    echo ' and were gone for ' . $how_long . '<br />';
                    echo 'Number of aliens: ' . $how_many . '<br />';
                    echo 'Describe them: ' . $alien_description . '<br />';
                    echo 'The aliens did this: ' . $what_they_did . '<br />';
                    echo 'Was Fang there? ' . $fang_spotted . '<br />';
                    echo 'Other comments: ' . $other . '<br />';
                    echo 'Your email address is ' . $email;
                    ?>
                    <br/><br/>
                    <button type="button" class="btn btn-primary" onclick="window.location.href = '../index.php'">Back</button>
                    
                </div>
            </div>
        </div>
        <?php Template::printFooter(); ?>
    </body>
</html>
