<!DOCTYPE html>
<?php
require '../template/templater.php';
Template::printHead('Make Me Elvis - Send Email');
?>
<body>
    <div class="container" style="margin-top:30px">
        <div class="row">
            <div class="col-sm-12">
                <img src="../img/blankface.jpg" width="161" height="350" alt=""/>
                <img name="elvislogo" src="../img/elvislogo.gif" width="229" height="32" border="0" alt="Make Me Elvis" />
                <h1><strong>Private:</strong> For Elmer's use ONLY</h1>
                <h2>Write and send an email to mailing list members.</h2>

                <?php
                if (isset($_POST['submit'])) {
                    $from = 'andrew.flam@gmail.com';
                    $subject = $_POST['subject'];
                    $text = $_POST['elvismail'];
                    $output_form = false;

                    if (empty($subject) || empty($text)) {
                        echo '<strong>! You forgot the email subject or body text.</strong><br />';
                        $output_form = true;
                    }
                } else {
                    $output_form = true;
                }

                if ((!empty($subject)) && (!empty($text))) {
                    $dbc = mysqli_connect('127.0.0.1', 'root', 'root', 'elvis_store')
                            or die('Error connecting to MySQL server.');

                    $query = "SELECT * FROM email_list";
                    $result = mysqli_query($dbc, $query)
                            or die('Error querying database.');

                    while ($row = mysqli_fetch_array($result)) {
                        $to = $row['email'];
                        $first_name = $row['first_name'];
                        $last_name = $row['last_name'];
                        $msg = "Dear $first_name $last_name,\n$text";
                        mail($to, $subject, $msg, 'From:' . $from);
                        echo 'Email sent to: ' . $to . '<br />';
                    }

                    mysqli_close($dbc);
                }

                if ($output_form) {
                    ?>

                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <div class="form-group">
                            <label for="subject">Subject of email:</label><br />
                            <input id="subject" class="form-control" name="subject" type="text" <?php 
                                    if (isset($_POST['submit'])) {
                                        echo 'value="' . $subject . '"';
                                    }
                                   ?>/>
                        </div>
                        <div class="form-group">
                            <label for="elvismail">Body of email:</label><br />
                            <textarea id="elvismail" class="form-control" name="elvismail" rows="8"><?php
                            if (isset($_POST['submit'])) { 
                                echo $text;
                            }
                            ?></textarea>
                        </div>
                        <button type="button" class="btn btn-primary" onclick="window.location.href = '../index.php'">Back</button>
                        <input type="submit" class="btn btn-primary" name="submit" value="Submit" />
                    </form>

                    <?php
                }
                ?>
            </div>
        </div>
    </div>
    <?php Template::printFooter(); ?>
</body>
</html>
