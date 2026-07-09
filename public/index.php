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
    // Apply the saved (or default light) theme before paint to avoid a flash.
    (function () {
      var stored = null;
      try { stored = localStorage.getItem('kit-theme'); } catch (e) {}
      var theme = stored || 'light';
      document.documentElement.dataset.kitTheme = theme;
    })();
  </script>
  <style>
    /* The kit ships light-mode tokens under `.kit-light`; mirror them onto the
       `data-kit-theme="light"` state so the toggle can flip the whole palette. */
    html[data-kit-theme="light"] {
      --kit-accent: #b7f8a2;
      --kit-accent-strong: #527f54;
      --kit-accent-ink: #16220f;
      --kit-mint: #6ba96d;
      --kit-bg: #ffffff;
      --kit-surface: #fafafa;
      --kit-surface-2: #f4f4f5;
      --kit-bg-muted: #fafafa;
      --kit-bg-elevated: #ffffff;
      --kit-border: rgba(0, 0, 0, 0.08);
      --kit-border-strong: rgba(0, 0, 0, 0.14);
      --kit-ink: #18181b;
      --kit-ink-muted: #52525b;
      --kit-ink-dimmed: #71717a;
      --kit-inverted: #18181b;
      --kit-inverted-ink: #fafafa;
      --kit-grid-line: rgba(0, 0, 0, 0.045);
      --kit-shadow-panel:
        0 1px 2px -1px rgba(0, 0, 0, 0.08),
        0 10px 24px -14px rgba(0, 0, 0, 0.12);
      --kit-shadow-panel-lg:
        inset 0 1px 0 0 rgba(255, 255, 255, 0.7),
        0 2px 6px -2px rgba(0, 0, 0, 0.08),
        0 30px 60px -28px rgba(0, 0, 0, 0.16);
    }
    .kit-theme-toggle {
      position: fixed;
      top: 1rem;
      right: 1rem;
      z-index: 100;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 2.5rem;
      height: 2.5rem;
      padding: 0;
      border: 1px solid var(--kit-border-strong);
      border-radius: 999px;
      background: var(--kit-surface-2);
      color: var(--kit-ink);
      cursor: pointer;
      transition: background 0.15s ease, border-color 0.15s ease;
    }
    .kit-theme-toggle:hover {
      border-color: var(--kit-accent);
    }
    .kit-theme-toggle:focus-visible {
      outline: 2px solid var(--kit-accent);
      outline-offset: 2px;
    }
    .kit-theme-toggle svg {
      width: 1.25rem;
      height: 1.25rem;
    }
    /* Show the moon icon (switch to dark) while in light mode, the sun otherwise. */
    .kit-theme-toggle .kit-icon-sun { display: none; }
    .kit-theme-toggle .kit-icon-moon { display: block; }
    [data-kit-theme="dark"] .kit-theme-toggle .kit-icon-sun { display: block; }
    [data-kit-theme="dark"] .kit-theme-toggle .kit-icon-moon { display: none; }
  </style>
</head>
<body class="kit-body">
  <button
    type="button"
    class="kit-theme-toggle"
    id="kit-theme-toggle"
    aria-label="Toggle dark mode"
    title="Toggle dark mode"
  >
    <svg class="kit-icon-moon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
      <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
    </svg>
    <svg class="kit-icon-sun" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
      <circle cx="12" cy="12" r="5"></circle>
      <line x1="12" y1="1" x2="12" y2="3"></line>
      <line x1="12" y1="21" x2="12" y2="23"></line>
      <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
      <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
      <line x1="1" y1="12" x2="3" y2="12"></line>
      <line x1="21" y1="12" x2="23" y2="12"></line>
      <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
      <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
    </svg>
  </button>
  <main class="kit-container kit-stack">

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
      var toggle = document.getElementById('kit-theme-toggle');
      if (!toggle) return;
      toggle.addEventListener('click', function () {
        var current = document.documentElement.dataset.kitTheme === 'dark' ? 'dark' : 'light';
        var next = current === 'dark' ? 'light' : 'dark';
        document.documentElement.dataset.kitTheme = next;
        try { localStorage.setItem('kit-theme', next); } catch (e) {}
      });
    })();
  </script>
</body>
</html>
