# https://github.com/code4mk/compose-hub/tree/main/db/mysql-phpmyadmin
curl -o db_compose.yml -LJO https://raw.githubusercontent.com/code4mk/compose-hub/main/db/mysql-phpmyadmin/compose.yml

# compose up
docker compose \
  --file db_compose.yml \
  up -d