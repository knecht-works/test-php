<?php
$host = $_SERVER['HTTP_HOST'] ?? 'unknown';
// Strip a leading alpha./beta. subdomain so the links below stay correct no
// matter which hostname the page is served from (see .ddev additional_hostnames).
$baseHost = preg_replace('/^(alpha|beta)\./', '', $host);
$now  = date('H:i:s');

$isHttps = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
  || (($_SERVER['SERVER_PORT'] ?? null) == 443);

$env = [
  'Host'            => $host,
  'PHP version'     => PHP_VERSION,
  'Server software' => $_SERVER['SERVER_SOFTWARE'] ?? '—',
  'Protocol'        => $_SERVER['SERVER_PROTOCOL'] ?? '—',
  'Scheme'          => $isHttps ? 'https' : 'http',
  'Request URI'     => $_SERVER['REQUEST_URI'] ?? '/',
  'Client IP'       => $_SERVER['REMOTE_ADDR'] ?? '—',
  'Timezone'        => date_default_timezone_get(),
  'Server time'     => date('Y-m-d H:i:s'),
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PHP Test | Knecht</title>
  <link rel="stylesheet" href="https://knecht.works/styleguide/kit.css">
  <script src="https://knecht.works/styleguide/kit.js" defer></script>
  <link rel="icon" type="image/png" href="https://knecht.works/styleguide/favicon/favicon-96x96.png" sizes="96x96" />
  <link rel="icon" type="image/svg+xml" href="https://knecht.works/styleguide/favicon/favicon.svg" />
  <link rel="shortcut icon" href="https://knecht.works/styleguide/favicon/favicon.ico" />
  <link rel="apple-touch-icon" sizes="180x180" href="https://knecht.works/styleguide/favicon/apple-touch-icon.png" />
  <meta name="apple-mobile-web-app-title" content="Knecht" />
  <link rel="manifest" href="https://knecht.works/styleguide/favicon/site.webmanifest" />
  <meta name="robots" content="noindex,follow" />
  <script>
    // Apply the saved or system-preferred color scheme before paint to avoid a flash.
    (function () {
      try {
        var stored = localStorage.getItem('kit-theme');
        var prefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
        var theme = stored || (prefersDark ? 'dark' : 'light');
        document.documentElement.dataset.theme = theme;
      } catch (e) {}
    })();
  </script>
  <style>
    /* Fallback dark-mode styles in case the styleguide kit does not ship a kit-dark theme. */
    html[data-theme="dark"] body.kit-body {
      background-color: #09090b;
      color: #e4e4e7;
    }
    html[data-theme="dark"] .kit-muted { color: #a1a1aa; }
    html[data-theme="dark"] .kit-card {
      background-color: #18181b;
      border-color: #27272a;
    }
    html[data-theme="dark"] .kit-code { background-color: #27272a; color: #e4e4e7; }
    .kit-theme-toggle { align-self: flex-end; }
  </style>
</head>
<body class="kit-body">
  <main class="kit-container kit-stack">

    <button
      type="button"
      class="kit-button kit-button--ghost kit-theme-toggle"
      id="kit-theme-toggle"
      aria-label="Toggle dark mode"
      aria-pressed="false"
    >
      <span data-theme-label>Dark mode</span>
    </button>

    <span class="kit-badge kit-mb-4">php-test-e2e</span>

    <h1>PHP Fixture <span class="kit-accent-text">Knecht.works</span></h1>

    <p class="kit-muted">
      A small demo page, built with the Knecht Styleguide Kit. Served from
      <code class="kit-code"><?= htmlspecialchars($host) ?></code> at <?= $now ?>.
    </p>

    <div class="kit-stack">
      <a class="kit-button kit-button--solid" href="https://knecht.works">Go to knecht.works</a>
      <button class="kit-button" data-kit-toast="Up and running! 🚀">Show toast</button>
      <a class="kit-button kit-button--ghost" href="https://github.com/knecht-works/test-php">Go to Repo</a>
    </div>

    <section class="kit-card kit-stack kit-mt-8">
      <dl class="kit-dl">
        <?php foreach ($env as $label => $value): ?>
        <div class="kit-dl-row">
          <dt><?= htmlspecialchars($label) ?></dt>
          <dd><?= htmlspecialchars((string) $value) ?></dd>
        </div>
        <?php endforeach; ?>
      </dl>
    </section>

    <p class="kit-muted">
      <a href="https://alpha.<?= htmlspecialchars($baseHost) ?>/home">primary link</a> ·
      <a href="https://beta.<?= htmlspecialchars($baseHost) ?>/page">beta link</a>
    </p>

  </main>

  <script>
    (function () {
      var root = document.documentElement;
      var body = document.body;
      var toggle = document.getElementById('kit-theme-toggle');
      var label = toggle ? toggle.querySelector('[data-theme-label]') : null;

      function apply(theme) {
        root.dataset.theme = theme;
        body.classList.toggle('kit-dark', theme === 'dark');
        body.classList.toggle('kit-light', theme !== 'dark');
        if (toggle) {
          toggle.setAttribute('aria-pressed', theme === 'dark' ? 'true' : 'false');
        }
        if (label) {
          label.textContent = theme === 'dark' ? 'Light mode' : 'Dark mode';
        }
      }

      // Sync classes with the theme chosen by the inline head script.
      apply(root.dataset.theme === 'dark' ? 'dark' : 'light');

      if (toggle) {
        toggle.addEventListener('click', function () {
          var next = root.dataset.theme === 'dark' ? 'light' : 'dark';
          apply(next);
          try {
            localStorage.setItem('kit-theme', next);
          } catch (e) {}
        });
      }

      // Follow OS changes when the user has not made an explicit choice.
      if (window.matchMedia) {
        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', function (e) {
          try {
            if (localStorage.getItem('kit-theme')) return;
          } catch (err) {}
          apply(e.matches ? 'dark' : 'light');
        });
      }
    })();
  </script>
</body>
</html>
