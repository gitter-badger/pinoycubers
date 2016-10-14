## Docker Setup

### Overview

This container is using the following technologies:
- php 7.0.9 with php-fpm
- laravel 5.2
- nginx 1.11.4
- redis 3.2.4
- mysql 5.7.15
- nodejs 6.7.0
- socket.io 1.4.5

### Setting Up Docker Environment

This is one time only. The entire setup will consume approximately **~2.5 GB** of space.

1. Install [Docker Toolbox](https://www.docker.com/products/docker-toolbox)
2. Move your `pinoycubers` directory to any folder under `C:\Users\USERNAME`. It could be on any nested folder as long s it is inside this directory. eg. `C:\Users\USERNAME\Documents\pinoycubers`
3. Go inside your `pinoycubers` directory and open a command prompt window on that folder. `(Shift + Right-Click -> Open Command Window Here)`
4. Input this on your console

	**Git Bash**

	```bash
	eval $(docker-machine env {machine-name})
	```

	**Windows**

	```cmd
	@FOR /f "tokens=*" %i IN ('docker-machine env --shell cmd {machine-name}') DO @%i
	```
	> The default machine name is `default`

	> Note: You can skip steps 1 and 2 if you use **Docker Terminal**. Then just navigate to the project folder
	
5. Copy the `.env.example` to `.env` and do not change it
6. Execute docker to build images required for running our Laravel project

	```cmd
	docker-compose build
	```	

	> This will download docker images and run a lot of command so it would take a while
	
	After it has finish you will see something like:

		Step 3 : CMD mysqld
		 ---> Using cache
		 ---> 103abec8c83e
		Step 4 : EXPOSE 3306
		 ---> Using cache
		 ---> 3fceb7a02efc
		Successfully built 3fceb7a02efc

### Running the Container

1. Go inside your `pinoycubers` directory and open a command prompt window on that folder. `(Shift + Right-Click -> Open Command Window Here)`
2. Input this on your console 

	**Git Bash**
	
	```bash
	eval $(docker-machine env {machine-name})
	```
	
	**Windows**
	
	```cmd
	@FOR /f "tokens=*" %i IN ('docker-machine env --shell cmd default') DO @%i
	```
3. Run the docker container services

	```bash
	docker-compose up
	```

	> This 'warning' is ok as it will still run on the background

	```
	An HTTP request took too long to complete. Retry with --verbose to obtain debug information.
	If you encounter this issue regularly because of slow network conditions, consider setting COMPOSE_HTTP_TIMEOUT to a higher value (current value: 60).
	```
4. Skip to step #5 if you do not need to migrate anything. Connect to workspace instance use cmd.

	List all docker containers

		CONTAINER ID        IMAGE               COMMAND                  CREATED             STATUS              PORTS                         NAMES
		3fd583f67bf1        pinoycubers_nginx       "nginx"                  3 hours ago         Up 3 hours          0.0.0.0:80->80/tcp, 443/tcp   pinoycubers_nginx
		b3715d29adf0        pinoycubers_php-fpm     "php-fpm"                3 hours ago         Up 3 hours          9000/tcp                      pinoycubers_phpfpm
		170b418c28b3        pinoycubers_mysql       "docker-entrypoint.sh"   3 hours ago         Up 3 hours          0.0.0.0:3306->3306/tcp        pinoycubers_mysql
		84d4958433e2        pinoycubers_redis       "docker-entrypoint.sh"   3 hours ago         Up 3 hours          0.0.0.0:6379->6379/tcp        pinoycubers_redis
		cfb8f1672c54        pinoycubers_workspace   "/sbin/my_init"          3 hours ago         Up 3 hours                                        pinoycubers_workspace

	Get the **CONTAINER ID** of **pinoycubers_workspace** and run

		docker exec -it cfb8f1672c54 bash

	You will see something like this:
	
		C:\Users\USERNAME>docker exec -it cfb8f1672c54 bash
		root@cfb8f1672c54:/var/www/laravel#	
	
	Run migraton

		php artisan migrate
	
5. Site is at [http://192.168.99.100](http://192.168.99.100) You may have a different IP just check using this command

		docker-machine env

	Then you will see your ip at **DOCKER_HOST**

		SET DOCKER_TLS_VERIFY=1
		SET DOCKER_HOST=tcp://192.168.99.101:2376
		SET DOCKER_CERT_PATH=C:\Users\ACM\.docker\machine\machines\default
		SET DOCKER_MACHINE_NAME=default
		REM Run this command to configure your shell:
		REM     @FOR /f "tokens=*" %i IN ('docker-machine env') DO @%i

	> Will automatically update when you do composer update and code changes on your local machine. BUT, migrate should be done like #4

### Connecting to MYSQL
	
	HOST - the IP 192.168.99.100 or whatever the IP is
	USERNAME - pinoycubers
	PASSWORD - secret