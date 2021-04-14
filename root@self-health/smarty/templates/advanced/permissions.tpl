{*Author: Randal Neptune*}
{*Project: EduRecord*}

{extends file="base/body.tpl"}

{block name=jquery}
    {literal}
        $("form").find("select").chosen();
        
        $("#categoryId").chosen().change(function(){
            if ($(this).val() != '') {
            
                $.ajax({
                    url:"/get/level/one/menu/"+$(this).val(),
                    type: "GET"
                    
                }).done(function(result){
                    var opts = "";
                    if (result.length > 0) {
                        opts += "<option value=''>Please select</option>";
                        
                        for (var i = 0; i < result.length; i++) {
                            opts += "<option value='"+result[i].id+"'>"+result[i].label+"</option>";
                        }
                    } else {
                        opts += "<option value=''>No submenus available</option>";
                    }
                    
                    $("#level1Id").html(opts).trigger("chosen:updated");
                }).fail(function(xhr, status, error){
                    swal("Operation Error", status + ': ' + error, "error");
                });
            } else {
                $("#level1Id").html("").trigger("chosen:updated");
            }
        
        });
    {/literal}
{/block}

{block name=styles}
    {literal}
        /* max-width 640px, mobile-only styles, use when QAing mobile issues */
        @media only screen and (max-width: 40em) { 
            div#inputs{
                width: 100%;
            }
        } 

        /* min-width 641px, medium screens */
        @media only screen and (min-width: 40.063em) { 
            div#inputs{
                width: 70%;
            }
        } 
    {/literal}
{/block}

{block name=dataTable}
    {literal}
        'iDisplayLength':100
    {/literal}
{/block}

{block name=content}
    {nocache}

{$msg}

{if $smarty.session.isAdmin && $user->isSystem()}
        <form data-abide name="permissionForm" id="permissionForm" action="{$actionPage}" method="POST" autocomplete="off">
            <fieldset style="width:76%;">
                <legend>{Messages::i18n("legend.manage.permissions")}</legend>
                    <input type="hidden" name="id" value="{$permission->getId()}"/>   
                    <div id="inputs">
                    <ul class="medium-block-grid-2 small-block-grid-1">
                        <li>
                            {*<div class="row" >
                                <div class="medium-12 end columns">
                                    <label><span class="required">{Messages::i18n("form.label.submenu.name")}</span>
                                        <input type="text" tabindex=1" name="submenuName" id="submenuName" value="{$permission->getSubmenuName()}" required />
                                    </label>
                                </div>
                            </div>*}
                            <div class="row" >
                                <div class="medium-12 end columns">
                                    <label><span class="required">{Messages::i18n("form.label.submenu.name.key")}</span>
                                        <input tabindex="1" type="text" tabindex="" name="submenuNameKey" id="submenuNameKey" value="{$permission->getSubmenuNameKey()}" required />
                                    </label>
                                </div>
                            </div>
                            <div class="row collapsed" >
                                <div class="medium-12 end columns">
                                    <label><span>{Messages::i18n("form.label.url")}</span>
                                        <input type="text" tabindex="3" name="url" id="url" value="{$permission->getUrl()}"/>
                                    </label>
                                </div>
                            </div>
                            <div class="row collapsed" >
                                <div class="medium-12 end columns">
                                    <label><span class="required">{Messages::i18n("form.label.category")}</span>
                                       <select tabindex="5" name="categoryId" id="categoryId" required>
                                            {html_options options=$categories selected=$permission->getCategoryId()}
                                        </select>
                                    </label>
                                </div>
                            </div>
                            <div class="row collapsed" >
                                <div class="medium-12 end columns">
                                    <label><span>{Messages::i18n("form.label.menu.level")}</span>
                                        <select tabindex="6" name="level" id="level">
                                            <option value=""></option>
                                            <option value="1" {if $permission->getLevel() == 1} selected {/if}>1</option>
                                            <option value="2" {if $permission->getLevel() == 2} selected {/if}>2</option>
                                        </select>
                                    </label>
                                </div>
                            </div>
                            <div class="row collapsed">
                                <div class="medium-12 end columns">
                                    <label><span>{Messages::i18n("form.label.parent.level")}</span>
                                        <select tabindex="7" name="level1Id" id="level1Id">
                                            {html_options options=DbMapperUtility::convertObjectArrayToDropDown($permission->getSubmenusByCategory($permission->getCategoryId())) selected=$permission->getLevel1Id()}
                                        </select>
                                    </label>
                                </div>
                            </div>
                        </li>
                        <li>
                            {*<div class="row" >
                                <div class="medium-12 end columns">
                                    <label><span class="required">{Messages::i18n("form.label.permission.text")}</span>
                                        <input type="text" tabindex="6" name="permText" id="permtext" value="{$permission->getPermText()}" required />
                                    </label>
                                </div>
                            </div>*}
                            <div class="row collapsed " >
                                <div class="medium-12 end columns">
                                    <label><span class="required">{Messages::i18n("form.label.permission.text.key")}</span>
                                        <input type="text" tabindex="2" name="permTextKey" id="permTextKey" value="{$permission->getPermTextKey()}" required />
                                    </label>
                                </div>
                            </div>
                            <div class="row" >
                                <div class="medium-12 end columns">
                                    <label><span>{Messages::i18n("form.label.constant")}</span>
                                        <input type="text" tabindex="4" name="constant" value="{$permission->getConstant()}" id="constant" />
                                    </label>
                                </div>
                            </div>
                            <div class="row" >
                                <div class="medium-12 end columns">
                                    <label><span>{Messages::i18n("form.label.is.menu")}</span>
                                        <div class="switch"> 
                                            <input tabindex="8" name="isMenu" id="isMenu" type="checkbox" value="1" {if $permission->getIsMenu()} checked {/if}> 
                                            <label for="isMenu"></label> 
                                        </div> 
                                    </label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="medium-12 end  columns">
                                   <label><span>{Messages::i18n("form.label.is.container")}</span>
                                        <div class="switch"> 
                                            <input tabindex="9" name="isContainer" id="isContainer" type="checkbox" value="1" {if $permission->getIsContainer()} checked {/if}> 
                                            <label for="isContainer"></label> 
                                        </div> 
                                    </label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="medium-12 end columns">
                                    <label><span>{Messages::i18n("form.label.comments")}</span>
                                        <textarea tabindex="10" cols="10" rows="4" wrap="physical" id="comments" name="comments">{$permission->getComments()}</textarea>
                                    </label>
                                </div>
                            </div>
                        </li>
                    </ul>
                    </div>  
                    <div class="row">
                        <div class="medium-12 columns">
                          <hr width="100%" size="2" color="#D0E0F0"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="medium-4 end columns">
                            <a tabindex="11" href="/advanced/app/permissions" class="reset">Reset</a>
                            {ElementTag::submitBtn(12)}
                        </div>
                        {if $permission->getId() != ''}  
                            <div class="medium-4 end columns">
                                {Messages::i18n("checkbox.confirm")}&nbsp;<input tabindex="13" id="confirmDelete" type="checkbox"/>
                                {ElementTag::deleteBtn(14, "/advanced/app/permissions/delete/`$permission->getId()`")}
                            </div>
                        {/if}
                    </div>
            </fieldset>
        </form> 

        {if $list|count gt 0}
            <div class="listTableCaption">{Messages::i18n("recorded.banner.permissions")}</div>
            <table align="left" id="" class="listTable displayTable" width="98%" cellspacing="0">
                <thead>
                   <tr>
                       <th width="20%">{Messages::i18n("header.submenu.name.key")}</th>
                       <th width="25%">{Messages::i18n("header.url")}</th>

                       <th width="30%">{Messages::i18n("header.permission.text.key")}</th>
                       <th width="10%">{Messages::i18n("header.constant")}</th>

                       <th width="5%">{Messages::i18n("header.is.menu")}</th>
                       <th width="5%">{Messages::i18n("header.is.container")}</th>
                       <th width="5%" class="all">&nbsp;</th>
                   </tr>
                </thead>
                <tbody>
                    {foreach from=$list item=perm} 
                        <tr>                           
                            <td>{$perm->getSubmenuNameKey()}</td> 
                            <td>{$perm->getUrl()}</td> 

                            <td>{$perm->getPermTextKey()}</td> 

                            <td>{$perm->getConstant()}</td> 

                            <td>{DbMapperUtility::booleanYesNo($perm->getIsMenu())}</td>
                            <td>{DbMapperUtility::booleanYesNo($perm->getIsContainer())}</td>
                            <td>
                                <div>
                                    <a  title="{Messages::i18n("link.edit")}" class="editRow" href="/advanced/app/permissions/edit/{$perm->getId()}">
                                        <i class='fas fa-edit' style='font-size:1.5rem;color:#008cba;'></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    {/foreach}
                </tbody>
            </table> 
        {else}
            <div align="left" class="emptyListMessage">{Messages::i18n("empty.list.app.permissions")}</div>
        {/if}
{else}
    <div align="left" class="errorMessage">{Messages::i18n("permissionForm.not.sufficent.permissions")}</div>
{/if}


{/nocache}
{/block}
