{*Author: Randal Neptune*}
{*Project: EduRecord*}

{extends file="base/body.tpl"}

{block name=jquery}
    {literal}
        $("div.table-toolbar").html("{/literal}{Messages::i18n("mealTypeForm.recorded.list")}{literal}").css({
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
        {Messages::i18n("mealTypeForm.legend")}
    </div>
    <div style="margin-left:15px;margin-top:2px;">
        <form data-abide name="mealTypeForm" id="mealTypeForm" action="{$actionPage}" method="POST" autocomplete="off">


                <input type="hidden" name="id" value="{$mealType->getId()}"/>
                <div class="row">
                    <div class="medium-4 end columns">
                        <label><span class="required">{Messages::i18n("mealTypeForm.name")}</span>
                            <input tabindex="1" autofocus maxlength="40" type="text" id="name" name="name" value="{$mealType->getName()}" placeholder="" required>
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="medium-4 end columns" style="padding-top:8px;">
                        <a href="/meal/type" tabindex="3" class="reset">{Messages::i18n("link.reset")}</a>&nbsp;
                        {ElementTag::submitBtn(2)}
                    </div>
                    {if $mealType->getId() != ''}
                        <div class="medium-4 end columns" style="padding-top:8px;">
                            {Messages::i18n("checkbox.confirm")}&nbsp;<input tabindex="4" id="confirmDelete" type="checkbox"/>
                            {ElementTag::deleteBtn(5, "/meal/type/delete/`$mealType->getId()`")}
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
                <th>{Messages::i18n("mealTypeForm.name")}</th> 
                <th width="10%">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            {foreach from=$list item=mt} 
                <tr>                           
                    <td>{$mt->getName()}</td> 
                    <td>
                        <a class="editRow" title="{Messages::i18n("link.edit")}" href="/meal/type/edit/{$mt->getId()}">
                            <i class='fas fa-edit' style='font-size:1.5rem;color:#008cba;'></i>
                        </a>
                    </td>
                </tr>
            {/foreach}
        </tbody>
    </table> 
{else}
    <div class="emptyListMessage">
        {Messages::i18n("mealTypeForm.empty.list.message")}
    </div>
{/if}
<br/><br/>


{/nocache}
{/block}
