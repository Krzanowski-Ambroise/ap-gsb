## Installation

1. Download the website file in `.zip` on github [Download](https://github.com/Krzanowski-Ambroise/ap-gsb/archive/refs/heads/main.zip).
2. Extract the file and send it to the set of files in the root folder of the web server.
3. Retrieve the database from the extracted document then import it into your mysql server via for example phpmyadmin [Download database](https://github.com/Krzanowski-Ambroise/ap-gsb/blob/main/gsb-cake.sql).
4. In the website folders you can go to the `config/app_local.php` folder, modify line 47/48 the database connection information and the name of the database. The security salt is not stored in the repository: set the `SECURITY_SALT` environment variable to a long random string (for example the output of `php -r "echo bin2hex(random_bytes(32));"`) for the web server and for `bin/cake`. You can also write `export SECURITY_SALT="..."` in a `config/.env` file, which git ignores (format in `config/.env.example`), and uncomment the `.env` block in `config/bootstrap.php`.
5. The site is deployed and you can now access it via the web page. The database ships with three demo accounts (`superadmin`, `client` and `comptable`) but no published password: after the import, set your own password for each one from the project root with `bin/cake users resetPassword <username> <password>`, or create a new admin with `bin/cake users addSuperuser`. The API keys stored in the dump are public too: generate new ones from each profile page.
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
