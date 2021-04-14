{*Author: Randal Neptune*}
{*Project: Self-Health*}

{extends file="base/body.tpl"}

{block name=jquery}
    {literal}
        $("div.table-toolbar").html("{/literal}{Messages::i18n("medicationForm.recorded.list")}{literal}").css({
            "margin-left" : "26px",
            "font-family": "'Poppins', sans-serif",
            "font-size" : "1.2rem",
            "font-weight" : 500,
            "color": "#464646"
        });
        
        $("#pharmaceuticalId").chosen();
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
        {Messages::i18n("medicationForm.legend")}
    </div>
    <div style="margin-left:15px;margin-top:2px;">
        <form data-abide name="medicationForm" id="medicationForm" action="{$actionPage}" method="POST" autocomplete="off">


                <input type="hidden" name="id" value="{$medication->getId()}"/>
                <div class="row">
                    <div class="medium-4 end columns">
                        <label><span class="required">{Messages::i18n("medicationForm.pharmaceuticalId")}</span>
                            <select tabindex="1" id="pharmaceuticalId" name="pharmaceuticalId" value="{$medication->getPharmaceuticalId()}" required>
                                {html_options options=$pharmaceuticalIds selected=$medication->getPharmaceuticalId()}
                            </select>
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="medium-4 end columns">
                        <label><span class="required">{Messages::i18n("medicationForm.dosage")}</span>
                            <input tabindex="2" maxlength="20" type="text" id="dosage" name="dosage" value="{$medication->getDosage()}" placeholder="" required>
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="medium-4 end columns" style="padding-top:8px;">
                        <a href="/medication" tabindex="4" class="reset">{Messages::i18n("link.reset")}</a>&nbsp;
                        {ElementTag::submitBtn(3)}
                    </div>
                    {if $medication->getId() != ''}
                        <div class="medium-4 end columns" style="padding-top:8px;">
                            {Messages::i18n("checkbox.confirm")}&nbsp;<input tabindex="5" id="confirmDelete" type="checkbox"/>
                            {ElementTag::deleteBtn(6, "/medication/delete/`$medication->getId()`")}
                        </div>
                    {/if}
                </div>

        </form> 
    </div>       

{if $list|count gt 0}
    <br/>
    <table align="left" id="listTable" class="displayTable" width="95%" cellspacing="0">
        <thead>
            <tr>
                <th>{Messages::i18n("medicationForm.pharmaceuticalId")}</th> 
                <th>{Messages::i18n("medicationForm.dosage")}</th>
                <th width="10%">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            {foreach from=$list item=med} 
                <tr>                           
                    <td>{$med->getPharmaceutical()->getLabel()}</td> 
                    <td>{$med->getDosage()}</td> 
                    <td>
                        <a class="editRow" title="{Messages::i18n("link.edit")}" href="/medication/edit/{$med->getId()}">
                            <i class='fas fa-edit' style='font-size:1.5rem;color:#008cba;'></i>
                        </a>
                    </td>
                </tr>
            {/foreach}
        </tbody>
    </table> 
{else}
    <div class="emptyListMessage">
        {Messages::i18n("medicationForm.empty.list.message")}
    </div>
{/if}
<br/><br/>


{/nocache}
{/block}


