<div align="center">

  <img src="https://knecht.works/styleguide/favicon/favicon.svg" alt="Knecht" width="112" height="112">

# test-php

<p>
  <img src="https://img.shields.io/badge/PHP-8.3-777BB4?logo=php&logoColor=white" alt="PHP 8.3">
  <img src="https://img.shields.io/badge/DDEV-nginx--fpm-02A8E2?logo=docker&logoColor=white" alt="DDEV · nginx-fpm">
  <img src="https://img.shields.io/badge/Knecht-e2e%20fixture-b7f8a2?labelColor=09090b" alt="Knecht e2e fixture">
  <img src="https://img.shields.io/badge/license-MIT-blue" alt="MIT License">
</p>

**Booten. Fixen. Testen. Vollautomatisch.**

</div>

A minimal [DDEV](https://ddev.com) PHP project used as an end-to-end test fixture
for [Knecht](https://knecht.works). It serves a single page (`public/index.php`)
on three hostnames — a primary plus `alpha.*` and `beta.*` — so Knecht can boot
the environment, hit each host, and assert against the rendered output.

## About Knecht

[Knecht](https://knecht.works) lets AI agents work against a *running* app instead
of guessing whether their changes work. You connect a repository, Knecht boots the
project as a live environment, and agents reproduce bugs in it, fix them, and open
a finished pull request.

- **One click, whole project** — Knecht boots your DDEV setup as a complete
  environment, including web, services, and database.
- **Deterministic workflows** — flows built from reusable blocks that run the same
  way every time, triggered by hand or via webhook (e.g. a GitHub issue or Jira ticket).
- **AI agent** — with an [OpenCode](https://opencode.ai) API key, the agent
  reproduces, fixes, and tests bugs against the real, running app — no guessing.

Knecht is DDEV-native, EU-based, self-hostable, and currently **in development**
(public beta targeted for Q4 2026). This repository is one of the fixtures used
to test that Knecht can boot a project and verify its output across multiple hosts.

## What this fixture does

`public/index.php` renders a small demo page built with the Knecht Styleguide Kit.
It reports the request environment (host, PHP version, server software, protocol,
scheme, client IP, timezone, server time) and links between the primary, `alpha`,
and `beta` hostnames. The page strips a leading `alpha.`/`beta.` subdomain so the
cross-host links stay correct regardless of which hostname served the page.

## Setup

Requires [DDEV](https://ddev.readthedocs.io/en/stable/users/install/ddev-installation/)
and a Docker provider (Docker, OrbStack, or Colima).

```bash
ddev start     # boot the containers
ddev launch    # open the site in your browser
```

The project is then available at:

| Role    | URL                                |
| ------- | ---------------------------------- |
| primary | `https://test-php.ddev.site`       |
| alpha   | `https://alpha.test-php.ddev.site` |
| beta    | `https://beta.test-php.ddev.site`  |

## Project layout

| Path                       | Purpose                                            |
| -------------------------- | -------------------------------------------------- |
| `public/index.php`         | The single page served on all three hostnames      |
| `.ddev/config.yaml`        | DDEV config: PHP 8.3, nginx-fpm, `alpha`/`beta` hosts |
| `composer.json`            | Minimal Composer metadata (no dependencies)         |
| `package.json`             | Placeholder `build` script (`echo build ok`)        |

## License

Released under the [MIT License](LICENSE). © 2026 Knecht.
