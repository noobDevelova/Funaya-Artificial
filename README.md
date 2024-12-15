# CodeIgniter 4 Application Starter

## What is CodeIgniter?

CodeIgniter is a PHP full-stack web framework that is light, fast, flexible and secure.
More information can be found at the [official site](https://codeigniter.com).

This repository holds a composer-installable app starter.
It has been built from the
[development repository](https://github.com/codeigniter4/CodeIgniter4).

More information about the plans for version 4 can be found in [CodeIgniter 4](https://forum.codeigniter.com/forumdisplay.php?fid=28) on the forums.

You can read the [user guide](https://codeigniter.com/user_guide/)
corresponding to the latest version of the framework.

## Installation & updates

`composer create-project codeigniter4/appstarter` then `composer update` whenever
there is a new release of the framework.

When updating, check the release notes to see if there are any changes you might need to apply
to your `app` folder. The affected files can be copied or merged from
`vendor/codeigniter4/framework/app`.

## Setup

Copy `env` to `.env` and tailor for your app, specifically the baseURL
and any database settings.

## Important Change with index.php

`index.php` is no longer in the root of the project! It has been moved inside the *public* folder,
for better security and separation of components.

This means that you should configure your web server to "point" to your project's *public* folder, and
not to the project root. A better practice would be to configure a virtual host to point there. A poor practice would be to point your web server to the project root and expect to enter *public/...*, as the rest of your logic and the
framework are exposed.

**Please** read the user guide for a better explanation of how CI4 works!

## Repository Management

We use GitHub issues, in our main repository, to track **BUGS** and to track approved **DEVELOPMENT** work packages.
We use our [forum](http://forum.codeigniter.com) to provide SUPPORT and to discuss
FEATURE REQUESTS.

This repository is a "distribution" one, built by our release preparation script.
Problems with it can be raised on our forum, or as issues in the main repository.

## Server Requirements

PHP version 8.1 or higher is required, with the following extensions installed:

- [intl](http://php.net/manual/en/intl.requirements.php)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)

> [!WARNING]
> - The end of life date for PHP 7.4 was November 28, 2022.
> - The end of life date for PHP 8.0 was November 26, 2023.
> - If you are still using PHP 7.4 or 8.0, you should upgrade immediately.
> - The end of life date for PHP 8.1 will be December 31, 2025.

Additionally, make sure that the following extensions are enabled in your PHP:

- json (enabled by default - don't turn it off)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php) if you plan to use MySQL
- [libcurl](http://php.net/manual/en/curl.requirements.php) if you plan to use the HTTP\CURLRequest library

```
funaya-artificial
├─ .gitattributes
├─ .github
│  └─ workflows
│     └─ close-pull-request.yml
├─ .gitignore
├─ app
│  ├─ .htaccess
│  ├─ Common.php
│  ├─ Config
│  │  ├─ App.php
│  │  ├─ Autoload.php
│  │  ├─ Boot
│  │  │  ├─ development.php
│  │  │  ├─ production.php
│  │  │  └─ testing.php
│  │  ├─ Cache.php
│  │  ├─ Constants.php
│  │  ├─ ContentSecurityPolicy.php
│  │  ├─ Cookie.php
│  │  ├─ Cors.php
│  │  ├─ CURLRequest.php
│  │  ├─ Database.php
│  │  ├─ DocTypes.php
│  │  ├─ Email.php
│  │  ├─ Encryption.php
│  │  ├─ Events.php
│  │  ├─ Exceptions.php
│  │  ├─ Feature.php
│  │  ├─ Filters.php
│  │  ├─ ForeignCharacters.php
│  │  ├─ Format.php
│  │  ├─ Generators.php
│  │  ├─ Honeypot.php
│  │  ├─ Images.php
│  │  ├─ Kint.php
│  │  ├─ Logger.php
│  │  ├─ Migrations.php
│  │  ├─ Mimes.php
│  │  ├─ Modules.php
│  │  ├─ Optimize.php
│  │  ├─ Pager.php
│  │  ├─ Paths.php
│  │  ├─ Publisher.php
│  │  ├─ Routes.php
│  │  ├─ Routing.php
│  │  ├─ Security.php
│  │  ├─ Services.php
│  │  ├─ Session.php
│  │  ├─ Toolbar.php
│  │  ├─ UserAgents.php
│  │  ├─ Validation.php
│  │  └─ View.php
│  ├─ Controllers
│  │  ├─ Admin
│  │  │  └─ DashboardController.php
│  │  ├─ Auth
│  │  │  ├─ Admin
│  │  │  │  └─ AuthController.php
│  │  │  └─ Customer
│  │  ├─ BaseController.php
│  │  ├─ Customer
│  │  └─ Home.php
│  ├─ Core
│  │  ├─ Adapters
│  │  │  └─ EnvAdapter.php
│  │  └─ Domains
│  │     └─ Auth
│  │        ├─ Entities
│  │        ├─ Repositories
│  │        │  └─ Mapper
│  │        └─ Usecases
│  ├─ Database
│  │  ├─ Migrations
│  │  │  └─ .gitkeep
│  │  └─ Seeds
│  │     └─ .gitkeep
│  ├─ Filters
│  │  └─ .gitkeep
│  ├─ Helpers
│  │  └─ .gitkeep
│  ├─ index.html
│  ├─ Language
│  │  ├─ .gitkeep
│  │  └─ en
│  │     └─ Validation.php
│  ├─ Libraries
│  │  └─ .gitkeep
│  ├─ Models
│  │  └─ .gitkeep
│  ├─ ThirdParty
│  │  └─ .gitkeep
│  └─ Views
│     ├─ admin
│     │  ├─ auth
│     │  │  └─ login.php
│     │  ├─ dashboard
│     │  │  └─ index.php
│     │  └─ layout
│     │     ├─ main.php
│     │     ├─ navbar.php
│     │     └─ sidebar.php
│     ├─ customer
│     │  └─ home
│     ├─ errors
│     │  ├─ cli
│     │  │  ├─ error_404.php
│     │  │  ├─ error_exception.php
│     │  │  └─ production.php
│     │  └─ html
│     │     ├─ debug.css
│     │     ├─ debug.js
│     │     ├─ error_404.php
│     │     ├─ error_exception.php
│     │     └─ production.php
│     └─ welcome_message.php
├─ builds
├─ composer.json
├─ composer.lock
├─ LICENSE
├─ package-lock.json
├─ package.json
├─ preload.php
├─ public
│  ├─ .htaccess
│  ├─ assets
│  │  ├─ css
│  │  │  ├─ tailwind.css
│  │  │  └─ tailwind.output.css
│  │  ├─ img
│  │  │  ├─ create-account-office-dark.jpeg
│  │  │  ├─ create-account-office.jpeg
│  │  │  ├─ dashboard.png
│  │  │  ├─ forgot-password-office-dark.jpeg
│  │  │  ├─ forgot-password-office.jpeg
│  │  │  ├─ github.svg
│  │  │  ├─ login-office-dark.jpeg
│  │  │  ├─ login-office.jpeg
│  │  │  └─ twitter.svg
│  │  └─ js
│  │     ├─ charts-bars.js
│  │     ├─ charts-lines.js
│  │     ├─ charts-pie.js
│  │     ├─ focus-trap.js
│  │     └─ init-alpine.js
│  ├─ favicon.ico
│  ├─ index.php
│  └─ robots.txt
├─ README.md
├─ spark
├─ tailwind.config.js
├─ tests
│  ├─ .htaccess
│  ├─ database
│  │  └─ ExampleDatabaseTest.php
│  ├─ index.html
│  ├─ README.md
│  ├─ session
│  │  └─ ExampleSessionTest.php
│  ├─ unit
│  │  └─ HealthTest.php
│  └─ _support
│     ├─ Database
│     │  ├─ Migrations
│     │  │  └─ 2020-02-22-222222_example_migration.php
│     │  └─ Seeds
│     │     └─ ExampleSeeder.php
│     ├─ Libraries
│     │  └─ ConfigReader.php
│     └─ Models
│        └─ ExampleModel.php
└─ writable
   ├─ .htaccess
   └─ index.html

```