<?php
/*
Plugin Name: WordPress SQL Backup
Plugin URI: http://anthony.strangebutfunny.net/my-plugins/alex-wp-backup/
Description: WordPress Backup allows you to create an sql backup of your WordPress database
Version: 1.0
Author: Alex and Anthony Zbierajewski
Author URI: http://www.strangebutfunny.net/
license: GPL 
*/

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
			
	//Connect to DB the old fashioned way and get the names of the tables on the server
	$cnx = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die(mysql_error());
	mysql_select_db(DB_NAME, $cnx) or die(mysql_error());
	$sql = "SHOW TABLES FROM " . DB_NAME;
$tables = mysql_query($sql);
	//Create a list of tables to be exported
	$table_list = array();
	while($t = mysql_fetch_array($tables))
	{
		array_push($table_list, $t[0]);
	}

	//Instantiate the SQL_Export class

	$e = new SQL_Export(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, $table_list);
	//Run the export
	echo "<p>Here's your entire wordpress database in sql form, if anything goes wrong simply drop your existing tables and run this as an sql query.</p>";
echo "<textarea rows=20 cols=100>";
	echo $e->export();
echo "</textarea>";
	//Clean up the joint
	mysql_close($e->cnx);
	mysql_close($cnx);
	}
	}
	echo "<br /><p>Please visit my site <a href=http://www.strangebutfunny.net/>http://www.strangebutfunny.net</a></p>";
	echo '</div>';
}
add_action('admin_menu', 'alex_plugin_menu');

?>