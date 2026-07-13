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

[Knecht](https://knecht.works) is a dashboard, self-hosted on your own server, built for agencies running many DDEV projects. Instead of manually re-running the same maintenance tasks, Knecht turns them into deterministic workflows:

- **Boot** — Knecht spins up a project's DDEV setup as a complete, running environment (web, services, database), since every project carries all the information it needs for a full boot.
- **Workflows** — Reusable, deterministic building blocks trigger via webhook (e.g. a GitHub issue or Jira ticket) or by hand, instead of sending an agent off to guess.
- **AI Agent** — With an [Opencode](https://opencode.ai) API key, Knecht's AI agent reproduces bugs in the running environment, fixes them, and tests directly against the real app — no guessing whether a change actually works.
- **Result** — A finished pull request with a preview link, ready to review and merge.

This repo exists purely so Knecht has a small, predictable project to boot, patch, and test against while its own workflows are being built.

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

## License

MIT — see [LICENSE](./LICENSE).

Maintained by Knecht (knecht.works).
