## Installation

1. Download the website file in .zip on github [Download](https://github.com/Krzanowski-Ambroise/ap-gsb/blob/main/ap-gsb-release.zip).
2. Extract the file and send it to the set of files in the root folder of the web server.
3. Retrieve the database from the extracted document then import it into your mysql server via for example phpmyadmin[Download](https://github.com/Krzanowski-Ambroise/ap-gsb/blob/main/gsb-cake.sql).
4. In the website folders you can go to the config/app_local.php folder, modify line 47/48 the database connection information and the name of the database.
5. The site is deployed and you can now access it via the web page. Admin username: superadmin, password: a593959e53d24c5b9f9094b4c4974b3e
## Update

Since this skeleton is a starting point for your application and various files
would have been modified as per your needs, there isn't a way to provide
automated upgrades, so you have to do any updates manually.

## Configuration

Read and edit the environment specific `config/app_local.php` and set up the
`'Datasources'` and any other configuration relevant for your application.
Other environment agnostic settings can be changed in `config/app.php`.

## Layout

The app skeleton uses [Milligram](https://milligram.io/) (v1.3) minimalist CSS
framework by default. You can, however, replace it with any other library or
custom styles.
