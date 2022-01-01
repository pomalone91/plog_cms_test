<?php
// Make connection to database.
require_once 'DataBaseConnection.php';

// Show header and title
include "header.php";
include "static-views.php";
include "article_viewed.php";

$title = "About";
displayHeader($title);

// Get article from markdown
include "markdownHandler.php";
$aboutFile = "main/about.md";
echo getMarkdown($aboutFile);

// Show the footer
include "footer.php";

// Get view count from table
setViewCount('about', $con);
articleViewed(19, $con);
?>