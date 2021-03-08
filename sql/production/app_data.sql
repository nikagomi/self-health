--Initial Data Entry
--
--Genders
INSERT INTO genders (gender_id, name, alive) VALUES ('SRM1', 'Female', true);
INSERT INTO genders (gender_id, name, alive) VALUES ('SRM2', 'Male', true);

--Facility types
/*INSERT INTO edu_facility_types (facility_type_id, name, constant, is_educational, is_admin, alive) VALUES (1,'Administration','ADMIN', false, true, true);
INSERT INTO edu_facility_types (facility_type_id, name, constant, is_educational, is_admin, alive) VALUES (2,'District Office','DISTRICT_OFFICE', false, true, true);
INSERT INTO edu_facility_types (facility_type_id, name, constant, is_educational, is_admin, alive) VALUES (3,'Primary School', 'PRIM_SCHOOL', true, false, true);
INSERT INTO edu_facility_types (facility_type_id, name, constant, is_educational, is_admin, alive) VALUES (4,'Secondary School', 'SEC_SCHOOL', true, false, true);
INSERT INTO edu_facility_types (facility_type_id, name, constant, is_educational, is_admin, alive) VALUES (5,'Community College', 'COMMUNITY_COLLEGE', true, false, true);*/
--INSERT INTO edu_facility_types (facility_type_id, name, constant, is_educational, is_admin, alive) VALUES (1,'Private', 'PRIVATE', true, true, true);

--INSERT INTO edu_districts (district_id, name, alive) VALUES ('SRM1', 'Kingstown', true);
--Districts
/*INSERT INTO edu_districts (district_id, name, alive) VALUES ('SRM1', 'Vieux Fort', true);
INSERT INTO edu_districts (district_id, name, alive) VALUES ('SRM2', 'Castries', true);
INSERT INTO edu_districts (district_id, name, alive) VALUES ('SRM3', 'Gros Islet', true);
INSERT INTO edu_districts (district_id, name, alive) VALUES ('SRM4', 'Dennery', true);
INSERT INTO edu_districts (district_id, name, alive) VALUES ('SRM5', 'Micoud', true);
INSERT INTO edu_districts (district_id, name, alive) VALUES ('SRM6', 'Anse La Raye', true);
INSERT INTO edu_districts (district_id, name, alive) VALUES ('SRM7', 'Soufriere', true);
INSERT INTO edu_districts (district_id, name, alive) VALUES ('SRM8', 'Choiseul', true);
INSERT INTO edu_districts (district_id, name, alive) VALUES ('SRM9', 'Laborie', true);
INSERT INTO edu_districts (district_id, name, alive) VALUES ('SRM10','Canaries', true);
*/
--Communities
--INSERT INTO edu_communities (community_id, district_id, name, alive )VALUES ('SRM1', 'SRM1', 'City', true);

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

--Full country list
INSERT INTO countries (country_id, name, alive) VALUES ('SRM1', 'Afghanistan', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM2', 'Akrotiri', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM3', 'Albania', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM4', 'Algeria', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM5', 'American Samoa', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM6', 'Andorra', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM7', 'Angola', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM8', 'Anguilla', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM9', 'Antarctica', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM10', 'Antigua and Barbuda', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM11', 'Argentina', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM12', 'Armenia', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM13', 'Aruba', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM14', 'Ashmore and Cartier Islands', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM15', 'Australia', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM16', 'Austria', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM17', 'Azerbaijan', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM18', 'Bahamas', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM19', 'Bahrain', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM20', 'Bangladesh', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM21', 'Barbados', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM22', 'Bassas da India', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM23', 'Belarus', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM24', 'Belgium', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM25', 'Belize', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM26', 'Benin', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM27', 'Bermuda', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM28', 'Bhutan', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM29', 'Bolivia', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM30', 'Bosnia and Herzegovina', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM31', 'Botswana', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM32', 'Bouvet Island', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM33', 'Brazil', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM34', 'British Indian Ocean Territory', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM35', 'British Virgin Islands', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM36', 'Brunei', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM37', 'Bulgaria', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM38', 'Burkina Faso', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM39', 'Burma', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM40', 'Burundi', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM41', 'Cambodia', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM42', 'Cameroon', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM43', 'Canada', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM44', 'Cape Verde', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM45', 'Cayman Islands', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM46', 'Central African Republic', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM47', 'Chad', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM48', 'Chile', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM49', 'China', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM50', 'Christmas Island', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM51', 'Clipperton Island', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM52', 'Cocos (Keeling) Islands', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM53', 'Colombia', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM54', 'Comoros', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM55', 'Congo, Democratic Republic of the', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM56', 'Congo, Republic of the', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM57', 'Cook Islands', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM58', 'Coral Sea Islands', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM59', 'Costa Rica', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM60', 'Cote d''Ivoire', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM61', 'Croatia', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM62', 'Cuba', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM63', 'Cyprus', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM64', 'Czech Republic', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM65', 'Denmark', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM66', 'Dhekelia', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM67', 'Djibouti', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM68', 'Dominica', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM69', 'Dominican Republic', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM70', 'Ecuador', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM71', 'Egypt', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM72', 'El Salvador', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM73', 'Equatorial Guinea', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM74', 'Eritrea', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM75', 'Estonia', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM76', 'Ethiopia', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM77', 'Europa Island', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM78', 'Falkland Islands (Islas Malvinas)', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM79', 'Faroe Islands', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM80', 'Fiji', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM81', 'Finland', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM82', 'France', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM83', 'French Guiana', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM84', 'French Polynesia', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM85', 'French Southern and Antarctic Lands', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM86', 'Gabon', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM87', 'Gambia, The', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM88', 'Gaza Strip', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM89', 'Georgia', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM90', 'Germany', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM91', 'Ghana', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM92', 'Gibraltar', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM93', 'Glorioso Islands', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM94', 'Greece', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM95', 'Greenland', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM96', 'Grenada', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM97', 'Guadeloupe', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM98', 'Guam', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM99', 'Guatemala', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM100', 'Guernsey', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM101', 'Guinea', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM102', 'Guinea-Bissau', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM103', 'Guyana', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM104', 'Haiti', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM105', 'Heard Island and McDonald Islands', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM106', 'Holy See (Vatican City)', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM107', 'Honduras', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM108', 'Hong Kong', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM109', 'Hungary', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM110', 'Iceland', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM111', 'India', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM112', 'Indonesia', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM113', 'Iran', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM114', 'Iraq', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM115', 'Ireland', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM116', 'Isle of Man', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM117', 'Israel', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM118', 'Italy', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM119', 'Jamaica', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM120', 'Jan Mayen', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM121', 'Japan', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM122', 'Jersey', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM123', 'Jordan', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM124', 'Juan de Nova Island', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM125', 'Kazakhstan', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM126', 'Kenya', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM127', 'Kiribati', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM128', 'Korea, North', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM129', 'Korea, South', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM130', 'Kuwait', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM131', 'Kyrgyzstan', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM132', 'Laos', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM133', 'Latvia', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM134', 'Lebanon', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM135', 'Lesotho', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM136', 'Liberia', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM137', 'Libya', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM138', 'Liechtenstein', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM139', 'Lithuania', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM140', 'Luxembourg', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM141', 'Macau', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM142', 'Macedonia', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM143', 'Madagascar', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM144', 'Malawi', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM145', 'Malaysia', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM146', 'Maldives', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM147', 'Mali', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM148', 'Malta', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM149', 'Marshall Islands', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM150', 'Martinique', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM151', 'Mauritania', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM152', 'Mauritius', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM153', 'Mayotte', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM154', 'Mexico', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM155', 'Micronesia, Federated States of', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM156', 'Moldova', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM157', 'Monaco', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM158', 'Mongolia', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM159', 'Montserrat', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM160', 'Morocco', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM161', 'Mozambique', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM162', 'Namibia', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM163', 'Nauru', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM164', 'Navassa Island', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM165', 'Nepal', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM166', 'Netherlands', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM167', 'Netherlands Antilles', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM168', 'New Caledonia', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM169', 'New Zealand', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM170', 'Nicaragua', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM171', 'Niger', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM172', 'Nigeria', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM173', 'Niue', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM174', 'Norfolk Island', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM175', 'Northern Mariana Islands', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM176', 'Norway', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM177', 'Oman', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM178', 'Pakistan', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM179', 'Palau', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM180', 'Panama', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM181', 'Papua New Guinea', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM182', 'Paracel Islands', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM183', 'Paraguay', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM184', 'Peru', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM185', 'Philippines', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM186', 'Pitcairn Islands', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM187', 'Poland', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM188', 'Portugal', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM189', 'Puerto Rico', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM190', 'Qatar', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM191', 'Reunion', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM192', 'Romania', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM193', 'Russia', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM194', 'Rwanda', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM195', 'Saint Helena', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM196', 'Saint Kitts and Nevis', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM197', 'Saint Lucia', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM198', 'Saint Pierre and Miquelon', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM199', 'Saint Vincent and the Grenadines', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM200', 'Samoa', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM201', 'San Marino', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM202', 'Sao Tome and Principe', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM203', 'Saudi Arabia', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM204', 'Senegal', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM205', 'Serbia and Montenegro', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM206', 'Seychelles', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM207', 'Sierra Leone', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM208', 'Singapore', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM209', 'Slovakia', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM210', 'Slovenia', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM211', 'Solomon Islands', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM212', 'Somalia', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM213', 'South Africa', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM214', 'South Georgia and the South Sandwich Islands', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM215', 'Spain', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM216', 'Spratly Islands', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM217', 'Sri Lanka', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM218', 'Sudan', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM219', 'Suriname', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM220', 'Svalbard', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM221', 'Swaziland', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM222', 'Sweden', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM223', 'Switzerland', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM224', 'Syria', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM225', 'Taiwan', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM226', 'Tajikistan', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM227', 'Tanzania', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM228', 'Thailand', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM229', 'Timor-Leste', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM230', 'Togo', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM231', 'Tokelau', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM232', 'Tonga', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM233', 'Trinidad and Tobago', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM234', 'Tromelin Island', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM235', 'Tunisia', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM236', 'Turkey', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM237', 'Turkmenistan', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM238', 'Turks and Caicos Islands', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM239', 'Tuvalu', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM240', 'Uganda', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM241', 'Ukraine', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM242', 'United Arab Emirates', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM243', 'United Kingdom', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM244', 'United States', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM245', 'Uruguay', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM246', 'Uzbekistan', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM247', 'Vanuatu', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM248', 'Venezuela', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM249', 'Vietnam', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM250', 'Virgin Islands', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM251', 'Wake Island', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM252', 'Wallis and Futuna', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM253', 'West Bank', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM254', 'Western Sahara', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM255', 'Yemen', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM256', 'Zambia', true);
INSERT INTO countries (country_id, name, alive) VALUES ('SRM257', 'Zimbabwe', true);

--Facilities (Central Facilities)
--INSERT INTO edu_facilities (facility_id, facility_type_id, name, facility_code, phone, address1, community_id, district_id, country_id) 
--VALUES('SRM1', 1, 'Ursuline Convent School', 'BBUCS','(246) 457-1104','Roebuck Street', 'SRM1', 'SRM2', 'SRM21');

--Users
INSERT INTO users (user_id,first_name,last_name, passwd, email, contact_number, is_system) 
VALUES ('SRM1','Admin', 'User','$2y$10$3GZ3HOT08C/dUR7PryGBWehHXIbYbn3OZpGLnFHtI5AWUQakmBjIu','randalneptune@gmail.com','(758) 719-1623',true);
INSERT INTO users (user_id,first_name,last_name, passwd, email, contact_number, is_system) 
VALUES ('SRM2','System', 'User','$2y$10$3GZ3HOT08C/dUR7PryGBWehHXIbYbn3OZpGLnFHtI5AWUQakmBjIu','system.user@self-report.org','(758) 719-1623',true);
--

--Menu categories
INSERT INTO edu_menu_categories (category_id, name, message_resource, alive, "order") VALUES (2, 'Student', 'menu.category.student', true, 2);
INSERT INTO edu_menu_categories (category_id, name, message_resource, alive, "order") VALUES (5, 'Synchronization', 'menu.category.synchronization', true, 4);
INSERT INTO edu_menu_categories (category_id, name, message_resource, alive, "order") VALUES (3, 'Administration', 'menu.category.administration', true, 3);
INSERT INTO edu_menu_categories (category_id, name, message_resource, alive, "order") VALUES (4, 'Reports', 'menu.category.report', true, 5);
INSERT INTO edu_menu_categories (category_id, name, message_resource, alive, "order") VALUES (1, 'Academic', 'menu.category.academic', true, 1);

--Permissions
/*
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (22, 'Attendance', '/attendance', 4, 1, NULL, 'Report Summary', 'REPORT.SUMMARY', true, false, NULL, false, NULL, NULL);
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (2, 'General', NULL, 3, 1, NULL, 'General Admin', NULL, true, true, NULL, true, 'menu.container.general', 'perm.text.general.admin');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (11, 'Security', NULL, 3, 1, NULL, 'Security', NULL, true, true, NULL, true, 'menu.container.security', 'perm.text.security');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (36, 'View Disciplinary Summary', NULL, 2, NULL, NULL, 'View Disciplinary Summary', 'VIEW.DISCIPLINARY.SUMMARY', false, false, NULL, true, 'menu.disciplinary.action.view', 'perm.text.disciplinary.action.view');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (8, 'Academic Year', '/academic/year', 3, 2, 7, 'Manage Academic Years', 'MANAGE.ACADEMIC.YEARS', true, false, NULL, true, 'menu.academic.year', 'perm.text.academic.year');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (31, 'Teacher Details', NULL, 1, NULL, NULL, 'Manage Teacher Details', 'MANAGE.TEACHER.DETAILS', false, false, NULL, true, 'menu.teacher.detail', 'perm.text.teacher.detail');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (4, 'Facilities', '/facility', 3, 2, 2, 'Manage Facilities', 'MANAGE.FACILITIES', true, false, NULL, true, 'menu.facility', 'perm.text.facility');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (5, 'Communities', '/community', 3, 2, 2, 'Manage Communities', 'MANAGE.COMMUNITIES', true, false, NULL, true, 'menu.community', 'perm.text.community');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (10, 'Countries', '/country', 3, 2, 2, 'Manage Countries', 'MANAGE.COUNTRIES', true, false, NULL, true, 'menu.country', 'perm.text.country');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (14, 'Districts', '/district', 3, 2, 2, 'Manage Districts', 'MANAGE.DISTRICTS', true, false, NULL, true, 'menu.district', 'perm.text.district');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (9, 'Grade Levels', '/academic/gradelevel', 3, 2, 7, 'Manage Grade Levels', 'MANAGE.GRADE.LEVELS', true, false, NULL, true, 'menu.grade.level', 'perm.text.grade.level');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (13, 'Groups', '/security/group', 3, 2, 11, 'Manage User Groups', 'MANAGE.GROUPS', true, false, NULL, true, 'menu.user.group', 'perm.text.user.group');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (12, 'Users', '/security/user', 3, 2, 11, 'Manage Users', 'MANAGE.USERS', true, false, NULL, true, 'menu.user', 'perm.text.user');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (16, 'Titles', '/title', 3, 2, 2, 'Manage Titles', 'MANAGE.TITLES', true, false, NULL, true, 'menu.title', 'perm.text.title');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (17, 'Academic Periods', '/academic/term/semester', 3, 2, 7, 'Manage Terms/Semesters', 'MANAGE.TERMS.SEMESTERS', true, false, NULL, true, 'menu.academic.period', 'perm.text.academic.period');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (18, 'Genders', '/gender', 3, 2, 2, 'Manage Genders', 'MANAGE.GENDERS', true, false, 'perm.comm.gender', true, 'menu.gender', 'perm.text.gender');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (1, 'Student Search', '/student/search/form', 1, 1, NULL, 'Student Search', 'STUDENT.SEARCH', true, false, NULL, true, 'menu.student.search', 'perm.text.student.search');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (39, 'Grade Summary', '/classgroup/grade/summary/term/start', 1, 2, 28, 'View Class Grade Summary', 'VIEW.CLASS.TERM.GRADE.SUMMARY', true, false, NULL, true, 'menu.class.grade.term.summary', 'perm.text.class.grade.term.summary');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (23, 'Qualifications', '/academic/qualification', 3, 2, 7, 'Manage qualifications', 'MANAGE.ACADEMIC.QUALIFICATIONS', true, false, 'perm.comm.qualification', true, 'menu.qualification', 'perm.text.qualification');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (37, 'Student Grades', '/classgroup/student/grade/subject/start', 1, 2, 28, 'Record Student Grades', 'RECORD.STUDENT.GRADES', true, false, NULL, true, 'menu.student.grade', 'perm.text.student.grade');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (26, 'Subjects', '/academic/subject', 3, 2, 7, 'Manage Subjects', 'MANAGE.SUBJECTS', true, false, NULL, true, 'menu.subject', 'perm.text.subject');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (29, 'Define Groups', '/classgroup/classgroup', 1, 2, 28, 'Manage Class Groups', 'MANAGE.CLASS.GROUPS', true, false, NULL, true, 'menu.class.group', 'perm.text.class.group');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (33, 'Subject Teachers', '/classgroup/subject/teacher/start', 1, 2, 28, 'View subject teachers', 'VIEW.SUBJECT.TEACHERS', true, false, NULL, true, 'menu.subject.teacher', 'perm.text.subject.teacher');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (38, 'Override Teacher Subject Relation', NULL, 1, NULL, NULL, 'Override Subject Teacher Relation', 'OVERRIDE.SUBJECT.TEACHER.RELATION', false, false, NULL, true, 'menu.override.subject.teacher.relation', 'perm.text.override.subject.teacher.relation');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (34, 'View Student Medical', NULL, 2, NULL, NULL, 'View Student Medical', 'VIEW.STUDENT.MEDICAL', false, false, NULL, true, 'menu.student.medical.view', 'perm.text.student.medical.view');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (35, 'View Academic Summary', NULL, 2, NULL, NULL, 'View Academic Summary', 'VIEW.ACADEMIC.SUMMARY', false, false, NULL, true, 'menu.academic.summary.view', 'perm.text.academic.summary.view');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (6, 'Triggers', '/sync/trigger', 5, 1, NULL, 'Manage Sync Triggers', 'MANAGE.SYNC.TRIGGERS', true, false, NULL, true, 'menu.sync.trigger', 'perm.text.sync.trigger');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (42, 'Node Groups', '/sync/nodegroup', 5, 1, NULL, 'Manage Node Groups', 'SYNC.MANAGE.NODE.GROUPS', true, false, NULL, true, 'menu.sync.node.group', 'perm.text.sync.node.group');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (43, 'Send grade via email', NULL, 2, NULL, NULL, 'Send Grades via Email', 'SEND.GRADE.VIA.EMAIL', false, false, NULL, true, 'menu.grade.via.email', 'perm.text.grade.via.email');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (45, 'Medical Condition Types', '/medicalconditiontype', 3, 2, 7, 'Manage Medical Condition Types', 'MANAGE.MEDICAL.CONDITION.TYPES', true, false, NULL, true, 'menu.medical.condition.type', 'perm.text.medical.condition.type');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (46, 'Edit Student Medical', NULL, 2, NULL, NULL, 'Edit Student Medical', 'EDIT.STUDENT.MEDICAL', false, false, NULL, true, 'menu.student.medical.edit', 'perm.text.student.medical.edit');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (48, 'Ethnicities', '/ethnicity', 3, 2, 2, 'Manage Ethnicities', 'MANAGE.ETHNICITIES', true, false, NULL, true, 'menu.ethnicity', 'perm.text.ethnicity');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (49, 'Register Student', NULL, 2, NULL, NULL, 'Register Student', 'REGISTER.STUDENT', false, false, NULL, true, 'menu.register.student', 'perm.text.register.student');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (51, 'Edit Legal Guardians', NULL, 2, NULL, NULL, 'Edit Legal Guardians', 'EDIT.LEGAL.GUARDIANS', false, false, NULL, true, 'menu.legal.guardian.edit', 'perm.text.legal.guardian.edit');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (52, 'Edit Student Photo', NULL, 2, NULL, NULL, 'Edit Student Photo', 'EDIT.STUDENT.PHOTO', false, false, NULL, true, 'menu.student.photo.edit', 'perm.text.student.photo.edit');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (54, 'Is Teacher', NULL, 1, NULL, NULL, 'Is Teacher?', 'IS.TEACHER', false, false, NULL, true, 'menu.is.teacher', 'perm.text.is.teacher');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (55, 'Grade Activities', '/academic/grade/activity', 3, 2, 7, 'Manage Grade Activities', 'MANAGE.GRADING.ACTIVITIES', true, false, 'perm.comm.grade.activity', true, 'menu.grade.activity', 'perm.text.grade.activity');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (56, 'Class Group Overview', NULL, 1, NULL, NULL, 'Class Group Overview', 'CLASS.GROUP.OVERVIEW', false, false, NULL, true, 'menu.class.group.overview', 'perm.text.class.group.overview');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (57, 'School Overview', NULL, 1, NULL, NULL, 'School Overview', 'SCHOOL.OVERVIEW', false, false, NULL, true, 'menu.school.overview', 'perm.text.school.overview');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (59, 'View Printable History', NULL, 1, NULL, NULL, 'View Grade Report History', 'VIEW.GRADE.REPORT.HISTORY', false, false, NULL, true, 'menu.grade.report.history', 'perm.text.grade.report.history');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (60, 'Modify Facility Emblem', NULL, 3, NULL, NULL, 'Modify Facility Emblem', 'MODIFY.FACILITY.EMBLEM', false, false, NULL, true, 'menu.modify.facility.emblem', 'perm.text.modify.facility.emblem');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (7, 'Academic', NULL, 3, 1, NULL, 'Manage Academic Info.', NULL, true, true, NULL, true, 'menu.container.academic', 'perm.text.manage.academic');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (64, 'Performance', NULL, 4, 1, NULL, 'Performance Reports', NULL, true, true, NULL, true, 'menu.container.performance', 'perm.text.performance.reports');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (75, 'Attendance', NULL, 4, 1, NULL, 'Attendance Reports', NULL, true, true, NULL, true, 'menu.container.attendance', 'perm.text.attendance.reports');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (80, 'Billing', NULL, 3, 1, NULL, 'Fee Billing', NULL, true, true, NULL, true, 'menu.container.billing', 'perm.text.billing');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (89, 'Financial', NULL, 4, 1, NULL, 'Financial Reports', NULL, true, true, NULL, true, 'menu.container.financial', 'perm.text.financial.reports');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (27, 'Classrooms', '/academic/classroom', 3, 2, 103, 'Manage Classrooms', 'MANAGE.CLASSROOMS', true, false, NULL, true, 'menu.classroom', 'perm.text.classroom');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (95, 'Advanced', NULL, 3, 1, NULL, 'Advanced', NULL, true, true, NULL, true, 'menu.container.advanced', 'perm.text.advanced');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (28, 'Class Groups', '/academic/classgroup', 1, 1, NULL, 'Class Groups', NULL, true, true, NULL, true, 'menu.container.class.group', 'perm.text.class.group');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (25, 'Student School Assignment', NULL, 1, NULL, NULL, 'Student School Assignment', 'STUDENT.SCHOOL.ASSIGNMENT', false, false, 'perm.comm.student.school.assignment', true, 'menu.student.school.assignment', 'perm.text.student.school.assignment');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (97, 'Extra-Curricular Activity Categories', '/xtra/activity/type', 3, 2, 7, 'Manage Extra-Curricular Activity Types', 'MANAGE.XTRA.CURRICULAR.ACTIVITY.TYPE', true, false, NULL, true, 'menu.extra.curricular.activity.type', 'perm.text.extra.curricular.activity.type');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (65, 'Subject Performance', '/rpt/class/group/subject/performance/form', 4, 2, 64, 'Subject Performance Report', 'CLASS.GROUP.SUBJECT.PERFORMANCE.REPORT', true, false, 'perm.comm.rpt.subject.performance', true, 'menu.rpt.subject.performance', 'perm.text.rpt.subject.performance');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (66, 'Sync Status', '/sync/facility/status', 5, 1, NULL, 'View facility sync status', 'SYNC.FACILITY.HEARTBEAT.STATUS', true, false, 'perm.comm.sync.status.heartbeat', true, 'menu.sync.status.heartbeat', 'perm.text.sync.status.heartbeat');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (67, 'Grade Translations', '/academic/grade/mapping', 3, 2, 7, 'Translate numeric grades', 'MANAGE.GRADE.TRANSLATIONS', true, false, 'perm.comm.grade.translation', true, 'menu.grade.translation', 'perm.text.grade.translation');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (68, 'External Access', NULL, 3, NULL, NULL, 'Manage External Access', 'MANAGE.EXTERNAL.ACCESS', false, false, 'perm.comm.external.access', true, 'menu.external.access', 'perm.text.external.access');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (69, 'View Attendance Summary', NULL, 2, NULL, NULL, 'View Attendance Summary', 'VIEW.ATTENDANCE.SUMMARY', false, false, 'perm.comm.attendance.summary', true, 'menu.attendance.summary', 'perm.text.attendance.summary');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (71, 'Record Disciplinary Actions', NULL, 2, NULL, NULL, 'Record Disciplinary Actions', 'RECORD.DISCIPLINARY.ACTION', false, false, 'perm.comm.record.disciplinary.action', true, 'menu.record.disciplinary.action', 'perm.text.record.disciplinary.action');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (72, 'Disciplinary Action Admin', NULL, 2, NULL, NULL, 'Disciplinary Action Admin', 'DISCIPLINARY.ACTION.ADMIN', false, false, 'perm.comm.disciplinary.action.admin', true, 'menu.disciplinary.action.admin', 'perm.text.disciplinary.action.admin');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (73, 'Disciplinary Action Types', '/disciplinary/action/type', 3, 2, 2, 'Manage Disciplinary Action Types', 'MANAGE.DISCIPLINARY.ACTION.TYPES', true, false, 'perm.comm.disciplinary.action.type', true, 'menu.disciplinary.action.type', 'perm.text.disciplinary.action.type');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (74, 'Disciplinary Not Administered Reasons', '/disciplinary/action/nadminister/reason', 3, 2, 2, 'Manage Disciplinary Action Not Admin. Reasons', 'MANAGE.DISCIPLINARY.NOT.ADMIN.REASONS', true, false, 'perm.comm.disciplinary.action.not.admin.reason', true, 'menu.disciplinary.action.not.admin.reason', 'perm.text.disciplinary.action.not.admin.reason');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (76, 'Class Groups By Date Range', '/rpt/attendance/classgroup/date/range/form', 4, 2, 75, 'Class Group Attendance By Date Range', 'ATT.CLASS.GROUP.BY.DATE.RANGE', true, false, 'perm.comm.rpt.attendance.class.group.date.range', true, 'menu.rpt.attendance.class.group.date.range', 'perm.text.rpt.attendance.class.group.date.range');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (78, 'Student Performance By Grade', '/rpt/student/performance/by/grade/form', 4, 2, 64, 'Student Performance By Grade Report', 'STUDENT.PERFORMANCE.BY.GRADE.REPORT', true, false, 'perm.comm.rpt.performance.by.grade', true, 'menu.rpt.performance.by.grade', 'perm.text.rpt.performance.by.grade');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (79, 'Student Subjects', '/class/group/student/subject/start', 1, 2, 28, 'Assign Students to Subjects', 'CLASS.GROUP.STUDENT.SUBJECT.ASSIGNMENT', true, false, 'perm.comm.student.subject.assignment', true, 'menu.student.subject.assignment', 'perm.text.student.subject.assignment');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (82, 'Payment Methods', '/billing/payment/method', 3, 2, 80, 'Manage Payment Methods', 'MANAGE.PAYMENT.METHODS', true, false, 'perm.comm.payment.method', true, 'menu.payment.method', 'perm.text.payment.method');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (83, 'School Fee Types', '/billing/fee/type', 3, 2, 80, 'Manage Types of School Fees', 'MANAGE.FEE.TYPES', true, false, 'perm.comm.fee.type', true, 'menu.fee.type', 'perm.text.fee.type');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (84, 'Define / Manage School Fees', '/billing/define/school/fees', 3, 2, 80, 'Manage School Fees', 'MANAGE.SCHOOL.FEES', true, false, 'perm.comm.define.school.fee', true, 'menu.define.school.fee', 'perm.text.define.school.fee');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (85, 'Cancellation Reasons', '/billing/fee/cancellation/reason', 3, 2, 80, 'Manage Payment Cancellation Reasons', 'MANAGE.PAYMENT.CANCELLATION.REASONS', true, false, NULL, true, 'menu.payment.cancellation.reason', 'perm.text.payment.cancellation.reason');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (86, 'Cancel Fee Payments', NULL, 3, NULL, NULL, 'Cancel Fee Payments', 'CANCEL.FEE.PAYMENTS', false, false, 'perm.comm.cancel.fee.payment', true, 'menu.cancel.fee.payment', 'perm.text.cancel.fee.payment');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (87, 'View Student Billing', NULL, 1, NULL, NULL, 'View Student Billing Info.', 'VIEW.STUDENT.BILLING.INFO', false, false, 'perm.comm.student.billing.info', true, 'menu.student.billing.info', 'perm.text.student.billing.info');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (88, 'Record Fee Payment', NULL, 1, NULL, NULL, 'Record School Fee Payment', 'RECORD.STUDENT.FEE.PAYMENT', false, false, 'perm.comm.record.school.fee.payment', true, 'menu.record.school.fee.payment', 'perm.text.record.school.fee.payment');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (90, 'Student Fee Payment', '/rpt/billing/fee/payment/status/form', 4, 2, 89, 'Student Fee Payment Report', 'FEE.PAYMENT.STATUS.REPORT', true, false, 'perm.comm.rpt.student.fee.payment', true, 'menu.rpt.student.fee.payment', 'perm.text.rpt.student.fee.payment');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (91, 'Receipt Summary', '/rpt/billing/receipt/summary/form', 4, 2, 89, 'Fee Payment Receipt Summary', 'FEE.PAYMENT.RECEIPT.SUMMARY.REPORT', true, false, 'perm.comm.receipt.summary', true, 'menu.receipt.summary', 'perm.text.receipt.summary');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (93, 'End School Assignment', NULL, 1, NULL, NULL, 'Terminate Student School Assignment', 'END.STUDENT.SCHOOL.ASSIGNMENT', false, false, 'perm.comm.school.assignment.end', true, 'menu.school.assignment.end', 'perm.text.school.assignment.end');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (96, 'App Permissions', '/advanced/app/permissions', 3, 2, 95, 'Manage App Permissions', 'MANAGE.APPLICATION.PERMISSIONS', true, false, 'perm.comm.app.permissions', true, 'menu.app.permissions', 'perm.text.app.permissions');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (92, 'Generate Transcript', NULL, 1, NULL, NULL, 'Generate Student Transcript', 'GENERATE.STUDENT.TRANSCRIPT', false, false, 'perm.comm.generate.transcript', true, 'menu.generate.transcript', 'perm.text.generate.transcript');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (94, 'Undo School Assignment Termination', NULL, 1, NULL, NULL, 'Undo School Assignment Termination', 'UNDO.SCHOOL.ASSIGNMENT.TERMINATION', false, false, 'perm.comm.school.assignment.end.undo', true, 'menu.school.assignment.end.undo', 'perm.text.school.assignment.end.undo');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (98, 'Extra-Curricular Activities', '/xtra/activity', 3, 2, 7, 'Manage Extra-Curricular Activities', 'MANAGE.EXTRA.CURRICULAR.ACTIVITY', true, false, NULL, true, 'menu.extra.curricular.activity', 'perm.text.extra.curricular.activity');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (99, 'menu.student.extra.curricular.activity', NULL, 2, NULL, NULL, 'Manage Student Extra-Curricular Activities', 'EDIT.STUDENT.EXTRACURRICULAR.ACTIVITY', false, false, NULL, true, 'Student Extra-Curricular Activities', 'perm.text.student.extra.curricular.activity');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (100, 'View Student Extra-Curricular Activities', NULL, 2, NULL, NULL, 'View Student Extra-Curricular Activities', 'VIEW.STUDENT.EXTRACURRICULAR.ACTIVITY', false, false, NULL, true, 'menu.view.student.extra.curricular.activity', 'perm.text.view.student.extra.curricular.activity');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (32, 'Class Group Subjects', '/classgroup/academic/year/assignment', 1, 2, 28, 'Manage class groups years', 'ASSIGN.CLASS.GROUP.ACADEMIC.YEAR', true, false, NULL, true, 'menu.class.group.subjects', 'perm.text.class.group.subjects');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (3, 'Facility Types', '/facilitytype', 3, 2, 11, 'Manage Facility Types', 'MANAGE.FACILITY.TYPES', true, false, NULL, true, 'menu.facility.type', 'perm.text.facility.type');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (15, 'Relationship Types', '/relationshiptype', 3, 2, 2, 'Manage Relationships', 'MANAGE.RELATIONSHIP.TYPES', true, false, NULL, true, 'menu.relationship.type', 'perm.text.relationship.type');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (19, 'Identification Types', '/identification/type', 3, 2, 2, 'Manage Identification Types', 'MANAGE.ID.TYPES', true, false, 'perm.comm.identification.type', true, 'menu.identification.type', 'perm.text.identification.type');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (40, 'Assign Subject Teachers', NULL, 1, NULL, NULL, 'Assign Subject Teachers', 'ASSIGN.SUBJECT.TEACHERS', false, false, NULL, true, 'menu.assign.subject.teacher', 'perm.text.assign.subject.teacher');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (30, 'Assign Students', '/classgroup/student/assignment/start', 1, 2, 28, 'Assign Students to Class Groups', 'STUDENT.CLASS.GROUP.ASSIGNMENT', true, false, NULL, true, 'menu.assign.student', 'perm.text.assign.student');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (41, 'Override Homeroom Teacher Privilege', NULL, 1, NULL, NULL, 'Homeroom Teacher Permission', 'OVERRIDE.HOMEROOM.TEACHER.PRIVILEGE', false, false, NULL, true, 'menu.override.homeroom.teacher.privilege', 'perm.text.override.homeroom.teacher.privilege');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (44, 'Grade Summary PDF', NULL, 2, NULL, NULL, 'Generate Term Grade PDF', 'GENERATE.TERM.GRADE.PDF', false, false, NULL, true, 'menu.grade.summary.pdf', 'perm.text.grade.summary.pdf');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (47, 'Religions', '/religion', 3, 2, 2, 'Manage Religions', 'MANAGE.RELIGIONS', true, false, NULL, true, 'menu.religion', 'perm.text.religion');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (50, 'Edit Student Details', NULL, 2, NULL, NULL, 'Edit Student Details', 'EDIT.STUDENT.DETAILS', false, false, NULL, true, 'menu.student.edit', 'perm.text.student.edit');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (53, 'Grade Summary Excel', NULL, 2, NULL, NULL, 'Generate Term Grade Spreadsheet', 'GENERATE.TERM.GRADE.EXCEL', false, false, NULL, true, 'menu.grade.summary.spreadsheet', 'perm.text.grade.summary.spreadsheet');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (58, 'Head Teacher Designations', '/academic/head/teacher/designation', 3, 2, 7, 'Head Teacher Designations', 'MANAGE.HEAD.TEACHER.DESIGNATION', true, false, 'perm.comm.head.teacher.designation', true, 'menu.head.teacher.designation', 'perm.text.head.teacher.designation');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (61, 'Educational Holidays', '/admin/holiday', 3, 2, 7, 'Manage Educational Holidays', 'MANAGE.EDUCATIONAL.HOLIDAYS', true, false, 'perm.comm.educational.holiday', true, 'menu.educational.holiday', 'perm.text.educational.holiday');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (63, 'School Off-Days', NULL, 3, NULL, NULL, 'Manage Facility Off-days', 'MANAGE.FACILITY.OFF.DAYS', false, false, 'perm.comm.facility.offDays', true, 'menu.facility.offDays', 'perm.text.facility.offDays');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (70, 'External Users', '/security/user/external', 3, 2, 11, 'Manage External Users', 'MANAGE.EXTERNAL.USERS', true, false, 'perm.comm.external.user', true, 'menu.external.user', 'perm.text.external.user');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (77, 'Students By Class Group', '/rpt/student/class/group/attendance/summary/form', 4, 2, 75, 'Student Attendance By Class Group By Date Range', 'ATT.STUDENT.CLASS.GROUP.BY.DATE.RANGE', true, false, 'perm.comm.rpt.attendance.class.group.date.range.table', true, 'menu.rpt.attendance.class.group.date.range.table', 'perm.text.rpt.attendance.class.group.date.range.table');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (101, 'View Student Subject History', NULL, 2, NULL, NULL, 'View Student Subject History', 'VIEW.STUDENT.SUBJECT.HISTORY', false, false, 'perm.comm.student.subject.history', true, 'menu.student.subject.history', 'perm.text.student.subject.history');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (102, 'Incident Types', '/incident/type', 3, 2, 2, 'Manage Incident Types', 'MANAGE.INCIDENT.TYPES', true, false, NULL, true, 'menu.incident.type', 'perm.text.incident.type');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (103, 'School', NULL, 3, 1, NULL, 'Manage School Specific Data', NULL, true, true, NULL, true, 'menu.container.school', 'perm.text.container.school');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (20, 'Teachers', '/academic/teacher', 3, 2, 103, 'Manage Teachers - Global', 'GLOBAL.TEACHER.MANAGEMENT', true, false, 'perm.comm.global.teacher', true, 'menu.global.teacher', 'perm.text.global.teacher');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (62, 'Re-open Class Groups', '/class/group/academic/period/reopen', 3, 2, 103, 'Re-open Class Groups', 'REOPEN.CLASS.GROUPS', true, false, 'perm.comm.class.group.reopen', true, 'menu.class.group.reopen', 'perm.text.class.group.reopen');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (104, 'Attendance Interval', '/attendance/interval', 3, 2, 103, 'Manage Attendance Interval', 'MANAGE.ATTENDANCE.INTERVAL', true, false, 'perm.comm.attendance.interval', true, 'menu.attendance.interval', 'perm.text.attendance.interval');
INSERT INTO edu_permissions (permission_id, submenu_name_key, submenu_name, url, category_id, level, level1_id, perm_text, perm_text_key, constant, is_menu, is_container, comments, alive) VALUES (108,'menu.student.liberal.view.allowed','View Student Info (Expanded)',NULL,1,NULL,NULL,'View Student Info (Expanded)','perm.text.liberal.view.allowed','OVERRIDE.STUDENT.VIEW.EXPANDED.STATUS',false,false,'perm.comm.liberal.view.allowed', true);
INSERT INTO edu_permissions (permission_id,submenu_name_key,submenu_name,url,category_id,level,level1_id,perm_text,perm_text_key,constant,is_menu,is_container,comments, alive) VALUES (109,'menu.class.group.list.by.year','Listing By Academic Year','/class/group/school/overview/start',1,2,28,'View Class Groups by Academic Year','perm.text.class.group.list.by.year','LIST.CLASS.GROUP.BY.YEAR',true,false,'perm.comm.class.group.list.by.year', true);
INSERT INTO edu_permissions (permission_id,submenu_name_key,submenu_name,url,category_id,level,level1_id,perm_text,perm_text_key,constant,is_menu,is_container,comments, alive) VALUES (110,'menu.property.file','Property file','/property/file/get',3,2,95,'Manage application properties','perm.text.property.file','ADMIN.PROPERTY.FILE',true,false,null, true);
INSERT INTO edu_permissions (permission_id,submenu_name_key,submenu_name,url,category_id,level,level1_id,perm_text,perm_text_key,constant,is_menu,is_container,comments, alive) VALUES (111,'menu.server.stats','Server Status','/server/stats/get',3,2,95,'View server statistics','perm.text.server.stats','ADMIN.SERVER.STATUS',true,false,null,true);
INSERT INTO edu_permissions (permission_id,submenu_name_key,submenu_name,url,category_id,level,level1_id,perm_text,perm_text_key,constant,is_menu,is_container,comments, alive) VALUES (112,'menu.opcache.status','Manage Cache (OP)','/server/opcache/status',3,2,95,'Manage application cache','perm.text.opcache.status','ADMIN.OPCACHE.MANAGE',true,false,null,true);
INSERT INTO edu_permissions (permission_id,submenu_name_key,submenu_name,url,category_id,level,level1_id,perm_text,perm_text_key,constant,is_menu,is_container,comments) VALUES (113,'menu.grade.activity.super.admin','Grade Activity Super Admin',null,1,null,null,'Subject grade activity super admin','perm.text.grade.activity.super.admin','GRADE.ACTIVITY.SUPER.ADMIN',false,false,'perm.comm.grade.activity.super.admin');
INSERT INTO edu_permissions (permission_id,submenu_name_key,submenu_name,url,category_id,level,level1_id,perm_text,perm_text_key,constant,is_menu,is_container,comments) VALUES (114,'menu.manage.sports.houses','Sports Houses','/sports/house',3,2,103,'Manage sports houses','perm.text.manage.sports.houses','MANAGE.SPORTS.HOUSES',true,false,null);
*/
------>>>>>>>>>
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (22, 'Attendance', '/attendance', 4, 1, NULL, 'Report Summary', 'REPORT.SUMMARY', true, false, NULL, false, NULL, NULL);
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (2, 'General', NULL, 3, 1, NULL, 'General Admin', NULL, true, true, NULL, true, 'menu.container.general', 'perm.text.general.admin');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (11, 'Security', NULL, 3, 1, NULL, 'Security', NULL, true, true, NULL, true, 'menu.container.security', 'perm.text.security');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (36, 'View Disciplinary Summary', NULL, 2, NULL, NULL, 'View Disciplinary Summary', 'VIEW.DISCIPLINARY.SUMMARY', false, false, NULL, true, 'menu.disciplinary.action.view', 'perm.text.disciplinary.action.view');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (8, 'Academic Year', '/academic/year', 3, 2, 7, 'Manage Academic Years', 'MANAGE.ACADEMIC.YEARS', true, false, NULL, true, 'menu.academic.year', 'perm.text.academic.year');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (31, 'Teacher Details', NULL, 1, NULL, NULL, 'Manage Teacher Details', 'MANAGE.TEACHER.DETAILS', false, false, NULL, true, 'menu.teacher.detail', 'perm.text.teacher.detail');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (4, 'Facilities', '/facility', 3, 2, 2, 'Manage Facilities', 'MANAGE.FACILITIES', true, false, NULL, true, 'menu.facility', 'perm.text.facility');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (5, 'Communities', '/community', 3, 2, 2, 'Manage Communities', 'MANAGE.COMMUNITIES', true, false, NULL, true, 'menu.community', 'perm.text.community');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (10, 'Countries', '/country', 3, 2, 2, 'Manage Countries', 'MANAGE.COUNTRIES', true, false, NULL, true, 'menu.country', 'perm.text.country');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (14, 'Districts', '/district', 3, 2, 2, 'Manage Districts', 'MANAGE.DISTRICTS', true, false, NULL, true, 'menu.district', 'perm.text.district');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (9, 'Grade Levels', '/academic/gradelevel', 3, 2, 7, 'Manage Grade Levels', 'MANAGE.GRADE.LEVELS', true, false, NULL, true, 'menu.grade.level', 'perm.text.grade.level');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (13, 'Groups', '/security/group', 3, 2, 11, 'Manage User Groups', 'MANAGE.GROUPS', true, false, NULL, true, 'menu.user.group', 'perm.text.user.group');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (12, 'Users', '/security/user', 3, 2, 11, 'Manage Users', 'MANAGE.USERS', true, false, NULL, true, 'menu.user', 'perm.text.user');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (16, 'Titles', '/title', 3, 2, 2, 'Manage Titles', 'MANAGE.TITLES', true, false, NULL, true, 'menu.title', 'perm.text.title');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (17, 'Academic Periods', '/academic/term/semester', 3, 2, 7, 'Manage Terms/Semesters', 'MANAGE.TERMS.SEMESTERS', true, false, NULL, true, 'menu.academic.period', 'perm.text.academic.period');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (18, 'Genders', '/gender', 3, 2, 2, 'Manage Genders', 'MANAGE.GENDERS', true, false, 'perm.comm.gender', true, 'menu.gender', 'perm.text.gender');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (1, 'Student Search', '/student/search/form', 1, 1, NULL, 'Student Search', 'STUDENT.SEARCH', true, false, NULL, true, 'menu.student.search', 'perm.text.student.search');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (39, 'Grade Summary', '/classgroup/grade/summary/term/start', 1, 2, 28, 'View Class Grade Summary', 'VIEW.CLASS.TERM.GRADE.SUMMARY', true, false, NULL, true, 'menu.class.grade.term.summary', 'perm.text.class.grade.term.summary');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (23, 'Qualifications', '/academic/qualification', 3, 2, 7, 'Manage qualifications', 'MANAGE.ACADEMIC.QUALIFICATIONS', true, false, 'perm.comm.qualification', true, 'menu.qualification', 'perm.text.qualification');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (37, 'Student Grades', '/classgroup/student/grade/subject/start', 1, 2, 28, 'Record Student Grades', 'RECORD.STUDENT.GRADES', true, false, NULL, true, 'menu.student.grade', 'perm.text.student.grade');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (26, 'Subjects', '/academic/subject', 3, 2, 7, 'Manage Subjects', 'MANAGE.SUBJECTS', true, false, NULL, true, 'menu.subject', 'perm.text.subject');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (29, 'Define Groups', '/classgroup/classgroup', 1, 2, 28, 'Manage Class Groups', 'MANAGE.CLASS.GROUPS', true, false, NULL, true, 'menu.class.group', 'perm.text.class.group');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (33, 'Subject Teachers', '/classgroup/subject/teacher/start', 1, 2, 28, 'View subject teachers', 'VIEW.SUBJECT.TEACHERS', true, false, NULL, true, 'menu.subject.teacher', 'perm.text.subject.teacher');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (38, 'Override Teacher Subject Relation', NULL, 1, NULL, NULL, 'Override Subject Teacher Relation', 'OVERRIDE.SUBJECT.TEACHER.RELATION', false, false, NULL, true, 'menu.override.subject.teacher.relation', 'perm.text.override.subject.teacher.relation');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (34, 'View Student Medical', NULL, 2, NULL, NULL, 'View Student Medical', 'VIEW.STUDENT.MEDICAL', false, false, NULL, true, 'menu.student.medical.view', 'perm.text.student.medical.view');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (35, 'View Academic Summary', NULL, 2, NULL, NULL, 'View Academic Summary', 'VIEW.ACADEMIC.SUMMARY', false, false, NULL, true, 'menu.academic.summary.view', 'perm.text.academic.summary.view');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (6, 'Triggers', '/sync/trigger', 5, 1, NULL, 'Manage Sync Triggers', 'MANAGE.SYNC.TRIGGERS', true, false, NULL, true, 'menu.sync.trigger', 'perm.text.sync.trigger');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (42, 'Node Groups', '/sync/nodegroup', 5, 1, NULL, 'Manage Node Groups', 'SYNC.MANAGE.NODE.GROUPS', true, false, NULL, true, 'menu.sync.node.group', 'perm.text.sync.node.group');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (43, 'Send grade via email', NULL, 2, NULL, NULL, 'Send Grades via Email', 'SEND.GRADE.VIA.EMAIL', false, false, NULL, true, 'menu.grade.via.email', 'perm.text.grade.via.email');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (45, 'Medical Condition Types', '/medicalconditiontype', 3, 2, 7, 'Manage Medical Condition Types', 'MANAGE.MEDICAL.CONDITION.TYPES', true, false, NULL, true, 'menu.medical.condition.type', 'perm.text.medical.condition.type');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (46, 'Edit Student Medical', NULL, 2, NULL, NULL, 'Edit Student Medical', 'EDIT.STUDENT.MEDICAL', false, false, NULL, true, 'menu.student.medical.edit', 'perm.text.student.medical.edit');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (48, 'Ethnicities', '/ethnicity', 3, 2, 2, 'Manage Ethnicities', 'MANAGE.ETHNICITIES', true, false, NULL, true, 'menu.ethnicity', 'perm.text.ethnicity');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (49, 'Register Student', NULL, 2, NULL, NULL, 'Register Student', 'REGISTER.STUDENT', false, false, NULL, true, 'menu.register.student', 'perm.text.register.student');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (51, 'Edit Legal Guardians', NULL, 2, NULL, NULL, 'Edit Legal Guardians', 'EDIT.LEGAL.GUARDIANS', false, false, NULL, true, 'menu.legal.guardian.edit', 'perm.text.legal.guardian.edit');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (52, 'Edit Student Photo', NULL, 2, NULL, NULL, 'Edit Student Photo', 'EDIT.STUDENT.PHOTO', false, false, NULL, true, 'menu.student.photo.edit', 'perm.text.student.photo.edit');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (54, 'Is Teacher', NULL, 1, NULL, NULL, 'Is Teacher?', 'IS.TEACHER', false, false, NULL, true, 'menu.is.teacher', 'perm.text.is.teacher');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (55, 'Grade Activities', '/academic/grade/activity', 3, 2, 7, 'Manage Grade Activities', 'MANAGE.GRADING.ACTIVITIES', true, false, 'perm.comm.grade.activity', true, 'menu.grade.activity', 'perm.text.grade.activity');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (56, 'Class Group Overview', NULL, 1, NULL, NULL, 'Class Group Overview', 'CLASS.GROUP.OVERVIEW', false, false, NULL, true, 'menu.class.group.overview', 'perm.text.class.group.overview');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (57, 'School Overview', NULL, 1, NULL, NULL, 'School Overview', 'SCHOOL.OVERVIEW', false, false, NULL, true, 'menu.school.overview', 'perm.text.school.overview');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (59, 'View Printable History', NULL, 1, NULL, NULL, 'View Grade Report History', 'VIEW.GRADE.REPORT.HISTORY', false, false, NULL, true, 'menu.grade.report.history', 'perm.text.grade.report.history');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (60, 'Modify Facility Emblem', NULL, 3, NULL, NULL, 'Modify Facility Emblem', 'MODIFY.FACILITY.EMBLEM', false, false, NULL, true, 'menu.modify.facility.emblem', 'perm.text.modify.facility.emblem');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (7, 'Academic', NULL, 3, 1, NULL, 'Manage Academic Info.', NULL, true, true, NULL, true, 'menu.container.academic', 'perm.text.manage.academic');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (64, 'Performance', NULL, 4, 1, NULL, 'Performance Reports', NULL, true, true, NULL, true, 'menu.container.performance', 'perm.text.performance.reports');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (75, 'Attendance', NULL, 4, 1, NULL, 'Attendance Reports', NULL, true, true, NULL, true, 'menu.container.attendance', 'perm.text.attendance.reports');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (80, 'Billing', NULL, 3, 1, NULL, 'Fee Billing', NULL, true, true, NULL, true, 'menu.container.billing', 'perm.text.billing');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (89, 'Financial', NULL, 4, 1, NULL, 'Financial Reports', NULL, true, true, NULL, true, 'menu.container.financial', 'perm.text.financial.reports');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (27, 'Classrooms', '/academic/classroom', 3, 2, 103, 'Manage Classrooms', 'MANAGE.CLASSROOMS', true, false, NULL, true, 'menu.classroom', 'perm.text.classroom');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (95, 'Advanced', NULL, 3, 1, NULL, 'Advanced', NULL, true, true, NULL, true, 'menu.container.advanced', 'perm.text.advanced');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (28, 'Class Groups', '/academic/classgroup', 1, 1, NULL, 'Class Groups', NULL, true, true, NULL, true, 'menu.container.class.group', 'perm.text.class.group');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (25, 'Student School Assignment', NULL, 1, NULL, NULL, 'Student School Assignment', 'STUDENT.SCHOOL.ASSIGNMENT', false, false, 'perm.comm.student.school.assignment', true, 'menu.student.school.assignment', 'perm.text.student.school.assignment');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (97, 'Extra-Curricular Activity Categories', '/xtra/activity/type', 3, 2, 7, 'Manage Extra-Curricular Activity Types', 'MANAGE.XTRA.CURRICULAR.ACTIVITY.TYPE', true, false, NULL, true, 'menu.extra.curricular.activity.type', 'perm.text.extra.curricular.activity.type');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (66, 'Sync Status', '/sync/facility/status', 5, 1, NULL, 'View facility sync status', 'SYNC.FACILITY.HEARTBEAT.STATUS', true, false, 'perm.comm.sync.status.heartbeat', true, 'menu.sync.status.heartbeat', 'perm.text.sync.status.heartbeat');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (67, 'Grade Translations', '/academic/grade/mapping', 3, 2, 7, 'Translate numeric grades', 'MANAGE.GRADE.TRANSLATIONS', true, false, 'perm.comm.grade.translation', true, 'menu.grade.translation', 'perm.text.grade.translation');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (68, 'External Access', NULL, 3, NULL, NULL, 'Manage External Access', 'MANAGE.EXTERNAL.ACCESS', false, false, 'perm.comm.external.access', true, 'menu.external.access', 'perm.text.external.access');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (69, 'View Attendance Summary', NULL, 2, NULL, NULL, 'View Attendance Summary', 'VIEW.ATTENDANCE.SUMMARY', false, false, 'perm.comm.attendance.summary', true, 'menu.attendance.summary', 'perm.text.attendance.summary');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (71, 'Record Disciplinary Actions', NULL, 2, NULL, NULL, 'Record Disciplinary Actions', 'RECORD.DISCIPLINARY.ACTION', false, false, 'perm.comm.record.disciplinary.action', true, 'menu.record.disciplinary.action', 'perm.text.record.disciplinary.action');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (72, 'Disciplinary Action Admin', NULL, 2, NULL, NULL, 'Disciplinary Action Admin', 'DISCIPLINARY.ACTION.ADMIN', false, false, 'perm.comm.disciplinary.action.admin', true, 'menu.disciplinary.action.admin', 'perm.text.disciplinary.action.admin');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (73, 'Disciplinary Action Types', '/disciplinary/action/type', 3, 2, 2, 'Manage Disciplinary Action Types', 'MANAGE.DISCIPLINARY.ACTION.TYPES', true, false, 'perm.comm.disciplinary.action.type', true, 'menu.disciplinary.action.type', 'perm.text.disciplinary.action.type');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (74, 'Disciplinary Not Administered Reasons', '/disciplinary/action/nadminister/reason', 3, 2, 2, 'Manage Disciplinary Action Not Admin. Reasons', 'MANAGE.DISCIPLINARY.NOT.ADMIN.REASONS', true, false, 'perm.comm.disciplinary.action.not.admin.reason', true, 'menu.disciplinary.action.not.admin.reason', 'perm.text.disciplinary.action.not.admin.reason');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (76, 'Class Groups By Date Range', '/rpt/attendance/classgroup/date/range/form', 4, 2, 75, 'Class Group Attendance By Date Range', 'ATT.CLASS.GROUP.BY.DATE.RANGE', true, false, 'perm.comm.rpt.attendance.class.group.date.range', true, 'menu.rpt.attendance.class.group.date.range', 'perm.text.rpt.attendance.class.group.date.range');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (78, 'Student Performance By Grade', '/rpt/student/performance/by/grade/form', 4, 2, 64, 'Student Performance By Grade Report', 'STUDENT.PERFORMANCE.BY.GRADE.REPORT', true, false, 'perm.comm.rpt.performance.by.grade', true, 'menu.rpt.performance.by.grade', 'perm.text.rpt.performance.by.grade');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (79, 'Student Subjects', '/class/group/student/subject/start', 1, 2, 28, 'Assign Students to Subjects', 'CLASS.GROUP.STUDENT.SUBJECT.ASSIGNMENT', true, false, 'perm.comm.student.subject.assignment', true, 'menu.student.subject.assignment', 'perm.text.student.subject.assignment');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (82, 'Payment Methods', '/billing/payment/method', 3, 2, 80, 'Manage Payment Methods', 'MANAGE.PAYMENT.METHODS', true, false, 'perm.comm.payment.method', true, 'menu.payment.method', 'perm.text.payment.method');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (83, 'School Fee Types', '/billing/fee/type', 3, 2, 80, 'Manage Types of School Fees', 'MANAGE.FEE.TYPES', true, false, 'perm.comm.fee.type', true, 'menu.fee.type', 'perm.text.fee.type');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (84, 'Define / Manage School Fees', '/billing/define/school/fees', 3, 2, 80, 'Manage School Fees', 'MANAGE.SCHOOL.FEES', true, false, 'perm.comm.define.school.fee', true, 'menu.define.school.fee', 'perm.text.define.school.fee');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (85, 'Cancellation Reasons', '/billing/fee/cancellation/reason', 3, 2, 80, 'Manage Payment Cancellation Reasons', 'MANAGE.PAYMENT.CANCELLATION.REASONS', true, false, NULL, true, 'menu.payment.cancellation.reason', 'perm.text.payment.cancellation.reason');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (86, 'Cancel Fee Payments', NULL, 3, NULL, NULL, 'Cancel Fee Payments', 'CANCEL.FEE.PAYMENTS', false, false, 'perm.comm.cancel.fee.payment', true, 'menu.cancel.fee.payment', 'perm.text.cancel.fee.payment');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (87, 'View Student Billing', NULL, 1, NULL, NULL, 'View Student Billing Info.', 'VIEW.STUDENT.BILLING.INFO', false, false, 'perm.comm.student.billing.info', true, 'menu.student.billing.info', 'perm.text.student.billing.info');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (88, 'Record Fee Payment', NULL, 1, NULL, NULL, 'Record School Fee Payment', 'RECORD.STUDENT.FEE.PAYMENT', false, false, 'perm.comm.record.school.fee.payment', true, 'menu.record.school.fee.payment', 'perm.text.record.school.fee.payment');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (90, 'Student Fee Payment', '/rpt/billing/fee/payment/status/form', 4, 2, 89, 'Student Fee Payment Report', 'FEE.PAYMENT.STATUS.REPORT', true, false, 'perm.comm.rpt.student.fee.payment', true, 'menu.rpt.student.fee.payment', 'perm.text.rpt.student.fee.payment');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (91, 'Receipt Summary', '/rpt/billing/receipt/summary/form', 4, 2, 89, 'Fee Payment Receipt Summary', 'FEE.PAYMENT.RECEIPT.SUMMARY.REPORT', true, false, 'perm.comm.receipt.summary', true, 'menu.receipt.summary', 'perm.text.receipt.summary');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (93, 'End School Assignment', NULL, 1, NULL, NULL, 'Terminate Student School Assignment', 'END.STUDENT.SCHOOL.ASSIGNMENT', false, false, 'perm.comm.school.assignment.end', true, 'menu.school.assignment.end', 'perm.text.school.assignment.end');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (96, 'App Permissions', '/advanced/app/permissions', 3, 2, 95, 'Manage App Permissions', 'MANAGE.APPLICATION.PERMISSIONS', true, false, 'perm.comm.app.permissions', true, 'menu.app.permissions', 'perm.text.app.permissions');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (92, 'Generate Transcript', NULL, 1, NULL, NULL, 'Generate Student Transcript', 'GENERATE.STUDENT.TRANSCRIPT', false, false, 'perm.comm.generate.transcript', true, 'menu.generate.transcript', 'perm.text.generate.transcript');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (94, 'Undo School Assignment Termination', NULL, 1, NULL, NULL, 'Undo School Assignment Termination', 'UNDO.SCHOOL.ASSIGNMENT.TERMINATION', false, false, 'perm.comm.school.assignment.end.undo', true, 'menu.school.assignment.end.undo', 'perm.text.school.assignment.end.undo');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (98, 'Extra-Curricular Activities', '/xtra/activity', 3, 2, 7, 'Manage Extra-Curricular Activities', 'MANAGE.EXTRA.CURRICULAR.ACTIVITY', true, false, NULL, true, 'menu.extra.curricular.activity', 'perm.text.extra.curricular.activity');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (99, 'menu.student.extra.curricular.activity', NULL, 2, NULL, NULL, 'Manage Student Extra-Curricular Activities', 'EDIT.STUDENT.EXTRACURRICULAR.ACTIVITY', false, false, NULL, true, 'Student Extra-Curricular Activities', 'perm.text.student.extra.curricular.activity');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (100, 'View Student Extra-Curricular Activities', NULL, 2, NULL, NULL, 'View Student Extra-Curricular Activities', 'VIEW.STUDENT.EXTRACURRICULAR.ACTIVITY', false, false, NULL, true, 'menu.view.student.extra.curricular.activity', 'perm.text.view.student.extra.curricular.activity');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (32, 'Class Group Subjects', '/classgroup/academic/year/assignment', 1, 2, 28, 'Manage class groups years', 'ASSIGN.CLASS.GROUP.ACADEMIC.YEAR', true, false, NULL, true, 'menu.class.group.subjects', 'perm.text.class.group.subjects');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (3, 'Facility Types', '/facilitytype', 3, 2, 11, 'Manage Facility Types', 'MANAGE.FACILITY.TYPES', true, false, NULL, true, 'menu.facility.type', 'perm.text.facility.type');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (15, 'Relationship Types', '/relationshiptype', 3, 2, 2, 'Manage Relationships', 'MANAGE.RELATIONSHIP.TYPES', true, false, NULL, true, 'menu.relationship.type', 'perm.text.relationship.type');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (19, 'Identification Types', '/identification/type', 3, 2, 2, 'Manage Identification Types', 'MANAGE.ID.TYPES', true, false, 'perm.comm.identification.type', true, 'menu.identification.type', 'perm.text.identification.type');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (40, 'Assign Subject Teachers', NULL, 1, NULL, NULL, 'Assign Subject Teachers', 'ASSIGN.SUBJECT.TEACHERS', false, false, NULL, true, 'menu.assign.subject.teacher', 'perm.text.assign.subject.teacher');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (30, 'Assign Students', '/classgroup/student/assignment/start', 1, 2, 28, 'Assign Students to Class Groups', 'STUDENT.CLASS.GROUP.ASSIGNMENT', true, false, NULL, true, 'menu.assign.student', 'perm.text.assign.student');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (41, 'Override Homeroom Teacher Privilege', NULL, 1, NULL, NULL, 'Homeroom Teacher Permission', 'OVERRIDE.HOMEROOM.TEACHER.PRIVILEGE', false, false, NULL, true, 'menu.override.homeroom.teacher.privilege', 'perm.text.override.homeroom.teacher.privilege');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (44, 'Grade Summary PDF', NULL, 2, NULL, NULL, 'Generate Term Grade PDF', 'GENERATE.TERM.GRADE.PDF', false, false, NULL, true, 'menu.grade.summary.pdf', 'perm.text.grade.summary.pdf');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (47, 'Religions', '/religion', 3, 2, 2, 'Manage Religions', 'MANAGE.RELIGIONS', true, false, NULL, true, 'menu.religion', 'perm.text.religion');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (50, 'Edit Student Details', NULL, 2, NULL, NULL, 'Edit Student Details', 'EDIT.STUDENT.DETAILS', false, false, NULL, true, 'menu.student.edit', 'perm.text.student.edit');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (53, 'Grade Summary Excel', NULL, 2, NULL, NULL, 'Generate Term Grade Spreadsheet', 'GENERATE.TERM.GRADE.EXCEL', false, false, NULL, true, 'menu.grade.summary.spreadsheet', 'perm.text.grade.summary.spreadsheet');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (58, 'Head Teacher Designations', '/academic/head/teacher/designation', 3, 2, 7, 'Head Teacher Designations', 'MANAGE.HEAD.TEACHER.DESIGNATION', true, false, 'perm.comm.head.teacher.designation', true, 'menu.head.teacher.designation', 'perm.text.head.teacher.designation');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (61, 'Educational Holidays', '/admin/holiday', 3, 2, 7, 'Manage Educational Holidays', 'MANAGE.EDUCATIONAL.HOLIDAYS', true, false, 'perm.comm.educational.holiday', true, 'menu.educational.holiday', 'perm.text.educational.holiday');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (63, 'School Off-Days', NULL, 3, NULL, NULL, 'Manage Facility Off-days', 'MANAGE.FACILITY.OFF.DAYS', false, false, 'perm.comm.facility.offDays', true, 'menu.facility.offDays', 'perm.text.facility.offDays');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (70, 'External Users', '/security/user/external', 3, 2, 11, 'Manage External Users', 'MANAGE.EXTERNAL.USERS', true, false, 'perm.comm.external.user', true, 'menu.external.user', 'perm.text.external.user');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (77, 'Students By Class Group', '/rpt/student/class/group/attendance/summary/form', 4, 2, 75, 'Student Attendance By Class Group By Date Range', 'ATT.STUDENT.CLASS.GROUP.BY.DATE.RANGE', true, false, 'perm.comm.rpt.attendance.class.group.date.range.table', true, 'menu.rpt.attendance.class.group.date.range.table', 'perm.text.rpt.attendance.class.group.date.range.table');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (101, 'View Student Subject History', NULL, 2, NULL, NULL, 'View Student Subject History', 'VIEW.STUDENT.SUBJECT.HISTORY', false, false, 'perm.comm.student.subject.history', true, 'menu.student.subject.history', 'perm.text.student.subject.history');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (102, 'Incident Types', '/incident/type', 3, 2, 2, 'Manage Incident Types', 'MANAGE.INCIDENT.TYPES', true, false, NULL, true, 'menu.incident.type', 'perm.text.incident.type');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (103, 'School', NULL, 3, 1, NULL, 'Manage School Specific Data', NULL, true, true, NULL, true, 'menu.container.school', 'perm.text.container.school');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (20, 'Teachers', '/academic/teacher', 3, 2, 103, 'Manage Teachers - Global', 'GLOBAL.TEACHER.MANAGEMENT', true, false, 'perm.comm.global.teacher', true, 'menu.global.teacher', 'perm.text.global.teacher');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (62, 'Re-open Class Groups', '/class/group/academic/period/reopen', 3, 2, 103, 'Re-open Class Groups', 'REOPEN.CLASS.GROUPS', true, false, 'perm.comm.class.group.reopen', true, 'menu.class.group.reopen', 'perm.text.class.group.reopen');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (104, 'Attendance Interval', '/attendance/interval', 3, 2, 103, 'Manage Attendance Interval', 'MANAGE.ATTENDANCE.INTERVAL', true, false, 'perm.comm.attendance.interval', true, 'menu.attendance.interval', 'perm.text.attendance.interval');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (108, 'View Student Info (Expanded)', NULL, 1, NULL, NULL, 'View Student Info (Expanded)', 'OVERRIDE.STUDENT.VIEW.EXPANDED.STATUS', false, false, 'perm.comm.liberal.view.allowed', true, 'menu.student.liberal.view.allowed', 'perm.text.liberal.view.allowed');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (109, 'Listing By Academic Year', '/class/group/school/overview/start', 1, 2, 28, 'View Class Groups by Academic Year', 'LIST.CLASS.GROUP.BY.YEAR', true, false, 'perm.comm.class.group.list.by.year', true, 'menu.class.group.list.by.year', 'perm.text.class.group.list.by.year');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (110, 'Property file', '/property/file/get', 3, 2, 95, 'Manage application properties', 'ADMIN.PROPERTY.FILE', true, false, NULL, true, 'menu.property.file', 'perm.text.property.file');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (112, 'Manage Cache (OP)', '/server/opcache/status', 3, 2, 95, 'Manage application cache', 'ADMIN.OPCACHE.MANAGE', true, false, NULL, true, 'menu.opcache.status', 'perm.text.opcache.status');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (114, 'Sports Houses', '/sports/house', 3, 2, 103, 'Manage sports houses', 'MANAGE.SPORTS.HOUSES', true, false, NULL, true, 'menu.manage.sports.houses', 'perm.text.manage.sports.houses');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (113, 'Grade Activity Super Admin', NULL, 1, NULL, NULL, 'Subject grade activity super admin', 'GRADE.ACTIVITY.SUPER.ADMIN', false, false, 'perm.comm.grade.activity.super.admin', true, 'menu.grade.activity.super.admin', 'perm.text.grade.activity.super.admin');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (115, 'Grading Preferences', '/facility/grading/preference', 3, 2, 103, 'Manage grading preferences', 'MANAGE.GRADING.PREFERENCES', true, false, 'perm.comm.facility.grading.pref', true, 'menu.facility.grading.pref', 'perm.text.facility.grading.pref');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (116, 'Conduct Letter Grades', '/facility/conduct/letter/grade', 3, 2, 103, 'Define Conduct Letter Grades', 'MANAGE.CONDUCT.LETTER.GRADES', true, false, 'perm.comm.conduct.letter.grade', true, 'menu.conduct.letter.grade', 'perm.text.conduct.letter.grade');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (117, 'Ranking Methods', '/academic/ranking/method', 3, 2, 7, 'Available ranking methods', 'MANAGE.RANKING.METHODS', true, false, NULL, true, 'menu.academic.ranking.method', 'perm.text.academic.ranking.method');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (118, 'Student Ranking Options', '/grade/level/ranking', 3, 2, 103, 'Grade Level Ranking Methods', 'MANAGE.SCHOOL.RANKING.OPTIONS', true, false, NULL, true, 'menu.facility.ranking.method', 'perm.text.facility.ranking.method');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (119, 'Grade Level Coordinators', '/grade/level/coordinator', 3, 2, 103, 'Manage Grade Level Coordinators', 'MANAGE.GRADE.LEVEL.COORDINATORS', true, false, 'perm.comm.grade.level.coordinator', true, 'menu.grade.level.coordinator', 'perm.text.grade.level.coordinator');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (120, 'Grade Report Suffix', '/grade/report/facility/suffix', 3, 2, 7, 'Manage grade report facility suffix', 'SYSTEM.USER', true, false, NULL, true, 'menu.grade.report.facility.suffix', 'perm.text.grade.report.facility.suffix');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (121, 'Final Grade Comments', '/academic/canned/final/grade/comment', 3, 2, 103, 'Manage Final Grade Comments', 'MANAGE.FINAL.GRADE.COMMENTS', true, false, 'perm.comm.canned.final.grade.comment', true, 'menu.canned.final.grade.comment', 'perm.text.canned.final.grade.comment');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (122, 'Final Grade Comment Rules', '/academic/final/comment/rule', 3, 2, 103, 'Manage Final Grade Comment Rules', 'MANAGE.GRADE.COMMENT.RULES', true, false, 'perm.comm.grade.comment.rule', true, 'menu.grade.comment.rule', 'perm.text.grade.comment.rule');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (123, 'Override Final Grade', NULL, 1, NULL, NULL, 'Override Calculated Final Grade', 'OVERRIDE.CALCULATED.FINAL.GRADE', false, false, 'perm.comm.override.final.grade', true, 'menu.override.final.year.grade', 'perm.text.override.final.year.grade');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (124, 'Notifications', NULL, 1, 1, NULL, 'Notifications', NULL, true, true, NULL, true, 'menu.notifications', 'menu.notifications');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (125, 'Publish', '/utility/notification/message', 1, 2, 124, 'Publish Notifications', 'NOTIFICATION.MESSAGE.SENDER', true, false, 'perm.comm.notifications.publish', true, 'menu.notifications.publish', 'perm.text.notification.publish');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (126, 'Search', '/utility/notification/message/search', 1, 2, 124, 'Notification Search', 'NOTIFICATION.MESSAGE.SEARCH', true, false, 'perm.comm.notifications.search', true, 'menu.notifications.search', 'perm.text.notification.search');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (128, 'Utility', NULL, 3, 1, NULL, 'Utility Container', NULL, true, true, NULL, true, 'menu.utility.container', 'perm.text.utility.container');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (129, 'Student Excel Upload', '/utility/student/excel/form', 3, 2, 128, 'Upload Students via Excel', 'UPLOAD.STUDENT.EXCEL', true, false, NULL, true, 'menu.student.upload.excel', 'perm.text.student.upload.excel');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (130, 'Shared Mark Reading', '/class/group/mark/reading/master', 3, 2, 103, 'Manage Class Group Mark Readings', 'MANAGE.CLASS.GROUP.MARK.READING', true, false, NULL, true, 'menu.shared.mark.reading', 'perm.text.shared.mark.reading');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (131, 'View Mark Readings', NULL, 1, NULL, NULL, 'View Mark Reading', 'VIEW.CLASS.GROUP.MARK.READING', false, false, NULL, true, 'menu.view.mark.reading', 'perm.text.view.mark.reading');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (132, 'Mark Reading Overview', '/class/group/mark/reading/overview', 1, 2, 28, 'Overview of mark readings for academic period', 'CLASS.GROUP.MARK.READING.OVERVIEW', true, false, NULL, true, 'menu.mark.reading.overview', 'perm.text.mark.reading.overview');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (133, 'Grade Assessment Override', NULL, 1, NULL, NULL, 'Override Grade Assessment Total Points', 'GRADE.ASSESSMENT.TOTAL.POINTS.OVERRIDE', false, false, 'perm.comm.grade.assess.override', true, 'menu.grade.assessement.tp.override', 'perm.text.grade.assess.override');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (65, 'Student Subject Performance', '/rpt/class/group/subject/performance/form', 4, 2, 64, 'Subject Performance Report', 'STUDENT.SUBJECT.PERFORMANCE.REPORT', true, false, 'perm.comm.rpt.subject.performance', true, 'menu.rpt.subject.performance', 'perm.text.rpt.subject.performance');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (127, 'Weighted Percentages', '/academic/weighted/percentage', 3, 2, 103, 'Manage Weighted Percentages', 'MANAGE.WEIGHTED.PERCENTAGES', true, false, NULL, true, 'menu.weighted.percentage', 'perm.text.weighted.percentage');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (135, 'Students by Sports House', '/rpt/student/by/sports/house/form', 4, 2, 134, 'List students by sports house', 'LIST.STUDENT.SPORTS.HOUSE', true, false, NULL, true, 'menu.rpt.student.sports.house', 'perm.text.rpt.student.sports.house');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (134, 'Students', NULL, 4, 1, NULL, 'Student Reports', NULL, true, true, NULL, true, 'menu.container.rpt.student', 'menu.container.rpt.student');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (136, 'Students w/o sports houses', '/rpt/student/no/sports/house/form', 4, 2, 134, 'List students w/o sport houses', 'LIST.STUDENT.WITHOUT.SPORTS.HOUSE', true, false, NULL, true, 'menu.rpt.student.no.sports.house', 'perm.text.rpt.student.no.sports.house');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (137, 'Attendance Status', '/rpt/timed/attendance/status/form', 4, 2, 75, 'List attendance status details', 'VIEW.ATTENDANCE.STATUS.REPORT', true, false, 'perm.comm.rpt.attendance.status.timed', true, 'menu.rpt.attendance.status.timed', 'perm.text.rpt.attendance.status.timed');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (138, 'Logged in users', '/admin/logged/users', 3, 2, 95, 'View users currently logged in to a facility', 'VIEW.LOGGED.IN.USERS', true, false, NULL, true, 'menu.logged.in.users', 'perm.text.logged.in.users');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (139, 'Grade level repeats', '/rpt/student/repeats/form', 4, 2, 64, 'List students repeating grade levels by academic year', 'STUDENT.GRADE.LEVEL.REPEAT.REPORT', true, false, 'perm.comm.rpt.grade.level.repeats', true, 'menu.rpt.grade.level.repeats', 'perm.text.rpt.grade.level.repeats');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (111, 'Server Status', '/server/stats/get', 3, 2, 95, 'View server statistics', 'ADMIN.SERVER.STATUS', false, false, NULL, true, 'menu.server.stats', 'perm.text.server.stats');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (140, 'Manage Transcripts', '/admin/transcript', 3, 2, 103, 'Manage Transcripts for various facilities', 'ADMIN.TRANSCRIPT', true, false, NULL, true, 'menu.admin.transcript', 'perm.text.admin.transcript');
INSERT INTO edu_permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) VALUES (141, 'Facility Divisions', '/academic/facility/division', 3, 2, 103, 'Manage facility divisions', 'MANAGE.FACILITY.DIVISIONS', true, false, NULL, true, 'menu.academic.facility.divisions', 'perm.text.academic.facility.divisions');


------>>>>>>>>
--Grading Activities
INSERT INTO edu_grade_activities(grade_activity_id, name, defacto, alive) VALUES ('SRM1','Final Exam', true, true);
INSERT INTO edu_grade_activities(grade_activity_id, name, defacto, alive) VALUES ('SRM2','Mid-Term Exam', true, true);
INSERT INTO edu_grade_activities(grade_activity_id, name, defacto, alive) VALUES ('SRM3','Project', true, true);
INSERT INTO edu_grade_activities(grade_activity_id, name, defacto, alive) VALUES ('SRM4','Quiz', true, true);
INSERT INTO edu_grade_activities(grade_activity_id, name, defacto, alive) VALUES ('SRM5','Assignment', true, true);

--Locales/Languages
INSERT INTO edu_locales (locale_id, locale_code, definition, alive) VALUES ('SRM1', 'en_US', 'English (American)', true);
INSERT INTO edu_locales (locale_id, locale_code, definition, alive) VALUES ('SRM2', 'es_CO', 'Español (Colombia)', true);

--School Assignment Termination Reasons
INSERT INTO edu_school_assignment_termination_reasons (school_assignment_termination_reason_id, name, display_text, constant, positive_outcome, alive)
VALUES ('SRM1', 'Graduation', 'Graduated', 'GRADUATED', true, true);
INSERT INTO edu_school_assignment_termination_reasons (school_assignment_termination_reason_id, name, display_text, constant, positive_outcome, alive)
VALUES ('SRM2', 'Expulsion', 'Expelled', 'EXPELLED', false, true);
INSERT INTO edu_school_assignment_termination_reasons (school_assignment_termination_reason_id, name, display_text, constant, positive_outcome, alive)
VALUES ('SRM3', 'Transfer', 'Transferred', 'TRANSFERRED', true, true);
INSERT INTO edu_school_assignment_termination_reasons (school_assignment_termination_reason_id, name, display_text, constant, positive_outcome, alive)
VALUES ('SRM4', 'Drop-Out', 'Dropped-Out', 'DROP_OUT', false, true);

-- Grade Mappings
INSERT INTO edu_grade_mappings (grade_mapping_id, numeric_low, numeric_high, letter_grade, gpa, alive) VALUES ('SRM12', 0, 35, 'F', 0.00, true);
INSERT INTO edu_grade_mappings (grade_mapping_id, numeric_low, numeric_high, letter_grade, gpa, alive) VALUES ('SRM11', 35, 40, 'D-', 0.67, true);
INSERT INTO edu_grade_mappings (grade_mapping_id, numeric_low, numeric_high, letter_grade, gpa, alive) VALUES ('SRM10', 40, 45, 'D', 1.00, true);
INSERT INTO edu_grade_mappings (grade_mapping_id, numeric_low, numeric_high, letter_grade, gpa, alive) VALUES ('SRM9', 45, 50, 'D+', 1.33, true);
INSERT INTO edu_grade_mappings (grade_mapping_id, numeric_low, numeric_high, letter_grade, gpa, alive) VALUES ('SRM8', 50, 55, 'C-', 1.67, true);
INSERT INTO edu_grade_mappings (grade_mapping_id, numeric_low, numeric_high, letter_grade, gpa, alive) VALUES ('SRM7', 55, 60, 'C', 2.00, true);
INSERT INTO edu_grade_mappings (grade_mapping_id, numeric_low, numeric_high, letter_grade, gpa, alive) VALUES ('SRM6', 60, 65, 'C+', 2.33, true);
INSERT INTO edu_grade_mappings (grade_mapping_id, numeric_low, numeric_high, letter_grade, gpa, alive) VALUES ('SRM5', 65, 70, 'B-', 2.67, true);
INSERT INTO edu_grade_mappings (grade_mapping_id, numeric_low, numeric_high, letter_grade, gpa, alive) VALUES ('SRM4', 70, 75, 'B', 3.00, true);
INSERT INTO edu_grade_mappings (grade_mapping_id, numeric_low, numeric_high, letter_grade, gpa, alive) VALUES ('SRM3', 75, 80, 'B+', 3.33, true);
INSERT INTO edu_grade_mappings (grade_mapping_id, numeric_low, numeric_high, letter_grade, gpa, alive) VALUES ('SRM2', 80, 90, 'A-', 3.67, true);
INSERT INTO edu_grade_mappings (grade_mapping_id, numeric_low, numeric_high, letter_grade, gpa, alive) VALUES ('SRM1', 90, 100, 'A', 4.00, true);

--Identification types
INSERT INTO edu_identification_types (identification_type_id, name, format, alive) VALUES ('SRM1', 'National Insurance Number', '000000', true);
INSERT INTO edu_identification_types (identification_type_id, name, format, alive) VALUES ('SRM2', 'Passport Number', 'R000000', true);
INSERT INTO edu_identification_types (identification_type_id, name, format, alive) VALUES ('SRM3', 'Driver''s License', '00000', true);
INSERT INTO edu_identification_types (identification_type_id, name, format, alive) VALUES ('SRM4', 'National Identification Number', '0000000', true);

-- Qualifications
INSERT INTO edu_qualifications (qualification_id, name, alive) VALUES ('SRM1', 'Teaching Certificate', true);
INSERT INTO edu_qualifications (qualification_id, name, alive) VALUES ('SRM2', 'Bachelors', true);
INSERT INTO edu_qualifications (qualification_id, name, alive) VALUES ('SRM3', 'Masters', true);
INSERT INTO edu_qualifications (qualification_id, name, alive) VALUES ('SRM4', 'Doctorate', true);
INSERT INTO edu_qualifications (qualification_id, name, alive) VALUES ('SRM5', 'CXC', true);
INSERT INTO edu_qualifications (qualification_id, name, alive) VALUES ('SRM6', 'A-Levels', true);
INSERT INTO edu_qualifications (qualification_id, name, alive) VALUES ('SRM7', 'GCE', true);
INSERT INTO edu_qualifications (qualification_id, name, alive) VALUES ('SRM8', 'Professional Certificate', true);

--Relations
INSERT INTO edu_relations (relation_id, name, alive) VALUES ('SRM1', 'Mother', true);
INSERT INTO edu_relations (relation_id, name, alive) VALUES ('SRM2', 'Father', true);
INSERT INTO edu_relations (relation_id, name, alive) VALUES ('SRM3', 'Brother', true);
INSERT INTO edu_relations (relation_id, name, alive) VALUES ('SRM4', 'Sister', true);
INSERT INTO edu_relations (relation_id, name, alive) VALUES ('SRM5', 'Cousin', true);
INSERT INTO edu_relations (relation_id, name, alive) VALUES ('SRM6', 'Stepfather', true);
INSERT INTO edu_relations (relation_id, name, alive) VALUES ('SRM7', 'Stepmother', true);
INSERT INTO edu_relations (relation_id, name, alive) VALUES ('SRM8', 'Aunt', true);
INSERT INTO edu_relations (relation_id, name, alive) VALUES ('SRM9', 'Uncle', true);
INSERT INTO edu_relations (relation_id, name, alive) VALUES ('SRM10', 'Guardian', true);
INSERT INTO edu_relations (relation_id, name, alive) VALUES ('SRM11', 'Grandmother', true);
INSERT INTO edu_relations (relation_id, name, alive) VALUES ('SRM12', 'Grandfather', true);

--Subjects
INSERT INTO edu_subjects (subject_id, name, code, alive) VALUES ('SRM1', 'Mathematics', 'MATH', true);
INSERT INTO edu_subjects (subject_id, name, code, alive) VALUES ('SRM2', 'English', 'ENG', true);
INSERT INTO edu_subjects (subject_id, name, code, alive) VALUES ('SRM3', 'Spanish', 'ESP', true);
INSERT INTO edu_subjects (subject_id, name, code, alive) VALUES ('SRM4', 'Writing', 'WRIT', true);
INSERT INTO edu_subjects (subject_id, name, code, alive) VALUES ('SRM5', 'French', 'FR', true);
INSERT INTO edu_subjects (subject_id, name, code, alive) VALUES ('SRM6', 'Physical Education', 'PHYS_ED', true);
INSERT INTO edu_subjects (subject_id, name, code, alive) VALUES ('SRM7', 'Information Technology', 'IT', true);
INSERT INTO edu_subjects (subject_id, name, code, alive) VALUES ('SRM8', 'Integrated Science', 'IS', true);
INSERT INTO edu_subjects (subject_id, name, code, alive) VALUES ('SRM9', 'Principles Of Business', 'POB', true);
INSERT INTO edu_subjects (subject_id, name, code, alive) VALUES ('SRM10', 'Accounts', 'ACCT', true);
INSERT INTO edu_subjects (subject_id, name, code, alive) VALUES ('SRM11', 'Biology', 'BIO', true);
INSERT INTO edu_subjects (subject_id, name, code, alive) VALUES ('SRM12', 'Chemistry', 'CHEM', true);
INSERT INTO edu_subjects (subject_id, name, code, alive) VALUES ('SRM13', 'Physics', 'PHY', true);
INSERT INTO edu_subjects (subject_id, name, code, alive) VALUES ('SRM14', 'Home Economics', 'HOME_EC', true);
INSERT INTO edu_subjects (subject_id, name, code, alive) VALUES ('SRM15', 'Language Arts', 'LANG_ARTS', true);
INSERT INTO edu_subjects (subject_id, name, code, alive) VALUES ('SRM16', 'Art', 'ART', true);
INSERT INTO edu_subjects (subject_id, name, code, alive) VALUES ('SRM17', 'History', 'HSTY', true);
INSERT INTO edu_subjects (subject_id, name, code, alive) VALUES ('SRM18', 'Geography', 'GEO', true);
INSERT INTO edu_subjects (subject_id, name, code, alive) VALUES ('SRM19', 'Social Studies', 'SS', true);
INSERT INTO edu_subjects (subject_id, name, code, alive) VALUES ('SRM20', 'English Literature', 'ENG_LIT', true);
INSERT INTO edu_subjects (subject_id, name, code, alive) VALUES ('SRM21', 'Religious Knowledge', 'RK', true);
INSERT INTO edu_subjects (subject_id, name, code, alive) VALUES ('SRM22', 'Typing', 'TYP', true);
INSERT INTO edu_subjects (subject_id, name, code, alive) VALUES ('SRM23', 'Economics', 'ECON', true);
INSERT INTO edu_subjects (subject_id, name, code, alive) VALUES ('SRM24', 'Administration', 'ADMIN', true);
INSERT INTO edu_subjects (subject_id, name, code, alive) VALUES ('SRM25', 'General Knowledge', 'GKNOW', true);

--Titles
INSERT INTO edu_titles (title_id, name, alive) VALUES ('SRM1', 'Mr', true);
INSERT INTO edu_titles (title_id, name, alive) VALUES ('SRM2', 'Ms', true);
INSERT INTO edu_titles (title_id, name, alive) VALUES ('SRM3', 'Mrs', true);
INSERT INTO edu_titles (title_id, name, alive) VALUES ('SRM4', 'Dr', true);
INSERT INTO edu_titles (title_id, name, alive) VALUES ('SRM5', 'Sir', true);


--Ethnicities
INSERT INTO edu_ethnicities (ethnicity_id, name, alive) VALUES ('SRM1', 'Black', true);
INSERT INTO edu_ethnicities (ethnicity_id, name, alive) VALUES ('SRM2', 'Caucasian', true);
INSERT INTO edu_ethnicities (ethnicity_id, name, alive) VALUES ('SRM3', 'Asian', true);
INSERT INTO edu_ethnicities (ethnicity_id, name, alive) VALUES ('SRM4', 'East Indian', true);
INSERT INTO edu_ethnicities (ethnicity_id, name, alive) VALUES ('SRM5', 'American Indian', true);
INSERT INTO edu_ethnicities (ethnicity_id, name, alive) VALUES ('SRM6', 'Unknown', true);


--Religions
INSERT INTO edu_religions (religion_id, name, alive) VALUES ('SRM1', 'Christianity', true);
INSERT INTO edu_religions (religion_id, name, alive) VALUES ('SRM2', 'Islam', true);
INSERT INTO edu_religions (religion_id, name, alive) VALUES ('SRM3', 'Buddism', true);
INSERT INTO edu_religions (religion_id, name, alive) VALUES ('SRM4', 'Hindu', true);
INSERT INTO edu_religions (religion_id, name, alive) VALUES ('SRM5', 'Not Stated', true);

/*
--Facility type subjects
INSERT INTO edu_facility_type_subjects (facility_type_subject_id, subject_id, facility_type_id, alive) VALUES ('SRM1', 'SRM10', 4, true);
INSERT INTO edu_facility_type_subjects (facility_type_subject_id, subject_id, facility_type_id, alive) VALUES ('SRM2', 'SRM10', 5, true);
INSERT INTO edu_facility_type_subjects (facility_type_subject_id, subject_id, facility_type_id, alive) VALUES ('SRM3', 'SRM24', 5, true);
INSERT INTO edu_facility_type_subjects (facility_type_subject_id, subject_id, facility_type_id, alive) VALUES ('SRM4', 'SRM16', 3, true);
INSERT INTO edu_facility_type_subjects (facility_type_subject_id, subject_id, facility_type_id, alive) VALUES ('SRM5', 'SRM16', 4, true);
INSERT INTO edu_facility_type_subjects (facility_type_subject_id, subject_id, facility_type_id, alive) VALUES ('SRM6', 'SRM16', 5, true);
INSERT INTO edu_facility_type_subjects (facility_type_subject_id, subject_id, facility_type_id, alive) VALUES ('SRM7', 'SRM11', 4, true);
INSERT INTO edu_facility_type_subjects (facility_type_subject_id, subject_id, facility_type_id, alive) VALUES ('SRM8', 'SRM11', 5, true);
INSERT INTO edu_facility_type_subjects (facility_type_subject_id, subject_id, facility_type_id, alive) VALUES ('SRM9', 'SRM12', 4, true);
INSERT INTO edu_facility_type_subjects (facility_type_subject_id, subject_id, facility_type_id, alive) VALUES ('SRM10', 'SRM12', 5, true);
INSERT INTO edu_facility_type_subjects (facility_type_subject_id, subject_id, facility_type_id, alive) VALUES ('SRM11', 'SRM23', 5, true);
INSERT INTO edu_facility_type_subjects (facility_type_subject_id, subject_id, facility_type_id, alive) VALUES ('SRM12', 'SRM2', 3, true);
INSERT INTO edu_facility_type_subjects (facility_type_subject_id, subject_id, facility_type_id, alive) VALUES ('SRM13', 'SRM2', 4, true);
INSERT INTO edu_facility_type_subjects (facility_type_subject_id, subject_id, facility_type_id, alive) VALUES ('SRM14', 'SRM2', 5, true);
INSERT INTO edu_facility_type_subjects (facility_type_subject_id, subject_id, facility_type_id, alive) VALUES ('SRM15', 'SRM20', 4, true);
INSERT INTO edu_facility_type_subjects (facility_type_subject_id, subject_id, facility_type_id, alive) VALUES ('SRM16', 'SRM20', 5, true);
INSERT INTO edu_facility_type_subjects (facility_type_subject_id, subject_id, facility_type_id, alive) VALUES ('SRM17', 'SRM5', 4, true);
INSERT INTO edu_facility_type_subjects (facility_type_subject_id, subject_id, facility_type_id, alive) VALUES ('SRM18', 'SRM5', 5, true);
INSERT INTO edu_facility_type_subjects (facility_type_subject_id, subject_id, facility_type_id, alive) VALUES ('SRM19', 'SRM18', 4, true);
INSERT INTO edu_facility_type_subjects (facility_type_subject_id, subject_id, facility_type_id, alive) VALUES ('SRM20', 'SRM18', 5, true);
INSERT INTO edu_facility_type_subjects (facility_type_subject_id, subject_id, facility_type_id, alive) VALUES ('SRM21', 'SRM17', 3, true);
INSERT INTO edu_facility_type_subjects (facility_type_subject_id, subject_id, facility_type_id, alive) VALUES ('SRM22', 'SRM17', 4, true);
INSERT INTO edu_facility_type_subjects (facility_type_subject_id, subject_id, facility_type_id, alive) VALUES ('SRM23', 'SRM17', 5, true);
INSERT INTO edu_facility_type_subjects (facility_type_subject_id, subject_id, facility_type_id, alive) VALUES ('SRM24', 'SRM14', 3, true);
INSERT INTO edu_facility_type_subjects (facility_type_subject_id, subject_id, facility_type_id, alive) VALUES ('SRM25', 'SRM14', 4, true);
INSERT INTO edu_facility_type_subjects (facility_type_subject_id, subject_id, facility_type_id, alive) VALUES ('SRM26', 'SRM7', 4, true);
INSERT INTO edu_facility_type_subjects (facility_type_subject_id, subject_id, facility_type_id, alive) VALUES ('SRM27', 'SRM7', 5, true);
INSERT INTO edu_facility_type_subjects (facility_type_subject_id, subject_id, facility_type_id, alive) VALUES ('SRM28', 'SRM8', 3, true);
INSERT INTO edu_facility_type_subjects (facility_type_subject_id, subject_id, facility_type_id, alive) VALUES ('SRM29', 'SRM8', 4, true);
INSERT INTO edu_facility_type_subjects (facility_type_subject_id, subject_id, facility_type_id, alive) VALUES ('SRM30', 'SRM15', 3, true);
INSERT INTO edu_facility_type_subjects (facility_type_subject_id, subject_id, facility_type_id, alive) VALUES ('SRM31', 'SRM1', 3, true);
INSERT INTO edu_facility_type_subjects (facility_type_subject_id, subject_id, facility_type_id, alive) VALUES ('SRM32', 'SRM1', 4, true);
INSERT INTO edu_facility_type_subjects (facility_type_subject_id, subject_id, facility_type_id, alive) VALUES ('SRM33', 'SRM1', 5, true);
INSERT INTO edu_facility_type_subjects (facility_type_subject_id, subject_id, facility_type_id, alive) VALUES ('SRM34', 'SRM6', 3, true);
INSERT INTO edu_facility_type_subjects (facility_type_subject_id, subject_id, facility_type_id, alive) VALUES ('SRM35', 'SRM6', 4, true);
INSERT INTO edu_facility_type_subjects (facility_type_subject_id, subject_id, facility_type_id, alive) VALUES ('SRM36', 'SRM13', 4, true);
INSERT INTO edu_facility_type_subjects (facility_type_subject_id, subject_id, facility_type_id, alive) VALUES ('SRM37', 'SRM13', 5, true);
INSERT INTO edu_facility_type_subjects (facility_type_subject_id, subject_id, facility_type_id, alive) VALUES ('SRM38', 'SRM9', 4, true);
INSERT INTO edu_facility_type_subjects (facility_type_subject_id, subject_id, facility_type_id, alive) VALUES ('SRM39', 'SRM21', 3, true);
INSERT INTO edu_facility_type_subjects (facility_type_subject_id, subject_id, facility_type_id, alive) VALUES ('SRM40', 'SRM21', 4, true);
INSERT INTO edu_facility_type_subjects (facility_type_subject_id, subject_id, facility_type_id, alive) VALUES ('SRM41', 'SRM19', 4, true);
INSERT INTO edu_facility_type_subjects (facility_type_subject_id, subject_id, facility_type_id, alive) VALUES ('SRM42', 'SRM3', 3, true);
INSERT INTO edu_facility_type_subjects (facility_type_subject_id, subject_id, facility_type_id, alive) VALUES ('SRM43', 'SRM3', 4, true);
INSERT INTO edu_facility_type_subjects (facility_type_subject_id, subject_id, facility_type_id, alive) VALUES ('SRM44', 'SRM3', 5, true);
INSERT INTO edu_facility_type_subjects (facility_type_subject_id, subject_id, facility_type_id, alive) VALUES ('SRM45', 'SRM22', 4, true);
INSERT INTO edu_facility_type_subjects (facility_type_subject_id, subject_id, facility_type_id, alive) VALUES ('SRM46', 'SRM4', 3, true);
INSERT INTO edu_facility_type_subjects (facility_type_subject_id, subject_id, facility_type_id, alive) VALUES ('SRM47', 'SRM25', 3, true);

*/
/*
--Grade levels
INSERT INTO edu_grade_levels (grade_level_id, name, ascension_order, alive) VALUES ('SRM1', 'Kindergarten', 1, true);
INSERT INTO edu_grade_levels (grade_level_id, name, ascension_order, alive) VALUES ('SRM2', 'Grade 1', 2, true);
INSERT INTO edu_grade_levels (grade_level_id, name, ascension_order, alive) VALUES ('SRM3', 'Grade 2', 3, true);
INSERT INTO edu_grade_levels (grade_level_id, name, ascension_order, alive) VALUES ('SRM4', 'Grade 3', 4, true);
INSERT INTO edu_grade_levels (grade_level_id, name, ascension_order, alive) VALUES ('SRM5', 'Grade 4', 5, true);
INSERT INTO edu_grade_levels (grade_level_id, name, ascension_order, alive) VALUES ('SRM6', 'Grade 6', 7, true);
INSERT INTO edu_grade_levels (grade_level_id, name, ascension_order, alive) VALUES ('SRM7', 'Grade 7', 8, true);
INSERT INTO edu_grade_levels (grade_level_id, name, ascension_order, alive) VALUES ('SRM8', 'Grade 8', 9, true);
INSERT INTO edu_grade_levels (grade_level_id, name, ascension_order, alive) VALUES ('SRM9', 'Grade 9', 10, true);
INSERT INTO edu_grade_levels (grade_level_id, name, ascension_order, alive) VALUES ('SRM10', 'Grade 10', 11, true);
INSERT INTO edu_grade_levels (grade_level_id, name, ascension_order, alive) VALUES ('SRM11', 'Grade 11', 12, true);
INSERT INTO edu_grade_levels (grade_level_id, name, ascension_order, alive) VALUES ('SRM12', 'Grade 12', 13, true);

--Facility type grade levels
INSERT INTO edu_facility_type_grade_levels (facility_type_grade_level_id, grade_level_id, facility_type_id, alive) VALUES ('SRM1', 'SRM1', 3, true);
INSERT INTO edu_facility_type_grade_levels (facility_type_grade_level_id, grade_level_id, facility_type_id, alive) VALUES ('SRM2', 'SRM2', 3, true);
INSERT INTO edu_facility_type_grade_levels (facility_type_grade_level_id, grade_level_id, facility_type_id, alive) VALUES ('SRM3', 'SRM3', 3, true);
INSERT INTO edu_facility_type_grade_levels (facility_type_grade_level_id, grade_level_id, facility_type_id, alive) VALUES ('SRM4', 'SRM4', 3, true);
INSERT INTO edu_facility_type_grade_levels (facility_type_grade_level_id, grade_level_id, facility_type_id, alive) VALUES ('SRM5', 'SRM5', 3, true);
INSERT INTO edu_facility_type_grade_levels (facility_type_grade_level_id, grade_level_id, facility_type_id, alive) VALUES ('SRM6', 'SRM6', 3, true);
INSERT INTO edu_facility_type_grade_levels (facility_type_grade_level_id, grade_level_id, facility_type_id, alive) VALUES ('SRM7', 'SRM7', 3, true);
INSERT INTO edu_facility_type_grade_levels (facility_type_grade_level_id, grade_level_id, facility_type_id, alive) VALUES ('SRM8', 'SRM8', 4, true);
INSERT INTO edu_facility_type_grade_levels (facility_type_grade_level_id, grade_level_id, facility_type_id, alive) VALUES ('SRM9', 'SRM9', 4, true);
INSERT INTO edu_facility_type_grade_levels (facility_type_grade_level_id, grade_level_id, facility_type_id, alive) VALUES ('SRM10', 'SRM10', 4, true);
INSERT INTO edu_facility_type_grade_levels (facility_type_grade_level_id, grade_level_id, facility_type_id, alive) VALUES ('SRM11', 'SRM11', 4, true);
INSERT INTO edu_facility_type_grade_levels (facility_type_grade_level_id, grade_level_id, facility_type_id, alive) VALUES ('SRM12', 'SRM12', 4, true);
*/
--Academic Years
/*
INSERT INTO edu_academic_years (academic_year_id, name, start_date, end_date, alive) VALUES ('SRM1', '2015 - 2016', '2015-09-07', '2016-07-08', true);
INSERT INTO edu_academic_years (academic_year_id, name, start_date, end_date, alive) VALUES ('SRM2', '2016 - 2017', '2016-09-05', '2017-07-14', true);
INSERT INTO edu_academic_years (academic_year_id, name, start_date, end_date, alive) VALUES ('SRM3', '2012 - 2013', '2012-09-03', '2013-07-12', true);
INSERT INTO edu_academic_years (academic_year_id, name, start_date, end_date, alive) VALUES ('SRM4', '2013 - 2014', '2013-09-02', '2014-07-11', true);
INSERT INTO edu_academic_years (academic_year_id, name, start_date, end_date, alive) VALUES ('SRM5', '2014 - 2015', '2014-09-01', '2015-07-10', true);
*/

--Fee Payment cancellation reasons
INSERT INTO edu_fee_payment_cancellation_reasons (fee_payment_cancellation_reason_id, name, alive) VALUES ('SRM1', 'Typographical Error', true);
INSERT INTO edu_fee_payment_cancellation_reasons (fee_payment_cancellation_reason_id, name, alive) VALUES ('SRM2', 'Bounced Cheque', true);
INSERT INTO edu_fee_payment_cancellation_reasons (fee_payment_cancellation_reason_id, name, alive) VALUES ('SRM3', 'Wrong Student', true);

--Payment Methods
INSERT INTO edu_payment_methods (payment_method_id, name, alive) VALUES ('SRM1', 'Cash', true);
INSERT INTO edu_payment_methods (payment_method_id, name, alive) VALUES ('SRM2', 'Cheque', true);
INSERT INTO edu_payment_methods (payment_method_id, name, alive) VALUES ('SRM3', 'Bank Draft', true);
INSERT INTO edu_payment_methods (payment_method_id, name, alive) VALUES ('SRM4', 'Credit/Debit Card', true);

--Fee Type
INSERT INTO edu_fee_types (fee_type_id, name, alive) VALUES ('SRM1', 'Tuition', true);
INSERT INTO edu_fee_types (fee_type_id, name, alive) VALUES ('SRM2', 'Activity', true);
INSERT INTO edu_fee_types (fee_type_id, name, alive) VALUES ('SRM3', 'Bursar', true);
INSERT INTO edu_fee_types (fee_type_id, name, alive) VALUES ('SRM4', 'Security', true);
INSERT INTO edu_fee_types (fee_type_id, name, alive) VALUES ('SRM5', 'Technology', true);

--Medical condition types
INSERT INTO edu_medical_condition_types (medical_condition_type_id, name, alive) VALUES ('SRM1', 'Allergy', true);
INSERT INTO edu_medical_condition_types (medical_condition_type_id, name, alive) VALUES ('SRM2', 'Disability', true);
INSERT INTO edu_medical_condition_types (medical_condition_type_id, name, alive) VALUES ('SRM3', 'Chronic Disease', true);

--Extra curricular activity types
INSERT INTO edu_extra_curricular_activity_types (extra_curricular_activity_type_id, name, alive) VALUES ('SRM1', 'Sports', true);
INSERT INTO edu_extra_curricular_activity_types (extra_curricular_activity_type_id, name, alive) VALUES ('SRM2', 'Social Club', true);

--Extra curricular activities
INSERT INTO edu_extra_curricular_activities (extra_curricular_activity_id, name, extra_curricular_activity_type_id, alive) VALUES ('SRM1', 'Football', 'SRM1', true);
INSERT INTO edu_extra_curricular_activities (extra_curricular_activity_id, name, extra_curricular_activity_type_id, alive) VALUES ('SRM2', 'Cricket', 'SRM1', true);
INSERT INTO edu_extra_curricular_activities (extra_curricular_activity_id, name, extra_curricular_activity_type_id, alive) VALUES ('SRM3', 'Basketball', 'SRM1', true);
INSERT INTO edu_extra_curricular_activities (extra_curricular_activity_id, name, extra_curricular_activity_type_id, alive) VALUES ('SRM4', 'Track & Field', 'SRM1', true);
INSERT INTO edu_extra_curricular_activities (extra_curricular_activity_id, name, extra_curricular_activity_type_id, alive) VALUES ('SRM5', 'Table Tennis', 'SRM1', true);
INSERT INTO edu_extra_curricular_activities (extra_curricular_activity_id, name, extra_curricular_activity_type_id, alive) VALUES ('SRM6', 'Volleyball', 'SRM1', true);
INSERT INTO edu_extra_curricular_activities (extra_curricular_activity_id, name, extra_curricular_activity_type_id, alive) VALUES ('SRM7', 'Tennis (Lawn)', 'SRM1', true);
INSERT INTO edu_extra_curricular_activities (extra_curricular_activity_id, name, extra_curricular_activity_type_id, alive) VALUES ('SRM8', 'Environmental Club', 'SRM2', true);
INSERT INTO edu_extra_curricular_activities (extra_curricular_activity_id, name, extra_curricular_activity_type_id, alive) VALUES ('SRM9', 'Drama Club', 'SRM2', true);
INSERT INTO edu_extra_curricular_activities (extra_curricular_activity_id, name, extra_curricular_activity_type_id, alive) VALUES ('SRM10', 'Art Group', 'SRM2', true);

--Sequence Update
INSERT INTO edu_sequences (sequence_id, table_name,lower_limit,upper_limit,current_value,sequence_flag,facility_id) 
VALUES ('SRM1','edu_facility_types', 1, 20000000, 1,'C','SRM1');
INSERT INTO edu_sequences (sequence_id, table_name,lower_limit,upper_limit,current_value,sequence_flag,facility_id) 
VALUES ('SRM2','edu_districts', 1, 20000000,1,'C','SRM1');
INSERT INTO edu_sequences (sequence_id, table_name,lower_limit,upper_limit,current_value,sequence_flag,facility_id) 
VALUES ('SRM3','edu_communities', 1, 20000000,1,'C','SRM1');
INSERT INTO edu_sequences (sequence_id, table_name,lower_limit,upper_limit,current_value,sequence_flag,facility_id) 
VALUES ('SRM4','edu_countries', 1, 20000000,257,'C','SRM1');
INSERT INTO edu_sequences (sequence_id, table_name,lower_limit,upper_limit,current_value,sequence_flag,facility_id) 
VALUES ('SRM5','edu_facilities', 1, 20000000,1,'C','SRM1');
INSERT INTO edu_sequences (sequence_id, table_name,lower_limit,upper_limit,current_value,sequence_flag,facility_id) 
VALUES ('SRM6','edu_users', 1, 20000000,1,'C','SRM1');
INSERT INTO edu_sequences (sequence_id, table_name,lower_limit,upper_limit,current_value,sequence_flag,facility_id) 
VALUES ('SRM7','edu_menu_categories', 1, 20000000, 5, 'C','SRM1');
INSERT INTO edu_sequences (sequence_id, table_name,lower_limit,upper_limit,current_value,sequence_flag,facility_id) 
VALUES ('SRM8','edu_permissions', 1, 20000000, 141, 'C', 'SRM1');
INSERT INTO edu_sequences (sequence_id, table_name,lower_limit,upper_limit,current_value,sequence_flag,facility_id) 
VALUES ('SRM9','edu_genders', 1, 20000000,2,'C','SRM1');
INSERT INTO edu_sequences (sequence_id, table_name,lower_limit,upper_limit,current_value,sequence_flag,facility_id) 
VALUES ('SRM10','edu_grade_actvities', 1, 20000000,5,'C','SRM1');
/* To be erased
INSERT INTO edu_sequences (table_name,lower_limit,upper_limit,current_value,sequence_flag,facility_id) 
VALUES ('edu_attendance_intervals', 1, 20000000,2,'C','SRM1');*/
INSERT INTO edu_sequences (sequence_id, table_name,lower_limit,upper_limit,current_value,sequence_flag,facility_id) 
VALUES ('SRM11','edu_locales', 1, 20000000,2,'C','SRM1');
INSERT INTO edu_sequences (sequence_id, table_name,lower_limit,upper_limit,current_value,sequence_flag,facility_id) 
VALUES ('SRM12','edu_school_assignment_termination_reasons', 1, 20000000,4,'C','SRM1'); 
INSERT INTO edu_sequences (sequence_id, table_name,lower_limit,upper_limit,current_value,sequence_flag,facility_id) 
VALUES ('SRM13','edu_grade_mappings', 1, 20000000, 12,'C','SRM1');
INSERT INTO edu_sequences (sequence_id, table_name,lower_limit,upper_limit,current_value,sequence_flag,facility_id) 
VALUES ('SRM14','edu_identification_types', 1, 20000000, 4,'C','SRM1');
INSERT INTO edu_sequences (sequence_id, table_name,lower_limit,upper_limit,current_value,sequence_flag,facility_id) 
VALUES ('SRM15','edu_sequences', 1, 20000000, 15,'C','SRM1');


