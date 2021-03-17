<?php

use Symfony\Component\Routing;

$routes = new Routing\RouteCollection();
/* Initial web site index page */
$routes->add('index', new Routing\Route('/', array(
    '_controller' => 'Authentication\\Controller\\AuthenticationController::indexAction',)));

/* Error routes */
$routes->add('access_denied', new Routing\Route('/access/denied/{errorMessage}', 
        array('_controller' => 'Error\\Controller\\ErrorController::noAccessGranted', 'errorMessage' => '')));
$routes->add('access_denied_simple', new Routing\Route('/access/denied/simple/{errorMessage}', 
        array('_controller' => 'Error\\Controller\\ErrorController::noAccessGrantedSimple', 'errorMessage' => '')));
$routes->add('error_404', new Routing\Route('/resource/not/found', array(
    '_controller' => 'Error\\Controller\\ErrorController::error404')));
$routes->add('process_error_detail', new Routing\Route('/process/error/detail', array(
    '_controller' => 'Error\\Controller\\ErrorController::processErrorDetails')));

/* Notification routes */
$routes->add('ajax_notification_get', new Routing\Route('/ajax/notification/get', array(
    '_controller' => 'Utility\\Controller\\NotificationController::ajaxGetNotifications')));
$routes->add('ajax_notification_close', new Routing\Route('/ajax/notification/close', array(
    '_controller' => 'Utility\\Controller\\NotificationController::ajaxAcknowledgeNotification')));

$routes->add('ajax_user_notification_get', new Routing\Route('/ajax/user/notification/get', array(
    '_controller' => 'Utility\\Controller\\NotificationMessageController::ajaxGetUserNotifications')));
$routes->add('ajax_user_notification_close', new Routing\Route('/ajax/user/notification/close', array(
    '_controller' => 'Utility\\Controller\\NotificationMessageController::ajaxAcknowledgeUserNotification')));

$routes->add('ajax_get_email_broadcast_recipients', new Routing\Route('/ajax/email/broadcast/recipients', array(
    '_controller' => 'Utility\\Controller\\NotificationMessageController::ajaxEmailBroadcastRecipients')));
$routes->add('ajax_send_broadcast_email', new Routing\Route('/ajax/send/broadcast/email', array(
    '_controller' => 'Utility\\Controller\\NotificationMessageController::ajaxSendEmailBroadcast')));

/* Authentication actions */
$routes->add('login', new Routing\Route('/login', array(
    '_controller' => 'Authentication\\Controller\\AuthenticationController::login',)));
$routes->add('logOut', new Routing\Route('/logOut', array(
    '_controller' => 'Authentication\\Controller\\AuthenticationController::logOut',)));
$routes->add('reset', new Routing\Route('/reset', array(
    '_controller' => 'Authentication\\Controller\\AuthenticationController::resetPassword',)));
$routes->add('timeout_logOut', new Routing\Route('/logOut/timeOut', array(
    '_controller' => 'Authentication\\Controller\\AuthenticationController::timeoutLogOut',)));
$routes->add('login_home', new Routing\Route('/user/home', array(
    '_controller' => 'Authentication\\Controller\\AuthenticationController::navigateHome',)));
$routes->add('forgot_password_request', new Routing\Route('/user/forgot/password', array(
    '_controller' => 'Authentication\\Controller\\AuthenticationController::forgotPasswordRequest',)));

$routes->add('tfa_verify_code', new Routing\Route('/tfa/verify', 
    array('_controller' => 'Authentication\\Controller\\AuthenticationController::verifyTFA')));

$routes->add('tfa_verify_code_again', new Routing\Route('/tfa/verify/code', 
    array('_controller' => 'Authentication\\Controller\\AuthenticationController::verifyCode')
));

$routes->add('tfa_verify_backup_code', new Routing\Route('/tfa/verify/backup/code', 
    array('_controller' => 'Authentication\\Controller\\AuthenticationController::verifyBackupCode')
));

$routes->add('tfa_backup_code_login', new Routing\Route('/tfa/backup/code/login', 
    array('_controller' => 'Authentication\\Controller\\AuthenticationController::backupCodeTFALogin')));
//NEW HEALTH STUFF ***************************************************************************************



//Country Actions
$routes->add('country_form', new Routing\Route('/country', 
    array('_controller' => 'Admin\\Controller\\CountryController::form')
));
$routes->add('country_save', new Routing\Route('/country/save', 
    array('_controller' => 'Admin\\Controller\\CountryController::save')
));
$routes->add('country_edit', new Routing\Route('/country/edit/{id}', 
    array('_controller' => 'Admin\\Controller\\CountryController::edit'),
    array('id' => '[A-Z0-9]+')
));
$routes->add('country_delete', new Routing\Route('/country/delete/{id}', 
    array('_controller' => 'Admin\\Controller\\CountryController::delete'),
    array('id' => '[A-Z0-9]+')
));


/* Gender Actions */
$routes->add('gender_form', new Routing\Route('/gender', 
        array('_controller' => 'Admin\\Controller\\GenderController::form')
 ));
$routes->add('gender_edit', new Routing\Route('/gender/edit/{id}', 
    array('_controller' => 'Admin\\Controller\\GenderController::edit'),
    array("id" => "[A-Z0-9]+")
));
$routes->add('gender_save', new Routing\Route('/gender/save', 
    array('_controller' => 'Admin\\Controller\\GenderController::save')
));
$routes->add('gender_delete', new Routing\Route('/gender/delete/{id}', 
    array('_controller' => 'Admin\\Controller\\GenderController::delete'),
    array("id" => "[A-Z0-9]+")
));

/* User preferences */
$routes->add('preference_form', new Routing\Route('/security/user/preferences', 
    array('_controller' => 'Authentication\\Controller\\UserController::getPreferences'))
);
$routes->add('enable_2fa', new Routing\Route('/enable/tfa', 
    array('_controller' => 'Authentication\\Controller\\UserController::enableTFA'))
);
$routes->add('disable_2fa', new Routing\Route('/disable/tfa', 
    array('_controller' => 'Authentication\\Controller\\UserController::disableTFA'))
);
$routes->add('enable_2fa-pwd', new Routing\Route('/verify/pwd', 
    array('_controller' => 'Authentication\\Controller\\UserController::verifyPassword'))
);
$routes->add('preference_update', new Routing\Route('/security/user/preferences/save', 
    array('_controller' => 'Authentication\\Controller\\UserController::updatePreferences'))
);
$routes->add('verify_unique_user_email', new Routing\Route('/ajax/user/verify/unique/email', 
    array('_controller' => 'Authentication\\Controller\\UserController::ajaxIsUserEmailUnique'))
);

/* Group Actions */
$routes->add('group_form', new Routing\Route('/security/group', 
        array('_controller' => 'Authentication\\Controller\\GroupController::form')
        )
);
$routes->add('group_edit', new Routing\Route('/security/group/edit/{id}', 
        array('_controller' => 'Authentication\\Controller\\GroupController::edit'),
        array("id" => "[A-Z0-9]+")
        )
);
$routes->add('group_save', new Routing\Route('/security/group/save', 
        array('_controller' => 'Authentication\\Controller\\GroupController::save')
));
$routes->add('group_delete', new Routing\Route('/security/group/delete/{id}', 
        array('_controller' => 'Authentication\\Controller\\GroupController::delete'),
        array("id" => "[A-Z0-9]+")
        )
);

/* User Actions */
$routes->add('user_form', new Routing\Route('/security/user', 
        array('_controller' => 'Authentication\\Controller\\UserController::form')
));
$routes->add('user_edit', new Routing\Route('/security/user/edit/{id}', 
        array('_controller' => 'Authentication\\Controller\\UserController::edit'),
        array("id" => "[A-Z0-9]+")
));
$routes->add('user_save', new Routing\Route('/security/user/save', 
        array('_controller' => 'Authentication\\Controller\\UserController::save')
));
$routes->add('user_delete', new Routing\Route('/security/user/delete/{id}', 
        array('_controller' => 'Authentication\\Controller\\UserController::delete'),
        array("id" => "[A-Z0-9]+")
));
$routes->add('user_ajaxGetName', new Routing\Route('/user/ajax/get/name/{id}', 
        array('_controller' => 'Authentication\\Controller\\UserController::ajaxGetName'),
        array("id" => "[A-Z0-9]+")
));
$routes->add('user_logged_in', new Routing\Route('/admin/logged/users', 
    array('_controller' => 'Authentication\\Controller\\UserController::retrieveLoggedInUsers')
));
$routes->add('tfa_enabled_users', new Routing\Route('/admin/tfa/enabled/users', 
    array('_controller' => 'Authentication\\Controller\\UserController::retrieve2FAEnabledUsers')
));
$routes->add('force_user_log_out', new Routing\Route('/force/user/log/out/{userId}', 
    array('_controller' => 'Authentication\\Controller\\AuthenticationController::forceLogOut'),
    array("userId" => "[A-Z0-9]+")
));
$routes->add('register_user', new Routing\Route('/register/user', 
    array('_controller' => 'Authentication\\Controller\\UserController::registerPatientUser')
));
$routes->add('register_user_check_capture', new Routing\Route('/user/registration/capture/check', 
    array('_controller' => 'Authentication\\Controller\\UserController::checkRegistrationCapture')
));
$routes->add('patient_user_listing', new Routing\Route('/security/patient/user', 
    array('_controller' => 'Authentication\\Controller\\UserController::showPatientUsers')
));
$routes->add('patient_user_lock', new Routing\Route('/security/patient/user/lock/{userId}', 
        array('_controller' => 'Authentication\\Controller\\UserController::lockPatientUser'),
        array("userId" => "[A-Z0-9]+")
));
$routes->add('patient_user_unlock', new Routing\Route('/security/patient/user/unlock/{userId}', 
        array('_controller' => 'Authentication\\Controller\\UserController::unlockPatientUser'),
        array("userId" => "[A-Z0-9]+")
));
$routes->add('patient_user_delete', new Routing\Route('/security/patient/user/delete/{userId}', 
        array('_controller' => 'Authentication\\Controller\\UserController::deletePatientUser'),
        array("userId" => "[A-Z0-9]+")
));

//Physical Activity Actions
$routes->add('physical_activity_form', new Routing\Route('/physical/activity', 
    array('_controller' => 'Admin\\Controller\\PhysicalActivityController::form')
));
$routes->add('physical_activity_save', new Routing\Route('/physical/activity/save', 
    array('_controller' => 'Admin\\Controller\\PhysicalActivityController::save')
));
$routes->add('physical_activity_edit', new Routing\Route('/physical/activity/edit/{id}', 
    array('_controller' => 'Admin\\Controller\\PhysicalActivityController::edit'),
    array('id' => '[A-Z0-9]+')
));
$routes->add('physical_activity_delete', new Routing\Route('/physical/activity/delete/{id}', 
    array('_controller' => 'Admin\\Controller\\PhysicalActivityController::delete'),
    array('id' => '[A-Z0-9]+')
));

//Patient Physical Activity Actions
$routes->add('patient_physical_activity_form', new Routing\Route('/patient/physical/activity', 
    array('_controller' => 'SelfReport\\Controller\\PatientPhysicalActivityController::form')
));
$routes->add('patient_physical_activity_save', new Routing\Route('/patient/physical/activity/save', 
    array('_controller' => 'SelfReport\\Controller\\PatientPhysicalActivityController::save')
));
$routes->add('patient_physical_activity_edit', new Routing\Route('/patient/physical/activity/edit/{id}', 
    array('_controller' => 'SelfReport\\Controller\\PatientPhysicalActivityController::edit'),
    array('id' => '[A-Z0-9]+')
));
$routes->add('patient_physical_activity_delete', new Routing\Route('/patient/physical/activity/delete/{id}', 
    array('_controller' => 'SelfReport\\Controller\\PatientPhysicalActivityController::delete'),
    array('id' => '[A-Z0-9]+')
));

//Age Range Actions
$routes->add('age_range_form', new Routing\Route('/age/range/form', 
    array('_controller' => 'Utility\\Controller\\AgeRangeController::form')
));
$routes->add('age_range_save', new Routing\Route('/age/range/save', 
    array('_controller' => 'Utility\\Controller\\AgeRangeController::save')
));
$routes->add('age_range_edit', new Routing\Route('/age/range/edit/{id}', 
    array('_controller' => 'Utility\\Controller\\AgeRangeController::edit'),
    array('id' => '[A-Z0-9]+')
));
$routes->add('age_range_delete', new Routing\Route('/age/range/delete/{id}', 
    array('_controller' => 'Utility\\Controller\\AgeRangeController::delete'),
    array('id' => '[A-Z0-9]+')
));

//Vital Test Actions
$routes->add('vital_test_form', new Routing\Route('/vital/test/form', 
    array('_controller' => 'Clinical\\Controller\\VitalTestController::form')
));
$routes->add('vital_test_save', new Routing\Route('/vital/test/save', 
    array('_controller' => 'Clinical\\Controller\\VitalTestController::save')
));
$routes->add('vital_test_edit', new Routing\Route('/vital/test/edit/{id}', 
    array('_controller' => 'Clinical\\Controller\\VitalTestController::edit'),
    array('id' => '[A-Z0-9]+')
));
$routes->add('vital_test_delete', new Routing\Route('/vital/test/delete/{id}', 
    array('_controller' => 'Clinical\\Controller\\VitalTestController::delete'),
    array('id' => '[A-Z0-9]+')
));

//Patient Vital Test Actions
$routes->add('patient_vitals_form', new Routing\Route('/patient/vitals/form', 
    array('_controller' => 'Patient\\Controller\\PatientVitalTestRecordController::form')
));
$routes->add('patient_vitals_save', new Routing\Route('/patient/vitals/save', 
    array('_controller' => 'Patient\\Controller\\PatientVitalTestRecordController::save')
));
$routes->add('patient_vitals_edit', new Routing\Route('/patient/vitals/edit/{id}', 
    array('_controller' => 'Patient\\Controller\\PatientVitalTestRecordController::edit'),
    array('id' => '[A-Z0-9]+')
));
$routes->add('patient_vitals_delete', new Routing\Route('/patient/vitals/delete/{id}', 
    array('_controller' => 'Patient\\Controller\\PatientVitalTestRecordController::delete'),
    array('id' => '[A-Z0-9]+')
));

//Meal Type Actions
$routes->add('meal_type_form', new Routing\Route('/meal/type', 
    array('_controller' => 'Clinical\\Controller\\MealTypeController::form')
));
$routes->add('meal_type_save', new Routing\Route('/meal/type/save', 
    array('_controller' => 'Clinical\\Controller\\MealTypeController::save')
));
$routes->add('meal_type_edit', new Routing\Route('/meal/type/edit/{id}', 
    array('_controller' => 'Clinical\\Controller\\MealTypeController::edit'),
    array('id' => '[A-Z0-9]+')
));
$routes->add('meal_type_delete', new Routing\Route('/meal/type/delete/{id}', 
    array('_controller' => 'Clinical\\Controller\\MealTypeController::delete'),
    array('id' => '[A-Z0-9]+')
));

//Food Group Actions
$routes->add('food_group_form', new Routing\Route('/food/group', 
    array('_controller' => 'Clinical\\Controller\\FoodGroupController::form')
));
$routes->add('food_group_save', new Routing\Route('/food/group/save', 
    array('_controller' => 'Clinical\\Controller\\FoodGroupController::save')
));
$routes->add('food_group_edit', new Routing\Route('/food/group/edit/{id}', 
    array('_controller' => 'Clinical\\Controller\\FoodGroupController::edit'),
    array('id' => '[A-Z0-9]+')
));
$routes->add('food_group_delete', new Routing\Route('/food/group/delete/{id}', 
    array('_controller' => 'Clinical\\Controller\\FoodGroupController::delete'),
    array('id' => '[A-Z0-9]+')
));
$routes->add('food_group_upload_image', new Routing\Route('/food/group/image/upload', 
    array('_controller' => 'Clinical\\Controller\\FoodGroupController::uploadImage')
));
$routes->add('food_group_delete_image', new Routing\Route('/food/group/image/delete/{id}', 
    array('_controller' => 'Clinical\\Controller\\FoodGroupController::deleteImage'),
    array('id' => '[A-Z0-9]+')
));

//Patient Meal Record Actions
$routes->add('patient_meal_record_form', new Routing\Route('/patient/meal/record/form', 
    array('_controller' => 'Patient\\Controller\\PatientMealRecordController::form')
));
$routes->add('patient_meal_record_save', new Routing\Route('/patient/meal/record/save', 
    array('_controller' => 'Patient\\Controller\\PatientMealRecordController::save')
));
$routes->add('patient_meal_record_edit', new Routing\Route('/patient/meal/record/edit/{id}', 
    array('_controller' => 'Patient\\Controller\\PatientMealRecordController::edit'),
    array('id' => '[A-Z0-9]+')
));
$routes->add('patient_meal_record_delete', new Routing\Route('/patient/meal/record/delete/{id}', 
    array('_controller' => 'Patient\\Controller\\PatientMealRecordController::delete'),
    array('id' => '[A-Z0-9]+')
));

//Lab Test Actions
$routes->add('lab_test_form', new Routing\Route('/lab/test/form', 
    array('_controller' => 'Clinical\\Controller\\LabTestController::form')
));
$routes->add('lab_test_save', new Routing\Route('/lab/test/save', 
    array('_controller' => 'Clinical\\Controller\\LabTestController::save')
));
$routes->add('lab_test_edit', new Routing\Route('/lab/test/edit/{id}', 
    array('_controller' => 'Clinical\\Controller\\LabTestController::edit'),
    array('id' => '[A-Z0-9]+')
));
$routes->add('lab_test_delete', new Routing\Route('/lab/test/delete/{id}', 
    array('_controller' => 'Clinical\\Controller\\LabTestController::delete'),
    array('id' => '[A-Z0-9]+')
));

/*Patient Search Actions */
$routes->add('patient_search_form', new Routing\Route('/patient/search', 
    array('_controller' => 'Patient\\Controller\\SearchController::search')
));
$routes->add('patient_search', new Routing\Route('/patient/search/form', 
    array('_controller' => 'Patient\\Controller\\SearchController::setForm')
));

/* Patient Actions */
$routes->add('patient_main_summary', new Routing\Route('/patient/summary/{id}/{isEdit}', 
        array('_controller' => 'Patient\\Controller\\PatientController::summary', 'isEdit' => ''),
        array("id" => "[A-Z0-9]+", 'isEdit' => "0|1")
));
$routes->add('patient_registration_form', new Routing\Route('/patient/register/form', 
        array('_controller' => 'Patient\\Controller\\PatientController::showRegistrationForm')
));
$routes->add('patient_register', new Routing\Route('/patient/register', 
        array('_controller' => 'Patient\\Controller\\PatientController::register')
));
$routes->add('patient_edit', new Routing\Route('/patient/edit/{id}', 
        array('_controller' => 'Patient\\Controller\\PatientController::edit'),
        array("id" => "[A-Z0-9]+")
));
$routes->add('patient_photo_capture', new Routing\Route('/patient/capture/photo', 
    array('_controller' => 'Patient\\Controller\\PatientController::capturePhoto')
));
$routes->add('patient_photo_delete', new Routing\Route('/patient/delete/photo/{id}', 
    array('_controller' => 'Patient\\Controller\\PatientController::deletePhoto'),
    array("id" => "[A-Z0-9]+")
));

/* Patient Tab Actions */
$routes->add('patient_physical_activity_view', new Routing\Route('/patient/physical/activity/view/{patientId}', 
    array('_controller' => 'SelfReport\\Controller\\PatientPhysicalActivityController::viewPatientPhysicalActvities'),
    array('patientId' => '[A-Z0-9]+')
));
$routes->add('patient_meal_record_view', new Routing\Route('/patient/meal/record/view/{patientId}', 
    array('_controller' => 'Patient\\Controller\\PatientMealRecordController::viewPatientMealRecord'),
    array('patientId' => '[A-Z0-9]+')
));
$routes->add('patient_vitals_view', new Routing\Route('/patient/vitals/view/{patientId}', 
    array('_controller' => 'Patient\\Controller\\PatientVitalTestRecordController::viewPatientVitals'),
    array('patientId' => '[A-Z0-9]+')
));
$routes->add('patient_lab_results_view', new Routing\Route('/patient/lab/results/view/{patientId}', 
    array('_controller' => 'Patient\\Controller\\PatientLabTestRecordController::viewPatienLabResults'),
    array('patientId' => '[A-Z0-9]+')
));

/* Religion Actions */
$routes->add('religion_form', new Routing\Route('/religion', 
    array('_controller' => 'Admin\\Controller\\ReligionController::form'))
);
$routes->add('religion_edit', new Routing\Route('/religion/edit/{id}', 
    array('_controller' => 'Admin\\Controller\\ReligionController::edit'),
    array("id" => "[A-Z0-9]+"))
);
$routes->add('religion_save', new Routing\Route('/religion/save', 
    array('_controller' => 'Admin\\Controller\\ReligionController::save')
));
$routes->add('religion_delete', new Routing\Route('/religion/delete/{id}', 
    array('_controller' => 'Admin\\Controller\\ReligionController::delete'),
    array("id" => "[A-Z0-9]+"))
);

/* Ethnicity Actions */
$routes->add('ethnicity_form', new Routing\Route('/ethnicity', 
    array('_controller' => 'Admin\\Controller\\EthnicityController::form'))
);
$routes->add('ethnicity_edit', new Routing\Route('/ethnicity/edit/{id}', 
    array('_controller' => 'Admin\\Controller\\EthnicityController::edit'),
    array("id" => "[A-Z0-9]+"))
);
$routes->add('ethnicity_save', new Routing\Route('/ethnicity/save', 
    array('_controller' => 'Admin\\Controller\\EthnicityController::save')
));
$routes->add('ethnicity_delete', new Routing\Route('/ethnicity/delete/{id}', 
    array('_controller' => 'Admin\\Controller\\EthnicityController::delete'),
    array("id" => "[A-Z0-9]+"))
);

//Patient Lab Record Actions
$routes->add('patient_lab_record_form', new Routing\Route('/patient/lab/record/form', 
    array('_controller' => 'Patient\\Controller\\PatientLabTestRecordController::form')
));
$routes->add('patient_lab_record_save', new Routing\Route('/patient/lab/record/save', 
    array('_controller' => 'Patient\\Controller\\PatientLabTestRecordController::save')
));
$routes->add('patient_lab_record_edit', new Routing\Route('/patient/lab/record/edit/{id}', 
    array('_controller' => 'Patient\\Controller\\PatientLabTestRecordController::edit'),
    array('id' => '[A-Z0-9]+')
));
$routes->add('patient_lab_record_delete', new Routing\Route('/patient/lab/record/delete/{id}', 
    array('_controller' => 'Patient\\Controller\\PatientLabTestRecordController::delete'),
    array('id' => '[A-Z0-9]+')
));

$routes->add('send_patient_email', new Routing\Route('/send/patient/email', 
    array('_controller' => 'Utility\\Controller\\NotificationMessageController::ajaxSendPatientEmail')
));


#Patient Smoking Drinking Status Actions
$routes->add('patient_smoking_drinking_status_form', new Routing\Route('/patient/smoking/drinking/status/form', 
    array('_controller' => 'Patient\\Controller\\PatientSmokingDrinkingStatusController::form')
));
$routes->add('patient_smoking_drinking_status_save', new Routing\Route('/patient/smoking/drinking/status/save', 
    array('_controller' => 'Patient\\Controller\\PatientSmokingDrinkingStatusController::save')
));
$routes->add('patient_smoking_drinking_status_view', new Routing\Route('/patient/smoking/drinking/status/view/{id}', 
    array('_controller' => 'Patient\\Controller\\PatientSmokingDrinkingStatusController::view'),
    array('id' => '[A-Z0-9]+')
));
$routes->add('patient_smoking_drinking_status_edit', new Routing\Route('/patient/smoking/drinking/status/edit/{id}', 
    array('_controller' => 'Patient\\Controller\\PatientSmokingDrinkingStatusController::edit'),
    array('id' => '[A-Z0-9]+')
));
$routes->add('smoking_drinking_status_patient_view', new Routing\Route('/smoking/drinking/status/patient/view/{patientId}', 
    array('_controller' => 'Patient\\Controller\\PatientSmokingDrinkingStatusController::viewPatientSmokingDrinkingStatus'),
    array('patientId' => '[A-Z0-9]+')
));

//Visualization Actions
$routes->add('likert_heatmap_form', new Routing\Route('/viz/likert/heatmap/form', 
    array('_controller' => 'Survey\\Controller\\VisualizationController::vizLikertHeatmapForm')
));
$routes->add('likert_heatmap', new Routing\Route('/viz/likert/heatmap', 
    array('_controller' => 'Survey\\Controller\\VisualizationController::vizLikertHeatmap')
));
$routes->add('indicator_likert_heatmap_form', new Routing\Route('/viz/indicator/likert/heatmap/form', 
    array('_controller' => 'Survey\\Controller\\VisualizationController::vizIndicatorLikertHeatmapForm')
));
$routes->add('indicator_likert_heatmap', new Routing\Route('/viz/indicator/likert/heatmap', 
    array('_controller' => 'Survey\\Controller\\VisualizationController::vizIndicatorLikertHeatmap')
));
/*****************************/
return $routes;
