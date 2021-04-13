{*Author: Randal Neptune*}
{*Project: Self-Health*}

{extends file="base/body.tpl"}

{block name=jquery}
    {literal}
        $("div.table-toolbar").html("{/literal}{Messages::i18n("covid19VaxForm.recorded.list")}{literal}").css({
            "margin-left" : "26px",
            "font-family": "'Poppins', sans-serif",
            "font-size" : "1.2rem",
            "font-weight" : 500,
            "color": "#464646"
        });
        
        $("#dateReceived").datepicker({
            format:"M dd, yyyy",
            autoclose: true,
            clearBtn: true,
            endDate: '0d'
        }).data("datepicker");
        
        $("#covid19VaccineId").chosen().change(function() {
            var id = $(this).val();
            if (id != '') {
                $.ajax({
                    url: "/ajax/covid19/dose/count/" + id,
                    type:"GET",
                    dataType: "json"
                }).done(function(doseAmount) {
               
                    var doseNumbers = '<option value=""></option>';
                    for (var x = 1; x <= doseAmount; x++) {
                        doseNumbers += '<option value="'+x+'">'+x+'</option>';
                    }
                    $("#doseNumber").html(doseNumbers);
                });
            } else{
                $("#doseNumber").html('<option value=""></option>');
            }
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
        {Messages::i18n("covid19VaxForm.legend")}
    </div>
    {if $smarty.session.patientId|trim != ''}
        <div style="margin-left:15px;margin-top:2px;width:80%;">
            <form data-abide name="covid19VaxForm" id="covid19VaxForm" action="{$actionPage}" method="POST" autocomplete="off">
                <input type="hidden" name="id" value="{$covid19Vax->getId()}"/>
                <input type="hidden" name="patientId" value="{$smarty.session.patientId}"/>
            
                <div class="row">
                    <div class="medium-12 end columns">
                        <label><span class="required">{Messages::i18n("covid19VaxForm.covid19VaccineId")}</span>
                            <select tabindex="1" id="covid19VaccineId" name="covid19VaccineId"  required>
                                {html_options options=$covid19VaccineIds selected=$covid19Vax->getCovid19VaccineId()}
                            </select>
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="medium-12 end columns">
                        <label><span class="required">{Messages::i18n("covid19VaxForm.doseNumber")}</span><br/>
                            <select style="width:50px !important;" tabindex="2" id="doseNumber" name="doseNumber" required>
                                {html_options options=$doseNumbers selected=$covid19Vax->getDoseNumber()}
                            </select>
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="medium-12 end columns">
                        <label><span class="required">{Messages::i18n("covid19VaxForm.dateReceived")}</span>
                            <input type="text" class="medium" tabindex="3" name="dateReceived" id="dateReceived" placeholder="dd/mm/yyyy" value="{$covid19Vax->displayDateReceived()}" required/>
                        </label>
                    </div>
                </div>

                <div class="row">
                    <div class="medium-4 end columns" style="padding-top:8px;">
                        <a href="/patient/covid19/vaccination/form" tabindex="5" class="reset">{Messages::i18n("link.reset")}</a>&nbsp;
                        {ElementTag::submitBtn(4)}
                    </div>
                    {if $covid19Vax->getId() != ''}
                        <div class="medium-4 end columns" style="padding-top:8px;">
                            {Messages::i18n("checkbox.confirm")}&nbsp;<input tabindex="6" id="confirmDelete" type="checkbox"/>
                            {ElementTag::deleteBtn(7, "/patient/covid19/vaccination/delete/`$covid19Vax->getId()`")}
                        </div>
                    {/if}
                </div>

            </form> 
        </div> 
        <div>
            <hr width="96%" style="margin:10px 2px 7px 2px;"/>
        </div>
    {/if}                    
    {if $list|count gt 0}
        <br/>
        <table align="left" id="listTable" class="displayTable" width="95%" cellspacing="0">
            <thead>
                <tr>
                    <th>{Messages::i18n("covid19VaxForm.covid19VaccineId")}</th> 
                    <th>{Messages::i18n("covid19VaxForm.doseNumber")}</th>
                    <th>{Messages::i18n("covid19VaxForm.dateReceived")}</th>
                    <th width="10%">&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                {foreach from=$list item=pvax} 
                    <tr>                           
                        <td>{$pvax->getCovid19Vaccine()->getLabel()}</td> 
                        <td>{$pvax->getDoseNumber()}</td>
                        <td>{$pvax->displayDateReceived()}</td>
                        <td>
                            <a class="editRow" title="{Messages::i18n("link.edit")}" href="/patient/covid19/vaccination/edit/{$pvax->getId()}">
                                <i class='fas fa-edit' style='font-size:1.5rem;color:#008cba;'></i>
                            </a>
                        </td>
                    </tr>
                {/foreach}
            </tbody>
        </table> 
    {else}
        <div class="emptyListMessage">
            {Messages::i18n("covid19VaxForm.empty.list.message")}
        </div>
    {/if}
    <br/><br/>


{/nocache}
{/block}
