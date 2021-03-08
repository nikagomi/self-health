<?php
/* Smarty version 3.1.34-dev-7, created on 2021-03-08 20:24:59
  from '/var/www/oecs/src/smarty/templates/self_report/patientSmokingDrinkingStatusView.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_6046881b670e02_65534898',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'be1bba6cb2b3a9ae1b07b0257074f8f76c6dc035' => 
    array (
      0 => '/var/www/oecs/src/smarty/templates/self_report/patientSmokingDrinkingStatusView.tpl',
      1 => 1615235096,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6046881b670e02_65534898 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>



<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_17083281386046881b65cef3_59629060', 'jquery');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_9264446796046881b65de30_89904236', 'styles');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_3367952746046881b65ea63_65590139', 'dataTable');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_2149100186046881b65f751_02084647', 'content');
?>



<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "base/body.tpl");
}
/* {block 'jquery'} */
class Block_17083281386046881b65cef3_59629060 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'jquery' => 
  array (
    0 => 'Block_17083281386046881b65cef3_59629060',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    
   
    
<?php
}
}
/* {/block 'jquery'} */
/* {block 'styles'} */
class Block_9264446796046881b65de30_89904236 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'styles' => 
  array (
    0 => 'Block_9264446796046881b65de30_89904236',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    
        .infoLabel {
            font-family: 'Poppins', sans-serif !important;
            font-size: 1.1rem  !important;
            font-weight: normal  !important;
        }
    
<?php
}
}
/* {/block 'styles'} */
/* {block 'dataTable'} */
class Block_3367952746046881b65ea63_65590139 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'dataTable' => 
  array (
    0 => 'Block_3367952746046881b65ea63_65590139',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    
       
    
<?php
}
}
/* {/block 'dataTable'} */
/* {block 'content'} */
class Block_2149100186046881b65f751_02084647 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_2149100186046881b65f751_02084647',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    
    <?php echo $_smarty_tpl->tpl_vars['msg']->value;?>

    <div class="listTableCaption_simpleTable" style="font-variant:normal;font-weight: 500;margin-top:2px;margin-bottom:2px;color:#414042;font-family:'Poppins', sans-serif;font-size:1.3rem;">
        <?php echo \Neptune\MessageResources::i18n("patientSmokingDrinkingStatusForm.viewLegend");?>

        &nbsp;
        <a href="/patient/smoking/drinking/status/edit/<?php echo $_smarty_tpl->tpl_vars['patientSmokingDrinkingStatus']->value->getId();?>
" tabindex="1" style="font-weight:normal;font-size:1rem;" class="reset"><?php echo \Neptune\MessageResources::i18n("link.edit");?>
</a>
    </div>
    <?php if (trim($_SESSION['patientId']) != '') {?>
         
        <div style="margin-left:15px;margin-top:2px;width:80%;">
           <br/>
            <div class="row">
                <div class="medium-12 end columns">
                    <ul class="medium-block-grid-2 small-block-grid-1">
                        <li>
                            <div class="row">
                                <div class="medium-6 end columns text-right">
                                    <label><span class=""><?php echo \Neptune\MessageResources::i18n("patientSmokingDrinkingStatusForm.smoker");?>
</span>
                                    </label>
                                </div>
                                <div class="medium-6 end columns infoLabel">
                                    <?php echo \Neptune\DbMapperUtility::booleanYesNo($_smarty_tpl->tpl_vars['patientSmokingDrinkingStatus']->value->isSmoker());?>

                                </div>
                            </div>
                            <div class="row">
                                <div class="medium-6 end columns text-right">
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
                                <div class="medium-6 end columns text-right">
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
                                <div class="medium-6 end columns text-right">
                                    <label><span class=""><?php echo \Neptune\MessageResources::i18n("patientSmokingDrinkingStatusForm.stoppedSmoking");?>
</span>
                                    </label>
                                </div>
                                <div class="medium-6 end columns infoLabel">
                                    <?php echo \Neptune\DbMapperUtility::booleanYesNo($_smarty_tpl->tpl_vars['patientSmokingDrinkingStatus']->value->hasStoppedSmoking());?>

                                </div>
                            </div>
                            <div class="row">
                                <div class="medium-6 end columns text-right">
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
                                <div class="medium-6 end columns text-right">
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
                                <div class="medium-6 end columns text-right">
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
                                <div class="medium-6 end columns text-right">
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
                                <div class="medium-6 end columns text-right">
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
                                <div class="medium-6 end columns text-right">
                                    <label><span class=""><?php echo \Neptune\MessageResources::i18n("patientSmokingDrinkingStatusForm.stoppedDrinking");?>
</span>
                                    </label>
                                </div>
                                <div class="medium-6 end columns infoLabel">
                                    <?php echo \Neptune\DbMapperUtility::booleanYesNo($_smarty_tpl->tpl_vars['patientSmokingDrinkingStatus']->value->hasStoppedDrinking());?>

                                </div>
                            </div>
                            <div class="row">
                                <div class="medium-6 end columns text-right">
                                    <label>
                                        <span class=""><?php echo \Neptune\MessageResources::i18n("patientSmokingDrinkingStatusForm.stopDrinkingDate");?>
</span>
                                    </label>
                                </div>
                                <div class="medium-6 end columns infoLabel">
                                    <?php echo $_smarty_tpl->tpl_vars['patientSmokingDrinkingStatus']->value->displayStopDrinkingDate();?>

                                </div>
                            </div>
                            <div class="row">
                                <div class="medium-6 end columns text-right">
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
    
    <br/><br/>



<?php
}
}
/* {/block 'content'} */
}
