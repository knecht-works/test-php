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

// Tags for a Vite entry, read from the manifest that `npm run build` writes.
// A missing manifest renders a comment instead of failing the page.
function vite(string $entry): string {
  static $manifest = null;
  if ($manifest === null) {
    $file = __DIR__ . '/dist/.vite/manifest.json';
    $manifest = is_file($file) ? (json_decode(file_get_contents($file), true) ?: []) : [];
  }
  $chunk = $manifest[$entry] ?? null;
  if (!$chunk) {
    return '<!-- vite: no manifest entry for ' . htmlspecialchars($entry) . ', run `npm run build` -->';
  }
  $tags = '';
  foreach ($chunk['css'] ?? [] as $css) {
    $tags .= '<link rel="stylesheet" href="/dist/' . htmlspecialchars($css) . '">' . "\n  ";
  }
  $tags .= str_ends_with($chunk['file'], '.css')
    ? '<link rel="stylesheet" href="/dist/' . htmlspecialchars($chunk['file']) . '">'
    : '<script type="module" src="/dist/' . htmlspecialchars($chunk['file']) . '"></script>';
  return $tags;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PHP Test | Knecht</title>
  <link rel="stylesheet" href="https://knecht.works/styleguide/kit.css">
  <script src="https://knecht.works/styleguide/kit.js" defer></script>
  <?= vite('src/css/app.css') ?>

  <?= vite('src/js/app.js') ?>

  <link rel="icon" type="image/png" href="https://knecht.works/styleguide/favicon/favicon-96x96.png" sizes="96x96" />
  <link rel="icon" type="image/svg+xml" href="https://knecht.works/styleguide/favicon/favicon.svg" />
  <link rel="shortcut icon" href="https://knecht.works/styleguide/favicon/favicon.ico" />
  <link rel="apple-touch-icon" sizes="180x180" href="https://knecht.works/styleguide/favicon/apple-touch-icon.png" />
  <meta name="apple-mobile-web-app-title" content="Knecht" />
  <link rel="manifest" href="https://knecht.works/styleguide/favicon/site.webmanifest" />
  <meta name="robots" content="noindex,follow" />
</head>
<body class="kit-body kit-light">
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
        <div class="kit-dl-row">
          <dt>Vite bundle</dt>
          <dd data-vite-status="pending">not loaded</dd>
        </div>
      </dl>
    </section>

    <p class="kit-muted">
      <a href="https://alpha.<?= htmlspecialchars($baseHost) ?>/home">primary link</a> ·
      <a href="https://beta.<?= htmlspecialchars($baseHost) ?>/page">beta link</a>
    </p>

  </main>
</body>
</html>
