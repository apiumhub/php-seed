to execute phing:
-----------------
* ./composer.phar install
* ./vendor/phing/phing/bin/phing (integrated in idea, plugin phing, as well)
* install (or enable) yaml extension

for integration testing
-----------------------
* create database seed_db and seed_db_test
* execute: set dateformat ydm
** advice: use sqlcmd -U <username> -P <password>
   is much more lightweight than SSMS
   use "go" to separate sql sentences
