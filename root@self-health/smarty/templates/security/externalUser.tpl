{extends file="base/body.tpl"}

{block name=jquery}
    {literal}
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
                        parTd.find("span").css("color","#FF0000").text("Locked");
                        self.text("(open)").attr("class","unlockUsr");
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
                        parTd.find("span").css("color","#006432").text("Open");
                        self.text("(restrict)").attr("class","lockUsr");
                    }else{
                        $("div.msg").html(data.msg);
                    }
                    $div.remove();
                }
            });
        });
        
        /**********************************************
         Do dissociate a student from an external user
        ***********************************************/
        $("a.unlink").click(function(){
            var id = $(this).attr("data-id");
            var parSpan = $(this).closest("span");
            var $div = $('<div>',{class:"overlay"});
            $div.height($(document).height());
            $div.css("padding-top",$(window).height()/2+"px");
            $div.append("<img src='/images/newloader.gif'/><br/><b>Working...</b>");
            $div.appendTo("body");
            $.ajax({
                url:"/security/user/external/unlink/student/"+id,
                type:"GET",
                dataType: "json",
                success: function(data){
                    if(data.status){
                        parSpan.remove();
                    }
                    $("div.msg").html(data.msg);
                    $div.remove();
                }
            });
        });
        
        /************************************
         To delete an external user
        *************************************/
        $("a.del").click(function(){
            var usrId = $(this).attr("data-id");
            var parTr = $(this).closest("tr");
            var $div = $('<div>',{class:"overlay"});
            $div.height($(document).height());
            $div.css("padding-top",$(window).height()/2+"px");
            $div.append("<img src='/images/newloader.gif'/><br/><b>Working...</b>");
            $div.appendTo("body");
            $.ajax({
                url:"/security/user/external/delete/account/"+usrId,
                type:"GET",
                dataType: "json",
                success: function(data){
                    if(data.status){
                        var tbody = parTr.closest("tbody");
                        parTr.remove();
                        if(tbody.find("tr").length == 0){//no more rows in table
                            $("div#holder").html('<div class="emptyListMessage">No external users have been recorded at this facility.</div>');
                        }
                    }
                    $("div.msg").html(data.msg);
                    $div.remove();
                }
            });
        });
    {/literal}
{/block}


{block name=styles}
    {literal}
        
        
    {/literal}
{/block}

{block name=dataTable}
    {literal}
        'iDisplayLength':100
    {/literal}
{/block}


{block name=content}
 
{nocache}
{if $smarty.session.isEducational} 
      
 
    <div class="listTableCaption_simpleTable" style="color:#BBBBBB;margin-top:2px;margin-left:2px;margin-bottom:10px;font-size:22px;">
        Manage External Users
    </div>
    <div class="msg">
        
    </div>
    <div id='holder'>
        {if $users|count gt 0}
            <table align="left" id="listTable" class="displayTable" width="95%" cellspacing="0">
                 <thead>
                    <tr height="30" style="">
                        <th class="all">First name</th> 
                        <th class="all">Last name</th>
                        <th class="desktop">Email</th>
                        <th class="all">Contact #</th>
                        <th class="all">Account Status</th>
                        <th class="all" width="">Associated Student(s)</th>
                        <th class="desktop" width="7%">&nbsp;</th>

                    </tr>
                </thead>
                <tbody>
                    {foreach from=$users item=usr} 
                        <tr>                           
                            <td>{$usr->getFirstName()}</td>
                            <td>{$usr->getLastName()}</td> 
                            <td><span title="{$usr->getEmail()}" class="hotspot">{$html->truncateString($usr->getEmail(), 30)}</span></td> 
                            <td>{$usr->displayContactNumber()}</td> 
                            <td>
                                {*$usrFacAccess=$usrFacility->getByUserAndFacility($usr->getId(),$facilityId, true)*}
                                {if $usr->isLocked()}
                                    <span style='color:#FF0000;font-weight:bold;'>Locked</span>&nbsp;<a href="#" style='font-size:0.8rem;' class="unlockUsr ajax_link" data-id="{$usr->getId()}" onclick="return false;">(open)</a>
                                {else}
                                    <span style='color:#006432;font-weight:bold;'>Open</span>&nbsp;<a href="#" style='font-size:0.8rem;' class="lockUsr ajax_link" data-id="{$usr->getId()}" onclick="return false;">(restrict)</a>
                                {/if}
                            </td> 
                            <td>
                                {$accessors=$studentAccess->getByUserId($usr->getId())}
                                {foreach from=$accessors item=accessor}
                                    <span>{$accessor->getStudent()->getFullName()}&nbsp;<a href="#" style="font-size:0.8rem;" class="unlink ajax_link" data-id="{$accessor->getId()}" onclick="return false;">unlink</a>;&nbsp;</span>
                                {/foreach}
                            </td>
                            <td>
                                <a  title="{Messages::i18n("link.delete")}" class="del ajax_link" data-id="{$usr->getId()}" href="#" onclick="return false;"></a>
                            </td>

                        </tr>
                    {/foreach}
                </tbody>
            </table> 
        {else}
            <div class="emptyListMessage">No external users have been recorded at this facility.</div>
        {/if}
    </div>
        
    
{else}
    <div class="emptyListMessage">This functionality is only available at an educational facility.</div>
{/if}
{/nocache}
{/block}