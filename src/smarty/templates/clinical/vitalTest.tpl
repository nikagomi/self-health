{*Author: Randal Neptune*}
{*Project: EduRecord*}

{extends file="base/body.tpl"}

{block name=jquery}
    {literal}
        $("div.table-toolbar").html("{/literal}{Messages::i18n("vitalTestForm.recorded.list")}{literal}").css({
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
        paging: true,
        order:[[7,"asc"]],
        "dom": "<'row'<'large-4 medium-4 columns collapsed table-toolbar'><'large-7 medium-7 columns end small-text-left medium-text-right collapsed 'f>>"+
            "t"+
            "<'row'<'small-12 medium-6 columns'><'small-12 medium-6 columns'p>>"
    {/literal}
{/block}

{block name=content}
    {nocache}
    {$msg}
    
    <div class="listTableCaption_simpleTable" style="font-variant:normal;font-weight: 500;margin-top:2px;margin-bottom:2px;color:#414042;font-family:'Poppins', sans-serif;font-size:1.3rem;">
        {Messages::i18n("vitalTestForm.legend")}
    </div>
    <div style="margin-left:15px;margin-top:2px;">
        <form data-abide name="vitalTestForm" id="vitalTestForm" action="{$actionPage}" method="POST" autocomplete="off">

                <input type="hidden" name="id" value="{$vitalTest->getId()}"/>
                <div class="row">
                    <div class="medium-3 end columns">
                        <label><span class="required">{Messages::i18n("vitalTestForm.name")}</span>
                            <input tabindex="1" class="medium" autofocus type="text" id="name" name="name" value="{$vitalTest->getName()}" placeholder="" required>
                        </label>
                    </div>
                    <div class="medium-3 end columns">
                        <label><span class="required">{Messages::i18n("vitalTestForm.abbreviation")}</span>
                            <input tabindex="2" class="short" maxlength="5" type="text" id="abbreviation" name="abbreviation" value="{$vitalTest->getAbbreviation()}" required>
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="medium-3 end columns">
                        <label><span class="required">{Messages::i18n("vitalTestForm.unit")}</span>
                            <input tabindex="3" class="medium" maxlength="10" type="text" id="unit" name="unit" value="{$vitalTest->getUnit()}" required>
                        </label>
                    </div>
                    <div class="medium-3 end columns">
                        <label><span class="">{Messages::i18n("vitalTestForm.numeric")}</span>
                            <div class="switch"  style="padding-bottom:2px;margin-bottom: 2px;"> 
                                <input name="numeric" id="numeric" tabindex="4" type="checkbox" value="1" {if $vitalTest->isNumeric()} checked {/if}> 
                                <label for="numeric"></label> 
                            </div> 
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="medium-3 end columns">
                        <label><span class="">{Messages::i18n("vitalTestForm.bpTest")}</span>
                            <div class="switch" style="padding-bottom:2px;margin-bottom: 5px;"> 
                                <input name="bpTest" id="bpTest" tabindex="5" type="checkbox" value="1" {if $vitalTest->isBpTest()} checked {/if}> 
                                <label for="bpTest"></label> 
                            </div> 
                        </label>
                    </div>
                    <div class="medium-3 end columns">
                        <label><span class="">{Messages::i18n("vitalTestForm.bpTestOrder")}</span><br/>
                            <select name="bpTestOrder" id="bpTestOrder" style="width:100px;" tabindex="6">
                                {html_options options=$componentOrder selected=$vitalTest->getBpTestOrder()}
                            </select>
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="medium-3 end columns">
                        <label><span class="">{Messages::i18n("vitalTestForm.bmiHeightComponent")}</span>
                            <div class="switch" style="padding-bottom:2px;margin-bottom: 5px;"> 
                                <input name="bmiHeightComponent" id="bmiHeightComponent" tabindex="5" type="checkbox" value="1" {if $vitalTest->isBmiHeightComponent()} checked {/if}> 
                                <label for="bmiHeightComponent"></label> 
                            </div> 
                        </label>
                    </div>
                    <div class="medium-3 end columns">
                        <label><span class="">{Messages::i18n("vitalTestForm.bmiWeightComponent")}</span>
                            <div class="switch" style="padding-bottom:2px;margin-bottom: 5px;"> 
                                <input name="bmiWeightComponent" id="bmiWeightComponent" tabindex="5" type="checkbox" value="1" {if $vitalTest->isBmiWeightComponent()} checked {/if}> 
                                <label for="bmiWeightComponent"></label> 
                            </div> 
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="medium-3 end columns">
                        <label><span class="required">{Messages::i18n("vitalTestForm.sortOrder")}</span>
                            <input tabindex="7" class="short" maxlength="4" type="text" id="sortOrder" name="sortOrder" value="{$vitalTest->getSortOrder()}" required>
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="medium-3 end columns" style="padding-top:8px;">
                        <a href="/vital/test/form" tabindex="9" class="reset">{Messages::i18n("link.reset")}</a>&nbsp;
                        {ElementTag::submitBtn(8)}
                    </div>
                    {if $vitalTest->getId() != ''}
                        <div class="medium-3 end columns" style="padding-top:8px;">
                            {Messages::i18n("checkbox.confirm")}&nbsp;<input tabindex="10" id="confirmDelete" type="checkbox"/>
                            {ElementTag::deleteBtn(11, "/vital/test/delete/`$vitalTest->getId()`")}
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
                <th>{Messages::i18n("vitalTestForm.name")}</th> 
                <th>{Messages::i18n("vitalTestForm.abbreviation")}</th> 
                <th>{Messages::i18n("vitalTestForm.unit")}</th> 
                <th>{Messages::i18n("vitalTestForm.numeric")}</th> 
                <th>{Messages::i18n("vitalTestForm.bpTest")}</th> 
                <th>{Messages::i18n("vitalTestForm.bmiHeightComponent")}</th> 
                <th>{Messages::i18n("vitalTestForm.bmiWeightComponent")}</th> 
                <th>{Messages::i18n("vitalTestForm.sortOrder")}</th> 
                <th width="10%">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            {foreach from=$list item=vt} 
                <tr>                           
                    <td>{$vt->getName()}</td>
                    <td>{$vt->getAbbreviation()}</td> 
                    <td>{$vt->getUnit()}</td> 
                    <td>{DbMapperUtility::booleanYesNo($vt->isNumeric())}</td> 
                    <td>
                        {DbMapperUtility::booleanYesNo($vt->isBpTest())}
                        {if $vt->isBpTest()}
                            <span style="font-size:0.85rem;">&nbsp;[BP - {$vt->getBpTestOrder()}]</span>
                        {/if}
                    </td> 
                    <td>{DbMapperUtility::booleanYesNo($vt->isBmiHeightComponent())}</td>
                    <td>{DbMapperUtility::booleanYesNo($vt->isBmiWeightComponent())}</td>
                    <td>{$vt->getSortOrder()}</td> 
                    <td>
                        <a class="editRow" title="{Messages::i18n("link.edit")}" href="/vital/test/edit/{$vt->getId()}">
                            <i class='fas fa-edit' style='font-size:1.5rem;color:#008cba;'></i>
                        </a>
                        {*    &ensp;
                        <a  title="Define reference ranges" href="">
                            result ranges
                        </a>*}
                    </td>
                </tr>
            {/foreach}
        </tbody>
    </table> 
{else}
    <div class="emptyListMessage">
        {Messages::i18n("vitalTestForm.empty.list.message")}
    </div>
{/if}
<br/><br/>


{/nocache}
{/block}
