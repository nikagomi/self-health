--Initial Data Entry
--
--Genders
INSERT INTO genders (gender_id, name, alive) VALUES ('SRM1', 'Female', true);
INSERT INTO genders (gender_id, name, alive) VALUES ('SRM2', 'Male', true);


--Countries
--OECS List
INSERT INTO countries (country_id, name, alive) VALUES ('SRM1', 'Saint Lucia', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM2', 'St. Vincent & the Grenadines', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM3', 'Dominica', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM4', 'Grenada', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM5', 'Montserrat', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM6', 'St. Kitts & Nevis', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM7', 'British Virgin Islands', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM8', 'Antigua and Barbuda', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM9', 'Martinique', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM10', 'Guadeloupe', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM11', 'Anguilla', true);


--Users
INSERT INTO users (user_id,first_name,last_name, passwd, email, contact_number, is_system) 
VALUES ('SRM1','Admin', 'User','$2y$10$3GZ3HOT08C/dUR7PryGBWehHXIbYbn3OZpGLnFHtI5AWUQakmBjIu','admin.email@org.net','(555) 555-5555',true);
INSERT INTO users (user_id,first_name,last_name, passwd, email, contact_number, is_system) 
VALUES ('SRM2','System', 'User','$2y$10$3GZ3HOT08C/dUR7PryGBWehHXIbYbn3OZpGLnFHtI5AWUQakmBjIu','system.user@org.net','(555) 555-5555',true);
--

INSERT INTO sequences (sequence_id, table_name,lower_limit,upper_limit,current_value,sequence_flag) 
VALUES ('SRM1', 'countries', 1, 20000000, 11, 'C');

INSERT INTO sequences (sequence_id, table_name,lower_limit,upper_limit,current_value,sequence_flag) 
VALUES ('SRM2', 'genders', 1, 20000000, 2, 'C'); 

INSERT INTO sequences (sequence_id, table_name,lower_limit,upper_limit,current_value,sequence_flag) 
VALUES ('SRM3', 'users', 1, 20000000, 2, 'C'); 

INSERT INTO sequences (sequence_id, table_name,lower_limit,upper_limit,current_value,sequence_flag) 
VALUES ('SRM4', 'menu_categories', 1, 20000000, 3, 'C'); 

INSERT INTO sequences (sequence_id, table_name,lower_limit,upper_limit,current_value,sequence_flag) 
VALUES ('SRM5', 'permissions', 1, 20000000, 24, 'C'); 

INSERT INTO sequences (sequence_id, table_name,lower_limit,upper_limit,current_value,sequence_flag) 
VALUES ('SRM6', 'sequences', 1, 20000000, 6, 'C'); 



