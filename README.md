# Kaufmarkt Marketplace - Public Case Study

Public GitHub case study for a marketplace platform covering a **customer-facing web app** and a **Laravel-based backend/admin system**.

> [!IMPORTANT]
> This repository is a **sample code release**, not the complete production codebase.
> Parts of the original project have been intentionally removed, simplified, or anonymized because the full implementation is protected by client NDA and internal confidentiality requirements.
> A **full code review and architecture walkthrough are available on call**.

## Overview

This case study represents work on a classifieds / marketplace product designed to support:

- listing discovery and detail pages
- seller and account management flows
- subscriptions and payment journeys
- notifications, chat, and engagement features
- multilingual content and SEO-friendly routing
- admin operations, catalog management, moderation, and API delivery

The goal of this public repository is to show **engineering approach, architecture direction, and representative implementation quality** without exposing confidential client assets or sensitive business logic.

## Repository Structure

### `frontend-reactjs/`

Public-facing marketplace application built with **Next.js** and modern React tooling.

Highlights include:

- listing and seller experience
- account-related flows
- API integration patterns
- language-aware routing and SEO behavior
- reusable utilities and frontend architecture

See [`frontend-reactjs/README.md`](frontend-reactjs/README.md) for frontend details.

### `backend-laravel/`

Laravel application powering backend APIs, administration workflows, and operational tooling.

Highlights include:

- authenticated API architecture
- admin and moderation capabilities
- payment gateway integrations
- notifications, settings, and content management
- marketplace business operations support

See [`backend-laravel/README.md`](backend-laravel/README.md) for backend details.

## What This Repository Demonstrates

- Full-stack marketplace product thinking across frontend and backend surfaces
- Real-world integration work with APIs, payments, notifications, and configuration-heavy systems
- Attention to maintainability, modular structure, and production-oriented concerns
- The ability to prepare client work for **public professional presentation** while respecting confidentiality boundaries

## What Was Removed for Public Release

To make this project safe to share publicly, the repository excludes or sanitizes parts of the original production system, including:

- NDA-protected business logic
- client-specific integrations and operational details
- private infrastructure and deployment configuration
- credentials, secrets, and environment-specific setup
- selected internal modules, workflows, and proprietary implementation details
- any code or assets that could expose sensitive product, client, or operational information

Because of these removals, this repository should be reviewed as a **representative case study**, not as a complete production handoff.

## Why It Works As a Case Study

This repository is intentionally structured to help reviewers quickly understand:

- the product domain
- the technical stack
- the scope of the delivered work
- the complexity handled across customer and operator experiences
- the separation between public sample code and confidential production work

That makes it suitable for:

- GitHub portfolio presentation
- client review
- hiring discussions
- architecture and implementation walkthroughs

## Review Notes

If you are reviewing this repository publicly, the best way to read it is:

1. Start with this root overview
2. Review the frontend and backend README files
3. Explore selected implementation areas in each app
4. Use a live conversation for the non-public parts of the system

## Full Review Availability

The complete project contains additional private implementation details that are not appropriate for public distribution.

If needed, I can provide on-call coverage for:

- full architecture review
- private code walkthrough
- implementation tradeoff discussion
- system design and delivery context

## Tech Snapshot

Representative technologies used across the project include **Next.js**, **React**, **Laravel**, **PHP**, **JavaScript**, **Tailwind CSS**, **Axios**, **Laravel Sanctum**, payment provider integrations, and supporting notification / infrastructure services.

## Public Repository Positioning

This repository is best described on GitHub as:

> Public case study for a full-stack marketplace platform. Sample code only: selected frontend and backend work shared publicly, with sensitive production details removed under NDA. Full code review available on call.
