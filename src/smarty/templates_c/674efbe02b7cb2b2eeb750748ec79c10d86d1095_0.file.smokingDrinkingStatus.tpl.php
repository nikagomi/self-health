<?php
/* Smarty version 3.1.34-dev-7, created on 2021-03-11 15:23:26
  from '/var/www/oecs/src/smarty/templates/patient/smokingDrinkingStatus.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_604a35eeb683e7_50085655',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '674efbe02b7cb2b2eeb750748ec79c10d86d1095' => 
    array (
      0 => '/var/www/oecs/src/smarty/templates/patient/smokingDrinkingStatus.tpl',
      1 => 1615248429,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_604a35eeb683e7_50085655 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>



<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_96023475604a35eeb510d4_79904464', 'styles');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_548425005604a35eeb52099_29462639', 'scripts');
?>



<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_289653394604a35eeb52810_50348974', 'jquery');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1657138711604a35eeb52ef4_99745339', 'content');
?>


<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "base/contentBody.tpl");
}
/* {block 'styles'} */
class Block_96023475604a35eeb510d4_79904464 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'styles' => 
  array (
    0 => 'Block_96023475604a35eeb510d4_79904464',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    
        .infoLabel {
            font-family: 'Poppins', sans-serif !important;
            font-size: 1rem  !important;
            font-weight: normal  !important;
        }
        
        .viewLabel {
            font-family: 'Poppins', sans-serif !important;
            font-size: 0.9rem  !important;
        }
    
<?php
}
}
/* {/block 'styles'} */
/* {block 'scripts'} */
class Block_548425005604a35eeb52099_29462639 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'scripts' => 
  array (
    0 => 'Block_548425005604a35eeb52099_29462639',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    
        function truncateText(text, val){
            var newLength = val - 3;
            return (text.length > val) ? text.substring(0, newLength) + "..." : text; 
        }
        
    
<?php
}
}
/* {/block 'scripts'} */
/* {block 'jquery'} */
class Block_289653394604a35eeb52810_50348974 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'jquery' => 
  array (
    0 => 'Block_289653394604a35eeb52810_50348974',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    
        
        $(function(){
            $(".hotspot").tipTip({maxWidth: "200px", edgeOffset: 3, defaultPosition: "top", delay: 200, fadeOut: 400});
        });
        
        
    
<?php
}
}
/* {/block 'jquery'} */
/* {block 'content'} */
class Block_1657138711604a35eeb52ef4_99745339 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_1657138711604a35eeb52ef4_99745339',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    
    <div>
    <div class="listTableCaption_simpleTable" style="font-variant:normal;font-weight: 500;margin-top:2px;margin-bottom:2px;color:#414042;font-family:'Poppins', sans-serif;font-size:1.3rem;">
        Smoking / Drinking Status
    </div>
    <?php if ($_smarty_tpl->tpl_vars['patientSmokingDrinkingStatus']->value->isIdEmpty()) {?>
        <div class="emptyListMessage">Patient has not indicated smoking and/or drinking status</div>
    <?php } else { ?>
        <div style="margin-left:15px;margin-top:2px;width:98%;">
           <br/>
            <div class="row">
                <div class="medium-12 end columns">
                    <ul class="medium-block-grid-2 small-block-grid-1">
                        <li>
                            <div class="row">
                                <div class="medium-6 end columns small-text-left medium-text-right viewLabel">
                                    <label><span class=""><?php echo \Neptune\MessageResources::i18n("patientSmokingDrinkingStatusForm.smoker");?>
</span>
                                    </label>
                                </div>
                                <div class="medium-6 end columns infoLabel">
                                    <?php echo \Neptune\DbMapperUtility::booleanYesNo($_smarty_tpl->tpl_vars['patientSmokingDrinkingStatus']->value->isSmoker());?>

                                </div>
                            </div>
                            <div class="row">
                                <div class="medium-6 end columns small-text-left medium-text-right viewLabel">
                                    <label>
                                        <span class=""><?php echo \Neptune\MessageResources::i18n("patientSmokingDrinkingStatusForm.smokingSince");?>
</span>
                                    </label>
                                </div>
                                <div class="medium-6 end columns infoLabel">
                                    <?php echo $_smarty_tpl->tpl_vars['patientSmokingDrinkingStatus']->value->getSmokingSinceQuantity();?>
 <?php echo $_smarty_tpl->tpl_vars['patientSmokingDrinkingStatus']->value->getSmokingSinceInterval();?>

                                </div>
                            </div>
                            <div class="row">
                                <div class="medium-6 end columns small-text-left medium-text-right viewLabel">
                                    <label>
                                        <span class=""><?php echo \Neptune\MessageResources::i18n("patientSmokingDrinkingStatusForm.smokingFrequency");?>
</span>
                                    </label>
                                </div>
                                <div class="medium-6 end columns infoLabel">
                                    <?php echo $_smarty_tpl->tpl_vars['patientSmokingDrinkingStatus']->value->getSmokingFrequency();?>

                                </div>
                            </div>
                            <div class="row">
                                <div class="medium-6 end columns small-text-left medium-text-right viewLabel">
                                    <label><span class=""><?php echo \Neptune\MessageResources::i18n("patientSmokingDrinkingStatusForm.stoppedSmoking");?>
</span>
                                    </label>
                                </div>
                                <div class="medium-6 end columns infoLabel">
                                    <?php echo \Neptune\DbMapperUtility::booleanYesNo($_smarty_tpl->tpl_vars['patientSmokingDrinkingStatus']->value->hasStoppedSmoking());?>

                                </div>
                            </div>
                            <div class="row">
                                <div class="medium-6 end columns small-text-left medium-text-right viewLabel">
                                    <label>
                                        <span class=""><?php echo \Neptune\MessageResources::i18n("patientSmokingDrinkingStatusForm.stopSmokingDate");?>
</span>
                                    </label>
                                </div>
                                <div class="medium-6 end columns infoLabel">
                                    <?php echo $_smarty_tpl->tpl_vars['patientSmokingDrinkingStatus']->value->displayStopSmokingDate();?>

                                </div>
                            </div>
                            <div class="row">
                                <div class="medium-6 end columns small-text-left medium-text-right viewLabel">
                                    <label>
                                        <span class=""><?php echo \Neptune\MessageResources::i18n("patientSmokingDrinkingStatusForm.smokingComments");?>
</span>
                                    </label>
                                </div>
                                <div class="medium-6 end columns infoLabel">
                                    <?php echo $_smarty_tpl->tpl_vars['patientSmokingDrinkingStatus']->value->getSmokingComments();?>

                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="row">
                                <div class="medium-6 end columns small-text-left medium-text-right viewLabel">
                                    <label>
                                        <span class=""><?php echo \Neptune\MessageResources::i18n("patientSmokingDrinkingStatusForm.drinker");?>
</span><br/>
                                    </label>
                                </div>
                                <div class="medium-6 end columns infoLabel">
                                    <?php echo \Neptune\DbMapperUtility::booleanYesNo($_smarty_tpl->tpl_vars['patientSmokingDrinkingStatus']->value->isDrinker());?>

                                </div>
                            </div>
                            <div class="row">
                                <div class="medium-6 end columns small-text-left medium-text-right viewLabel">
                                    <label>
                                        <span class=""><?php echo \Neptune\MessageResources::i18n("patientSmokingDrinkingStatusForm.drinkingSince");?>
</span>
                                    </label>
                                </div>
                                <div class="medium-6 end columns infoLabel">
                                    <?php echo $_smarty_tpl->tpl_vars['patientSmokingDrinkingStatus']->value->getDrinkingSinceQuantity();?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['patientSmokingDrinkingStatus']->value->getDrinkingSinceInterval();?>

                                </div>
                            </div>
                            <div class="row">
                                <div class="medium-6 end columns small-text-left medium-text-right viewLabel">
                                    <label>
                                        <span class=""><?php echo \Neptune\MessageResources::i18n("patientSmokingDrinkingStatusForm.drinkingFrequency");?>
</span>
                                    </label>
                                </div>
                                <div class="medium-6 end columns infoLabel">
                                    <?php echo $_smarty_tpl->tpl_vars['patientSmokingDrinkingStatus']->value->getDrinkingFrequency();?>

                                </div>
                            </div>
                            <div class="row">
                                <div class="medium-6 end columns small-text-left medium-text-right viewLabel">
                                    <label><span class=""><?php echo \Neptune\MessageResources::i18n("patientSmokingDrinkingStatusForm.stoppedDrinking");?>
</span>
                                    </label>
                                </div>
                                <div class="medium-6 end columns infoLabel">
                                    <?php echo \Neptune\DbMapperUtility::booleanYesNo($_smarty_tpl->tpl_vars['patientSmokingDrinkingStatus']->value->hasStoppedDrinking());?>

                                </div>
                            </div>
                            <div class="row">
                                <div class="medium-6 end columns small-text-left medium-text-right">
                                    <label>
                                        <span class=""><?php echo \Neptune\MessageResources::i18n("patientSmokingDrinkingStatusForm.stopDrinkingDate");?>
</span>
                                    </label>
                                </div>
                                <div class="medium-6 end columns infoLabel viewLabel">
                                    <?php echo $_smarty_tpl->tpl_vars['patientSmokingDrinkingStatus']->value->displayStopDrinkingDate();?>

                                </div>
                            </div>
                            <div class="row">
                                <div class="medium-6 end columns small-text-left medium-text-right viewLabel">
                                    <label>
                                        <span class=""><?php echo \Neptune\MessageResources::i18n("patientSmokingDrinkingStatusForm.drinkingComments");?>
</span>
                                    </label>
                                </div>
                                <div class="medium-6 end columns infoLabel">
                                    <?php echo $_smarty_tpl->tpl_vars['patientSmokingDrinkingStatus']->value->getDrinkingComments();?>

                                </div>
                            </div>
                        </li>    
                    </ul>
                </div>
            </div>
        </div> 
    <?php }?>
</div>


<?php
}
}
/* {/block 'content'} */
}