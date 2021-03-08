{*Author: Randal Neptune*}
{*Project: EduRecord*}

{extends file="base/body.tpl"}

{block name=styles}
    {literal}
        #legendContainer {
            height: auto;
            padding: 2px;
            border-radius: 0px;
            border: none;
            margin: 0px 0px 3px 5px;
            align: right;
        }
        
        .flot-y-axis .flot-tick-label{
            margin-right: 30px;
            margin-top: 2px;
            font-weight:normal;
        }
        
        .flot-y-axis .flot-tick-label{
            margin-right: 7px;
            font-weight:normal;
            font-size: 0.8rem;
        }
    {/literal}
{/block}

{block name=scripts}
    {literal}
        var graph = null;

        function togglePlotVisibility (seriesIdx){
            var someData = graph.getData();
            someData[seriesIdx].bars.show = !someData[seriesIdx].bars.show;
            graph.setData(someData);
            graph.draw();
        }
    {/literal}
{/block}

{block name=jquery}
    {literal}
        var termSemesters = {/literal} {nocache} {$termSemesters} {/nocache} {literal};
        var subjectJson = {/literal} {nocache} {$subjects} {/nocache} {literal};
        var jsonObj = {/literal} {nocache}{$chartDataJson} {/nocache} {literal};
        var series = [];
        
        
        //Create series dynamically for the graph  
        for(var i = 0; i < jsonObj.length - 1; i++){
            var order = i + 1;
            var serie = {};
            serie.label = jsonObj[i].label;
            serie.data = jsonObj[i].data;
            serie.bars = {};
            serie.bars['order'] = order;
            serie.idx = i;
            serie.xaxis = 1;
            series.push(serie);
        }
        
        var options = {
            series: {
                bars: {
                    show: false,
                    align: "center",
                    barWidth: 0.15,
                    lineWidth: 1,
                    horizontal: true
                },
                lines:{
                    show: false
                }
            },
            xaxes: [{
                    max: 100,
                    axisLabel: "<b>Graded Assessment (%)</b>",
                    axisLabelPadding:20,
                    rotateTicks: 0,
                    rotateTicksFont:"0.8rem Arial",
                    position: "bottom",
                    tickSize: 5
                },{
                    max: 100,
                    min: 0,
                    rotateTicks: 0,
                    rotateTicksFont:"0.8rem Arial",
                    position: "top",
                    tickSize: 5
                }],
            yaxis: {
                axisLabel: "<b>Students</b>",
                axisLabelPadding: 2,
            },
            legend:{
                show: true,
                noColumns: 4
            },
            grid: {
                hoverable: false,
                clickable: true,
                borderWidth: 1,
                margin:{ right: 10},
                backgroundColor: { colors: ["#ffffff","#EDF5FF"] }
            },
            colors: ["#338833","#FF4500","#809898","#FFD700","#003366","#800080","#EE7600"]
        };
        
        //Draw the chart 
        if(jsonObj.length > 0){
            /* Construct the ghost series*/
            var x = jsonObj.length - 1;
            var serie = {};
            serie.label = jsonObj[x].label;
            serie.data = jsonObj[x].data;
            serie.bars = {};
            serie.bars['order'] = x;
            serie.idx = x;
            serie.xaxis = 2;
            series.push(serie);
        
            options.yaxis.ticks = jsonObj[0].ticks;
            options.legend.container = $("#legendContainer");
            options.legend.labelFormatter = function(label, series){
                                                return '<a href="#" onClick="togglePlotVisibility('+series.idx+'); return false;">'+label+'</a>';
                                            }
                                            
            graph = $.plot($("#flotContainer"), series, options); 
            
            //show bars for only first series on load
            togglePlotVisibility(0);
            
            $("#chartDiv").bind("plotclick", function (event, pos, item) {
                if (item) {
                    $("#charttooltip").remove();
                    showChartTooltip(item.pageX, item.pageY, item.series.data[item.dataIndex][3], $("#chartDiv"), 0, 26);
                } else {
                     $("#charttooltip").remove();
                }
            });
        }
        
        /*******************************************
         To download graph
        ********************************************/
        $("body").on("click","img.exportImage",function(){
            downloadFlotGraph ($("#chartDiv"), "grade_activity_performance_comparisons for " + $(this).attr("data-export"), false);
        });
        
        /**************************************************
        Give options to navigate to particular subjects
        ***************************************************/
        $("#subjectList").qtip({
            content: {
                button: true,
                title: "<b>View grades for</b>",
                text: function(event, api) {
                    var $div = $("<div>");
                    var gradeDisplay = $("input.gradeDisplay[type=radio]:checked").val();
                    for(var j = 0; j < subjectJson.length; j++){
                        if(subjectJson[j].id != $("#subjectId").val()){
                            var $a = $("<a>",{"href":"/grade/activity/chart/"+$("#ayClassGroupId").val()+"/"+subjectJson[j].id+"/"+$("#termSemesterId").val()});
                               $a.text(subjectJson[j].name);
                               $a.css({"font-size":"1.1rem", "line-height":"1.8rem"});
                            $div.append($a).append("<br/>");
                        }
                    }
                    return $div.html();
                }
            },
             style: {
                classes: 'qtip-bootstrap',
                width: '250px'
            },
            position: {
                my: "left center",
                at: "right center",
                viewport: $(window),
                adjust: {
                    method: 'none shift'
                },
                target: self
            },
            show :{
                event: "click",
                solo: true,
                modal: false
            }, 
            hide: false
        });
        
        /**************************************************
        Give options to navigate to other academic periods
        ***************************************************/
        $("#termSemesterList").qtip({
            content: {
                button: true,
                title: "<b>View grades for</b>",
                text: function(event, api) {
                    var $div = $("<div>");
                    var gradeDisplay = $("input.gradeDisplay[type=radio]:checked").val();
                    for(var j = 0; j < termSemesters.length; j++){

                       var $a = $("<a>",{"href":"/grade/activity/chart/"+$("#ayClassGroupId").val()+"/"+$("#subjectId").val()+"/"+termSemesters[j].id});
                           $a.text(termSemesters[j].name);
                           $a.css({"font-size":"1.1rem", "line-height":"1.7rem"});
                       $div.append($a).append("<br/>");
                    }
                    return $div.html();
                }
            },
             style: {
                classes: 'qtip-bootstrap'
            },
            position: {
                my: "left center",
                at: "right center",
                viewport: $(window),
                adjust: {
                    method: 'none shift'
                },
                target: self
            },
            show :{
                event: "click",
                solo: true,
                modal: false
            }, 
            hide: false
        });
    {/literal}
{/block}

{block name=content}
    {nocache}
        {$msg}
        <input type="hidden" name="subjectId" id="subjectId" value="{$subject->getId()}"/>
        <input type="hidden" name="ayClassGroupId" id="ayClassGroupId" value="{$ayClassGroup->getId()}"/>
        <input type="hidden" name="termSemesterId" id="termSemesterId" value="{$termSemester->getId()}"/>
        <div class="listTableCaption_simpleTable" style="color:#BBBBBB;margin-top:2px;margin-bottom:10px;font-size:22px;">
            Graded Activity Performance Comparisons
        </div>
        <div class="row" >
            <div class="medium-3 columns">
                <label class="medium-text-right small-text-left">Academic Year:</label>
            </div>
            <div class="medium-2 end columns">
                <label class="infoLabel text-left">{$ayClassGroup->getAcademicYear()->getName()}</label>
            </div>
             <div class="medium-2 columns">
                 <label class="medium-text-right small-text-left">Class Group:</label>
            </div>
            <div class="medium-2 end columns">
                <label class="text-left infoLabel">
                    <b>
                        <a href="/classgroup/student/summary/{$ayClassGroup->getId()}/{$termSemester->getId()}">{$ayClassGroup->getClassGroup()->getName()}</a>
                    </b>
                    {if !$ayClassGroup->isOpenForAcademicPeriod($termSemester->getId())}
                        &nbsp;<span style="font-weight:normal;font-size:smaller; color:#dd0000;">(closed)</span>
                    {/if}
                </label>
            </div>
            <div class="medium-3 end columns">
                <label class="text-left infoLabel">
                    <span style='color:#AAA;'>{$ayClassGroup->getClassGroup()->getFacility()->getName()}</span>
                </label>
            </div>
        </div>
        <div class="row" >
            <div class="medium-3 columns">
                <label class="medium-text-right small-text-left">
                    <span>Academic Period:</span>
                </label>
            </div>
            <div class="medium-2 end columns">
                <label class="text-left">
                    <a id="termSemesterList" onclick="return false;">
                        {$termSemester->getName()}
                    </a><a href="#" class="hintanchorRow" onMouseover="showhint('Click on academic period name to access other academic periods', this, event, '200px')">&nbsp;</a>
                </label>
            </div>
            <div class="medium-2 columns">
                <label class="medium-text-right small-text-left">
                    <span>Subject:</span>
                </label>
            </div>
            <div class="medium-5 end columns">
                <label class="text-left">
                    <a id="subjectList" onclick="return false;">
                        {$subject->getName()}
                    </a>
                    <a href="#" class="hintanchorRow" onMouseover="showhint('Click on <b><i>the subject name</i></b> to access grade summaries for other subjects', this, event, '200px')">&nbsp;</a>
                </label>
            </div>
        </div>
        <div class="row" >
            <div class="medium-3 columns">
                <label class="medium-text-right">
                    <span>Teacher:</span>
                </label>
            </div>
            <div class="medium-4 end columns">
                <label class="text-left infoLabel">
                    {$subjectTeacher->getName()}
                </label>
            </div>
        </div>

        
         
        <div class="row" style="padding:0px;margin:0px;">
            <div  class="medium-4 columns end" >
                &nbsp;
            </div>
            <div  class="medium-4 columns end medium-text-right small-text-left" >
                <a style="color:purple;" href="/classgroup/student/grade/subject/activity/summary/{$ayClassGroup->getId()}/{$termSemester->getId()}/{$subject->getId()}">
                    Summarized subject grades
                </a>
            </div>
            <div  class="medium-4 columns end medium-text-right small-text-left">
                <a style="color:purple;" href="/classgroup/student/grade/subject/activity/detail/{$ayClassGroup->getId()}/{$termSemester->getId()}/{$subject->getId()}">
                    Assessment details
                </a>
            </div>
        </div>
        <div class="row">
            <div class="medium-12 columns">
              <hr width="100%" size="2" color="#D0E0F0" style="margin:5px;"/>
            </div>
        </div>
                   
        {if $rawDataCount gt 0}
            <div style="margin-left:25px;">
                <b>Please click on the graded activity name in the chart legend to show or hide it on the graph</b>
                <img style="margin-left:25px;cursor:pointer;" alt="download graph" title="Click to download graph" src="/images/download32.png" class="exportImage" data-export="{$ayClassGroup->getLabel()}_{$termSemester->getLabel()}_{$subject->getLabel()}"/>
            </div>
            <div id="chartDiv"  style="width:99%; margin-left:5px;background-color: #FFFFFF;margin-top:20px;padding:15px 10px 0px 0px;">
                <div style="margin:0px 0px 10px 25px;color:#777777;font-variant: small-caps;">
                    <b>{$ayClassGroup->getLabel()} grade activity performance chart for {$subject->getLabel()} in {$termSemester->getLabel()}  </b>
                </div>

                <div id="legendContainer"></div>
                <div id="flotContainer" style="width:100%;height:1100px;"></div>
            </div>
        {else}
            <div class="emptyListMessage">
                Sorry, no data available to chart.
                Either, no students are defined or you haven't created any student subject groups.
            </div>
        {/if}
    {/nocache}
{/block}