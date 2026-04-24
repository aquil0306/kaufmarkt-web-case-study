# Kaufmarkt Admin — Case study

Backend and operator console for a **classifieds / marketplace** platform: one Laravel app powers the **admin dashboard**, **REST APIs** for web and mobile clients, and **payment webhooks** from several providers.

---

## 1. Project overview

**Problem solved:** Running a multi-sided marketplace means operators need a single place to **curate the catalog** (categories, custom fields), **moderate listings and sellers**, **sell subscription packages**, and **wire up payments, notifications, and storage** without redeploying client apps. Mobile and web clients also need a **stable, authenticated API** for listings, chat, verification, and checkout.

This project addresses that by delivering a **Laravel admin + Sanctum API** with deep settings for gateways, Firebase, SEO, languages, and regions—so the business can scale catalog and policy rules from the server, not from scattered spreadsheets or one-off scripts.

---

## 2. Your role

- **Full-stack developer** (backend-heavy): owned server-side behavior end-to-end for admin workflows and public/client APIs.
- **Built backend APIs** under Laravel Sanctum for auth, listings, favourites, packages, payments, chat, verification, jobs, and notifications (`routes/api.php`, `/api` prefix).
- **Implemented admin features**: categories (including bulk import/update and ordering), custom fields, advertisement moderation, seller verification, staff/roles, blogs, FAQs, places, packages, transactions, and system settings.
- **Integrated third-party services**: Stripe, PayPal, Razorpay, Paystack, Flutterwave, PhonePe, Paytabs, Twilio, Firebase (FCM), S3-compatible storage, and related **webhook + return URL** handling.
- **Shipped operator UX** with Blade + Bootstrap + Vite (charts where needed) so non-developers can run day-to-day operations.

*(Edit this section in the first person if you prefer: “I designed…”, “I shipped…”.)*

---

## 3. Tech stack

**PHP**, **Laravel 10**, **MySQL**, **Laravel Sanctum**, **Laravel UI**, **Blade**, **Bootstrap**, **Vite**, **Vue** (Vite plugin), **Highcharts**, **Composer**, **Node/npm**, **Spatie Laravel Permission**, **Spatie Image**, **Doctrine DBAL**, **Guzzle**, **PhpSpreadsheet**, **Swagger PHP**, **AWS S3** (Flysystem), **Stripe / PayPal / Razorpay / Paystack / Flutterwave / PhonePe / Paytabs** SDKs, **Twilio**, **Google APIs / Firebase**, **Redis** (optional, typical in production).

---

## 4. Key features

- **Authentication & authorization** — Session-based admin login; API tokens via Sanctum; staff roles and permissions.
- **Payments** — Multiple gateways, webhook endpoints, success/cancel callbacks, payment transaction views, bank-transfer approval flows.
- **Dashboard & operations** — Home/overview, settings hub (system, Firebase, payments, languages, SEO, web, notifications), error logs, optional installer flow.
- **Catalog** — Nested categories, reordering, bulk upload/update, per-category custom fields.
- **Listings (“advertisements”)** — CRUD, approval / bulk approval, featured items, deep links for sharing.
- **Trust & safety** — Seller verification fields and requests, review reports, user reports, report reasons.
- **Engagement** — Admin chat (FCM token registration), push-oriented notification settings, sliders, featured sections.
- **Content & locale** — Blog, FAQ, tips, multilingual JSON resources, country/state/city/area management with translations.
- **Monetization** — Subscription packages, user packages, payment transaction reporting.

---

## 5. Screenshots / Demo

**This section matters most on GitHub**—many viewers never clone the repo; screenshots and a short demo prove you shipped real software.

**What to add**

1. Create a folder in this repo, e.g. `docs/screenshots/`, and drop **PNG or WebP** images (keep each file under ~500KB when possible).
2. Uncomment or paste the markdown below and **point `src` at your files**.

**Suggested shots**

| # | Screen | Why it helps |
|---|--------|----------------|
| 1 | Login / admin home | First impression, “real product” |
| 2 | Category tree or bulk upload | Shows complexity you handled |
| 3 | Listing moderation / approval | Trust & safety angle |
| 4 | Payment gateway settings | Integrations credibility |
| 5 | API or Sanctum-related settings (sanitized) | Technical depth without exposing secrets |

**Example (replace filenames after you add assets)**

```markdown
![Admin dashboard](docs/screenshots/01-dashboard.png)
![Categories & custom fields](docs/screenshots/02-catalog.png)
![Listing moderation](docs/screenshots/03-moderation.png)
```

**Optional:** 60–90s **screen recording** (Loom, YouTube unlisted) walking through login → approve listing → open payment settings (blur keys). Link it in the table below.

| Asset | Link / path |
|-------|----------------|
| Screenshot folder | `docs/screenshots/` *(add your images)* |
| Video walkthrough | *Paste Loom / YouTube URL here* |

---

## 6. Challenges + solutions

| Challenge | Solution |
|-----------|-----------|
| **One backend, many clients** (admin Blade UI + Next/mobile on the same API) | Clear split: `routes/web.php` for operators, `routes/api.php` with Sanctum; consistent JSON contracts and CORS aligned with `APP_URL` and client origins. |
| **Many payment providers, one order flow** | Dedicated webhook routes per provider, shared success/cancel handlers where possible, configuration stored in admin settings instead of hardcoding keys in clients. |
| **Rich catalog without fragile one-off scripts** | Category adjacency patterns, bulk Excel import/export, custom fields bound to categories so listings stay structured. |
| **Trust (verification, reports)** | Separate modules for seller verification, review reports, and user reports so moderation scales with volume. |
| **Operational risk** | Log viewer, system status, settings for storage and Firebase; **before production**, remove or lock down any convenience web routes (e.g. migrate helpers) and never commit `.env` or database dumps. |

---

## 7. Live demo

**Credibility tip:** A read-only demo or short video often beats a private repo.

| Type | URL |
|------|-----|
| **Live admin** | *Add your staging URL here (use a demo account, not production).* |
| **API base (read-only)** | *Optional: public health or docs URL if you expose Swagger safely.* |
| **Companion storefront** | Pair with [Kaufmart Web](../kaufmart-web) if both are in your portfolio. |

If you cannot host a live admin, **prioritize Section 5** (screenshots + 90s video)—that still builds strong trust.

---

### Appendix: Run locally (developers)

**Requirements:** PHP 8.1+ (`curl`, `openssl`, `zip`, PDO MySQL, etc.), Composer, Node 18+, MySQL/MariaDB.

```bash
cd kaufmarkt-admin
composer install
# Create `.env` with DB and app settings, then:
php artisan key:generate
php artisan migrate
npm install && npm run dev    # Vite
php artisan serve
```

Document root in production should be `public/`. API routes are registered with the `/api` prefix. See `routes/api.php` and `routes/web.php` for details.

---

### GitHub: description, website, topics

Set these under **Settings → General** (or the repo **⚙ About** gear on GitHub) so the profile looks complete. Adjust URLs to your real demo or portfolio.

| Field | Suggested value |
|--------|------------------|
| **Description** | Laravel 10 admin + Sanctum API for a classifieds marketplace: catalog, moderation, packages, multi-gateway payments, Firebase/Twilio integrations. |
| **Website** | Your live demo, docs site, or portfolio case-study URL |
| **Topics** | `laravel`, `php`, `mysql`, `rest-api`, `sanctum`, `marketplace`, `classifieds`, `admin-panel`, `vite`, `bootstrap` |

**Security:** This repo includes [`SECURITY.md`](SECURITY.md). On GitHub enable **Settings → Security → Private vulnerability reporting** so reports stay off the public issue tracker.

---

### License

Composer metadata references **MIT** for the base Laravel skeleton; third-party packages and any commercial template licensing follow their own terms—confirm before redistributing.
