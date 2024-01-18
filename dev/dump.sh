#/bin/bash
ssh gema@alfacruz.homelinux.org pg_dump molecvet -U postgres -f /tmp/dump.sql
scp gema@alfacruz.homelinux.org:/tmp/dump.sql /tmp/dump.sql

psql -U postgres -c "drop schema public cascade; create schema public" molecvet
psql -U postgres -f /tmp/dump.sql molecvet
