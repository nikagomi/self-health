<?php
/* Smarty version 3.1.34-dev-7, created on 2021-04-08 16:59:49
  from '/var/www/oecs/src/smarty/templates/self_report/patientPhysicalActivity.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_606f36859c3f10_99298109',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f6ad6be5fda3ec97278c2dc9ede04c477e5671bb' => 
    array (
      0 => '/var/www/oecs/src/smarty/templates/self_report/patientPhysicalActivity.tpl',
      1 => 1617901185,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_606f36859c3f10_99298109 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>



<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_549792341606f36859af180_57937058', 'jquery');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1350506360606f36859b0f97_17165092', 'dataTable');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_2068370253606f36859b1804_73585977', 'content');
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "base/body.tpl");
}
/* {block 'jquery'} */
class Block_549792341606f36859af180_57937058 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'jquery' => 
  array (
    0 => 'Block_549792341606f36859af180_57937058',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    
        $("div.table-toolbar").html("<?php echo \Neptune\MessageResources::i18n("patientPhysicalActivityForm.recorded.list");?>
").css({
            "margin-left" : "26px",
            "font-family": "'Poppins', sans-serif",
            "font-size" : "1.2rem",
            "font-weight" : 500,
            "color": "#464646"
        });
        
        $("#datePerformed").datepicker({
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
        
        $("#timeStarted").timepicki(timePickiOptions);
        $("#physicalActivityId").chosen();
    
<?php
}
}
/* {/block 'jquery'} */
/* {block 'dataTable'} */
class Block_1350506360606f36859b0f97_17165092 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'dataTable' => 
  array (
    0 => 'Block_1350506360606f36859b0f97_17165092',
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
class Block_2068370253606f36859b1804_73585977 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_2068370253606f36859b1804_73585977',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/var/www/oecs/vendor/smarty/smarty/libs/plugins/function.html_options.php','function'=>'smarty_function_html_options',),));
?>

    
    <?php echo $_smarty_tpl->tpl_vars['msg']->value;?>

    <div class="listTableCaption_simpleTable" style="font-variant:normal;font-weight: 500;margin-top:2px;margin-bottom:2px;color:#414042;font-family:'Poppins', sans-serif;font-size:1.3rem;">
        <?php echo \Neptune\MessageResources::i18n("patientPhysicalActivityForm.legend");?>

    </div>
    <?php if (trim($_SESSION['patientId']) != '') {?>
        <div style="margin-left:15px;margin-top:2px;width:80%;">
            <form data-abide name="patientPhysicalActivityForm" id="patientPhysicalActivityForm" action="<?php echo $_smarty_tpl->tpl_vars['actionPage']->value;?>
" method="POST" autocomplete="off">
                <input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['patientPhysicalActivity']->value->getId();?>
"/>
                <input type="hidden" name="patientId" value="<?php echo $_SESSION['patientId'];?>
"/>
            <div class="row>"
                <div class="medium-4 end columns">
                <ul class="medium-block-grid-2 small-block-grid-1">
                    <li>
                        <div class="row">
                            <div class="medium-12 end columns">
                                <label><span class="required"><?php echo \Neptune\MessageResources::i18n("patientPhysicalActivityForm.physicalActivityId");?>
</span>
                                    <select tabindex="1" id="physicalActivityId" name="physicalActivityId" value="<?php echo $_smarty_tpl->tpl_vars['patientPhysicalActivity']->value->getPhysicalActivityId();?>
" required>
                                        <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['physicalActivityIds']->value,'selected'=>$_smarty_tpl->tpl_vars['patientPhysicalActivity']->value->getPhysicalActivityId()),$_smarty_tpl);?>

                                    </select>
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="medium-12 end columns">
                                <label><span class="required"><?php echo \Neptune\MessageResources::i18n("patientPhysicalActivityForm.datePerformed");?>
</span>
                                    <input tabindex="2" type="text" class="medium" id="datePerformed" name="datePerformed" value="<?php echo $_smarty_tpl->tpl_vars['patientPhysicalActivity']->value->displayDatePerformed();?>
" required>
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="medium-12 end columns">
                                <label><span class=""><?php echo \Neptune\MessageResources::i18n("patientPhysicalActivityForm.timeStarted");?>
</span>
                                    <input tabindex="3" class="medium" type="text" id="timeStarted" name="timeStarted" value="<?php echo $_smarty_tpl->tpl_vars['patientPhysicalActivity']->value->getTimeStarted();?>
">
                                </label>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="row">
                            <div class="medium-12 end columns">
                                <label><span class="required"><?php echo \Neptune\MessageResources::i18n("patientPhysicalActivityForm.durationInMinutes");?>
</span>
                                    <input tabindex="4"  type="text" class="medium" maxlength="3" id="durationInMinutes" name="durationInMinutes" value="<?php echo $_smarty_tpl->tpl_vars['patientPhysicalActivity']->value->getDurationInMinutes();?>
" required>
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="medium-12 end columns">
                                <label><span class=""><?php echo \Neptune\MessageResources::i18n("patientPhysicalActivityForm.notes");?>
</span>
                                    <textarea tabindex="5" id="notes" rows="3" style="resize:none;" name="notes" ><?php echo $_smarty_tpl->tpl_vars['patientPhysicalActivity']->value->getNotes();?>
</textarea>
                                </label>
                            </div>
                        </div>
                </ul>
            </div>
            
            <div class="row">
                <div class="medium-4 end columns" style="padding-top:8px;">
                    <a href="/patient/physical/activity" tabindex="6" class="reset"><?php echo \Neptune\MessageResources::i18n("link.reset");?>
</a>&nbsp;
                    <?php echo \Neptune\HtmlElementTag::submitBtn(2);?>

                </div>
                <?php if ($_smarty_tpl->tpl_vars['patientPhysicalActivity']->value->getId() != '') {?>
                    <div class="medium-4 end columns" style="padding-top:8px;">
                        <?php echo \Neptune\MessageResources::i18n("checkbox.confirm");?>
&nbsp;<input tabindex="7" id="confirmDelete" type="checkbox"/>
                        <?php echo \Neptune\HtmlElementTag::deleteBtn(8,"/patient/physical/activity/delete/".((string)$_smarty_tpl->tpl_vars['patientPhysicalActivity']->value->getId()));?>

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
                    <th><?php echo \Neptune\MessageResources::i18n("patientPhysicalActivityForm.physicalActivityId");?>
</th> 
                    <th><?php echo \Neptune\MessageResources::i18n("patientPhysicalActivityForm.durationInMinutes");?>
</th>
                    <th><?php echo \Neptune\MessageResources::i18n("patientPhysicalActivityForm.datePerformed");?>
</th>
                    <th><?php echo \Neptune\MessageResources::i18n("patientPhysicalActivityForm.timeStarted");?>
</th>
                    <th><?php echo \Neptune\MessageResources::i18n("patientPhysicalActivityForm.notes");?>
</th>
                    <th width="10%">&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['list']->value, 'ppa');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['ppa']->value) {
?> 
                    <tr>                           
                        <td><?php echo $_smarty_tpl->tpl_vars['ppa']->value->getPhysicalActivity()->getLabel();?>
</td> 
                        <td><?php echo $_smarty_tpl->tpl_vars['ppa']->value->getDurationInMinutes();?>
</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['ppa']->value->displayDatePerformed();?>
</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['ppa']->value->displayTimeStarted();?>
</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['ppa']->value->getNotes();?>
</td>
                        <td>
                            <a class="editRow" title="<?php echo \Neptune\MessageResources::i18n("link.edit");?>
" href="/patient/physical/activity/edit/<?php echo $_smarty_tpl->tpl_vars['ppa']->value->getId();?>
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
            <?php echo \Neptune\MessageResources::i18n("patientPhysicalActivityForm.empty.list.message");?>

        </div>
    <?php }?>
    <br/><br/>



<?php
}
}
/* {/block 'content'} */
}
