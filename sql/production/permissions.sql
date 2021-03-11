--Permissions insert statements
/**
 * Author:  Randal Neptune
 * Created: Mar 11, 2021
 */

INSERT INTO menu_categories (category_id, "name", message_resource, order, alive) VALUES (1, 'Configuration', 'menu.category.configuration', 1, true);
INSERT INTO menu_categories (category_id, "name", message_resource, order, alive) VALUES (2, 'Patient', 'menu.category.patient', 2, true);
INSERT INTO menu_categories (category_id, "name", message_resource, order, alive) VALUES (3, 'Reports', 'menu.category.report', 3, true);



INSERT INTO permissions (permission_id, submenu_name_key, perm_text_key, url, category_id, level, level1_id, constant, is_menu, is_container, comments, alive) 
VALUES (1,  'menu.manage.country', 'perm.text.manage.country', '/country', 1, NULL, NULL, 'MANAGE.COUNTRIES', false, false, NULL, true);

