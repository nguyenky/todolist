printf "\n ****************************** Step 1: Init docker ****************************** \n"

ENV_PATH=$(pwd)/docker/.env

printf "\nCopying .env.example to .env \n"
cp $(pwd)/docker/.env.example $(pwd)/docker/.env

export $(grep -v '^#' ${ENV_PATH} | xargs)

printf "\n ****************************** Step 2: Docker build ****************************** \n"

printf "\nMay take a long time (15min+) on the first run\n"

docker-compose -f $(pwd)/docker/docker-compose.yml up --build -d

printf "\n ****************************** Step 3: Init todolist ****************************** \n"

ENV_PATH=$(pwd)/source/.env

printf "\nCopying .env.example to .env \n"
cp $(pwd)/source/.env.example $(pwd)/source/.env

export $(grep -v '^#' ${ENV_PATH} | xargs)

printf "\n ****************************** Step 4: Composer install ****************************** \n"

docker exec -it -u laradock -w /var/www/ todolist_workspace_1 composer install

printf "\n ****************************** Step 5: Composer migrate ****************************** \n"

docker exec -it -u laradock -w /var/www/public todolist_workspace_1 php migrate.php


cat << EOF

######## #### ##    ## ####  ######  ##     ## ######## ########
##        ##  ###   ##  ##  ##    ## ##     ## ##       ##     ##
##        ##  ####  ##  ##  ##       ##     ## ##       ##     ##
######    ##  ## ## ##  ##   ######  ######### ######   ##     ##
##        ##  ##  ####  ##        ## ##     ## ##       ##     ##
##        ##  ##   ###  ##  ##    ## ##     ## ##       ##     ##
##       #### ##    ## ####  ######  ##     ## ######## ########


EOF

docker exec -it -u laradock -w /var/www/ todolist_workspace_1 bash