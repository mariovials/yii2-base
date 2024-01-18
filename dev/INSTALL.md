
sudo apt install postgresql
sudo vi /etc/postgresql/15/main/postgresql.conf
sudo vi /etc/postgresql/15/main/pg_hba.conf

sudo /etc/init.d/postgresql restart

psql -U postgres


CREATE DATABASE arqpub;

CREATE USER arqpub WITH PASSWORD '3B27m*Qsa3$x';

GRANT ALL PRIVILEGES ON DATABASE "arqpub" to arqpub;
GRANT ALL PRIVILEGES ON ALL TABLES IN SCHEMA public TO arqpub;
GRANT ALL PRIVILEGES ON ALL SEQUENCES IN SCHEMA public TO arqpub;

ALTER ROLE arqpub WITH SUPERUSER;
