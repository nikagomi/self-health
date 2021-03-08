{*Author: Randal Neptune*}
{*Project: OECS*}

{extends file="base/body.tpl"}

{block name=jquery}
    {literal}
        $("div.table-toolbar").html('Recorded Indicators');
    {/literal}
{/block}

{block name=dataTable}
    {literal}
        "paging":false,
        info: false,
        searching: true,
        "dom": "<'row'<'col-sm-12 col-md-4 table-toolbar'><'col-sm-12 col-md-3'f><'col-sm-12 col-md-4 text-right'>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>"
    {/literal}
{/block}

{block name=content}
    {nocache}
        {$msg}
            <div style="font-size: 1.3rem;font-weight:500;color:#5c5c5c;">Manage Question Indicators</div>
            <form data-abide name="indicatorForm" id="indicatorForm" action="{$actionPage}" method="POST" autocomplete="off">
            
                <input type="hidden" name="id" value="{$indicator->getId()}"/>
                <div class="row">
                    <div class="medium-4 end columns">
                        <label><span class="required">Name</span>
                            <input tabindex="1" autofocus type="text" id="name" name="name" value="{$indicator->getName()}" placeholder="Enter a name" required>
                        </label>
                    </div>
                </div>
                
                <div class="row">
                    <div class="medium-4 end columns">
                        <a href="/indicator/form" tabindex="3" class="reset">Reset</a>&nbsp;
                        {ElementTag::submitBtn(2)}
                    </div>
                    {if $indicator->getId() != ''}
                        <div class="medium-4 end columns">
                            Confirm&nbsp;<input tabindex="4" id="confirmDelete" type="checkbox"/>
                            {ElementTag::deleteBtn(5, "/indicator/delete/`$indicator->getId()`")}
                        </div>
                    {/if}
                </div>
           
        </form> 
        <hr style="margin: 15px 0px 8px 0px;color:#5c5c5c;" width="100%" />      

    {if $list|count gt 0}
        <br/>
        <table align="left" style="margin-left: 1px !important;" id="listTable" class="displayTable" width="70%" cellspacing="0">
            <thead>
                <tr>
                    <th>Name</th> 
                    <th width="10%">&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                {foreach from=$list item=ind} 
                    <tr>                           
                        <td>{$ind->getName()}</td> 
                        <td>
                            <a title="{Messages::i18n("link.edit")}" class="editRow" href="/indicator/edit/{$ind->getId()}">
                                <i class='fas fa-edit' style='font-size:1.5rem;color:#008cba;'></i>
                            </a>
                        </td>

                    </tr>
                {/foreach}
            </tbody>
        </table> 
    {else}
        {*<div class="emptyListMessage">No ethnicities have been recorded.</div>*}
    {/if}
    <br/><br/>
    {/nocache}
{/block}
