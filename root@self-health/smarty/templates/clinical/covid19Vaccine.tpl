{*Author: Randal Neptune*}
{*Project: EduRecord*}

{extends file="base/body.tpl"}

{block name=jquery}
    {literal}
        $("div.table-toolbar").html("{/literal}{Messages::i18n("covid19VaccineForm.recorded.list")}{literal}").css({
            "margin-left" : "26px",
            "font-family": "'Poppins', sans-serif",
            "font-size" : "1.1rem",
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
        {Messages::i18n("covid19VaccineForm.legend")}
    </div>
    <div style="margin-left:15px;margin-top:2px;">
        <form data-abide name="covid19VaccineForm" id="covid19VaccineForm" action="{$actionPage}" method="POST" autocomplete="off">

                <input type="hidden" name="id" value="{$covid19Vaccine->getId()}"/>
                <div class="row">
                    <div class="medium-3 end columns">
                        <label><span class="required">{Messages::i18n("covid19VaccineForm.manufacturer")}</span>
                            <input tabindex="1" autofocus type="text" id="manufacturer" name="manufacturer" value="{$covid19Vaccine->getManufacturer()}" placeholder="" required>
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="medium-3 end columns">
                        <label><span class="required">{Messages::i18n("covid19VaccineForm.doseAmount")}</span>
                            <input tabindex="2" class="short" maxlength="1" type="text" id="doseAmount" name="doseAmount" value="{$covid19Vaccine->getDoseAmount()}" required>
                        </label>
                    </div>
                </div>
               
                <div class="row">
                    <div class="medium-3 end columns" style="padding-top:8px;">
                        <a href="/covid19/vaccine/form" tabindex="4" class="reset">{Messages::i18n("link.reset")}</a>&nbsp;
                        {ElementTag::submitBtn(3)}
                    </div>
                    {if $covid19Vaccine->getId() != ''}
                        <div class="medium-3 end columns" style="padding-top:8px;">
                            {Messages::i18n("checkbox.confirm")}&nbsp;<input tabindex="5" id="confirmDelete" type="checkbox"/>
                            {ElementTag::deleteBtn(6, "/covid19/vaccine/delete/`$covid19Vaccine->getId()`")}
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
                <th>{Messages::i18n("covid19VaccineForm.manufacturer")}</th> 
                <th>{Messages::i18n("covid19VaccineForm.doseAmount")}</th> 
                <th width="10%">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            {foreach from=$list item=cv} 
                <tr>                           
                    <td>{$cv->getManufacturer()}</td>
                    <td>{$cv->getDoseAmount()}</td> 
                    <td>
                        <a class="editRow" title="{Messages::i18n("link.edit")}" href="/lcovid19/vaccine/edit/{$cv->getId()}">
                            <i class='fas fa-edit' style='font-size:1.5rem;color:#008cba;'></i>
                        </a>
                    </td>
                </tr>
            {/foreach}
        </tbody>
    </table> 
{else}
    <div class="emptyListMessage">
        {Messages::i18n("covid19VaccineForm.empty.list.message")}
    </div>
{/if}
<br/><br/>


{/nocache}
{/block}

