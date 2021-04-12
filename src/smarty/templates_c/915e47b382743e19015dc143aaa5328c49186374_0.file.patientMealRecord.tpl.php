<?php
/* Smarty version 3.1.34-dev-7, created on 2021-04-12 19:59:42
  from '/var/www/oecs/src/smarty/templates/self_report/patientMealRecord.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_6074a6aeded560_77138047',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '915e47b382743e19015dc143aaa5328c49186374' => 
    array (
      0 => '/var/www/oecs/src/smarty/templates/self_report/patientMealRecord.tpl',
      1 => 1614879547,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6074a6aeded560_77138047 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>



<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1248766926074a6aedbca28_69757239', 'jquery');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_6530799956074a6aedc0096_51303499', 'styles');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_4493332856074a6aedc09f4_02222297', 'dataTable');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_10645010766074a6aedc1312_68209685', 'content');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_3810340076074a6aedec632_27013052', "foundation");
?>


<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "base/body.tpl");
}
/* {block 'jquery'} */
class Block_1248766926074a6aedbca28_69757239 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'jquery' => 
  array (
    0 => 'Block_1248766926074a6aedbca28_69757239',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    
        var smallScreen = window.matchMedia("(max-width: 40.0625em)");
        var chgPwdWidth = (smallScreen.matches) ? "100%" : "440px";
    
        $("div.table-toolbar").html("<?php echo \Neptune\MessageResources::i18n("patientMealForm.recorded.list");?>
").css({
            "margin-left" : "26px",
            "font-family": "'Poppins', sans-serif",
            "font-size" : "1.2rem",
            "font-weight" : 500,
            "color": "#464646"
        });
        
        $("#dateConsumed").datepicker({
            format:"M dd, yyyy",
            autoclose: true,
            clearBtn: true,
            endDate: '0d'
        }).data("datepicker");
        
        var timePickiOptions = {
            tincrease_direction: 'up',
            disable_keyboard_mobile: true
        };
        
        $("#timeConsumed").timepicki(timePickiOptions);
        $("#mealTypeId").chosen();
        
        $("input.fg").click(function() {
            var parLi = $(this).closest("li");
            if ($(this).prop("checked")) {
                parLi.find("textarea").prop("disabled", false);
            } else {
                parLi.find("textarea").prop("disabled", true).val("");
            }
        });
        
        /*****************************************
         Interrupt form submit to make sure that 
         at least one food group is selected
        ******************************************/
        $("#patientMealForm").submit(function(e){
            if( $('input[name="foodGroupId[]"]:checked').length == 0){
                e.preventDefault();
                $("div#err").html("At least one food group must be selected");
            }else{
                $("div#err").html("");
                var errorCnt = 0;
                $('input[name="foodGroupId[]"]:checked').each(function() {
                    var parLi = $(this).closest("li");
                    if ($.trim(parLi.find("textarea").val()) == '') {
                        errorCnt++;
                        parLi.find("textarea").addClass("error");
                    } else{
                        parLi.find("textarea").removeClass("error");
                    }
                });
                if (errorCnt > 0) {
                    e.preventDefault();
                    return false;
                }
            }
        });
   
    
<?php
}
}
/* {/block 'jquery'} */
/* {block 'styles'} */
class Block_6530799956074a6aedc0096_51303499 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'styles' => 
  array (
    0 => 'Block_6530799956074a6aedc0096_51303499',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    
        .shorter {
          width: 70px !important;
        }
        .shortest {
          width: 50px !important;
        }
        
    
<?php
}
}
/* {/block 'styles'} */
/* {block 'dataTable'} */
class Block_4493332856074a6aedc09f4_02222297 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'dataTable' => 
  array (
    0 => 'Block_4493332856074a6aedc09f4_02222297',
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
class Block_10645010766074a6aedc1312_68209685 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_10645010766074a6aedc1312_68209685',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/var/www/oecs/vendor/smarty/smarty/libs/plugins/function.html_options.php','function'=>'smarty_function_html_options',),));
?>

    
    <?php echo $_smarty_tpl->tpl_vars['msg']->value;?>

    
    <div class="listTableCaption_simpleTable" style="font-variant:normal;font-weight: 500;margin-top:2px;margin-bottom:2px;color:#414042;font-family:'Poppins', sans-serif;font-size:1.3rem;">
        <?php echo \Neptune\MessageResources::i18n("patientMealForm.legend");?>

    </div>
    <div style="margin-left:15px;margin-top:2px;">
        <form data-abide name="patientMealForm" id="patientMealForm" action="<?php echo $_smarty_tpl->tpl_vars['actionPage']->value;?>
" method="POST" autocomplete="off">

                <input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['patientMeal']->value->getId();?>
"/>
                <input type="hidden" name="patientId" value="<?php echo $_SESSION['patientId'];?>
"/>
                <div class="row">
                    <div class="medium-3 end columns">
                        <label><span class="required"><?php echo \Neptune\MessageResources::i18n("patientMealForm.mealTypeId");?>
</span><br/>
                            <select name="mealTypeId" id="mealTypeId" tabindex="1"  required>
                                <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['mealTypeIds']->value,'selected'=>$_smarty_tpl->tpl_vars['patientMeal']->value->getMealTypeId()),$_smarty_tpl);?>

                            </select>
                        </label>
                    </div>
                    <div class="medium-3 end columns">
                        <label><span class="required"><?php echo \Neptune\MessageResources::i18n("patientMealForm.dateConsumed");?>
</span>
                            <input tabindex="2" class="medium" type="text" id="dateConsumed" name="dateConsumed" value="<?php echo $_smarty_tpl->tpl_vars['patientMeal']->value->displayDateConsumed();?>
" placeholder="MMM dd, yyyy" required>
                        </label>
                    </div>
                    <div class="medium-3 end columns">
                        <label><span class="required"><?php echo \Neptune\MessageResources::i18n("patientMealForm.timeConsumed");?>
</span>
                            <input tabindex="3" class="short" type="text" id="timeConsumed" name="timeConsumed" value="<?php echo $_smarty_tpl->tpl_vars['patientMeal']->value->displayTimeConsumed();?>
" required>
                        </label>
                    </div>
                </div>
                <div class="row" style="margin-top:25px;">
                    <div class="medium-9 end columns">
                        <b>Please specify the food groups (and optional details) that were consumed during this meal below.</b>
                    </div>
                </div>
                                <div class="row">
                    <div class="medium-9 end columns">
                        <ul class="medium-block-grid-2 small-block-grid-1">
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['foodGroups']->value, 'fg');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['fg']->value) {
?>
                                <li>
                                    <div>
                                        <label for="<?php echo $_smarty_tpl->tpl_vars['fg']->value->getId();?>
" style="font-weight:500;color:#464646;"><input class="fg" <?php if (\Neptune\DbMapperUtility::isObjectInArray($_smarty_tpl->tpl_vars['fg']->value,$_smarty_tpl->tpl_vars['associatedFoodGroups']->value)) {?> checked <?php }?> type="checkbox" id="<?php echo $_smarty_tpl->tpl_vars['fg']->value->getId();?>
" name="foodGroupId[]" value="<?php echo $_smarty_tpl->tpl_vars['fg']->value->getId();?>
" style="float:left;"/><?php echo $_smarty_tpl->tpl_vars['fg']->value->getLabel();?>
</label>
                                    </div>
                                    <div>
                                        <?php if (trim($_smarty_tpl->tpl_vars['fg']->value->getImageName()) != '') {?>
                                            <div style="width:135px;float:left;">
                                                <img src="/food_group_images/<?php echo $_smarty_tpl->tpl_vars['fg']->value->getImageName();?>
" alt=""/>
                                            </div>
                                        <?php }?>
                                        <div style="width:50%;float:left;">
                                            <textarea name="detail_<?php echo $_smarty_tpl->tpl_vars['fg']->value->getId();?>
" cols="5" <?php if (!\Neptune\DbMapperUtility::isObjectInArray($_smarty_tpl->tpl_vars['fg']->value,$_smarty_tpl->tpl_vars['associatedFoodGroups']->value)) {?> disabled <?php }?> rows="6" placeholder="Put details of <?php echo $_smarty_tpl->tpl_vars['fg']->value->getLabel();?>
 consumed here" style="resize:none;padding-top:8px;color:#000000;font-size:0.85rem;display:inline-block;"><?php echo $_smarty_tpl->tpl_vars['mealFoodGroup']->value->getByMealRecordAndFoodGroupId($_smarty_tpl->tpl_vars['patientMeal']->value->getId(),$_smarty_tpl->tpl_vars['fg']->value->getId())->getDetails();?>
</textarea>
                                        </div>
                                    </div>
                                </li>
                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </ul>
                    </div>
                </div>
                            
                            
                <div class="row">
                    <div class="medium-3 end columns" style="padding-top:8px;">
                        <a href="/patient/meal/record/form" tabindex="5" class="reset"><?php echo \Neptune\MessageResources::i18n("link.reset");?>
</a>&nbsp;
                        <?php echo \Neptune\HtmlElementTag::submitBtn(4);?>

                    </div>
                    <?php if ($_smarty_tpl->tpl_vars['patientMeal']->value->getId() != '') {?>
                        <div class="medium-3 end columns" style="padding-top:8px;">
                            <?php echo \Neptune\MessageResources::i18n("checkbox.confirm");?>
&nbsp;<input tabindex="6" id="confirmDelete" type="checkbox"/>
                            <?php echo \Neptune\HtmlElementTag::deleteBtn(7,"/patient/meal/record/delete/".((string)$_smarty_tpl->tpl_vars['patientMeal']->value->getId()));?>

                        </div>
                    <?php }?>
                </div>
                <div class="row">
                    <div class="medium-9 end columns">
                        <div id="err" class="error"></div>
                    </div>
                </div>
        </form> 
    </div>       

<?php if (count($_smarty_tpl->tpl_vars['list']->value) > 0) {?>
    <br/>
    <table align="left" id="listTable" class="displayTable" width="95%" cellspacing="0">
        <thead>
            <tr>
                <th><?php echo \Neptune\MessageResources::i18n("patientMealForm.mealTypeId");?>
</th>
                <th><?php echo \Neptune\MessageResources::i18n("patientMealForm.dateConsumed");?>
</th>
                <th><?php echo \Neptune\MessageResources::i18n("patientMealForm.timeConsumed");?>
</th>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['foodGroups']->value, 'mfg');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['mfg']->value) {
?>
                    <th><?php echo $_smarty_tpl->tpl_vars['mfg']->value->getLabel();?>
</th>
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                <th width="10%">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['list']->value, 'pmr');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['pmr']->value) {
?> 
                <tr>  
                    <td><?php echo $_smarty_tpl->tpl_vars['pmr']->value->getMealType()->getLabel();?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['pmr']->value->displayDateConsumed();?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['pmr']->value->displayTimeConsumed();?>
</td>
                    
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['foodGroups']->value, 'mfg');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['mfg']->value) {
?>
                        <td><?php echo $_smarty_tpl->tpl_vars['mealFoodGroup']->value->getByMealRecordAndFoodGroupId($_smarty_tpl->tpl_vars['pmr']->value->getId(),$_smarty_tpl->tpl_vars['mfg']->value->getId())->getDetails();?>
</td>
                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                   
                    <td>
                        <a class="editRow" title="<?php echo \Neptune\MessageResources::i18n("link.edit");?>
" href="/patient/meal/record/edit/<?php echo $_smarty_tpl->tpl_vars['pmr']->value->getId();?>
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
        <?php echo \Neptune\MessageResources::i18n("patientMealForm.empty.list.message");?>

    </div>
<?php }?>
<br/><br/>



<?php
}
}
/* {/block 'content'} */
/* {block "foundation"} */
class Block_3810340076074a6aedec632_27013052 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'foundation' => 
  array (
    0 => 'Block_3810340076074a6aedec632_27013052',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    
        abide : {
            patterns: {
              positive_integer: /^\d+$/,
              positive_number: /^\d*\.{0,1}\d+$/
            }
        }
    
<?php
}
}
/* {/block "foundation"} */
}
