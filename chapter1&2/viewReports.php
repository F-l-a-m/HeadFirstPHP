<!DOCTYPE html>
<html>
    <?php
    require '../template/templater.php';
    Template::printHead('People abducted by aliens');
    ?>
    <body>
        <h1>People abducted by aliens</h1>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">First name</th>
                    <th scope="col">Last name</th>
                    <th scope="col">When it happened</th>
                    <th scope="col">How long</th>
                    <th scope="col">How many</th>
                    <th scope="col">Alien description</th>
                    <th scope="col">What they did</th>
                    <th scope="col">Fang spotted</th>
                    <th scope="col">Other</th>
                    <th scope="col">E-mail</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require '../database/database.php';
                $connection = Database::connect('aliendatabase');
                $sql = "SELECT * FROM aliens_abduction";
                foreach ($connection->query($sql) as $row) {
                    echo '<tr>';
                    echo '<td>' . $row['first_name'] . '</td>';
                    echo '<td>' . $row['last_name'] . '</td>';
                    echo '<td>' . $row['when_it_happened'] . '</td>';
                    echo '<td>' . $row['how_long'] . '</td>';
                    echo '<td>' . $row['how_many'] . '</td>';
                    echo '<td>' . $row['alien_description'] . '</td>';
                    echo '<td>' . $row['what_they_did'] . '</td>';
                    echo '<td>' . $row['fang_spotted'] . '</td>';
                    echo '<td>' . $row['other'] . '</td>';
                    echo '<td>' . $row['email'] . '</td>';
                    echo '</tr>';
                }
                Database::disconnect();
                ?>
            </tbody>
        </table>
        <br/>
        <button type="button" class="btn btn-primary" onclick="window.location.href='../index.php'">Back</button>
        <?php Template::printFooter(); ?>
    </body>
</html>
