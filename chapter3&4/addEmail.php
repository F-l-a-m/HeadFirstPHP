<!DOCTYPE html>
<html>
    <?php
    require '../template/templater.php';
    Template::printHead('Add email');
    ?>
    <body>
        <div class="container" style="margin-top:30px">
            <div class="row">
                <div class="col-sm-12">
                    <h1>Add email</h1>
                    <?php
                    include '../database/database.php';

                    $firstname = $_POST['firstname'];
                    $lastname = $_POST['lastname'];
                    $email = $_POST['email'];

                    $connection = Database::connect('elvis_store');
                    $sql = "INSERT INTO email_list (first_name, last_name, email)" .
                            "VALUES (:firstname, :lastname, :email)";
                    $query = $connection->prepare($sql);
                    $query->execute(array(
                        "firstname" => $firstname,
                        "lastname" => $lastname,
                        "email" => $email
                    ));
                    Database::disconnect();
                    echo 'Successfully added to database<br />';
                    echo "First name: $firstname<br/>";
                    echo "Last name: $lastname<br/>";
                    echo "E-mail: $email";
                    ?>
                    <button type="button" class="btn btn-primary" onclick="window.location.href = '../index.php'">Back</button>
                </div>
            </div>
        </div>
        <?php Template::printFooter(); ?>
    </body>
</html>
