<!doctype html><html><head profile="http://www.w3.org/2005/10/profile">    <link rel="icon"       type="image/png"       href="/images/page_icon.ico?v=2" /><meta charset="utf-8" /><meta name="viewport" content="width=device-width, initial-scale=1.0" /><noscript>  <style>html{literal}{display:none;}{/literal}</style>  <meta http-equiv="refresh" content="0.0;url=/nojs.html"></noscript>{include file="base/header.tpl"}<style type="text/css">    .ui-dialog{        font-size:12px;    }        {block name=styles}    {/block}</style><script type="text/javascript">        {* To prevent right clicking on the page *}      {literal} var timeout = 20;        var smallScreen = window.matchMedia("(max-width: 40.0625em)");                   /*var message = '';        function clickIE() {            if (document.all) {                (message);                return false;            }        }        function clickNS(e) {            if(document.layers || (document.getElementById&&!document.all)) {                if (e.which == 2 || e.which == 3) {                    (message);                    return false;                }            }        }        if (document.layers) {            document.captureEvents(Event.MOUSEDOWN);document.onmousedown = clickNS;        }else{            document.onmouseup = clickNS;document.oncontextmenu = clickIE;        }        document.oncontextmenu = new Function("return false");*/                function toggleLinkState (elem) {            if (elem.attr("aria-expanded") == true) {                //elem.attr("data-toggle", "collapsed");                elem.attr("aria-expanded", false);            } else {               // elem.attr("data-toggle", "dropdown");                elem.attr("aria-expanded", true);            }                    }    {/literal}            {block name=scripts}                    {/block}            {literal}          $(document).ready(function(){            /*For wysiwyg editor */            $.trumbowyg.svgPath = '/images/icons/icons.svg';                        if (sessionStorage.getItem("sidebarState")) {                $("#sidebar").html(sessionStorage.getItem("sidebarState"));            }                        /*To get success messages to fade away after a while*/            $(function () {                if ($("div.successMessage").length > 0) {                    var x = 2000;                    $("div.successMessage").each( function() {                        $(this).delay(x).fadeOut('slow');                        x = x + 1000;                    });                }                                 $("a.editRow").html("<i class='fas fa-edit' style='font-size:1.5rem;color:#008cba;'></i>");                $("a.del").html("<i class='fas fa-trash-alt' style='font-size:1.5rem;color:#DD0000;'></i>");                $("a.saveRow").html("<i class='fas fa-save' style='font-size:1.5rem;color:green;'></i>");                $("a.cancelRow").html("<i class='fas fa-undo' style='font-size:1.5rem;color:orangered;'></i>");                $("a.hintanchorRow").html("<i class='fas fa-question-circle' style='font-size:0.85rem;color:#AAAAAA;'></i>");                                            });                        $("a.pointers").click(function(e){               $(document).foundation('joyride', 'start');             });                        /* For idle timeout */            $.idleHands({                'heartRate': 30,                'heartbeatUrl': window.location.href,                /*'heartbeatCallback': function (data, textStatus, jqXHR) {},*/                'maxInactivitySeconds': timeout * 60,                 'inactivityLogoutUrl': '/logOut/timeOut',                'manualLogoutUrl': '/logOut',                'inactivityDialogDuration': 20,                'dialogMessage': '{/literal}{Messages::i18nParams("sessionExpiry.timeout.details", $smarty.session.timeout)}{literal}',                'dialogTimeRemainingLabel': '{/literal}{Messages::i18n("sessionExpiry.time.remaining")}{literal}',                'dialogTitle': '{/literal}{Messages::i18n("sessionExpiry.warning.header")}{literal}',                'activityEvents': 'click keypress scroll wheel mousewheel mousemove',                'applicationId': 'idle-hands',                'localStoragePrefix': 'idle-hands',                'documentTitle': 'Session Expiry Warning'            });            /******* END ********/            /* Menu section */            $(function() {                if (navigator.userAgent.match(/msie|trident/i)){//($.browser.msie && $.browser.version.substr(0,1) < 7){                    $('li').has('ul').mouseover(function(){                        $(this).children('ul').css('visibility','visible');                    }).mouseout(function(){                        $(this).children('ul').css('visibility','hidden');                    });                }                /* Mobile */                $('#menu-wrap').prepend('<div id="menu-trigger">{/literal}{$app_name}{literal}</div>');		                $("#menu-trigger").on("click", function(){                    $("#menu").slideToggle();                });                /* iPad */                var isiPad = navigator.userAgent.match(/iPad/i) != null;                if (isiPad){                    $('#menu ul').addClass('no-transition');                      }                   /****** END *******************************************************/                /* Delete confirm section - on forms */                $("input[type='checkbox']#confirmDelete").click(function(e){                    if($(this).prop("checked")){                        $(this).closest("div").find(".delete").attr("disabled",false);                    }else{                       $(this).closest("div").find(".delete").attr("disabled",true);                    }                });                /* Data tables */                           });            $.extend( $.fn.dataTable.defaults, {                "searching": true,                "ordering": true,                "language": {                    "info": "Showing results _START_ to _END_ of _TOTAL_",                    "infoEmpty": "0 results"                },                "info": true,                "paging": true,                "fixedHeader": true,                "iDisplayLength": 25,                "lengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]],                "dom": "<'row'<'small-12 medium-3 columns'l><'small-12 medium-3 columns'f><'small-12 medium-6 columns collapsed'>r>"+                        "t"+                        "<'row'<'small-12 medium-6 columns'i><'small-12 medium-6 columns'p>>",                columnDefs: [                    { orderable: false, "targets": -1 },                                    ],                responsive:{                     breakpoints: [                        { name: 'desktop',  width: Infinity },                        { name: 'tablet-l', width: 1024 },                        { name: 'tablet-p', width: 768 },                        { name: 'mobile-l', width: 480 },                        { name: 'mobile-p', width: 320 }                    ],                    details:{                                               renderer: function ( api, rowIdx ) {                            // Select hidden columns for the given row                            var data = api.cells( rowIdx, ':hidden' ).eq(0).map(function(cell) {                                var header = $(api.column( cell.column ).header());                                if (!header.hasClass("never")) {                                                                        var node = api.cell(cell).node();                                                                        var xtra = "";                                    if ($(node).find("span").length > 0 && $(node).find("span").hasClass("hotspot")) {                                        var wrapper = $("<div>");                                        wrapper.html(api.cell(cell).data());                                        xtra = "<br/><pre style='font-size:0.8rem;'>[" + wrapper.find("span").attr("title") + "]</pre>";                                    }                                    return '<tr>'+                                                '<td style="min-width:40%;width:auto;word-wrap:break-word;text-align:left;"><b>'+                                                    header.text()+':</b>'+                                                '</td> '+                                                '<td style="text-align:left;">'+                                                   $(node).html() + xtra +                                                '</td>'+                                            '</tr>';                                }                            }).toArray().join('');                                                        return data ? $('<table/>',{style:"width:98%;margin:0;border:2px solid #d0e8e8;box-shadow:3px 3px 4px #d0e8e8;",align:"center"}).append( data ) : false;                        }                    }                },                "language": {                    "lengthMenu": "{/literal}{Messages::i18nParams('datatables.length.menu', "_MENU_")}{literal}",                    "zeroRecords": "{/literal}{Messages::i18n('datatables.zero.records')}{literal}",                    "info": "{/literal}{Messages::i18nParams('datatables.info', "_PAGE_,_PAGES_")}{literal}",                    "infoEmpty": "{/literal}{Messages::i18n('datatables.zero.records')}{literal}",                    "infoFiltered": "{/literal}{Messages::i18nParams('datatables.info.filtered', "_MAX_")}{literal}",                    "search": "{/literal}{Messages::i18n('datatables.search')}{literal}",                    "emptyTable": "{/literal}{Messages::i18n('datatables.empty.table')}{literal}",                    "paginate": {                        "first":      "{/literal}{Messages::i18n('datatables.paginate.first')}{literal}",                        "last":       "{/literal}{Messages::i18n('datatables.paginate.last')}{literal}",                        "next":       "{/literal}{Messages::i18n('datatables.paginate.next')}{literal}",                        "previous":   "{/literal}{Messages::i18n('datatables.paginate.previous')}{literal}"                }   }                });                                                $("body").on('click', 'a',function(event) {                $('.qtip:visible').qtip('hide');            });                        function newpage() {                window.location = newLocation;            }                        var dTable = $("#listTable, .listTable").DataTable({                {/literal}                    {block name=dataTable}                    {/block}                {literal}            });            /************************************************            Toggle Sidebar            *************************************************/                        //For desktop screens            $('body').on("click","#toggleSidebar", function () {                $('#sidebar').toggleClass('active');                if (smallScreen.matches && $('#sidebar').hasClass('active')) {                    $('.overlayM').addClass("active");                }            });                        $('#dismiss').on('click', function () {                // hide sidebar                $('#sidebar').removeClass('active');                // hide overlay                $('.overlayM').removeClass('active');            });                        //To show a toast if there is one            $('.toast').toast('show');                        //To get ride of toastdiv after it has been hidden            $('.toast').on('hidden.bs.toast', function () {                $(this).remove();            });                        /******************************************             Save the state of the side bar            *******************************************/            $('#sidebar a:not(".dropdown-toggle")').click(function (event) {               $('#sidebar a:not(".dropdown-toggle")').removeClass("blab");               $(this).addClass("blab");               sessionStorage.setItem("sidebarState", $("#sidebar")[0].innerHTML);            });                        $("a.logOut").click(function(e){                sessionStorage.clear();                window.location.href="/logOut";            });    {/literal}    {*Helloinclude file="utility/notify/notification.tpl"*}        {block name=jquery}        {/block}    {literal}         });   /* End of $(document).ready() function */    {/literal}</script><title>    {block name=title}        Health Self Reporting Tool - {nocache}{$smarty.session.userName}{/nocache}    {/block}</title></head><body>        <!-- Dark Overlay element -->    <div class="overlayM"></div>    <div id="wrapper">        {nocache}            <!-- Sidebar Content goes here -->            <nav id="sidebar" >                <div id="dismiss" class="show-for-small-down show-for-portrait">                    <i class="fas fa-arrow-left"></i>                </div>                <div class="logoContainer" >                    {*<img src="/images/oecs_logo_image.png" height="96px" width="96px" style="margin-bottom:10px;"/>*}                    <br/>                    <span class="orgName">Your Organization's Full Name</span>                    <br/>                    {*<img src="/images/flag_banner.png"/>*}                    <br/>                    <span class="tagLine">Organization Tag Line</span>                    <br/><br/>                                                                                                                                                              </div>                <ul class="list-unstyled components">                    <li class="">                        <a href="/user/home"><i class="fas fa-home" style="color:inherit;"></i>&ensp;Home</a>                    </li>                    <li>                        <a href="/security/user/preferences"><i class="fas fa-user" style="color:inherit;"></i>&ensp;Preferences</a>                    </li>                    {if $smarty.session.isPatient || PermissionManager::userHasPermission("SEARCH.PATIENTS", $smarty.session.userId)}                        <li>                            <a href="#patientSubmenu" onclick="toggleLinkState($(this));" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">                                <i class="fas fa-hospital-user" style="color:inherit;"></i>&ensp;Patient                            </a>                            <ul class="collapse list-unstyled" id="patientSubmenu">                                {if PermissionManager::userHasPermission("SEARCH.PATIENTS", $smarty.session.userId)}                                    <li>                                        <a href="/patient/search/form">Patient Search</a>                                    </li>                                {/if}                                {if $smarty.session.isPatient}                                    <li>                                        <a href="/patient/summary/{$smarty.session.patientId}">Patient Profile</a>                                    </li>                                {/if}                            </ul>                        </li>                    {/if}                    {if $smarty.session.isPatient}                        <li>                            <a href="#healthSubmenu" onclick="toggleLinkState($(this));" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">                                <i class="fas fa-heartbeat" style="color:inherit;"></i>&ensp;Self Health Records                            </a>                            <ul class="collapse list-unstyled" id="healthSubmenu">                                <li>                                    <a href="/patient/smoking/drinking/status/form">Smoking/Drinking Status</a>                                </li>                                <li>                                    <a href="/patient/physical/activity">Physical Activity</a>                                </li>                                <li>                                    <a href="/patient/meal/record/form">Meals</a>                                </li>                                <li>                                    <a href="/patient/vitals/form">Vitals</a>                                </li>                                <li>                                    <a href="/patient/lab/record/form">Lab Results</a>                                </li>                            </ul>                        </li>                    {/if}                    {if PermissionManager::userHasPermissionInList("MANAGE.USER.GROUPS,MANAGE.USERS", $smarty.session.userId)}                        <li>                            <a href="#secureSubmenu" onclick="toggleLinkState($(this));" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">                                <i class="fas fa-user-shield" style="color:inherit;"></i>&ensp;Security                            </a>                            <ul class="collapse list-unstyled" id="secureSubmenu">                                {if PermissionManager::userHasPermission("MANAGE.USER.GROUPS", $smarty.session.userId)}                                    <li>                                        <a href="/security/group">Manage User Groups</a>                                    </li>                                {/if}                                {if PermissionManager::userHasPermission("MANAGE.USERS", $smarty.session.userId)}                                    <li>                                        <a href="/security/user">Manage Users</a>                                    </li>                                {/if}                            </ul>                        </li>                    {/if}                    {if PermissionManager::userHasPermissionInList("MANAGE.FOOD.GROUPS,MANAGE.MEAL.TYPES,MANAGE.LAB.TESTS,MANAGE.VITAL.TESTS,MANAGE.COUNTRIES,MANAGE.PHYSICAL.ACTIVITIES,MANAGE.AGE.RANGES", $smarty.session.userId)}                        <li>                            <a href="#adminSubmenu" onclick="toggleLinkState($(this));" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">                                <i class="fas fa-tools" style="color:inherit;"></i>&ensp;Configuration                            </a>                            <ul class="collapse list-unstyled" id="adminSubmenu">                                {if PermissionManager::userHasPermission("MANAGE.COUNTRIES", $smarty.session.userId)}                                    <li>                                        <a href="/country">{Messages::i18n("menu.manage.country")}</a>                                    </li>                                {/if}                                {if PermissionManager::userHasPermission("MANAGE.PHYSICAL.ACTIVITIES", $smarty.session.userId)}                                    <li>                                        <a href="/physical/activity">{Messages::i18n("menu.manage.physical.activity")}</a>                                    </li>                                {/if}                                {if PermissionManager::userHasPermission("MANAGE.AGE.RANGES", $smarty.session.userId)}                                    <li>                                        <a href="/age/range/form">Age Ranges</a>                                    </li>                                {/if}                                {if PermissionManager::userHasPermission("MANAGE.VITAL.TESTS", $smarty.session.userId)}                                    <li>                                        <a href="/vital/test/form">Vital Tests</a>                                    </li>                                {/if}                                {if PermissionManager::userHasPermission("MANAGE.LAB.TESTS", $smarty.session.userId)}                                    <li>                                        <a href="/lab/test/form">Lab Tests</a>                                    </li>                                {/if}                                {if PermissionManager::userHasPermission("MANAGE.MEAL.TYPES", $smarty.session.userId)}                                    <li>                                        <a href="/meal/type">Meal Types</a>                                    </li>                                {/if}                                {if PermissionManager::userHasPermission("MANAGE.FOOD.GROUPS", $smarty.session.userId)}                                    <li>                                        <a href="/food/group">Food Groups</a>                                    </li>                                {/if}                                {if PermissionManager::userHasPermission("MANAGE.RELIGIONS", $smarty.session.userId)}                                    <li>                                        <a href="/ethnicity">Ethnicities</a>                                    </li>                                {/if}                                {if PermissionManager::userHasPermission("MANAGE.ETHNICITIES", $smarty.session.userId)}                                    <li>                                        <a href="/religion">Religions</a>                                    </li>                                {/if}                                                            </ul>                        </li>                    {/if}                   {* <li>                        <a href="#dashboardSubmenu" onclick="toggleLinkState($(this));" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">                            <i class="fas fa-chart-bar" style="color:inherit;"></i>&ensp;Dashboards                        </a>                        <ul class="collapse list-unstyled" id="dashboardSubmenu">                            <li>                                <a href="/viz/likert/heatmap/form">Question Heatmap (Likert)</a>                            </li>                            <li>                                <a href="/viz/indicator/likert/heatmap/form">Indicator Heatmap (Likert)</a>                            </li>                            <li>                                <a href="#">Line Graphs</a>                            </li>                        </ul>                    </li>*}                    <li>                        <a href="#"><i class="fas fa-info-circle" style="color:inherit;"></i>&ensp;About</a>                    </li>                    <li>                        <a href="#" class='logOut'><i class="fas fa-sign-out-alt" style="color:inherit;"></i>&ensp;Log Out</a>                    </li>                </ul>            </nav>            <!-- Page content goes here -->            <div id="main-content">                <div id="header-bar">                    <span style="padding-top:8px;"><i id="toggleSidebar" title="Click to toggle visibility of sidebar" class="fas fa-bars" style="cursor:pointer;color:#ffc42c;font-family:'Poppins',sans-serif;font-size:2.2rem;"></i></span>                    {*<span style="padding-top:8px;" class="show-for-portrait"><i id="toggleSidebarM" title="Click to toggle visibility of sidebar" class="fas fa-bars" style="cursor:pointer;color:#ffc42c;font-family:'Poppins',sans-serif;font-size:2.2rem;"></i></span>*}                    <!--<img id="toggleSidebar" src="/images/hamburger.png" height="36px" width="36px" title="Click to toggle visibility of sidebar"/>-->                    <span class="show-for-small-down orgName">                        Acronym - Survey Tool                    </span>                    <span class="show-for-medium-up orgName">                        Your Organization's Full Name - Health Self Reporting Tool                    </span>                </div>                <div id="header2" style="font-family:'Poppins', sans-serif;font-size:0.85rem;color:#777777;">                    <i class="fas {if $smarty.session.isPatient}fa-hospital-user{else}fa-user{/if}" style="font-size:1.0rem;"></i>                    <a style="font-family:'Poppins', sans-serif;color:#008cba;font-size:0.9rem;" href='/security/user/preferences' id='userSecurity'>{$smarty.session.userName}</a>                    &nbsp;&bull;&nbsp;                    <a style="font-family:'Poppins', sans-serif;color:#008cba;font-size:0.9rem;" href='/logOut' class='logOut'>Log Out</a>                    &ensp;                </div>                <div id="content-bar">                    {block name=content}                    {/block}                </div>            </div>        {/nocache}    </div>        {*include file="base/footer.tpl"*}             <!-- Other JS plugins can be included here -->    {literal}        <script type="text/javascript" src="/js/foundation.js"></script>        <script type="text/javascript" src="/js/datatables.min.js"></script>         <script type="text/javascript" src="/js/absolute.js"></script>        <!--<script type="text/javascript" src="/js/dataTables.fixedHeader.min.js"></script>-->         <script type="text/javascript" src="/js/foundation.abide.js"></script>        <script type="text/javascript" src="/js/foundation.equalizer.js"></script>        <script type="text/javascript" src="/js/foundation.accordion.js"></script>         <script type="text/javascript" src="/js/foundation.joyride.js"></script>                <script type='text/javascript'>            {/literal}                {block name="auxScripts"}                {/block}            {literal}            $(document).foundation({                {/literal}                       {block name="foundation"}                    {/block}                {literal}            });            {/literal}        </script></body></html>