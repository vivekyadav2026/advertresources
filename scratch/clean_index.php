<?php
$file = 'c:\xampp\htdocs\advertresources\admin\index.php';
$content = file_get_contents($file);

// 1. Get the PHP part (everything before <!DOCTYPE html>)
$html_start = strpos($content, '<!DOCTYPE html>');
$php_part = substr($content, 0, $html_start);

// Clean the PHP part (remove Careers processing blocks 4, 5, 6)
$php_part = preg_replace('/\/\/ 4\. Process Add\/Edit Career Job.*?try \{/s', "try {\n", $php_part);

// 2. Get the Main HTML sections
$dash_start = strpos($content, '<!-- SECTION 1: DASHBOARD INDEX -->');
$script_start = strpos($content, '<script>');

if ($dash_start === false || $script_start === false) {
    die("Failed to find main HTML markers.");
}

$main_html = substr($content, $dash_start, $script_start - $dash_start);

// Strip SECTION 3 (Careers) completely
// The simplest way is to match from <!-- SECTION 3: MANAGE CAREERS --> up to the end of its enclosing div
$main_html = preg_replace('/<!-- SECTION 3: MANAGE CAREERS -->.*?<!-- FORM VIEW -->.*?<\/div>\s*<\/div>\s*<\/div>/s', '', $main_html);

// 3. Get the script block
$script_end = strpos($content, '</body>');
$script_block = substr($content, $script_start, $script_end - $script_start);

// Remove career-specific JS
$script_block = preg_replace('/function showCareerList\(\) \{.*?\}/s', '', $script_block);
$script_block = preg_replace('/function showCareerForm\(\) \{.*?\}/s', '', $script_block);
$script_block = preg_replace('/function editCareer\(job\) \{.*?\}/s', '', $script_block);

// 4. Assemble the final file
$final = rtrim($php_part) . "\n<?php require_once 'includes/header.php'; ?>\n\n" . trim($main_html) . "\n\n" . trim($script_block) . "\n\n<?php require_once 'includes/footer.php'; ?>\n";

file_put_contents($file, $final);
echo "index.php cleaned successfully.\n";
?>
