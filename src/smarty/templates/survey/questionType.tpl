{*Author: Randal Neptune*}
{*Project: OECS*}

{extends file="base/body.tpl"}

{block name=jquery}
    {literal}
        $("div.table-toolbar").html('Recorded Question Types');
    {/literal}
{/block}

{block name=dataTable}
    {literal}
        "paging":false,
        info: false,
        searching: false,
        "dom": "<'row'<'col-sm-12 col-md-4 table-toolbar'><'col-sm-12 col-md-3'l><'col-sm-12 col-md-4 text-right'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>"
    {/literal}
{/block}

{block name=content}
    {nocache}
        {$msg}
            <div style="font-size: 1.3rem;font-weight:500;color:#5c5c5c;">Manage Question Types</div>
            <form data-abide name="questionTypeForm" id="questionTypeForm" action="{$actionPage}" method="POST" autocomplete="off">
            
                <input type="hidden" name="id" value="{$questionType->getId()}"/>
                <div class="row">
                    <div class="medium-4 end columns">
                        <label><span class="required">Name</span>
                            <input tabindex="1" autofocus type="text" id="name" name="name" value="{$questionType->getName()}" placeholder="Enter a name" required>
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="medium-4 end columns">
                        <label><span class="required">Constant</span>
                            <input tabindex="2" type="text" id="constant" name="constant" value="{$questionType->getConstant()}" required>
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="medium-4 end columns">
                        <a href="/question/type/form" tabindex="4" class="reset">Reset</a>&nbsp;
                        {ElementTag::submitBtn(3)}
                    </div>
                    {if $questionType->getId() != ''}
                        <div class="medium-4 end columns">
                            Confirm&nbsp;<input tabindex="5" id="confirmDelete" type="checkbox"/>
                            {ElementTag::deleteBtn(6, "/question/type/delete/`$questionType->getId()`")}
                        </div>
                    {/if}
                </div>
           
        </form> 
        <hr style="margin: 15px 0px 8px 0px;color:#5c5c5c;" width="100%" />      

    {if $list|count gt 0}
        <br/>
        <table align="left" style="margin-left: 1px !important;" id="listTable" class="displayTable" width="66%" cellspacing="0">
            <thead>
                <tr>
                    <th>Name</th> 
                    <th>Constant</th>
                    <th width="10%">&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                {foreach from=$list item=qt} 
                    <tr>                           
                        <td>{$qt->getName()}</td> 
                        <td>{$qt->getConstant()}</td>
                        <td>
                            <a title="{Messages::i18n("link.edit")}" class="editRow" href="/question/type/edit/{$qt->getId()}">
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
