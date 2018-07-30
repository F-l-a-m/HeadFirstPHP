<!DOCTYPE html>
<html>
    <?php
    require '../template/templater.php';
    Template::printHead('Mailing list');
    ?>
    <body>
        <div class="container" style="margin-top:30px">
            <div class="row">
                <div class="col-sm-12">
                    <h1>Mailing list</h1>
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">First name</th>
                                <th scope="col">Last name</th>
                                <th scope="col">E-mail</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require '../database/database.php';
                            $connection = Database::connect('elvis_store');
                            $sql = "SELECT * FROM email_list";

                            foreach ($connection->query($sql) as $row) {
                                echo '<tr>';
                                echo '<td>' . $row['first_name'] . '</td>';
                                echo '<td>' . $row['last_name'] . '</td>';
                                echo '<td>' . $row['email'] . '</td>';
                                echo '</tr>';
                            }
                            Database::disconnect();
                            ?>
                        </tbody>
                    </table>
                    <br/>
                    <button type="button" class="btn btn-primary" onclick="window.location.href = '../index.php'">Back</button>
                </div>
            </div>
        </div>
        <?php Template::printFooter(); ?>
    </body>
</html>
