
function sarmsHeaderDataTableColumnFilter(dTable, idx, selectedVal){
    var hd = dTable.column(0).header();
    //alert();   
    if ($.trim($(hd).text()).length > 0) {
        var column = dTable.column(idx);
        var headerElement = column.header();
        var txt = $(headerElement).text();
         
        var smallScreen = window.matchMedia("(max-width: 40.0625em)");
        if (!smallScreen.matches) {
            $(headerElement).html("");
            
            var select = $('<select><option value="">'+txt+'</option></select>')
                .appendTo( column.header() )
                .on( 'change', function () {
                    var val = $.fn.dataTable.util.escapeRegex(
                        $(this).val()
                    );
                    column.search( val ? '^'+val+'$' : '', true, false ).draw();
                });
                
                column.data().unique().sort().each( function ( d, j ) {
                    select.append('<option value="'+d+'">'+d+'</option>');
                });
                //select.css("width","150px !important;");

            select.chosen();
            if($.trim(selectedVal) !== ''){
                select.val(selectedVal).trigger('chosen:updated').trigger("change");
            }
        } else {
            $(headerElement).text(txt);
        }
    }
}


function sarmsHeaderDataTableColumnFilterMulti(dTable, idxArr, $valArr = null){
    for(var i = 0; i < idxArr.length; i++){
        var val = ($valArr === null || $valArr[i] === 'undefined') ? '' : $valArr[i];
        sarmsHeaderDataTableColumnFilter(dTable, idxArr[i], val);
    }
}

/*****************************
To convert tabs to accordions
******************************/
function tabsToAccordions(){
   $("#tabs").each(function(){
       var e = $('<ul class="accordion">');
       var t = new Array;
       $(this).find(">ul>li").each(function(){
           var tmp = $('<li class="accordion-navigation">');
           var id = $(this).find("a").attr("id");
           tmp.html($(this).html()+"<div id='" + id + "'></div>");
           t.push(tmp);
       });

       t[0].find("div").append($(this).find(">div:first").html());
       e.append(t[0]);
       for(var r=1; r < t.length; r++){
           e.append(t[r]);
       }
       $(this).before(e);
       $(this).remove();
   });
   $(".accordion").accordion({
       collapsible: true
   });
}

/***************************
Convert accordions to tabs
****************************/
function accordionsToTabs(){
   $("ul.accordion").each(function(){
       var e = $('<div id="tabs" style="display:none;">');
       var t = new Array;
       var n = $("<ul>");

       $(this).find(">li").each(function(){
           var tmp = $('<li>');
           tmp.html($(this).html());
           t.push(tmp);
       });
       var contentDiv = $(this).find(">div:first");
       for(var x = 0; x < t.length; x++){
           n.append(t[x]);
       }

       e.append(n).append(contentDiv);
       $(this).before(e);
       $(this).remove();
   });
   $("div#tabs").tabs(tabOptions);
   $("div#tabs").tabs("refresh");
}

function isRealValue(obj){
    return obj && obj !== "null" && obj!== "undefined";
}

function capsLockWarning(selector, warningMsg){
    var capsLock;
    $(selector).bind("keypress keydown", function(e) { 
        if(e.type === "keypress"){
            var s = String.fromCharCode(e.which);
            if ((s.toUpperCase() === s && s.toLowerCase() !== s && !e.shiftKey) || (s.toUpperCase() !== s && s.toLowerCase() === s && e.shiftKey)) { //caps is on
                capsLock = true;
            } else if ((s.toLowerCase() === s && s.toUpperCase() !== s && !e.shiftKey) || (s.toLowerCase() !== s && s.toUpperCase() === s && e.shiftKey)) { //caps is off
                capsLock = false;
            }
        }else if($(this).val() === ""){
            capsLock = false;
        }
        else if(e.which === 20 && e.type === "keydown"){
            capsLock = (capsLock === null ) ? false : !capsLock;
        }

        //Now show or hide warning depending on capslock state
        if(capsLock){
            if($(this).parent().find("span.capsLock").length === 0){
                $(this).parent().append('<span style="color:#DD0000;" class="capsLock">'+warningMsg+'</span>');
            }
        }else{
            $(this).parent().find("span.capsLock").remove();
        } 
    });
    
    $(selector).focusout(function(e){
        if($(this).parent().find("span.capsLock").length > 0){
            $(this).parent().find("span.capsLock").remove();
        }
    });
}

/**
 * For flot tooltip positioning
 * @param {type} x
 * @param {type} y
 * @param {type} contents
 * @param {type} padre
 * @param {type} xsub
 * @param {type} ysub
 * @returns {undefined}
 */
function showChartTooltip(x, y, contents, padre, xsub, ysub) {
    var offset = $(padre).offset();
    var minusx = (xsub === undefined) ? offset.left + 5 : xsub;
    var minusy = (ysub === undefined) ? offset.top : ysub;
    var span  = $("<span>").css({
        position: 'absolute',
        display: 'none',
        top:y - minusy,
        left: x - minusx,
        border: '1px solid #bfbfbf',
        padding: '2px',
        'background-color': '#ffffff',
        opacity: 1
    }).text(contents).attr("id","charttooltip").appendTo(padre).fadeIn(200);
}

/**
 * To show tooltip (qtip) with list of academic periods for academic year when clicked on class group
 * @param {type} elem
 * @param {type} academicYearId
 * @param {type} ayClassGroupId
 * @param {type} baseUrl
 * @returns {undefined}
 */
function getAcademicPeriodListTooltipForClassGroup(elem, academicYearId, ayClassGroupId, baseUrl, currentAcademicPeriodId = '') {
    elem.qtip({
        content: {
            title: "<b>Select academic period</b>",
            button: true,
            text: function(event, api) {
                return $.ajax({
                    url: '/ajax/classgroup/summary/term/semester',
                    dataType: 'json',
                    type: 'POST',
                    data:{academicYearId: academicYearId, ayClassGroupId:ayClassGroupId},
                    cache: false
                })
                .then(function(data) {
                    var $div = $("<div>");
                    if(data['periods'].length === 0){ 
                       $div = "<span style='color:#FF0000;'>No academic periods defined</span>";
                    }else{
                        for(var i = 0; i < data['periods'].length; i++){
                            var $a = $("<a>",{href: baseUrl + "/" + ayClassGroupId + "/" + data['periods'][i].id});
                            //$a.addClass("overlayClick").attr("data-type","Page");
                            var txt = (data['periods'][i].id === currentAcademicPeriodId && currentAcademicPeriodId !== '') ? data['periods'][i].name +'*' : data['periods'][i].name;
                            $a.text(txt);
                            $a.css({"font-size":"1.1rem", "line-height":"1.7rem"});
                            $div.append($a).append("<br/>");
                        }
                    }
                    return $div;
                 }, function(xhr, status, error) {
                    api.set('content.text', status + ': ' + error);
                });
                //return '<b>Loading...</b>';
            }
        },
        show:{
            event: "click",
            ready: true,
            solo: true
        },
        style: {
            classes: 'qtip-bootstrap',
            width: '235px'
        },
        position: {

            my: "top left",
            at: "bottom center",
            target: elem
        }, 
        hide: false
    });
}

/**
 * To show q qtip with academic period and subject dropdowns which will produce a continue link
 * @param {type} elem
 * @param {type} academicYearId
 * @param {type} academicPeriodId
 * @param {type} ayClassGroupId
 * @param {type} baseUrl
 * @param {type} incSubj
 * @param {type} qtipClass
 * @returns {undefined}
 */
function getAcademicPeriodAndSubjectDropDownForClassGroups (elem, academicYearId, academicPeriodId, ayClassGroupId, baseUrl, incSubj, qtipClass) {
    elem.qtip({
        content: {
            title: "<b>Please select parameters</b>",
            button: true,
            text: function(event, api) {
                $.ajax({
                    url: '/ajax/classgroup/summary/term/semester',
                    dataType: 'json',
                    type: 'POST',
                    data:{academicYearId: academicYearId, ayClassGroupId:ayClassGroupId, academicPeriodId:academicPeriodId},
                    cache: false
                })
                .then(function(data) {
                    var tooltipDiv = $("<div>");
                    var div;
                    if(data['periods'].length == 0){ 
                       div = "<span style='color:#FF0000;'>No academic periods defined</span>";
                    }else{
                        var periodLabel = $("<label>");
                        div = $("<div>",{class:"row"});

                        var periodDiv = $("<div>",{class:"medium-12 end columns"});
                        var periodSpan = $("<span>", {text:"Academic Period", class:"required"});
                        var periodSelect = $("<select>",{id:'termSemesterId'});
                        var periodOpts = "<option value=''></option>";

                        for(var i = 0; i < data['periods'].length; i++){
                            var isSelected = (data['periods'][i].id == academicPeriodId) ? "selected='selected'" : "";
                            periodOpts += "<option value='" + data['periods'][i].id + "'" + isSelected +">" + data['periods'][i].name + "</option>";
                        }
                        periodSelect.html(periodOpts);
                        periodLabel.append(periodSpan).append(periodSelect);
                        periodDiv.html(periodLabel);
                        div.append(periodDiv);

                        /*** Now for the subject part ***/
                        if(incSubj == 1) {
                            var subjLabel = $("<label>");
                            var subjSpan = $("<span>", {text:"Subject", class:"required"});
                            var subjDiv = $("<div>",{class:"medium-12 end columns"});
                            var subjSelect = $("<select>",{id:'subjectId'});

                            var subjOpts = "";
                            if(data['subjects'].length > 0){
                                subjOpts += "<option value=''>-- Please select --</option>";
                                for(var x = 0; x < data['subjects'].length; x++){
                                    subjOpts += "<option value='" + data['subjects'][x].id + "'>" + data['subjects'][x].name + "</option>";
                                }
                            }else{
                                subjOpts += "<option value=''>-- no subjects --</option>";
                            }
                            subjSelect.html(subjOpts);
                            subjLabel.append(subjSpan).append(subjSelect);
                            subjDiv.html(subjLabel);

                            div.append(subjDiv);
                        }

                        /** Last div to remain empty ***/
                        var aDiv =  $("<div>",{class:"medium-12 end columns collapse"});
                            aDiv.css("text-align", "right");
                        //Hidden element to hold the base url
                        var urlHidden = $("<input>",{type:"hidden",id:"baseUrl"});
                        var aycgHidden = $("<input>",{type:"hidden",class:"ayClassGroupId"});
                        urlHidden.val(baseUrl);
                        aycgHidden.val(ayClassGroupId);

                        aDiv.append(urlHidden).append(aycgHidden);
                        div.append(aDiv);
                    }
                    tooltipDiv.append(div);
                    api.set('content.text', tooltipDiv.html());
                }, function(xhr, status, error) {
                    api.set('content.text', status + ': ' + error);
                });
                //return '<b>Loading...</b>';
            }
        },
        show:{
            event: "click",
            ready: true,
            solo: true
        },
        style: {
            classes: qtipClass,
            width: '280px'
        },
        position: {
            my: "top left",
            at: "bottom center",
            target: elem
        }, 
        hide: false
    });
}

/**
 * Manage change of academic period dropdown form qtip which also has subject drop down
 * @returns {undefined}
 */
function qtipAcademicPeriodChange () {
    var div = $(this).closest("div").parent();
    var periodId = $(this).val();
    var ayClassGroupId = div.find(".ayClassGroupId").val();
    var baseUrl = div.find("#baseUrl").val();

    //Clean up subject list always and remove continue link
    div.find("select#subjectId").html("");
    div.find("div.medium-12:last").find("#link").remove();

    if (periodId != "") {
        $.ajax ({
            url: '/ajax/subject/by/classgroup/academic/period',
            dataType: 'json',
            type: 'POST',
            data:{ayClassGroupId:ayClassGroupId, academicPeriodId:periodId},
            cache: false,
            success: function (data) {
                var subjOpts = "";
                if(data.length > 0){
                    subjOpts += "<option value=''>-- Please select --</option>";
                    for(var i = 0; i < data.length; i++){
                        subjOpts += "<option value='" + data[i].id + "'>" + data[i].name + "</option>";
                    }
                }else{
                    subjOpts += "<option value=''>-- no subjects --</option>";
                }
                div.find("select#subjectId").html(subjOpts);
            }
        });
    }
}

/**
 * Manage change functionality of subject drop down with academic period in qtip
 * @returns {undefined}
 */
function qtipSubjectWithAcademicPeriodChange () {
    var div = $(this).closest("div").parent();
    var periodId = div.find("select#termSemesterId").val();
    var ayClassGroupId = div.find(".ayClassGroupId").val();
    var baseUrl = div.find("#baseUrl").val();
    var subjectId = $(this).val();

    if(subjectId != "" && periodId != ""){
        var link = "<a id='link' href='" + baseUrl + "/" + ayClassGroupId + "/" + periodId + "/" + subjectId +"'>CONTINUE</a>";
        if(div.find("div.medium-12:last").find("#link").length > 0){
            div.find("div.medium-12:last").find("#link").remove();
        }
        div.find("div.medium-12:last").append(link);
    }else{
        div.find("div.medium-12:last").find("#link").remove();
    }
}

function academicPeriodGradeListing (elem, academicPeriods, baseUrl, gradeDisplay, subjectId, ayClassGroupId, qtipClass) {
    elem.qtip({
        content: {
            button: true,
            title: "<b>View grades for</b>",
            text: function(event, api) {
                var $div = $("<div>");
                for(var j = 0; j < academicPeriods.length; j++){

                   var $a = $("<a>",{"href":baseUrl + "/" + ayClassGroupId + "/" + academicPeriods[j].id +  "/" + subjectId + "/" + gradeDisplay });
                       $a.text(academicPeriods[j].name);
                       $a.css({"font-size":"1.1rem", "line-height":"1.8rem"});
                   $div.append($a).append("<br/>");
                }
                return $div.html();
            }
        },
         style: {
            classes: qtipClass,
            width: "170px"
        },
        position: {
            my: "left center",
            at: "right center",
            viewport: $(window),
            adjust: {
                method: 'none shift'
            },
            target: elem
        },
        show :{
            event: "click",
            solo: true,
            modal: false
        }, 
        hide: false
    });
}


function listingForSubjectGradeNavigation (elem, baseUrl, subjects, academicPeriodId, subjectId, gradeDisplay, ayClassGroupId, qtipClass, qtipWidth) {
    elem.qtip({
        content: {
            button: true,
            title: "<b>View grades for</b>",
            text: function(event, api) {
                var $div = $("<div>");
                for(var j = 0; j < subjects.length; j++){
                    if(subjects[j].id != subjectId){
                        var $a = $("<a>",{"href": baseUrl + "/" + ayClassGroupId + "/" + academicPeriodId + "/" + subjects[j].id + "/" + gradeDisplay});
                           $a.text(subjects[j].name);
                           $a.css({"font-size":"1.1rem", "line-height":"2rem"});
                        $div.append($a).append("<br/>");
                    }
                }
                if ($div.html() == "") {
                    $div.append('<div style="color:#DD0000;font-size:0.9rem;">No other subjects to show</div>');
                } 
                return $div.html();
            }
        },
         style: {
            classes: qtipClass,
            width: qtipWidth
        },
        position: {
            my: "left center",
            at: "right center",
            viewport: $(window),
            adjust: {
                method: 'none shift'
            },
            target: elem
        },
        show :{
            event: "click",
            solo: true,
            modal: false
        }, 
        hide: false
    }); 
}

function downloadFlotGraph (graphContainer, imgName, hideQtipGraph) {
    html2canvas(graphContainer, {
        onrendered: function(canvas) {
            theCanvas = canvas;
            canvas.toBlob(function(blob) {
                saveAs(blob, imgName+".png");
            });
            if (hideQtipGraph) {
                $('.qtip:visible').qtip('hide');
            }
        }
    });
}

/*******************************************
check character counter for wysiwyg editor
********************************************/
function checkCharacterCount(elem, charLimit, charCounter, contentHolder = {value: ""}){ 
    //var div = document.createElement("div");
    
    var txt = htmlToText(elem.trumbowyg("html")); //div.textContent || div.innerText;
    var txtHtml = elem.trumbowyg("html");
    var txtLength = txt.length;

    if (txtLength <= charLimit) {
        contentHolder.value = elem.trumbowyg("html");
    }

    if ($.trim(txt) == '') {
        contentHolder.value = '';
        txtHtml = '';
        txtLength = 0;
    } else {
        if (txtLength > charLimit && contentHolder.value != '') {
            elem.trumbowyg("html",contentHolder.value);
        } else {
            if (txtLength > charLimit) {
                var limit = charLimit - 1;
                contentHolder.value = txt.substring(0, limit);
                elem.trumbowyg("html",txt.substring(0, limit));
            } else {
                contentHolder.value = txtHtml;
            }
        }
    }
    var remainder = (txtLength > charLimit) ? 0 : (charLimit - parseInt(txtLength)); 
    charCounter.html(remainder);
}

function htmlToText (htmlContent) {
    var div = document.createElement("div");
    div.innerHTML = htmlContent;
    return div.textContent || div.innerText;
}

/*****************************
 Add overlay to the page.
 *****************************/
function addOverlay(elemType = '', replaceText = false) {
    $('.qtip:visible').qtip('hide');
    var $div = $('<div>',{class:"overlay2"});
    $div.height($(document).height());
    $div.css("padding-top",$(window).height()/2+"px");
   
    //var myImg = new Image();
    //myImg.src = "/images/next.png?rnd=" + Math.random();
    //var nText = (!replaceText) ? "Loading "+elemType+"..." : elemType+"...";
    //$div.append("<img src='/images/newloader.gif'/>");
    //$div.append("<br/><b>"+nText+"</b>");
     $div.appendTo("body");
    //$div.append("<img src='/images/newloader.gif?"+Math.random()+"'/><br/><b>"+nText+"</b>");
    
}

/********************
 * Truncate a string to the number of characters specified.
 * if useWordBoundary is true the truncates up to last full word before total number of characters are
 * reached.
 * @param {int} n
 * @param {boolean} useWordBoundary
 * @returns {String}
 */
String.prototype.trunc = function(n,useWordBoundary){
    var toLong = this.length > n,
    s_ = toLong ? this.substr(0,n-1) : this;
    s_ = useWordBoundary && toLong ? s_.substr(0,s_.lastIndexOf(' ')) : s_;
    return  toLong ? s_ + '&hellip;' : s_;
};

/*
 * To jump forward and back between textboxes that share a similar selector and encased 
 * within a div.
 */
textAutoMove = function (selector, textLength = 1, divAutoEntryClass = 'autoEntry') {
    $(document).on ('focusin', selector, function() {
        $(this).data('val', $(this).val());
    }).on('keyup', selector, function(){
        var val = $.trim($(this).val());
        var prevVal = $(this).data('val');
        if (val.length === textLength) {
            //move forward
            if ($(this).closest("div").next('div.'+divAutoEntryClass).find('input').length !== 0) {
                $(this).closest("div").next('div.'+divAutoEntryClass).find('input').focus();
            }
        } else if ((prevVal !== '' && val === '') || (val === '' && prevVal === '')) {
            //move backward
            if ($(this).closest("div").prev('div.'+divAutoEntryClass).find('input').length !== 0) {
                $(this).closest("div").prev('div.'+divAutoEntryClass).find('input').focus();
            }
        }
    });    
};

function moveCaretToEnd(el) {
    if (typeof el.selectionStart == "number") {
        el.selectionStart = el.selectionEnd = el.value.length;
    } else if (typeof el.createTextRange != "undefined") {
        el.focus();
        var range = el.createTextRange();
        range.collapse(false);
        range.select();
    }
}

function dynamicSingleEntityAdd (elem, txtLabel='', saveButtonClass = "saveEntry", width="400px") {
    var self = elem;;
    var titleTxt = (txtLabel === '') ? self.closest("label").find("span:first").text() : txtLabel;
    var relId = self.closest("div").find("select").attr("id");
    var btnClass = "button " + saveButtonClass;
    self.qtip({
        content: {
            button: true,
            title: "<b>Add new "+ titleTxt.toLowerCase() +"</b>",
            text: function(event, api) {
                var cls = self.attr("data-sClass");
                var $hid = $("<input>",{type:"hidden", value:cls, class:"hClass"});
                var $rel = $("<input>",{type:"hidden", value:relId, class:"relElem"});
                var $txt = $("<input>",{type:"text", class:"txtEntry"}).css("width","auto");
                var $div = $("<div>",{id:"tooltipDiv"});
                    var $span = $("<span>",{class:"errorSpan"}).css("padding","2px 0px 4px 0px");


                var $btnDiv = $("<div>", {class:"row"}).css({"text-align":"right","padding-top":"10px"});
                var $button = $("<input>",{type:"button", value:"Save", class: btnClass});

                var $inputDiv =  $("<div>", {class:"row"});
                var div1 =  $("<div>", {class:"small-5 columns end nombre"}).css({"text-align":"right","font-size":"0.85rem","font-weight":"bold"});   
                var div2 =  $("<div>", {class:"small-7 columns end"}); 
                    div1.html(titleTxt).css({"padding-top":"8px","font-size":"0.85rem"});
                    div2.append($txt);
                $inputDiv.append(div1).append(div2);

                $btnDiv.append($button);
                $div.append($hid).append($rel).append($span).append($inputDiv).append($btnDiv);
                return $div;
            }
        },
         style: {
            classes: 'qtip-bootstrap',
            width:width
        },
        position: {
            my: "bottom left",
            at: "top right",
            viewport: $(window),
            adjust: {
                method: 'shift shift'
            },
            target: self
        },
        show :{
            ready: true,
            event: "click",
            solo: true,
            modal: {
                on: true,
                blur: false,
                escape: false
            }
        }, 
        hide:false
    });
}

function saveSingleEntity (elem) {
    var parDiv = elem.closest("div#tooltipDiv");
    var txt = parDiv.find(".txtEntry").val();
    var nombre = parDiv.find("div.nombre").text();
    var tClass = parDiv.find(".hClass").val();
    var elemId = parDiv.find(".relElem").val();
    if ($.trim(txt) === ''){
        parDiv.find(".txtEntry").addClass("error"); 
        parDiv.find(".errorSpan").html("&nbsp;"+nombre+" is required").addClass("error");
    } else {
        parDiv.find(".txtEntry").removeClass("error"); 
        parDiv.find(".errorSpan").html("").removeClass("error");
        //Do ajax now

        $.ajax({
            type: "POST",
            dataType: "json",
            url: "/simple/entity/quickadd",
            data: {targetClass:tClass, name: txt},
            success: function (result) {
                if (result.status) {
                    $('#'+elemId).append($("<option>",{value:result.id, text: result.name}));

                    $('#'+elemId).val(result.id);
                    $('#'+elemId).trigger("chosen:updated");
                    $('.qtip:visible').qtip('hide');
                } else {
                    parDiv.find(".errorSpan").html(result.msg).addClass("error");
                }
            }
        });
    }
}

function dynamicAssociatedEntityAdd (elem, txtLabel='', saveButtonClass = "saveEntry2", width="400px") {
    var self = elem;
    
    var parId = self.attr("data-pElemId");
    var parVal = $("#"+parId).val();
    var assocTitleTxt = $("#"+parId).closest("label").find("span:first").text();
    if ($.trim(parVal) == '') {
        swal("Information","Please select a "+assocTitleTxt+" to proceed.","info");
        return false;
    }
     
    var titleTxt = (txtLabel === '') ? self.closest("label").find("span:first").text() : txtLabel;
    var relId = self.closest("div").find("select").attr("id");
    
    var pClass = self.attr("data-pClass");
    var parTxt = $("#"+parId+" option:selected").text();
    
    var btnClass = "button " + saveButtonClass;
    self.qtip({
        content: {
            button: true,
            title: "<b>Add new "+ titleTxt.toLowerCase() +"</b>",
            text: function(event, api) {
                var cls = self.attr("data-sClass");
                var $hid = $("<input>",{type:"hidden", value:cls, class:"hClass"});
                var $rel = $("<input>",{type:"hidden", value:relId, class:"relElem"});
                
                var $parElem = $("<input>",{type:"hidden", value:parVal, class:"parVal"});
                var $parClass = $("<input>",{type:"hidden", value:pClass, class:"pClass"});
                
                var $txt = $("<input>",{type:"text", class:"txtEntry"}).css("width","auto");
                var $div = $("<div>",{id:"tooltipDiv"});
                    var $span = $("<span>",{class:"errorSpan"}).css("padding","2px 0px 4px 0px");


                var $btnDiv = $("<div>", {class:"row"}).css({"text-align":"right","padding-top":"10px"});
                var $button = $("<input>",{type:"button", value:"Save", class: btnClass});

                var $inputDivPar =  $("<div>", {class:"row"});
                var divPar1 =  $("<div>", {class:"small-5 columns end parNombre"}).css({"text-align":"right","font-size":"0.85rem","font-weight":"bold"});   
                var divPar2 =  $("<div>", {class:"small-7 columns end"}); 
                
                divPar1.html(assocTitleTxt);
                divPar1.append($parElem);
                divPar2.append(parTxt).append($parClass).css({"font-weight":"bold"});
                $inputDivPar.append(divPar1).append(divPar2);
                
                var $inputDiv =  $("<div>", {class:"row"});
                var div1 =  $("<div>", {class:"small-5 columns end nombre"}).css({"text-align":"right","font-size":"0.85rem","font-weight":"bold"});   
                var div2 =  $("<div>", {class:"small-7 columns end"}); 
                    div1.html(titleTxt).css({"padding-top":"8px","font-size":"0.85rem"});
                    div2.append($txt).css({"padding-top":"8px"});
                $inputDiv.append(div1).append(div2);

                $btnDiv.append($button);
                $div.append($hid).append($rel).append($span).append($inputDivPar).append($inputDiv).append($btnDiv);
                return $div;
            }
        },
         style: {
            classes: 'qtip-bootstrap',
            width: width
        },
        position: {
            my: "bottom left",
            at: "top right",
            viewport: $(window),
            adjust: {
                method: 'shift shift'
            },
            target: self
        },
        show :{
            ready: true,
            event: "click",
            solo: true,
            modal: {
                on: true,
                blur: false,
                escape: false
            }
        }, 
        hide:false
    });
}

function saveDynamicAssociatedEntity (elem) {
    var parDiv = elem.closest("div#tooltipDiv");
    var txt = parDiv.find(".txtEntry").val();
    var nombre = parDiv.find("div.nombre").text();
    var tClass = parDiv.find(".hClass").val();
    var elemId = parDiv.find(".relElem").val();
    
    var pClass = parDiv.find(".pClass").val();
    var pVal = parDiv.find(".parVal").val();
    
    if ($.trim(txt) === ''){
        parDiv.find(".txtEntry").addClass("error"); 
        parDiv.find(".errorSpan").html("&nbsp;"+nombre+" is required").addClass("error");
    } else {
        parDiv.find(".txtEntry").removeClass("error"); 
        parDiv.find(".errorSpan").html("").removeClass("error");
        //Do ajax now
        //alert(tClass+" "+txt+" "+pClass+" "+pVal);
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "/simple/associated/entity/quickadd",
            data: {targetClass:tClass, name: txt, parentClass:pClass, parentValue:pVal},
            success: function (result) {
                if (result.status) {
                    $('#'+elemId).append($("<option>",{value:result.id, text: result.name}));

                    $('#'+elemId).val(result.id);
                    $('#'+elemId).trigger("chosen:updated");
                    $('.qtip:visible').qtip('hide');
                } else {
                    parDiv.find(".errorSpan").html(result.msg).addClass("error");
                }
            }
        });
    }
}

/*************************************************
 * FOR FILE INPUT TO SHOW UPLOADED FILE NAME 
 *************************************************/
$(".inputfile").change(function(e){
    alert('me");')
    var label = $(this).next("label");
    var labelVal = label.text();

    var fileName = '';
  alert(this.files.length);
    if(this.files && this.files.length > 1 ) {
        var placeholder = $(this).attr('data-multiple-caption');
        fileName = placeholder.replace( "{count}", this.files.length );
    } else {
        fileName = e.target.value.split( '\\' ).pop();
        alert(fileName);
    }
    
    if( fileName.length > 0) {
        label.find('span').html(fileName);
    } else {
        label.text(labelVal);
    }
});

function truncateText(text, val){
    var newLength = val - 3;
    return (text.length > val) ? text.substring(0, newLength) + "..." : text; 
}

$.fn.ignore = function(sel){
  return this.clone().find(sel||">*").remove().end();
};

function round(value, precision) {
    var multiplier = Math.pow(10, precision || 0);
    return Math.round(value * multiplier) / multiplier;
}

function isPositiveInteger(s){
    return /^\d+$/.test(s);
}

function hasMonetaryFormat (s) {
    return /^\d{0,4}(\.\d{0,2})?$/.test(s);
}

function validateEmail(email){
    return /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))$/i.test(email);
}

function isPositiveNumber (s) {
    return /^\d*\.{0,1}\d+$/.test(s);
}

