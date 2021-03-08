{*Author: Randal Neptune*}
{*Project: EduRecord*}

{extends file="base/body.tpl"}


{block name=content} 
{nocache}
    
{$msg}

    <form data-abide name="genderForm" id="countryForm" action="{$actionPage}" method="POST" autocomplete="off">
        <fieldset style="width:66%;">
            <legend>{Messages::i18n("genderForm.legend")}</legend>
            <input type="hidden" name="id" value="{$gender->getId()}"/>
            <div class="row">
                <div class="medium-4 end columns">
                    <label><span class="required">{Messages::i18n("genderForm.name")}</span>
                        <input tabindex="1" autofocus type="text" id="name" name="name" maxlength="20" value="{$gender->getName()}" placeholder="" required>
                    </label>
                </div>
            </div>
            <div class="row">
                <div class="medium-4 end columns">
                    <a  tabindex="3" href="/gender" class="reset">{Messages::i18n("link.reset")}</a>&nbsp;
                    {ElementTag::submitBtn(2)}
                </div>
                {if $gender->getId() != ''}
                    <div class="medium-4 end columns">
                        {Messages::i18n("checkbox.confirm")}&nbsp;<input tabindex="4" id="confirmDelete" type="checkbox"/>
                        {ElementTag::deleteBtn(5, "/gender/delete/`$gender->getId()`")}
                    </div>
                {/if}
            </div>
        </fieldset>
    </form> 
            


{if $list|count gt 0}
    <div class="listTableCaption">{Messages::i18n("genderForm.recorded.list")}</div> 
    <table align="left" id="listTable" class="displayTable" width="66%" cellspacing="0">
        <thead>
            <tr>
                <th>{Messages::i18n("genderForm.name")}</th> 
                <th width="10%">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            {foreach from=$list item=gen} 
                <tr>                           
                    <td>{$gen->getName()}</td> 
                    <td>
                        {if $smarty.session.isAdmin}
                            <a  title="{Messages::i18n("link.edit")}" class="editRow" href="/gender/edit/{$gen->getId()}">
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
        {Messages::i18n("genderForm.empty.list.message")}
    </div>
{/if}

{/nocache}

{/block}
