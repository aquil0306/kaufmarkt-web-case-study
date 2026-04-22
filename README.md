# Kaufmarkt Web - Public Case Study

Client-facing marketplace web application built with **Next.js** for browsing listings, publishing ads, managing profiles, handling subscriptions, and supporting SEO-friendly public pages.

> [!IMPORTANT]
> This repository is a **public case study**, not the full production project.
> Some modules, integrations, internal architecture, deployment details, and business logic are intentionally omitted or simplified because the complete implementation is covered by client NDA.

## Overview

This case study showcases the frontend architecture and product experience for a marketplace platform with:

- listing discovery and detail pages
- seller profiles and favourites
- subscription and payment flows
- chat and notifications
- CMS-driven pages and SEO metadata
- multilingual routing behavior

The app consumes a Laravel-based JSON API, but the backend source and full production setup are not included in this public repository.

## My Role

- Built the customer web application in **Next.js**
- Integrated the frontend with backend APIs using **Axios**
- Implemented multilingual request handling and canonical `lang` behavior
- Worked on payment UX and third-party client integrations
- Delivered SEO-focused pages, metadata, and sitemap-related logic

## Public Repository Scope

Included in this repo:

- representative frontend structure
- selected pages and flows
- API integration patterns
- reusable UI and client-side utilities
- documentation for review and portfolio presentation

Not included in this repo:

- full production backend
- sensitive business rules
- private services and credentials
- client-specific infrastructure and deployment configuration
- all internal modules from the original product

For a short summary of the public-release boundaries, see [`NOTICE.md`](NOTICE.md).

## Tech Stack

**React 19**, **Next.js 15**, **JavaScript**, **Tailwind CSS**, **Redux Toolkit**, **Axios**, **Firebase**, **Stripe**, **Leaflet**, **Google Maps**, **Radix UI**, **ESLint**, and a custom production `server.js`.

## Selected Features

- **Marketplace browsing** with category-driven listing flows
- **Listing detail pages** with SEO-friendly URLs
- **Profile and account flows** for end users
- **Favourites, notifications, and chat-related UX**
- **Subscription and payment flow integration**
- **CMS-driven pages** such as policies, FAQs, and blogs
- **Language-aware routing** using middleware

## Challenges and Solutions

| Challenge | Approach |
|-----------|----------|
| Dynamic marketplace data with SEO requirements | Built metadata and page behavior around API-driven content and public URLs |
| Language consistency across sessions and links | Added middleware to keep `lang` query and cookie behavior aligned |
| Third-party integrations in a public frontend | Kept browser-safe configuration in env-based client setup and left sensitive logic to the backend |
| Marketplace UX across many page types | Reused shared API patterns and common UI behavior across listings, seller pages, and account flows |

## Screenshots and Demo

This repository is intended for portfolio and client review, so screenshots are strongly recommended.

Suggested additions:

1. Add anonymized screenshots to `docs/screenshots/`
2. Include at least one desktop and one mobile flow
3. Optionally link an unlisted walkthrough video

Example:

```markdown
![Home](docs/screenshots/01-home.png)
![Listing detail](docs/screenshots/02-detail.png)
![Subscription flow](docs/screenshots/03-subscription.png)
```

## Running Locally

Requirements:

- Node.js 20 LTS recommended
- npm
- compatible API environment for local testing

Common environment variables used by the public frontend include:
`NEXT_PUBLIC_API_URL`, `NEXT_PUBLIC_END_POINT`, `NEXT_PUBLIC_WEB_URL`, `NEXT_PUBLIC_DEFAULT_LANG_CODE`, `NEXT_PUBLIC_SUPPORTED_LANGS_CODE`, `NEXT_PUBLIC_SEO`, `NEXT_PUBLIC_META_*`, Firebase `NEXT_PUBLIC_*` values, and `NODE_PORT`.

```bash
npm install
npm run dev
```

## Security

Security guidance for this public repository is documented in [`SECURITY.md`](SECURITY.md).

## Usage Notice

This repository is shared as a **case study only**. It is not a complete product handoff or a drop-in commercial distribution. Please review [`NOTICE.md`](NOTICE.md) before reusing any part of this repository.
