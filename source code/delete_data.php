<?php
// مسیر فایل userinfo.txt که باید حذف شود
$file = 'userinfo.txt';

if (file_exists($file)) {
    if (unlink($file)) {
        echo "File deleted successfully.";
    } else {
        echo "Error deleting the file.";
    }
} else {
    echo "File does not exist.";
}
?>
