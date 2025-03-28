
sudo apt install git
git config --global init.defaultBranch master
git config --global user.email "mariovials@gmail.com"
git config --global user.name "Mario Vial"

sudo apt install postgresql
sudo vi /etc/postgresql/15/main/postgresql.conf
sudo vi /etc/postgresql/15/main/pg_hba.conf

sudo /etc/init.d/postgresql restart

psql -U postgres

CREATE database webleu;
CREATE USER leu WITH PASSWORD 'leu';
GRANT ALL PRIVILEGES ON DATABASE "webleu" to leu;
GRANT ALL PRIVILEGES ON ALL TABLES IN SCHEMA public TO leu;
GRANT ALL PRIVILEGES ON ALL SEQUENCES IN SCHEMA public TO leu;
ALTER ROLE leu WITH SUPERUSER;
