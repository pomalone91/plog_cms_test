<?php
// Show header and title
include "header.php";
$title = "About";
displayHeader($title);

// Get article from markdown
include "markdownHandler.php";
$aboutFile = "main/about.md";
echo getMarkdown($aboutFile);

// Show the footer
include "footer.php";
?>