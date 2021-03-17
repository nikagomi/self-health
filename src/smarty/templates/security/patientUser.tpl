{extends file="base/body.tpl"}

{block name=jquery}
    {literal}
        
        $(function(){
            $(".hotspot").tipTip({maxWidth: "400px", edgeOffset: 3, defaultPosition: "top", delay: 200, fadeOut: 400});   
        });
        
        $("div.table-toolbar").html("Manage Patient Users").css({
            "margin-left" : "26px",
            "font-family": "'Poppins', sans-serif",
            "font-size" : "1.2rem",
            "font-weight" : 500,
            "color": "#464646"
        });
        
        /*****************************************************
         Lock a patient user
        ******************************************************/
        $("body").on("click","a.lockUsr",function(e) {
            var id = $(this).attr("data-id");
            var self = $(this);
            var parTr = $(this).closest("tr");
            $.ajax({
                type: "GET",
                url: "/security/patient/user/lock/" + id,
                dataType: "json"
            }).done(function(success) {
                if (success) {
                    parTr.find("td:first").html('<i class="fas fa-lock" style="font-size:1rem;color:#FF0000;" title="Account currently locked"></i>');
                    self.replaceWith('<a href="#" data-id="'+id+'" onclick="return false;" class="unlockUsr" title="Un-lock the user account"><i class="fas fa-lock-open" style="font-size:1.4rem;color:#006423;"></i></a>');
                } else {
                    swal("Update Error", "An error occurred. Could not lock the user account. Please try again later or contact the application HelpDesk", "error");
                }
            })
        });
        
        /*****************************************************
         Un-Lock a patient user
        ******************************************************/
        $("body").on("click","a.unlockUsr",function(e) {
            var id = $(this).attr("data-id");
            var self = $(this);
            var parTr = $(this).closest("tr");
            $.ajax({
                type: "GET",
                url: "/security/patient/user/unlock/" + id,
                dataType: "json"
            }).done(function(success) {
                if (success) {
                    parTr.find("td:first").html('<i class="fas fa-unlock-alt" style="font-size:1rem;color:#006432;" title="Account currently un-locked"></i>');
                    self.replaceWith('<a href="#" data-id="'+id+'" onclick="return false;" class="lockUsr" title="Lock the user account"><i class="fas fa-user-lock" style="font-size:1.4rem;color:orangered;"></i></a>');
                } else {
                    swal("Update Error", "An error occurred. Could not un-lock the user account. Please try again later or contact the application HelpDesk", "error");
                }
            })
        });
        
        /*****************************************************
         Delete a patient user (along with patient)
        ******************************************************/
        /*$("a.deleteUsr").click(function(e) {
            var id = $(this).attr("data-id");
            var self = $(this);
            var parTr = $(this).closest("tr");
            $.ajax({
                type: "GET",
                url: "/security/patient/user/unlock/" + id,
                dataType: "json"
            }).done(function(success) {
                if (success) {
                    parTr.remove();
                } else {
                    swal("Update Error", "An error occurred. Could not delete the user account (and associated patient record). Please try again later or contact the application HelpDesk", "error");
                }
            })
        });*/
        
        /*****************************************************
         Delete a patient user (along with patient)
        ******************************************************/
        $("a.deleteUsr").click(function(){
            var id = $(this).attr("data-id");
            var self = $(this);
            var parTr = $(this).closest("tr");
            
            swal({
                text: 'Are you sure you want to delete this user and the associated patient record?',
                showCancelButton: true,
              })
            .then((value) => {
                return fetch("/security/patient/user/delete/"+id, {method: 'GET'});
            })
            .then(results => {
                return results.json();
            })
            .then(json => {
                if (json.status) {
                   parTr.remove();
                } else {
                    swal("Update Error", "An error occurred. Could not delete the user account (and associated patient record). Please try again later or contact the application HelpDesk", "error");
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
        paging: true,
        "dom": "<'row'<'large-4 medium-4 columns collapsed table-toolbar'><'large-7 medium-7 columns end small-text-left medium-text-right collapsed 'f>>"+
            "t"+
            "<'row'<'small-12 medium-6 columns'><'small-12 medium-6 columns'p>>"
    {/literal}
{/block}


{block name=content}
 
{nocache}

      
 
    {*<div class="listTableCaption_simpleTable" style="font-variant:normal;font-weight: 500;margin-top:2px;margin-bottom:2px;color:#414042;font-family:'Poppins', sans-serif;font-size:1.3rem;">
        Manage Patient Users
    </div>*}
    <div id='holder'>
        {if $patientUsers|count gt 0}
            <table align="left" id="listTable" class="displayTable" width="95%" cellspacing="0" style='margin-left:15px !important;'>
                 <thead>
                    <tr height="30" style="">
                        <th class='all'>&nbsp;</th>
                        <th class="all">Last name</th>
                        <th class="all">First name</th> 
                        <th class="tablet-l desktop">Email</th>
                        <th class="all">Patient Name</th>
                        <th class="">Patient Sex</th>
                        <th class="">Patient Age</th>
                        <th class="">Patient Country</th>
                        <th class="">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    {foreach from=$patientUsers item=pUsr} 
                        {$patient=$patient->getByUserId($pUsr->getId())}
                        <tr>     
                            <td>
                                {if $pUsr->isLocked()}
                                    <i class="fas fa-lock" style='font-size:1rem;color:#FF0000;' title="Account currently locked"></i>
                                {else}
                                    <i class="fas fa-unlock-alt" style='font-size:1rem;color:#006432;' title="Account currently un-locked"></i>
                                {/if}
                            </td>
                            <td>{$pUsr->getLastName()}</td>
                            <td>{$pUsr->getFirstName()}</td>
                            <td>{$pUsr->getEmail()}</td>
                            <td>
                                {if PermissionManager::userHasPermission("SEARCH.PATIENTS", $smarty.session.userId)}
                                    <a style="color:#008cba;font-weight:400;" href='/patient/summary/{$patient->getId()}'>
                                        {$patient->getLabel()}
                                    </a>
                                {else}
                                    {$patient->getLabel()}
                                {/if}
                            </td> 
                            <td>{$patient->getGender()->getName()}</td>
                            <td>{$patient->displayAge()}</td> 
                            <td>{$patient->getCountry()->getLabel()}</td>
                            <td>
                                {if $pUsr->isLocked()}
                                    <a href="#" data-id="{$pUsr->getId()}" onclick="return false;" class="unlockUsr" title="Un-lock the user's account">
                                        <i class="fas fa-lock-open" style="font-size:1.4rem;color:#006423;"></i>
                                    </a>
                                {else}
                                    <a href="#" data-id="{$pUsr->getId()}" onclick="return false;" class="lockUsr" title="Lock the user's account">
                                        <i class="fas fa-user-lock" style='font-size:1.4rem;color:orangered;'></i>
                                    </a>
                                {/if}
                                &ensp;
                                <a href="#" data-id="{$pUsr->getId()}" onclick="return false;" class="deleteUsr" title="Delete the user's account. The associated patient record will be deleted as well.">
                                    <i class="fas fa-trash-alt" style='font-size:1.4rem;color:#ff0000;'></i>
                                </a>
                            </td>
                        </tr>
                    {/foreach}
                </tbody>
            </table> 
        {else}
            <div class="emptyListMessage">No patient users are defined. This means that there have not been any registrations.</div>
        {/if}
    </div>

{/nocache}
{/block}

