<!DOCTYPE html>
<html>
    <?php
    include 'template/templater.php';
    Template::printHead('Home page');
    ?>
    <body>
        <div class="container" style="margin-top:30px">
            <div class="row">
                <div class="col-sm-12">
                    <h1>My "Head First PHP" book code</h1>
                    <h2>Chapter 1 & 2</h2>
                    <ul>
                        <li><a href="chapter1&amp;2/report.html">Report an abduction</a></li>
                        <li><a href="chapter1&amp;2/viewReports.php">View reports</a></li>
                    </ul>
                    <h2>Chapter 3</h2>
                    <ul>
                        <li><a href="chapter3/addEmail.html">Add email's</a></li>
                        <li><a href="chapter3/listEmails.php">List email's</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <?php Template::printFooter(); ?>
    </body>
</html>
