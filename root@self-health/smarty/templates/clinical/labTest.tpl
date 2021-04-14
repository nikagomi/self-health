{*Author: Randal Neptune*}
{*Project: EduRecord*}

{extends file="base/body.tpl"}

{block name=jquery}
    {literal}
        $("div.table-toolbar").html("{/literal}{Messages::i18n("labTestForm.recorded.list")}{literal}").css({
            "margin-left" : "26px",
            "font-family": "'Poppins', sans-serif",
            "font-size" : "1.2rem",
            "font-weight" : 500,
            "color": "#464646"
        });
    {/literal}
{/block}

{block name=dataTable}
    {literal}
        'iDisplayLength':25,
        paging: true,
        "dom": "<'row'<'large-4 medium-4 columns collapsed table-toolbar'><'large-3 medium-3 columns collapsed'l><'large-4 medium-4 columns end small-text-left medium-text-right collapsed 'f>>"+
            "t"+
            "<'row'<'small-12 medium-6 columns'><'small-12 medium-6 columns'p>>"
    {/literal}
{/block}

{block name=content}
    {nocache}
    {$msg}
    
    <div class="listTableCaption_simpleTable" style="font-variant:normal;font-weight: 500;margin-top:2px;margin-bottom:2px;color:#414042;font-family:'Poppins', sans-serif;font-size:1.3rem;">
        {Messages::i18n("labTestForm.legend")}
    </div>
    <div style="margin-left:15px;margin-top:2px;">
        <form data-abide name="labTestForm" id="labTestForm" action="{$actionPage}" method="POST" autocomplete="off">

                <input type="hidden" name="id" value="{$labTest->getId()}"/>
                <div class="row">
                    <div class="medium-3 end columns">
                        <label><span class="required">{Messages::i18n("labTestForm.name")}</span>
                            <input tabindex="1" class="medium" autofocus type="text" id="name" name="name" value="{$labTest->getName()}" placeholder="" required>
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="medium-3 end columns">
                        <label><span class="required">{Messages::i18n("labTestForm.unit")}</span>
                            <input tabindex="2" class="medium" maxlength="10" type="text" id="unit" name="unit" value="{$labTest->getUnit()}" required>
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="medium-3 end columns">
                        <label><span class="">{Messages::i18n("labTestForm.numeric")}</span>
                            <div class="switch"  style="padding-bottom:2px;margin-bottom: 2px;"> 
                                <input name="numeric" id="numeric" tabindex="3" type="checkbox" value="1" {if $labTest->isNumeric()} checked {/if}> 
                                <label for="numeric"></label> 
                            </div> 
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="medium-3 end columns" style="padding-top:8px;">
                        <a href="/lab/test/form" tabindex="5" class="reset">{Messages::i18n("link.reset")}</a>&nbsp;
                        {ElementTag::submitBtn(4)}
                    </div>
                    {if $labTest->getId() != ''}
                        <div class="medium-3 end columns" style="padding-top:8px;">
                            {Messages::i18n("checkbox.confirm")}&nbsp;<input tabindex="6" id="confirmDelete" type="checkbox"/>
                            {ElementTag::deleteBtn(7, "/lab/test/delete/`$labTest->getId()`")}
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
                <th>{Messages::i18n("labTestForm.name")}</th> 
                <th>{Messages::i18n("labTestForm.unit")}</th> 
                <th>{Messages::i18n("labTestForm.numeric")}</th> 
                <th width="10%">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            {foreach from=$list item=lt} 
                <tr>                           
                    <td>{$lt->getName()}</td>
                    <td>{$lt->getUnit()}</td> 
                    <td>{DbMapperUtility::booleanYesNo($lt->isNumeric())}</td> 
                    <td>
                        <a class="editRow" title="{Messages::i18n("link.edit")}" href="/lab/test/edit/{$lt->getId()}">
                            <i class='fas fa-edit' style='font-size:1.5rem;color:#008cba;'></i>
                        </a>
                    </td>
                </tr>
            {/foreach}
        </tbody>
    </table> 
{else}
    <div class="emptyListMessage">
        {Messages::i18n("labTestForm.empty.list.message")}
    </div>
{/if}
<br/><br/>


{/nocache}
{/block}
