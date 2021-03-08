{*Author: Randal Neptune*}
{*Project: OECS*}

{extends file="base/body.tpl"}

{block name=jquery}
    {literal}
        $("#year").chosen();
        
        $("a#submit").click(function(){
            $("form").submit();
        });
    {/literal}
{/block}

{block name=dataTable}
    {literal}
      
    {/literal}
{/block}

{block name=styles}
    {literal}
      .filter-bar {
        display: none;
      }
    {/literal}
{/block}

{block name=content}
    {nocache}
        <div style="font-size: 1.3rem;font-weight:500;color:#5c5c5c;">Question Heatmap (Likert)</div>
        <form data-abide method="POST" action="{$actionPage}">
            <div class="row">
                <div class="medium-4 end columns">
                    <label style="width:60%;"><span class="required">Survey Year</span>
                        <div style="display:flex; flex-direction: row;">
                            <select tabindex="1" name="year" id="year" required style="display:inline-block;">
                                {html_options options=$years selected=$selectedYear}
                            </select>
                            &ensp;&nbsp;
                            <a href="#" onclick="return false;" id="submit" style="display:inline-block;float:top;">
                                <i class="fas fa-check-square" style="font-size:2.4rem;color:#006432;"></i>
                            </a>
                    </label>
                </div>
            </div>
        </form>
        {if $year != ''}
            <iframe src="http://{Config::$KIBANA_HOST}:{Config::$KIBANA_PORT}/app/kibana#/visualize/edit/dbdeed90-d0f0-11ea-9265-41fb06ada209?embed=true&_g=(filters:!(),refreshInterval:(pause:!t,value:0),time:(from:now-15m,to:now))&_a=(filters:!(('$state':(store:appState),meta:(alias:!n,disabled:!f,index:oecs-survey-responses,key:'question%20type.keyword',negate:!f,params:(query:Likert),type:phrase),query:(match_phrase:('question%20type.keyword':Likert))),('$state':(store:appState),meta:(alias:!n,disabled:!f,index:oecs-survey-responses,key:'survey%20year',negate:!f,params:(query:'2020'),type:phrase),query:(match_phrase:('survey%20year':'{$year}')))),linked:!f,query:(language:kuery,query:''),uiState:(),vis:(aggs:!((enabled:!t,id:'1',params:(),schema:metric,type:count),(enabled:!t,id:'3',params:(customLabel:Responses,field:response.keyword,missingBucket:!f,missingBucketLabel:Missing,order:asc,orderBy:_key,otherBucket:!f,otherBucketLabel:Other,size:7),schema:segment,type:terms),(enabled:!t,id:'2',params:(field:question.keyword,missingBucket:!f,missingBucketLabel:Missing,order:asc,orderBy:_key,otherBucket:!f,otherBucketLabel:Other,size:100),schema:group,type:terms)),params:(addLegend:!t,addTooltip:!t,colorSchema:'Green%20to%20Red',colorsNumber:4,colorsRange:!((from:0,to:100)),enableHover:!t,invertColors:!t,legendPosition:right,percentageMode:!t,row:!t,setColorRange:!f,times:!(),type:heatmap,valueAxes:!((id:ValueAxis-1,labels:(color:black,overwriteColor:!f,rotate:0,show:!f),scale:(defaultYExtents:!f,type:linear),show:!f,type:value))),title:'Heatmap%20Likert%20Questions',type:heatmap))"  style='border:none; width:100%;min-height:90vh;background-color:#FFFFFF !important;'></iframe>
        {/if}
    {/nocache}
{/block}
