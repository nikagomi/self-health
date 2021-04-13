{*Author: Randal Neptune*}
{*Project: Self-Health*}

{extends file="base/body.tpl"}

{block name=jquery}
    {literal}
        $("div.table-toolbar").html("{/literal}{Messages::i18n("patientAllergyForm.recorded.list")}{literal}").css({
            "margin-left" : "26px",
            "font-family": "'Poppins', sans-serif",
            "font-size" : "1.2rem",
            "font-weight" : 500,
            "color": "#464646"
        });
        
        $("form").find("select").chosen();
        
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
        {Messages::i18n("patientAllergyForm.legend")}
    </div>
    {if $smarty.session.patientId|trim != ''}
        <div style="margin-left:15px;margin-top:2px;width:80%;">
            <form data-abide name="patientAllergyForm" id="patientAllergyForm" action="{$actionPage}" method="POST" autocomplete="off">
                <input type="hidden" name="id" value="{$patientAllergy->getId()}"/>
                <input type="hidden" name="patientId" value="{$smarty.session.patientId}"/>
            
                <div class="row">
                    <div class="medium-12 end columns">
                        <label><span class="required">{Messages::i18n("patientAllergyForm.allergyTypeId")}</span>
                            <select tabindex="1" id="allergyTypeId" name="allergyTypeId"  required>
                                {html_options options=$allergyTypeIds selected=$patientAllergy->getAllergyTypeId()}
                            </select>
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="medium-12 end columns">
                        <label><span class="required">{Messages::i18n("patientAllergyForm.allergen")}</span>
                            <input tabindex="2" type="text"  maxlength="45" id="allergen" name="allergen" value="{$patientAllergy->getAllergen()}" required>
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="medium-12 end columns">
                        <label><span class="">{Messages::i18n("patientAllergyForm.notes")}</span>
                            <textarea tabindex="3" cols="20" rows="3" style="resize:none;" name="notes" id="notes">{$patientAllergy->getNotes()}</textarea>
                        </label>
                    </div>
                </div>

                <div class="row">
                    <div class="medium-4 end columns" style="padding-top:8px;">
                        <a href="/patient/allergy" tabindex="5" class="reset">{Messages::i18n("link.reset")}</a>&nbsp;
                        {ElementTag::submitBtn(4)}
                    </div>
                    {if $patientAllergy->getId() != ''}
                        <div class="medium-4 end columns" style="padding-top:8px;">
                            {Messages::i18n("checkbox.confirm")}&nbsp;<input tabindex="6" id="confirmDelete" type="checkbox"/>
                            {ElementTag::deleteBtn(7, "/patient/allergy/delete/`$patientAllergy->getId()`")}
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
                    <th>{Messages::i18n("patientAllergyForm.allergyTypeId")}</th> 
                    <th>{Messages::i18n("patientAllergyForm.allergen")}</th>
                    <th>{Messages::i18n("patientAllergyForm.notes")}</th>
                    <th width="10%">&nbsp;</th>
                    
                </tr>
            </thead>
            <tbody>
                {foreach from=$list item=pa} 
                    <tr>                           
                        <td>{$pa->getAllergyType()->getLabel()}</td> 
                        <td>{$pa->getAllergen()}</td>
                        <td>{$pa->getNotes()}</td>
                        <td>
                            <a class="editRow" title="{Messages::i18n("link.edit")}" href="/patient/allergy/edit/{$pa->getId()}">
                                <i class='fas fa-edit' style='font-size:1.5rem;color:#008cba;'></i>
                            </a>
                        </td>
                    </tr>
                {/foreach}
            </tbody>
        </table> 
    {else}
        <div class="emptyListMessage">
            {Messages::i18n("patientAllergyForm.empty.list.message")}
        </div>
    {/if}
    <br/><br/>


{/nocache}
{/block}