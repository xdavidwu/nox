# nox

Taiwan air pollution data consolidation website

## Environment Setup

### Requirements

* PHP environment with composer
* Nodejs with npm
* A database backend for Laravel

### Setup

Check [Laravel documentation](https://laravel.com/docs/7.x) for detailed instruction. The following describe a simplified flow and what is needed in addition to basic Laravel setup.

Install php and nodejs packages:

```
composer install
npm install
```

Run `npm run dev` or `npm run prod` to build the frontend, depending on whether you want to develop or run a production instance.

Like other Laravel projects, create `.env` using `.env.example` as a template.

For production instance, you can provide a link to your souce code with `SOURCE_URL` in `.env`.

A database is required. Other components are not used as for now.

Run `php artisan db:seed --class StationSeeder` to download station info.

Run `php artisan db:seed --class MonthlyValueSeeder` to download monthly value data. This would take a few minutes.

Be sure to run `StationSeeder` before `MonthlyValueSeeder`.

Setup a web server or use `php artisan serve` for one suitable for development only.

### Grafana setup

We use Grafana for data visualization with charts. `.env.example` provides link to our Grafana instance and is suitable if you want to develop. For production, we recommend running your own Grafana instance.

The dashboard use the same data as other part in this project, and can be run under the same database, better with another user with less permission. We use mariadb for our instance.

The database user for Grafana should have only SELECT permission to the database.

Grafana dashboard definition is provided in `grafana/nox.json`.

Observe the panel url format from `Share > Embed` with `Current time range` disabled in a panel. The `from`, `to` parameters should be removed. Remove the value of `panelId` and be sure that it is the last parameter. The code for embedding the panel will append value to it. See the value in `.env.example` for what it should look like.

If your panel ids differ from ours, update the mapping in `app/Consts.php`.

### Updating data

The monthly value data can be updated using `MonthlyValueSeeder`, with an environment variable specifing the month to begins with. For example:

```
env UPDATE_MONTH_FROM=202005 php artisan db:seed --class=MonthlyValueSeeder
```

This updates value starting from May of 2020. If you do not specify the month to start with, it will act as an initial import and download all data available. If `auto`, the starting month will be one month before last month with data.

## License

MIT

For licenses of data, files, libraries directly used by this project, check out the menu in the upper right corner of any page by this project. You can also check `resources/views/layouts/main.blade.php` in source form.
