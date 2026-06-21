# Uraca Realty Backend Setup

## Local Database
1. Start Apache/PHP and MySQL in XAMPP.
2. Create the database:
   `CREATE DATABASE IF NOT EXISTS uraca_realty_backend CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;`
3. Import `database/schema.sql` into `uraca_realty_backend`.
4. Confirm `config/config.php` matches the database credentials.
5. Seed the current listings:
   `C:\xampp\php\php.exe database\seed_from_json.php`

For an existing installation, apply the four-category property taxonomy upgrade once after deploying the new code:
`C:\xampp\php\php.exe database\migrate_property_taxonomy.php`

The taxonomy migration is idempotent and can be rerun safely. It adds the structured sale/rent purpose, remaps existing listings, unpublishes the former construction packages, and creates the Construction & Design-Build CMS service.

To enable optional property video tours on an existing installation, run:
`C:\xampp\php\php.exe database\migrate_property_video.php`

To link listing-specific inquiries to properties in the CMS inbox, run:
`C:\xampp\php\php.exe database\migrate_inquiry_sources.php`

## Admin Login
- URL: `/admin/login.php`
- Seeded email: `admin@uracarealtyph.com`
- The seed script generates a password when `URACA_ADMIN_PASSWORD` is not provided.
- Set `URACA_ADMIN_PASSWORD` before production seeding, then rotate the password after first login.

## Deployment Notes
- Keep `config/`, `database/`, `data/`, `storage/`, and `uploads/` protected from script execution or direct browsing.
- Public page entrypoints are PHP-only. Do not deploy root `.html` page files; old `.html` URLs are handled by root `.htaccess` 301 redirects.
- Do not restore `js/property-data.js` or `js/property-pages.js`; listing data should come from MySQL.
- Admin-managed website content lives in the CMS tables added to `database/schema.sql`. Re-importing the schema is additive because the CMS tables use `CREATE TABLE IF NOT EXISTS`.
- Run `C:\xampp\php\php.exe database\seed_from_json.php` after schema updates to populate listing data and default CMS content for site settings, pages, services, testimonials, and featured listings.
