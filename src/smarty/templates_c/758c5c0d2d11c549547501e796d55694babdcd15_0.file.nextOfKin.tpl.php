<?php
/* Smarty version 3.1.34-dev-7, created on 2021-04-13 13:02:46
  from '/var/www/oecs/src/smarty/templates/patient/nextOfKin.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_60759676cfaa96_86541102',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '758c5c0d2d11c549547501e796d55694babdcd15' => 
    array (
      0 => '/var/www/oecs/src/smarty/templates/patient/nextOfKin.tpl',
      1 => 1618318962,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60759676cfaa96_86541102 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>




<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_89762578160759676cde722_17472907', 'jquery');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_119735191460759676ce1246_95224358', 'dataTable');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_134898319360759676ce1b32_58531306', 'content');
?>



<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_179223009860759676cf8fc5_24976669', "auxScripts");
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_173270059660759676cf9c02_42047175', "foundation");
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "base/body.tpl");
}
/* {block 'jquery'} */
class Block_89762578160759676cde722_17472907 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'jquery' => 
  array (
    0 => 'Block_89762578160759676cde722_17472907',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    
        $("div.table-toolbar").html("<?php echo \Neptune\MessageResources::i18n("nextOfKinForm.recorded.list");?>
").css({
            "margin-left" : "26px",
            "font-family": "'Poppins', sans-serif",
            "font-size" : "1.1rem",
            "font-weight" : 500,
            "color": "#464646"
        });
        
        $("form").find("select").chosen();
        
        /*****************************************
         Interrupt form submit to take care of 
         telephone stuff
        ******************************************/
        $("#nextOfKinForm").submit(function(e){
            var countryCode = itiContact.getSelectedCountryData().iso2;
            var telContact = phoneUtil.parseAndKeepRawInput(itiContact.getNumber(), countryCode.toUpperCase());
            $("input[name='contactNumber']").val(phoneUtil.format(telContact, i18n.phonenumbers.PhoneNumberFormat.INTERNATIONAL));
        });
        
    
<?php
}
}
/* {/block 'jquery'} */
/* {block 'dataTable'} */
class Block_119735191460759676ce1246_95224358 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'dataTable' => 
  array (
    0 => 'Block_119735191460759676ce1246_95224358',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    
        paging: true,
        "dom": "<'row'<'large-4 medium-4 columns collapsed table-toolbar'><'large-7 medium-7 columns end small-text-left medium-text-right collapsed 'f>>"+
            "t"+
            "<'row'<'small-12 medium-6 columns'><'small-12 medium-6 columns'p>>"
    
<?php
}
}
/* {/block 'dataTable'} */
/* {block 'content'} */
class Block_134898319360759676ce1b32_58531306 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_134898319360759676ce1b32_58531306',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/var/www/oecs/vendor/smarty/smarty/libs/plugins/function.html_options.php','function'=>'smarty_function_html_options',),));
?>

    
    <?php echo $_smarty_tpl->tpl_vars['msg']->value;?>

    <div class="listTableCaption_simpleTable" style="font-variant:normal;font-weight: 500;margin-top:2px;margin-bottom:2px;color:#414042;font-family:'Poppins', sans-serif;font-size:1.3rem;">
        <?php echo \Neptune\MessageResources::i18n("nextOfKinForm.legend");?>

    </div>
    <?php if (trim($_SESSION['patientId']) != '') {?>
        <div style="margin-left:15px;margin-top:2px;width:80%;">
            <form data-abide name="nextOfKinForm" id="nextOfKinForm" action="<?php echo $_smarty_tpl->tpl_vars['actionPage']->value;?>
" method="POST" autocomplete="off">
                <input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['nextOfKin']->value->getId();?>
"/>
                <input type="hidden" name="patientId" value="<?php echo $_SESSION['patientId'];?>
"/>
            
                <div class="row">
                    <div class="medium-12 end columns">
                        <label><span class="required"><?php echo \Neptune\MessageResources::i18n("nextOfKinForm.name");?>
</span>
                            <input tabindex="1" type="text"  maxlength="140" id="name" name="name" value="<?php echo $_smarty_tpl->tpl_vars['nextOfKin']->value->getName();?>
" required>
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="medium-12 end columns">
                        <label><span class="required"><?php echo \Neptune\MessageResources::i18n("nextOfKinForm.relationshipTypeId");?>
</span>
                            <select tabindex="2" id="relationshipTypeId" name="relationshipTypeId"  required>
                                <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['relationshipTypeIds']->value,'selected'=>$_smarty_tpl->tpl_vars['nextOfKin']->value->getRelationshipTypeId()),$_smarty_tpl);?>

                            </select>
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="medium-12 end columns">
                        <label><span class="required"><?php echo \Neptune\MessageResources::i18n("nextOfKinForm.contactNumber");?>
</span><small id="phoneError" class="error"></small><br/>
                            <input tabindex="3" type="text"  class="medium" data-abide-validator="phoneValidator"  id="contact" name="contact" value="<?php echo $_smarty_tpl->tpl_vars['nextOfKin']->value->getContactNumber();?>
" required>
                        </label>
                    </div>
                </div>
                

                <div class="row">
                    <div class="medium-4 end columns" style="padding-top:8px;">
                        <a href="/next/of/kin/form" tabindex="5" class="reset"><?php echo \Neptune\MessageResources::i18n("link.reset");?>
</a>&nbsp;
                        <?php echo \Neptune\HtmlElementTag::submitBtn(4);?>

                    </div>
                    <?php if ($_smarty_tpl->tpl_vars['nextOfKin']->value->getId() != '') {?>
                        <div class="medium-4 end columns" style="padding-top:8px;">
                            <?php echo \Neptune\MessageResources::i18n("checkbox.confirm");?>
&nbsp;<input tabindex="6" id="confirmDelete" type="checkbox"/>
                            <?php echo \Neptune\HtmlElementTag::deleteBtn(7,"/next/of/kin/delete/".((string)$_smarty_tpl->tpl_vars['nextOfKin']->value->getId()));?>

                        </div>
                    <?php }?>
                </div>

            </form> 
        </div> 
        <div>
            <hr width="96%" style="margin:10px 2px 7px 2px;"/>
        </div>
    <?php }?>                    
    <?php if (count($_smarty_tpl->tpl_vars['list']->value) > 0) {?>
        <br/>
        <table align="left" id="listTable" class="displayTable" width="95%" cellspacing="0">
            <thead>
                <tr>
                    <th><?php echo \Neptune\MessageResources::i18n("nextOfKinForm.name");?>
</th>
                    <th><?php echo \Neptune\MessageResources::i18n("nextOfKinForm.relationshipTypeId");?>
</th> 
                    <th><?php echo \Neptune\MessageResources::i18n("nextOfKinForm.contactNumber");?>
</th>
                    <th width="10%">&nbsp;</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['list']->value, 'nok');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['nok']->value) {
?> 
                    <tr>    
                        <td><?php echo $_smarty_tpl->tpl_vars['nok']->value->getName();?>
</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['nok']->value->getRelationshipType()->getLabel();?>
</td> 
                        <td><?php echo $_smarty_tpl->tpl_vars['nok']->value->getContactNumber();?>
</td>
                        <td>
                            <a class="editRow" title="<?php echo \Neptune\MessageResources::i18n("link.edit");?>
" href="/next/of/kin/edit/<?php echo $_smarty_tpl->tpl_vars['nok']->value->getId();?>
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
        <div class="emptyListMessage">
            <?php echo \Neptune\MessageResources::i18n("nextOfKinForm.empty.list.message");?>

        </div>
    <?php }?>
    <br/><br/>

<?php
}
}
/* {/block 'content'} */
/* {block "auxScripts"} */
class Block_179223009860759676cf8fc5_24976669 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'auxScripts' => 
  array (
    0 => 'Block_179223009860759676cf8fc5_24976669',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    
        const phoneUtil = i18n.phonenumbers.PhoneNumberUtil.getInstance();
        var contactNumber = document.querySelector("#contact");
       
        var phoneErrorMap = ["Invalid number", "Invalid country code", "Too short", "Too long"];
        
        var itiContact = intlTelInput(contact,{
            utilsScript: "/js/utils.js",
            placeholderNumberType: "FIXED_LINE",
            hiddenInput: "contactNumber",
            "allowDropdown": true,
            "autoPlaceholder": "polite",
            "initialCountry": "ai",
            "preferredCountries": ["ai", "ag", "vg", "dm", "gd", "gp", "mq", "ms", "kn", "lc", "vc"],
            "formatOnDisplay": true,
            autoHideDialCode: true
        });
        
        
        
    
<?php
}
}
/* {/block "auxScripts"} */
/* {block "foundation"} */
class Block_173270059660759676cf9c02_42047175 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'foundation' => 
  array (
    0 => 'Block_173270059660759676cf9c02_42047175',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    abide : {
        validators: {
            
            phoneValidator: function (el, required, parent) {
                   
                if (el.getAttribute("id") == 'contact') {
                    if (!itiContact.isValidNumber()) {
                       /* var countryCode = itiPrimaryNumber.getSelectedCountryData().iso2;

                        if (countryCode == "lc" && (itiPrimaryNumber.getNumber().indexOf("732") == 5 || itiPrimaryNumber.getNumber().indexOf("733") == 5) && phoneErrorMap[itiPrimaryNumber.getValidationError()] == "Invalid number") {
                            $("#phoneError").text("");
                            $("#primaryNumber").removeClass("error");
                            return true;
                        } */
                        $("#phoneError").text(phoneErrorMap[itiContact.getValidationError()]).css("display","inline-block");
                        $("#contact").addClass("error");
                        return false;
                    } else {
                        $("#contact").removeClass("error");
                    }
                }
                $("#phoneError").css("display","none");
                return true;
            }
        }
    }
<?php
}
}
/* {/block "foundation"} */
}
