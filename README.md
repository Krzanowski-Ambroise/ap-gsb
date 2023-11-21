## Installation

1. Install cakephp project in your :
```bash
php composer.phar create-project --prefer-dist cakephp/app
```
2. Configure your Database [Configuration](#Configuration).
3. Install and configure [CakeDC/Users](https://github.com/CakeDC/users/blob/11.next-cake4/Docs/Documentation/Installation.md).
4. Import [Database](./ap-gsb.sql).
5. Continue your project and send me news Discord : `aambroisee`.

You can now either use your machine's webserver to view the default home page, or start
up the built-in webserver with:

```bash
bin/cake server -p 8765
```

Then visit `http://localhost:8765` to see the welcome page.

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
