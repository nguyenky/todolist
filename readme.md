### Prerequisite
* [Docker](https://www.docker.com/products/docker-desktop)
* [Git](https://git-scm.com/downloads)


## Setup
* Clone the project 
  * Clone the project by running `git clone git@github.com:nguyenky/todolist.git`
    
* If you are using Unix (Mac, Linux), run `chmod +x ./init.sh`
* Start `Docker`
* Run `./init.sh`
* Update your host config
            
            127.0.0.1	todo-list.local
* Enter (http://todo-list.local/)
* Done

* Mysql: http://localhost:9090/

            Server: mysql
            Username: default
            Pass: secret

## Check linting
* running `docker exec -it -u laradock -w /var/www/ todolist_workspace_1 composer lint`

