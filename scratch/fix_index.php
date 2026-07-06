<?php
$file = 'c:\xampp\htdocs\advertresources\admin\index.php';
$content = file_get_contents($file);

$marker1 = "    } catch (Exception \$e) {\n        \$error = \"Delete failed: \" . \$e->getMessage();\n    }\n}\n";
$marker2 = "// Fetch all database records";

$pos1 = strpos($content, $marker1);
if ($pos1 !== false) {
    $pos1 += strlen($marker1);
    $pos2 = strpos($content, $marker2, $pos1);
    
    if ($pos2 !== false) {
        $part1 = substr($content, 0, $pos1);
        $part2 = substr($content, $pos2);
        
        $new_content = $part1 . "\n" . $part2;
        
        // Remove $edit_career = null; block inside try/catch
        $edit_career_pattern = '/\s*\$edit_career = null;\s*if \(isset\(\$_GET\[\'edit_career\'\]\)\).*?\$edit_career = \$stmt->fetch\(PDO::FETCH_ASSOC\);\s*\}/s';
        $new_content = preg_replace($edit_career_pattern, '', $new_content);
        
        // Remove $edit_career = null from catch block
        $new_content = str_replace('$edit_career = null;', '', $new_content);
        
        file_put_contents($file, $new_content);
        echo "index.php fixed successfully.\n";
    } else {
        echo "Marker 2 not found.\n";
    }
} else {
    echo "Marker 1 not found.\n";
}
?>
