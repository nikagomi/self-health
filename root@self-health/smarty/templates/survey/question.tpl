{*Author: Randal Neptune*}
{*Project: OECS*}

{extends file="base/body.tpl"}

{block name=styles}
    {literal}
        #listTable {
            padding-top: 0px !important;
            margin-top: 0px !important;
        }
        
        .row{
            margin-bottom: 0px !important;
        }
        
        .block, .permBloc{
            margin-left: 25px;
            margin-top:10px;
        }
        
        .block li{
            padding: 0px;
        }
        
        li > label {
            color: #555 !important;
            font-size: 1rem;
        }
        
        #err {
            color: #DD0000;
            font-family: 'Poppins', sans-serif;
            font-size: 1rem;
            font-weight: 400;
        }
        
        .sectionHead{
            font-weight: 400;
            font-family:  'Poppins', sans-serif;
            font-size: 1.1rem;
            color: #777;
        }
        
        textarea {
            font-family: 'Poppins', sans-serif;
            font-size: 1rem;
        }
       
    {/literal}
{/block}

{block name=jquery}
    {literal}
        $("div.table-toolbar").html('Recorded Questions');
        
        $("#questionTypeId").chosen();
        
        $(function(){
            $(".hotspot").tipTip({maxWidth: "400px", edgeOffset: 3, defaultPosition: "top", delay: 200, fadeOut: 400});
        });
        
        /*$("#questionForm").submit(function(e){
            if ($('input[name="ind[]"][type="checkbox"]').length > 0 && $('input[name="ind[]"]:checked').length == 0) {
                e.preventDefault();
                $("div#err").html("Please associate at least one(1) indicator to this question");
            } else {
                $("div#err").html("");
            }
        });*/
    {/literal}
{/block}

{block name=dataTable}
    {literal}
        "paging":true,
        info: true,
        searching:true,
        "dom": "<'row'<'col-sm-12 col-md-4 table-toolbar'><'col-sm-12 col-md-3'l><'col-sm-12 col-md-4 text-right'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
    {/literal}
{/block}

{block name=content}
    {nocache}
        {$msg}
            <div style="font-size: 1.3rem;font-weight:500;color:#5c5c5c;">Manage Survey Questions</div>
            <form data-abide name="questionForm" id="questionForm" action="{$actionPage}" method="POST" autocomplete="off" style="width:100% !important;">
            
                <input type="hidden" name="id" value="{$question->getId()}"/>
                <div class="row">
                    <div class="medium-4 end columns">
                        <label><span class="required">Question Type</span>
                            {if $question->getNumberOfOptions()|count gt 0 && !$question->IsIdEmpty()}
                                <select tabindex="1"  id="questionTypeId" disabled>
                                    {html_options options=$questionTypes selected=$question->getQuestionTypeId()}
                                </select>
                                <input type="hidden" name="questionTypeId" value="{$question->getQuestionTypeId()}" />
                            {else}
                                <select tabindex="1" name="questionTypeId" id="questionTypeId" required>
                                    {html_options options=$questionTypes selected=$question->getQuestionTypeId()}
                                </select>
                            {/if}

                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="medium-6 columns">
                        <label style="width:100% !important;"><span class="required">Question Text</span>
                            <textarea cols="20" rows="2" wrap="soft" name="questionText" id='questionText' placeholder="Define the question" required>{$question->getQuestionText()}</textarea>
                        </label>
                    </div>
                </div>
                {*<div class="row">
                    <div class="medium-6 end columns">
                        <label style="width:100% !important;"><span class="">Descriptive tooltip/hint</span>
                            <textarea cols="20" rows="2" wrap="soft" name="tooltipDescription">{$question->getTooltipDescription()}</textarea>
                        </label>
                    </div>
                </div>*}
                {if $indicators|count gt 0}
                    <div class="row">
                        <div class="medium-12 columns">
                            <span class="sectionHead ">Indicators</span>
                        </div>
                    </div>
                    <div class="">
                        <ul class="large-block-grid-4 medium-block-grid-4 small-block-grid-2 block">
                            {html_checkboxes separator='' name='ind' selected=$questionIndicators options=$indicators assign='indOpts'}
                            {foreach from=$indOpts item=indOpt}
                                <li>{$indOpt}</li>
                            {/foreach}
                        </ul>
                    </div>       
                {/if}
                {*<ul class="medium-block-grid-3 small-block-grid-1 block">
                    {if $indicators|count eq 1}
                        <input type="hidden" name="ind[]" id="ind_{$indicators[0]->getId()}" value="{$indicators[0]->getId()}"/>
                    {elseif $indicators|count gt 1}    
                        {foreach from=$indicators item=indicator}
                            <li>
                                <input type="checkbox" name="ind[]" id="ind_{$indicator->getId()}" value="{$indicator->getId()}" {if $indicator->getId()|in_array:$questionIndicators} checked {/if}/>
                                {$indicator->getName()}
                            </li>
                        {/foreach}
                    {/if}
                </ul>*}
                <div class="row">
                    <div class="medium-4 end columns">
                        <a href="/question/form" tabindex="5" class="reset">Reset</a>&nbsp;
                        {ElementTag::submitBtn(4)}
                    </div>
                    {if $question->getId() != '' && $question->getNumberOfOptions()|count eq 0}
                        <div class="medium-4 end columns">
                            Confirm&nbsp;<input tabindex="6" id="confirmDelete" type="checkbox"/>
                            {ElementTag::deleteBtn(7, "/question/delete/`$question->getId()`")}
                        </div>
                    {/if}
                </div>
                <div class="row">
                    <div class="medium-8 end columns medium-push-4">
                        <div id="err"></div>
                    </div>
                </div>
        </form> 
        <hr style="margin: 15px 0px 8px 0px;color:#5c5c5c;" width="100%" />      

    {if $list|count gt 0}
        <br/>
        <table align="left" style="margin-left: 1px !important;" id="listTable" class="displayTable" width="99%" cellspacing="0">
            <thead>
                <tr>
                    <th width='50%'>Question</th> 
                    <th width='15%'>Question Type</th>
                    <th width='18%'>Indicators</th>
                    {*<th width='30%'>Descriptive tooltip/hint</th>*}
                    <th width="10%">&nbsp;</th>
                    <th width="7%">&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                {foreach from=$list item=ques} 
                    <tr>                           
                        <td>{$ques->getQuestionText()}</td> 
                        <td>{$ques->getQuestionType()->getName()}</td>
                        <td>{$ques->getIndicatorList()}</td>
                       {* <td>{$ques->getTooltipDescription()}</td>*}
                        <td>
                            {if $ques->getQuestionType()->needsChoiceDefinition()}
                                <a title="Define question options"  href="/question/option/form/{$ques->getId()}" style='color:#008cba;'>
                                    Options
                                </a>
                                {if $ques->getNumberOfOptions()|count gt 0}
                                    <span title="<b>Options:</b><br/>{$ques->getOptionListHTML()}" class="hotspot">
                                        ({$ques->getNumberOfOptions()})
                                    </span>
                                {/if}
                            {else}
                                &nbsp;
                            {/if}
                        </td>
                        <td>
                            <a title="{Messages::i18n("link.edit")}" class="editRow" href="/question/edit/{$ques->getId()}">
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
