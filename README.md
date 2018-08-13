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

4. Run ```docker-compose up -d```

5. Optional: Run ```docker-compose logs -f``` to watch when the Containers are ready (Generating the Diffie-Hellman Parameter may take a few minutes)

6. Run ```docker logs Homepage_Database 2>&1 | grep "GENERATED ROOT PASSWORD"``` and copy the Password

7. Open fsmpi.uni-bayreuth.de in a Browser

8. Install Wordpress with the following Configuration:

   **Database-Name**		wordpress

   **Username**			root

   **Password** 			 *[The copied Password from before]*

   **Database-Host**		mysql

   **Table-Prefix**			wp_

9. Check if the Website works correctly

10. Run ```docker-compose down``` and within the https-portal service in the docker-compose.yml switch the STAGE Environment Variable from 'local' to 'production'

11. Run ```docker-compose up -d``` again; Now the Lets Enrypt Certs should be installed



### FS-Theme

Our Custom Wordpress Theme is based on the Google Material Framework and is written completely from the ground up (no child-theme). You can find the Code inside the src/ directory

It also features some Domain-Specific Features (that will be listed here in the Future)

