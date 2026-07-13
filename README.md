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

[Knecht](https://knecht.works) is a self-hostable dashboard for agencies that manage many DDEV projects. It boots each project as a fully working environment (web, services, database) and runs it through deterministic **workflows** — repeatable sequences of steps triggered by hand or by webhook (e.g. a GitHub issue or Jira ticket).

Where a workflow needs judgement rather than a fixed script — reproducing a bug, writing a fix, verifying it against the real, running app — Knecht can call an AI agent (powered by [opencode](https://opencode.ai)) instead of guessing. A typical use case: a security patch lands, Knecht boots the affected project, runs `composer update`, lets migrations write their files, tests the result against the live app, and opens a pull request with a preview link — something a plain dependency bot can't do because it has no running project to update against.

Knecht is EU-based, DDEV-native, and currently in development (public beta targeted for Q4 2026).

## This fixture's role

This repo has no real application logic — it exists purely so Knecht's own end-to-end tests have something real to boot, patch, and verify:

- **Boot** — a plain DDEV/PHP/nginx-fpm project Knecht can spin up like any client project.
- **Multiple hosts** — `alpha.*` and `beta.*` additional hostnames let tests check that routing and links behave correctly across hostnames.
- **Inspectable output** — the page prints live server info (host, PHP version, protocol, request URI, timestamps, …) so a test run can assert against real, observable state instead of a static fixture.

## Setup

Requires [DDEV](https://ddev.readthedocs.io/en/stable/users/install/ddev-installation/) and a Docker provider (Docker, OrbStack, or Colima).

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
