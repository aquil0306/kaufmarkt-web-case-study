# Kaufmart Web — Case study

Customer-facing **marketplace web app**: browse and publish classified listings, manage profile and favourites, subscribe to plans, chat with sellers, and read CMS-driven content—all backed by a **Laravel JSON API** ([Kaufmarkt Admin](../kaufmarkt-admin)).

---

## 1. Project overview

**Problem solved:** Buyers and sellers need a **fast, searchable storefront** that works on mobile and desktop, supports **subscriptions and payments**, and stays **SEO-friendly** (shareable listing URLs, sitemaps, metadata) while the business runs catalog rules and copy from the server. Building that only in a legacy admin UI is not enough; you need a **modern web client** that consumes the same APIs as mobile.

This app solves that by implementing a **Next.js (App Router) storefront**: server-aware metadata and sitemaps, client-side listing UX (infinite scroll, filters), Redux for session-like UI state, and integrations (Stripe, Firebase, maps) aligned with API-delivered settings.

---

## 2. Your role

- **Full-stack developer** with emphasis on **frontend architecture** and **API integration**.
- **Built the customer web app** in Next.js: listing discovery, detail pages, seller profiles, favourites, profile, notifications, blogs, policies, and subscription flows.
- **Consumed backend APIs** via Axios with shared interceptors (language headers, base URL from env).
- **Implemented i18n routing behavior** with middleware so `lang` is always canonical for the API and SEO.
- **Handled payments UX** (e.g. Stripe publishable keys from settings, postMessage origin checks against the API host).
- **Shipped SEO layer**: conditional metadata generation, dynamic sitemap fed by API slugs, Open Graph–friendly canonical URLs.

*(Tune wording to first person for your portfolio if you prefer.)*

---

## 3. Tech stack

**React 19**, **Next.js 15** (App Router), **JavaScript**, **Tailwind CSS**, **Radix UI**, **Redux Toolkit**, **redux-persist**, **Axios**, **Firebase**, **Stripe** (`@stripe/react-stripe-js`), **Leaflet** / **react-leaflet**, **Google Maps** (`@react-google-maps/api`), **Embla Carousel**, **Sonner**, **Node.js**, **ESLint**, **Turbopack** (dev), custom **Node `server.js`** for production.

---

## 4. Key features

- **Authentication & session UX** — Login/signup flows against API; protected routes for profile, my ads, chat, subscriptions.
- **Payments** — Subscription checkout with Stripe; payment modal; origin validation for embedded / postMessage flows.
- **Dashboard-style hubs** — Profile, my listings, transactions, notifications, user verification, job applications.
- **Marketplace core** — Home, category-driven listing grids, ad detail by slug, edit listing, seller pages, favourites.
- **Content** — Blogs (list + slug), FAQs, landing page, about/contact/legal pages driven by API SEO settings.
- **Maps & location** — Google Places / map components and Leaflet where the product requires maps.
- **Push / realtime** — Firebase client wiring for messaging-related features (configure via env + API).
- **Internationalization** — Supported languages, default language, cookie + query alignment via middleware.

---

## 5. Screenshots / Demo

**Treat this as mandatory for a public case study**—it is the fastest way to show product sense, UI polish, and scope.

**What to add**

1. Add images under e.g. `docs/screenshots/` in this repo.
2. Use **realistic but anonymized** data (blur emails/phones/addresses).
3. Capture **mobile width** and **desktop** for at least one flow.

**Suggested shots**

| # | Screen | Why it helps |
|---|--------|----------------|
| 1 | Home + categories | Shows information architecture |
| 2 | Listing grid / filters | Search UX, performance-sensitive UI |
| 3 | Listing detail + gallery | Trust, media handling |
| 4 | Subscription / Stripe step | Commercial complexity |
| 5 | Chat or notifications | Engagement features |

**Example markdown after you add files**

```markdown
![Home](docs/screenshots/01-home.png)
![Listing browse](docs/screenshots/02-ads.png)
![Listing detail](docs/screenshots/03-detail.png)
```

| Asset | Link / path |
|-------|----------------|
| Screenshot folder | `docs/screenshots/` *(add your images)* |
| Video walkthrough | *Paste Loom / YouTube URL — walk through search → detail → favourite in under 2 minutes* |

---

## 6. Challenges + solutions

| Challenge | Solution |
|-----------|-----------|
| **SEO vs. highly dynamic data** | Server-side metadata and sitemap generation tied to API slugs; `NEXT_PUBLIC_SEO` flag to simplify non-indexed environments; revalidation window from env for cache discipline. |
| **Language in every request** | Middleware rewrites/redirects so a valid `lang` query is always present; cookie sync so refreshes and shared links stay consistent with backend translations. |
| **Payments in a separate origin** | postMessage checks against `NEXT_PUBLIC_API_URL`; Stripe keys loaded from API settings where possible instead of duplicating secrets in the browser bundle. |
| **Images from API/CDN hosts** | `next.config.mjs` `remotePatterns` updated for your production hostname (replace demo hosts before go-live). |
| **Production vs. dev servers** | Custom `server.js` for port binding and `/.well-known` static files; reverse-proxy docs in deployment scripts (`install.sh` as a reference for PM2/Linux). |

---

## 7. Live demo

| Type | URL |
|------|-----|
| **Live site** | *Staging or production URL (read-only or demo login).* |
| **Backend dependency** | Same deployment or README as [Kaufmarkt Admin](../kaufmarkt-admin); CORS must allow this site’s origin. |

If you have **no public URL**, combine **Section 5** (4–6 sharp screenshots) + **one unlisted video**—that alone strongly supports hiring and client conversations.

---

### Appendix: Environment & run locally

**Requirements:** Node 20 LTS recommended, npm, running Laravel API with CORS for this origin.

Copy env from your template. Commonly used variables include: `NEXT_PUBLIC_API_URL`, `NEXT_PUBLIC_END_POINT` (e.g. `/api/`), `NEXT_PUBLIC_WEB_URL`, `NEXT_PUBLIC_DEFAULT_LANG_CODE`, `NEXT_PUBLIC_SUPPORTED_LANGS_CODE`, `NEXT_PUBLIC_SEO`, `NEXT_PUBLIC_META_*`, Firebase `NEXT_PUBLIC_*` keys, `NEXT_PUBLIC_DEFAULT_COUNTRY`, `NODE_PORT`. *(Exact names appear in `middleware.js`, `api/AxiosInterceptors.jsx`, and `utils/Firebase.js`.)*

```bash
cd kaufmart-web
npm install
npm run dev          # Turbopack dev server
# npm run build && npm start   # production
```

---

### License

This codebase sits in a classifieds / **eClassify**-style ecosystem; confirm original template or vendor licensing before redistribution.
