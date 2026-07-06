# test-php

Minimales DDEV-Projekt als End-to-End-Test-Fixture für [Knecht](https://knecht.works).

## Über Knecht

Knecht ist ein AI-gesteuertes Entwicklungstool, das automatisch Projekte bootet, Bugs reproduziert, fixt und Pull Requests erstellt. Mit Knecht verbindest du ein Repository, und der AI-Agent startet das Projekt als laufende App, testet Änderungen direkt gegen die echte Umgebung und öffnet fertige Pull Requests.

### Kernfunktionen

- **Ein Klick, ganzes Projekt**: Startet DDEV-Setups als komplette Umgebung inklusive Web, Services und Datenbank
- **Deterministische Workflows**: Abläufe aus Bausteinen, getriggert per Hand oder Webhook (GitHub Issues, Jira-Tickets)
- **AI Agent**: Reproduziert und fixt Bugs in der laufenden Umgebung mit direktem Testing

## Über dieses Projekt

Dieses Repository dient als Test-Fixture für die End-to-End-Tests von Knecht. Es enthält eine minimale PHP-Anwendung mit DDEV-Konfiguration, um die Kernfunktionalität von Knecht zu validieren.

## Tech Stack

- **PHP**: 8.3
- **Webserver**: nginx-fpm
- **DDEV**: Lokale Entwicklungsumgebung
- **Docroot**: `public/`

## Setup

### Voraussetzungen

- [DDEV](https://ddev.readthedocs.io/) installiert
- Docker

### Installation

```bash
# Repository klonen
git clone <repository-url>
cd test-php

# DDEV starten
ddev start

# Projekt im Browser öffnen
ddev launch
```

## Projekt-Struktur

```
.
├── .ddev/              # DDEV-Konfiguration
├── public/             # Docroot
│   └── index.php       # Einfache Test-Seite
├── composer.json       # PHP-Dependencies
├── package.json        # Node-Scripts
└── README.md           # Diese Datei
```

## Hosts

Das Projekt konfiguriert mehrere Hostnames für Testing:

- `test-php.ddev.site` (primär)
- `alpha.test-php.ddev.site`
- `beta.test-php.ddev.site`

## Build

```bash
npm run build
```

## Status

Knecht befindet sich aktuell in der Entwicklung. Ziel ist eine öffentliche Beta in Q4 2026, Early-Access in Q3 2026.

## Mehr Informationen

- Website: [knecht.works](https://knecht.works)
- Updates: [knecht.works/updates](https://knecht.works/updates)
- GitHub: [github.com/knecht-works](https://github.com/knecht-works)

## Lizenz

Siehe [LICENSE](LICENSE)
