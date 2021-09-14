# admicon-microservices
Microservices App with Symfony and Docker.

To begin, 

- Build the Docker container with 'make build-all'
- Run the container and composer install with 'make start-all'

Then configure the RabbitMQ as shown:

- go to 'http://localhost:15672' login with 'guest' in user and password
- create a new user as ADMIN rol with 'root' user and 'password' password
- Login again and create a new 'Virtual Host' as 'admicon_microservices'
- and finally in the Application Service consume mesenger with 'sf messenger:consume -vv' option ' [0] async_register_application'


