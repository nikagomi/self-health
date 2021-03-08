{*Author: Randal Neptune*}
{*Project: EduRecord*}

{extends file="base/contentBody.tpl"}

{block name=styles}
    {literal}
        .denied{
            font-style:uppercase;
            font-variant:small-caps;
            color:#DD0000;
            text-align:left;
            padding-top:100px;
            font-size:80px;
            font-weight:bold;
            font-family:Verdana;
        }
        .errorSpan{
            font-weight:bold;
            font-size:1.1rem;
            font-variant:small-caps;
            line-height:28px;
            font-family:Verdana;
        }
    {/literal}
{/block}

{block name=content}
    <div class="row">
        <div class="medium-3 columns" >
            <img src="/images/access_denied.png">
        </div>
        {nocache}
        <div class="medium-8 end columns" >
            <span class="denied">ACCESS DENIED</span><br/>
            <span>
                {if $errorMessage != ''}
                    {$errorMessage}
                {else}
                    You are on this page because you have tried to access a page / url that you are not authorized to access.
                {/if}
            </span>
        </div>
        {/nocache}
    </div>
    
    
{/block}
