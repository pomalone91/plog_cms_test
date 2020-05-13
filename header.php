<?php
function displayHeader($title) {
    echo '<!DOCTYPE html>';
    echo '<html lang="en">';
    echo '<head>';
    echo '    <title>' . $title . '</title>';
    echo '<meta name="viewport" content="width=device-width, initial-scale=1">';
    echo '    <link rel="stylesheet" type="text/css" href="style.css">';
    echo '    <link rel="icon" type="img/png" href="favicon-32x32.png">';
    echo '</head>';
    echo '<body>';
    echo '    <div class="container">';
    echo '        <div id="inner-header">';
    echo '            <h1 id="banner"><a href="index.php">Nine Circles of Shell</a></h1>';
    echo '            <ul class="nav">';
    echo '                <li class="nav-item"><a href="archive.php">archive</a></li>';
    echo '                <li class="nav-item"><a href="about.php">about</a></li>';
    echo '                <li class="nav-item"><a href="projects.php">projects</a></li>';
    echo '            </ul>';
    echo '        </div>';
    echo '        <div id="main">';
}
?>