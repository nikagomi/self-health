{extends file="base/body.tpl"}

{block name=styles}
    {literal}
        
    {/literal}
{/block}

{block name=scripts}
    {literal}
        function refresh() {
            window.location.reload(true);
        }

        setTimeout(refresh, 60000);
    {/literal}
{/block}
 
{block name=jquery}
   {literal}
        $(function(){
            $(".hotspot").tipTip({maxWidth: "400px", edgeOffset: 3, defaultPosition: "top", delay: 200, fadeOut: 400});
        });
        
        $("a.forceLogOut").click(function() {
            var usrId = $(this).attr("data-id");
            var parTr =  $(this).closest("tr");
            sweetAlert({
                title: "Forcefully end user session",
                text: "This will forcefully terminate the user session. Continue?",
                type: "question",
                showCancelButton: true,
                confirmButtonColor: "#FF0000",
                confirmButtonText: "End Session",
                closeOnConfirm: true,
                closeOnCancel: true
            }).then(
                function(){
                  
                    $.ajax({
                        type: "GET",
                        url: "/force/user/log/out/"+usrId,
                        dataType: "json",
                        success: function (status) {
                            if (status) {
                                parTr.remove();
                                sweetAlert({
                                    title: "Force log out success",
                                    text: "The user was successfully logged out of the application.",
                                    type: "success"
                                });
                            } else {
                                sweetAlert({
                                    title: "Force log out error",
                                    text: "Could not log the user out of the application.\nPlease contact the administrator.",
                                    type: "error"
                                });
                            }
                        }
                    });
                }
            );
        });
        
        $("div.table-toolbar").html('Users logged in by facility');
    {/literal}
    {nocache}
        {if $smarty.session.isAdmin && $loggedUsersList|count gt 0}
            sarmsHeaderDataTableColumnFilter(dTable, 4, "");
        {/if}
    {/nocache}
{/block}

{block name=dataTable}
    {literal}
        'iDisplayLength':100,
        "dom": "<'row'<'small-12 medium-6 columns table-toolbar'><'small-12 medium-3 columns show-for-medium-up'l><'small-12 medium-3 columns end text-left'f>>"+
        "t"+
        "<'row'<'small-12 medium-6 columns'><'small-12 medium-6 columns'p>>"
    {/literal}
{/block}

{block name=content}
{nocache}

{$msg}

{if PermissionManager::userHasPermissionAtFacility("VIEW.LOGGED.IN.USERS",$smarty.session.userId, $smarty.session.facilityId)}
    <br/><br/>
    {if $loggedUsersList|count gt 0}

        <table align="left" id="listTable"  class="displayTable" width="98%" cellspacing="0">
            <thead>
                <tr>
                    <th>Email</th>
                    <th>Last Name</th> 
                    <th>First Name</th> 
                    <th>Contact #</th>
                    <th>Facility</th> 
                    <th>Last Login</th> 
                    <th>Ext. User?</th>
                    <th>Time Since Login</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                {foreach from=$loggedUsersList item=lu} 
                    <tr>    
                        <td>{$lu->getEmail()}</td>
                        <td>{$lu->getLastName()}</td>
                        <td>{$lu->getFirstName()}</td>
                        <td>{$lu->getContactNumber()}</td>
                        <td class="hotspot" title="{$lu->getLoggedInAtFacility()->getName()}">
                                {$lu->getLoggedInAtFacility()->getFacilityCode()}
                            
                        </td> 
                        <td>{$lu->getLastLoginTime()|date_format:"%b %e, %Y %l:%M %p"}</td>
                        <td>{DbMapperUtility::booleanYesNo($lu->isExternalUser())}</td> 
                        <td>{DbMapperUtility::timeElapsedExpanded($lu->getLastLoginTime(), $now)}</td>
                        <td>
                            {if $lu->getId() != $smarty.session.userId && !$lu->isSystem()}
                                <a href="#" data-id="{$lu->getId()}" onclick="return false;" class="forceLogOut">
                                    Log Out
                                </a>
                            {else}
                                &nbsp;
                            {/if}
                        </td> 
                    </tr>
                {/foreach}
            </tbody>
        </table> 
    {else}
        <div align="left" class="emptyListMessage">
            No users seem to be logged in at the chosen facility.
        </div>
    {/if}
{/if}

{/nocache}

{/block}
    