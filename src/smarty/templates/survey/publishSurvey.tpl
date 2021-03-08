{*Author: Randal Neptune*}
{*Project: OECS*}

{extends file="base/body.tpl"}

{block name=scripts}
    {literal}
        function updateSortOrder () {
            var ids = [];
            var orders = [];
            
            //Reset the sort orders and populate the arrays
            $("div.questionHolder").each(function(index) {
                $(this).find("input.sortOrder").val(index + 1);
                ids.push($(this).find("input.questionId").val());
                orders.push(index + 1);
                $(this).find("span.so").text((index + 1) + ".");
            });

            $.ajax({
                url: "/ajax/survey/question/update/sort/order",
                type: "POST",
                dataType: "json",
                data: {surveyId: $("#id").val(), ids: ids.join(","), orders: orders.join(",")}
            }).done(function(data){
                console.log("Transaction was successful?" + data);
            });
        }
    {/literal}
{/block}

{block name=styles}
    {literal}
        div.questionHolder {
            margin-bottom: 20px !important;
        }
    {/literal}
{/block}

{block name=jquery}
    {literal}
        $(function(){
            $(".hotspot").tipTip({maxWidth: "400px", edgeOffset: 3, defaultPosition: "top", delay: 200, fadeOut: 400});
        });
        
        
        
    {/literal}
{/block}

{block name=dataTable}
    {literal}
       
    {/literal}
{/block}

{block name=content}
    {nocache}
        <div class="row">
            <div class="small-10 columns end text-right" style="margin-top:1px;padding-top:1px;">
                <a style="font-family:'Poppins', sans-serif;font-size:1rem;color:#008cba;" href="/survey/publish/{$surveyId}">Publish</a>
            </div>
            <div class="small-2 columns end text-right" style="margin-top:1px;padding-top:1px;">
                <a style="font-family:'Poppins', sans-serif;font-size:1rem;color:#008cba;" href="/survey/form">Surveys List</a>
            </div>
        </div>
        <div style="padding-left:20px;">
            <img src="/images/OECS_Logo_Desktop.png" alt="OECS Desktop Logo"/>
        </div>
         <hr width="95%" style="color:#5c5c5c;"/>
         
        <div class="row">
            <div class="small-12 columns end infoLabel" style="padding-left:30px !important;font-family:'Poppins', sans-serif;font-size:1.3rem;">
                {$survey->getTitle()}
            </div>
        </div>
       <br/>
       
       <div class="row">
            <div class="small-12 columns end" style="padding-left:30px !important;font-family:'Poppins', sans-serif;font-size:1rem;">
                <i class='required'>Please answer all the questions in this survey.</i>
            </div>
        </div>
       <br/>
        
        <input type="hidden" id="id" value="{$survey->getId()}" />
        <div id='questions'>
            {foreach from=$surveyQuestions item=sQuestion name=idx}
                <div class='questionHolder'>
                    <div class="row">
                        
                        <div class="small-1 end columns text-right">
                            <a href='#' onclick='return false;' class='sortIcon'>
                                <i class='fas fa-arrows-alt' style='font-size:1.2rem;color:#AAAAAA;'></i>
                            </a>
                            &ensp;
                            <span class="so" style="font-weight:300;font-family:'Poppins', sans-serif;font-size:1rem;" data-so='{$sQuestion->getSortOrder()}'>
                               {$smarty.foreach.idx.index +1}.
                            </span>
                            <input type='hidden' class='questionId' value='{$sQuestion->getId()}'/>
                            <input type='hidden' class='sortOrder' value=''/>
                        </div>

                        <div class='small-10 columns end' style="font-family:'Poppins', sans-serif;font-size:1rem;">
                            {$sQuestion->getQuestion()->getQuestionText()}
                        </div>
                    </div>
                    <div class='row'>
                        <div class="small-1 end columns text-right">&nbsp;</div>
                        <div class='small-11 columns end'>
                            {QuestionUtil::drawQuestionResponseOptions($sQuestion->getQuestion())}
                        </div>
                    </div>
                </div>
            {/foreach}
        </div>
    {/nocache}
{/block}
