<?php
// Show header and title
require_once 'DataBaseConnection.php';
include "static-views.php";
include "header.php";

$title = "Projects";
displayHeader($title);

// Get article from markdown
include "markdownHandler.php";
$file = "main/projects.md";
echo getMarkdown($file);

// Show the footer
include "footer.php";

setViewCount('projects', $con);
?>