# 06 - PHP + Laravel (Deployment Practice Target)

A tiny **Laravel 11** web app that exposes 3 endpoints. It does almost nothing on
purpose - your job isn't to build it, it's to **ship it**: Dockerize it, run it
with a database, put it through CI/CD, and deploy it to Kubernetes on AWS.

> Like every project in this folder, this app is a **black box** you treat as
> someone else's code. Answer the 7 questions below, then run the same universal
> recipe you used for TaskBoard.

---

## ⚠️ Read this first: the framework is NOT shipped here

Laravel needs its framework code (the `vendor/` folder) installed by **Composer**.
We deliberately do **not** ship `vendor/` - it's huge, machine-generated, and
belongs in `.gitignore`. What you get here are the **custom files a student adds
on top of a fresh Laravel**:

```
composer.json                              # requires php ^8.2 + laravel/framework ^11
routes/web.php                             # the 3 endpoints, wired to the controller
app/Http/Controllers/ItemController.php    # the endpoint logic
.env.example                               # config template (APP_KEY, APP_PORT, DB_*)
.gitignore                                 # ignores /vendor, /node_modules, .env, logs
```

To get a runnable app you install the framework with Composer (see **Run it locally**).
This is exactly how real Laravel projects work - code is committed, `vendor/` is built.

---

## ## The 7 DevOps Questions

| # | Question | Answer for this app |
|---|---|---|
| 1 | **Language / runtime?** | PHP 8.2 + Composer (Laravel 11 framework) |
| 2 | **How do you build it?** | `composer install` (production: `composer install --no-dev --optimize-autoloader`) |
| 3 | **What's the artifact?** | The app source **plus** the installed `vendor/` folder, served by **php-fpm + nginx** (or `php artisan serve`) |
| 4 | **Start command?** | Dev: `php artisan serve --host 0.0.0.0 --port 8000` - Prod: run **php-fpm** behind nginx |
| 5 | **Which port?** | `8000` (set by `APP_PORT`); php-fpm itself listens on `9000` behind nginx |
| 6 | **Config / secrets?** | Environment variables via `.env` (`APP_KEY`, `APP_PORT`, `DB_*`) - never hardcode |
| 7 | **Health check URL?** | `GET /health` -> `{"status":"ok"}` |

---

## ## Run it locally

You need **PHP 8.2+** and **Composer** installed. Pick ONE option.

### Option A - Fresh scaffold, then copy these files in (recommended, fastest)

```bash
# 1. Scaffold a brand-new Laravel app somewhere
composer create-project laravel/laravel myapp
cd myapp

# 2. Copy THIS project's custom files over the scaffold
#    (adjust the source path to wherever you cloned this repo)
cp /path/to/06-php-laravel/routes/web.php                       routes/web.php
cp /path/to/06-php-laravel/app/Http/Controllers/ItemController.php app/Http/Controllers/ItemController.php
cp /path/to/06-php-laravel/.env.example                         .env.example

# 3. Configure + run
cp .env.example .env
php artisan key:generate
php artisan serve --host 0.0.0.0 --port 8000
```

`composer create-project` already runs `key:generate` for you, but the copy steps
reset `.env`, so generate the key again as shown.

### Option B - You have a full Laravel skeleton in this folder

If you (or a later step) drop a complete Laravel skeleton here so this folder is a
full app, then:

```bash
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate
php artisan serve --host 0.0.0.0 --port 8000
```

### Verify all 3 endpoints

```bash
curl http://localhost:8000/
curl http://localhost:8000/health
curl http://localhost:8000/api/items
```

Expected output:

```jsonc
// GET /
{"app":"DevOps Practice Target","stack":"PHP 8.2 + Laravel 11","message":"Welcome! Dockerize and deploy me. Try /health and /api/items."}

// GET /health
{"status":"ok"}

// GET /api/items
[{"id":1,"name":"Containerize me","done":false},{"id":2,"name":"Add a database with Compose","done":false},{"id":3,"name":"Build a CI/CD pipeline","done":false},{"id":4,"name":"Ship to Kubernetes on AWS","done":false}]
```

---

## ## Your Practice Mission

The app works. Now **ship it.** Nothing below is included - building it **is** the
practice. Open the matching TaskBoard module if you get stuck; the pattern transfers.

- [ ] **Dockerize it (M14)** - build a `Dockerfile` using **php-fpm + nginx** (multi-stage: `composer install --no-dev`, then a runtime image). `EXPOSE 8000`, `HEALTHCHECK` hitting `/health`.
- [ ] **Compose + MySQL (M15)** - write `docker-compose.yml` with the app + a **MySQL** service; switch the `DB_*` env vars to MySQL.
- [ ] **CI/CD with Jenkins (M17)** - a `Jenkinsfile`: build -> test -> build image -> deploy.
- [ ] **VM with Vagrant (M13)** - a `Vagrantfile` to run it on a VirtualBox VM.
- [ ] **Provision with Ansible (M16)** - a playbook to install PHP/nginx and deploy the app.
- [ ] **Kubernetes (M18 / M19)** - `Deployment` + `Service` + `Ingress`; use `/health` for liveness/readiness probes; scale it.
- [ ] **AWS + Terraform (M20 / M21)** - run it live on AWS (EC2/RDS), then make Terraform build the whole thing, with HTTPS.

> 🚫 **On purpose:** no `Dockerfile`, no `Jenkinsfile`, no `docker-compose.yml`, no
> `k8s/` YAML, no Terraform here. That's your job - and your portfolio.
