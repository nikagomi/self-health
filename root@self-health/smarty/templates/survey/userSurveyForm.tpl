{*Author: Randal Neptune*}
{*Project: OECS*}

{extends file="base/contentBody.tpl"}

{block name=scripts}
    {literal}
        var currentTab = 0; // Current tab is set to be the first tab (0)

        function showTab(n) {
            $("div.tab").eq(n).css({"display":"block"});
            if (n == 0) {
              $("#prevBtn").css("display","none");
            } else {
              $("#prevBtn").css("display","inline");
            }
            if (n == ($("div.tab").length - 1)) {
              $("#nextBtn").val("Submit");
            } else {
              $("#nextBtn").val("Next");
            }
            
            //....Scroll to first question in the div tab
            window.scrollTo({ top: 0, behavior: 'smooth' });
            
            // ... and run a function that displays the correct step indicator:
            fixStepIndicator(n);
            
        }

        function nextPrev(n) {
            // Exit the function if any field in the current tab is invalid:
            if (n == 1 && !validateForm()) return false;
            // Hide the current tab:
            $("div.tab").eq(currentTab).css("display","none");
            // Increase or decrease the current tab by 1:
            currentTab = currentTab + n;
            // if you have reached the end of the form... :
            if (currentTab >= $("div.tab").length) {
              //...the form gets submitted:
              $("form#userSurveyForm").submit();
              return false;
            }
            // Otherwise, display the correct tab:
            showTab(currentTab);
        }

        function validateForm() {
            // This function deals with validation of the form fields
            var valid = true;
            var cnt = 0;
            
            $("div.tab").eq(currentTab).find("div.questionHolder").each (function(){
                var qH = $(this);
                qH.find("input[type='radio'],textarea").each(function(){
                    if ($(this).is("textarea")) {
                        if ($.trim($(this).val()) == '') {
                            qH.find("div:first").addClass("invalid");
                            cnt++;
                        }
                    } else if (qH.find("input[type='radio']:checked").length == 0) {
                        qH.find("div:first").addClass("invalid");
                        //qH.find("input[type='radio']").addClass("invalid");
                        cnt++;
                    } else {
                        qH.find("div:first").removeClass("invalid");
                        //$(this).removeClass("invalid");
                    }
                });
            });
            
            if (cnt > 0) {
                valid = false;
            } else {
                $(".step").eq(currentTab).addClass("finish");
            }
            return valid;
         }

    function fixStepIndicator(n) {
        for (i = 0; i < $(".step").length; i++) {
            $(".step").eq(i).removeClass("active");
        }
        //... and adds the "active" class to the current step:
        $(".step").eq(n).addClass("active");
    }

    {/literal}
{/block}

{block name=styles}
    {literal}
        div.questionHolder {
           
        }
        
        .invalid {
            color: #DD0000;
        }
        
        label {
            color: #4A4A4A !important;
            font-family: 'Poppins', sans-serif !important;
            font-size: 0.9rem !important;
        }
        
        /* Mark input boxes that gets an error on validation: */
        input.invalid {
          background-color: #ffdddd;
        }

        /* Hide all steps by default: */
        .tab {
          display: none;
        }

        /* Make circles that indicate the steps of the form: */
        .step {
            height: 15px;
            width: 15px;
            margin: 0 2px;
            background-color: #bbbbbb;
            border: none;
            border-radius: 50%;
            display: inline-block;
            opacity: 0.5;
        }

        /* Mark the active step: */
        .step.active {
          opacity: 1;
        }

        /* Mark the steps that are finished and valid: */
        .step.finish {
          background-color: #4CAF50;
        }
        
       
    {/literal}
{/block}

{block name=jquery}
    {literal}
        
        
        $(function(){
            $(".hotspot").tipTip({maxWidth: "400px", edgeOffset: 3, defaultPosition: "top", delay: 200, fadeOut: 400});
            
            // Display the current tab
            showTab(currentTab);
        });
        
        /********************************************
         Stuff to do when a radio button is clicked
        *********************************************/
        $("input[type='radio']").click(function(){
            if ($(this).prop("checked")) {
                var qH = $(this).closest("div.questionHolder");
                qH.find("div:first").removeClass("invalid");
                var val = $(this).val();
                var questionName = $(this).attr("name");
                var nameSplit = questionName.split("_");
                $.ajax({
                    url: "/ajax/survey/question/response/update",
                    type: "GET",
                    dataType: "json"
                    data: {questionId: nameSplit[1], response:val, surveyId: $("#surveyId").val()}
                }).done(function(data) {
                    if (data) {
                        qH.find("div:first").removeClass("invalid");
                    } else {
                        qH.find("div:first").addClass("invalid");
                    }
                });
            }
        });
        
        /*************************************************
         Stuff to do when info is entered into text area
        **************************************************/
        $("textarea").blur(function(){
            var qH = $(this).closest("div.questionHolder");
            if ($.trim($(this).val()) != '') {
                qH.find("div:first").removeClass("invalid");
                var val = $.trim($(this).val());
                var questionName = $(this).attr("name");
                var nameSplit = questionName.split("_");
                $.ajax({
                    url: "/ajax/survey/question/response/update",
                    type: "GET",
                    dataType: "json"
                    data: {questionId: nameSplit[1], response:val, surveyId: $("#surveyId").val()}
                }).done(function(data) {
                    if (data) {
                        qH.find("div:first").removeClass("invalid");
                    } else {
                        qH.find("div:first").addClass("invalid");
                    }
                });
            } else {
                qH.find("div:first").addClass("invalid");
            }
        });
    {/literal}
{/block}

{block name=dataTable}
    {literal}
       
    {/literal}
{/block}

{block name=content}
    {nocache}
        <div class="paper" align="left" style="min-height:96vh !important;text-align:left !important;margin-top:10px;">
            <div class="grid-x">
                <div class="medium-4 cell text-center" style="padding-left:20px;margin-top:20px;margin-bottom: 10px;">
                    <img src="/images/OECS_Logo_Desktop.png?v=2" alt="OECS Desktop Logo" />
                </div>
                <div class="medium-7 cell infoLabel" style="padding-top:30px !important;font-family:'Poppins', sans-serif;font-size:1.3rem;">
                    {$survey->getTitle()}
                    <br/><i style="font-weight:normal;font-family:'Poppins', sans-serif;font-size:0.95rem;" class='required'>Please answer all the questions in this survey.</i>
                </div>
            </div>
            <hr width="95%" style="color:#5c5c5c;"/>

            <form data-abide name='userSurveyForm' id='userSurveyForm' method='POST' action='{$actionPage}'>
                <input type="hidden" name="surveyId" id="surveyId" value="{$survey->getId()}" />
                <div id='questions'>
                    {foreach from=$surveyQuestions item=sQuestion name=idx}
                        {assign var="x" value="{$smarty.foreach.idx.index + 1}"}{* 6 or less questions to a div tab*}
                     
                        {if $x == 1}
                            <div class="tab">
                        {elseif $x % 6 == 1}
                            <div class="tab">
                        {/if}
                            <div class='grid-container full questionHolder'>
                                <div class="grid-x grid-padding-x">
                                    <div class="small-1 cell text-right">
                                        <span class="so" style="font-weight:300;font-family:'Poppins', sans-serif;font-size:1rem;" data-so='{$sQuestion->getSortOrder()}'>
                                           {$smarty.foreach.idx.index +1}.
                                        </span>
                                    </div>
                                    <div class='small-10 cell end' style="font-family:'Poppins', sans-serif;font-size:1rem;">
                                        {$sQuestion->getQuestion()->getQuestionText()}
                                    </div>
                                </div>
                                <div class='grid-x grid-padding-x' style="margin-bottom:10px;">
                                    <div class="small-1 cell text-right">&nbsp;</div>
                                    <div class='small-8 cell'>
                                        {QuestionUtil::drawQuestionResponseOptions($sQuestion->getQuestion())}
                                    </div>
                                </div>
                            </div>
                        {if $x % 6 == 0}
                            </div>
                            
                        {/if}    
                    {/foreach}
                    {if $x % 6 != 0}
                        </div>
                   {/if}
                </div>
                <div class='grid-x'>
                    <div class='cell text-center'>
                      <button type="button" class="btn btn-success" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                      <button type="button" class="btn btn-success" id="nextBtn" onclick="nextPrev(1)">Next</button>
                    </div>
                </div>

                <!-- Circles which indicates the steps of the form: -->
                <div class='grid-x grid-padding-x'>
                    <div class="cell text-center" style="margin-top:40px;">
                        <span class="step"></span>
                        <span class="step"></span>
                        <span class="step"></span>
                        <span class="step"></span>
                    </div>
                </div>
                {*<div class="row">
                    <div class="small-1 end columns">
                        &nbsp;
                    </div>
                    <div class="small-4 end columns">
                        {ElementTag::submitBtn('','Submit Survey')}
                    </div>
                </div>*}
            </form>
            <br/>
        </div>
        <br/><br/>
    {/nocache}
{/block}
