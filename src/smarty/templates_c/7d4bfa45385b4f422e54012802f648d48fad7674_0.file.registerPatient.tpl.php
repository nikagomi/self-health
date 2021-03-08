<?php
/* Smarty version 3.1.34-dev-7, created on 2021-03-01 17:45:29
  from '/var/www/oecs/src/smarty/templates/patient/registerPatient.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_603d2839ec6137_29551962',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7d4bfa45385b4f422e54012802f648d48fad7674' => 
    array (
      0 => '/var/www/oecs/src/smarty/templates/patient/registerPatient.tpl',
      1 => 1614620449,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_603d2839ec6137_29551962 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>





<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_425442462603d2839eb7ba2_24857543', 'jquery');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_2048947122603d2839eb8e10_19203828', 'scripts');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1771639299603d2839eb96c2_67070741', 'styles');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1197300815603d2839eb9e37_81287175', 'content');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1654078699603d2839ec3f41_21553806', "auxScripts");
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_598790225603d2839ec5161_67531115', "foundation");
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "base/body.tpl");
}
/* {block 'jquery'} */
class Block_425442462603d2839eb7ba2_24857543 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'jquery' => 
  array (
    0 => 'Block_425442462603d2839eb7ba2_24857543',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    
        
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
        
        
    
<?php
}
}
/* {/block 'jquery'} */
/* {block 'scripts'} */
class Block_2048947122603d2839eb8e10_19203828 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'scripts' => 
  array (
    0 => 'Block_2048947122603d2839eb8e10_19203828',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    
        
    
<?php
}
}
/* {/block 'scripts'} */
/* {block 'styles'} */
class Block_1771639299603d2839eb96c2_67070741 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'styles' => 
  array (
    0 => 'Block_1771639299603d2839eb96c2_67070741',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    
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
    
<?php
}
}
/* {/block 'styles'} */
/* {block 'content'} */
class Block_1197300815603d2839eb9e37_81287175 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_1197300815603d2839eb9e37_81287175',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/var/www/oecs/vendor/smarty/smarty/libs/plugins/function.html_options.php','function'=>'smarty_function_html_options',),));
?>



<?php echo $_smarty_tpl->tpl_vars['msg']->value;?>


<div class="listTableCaption_simpleTable" style="font-variant:normal;font-weight: 500;margin-top:2px;margin-bottom:2px;color:#414042;font-family:'Poppins', sans-serif;font-size:1.3rem;">
    Edit Patient Details
</div>
<div style="margin-left:15px;margin-top:2px;">
<form data-abide="ajax" name="registrationForm" id="registrationForm" action="<?php echo $_smarty_tpl->tpl_vars['actionPage']->value;?>
" method="POST" autocomplete="off">
    
            <input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['patient']->value->getId();?>
"/>
            <input type="hidden" name="userId" value="<?php echo $_SESSION['userId'];?>
"/>
            
            <div id="inputs">
                <ul class="medium-block-grid-2 small-block-grid-1">
                    <li>
                        <div class="row" >
                            <div class="medium-12 end columns">
                                <label><span class="required">First name</span>
                                    <input tabindex="1" type="text" name="firstName" id="firstName" maxlength="50" value="<?php echo $_smarty_tpl->tpl_vars['patient']->value->getFirstName();?>
" required>
                                </label>
                            </div>
                        </div>
                        <div class="row" >
                            <div class="medium-12 end columns">
                                <label><span>Middle names</span>
                                    <input tabindex="2" type="text" name="middleNames" id="middleNames" value="<?php echo $_smarty_tpl->tpl_vars['patient']->value->getMiddleNames();?>
"/>
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="medium-12 end columns">
                                <label><span class="required">Last name </span>
                                    <input tabindex="3" type="text" name="lastName" id="lastName" value="<?php echo $_smarty_tpl->tpl_vars['patient']->value->getLastName();?>
" required/>
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="medium-12 end columns">
                               <label><span class="required">Sex</span>
                                    <select tabindex="4" name="genderId" id="genderId" required>
                                        <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['genders']->value,'selected'=>$_smarty_tpl->tpl_vars['patient']->value->getGenderId()),$_smarty_tpl);?>

                                    </select>
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="medium-12 end columns">
                                <label><span class="required">Date of birth<small class="error" id="dateError">date is invalid</small></span>
                                    <input tabindex="5" class="medium" maxlength="10" type="text" name="dateOfBirth" id="dateOfBirth" value="<?php echo $_smarty_tpl->tpl_vars['patient']->value->displayDateOfBirth();?>
" placeholder="dd/mm/yyyy" pattern="" data-abide-validator="dateValidator" required/>
                                </label>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="medium-12 end columns">
                                <label>
                                    <span>Ethnicity
                                    <?php if (\Authentication\Model\PermissionManager::userHasPermission('MANAGE.ETHNICITIES',$_SESSION['userId'])) {?>
                                        <a class="show-for-medium-up quickAdd" href="#" onclick="return false;" data-sClass="\Admin\Model\Ethnicity">add new</a>
                                    <?php }?></span>
                                    <select tabindex="6" name="ethnicityId" id="ethnicityId">
                                        <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['ethnicities']->value,'selected'=>$_smarty_tpl->tpl_vars['patient']->value->getEthnicityId()),$_smarty_tpl);?>

                                    </select>
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="medium-12 end columns">
                                <label><span>Religion
                                    <?php if (\Authentication\Model\PermissionManager::userHasPermission('MANAGE.RELIGIONS',$_SESSION['userId'])) {?>
                                        <a class="show-for-medium-up quickAdd" href="#" onclick="return false;" data-sClass="\Admin\Model\Religion">add new</a>
                                    <?php }?></span>
                                    <select tabindex="7" name="religionId" id="religionId">
                                        <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['religions']->value,'selected'=>$_smarty_tpl->tpl_vars['patient']->value->getReligionId()),$_smarty_tpl);?>

                                    </select>
                                </label>
                            </div>
                        </div>
                    </li>
                    <li>
                        
                            
                        <div class="row">
                            <div class="medium-12 end columns">
                                <label><span class="">Primary contact #<small class="error" id="phoneError"></small></span><br/>
                                    <input tabindex="8" type="text" class="medium" data-abide-validator='phoneValidator' id="primaryNumber" value="<?php echo $_smarty_tpl->tpl_vars['patient']->value->getContactNumber();?>
" placeholder=""/>
                                </label>
                            </div>
                        </div>
                        <div class="row" >
                            <div class="medium-12 end columns">
                                <label><span>Other contact #<small class="error" id="phone2Error"></small></span><br/>
                                    <input tabindex="9"  class="medium" type="text" data-abide-validator='phoneValidator' id="otherNumber" value="<?php echo $_smarty_tpl->tpl_vars['patient']->value->getOtherContactNumber();?>
" placeholder=""/>
                                </label>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="medium-12 end columns">
                                <label><span class="">Patient Address</span>
                                    <textarea style="resize: none;" tabindex="10"  rows="3" name="address" id="address" ><?php echo $_smarty_tpl->tpl_vars['patient']->value->getAddress();?>
</textarea>
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="medium-12 end columns">
                                <label><span class="">Primary Doctor</span>
                                    <input tabindex="11" type="text" name="primaryDoctor" id="primaryDoctor" maxlength="120" value="<?php echo $_smarty_tpl->tpl_vars['patient']->value->getPrimaryDoctor();?>
" placeholder=""/>
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="medium-12 end columns">
                                <label><span class="">Principal Health Facility</span>
                                    <input tabindex="12" type="text" name="principalHealthCareFacility" id="principalHealthCareFacility" maxlength="120" value="<?php echo $_smarty_tpl->tpl_vars['patient']->value->getPrincipalHealthCareFAcility();?>
" placeholder=""/>
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="medium-12 end columns">
                               <label><span class="required">Country </span>
                                    <select tabindex="13" name="countryId" id="countryId" required>
                                        <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['countries']->value,'selected'=>$_smarty_tpl->tpl_vars['patient']->value->getCountryId()),$_smarty_tpl);?>

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
                    <a href="/patient/summary/<?php echo $_smarty_tpl->tpl_vars['patient']->value->getId();?>
" tabindex="15" class="reset">Patient Summary</a>  
                </div>
                <div class="medium-8 end columns">
                    <div class="err"></div>
                </div>
                
                            </div>
</form>
</div>
                

<?php
}
}
/* {/block 'content'} */
/* {block "auxScripts"} */
class Block_1654078699603d2839ec3f41_21553806 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'auxScripts' => 
  array (
    0 => 'Block_1654078699603d2839ec3f41_21553806',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    
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
        
        var localCode = '<?php echo \Neptune\PropertyService::getProperty("facility.country.code","lc");?>
';
    
<?php
}
}
/* {/block "auxScripts"} */
/* {block "foundation"} */
class Block_598790225603d2839ec5161_67531115 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'foundation' => 
  array (
    0 => 'Block_598790225603d2839ec5161_67531115',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    abide : {
        validators: {
            dateValidator: function (el, required, parent) {
                try{
                    var dob = moment(el.value, "DD/MM/YYYY");
                    var now = moment();
                    if(now.subtract(16, 'years').isBefore(dob)){
                        $("#dateError").text("Must be over 1 month");
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
<?php
}
}
/* {/block "foundation"} */
}
