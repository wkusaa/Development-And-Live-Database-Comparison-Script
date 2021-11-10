# Development-And-Live-Database-Comparison-Script

- Table_Column_Cross_Checker is a PHP MYSQL Database Table Column comparison script that will check the difference of columns between 2 different DBs.
- The common use case for this is to compare the live DB and the test DB to check and see if there's any missing columns between the two.

## Installation
- Clone this project in whatever directory you want.

## Prerequisite
- Make sure to have PHP install in your system beforehand.
- Edit the php.ini and enable the mysqli extension. Sauce: https://stackoverflow.com/questions/54500881/how-do-i-enable-mysqli-for-my-php-script/54501457

## Config
- Go into the Table_Column_Cross_Checker folder you just installed.
- Edit the cross_checker.json for the DBs you want to cross check

## Run Script
- Run this is your favourite terminal
```sh
cd "[your_directory]\Table_Column_Cross_Checker"
php db_cross_check.php
```

Enjoy! o(=´∇｀=)o
