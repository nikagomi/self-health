<?php
/* Smarty version 3.1.34-dev-7, created on 2021-04-09 18:36:36
  from '/var/www/oecs/src/smarty/templates/admin/medication.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_60709eb48b6ac2_87939009',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a559877a0e9d23d79c77b2358f7815cb611aecee' => 
    array (
      0 => '/var/www/oecs/src/smarty/templates/admin/medication.tpl',
      1 => 1617993394,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60709eb48b6ac2_87939009 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>



<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_95639622960709eb48a7ec9_61893779', 'jquery');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_164905797860709eb48a99d3_61823109', 'dataTable');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_164014023260709eb48aa1d8_82485992', 'content');
?>



<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "base/body.tpl");
}
/* {block 'jquery'} */
class Block_95639622960709eb48a7ec9_61893779 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'jquery' => 
  array (
    0 => 'Block_95639622960709eb48a7ec9_61893779',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    
        $("div.table-toolbar").html("<?php echo \Neptune\MessageResources::i18n("medicationForm.recorded.list");?>
").css({
            "margin-left" : "26px",
            "font-family": "'Poppins', sans-serif",
            "font-size" : "1.2rem",
            "font-weight" : 500,
            "color": "#464646"
        });
        
        $("#pharmaceuticalId").chosen();
    
<?php
}
}
/* {/block 'jquery'} */
/* {block 'dataTable'} */
class Block_164905797860709eb48a99d3_61823109 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'dataTable' => 
  array (
    0 => 'Block_164905797860709eb48a99d3_61823109',
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
class Block_164014023260709eb48aa1d8_82485992 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_164014023260709eb48aa1d8_82485992',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/var/www/oecs/vendor/smarty/smarty/libs/plugins/function.html_options.php','function'=>'smarty_function_html_options',),));
?>

    
    <?php echo $_smarty_tpl->tpl_vars['msg']->value;?>

    
    <div class="listTableCaption_simpleTable" style="font-variant:normal;font-weight: 500;margin-top:2px;margin-bottom:2px;color:#414042;font-family:'Poppins', sans-serif;font-size:1.3rem;">
        <?php echo \Neptune\MessageResources::i18n("medicationForm.legend");?>

    </div>
    <div style="margin-left:15px;margin-top:2px;">
        <form data-abide name="medicationForm" id="medicationForm" action="<?php echo $_smarty_tpl->tpl_vars['actionPage']->value;?>
" method="POST" autocomplete="off">


                <input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['medication']->value->getId();?>
"/>
                <div class="row">
                    <div class="medium-4 end columns">
                        <label><span class="required"><?php echo \Neptune\MessageResources::i18n("medicationForm.pharmaceuticalId");?>
</span>
                            <select tabindex="1" id="pharmaceuticalId" name="pharmaceuticalId" value="<?php echo $_smarty_tpl->tpl_vars['medication']->value->getPharmaceuticalId();?>
" required>
                                <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['pharmaceuticalIds']->value,'selected'=>$_smarty_tpl->tpl_vars['medication']->value->getPharmaceuticalId()),$_smarty_tpl);?>

                            </select>
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="medium-4 end columns">
                        <label><span class="required"><?php echo \Neptune\MessageResources::i18n("medicationForm.dosage");?>
</span>
                            <input tabindex="2" maxlength="10" type="text" id="dosage" name="dosage" value="<?php echo $_smarty_tpl->tpl_vars['medication']->value->getDosage();?>
" placeholder="" required>
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="medium-4 end columns" style="padding-top:8px;">
                        <a href="/medication" tabindex="4" class="reset"><?php echo \Neptune\MessageResources::i18n("link.reset");?>
</a>&nbsp;
                        <?php echo \Neptune\HtmlElementTag::submitBtn(3);?>

                    </div>
                    <?php if ($_smarty_tpl->tpl_vars['medication']->value->getId() != '') {?>
                        <div class="medium-4 end columns" style="padding-top:8px;">
                            <?php echo \Neptune\MessageResources::i18n("checkbox.confirm");?>
&nbsp;<input tabindex="5" id="confirmDelete" type="checkbox"/>
                            <?php echo \Neptune\HtmlElementTag::deleteBtn(6,"/medication/delete/".((string)$_smarty_tpl->tpl_vars['medication']->value->getId()));?>

                        </div>
                    <?php }?>
                </div>

        </form> 
    </div>       

<?php if (count($_smarty_tpl->tpl_vars['list']->value) > 0) {?>
    <br/>
    <table align="left" id="listTable" class="displayTable" width="95%" cellspacing="0">
        <thead>
            <tr>
                <th><?php echo \Neptune\MessageResources::i18n("medicationForm.pharmaceuticalId");?>
</th> 
                <th><?php echo \Neptune\MessageResources::i18n("medicationForm.dosage");?>
</th>
                <th width="10%">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['list']->value, 'med');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['med']->value) {
?> 
                <tr>                           
                    <td><?php echo $_smarty_tpl->tpl_vars['med']->value->getPharmaceutical()->getLabel();?>
</td> 
                    <td><?php echo $_smarty_tpl->tpl_vars['med']->value->getDosage();?>
</td> 
                    <td>
                        <a class="editRow" title="<?php echo \Neptune\MessageResources::i18n("link.edit");?>
" href="/medication/edit/<?php echo $_smarty_tpl->tpl_vars['med']->value->getId();?>
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
        <?php echo \Neptune\MessageResources::i18n("medicationForm.empty.list.message");?>

    </div>
<?php }?>
<br/><br/>



<?php
}
}
/* {/block 'content'} */
}
