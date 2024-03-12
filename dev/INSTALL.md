
sudo apt install git
git config --global init.defaultBranch master
git config --global user.email "mariovials@gmail.com"
git config --global user.name "Mario Vial"


sudo apt install postgresql
sudo vi /etc/postgresql/15/main/postgresql.conf
sudo vi /etc/postgresql/15/main/pg_hba.conf

sudo /etc/init.d/postgresql restart

psql -U postgres


CREATE DATABASE arpu;

CREATE USER arpu WITH PASSWORD '3B27m*Qsa3$x';

GRANT ALL PRIVILEGES ON DATABASE "arpu" to arpu;
GRANT ALL PRIVILEGES ON ALL TABLES IN SCHEMA public TO arpu;
GRANT ALL PRIVILEGES ON ALL SEQUENCES IN SCHEMA public TO arpu;

ALTER ROLE arpu WITH SUPERUSER;
