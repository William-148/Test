!/bin/bash

docker exec -it 2e6 mysql -umysql -p
docker exec -i 2e6 mysql -umysql -padmin task-app <script.sql
docker exec -i 2e6 mysql -umysql -padmin task-app <data.sql
