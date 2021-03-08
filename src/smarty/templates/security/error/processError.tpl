{*Author: Randal Neptune*}
{*Project: EduRecord*}

{extends file="base/body.tpl"}

{block name=styles}
    {literal}
    
    {/literal}
{/block}

{block name=jquery}
    {literal}
        
    {/literal}
{/block}

{block name=content}
{nocache}
    <div class="row">
        <div class="medium-12 end columns" >
            <span style="font-size:1.2rem;font-variant:normal;line-height:1.2rem;font-family:Verdana;">
                {$smarty.session.mailerMessage}
                <br/><br/>
                Please note that you may continue to use other aspects of the application via the menu if available 
                <br/>or go to the <a href="/logOut">login page</a>
            </span>
        </div>
    </div>
{/nocache}    
{/block}