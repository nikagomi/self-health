{*Author: Randal Neptune*}
{*Project: Self-Health*}

{extends file="base/body.tpl"}

{block name=styles}
    {literal}
        .titleText {
            font-weight: 600;
            color: #464646;
            font-size: 1.6rem;
            font-family:'Poppins', sans-serif;
        }
        
        .bodyText {
            text-align: justify;
            color: #555555;
            margin-right: 10px;
        }
    {/literal}
{/block}

{block name=dataTable}
    {literal}
        
    {/literal}
{/block}

{block name=content}
    {nocache}
        <p class="titleText">
           About OECS PEHR 
        </p>
        <p class="bodyText">
            This web-based Patient-owned Electronic Health Record (PEHR) platform was developed under an initiative by the Organization of Eastern Caribbean States (OECS).<br/>
            The software facilitates usage by persons with diabetes in the OECS Member States. <br/>
            The design and implementation of the OECS PEHR platform focus on the digitization of key processes to support chronic disease management. 
        </p>
    {/nocache}
{/block}


