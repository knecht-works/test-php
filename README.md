# test-php

Minimales [DDEV](https://ddev.com/)-Projekt, das als End-to-End-Test-Fixture für **[Knecht](https://knecht.works)** dient.

## Was ist Knecht?

> Booten. Fixen. Testen. Vollautomatisch.

[Knecht](https://knecht.works) verbindet ein Repository, startet das Projekt als laufende App und lässt AI-Agenten Bugs in der echten Umgebung reproduzieren, fixen und als fertigen Pull Request öffnen. Kernideen:

- **Ein Klick, ganzes Projekt** – Knecht startet ein DDEV-Setup als komplette Umgebung (Web, Services, Datenbank).
- **Deterministische Workflows** – wiederholbare Abläufe aus Bausteinen, getriggert per Hand oder Webhook (z. B. GitHub-Issue oder Jira-Ticket).
- **AI-Agent** – reproduziert und fixt Bugs in der laufenden Umgebung und testet gegen die echte App, statt zu raten.

Knecht ist DDEV-nativ, EU-basiert und self-hostable. Aktuell in Entwicklung – öffentliche Beta geplant für Q4 2026.

## Zweck dieses Repositories

Dieses Repo ist bewusst so klein wie möglich gehalten. Es liefert eine reproduzierbare PHP-Umgebung, an der Knecht seine End-to-End-Abläufe verifizieren kann – vom Booten des Projekts bis zum automatisierten Fix samt Pull Request.

## Tech-Stack

| Komponente     | Wert            |
| -------------- | --------------- |
| Projekttyp     | PHP             |
| PHP-Version    | 8.3             |
| Webserver      | nginx-fpm       |
| Docroot        | `public`        |
| Umgebung       | DDEV            |

Zusätzliche Hostnames (via DDEV): `alpha.test-php`, `beta.test-php`.

## Struktur

```
.
├── .ddev/            # DDEV-Konfiguration (config.yaml, providers, …)
├── public/
│   └── index.php     # Einstiegspunkt, gibt Host-Info und Testlinks aus
├── composer.json     # PHP-Metadaten (keine Runtime-Abhängigkeiten)
├── package.json      # Node-Metadaten mit Platzhalter-Build-Skript
└── LICENSE           # MIT
```

## Voraussetzungen

- [DDEV](https://ddev.readthedocs.io/en/stable/users/install/ddev-installation/)
- Docker

## Loslegen

```bash
# Umgebung starten
ddev start

# Im Browser öffnen
ddev launch
```

Danach liefert `public/index.php` eine kurze Begrüßung mit dem aktuellen Host sowie zwei Testlinks aus.

## Build

Das `package.json` enthält ein Platzhalter-Build-Skript für die Test-Pipeline:

```bash
npm run build   # -> "build ok"
```

## Lizenz

[MIT](LICENSE) © 2026 Knecht
