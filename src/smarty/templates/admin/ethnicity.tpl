{*Author: Randal Neptune*}
{*Project: SARMS*}

{extends file="base/body.tpl"}

{block name=jquery}
    {literal}
        $("div.table-toolbar").html("{/literal}{Messages::i18n("ethnicityForm.recorded.list")}{literal}").css({
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
    {Messages::i18n("ethnicityForm.legend")}
</div>
<div style="margin-left:15px;margin-top:2px;">
    <form data-abide name="ethnicityForm" id="ethnicityForm" action="{$actionPage}" method="POST" autocomplete="off">
   
        <input type="hidden" name="id" value="{$ethnicity->getId()}"/>
        <div class="row">
            <div class="medium-4 end columns">
                <label><span class="required">Ethnicity</span>
                    <input tabindex="1" autofocus type="text" id="name" name="name" value="{$ethnicity->getName()}" placeholder="Enter a name" required>
                </label>
            </div>
        </div>
        <div class="row">
            <div class="medium-4 end columns">
                <a href="/ethnicity" tabindex="3" class="reset">Reset</a>&nbsp;
                <input tabindex="2" type="submit" name="submit" class="button" value="Save"/>
            </div>
            {if $ethnicity->getId() != ''}
                <div class="medium-4 end columns">
                    Confirm&nbsp;<input tabindex="4" id="confirmDelete" type="checkbox"/>
                    <input tabindex="5" disabled="disabled" onclick="window.location.href='/ethnicity/delete/{$ethnicity->getId()}';" type="button" name="delete" class="delete button alert" value="Delete"/>
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
                <th>Ethnicity</th> 
                <th width="10%">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            {foreach from=$list item=ethn} 
                <tr>                           
                    <td>{$ethn->getName()}</td> 
                    <td>
                        <a title="{Messages::i18n("link.edit")}" class="editRow" href="/ethnicity/edit/{$ethn->getId()}"></a>
                    </td>
                </tr>
            {/foreach}
        </tbody>
    </table> 
{else}
    <div class="emptyListMessage">{Messages::i18n("ethnicityForm.empty.list.message")}</div>
{/if}
<br/><br/>


{/nocache}

{/block}
