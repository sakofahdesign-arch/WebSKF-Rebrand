# Sakofah Website

Laravel website for Sakofah Islamic Cooperative with Blade pages and Vite-powered React components on selected homepage sections.

## Content Editing

Owner-editable media and document files are organized under:

```text
public/content/
```

The central content map is:

```text
config/site-content.php
```

Read the editing guide here:

```text
docs/CONTENT_GUIDE.md
```

It explains where to change Hero images, homepage banners, eBooks, reports, forms, branch images, logos, and related display data.

## Deployment

Read the server upload checklist here:

```text
docs/DEPLOY_FILES.md
```

Most important rule: set the web server document root to `public/`, not the project root.

## Local Commands

```bash
composer install
npm install
npm run build
php artisan serve
```

If config is changed on a server with cached config, run:

```bash
php artisan config:clear
php artisan cache:clear
```
