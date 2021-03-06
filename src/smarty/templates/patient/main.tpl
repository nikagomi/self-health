{*Author: Randal Neptune*}
{*Project: EduRecord*}

{extends file="base/body.tpl"}

{block name=dataTable}
     {literal}
       fixedHeader: false
   {/literal}
{/block}

{block name=styles}
    {literal}
        .infoLabel {
            font-family: 'Poppins', sans-serif !important;
            font-size: 1rem  !important;
            font-weight: normal  !important;
        }
        
        .viewLabel {
            font-family: 'Poppins', sans-serif !important;
            font-size: 0.9rem  !important;
            color: #555555 !important;;
        }
       
        #btnCrop, #btnZoomIn, #btnZoomOut, #snap, #next, #reset, #endVideo {
            border-radius: 3px;
            width: 50px;
            height: 18px;
            font-size: 12px;
            font-weight: normal;
            border: none;
            background: none;
            background-color: white !important;
            box-shadow: none;
            margin-right: 3px;
            padding-bottom: 2px;
        }
        
        h5 {
            font-weight: bold;
        }
        
        .working{
            color:#506070;
        }
        
        #tabs { 
            padding: 0px; 
            background: none; 
            border-width: 0px;
            width: 100%;
            margin-left: 5px;
            margin-top: 10px; 
            font-size: 80%;
        } 
        
        ul.accordion { 
            font-size: 80%;
        }
        
        ul.accordion  > li{
            background-color:lightblue;
        }
        
        #tabs .ui-tabs-nav { 
            padding-left: 0px; 
            background: transparent; 
            border-width: 0px 0px 1px 0px; 
            -moz-border-radius: 0px; 
            -webkit-border-radius: 0px; 
            border-radius: 0px; 
        } 
        
        #tabs .ui-tabs-panel { 
            border-width: 0px 1px 1px 1px; 
            min-height: 330px;
            border-color:#444;
            font-size: 0.8rem;
        }

        #tabs .ui-tabs-nav li.ui-tabs-selected, 
        #tabs .ui-tabs-nav li.ui-state-active { 
            margin-top: 0em; 
            font-size: 100%; 
        }

        #summary{
            border:1px solid #444;/*lightblue */
            min-height:300px;
            margin-top:42px;
            padding: 0px;
            background-color: #f5f5f5;
        }

        /*.modalHeader{
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
        }*/

        .details{
            margin: 5px 0px 0px 4px;
        }

        .summaryLabel{
            text-align: right;
            margin: 0px 0px 0px 0px;
            width: 25%;
            padding-right: 0px;
        }

        .summaryInfo{
            text-align: left;
            font-weight: bold;
            width:75%;
        }

        #newRow{
            background-color:#EEEECC;
            height: 35px;
        }

        .assignSchool, .assignHere{
            font-style:italic;
            text-decoration:underline;
            color:#003366;
            font-size:10px;
        }
        
        .editSchool{
            color:purple;
        }
        
        #schools{
            width:95%;
            font-size:12px;
            height:25px;
            padding:0px;
            margin:0px;
        }
        
        
        
        .editLink{
            color: #719caa !important;
            font-weight: bold;
            font-size:1rem;
        }
        
        .imgStore{
            display:none;
        }
        
        
                
        .imageHolder{
            min-height:80px;
            background-color:#506070;
            padding-top:15px;
            border-bottom:4px solid #444;
        }
                
        .extAccess{
            color: purple;
            font-size:0.75rem;
            cursor: pointer;
            padding-left:5px;
        }
        
        div.error{
            color:#FF0000;
            font-weight:normal;
            font-size:0.9rem;
            padding: 5px 0px;
            font-family:"Arial";
        }
        
        div.moreActions{
            display: none;
        }
        
        div.moreActions a{
            
        }
        
        tr#newRow  div.chosen-container {
            min-width: 150px !important;
        }
        
        span.bulletSpan{
            font-family:verdana; 
            font-size:0.925rem;
            line-height:2.0rem;
            font-weight:bold;
        }
        
        .notify{
            background-color: orangered;
            color: #FFFFFF;
            font-size: 10px;
            font-family: Arial;
            text-align:right;
            padding: 3px 5px;
            border-radius: 4px;
            margin-left: 8px;
            cursor: pointer;
        }
        
        /* For photo and new modal box views */
        .imageBox { 
            position: relative;
            height: 400px;
            width: 400px;
            border:1px solid #aaa;
            background: #fff;
            overflow: hidden;
            background-repeat: no-repeat;
            cursor:move;
        }

        .imageBox .thumbBox {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 200px;
            height: 200px;
            margin-top: -100px;
            margin-left: -100px;
            box-sizing: border-box;
            border: 1px solid rgb(102, 102, 102);
            box-shadow: 0 0 0 1000px rgba(0, 0, 0, 0.5);
            background: none repeat scroll 0% 0% transparent;
        }

        .imageBox .spinner {
            position: absolute;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            text-align: center;
            line-height: 400px;
            background: rgba(0,0,0,0.7);
        }
        .container {
            position: relative;
            width: 400px;
        }

        .action {
            width: 400px;
            height: 30px;
            margin: 10px 0;
        }

        .cropped>img {
            margin-right: 10px;
            cursor: pointer;
        }


        video {
            object-fit: fill;
        }

        .modalDialog {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.8);
            z-index: 99999;
            opacity: 0;
            -webkit-transition: opacity 400ms ease-in;
            -moz-transition: opacity 400ms ease-in;
            transition: opacity 400ms ease-in;
            pointer-events: none;
            overflow: auto;
        }

        .modalDialog:target {
            opacity: 1;
            pointer-events: auto;
        }

        .modalDialog > div {
            width: 440px !important;
            position: relative;
            margin: 3% auto;
            padding: 5px 20px 13px 20px;
            border-radius: 10px;
            background: #fff;
            background: -moz-linear-gradient(#fff, #999);
            background: -webkit-linear-gradient(#fff, #999);
            background-color: rgba(0, 0, 0, 1);
        }

        .smallModal > div {
            width: 240px !important;
        }

        .close {
            background: #606061;
            color: #FFFFFF;
            line-height: 25px;
            position: absolute;
            right: -12px;
            text-align: center;
            top: -10px;
            width: 24px;
            text-decoration: none;
            font-weight: bold;
            border-radius: 12px;
            -webkit-border-radius: 12px;
            -moz-border-radius: 12px;
            box-shadow: 1px 1px 3px #000000;
            -webkit-box-shadow: 1px 1px 3px #000000;
            -moz-box-shadow: 1px 1px 3px #000000;
            font-family: sans-serif arial helvetica;
        }

        .close:hover {
            background: #00d9ff;
        }

        .patientImage {
            cursor: pointer;
        }
        
        .block{
            margin-left: 25px;
        }
        
        .block li{
            padding: 0px;
        }
        
        .hotspotNoBorder {
            border:none !important;
        }
        
        #btnSaveSign {
            font-size: 1rem !important;
            margin-top:10px !important;
            width: auto !important;
            padding-left: 3px;
            padding-right: 3px;
        }
        #signArea{
            width:350px;
            margin: 5px 10px 10px 10px;
            text-align:left;
            display:none;
        }
        .sign-container {
            width: 60%;
            margin: auto;
        }
        .sign-preview {
            width: 150px;
            height: 50px;
            border: solid 1px #CFCFCF;
            margin: 10px 5px;
        }
        .tag-ingo {
            font-family: cursive;
            font-size: 1.1rem;
            text-align: left;
            font-style: oblique;
        }
        .signErr {
            display:none;
            color: #DD0000;
            font-size: 1rem;
        }
        
        .homeCareBlock {
            color: #FFFFFF;
            font-variant: small-caps;
            font-sie: 1rem;
            padding:3px 2px;
            vertical-align:middle;
            margin-bottom: 3px;
            border:solid 1px #CCCCCC;
        }
        
        .approved {
            background-color:#3CB371;
        }
        
        .pending {
            background-color:#F79862;
        }
        
        .deferred {
            background-color:#CD5C5C;
        }
        
        
    {/literal}
{/block}

{block name="scripts"}
    {literal}
        var smallScreen = window.matchMedia("(max-width: 40.0625em)");
        var emailWidth = (smallScreen.matches) ? "95%" : "550px";
        
        var canvasDrawn = false;
        
        function truncateText(text, val){
            var newLength = val - 3;
            return (text.length > val) ? text.substring(0, newLength) + "..." : text; 
             
        }
        
        function validateEmail(email){
            return /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))$/i.test(email);
        }
        
       
        var tabOptions = {
            overflowTabs: true,
            beforeLoad: function( event, ui ) {
                if(ui.panel.html() == ''){
                    ui.panel.html("<div align='center' style='margin-top: 50px;'><img src='/images/gif-load.gif'/><br/>Loading...</div>");
                }
                ui.jqXHR.fail(function() {
                ui.panel.html(
                    "Could not load content. Please contact administrator." );
                });
            },
            
        };
        
        var options = {
            thumbBox: '.thumbBox',
            spinner: '.spinner',
            imgSrc: '',
            endCanvasSize: 120,
            dataURL: ''
        };

        var cropper;
        

        function dataURLtoFile(dataurl, filename) {
            var arr = dataurl.split(','), mime = arr[0].match(/:(.*?);/)[1],
                bstr = atob(arr[1]), n = bstr.length, u8arr = new Uint8Array(n);
            while(n--){
                u8arr[n] = bstr.charCodeAt(n);
            }
            return new File([u8arr], filename, {type:mime});
        }
        
        function dataURLtoBlob(dataurl) {
            var arr = dataurl.split(','), mime = arr[0].match(/:(.*?);/)[1],
                bstr = atob(arr[1]), n = bstr.length, u8arr = new Uint8Array(n);
            while(n--){
                u8arr[n] = bstr.charCodeAt(n);
            }
            return new Blob([u8arr], {type:mime});
        }

        function stopWebCam(localStream){
            //var video = document.getElementById("video");
            video.pause();
            localStream.getVideoTracks()[0].stop();
            $('#video').fadeOut(1000);    
        }
        
        
    {/literal}
{/block}

{block name=jquery}
    {literal}
        $(function(){
            $(".hotspot").tipTip({maxWidth: "400px", edgeOffset: 3, defaultPosition: "top", delay: 200, fadeOut: 400});
        });
        
        
        
        /*****************************
         This is for the tabs layout
        ******************************/
        $(function() {
            var tabs = $("div#tabs").tabs(tabOptions);
            
            // - Go directly to tab if a hash is present
            if($("div#tabs") && document.location.hash){
                var hash = window.location.hash;
                if ($('#tabs a[id="' + hash.substr(1) +'"]').length > 0) {
                    var index = $('#tabs a[id="' + hash.substr(1) +'"]').parent().index();
                    $("#tabs").tabs("option", "active", index);
                }
            }
           
            $("div#tabs").show();
            /*$("table.tabListTable").DataTable({
                responsive: true,
                "searching":false,
                "info": false,
                "paging": false,
                autoWidth: false,
                fixedHeader: false
            });*/
            
            $("div#tabs").tabs("refresh");
        });
        
       

        
        /*********************************************************
         variable to hold the current table row (tr) being edited
        **********************************************************/
        var superTr;
        var assignHolder;
        
        
        
        
            
            /**********************************************************
            To email patient
            ***********************************************************/
            $(".emailPatient").click(function(){
                var self = $(this);
                var emails = $(this).attr("data-email");
                var emailArr = emails.split(",");
                self.qtip({
                    content:{
                       title:"<span><b>Send Patient Email</b><span>",
                       button:true,
                       text: function(event, api) {
                            var $div = $("<div>",{id:"msgCont"});
                            $div.append("<div class='error'></div>");
                            if (emailArr.length > 1) {
                                var chkBoxes = '';
                                for (var x = 0; x < emailArr.length; x++) {
                                    chkBoxes += '<input type="checkbox" value="' + $.trim(emailArr[x]) + '" />'+$.trim(emailArr[x])+'<br>';
                                }
                                $div.append("<div><b><span class='required'>Select Address(es):&nbsp;</span></b><br/>"+chkBoxes+"</div>");
                            }
                            $div.append("<div><b><span class='required'>Subject:&nbsp;</span></b><br/><input class='gpSubj' maxlength='80'/></div>");
                            $div.append("<div style='margin-bottom:0px;padding-bottom: 0px;'><b><span class='required'>Message:&nbsp;</span></b><span id='msgCnt' style='font-size:0.75rem;color:#777777;font-style:italic;'>1250</span><span style='font-size:0.75rem;color:#777777;font-style:italic;'>&nbsp;characters remaining</span><br/><textarea class='gpMsg' cols='10' rows='4' maxlength='400'></textarea></div>");
                            $div.append("<div align='left' style='font-size:0.8rem;color:#666666;padding-bottom:4px;'><i>Please note that <b>'Dear "+$("#patientName").val()+"'</b> will be automaticaly added to the email message.</i></div>");
                            $div.append("<div align='right'><button type='button' class='button' style='width:auto;padding: 0px 6px;' id='sendMessage'><i class='fas fa-envelope' style='font-size:1.2rem;'></i>&nbsp;Send Message</button></div>");
                            

                            $div.find("textarea").alphanum({
                                disallow: '"`',
                                allow: "!@#$%^&*()+=[]\\\';,/{}|:<>?~.- _"
                            });

                            return $div;
                        }
                   },
                    style: {
                       classes: 'qtip-bootstrap',
                       width:emailWidth
                   },
                   position: {
                       my: "top right",
                       at: "bottom left",
                       viewport: $(window),
                       adjust: {
                           method: 'shift shift',
                       },
                       target: self
                   },
                   show :{
                       event: "click",
                       solo: true,
                       modal: false,
                       ready: true
                   }, 
                   hide:false
                });
            });
            /********************************************
             Character limit count for textarea message
            *********************************************/
            $("body").on("input",".gpMsg", function(e) {
                var txt = $(this).val();
                var len = txt.length;
                var rem = 1250 - len;
                $(this).closest("div").find("#msgCnt").text(rem);
            });
            
            /***************************
            'Send message' button click
            ***************************/
            $("body").on("click","button#sendMessage", function(){
                var api = $('.qtip:visible');
                api.find("div.error").html("");
                var emails = [];
                
                //Make sure an email is selected if there are multiple options
                var numChkBoxes = api.find("input[type='checkbox']").length;
                if (numChkBoxes > 0) {
                    var checkedBoxes = api.find("input[type='checkbox']:checked").length;
                    if (checkedBoxes == 0) {
                        api.find("div.error").html("Please select at least one(1) email address.");
                        return false;
                    } else {
                        api.find("input[type='checkbox']:checked").each(function(){
                            emails.push($(this).val()); 
                        });
                    }
                }

                //Make sure that there is a subject
                var subj = $.trim(api.find("input.gpSubj").val());
                if (subj == '') {
                     api.find("div.error").html("Please include a subject.");
                     return false;
                }

                //Make sure that there is a message
                var msg = $.trim(api.find("textarea").val());
                if (msg == '') {
                     api.find("div.error").html("Please include a message to be sent.");
                     return false;
                }
               
                api.find("div.error").remove();
                api.find("div#msgCont").html("<div align='center' style='margin-top: 50px;'><img src='/images/gif-load.gif'/><br/><b>Working...</b></div>");
                var emailData = (emails.length > 0) ? emails.join(",") : '';
                
                $.ajax({
                    url:"/send/patient/email",
                    type:'POST',
                    data:{patientId:$("#patientId").val(), message: msg, subject:subj, emails: emailData},
                    success:function(data){
                       $("span.msg").html(data);
                       api.qtip("hide");
                    }
                });
            });
            
        
    {/literal}
{/block}

{block name=content }
    {nocache}

{if PermissionManager::userHasPermission("SEARCH.PATIENTS", $smarty.session.userId) || $smarty.session.isPatient}
    <span class="msg">{$msg}</span>

    <input type="hidden" id="patientId" value="{$patient->getId()}"/>
    <input type="hidden" id="patientName" value="{$patient->getFullName()}"/>
    <div class="row show-for-small-down" style="margin-left:5px;width:90%;color:#444444;border:1px solid #464646; background-color:#ffc42c !important;padding:5px 1px;font-weight:500;font-family:'Poppins', sans-serif;">
        
        <div class="small-9 columns end">
           <b><a style="color:#008cba;" href="/patient/summary/{$patient->getId()}">{$patient->getFullName()}</a></b><br/>{$patient->getGender()->getName()} - {$patient->displayAge()}
        </div>
    </div>
    <div class="row">
       
        <div class="medium-10 ends columns">
            <div id="tabs" style="display:none;padding-top:0px;">
                <ul>
                    <li><a id="" href="#start">General</a></li>
                    <li><a id="nok" href="/next/of/kin/view/{$patient->getId()}">Next of Kin</a></li>
                    <li><a id="allergy" href="/patient/allergy/view/{$patient->getId()}">Allergies</a></li>
                    <li><a id="covid" href="/patient/covid19/vaccination/view/{$patient->getId()}">Covid-19 Vaccination</a></li>
                    <li><a id="psdStatus" href="/smoking/drinking/status/patient/view/{$patient->getId()}">Smoking/Drinking</a></li>
                    <li><a id="physA" href="/patient/physical/activity/view/{$patient->getId()}">Physical Activity</a></li>
                    <li><a id="meds" href="/patient/medication/view/{$patient->getId()}">Medication Record</a></li>
                    <li><a id="meal" href="/patient/meal/record/view/{$patient->getId()}">Meal Records</a></li>
                    <li><a id="vitals" href="/patient/vitals/view/{$patient->getId()}">Vital Signs</a></li>
                    <li><a id="labs" href="/patient/lab/results/view/{$patient->getId()}">Lab Results</a></li>
                </ul>
                <div id="start" style="margin-top:0px;padding-top:0px;">
                    {* Summary of student *}
                    <br/>
                    <div align="right" style="padding-right:4px;padding-top:0px;margin-top:0px;">
                        {if $patient->getUser()->getEmail() != '' && PermissionManager::userHasPermission("SEND.PATIENT.EMAILS", $smarty.session.userId)}
                            &ensp;&nbsp;
                            <a  class="emailPatient" href="#" onclick="return false;" style='margin-top:0px;color:#999 !important;font-weight:bold;font-size:0.875rem;' data-email='{$patient->getUser()->getEmail()}'>
                                <i class="fas fa-envelope hotspot hotspotNoBorder" style="font-size:1.4rem;" title="Send email message to patient"></i>
                            </a>
                        {/if}
                    </div>
                    
                    <div class="row" data-equalizer="top" data-equalizer-mq="medium-up">
                        <div class="medium-6 small-6 columns">
                            <div data-equalizer-watch="top">
                                 <div class="row" >
                                    <div class="medium-5 columns end">
                                        <label class="viewLabel text-left">Patient ID:</label>
                                    </div>
                                    <div class="medium-7 columns end">
                                        <label class="infoLabel text-left"> 
                                            <a style="color:#008cba;" href="/patient/summary/{$patient->getId()}">{$patient->displayID()}</a>
                                        </label>
                                    </div>
                                </div>
                                <div class="row" >
                                    <div class="medium-5 columns">
                                        <label class="viewLabel text-left">First name:</label>
                                    </div>
                                    <div class="medium-7 columns">
                                        <label class="infoLabel text-left"> 
                                            <a href="/patient/summary/{$patient->getId()}">{$patient->getFirstName()}</a>
                                        </label>
                                    </div>
                                </div>
                                <div class="row" >
                                    <div class="medium-5 columns">
                                        <label class="viewLabel text-left">Middle name(s):</label>
                                    </div>
                                    <div class="medium-7 columns">
                                        <label class="infoLabel text-left"> {$patient->getMiddleNames()} &nbsp;</label>
                                    </div>
                                </div>
                                <div class="row" >
                                    <div class="medium-5 columns">
                                        <label class="viewLabel text-left">Last name:</label>
                                    </div>
                                    <div class="medium-7 columns">
                                        <label class="infoLabel text-left"> {$patient->getLastName()}</label>
                                    </div>
                                </div>
                                <div class="row" >
                                    <div class="medium-5 columns">
                                        <label class="viewLabel text-left">Gender:</label>
                                    </div>
                                    <div class="medium-7 columns">
                                        <label class="infoLabel text-left"> {$patient->getGender()->getName()}</label>
                                    </div>
                                </div>
                                <div class="row" >
                                    <div class="medium-5 columns">
                                        <label class="viewLabel text-left">Date of birth:</label>
                                    </div>
                                    <div class="medium-7 columns">
                                        <label class="infoLabel text-left"> {DbMapperUtility::formatSqlDate($patient->getDateOfBirth())}</label>
                                    </div>
                                </div>
                                <div class="row" >
                                    <div class="medium-5 columns">
                                        <label class="viewLabel text-left">Ethnicity:</label>
                                    </div>
                                    <div class="medium-7 columns">
                                        <label class="infoLabel text-left"> {$patient->getEthnicity()->getName()} </label>
                                    </div>
                                </div>
                                <div class="row" >
                                    <div class="medium-5 columns">
                                        <label class="viewLabel text-left">Religion:</label>
                                    </div>
                                    <div class="medium-7 columns">
                                        <label class="infoLabel text-left"> {$patient->getReligion()->getName()} </label>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="medium-6 small-6 end columns">
                            <div data-equalizer-watch="top">
                                <div class="row" >
                                    <div class="medium-5 columns end">
                                        <label class="viewLabel text-left">&nbsp;</label>
                                    </div>
                                    <div class="medium-7 columns end">
                                        <label class="infoLabel text-left"> 
                                            &nbsp;
                                        </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="medium-5 columns">
                                        <label class="viewLabel text-left">Primary #:</label>
                                    </div>
                                    <div class="medium-7 columns">
                                        <label class="infoLabel text-left"> 
                                            <span {if $patient->getContactNumber() != ''} class="hotspot" title="{$patient->getContactNumber()}" {/if}>
                                                {$html->truncateString($patient->getContactNumber(),20)}
                                            </span>
                                        </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="medium-5 columns">
                                        <label class="viewLabel text-left">Other contact #:</label>
                                    </div>
                                    <div class="medium-7 end columns">
                                        <label class="infoLabel text-left"> 
                                            <span {if $patient->getOtherContactNumber() != ''} class="hotspot" title="{$patient->getOtherContactNumber()}" {/if}>
                                                {$html->truncateString($patient->getOtherContactNumber(),20)}
                                            </span>
                                        </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="medium-5 columns">
                                        <label class="viewLabel text-left">Primary Email:</label>
                                    </div>
                                    <div class="medium-7 end columns">
                                        <label class="infoLabel text-left">
                                            <span {if $patient->getUser()->getEmail() != ''} class="hotspot" title="{$patient->getUser()->getEmail()}" {/if}>
                                                {$html->truncateString($patient->getUser()->getEmail(),17)}
                                            </span>
                                        </label>
                                    </div>
                                </div>
                                <div class="row" >
                                    <div class="medium-5 columns">
                                        <label class="viewLabel text-left">Patient Address:</label>
                                    </div>
                                    <div class="medium-7 columns">
                                        <label class="infoLabel text-left"> 
                                            <span {if $patient->getAddress() != ''} class="hotspot" title="{$patient->getAddress()}" {/if}>
                                                {$patient->getAddress()} 
                                            </span>
                                        </label>
                                    </div>
                                </div>
                                <div class="row" >
                                    <div class="medium-5 columns">
                                        <label class="viewLabel text-left">Primary Doctor:</label>
                                    </div>
                                    <div class="medium-7 columns">
                                        <label class="infoLabel text-left"> {$patient->getPrimaryDoctor()} </label>
                                    </div>
                                </div>
                                <div class="row" >
                                    <div class="medium-5 columns">
                                        <label class="viewLabel text-left">Principal Health Facility:</label>
                                    </div>
                                    <div class="medium-7 columns">
                                        <label class="infoLabel text-left"> {$patient->getPrincipalHealthCareFacility()} </label>
                                    </div>
                                </div>
                                <div class="row" >
                                    <div class="medium-5 columns">
                                        <label class="viewLabel text-left">Country:</label>
                                    </div>
                                    <div class="medium-7 columns">
                                        <label class="infoLabel text-left"> {$patient->getCountry()->getName()} </label>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="medium-12 columns">
                          <hr width="95%" size="2" color="#D0E0F0" style="margin:5px;"/>
                        </div>
                    </div>    
                    <div class="row" style="display:flex;flex-direction:row; align-items: center;margin-bottom:10px;">
                        <div style="margin-left:15px; flex-grow:0; font-weight:500;font-size:1.1rem;font-family:'Poppins', sans-serif;{if $patient->isRelocated()} color:orangered;{/if}">
                            {if $patient->isRelocated()} Relocated {else} Not relocated {/if}&ensp;
                        </div>
                        {*<div style="flex-grow:0.5;height: 1px;background-color: #9f9f9f;width: 50%;"></div>*}
                    </div> 
                    {if $patient->isRelocated()}
                        <div class="row" data-equalizer="top" data-equalizer-mq="medium-up">
                            <div class="medium-6 small-6 columns">
                                <div data-equalizer-watch="top">
                                    <div class="row" >
                                        <div class="medium-5 columns">
                                            <label class="viewLabel text-left">Relocation Date:</label>
                                        </div>
                                        <div class="medium-7 columns">
                                            <label class="infoLabel text-left">{DbMapperUtility::formatSqlDate($patient->getRelocatedDate())}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="medium-6 small-6 end columns">
                                <div data-equalizer-watch="top">
                                    <div class="row" >
                                        <div class="medium-5 columns">
                                            <label class="viewLabel text-left">Relocation Country:</label>
                                        </div>
                                        <div class="medium-7 columns">
                                            <label class="infoLabel text-left"> {$patient->getRelocatedCountry()->getName()} </label>
                                        </div>
                                    </div>
                                    <div class="row" >
                                        <div class="medium-5 columns">
                                            <label class="viewLabel text-left">Relocation Address:</label>
                                        </div>
                                        <div class="medium-7 columns">
                                            <label class="infoLabel text-left"> {$patient->getRelocatedAddress()} </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    {/if}
                    
                    {*Chronic Disease section *}
                    <div class="row">
                        <div class="medium-12 columns">
                          <hr width="95%" size="2" color="#D0E0F0" style="margin:5px;"/>
                        </div>
                    </div>    
                    <div class="row" style="display:flex;flex-direction:row; align-items: center;margin-bottom:10px;">
                        <div style="margin-left:15px; flex-grow:0; font-weight:500;font-size:1.1rem;font-family:'Poppins', sans-serif;{if $patient->isRelocated()} color:orangered;{/if}">
                            Chronic Diseases&ensp;
                            <a href="#" class="hintanchorRow" onclick="return false;" onMouseover="showhint('When present, the figure in parenthesis represents the year when the patient was initially diagnosed with the chronic disease.', this, event, '180px')">&nbsp;</a>
                        </div>
                        {*<div style="flex-grow:0.5;height: 1px;background-color: #9f9f9f;width: 50%;"></div>*}
                    </div>
                    {if $patientChronicDiseases|count gt 0}
                        <ul class='medium-block-grid-4 small-block-grid-2'>
                            {foreach from=$patientChronicDiseases item=pcd}
                                <li>
                                    &nbsp;&bull;
                                    {$pcd->getChronicDisease()->getLabel()}
                                    {if $pcd->getOtherDisease() != ''}
                                        -&nbsp;<i>{$pcd->getOtherDisease()}</i>
                                    {/if}
                                    {if $pcd->getDiagnosedSinceYear() != ''}
                                        &nbsp;<i>({$pcd->getDiagnosedSinceYear()})</i>
                                    {/if}
                                </li>
                            {/foreach}
                        </ul>
                    {else}
                        None recorded.
                    {/if}
                    {*End of first tab content *}
                    <br/>
                    
                   {*End of tab content *}
                </div>
            </div>
        </div>
         {***************************** SEPARATOR ********************}
        
        <div id="summary" class="medium-2 small-10 end columns show-for-medium-up show-for-landscape">
            
            <div align="center" class="" style="color:#444444;border:1px solid #464646; background-color:#ffc42c !important;padding:5px 1px;font-weight:500;font-family:'Poppins', sans-serif;">
                Patient Summary
            </div>

            {* ****************************Patient Info section************************** *}
            <div style="">
                
                <div class="row" style="background-color:#FFFFFF;margin:4px 0px;">
                    <div class="medium-12 large-4 small-3 columns end">
                        <label class="text-left">Name:</label>
                    </div>
                    <div class="medium-12 large-8 small-9 columns end">
                        <label class="text-left" style="font-size:0.875rem;padding-top:3px;">
                            <b><a style="color:#008cba;" href="/patient/summary/{$patient->getId()}">{$patient->getFullName()}</a></b>
                        </label>
                    </div>
                </div>
                <div class="row" style="margin:4px 0px;">
                    <div class="medium-12 large-4 small-3 columns end">
                        <label class="text-left">Sex:</label>
                    </div>
                    <div class="medium-12 large-8 small-9 columns end">
                        <label class="text-left" style="color:#111;font-size:0.875rem;padding-top:3px;">
                            <b>{$patient->getGender()->getName()}</b>
                        </label>
                    </div>
                </div>
                <div class="row" style="margin:4px 0px;background-color:#FFFFFF;">
                    <div class="medium-12 large-4 small-3 columns end">
                        <label class="text-left">Age:</label>
                    </div>
                    <div class="medium-12 large-8 small-9 columns end">
                        <label class="text-left" style="color:#111;font-size:0.875rem;padding-top:3px;">
                            <b>{$patient->displayAge()}</b>
                        </label>
                    </div>
                </div>
                {if $smarty.session.patientId == $patient->getId()}
                    <div class="row " style="margin:7px 0px;">
                        <div class="medium-12 large-4 small-3 columns end">
                            <label class="text-left">&nbsp;</label>
                        </div>
                        <div class="medium-12 large-8 small-9 columns end">
                            <label class="text-left" >
                                <a  class="editLink" href="/patient/edit/{$patient->getId()}" style='font-weight:400;color:#008cba !important;font-size:0.875rem;'>
                                    edit record
                                </a>
                            </label>
                        </div>
                    </div>
                {/if}
                {*if $smarty.session.patientId != $patient->getId()}
                    <div class="row" style="margin:4px 0px;">
                        <div class="medium-12 columns end text-right">
                            
                        {if $patient->currentlySmokes()}
                            <i class="fas fa-smoking" style="color:#FF0000;font-size:1.7rem;" title="Currently smokes"></i>
                        {else}
                            <i class="fas fa-smoking-ban" title="Does not currently smoke" style="color:#006432;font-size:1.7rem;"></i>
                        {/if}
                        &ensp;
                        {if !$patient->currentlyDrinks()}
                            <i class="fas fa-cocktail" style="color:#FF0000;font-size:1.7rem;" title="Currently drinks"></i>
                        {else}
                            <span style="height:30px !important;text-align:right;" class="fa-stack fa-2x">
                                <i class="fas fa-cocktail fa-stack-1x" style="color:#888888;font-size:1rem;"></i>
                                <i class="fas fa-ban fa-stack-2x" style="color:#006432;font-size:1rem;"></i>
                            </span>
                        {/if}
                            
                        </div>
                    </div>
                {/if*}
            </div>
        </div>
        {***************************** SEPARATOR ********************}
        
    </div> 
    {*    
            <!-- for image upload and cropping -->
            <div id="openModal" class="modalDialog">
                <div>
                    <a href="#close" title="close" class="close">X</a>
                    <h5>Crop and/or upload photograph</h5>
                    <div class="container" >
                        <div class="imageBox">
                            <div class="thumbBox"></div>
                            <div class="spinner" style="display: none">Loading...</div>
                        </div>
                        <div class="action">
                            <input type="file" id="file" style="float:left; width: 200px">
                            <input type="button" id="btnCrop" value="Done" style="float: right;">
                            <input type="button" id="btnZoomIn" value="+" style="float: right;">
                            <input type="button" id="btnZoomOut" value="-" style="float: right;">
                        </div>
                    </div>
                </div>
            </div>

            <!--For the camera -->
            <div id="videoModal" class="modalDialog smallModal">
                <div>
                    <a href="#videoClose" title="close" class="close" id="closeVideo">X</a>
                    <h5>Capture photograph</h5>
                    <div id="">
                        <div class="camcontent" style="margin:0px;padding:0px;border:1px solid #464646;width:200px;height:200px;background-color:#bbbbbb;">
                            <video width="200" height="200" id="video" style="border: 1px solid red;" autoplay></video>
                            <canvas id="canvas" width="200" height="200"/>
                        </div>
                        <div style="width:200px;">
                            <input type="button" id="snap" value="Capture" style="display:none;">
                            <input type="button" id="reset" value="Reset" style="display:none;">
                            <input type="button" id="next" value="Next" style="display:none;">
                            <input type="button" id="endVideo" value="Close">
                        </div>
                    </div>
                </div>
            </div>
    *}
{else}
    <div class="emptyListMessage">You do not have permissions to see the content of this page</div>
{/if}
{/nocache} 
{/block}
    
    
{block name="foundation"}
    {literal}
        
    {/literal}
{/block}
