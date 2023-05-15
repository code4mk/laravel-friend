curl -o db_compose.yml -LJO https://raw.githubusercontent.com/code4mk/compose-hub/main/db/mysql-phpmyadmin/compose.yml

docker compose \
  --file db_compose.yml \
  up -d