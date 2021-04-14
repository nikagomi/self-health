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
       
    {/literal}
{/block}

{block name=jquery}
    {literal}
        $("div.table-toolbar").html('Available Surveys');
        $("#year").chosen();
    {/literal}
{/block}

{block name=dataTable}
    {literal}
        "paging":true,
        info: false,
        searching:true,
        "dom": "<'row'<'col-sm-12 col-md-4 table-toolbar'><'col-sm-12 col-md-3'l><'col-sm-12 col-md-4 text-right'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
    {/literal}
{/block}

{block name=content}
{nocache}
    
{$msg}
    <div style="font-size: 1.3rem;font-weight:500;color:#5c5c5c;">Manage Surveys</div>
    <form data-abide name="surveyForm" id="surveyForm" action="{$actionPage}" method="POST" autocomplete="off">
        
        <input type="hidden" name="id" value="{$survey->getId()}"/>
        <div class="row">
            <div class="medium-4 end columns">
                <label><span class="required">Identifier</span>
                    <input tabindex="1" type="text" maxlength="30" id="identifier" name="identifier" value="{$survey->getIdentifier()}" placeholder="Enter a name" required>
                </label>
            </div>
        </div>
        <div class="row">
            <div class="medium-4 end columns">
                <label><span class="required">Year</span>
                    <select tabindex="2" id="year" name="year" required>
                        {html_options options=$years selected=$survey->getYear()}
                    </select>
                </label>
            </div>
        </div>
        <div class="row">
            <div class="medium-8 large-6 end columns">
                <label style="width:100%;"><span class="required">Title</span>
                    <textarea tabindex="3" cols="20" rows="2" wrap="soft" name="title" id="title" required>{$survey->getTitle()}</textarea>
                </label>
            </div>
        </div>
        <div class="row">
            <div class="medium-4 end columns">
                <a href="/survey/form" tabindex="5" class="reset">Reset</a>&nbsp;
                {ElementTag::submitBtn(4)}
            </div>
            {if $survey->getId() != ''}
                <div class="medium-4 end columns">
                    Confirm&nbsp;<input tabindex="6" id="confirmDelete" type="checkbox"/>
                    {ElementTag::deleteBtn(7, "/survey/delete/`$survey->getId()`")}
                </div>
            {/if}
        </div>
    </form> 
    <hr style="margin: 15px 0px 8px 0px;color:#5c5c5c;" width="100%" />         

{if $list|count gt 0}
    <br/>
    <table align="left" style="margin-left: 1px !important;" id="listTable" class="displayTable" width="98%" cellspacing="0">
        <thead>
            <tr>
                <th>Identifier</th>
                <th>Year</th>
                <th>Title</th>
                <th width="15%">&nbsp;</th>
                <th width="10%">&nbsp;</th>
                <th width="7%">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            {foreach from=$list item=surv} 
                <tr>                           
                    <td>{$surv->getIdentifier()}</td> 
                    <td>{$surv->getYear()}</td>
                    <td>{$surv->getTitle()}</td>
                    <td>
                        <a title="Define survey questions" style='color:#008cba;' href="/survey/question/form/{$surv->getId()}">
                            Questions&nbsp;<span style="color:#464646;">({$surv->getNumberOfQuestions()})</span>
                        </a>
                    </td>
                    <td>
                        <a title="Preview published survey" style='color:#008cba;' href="/survey/preview/{$surv->getId()}">
                            Preview
                        </a>
                    </td>
                    <td>
                        <a title="{Messages::i18n("link.edit")}" class="editRow" href="/survey/edit/{$surv->getId()}">
                            <i class='fas fa-edit' style='font-size:1.5rem;color:#008cba;'></i>
                        </a>
                    </td>
                </tr>
            {/foreach}
        </tbody>
    </table>  
{/if}
<br/><br/>
{/nocache}
{/block}
