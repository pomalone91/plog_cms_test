<?php
// Parse the markdown from a file
function getMarkdown($fileName) {
    $shellCommand = "perl Markdown.pl --html4tags " . $fileName;
    $output = shell_exec($shellCommand);
    return $output;
}

// Get current directory path
// $old_path = getcwd();
// $output = shell_exec('perl Markdown.pl --html4tags test.md');
// echo $output;

// Echo a string to markdown.pl to parse it without passing a file.
function parseMarkdown($string) {
    $shellCommand = "echo \"". $string . "\" | perl Markdown.pl --html4tags ";
    $output = shell_exec($shellCommand);
    return $output;
}
?>