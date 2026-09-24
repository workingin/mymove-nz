# MyMoveNZ Portal

Member portal for **MyMoveNZ / Working In**, a New Zealand immigration and relocation
consultancy. Clients log in to read CMS-driven guidance, download templates and
generate a Letter of Support PDF signed by their Licensed Immigration Adviser (LIA).
Staff manage users, content and activity logs through the admin panel.

Production: `https://portal.mymove.nz` (cPanel, PHP 8.1, MySQL).

## Tech stack

- Plain PHP 8.1 (no framework), PDO + MySQL
- Server-rendered pages, jQuery, Tailwind-based theme in `dist/`
- [mPDF](https://mpdf.github.io/) (bundled in `htpd/vendor/`) and FPDF (`fpdf.php`) for PDFs
- PHPMailer and the Brevo HTTP API for email
- Apache with `.htaccess` (forces HTTPS)

## Project structure

```
index.php              Login page (admins are redirected to admin/)
main.php               Member portal: CMS sections (welcome, forms, FAQs, testimonials, …)
settlement.php         Settlement guide: accommodation, banking, healthcare, tax, transport, …
teacher.php            Teacher pathway: curriculum, job search, documents, benefits, Māori culture
register.php           Self-registration
forgotpass.php         Password reset
useredit.php, userinfo.php   Profile pages
header.view.php, footer.view.php, main.view.php, …   Shared page templates

admin/                 Admin panel (users, groups, CMS categories/posts, logs, uploads, settings)
  includes/            Core library — controller.php bootstraps every page (see below)
  config/              Database class
  upload/              Company document uploads (uploads/ is git-ignored)
  install___22/        Original installer and schema dump — do not expose publicly

htpd/                  Letter of Support PDF generator (mPDF). Requires a logged-in user
                       with access to the requested visa type.
supportportal/         Separate multi-step onboarding/support form with its own admin
                       (supportportal/admin/) and email tooling (supportportal/email/)
app/                   Bootstrap for supportportal: env loader, autoloader, helpers
classes/               Classes used by app/ (DB, Users, Settings, Countries, Logs)
class/                 Legacy PHPMailer copy
geoip/                 IP geolocation helper
downloads/             CV / cover letter templates and PDFs offered to members
assets/, dist/, css/, js/, img/, mediabox/   Front-end assets
```

## How a request is bootstrapped

There are two bootstraps:

1. **Main portal and admin** — pages start with
   `include("admin/includes/controller.php")`. It loads `.env` via
   `admin/includes/constants.php` → `app/env.php`, autoloads classes from
   `admin/includes/`, and creates `$db`, `$session`, `$configs`, `$functions`,
   `$logger` and `$adminfunctions`. Timezone is `Pacific/Auckland`.
   Protected pages check `$session->logged_in` and redirect to `/index.php`.
2. **Support portal** — pages `require 'app/start.php'`, which loads `.env`,
   autoloads from `classes/`, and creates `$db`, `$settings` and `$U` (Users).

User levels (`admin/includes/constants.php`): 10 super admin, 9 admin,
3 registered user, 2 awaiting admin activation, 1 awaiting email activation, 0 guest.

Portal page views are logged to `log_table` (user, `section`, timestamp, IP) and
reported in `admin/logs_report.php`.

## Local setup (Laragon on Windows)

1. Place the project in `D:\laragon\www\mymovenz` and start Laragon (Apache + MySQL, PHP 8.1+).
2. Create a database and import the schema from a production dump
   (or `admin/install___22/db_dump.sql` for the base schema).
3. Create `.env` in the project root:

   ```ini
   PROJECT_MODE=development
   TIMEZONE=Pacific/Auckland

   DB_TYPE=mysql
   DB_HOST=localhost
   DB_USER=root
   DB_PASS=
   DB_NAME=mymovenz

   SUPPORTPORTAL_ADMIN_USERNAME=
   SUPPORTPORTAL_ADMIN_PASS=
   BREVO_API_KEY=
   ```

4. Browse to `http://mymovenz.test` (or `http://localhost/mymovenz`).
   The root `.htaccess` redirects to HTTPS, so enable SSL in Laragon or comment
   out the redirect locally (don't commit that change).

## Configuration

| Key | Used by | Purpose |
|-----|---------|---------|
| `PROJECT_MODE` | `app/start.php` | `development` shows all errors; anything else hides them. |
| `TIMEZONE` | `app/start.php` | Support portal timezone (main portal is hard-coded to `Pacific/Auckland`). |
| `DB_*` | both bootstraps | MySQL connection. |
| `SUPPORTPORTAL_ADMIN_USERNAME` / `_PASS` | `supportportal/admin` | Support portal admin login. |
| `BREVO_API_KEY` | `admin/includes/brevoMailer.php` | Brevo (Sendinblue) transactional email API key. |

`.env`, `php.ini`, `.user.ini`, logs, SQL dumps and uploaded files are git-ignored.
The `php.ini`/`.user.ini` values (200 MB uploads, 256 MB memory) are managed in
cPanel's MultiPHP INI Editor on the server.

## Deployment

The site is hosted on cPanel. Upload changed files to the account's web root, keep
the server's own `.env` and PHP INI files, and don't upload `admin/upload/uploads/`,
`admin/img/` or local backups.

## Known issues / housekeeping

- Several queries in `admin/includes/controller.php` interpolate values into SQL;
  convert them to prepared-statement parameters.
- Backup and test files live alongside live code (`*backup*.php`, `*old*.php`,
  `logsbk-*.php`, `tst.php`, `testemail.php`, `testphp.php`, `get-started_____.php`).
  They are publicly reachable and should be removed or moved out of the web root.
- `admin/install___22/` contains an installer and a DB dump and should not be deployed.
