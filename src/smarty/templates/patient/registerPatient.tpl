{*Author: Randal Neptune*}
{*Project: EduRecord*}


{extends file="base/body.tpl"}


{block name=jquery}
    {literal}
        
        $("#countryId,#genderId, #religionId, #ethnicityId").chosen();
        
        
        $('#registrationForm').on('valid.fndtn.abide', function() {
            $("div.err").html("");
          
            var countryCode = itiPrimaryNumber.getSelectedCountryData().iso2;
            var telPrimaryNumber = phoneUtil.parseAndKeepRawInput(itiPrimaryNumber.getNumber(), countryCode.toUpperCase());
            /*if (localCode.toUpperCase() === countryCode.toUpperCase()) {
                $("input[name='contactNumber']").val(phoneUtil.format(telPrimaryNumber, i18n.phonenumbers.PhoneNumberFormat.NATIONAL));
            } else {
                $("input[name='contactNumber']").val(phoneUtil.format(telPrimaryNumber, i18n.phonenumbers.PhoneNumberFormat.INTERNATIONAL));
            }*/
            $("input[name='contactNumber']").val(phoneUtil.format(telPrimaryNumber, i18n.phonenumbers.PhoneNumberFormat.NATIONAL));

            //Phone 2
            if (itiOtherNumber.getNumber() != '') {
                var otherCountryCode = itiOtherNumber.getSelectedCountryData().iso2;
                var telOtherNumber = phoneUtil.parseAndKeepRawInput(itiOtherNumber.getNumber(), otherCountryCode.toUpperCase());
                $("input[name='otherContactNumber']").val(phoneUtil.format(telOtherNumber, i18n.phonenumbers.PhoneNumberFormat.NATIONAL));
                /*if (localCode.toUpperCase() === otherCountryCode.toUpperCase()) {
                    $("input[name='otherContactNumber']").val(phoneUtil.format(telOtherNumber, i18n.phonenumbers.PhoneNumberFormat.NATIONAL));
                }else {
                    $("input[name='otherContactNumber']").val(phoneUtil.format(telOtherNumber, i18n.phonenumbers.PhoneNumberFormat.INTERNATIONAL));
                }*/
            }
            $(this).submit();
        }).on('invalid.fndtn.abide', function () {
            $("div.err").html("There are incomplete / invalid fields on the form");
        });
        
       
        
        /********************************************************
         Settng up the datepicker (patient must be >= 8 months)
        ********************************************************/
        $("#dateOfBirth").datepicker({
            format:"dd/mm/yyyy", 
            endDate:"-18y",
            startDate:"-110y",
            clearBtn:true,
            autoclose: true
        }).data('datepicker');
        
        /****** To do a quick add to the db from the form ***********/
        $(".quickAdd").click(function(e){
            var self = $(this);
            var titleTxt = self.closest("label").find("span:first").text();
            var relId = self.closest("div").find("select").attr("id");
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
                        var $button = $("<input>",{type:"button", value:"Save", class:"button saveEntry"});

                        var $inputDiv =  $("<div>", {class:"row"});
                        var div1 =  $("<div>", {class:"small-4 columns end nombre"}).css({"text-align":"right"});   
                        var div2 =  $("<div>", {class:"small-8 columns end"}); 
                            div1.html(titleTxt).css({"padding-top":"8px","font-size":"1.0rem"});
                            div2.append($txt);
                        $inputDiv.append(div1).append(div2);
                        
                        $btnDiv.append($button);
                        $div.append($hid).append($rel).append($span).append($inputDiv).append($btnDiv);
                        return $div;
                    }
                },
                 style: {
                    classes: 'qtip-bootstrap',
                    width:'360px'
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
                    solo: true,
                    modal: {
                        on: true,
                        blur: false,
                        escape: false
                    }
                }, 
                hide:false
            });
        });
        
        $("body").on("click",".saveEntry", function(e) {
            var parDiv = $(this).closest("div#tooltipDiv");
            var txt = parDiv.find(".txtEntry").val();
            var nombre = parDiv.find("div.nombre").text();
            var tClass = parDiv.find(".hClass").val();
            var elemId = parDiv.find(".relElem").val();
            if ($.trim(txt) == ''){
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
        });
        
        
    {/literal}
{/block}

{block name=scripts}
    {literal}
        
    {/literal}
{/block}

{block name=styles}
    {literal}
        /* max-width 640px, mobile-only styles, use when QAing mobile issues */
        @media only screen and (max-width: 40em) { 
            div#inputs{
                width: 100%;
            }
        } 

        /* min-width 641px, medium screens */
        @media only screen and (min-width: 40.063em) { 
            div#inputs{
                width: 70%;
            }
        }
        
        .quickAdd {
            padding-left: 20px;
            font-size: 0.8rem;
        }
        
        .block{
            margin-left: 25px;
        }
        
        .block li{
            padding: 0px;
        }
        
        .err {
            font-family: 'Poppins', sans-serif;
            font-size: 1rem;
            color: #FF0000;
            font-weight: 400;
        }
    {/literal}
{/block}

{block name=content}
{nocache}

{$msg}

<div class="listTableCaption_simpleTable" style="font-variant:normal;font-weight: 500;margin-top:2px;margin-bottom:2px;color:#414042;font-family:'Poppins', sans-serif;font-size:1.3rem;">
    Edit Patient Details
</div>
<div style="margin-left:15px;margin-top:2px;">
<form data-abide="ajax" name="registrationForm" id="registrationForm" action="{$actionPage}" method="POST" autocomplete="off">
    
            <input type="hidden" name="id" value="{$patient->getId()}"/>
            <input type="hidden" name="userId" value="{$smarty.session.userId}"/>
            
            <div id="inputs">
                <ul class="medium-block-grid-2 small-block-grid-1">
                    <li>
                        <div class="row" >
                            <div class="medium-12 end columns">
                                <label><span class="required">First name</span>
                                    <input tabindex="1" type="text" name="firstName" id="firstName" maxlength="50" value="{$patient->getFirstName()}" required>
                                </label>
                            </div>
                        </div>
                        <div class="row" >
                            <div class="medium-12 end columns">
                                <label><span>Middle names</span>
                                    <input tabindex="2" type="text" name="middleNames" id="middleNames" value="{$patient->getMiddleNames()}"/>
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="medium-12 end columns">
                                <label><span class="required">Last name </span>
                                    <input tabindex="3" type="text" name="lastName" id="lastName" value="{$patient->getLastName()}" required/>
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="medium-12 end columns">
                               <label><span class="required">Sex</span>
                                    <select tabindex="4" name="genderId" id="genderId" required>
                                        {html_options options=$genders selected=$patient->getGenderId()}
                                    </select>
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="medium-12 end columns">
                                <label><span class="required">Date of birth&nbsp;<small class="error" id="dateError">date is invalid</small></span>
                                    <input tabindex="5" class="medium" maxlength="10" type="text" name="dateOfBirth" id="dateOfBirth" value="{$patient->displayDateOfBirth()}" placeholder="dd/mm/yyyy" pattern="" data-abide-validator="dateValidator" required/>
                                </label>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="medium-12 end columns">
                                <label>
                                    <span>Ethnicity
                                    {if PermissionManager::userHasPermission('MANAGE.ETHNICITIES', $smarty.session.userId)}
                                        <a class="show-for-medium-up quickAdd" href="#" onclick="return false;" data-sClass="\Admin\Model\Ethnicity">add new</a>
                                    {/if}</span>
                                    <select tabindex="6" name="ethnicityId" id="ethnicityId">
                                        {html_options options=$ethnicities selected=$patient->getEthnicityId()}
                                    </select>
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="medium-12 end columns">
                                <label><span>Religion
                                    {if PermissionManager::userHasPermission('MANAGE.RELIGIONS', $smarty.session.userId)}
                                        <a class="show-for-medium-up quickAdd" href="#" onclick="return false;" data-sClass="\Admin\Model\Religion">add new</a>
                                    {/if}</span>
                                    <select tabindex="7" name="religionId" id="religionId">
                                        {html_options options=$religions selected=$patient->getReligionId()}
                                    </select>
                                </label>
                            </div>
                        </div>
                    </li>
                    <li>
                        
                            
                        <div class="row">
                            <div class="medium-12 end columns">
                                <label><span class="">Primary contact #<small class="error" id="phoneError"></small></span><br/>
                                    <input tabindex="8" type="text" class="medium" data-abide-validator='phoneValidator' id="primaryNumber" value="{$patient->getContactNumber()}" placeholder=""/>
                                </label>
                            </div>
                        </div>
                        <div class="row" >
                            <div class="medium-12 end columns">
                                <label><span>Other contact #<small class="error" id="phone2Error"></small></span><br/>
                                    <input tabindex="9"  class="medium" type="text" data-abide-validator='phoneValidator' id="otherNumber" value="{$patient->getOtherContactNumber()}" placeholder=""/>
                                </label>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="medium-12 end columns">
                                <label><span class="">Patient Address</span>
                                    <textarea style="resize: none;" tabindex="10"  rows="3" name="address" id="address" >{$patient->getAddress()}</textarea>
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="medium-12 end columns">
                                <label><span class="">Primary Doctor</span>
                                    <input tabindex="11" type="text" name="primaryDoctor" id="primaryDoctor" maxlength="120" value="{$patient->getPrimaryDoctor()}" placeholder=""/>
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="medium-12 end columns">
                                <label><span class="">Principal Health Facility</span>
                                    <input tabindex="12" type="text" name="principalHealthCareFacility" id="principalHealthCareFacility" maxlength="120" value="{$patient->getPrincipalHealthCareFAcility()}" placeholder=""/>
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="medium-12 end columns">
                               <label><span class="required">Country </span>
                                    <select tabindex="13" name="countryId" id="countryId" required>
                                        {html_options options=$countries selected=$patient->getCountryId()}
                                    </select>
                                </label>
                            </div>
                        </div>
                    </li>
                </ul>        
            </div>           
            <div class="row">
                <div class="medium-12 columns">
                  <hr width="85%" size="2" color="#D0E0F0" style="margin:5px;"/>
                </div>
            </div>            
            <div class="row">
                <div class="medium-4 end columns">
                    <input type="submit" tabindex="14" name="submit" class="button" value="Update"/>
                    <a href="/patient/summary/{$patient->getId()}" tabindex="15" class="reset">Patient Summary</a>  
                </div>
                <div class="medium-8 end columns">
                    <div class="err"></div>
                </div>
                
                {*if $patient->getId() != ''}
                    <div class="medium-4 end columns">
                        <span id="delete"><i>Confirm</i>&nbsp;<input tabindex="17"  type="checkbox"/></span>
                        <a tabindex="18" href="/patient/delete/{$patient->getId()}" class="delete">Delete</a>
                    </div>
                {/if*}
            </div>
</form>
</div>
                
{/nocache}
{/block}

{block name="auxScripts"}
    {literal}
        const phoneUtil = i18n.phonenumbers.PhoneNumberUtil.getInstance();
        var primaryNumber = document.querySelector("#primaryNumber");
        var otherNumber = document.querySelector("#otherNumber");
        
        var phoneErrorMap = ["Invalid number", "Invalid country code", "Too short", "Too long"];
        
        var itiPrimaryNumber = intlTelInput(primaryNumber,{
            utilsScript: "/js/utils.js",
            placeholderNumberType: "FIXED_LINE",
            hiddenInput: "contactNumber",
            "allowDropdown": true,
            "autoPlaceholder": "polite",
            "initialCountry": "lc",
            "preferredCountries": ["lc", "us", "gb"],
            "formatOnDisplay": true,
            autoHideDialCode: true
        });
        var itiOtherNumber = intlTelInput(otherNumber,{
            utilsScript: "/js/utils.js",
            placeholderNumberType: "MOBILE",
            hiddenInput: "otherContactNumber",
            "allowDropdown": true,
            "autoPlaceholder": "polite",
            "initialCountry": "lc",
            "preferredCountries": ["lc", "us", "gb"],
            "formatOnDisplay": true,
            autoHideDialCode: true
        });
        
        var localCode = '{/literal}{PropertyService::getProperty("facility.country.code","lc")}{literal}';
    {/literal}
{/block}

{block name="foundation"}
    abide : {
        validators: {
            dateValidator: function (el, required, parent) {
                try{
                    var dob = moment(el.value, "DD/MM/YYYY");
                    var now = moment();
                    if(now.subtract(18, 'years').isBefore(dob)){
                        $("#dateError").text("Must be over 18 years");
                        return false;
                    }
                }catch(e){
                    $("#dateError").text("Date is invalid");
                    return false;
                }
                return true;
            },
            phoneValidator: function (el, required, parent) {
                   
                if (el.getAttribute("id") == 'primaryNumber') {
                    if (!itiPrimaryNumber.isValidNumber()) {
                        var countryCode = itiPrimaryNumber.getSelectedCountryData().iso2;
                        
                        if (countryCode == "lc" && (itiPrimaryNumber.getNumber().indexOf("732") == 5 || itiPrimaryNumber.getNumber().indexOf("733") == 5) && phoneErrorMap[itiPrimaryNumber.getValidationError()] == "Invalid number") {
                            $("#phoneError").text("");
                            $("#primaryNumber").removeClass("error");
                            return true;
                        } 
                        $("#phoneError").text(phoneErrorMap[itiPrimaryNumber.getValidationError()]).css("display","inline-block");
                        $("#primaryNumber").addClass("error");
                        return false;
                    } else {
                        $("#primaryNumber").removeClass("error");
                    }
                }
                if (el.getAttribute("id") == 'otherNumber' && $.trim($("#otherNumber").val()) !== '') {
                
                    if (!itiOtherNumber.isValidNumber()) {
                        var countryCode = itiOtherNumber.getSelectedCountryData().iso2;
                        if (countryCode == "lc" && (itiOtherNumber.getNumber().indexOf("732") == 5 || itiOtherNumber.getNumber().indexOf("733") == 5) && phoneErrorMap[itiOtherNumber.getValidationError()] == "Invalid number") {
                            $("#phone2Error").text("");
                            $("#otherNumber").removeClass("error");
                            return true;
                        } 
                        $("#phone2Error").text(phoneErrorMap[itiOtherNumber.getValidationError()]).css("display","inline-block");
                        $("#otherNumber").addClass("error");
                        return false;
                    } else {
                         $("#otherNumber").removeClass("error");
                    }
                }

                $("#phone2Error,#phoneError").css("display","none");
                
                return true;
            }
        }
    }
{/block}
