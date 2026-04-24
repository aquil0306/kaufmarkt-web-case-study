# Security policy

## Supported versions

Security updates are expected only for the **actively maintained branch** (typically `main` / default).

| Component        | Version / notes                          |
|-----------------|-------------------------------------------|
| PHP             | 8.1+ as declared in `composer.json`     |
| Laravel         | 10.x as declared in `composer.json`     |
| Dependency tree | `composer.lock` should be committed and updated deliberately |

Older major versions or forks are **not** guaranteed to receive fixes unless you maintain them yourself.

## Reporting a vulnerability

**Please do not open a public GitHub issue** for undisclosed security problems (that can put users at risk).

Preferred options (use whichever applies to your fork):

1. **GitHub** — If [Private vulnerability reporting](https://docs.github.com/en/code-security/security-advisories/guidance-on-reporting-and-writing-information-about-vulnerabilities/privately-reporting-a-security-vulnerability) is enabled on this repository, use **Security → Report a vulnerability**.
2. **Email** — Send details to: **`[YOUR-SECURITY-EMAIL@DOMAIN]`** (replace with your real contact before publishing the repo).

Include:

- A short description of the issue and its impact  
- Steps to reproduce (or proof-of-concept) if safe to share  
- Affected versions / commits if known  
- Whether you would like public credit after a fix is released  

We aim to acknowledge reports within a **few business days**; timelines for fixes depend on severity and capacity.

## Scope

**In scope**

- This application’s own code under this repository (e.g. controllers, routes, auth, file handling, admin actions).  
- Misconfiguration guidance when it leads to a concrete exploit path (e.g. exposed `.env`, world-writable uploads).

**Out of scope**

- Third-party vendor or template licensing disputes.  
- Social engineering of maintainers or hosting providers.  
- Denial-of-service requiring very large traffic (report separately if you have a specific resource exhaustion bug).  
- Issues in dependencies without a practical exploit through **this** app (still welcome as **dependency update** suggestions via PR or issue if already public).

## Secure development reminders

- Never commit `.env`, production database dumps, or live API keys.  
- Before exposing this admin app to the internet, review `routes/web.php` for **debug / migrate / one-click** routes and remove or protect them.  
- Run production with HTTPS, strict cookie settings, and up-to-date PHP and extensions.

Thank you for helping keep users and operators safe.
