{extends file="base/body.tpl"}


{block name=jquery}
    {literal}

        
    {/literal}
{/block}



{block name=content}

{nocache}
{$msg}

{if $smarty.session.isAdmin}
    <form data-abide name="titleForm" id="titleForm" action="{$actionPage}" method="POST" autocomplete="on">
        <fieldset style="width:66%;">
            <legend>{Messages::i18n("titleForm.legend")}</legend>
            <input type="hidden" name="id" value="{$titulo->getId()}"/>
            <div class="row">
                <div class="medium-4 end columns">
                    <label><span class="required">{Messages::i18n("titleForm.name")}</span>
                        <input tabindex="1" autofocus type="text" name="name" id="name" value="{$titulo->getName()}" placeholder="{Messages::i18n("text.example")}: Mr.,Sr., Ms., etc." required/>
                    </label>
                </div>
            </div>
            <div class="row">
                <div class="medium-4 end columns">
                    <a tabindex="3" href="/title" class="reset">{Messages::i18n("link.reset")}</a>&nbsp;
                    {ElementTag::submitBtn(2)}
                </div>
                {if $titulo->getId() != ''}
                    <div class="medium-4 end columns">
                        {Messages::i18n("checkbox.confirm")}&nbsp;<input tabindex="4" id="confirmDelete" type="checkbox"/>
                        {ElementTag::deleteBtn(5, "/title/delete/`$titulo->getId()`")}
                    </div>
                {/if}
            </div>
        </fieldset>
    </form>
{/if}                          


{if $list|count gt 0}
    <div class="listTableCaption">{Messages::i18n("titleForm.recorded.list")}</div> 

    <table align="left" id="listTable" class="displayTable" width="66%" style="margin-left:10px;margin-top:10px;" cellspacing="0">
        <thead>
            <tr>
                <th>{Messages::i18n("titleForm.name")}</th> 
                <th width="10%">&nbsp;</th>
            </tr>
        </thead>
        <tbody>

            {foreach from=$list item=ts} 
                <tr >                           
                    <td>{$ts->getName()}</td> 
                    <td>
                        {if $smarty.session.isAdmin}
                            <a title="{Messages::i18n("link.edit")}" class="editRow" href="/title/edit/{$ts->getId()}">
                                <i class='fas fa-edit' style='font-size:1.5rem;color:#008cba;'></i>
                            </a>
                        {/if}
                    </td>
                </tr>
            {/foreach}
        </tbody>
    </table> 
{else}
    <div class="emptyListMessage">
        {Messages::i18n("titleForm.empty.list.message")}
    </div>
{/if}

{/nocache}
{/block}