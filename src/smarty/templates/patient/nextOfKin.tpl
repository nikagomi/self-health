
{*Author: Randal Neptune*}
{*Project: Self-Health*}

{extends file="base/body.tpl"}

{block name=jquery}
    {literal}
        $("div.table-toolbar").html("{/literal}{Messages::i18n("nextOfKinForm.recorded.list")}{literal}").css({
            "margin-left" : "26px",
            "font-family": "'Poppins', sans-serif",
            "font-size" : "1.1rem",
            "font-weight" : 500,
            "color": "#464646"
        });
        
        $("form").find("select").chosen();
        
        /*****************************************
         Interrupt form submit to take care of 
         telephone stuff
        ******************************************/
        $("#nextOfKinForm").submit(function(e){
            var countryCode = itiContact.getSelectedCountryData().iso2;
            var telContact = phoneUtil.parseAndKeepRawInput(itiContact.getNumber(), countryCode.toUpperCase());
            $("input[name='contactNumber']").val(phoneUtil.format(telContact, i18n.phonenumbers.PhoneNumberFormat.INTERNATIONAL));
        });
        
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
    {$msg}
    <div class="listTableCaption_simpleTable" style="font-variant:normal;font-weight: 500;margin-top:2px;margin-bottom:2px;color:#414042;font-family:'Poppins', sans-serif;font-size:1.3rem;">
        {Messages::i18n("nextOfKinForm.legend")}
    </div>
    {if $smarty.session.patientId|trim != ''}
        <div style="margin-left:15px;margin-top:2px;width:80%;">
            <form data-abide name="nextOfKinForm" id="nextOfKinForm" action="{$actionPage}" method="POST" autocomplete="off">
                <input type="hidden" name="id" value="{$nextOfKin->getId()}"/>
                <input type="hidden" name="patientId" value="{$smarty.session.patientId}"/>
            
                <div class="row">
                    <div class="medium-12 end columns">
                        <label><span class="required">{Messages::i18n("nextOfKinForm.name")}</span>
                            <input tabindex="1" type="text"  maxlength="140" id="name" name="name" value="{$nextOfKin->getName()}" required>
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="medium-12 end columns">
                        <label><span class="required">{Messages::i18n("nextOfKinForm.relationshipTypeId")}</span>
                            <select tabindex="2" id="relationshipTypeId" name="relationshipTypeId"  required>
                                {html_options options=$relationshipTypeIds selected=$nextOfKin->getRelationshipTypeId()}
                            </select>
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="medium-12 end columns">
                        <label><span class="required">{Messages::i18n("nextOfKinForm.contactNumber")}</span><small id="phoneError" class="error"></small><br/>
                            <input tabindex="3" type="text"  class="medium" data-abide-validator="phoneValidator"  id="contact" name="contact" value="{$nextOfKin->getContactNumber()}" required>
                        </label>
                    </div>
                </div>
                

                <div class="row">
                    <div class="medium-4 end columns" style="padding-top:8px;">
                        <a href="/next/of/kin/form" tabindex="5" class="reset">{Messages::i18n("link.reset")}</a>&nbsp;
                        {ElementTag::submitBtn(4)}
                    </div>
                    {if $nextOfKin->getId() != ''}
                        <div class="medium-4 end columns" style="padding-top:8px;">
                            {Messages::i18n("checkbox.confirm")}&nbsp;<input tabindex="6" id="confirmDelete" type="checkbox"/>
                            {ElementTag::deleteBtn(7, "/next/of/kin/delete/`$nextOfKin->getId()`")}
                        </div>
                    {/if}
                </div>

            </form> 
        </div> 
        <div>
            <hr width="96%" style="margin:10px 2px 7px 2px;"/>
        </div>
    {/if}                    
    {if $list|count gt 0}
        <br/>
        <table align="left" id="listTable" class="displayTable" width="95%" cellspacing="0">
            <thead>
                <tr>
                    <th>{Messages::i18n("nextOfKinForm.name")}</th>
                    <th>{Messages::i18n("nextOfKinForm.relationshipTypeId")}</th> 
                    <th>{Messages::i18n("nextOfKinForm.contactNumber")}</th>
                    <th width="10%">&nbsp;</th>
                    
                </tr>
            </thead>
            <tbody>
                {foreach from=$list item=nok} 
                    <tr>    
                        <td>{$nok->getName()}</td>
                        <td>{$nok->getRelationshipType()->getLabel()}</td> 
                        <td>{$nok->getContactNumber()}</td>
                        <td>
                            <a class="editRow" title="{Messages::i18n("link.edit")}" href="/next/of/kin/edit/{$nok->getId()}">
                                <i class='fas fa-edit' style='font-size:1.5rem;color:#008cba;'></i>
                            </a>
                        </td>
                    </tr>
                {/foreach}
            </tbody>
        </table> 
    {else}
        <div class="emptyListMessage">
            {Messages::i18n("nextOfKinForm.empty.list.message")}
        </div>
    {/if}
    <br/><br/>
{/nocache}
{/block}


{block name="auxScripts"}
    {literal}
        const phoneUtil = i18n.phonenumbers.PhoneNumberUtil.getInstance();
        var contactNumber = document.querySelector("#contact");
       
        var phoneErrorMap = ["Invalid number", "Invalid country code", "Too short", "Too long"];
        
        var itiContact = intlTelInput(contact,{
            utilsScript: "/js/utils.js",
            placeholderNumberType: "FIXED_LINE",
            hiddenInput: "contactNumber",
            "allowDropdown": true,
            "autoPlaceholder": "polite",
            "initialCountry": "ai",
            "preferredCountries": ["ai", "ag", "vg", "dm", "gd", "gp", "mq", "ms", "kn", "lc", "vc"],
            "formatOnDisplay": true,
            autoHideDialCode: true
        });
        
        
        
    {/literal}
{/block}

{block name="foundation"}
    abide : {
        validators: {
            
            phoneValidator: function (el, required, parent) {
                   
                if (el.getAttribute("id") == 'contact') {
                    if (!itiContact.isValidNumber()) {
                       /* var countryCode = itiPrimaryNumber.getSelectedCountryData().iso2;

                        if (countryCode == "lc" && (itiPrimaryNumber.getNumber().indexOf("732") == 5 || itiPrimaryNumber.getNumber().indexOf("733") == 5) && phoneErrorMap[itiPrimaryNumber.getValidationError()] == "Invalid number") {
                            $("#phoneError").text("");
                            $("#primaryNumber").removeClass("error");
                            return true;
                        } */
                        $("#phoneError").text(phoneErrorMap[itiContact.getValidationError()]).css("display","inline-block");
                        $("#contact").addClass("error");
                        return false;
                    } else {
                        $("#contact").removeClass("error");
                    }
                }
                $("#phoneError").css("display","none");
                return true;
            }
        }
    }
{/block}
