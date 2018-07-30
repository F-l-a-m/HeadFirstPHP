<!DOCTYPE html>
<html>
    <?php
    require '../template/templater.php';
    Template::printHead('Delete email from mailing list');
    ?>
    <body>
        <div class="container" style="margin-top:30px">
            <div class="row">
                <div class="col-sm-12">
                    <h1>Delete email from mailing list</h1>
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <?php
                        $dbc = mysqli_connect('127.0.0.1', 'root', 'root', 'elvis_store')
                                or die('Error conncting to MySQL server');

                        if (isset($_POST['submit']) && isset($_POST['todelete'])) {
                            foreach ($_POST['todelete'] as $delete_id) {
                                $query = "DELETE FROM email_list WHERE id = $delete_id";
                                mysqli_query($dbc, $query)
                                        or die('Error while making database query');
                            }
                            echo "Customer(s) successfully deleted from mailing list<br />";
                        }

                        $query = "SELECT * FROM email_list";
                        $result = mysqli_query($dbc, $query);
                        while ($row = mysqli_fetch_array($result)) {
                            echo '<input type="checkbox" value="' . $row['id'] . '" name="todelete[]" />';
                            echo ' ' . $row['first_name'];
                            echo ' ' . $row['last_name'];
                            echo ' ' . $row['email'];
                            echo '<br />';
                        }
                        mysqli_close($dbc);
                        ?>
                        <button type="button" class="btn btn-primary" onclick="window.location.href = '../index.php'">Back</button>
                        <input type="submit" class="btn btn-primary" name="submit" value="Delete"/>
                    </form>
                </div>
            </div>
        </div>
        <?php Template::printFooter(); ?>
    </body>
</html>

