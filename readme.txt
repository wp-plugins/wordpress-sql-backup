=== Plugin Name ===
Contributors: alexandanthony, Adzbierajewski
Donate link: http://anthony.strangebutfunny.net/
Tags: wordpress, backup
Requires at least: 3.2.1
Tested up to: 3.2.1
Stable tag: 6.0

WP Backup is a plugin that allows you to easily preform an sql backup and and create a tar and gzipped backup of your /wp-content/ directory from within your dashboard. The plugin is very secure and only allows administrators to preform a backup.
 This plugin allows you to create a backup and download it or email it to the administrator as an attatchment. This plugin also works great and has been tested on blogs with thousands of posts.
  
 The best way to get fast support is by posting your question in a comment at http://anthony.strangebutfunny.net/my-plugins/alex-wp-backup/

== Description ==

WP Backup is a plugin that allows you to easily preform an sql backup and and create a tar and gzipped backup of your /wp-content/ directory from within your dashboard. The plugin is very secure and only allows administrators to preform a backup.
 This plugin allows you to create a backup and download it or email it to the administrator as an attatchment. This plugin also works great and has been tested on blogs with thousands of posts.
 
 The best way to get fast support is by posting your question in a comment at http://anthony.strangebutfunny.net/my-plugins/alex-wp-backup/

== Installation ==

This section describes how to install the plugin and get it working.

e.g.

1. Upload `the directory "wordpress-sql-backup"` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Go to "Backup Site" in the dashboard to backup or download the backup or email the backup to yourself

== Screenshots ==

1. Here's a screenshot of it in action

== Changelog ==

= 1.0 =
* Initial Release

= 2.0 =
* Wrong encoding bug fix

= 3.0 =
* Unable to restore backed up sql files bug fixed
* Ability to download sql file to your computer
* Ability to email the sql file to the administrator as an attatchment

= 4.0 =
* "index.php" in /alex-backups/ is now automatically created if possible

= 5.0 =
* Ability to use alternatives to "exec()" such as "passthru()" and "system()" added

= 6.0 =
* Merged with my other plugin Wordpress File Backup

== Frequently Asked Questions ==

= Is this plugin compatible with WordPress Multi Site? =

No, This plugin is NOT recommended for WordPress Multi Site websites, it allows every admin to every blog access to your backup.

= How do I tell when a backup was created? =

Usually most computers (PC, Linux and Mac) have a "date modified" feature in the file manager, that will tell you when it was downloaded to your PC, or if you chose to send it in an email, it will say in your email provider the date you recieved the message.