<?php
/* Smarty version 3.1.34-dev-7, created on 2021-04-13 13:03:15
  from '/var/www/oecs/src/smarty/templates/self_report/patientAllergy.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_60759693f3a623_92025795',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5408ad1c0e22732a7dd0b43057fbfc22f1689c48' => 
    array (
      0 => '/var/www/oecs/src/smarty/templates/self_report/patientAllergy.tpl',
      1 => 1618318992,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60759693f3a623_92025795 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>



<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_203648398860759693f24510_96532900', 'jquery');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_119860341360759693f25b14_32489480', 'dataTable');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_127393823860759693f26417_00728379', 'content');
$_smarty_tpl->inheritance->endChild($_smarty_tpl, "base/body.tpl");
}
/* {block 'jquery'} */
class Block_203648398860759693f24510_96532900 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'jquery' => 
  array (
    0 => 'Block_203648398860759693f24510_96532900',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    
        $("div.table-toolbar").html("<?php echo \Neptune\MessageResources::i18n("patientAllergyForm.recorded.list");?>
").css({
            "margin-left" : "26px",
            "font-family": "'Poppins', sans-serif",
            "font-size" : "1.2rem",
            "font-weight" : 500,
            "color": "#464646"
        });
        
        $("form").find("select").chosen();
        
    
<?php
}
}
/* {/block 'jquery'} */
/* {block 'dataTable'} */
class Block_119860341360759693f25b14_32489480 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'dataTable' => 
  array (
    0 => 'Block_119860341360759693f25b14_32489480',
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
class Block_127393823860759693f26417_00728379 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_127393823860759693f26417_00728379',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/var/www/oecs/vendor/smarty/smarty/libs/plugins/function.html_options.php','function'=>'smarty_function_html_options',),));
?>

    
    <?php echo $_smarty_tpl->tpl_vars['msg']->value;?>

    <div class="listTableCaption_simpleTable" style="font-variant:normal;font-weight: 500;margin-top:2px;margin-bottom:2px;color:#414042;font-family:'Poppins', sans-serif;font-size:1.3rem;">
        <?php echo \Neptune\MessageResources::i18n("patientAllergyForm.legend");?>

    </div>
    <?php if (trim($_SESSION['patientId']) != '') {?>
        <div style="margin-left:15px;margin-top:2px;width:80%;">
            <form data-abide name="patientAllergyForm" id="patientAllergyForm" action="<?php echo $_smarty_tpl->tpl_vars['actionPage']->value;?>
" method="POST" autocomplete="off">
                <input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['patientAllergy']->value->getId();?>
"/>
                <input type="hidden" name="patientId" value="<?php echo $_SESSION['patientId'];?>
"/>
            
                <div class="row">
                    <div class="medium-12 end columns">
                        <label><span class="required"><?php echo \Neptune\MessageResources::i18n("patientAllergyForm.allergyTypeId");?>
</span>
                            <select tabindex="1" id="allergyTypeId" name="allergyTypeId"  required>
                                <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['allergyTypeIds']->value,'selected'=>$_smarty_tpl->tpl_vars['patientAllergy']->value->getAllergyTypeId()),$_smarty_tpl);?>

                            </select>
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="medium-12 end columns">
                        <label><span class="required"><?php echo \Neptune\MessageResources::i18n("patientAllergyForm.allergen");?>
</span>
                            <input tabindex="2" type="text"  maxlength="45" id="allergen" name="allergen" value="<?php echo $_smarty_tpl->tpl_vars['patientAllergy']->value->getAllergen();?>
" required>
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="medium-12 end columns">
                        <label><span class=""><?php echo \Neptune\MessageResources::i18n("patientAllergyForm.notes");?>
</span>
                            <textarea tabindex="3" cols="20" rows="3" style="resize:none;" name="notes" id="notes"><?php echo $_smarty_tpl->tpl_vars['patientAllergy']->value->getNotes();?>
</textarea>
                        </label>
                    </div>
                </div>

                <div class="row">
                    <div class="medium-4 end columns" style="padding-top:8px;">
                        <a href="/patient/allergy" tabindex="5" class="reset"><?php echo \Neptune\MessageResources::i18n("link.reset");?>
</a>&nbsp;
                        <?php echo \Neptune\HtmlElementTag::submitBtn(4);?>

                    </div>
                    <?php if ($_smarty_tpl->tpl_vars['patientAllergy']->value->getId() != '') {?>
                        <div class="medium-4 end columns" style="padding-top:8px;">
                            <?php echo \Neptune\MessageResources::i18n("checkbox.confirm");?>
&nbsp;<input tabindex="6" id="confirmDelete" type="checkbox"/>
                            <?php echo \Neptune\HtmlElementTag::deleteBtn(7,"/patient/allergy/delete/".((string)$_smarty_tpl->tpl_vars['patientAllergy']->value->getId()));?>

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
                    <th><?php echo \Neptune\MessageResources::i18n("patientAllergyForm.allergyTypeId");?>
</th> 
                    <th><?php echo \Neptune\MessageResources::i18n("patientAllergyForm.allergen");?>
</th>
                    <th><?php echo \Neptune\MessageResources::i18n("patientAllergyForm.notes");?>
</th>
                    <th width="10%">&nbsp;</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['list']->value, 'pa');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['pa']->value) {
?> 
                    <tr>                           
                        <td><?php echo $_smarty_tpl->tpl_vars['pa']->value->getAllergyType()->getLabel();?>
</td> 
                        <td><?php echo $_smarty_tpl->tpl_vars['pa']->value->getAllergen();?>
</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['pa']->value->getNotes();?>
</td>
                        <td>
                            <a class="editRow" title="<?php echo \Neptune\MessageResources::i18n("link.edit");?>
" href="/patient/allergy/edit/<?php echo $_smarty_tpl->tpl_vars['pa']->value->getId();?>
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
            <?php echo \Neptune\MessageResources::i18n("patientAllergyForm.empty.list.message");?>

        </div>
    <?php }?>
    <br/><br/>



<?php
}
}
/* {/block 'content'} */
}
