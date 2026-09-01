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

Test
