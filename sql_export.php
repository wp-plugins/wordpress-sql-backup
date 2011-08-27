<?php
$filename_numbers = md5(rand(0,100) . rand(0,100) . rand(0,100) . rand(0,100) . rand(0,100) . rand(0,100) . rand(0,100) . rand(0,100) . rand(0,100) . rand(0,100));
$filename = "/" . $filename_numbers . ".sql";
$fh = fopen(get_option('alex_backup_filename'), 'w') or die("can't open file, are you sure I have permission to open the file?");
fclose($fh);
unlink(get_option('alex_backup_filename'));
update_option('alex_backup_filename', WP_CONTENT_DIR . '/alex-backups/' . $filename);
update_option('alex_backup_urlpath', get_bloginfo('wpurl') . '/wp-content' . '/alex-backups' . $filename);


$backupfile = WP_CONTENT_DIR . '/alex-backups/' . $filename;

exec("mysqldump --opt -h" . DB_HOST . " -u" . DB_USER . " -p" . DB_PASSWORD . " " . DB_NAME . " > " . $backupfile . "");
echo "The backup was completed sucessfully!<br />";
?>