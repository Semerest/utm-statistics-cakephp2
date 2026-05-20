# UTM Statistics

Test task implementation for displaying UTM data as a hierarchical tree using CakePHP 2.

## Stack

- CakePHP 2.10.24
- PHP 5.6 FPM
- MySQL 5.7
- Nginx
- Docker Compose

## Features

- Displays UTM data as a nested tree:
  - source
  - medium
  - campaign
  - content
  - term
- Pagination by unique `source`
- Seed data included
- Docker-based local environment
- Sample dataset includes more than 20 unique sources to verify pagination behavior

## Run

```bash
docker compose up -d --build

Открыть страницу:

```text
http://localhost:8080/statistics/utm/list

Вторая страница страницу:

```text
http://localhost:8080/statistics/utm/list