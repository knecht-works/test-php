# test-php

Minimal [DDEV](https://ddev.com)-based PHP project used as an end-to-end test fixture for [Knecht](https://knecht.works).

## Über Knecht

[Knecht](https://knecht.works) bootet, fixt und testet Projekte vollautomatisch: Du verbindest ein Repository, Knecht startet das Projekt als laufende App, und AI-Agenten reproduzieren Bugs darin, fixen sie und öffnen einen fertigen Pull Request.

Die Kernidee: AI-Agenten sollten nicht raten müssen, ob ihre Änderungen wirklich funktionieren. Deshalb setzt Knecht auf:

- **Ein Klick, ganzes Projekt** – Knecht startet dein DDEV-Setup als komplette Umgebung inklusive Web, Services und Datenbank.
- **Deterministische Workflows** – Abläufe aus Bausteinen, die immer gleich passieren, getriggert per Hand oder Webhook (z. B. aus einem GitHub-Issue oder Jira-Ticket).
- **AI Agent** – Mit einem API-Key von Opencode reproduziert, fixt und testet der Agent Bugs direkt gegen die laufende App.

Knecht ist DDEV-nativ, EU-basiert und self-hostable. Mehr dazu unter [knecht.works](https://knecht.works).

## Zweck dieses Repositories

Dieses Repository ist **kein** echtes Anwendungsprojekt, sondern eine bewusst minimale Fixture. Es dient dazu, die End-to-End-Abläufe von Knecht zu testen:

- Ein DDEV-Projekt aus dem Container heraus booten.
- Die laufende App über mehrere Hostnamen erreichen.
- Workflows und AI-Agenten gegen eine echte, laufende Umgebung ausführen.

## Tech-Stack

- **PHP** 8.3
- **Webserver** nginx-fpm
- **Umgebung** DDEV
- **Docroot** `public/`

## Projektstruktur

```
.
├── .ddev/            # DDEV-Konfiguration der Umgebung
├── public/
│   └── index.php     # Einstiegspunkt der Beispiel-App
├── composer.json     # PHP-Abhängigkeiten (aktuell keine)
├── package.json      # npm-Skripte (Build-Platzhalter)
└── README.md
```

Die App unter `public/index.php` gibt eine Begrüßung samt Host aus und rendert Links auf die primären und zusätzlichen Hostnamen der Umgebung.

## Voraussetzungen

- [DDEV](https://ddev.readthedocs.io/en/stable/users/install/ddev-installation/)
- Docker

## Starten

```bash
ddev start
ddev launch
```

Die App ist danach unter den in `.ddev/config.yaml` konfigurierten Hostnamen erreichbar:

- `https://test-php.ddev.site`
- `https://alpha.test-php.ddev.site`
- `https://beta.test-php.ddev.site`

## Build

```bash
npm run build
```

Das Build-Skript ist ein Platzhalter und gibt lediglich `build ok` aus.

## Lizenz

Siehe [LICENSE](LICENSE).
