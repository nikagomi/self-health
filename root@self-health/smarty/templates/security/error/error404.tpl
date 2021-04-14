{*Author: Randal Neptune*}
{*Project: EduRecord*}

{extends file="base/body.tpl"}

{block name=styles}
    {literal}
        .denied{
            text-transform:uppercase;
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

{block name=content}
{nocache}
    <div class="row">
        <div class="medium-6 end columns" >
            <span class="denied">ERROR</span><br/>
        </div>
    </div>
    <div class="row">
        <div class="medium-6 end columns" >
            <span style="font-size:28px;font-variant:small-caps;line-height:28px;font-family:Helvetica;">
                Error Code: {$code}
            </span>
        </div>
    </div>
    <div class="row">
        <div class="medium-12 end columns" >
            <span style="font-size:14px;font-variant:small-caps;line-height:14px;font-family:Helvetica;">
                {$msg}
            </span>
        </div>
    </div>
    
{/nocache}    
{/block}