--Permissions insert statements
/**
 * Author:  Randal Neptune
 * Created: Mar 11, 2021
 */

INSERT INTO menu_categories (category_id, "name", message_resource, "order", alive) VALUES (1, 'Configuration', 'menu.category.configuration', 1, true);
INSERT INTO menu_categories (category_id, "name", message_resource, "order", alive) VALUES (2, 'Reports', 'menu.category.report', 2, true);
INSERT INTO menu_categories (category_id, "name", message_resource, "order", alive) VALUES (3, 'Patient', 'menu.category.patient', 3, true);




INSERT INTO permissions (permission_id, submenu_name_key, perm_text_key, url, category_id, level, level1_id, constant, is_menu, is_container, comments, alive) 
VALUES (1,  'menu.manage.country', 'perm.text.manage.country', '/country', 1, NULL, NULL, 'MANAGE.COUNTRIES', false, false, NULL, true);
INSERT INTO permissions (permission_id, submenu_name_key, perm_text_key, url, category_id, level, level1_id, constant, is_menu, is_container, comments, alive) 
VALUES (2,  'menu.manage.physical.activity', 'perm.text.manage.physical.activity', '/physical/activity', 1, NULL, NULL, 'MANAGE.PHYSICAL.ACTIVITIES', false, false, NULL, true);
INSERT INTO permissions (permission_id, submenu_name_key, perm_text_key, url, category_id, level, level1_id, constant, is_menu, is_container, comments, alive) 
VALUES (3,  'menu.manage.age.range', 'perm.text.manage.age.range', '/age/range/form', 1, NULL, NULL, 'MANAGE.AGE.RANGES', false, false, NULL, true);
INSERT INTO permissions (permission_id, submenu_name_key, perm_text_key, url, category_id, level, level1_id, constant, is_menu, is_container, comments, alive) 
VALUES (4,  'menu.manage.vital.test', 'perm.text.manage.vital.test', '/vital/test/form', 1, NULL, NULL, 'MANAGE.VITAL.TESTS', false, false, NULL, true);
INSERT INTO permissions (permission_id, submenu_name_key, perm_text_key, url, category_id, level, level1_id, constant, is_menu, is_container, comments, alive) 
VALUES (5,  'menu.manage.meal.type', 'perm.text.manage.meal.type', '/meal/type', 1, NULL, NULL, 'MANAGE.MEAL.TYPES', false, false, NULL, true);
INSERT INTO permissions (permission_id, submenu_name_key, perm_text_key, url, category_id, level, level1_id, constant, is_menu, is_container, comments, alive) 
VALUES (6,  'menu.manage.food.group', 'perm.text.manage.food.group', '/food/group', 1, NULL, NULL, 'MANAGE.FOOD.GROUPS', false, false, NULL, true);
INSERT INTO permissions (permission_id, submenu_name_key, perm_text_key, url, category_id, level, level1_id, constant, is_menu, is_container, comments, alive) 
VALUES (7,  'menu.manage.lab.test', 'perm.text.manage.lab.test', '/lab/test/form', 1, NULL, NULL, 'MANAGE.LAB.TESTS', false, false, NULL, true);
INSERT INTO permissions (permission_id, submenu_name_key, perm_text_key, url, category_id, level, level1_id, constant, is_menu, is_container, comments, alive) 
VALUES (8,  'menu.manage.religion', 'perm.text.manage.religion', '/religion', 1, NULL, NULL, 'MANAGE.RELIGIONS', false, false, NULL, true);
INSERT INTO permissions (permission_id, submenu_name_key, perm_text_key, url, category_id, level, level1_id, constant, is_menu, is_container, comments, alive) 
VALUES (9,  'menu.manage.ethnicity', 'perm.text.manage.ethnicity', '/ethnicity', 1, NULL, NULL, 'MANAGE.ETHNICITIES', false, false, NULL, true);
INSERT INTO permissions (permission_id, submenu_name_key, perm_text_key, url, category_id, level, level1_id, constant, is_menu, is_container, comments, alive) 
VALUES (10,  'menu.patient.search', 'perm.text.patient.search', NULL, 3, NULL, NULL, 'SEARCH.PATIENTS', false, false, NULL, true);
INSERT INTO permissions (permission_id, submenu_name_key, perm_text_key, url, category_id, level, level1_id, constant, is_menu, is_container, comments, alive) 
VALUES (11,  'menu.manage.user.groups', 'perm.text.manage.user.groups', '/security/group', 1, NULL, NULL, 'MANAGE.USER.GROUPS', false, false, NULL, true);
INSERT INTO permissions (permission_id, submenu_name_key, perm_text_key, url, category_id, level, level1_id, constant, is_menu, is_container, comments, alive) 
VALUES (12,  'menu.manage.users', 'perm.text.manage.users', '/security/user', 1, NULL, NULL, 'MANAGE.USERS', false, false, NULL, true);
INSERT INTO permissions (permission_id, submenu_name_key, perm_text_key, url, category_id, level, level1_id, constant, is_menu, is_container, comments, alive) 
VALUES (13,  'menu.send.patient.email', 'perm.text.send.patient.email', NULL, 3, NULL, NULL, 'SEND.PATIENT.EMAILS', false, false, NULL, true);
INSERT INTO permissions (permission_id, submenu_name_key, perm_text_key, url, category_id, level, level1_id, constant, is_menu, is_container, comments, alive) 
VALUES (14,  'menu.manage.patient.user', 'perm.text.manage.patient.user', '/security/patient/user', 3, NULL, NULL, 'MANAGE.PATIENT.USERS', false, false, NULL, true);







