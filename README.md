## Docker-Compose Wordpress Stack

This is the Stack for our Homepage https://fsmpi.uni-bayreuth.de including our custom Wordpress-Theme.

The Stack includes the following (official) images:

* https-portal
* wordpress
* mariadb



### Setup

1. Install Docker

2. Install Docker-compose

3. Clone this Repository

4. Change Login Credentials in th .env.example File and rename it to .env

5. Run ```docker-compose up -d```

6. Optional: Run ```docker-compose logs -f``` to watch when the Containers are ready (Generating the Diffie-Hellman Parameter may take a few minutes)

7. Check if the Website works correctly

8. Run ```docker-compose down``` and within the .env File switch the STAGE Environment Variable from 'local' to 'production'

9. Run ```docker-compose up -d``` again; Now the Lets Enrypt Certs should be installed



### FS-Theme

Our Custom Wordpress Theme is based on the Google Material Framework and is written completely from the ground up (no child-theme). You can find the Code inside the src/ directory

It also features some Domain-Specific Features (that will be listed here in the Future)

