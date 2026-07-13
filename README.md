<div align="center">

  <img src="https://knecht.works/styleguide/favicon/favicon.svg" alt="Knecht" width="112" height="112">

# test-php

<p>
  <img src="https://img.shields.io/badge/PHP-8.3-777BB4?logo=php&logoColor=white" alt="PHP 8.3">
  <img src="https://img.shields.io/badge/DDEV-nginx--fpm-02A8E2?logo=docker&logoColor=white" alt="DDEV · nginx-fpm">
  <img src="https://img.shields.io/badge/Knecht-e2e%20fixture-b7f8a2?labelColor=09090b" alt="Knecht e2e fixture">
  <img src="https://img.shields.io/badge/license-MIT-blue" alt="MIT License">
</p>

</div>

A minimal [DDEV](https://ddev.com) PHP project used as an end-to-end test fixture for [Knecht](https://knecht.works). It serves a single page (`public/index.php`) on three hostnames — a primary plus `alpha.*` and `beta.*` — so Knecht can boot the environment, hit each host, and assert against the rendered output.

## What is Knecht?

[Knecht](https://knecht.works) is a dashboard, self-hosted on your own server, built for agencies juggling many DDEV projects. It boots each project as a fully working environment and runs deterministic workflows on top of it — instead of setting an agent loose and hoping for the best.

- **Projects** — one click boots the full DDEV setup: web, services, and database.
- **Workflows** — deterministic building blocks, triggered manually or via webhook (e.g. a GitHub issue or Jira ticket), that always run the same way.
- **AI agent** — powered by an [Opencode](https://opencode.ai) API key, the agent reproduces bugs in the running environment, fixes them, and tests directly against the real app instead of guessing.

A typical use case: a security update lands, Knecht boots the affected project, runs `composer update`, executes any migrations against a real database, tests the result against the running app, and opens a pull request with a preview link — something a bot without a live environment (like Dependabot) can't do.

This repository is one such project: a small, self-contained PHP fixture that Knecht boots and drives during its own end-to-end tests.

## Setup

Requires [DDEV](https://ddev.readthedocs.io/en/stable/users/install/ddev-installation/) and a Docker provider (Docker, OrbStack, or Colima).

```bash
ddev start     # boot the containers
ddev launch    # open the site in your browser
```

The project is then available at:

| Role    | URL                                 |
| ------- | ------------------------------------ |
| primary | `https://test-php.ddev.site`        |
| alpha   | `https://alpha.test-php.ddev.site`  |
| beta    | `https://beta.test-php.ddev.site`   |

## License

MIT, see [LICENSE](LICENSE).
