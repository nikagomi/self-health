{*Author: Randal Neptune*}
{*Project: OECS*}

{extends file="base/contentBody.tpl"}

{block name=scripts}
    {literal}
        
    {/literal}
{/block}

{block name=styles}
    {literal}
        div.completed {
            padding: 20px !important;
            font-family: 'Poppins', sans-serif;
            font-size: 1.7rem;
            text-align: center !important;
            margin-left:45%;
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
        <div class="paper" align="left" style="min-height:96vh !important;text-align:left !important;margin-top:10px;">
            <div class="grid-x">
                <div class="medium-4 cell text-center" style="padding-left:20px;margin-top:20px;margin-bottom: 10px;">
                    <img src="/images/OECS_Logo_Desktop.png?v=2" alt="OECS Desktop Logo" />
                </div>
                <div class="medium-7 cell infoLabel" style="padding-top:30px !important;font-family:'Poppins', sans-serif;font-size:1.3rem;">
                    {$survey->getTitle()}
                </div>
            </div>
            <hr width="95%" style="color:#5c5c5c;"/>

            {*<div class="row">
                <div class="small-12 columns end infoLabel" style="padding-left:30px !important;font-family:'Poppins', sans-serif;font-size:1.3rem;">
                    Thank you for taking the time to respond to this survey
                </div>
            </div>
           <br/>*}

           <div  align="center" class="completed btn btn-success">
                Thank You!
            </div>
           <br/>
        </div>
       
    {/nocache}
{/block}
