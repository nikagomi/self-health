/*
To create drop table statements for tables that match a certain pattern.
In this case sym tables. Pattern: sym_
*** LOOK OUT FOR SEQUENCES (Use DROP SEQUENCE)
*/

SELECT 'DROP TABLE IF EXISTS '||n.nspname ||'.'|| c.relname||' CASCADE;' as "Name" 
FROM pg_catalog.pg_class c
     LEFT JOIN pg_catalog.pg_namespace n ON n.oid = c.relnamespace
WHERE c.relkind IN ('r','v','S','')
AND c.relname LIKE 'sym_%'
     AND n.nspname <> 'pg_catalog'
     AND n.nspname <> 'information_schema'
     AND n.nspname !~ '^pg_toast'
AND pg_catalog.pg_table_is_visible(c.oid);


/* DROP ACTIVE USERS FROM A DB */
SELECT pg_terminate_backend(pg_stat_activity.pid)
FROM pg_stat_activity
WHERE datname = current_database()
  AND pid <> pg_backend_pid();


/* Bash script to drop active db connections:
   Pass db_name as parameter
*/
#!/usr/bin/env bash
# kill all connections to the postgres server
if [ -n "$1" ] ; then
  where="where pg_stat_activity.datname = '$1'"
  echo "killing all connections to database '$1'"
else
  echo "killing all connections to database"
fi

cat <<-EOF | psql -U postgres -d postgres 
SELECT pg_terminate_backend(pg_stat_activity.pid)
FROM pg_stat_activity
${where}
EOF

/*
The list of functions in postgres
*/
select p.oid::regprocedure
              from pg_proc p 
                   join pg_namespace n 
                   on p.pronamespace = n.oid 
             where n.nspname not in ('pg_catalog', 'information_schema');

/*Determine if a particular function exists in postgresq */
select exists(select * from pg_proc where proname = 'func_name');

/* Get rid of triggers*/
CREATE OR REPLACE FUNCTION strip_all_triggers() RETURNS text AS $$ DECLARE
    triggNameRecord RECORD;
    triggTableRecord RECORD;
BEGIN
    FOR triggNameRecord IN select distinct(trigger_name) from information_schema.triggers where trigger_schema = 'public' LOOP
        FOR triggTableRecord IN SELECT distinct(event_object_table) from information_schema.triggers where trigger_name = triggNameRecord.trigger_name LOOP
            RAISE NOTICE 'Dropping trigger: % on table: %', triggNameRecord.trigger_name, triggTableRecord.event_object_table;
            EXECUTE 'DROP TRIGGER ' || triggNameRecord.trigger_name || ' ON ' || triggTableRecord.event_object_table || ';';
        END LOOP;
    END LOOP;

    RETURN 'done';
END;
$$ LANGUAGE plpgsql SECURITY DEFINER;
