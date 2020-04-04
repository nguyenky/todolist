# ROUND 1: TEST TOPIC

## CONTENT:

You need a web system to manage your work named
“TodoList” with the below functions:
* Functions to Add, Edit, Delete Work. A work includes information of “Work Name”, “Starting Date”, “EndingDate” and “Status” (Planning, Doing, Complete) 
* Function to show the works on a calendar view with: Date, Week, Month (can use third-party library) 

## REQUES
*  To do with PHP programming language follows MVC. 
PLEASE DO NOT USE ANY FRAMEWORK
*  To use coding convention follows PSR
* To apply UNIT TEST to test your functions 
* To use GIT and GIT Flow to manage your code
* Please do your best, no need to complete all contents if 
you cannot
* Please send your result to bo@tech.est-rouge.com 

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

