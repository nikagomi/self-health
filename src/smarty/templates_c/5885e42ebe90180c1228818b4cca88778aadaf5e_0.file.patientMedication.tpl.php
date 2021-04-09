<?php
/* Smarty version 3.1.34-dev-7, created on 2021-04-09 18:47:20
  from '/var/www/oecs/src/smarty/templates/self_report/patientMedication.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_6070a1387850d8_66271466',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5885e42ebe90180c1228818b4cca88778aadaf5e' => 
    array (
      0 => '/var/www/oecs/src/smarty/templates/self_report/patientMedication.tpl',
      1 => 1617994037,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6070a1387850d8_66271466 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>



<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_19450195206070a13876d369_12926268', 'jquery');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_6837669726070a138770102_36648878', 'dataTable');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_5724436386070a138770ad2_92936835', 'content');
?>


<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "base/body.tpl");
}
/* {block 'jquery'} */
class Block_19450195206070a13876d369_12926268 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'jquery' => 
  array (
    0 => 'Block_19450195206070a13876d369_12926268',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    
        $("div.table-toolbar").html("<?php echo \Neptune\MessageResources::i18n("patientMedicationForm.recorded.list");?>
").css({
            "margin-left" : "26px",
            "font-family": "'Poppins', sans-serif",
            "font-size" : "1.2rem",
            "font-weight" : 500,
            "color": "#464646"
        });
        
        $("#dateTaken").datepicker({
            format:"M dd, yyyy",
            autoclose: true,
            clearBtn: true,
            endDate: '0d',
            highlightToday: true,
            todayBtn: true
        }).data("datepicker");
        
        var timePickiOptions = {
            tincrease_direction: 'up',
            disable_keyboard_mobile: true
        };
        
        $("#timeTaken").timepicki(timePickiOptions);
        $("#medicationId, #quantityUnitId").chosen();
    
<?php
}
}
/* {/block 'jquery'} */
/* {block 'dataTable'} */
class Block_6837669726070a138770102_36648878 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'dataTable' => 
  array (
    0 => 'Block_6837669726070a138770102_36648878',
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
class Block_5724436386070a138770ad2_92936835 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_5724436386070a138770ad2_92936835',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/var/www/oecs/vendor/smarty/smarty/libs/plugins/function.html_options.php','function'=>'smarty_function_html_options',),));
?>

    
    <?php echo $_smarty_tpl->tpl_vars['msg']->value;?>

    <div class="listTableCaption_simpleTable" style="font-variant:normal;font-weight: 500;margin-top:2px;margin-bottom:2px;color:#414042;font-family:'Poppins', sans-serif;font-size:1.3rem;">
        <?php echo \Neptune\MessageResources::i18n("patientMedicationForm.legend");?>

    </div>
    <?php if (trim($_SESSION['patientId']) != '') {?>
        <div style="margin-left:15px;margin-top:2px;width:80%;">
            <form data-abide name="patientMedicationForm" id="patientMedicationForm" action="<?php echo $_smarty_tpl->tpl_vars['actionPage']->value;?>
" method="POST" autocomplete="off">
                <input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['patientMedication']->value->getId();?>
"/>
                <input type="hidden" name="patientId" value="<?php echo $_SESSION['patientId'];?>
"/>
            <div class="row">
                <div class="medium-12 end columns">
                    <ul class="medium-block-grid-2 small-block-grid-1">
                        <li>
                            <div class="row">
                                <div class="medium-12 end columns">
                                    <label><span class="required"><?php echo \Neptune\MessageResources::i18n("patientMedicationForm.medicationId");?>
</span>
                                        <select tabindex="1" id="medicationId" name="medicationId"  required>
                                            <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['medicationIds']->value,'selected'=>$_smarty_tpl->tpl_vars['patientMedication']->value->getMedicationId()),$_smarty_tpl);?>

                                        </select>
                                    </label>
                                </div>
                            </div>
                            <div class="row" style="margin-bottom:8px;">
                                <div class="medium-12 end columns" style="">
                                    <label>
                                        <span class=""><?php echo \Neptune\MessageResources::i18n("patientMedicationForm.quantityConsumed");?>
</span>
                                    </label><br/>
                                    <input tabindex="2" type="text" class="short" maxlength="2" id="quantityAmount" name="quantityAmount" value="<?php echo $_smarty_tpl->tpl_vars['patientMedication']->value->getQuantityAmount();?>
" style="float:left;display:inline-block;margin-right:5px;"/>
                                    <select tabindex="3" name="quantityTakenUnitId" id="quantityTakenUnitId" class="" style="float:left;display:inline-block;width:170px;">
                                        <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['quantityTakenUnitIds']->value,'selected'=>$_smarty_tpl->tpl_vars['patientMedication']->value->getQuantityTakenUnitId()),$_smarty_tpl);?>

                                    </select>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="row">
                                <div class="medium-12 end columns">
                                    <label><span class="required"><?php echo \Neptune\MessageResources::i18n("patientMedicationForm.dateTaken");?>
</span>
                                        <input tabindex="4" type="text" class="medium" id="dateTaken" name="dateTaken" value="<?php echo $_smarty_tpl->tpl_vars['patientMedication']->value->displayDateTaken();?>
" required>
                                    </label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="medium-12 end columns">
                                    <label><span class=""><?php echo \Neptune\MessageResources::i18n("patientMedicationForm.timeTaken");?>
</span>
                                        <input tabindex="5" class="medium" type="text" id="timeTaken" name="timeTaken" value="<?php echo $_smarty_tpl->tpl_vars['patientMedication']->value->getTimeTaken();?>
">
                                    </label>
                                </div>
                            </div>

                        </li>   
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="medium-4 end columns">
                    <label><span class=""><?php echo \Neptune\MessageResources::i18n("patientMedicationForm.comments");?>
</span>
                        <textarea tabindex="6" id="comments" rows="3" style="resize:none;" name="comments" ><?php echo $_smarty_tpl->tpl_vars['patientMedication']->value->getComments();?>
</textarea>
                    </label>
                </div>
            </div>
            
            <div class="row">
                <div class="medium-4 end columns" style="padding-top:8px;">
                    <a href="/patient/medication" tabindex="8" class="reset"><?php echo \Neptune\MessageResources::i18n("link.reset");?>
</a>&nbsp;
                    <?php echo \Neptune\HtmlElementTag::submitBtn(7);?>

                </div>
                <?php if ($_smarty_tpl->tpl_vars['patientMedication']->value->getId() != '') {?>
                    <div class="medium-4 end columns" style="padding-top:8px;">
                        <?php echo \Neptune\MessageResources::i18n("checkbox.confirm");?>
&nbsp;<input tabindex="9" id="confirmDelete" type="checkbox"/>
                        <?php echo \Neptune\HtmlElementTag::deleteBtn(10,"/patient/medication/delete/".((string)$_smarty_tpl->tpl_vars['patientMedication']->value->getId()));?>

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
                    <th><?php echo \Neptune\MessageResources::i18n("patientMedicationForm.medicationId");?>
</th> 
                    <th><?php echo \Neptune\MessageResources::i18n("patientMedicationForm.quantityConsumed");?>
</th>
                    <th><?php echo \Neptune\MessageResources::i18n("patientMedicationForm.dateTaken");?>
</th>
                    <th><?php echo \Neptune\MessageResources::i18n("patientMedicationForm.timeTaken");?>
</th>
                    <th><?php echo \Neptune\MessageResources::i18n("patientMedicationForm.comments");?>
</th>
                    <th width="10%">&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['list']->value, 'pmed');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['pmed']->value) {
?> 
                    <tr>                           
                        <td><?php echo $_smarty_tpl->tpl_vars['pmed']->value->getMedication()->getLabel();?>
</td> 
                        <td><?php echo $_smarty_tpl->tpl_vars['pmed']->value->getQuantityAmount();?>
 <?php echo $_smarty_tpl->tpl_vars['pmed']->value->getQuantityTakenUnit()->getLabel();?>
</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['pmed']->value->displayDateTaken();?>
</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['pmed']->value->displayTimeTaken();?>
</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['pmed']->value->getComments();?>
</td>
                        <td>
                            <a class="editRow" title="<?php echo \Neptune\MessageResources::i18n("link.edit");?>
" href="/patient/medication/edit/<?php echo $_smarty_tpl->tpl_vars['pmed']->value->getId();?>
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
            <?php echo \Neptune\MessageResources::i18n("patientMedicationForm.empty.list.message");?>

        </div>
    <?php }?>
    <br/><br/>



<?php
}
}
/* {/block 'content'} */
}
