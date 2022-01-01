<?php
// Show header and title
require_once 'DataBaseConnection.php';
include "static-views.php";
include "header.php";
include "article_viewed.php";

$title = "Resume";
displayHeader($title);

// Get article from markdown
include "markdownHandler.php";
$file = "main/resume.md";
echo getMarkdown($file);

// Show the footer
include "footer.php";

setViewCount('resume', $con);
articleViewed(21, $con);
?>