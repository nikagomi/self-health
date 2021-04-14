{extends file="base/body.tpl"}

{block name=styles}
    {literal}
        
    {/literal}
{/block}

{block name=scripts}
    {literal}
        
    {/literal}
{/block}
 
{block name=jquery}
   {literal}
        $(function(){
            $(".hotspot").tipTip({maxWidth: "400px", edgeOffset: 3, defaultPosition: "top", delay: 200, fadeOut: 400});
        });
        
        $("a.disable2FA").click(function() {
            var usrId = $(this).attr("data-id");
            var usrName = $(this).attr("data-name");
            var parTr = $(this).closest("tr");
            sweetAlert({
                title: "Disable user two factor authentication for\n"+usrName+"?",
                text: "This will disable two factor authentication for the user, making the user's login process less secure.\nContinue?",
                type: "question",
                showCancelButton: true,
                confirmButtonColor: "#FF0000",
                confirmButtonText: "Disable",
                closeOnConfirm: true,
                closeOnCancel: true
            }).then(
                function(){
                    $.ajax({
                        type: "POST",
                        url: "/disable/tfa",
                        dataType: "json",
                        data: {userId: usrId},
                        success: function (status) {
                            if (status) {
                                parTr.remove();
                                sweetAlert({
                                    title: "Disable 2FA Success",
                                    text: "Two factor authentication was successfully disabled for "+usrName+".\nThe user will need to re-enable two factor authentication.",
                                    type: "success"
                                });
                                
                            } else {
                                sweetAlert({
                                    title: "Disable 2FA Error",
                                    text: "Could not disable two factor authentication for "+usrName+".\nPlease contact the administrator.",
                                    type: "error"
                                });
                            }
                        }
                    });
                }
            );
        });
        
        $("div.table-toolbar").html('Two factor authentication enabled users');
    {/literal}
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

{if PermissionManager::userHasPermissionAtFacility("VIEW.TFA.ENABLED.USERS",$smarty.session.userId, $smarty.session.facilityId)}
    <br/><br/>
    {if $list|count gt 0}

        <table align="left" id="listTable"  class="displayTable" width="98%" cellspacing="0">
            <thead>
                <tr>
                    <th>Email</th>
                    <th>First Name</th>
                    <th>Last Name</th> 
                    <th>Contact #</th>
                    <th>Last Login</th> 
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                {foreach from=$list item=lu} 
                    <tr>    
                        <td style="font-weight:bold;">{$lu->getEmail()}</td>
                        <td>{$lu->getFirstName()}</td>
                        <td>{$lu->getLastName()}</td>
                        <td>{$lu->displayContactNumber()}</td>
                        <td>{$lu->getLastLoginTime()|date_format:"%b %e, %Y %l:%M %p"}</td>
                        <td>
                            {if $lu->getId() != $smarty.session.userId && !$lu->isSystem() && PermissionManager::userHasPermissionAtFacility('DISABLE.USER.2FA', $smarty.session.userId, $smarty.session.facilityId)}
                                <a href="#" data-id="{$lu->getId()}" data-name="{$lu->getLabel()}" style="color:#DD0000;font-size:0.8rem;" onclick="return false;" class="disable2FA">
                                    disable 2FA
                                </a>
                            {else}
                                &nbsp;
                            {/if}
                        </td> 
                        <td>
                            {if PermissionManager::userHasPermissionAtFacility('MANAGE.USERS', $smarty.session.userId, $smarty.session.facilityId) && !$lu->isSystem()}
                                <a href="/security/users/{$lu->getId()}" style='font-size:0.8rem;'>
                                    edit user
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
            No users seem to have two factor authentication enabled {if !$smarty.session.isAdmin} at the chosen facility {/if}
        </div>
    {/if}
{/if}

{/nocache}

{/block}
    