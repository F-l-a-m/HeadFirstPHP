<?php

class Template {

    public static function printHead($title) {
        echo "<head>\n";
        echo "      <title>$title</title>\n";
        echo '      <meta charset="UTF-8">' . "\n";
        echo '      <meta name="viewport" content="width=device-width, initial-scale=1.0">' . "\n";
        echo '      <link rel="stylesheet" href="../css/bootstrap.min.css" type="text/css"/>' . "\n";
        echo '      <script src="../js/bootstrap.min.js"></script>' . "\n";
        
        echo '    </head>' . "\n";
    }
    
    public static function printFooter(){
        echo '<footer class="jumbotron text-center" style="margin-bottom:0; margin-top:40px;">';
        echo '<p>&copy; Andrew, 2018</p>';
        echo '</footer>';
    }
}
