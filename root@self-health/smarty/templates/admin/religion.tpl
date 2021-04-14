{*Author: Randal Neptune*}
{*Project: EduRecord*}

{extends file="base/body.tpl"}

{block name=jquery}
    {literal}
        $("div.table-toolbar").html("{/literal}{Messages::i18n("religionForm.recorded.list")}{literal}").css({
            "margin-left" : "17px",
            "font-family": "'Poppins', sans-serif",
            "font-size" : "1.2rem",
            "font-weight" : 500,
            "color": "#464646"
        });
    {/literal}
{/block}

{block name=dataTable}
    {literal}
        "paging":false,
        "dom": "<'row'<'small-12 medium-3 columns table-toolbar'><'small-12 medium-5 columns end text-left'f>>"+
            "t"+
            "<'row'<'small-12 medium-6 columns'><'small-12 medium-6 columns'p>>"
    {/literal}
{/block}

{block name=content}
{nocache}
    
{$msg}

<div class="listTableCaption_simpleTable" style="font-variant:normal;font-weight: 500;margin-top:2px;margin-bottom:2px;color:#414042;font-family:'Poppins', sans-serif;font-size:1.3rem;">
    {Messages::i18n("religionForm.legend")}
</div>
<div style="margin-left:15px;margin-top:2px;">
    <form data-abide name="religionForm" id="religionForm" action="{$actionPage}" method="POST" autocomplete="off">

            <input type="hidden" name="id" value="{$religion->getId()}"/>
            <div class="row">
                <div class="medium-4 end columns">
                    <label><span class="required">{Messages::i18n("religionForm.name")}</span>
                        <input tabindex="1" autofocus type="text" id="name" name="name" value="{$religion->getName()}" placeholder="" required>
                    </label>
                </div>
            </div>
            <div class="row">
                <div class="medium-4 end columns">
                    <a href="/religion" tabindex="3" class="reset">{Messages::i18n("link.reset")}</a>&nbsp;
                    <input tabindex="2" type="submit" name="submit" class="button" value="{Messages::i18n("link.save")}"/>
                </div>
                {if $religion->getId() != ''}
                    <div class="medium-4 end columns">
                        {Messages::i18n("checkbox.confirm")}&nbsp;<input tabindex="4" id="confirmDelete" type="checkbox"/>
                        <input tabindex="5" disabled="disabled" onclick="window.location.href='/religion/delete/{$religion->getId()}';" type="button" name="delete" class="delete button alert" value="{Messages::i18n("link.delete")}"/>
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
                <th>{Messages::i18n("religionForm.name")}</th> 
                <th width="10%">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            {foreach from=$list item=rel} 
                <tr>                           
                    <td>{$rel->getName()}</td> 
                    <td>
                        <a title="{Messages::i18n("link.edit")}" class="editRow" href="/religion/edit/{$rel->getId()}"></a>
                    </td>
                </tr>
            {/foreach}
        </tbody>
    </table> 
{else}
    <div class="emptyListMessage">
        {Messages::i18n("religionForm.empty.list.message")}
    </div>
{/if}
<br/><br/>


{/nocache}
{/block}
