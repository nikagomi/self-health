{extends file="base/body.tpl"}

{block name=styles}
    {literal}
        table thead tr th{
            color:#FFFFFF;
        }
        
        .infoLabel{
            font-weight: normal;
            
        }
        
        .ui-progressbar{
            position: relative;
        }
        
        .progress-label{
            position: absolute;
            left: 47%;
            top: 2px;
            font-weight: bold;
            text-shadow: none;
        }
        

        #newflotContainer{
            height:350px;
            width:1000px;
            margin-top: 8px;
            position: relative;
        }
        
        #newlegendContainer {
            height: 30px;
            padding: 2px;
            border-radius: 0px;
            border: none;
            /*display: inline-block;*/
            margin: 0px 0px 0px 52px;
        }
        
       .flot-y-axis .flot-tick-label{
            margin-right: 15px;
            margin-top: -20px;
            font-weight:bold;
        }
        
        div.paper {
            box-shadow: 10px 10px 5px #888888;
            border:1px solid #CCC;
            width: 95%;
            background-color:#FFFFFF;
            margin-left:15px;
            text-align:center;
            margin-bottom:10px;
        }
        
        .exportImage{
            cursor:pointer;
        }
        
        .trumbowyg-editor, .trunbowyg-textarea {
            min-height: 120px !important;
        }
        
        div.signed {
            font-size: 0.85rem;
            font-style:italic;
            color: #999999;
            display: none;
            
        }
        
        div#errSign {
            font-size: 0.85rem;
            font-variant:small-caps;
            font-weight:bold;
            color: #DD0000;
            display: none;
        }
        
        .modalHeader{
            background-color:#506070; 
            color:#fff; 
            font-size:16px; 
            font-weight:bold;
            height:30px; 
            padding-top:5px;
            font-family:"Arial";
            vertical-align: middle;
            font-variant:small-caps;
            border-radius: 0px;
        }
    {/literal}
{/block}
    

{block name=scripts}
    {literal}
        var msgContent = {value: ""};
        var htMsgContent = {value: ""};
        var rmkContent = {value: ""};
        var characterLimit = {/literal}{PropertyService::getProperty("academic.period.end.max.char.limit", 200)}{literal};
        var htCharacterLimit = {/literal}{PropertyService::getProperty("head.teacher.remarks.max.char.limit", 100)}{literal};
        
        
        var options = {
            xaxis: {
                axisLabel: "<b>{/literal}{Messages::i18n("studentSubjectHistory.academic.period")}{literal}</b>",
                axisLabelPadding:35,
                rotateTicks: 92,
                rotateTicksFont:"0.8rem Arial",
                tickLenth: 10
            },
            yaxis: {
                min:0,
                max: 102,
                autoscaleMargin:0,
                tickDecimals: 0,
                tickSize: 10
            },
            legend:{
                show: true,
                noColumns: 0,
            },
            grid: {
                hoverable: true,
                clickable: true,
                borderWidth: 1,
                labelMargin: 30,
                axisMargin: 5,
                margin:{ right: 15, top: 5, bottom:15, left:10},
                backgroundColor: { colors: ["#ffffff", "#EDF5FF"] }
            }
        };
        
        function initQtipSubjectTeacher (elem) {
            var val = (elem.text() == "--") ? "" : $.trim(elem.text());
            var self = elem;
            var $div = $("<div>");
            var teacherId = elem.attr("data-teacherId");
            var subjectId = elem.attr("data-subjectId");
            self.qtip({ 
                content: {
                    button: true,
                    title: "<b>Choose subject Teacher</b>",
                    text: function(event, api) {
                        $.ajax({
                            url: '/ajax/class/group/subject/teachers/'+ $("#ayClassGroupId").val() + '/' + $("#termSemesterId").val() + '/' + subjectId,
                            cache: false
                        })
                        .then(function(data) {
                            if (data.length > 0) {
                                for (var x = 0; x < data.length; x++) {
                                    var $span = $("<span>",{class:'scgt'});
                                        $span.attr("data-id", data[x].id); //id is the teacher Id
                                        $span.attr("data-subjectId", subjectId);
                                        var fName = data[x].firstName;
                                        $span.text(fName.charAt(0).toUpperCase() + ". " + data[x].lastName);
                                        $span.css({"font-size":"1.1rem", "line-height": "1.7rem", "color":"#008cba", "font-weight":"normal","cursor":"pointer"});
                                        if (teacherId == data[x].id) {
                                            $span.css("color","darkorange");
                                        }
                                        $div.append($span).append("<br/>");
                                }
                            } else {
                                $div.html("No teachers confgured");
                            }
                            api.set('content.text', $div.html());
                        }, function(xhr, status, error) {
                            api.set('content.text', "An error occured. Could not load subject teacher(s)");
                        });
                        return '<b>Loading...</b>';
                    }
                },
                 style: {
                    classes: 'qtip-bootstrap',
                    width: "240px"
                },
                position: {
                    my: "bottom center",
                    at: "top center",
                    target: self
                },
                show :{
                    event: "click",
                    solo: true,
                    ready: true,
                }, 
                hide: {
                    fixed: true,
                    delay: 500
                },
                events: {
                    hide: function(event, api) {
                        $(this).qtip('destroy');
                    }
                }
            });
        }
        
        String.prototype.trimRight = function(charlist) {
            if (charlist === undefined)
              charlist = "\s";

            return this.replace(new RegExp("[" + charlist + "]+$"), "");
        };
        
        function validateEmail(email){
            return /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))$/i.test(email);
        }
        
    {/literal}
{/block}

{block name=jquery}
    {literal}
        var rptSuffix = '{/literal}{$gradeReportSuffix->getReportSuffix()}{literal}';
        var rptDir = '{/literal}{Config::$PDF_GRADE_REPORT_DIR}{literal}';
        
        $(function(){
            $(".hotspot").tipTip({maxWidth: "400px", edgeOffset: 3, defaultPosition: "top", delay: 200, fadeOut: 400});
            
            
            $("body").on("each", "textarea",function() {
                var theValue = $(this).val();
                $(this).data("value", theValue);
            });
        });
        
        var lines = 4;
        
        /* Global variable to keep track of the comments */
        var commentTxt;
        var coordinatorRemarkTxt;
        var htCommentTxt;
        
        /***************************************************
         To edit head teacher comments - shows the textarea
        *****************************************************/
        $("body").on("click",".editHTRemarks", function(){
            var ta = $("<textarea>");
            var spanComm = $("span#htremarks");
            htCommentTxt = spanComm.attr('data-remarks');

            var divCont = $(this).closest("div");
            ta.attr("cols", 40).attr("rows",3).attr("wrap","physical").attr("id","htrmks").html(htCommentTxt);
            
            spanComm.html('<div style="color:#777777;" contenteditable="true" align="right"><i><span class="numChar">'+htCharacterLimit+'</span> characters left</i></div>');
            spanComm.append(ta);

            if (htCommentTxt != '') {
                var conTxt = htmlToText(htCommentTxt);
                var remainder = (conTxt.length > htCharacterLimit) ? 0 : (htCharacterLimit - parseInt(conTxt.length)); 
                $("#htrmks").closest("span#htremarks").find("span.numChar").html(remainder);
            }
               
            ta.trumbowyg({
                btns: [
                    'btnGrp-design',
                    ['superscript', 'subscript'],
                    ['removeformat'],
                    ['foreColor'] 
                ],
                removeformatPasted: true,
                semantic: false
            }).on ('tbwchange', function() {
                var charCounter = $("#htrmks").closest("span#htremarks").find("span.numChar");
                checkCharacterCount($("#htrmks"), htCharacterLimit, charCounter, htMsgContent);
            });
            document.execCommand("defaultParagraphSeparator", false, "div");

            var spanLink = $(this).closest("span");
            spanLink.html('&nbsp;&nbsp;<a href="#" onclick="return false;" class="savehtrmk"><i class="fas fa-save" style="font-size:1.2rem;color:green;"></i></a>&nbsp;&nbsp;<a href="#" onclick="return false;"  style="color:purple;" class="cancelHTRemarks"><i class="fas fa-undo" style="font-size:1.2rem;color:orangered;"></i></a>');
        });

        /********************************************
         To save or update the head teacher comments
        **********************************************/
        $("body").on("click",".savehtrmk", function(){
            var comments = $("span#htremarks").find("textarea").val();

            var spanLink = $(this).closest("span");
            $("span#htremarks").find("textarea").trumbowyg('destroy');

            $.ajax({
                url:"/classgroup/student/grade/summary/head/teacher/remarks",
                type:"POST",
                dataType:"json",
                data:{headTeacherRemarks:comments,id:$("#id").val()},
                success: function(data){
                    if(data['status']){
                        
                        $("span#htremarks").html(comments);
                        $("span#htremarks").attr("data-remarks",comments);
                        spanLink.html('&nbsp;&nbsp;<a href="#" onclick="return false;" class="editHTRemarks"><i class="fas fa-edit" style="font-size:1.2rem;color:#008cba;"></i></a>');
                        
                    }else{
                        sweetAlert("Update Error", "Could not update head teacher comments", "error");
                    }
                }, error: function(jqXHR, exception) {
                    $("span#htremarks").find("textarea").remove();
                }
            });
        });

        /***********************************************************
         To cancel an intended edit or save of head teacher remarks
        ************************************************************/
        $("body").on("click",".cancelHTRemarks", function(){
            var spanComm = $("span#htremarks");
            spanComm.html(htCommentTxt);

            var spanLink = $(this).closest("span");
            spanLink.html('&nbsp;&nbsp;<a href="#" onclick="return false;" class="editHTRemarks"><i class="fas fa-edit" style="font-size:1.2rem;color:#008cba;"></i></a>');
        });

        /***************************************************
         To edit form teacher comments - shows the textarea
        *****************************************************/
        $("body").on("click",".editComments", function(){
            var ta = $("<textarea>");
            var spanComm = $("span#comments");
            commentTxt = spanComm.attr('data-comments');

            var divCont = $(this).closest("div");
            ta.attr("cols", 40).attr("rows",3).attr("wrap","physical").attr("id","comms").html(commentTxt);
            
            spanComm.html('<div style="color:#777777;font-size:0.8rem;" contenteditable="true" align="right"><i><span class="numChar">'+characterLimit+'</span> characters left</i></div>');
            spanComm.append(ta);

            if (commentTxt != '') {
                var conTxt = htmlToText(commentTxt);
                var remainder = (conTxt.length > characterLimit) ? 0 : (characterLimit - parseInt(conTxt.length)); 
                $("#comms").closest("span#comments").find("span.numChar").html(remainder);
            }
               
            ta.trumbowyg({
                btns: [
                    'btnGrp-design',
                    ['superscript', 'subscript'],
                    ['removeformat'],
                    ['foreColor'] 
                ],
                removeformatPasted: true,
                semantic: false
            }).on ('tbwchange', function() {
                var charCounter = $("#comms").closest("span#comments").find("span.numChar");
                checkCharacterCount($("#comms"), characterLimit, charCounter, msgContent);
            });
            document.execCommand("defaultParagraphSeparator", false, "div");

            var spanLink = $(this).closest("span");
            spanLink.html('&nbsp;&nbsp;<a href="#" onclick="return false;" class="saveComm"><i class="fas fa-save" style="font-size:1.2rem;color:green;"></i></a>&nbsp;&nbsp;<a href="#" onclick="return false;"  style="color:purple;" class="cancelComm"><i class="fas fa-undo" style="font-size:1.2rem;color:orangered;"></i></a>');
        });

        
        
        /*********************************
         To save or update the comments
        **********************************/
        $("body").on("click",".saveComm", function(){
            var comments = $("span#comments").find("textarea").val();

            var spanLink = $(this).closest("span");
            $("span#comments").find("textarea").trumbowyg('destroy');
            $.ajax({
                url:"/classgroup/student/grade/summary/term/print/update/comments",
                type:"POST",
                dataType:"json",
                data:{comments:comments,id:$("#id").val()},
                success: function(data){
                    if(data['status']){
                        if ($.trim(comments) !== '') {
                            $("div.comments_separator").css("display","inline-block");
                        } else{
                            $("div.comments_separator").css("display","none");
                        }

                        $("span#comments").html(data['comments']);
                        $("span#comments").attr("data-comments",data['comments']);
                        spanLink.html('&nbsp;&nbsp;<a href="#" onclick="return false;" class="editComments"><i class="fas fa-edit" style="font-size:1.2rem;color:#008cba;"></i></a>');
                        
                    }else{
                        sweetAlert("Update Error", "Could not update comments", "error");
                    }
                }, error: function(jqXHR, exception) {
                    $("span#comments").find("textarea").remove();
                }
            });
        });

        /************************************************
            To edit coordinator remarks - shows the textarea
           **************************************************/
           $("body").on("click",".editRemarks", function(){
               $("div.signed").hide();
               var ta = $("<textarea>");
               var spanComm = $("span#remarks");
               coordinatorRemarkTxt = spanComm.attr('data-remarks');

               var divCont = $(this).closest("div");
               ta.attr("cols", 40).attr("rows",3).attr("wrap","physical").attr("id","rmks").html(coordinatorRemarkTxt);
               
               spanComm.html('<div style="color:#777777;font-size:0.8rem;" contenteditable="true" align="right"><i><span class="numChar">'+characterLimit+'</span> characters left</i></div>');
               spanComm.append(ta);

               if (coordinatorRemarkTxt != '') {
                    var conTxt = htmlToText(coordinatorRemarkTxt);
                    var remainder = (conTxt.length > characterLimit) ? 0 : (characterLimit - parseInt(conTxt.length)); 
                    $("#rmks").closest("span#remarks").find("span.numChar").html(remainder);
                    if ($("input[type='radio'][name='sign']:checked").length > 0) {
                        $("div.signatory").show();
                    }
                }
                
                if ($("#chkCoord").length == 1){
                    $("div.signatory").show();
                }

                ta.trumbowyg({
                    btns: [
                        'btnGrp-design',
                        ['superscript', 'subscript'],
                        ['removeformat'],
                        ['foreColor'] 
                    ],
                    removeformatPasted: true,
                    semantic: false
                }).on ('tbwchange', function() {
                    var charCounter = $("#rmks").closest("span#remarks").find("span.numChar");
                    checkCharacterCount($("#rmks"), characterLimit, charCounter, rmkContent);
                });
                document.execCommand("defaultParagraphSeparator", false, "div");

               var spanLink = $(this).closest("span");
               spanLink.html('&nbsp;&nbsp;<a href="#" onclick="return false;" class="saveRemark"><i class="fas fa-save" style="font-size:1.2rem;color:green;"></i></a>&nbsp;&nbsp;<a href="#" onclick="return false;"  style="color:purple;" class="cancelRemark"><i class="fas fa-undo" style="font-size:1.2rem;color:orangered;"></i></a>');
               
           });

           /*********************************
            To save or update coordinator comments
           **********************************/
           $("body").on("click",".saveRemark", function(){
                var remarks = $("span#remarks").find("textarea").val();
                var spanLink = $(this).closest("span");
                var coordinatorId = $("input[type='radio'][name='sign']:checked").val();

                if ($("div.signatory").is(":visible") || $("#chkCoord").length == 1){
                    if (coordinatorId == '' || typeof coordinatorId === "undefined") {
                        $("div#errSign").show();
                        return false;
                    }
                }

                $("span#remarks").find("textarea").trumbowyg('destroy');

                

                $("div#errSign").hide();
                $.ajax({
                    url:"/classgroup/student/grade/summary/term/print/update/remarks",
                    type:"POST",
                    dataType:"json",
                    data: {remarks:remarks,id:$("#id").val(), coordinatorId:coordinatorId},
                    success: function(data){
                        if(data['status']){
                            $("span#remarks").html(remarks);
                            $("span#remarks").attr('data-remarks', remarks);
                            spanLink.html('&nbsp;&nbsp;<a href="#" onclick="return false;" class="editRemarks"><i class="fas fa-edit" style="font-size:1rem;color:#008cba;"></i></a>');

                             if ($.trim(remarks) != '') {//If remarks are empty then hide who signed it.
                                 $("div.signed").find("span").text(data['coordName']);
                                 $("div.signed").show();
                             } else {
                                 $("div.signed").hide();
                                 $("div.signatory").find("input[type='radio']").prop('checked', false);
                             }
                            $("div.signatory").hide();
                            //Now check the radio signatories
                            $("div.signatory").find("input[type='radio']").each(function(e) {
                                 if ($(this).val() == data['coordId']) {
                                     $(this).prop('checked', true);
                                     return false;
                                 }
                             });
                        }else{
                            sweetAlert("Update Error", "Could not update remarks", "error");
                        }
                    }, error: function(jqXHR, exception) {
                         $("span#remarks").find("textarea").remove();
                     }
                });
            });

           /***********************************************
            To cancel an intended edit or save of remarks
           ***********************************************/
           $("body").on("click",".cancelRemark", function(){
                var spanComm = $("span#remarks");
                spanComm.html(coordinatorRemarkTxt);

                var spanLink = $(this).closest("span");
                $("div.signatory").hide();
                $("div#errSign").hide();
                spanLink.html('&nbsp;&nbsp;<a href="#" onclick="return false;" class="editRemarks"><i class="fas fa-edit" style="font-size:1rem;color:#008cba;"></i></a>');
                if ($.trim($("div.signed").find("span").text()) != ''){
                    $("div.signed").show();
                }
           });

        /**********************************
         To show send emails modal dialog
        **********************************/
        $("a#emailSend").click(function(){
            //try counting number of rows and then do the height with an offset
            var cnt = $('div#basic-modal-content').find('div.row').length;
            var height = 90; //default if no email address are available
            /*if(cnt > 0){
                height = (cnt * 45) + 40; //header is 40 'height':height + 'px',
            } */  
            $.modal($('div#basic-modal-content'), {
                containerCss: {'width':'700px','border':'1px #506070 solid', 'border-radius':'5px'},
                onOpen: function (dialog) {
                    dialog.overlay.fadeIn('slow', function () {
                        dialog.data.hide();
                        dialog.container.fadeIn('slow', function () {
                                dialog.data.slideDown('slow');	 
                                // where the magic happens
                                dialog.container.css('height', 'auto');
                                dialog.origHeight = '90px';
                        });
                    });
                }
            });
        });
        
        /*******************************
         To send emails on button click
        ********************************/
        $("#sendEmail").click(function(){
            var pBar = $("div#progressBar");
            var addresses = '';
            if($("input[type='checkbox'].emailBox:checked").length == 0 && $.trim($("textarea#manualEmail").val()) == ''){
                $("div#emailErr").html("select at least ONE email recipient checkbox (if applicable) or enter addresses manually");
            }else{
                //Determine if manual emails were entered and check to make sure that they are valid
                var errEmails = [];
                if ($.trim($("textarea#manualEmail").val()) != ''){
                    var manAddrs = $.trim($("textarea#manualEmail").val());
                    var manAddrArr = manAddrs.split(",");
                    for (var x = 0; x < manAddrArr.length; x++) {
                        var tAddr = $.trim(manAddrArr[x]);
                        if (tAddr != '') {
                            if (validateEmail(tAddr) ) {
                                if (addresses != '') {
                                    addresses += ":email:";
                                } 
                                addresses += tAddr;
                            } else {
                                errEmails.push(tAddr);
                            }
                        }
                    }
                }
                //If there are any erroneous manual emails report an error.
                if (errEmails.length > 0) {
                    $("div#emailErr").html("The following manually entered addresses are invalid: "+errEmails.join(", "));
                    return false;
                }
                
                $("div#emailErr").html("");
                $(".progress-label").removeClass("successMessage").text('Sending email(s)...');
                $("input[type='checkbox'].emailBox").attr("disabled",true);
                pBar.progressbar({value: false});
                pBar.find(".ui-progressbar-value").css({
                    "background" : '#' +  Math.floor(Math.random() * 16777215).toString(16)
                });

                //set up address string to send via ajax
                
                $("input[type='checkbox'].emailBox:checked").each(function(idx){
                    if(idx > 0){ 
                        addresses += ":email:";
                    }
                    addresses += $(this).val();
                });
                
                //now do the ajax to send mail
                $.ajax({
                    url: rptDir+rptSuffix+"/ajaxEmailStudentGradeSummary.php",
                    type: "POST",
                    dataType: "json",
                    data:{addresses:addresses, id:$("#id").val(), displayType:$("#gradeDisplay").val()},
                    success: function(data){
                        pBar.progressbar("destroy");
                        $(".progress-label").removeClass("successMessage").text('');
                        $("input[type='checkbox'].emailBox").attr("disabled",false); //re-enable checkboxes
                        if(data['failMsg'] != ''){
                            $("div#emailErr").html(data['failedMsg']);
                        }else{
                            if(data['failures'] > 0){
                                $("div#emailErr").html("Unable to send to: " + data['failedArr']);
                            }else{
                                $(".progress-label").css({"font-weight":"bold","font-size":"1.1rem","font-variant":"small-caps","color":"#006699"}).text('emails sent');
                            }
                        }
                    }
                });
            }
        });

        /***********************************************
         To cancel an intended edit or save of comments
        ***********************************************/
        $("body").on("click",".cancelComm", function(){
            var spanComm = $("span#comments");
            spanComm.html(commentTxt);

            var spanLink = $(this).closest("span");
            spanLink.html('&nbsp;&nbsp;<a href="#" onclick="return false;" class="editComments"><i class="fas fa-edit" style="font-size:1.2rem;color:#008cba;"></i></a>');
        });

        /********************************************
         To get the grade details of the subject
        ********************************************/
        $("span.gradeDetails").each(function(){
            var ayClassGroupId = $("#ayClassGroupId").val();
            var termSemesterId = $("#termSemesterId").val();
            var subjectId = $(this).attr("data-subjectId");
            var studentId = $(this).attr("data-studentId");
            $(this).qtip({ 
                content: {
                    button: true,
                    title: "<b>Subject Grade Details</b>",
                    text: function(event, api) {
                        $.ajax({
                            url: '/ajax/subject/grade/details/term/'+subjectId+'/'+ayClassGroupId+'/'+termSemesterId+'/'+studentId,
                            cache: false
                        })
                        .then(function(content) {
                            api.set('content.text', content);
                        }, function(xhr, status, error) {
                            api.set('content.text', "An error occured. Could not load subject grade details");
                        });
                        return '<b>Loading...</b>';
                    }
                },
                 style: {
                    classes: 'qtip-bootstrap',
                    width: "720px"
                },
                position: {
                    my: "bottom left",
                    at: "top right",
                    viewport: $(window),
                    adjust: {
                        method: 'none shift'
                    },
                    target: self
                },
                show :{
                    event: "click",
                    solo: true,
                    modal: true
                }, 
                hide: 'unfocus'
            });
        });
        /************************************************
         Refersh page depending on grade display option
        ************************************************/
        $("input.gradeDisplay[type=radio]").click(function(){
            window.location.href = $("#requestUri").val()+"/"+$("#ayClassGroupId").val()+"/"+$("#termSemesterId").val()+"/"+$("#studentId").val()+"/"+$(this).val();
        });

        /********************************************************
         Student Subject Grade History Graph - Not being used now
        *********************************************************/
            $('a.subjectGraph').click(function(e){
                
                var self = $(this);
                var studentId = $("#studentId").val();
                var url = '/graph/student/grade/subject/summary/term/'+studentId+'/'+$(this).attr("data-subject");
                $.ajax({
                    url: url,
                    type:"GET",
                    success: function(result){
                        if(result.data.length <= 1){
                            var $span = $("<span>");
                                $span.html("<br/>[insufficient chart data]").css({"font-family":"Arial","font-size":"0.9rem","color":"#DD0000"});
                                self.closest("td").append($span);
                                setTimeout(function() {
                                    self.closest("td").find($span).fadeOut(300, function(){ $(this).remove();});
                                }, 1000);
                        }else{
                            self.qtip({    
                                content: {
                                    button: true,
                                    title: "<span style='font-variant:small-caps;font-size:15px;font-weight:bold;'>Student subject performance over time</span>",
                                    text: function(event, api) {
                                        var div = $("<div>");   
                                        var legendContainer = $("<div>");
                                        var flotContainer = $("<div>");
                                        legendContainer.attr("id", "newlegendContainer");
                                        flotContainer.attr("id","newflotContainer").css({"height":"350px","width":"950px"});

                                        div.css({"height":"450px","width":"1100px"});
                                        div.addClass("grafico");
                                        div.append('<div class="row" style="width:950px;"><div class="small-10 columns end text-left"><span style="font-variant:small-caps;font-size:15px;font-weight:bold;">' + result['title'] + '</span></div><div class="small-2 columns end text-right"><img style="margin-left:25px;margin-right:30px;cursor:pointer;" alt="download graph" title="Click to download graph" src="/images/download32.png" class="exportImage" data-graph-title="'+ result['saveTitle'] +'"/></div></div>');
                                        div.append(legendContainer);
                                        div.append(flotContainer);

                                        var data = result['data'];
                                        var ticks = result['ticks'];
                                        var threshold = result['threshold'];


                                        var newData = [
                                            {label:"Subject Grade (%)", data:data, showLabels: true, labelPlacement: "top", color:"orangered", lines: {fill: false, show: true}, points: {show: true,  fill: true, fillColor: "rgba(255, 0, 0, 1)" }}
                                            /*{label:"Pass Grade: " + result['passGrade']+"%", color:"#FF0000", lines: {fill: false, show: true}, data:threshold, points: {show: false}, showLabels: false}*/
                                        ];

                                        options.xaxis.ticks = ticks;
                                        options.legend.container = legendContainer;

                                        var graph = $.plot(flotContainer, newData, options);

                                        //bind the plotclick/plothover events to the div here
                                        div.bind("plotclick", function (event, pos, item) {
                                            if (item) {
                                                $("#charttooltip").remove();
                                                showChartTooltip(item.pageX, item.pageY, item.series.data[item.dataIndex][2], div);
                                            } else {
                                                 $("#charttooltip").remove();
                                            }
                                        });
                                        return div;
                                    }
                                },
                                style: {
                                    classes: 'qtip-bootstrap',
                                    height: "520px",
                                    width: "1150px"
                                },
                                position: {
                                    my: 'left center',
                                    at: 'right center',
                                    viewport: $(window),
                                    adjust: {
                                        method: 'none shift'
                                    },
                                    target: self
                                 },
                                show :{
                                    event: 'click',
                                    ready: true,
                                    solo: true,
                                    modal: {
                                        on: true,
                                        blur: false,
                                        escape: true
                                    }
                                }, 
                                hide:false
                            });
                        }
                    }
                });
            });


            /*******************************************
             To download subject history graph
            ********************************************/
            $("body").on("click","img.exportImage",function(){
                var div = $("div.grafico");
                var imgName = $(this).attr("data-graph-title");
                html2canvas(div, {
                    onrendered: function(canvas) {
                        theCanvas = canvas;
                        canvas.toBlob(function(blob) {
                            saveAs(blob, imgName+".png");
                        });
                        //$('.qtip:visible').qtip('hide');
                    }
                });
            });

            /*****************************************
             To modify the subject teachers - get list
            ******************************************/
            $("span.subjectTeacher").click(function() {
                initQtipSubjectTeacher ($(this));
            });

            /*****************************************
             To update final grade teacher selection
            ******************************************/
            $("body").on("click","span.scgt", function () {

                var span = $(this).closest('.qtip').data('qtip').options.position.target; 
                var teacherId = $(this).attr("data-id");
                var subjectId = $(this).attr("data-subjectId");
                var termSemesterId = $("#termSemesterId").val();
                var academicYearClassGroupId = $("#ayClassGroupId").val();
                var studentId = $("#studentId").val();

                $.ajax({
                    url: "/ajax/final/grade/subject/teacher/update",
                    type: "POST",
                    dataType: "json",
                    data: {academicYearClassGroupId:academicYearClassGroupId, studentId:studentId, termSemesterId:termSemesterId, subjectId:subjectId, teacherId:teacherId},
                    success: function(result) {
                        if (result.status) {
                            $('.qtip:visible').qtip('hide');
                            span.attr("data-teacherId", result.teacherId);
                            span.text(result.shortName);
                        } else {
                            //Do nothing
                        }
                    }              
                });
            });

            

           /************************************************
            To access other students in the class from page
           *************************************************/
           
           $("#changeStudent > a").click(function() {
                if ($("span#changeStudent").find("select").length == 0) {
                    var ayClassGroupId = $("#ayClassGroupId").val();
                    var termSemesterId = $("#termSemesterId").val();
                    var studentId = $("#studentId").val();
                    var gradeDisplay = $("input.gradeDisplay[type=radio]:checked").val();

                    if ($("textarea:visible").length > 0){
                        swal("Incomplete Data Entry", "Please save or cancel edit to comments before navigating to a new student.", "warning");
                        return false;
                    }
                    $.ajax({
                        url: '/ajax/students/by/group/period/'+ayClassGroupId+'/'+termSemesterId,
                        cache: false,
                        dataType: 'json',
                        type: 'GET',
                        success: function (result){
                            var $select = $("<select>",{class: "studentChange"});
                            var options = "<option value=''>--Select Student--</option>";
                            for(var j = 0; j < result.length; j++){
                                if (result[j].id != studentId) {
                                    options += '<option value="/classgroup/student/grade/summary/term/print/form/'+ayClassGroupId+'/'+termSemesterId+'/'+result[j].id+'/'+gradeDisplay+'">'+result[j].lastName +', ' + result[j].firstName+'</option>';
                                }
                            }
                            $select.html(options);
                            $select.css("width","160px");
                            $("span#changeStudent").append($select);
                        }
                    });
                }
            });

            $("body").on("change",".studentChange",function () {
               if ($(this).value != "") {
                    addOverlay('Student');
                    window.location.href = $(this).val();
               }
            });

            /*************************************
             To update the grade report signatory
            **************************************/
            //$("#gradeReportSignatoryId").chosen();
            $("body").on("click","#updateSignatory", function(){
                var signatoryId = $("#gradeReportSignatoryId").val();
                if (signatoryId == '') {
                    $("#gradeReportSignatoryId").addClass("error");
                    return false;
                } else {
                    $("#gradeReportSignatoryId").removeClass("error");
                    $.ajax({
                        url:"/classgroup/student/grade/summary/term/print/update/signatory",
                        type:"POST",
                        dataType:"json",
                        data: {id:$("#id").val(), gradeReportSignatoryId:signatoryId},
                        success: function(data){ 
                            if (data.status) {
                                $("#signatoryError").text("").css("display","none");
                                $("div.sigChange").find("a#removeSignatory").attr("data-signatoryId",signatoryId);
                                $("div.sigChange").find("a#changeSignatory").attr("data-signatoryId",signatoryId);
                                $("div.sigChange").find("span.sigName").html(data.signatoryName);
                                $("div.sigChange").find("span.sigTitle").html(data.signatoryTitle);
                                $("div.sigChange").find("span.sigPrefix").html(data.signatoryPrefix);
                                $("div.sigUpdate").css("display","none");
                                $("div.sigChange").css("display","block");
                            } else {
                                $("#signatoryError").text("Could not update signatory").css("display","inline-block");
                            }
                        }
                    });
                }
            });

            /*************************************
             To change the grade report signatory
            **************************************/
            $("body").on("click","#changeSignatory", function(){
                var signatoryId = $(this).attr("data-signatoryId");
                $("div.sigUpdate").find("select").val(signatoryId);
                $("div.sigChange").css("display","none");
                $("div.sigUpdate").css("display","block");
            });

            /*************************************
             To remove the grade report signatory
            **************************************/
            $("body").on("click","#removeSignatory", function(){
                $.ajax({
                    url:"/classgroup/student/grade/summary/term/print/remove/signatory",
                    type:"POST",
                    dataType:"json",
                    data: {id:$("#id").val()},
                    success: function(data){ 
                        if (data.status) {
                            $("#signatoryError").text("").css("display","none");
                            $("div.sigChange").find("a#removeSignatory").attr("data-signatoryId", "");
                            $("div.sigChange").find("a#changeSignatory").attr("data-signatoryId", "");
                            $("div.sigUpdate").find("select").val("");
                            $("div.sigChange").css("display","none");
                            $("div.sigUpdate").css("display","block");
                            
                        } else {
                            swal("Signatory Error", "Could not remove signatory","error");
                        }
                    }
                });
            });

            
    {/literal}
{/block}

{block name=dataTable}
    "paging":false,
    "searching": false,
    "info": false
{/block}

{block name=content}
    {nocache}
        {$msg}
    
        <div class="paper">
            
                <input type="hidden" name="id" id="id" value="{$printable->getId()}"/>
                <input type="hidden" name="ayClassGroupId" id="ayClassGroupId" value="{$ayClassGroup->getId()}"/>
                <input type="hidden" id="termSemesterId" value="{$termSemester->getId()}"/>
                <input type="hidden" id="studentId" value="{$student->getId()}"/>
                <input type="hidden" id="requestUri" value="{$requestUri}"/>
                <input type="hidden" id="gradeDisplay" value="{$gradeDisplay}"/>
            
                <div class="listTableCaption_simpleTable" style="color:#bbb;margin-top:2px;margin-bottom:10px;font-size:22px;">
                    student grade summary report
                </div>
                <div class="row">
                    <div class="medium-6 columns end">
                        <div class="row" >
                            <div class="medium-5 columns end">
                                <label class="medium-text-right small-text-left">Student:</label>
                            </div>
                            <div class="medium-7 end columns">
                                <label class="infoLabel text-left">
                                    <b><a href="/student/summary/{$student->getId()}">{$student->getFullName()}</a></b>
                                    {if !$currentUsr->isExternalUser() && $ayClassGroup->canBeViewedAtFacility()}
                                        &nbsp;
                                        <span id="changeStudent">
                                            <a style="border-bottom:1px dotted; font-size:0.75rem;color:#999;">change</a>
                                        </span>
                                    {/if}
                                </label>
                            </div>
                        </div>
                        <div class="row" >
                            <div class="medium-5 columns">
                                <label class="medium-text-right small-text-left">Sex:</label>
                            </div>
                            <div class="medium-7 end columns">
                                <label class="text-left"><b>{$student->getGender()->getName()}</b></label>
                            </div>

                        </div>
                        <div class="row" >
                            <div class="medium-5 columns">
                                <label class="medium-text-right small-text-left">Age:</label>
                            </div>
                            <div class="medium-7 end columns">
                                <label class="text-left">
                                    <b>{$student->getAgeAtDate($termSemester->getEndDate())} yrs</b>
                                </label>
                            </div>
                        </div>
                        <div class="row" >
                            <div class="medium-2 columns medium-5">
                                 <label class="medium-text-right small-text-left">Academic Period:</label>
                            </div>
                            <div class="medium-4 end columns medium-7">
                                <label class="text-left infoLabel">
                                    <span>
                                        <b>{$termSemester->getName()}&nbsp;({$termSemester->getAcademicYear()->getLabel()})</b>
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div class="row" >
                            <div class="medium-5 columns">
                                 <label class="medium-text-right small-text-left">Class:</label>
                            </div>
                            <div class="medium-7 end columns">
                                <label class="text-left infoLabel">
                                    <b>
                                        {if !$currentUsr->isExternalUser()}
                                            <a href="/classgroup/student/summary/{$ayClassGroup->getId()}/{$termSemester->getId()}">
                                                {$ayClassGroup->getClassGroup()->getName()}
                                            </a>
                                            {if !$ayClassGroup->isOpenForAcademicPeriod($termSemester->getId())}
                                                &nbsp;<span style="font-weight:normal;font-size:smaller; color:#dd0000;">(closed)</span>
                                            {/if}
                                        {else}
                                            {$ayClassGroup->getClassGroup()->getName()}
                                        {/if}
                                    </b>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="medium-6 columns end text-left">
                        <table width="90%" cellspacing="0" cellpadding="0" style="margin-left:35px;">
                            <thead>
                                <tr style="background-color:#d0e8e8;">
                                    <th colspan="3" style="color:#464646;text-align: center;border-right:1px solid #464646;">
                                        Grading
                                    </th>
                                    <th colspan="2"  style="color:#464646;text-align: center;">
                                        Attendance
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        &nbsp;
                                    </td>
                                    <td>
                                        <b>Avg.</b>
                                    </td>
                                    <td style="border-right:1px solid #464646;">
                                        <b>Rank</b>
                                    </td>
                                    <td>
                                        Possible Attendances 
                                    </td>
                                    <td>
                                        <b>{$periodAttendance['num_attendances']}</b>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Term
                                    </td>
                                    <td>
                                        <b>{$rank['average'][$student->getId()]['grade']}{*$termAverage['display']*}</b>
                                    </td>
                                    <td style="border-right:1px solid #464646;">
                                        {DbMapperUtility::addOrdinalSuffix($rank['average'][$student->getId()]['rank'])}
                                    </td>
                                    <td>
                                        Late
                                    </td>
                                    <td>
                                        <b>{$periodAttendance['late']}</b>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        {if $gradePref->hasAcademicPeriodExam()}
                                            Exam
                                        {else}
                                            &nbsp;
                                        {/if}
                                    </td>
                                    <td>
                                        <b>{*$termAverage['examDisplay']*}{$rank['examAverage'][$student->getId()]['grade']}</b>
                                    </td>
                                    <td style="border-right:1px solid #464646;">
                                        {DbMapperUtility::addOrdinalSuffix($rank['examAverage'][$student->getId()]['rank'])}
                                    </td>
                                    <td>
                                        Absent
                                    </td>
                                    <td>
                                        <b>{$periodAttendance['absent']}</b>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        {if $gradePref->hasFinalGrade()}
                                            Final
                                        {else}
                                            &nbsp;
                                        {/if}
                                    </td>
                                    <td>
                                        <b>{*$termAverage['finalGradeDisplay']*}{$rank['finalAverage'][$student->getId()]['grade']}</b>
                                    </td>
                                    <td style="border-right:1px solid #464646;">
                                        {DbMapperUtility::addOrdinalSuffix($rank['finalAverage'][$student->getId()]['rank'])}
                                    </td>
                                    <td>
                                        Punctuality
                                    </td>
                                    <td>
                                        
                                        <b>
                                            {if $periodAttendance['present'] != "" && $periodAttendance['num_attendances'] != 0}
                                                {(($periodAttendance['present']/$periodAttendance['num_attendances']) * 100)|number_format:1|floatval} %
                                            {else}
                                                &nbsp;
                                            {/if}
                                        </b>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        
                        <div class="row">
                            <div class="text-right small-11 columns end" style="padding:0 4px 0 0;">
                                Number in Class:
                            </div>
                            <div class="text-left small-1 columns end infoLabel" style="padding:0px;">
                                <b>{$numStudents}</b>
                            </div>
                        </div>
                        
                    </div>
                </div>
                                        
                <div class="row">
                    <div class="medium-12 columns">
                      <hr width="98%" size="2" color="#D0E0F0" style="margin:10px;"/>
                    </div>
                </div>

                <div align="left">
                    <div class="row"  style="width:100%;">
                        <div class="medium-4 columns end text-left">
                            <span class="missingGrades">*</span>:&nbsp;
                            <span style="font-size: 0.9rem;color:#555;">
                                represents an incomplete grade
                                <a href="#" class="hintanchorRow" onMouseover="showhint('A grade is <b>incomplete</b> if the student is missing a grade for any of the assigned subjects or any graded activity for one or more subjects', this, event, '200px')">&nbsp;</a>
                            </span>
                        </div>
                        <div class="medium-3 columns small-text-left medium-text-right infoLabel end">
                                Display options:
                                <a href="#" class="hintanchorRow" onMouseover="showhint('Use the following options to determine how you would like the grades to be displayed', this, event, '200px')">&nbsp;</a>
                        </div>
                        <div class="medium-5 columns end text-left">
                            &nbsp;&nbsp;<input class="gradeDisplay" type="radio" name="displayOpt" id="numeric" value="numeric" {if $gradeDisplay == "NUMERIC"} checked {/if}/><label for="numeric">Numeric</label>
                            &nbsp;<input class="gradeDisplay" type="radio" name="displayOpt" id="letter" value="letter" {if $gradeDisplay == "LETTER"} checked {/if}/><label for="letter">Letter</label>
                            &nbsp;<input class="gradeDisplay" type="radio" name="displayOpt" id="gpa" value="gpa" {if $gradeDisplay == "GPA"} checked {/if}/><label for="gpa">GPA</label>
                        </div>
                    </div>
                    {if !$currentUsr->isExternalUser() && $ayClassGroup->canBeViewedAtFacility()}
                    <div class="row">
                        <div class="small-12 columns end text-right">
                            <a class="reportScroll overlayClick" data-type="Student" href="/classgroup/student/grade/summary/term/print/form/{$ayClassGroup->getId()}/{$termSemester->getId()}/{$scroller['previous']}/{$gradeDisplay}">&#8810;&nbsp;Prev</a>
                            &nbsp;&nbsp;
                            <a class="reportScroll overlayClick" data-type="Student" href="/classgroup/student/grade/summary/term/print/form/{$ayClassGroup->getId()}/{$termSemester->getId()}/{$scroller['next']}/{$gradeDisplay}">Next&nbsp;&#8811;</a>
                        </div>
                    </div>
                    {/if}
                    <table align="left" class="listTable secondaryDisplayTable" width="98%" border="0" cellspacing="1" style="margin-top:4px;margin-bottom:4px;margin-left: 15px;">
                        <thead>
                            <tr>
                                <th width="20%">
                                    <span class="show">
                                        Subject&nbsp;
                                        {*<a href="#" class="hintanchorRow" onMouseover="showhint('Click on subject names to show a graphical representation of the student\'s performance in the subject over time.', this, event, '200px')">
                                            &nbsp;&nbsp;
                                        </a>
                                    </span>
                                    <span class="show-for-small-down">
                                        Subject&nbsp;*}
                                    </span>
                                </th>
                                <th width="8%">Term {if $gradeDisplay == "NUMERIC"}(%){/if}</th>
                                {if $gradePref->hasAcademicPeriodExam()}
                                    <th width="8%">Exam {if $gradeDisplay == "NUMERIC"}(%){/if}</th>
                                {/if}
                                {if $gradePref->hasFinalGrade() && $termSemester->getId() == $lastTermSemester->getId()}
                                    <th width="8%">Final {if $gradeDisplay == "NUMERIC"}(%){/if}</th>
                                {/if}
                                <th width="5%">Conduct</th>
                                <th width="35%">Comments</th>
                                <th width="15%">
                                    Teacher
                                    <a href="#" class="hintanchorRow" onMouseover="showhint('If class group is <b>NOT</b> closed, click on teacher name or --- to choose or change subject teacher.', this, event, '200px')">
                                        &nbsp;&nbsp;
                                    </a>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            {foreach from=$subjects item=subject}
                                <tr>
                                    {if $subject->getCode()|array_key_exists:$studentAcademicPeriodGrades || $letterSubjectGrade->subjectUsesLetterGrades($ayClassGroup->getId(), $termSemester->getId(), $subject->getId())}
                                        {*if $studentAcademicPeriodGrades[$subject->getCode()]['complete']}{/if*}
                                        {$fgr=$finalGradeRemark->getByParameters($ayClassGroup->getId(), $termSemester->getId(), $subject->getId(), $student->getId())}
                                        
                                        <td>
                                            <a href="#" class="" data-subject="{$subject->getId()}" onclick="return false;">
                                                {$subject->getName()}
                                            </a>
                                        </td>
                                        <td>
                                            <b>
                                                {if $letterSubjectGrade->subjectUsesLetterGrades($ayClassGroup->getId(), $termSemester->getId(), $subject->getId())}
                                                    <span>{$fgr->getLetterGrade()}</span>
                                                {else}  
                                                    <span class="hotspot gradeDetails" title="" data-studentId="{$student->getId()}" data-subjectId="{$subject->getId()}">
                                                        {if $studentAcademicPeriodGrades[$subject->getCode()]['grade'] !== "" &&  (!$onlyCompleteGrades || ($onlyCompleteGrades && !$currentUsr->isExternalUser()) || $studentAcademicPeriodGrades[$subject->getCode()]['complete'])}
                                                            {$studentAcademicPeriodGrades[$subject->getCode()]['display']}
                                                            {if !$studentAcademicPeriodGrades[$subject->getCode()]['complete']} <span class="missingGrades">*</span> {/if}
                                                        {else}
                                                            &nbsp;
                                                        {/if}
                                                    </span>
                                                {/if}
                                            </b>
                                        </td>
                                        {if $gradePref->hasAcademicPeriodExam()}
                                            <td>
                                                <b>
                                                    <span>
                                                        {if $studentAcademicPeriodGrades[$subject->getCode()]['examGrade'] !== ""}
                                                            {$studentAcademicPeriodGrades[$subject->getCode()]['examDisplay']}
                                                        {else}
                                                            &nbsp;
                                                        {/if}
                                                    </span>
                                                    
                                                </b>
                                            </td>
                                        {/if}
                                        {if $gradePref->hasFinalGrade() && $termSemester->getId() == $lastTermSemester->getId()}
                                            <td>
                                                <b>
                                                    {if $letterSubjectGrade->subjectUsesLetterGrades($ayClassGroup->getId(), $termSemester->getId(), $subject->getId())}
                                                        &nbsp;
                                                    {else}
                                                        <span>
                                                            {if $studentAcademicPeriodGrades[$subject->getCode()]['overrideFinalGrade']}
                                                                {if  $studentAcademicPeriodGrades[$subject->getCode()]['finalGradeOverride'] !== ""}
                                                                    <b><font color='#006699'>
                                                                        {$studentAcademicPeriodGrades[$subject->getCode()]['finalGradeOverrideDisplay']}
                                                                    </font></b>
                                                                {/if}
                                                            {elseif $studentAcademicPeriodGrades[$subject->getCode()]['finalGrade'] !== ""}
                                                                {$studentAcademicPeriodGrades[$subject->getCode()]['finalGradeDisplay']}
                                                            {else}
                                                                &nbsp;
                                                            {/if}
                                                        </span>
                                                    {/if}
                                                </b>
                                            </td>
                                        {/if}
                                        
                                        <td>
                                            {if ($studentAcademicPeriodGrades[$subject->getCode()]['complete'] || $letterSubjectGrade->subjectUsesLetterGrades($ayClassGroup->getId(), $termSemester->getId(), $subject->getId()))}
                                                &nbsp;<i><b>{$fgr->getConductGradeClean()}</b></i>
                                            {/if}
                                        </td>
                                        <td>
                                            {if $studentAcademicPeriodGrades[$subject->getCode()]['complete']}
                                                {$fgr->getRemarks()}
                                            {/if}
                                        </td>
                                        <td>
                                            {$sTeacher=$finalGradeSubjectTeacher->getByParameters($ayClassGroup->getId(), $termSemester->getId(), $subject->getId(), $student->getId())->getTeacher()}
                                            {if $ayClassGroup->isOpenForAcademicPeriod($termSemester->getId()) && !$currentUsr->isExternalUser() && $ayClassGroup->isAtCurrentFacility()
                                                && ($isHomeroomTeacher || PermissionManager::userHasPermissionAtFacility('OVERRIDE.HOMEROOM.TEACHER.PRIVILEGE',$smarty.session.userId, $ayClassGroup->getFacilityId()))}
                                                <span class="subjectTeacher" data-teacherId="{$sTeacher->getId()}" data-subjectId="{$subject->getId()}" style="cursor:pointer;">
                                                    {if $sTeacher->getId() != ""}
                                                        {$sTeacher->getShortName()}
                                                    {else}
                                                        ---
                                                    {/if}
                                                </span>
                                            {else}
                                                {if $sTeacher->getId() != ""}
                                                    {$sTeacher->getShortName()}
                                                {else}
                                                    &nbsp;
                                                {/if}
                                            {/if}
                                        </td>
                                        
                                    {else}
                                        <td>
                                            <a href="#" class="subjectGraph" data-subject="{$subject->getId()}" onclick="return false;">
                                                {$subject->getName()}
                                            </a>
                                        </td>
                                        <td>&nbsp;</td>
                                        {if $gradePref->hasAcademicPeriodExam()}
                                            <td>&nbsp;</td>
                                        {/if}
                                        {if $gradePref->hasFinalGrade() && $termSemester->getId() == $lastTermSemester->getId()}
                                            <td>&nbsp;</td>
                                        {/if}
                                        {*<td>
                                            <span class="hotspot" title="Highest Grade in Class: <b>{$highestGrades[$subject->getCode()]['grade']}%</b>">
                                                {$highestGrades[$subject->getCode()]['display']}
                                            </span>
                                        </td>*}
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>
                                            &nbsp;
                                            {*$finalGradeSubjectTeacher->getByParameters($ayClassGroup->getId(), $termSemester->getId(), $subject->getId(), $student->getId())->getTeacher()->getShortName()*}
                                            {*$subjectTeacher->getTeacherLabelBySubjectTermSemester($ayClassGroup->getId(), $subject->getId(), $termSemester->getId())*}
                                        </td>
                                    {/if}
                                </tr>
                           {/foreach}
                        </tbody>
                    </table>
                </div>
                {if !$currentUsr->isExternalUser() && $ayClassGroup->canBeViewedAtFacility()}
                <div class="row">
                    <div class="small-12 columns end text-right">
                        <a class="reportScroll overlayClick" data-type="Student" href="/classgroup/student/grade/summary/term/print/form/{$ayClassGroup->getId()}/{$termSemester->getId()}/{$scroller['previous']}/{$gradeDisplay}">&#8810;&nbsp;Prev</a>
                        &nbsp;&nbsp;
                        <a class="reportScroll overlayClick" data-type="Student" href="/classgroup/student/grade/summary/term/print/form/{$ayClassGroup->getId()}/{$termSemester->getId()}/{$scroller['next']}/{$gradeDisplay}">Next&nbsp;&#8811;</a>
                    </div>
                </div>  
                {/if}
                <div class="row">
                    <div class="medium-8 end columns">
                        <label class="medium-text-left infoLabel" style='color:#888;'>
                            {PropertyService::getProperty("class.teacher.title","Homeroom Teacher")} comments:<a href="#" class="hintanchorRow" onMouseover="showhint('Click edit link (if available) to enter comments.', this, event, '200px')">&nbsp;</a>
                            
                            {if $ayClassGroup->isOpenForAcademicPeriod($termSemester->getId()) && $isCurrentAssignment 
                                && ($isHomeroomTeacher || PermissionManager::userHasPermissionAtFacility('OVERRIDE.HOMEROOM.TEACHER.PRIVILEGE',$smarty.session.userId, $ayClassGroup->getClassGroup()->getFacilityId()))}
                                    <span> <a class="editComments" href="#" onclick="return false;"><i class="fas fa-edit" style="font-size:1.2rem;color:#008cba;"></i></a></span>
                            {/if}
                            
                            <div style="color:#333;width:75%;">
                                <span id="comments" data-comments="{$printable->getComments()}">
                                    {$printable->getComments()|html_entity_decode} 
                                </span> 
                            </div>
                            <div class="comments_separator" style="display:{if $printable->getComments()|trim eq ''}none{else}inline-block{/if};color:#008cba;text-align:left;font-size:1.1rem;">
                                ---------------------
                            </div>
                        </label>
                    </div>
                </div>
                {if PropertyService::getBoolean("has.academic.year.grade.level.coordinator") && $yearCoordinators|count gt 0}
                    <br/>
                    <div class="row">
                        <div class="medium-8 end columns">
                            <label class="medium-text-left infoLabel" style='color:#888;'>
                                {PropertyService::getProperty("academic.year.grade.level.coordinator.designation","Year Coordinator")} comments:<a href="#" class="hintanchorRow" onMouseover="showhint('Click edit link (if available) to enter comments.', this, event, '200px')">&nbsp;</a>

                                {if $ayClassGroup->isOpenForAcademicPeriod($termSemester->getId()) && $isCurrentAssignment 
                                    && ($coordinator->isUserCoordinator($currentUsr->getId(), $ayClassGroup->getFacilityId(), $ayClassGroup->getAcademicYearId(), $ayClassGroup->getClassGroup()->getGradeLevelId()) 
                                    || PermissionManager::userHasPermissionAtFacility('OVERRIDE.HOMEROOM.TEACHER.PRIVILEGE',$smarty.session.userId, $ayClassGroup->getClassGroup()->getFacilityId()) || $currentUsr->isSystem())}
                                        <span> <a class="editRemarks" href="#" onclick="return false;"><i class="fas fa-edit" style="font-size:1.2rem;color:#008cba;"></i></a></span>
                                {/if}

                                <div style="color:#333;width:75%;">
                                    <span id="remarks" data-remarks="{$printable->getCoordinatorRemarks()}">
                                        {$printable->getCoordinatorRemarks()|html_entity_decode} 
                                    </span> 
                                </div>
                                
                                <div class='signed' {if (!$coordinatorSignatory->isIdEmpty() && $coordinatorSignatory->getCoordinatorId() != '') || $printable->getCoordinatorRemarks() != ''} style="display:block;"  {/if}>
                                    -------------------------<br/>
                                    <strong><span>{$coordinatorSignatory->getCoordinator()->getTeacher()->getLabel()}</span></strong>&nbsp;(sgd)
                                </div>
                               
                                
                                <div class='signatory'  style='display:none;color:#464646;'>Signed by: &nbsp;&nbsp;
                                    {foreach from=$yearCoordinators item=coordinator}
                                        <input type="radio" name='sign' value="{$coordinator->getId()}" {if $coordinator->getTeacher()->getUserId() == $currentUsr->getId()} checked {/if} name="yearCoordinator"/>&nbsp;{$coordinator->getTeacher()->getLabel()}&nbsp;&nbsp;
                                    {/foreach}
                                </div>
                                {if !$coordinator->isUserCoordinator($currentUsr->getId(), $ayClassGroup->getFacilityId(), $ayClassGroup->getAcademicYearId(), $ayClassGroup->getClassGroup()->getGradeLevelId())}
                                    <input type="hidden" id="chkCoord" value="1"/>
                                {/if}
                                
                                <div id="errSign">
                                    please choose a {PropertyService::getProperty("academic.year.grade.level.coordinator.designation","Year Coordinator")} to proceed
                                </div>
                            </label>
                        </div>
                    </div>
                {/if}
                {if PropertyService::getBoolean("has.head.teacher.comments")}
                    <br/>
                    <div class="row">
                        <div class="medium-8 end columns">
                            <label class="medium-text-left infoLabel" style='color:#888;'>
                                {$headTeacher->getHeadTeacherDesignation()->getName()} comments:<a href="#" class="hintanchorRow" onMouseover="showhint('Click edit link (if available) to enter comments.', this, event, '200px')">&nbsp;</a>

                                {if $ayClassGroup->isOpenForAcademicPeriod($termSemester->getId()) && $isCurrentAssignment 
                                    && ($smarty.session.userId == $headTeacher->getTeacher()->getUserId() || $isHomeroomTeacher 
                                    || PermissionManager::userHasPermissionAtFacility('OVERRIDE.HOMEROOM.TEACHER.PRIVILEGE',$smarty.session.userId, $ayClassGroup->getClassGroup()->getFacilityId()) || $currentUsr->isSystem())}
                                        <span> <a class="editHTRemarks" href="#" onclick="return false;"><i class="fas fa-edit" style="font-size:1.2rem;color:#008cba;"></i></a></span>
                                {/if}

                                <div style="color:#333;width:75%;">
                                    <span id="htremarks" data-remarks="{$printable->getHeadTeacherRemarks()}">
                                        {$printable->getHeadTeacherRemarks()|html_entity_decode} 
                                    </span> 
                                </div>
                                
                            </label>
                        </div>
                    </div>
                {/if}
                {if PropertyService::getBoolean("show.report.grade.signatory")}
                    <div class="row">
                        <div class="medium-4 columns end">
                            <label class="medium-text-left infoLabel" style='color:#888;'>
                                <span>
                                    Grade Report Signatory:
                                    <a href="#" class="hintanchorRow" onMouseover="showhint('If left blank, the grade report signatory will default to the head teacher/principal.', this, event, '200px')">&nbsp;</a></span>
                                </span>

                                    <div class="sigChange" style="{if $printable->getGradeReportSignatoryId() != ''}display:block;{else}display:none;{/if}">
                                        <span class="sigName" style="font-weight:bold;color:#000000;">{$printable->getGradeReportSignatory()->getUser()->getLabel()}</span>
                                        &ensp;<a data-signatoryId="{$printable->getGradeReportSignatoryId()}" style="padding-top:10px;padding-left:6px;font-size:0.85rem;" id="changeSignatory" href='#' onclick="return false;">change</a>
                                        &ensp;<a data-signatoryId="{$printable->getGradeReportSignatoryId()}" style="padding-top:10px;padding-left:2px;font-size:0.85rem;color:#FF0000;" id="removeSignatory" href='#' onclick="return false;">remove</a>
                                        <br/><span style="font-style:italic;color:#000000;font-size:0.85rem;" class="sigTitle">{$printable->getGradeReportSignatory()->getTitle()}</span>
                                        <br/><span style="font-style:italic;color:#000000;font-size:0.85rem;" class="sigPrefix">{$printable->getGradeReportSignatory()->getPrefixedAddition()}</span>
                                    </div>

                                    <div class="sigUpdate" style="{if $printable->getGradeReportSignatoryId() != ''}display:none;{else}display:block;{/if}">
                                        <select id="gradeReportSignatoryId" style='display:inline-block;width:80%;'>
                                            {html_options options=$signatories}
                                        </select>

                                        <a id="updateSignatory" style='display:inline-block;width:20%;float:right;font-size:0.85rem;padding:7px 6px;' href='#' onclick="return false;">update</a>
                                        <small style="color:#FF0000;display:none;" id="signatoryError"></small>
                                    </div>
                            </label>
                        </div>
                    </div>
                {/if}
                <div class="row">
                    <div class="medium-12 columns">
                      <hr width="98%" size="2" color="#D0E0F0" style="margin:10px;"/>
                    </div>
                </div>
                <div class="row" align="left" style="width:100%;">
                    <div class="medium-2 end columns">
                        <label class="text-left" style="padding-top:10px;">
                            {if ($smarty.session.isEducational && ($isHomeroomTeacher || PermissionManager::userHasPermissionAtFacility('OVERRIDE.HOMEROOM.TEACHER.PRIVILEGE',$smarty.session.userId, $ayClassGroup->getClassGroup()->getFacilityId())))
                                || ($smarty.session.isAdmin && PermissionManager::userHasPermission("GENERATE.TERM.GRADE.PDF",$smarty.session.userId))}
                                <a tabindex="1" href="{Config::$PDF_GRADE_REPORT_DIR}{$gradeReportSuffix->getReportSuffix()}/studentGradeReport.php?id={$printable->getId()}&gd={$gradeDisplay}" target="_blank">
                                    Print Report
                                </a>
                                <a href="#" class="hintanchorRow" onMouseover="showhint('The report will display the grades to match the current display option', this, event, '200px')">&nbsp;</a>
                            {/if}
                        </label>
                    </div>
                    <div class="medium-3 end columns">
                        <label class="text-left" style="padding-top:10px;"> {*{$gradeReportSuffix->getReportSuffix()}*}
                            {if ($smarty.session.isEducational && $isCurrentAssignment && ($isHomeroomTeacher || PermissionManager::userHasPermissionAtFacility('OVERRIDE.HOMEROOM.TEACHER.PRIVILEGE',$smarty.session.userId, $ayClassGroup->getClassGroup()->getFacilityId())))
                                || ($smarty.session.isAdmin && PermissionManager::userHasPermission("SEND.GRADE.VIA.EMAIL",$smarty.session.userId))}
                                <a href="#" tabindex="2" onclick="return false;" id="emailSend">
                                    Send via Email
                                </a>
                            {/if}
                        </label>
                    </div>
                    <div class="medium-4 end columns"> 
                        <label class="text-left" style="padding-top:10px;">
                            {if $smarty.session.isAdmin || ($smarty.session.isEducational && PermissionManager::userHasPermission("VIEW.ACADEMIC.SUMMARY",$smarty.session.userId))}
                                <a href="/student/summary/{$printable->getStudentId()}#grade" tabindex="3" class="reset">
                                    Student Grade Summary
                                </a>
                            {/if}
                        </label>
                    </div>
                    <div class="medium-3 end columns">  
                        <label class="text-left" style="padding-top:10px;">
                            {if (($smarty.session.isEducational && PermissionManager::userHasPermissionInList("VIEW.CLASS.TERM.GRADE.SUMMARY,RECORD.STUDENT.GRADES",$smarty.session.userId))
                                || $printable->getAcademicYearClassGroup()->canBeViewedAtFacility()) && !$currentUsr->isExternalUser()}
                                <a href="/classgroup/grade/summary/term/view/{$ayClassGroup->getId()}/{$termSemester->getId()}/0/{$gradeDisplay}" tabindex="4" class="reset">
                                    Term Grade Summary
                                </a>
                            {/if}
                        </label>
                    </div>
                </div>
               
        </div>
{* Now the history table goes here if you have the permissions must be able to print from here though*}
{if $histories|count gt 0 && PermissionManager::userHasPermissionAtFacility("VIEW.GRADE.REPORT.HISTORY",$smarty.session.userId, $smarty.session.facilityId)}
    <div class="row">
        <div class="medium-12 columns">
          <hr width="98%" size="2" color="#D0E0F0"/>
        </div>
    </div>
    <div class="listTableCaption_simpleTable" style="margin-top:3px;">Report Generation History </div> 
    <table id="teacherAssignmentTable" class="listTable displayTable_simpleTable" border="0" width="94%" cellspacing="0" cellpadding="0">
        <thead>
            <tr>
                <th>Head Teacher Designation</th>
                <th>Head Teacher</th>
                <th>Homeroom Teacher</th>
                <th>Generated By</th>
                <th>Generated Time</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            {foreach from=$histories item=history}
                <tr>
                    <td>{$history->getHeadTeacherDesignation()->getLabel()}</td>
                    <td>{$history->getFacilityHeadTeacher()->getTeacher()->getLabel()}</td>
                    <td>{$history->getHomeroomTeacher()->getLabel()}</td>
                    <td>{$history->getGeneratedBy()->getLabel()}</td>
                    <td>{$history->getTimeGenerated()|date_format:"%b %e, %Y %l:%M %p (%A)"}</td>
                    <td>
                        {*if ($smarty.session.isEducational && $isCurrentAssignment && ($isHomeroomTeacher || $prmManager->userHasPermissionAtFacility('GENERATE.TERM.GRADE.PDF',$smarty.session.userId, $ayClassGroup->getClassGroup()->getFacilityId())))
                            || ($smarty.session.isAdmin && $prmManager->userHasPermission("GENERATE.TERM.GRADE.PDF",$smarty.session.userId))}
                                <a target="_blank" href="/pdfs/termGradeSummaryReportFromHistory.php?id={$history->getId()}&gd={$gradeDisplay}">Print Report</a>
                        {/if*}
                    </td>
                </tr> 
            {/foreach}
        </tbody>
    </table>
{/if} 


    <!-- modal content for sending emails -->
    <div id="basic-modal-content">
        <div class='modalHeader'  align="center" >select email recipients</div>
        <br/>
            {assign var="addrs" value="0"}
            {if $guardians|count gt 0}
                
                {foreach from=$guardians item=guardian}
                    {if $guardian->getEmail() != ''}
                        {* increment the count of addresses available *}
                        {assign var="addrs" value="{$addrs +1}"}
                        <div class="row">
                            <div class="medium-12 columns">
                                <input type="checkbox" value="{$guardian->getEmail()}:sep:{$guardian->getLabel()}" class="emailBox"/>
                                &nbsp;{$guardian->getLabel()}&nbsp;-&nbsp;<span style='color:orange;'>{$guardian->getRelation()->getName()}</span>
                                &nbsp;<span style='font-weight:normal;'>[{$guardian->getEmail()}]</span>
                            </div>
                        </div> 
                    {/if}
                {/foreach}
            {/if}
            {if $printable->getStudent()->getEmail() != ''}
                {assign var="addrs" value="{$addrs +1}"}
                <div class="row">
                    <div class="medium-12 columns">
                        <input type="checkbox" value="{$printable->getStudent()->getEmail()}:sep:{$printable->getStudent()->getName()}" class="emailBox"/>
                        &nbsp;{$printable->getStudent()->getName()}&nbsp;-&nbsp;<span style='color:orange;'>The student</span>
                        &nbsp;<span style='font-weight:normal;'>[{$printable->getStudent()->getEmail()}]</span>
                    </div>
                </div>   
            {/if}
            {if $addrs eq 0}
                <div class="infoMessage" style="font-size:0.9rem !important;line-height:1.1rem !important;">Neither the student or guardians have associated email addresses.<br>Please enter addresses manually, separated by a comma, to proceed.</div>
                <br/>
            {/if}
            <div class="row">
                <div class="medium-9 columns ends">
                    <label><span class="{if $addrs eq 0}required{/if}">Manually enter email addresses <small>(separate email addresses with a comma)</small></span>
                        <textarea id="manualEmail" cols="20" rows="2" wrap="soft"></textarea>
                    </label>
                </div>
            </div>
            
                <div class="row">
                    <div class="medium-12 end columns">
                        <div id="progressBar" >
                            <div class="progress-label">
                                
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="row" >
                    <div class="medium-6 columns">
                        <input type="button" class="button" id="sendEmail" value="Send"/>
                    </div>
                 </div> 
                <div class="row" >
                    <div class="medium-12 columns">
                        <div id="emailErr" class="emptyListMessage" style='font-size:0.9rem !important;'></div>
                    </div>
                </div>
           
            
        	
    </div>
    {/nocache}
{/block}
