{*Author: Randal Neptune*}
{*Project: EduRecord*}

{extends file="base/body.tpl"}

{block name=jquery}
    {literal}
        $("div.table-toolbar").html("{/literal}{Messages::i18n("patientPhysicalActivityForm.recorded.list")}{literal}").css({
            "margin-left" : "26px",
            "font-family": "'Poppins', sans-serif",
            "font-size" : "1.2rem",
            "font-weight" : 500,
            "color": "#464646"
        });
        
        $("#datePerformed").datepicker({
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
        
        $("#timeStarted").timepicki(timePickiOptions);
        $("#physicalActivityId").chosen();
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
        {Messages::i18n("patientPhysicalActivityForm.legend")}
    </div>
    {if $smarty.session.patientId|trim != ''}
        <div style="margin-left:15px;margin-top:2px;width:80%;">
            <form data-abide name="patientPhysicalActivityForm" id="patientPhysicalActivityForm" action="{$actionPage}" method="POST" autocomplete="off">
                <input type="hidden" name="id" value="{$patientPhysicalActivity->getId()}"/>
                <input type="hidden" name="patientId" value="{$smarty.session.patientId}"/>
            <div class="row">
                <div class="medium-12 end columns">
                <ul class="medium-block-grid-2 small-block-grid-1">
                    <li>
                        <div class="row">
                            <div class="medium-12 end columns">
                                <label><span class="required">{Messages::i18n("patientPhysicalActivityForm.physicalActivityId")}</span>
                                    <select tabindex="1" id="physicalActivityId" name="physicalActivityId" required>
                                        {html_options options=$physicalActivityIds selected=$patientPhysicalActivity->getPhysicalActivityId()}
                                    </select>
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="medium-12 end columns">
                                <label><span class="required">{Messages::i18n("patientPhysicalActivityForm.datePerformed")}</span>
                                    <input tabindex="2" type="text" class="medium" id="datePerformed" name="datePerformed" value="{$patientPhysicalActivity->displayDatePerformed()}" required>
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="medium-12 end columns">
                                <label><span class="">{Messages::i18n("patientPhysicalActivityForm.timeStarted")}</span>
                                    <input tabindex="3" class="medium" type="text" id="timeStarted" name="timeStarted" value="{$patientPhysicalActivity->getTimeStarted()}">
                                </label>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="row">
                            <div class="medium-12 end columns">
                                <label><span class="required">{Messages::i18n("patientPhysicalActivityForm.durationInMinutes")}</span>
                                    <input tabindex="4"  type="text" class="medium" maxlength="3" id="durationInMinutes" name="durationInMinutes" value="{$patientPhysicalActivity->getDurationInMinutes()}" required>
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="medium-12 end columns">
                                <label><span class="">{Messages::i18n("patientPhysicalActivityForm.notes")}</span>
                                    <textarea tabindex="5" id="notes" rows="3" style="resize:none;" name="notes" >{$patientPhysicalActivity->getNotes()}</textarea>
                                </label>
                            </div>
                        </div>
                </ul>
            </div>
                                </div>
            <div class="row">
                <div class="medium-4 end columns" style="padding-top:8px;">
                    <a href="/patient/physical/activity" tabindex="7" class="reset">{Messages::i18n("link.reset")}</a>&nbsp;
                    {ElementTag::submitBtn(6)}
                </div>
                {if $patientPhysicalActivity->getId() != ''}
                    <div class="medium-4 end columns" style="padding-top:8px;">
                        {Messages::i18n("checkbox.confirm")}&nbsp;<input tabindex="8" id="confirmDelete" type="checkbox"/>
                        {ElementTag::deleteBtn(9, "/patient/physical/activity/delete/`$patientPhysicalActivity->getId()`")}
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
                    <th>{Messages::i18n("patientPhysicalActivityForm.physicalActivityId")}</th> 
                    <th>{Messages::i18n("patientPhysicalActivityForm.durationInMinutes")}</th>
                    <th>{Messages::i18n("patientPhysicalActivityForm.datePerformed")}</th>
                    <th>{Messages::i18n("patientPhysicalActivityForm.timeStarted")}</th>
                    <th>{Messages::i18n("patientPhysicalActivityForm.notes")}</th>
                    <th width="10%">&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                {foreach from=$list item=ppa} 
                    <tr>                           
                        <td>{$ppa->getPhysicalActivity()->getLabel()}</td> 
                        <td>{$ppa->getDurationInMinutes()}</td>
                        <td>{$ppa->displayDatePerformed()}</td>
                        <td>{$ppa->displayTimeStarted()}</td>
                        <td>{$ppa->getNotes()}</td>
                        <td>
                            <a class="editRow" title="{Messages::i18n("link.edit")}" href="/patient/physical/activity/edit/{$ppa->getId()}">
                                <i class='fas fa-edit' style='font-size:1.5rem;color:#008cba;'></i>
                            </a>
                        </td>
                    </tr>
                {/foreach}
            </tbody>
        </table> 
    {else}
        <div class="emptyListMessage">
            {Messages::i18n("patientPhysicalActivityForm.empty.list.message")}
        </div>
    {/if}
    <br/><br/>


{/nocache}
{/block}
