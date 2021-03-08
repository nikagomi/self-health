<?php
/* Smarty version 3.1.34-dev-7, created on 2021-03-08 20:25:41
  from '/var/www/oecs/src/smarty/templates/self_report/patientSmokingDrinkingStatus.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_6046884511a8d3_25159754',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd09687859fd01b7cd61cc1674cd36c8c2f59f9af' => 
    array (
      0 => '/var/www/oecs/src/smarty/templates/self_report/patientSmokingDrinkingStatus.tpl',
      1 => 1615235138,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6046884511a8d3_25159754 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>



<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1529601876604688450f3254_91333750', 'jquery');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_918231360604688450f4534_00505840', 'dataTable');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1601722790604688450f4ea1_20863482', 'dataTable');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1158027596604688450f58a9_28350073', 'content');
?>


<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "base/body.tpl");
}
/* {block 'jquery'} */
class Block_1529601876604688450f3254_91333750 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'jquery' => 
  array (
    0 => 'Block_1529601876604688450f3254_91333750',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    
   
        
        $("#stopSmokingDate, #stopDrinkingDate").datepicker({
            format:"M dd, yyyy",
            autoclose: true,
            clearBtn: true,
            endDate: '0d',
            highlightToday: true,
            todayBtn: true
        }).data("datepicker");
        
        
        $("#smokingSinceInterval, #smokingFrequency, #drinkingSinceInterval, #drinkingFrequency").chosen();
        
        $("input[type='radio'].dSmoke").click(function(){
            if ($(this).val() == 1) {
                $("div.ddSmoke").each(function(){ 
                    $(this).css("display","block");
                });
            } else {
                $("div.ddSmoke").each(function(){ 
                    $(this).css("display","none");
                    $(this).find("input[type='text'], textarea").val("");
                    $(this).find("select").val("").trigger("chosen:updated");
                });
            }
        });
        
        $("input[type='radio'].sSmoke").click(function(){
            if ($(this).val() == 1) {
                $("div.sSmoke").each(function(){ 
                    $(this).css("display","block");
                });
            } else {
                $("div.sSmoke").each(function(){ 
                    $(this).css("display","none");
                    $(this).find("input[type='text']").val("");
                });
            }
        });
        
        $("input[type='radio'].dDrink").click(function(){
            if ($(this).val() == 1) {
                $("div.ddDrink").each(function(){ 
                    $(this).css("display","block");
                });
            } else {
                $("div.ddDrink").each(function(){ 
                    $(this).css("display","none");
                    $(this).find("input[type='text'], textarea").val("");
                    $(this).find("select").val("").trigger("chosen:updated");
                });
            }
        });
        
        $("input[type='radio'].sDrink").click(function(){
            if ($(this).val() == 1) {
                $("div.sDrink").each(function(){ 
                    $(this).css("display","block");
                });
            } else {
                $("div.sDrink").each(function(){ 
                    $(this).css("display","none");
                    $(this).find("input[type='text']").val("");
                });
            }
        });
      
    
<?php
}
}
/* {/block 'jquery'} */
/* {block 'dataTable'} */
class Block_918231360604688450f4534_00505840 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'dataTable' => 
  array (
    0 => 'Block_918231360604688450f4534_00505840',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    
       
    
<?php
}
}
/* {/block 'dataTable'} */
/* {block 'dataTable'} */
class Block_1601722790604688450f4ea1_20863482 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'dataTable' => 
  array (
    0 => 'Block_1601722790604688450f4ea1_20863482',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    
       
    
<?php
}
}
/* {/block 'dataTable'} */
/* {block 'content'} */
class Block_1158027596604688450f58a9_28350073 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_1158027596604688450f58a9_28350073',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/var/www/oecs/vendor/smarty/smarty/libs/plugins/function.html_options.php','function'=>'smarty_function_html_options',),));
?>

    
    <?php echo $_smarty_tpl->tpl_vars['msg']->value;?>

    <div class="listTableCaption_simpleTable" style="font-variant:normal;font-weight:500;margin-top:2px;margin-bottom:2px;color:#414042;font-family:'Poppins',sans-serif;font-size:1.3rem;">
        <?php echo \Neptune\MessageResources::i18n("patientSmokingDrinkingStatusForm.legend");?>

    </div>
    <?php if (trim($_SESSION['patientId']) != '') {?>
        <div style="margin-left:15px;margin-top:2px;width:85%;">
            <form data-abide name="patientSmokingDrinkingStatusForm" id="patientSmokingDrinkingStatusForm" action="<?php echo $_smarty_tpl->tpl_vars['actionPage']->value;?>
" method="POST" autocomplete="off">
                <input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['patientSmokingDrinkingStatus']->value->getId();?>
"/>
                <input type="hidden" name="patientId" value="<?php echo $_SESSION['patientId'];?>
"/>
            <div class="row">
                <div class="medium-12 end columns">
                    <ul class="medium-block-grid-2 small-block-grid-1">
                        <li>
                            <div class="row">
                                <div class="medium-12 end columns">
                                    <label><span class=""><?php echo \Neptune\MessageResources::i18n("patientSmokingDrinkingStatusForm.smoker");?>
</span><br/>
                                        <input name="smoker" id="smoker" tabindex="1" class="dSmoke" type="radio" value="1" <?php if ($_smarty_tpl->tpl_vars['patientSmokingDrinkingStatus']->value->isSmoker()) {?> checked <?php }?>> 
                                        <label for="smoker">Yes</label> 
                                        <input name="smoker" id="notSmoker" tabindex="2" class="dSmoke" type="radio" value="0" <?php if (!$_smarty_tpl->tpl_vars['patientSmokingDrinkingStatus']->value->isIdEmpty() && !$_smarty_tpl->tpl_vars['patientSmokingDrinkingStatus']->value->isSmoker()) {?> checked <?php }?>> 
                                        <label for="notSmoker">No</label>
                                    </label>
                                </div>
                            </div>
                            <div class="row" style="margin-bottom:8px;">
                                <div class="medium-12 end columns ddSmoke" style="<?php if ($_smarty_tpl->tpl_vars['patientSmokingDrinkingStatus']->value->isSmoker()) {?> display:inline-block; <?php } else { ?> display:none; <?php }?>">
                                    <label>
                                        <span class=""><?php echo \Neptune\MessageResources::i18n("patientSmokingDrinkingStatusForm.smokingSince");?>
</span>
                                    </label>
                                    <input tabindex="3" type="text" class="short" maxlength="2"id="smokingSinceQuantity" name="smokingSinceQuantity" value="<?php echo $_smarty_tpl->tpl_vars['patientSmokingDrinkingStatus']->value->getSmokingSinceQuantity();?>
" style="float:left;display:inline-block;margin-right:5px;"/>
                                    <select tabindex="4" name="smokingSinceInterval" id="smokingSinceInterval" class="" style="float:left;display:inline-block;width:170px;">
                                        <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['intervals']->value,'selected'=>$_smarty_tpl->tpl_vars['patientSmokingDrinkingStatus']->value->getSmokingSinceInterval()),$_smarty_tpl);?>

                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="medium-12 end columns ddSmoke"  style="<?php if ($_smarty_tpl->tpl_vars['patientSmokingDrinkingStatus']->value->isSmoker()) {?> display:inline-block; <?php } else { ?> display:none; <?php }?>">
                                    <label><span class=""><?php echo \Neptune\MessageResources::i18n("patientSmokingDrinkingStatusForm.smokingFrequency");?>
</span>
                                        <select tabindex="5"  name="smokingFrequency" id="smokingFrequency" style="width:120px;">
                                            <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['frequencies']->value,'selected'=>$_smarty_tpl->tpl_vars['patientSmokingDrinkingStatus']->value->getSmokingFrequency()),$_smarty_tpl);?>

                                        </select>
                                    </label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="medium-12 end columns ddSmoke" style="<?php if ($_smarty_tpl->tpl_vars['patientSmokingDrinkingStatus']->value->isSmoker()) {?> display:inline-block; <?php } else { ?> display:none; <?php }?>">
                                    <label><span class=""><?php echo \Neptune\MessageResources::i18n("patientSmokingDrinkingStatusForm.stoppedSmoking");?>
</span><br/>
                                        <input name="stoppedSmoking" id="stoppedSmoking" class="sSmoke" tabindex="6" type="radio" value="1" <?php if ($_smarty_tpl->tpl_vars['patientSmokingDrinkingStatus']->value->hasStoppedSmoking()) {?> checked <?php }?>> 
                                        <label for="stoppedSmoking">Yes</label> 
                                        <input name="stoppedSmoking" id="notStoppedSmoking" class="sSmoke" tabindex="7" type="radio" value="0" <?php if (!$_smarty_tpl->tpl_vars['patientSmokingDrinkingStatus']->value->isIdEmpty() && !$_smarty_tpl->tpl_vars['patientSmokingDrinkingStatus']->value->hasStoppedSmoking()) {?> checked <?php }?>> 
                                        <label for="notStoppedSmoking">No</label>
                                    </label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="medium-12 end columns sSmoke" style="<?php if ($_smarty_tpl->tpl_vars['patientSmokingDrinkingStatus']->value->hasStoppedSmoking()) {?> display:inline-block; <?php } else { ?> display:none; <?php }?>">
                                    <label><span class=""><?php echo \Neptune\MessageResources::i18n("patientSmokingDrinkingStatusForm.stopSmokingDate");?>
</span>
                                        <input tabindex="8" type="text" class="medium sSmoke" placeholder="MMM d, yyyy" id="stopSmokingDate" name="stopSmokingDate" value="<?php echo $_smarty_tpl->tpl_vars['patientSmokingDrinkingStatus']->value->displayStopSmokingDate();?>
"/>
                                    </label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="medium-12 end columns ddSmoke" style="<?php if ($_smarty_tpl->tpl_vars['patientSmokingDrinkingStatus']->value->isSmoker()) {?> display:inline-block; <?php } else { ?> display:none; <?php }?>">
                                    <label><span class=""><?php echo \Neptune\MessageResources::i18n("patientSmokingDrinkingStatusForm.smokingComments");?>
</span>
                                        <textarea cols="20" rows="3" style="resize:none;" tabindex="9" name="smokingComments" id="smokingComments" placeholder="What do you smoke? More details on frequency, etc."><?php echo $_smarty_tpl->tpl_vars['patientSmokingDrinkingStatus']->value->getSmokingComments();?>
</textarea>
                                    </label>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="row">
                                <div class="medium-12 end columns">
                                    <label><span class=""><?php echo \Neptune\MessageResources::i18n("patientSmokingDrinkingStatusForm.drinker");?>
</span><br/>
                                        <input name="drinker" id="isDrinker" tabindex="10" class="dDrink" type="radio" value="1" <?php if ($_smarty_tpl->tpl_vars['patientSmokingDrinkingStatus']->value->isDrinker()) {?> checked <?php }?>/> 
                                        <label for="isDrinker">Yes</label> 
                                        <input name="drinker" id="notDrinker" tabindex="11" class="dDrink" type="radio" value="0" <?php if (!$_smarty_tpl->tpl_vars['patientSmokingDrinkingStatus']->value->isIdEmpty() && !$_smarty_tpl->tpl_vars['patientSmokingDrinkingStatus']->value->isDrinker()) {?> checked <?php }?>/> 
                                        <label for="notDrinker">No</label> 
                                    </label>
                                </div>
                            </div>
                            <div class="row"  style="margin-bottom:8px;">
                                <div class="medium-12 end columns ddDrink" style="<?php if ($_smarty_tpl->tpl_vars['patientSmokingDrinkingStatus']->value->isDrinker()) {?> display:inline-block; <?php } else { ?> display:none; <?php }?>">
                                    <label>
                                        <span class=""><?php echo \Neptune\MessageResources::i18n("patientSmokingDrinkingStatusForm.drinkingSince");?>
</span>
                                    </label>
                                    <input tabindex="12" type="text" class="short dDrink" maxlength="2" pattern="number" id="drinkingSinceQuantity" name="drinkingSinceQuantity" value="<?php echo $_smarty_tpl->tpl_vars['patientSmokingDrinkingStatus']->value->getDrinkingSinceQuantity();?>
" style="float:left;display:inline-block;margin-right:5px;"/>
                                    <select tabindex="13" class="dDrink" name="drinkingSinceInterval" id="drinkingSinceInterval" style="float:left;display:inline-block;width:170px;">
                                        <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['intervals']->value,'selected'=>$_smarty_tpl->tpl_vars['patientSmokingDrinkingStatus']->value->getDrinkingSinceInterval()),$_smarty_tpl);?>

                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="medium-12 end columns ddDrink" style="<?php if ($_smarty_tpl->tpl_vars['patientSmokingDrinkingStatus']->value->isDrinker()) {?> display:inline-block; <?php } else { ?> display:none; <?php }?>">
                                    <label><span class=""><?php echo \Neptune\MessageResources::i18n("patientSmokingDrinkingStatusForm.drinkingFrequency");?>
</span>
                                        <select tabindex="14" class="dDrink" name="drinkingFrequency" id="drinkingFrequency" style="">
                                            <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['frequencies']->value,'selected'=>$_smarty_tpl->tpl_vars['patientSmokingDrinkingStatus']->value->getDrinkingFrequency()),$_smarty_tpl);?>

                                        </select>
                                    </label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="medium-12 end columns ddDrink" style="<?php if ($_smarty_tpl->tpl_vars['patientSmokingDrinkingStatus']->value->isDrinker()) {?> display:inline-block; <?php } else { ?> display:none; <?php }?>">
                                    <label><span class=""><?php echo \Neptune\MessageResources::i18n("patientSmokingDrinkingStatusForm.stoppedDrinking");?>
</span><br/>
                                        <input name="stoppedDrinking" id="stoppedDrinking" class="sDrink" tabindex="15" type="radio" value="1" <?php if ($_smarty_tpl->tpl_vars['patientSmokingDrinkingStatus']->value->hasStoppedDrinking()) {?> checked <?php }?>> 
                                        <label for="stoppedDrinking">Yes</label> 
                                        <input name="stoppedDrinking" id="notStoppedDrinking" class="sDrink" tabindex="16" type="radio" value="0" <?php if (!$_smarty_tpl->tpl_vars['patientSmokingDrinkingStatus']->value->isIdEmpty() && !$_smarty_tpl->tpl_vars['patientSmokingDrinkingStatus']->value->hasStoppedDrinking()) {?> checked <?php }?>> 
                                        <label for="notStoppedDrinking">No</label>
                                    </label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="medium-12 end columns sDrink" style="<?php if ($_smarty_tpl->tpl_vars['patientSmokingDrinkingStatus']->value->hasStoppedDrinking()) {?> display:inline-block; <?php } else { ?> display:none; <?php }?>">
                                    <label><span class=""><?php echo \Neptune\MessageResources::i18n("patientSmokingDrinkingStatusForm.stopDrinkingDate");?>
</span>
                                        <input tabindex="17" type="text" class="medium sDrink" placeholder="MMM d, yyyy" id="stopDrinkingDate" name="stopDrinkingDate" value="<?php echo $_smarty_tpl->tpl_vars['patientSmokingDrinkingStatus']->value->displayStopDrinkingDate();?>
"/>
                                    </label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="medium-12 end columns ddDrink" style="<?php if ($_smarty_tpl->tpl_vars['patientSmokingDrinkingStatus']->value->isDrinker()) {?> display:inline-block; <?php } else { ?> display:none; <?php }?>">
                                    <label><span class=""><?php echo \Neptune\MessageResources::i18n("patientSmokingDrinkingStatusForm.drinkingComments");?>
</span>
                                        <textarea cols="20" rows="3" style="resize:none;" tabindex="18" name="drinkingComments" id="drinkingComments" placeholder="What do you drink? More details on frequency, etc."><?php echo $_smarty_tpl->tpl_vars['patientSmokingDrinkingStatus']->value->getDrinkingComments();?>
</textarea>
                                    </label>
                                </div>
                            </div>
                        </li>    
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="medium-4 end columns" style="padding-top:2px;">
                    <?php echo \Neptune\HtmlElementTag::submitBtn(19);?>

                    <a href="/patient/smoking/drinking/status/view/<?php echo $_smarty_tpl->tpl_vars['patientSmokingDrinkingStatus']->value->getId();?>
" tabindex="6" class="reset"><?php echo \Neptune\MessageResources::i18n("link.cancel");?>
</a>&nbsp;
                </div>
            </div>

            </form> 
        </div> 
    
    <?php }?>                    
    
    <br/><br/>



<?php
}
}
/* {/block 'content'} */
}
