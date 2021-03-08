-- EduRecord Appliction Schema

--IMPORTANT: Also set in postgresql configuration file

SET datestyle TO 'iso, dmy';
SET timezone = 'America/St_Lucia';



CREATE TABLE users(
  user_id character varying(50) NOT NULL,
  first_name character varying(100) NOT NULL,
  last_name character varying(100) NOT NULL,
  passwd character varying(100) NOT NULL,
  email character varying(100) NOT NULL,
  contact_number character varying(50),
  is_system boolean NOT NULL DEFAULT false,
  last_login timestamp without time zone,
  previous_login timestamp without time zone,
  login_amt integer,
  previous_login_ip_address character varying(50),
  login_ip_address character varying(50),
  locked boolean NOT NULL DEFAULT false,
  reset boolean NOT NULL DEFAULT false, 
  alive boolean NOT NULL DEFAULT true,
  patient boolean NOT NULL DEFAULT false,
  CONSTRAINT pk_user_id PRIMARY KEY (user_id )
);
ALTER TABLE users OWNER TO postgres;
GRANT ALL ON TABLE users TO postgres;
GRANT SELECT, UPDATE, INSERT ON TABLE users TO public;

CREATE TABLE sequences(
  sequence_id character varying(80) NOT NULL,
  "table_name" character varying(60) NOT NULL,
  lower_limit integer NOT NULL,
  upper_limit integer NOT NULL,
  current_value integer NOT NULL,
  sequence_flag character(1) NOT NULL,
  CONSTRAINT pk_sequence_id PRIMARY KEY (sequence_id )
);
ALTER TABLE sequences OWNER TO postgres;
GRANT ALL ON TABLE sequences TO postgres;
GRANT SELECT, UPDATE, INSERT ON TABLE sequences TO public;

CREATE TABLE logs(
  log_id character varying(50) NOT NULL,
  user_id character varying(200) NOT NULL,
  "table_name" character varying(60) NOT NULL,
  record_id character varying(200) NOT NULL,
  prev_value text,
  new_value text,
  "action" character varying(20) NOT NULL,
  sql_statement text NOT NULL,
  log_date timestamp without time zone NOT NULL,
  log_time time without time zone NOT NULL,
  object_class text,
  CONSTRAINT pk_log_id PRIMARY KEY (log_id ),
  CONSTRAINT fk_user_id FOREIGN KEY (user_id)
      REFERENCES users (user_id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);
ALTER TABLE logs OWNER TO postgres;
GRANT ALL ON TABLE logs TO postgres;
GRANT SELECT, INSERT ON TABLE logs TO public;

CREATE TABLE genders(
  gender_id character varying(50) NOT NULL,
  "name" character varying(25) NOT NULL,
  alive boolean NOT NULL DEFAULT true,
  CONSTRAINT pk_gender_id PRIMARY KEY (gender_id)
);
ALTER TABLE genders OWNER TO postgres;
GRANT ALL ON TABLE genders TO postgres;
GRANT SELECT, UPDATE, INSERT ON TABLE genders TO public;
CREATE TABLE religions(
 religion_id character varying(50) NOT NULL,
 "name" character varying(50) NOT NULL,
 alive boolean NOT NULL DEFAULT true,
 CONSTRAINT pk_religion_id PRIMARY KEY (religion_id) 
);
ALTER TABLE religions OWNER TO postgres;
GRANT ALL ON TABLE religions TO postgres;
GRANT SELECT, UPDATE, INSERT ON TABLE religions TO public;

CREATE TABLE ethnicities(
 ethnicity_id character varying(50) NOT NULL,
 "name" character varying(50) NOT NULL,
 alive boolean NOT NULL DEFAULT true,
 CONSTRAINT pk_ethnicity_id PRIMARY KEY (ethnicity_id) 
);
ALTER TABLE ethnicities OWNER TO postgres;
GRANT ALL ON TABLE ethnicities TO postgres;
GRANT SELECT, UPDATE, INSERT ON TABLE ethnicities TO public;

CREATE TABLE countries(
 country_id character varying(50) NOT NULL,
 "name" character varying(100) NOT NULL,
 alive boolean NOT NULL DEFAULT true,
 PRIMARY KEY(country_id)
);
ALTER TABLE countries OWNER TO postgres;
GRANT ALL ON TABLE countries TO postgres;
GRANT SELECT, UPDATE, INSERT ON TABLE countries TO public;

CREATE TABLE menu_categories (
 category_id integer NOT NULL,
 "name" character varying(45) NOT NULL,
 alive boolean DEFAULT true NOT NULL,
 "order" integer NOT NULL DEFAULT 1,
 PRIMARY KEY(category_id)
);
ALTER TABLE menu_categories OWNER TO postgres;
GRANT ALL ON TABLE menu_categories TO postgres;
GRANT SELECT, UPDATE, INSERT ON TABLE menu_categories TO public;

CREATE TABLE permissions (
    permission_id integer NOT NULL,
    url character varying(50),
    category_id integer NOT NULL,
    "level" integer,
    level1_id integer,
    "constant" character varying(40),
    is_menu boolean DEFAULT false NOT NULL,
    is_container boolean DEFAULT false NOT NULL,
    comments character varying(225),
    alive boolean DEFAULT true NOT NULL,
    PRIMARY KEY(permission_id),
    CONSTRAINT pk_category_id FOREIGN KEY(category_id) 
       REFERENCES menu_categories(category_id)
);
ALTER TABLE permissions OWNER TO postgres;
GRANT ALL ON TABLE permissions TO postgres;
GRANT SELECT, UPDATE, INSERT ON TABLE permissions TO public;

CREATE TABLE user_permissions(
  user_permission_id character varying(200) NOT NULL,
  user_id character varying(200) NOT NULL,
  permission_id integer NOT NULL,
  alive boolean NOT NULL DEFAULT true,
  CONSTRAINT pk_user_permission_id PRIMARY KEY (user_permission_id ),
  CONSTRAINT fk_permission_id FOREIGN KEY (permission_id)
      REFERENCES permissions (permission_id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT fk_user_id FOREIGN KEY (user_id)
      REFERENCES users (user_id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);
ALTER TABLE user_permissions OWNER TO postgres;
GRANT ALL ON TABLE user_permissions TO postgres;
GRANT SELECT, UPDATE, INSERT ON TABLE user_permissions TO public;

-- only central
CREATE TABLE groups(
  group_id character varying (30) NOT NULL,
  "name" character varying(60) NOT NULL,
  description character varying(150),
  alive boolean NOT NULL DEFAULT true,
  CONSTRAINT pk_group_id PRIMARY KEY (group_id )
);
ALTER TABLE groups OWNER TO postgres;
GRANT ALL ON TABLE groups TO postgres;
GRANT SELECT, UPDATE, INSERT ON TABLE groups TO public;

CREATE TABLE group_permissions(
  group_permission_id character varying(50) NOT NULL,
  group_id character varying(50) NOT NULL,
  permission_id integer NOT NULL,
  alive boolean NOT NULL DEFAULT true,
  CONSTRAINT pk_group_permission_id PRIMARY KEY (group_permission_id ),
  CONSTRAINT fk_group_id FOREIGN KEY (group_id)
      REFERENCES groups (group_id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT fk_permission_id FOREIGN KEY (permission_id)
      REFERENCES permissions (permission_id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);
ALTER TABLE group_permissions OWNER TO postgres;
GRANT ALL ON TABLE group_permissions TO postgres;
GRANT SELECT, UPDATE, INSERT ON TABLE group_permissions TO public;

CREATE TABLE user_groups(
 user_group_id character varying(200) NOT NULL,
 user_id character varying(200) NOT NULL,
 group_id character varying(30) NOT NULL,
 alive boolean NOT NULL DEFAULT true,
 PRIMARY KEY(user_group_id),
 CONSTRAINT fk_user_id FOREIGN KEY (user_id)
    REFERENCES users(user_id),
 CONSTRAINT fk_group_id FOREIGN KEY (group_id)
    REFERENCES groups(group_id)
);
ALTER TABLE user_groups OWNER TO postgres;
GRANT ALL ON TABLE user_groups TO postgres;
GRANT SELECT, UPDATE, INSERT ON TABLE user_groups TO public;

CREATE TABLE twofa_user_backup_codes (
    user_backup_code_id character varying(50) NOT NULL,
    user_id character varying(50) NOT NULL,
    backup_code character varying(8) NOT NULL,
    sort_order integer NOT NULL,
    time_used timestamp without time zone,
    used boolean NOT NULL DEFAULT false,
    alive boolean NOT NULL DEFAULT true,
    CONSTRAINT pk_user_backup_code_id PRIMARY KEY (user_backup_code_id),
    CONSTRAINT fk_user_id FOREIGN KEY (user_id)
       REFERENCES users (user_id)
);
ALTER TABLE twofa_user_backup_codes OWNER TO postgres;
GRANT ALL ON TABLE twofa_user_backup_codes TO postgres;
GRANT SELECT, UPDATE, INSERT ON TABLE twofa_user_backup_codes TO public;

ALTER TABLE users ALTER COLUMN passwd TYPE character varying(255);
ALTER TABLE users ADD COLUMN session_id character varying(200);
ALTER TABLE users ADD COLUMN last_forgot_password_time timestamp without time zone;

ALTER TABLE logs ADD COLUMN no_replicate integer NOT NULL DEFAULT 0;

ALTER TABLE menu_categories ADD COLUMN message_resource character varying(50);
ALTER TABLE permissions ADD COLUMN submenu_name_key character varying(100);
ALTER TABLE permissions ADD COLUMN perm_text_key character varying (100);

ALTER TABLE users ADD COLUMN accummulated_failed_logins integer NOT NULL DEFAULT 0;
ALTER TABLE users ADD COLUMN failed_login_time timestamp without time zone;
ALTER TABLE users ADD COLUMN next_login_reference_time timestamp without time zone;
ALTER TABLE logs ALTER COLUMN user_id DROP NOT NULL;

ALTER TABLE users ADD COLUMN timeout integer NOT NULL DEFAULT 20;
ALTER TABLE users ADD COLUMN two_factor_auth_enabled boolean NOT NULL DEFAULT false;
ALTER TABLE users ADD COLUMN two_factor_secret character varying(255);


CREATE TABLE physical_activities (
 physical_activity_id character varying(50) NOT NULL,
 "name" character varying(100) NOT NULL,
 alive boolean NOT NULL DEFAULT true,
 PRIMARY KEY(physical_activity_id)
);
ALTER TABLE physical_activities OWNER TO postgres;
GRANT ALL ON TABLE physical_activities TO postgres;
GRANT SELECT, UPDATE, INSERT ON TABLE physical_activities TO public;

CREATE TABLE patients (
  patient_id character varying(50) NOT NULL,
  first_name character varying(50) NOT NULL,
  middle_names character varying(100),
  last_name character varying(50) NOT NULL,
  gender_id character varying(50) NOT NULL,
  country_id character varying(50) NOT NULL,
  date_of_birth date NOT NULL,
  user_id character varying(50) NOT NULL,
  contact_number character varying(20),
  other_contact_number character varying(20),
  religion_id character varying(50),
  ethnicity_id character varying(50),
  alive boolean NOT NULL DEFAULT true,
  created_time timestamp without time zone NOT NULL,
  created_by_id character varying(50) nOT NULL,
  modified_by_id character varying(50) NOT NULL,
  modified_time timestamp without time zone NOT NULL,
  CONSTRAINT pk_patient_id PRIMARY KEY (patient_id),
  CONSTRAINT fk_gender_id FOREIGN KEY (gender_id)
     REFERENCES genders (gender_id),
  CONSTRAINT fk_country_id FOREIGN KEY (country_id)
    REFERENCES countries (country_id),
  CONSTRAINT fk_created_by_id FOREIGN KEY (created_by_id)
    REFERENCES users (user_id),
  CONSTRAINT fk_modified_by_id FOREIGN KEY (modified_by_id)
    REFERENCES users (user_id),
  CONSTRAINT fk_religion_id FOREIGN KEY(religion_id)
    REFERENCES religions (religion_id),
  CONSTRAINT fk_ethnicity_id FOREIGN KEY (ethnicity_id)
    REFERENCES ethnicities (ethnicity_id)
);
ALTER TABLE patients OWNER TO postgres;
GRANT ALL ON TABLE patients TO postgres;
GRANT SELECT, UPDATE, INSERT ON TABLE patients TO public;

CREATE TABLE patient_physical_activities (
  patient_physical_activity_id character varying(50) NOT NULL,
  patient_id character varying(50) NOT NULL,
  date_performed date NOT NULL,
  time_performed time without time zone,
  physical_activity_id character varying(50) NOT NULL,
  duration_in_minutes integer NOT NULL,
  notes text,
  created_time timestamp without time zone NOT NULL,
  created_by_id character varying(50) NOT NULL,
  modified_time timestamp without time zone NOT NULL,
  modified_by_id character varying(50) NOT NULL,
  alive boolean NOT NULL DEFAULT true,
  CONSTRAINT pk_patient_physical_activity_id PRIMARY KEY(patient_physical_activity_id),
  CONSTRAINT fk_patient_id FOREIGN KEY(patient_id)
    REFERENCES patients (patient_id),
  CONSTRAINT fk_physical_activity_id FOREIGN KEY (physical_activity_id)
    REFERENCES physical_activities (physical_activity_id),
  CONSTRAINT fk_created_by_id FOREIGN KEY (created_by_id)
    REFERENCES users (user_id),
  CONSTRAINT fk_modified_by_id FOREIGN KEY (modified_by_id)
    REFERENCES users (user_id)
);
ALTER TABLE patient_physical_activities OWNER TO postgres;
GRANT ALL ON TABLE patient_physical_activities TO postgres;
GRANT SELECT, UPDATE, INSERT ON TABLE patient_physical_activities TO public;

--12/Feb/2021

CREATE TABLE age_ranges (
  age_range_id character varying(50) NOT NULL,
  "name" character varying(50) NOT NULL,
  lower_limit integer NOT NULL,
  upper_limit integer NOT NULL,
  alive boolean NOT NULL DEFAULT true,
  CONSTRAINT pk_age_range_id PRIMARY KEY(age_range_id)
);
ALTER TABLE age_ranges OWNER TO postgres;
GRANT ALL ON TABLE age_ranges TO postgres;
GRANT SELECT, UPDATE, INSERT ON TABLE age_ranges TO public;

CREATE TABLE vital_tests (
  vital_test_id character varying(50) NOT NULL,
  test_name character varying(40) NOT NULL,
  abbreviation character varying(5) NOT NULL,
  unit character varying(10) NOT NULL,
  numeric_test boolean NOT NULL DEFAULT false,
  bp_test boolean NOT NULL DEFAULT false,
  bp_test_order smallint,
  sort_order smallint NOT NULL,
  alive boolean NOT NULL DEFAULT true,
  CONSTRAINT pk_vital_test_id PRIMARY KEY (vital_test_id)
);
ALTER TABLE vital_tests OWNER TO postgres;
GRANT ALL ON TABLE vital_tests TO postgres;
GRANT SELECT, UPDATE, INSERT ON TABLE vital_tests TO public;

CREATE TABLE vital_test_thresholds (
  vital_test_threshold_id character varying(50) NOT NULL,
  vital_test_id character varying(50) NOT NULL,
  gender_id character varying(50) NOT NULL,
  lower_limit numeric(4,1) NOT NULL,
  upper_limit numeric(4,1) NOT NULL,
  age_range_id character varying(50) NOT NULL,
  alive boolean NOT NULL DEFAULT true,
  CONSTRAINT pk_vital_test_threshold_id PRIMARY KEY(vital_test_threshold_id),
  CONSTRAINT fk_vital_test_id FOREIGN KEY (vital_test_id)
    REFERENCES vital_tests (vital_test_id),
  CONSTRAINT fk_age_range_id FOREIGN KEY(age_range_id)
    REFERENCES age_ranges (age_range_id),
  CONSTRAINT fk_gender_id FOREIGN KEY(gender_id)
    REFERENCES genders (gender_id)
);
ALTER TABLE vital_test_thresholds OWNER TO postgres;
GRANT ALL ON TABLE vital_test_thresholds TO postgres;
GRANT SELECT, UPDATE, INSERT ON TABLE vital_test_thresholds TO public;

CREATE TABLE patient_vital_test_records (
  patient_vital_test_record_id character varying(50) NOT NULL,
  patient_id character varying(50) NOT NULL,
  record_date date NOT NULL,
  record_time time without time zone NOT NULL,
  patient_position character varying(20) NOT NULL,
  created_by_id character varying(50) NOT NULL,
  modified_by_id character varying(50) NOT NULL,
  created_time timestamp without time zone NOT NULL DEFAULT now(),
  modified_time timestamp without time zone NOT NULL DEFAULT now(),
  alive boolean NOT NULL DEFAULT true,
  CONSTRAINT pk_patient_vital_test_record_id PRIMARY KEY(patient_vital_test_record_id),
  CONSTRAINT fk_patient_id FOREIGN KEY(patient_id)
     REFERENCES patients (patient_id),
  CONSTRAINT fk_created_by_id FOREIGN KEY(created_by_id)
     REFERENCES users (user_id),
  CONSTRAINT fk_modified_by_id FOREIGN KEY(modified_by_id)
     REFERENCES users (user_id)
);
ALTER TABLE patient_vital_test_records OWNER TO postgres;
GRANT ALL ON TABLE patient_vital_test_records TO postgres;
GRANT SELECT, UPDATE, INSERT ON TABLE patient_vital_test_records TO public;

CREATE TABLE patient_vital_test_record_items (
  patient_vital_test_record_item_id character varying(50) NOT NULL,
  patient_vital_test_record_id character varying(50) NOT NULL,
  vital_test_id character varying(50) NOT NULL,
  test_result character varying(20) NOT NULL,
  alive boolean NOT NULL DEFAULT true,
  CONSTRAINT pk_patient_vital_test_record_item_id PRIMARY KEY (patient_vital_test_record_item_id),
  CONSTRAINT fk_patient_vital_test_record_id FOREIGN KEY(patient_vital_test_record_id)
     REFERENCES patient_vital_test_records (patient_vital_test_record_id)
);
ALTER TABLE patient_vital_test_record_items OWNER TO postgres;
GRANT ALL ON TABLE patient_vital_test_record_items TO postgres;
GRANT SELECT, UPDATE, INSERT ON TABLE patient_vital_test_record_items TO public;

--19/Feb/2021
CREATE TABLE meal_types (
  meal_type_id character varying(50) NOT NULL,
  "name" character varying(40) NOT NULL,
  alive boolean NOT NULL DEFAULT true,
  CONSTRAINT pk_meal_type_id PRIMARY KEY (meal_type_id)
);
ALTER TABLE meal_types OWNER TO postgres;
GRANT ALL ON TABLE meal_types TO postgres;
GRANT SELECT, UPDATE, INSERT ON TABLE meal_types TO public;

CREATE TABLE food_groups (
  food_group_id character varying(50) NOT NULL,
  "name" character varying(40) NOT NULL,
  alive boolean NOT NULL DEFAULT true,
  CONSTRAINT pk_food_group_id PRIMARY KEY (food_group_id)
);
ALTER TABLE food_groups OWNER TO postgres;
GRANT ALL ON TABLE food_groups TO postgres;
GRANT SELECT, UPDATE, INSERT ON TABLE food_groups TO public;

CREATE TABLE patient_meal_records (
  patient_meal_record_id character varying(50) NOT NULL,
  patient_id character varying(50) NOT NULL,
  meal_type_id character varying(50) NOT NULL,
  date_consumed date NOT NULL,
  time_consumed time without time zone NOT NULL, 
  created_by_id character varying(50) NOT NULL,
  created_time timestamp without time zone NOT NULL,
  modified_by_id character varying(50) NOT NULL,
  modified_time timestamp without time zone NOT NULL,
  notes text,
  alive boolean NOT NULL DEFAULT true,
  CONSTRAINT pk_patient_meal_record_id PRIMARY KEY (patient_meal_record_id),
  CONSTRAINT fk_patient_id FOREIGN KEY(patient_id)
     REFERENCES patients (patient_id),
  CONSTRAINT fk_created_by_id FOREIGN KEY(created_by_id)
     REFERENCES users (user_id),
  CONSTRAINT fk_modified_by_id FOREIGN KEY(modified_by_id)
     REFERENCES users (user_id),
  CONSTRAINT fk_meal_type_id FOREIGN KEY(meal_type_id)
     REFERENCES meal_types (meal_type_id)
);
ALTER TABLE patient_meal_records OWNER TO postgres;
GRANT ALL ON TABLE patient_meal_records TO postgres;
GRANT SELECT, UPDATE, INSERT ON TABLE patient_meal_records TO public;

CREATE TABLE patient_meal_record_food_groups (
  patient_meal_record_food_group_id character varying(50) NOT NULL,
  patient_meal_record_id character varying(50) NOT NULL,
  food_group_id character varying(50) NOT NULL,
  details text,
  alive boolean NOT NULL DEFAULT true,
  CONSTRAINT pk_patient_meal_record_food_group_id PRIMARY KEY (patient_meal_record_food_group_id),
  CONSTRAINT fk_patient_meal_record_id FOREIGN KEY(patient_meal_record_id)
    REFERENCES patient_meal_records (patient_meal_record_id)
);
ALTER TABLE patient_meal_record_food_groups OWNER TO postgres;
GRANT ALL ON TABLE patient_meal_record_food_groups TO postgres;
GRANT SELECT, UPDATE, INSERT ON TABLE patient_meal_record_food_groups TO public;

CREATE TABLE lab_tests (
  lab_test_id character varying(50) NOT NULL,
  "name" character varying(50) NOT NULL,
  is_numeric boolean NOT NULL DEFAULT false,
  unit character varying(10),
  alive boolean NOT NULL DEFAULT true,
  CONSTRAINT pk_lab_test_id PRIMARY KEY (lab_test_id)
);
ALTER TABLE lab_tests OWNER TO postgres;
GRANT ALL ON TABLE lab_tests TO postgres;
GRANT SELECT, UPDATE, INSERT ON TABLE lab_tests TO public;

--20/Feb/2021
CREATE TABLE patient_lab_test_records (
  patient_lab_test_record_id character varying(50) NOT NULL,
  patient_id character varying(50) NOT NULL,
  test_date date NOT NULL,
  notes text,
  created_by_id character varying(50) NOT NULL,
  created_time timestamp without time zone NOT NULL,
  modified_by_id character varying(50) NOT NULL,
  modified_time timestamp without time zone NOT NULL,
  alive boolean NOT NULL DEFAULT true,
  CONSTRAINT pk_patient_lab_test_record_id PRIMARY KEY(patient_lab_test_record_id),
  CONSTRAINT fk_patient_id FOREIGN KEY(patient_id)
     REFERENCES patients (patient_id),
  CONSTRAINT fk_created_by_id FOREIGN KEY(created_by_id)
     REFERENCES users (user_id),
  CONSTRAINT fk_modified_by_id FOREIGN KEY(modified_by_id)
     REFERENCES users (user_id)
);
ALTER TABLE patient_lab_test_records OWNER TO postgres;
GRANT ALL ON TABLE patient_lab_test_records TO postgres;
GRANT SELECT, UPDATE, INSERT ON TABLE patient_lab_test_records TO public;

CREATE TABLE patient_lab_test_results (
  patient_lab_test_result_id character varying(50) NOT NULL,
  patient_lab_test_record_id character varying(50) NOT NULL,
  lab_test_id character varying(50) NOT NULL,
  test_result character varying(15) NOT NULL,
  observations character varying(20),
  alive boolean NOT NULL DEFAULT true,
  CONSTRAINT pk_patient_lab_test_result_id PRIMARY KEY(patient_lab_test_result_id),
  CONSTRAINT fk_lab_test_id FOREIGN KEY(lab_test_id)
     REFERENCES lab_tests (lab_test_id),
  CONSTRAINT fk_patient_lab_test_record_id FOREIGN KEY (patient_lab_test_record_id)
     REFERENCES patient_lab_test_records (patient_lab_test_record_id)
);
ALTER TABLE patient_lab_test_results OWNER TO postgres;
GRANT ALL ON TABLE patient_lab_test_results TO postgres;
GRANT SELECT, UPDATE, INSERT ON TABLE patient_lab_test_results TO public;

--1/Mar/2021
ALTER TABLE patients ADD COLUMN address text;
ALTER TABLE patients ADD COLUMN primary_doctor character varying(200);
ALTER TABLE patients ADD COLUMN principal_health_care_facility character varying(200);

ALTER TABLE vital_tests ADD COLUMN bmi_height_component boolean NOT NULL default false;
ALTER TABLE vital_tests ADD COLUMN bmi_weight_component boolean NOT NULL default false;

--4/Mar/2021
ALTER TABLE food_groups ADD COLUMN image_name character varying(30);
ALTER TABLE food_groups ADD COLUMN original_image_name text;

--5/Mar/2021
CREATE TABLE patient_smoking_drinking_statuses (
  patient_smoking_drinking_status_id character varying(50) NOT NULL,
  patient_id character varying(50) NOT NULL,
  smoker boolean NOT NULL DEFAULT false,
  smoking_since_quantity integer,
  smoking_since_interval character varying(10),
  smoking_frequency character varying(10),
  stop_smoking_date date,
  smoking_comments text,
  drinker boolean NOT NULL DEFAULT false,
  drinking_since_quantity integer,
  drinking_since_interval character varying(10),
  drinking_frequency character varying(10),
  stop_drinking_date date,
  drinking_comments text,
  stopped_drinking boolean NOT NULL DEFAULT false,
  stopped_smoking boolean NOT NULL DEFAULT false,
  alive boolean NOT NULL DEFAULT true,
  CONSTRAINT pk_patient_smoking_drinking_status_id PRIMARY KEY (patient_smoking_drinking_status_id),
  CONSTRAINT fk_patient_id FOREIGN KEY (patient_id)
     REFERENCES patients(patient_id)
);
ALTER TABLE patient_smoking_drinking_statuses OWNER TO postgres;
GRANT ALL ON TABLE patient_smoking_drinking_statuses TO postgres;
GRANT SELECT, UPDATE, INSERT ON TABLE patient_smoking_drinking_statuses TO public;