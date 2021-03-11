<?php
/* Smarty version 3.1.34-dev-7, created on 2021-03-11 17:23:47
  from '/var/www/oecs/src/smarty/templates/base/body.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_604a5223cd5909_49667788',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a376c27b85b69c858851286c60ead8e149c29457' => 
    array (
      0 => '/var/www/oecs/src/smarty/templates/base/body.tpl',
      1 => 1615483425,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:base/header.tpl' => 1,
  ),
),false)) {
function content_604a5223cd5909_49667788 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>
<!doctype html>
<html>
<head profile="http://www.w3.org/2005/10/profile">
    <link rel="icon" 
      type="image/png" 
      href="/images/page_icon.ico?v=2" />
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<noscript>
  <style>html{display:none;}</style>
  <meta http-equiv="refresh" content="0.0;url=/nojs.html">
</noscript>


<?php $_smarty_tpl->_subTemplateRender("file:base/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<style type="text/css">
    .ui-dialog{
        font-size:12px;
    }
    
    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_733616332604a5223c9fb50_23929832', 'styles');
?>

</style>

<?php echo '<script'; ?>
 type="text/javascript">
    
      
     var timeout = 20;
        var smallScreen = window.matchMedia("(max-width: 40.0625em)");
           
        /*var message = '';
        function clickIE() {
            if (document.all) {
                (message);
                return false;
            }
        }

        function clickNS(e) {
            if(document.layers || (document.getElementById&&!document.all)) {
                if (e.which == 2 || e.which == 3) {
                    (message);
                    return false;
                }
            }
        }

        if (document.layers) {
            document.captureEvents(Event.MOUSEDOWN);document.onmousedown = clickNS;
        }else{
            document.onmouseup = clickNS;document.oncontextmenu = clickIE;
        }
        document.oncontextmenu = new Function("return false");*/
        
        function toggleLinkState (elem) {
            if (elem.attr("aria-expanded") == true) {
                //elem.attr("data-toggle", "collapsed");
                elem.attr("aria-expanded", false);
            } else {
               // elem.attr("data-toggle", "dropdown");
                elem.attr("aria-expanded", true);
            }
            
        }
    
        
    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1966248371604a5223ca1667_45563401', 'scripts');
?>

        
      
        $(document).ready(function(){
            /*For wysiwyg editor */
            $.trumbowyg.svgPath = '/images/icons/icons.svg';
            
            if (sessionStorage.getItem("sidebarState")) {
                $("#sidebar").html(sessionStorage.getItem("sidebarState"));
            }
            
            /*To get success messages to fade away after a while*/
            $(function () {
                if ($("div.successMessage").length > 0) {
                    var x = 2000;
                    $("div.successMessage").each( function() {
                        $(this).delay(x).fadeOut('slow');
                        x = x + 1000;
                    });
                } 
                
                $("a.editRow").html("<i class='fas fa-edit' style='font-size:1.5rem;color:#008cba;'></i>");
                $("a.del").html("<i class='fas fa-trash-alt' style='font-size:1.5rem;color:#DD0000;'></i>");
                $("a.saveRow").html("<i class='fas fa-save' style='font-size:1.5rem;color:green;'></i>");
                $("a.cancelRow").html("<i class='fas fa-undo' style='font-size:1.5rem;color:orangered;'></i>");
                $("a.hintanchorRow").html("<i class='fas fa-question-circle' style='font-size:0.85rem;color:#AAAAAA;'></i>");
                
                
            });
            
            $("a.pointers").click(function(e){
               $(document).foundation('joyride', 'start'); 
            });
            
            /* For idle timeout */
            $.idleHands({
                'heartRate': 30,
                'heartbeatUrl': window.location.href,
                /*'heartbeatCallback': function (data, textStatus, jqXHR) {},*/
                'maxInactivitySeconds': timeout * 60, 
                'inactivityLogoutUrl': '/logOut/timeOut',
                'manualLogoutUrl': '/logOut',
                'inactivityDialogDuration': 20,
                'dialogMessage': '<?php echo \Neptune\MessageResources::i18nParams("sessionExpiry.timeout.details",$_SESSION['timeout']);?>
',
                'dialogTimeRemainingLabel': '<?php echo \Neptune\MessageResources::i18n("sessionExpiry.time.remaining");?>
',
                'dialogTitle': '<?php echo \Neptune\MessageResources::i18n("sessionExpiry.warning.header");?>
',
                'activityEvents': 'click keypress scroll wheel mousewheel mousemove',
                'applicationId': 'idle-hands',
                'localStoragePrefix': 'idle-hands',
                'documentTitle': 'Session Expiry Warning'
            });
            /******* END ********/
            /* Menu section */
            $(function() {
                if (navigator.userAgent.match(/msie|trident/i)){//($.browser.msie && $.browser.version.substr(0,1) < 7){
                    $('li').has('ul').mouseover(function(){
                        $(this).children('ul').css('visibility','visible');
                    }).mouseout(function(){
                        $(this).children('ul').css('visibility','hidden');
                    });
                }
                /* Mobile */
                $('#menu-wrap').prepend('<div id="menu-trigger"><?php echo $_smarty_tpl->tpl_vars['app_name']->value;?>
</div>');		
                $("#menu-trigger").on("click", function(){
                    $("#menu").slideToggle();
                });
                /* iPad */
                var isiPad = navigator.userAgent.match(/iPad/i) != null;
                if (isiPad){
                    $('#menu ul').addClass('no-transition');      
                }   
                /****** END *******************************************************/

                /* Delete confirm section - on forms */
                $("input[type='checkbox']#confirmDelete").click(function(e){
                    if($(this).prop("checked")){
                        $(this).closest("div").find(".delete").attr("disabled",false);
                    }else{
                       $(this).closest("div").find(".delete").attr("disabled",true);
                    }
                });

                /* Data tables */
               
            });
            $.extend( $.fn.dataTable.defaults, {
                "searching": true,
                "ordering": true,
                "language": {
                    "info": "Showing results _START_ to _END_ of _TOTAL_",
                    "infoEmpty": "0 results"
                },
                "info": true,
                "paging": true,
                "fixedHeader": true,
                "iDisplayLength": 25,
                "lengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]],
                "dom": "<'row'<'small-12 medium-3 columns'l><'small-12 medium-3 columns'f><'small-12 medium-6 columns collapsed'>r>"+
                        "t"+
                        "<'row'<'small-12 medium-6 columns'i><'small-12 medium-6 columns'p>>",
                columnDefs: [
                    { orderable: false, "targets": -1 },
                    
                ],
                responsive:{
                     breakpoints: [
                        { name: 'desktop',  width: Infinity },
                        { name: 'tablet-l', width: 1024 },
                        { name: 'tablet-p', width: 768 },
                        { name: 'mobile-l', width: 480 },
                        { name: 'mobile-p', width: 320 }
                    ],
                    details:{
                       
                        renderer: function ( api, rowIdx ) {
                            // Select hidden columns for the given row
                            var data = api.cells( rowIdx, ':hidden' ).eq(0).map(function(cell) {
                                var header = $(api.column( cell.column ).header());
                                if (!header.hasClass("never")) {
                                    
                                    var node = api.cell(cell).node();
                                    
                                    var xtra = "";
                                    if ($(node).find("span").length > 0 && $(node).find("span").hasClass("hotspot")) {
                                        var wrapper = $("<div>");
                                        wrapper.html(api.cell(cell).data());
                                        xtra = "<br/><pre style='font-size:0.8rem;'>[" + wrapper.find("span").attr("title") + "]</pre>";
                                    }

                                    return '<tr>'+
                                                '<td style="min-width:40%;width:auto;word-wrap:break-word;text-align:left;"><b>'+
                                                    header.text()+':</b>'+
                                                '</td> '+
                                                '<td style="text-align:left;">'+
                                                   $(node).html() + xtra +
                                                '</td>'+
                                            '</tr>';
                                }
                            }).toArray().join('');
                            
                            return data ? $('<table/>',{style:"width:98%;margin:0;border:2px solid #d0e8e8;box-shadow:3px 3px 4px #d0e8e8;",align:"center"}).append( data ) : false;
                        }
                    }
                },
                "language": {
                    "lengthMenu": "<?php echo \Neptune\MessageResources::i18nParams('datatables.length.menu',"_MENU_");?>
",
                    "zeroRecords": "<?php echo \Neptune\MessageResources::i18n('datatables.zero.records');?>
",
                    "info": "<?php echo \Neptune\MessageResources::i18nParams('datatables.info',"_PAGE_,_PAGES_");?>
",
                    "infoEmpty": "<?php echo \Neptune\MessageResources::i18n('datatables.zero.records');?>
",
                    "infoFiltered": "<?php echo \Neptune\MessageResources::i18nParams('datatables.info.filtered',"_MAX_");?>
",
                    "search": "<?php echo \Neptune\MessageResources::i18n('datatables.search');?>
",
                    "emptyTable": "<?php echo \Neptune\MessageResources::i18n('datatables.empty.table');?>
",
                    "paginate": {
                        "first":      "<?php echo \Neptune\MessageResources::i18n('datatables.paginate.first');?>
",
                        "last":       "<?php echo \Neptune\MessageResources::i18n('datatables.paginate.last');?>
",
                        "next":       "<?php echo \Neptune\MessageResources::i18n('datatables.paginate.next');?>
",
                        "previous":   "<?php echo \Neptune\MessageResources::i18n('datatables.paginate.previous');?>
"
                }   }
    
            });
            
            
            
            $("body").on('click', 'a',function(event) {
                $('.qtip:visible').qtip('hide');
            });
            
            function newpage() {
                window.location = newLocation;
            }
            
            var dTable = $("#listTable, .listTable").DataTable({
                
                    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_626325195604a5223cb1f13_15246109', 'dataTable');
?>

                
            });
            /************************************************
            Toggle Sidebar
            *************************************************/
            
            //For desktop screens
            $('body').on("click","#toggleSidebar", function () {
                $('#sidebar').toggleClass('active');
                if (smallScreen.matches && $('#sidebar').hasClass('active')) {
                    $('.overlayM').addClass("active");
                }
            });
            
            $('#dismiss').on('click', function () {
                // hide sidebar
                $('#sidebar').removeClass('active');
                // hide overlay
                $('.overlayM').removeClass('active');
            });
            
            //To show a toast if there is one
            $('.toast').toast('show');
            
            //To get ride of toastdiv after it has been hidden
            $('.toast').on('hidden.bs.toast', function () {
                $(this).remove();
            });
            
            /******************************************
             Save the state of the side bar
            *******************************************/
            $('#sidebar a:not(".dropdown-toggle")').click(function (event) {
               $('#sidebar a:not(".dropdown-toggle")').removeClass("blab");
               $(this).addClass("blab");
               sessionStorage.setItem("sidebarState", $("#sidebar")[0].innerHTML);
            });
            
            $("a.logOut").click(function(e){
                sessionStorage.clear();
                window.location.href="/logOut";
            });

    

            <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_526742070604a5223cb2e15_27746008', 'jquery');
?>

     
        });   /* End of $(document).ready() function */
    
<?php echo '</script'; ?>
>


<title>
    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1367684283604a5223cb3b51_75089500', 'title');
?>

</title>

</head>

<body>
        <!-- Dark Overlay element -->
    <div class="overlayM"></div>
    <div id="wrapper">
        
            <!-- Sidebar Content goes here -->
            <nav id="sidebar" >
                <div id="dismiss" class="show-for-small-down show-for-portrait">
                    <i class="fas fa-arrow-left"></i>
                </div>
                <div class="logoContainer" >
                                        <br/>
                    <span class="orgName">Your Organization's Full Name</span>
                    <br/>
                                        <br/>
                    <span class="tagLine">Organization Tag Line</span>
                    <br/><br/>                                                                                                                                              
                </div>
                <ul class="list-unstyled components">
                    <li class="">
                        <a href="/user/home"><i class="fas fa-home" style="color:inherit;"></i>&ensp;Home</a>
                    </li>
                    <li>
                        <a href="/security/user/preferences"><i class="fas fa-user" style="color:inherit;"></i>&ensp;Preferences</a>
                    </li>
                    <?php if ($_SESSION['isPatient'] || \Authentication\Model\PermissionManager::userHasPermission("SEARCH.PATIENTS",$_SESSION['userId'])) {?>
                        <li>
                            <a href="#patientSubmenu" onclick="toggleLinkState($(this));" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                <i class="fas fa-hospital-user" style="color:inherit;"></i>&ensp;Patient
                            </a>
                            <ul class="collapse list-unstyled" id="patientSubmenu">
                                <?php if (\Authentication\Model\PermissionManager::userHasPermission("SEARCH.PATIENTS",$_SESSION['userId'])) {?>
                                    <li>
                                        <a href="/patient/search/form">Patient Search</a>
                                    </li>
                                <?php }?>
                                <?php if ($_SESSION['isPatient']) {?>
                                    <li>
                                        <a href="/patient/summary/<?php echo $_SESSION['patientId'];?>
">Patient Profile</a>
                                    </li>
                                <?php }?>
                            </ul>
                        </li>
                    <?php }?>
                    <?php if ($_SESSION['isPatient']) {?>
                        <li>
                            <a href="#healthSubmenu" onclick="toggleLinkState($(this));" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                <i class="fas fa-heartbeat" style="color:inherit;"></i>&ensp;Self Health Records
                            </a>
                            <ul class="collapse list-unstyled" id="healthSubmenu">
                                <li>
                                    <a href="/patient/smoking/drinking/status/form">Smoking/Drinking Status</a>
                                </li>
                                <li>
                                    <a href="/patient/physical/activity">Physical Activity</a>
                                </li>
                                <li>
                                    <a href="/patient/meal/record/form">Meals</a>
                                </li>
                                <li>
                                    <a href="/patient/vitals/form">Vitals</a>
                                </li>
                                <li>
                                    <a href="/patient/lab/record/form">Lab Results</a>
                                </li>
                            </ul>
                        </li>
                    <?php }?>
                    <?php if (\Authentication\Model\PermissionManager::userHasPermissionInList("MANAGE.USER.GROUPS,MANAGE.USERS",$_SESSION['userId'])) {?>
                        <li>
                            <a href="#secureSubmenu" onclick="toggleLinkState($(this));" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                <i class="fas fa-user-shield" style="color:inherit;"></i>&ensp;Security
                            </a>
                            <ul class="collapse list-unstyled" id="secureSubmenu">
                                <?php if (\Authentication\Model\PermissionManager::userHasPermission("MANAGE.USER.GROUPS",$_SESSION['userId'])) {?>
                                    <li>
                                        <a href="/security/group">Manage User Groups</a>
                                    </li>
                                <?php }?>
                                <?php if (\Authentication\Model\PermissionManager::userHasPermission("MANAGE.USERS",$_SESSION['userId'])) {?>
                                    <li>
                                        <a href="/security/user">Manage Users</a>
                                    </li>
                                <?php }?>
                            </ul>
                        </li>
                    <?php }?>
                    <?php if (\Authentication\Model\PermissionManager::userHasPermissionInList("MANAGE.FOOD.GROUPS,MANAGE.MEAL.TYPES,MANAGE.LAB.TESTS,MANAGE.VITAL.TESTS,MANAGE.COUNTRIES,MANAGE.PHYSICAL.ACTIVITIES,MANAGE.AGE.RANGES",$_SESSION['userId'])) {?>
                        <li>
                            <a href="#adminSubmenu" onclick="toggleLinkState($(this));" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                <i class="fas fa-tools" style="color:inherit;"></i>&ensp;Configuration
                            </a>
                            <ul class="collapse list-unstyled" id="adminSubmenu">
                                <?php if (\Authentication\Model\PermissionManager::userHasPermission("MANAGE.COUNTRIES",$_SESSION['userId'])) {?>
                                    <li>
                                        <a href="/country"><?php echo \Neptune\MessageResources::i18n("menu.manage.country");?>
</a>
                                    </li>
                                <?php }?>
                                <?php if (\Authentication\Model\PermissionManager::userHasPermission("MANAGE.PHYSICAL.ACTIVITIES",$_SESSION['userId'])) {?>
                                    <li>
                                        <a href="/physical/activity"><?php echo \Neptune\MessageResources::i18n("menu.manage.physical.activity");?>
</a>
                                    </li>
                                <?php }?>
                                <?php if (\Authentication\Model\PermissionManager::userHasPermission("MANAGE.AGE.RANGES",$_SESSION['userId'])) {?>
                                    <li>
                                        <a href="/age/range/form">Age Ranges</a>
                                    </li>
                                <?php }?>
                                <?php if (\Authentication\Model\PermissionManager::userHasPermission("MANAGE.VITAL.TESTS",$_SESSION['userId'])) {?>
                                    <li>
                                        <a href="/vital/test/form">Vital Tests</a>
                                    </li>
                                <?php }?>
                                <?php if (\Authentication\Model\PermissionManager::userHasPermission("MANAGE.LAB.TESTS",$_SESSION['userId'])) {?>
                                    <li>
                                        <a href="/lab/test/form">Lab Tests</a>
                                    </li>
                                <?php }?>
                                <?php if (\Authentication\Model\PermissionManager::userHasPermission("MANAGE.MEAL.TYPES",$_SESSION['userId'])) {?>
                                    <li>
                                        <a href="/meal/type">Meal Types</a>
                                    </li>
                                <?php }?>
                                <?php if (\Authentication\Model\PermissionManager::userHasPermission("MANAGE.FOOD.GROUPS",$_SESSION['userId'])) {?>
                                    <li>
                                        <a href="/food/group">Food Groups</a>
                                    </li>
                                <?php }?>
                                <?php if (\Authentication\Model\PermissionManager::userHasPermission("MANAGE.RELIGIONS",$_SESSION['userId'])) {?>
                                    <li>
                                        <a href="/ethnicity">Ethnicities</a>
                                    </li>
                                <?php }?>
                                <?php if (\Authentication\Model\PermissionManager::userHasPermission("MANAGE.ETHNICITIES",$_SESSION['userId'])) {?>
                                    <li>
                                        <a href="/religion">Religions</a>
                                    </li>
                                <?php }?>
                                
                            </ul>
                        </li>
                    <?php }?>
                                       <li>
                        <a href="#"><i class="fas fa-info-circle" style="color:inherit;"></i>&ensp;About</a>
                    </li>
                    <li>
                        <a href="#" class='logOut'><i class="fas fa-sign-out-alt" style="color:inherit;"></i>&ensp;Log Out</a>
                    </li>
                </ul>
            </nav>

            <!-- Page content goes here -->
            <div id="main-content">
                <div id="header-bar">
                    <span style="padding-top:8px;"><i id="toggleSidebar" title="Click to toggle visibility of sidebar" class="fas fa-bars" style="cursor:pointer;color:#ffc42c;font-family:'Poppins',sans-serif;font-size:2.2rem;"></i></span>
                                        <!--<img id="toggleSidebar" src="/images/hamburger.png" height="36px" width="36px" title="Click to toggle visibility of sidebar"/>-->
                    <span class="show-for-small-down orgName">
                        Acronym - Survey Tool
                    </span>
                    <span class="show-for-medium-up orgName">
                        Your Organization's Full Name - Health Self Reporting Tool
                    </span>
                </div>
                <div id="header2" style="font-family:'Poppins', sans-serif;font-size:0.85rem;color:#777777;">
                    <i class="fas <?php if ($_SESSION['isPatient']) {?>fa-hospital-user<?php } else { ?>fa-user<?php }?>" style="font-size:1.0rem;"></i>
                    <a style="font-family:'Poppins', sans-serif;color:#008cba;font-size:0.9rem;" href='/security/user/preferences' id='userSecurity'><?php echo $_SESSION['userName'];?>
</a>
                    &nbsp;&bull;&nbsp;
                    <a style="font-family:'Poppins', sans-serif;color:#008cba;font-size:0.9rem;" href='/logOut' class='logOut'>Log Out</a>
                    &ensp;
                </div>
                <div id="content-bar">
                    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1510748284604a5223ccee71_85023301', 'content');
?>

                </div>
            </div>
        
    </div>
    
         
    
    <!-- Other JS plugins can be included here -->
    
        <?php echo '<script'; ?>
 type="text/javascript" src="/js/foundation.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 type="text/javascript" src="/js/datatables.min.js"><?php echo '</script'; ?>
> 
        <?php echo '<script'; ?>
 type="text/javascript" src="/js/absolute.js"><?php echo '</script'; ?>
>
        <!--<?php echo '<script'; ?>
 type="text/javascript" src="/js/dataTables.fixedHeader.min.js"><?php echo '</script'; ?>
>--> 
        <?php echo '<script'; ?>
 type="text/javascript" src="/js/foundation.abide.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 type="text/javascript" src="/js/foundation.equalizer.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 type="text/javascript" src="/js/foundation.accordion.js"><?php echo '</script'; ?>
> 
        <?php echo '<script'; ?>
 type="text/javascript" src="/js/foundation.joyride.js"><?php echo '</script'; ?>
>
        
        <?php echo '<script'; ?>
 type='text/javascript'>
            
                <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_909426179604a5223cd20a2_53804902', "auxScripts");
?>

            
            $(document).foundation({
                   
                    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_2040389336604a5223cd3dd2_74191180', "foundation");
?>

                
            });
            

        <?php echo '</script'; ?>
>

</body>
</html>
<?php }
/* {block 'styles'} */
class Block_733616332604a5223c9fb50_23929832 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'styles' => 
  array (
    0 => 'Block_733616332604a5223c9fb50_23929832',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


    <?php
}
}
/* {/block 'styles'} */
/* {block 'scripts'} */
class Block_1966248371604a5223ca1667_45563401 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'scripts' => 
  array (
    0 => 'Block_1966248371604a5223ca1667_45563401',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

        
        
    <?php
}
}
/* {/block 'scripts'} */
/* {block 'dataTable'} */
class Block_626325195604a5223cb1f13_15246109 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'dataTable' => 
  array (
    0 => 'Block_626325195604a5223cb1f13_15246109',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


                    <?php
}
}
/* {/block 'dataTable'} */
/* {block 'jquery'} */
class Block_526742070604a5223cb2e15_27746008 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'jquery' => 
  array (
    0 => 'Block_526742070604a5223cb2e15_27746008',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>



        <?php
}
}
/* {/block 'jquery'} */
/* {block 'title'} */
class Block_1367684283604a5223cb3b51_75089500 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'title' => 
  array (
    0 => 'Block_1367684283604a5223cb3b51_75089500',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

        Health Self Reporting Tool - <?php echo $_SESSION['userName'];?>

    <?php
}
}
/* {/block 'title'} */
/* {block 'content'} */
class Block_1510748284604a5223ccee71_85023301 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_1510748284604a5223ccee71_85023301',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


                    <?php
}
}
/* {/block 'content'} */
/* {block "auxScripts"} */
class Block_909426179604a5223cd20a2_53804902 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'auxScripts' => 
  array (
    0 => 'Block_909426179604a5223cd20a2_53804902',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


                <?php
}
}
/* {/block "auxScripts"} */
/* {block "foundation"} */
class Block_2040389336604a5223cd3dd2_74191180 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'foundation' => 
  array (
    0 => 'Block_2040389336604a5223cd3dd2_74191180',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


                    <?php
}
}
/* {/block "foundation"} */
}
