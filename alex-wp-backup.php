<?php
/*
Plugin Name: WordPress SQL Backup
Plugin URI: http://anthony.strangebutfunny.net/my-plugins/alex-wp-backup/
Description: WordPress Backup allows you to create an sql backup of your WordPress database
Version: 5.0
Author: Alex and Anthony
Author URI: http://www.strangebutfunny.net/
license: GPL 
*/
add_option( 'alex_backup_filename', 'nothing' );
add_option( 'alex_backup_urlpath', 'nothing' );
add_option( 'alex_backup_whattouse', 'nothing' );
add_action('admin_notices', 'alex_backup_admin_notices');
function alex_backup_admin_notices() {
	$backup_options = get_option('dbmanager_options');
	if(!@file_exists(WP_CONTENT_DIR . '/alex-backups/' . 'index.php')) {
		echo '<div class="error" style="text-align: center;"><p style="color: red; font-size: 14px; font-weight: bold;">'.__('The folder /wp-content/alex-backups/ is visible to the public!', 'wp-postratings').'</p><p>'.sprintf(__('To fix this, create an empty file called <strong>index.php</strong> in the directory <strong>wp-content/alex-backups</strong>', 'wp-postratings')).'</p></div>';
	}
	if(get_option("alex_backup_whattouse")=="nothing"){
	echo '<div class="error" style="text-align: center;"><p style="color: red; font-size: 14px; font-weight: bold;">'.__('The settings for WordPress SQL Backup are empty!', 'wp-postratings').'</p><p>'.sprintf(__('To fix this, Go to "Backup Site" in the administration menu and select an option in the "Settings" area then click "Save Changes"', 'wp-postratings')).'</p></div>';

		}
}

	if(!@file_exists(WP_CONTENT_DIR . '/alex-backups/')) {
mkdir(WP_CONTENT_DIR . "/alex-backups");
	}
	if(!@file_exists(WP_CONTENT_DIR . '/alex-backups/index.php')) {
if (!copy(WP_CONTENT_DIR . "/plugins/wordpress-sql-backup/index.php", WP_CONTENT_DIR . "/alex-backups/index.php")) {
    echo "failed to write file '" . WP_CONTENT_DIR . "/alex-backups/index.php" / "' in '" . WP_CONTENT_DIR . "/alex-backups/" . "'";
}
	}
function alex_plugin_menu() {
	add_menu_page('Backup Site', 'Backup Site', 'manage_options', 'alex_wp_backup', 'alex_plugin_options'); 
}

function alex_plugin_options() {
	if (!current_user_can('manage_options'))  {
		wp_die( __('You do not have sufficient permissions to access this page.') );
	}
	echo '<div class="wrap">';
	echo "<h2><a class='submit' href=admin.php?page=alex_wp_backup&action=backup>Generate Backup</a></h2>";
	
	if(isset($_REQUEST["action"])){
	if($_REQUEST["action"]=="backup"){
			require("sql_export.php");
echo "What do you want to do?<br />";
echo "<h3><a href='" . get_option('alex_backup_urlpath') . "'>Directly download the backup file</a></h3>";
echo "<h3><a href='admin.php?page=alex_wp_backup&action=email_to_admin'>Email this backup to the administrator's email as an attachment</a></h3>";
	}
	if($_REQUEST["action"]=="email_to_admin"){
	
	wp_mail(get_option('admin_email'),'Alex Wordpress Backup', "Here's your backup","" ,get_option("alex_backup_filename"));
	echo "There!, I sent the backup as an attachment to your email The attached backup file should look something like 4958e2917dbf36ea53b46c6b954917e9.sql Have fun!";
	}
	}
	echo "<h2>Settings:</h2>";
	echo '<form name="wordpress_sql_backup_config" action="" method="post" />';
	echo 'Current setting: ' . get_option('alex_backup_whattouse') . '<br />';
	if($_REQUEST["whattouse"]){
	update_option('alex_backup_whattouse', $_REQUEST["whattouse"]);
	echo '<h2>Settings Updated!</h2>';
	}
			if(function_exists('passthru')) {
				echo '<font color="green"><span dir="ltr">passthru() is enabled.</span></font><br />';
				echo 'Use passthru? <input type="radio" name="whattouse" value="passthru"><br />';
			} else {
				echo '<font color="red"><span dir="ltr">passthru() is disabled and cant be used.</span></font><br />';
			}
			if(function_exists('system')) {
				echo '<font color="green"><span dir="ltr">system() is enabled</span></font><br />';
				echo 'Use System? <input type="radio" name="whattouse" value="system"><br />';
			} else {
				echo '<font color="red"><span dir="ltr">system() is disabled and cant be used.</span>font><br />';
			}
			if(function_exists('exec')) {
				echo '<font color="green"><span dir="ltr">exec() is enabled</span></font><br />';
				echo 'Use exec? <input type="radio" name="whattouse" value="exec"><br />';
			} else {
				echo '<font color="red"><span dir="ltr">exec() is disabled and cant be used.</span></font>';
			}
			echo '<input type="submit" value="Save Changes" />';
			echo '</form>';
	echo "<br /><p>Please visit my site <a href=http://www.strangebutfunny.net/>http://www.strangebutfunny.net</a></p>";
	echo '</div>';
}
add_action('admin_menu', 'alex_plugin_menu');
?>