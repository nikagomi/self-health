<?php

$accessMap = array(
    /* from permission tables */
    /* Do not include trailing / in url path */
	
        "/symtrigger" => "MANAGE.SYNC.TRIGGERS",
        
        /* Manage countries */
        "/country" => "MANAGE.COUNTRIES",
        "/country/save" => "MANAGE.COUNTRIES",
        "/country/edit" => "MANAGE.COUNTRIES",
        "/country/delete" => "MANAGE.COUNTRIES",
    
        /* Manage Physical Activities */
        "/physical/activity" => "MANAGE.PHYSICAL.ACTIVITIES",
        "/physical/activity/save" => "MANAGE.PHYSICAL.ACTIVITIES",
        "/physical/activity/edit" => "MANAGE.PHYSICAL.ACTIVITIES",
        "/physical/activity/delete" => "MANAGE.PHYSICAL.ACTIVITIES",
    
        /* Manage Age Ranges*/
        "/age/range/form" => "MANAGE.AGE.RANGES",
        "/age/range/save" => "MANAGE.AGE.RANGES",
        "/age/range/edit" => "MANAGE.AGE.RANGES",
        "/age/range/delete" => "MANAGE.AGE.RANGES",
    
        /* Manage Vital Test*/
        "/vital/test/form" => "MANAGE.VITAL.TESTS",
        "/vital/test/save" => "MANAGE.VITAL.TESTS",
        "/vital/test/edit" => "MANAGE.VITAL.TESTS",
        "/vital/test/delete" => "MANAGE.VITAL.TESTS",
    
        /* Manage meal types */
        "/meal/type" => "MANAGE.MEAL.TYPES",
        "/meal/type/save" => "MANAGE.MEAL.TYPES",
        "/meal/type/edit" => "MANAGE.MEAL.TYPES",
        "/meal/type/delete" => "MANAGE.MEAL.TYPES",
    
        /* Manage food groups */
        "/food/group" => "MANAGE.FOOD.GROUPS",
        "/food/group/save" => "MANAGE.FOOD.GROUPS",
        "/food/group/edit" => "MANAGE.FOOD.GROUPS",
        "/food/group/delete" => "MANAGE.FOOD.GROUPS",
    
         /* Manage Lab Test*/
        "/lab/test/form" => "MANAGE.LAB.TESTS",
        "/lab/test/save" => "MANAGE.LAB.TESTS",
        "/lab/test/edit" => "MANAGE.LAB.TESTS",
        "/lab/test/delete" => "MANAGE.LAB.TESTS",
    
        "/religion" => "MANAGE.RELIGIONS",
        "/religion/edit" => "MANAGE.RELIGIONS",
        "/religion/save" => "MANAGE.RELIGIONS",
        "/religion/delete" => "MANAGE.RELIGIONS",
    
        /* Ethnicity */
        "/ethnicity" => "MANAGE.ETHNICITIES",
        "/ethnicity/edit" => "MANAGE.ETHNICITIES",
        "/ethnicity/save" => "MANAGE.ETHNICITIES",
        "/ethnicity/delete" => "MANAGE.ETHNICITIES",
    
        /* User Groups */
        "/security/group" => "MANAGE.USER.GROUPS",
        "/security/group/edit" => "MANAGE.USER.GROUPS",
        "/security/group/save" => "MANAGE.USER.GROUPS",
        "/security/group/delete" => "MANAGE.USER.GROUPS",
       
        /* Users */
        "/security/user" => "MANAGE.USERS",
        "/security/user/edit" => "MANAGE.USERS",
        "/security/user/save" => "MANAGE.USERS",
        "/security/user/delete" => "MANAGE.USERS",
    
        /* Reports */
        "/report/patient/distribution/detail/form" => "RPT.PATIENT.DISTRIBUTION.DETAILS",
        "/report/patient/distribution/details" => "RPT.PATIENT.DISTRIBUTION.DETAILS",
    
        "/report/patient/smoking/drinking/form" => "RPT.PATIENT.SMOKING.DRINKING.DETAILS",
        "/report/patient/smoking/drinking" => "RPT.PATIENT.SMOKING.DRINKING.DETAILS",
    
        "/report/patient/physical/activity/form" => "RPT.PATIENT.PHYSICAL.ACTIVITY.DETAILS",
        "/report/patient/physical/activity" => "RPT.PATIENT.PHYSICAL.ACTIVITY.DETAILS",
    
    
        /*Server admin functions / access */
        "/property/file/get" => "ADMIN.PROPERTY.FILE",
        "/ajax/property/file/update" => "ADMIN.PROPERTY.FILE",
        "/server/stats/get" => "ADMIN.SERVER.STATUS",
        "/server/opcache/status" => "ADMIN.OPCACHE.MANAGE",
    
        "/admin/logged/users" => "VIEW.LOGGED.IN.USERS",
        "/force/user/log/out" => "VIEW.LOGGED.IN.USERS",
    
        

    );
return $accessMap;
