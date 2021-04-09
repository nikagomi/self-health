{*Author: Randal Neptune*}
{*Project: Self-Health*}

{extends file="base/body.tpl"}

{block name=jquery}
    {literal}
        $("div.table-toolbar").html("{/literal}{Messages::i18n("patientMedicationForm.recorded.list")}{literal}").css({
            "margin-left" : "26px",
            "font-family": "'Poppins', sans-serif",
            "font-size" : "1.2rem",
            "font-weight" : 500,
            "color": "#464646"
        });
        
        $("#dateTaken").datepicker({
            format:"M dd, yyyy",
            autoclose: true,
            clearBtn: true,
            endDate: '0d',
            highlightToday: true,
            todayBtn: true
        }).data("datepicker");
        
        var timePickiOptions = {
            tincrease_direction: 'up',
            disable_keyboard_mobile: true
        };
        
        $("#timeTaken").timepicki(timePickiOptions);
        $("#medicationId, #quantityUnitId").chosen();
        
        $("div.medDateRangeFilter").css({"color":"#666666","font-size":"0.9rem"}).html('<span style="float:left;display:inline-block;padding-top:8px;">Date Filter:&nbsp;</span><input type="text" class="short" style="float:left;width:110px !important;" id="rmin" /><span style="float:left;display:inline-block;padding-top:8px;">&nbsp;-&nbsp;</span><input type="text" style="float:left;width:110px !important;"  class="short" id="rmax" />');
        $("#rmin, #rmax").datepicker({
            format:"M dd, yyyy", 
            clearBtn:true,
            autoclose: true
        }).on('changeDate', function (ev) {
            medTable.draw();
        }).data('datepicker');
        
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
        {Messages::i18n("patientMedicationForm.legend")}
    </div>
    {if $smarty.session.patientId|trim != ''}
        <div style="margin-left:15px;margin-top:2px;width:80%;">
            <form data-abide name="patientMedicationForm" id="patientMedicationForm" action="{$actionPage}" method="POST" autocomplete="off">
                <input type="hidden" name="id" value="{$patientMedication->getId()}"/>
                <input type="hidden" name="patientId" value="{$smarty.session.patientId}"/>
            <div class="row">
                <div class="medium-12 end columns">
                    <ul class="medium-block-grid-2 small-block-grid-1">
                        <li>
                            <div class="row">
                                <div class="medium-12 end columns">
                                    <label><span class="required">{Messages::i18n("patientMedicationForm.medicationId")}</span>
                                        <select tabindex="1" id="medicationId" name="medicationId"  required>
                                            {html_options options=$medicationIds selected=$patientMedication->getMedicationId()}
                                        </select>
                                    </label>
                                </div>
                            </div>
                            <div class="row" style="margin-bottom:8px;">
                                <div class="medium-12 end columns" style="">
                                    <label>
                                        <span class="">{Messages::i18n("patientMedicationForm.quantityConsumed")}</span>
                                    </label><br/>
                                    <input tabindex="2" type="text" class="short" maxlength="2" id="quantityAmount" name="quantityAmount" value="{$patientMedication->getQuantityAmount()}" style="float:left;display:inline-block;margin-right:5px;"/>
                                    <select tabindex="3" name="quantityTakenUnitId" id="quantityTakenUnitId" class="" style="float:left;display:inline-block;width:170px;">
                                        {html_options options=$quantityTakenUnitIds selected=$patientMedication->getQuantityTakenUnitId()}
                                    </select>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="row">
                                <div class="medium-12 end columns">
                                    <label><span class="required">{Messages::i18n("patientMedicationForm.dateTaken")}</span>
                                        <input tabindex="4" type="text" class="medium" id="dateTaken" name="dateTaken" value="{$patientMedication->displayDateTaken()}" required>
                                    </label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="medium-12 end columns">
                                    <label><span class="">{Messages::i18n("patientMedicationForm.timeTaken")}</span>
                                        <input tabindex="5" class="medium" type="text" id="timeTaken" name="timeTaken" value="{$patientMedication->getTimeTaken()}">
                                    </label>
                                </div>
                            </div>

                        </li>   
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="medium-4 end columns">
                    <label><span class="">{Messages::i18n("patientMedicationForm.comments")}</span>
                        <textarea tabindex="6" id="comments" rows="3" style="resize:none;" name="comments" >{$patientMedication->getComments()}</textarea>
                    </label>
                </div>
            </div>
            
            <div class="row">
                <div class="medium-4 end columns" style="padding-top:8px;">
                    <a href="/patient/medication" tabindex="8" class="reset">{Messages::i18n("link.reset")}</a>&nbsp;
                    {ElementTag::submitBtn(7)}
                </div>
                {if $patientMedication->getId() != ''}
                    <div class="medium-4 end columns" style="padding-top:8px;">
                        {Messages::i18n("checkbox.confirm")}&nbsp;<input tabindex="9" id="confirmDelete" type="checkbox"/>
                        {ElementTag::deleteBtn(10, "/patient/medication/delete/`$patientMedication->getId()`")}
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
        <table align="left" id="medTable" class="displayTable" width="95%" cellspacing="0">
            <thead>
                <tr>
                    <th>{Messages::i18n("patientMedicationForm.medicationId")}</th> 
                    <th>{Messages::i18n("patientMedicationForm.quantityConsumed")}</th>
                    <th>{Messages::i18n("patientMedicationForm.dateTaken")}</th>
                    <th>{Messages::i18n("patientMedicationForm.timeTaken")}</th>
                    <th>{Messages::i18n("patientMedicationForm.comments")}</th>
                    <th width="10%">&nbsp;</th>
                    <th class="never">&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                {foreach from=$list item=pmed} 
                    <tr>                           
                        <td>{$pmed->getMedication()->getLabel()}</td> 
                        <td>{$pmed->getQuantityAmount()} {$pmed->getQuantityTakenUnit()->getLabel()}</td>
                        <td>{$pmed->displayDateTaken()}</td>
                        <td>{$pmed->displayTimeTaken()}</td>
                        <td>{$pmed->getComments()}</td>
                        <td>
                            <a class="editRow" title="{Messages::i18n("link.edit")}" href="/patient/medication/edit/{$pmed->getId()}">
                                <i class='fas fa-edit' style='font-size:1.5rem;color:#008cba;'></i>
                            </a>
                        </td>
                        <td>{$pmed->getDateTaken()|strtotime}</td>
                    </tr>
                {/foreach}
            </tbody>
        </table> 
    {else}
        <div class="emptyListMessage">
            {Messages::i18n("patientMedicationForm.empty.list.message")}
        </div>
    {/if}
    <br/><br/>


{/nocache}
{/block}

{block name="auxScripts"}
    {literal}
        $.fn.dataTable.ext.search.push(
            function (settings, data, dataIndex) {
                var min = ($.trim($('#rmin').val()) != '') ? moment($('#rmin').val(), "MMM D, YYYY") : null;
                var max = ($.trim($('#rmax').val()) != '') ? moment($('#rmax').val(), "MMM D, YYYY") : null;
                var startDate = moment(data[2], "MMM D, YYYY");

                if (min == null && min == null) { return true; }
                if (min == null && startDate.isSameOrBefore(max)) { return true;}
                if (max == null && startDate.isSameOrAfter(min)) {return true;}
                if (startDate.isSameOrBefore(max) && startDate.isSameOrAfter(min)) { return true; }
                return false;
            }
        );

        var medTable = $("#medTable").DataTable({
            "paging":true,
            "iDisplayLength": 100,
            responsive: true,
            "dom": "<'row'<'medium-3 columns show-for-medium-up'l><'medium-8 columns end text-right medDateRangeFilter'>>"+
                "t"+
                "<'row'<'small-12 medium-7 text-left columns end'p>>",
            order: [
                [0, 'asc'], [2, 'desc']
            ],
            'columnDefs': [
                { 'orderData':[6], 
                  'targets': [2], 
                },
                {
                  'targets': [6],
                  'visible': false,
                  'searchable': false,
                },
                {
                    className: 'control',
                    orderable: false,
                    targets:   '0'
                }
            ]
        });

        /*************  Column header filter  ************/
        sarmsHeaderDataTableColumnFilterMulti(medTable, [0]);

         
    {/literal}
{/block}