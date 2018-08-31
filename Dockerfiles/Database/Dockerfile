FROM mariadb:latest

#RUN apt-get update
#RUN apt-get install -y md5

COPY docker-entrypoint.sh /usr/local/bin/
COPY Scripts/*.sql /tmp/

RUN chmod 777 /usr/local/bin/docker-entrypoint.sh
RUN chmod 777 /tmp/database_schema.sql

ENTRYPOINT ["docker-entrypoint.sh"]

EXPOSE 3306
CMD ["mysqld"]