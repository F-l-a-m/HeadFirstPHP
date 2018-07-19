<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Abducted by aliens table</title>
    </head>
    <body>
        <h1>Abducted by aliens table</h1>
        <table border="1">
            <thead>
                <tr>
                    <th>First name</th>
                    <th>Last name</th>
                    <th>When it happened</th>
                    <th>How long</th>
                    <th>How many</th>
                    <th>Alien description</th>
                    <th>What they did</th>
                    <th>Fang spotted</th>
                    <th>Other</th>
                    <th>E-mail</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require '../database/database.php';
                $connection = Database::connect();
                $sql = "SELECT * FROM aliens_abduction";
                //$query = $connection->prepare($sql);
                //$query->execute(array());
                //$data = $query->fetch(PDO::FETCH_ASSOC);
                
                
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
    </body>
</html>
