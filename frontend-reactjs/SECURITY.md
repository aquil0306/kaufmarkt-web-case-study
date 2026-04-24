# Security Policy

## Supported Version

Security-sensitive fixes apply to the current default branch while this public case study is maintained.

| Component | Notes |
|-----------|-------|
| Node.js | 20 LTS recommended |
| Next.js | 15.x |
| React | 19.x |
| Lockfile | Review `package-lock.json` changes carefully |

## Reporting a Vulnerability

Please do **not** open a public issue for an undisclosed vulnerability.

Preferred reporting options:

1. Use GitHub private vulnerability reporting if it is enabled for this repository.
2. If private reporting is not enabled, contact the repository owner privately through GitHub before sharing details publicly.

When reporting, include:

- a short summary
- affected page or flow
- reproduction steps
- expected impact
- any suggested mitigation

## Scope Notes

This repository is a **public case study**, not the complete production system. Some private infrastructure, backend logic, and internal integrations are intentionally excluded because they are protected under NDA.

Issues that are still useful to report:

- client-side XSS or unsafe rendering
- auth or session handling weaknesses visible in this public code
- insecure redirects or origin validation issues
- accidental exposure of unsafe public configuration

## Maintainer Reminders

- Never place private keys or server-only secrets in `NEXT_PUBLIC_*` variables.
- Keep frontend dependencies up to date.
- Review public documentation before release so private implementation details are not disclosed.

Thank you for reporting issues responsibly.
