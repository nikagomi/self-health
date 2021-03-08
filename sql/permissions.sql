--
-- PostgreSQL database dump
--

-- Dumped from database version 12.4
-- Dumped by pg_dump version 12.4

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- Data for Name: permissions; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.permissions (permission_id, submenu_name, url, category_id, level, level1_id, perm_text, constant, is_menu, is_container, comments, alive, submenu_name_key, perm_text_key) FROM stdin;
2	Patient Search	/patient/search/form	1	1	\N	Search for patient	PATIENT.SEARCH	t	f	perm.comm.patient.search	t	menu.patient.search	perm.text.patient.search
3	Advanced	\N	2	1	\N	Advanced functionality menus	\N	t	t	\N	t	menu.advanced.container	perm.text.advanced.container
5	Security	\N	2	1	\N	Credential/Security options	\N	t	t	\N	t	menu.security.container	perm.text.security.container
6	Users	/security/user	2	2	5	Manage user accounts	MANAGE.USERS	t	f	perm.comm.manage.user	t	menu.manage.user	perm.text.manage.user
4	App Permissions	/advanced/app/permissions	2	2	3	Manage application permissions	MANAGE.APPLICATION.PERMISSIONS	t	f	perm.comm.app.permissions	t	menu.app.permissions	perm.text.app.permissions
7	Groups	/security/group	2	2	5	Manage user groups	MANAGE.GROUPS	t	f	perm.comm.manage.group	t	menu.manage.group	perm.text.manage.group
8	General	\N	2	1	\N	Genral Administrative Functions	\N	t	t	\N	t	menu.admin.general	perm.text.admin.general
9	Genders	/gender	2	2	8	Manage Genders	MANAGE.GENDERS	t	f	\N	t	menu.manage.gender	perm.text.manage.gender
10	Religions	/religion	2	2	8	Manage religions	MANAGE.RELIGIONS	t	f	\N	t	menu.manage.religion	perm.text.manage.religion
11	Communities	/community	2	2	8	Manage communities	MANAGE.COMMUNITIES	t	f	\N	t	menu.manage.community	perm.text.manage.community
12	Districts	/district	2	2	8	Manage districts	MANAGE.DISTRICTS	t	f	\N	t	menu.manage.district	perm.text.manage.district
13	Countries	/country	2	2	8	Manage countries	MANAGE.COUNTRIES	t	f	\N	t	menu.manage.country	perm.text.manage.country
14	Ethnicities	/ethnicity	2	2	8	Manage ethnicities	MANAGE.ETHNICITIES	t	f	\N	t	menu.manage.ethnicity	perm.text.manage.ethnicity
16	Edit Patient	/patient/edit	1	\N	\N	Edit patient details	EDIT.PATIENT.DETAILS	f	f	perm.comm.patient.edit	t	nmenu.patient.edit	perm.text.patient.edit
35	Attachment Types	/attachment/type	2	2	21	Manage Atatchment Types	MANAGE.ATTACHMENT.TYPES	t	f	\N	t	menu.admin.attachment.types.title	perm.text.admin.attachment.types
15	Register Patient	/patient/register/form	1	1	\N	Register new patients	REGISTER.PATIENT	t	f	perm.comm.patient.register	t	menu.patient.register	perm.text.patient.register
17	Edit Next of Kin	\N	1	\N	\N	Edit Next of Kin	EDIT.NEXT.OF.KIN	f	f	\N	t	menu.next.of.kin.edit	perm.text.next.of.kin.edit
18	Patient Photo Edit	\N	1	\N	\N	Edit Patient Photo	EDIT.PATIENT.PHOTO	f	f	\N	t	menu.patient.photo.edit	perm.text.patient.photo.edit
19	Manage Relations	/relation	2	2	8	Manage relationship types	MANAGE.RELATIONS	t	f	\N	t	menu.manage.relationship.type	perm.text.manage.relationship.type
21	Clinical	\N	2	1	\N	Clinical	\N	t	t	\N	t	menu.container.clinical	perm.text.container.clinical
20	Clinicians	/clinician	2	2	21	Manage clinicians	MANAGE.CLINICIANS	t	f	\N	t	menu.manage.clinician	perm.text.manage.clinician
23	Billing	\N	2	1	\N	Billing	\N	t	t	\N	t	menu.container.billing	perm.text.container.billing
24	Procedure Costs	/procedure/cost	2	2	23	Manage the cost of procedures	MANAGE.PROCEDURE.COSTS	t	f	perm.comm.manage.procedure.cost	t	menu.manage.procedure.cost	perm.text.manage.procedure.cost
25	Create Visit	\N	1	\N	\N	Create Patient Visits	CREATE.PATIENT.VISIT	f	f	perm.comm.visit.create	t	menu.visit.create	perm.text.visit.create
29	Cancellation Reasons	/billing/payment/cancellation/reason	2	\N	23	Manage payment cancellation reasons	MANAGE.PAYMENT.CANCELLATION.REASONS	t	f	perm.comm.manage.payment.cancellation.reason	t	menu.manage.payment.cancellation.reason	perm.text.manage.payment.cancellation.reason
28	Payment Methods	/billing/payment/method	2	2	23	Manage payment methods	MANAGE.PAYMENT.METHODS	t	f	\N	t	menu.manage.payment.method	perm.text.manage.payment.method
30	Titles	/title	2	2	8	Manage titles	MANAGE.TITLES	t	f	\N	t	menu.manage.title	perm.text.manage.title
31	Appointments	\N	2	1	\N	Manage appointment data	\N	t	t	\N	t	menu.appointment.title	perm.text.appointment.title
32	Appointment Statuses	/appointment/status	2	2	31	Manage appointment statuses	MANAGE.APPOINTMENT.STATUSES	t	f	\N	t	menu.appointment.status.title	perm.text.appointment.status
33	Days	/admin/days	2	2	31	Manage days	MANAGE.DAYS	t	f	\N	t	menu.admin.days.title	perm.text.admin.days
36	Temporality	/temporality	2	2	21	Manage Temporalities	MANAGE.TEMPORALITIES	t	f	\N	t	menu.manage.temporality	perm.text.manage.temporality
38	Patient Groups	/patient/group	1	1	\N	Manage Patient Groups	MANAGE.PATIENT.GROUPS	t	f	\N	t	menu.manage.patient.group.title	perm.text.manage.patient.groups
39	Email Broadcasts	/email/broadcast/form	1	1	\N	Send Email Broadcasts	SEND.EMAIL.BROADCASTS	t	f	\N	t	menu.email.broadcast.title	perm.text.email.broadcasts
40	View Procedures	\N	1	\N	\N	View visit procedures	VIEW.VISIT.PROCEDURES	f	f	\N	t	menu.view.procedures.title	perm.text.view.procedures
41	Edit Procedures	\N	1	\N	\N	Edit visit procedures	EDIT.VISIT.PROCEDURES	f	f	\N	t	menu.edit.procedures.title	perm.text.edit.procedures
42	View Diagnoses	\N	1	\N	\N	View visit diagnoses	VIEW.VISIT.DIAGNOSES	f	f	\N	t	menu.view.diagnoses.title	perm.text.view.diagnoses
43	Edit Diagnoses	\N	1	\N	\N	Edit visit diagnoses	EDIT.VISIT.DIAGNOSES	f	f	\N	t	menu.edit.diagnoses.title	perm.text.edit.diagnoses
44	View vitals	\N	1	\N	\N	View visit vitals	VIEW.VISIT.VITALS	f	f	\N	t	menu.view.vitals.title	perm.text.view.vitals
45	Edit Vitals	\N	1	\N	\N	Edit visit vitals	EDIT.VISIT.VITALS	f	f	\N	t	menu.edit.vitals.title	perm.text.edit.vitals
46	Upload attachments	\N	1	\N	\N	Upload attachments	UPLOAD.ATTACHMENTS	f	f	\N	t	menu.upload.attachments.title	perm.text.upload.attachments
47	View Attachments	\N	1	\N	\N	View attachments	VIEW.ATTACHMENTS	f	f	\N	t	menu.view.attachments.title	perm.text.view.attachments
26	View Visit	\N	1	\N	\N	View patient visits	VIEW.PATIENT.VISIT	f	f	perm.comm.visit.view	t	menu.visit.view	perm.text.visit.view
48	Close Visit	\N	1	\N	\N	Close visit	VISIT.CLOSE	f	f	\N	t	menu.visit.close	perm.text.visit.close
50	Procedure Details	/report/procedure/details/form	3	1	\N	Procedure details report	REPORT.PROCEDURE.DETAILS	t	f	perm.comm.report.procedure	t	menu.report.procedure.title	perm.text.report.procedure
51	Schedules	/appointment/schedule/form	2	2	31	Manage clinician schedules	MANAGE.CLINICIAN.SCHEDULES	t	f	\N	t	menu.clinician.schedule.title	perm.text.clinician.schedule
52	Visit Payments	\N	1	\N	\N	Record Visit Payments	RECORD.VISIT.PAYMENTS	f	f	\N	t	menu.visit.payments.title	perm.text.visit.payments
98	View Visit	\N	1	\N	\N	View Visit Details	VIEW.VISIT	f	f	\N	t	menu.view.visit	perm.text.view.visit
53	Visit by Date	/report/visit/daily	3	1	\N	Visit by date report	\N	t	f	perm.comm.report.visit.dail	t	menu.report.visit.daily.title	perm.text.report.visit.daily
54	Birthday Notifications	\N	1	1	\N	View Birthday Notifications	VIEW.BIRTHDAY.NOTIFICATION	f	f	perm.comm.birthday.notify	t	menu.birthday.notify	perm.text.birthday.notify
55	Birthdays	/patient/birthday/form	1	1	\N	Search/View patient birthdays	SEARCH.PATIENT.BIRTHDAY	t	f	perm.comm.patient.birthdays	t	menu.patient.birthdays	perm.text.patient.birthdays
58	Visit Templates	/visit/template	2	2	3	Manage Visit Templates	MANAGE.VISIT.TEMPLATES	t	f	\N	t	menu.manage.visit.template	perm.text.visit.template
61	View Complaints	\N	1	\N	\N	View Patient Complaints	VIEW.PATIENT.COMPLAINTS	f	f	\N	t	menu.view.complaints.title	perm.text.view.complaints
62	Edit Complaints	\N	1	\N	\N	Edit Patient Complaints	EDIT.PATIENT.COMPLAINTS	f	f	\N	t	menu.edit.complaints.title	perm.text.edit.complaints
63	Print Rx	\N	1	\N	\N	Print Prescriptions	PRINT.PRESCRIPTION	f	f	\N	t	menu.print.prescription.title	menu.print.prescription.title
65	Print Lab Requests	\N	1	\N	\N	Print Lab Test Requests	PRINT.LAB.TEST.REQUEST	f	f	\N	t	menu.print.lab.test.request	perm.text.print.lab.test.request
66	View Urinalysis	\N	1	\N	\N	View Urinalysis Results	VIEW.URINALYSIS	f	f	\N	t	menu.view.urinalysis.title	perm.text.view.urinalysis
67	Edit Urinalysis	\N	1	\N	\N	Enter/Edit Urinalysis Results	EDIT.URINALYSIS	f	f	\N	t	menu.edit.urinalysis.title	perm.text.edit.urinalysis
64	Visitor Editor Override	\N	1	\N	\N	Visitor Editor Override	VISIT.EDITOR.OVERRIDE	f	f	perm.comm.visit.editor	t	menu.visit.editor.title	menu.visit.editor.title
68	View Physical Findings	\N	1	\N	\N	View Physical Findings	VIEW.PHYSICAL.FINDINGS	f	f	\N	t	menu.view.physical.finding	perm.text.view.physical.finding
69	Edit Physical Findings	\N	1	\N	\N	Edit Physical Findings	EDIT.PHYSICAL.FINDINGS	f	f	\N	t	menu.edit.physical.finding	perm.text.edit.physical.finding
71	Allergen Types	/allergen/type	2	2	21	Manage Allergen Types	MANAGE.ALLERGEN.TYPES	t	f	\N	t	menu.allergen.type.title	perm.text.allergen.type
73	Patient Allergies	\N	1	\N	\N	Manage Patient Allergies	MANAGE.PATIENT.ALLERGIES	f	f	\N	t	menu.manage.patient.allergies	perm.text.patient.allergies
74	Patient Problems	\N	1	\N	\N	Manage Patient Problems	MANAGE.PATIENT.PROBLEMS	f	f	\N	t	menu.manage.patient.problems	perm.text.patient.problems
75	View Action Plans	\N	1	\N	\N	View Action Plans	VIEW.ACTION.PLANS	f	f	\N	t	menu.view.action.plan	perm.text.view.action.plan
76	Edit Action Plans	\N	1	\N	\N	Edit Visit Action Plans	EDIT.ACTION.PLANS	f	f	\N	t	menu.edit.action.plan	perm.text.view.action.plan
77	Complaint History	\N	1	\N	\N	Edit Complaint History	EDIT.COMPLAINT.HISTORY	f	f	\N	t	menu.edit.complaint.history	perm.text.edit.complaint.history
78	Complaint History	\N	1	\N	\N	View Complaint History	VIEW.COMPLAINT.HISTORY	f	f	\N	t	menu.view.complaint.history	perm.text.view.complaint.history
79	Recreational Drugs	/recreational/drug	2	2	21	Manage Recreational Drugs	MANAGE.RECREATIONAL.DRUGS	t	f	\N	t	menu.manage.recreational.drug	perm.text.recreational.drug
80	Contraceptive Methods	/contraceptive/method	2	2	21	Manage Contraceptive Methods	MANAGE.CONTRACEPTIVE.METHODS	t	f	\N	t	menu.manage.contraceptive.method	perm.text.contraceptive.method
81	Recreational Drug Use	\N	1	\N	\N	Manage Recreational Drug Use	MANAGE.PATIENT.DRUG.USES	f	f	\N	t	menu.manage.patient.drug.use	perm.text.patient.drug.use
82	View Intake Medical History	\N	1	\N	\N	View Patient Intake Medical History	VIEW.INTAKE.HISTORY	f	f	\N	t	menu.view.intake.medical.history	perm.text.view.intake.medical.history
83	Edit Intake Medical History	\N	1	\N	\N	Edit Patient Intake Medical History	EDIT.INTAKE.HISTORY	f	f	\N	t	menu.edit.intake.medical.history	perm.text.edit.intake.medical.history
84	View Obstetric History	\N	1	\N	\N	View Patient Obstetric History	VIEW.OBSTETRIC.HISTORY	f	f	\N	t	menu.view.obstetric.history	perm.text.view.obstetric.history
85	Edit Obstetric History	\N	1	\N	\N	Edit Patient Obstetric History	EDIT.OBSTETRIC.HISTORY	f	f	\N	t	menu.edit.obstetric.history	perm.text.edit.obstetric.history
86	Visit Data Sets	\N	2	1	\N	Visit Data Sets	\N	t	t	\N	t	menu.container.visit.data.set	menu.container.visit.data.set
60	Body Parts	/body/part	2	2	86	Manage Body Parts	MANAGE.BODY.PARTS	t	f	\N	t	menu.manage.body.part	perm.text.body.part
70	Body Systems	/body/system	2	2	86	Manage Body Systems	MANAGE.BODY.SYSTEMS	t	f	\N	t	menu.manage.body.system	perm.text.body.system
72	Disease Codes	/disease/code	2	2	86	Manage Disease Codes	MANAGE.DISEASE.CODES	t	f	\N	t	menu.disease.code.title	perm.text.disease.code
57	Lab Tests	/lab/test	2	2	86	Manage Lab Tests	MANAGE.LAB.TESTS	t	f	\N	t	menu.manage.lab.test	perm.text.lab.test
56	Lab Test Sections	/lab/test/section	2	2	86	Manage Lab Test Sections	MANAGE.LAB.TEST.SECTIONS	t	f	\N	t	menu.manage.lab.test.section	perm.text.lab.test.section
22	Procedures	/procedure	2	2	86	Manage procedures	MANAGE.PROCEDURES	t	f	perm.comm.manage.procedure	t	menu.manage.procedure	perm.text.manage.procedure
87	Radiology Tests	/radiology/test	2	2	86	Manage Radiology Tests	MANAGE.RADIOLOGY.TESTS	t	f	\N	t	menu.manage.radiology.test	perm.text.radiology.test
88	View Cinical Notes	\N	1	\N	\N	View Visit Clinical Notes	VIEW .CLINICAL.NOTES	f	f	\N	t	menu.view.clinical.notes	perm.text.view.clinical.notes
89	Edit Clinical Notes	\N	1	\N	\N	Edit Visit Clinical Notes	EDIT.CLINICAL.NOTES	f	f	\N	t	menu.edit.clinical.notes	perm.text.edit.clinical.notes
90	View Post Visit Notes	\N	1	\N	\N	View Post Visit Notes	VIEW.POST.VISIT.NOTES	f	f	\N	t	menu.view.post.visit.notes	perm.text.view.post.visit.notes
91	Edit Post Visit Notes	\N	1	\N	\N	Edit Post Visit Notes	EDIT.POST.VISIT.NOTES	f	f	\N	t	menu.edit.post.visit.notes	perm.text.edit.post.visit.notes
92	Print Radiology Request	\N	1	\N	\N	Print Radiology Request	PRINT.RADIOLOGY.TEST.REQUEST	f	f	\N	t	menu.print.radiology.request	perm.text.print.radiology.request
93	Medication Classes	/billing/medication/class	2	2	23	Manage Medication Classes	MANAGE.BILLING.MEDICATION.CLASSES	t	f	perm.comm.medication.class	t	menu.manage.medication.class	perm.text.medication.class
94	Medication Class Cost	/medication/class/cost	2	2	23	Manage Medication Class Costs	MANAGE.MEDICATION.CLASS.COSTS	t	f	perm.comm.medication.class.cost	t	menu.manage.medication.class.cost	perm.text.medication.class.cost
95	View Gynaecology Measures	\N	1	\N	\N	View Visit Gynaecology Measures	VIEW.GYNAE.MEASURES	f	f	\N	t	menu.view.gynae.measures	perm.text.view.gynae.measures
96	Edit Gynaecology Measures	\N	1	\N	\N	Edit Visit Gynaecology Measures	EDIT.GYNAE.MEASURES	f	f	\N	t	menu.edit.gynae.measures	perm.text.edit.gynae.measures
100	Facilities	/facility	2	2	8	Manage Facilities	MANAGE.FACILITIES	t	f	\N	t	menu.manage.facilities	perm.text.manage.facilities
99	Facility Types	/facilitytype	2	2	5	Manage Facility Types	MANAGE.FACILITY.TYPES	t	f	perm.comm.manage.facility.types	t	menu.manage.facility.types	perm.text.manage.facility.types
101	Facility Emblem	\N	2	\N	\N	Modify facility Emblem	MODIFY.FACILITY.EMBLEM	f	f	\N	t	menu.modify.facility.emblem	perm.text.modify.facility.emblem
102	Application Counters	/counter	2	2	3	Manage Application Counters	MANAGE.APPLICATION.COUNTERS	t	f	perm.comm.manage.application.counters	t	menu.manage.application.counters	perm.text.manage.application.counters
104	Print Statements	\N	3	\N	\N	Print Patient Statements	PRINT.PATIENT.STATEMENT	f	f	\N	t	menu.print.patient.statement	perm.text.print.patient.statements
105	Print Receipts	\N	3	\N	\N	Print Patient Receipts	PRINT.PATIENT.RECEIPT	f	f	\N	t	menu.print.patient.receipt	perm.text.print.patient.receipt
106	Print Invoice	\N	3	\N	\N	Print Patient invoice	PRINT.PATIENT.BILL	f	f	\N	t	menu.print.patient.invoice	perm.text.print.patient.invoice
107	Modify Invoice	\N	2	\N	\N	Modify Patient Invoice	MODIFY.PATIENT.BILL	f	f	\N	t	menu.modify.patient.invoice	perm.text.modify.patient.invoice
108	Finalize Invoice	\N	2	\N	\N	Finalize Patient Invoice	FINALIZE.BILL	f	f	\N	t	menu.finalize.patient.invoice	perm.text.finalize.patient.invoice
97	Modify Patient Bill	\N	1	\N	\N	Modify Patient Bill	\N	f	t	\N	t	menu.modify.patient.bill	perm.text.modify.patient.bill
103	Account Statement Report	/report/account/statements/form	3	2	109	Generate account statement report	REPORT.GENERATE.ACCOUNT.STATEMENT	t	f	\N	t	menu.rpt.account.statements	perm.text.rpt.account.statements
109	Finance	\N	3	1	\N	Access Billing Reports	\N	t	t	\N	t	menu.report.finance.container	perm.text.report.finance.container
110	Is Doctor	\N	2	\N	\N	User is a doctor	IS.DOCTOR	f	f	\N	t	menu.perm.is.doctor	menu.perm.text.is.doctor
112	Patient Chronic Diseases	\N	1	\N	\N	Manage Patient Chronic Diseases	MANAGE.PATIENT.CHRONIC.DISEASES	f	f	\N	t	menu.patient.chronic.disease	perm.text.patient.chronic.disease
113	Re-open Bill	\N	1	\N	\N	Re-open Patient Bill	UNFINALIZE.BILL	f	f	\N	t	menu.reopen.patient.bill	perm.text.reopen.patient.bill
111	Generate Referral Letters	\N	3	\N	\N	Generate Patient Referral Letters	GENERATE.REFERRAL.LETTER	f	f	\N	t	menu.perm.generate.referral.letter	menu.perm.text.generate.referral.letter
114	Generate Visit Summary	\N	3	\N	\N	Generate Visit Summary	GENERATE.VISIT.SUMMARY	f	f	\N	t	menu.perm.generate.visit.summary	menu.perm.text.generate.visit.summary
115	Visit Statistics	\N	3	1	\N	Statistical Reports	\N	t	t	\N	t	menu.report.visit.statistic.container	perm.text.report.visit.statistic.container
116	Doctors Visit Summary	/report/visits/by/doctors/form	3	2	115	Doctors' visit summary for a date range	REPORT.VISITS.BY.DOCTORS	t	f	\N	t	menu.report.doctors.visits	perm.text.report.doctors.visits
117	Visits by Doctor by Date	/report/visit/by/doctors/form	3	2	115	Visit summary by doctor for a date range	REPORT.DOCTOR.VISIT.SUMMARY	t	f	\N	t	menu.report.doctor.visit.summary	perm.text.report.doctor.visit.summary
118	New / Existing Clients by Date Range	/report/visits/new/existing/form	3	2	115	New / Existing Clients by Date Range	REPORT.NEW.EXISTING.CLIENTS	t	f	\N	t	menu.report.new.existing.clients	perm.text.report.new.existing.clients
119	View Privileged Diagnoses	\N	1	\N	\N	View Privileged Diagnoses	VIEW.PRIVILEGED.DIAGNOSES	f	f	\N	t	menu.view.privileged.diagnoses	perm.text.view.privileged.diagnoses
120	Update Diagnosis State	\N	1	\N	\N	Update Diagnosis State (closed visits)	UPDATE.DIAGNOSIS.STATE	f	f	perm.comm.update.diagnosis.state	t	menu.update.diagnosis.state	perm.text.update.diagnosis.state
121	Parent Companies	/billing/parent/company	2	2	23	Manage Parent Companies	MANAGE.PARENT.COMPANIES	t	f	\N	t	menu.manage.parent.companies	perm.text.manage.parent.companies
122	Parent Company Due Invoices	/report/parent/company/invoices/due/form	3	1	\N	List due parent company invoices	REPORT.PARENT.COMPANY.DUE.INVOICE	t	f	\N	t	menu.report.due.parent.company.invoice	perm.text.report.due.parent.company.invoice
123	Edit Patient Visit Observation Sheet	\N	1	\N	\N	Edit Patient Visit Observation Sheet	EDIT.VISIT.PATIENT.OBSERVATIONS	f	f	\N	t	menu.edit.patient.visit.observation	perm.text.edit.patient.visit.observation
124	View Patient Visit Observation Sheet	\N	1	\N	\N	View Patient Visit Observation Sheet	VIEW.VISIT.PATIENT.OBSERVATIONS	f	f	\N	t	menu.view.patient.visit.observation	perm.text.view.patient.visit.observation
125	Is Nurse	\N	2	\N	\N	User is a nurse	IS.NURSE	f	f	\N	t	menu.perm.is.nurse	menu.perm.text.is.nurse
126	Payments Export (QuickBooks)	/report/qb/payment/export/form	3	2	109	Generate Payment Export for QuickBooks (Excel)	REPORT.EXPORT.QB.PAYMENTS	t	f	perm.comm.export.qb.payments	t	menu.perm.export.qb.payments	perm.text.export.qb.payments
127	Template Fragments	/template/fragment	2	2	3	Manage Template Fragments	MANAGE.TEMPLATE.FRAGMENTS	t	f	perm.comm.template.fragment	t	menu.manage.template.fragment	perm.text.template.fragment
128	Home Care	\N	2	1	\N	Access Home Care Functionality	\N	t	t	\N	t	menu.home.care.container	perm.text.home.care.container
129	Home Care Intake	/home/care/intake/form	1	1	\N	Record Home Care Intake Consultation	MANAGE.HOME.CARE.INTAKE	t	f	perm.comm.home.care.intake	t	menu.home.care.intake	perm.text.home.care.intake
130	View Home Care Intake	\N	1	\N	\N	View Home Care Intake Consultation	VIEW.HOME.CARE.INTAKE	f	f	perm.comm.view.home.care.intake	t	menu.view.home.care.intake	perm.text.view.home.care.intake
131	Home Care Services	/home/care/service	2	2	128	Manage Home Care Services	MANAGE.HOME.CARE.SERVICES	t	f	\N	t	menu.home.care.service	perm.text.home.care.service
132	Inventory	\N	2	1	\N	Access Inventory Components	\N	t	t	\N	t	menu.inventory.container	perm.text.inventory.container
133	Item Types	/inventory/item/type	2	2	132	Manage Inventory Item Types	MANAGE.INVENTORY.ITEM.TYPES	t	f	\N	t	menu.inventory.type.title	perm.text.inentory.type
134	Packaging Units	/inventory/packaging/unit	2	2	132	Manage Packaging Units	MANAGE.PACKAGING.UNITS	t	f	\N	t	menu.packaging.unit.title	perm.text.packaging.unit
135	Sale Items	/sale/item	2	2	132	Manage Sale Items	MANAGE.SALE.ITEMS	t	f	\N	t	menu.sale.item.title	perm.text.sale.item
136	Inventory Items	/inventory/item	2	2	132	Manage Inventory Items	MANAGE.INVENTORY.ITEMS	t	f	\N	t	menu.inventory.item.title	perm.text.inventory.item
137	Record Sales	/sale/form	2	2	132	Record Sales of Inventory Items	RECORD.INVENTORY.ITEM.SALES	t	f	\N	t	menu.record.sales.title	perm.text.record.sales
139	List Sales	/list/sales	2	2	132	List Sales by Date	LIST.SALES	t	f	\N	t	menu.list.sales.title	perm.text.list.sales
140	OTC Sales by Date Range	/report/sale/listing/form	3	2	138	OTC Sales by Date Range	REPORT.SALE.LISTING	t	f	\N	t	menu.report.sale.listing	perm.text.report.sale.listing
138	Inventory	\N	3	1	\N	Inventory Reports	\N	t	t	\N	t	menu.report.inventory.container	perm.text.report.inventory.container
141	Sale Item Lookup	/sale/item/lookup/form	2	2	132	Lookup item inventory and sa	SALE.ITEM.LOOKUP	t	f	\N	t	menu.sale.item.lookup	perm.text.sale.item.lookup
143	Rx Drugs Prices	/rx/pharmaceutical/price	2	2	23	Manage Rx Drugs Prices	MANAGE.RX.PHARM.PRICES	t	f	perm.comm.manage.rx.pharm.price	t	menu.manage.rx.pharm.price	perm.text.manage.rx.pharm.price
144	Expiring/Expired Inventory	/report/expiring/inventory	3	2	138	Expiring and soon to expire inventory	EXPIRING.INVENTORY.ITEM.REPORT	t	f	perm.comm.rpt.expiring.inventory	t	menu.rpt.expiring.inventory	perm.text.rpt.expiring.inventory
145	Visit Rx Billing	\N	1	\N	\N	Rx drug billing for visits	RX.BILLING	f	f	perm.comm.visit.rx.billing	t	menu.visit.rx.billing	perm.text.visit.rx.billing
146	Retired Inventory	/report/retired/inventory/form	3	2	138	Retired inventory items report	RETIRED.INVENTORY.REPORT	t	f	perm.comm.rpt.expiring.inventory	t	menu.rpt.retired.inventory	perm.text.rpt.retired.inventory
147	Branch Visits	/report/facility/visits/form	3	2	115	Visits by branch report	REPORT.FACILITY.VISITS	t	f	perm.comm.rpt.facility.visits	t	menu.rpt.facility.visits	perm.text.rpt.facility.visits
148	Home Care	\N	3	1	\N	Home Care Reports	\N	t	t	\N	t	menu.report.home.care.container	perm.text.report.home.care.container
149	Intake Consultation	/report/intake/consultation/form	3	2	148	Intake consultations finance report	REPORT.INTAKE.CONSULTATION	t	f	perm.comm.rpt.intake.consultation	t	menu.rpt.intake.consultation	perm.text.rpt.intake.consultation
150	Adjunctive Services	/report/adjunctive/service/form	3	2	148	Adjunctive services finance report	REPORT.ADJUNCTIVE.SERVICES	t	f	perm.comm.rpt.adjunctive.service	t	menu.rpt.adjunctive.service	perm.text.rpt.adjunctive.service
151	Actions Taken	/action/taken	2	2	8	Manage Actions Taken	MANAGE.ACTIONS.TAKEN	t	f	\N	t	menu.manage.actions.taken	perm.text.manage.actions.taken
152	Log Calls	/call/log/sheet/form	1	1	\N	Record/Log Incoming Calls	LOG.CALLS	t	f	\N	t	menu.manage.call.log.sheet	perm.text.call.log.sheet
153	Logged Calls by Facility	/report/call/log/sheet/form	3	1	\N	Logged calls by facility report	REPORT.CALL.LOG.SHEET	t	f	perm.comm.rpt.call.log.sheet	t	menu.rpt.call.log.sheet	perm.text.rpt.call.log.sheet
142	Manage Rx Drugs	/rx/pharmaceutical	2	2	21	Manage Rx Drugs	MANAGE.LOCAL.RX.PHARMS	t	f	\N	t	menu.local.rx.pharms	perm.text.local.rx.pharms
154	Manage Care Plan Item	\N	1	\N	\N	Manage care plan items	MANAGE.CARE.PLAN.ITEM	f	f	\N	t	menu.manage.care.plan.item	perm.text.manage.care.plan.item
155	Patient Group Members	/report/patient/group/member/form	3	1	\N	List Patient Group Members	REPORT.LIST.PATIENT.GROUP.MEMBERS	t	f	\N	t	menu.rpt.list.group.members	perm.text.list.group.members
156	Backup Sync	/sync/facility/status	2	2	3	Backup Sync Status	SYNC.FACILITY.HEARTBEAT.STATUS	t	f	\N	t	menu.backup.sync	perm.text.backup.sync
157	Threshold Alerts	/inventory/threshold/alert/view	2	2	132	View Inventory Threshold Alerts	STOCK.ALERT.RECEIVER	t	f	perm.comm.minimum.stock.alert.view	t	menu.minimum.stock.alert.view	perm.text.minimum.stock.alert.view
158	Stock Alert Receiver	\N	2	\N	\N	Stock Alert Receiver	STOCK.ALERT.RECEIVER	f	f	perm.comm.stock.alert.receiver	t	menu.stock.alert.receiver	perm.text.stock.alert.receiver
159	Inventory Thresholds	/inventory/threshold	2	2	132	Define minimum stock thresholds	MANAGE.INVENTORY.THRESHOLDS	t	f	perm.comm.manage.inventory.threshold	t	menu.manage.inventory.threshold	perm.text.manage.inventory.threshold
\.


--
-- PostgreSQL database dump complete
--

