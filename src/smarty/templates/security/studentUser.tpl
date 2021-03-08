{extends file="base/body.tpl"}

{block name=jquery}
    {literal}
        
        var classGroups = {/literal} {nocache} {$jsonClassGroups} {/nocache} {literal};
        
        $(function(){
            $(".hotspot").tipTip({maxWidth: "400px", edgeOffset: 3, defaultPosition: "top", delay: 200, fadeOut: 400});   
        });
        
        /*******************************
         To lock external user account
        ********************************/
        $("body").on("click","a.lockUsr",function(){
            var self = $(this);
            var usrId = $(this).attr("data-id");
            var parTd = $(this).closest("td");
            var $div = $('<div>',{class:"overlay"});
            $div.height($(document).height());
            $div.css("padding-top",$(window).height()/2+"px");
            $div.append("<img src='/images/newloader.gif'/><br/><b>Working...</b>");
            $div.appendTo("body");
          
            $.ajax({
                url:"/security/user/external/restrict/"+usrId,
                type:"GET",
                dataType: "json",
                cache: false,
                success: function(data){
                    if(data.status){
                        parTd.html('<span style="color:#FF0000;font-weight:bold;">Locked</span>&nbsp;<a href="#" style="font-size:0.8rem;" class="unlockUsr ajax_link" data-id="'+usrId+'" onclick="return false;">(open)</a>');
                    }else{
                        $("div.msg").html(data.msg);
                    }
                    $div.remove();
                }
            });
        });
        
        /**************************************
         To unlock an external user account
        ***************************************/
        $("body").on("click","a.unlockUsr",function(){
            var self = $(this);
            var usrId = $(this).attr("data-id");
            var parTd = $(this).closest("td");
            var $div = $('<div>',{class:"overlay"});
            $div.height($(document).height());
            $div.css("padding-top",$(window).height()/2+"px");
            $div.append("<img src='/images/newloader.gif'/><br/><b>Working...</b>");
            $div.appendTo("body");
            $.ajax({
                url:"/security/user/external/open/account/"+usrId,
                type:"GET",
                dataType: "json",
                cache: false,
                success: function(data){
                    if(data.status){
                        parTd.html('<span style="color:#006432;font-weight:bold;">Open</span>&nbsp;<a href="#" style="font-size:0.8rem;" class="lockUsr ajax_link" data-id="'+usrId+'" onclick="return false;">(lock)</a>');
                    }else{
                        $("div.msg").html(data.msg);
                    }
                    $div.remove();
                }
            });
        });
        
        /**********************************************
         To create a student user account
        ***********************************************/
        $("body").on("click","a.createAcct",function(){
            var studentId = $(this).attr("data-id");
            var parTd = $(this).closest("td");
            var $div = $('<div>',{class:"overlay"});
            $div.height($(document).height());
            $div.css("padding-top",$(window).height()/2+"px");
            $div.append("<img src='/images/newloader.gif'/><br/><b>Working...</b>");
            $div.appendTo("body");
            $.ajax({
                url:"/security/user/student/create/"+studentId,
                type:"GET",
                dataType: "json",
                success: function(data){
                    if(data.userId != ''){
                        parTd.html('<a  title="Delete the student\'s user account" class="del ajax_link" style="color:#DD0000;" data-id="'+data.userId+'" href="#" onclick="return false;">delete acct.</a>');
                        parTd.prev("td").html('<span style="color:#006432;font-weight:bold;">Open</span>&nbsp;<a href="#" style="font-size:0.8rem;" class="lockUsr ajax_link" data-id="'+data.userId+'" onclick="return false;">(lock)</a>');
                    }
                    if (data.status) {
                        $("div.msg").css("color","#006432 !important");
                    } else {
                        $("div.msg").css("color","#FF0000 !important");
                    }
                    $("div.msg").html(data.msg);
                    $div.remove();
                }
            });
        });
        
        /************************************
         To delete a student user
        *************************************/
        $("body").on("click","a.deleteAcct", function(){
            var usrId = $(this).attr("data-id");
            var parTd = $(this).closest("td");
            var $div = $('<div>',{class:"overlay"});
            $div.height($(document).height());
            $div.css("padding-top",$(window).height()/2+"px");
            $div.append("<img src='/images/newloader.gif'/><br/><b>Working...</b>");
            $div.appendTo("body");
            $.ajax({
                url:"/security/user/student/delete/"+usrId,
                type:"GET",
                dataType: "json",
                success: function(data){
                    if(data.status){
                        parTd.html('<a  title="Create a user account for the student" class="createAcct ajax_link" data-id="{$student->getId()}" href="#" onclick="return false;">create acct.</a>');
                        parTd.prev("td").html("N/A");
                    } else {
                        $("div.msg").html(data.msg).css("color","#DD0000");
                    }
                    $div.remove();
                }
            });
        });
        
        /**************************************************
        Give options to navigate to other class groups
        ***************************************************/
        $("#classGroupList").qtip({
            content: {
                button: true,
                title: "<b>Navigate to:</b>",
                text: function(event, api) {
                    var $div = $("<div>");
                    var $ul = $("<ul>", {class:"small-block-grid-2"});
                        
                    var url = "/security/user/student/";
                    var curl = '';
                    for(var j = 0; j < classGroups.length; j++){
                        var $li = $("<li>");
                            $li.css({'padding':'2px'});
                        nurl =  url + classGroups[j].id;
                        var $a = $("<a>",{"href": nurl});
                            $a.text(classGroups[j].label);
                            $a.css({"font-size":"1.1rem", "line-height":"1.7rem","font-weight":"bold"});
                        if ($("#ayClassGroupId").val() == classGroups[j].id) {
                            $a.css({'color':'orange'});
                        }
                        //$div.append($a).append("<br/>");
                        $li.append($a);
                        $ul.append($li);
                    }
                    $div.append($ul);
                    return $div.html();
                }
            },
             style: {
                classes: 'qtip-bootstrap',
                width: '355px'
            },
            position: {
                my: "top center",
                at: "bottom center",
                viewport: $(window),
                adjust: {
                    method: 'none shift'
                },
                target: self
            },
            show :{
                event: "click",
                solo: true,
                modal: false
            }, 
            hide: false
        });
        
        /***********************************************************
         Edit/Add a student email
        ************************************************************/
        $("body").on("click",".editStudentEmail, .addStudentEmail", function () {
            var studentId = $(this).attr("data-id");
            var email = $(this).attr("data-email");
            var parTd = $(this).closest("td");
            
            var $txt = $("<input>", {"type":"text", "data-email": email, "data-id": studentId});
            $txt.val(email).css({"display":"inline-block", "width":"80%"});
            parTd.html("").append($txt).append("&ensp;&nbsp;<i class='fas fa-check updateEmail' style='color:#006432;font-size:1.1rem;'></i>&ensp;&ensp;<i class='fas fa-undo cancelEmail' style='color:orangered;font-size:1.1rem;'></i>");
            parTd.append("<small class='error' style='display:none;color:#FF0000;background-color:transparent;'>invalid email format</small>");
        });
        
        /*************************************
         Cancel the add/edit of an email
        **************************************/
        $("body").on("click",".cancelEmail", function () {
            parTd = $(this).closest("td");
            var studentId = parTd.find("input[type='text']").attr("data-id");
            var email = $.trim(parTd.find("input[type='text']").attr("data-email"));
            
            if (email != '') {
                parTd.html('<span title="'+email+'" class="hotspot">'+truncateText(email, 30)+'</span>&ensp;&ensp;<i class="fas fa-edit editStudentEmail" data-email="'+email+'" data-id="'+studentId+'" style="font-size:1.1rem;color:#008cba;"></i>');
            } else {
                parTd.html('&ensp;<i class="fas fa-plus-circle addStudentEmail" data-email="" data-id="'+studentId+'" style="font-size:1.1rem;color:#006432;"></i>');
            }
            $(".hotspot").tipTip({maxWidth: "400px", edgeOffset: 3, defaultPosition: "top", delay: 200, fadeOut: 400}); 
        });
        
        /****************************************
         Update a student email
        *****************************************/
        $("body").on("click",".updateEmail", function() {
            var parTd = $(this).closest("td");
            var email = $.trim(parTd.find("input[type='text']").val());
            var id = $.trim(parTd.find("input[type='text']").attr("data-id"));
            var prevEmail = $.trim(parTd.find("input[type='text']").attr("data-email"));
            
            if (email == '') {
                parTd.find("input[type='text']").addClass("error");
                return false;
            } else if (!validateEmail(email)) {
                parTd.find("input[type='text']").addClass("error");
                parTd.find("small").css("display","inline-block");
                return false;
            } else {
                parTd.find("input[type='text']").removeClass("error");
                parTd.find("small").css("display","none");
            }
            
            $.ajax({
                url:"/ajax/student/email/update",
                type: "POST",
                data: {id: id, email: email},
                dataType: "json"
            }).done (function(data) {
                if (data) {
                    parTd.html('<span title="'+email+'" class="hotspot">'+truncateText(email, 30)+'</span>&ensp;&ensp;<i class="fas fa-edit editStudentEmail" data-email="'+email+'" data-id="'+studentId+'" style="font-size:1.1rem;color:#008cba;"></i>');
                    parTd.closest("table").find("td:last").html('<a  title="Create a user account for the student" class="createAcct ajax_link" data-id="'+studentId+'" href="#" onclick="return false;">create acct.</a>');
                } else {
                    swal("Operation Error", "Sorry, could not update student's email.\nPlease try to edit from student details page instead.","error");
                }
            });
        });
        
    {/literal}
{/block}


{block name=styles}
    {literal}
        .deleteAcct {
            color: #DD0000;
        }
        
        .createAcct {
            color: #006432;
        }
        
    {/literal}
{/block}

{block name=scripts}
    {literal}
        function validateEmail(email){
            return /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))$/i.test(email);
        }
    {/literal}
{/block}

{block name=dataTable}
    {literal}
        "paging":false,
        "ordering": true,
        "dom": "<'row'<'small-12 medium-3 columns'><'small-12 medium-9 columns end text-right'f>>"+
            "t"+
            "<'row'<'small-12 medium-6 columns'><'small-12 medium-6 columns'p>>"
    {/literal}
{/block}


{block name=content}
 
{nocache}
{if $smarty.session.isEducational && $currentYear->getId() == $ayClassGroup->getAcademicYearId()} 
      
 
    <div class="listTableCaption_simpleTable" style="color:#BBBBBB;margin-top:2px;margin-left:18px;margin-bottom:10px;font-size:22px;">
        Manage Student Users
    </div>
    
    <div class="row" >
        <div class="medium-3 large-2 columns">
            <label class="medium-text-right small-text-left">Academic year:</label>
        </div>
        <div class="medium-3 large-2 end columns">
            <label class="infoLabel text-left">{$ayClassGroup->getAcademicYear()->getName()}
            </label>
        </div>
         <div class="medium-3 large-2 columns">
             <label class="medium-text-right small-text-left">Class Group:</label>
        </div>
        <div class="medium-3 large-4 end columns">
            <label class="text-left infoLabel">
                <b>
                    <a id='classGroupList' onclick='return false;'
                        {if PropertyService::getBoolean("has.facility.divisions")} 
                            class="hotspot ajax_link" title="<i><b>{$ayClassGroup->getClassGroup()->getFacilityDivision()->getLabel()}</b></i>"
                        {else}
                            class="ajax_link"
                        {/if}
                        >
                        {$ayClassGroup->getClassGroup()->getName()}
                    </a>
                    <a href="#" class="hintanchorRow" onMouseover="showhint('Click on the class group name to access other class groups', this, event, '200px')">
                        &nbsp;
                    </a>
                </b>
            </label>
        </div>
    </div>
     <div class="row" >
        <div class="medium-3 large-2 columns">
            <label class="medium-text-right small-text-left">School:</label>
        </div>
        <div class="medium-7 end columns">
            <label class="infoLabel text-left">{$ayClassGroup->getFacility()->getName()}
            </label>
        </div>
    </div> 
    <div class="row">
        <div class="medium-12 columns">
          <hr width="99%" size="4" color="#D0E0F0" style="margin:5px;"/>
        </div>
    </div>
    <div class="msg" align="left" style="margin-left:18px;font-variant: small-caps;"></div>
    
    <div id='holder'>
        {if $students|count gt 0}
            <table align="left" id="listTable" class="displayTable" width="95%" cellspacing="0" style='margin-left:15px !important;'>
                 <thead>
                    <tr height="30" style="">
                        <th class="all">Last name</th>
                        <th class="all">First name</th> 
                        <th class="desktop">Sex</th>
                        <th class="all">Email</th>
                        <th class="desktop">Contact #</th>
                        <th class="all">Acct Status</th>
                        <th class="all">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    {foreach from=$students item=student} 
                        {$usr=$student->getUserAccount()}
                        <tr>                           
                            <td>
                                <a href='/student/summary/{$student->getId()}'>
                                     {$student->getLastName()}
                                </a>
                            </td>
                            <td>
                                <a href='/student/summary/{$student->getId()}'>
                                    {$student->getFirstName()}
                                </a>
                            </td> 
                            <td>{$student->getGender()->getName()}</td>
                            <td>
                                {if $student->getEmail() != ''}
                                    <span title="{$student->getEmail()}" class="hotspot">
                                        {$html->truncateString($student->getEmail(), 30)}
                                    </span>&ensp;&ensp;<i class="fas fa-edit editStudentEmail" data-email="{$student->getEmail()}" data-id="{$student->getId()}" style="font-size:1.1rem;color:#008cba;"></i>
                                {else}
                                    &ensp;<i class="fas fa-plus-circle addStudentEmail" data-email="" data-id="{$student->getId()}" style="font-size:1.1rem;color:#006432;"></i>
                                {/if}
                            </td> 
                            <td>{$student->displayPrimaryContactNumber()}</td>
                            <td>
                                {if !$usr->isIdEmpty()}
                                    {if $usr->isLocked()}
                                        <span style='color:#FF0000;font-weight:bold;'>Locked</span>&nbsp;<a href="#" style='font-size:0.8rem;' class="unlockUsr ajax_link" data-id="{$usr->getId()}" onclick="return false;">(open)</a>
                                    {else}
                                        <span style='color:#006432;font-weight:bold;'>Open</span>&nbsp;<a href="#" style='font-size:0.8rem;' class="lockUsr ajax_link" data-id="{$usr->getId()}" onclick="return false;">(lock)</a>
                                    {/if}
                                {else}
                                    N/A
                                {/if}
                            </td> 
                            <td>
                               
                                {if $usr->IsIdEmpty() && $student->getEmail()|trim != ''}
                                    <a  title="Create a user account for the student" class="createAcct ajax_link" data-id="{$student->getId()}" href="#" onclick="return false;">create acct.</a>
                                {elseif (!$usr->IsIdEmpty())}
                                    <a  title="Delete the student's user account" class="deleteAcct ajax_link" data-id="{$usr->getId()}" href="#" onclick="return false;">delete acct.</a>
                                {else}
                                    <span style='color:darkorange;font-size:0.8rem;'>email required</span>
                                {/if}
                                
                            </td>

                        </tr>
                    {/foreach}
                </tbody>
            </table> 
        {else}
            <div class="emptyListMessage">No students have been defined for the chosen class group.</div>
        {/if}
    </div>
{else}
    <div class="emptyListMessage">This functionality is only available at an educational facility within the current or latest academic year.</div>
{/if}
{/nocache}
{/block}
