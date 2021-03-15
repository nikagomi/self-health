<?php
/* Smarty version 3.1.34-dev-7, created on 2021-03-15 14:14:39
  from '/var/www/oecs/src/smarty/templates/security/user.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_604f6bcf248114_98736174',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4e8da113a751e9d869f36952843913c14f80a5c0' => 
    array (
      0 => '/var/www/oecs/src/smarty/templates/security/user.tpl',
      1 => 1615817678,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_604f6bcf248114_98736174 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1476609637604f6bcf22b1e8_87306259', 'jquery');
?>



<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1334233046604f6bcf22d3d3_71633413', 'styles');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_267338288604f6bcf22db51_55791153', 'dataTable');
?>



<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1636451684604f6bcf22e231_21872755', 'content');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_216693662604f6bcf247032_98470156', "auxScripts");
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1252085591604f6bcf2478d8_35793876', "foundation");
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "base/body.tpl");
}
/* {block 'jquery'} */
class Block_1476609637604f6bcf22b1e8_87306259 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'jquery' => 
  array (
    0 => 'Block_1476609637604f6bcf22b1e8_87306259',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    
        
        $("div.table-toolbar").html("Recorded Users").css({
            "margin-left" : "26px",
            "font-family": "'Poppins', sans-serif",
            "font-size" : "1.2rem",
            "font-weight" : 500,
            "color": "#464646"
        });
        
        var countryCode = "<?php echo \Neptune\PropertyService::getProperty('facility.country.code','lc');?>
";
        
        $(function(){
            $(".hotspot").tipTip({maxWidth: "400px", edgeOffset: 3, defaultPosition: "top", delay: 200, fadeOut: 400});   
            /*****************************
             Select all options 
            ******************************/
            $(".prm,.grp,.fac").click(function(){
                var nm = $(this).attr('id');
                if($(this).is(":checked")){
                    $("div."+nm+"").find("input[type=checkbox]").each(function(){
                        $(this).prop('checked',true);
                    });   
                    if(nm == "prm"){$("div#err").html("");}
                }else{
                    $("div."+nm+"").find("input[type=checkbox]").each(function(){
                        $(this).prop('checked',false);
                    });
                }
            });
        });
        
       
        
        /*****************************************
         Interrupt form submit to make sure that 
         at least a permission or group selected
        ******************************************/
        $("#userForm").submit(function(e){
            if( $('input[name="perm[]"]:checked').length == 0 && $('input[name="grp[]"]:checked').length  == 0){
                e.preventDefault();
                $("div#err").html("At least one permission or group must be selected");
            }else{
                $("div#err").html("");
            }
            
            /*var countryCode = itiContact.getSelectedCountryData().iso2;
            var telContact = phoneUtil.parseAndKeepRawInput(itiContact.getNumber(), countryCode.toUpperCase());
            if (localCode.toUpperCase() === countryCode.toUpperCase()) {
                $("input[name='contactNumber']").val(phoneUtil.format(telContact, i18n.phonenumbers.PhoneNumberFormat.NATIONAL));
            } else {*/
                $("input[name='contactNumber']").val(phoneUtil.format(telContact, i18n.phonenumbers.PhoneNumberFormat.INTERNATIONAL));
            //}
            
        });
        
        
        
        $(function(){
            capsLockWarning("#password, #cpassword", "<?php echo \Neptune\MessageResources::i18n("warning.caps.lock");?>
");
        });
        
    
<?php
}
}
/* {/block 'jquery'} */
/* {block 'styles'} */
class Block_1334233046604f6bcf22d3d3_71633413 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'styles' => 
  array (
    0 => 'Block_1334233046604f6bcf22d3d3_71633413',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    
        .sectionHead{
            font-weight: 400;
            font-family: 'Poppins', sans-serif;
            color:#506070;
            font-size: 1.1rem;
            font-variant: nornmal;
            margin-bottom: 4px;
        }
        
        .block, .permBlock{
            margin-left: 25px;
        }
        .permBlock{
            margin-left: 5px;
        }
        .block li{
            padding: 0px;
        }
        
        li > label {
            color: #777 !important;
        }
        
    
<?php
}
}
/* {/block 'styles'} */
/* {block 'dataTable'} */
class Block_267338288604f6bcf22db51_55791153 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'dataTable' => 
  array (
    0 => 'Block_267338288604f6bcf22db51_55791153',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    
        'iDisplayLength':100,
        paging: true,
        "dom": "<'row'<'large-4 medium-4 columns collapsed table-toolbar'><'large-7 medium-7 columns end small-text-left medium-text-right collapsed 'f>>"+
            "t"+
            "<'row'<'small-12 medium-6 columns'><'small-12 medium-6 columns'p>>",
        'columnDefs': [
            {
              'targets': [3, 4, 5, 6, 7],
              'orderable': false,
            }
        ]
    
<?php
}
}
/* {/block 'dataTable'} */
/* {block 'content'} */
class Block_1636451684604f6bcf22e231_21872755 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_1636451684604f6bcf22e231_21872755',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/var/www/oecs/vendor/smarty/smarty/libs/plugins/function.html_checkboxes.php','function'=>'smarty_function_html_checkboxes',),));
?>

    
  
    <?php echo $_smarty_tpl->tpl_vars['msg']->value;?>

    <div class="listTableCaption_simpleTable" style="font-variant:normal;font-weight: 500;margin-top:2px;margin-bottom:2px;color:#414042;font-family:'Poppins', sans-serif;font-size:1.3rem;">
        Manage Users
    </div>
    <div style="margin-left:15px;margin-top:2px;">
        <form data-abide name="userForm" id="userForm" action="<?php echo $_smarty_tpl->tpl_vars['actionPage']->value;?>
" method="POST" autocomplete="off">
        
        <input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['user']->value->getId();?>
"/>
        <div class="row" >
            <div class="medium-6 large-4 columns">
                <label><span class="required">Email <small class="error">invalid format</small></span>
                   <input tabindex="1" type="email" name="email" id="email" value="<?php echo $_smarty_tpl->tpl_vars['user']->value->getEmail();?>
" required autocomplete="off" placeholder=""/>
                </label>
            </div>
            <div class="medium-6 large-4 end columns">
                <label><span class="">Contact # <small class="error" id="phoneError"></small></span><br/>
                    <input tabindex="2" type="text" class="medium" name="contact" id="contact" value="<?php echo $_smarty_tpl->tpl_vars['user']->value->getContactNumber();?>
" data-abide-validator="phoneValidator"/>
                </label>
            </div>
        </div>
        <div class="row" >
            <div class="medium-6 large-4 columns">
                <label><span class="required">First name</span>
                   <input tabindex="3" type="text" name="firstName" id="firstName" value="<?php echo $_smarty_tpl->tpl_vars['user']->value->getFirstName();?>
" required />
                </label>
            </div>
            <div class="medium-6 large-4 end columns">
                <label><span class="required">Last name</span>
                    <input tabindex="4" type="text" name="lastName" id="lastName" value="<?php echo $_smarty_tpl->tpl_vars['user']->value->getLastName();?>
" required/>
                </label>
            </div>
        </div>
        <div class="row" >
            <div class="medium-6 large-4 columns">
                <label><span class="required">Password</span>
                   <input tabindex="5" type="password" name="password" id="password" value="<?php echo $_smarty_tpl->tpl_vars['user']->value->getPassword();?>
" autocomplete="off" required/>
                </label>
            </div>
            <div class="medium-6 large-4 end columns">
                <label><span class="required">Confirm password <small class="error">Must match password</small></span>
                     <input tabindex="6" type="password" name="cpassword" id="cpassword" value="<?php echo $_smarty_tpl->tpl_vars['user']->value->getPassword();?>
" autocomplete="off" required data-equalTo="password"/>
                </label>
            </div>
        </div>
        <div class="row" >
            <div class="medium-6 large-4 end columns">
                <label><span class="required">Timeout</span>
                    <a href="#" class="hintanchorRow" onclick="return false;" onMouseover='showhint("The amount of time (in minutes) the user can remain idle before being logged out by the application.<br/>Valid values range from 10 to 60 minutes.", this, event, "180px")'>&nbsp;</a>
                    <small class="error shortMedium">range: 10 to 60</small>
                    <input tabindex="7" type="text" class="short" name="timeout" id="timeout" value="<?php if ($_smarty_tpl->tpl_vars['user']->value->isIdEmpty()) {?> 20 <?php } else {
echo $_smarty_tpl->tpl_vars['user']->value->getTimeout();
}?>" autocomplete="off" data-abide-validator='timeoutRange' required/> 
                </label>
            </div>
            <div class="medium-3 large-2 end columns">
                <label><span>Locked?</span>
                    <div class="switch"> 
                        <input name="locked" id="locked" type="checkbox" value="1" <?php if ($_smarty_tpl->tpl_vars['user']->value->isLocked()) {?> checked <?php }?>> 
                        <label for="locked"></label> 
                    </div> 
                </label>
            </div>
            <div class="medium-3 large-2 end columns">
                <?php if ($_smarty_tpl->tpl_vars['currentUser']->value->isSystem()) {?>
                    <label><span>Superuser?</span>
                        <div class="switch"> 
                            <input name="isSystem" id="isSystem" type="checkbox" value="1" <?php if ($_smarty_tpl->tpl_vars['user']->value->isSystem()) {?> checked <?php }?>> 
                            <label for="isSystem"></label> 
                        </div> 
                    </label>
                <?php } else { ?>
                    <input type="hidden" name="isSystem" value="<?php if ($_smarty_tpl->tpl_vars['user']->value->isSystem()) {?> 1 <?php } else { ?> 0 <?php }?>"/>
                <?php }?>
            </div>
        </div>
        <div class="row">
            <div class="medium-12 columns">
              <hr width="100%" size="2" color="#D0E0F0" style="margin:0px;"/>
            </div>
        </div>
        <div class="row">
            <div class="medium-12 columns">
                <span class="sectionHead">Groups</span>&nbsp<input type="checkbox" class="grp" id="grp"/>
            </div>
        </div>
        <div class="grp">
            <ul class="large-block-grid-3 medium-block-grid-2 small-block-grid-1 block">
                <?php echo smarty_function_html_checkboxes(array('separator'=>'','name'=>'grp[]','selected'=>$_smarty_tpl->tpl_vars['selectedGrps']->value,'options'=>$_smarty_tpl->tpl_vars['groups']->value,'assign'=>'grpOpts'),$_smarty_tpl);?>

                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['grpOpts']->value, 'grpOpt');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['grpOpt']->value) {
?>
                    <li><?php echo $_smarty_tpl->tpl_vars['grpOpt']->value;?>
</li>
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </ul>
        </div>
        <div class="row">
            <div class="medium-12 columns">
                <span class="sectionHead">Permissions</span>&nbsp;<input type="checkbox" class="prm" id="prm"/>
            </div>
        </div>
        <div class="prm" >
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['categories']->value, 'ctg');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['ctg']->value) {
?>
                <?php $_smarty_tpl->_assignInScope('perms', $_smarty_tpl->tpl_vars['prm']->value->getByCategoryId($_smarty_tpl->tpl_vars['ctg']->value->getId()) ,true);?>
                <?php if (count($_smarty_tpl->tpl_vars['perms']->value) > 0) {?>
                    <div class="row">
                        <div class="medium-12 columns">
                            <span class="permBlock">
                                <?php echo \Neptune\MessageResources::i18n($_smarty_tpl->tpl_vars['ctg']->value->getMessageResource());?>

                            </span>
                        </div>
                    </div>
                    <ul class="large-block-grid-3 medium-block-grid-2 small-block-grid-1 block">
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['perms']->value, 'perm');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['perm']->value) {
?>
                            <li>
                                <label>
                                    <input type="checkbox" name="perm[]" value="<?php echo $_smarty_tpl->tpl_vars['perm']->value->getId();?>
" <?php if (in_array($_smarty_tpl->tpl_vars['perm']->value->getId(),$_smarty_tpl->tpl_vars['selectedPerms']->value)) {?> checked="checked" <?php }?>/>
                                    <?php echo \Neptune\MessageResources::i18n($_smarty_tpl->tpl_vars['perm']->value->getPermTextKey());?>

                                    <?php if ($_smarty_tpl->tpl_vars['perm']->value->getCommentKey() != '') {?>
                                        <a href="#" class="hintanchorRow" onclick="return false;" onMouseover='showhint("<?php echo \Neptune\MessageResources::i18n($_smarty_tpl->tpl_vars['perm']->value->getCommentKey());?>
", this, event, "180px")'>&nbsp;</a>
                                    <?php }?>
                                </label> 
                            </li>
                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    </ul>
                <?php }?>
            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </div>

        <div class="row">
            <div class="small-12 columns">
              <hr width="100%" size="2" color="#D0E0F0" style="margin:0px;"/>
            </div>
        </div>
        <div class="row">
            <div class="medium-4 end columns">
                <a tabindex="10" href="/security/user" class="reset">Reset</a>
                <?php echo \Neptune\HtmlElementTag::submitBtn(9);?>

            </div>
            <?php if ($_smarty_tpl->tpl_vars['user']->value->getId() != '') {?>
                <div class="medium-4 end columns">
                    Confirm&nbsp;<input tabindex="11" id="confirmDelete" type="checkbox"/>&nbsp;
                    <?php echo \Neptune\HtmlElementTag::deleteBtn(12,"/security/user/delete/".((string)$_smarty_tpl->tpl_vars['user']->value->getId()));?>

                </div>
            <?php }?>
        </div> 
        <div class="row">
            <div class="medium-8 end columns">
                <div id="err" class="error"></div>
            </div>
        </div>
        </form>
    </div>       
    <?php if (count($_smarty_tpl->tpl_vars['list']->value) > 0) {?>
        <br/> 
        <table align="left" id="listTable" class="displayTable" width="98%" cellspacing="0">
             <thead>
                <tr height="30" style="">
                    <th class="all" width="15%">Last Name</th> 
                    <th class="all" width="15%">First Name</th> 
                    <th class="all" width="15%">Email</th>
                    <th class="all" width="15%">Contact #</th>
                    <th class="tablet-l desktop" width="15%">Member Of</th>
                    <?php if ($_smarty_tpl->tpl_vars['currentUser']->value->isSystem()) {?>
                        <th class="desktop" width="10%">Super user?</th>
                    <?php }?>
                    <th class="desktop" width="8%">Locked?</th>
                    <th class="desktop" width="7%">&nbsp;</th>

                </tr>
            </thead>
            <tbody>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['list']->value, 'usr');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['usr']->value) {
?> 
                    <?php $_smarty_tpl->_assignInScope('usrGrps', $_smarty_tpl->tpl_vars['userGroup']->value->getGroupsByUserId($_smarty_tpl->tpl_vars['usr']->value->getId()) ,true);?>
                    <tr>                           
                        <td><?php echo $_smarty_tpl->tpl_vars['usr']->value->getLastName();?>
</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['usr']->value->getFirstName();?>
</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['usr']->value->getEmail();?>
</td> 
                        <td><?php echo $_smarty_tpl->tpl_vars['usr']->value->displayContactNumber();?>
</td> 
                        <td>
                            <span class="hotspot" title="<?php echo \Neptune\DbMapperUtility::objectArrayToNameList($_smarty_tpl->tpl_vars['usrGrps']->value);?>
">
                                <?php if (count($_smarty_tpl->tpl_vars['usrGrps']->value) == 1) {?> 
                                    1 group
                                <?php } elseif (count($_smarty_tpl->tpl_vars['usrGrps']->value) > 0) {?>
                                    <?php echo count($_smarty_tpl->tpl_vars['usrGrps']->value);?>
 groups
                                <?php } else { ?>
                                    &nbsp;
                                <?php }?>
                            </span>
                        </td>
                        <?php if ($_smarty_tpl->tpl_vars['currentUser']->value->isSystem()) {?>
                            <td><?php echo \Neptune\DbMapperUtility::booleanYesNo($_smarty_tpl->tpl_vars['usr']->value->isSystem());?>
</td> 
                        <?php }?>
                        <td><?php echo \Neptune\DbMapperUtility::booleanYesNo($_smarty_tpl->tpl_vars['usr']->value->getLocked());?>
</td>
                        <td>
                            <a class="editRow" title="<?php echo \Neptune\MessageResources::i18n('link.edit');?>
" href="/security/user/edit/<?php echo $_smarty_tpl->tpl_vars['usr']->value->getId();?>
">
                                <i class='fas fa-edit' style='font-size:1.5rem;color:#008cba;'></i>
                            </a>
                        </td>

                    </tr>
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </tbody>
        </table> 
    <?php } else { ?>
        <div class="emptyListMessage">No users have been recorded.</div>
    <?php }?>


<?php
}
}
/* {/block 'content'} */
/* {block "auxScripts"} */
class Block_216693662604f6bcf247032_98470156 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'auxScripts' => 
  array (
    0 => 'Block_216693662604f6bcf247032_98470156',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    
        const phoneUtil = i18n.phonenumbers.PhoneNumberUtil.getInstance();
        var contact = document.querySelector("#contact");
        
        var phoneErrorMap = ["Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"];
        
        var itiContact = intlTelInput(contact,{
            utilsScript: "/js/utils.js",
            placeholderNumberType: "FIXED_LINE",
            hiddenInput: "contactNumber",
            "allowDropdown": true,
            "autoPlaceholder": "polite",
            "initialCountry": "lc",
            "preferredCountries": ["lc", "us", "gb"],
            "formatOnDisplay": true,
            autoHideDialCode: true,
        });
       
    
<?php
}
}
/* {/block "auxScripts"} */
/* {block "foundation"} */
class Block_1252085591604f6bcf2478d8_35793876 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'foundation' => 
  array (
    0 => 'Block_1252085591604f6bcf2478d8_35793876',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    
        abide: {
            validators: {
                phoneValidator: function (el, required, parent) {
                   
                    if (el.getAttribute("id") == 'primaryNumber') {
                        if (!itiPrimaryNumber.isValidNumber()) {
                           /* var countryCode = itiPrimaryNumber.getSelectedCountryData().iso2;

                            if (countryCode == "lc" && (itiPrimaryNumber.getNumber().indexOf("732") == 5 || itiPrimaryNumber.getNumber().indexOf("733") == 5) && phoneErrorMap[itiPrimaryNumber.getValidationError()] == "Invalid number") {
                                $("#phoneError").text("");
                                $("#primaryNumber").removeClass("error");
                                return true;
                            } */
                            $("#phoneError").text(phoneErrorMap[itiPrimaryNumber.getValidationError()]).css("display","inline-block");
                            $("#contact").addClass("error");
                            return false;
                        } else {
                            $("#contact").removeClass("error");
                        }
                    }
                    $("#phoneError").css("display","none");
                    return true;
                },
                timeoutRange: function (el, required, parent) {
                    try{
                        if($.trim(el.value) != ''){
                            var tout = $.trim(el.value);
                           
                            if(!isNaN(parseInt(tout)) && isFinite(tout)){
                                if(parseInt(tout) >= 10 && parseInt(tout) <= 60){
                                    return true;
                                } else {
                                    return false;
                                }
                            }else{
                                 return false;
                            }
                        }else{
                            return false;
                        }
                    }catch(e){
                        return false;
                    }    
                    //other rules can go here
                    return true;
                }
            },
            patterns: {
                short_comment: /^.{0,30}$/,
                long_comment: /^.{0,150}$/,
                medium_comment: /^.{0,100}$/
            }
        } 
    
<?php
}
}
/* {/block "foundation"} */
}
