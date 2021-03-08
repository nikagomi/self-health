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
        
        .remove_disabled {
            color: #AAAAAA;
        }
        
        .remove_active {
            color: #FF0000;;
        }
        
        
       
    {/literal}
{/block}

{block name=jquery}
    {literal}
        $("div.table-toolbar").html('Recorded Questions');
        
        $(function(){
            $(".hotspot").tipTip({maxWidth: "400px", edgeOffset: 3, defaultPosition: "top", delay: 200, fadeOut: 400});
        });
        
        /*************************************************************************
         Associating a question to the survey
        **************************************************************************/
        $("body").on("click","input[type='checkbox'].qrow",function(e) {//Assuming that it will be disabled after check
            var self = $(this);
            var parTr = $(this).closest("tr");
            var parTd = $(this).closest("td");
           
            var questionId = $(this).val();
            var surveyId = $("#id").val();
            $.ajax({
                url: "/ajax/associate/survey/question",
                type: "POST",
                dataType: "json",
                data: {surveyId: surveyId, questionId: questionId}
            }).done(function(data){
                if (data) {
                    parTr.find("td:last").find(".fa-minus-square").removeClass("remove_disabled").addClass("remove_active");
                    self.prop("disabled", true).css("display","none");
                    parTd.append('<i class="fas fa-check-circle" style="color:#006432;font-size:1.3rem;"></i>');
                } else {
                    swal("Error","Could not associate question to survey due to an error.","error");
                }
            });
        });
        
        /*************************************************************************
         Removing a question from the survey
        **************************************************************************/
        $("body").on("click",".remove_active",function(e) {
            var self = $(this);
            var parTr = $(this).closest("tr");
            var parTd = $(this).closest("td");
            var questionId = $(this).attr("data-id");
            var surveyId = $("#id").val();
            $.ajax({
                url: "/ajax/associate/survey/question/remove",
                type: "POST",
                dataType: "json",
                data: {surveyId: surveyId, questionId: questionId}
            }).done(function(data){
                if (data) {
                    self.removeClass("remove_active").addClass("remove_disabled");
                    parTr.find("input[type='checkbox']").prop("disabled", false).prop("checked", false).css("display","inline-block");
                    parTr.find('.fa-check-circle').remove();
                } else {
                    //Suppress for now because of the select all
                    //swal("Error","An error occurred. Could not remove question from survey.","error");
                }
            });
        });
        
        /********************************************
         Select all checkboxes
        *********************************************/
        $("#selectAll").click(function(){
            if ($(this).prop("checked")) {
                $("table.displayTable > tbody").find("input[type='checkbox']:visible").each(function(){
                    $(this).prop("checked", true).trigger("click");
                });
            }
        });
    {/literal}
{/block}

{block name=dataTable}
    {literal}
        "paging":false,
        info: false,
        searching:true,
        "dom": "<'row'<'col-sm-12 col-md-4 table-toolbar'><'col-sm-12 col-md-3'l><'col-sm-12 col-md-4 text-right'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        "columnDefs": [{ 
            orderable: false, 
            targets: [0,3]
        }]
    {/literal}
{/block}

{block name=content}
    {nocache}
        {$msg}
            <div style="font-size: 1.3rem;font-weight:500;color:#5c5c5c;">Add Questions to Survey</div>
            
                <input type="hidden" id="id" value="{$survey->getId()}"/>
                <div class="row">
                    <div class="medium-3 end columns text-right">
                        <label>
                            <span class="">Survey Identifier:</span>
                        </label>
                    </div>
                    <div class="medium-3 end columns">
                        <label class="infoLabel">
                            {$survey->getIdentifier()}
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="medium-3 end columns text-right">
                        <label>
                            <span class="">Survey Year:</span>
                        </label>
                    </div>
                    <div class="medium-3 end columns">
                        <label class="infoLabel">
                            {$survey->getYear()}
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="medium-3 end columns text-right">
                        <label>
                            <span class="">Survey Title:</span>
                        </label>
                    </div>
                    <div class="medium-9 end columns">
                        <label class="infoLabel">
                            {$survey->getTitle()}
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="medium-3 end columns text-right">
                        <label>
                            <span class="">&nbsp;</span>
                        </label>
                    </div>
                    <div class="medium-3 end columns">
                        <label class="">
                            <a href='/survey/form' style="font-weight:normal;color:#008cba;font-size:1rem;font-family:'Poppins',sans-serif;">
                                return to surveys
                            </a>
                        </label>
                    </div>
                    <div class="medium-3 end columns">
                        <label class="">
                            <a href='/survey/preview/{$survey->getId()}' style="font-weight:normal;color:#008cba;font-size:1rem;font-family:'Poppins',sans-serif;">
                                preview survey
                            </a>
                        </label>
                    </div>
                </div>
        <hr style="margin: 15px 0px 8px 0px;color:#5c5c5c;" width="100%" />      

    {if $questions|count gt 0}
        <br/>
        <table align="left" style="margin-left: 1px !important;" id="listTable" class="displayTable" width="99%" cellspacing="0">
            <thead>
                <tr>
                    <th style="text-align:center;vertical-align:middle;" width='10%'><input type="checkbox" id="selectAll"/></th> 
                    <th width='65%'>Question</th>
                    <th width="15%">Type</th>
                    <th width="15%">&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                {foreach from=$questions item=q} 
                    <tr>                           
                        <td style="text-align:center;">
                            <input class="qrow" type="checkbox" value="{$q->getId()}" {if DbMapperUtility::isObjectInArray($q, $surveyQuestions)} checked disabled style='display:none;'{/if}/>
                            {if DbMapperUtility::isObjectInArray($q, $surveyQuestions)} <i class="fas fa-check-circle" style="color:#006432;font-size:1.3rem;"></i>{/if}
                        </td> 
                        <td>{$q->getQuestionText()}</td>
                        <td>{$q->getQuestionType()->getName()}</td>
                        <td style="text-align:center;">
                            <i class='fas fa-minus-square {if DbMapperUtility::isObjectInArray($q, $surveyQuestions)} remove_active {else} remove_disabled {/if}' data-id="{$q->getId()}" style="font-family: 'Poppins', sans-serif; font-size:1.4rem;"></i> 
                        </td>
                     </tr>
                {/foreach}
            </tbody>
        </table> 
    {/if}
    <br/><br/>
    {/nocache}
{/block}
