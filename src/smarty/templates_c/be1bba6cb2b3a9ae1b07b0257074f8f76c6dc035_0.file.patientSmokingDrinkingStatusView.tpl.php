<?php
/* Smarty version 3.1.34-dev-7, created on 2021-03-11 15:24:37
  from '/var/www/oecs/src/smarty/templates/self_report/patientSmokingDrinkingStatusView.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_604a363535ac20_91810058',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'be1bba6cb2b3a9ae1b07b0257074f8f76c6dc035' => 
    array (
      0 => '/var/www/oecs/src/smarty/templates/self_report/patientSmokingDrinkingStatusView.tpl',
      1 => 1615248499,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_604a363535ac20_91810058 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>



<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1670236505604a3635346c85_52193089', 'jquery');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_486590395604a3635348277_31639005', 'styles');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_243250930604a3635348b54_87709505', 'dataTable');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1132924898604a3635349359_68952717', 'content');
?>



<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "base/body.tpl");
}
/* {block 'jquery'} */
class Block_1670236505604a3635346c85_52193089 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'jquery' => 
  array (
    0 => 'Block_1670236505604a3635346c85_52193089',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    
   
    
<?php
}
}
/* {/block 'jquery'} */
/* {block 'styles'} */
class Block_486590395604a3635348277_31639005 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'styles' => 
  array (
    0 => 'Block_486590395604a3635348277_31639005',
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
class Block_243250930604a3635348b54_87709505 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'dataTable' => 
  array (
    0 => 'Block_243250930604a3635348b54_87709505',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    
       
    
<?php
}
}
/* {/block 'dataTable'} */
/* {block 'content'} */
class Block_1132924898604a3635349359_68952717 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_1132924898604a3635349359_68952717',
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
                                <div class="medium-6 end columns small-text-left medium-text-right">
                                    <label><span class=""><?php echo \Neptune\MessageResources::i18n("patientSmokingDrinkingStatusForm.smoker");?>
</span>
                                    </label>
                                </div>
                                <div class="medium-6 end columns infoLabel">
                                    <?php echo \Neptune\DbMapperUtility::booleanYesNo($_smarty_tpl->tpl_vars['patientSmokingDrinkingStatus']->value->isSmoker());?>

                                </div>
                            </div>
                            <div class="row">
                                <div class="medium-6 end columns small-text-left medium-text-right">
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
                                <div class="medium-6 end columns small-text-left medium-text-right">
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
                                <div class="medium-6 end columns small-text-left medium-text-right">
                                    <label><span class=""><?php echo \Neptune\MessageResources::i18n("patientSmokingDrinkingStatusForm.stoppedSmoking");?>
</span>
                                    </label>
                                </div>
                                <div class="medium-6 end columns infoLabel">
                                    <?php echo \Neptune\DbMapperUtility::booleanYesNo($_smarty_tpl->tpl_vars['patientSmokingDrinkingStatus']->value->hasStoppedSmoking());?>

                                </div>
                            </div>
                            <div class="row">
                                <div class="medium-6 end columns small-text-left medium-text-right">
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
                                <div class="medium-6 end columns small-text-left medium-text-right">
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
                                <div class="medium-6 end columns small-text-left medium-text-right">
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
                                <div class="medium-6 end columns small-text-left medium-text-right">
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
                                <div class="medium-6 end columns small-text-left medium-text-right">
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
                                <div class="medium-6 end columns small-text-left medium-text-right">
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
                                <div class="medium-6 end columns infoLabel">
                                    <?php echo $_smarty_tpl->tpl_vars['patientSmokingDrinkingStatus']->value->displayStopDrinkingDate();?>

                                </div>
                            </div>
                            <div class="row">
                                <div class="medium-6 end columns small-text-left medium-text-right">
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
