{*Author: Randal Neptune*}
{*Project: EduRecord*}

{extends file="base/body.tpl"}

{block name=styles}
    {literal}
        .denied{
            text-transform: uppercase;
            font-variant:small-caps;
            color:#DD0000;
            text-align:left;
            padding-top:100px;
            font-size:2.0rem;
            font-weight:bold;
            font-family:Helvetica;
        }
        
    {/literal}
{/block}

{block name=jquery}
    {literal}
        $("form#errorDetailForm").on("valid",function(){
            var $div = $('<div>',{class:"overlay"});
                $div.height($(document).height());
                $div.css("padding-top",$(window).height()/2+"px");
                $div.append("<img src='/images/newloader.gif'/><br/><b>Sending Error Details...</b>");
                $div.appendTo("body")
        });
    {/literal}
{/block}

{block name=content}
{nocache}
    <div class="row">
        <div class="medium-12 end columns" >
            <span class="denied">Application Error</span><br/>
        </div>
    </div>
    <div class="row">
        <div class="medium-12 end columns" >
            <span style="font-size:1.2rem;font-variant:normal;line-height:24px;font-family:Verdana;">
                The application has encountered an error.
                
                <br/><br/>
                    <span style="font-size:1.0rem;color:#FF0000;font-family:courier;"> 
                        {$msg}
                    </span>
                <br/><br/>  
                
                In order for the developers to suitable address this error, please provide the 
                details of what you were trying to do when the error occurred <i><b> (please provide as much detail as possible)</b></i>. 
                <br/><br/>
                Please note that you may:<br/>
                &nbsp;(1)&nbsp;submit the error details or<br/>
                &nbsp;(2)&nbsp;continue to use other aspects of the application via the menu if available.
                <br/><br/>If details for this error have already been submitted, please do not submit it again. 
                <br/>Thank you.
            </span>
        </div>
    </div>
    <div>
        <form data-abide name="errorDetailForm" id="errorDetailForm" action="/process/error/detail" method="POST" autocomplete="off">
            <div class="row">
                <div class="medium-6 end columns" >
                    <label>
                        <span class="required">Details:</span>
                        <textarea name="details" id="details" wrap="physical" cols="30" rows="8" required></textarea>
                    </label>
                </div>
                <div class="medium-6 end columns" >
                    <input type="hidden" name="code" value="{$exception->getStatusCode()}"/>
                    <input type="hidden" name="line" value="{$exception->getLine()}"/>
                    <input type="hidden" name="file" value="{$exception->getFile()}"/>
                    <input type="hidden" name="message" value="{$exception->getMessage()}"/>
                </div>
            </div>
            <div class="row">
                <div class="medium-6 end columns" >
                    <label>
                        <input type="submit" name="submit" value="Submit" class="button"/>
                    </label>
                </div>
            </div>
        </form>
    </div>
    
{/nocache}    
{/block}