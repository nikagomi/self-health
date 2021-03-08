<!doctype html>
<html>
<head profile="http://www.w3.org/2005/10/profile">
    <link rel="icon" 
      type="image/png" 
      href="/images/page_icon.ico" />
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<noscript>
  <style>html{literal}{display:none;}{/literal}</style>
  <meta http-equiv="refresh" content="0.0;url=/nojs.html">
</noscript>


{include file="base/header.tpl"}

<style type="text/css">
    .ui-dialog{
        font-size:12px;
    }
    
    {block name=styles}

    {/block}
</style>

<script type="text/javascript">
    {* To prevent right clicking on the page *}
    
    {literal} var timeout = {/literal} {$smarty.session.timeout}{*PropertyService::getProperty("inactivity.timeout.period")*};
        {*following literal box prevents right click popup menu*}
    {literal}
       
     var message = '';
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
        document.oncontextmenu = new Function("return false");
    {/literal}
        
    {block name=scripts}
        
        
    {/block}
        
    {literal}  
        $(document).ready(function(){
            /*For wysiwyg editor */
            $.trumbowyg.svgPath = '/images/icons/icons.svg';
            
            /*To get success messages to fade away after a while*/
            $(function () {
                if ($("div.successMessage").length > 0) {
                    var x = 2000;
                    $("div.successMessage").each( function() {
                        $(this).delay(x).fadeOut('slow');
                        x = x + 1000;
                    });
                } 
            });
            
            /* For idle timeout */
            $(document).idleTimeout({
                idleTimeLimit: timeout * 60,      
                redirectUrl: '/logOut/timeOut',    
                customCallback: false,     
                activityEvents: 'click keypress scroll wheel mousewheel mousemove', 

                // warning dialog box configuration
                enableDialog: true,        
                dialogDisplayLimit: 90,   
                dialogTitle: '{/literal}{Messages::i18n("sessionExpiry.warning.header")}{literal}',
                dialogText: '{/literal}{Messages::i18nParams("sessionExpiry.timeout.details", PropertyService::getProperty("inactivity.timeout.period"))}{literal}',
                dialogTimeRemaining: '{/literal}{Messages::i18n("sessionExpiry.time.remaining")}{literal}',
                dialogStayLoggedInButton: '{/literal}{Messages::i18n("sessionExpiry.option.stayLoggedIn")}{literal}',
                //dialogLogOutNowButton: 'Log out now',

                // error message
                //errorAlertMessage: 'Please disable "Private Mode", or upgrade to a modern browser.',
                sessionKeepAliveTimer: false 
                
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
                $('#menu-wrap').prepend('<div id="menu-trigger">Menu</div>');		
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
                        $(this).closest("div").find("input[type='button'].delete").attr("disabled",false);
                    }else{
                       $(this).closest("div").find("input[type='button'].delete").attr("disabled",true);
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
                    { orderable: false, "targets": -1 }
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
                            var data = api.cells( rowIdx, ':hidden' ).eq(0).map(function(cell){
                                var header = $(api.column( cell.column ).header());
                                var content = api.cell(cell).data();
                                
                                var spn = api.cell(cell).node().getElementsByTagName("SPAN")[0];
                                
                                if(isRealValue(spn) && $.trim(spn.title) != ""){
                                    content = api.cell(cell).data()+" ("+spn.title+")";
                                }else if(isRealValue(api.cell(cell).node().title)){
                                    content = api.cell(cell).node().title;
                                }else{
                                    content = api.cell(cell).data();
                                }
                                return '<tr>'+
                                            '<td style="width:20%;"><b>'+
                                                header.text()+':</b>'+
                                            '</td> '+
                                            '<td>'+
                                               content +
                                            '</td>'+
                                        '</tr>';
                            } ).toArray().join('');

                            return data ? $('<table/>',{style:"width:98%;margin:0;border:2px solid #d0e8e8;box-shadow:3px 3px 4px #d0e8e8;",align:"center"}).append( data ) : false;
                        }
                    }
                },
                "language": {
                    "lengthMenu": "{/literal}{Messages::i18nParams('datatables.length.menu', "_MENU_")}{literal}",
                    "zeroRecords": "{/literal}{Messages::i18n('datatables.zero.records')}{literal}",
                    "info": "{/literal}{Messages::i18nParams('datatables.info', "_PAGE_,_PAGES_")}{literal}",
                    "infoEmpty": "{/literal}{Messages::i18n('datatables.zero.records')}{literal}",
                    "infoFiltered": "{/literal}{Messages::i18nParams('datatables.info.filtered', "_MAX_")}{literal}",
                    "search": "{/literal}{Messages::i18n('datatables.search')}{literal}",
                    "emptyTable": "{/literal}{Messages::i18n('datatables.empty.table')}{literal}",
                    "paginate": {
                        "first":      "{/literal}{Messages::i18n('datatables.paginate.first')}{literal}",
                        "last":       "{/literal}{Messages::i18n('datatables.paginate.last')}{literal}",
                        "next":       "{/literal}{Messages::i18n('datatables.paginate.next')}{literal}",
                        "previous":   "{/literal}{Messages::i18n('datatables.paginate.previous')}{literal}"
                }   }
    
            });
            
            
            
            /*$("body").on("click",".overlayClick",function(event){
                addOverlay("", true);
            });*/
            
            /*$("body").on('click', 'a:not(.ajax_link,.hintanchorRow)',function(event) {
                event.preventDefault();
                //Pace.restart();
                newLocation = this.href;
                $('body').css("opacity",0.5); //fadeOut(2000, newpage);
                newpage();
            });*/
            
            $("body").on('click', 'a',function(event) {
                $('.qtip:visible').qtip('hide');
            });
            
            function newpage() {
                window.location = newLocation;
            }
            
            var dTable = $("#listTable, .listTable").DataTable({
                {/literal}
                    {block name=dataTable}

                    {/block}
                {literal}
            });
            /************************************************
            Quick Link for users to change password and email
            *************************************************/

    {/literal}

    {include file="utility/notify/notification.tpl"}
        {block name=jquery}


        {/block}
    {literal} 
        });   /* End of $(document).ready() function */
    {/literal}
</script>


<title>
    {block name=title}
        SM@RT: The Clever Solution. - {nocache}{$smarty.session.userName}{/nocache}
    {/block}
</title>

</head>

<body>
    <div id="wrap">
        <div id="main">
            {block name=content}

            {/block}
	</div>
    </div>
    <br/><br/>
    {*include file="base/footer.tpl"*}

    
    <!-- Other JS plugins can be included here -->
    {literal}
        <script type="text/javascript" src="/js/foundation.js"></script>
        <script type="text/javascript" src="/js/datatables.min.js"></script> 
        <!--<script type="text/javascript" src="/js/dataTables.fixedHeader.min.js"></script>--> 
        <script type="text/javascript" src="/js/foundation.abide.js"></script>
        <script type="text/javascript" src="/js/foundation.equalizer.js"></script>
        <script type="text/javascript" src="/js/foundation.accordion.js"></script> 
        <script>
                $(document).foundation({
            {/literal}   
            {block name="foundation"}

            {/block}
            {literal}
                });
            {/literal}

        </script>
</body>


</html>