<?php
/* Smarty version 3.1.34-dev-7, created on 2021-03-04 14:32:04
  from '/var/www/oecs/src/smarty/templates/admin/physicalActivity.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_6040ef643d8712_18800564',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '10cc60de3e2c3e66996e85e46124746aa0dd3b87' => 
    array (
      0 => '/var/www/oecs/src/smarty/templates/admin/physicalActivity.tpl',
      1 => 1613491717,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6040ef643d8712_18800564 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>



<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_16237565096040ef643c7218_46870327', 'jquery');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_16837356346040ef643c9533_83296266', 'dataTable');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_4663960346040ef643c9e38_37161209', 'content');
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "base/body.tpl");
}
/* {block 'jquery'} */
class Block_16237565096040ef643c7218_46870327 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'jquery' => 
  array (
    0 => 'Block_16237565096040ef643c7218_46870327',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    
        $("div.table-toolbar").html("<?php echo \Neptune\MessageResources::i18n("physicalActivityForm.recorded.list");?>
").css({
            "margin-left" : "26px",
            "font-family": "'Poppins', sans-serif",
            "font-size" : "1.2rem",
            "font-weight" : 500,
            "color": "#464646"
        });
    
<?php
}
}
/* {/block 'jquery'} */
/* {block 'dataTable'} */
class Block_16837356346040ef643c9533_83296266 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'dataTable' => 
  array (
    0 => 'Block_16837356346040ef643c9533_83296266',
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
class Block_4663960346040ef643c9e38_37161209 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_4663960346040ef643c9e38_37161209',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    
    <?php echo $_smarty_tpl->tpl_vars['msg']->value;?>

    <div class="listTableCaption_simpleTable" style="font-variant:normal;font-weight: 500;margin-top:2px;margin-bottom:2px;color:#414042;font-family:'Poppins', sans-serif;font-size:1.3rem;">
        <?php echo \Neptune\MessageResources::i18n("physicalActivityForm.legend");?>

    </div>
    <div style="margin-left:15px;margin-top:2px;">
        <form data-abide name="physicalActivityForm" id="physicalActivityForm" action="<?php echo $_smarty_tpl->tpl_vars['actionPage']->value;?>
" method="POST" autocomplete="off">


                <input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['physicalActivity']->value->getId();?>
"/>
                <div class="row">
                    <div class="medium-4 end columns">
                        <label><span class="required"><?php echo \Neptune\MessageResources::i18n("physicalActivityForm.name");?>
</span>
                            <input tabindex="1" autofocus type="text" id="name" name="name" value="<?php echo $_smarty_tpl->tpl_vars['physicalActivity']->value->getName();?>
" placeholder="" required>
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="medium-4 end columns" style="padding-top:8px;">
                        <a href="/physical/activity" tabindex="3" class="reset"><?php echo \Neptune\MessageResources::i18n("link.reset");?>
</a>&nbsp;
                        <?php echo \Neptune\HtmlElementTag::submitBtn(2);?>

                    </div>
                    <?php if ($_smarty_tpl->tpl_vars['physicalActivity']->value->getId() != '') {?>
                        <div class="medium-4 end columns" style="padding-top:8px;">
                            <?php echo \Neptune\MessageResources::i18n("checkbox.confirm");?>
&nbsp;<input tabindex="4" id="confirmDelete" type="checkbox"/>
                            <?php echo \Neptune\HtmlElementTag::deleteBtn(5,"/physical/activity/delete/".((string)$_smarty_tpl->tpl_vars['physicalActivity']->value->getId()));?>

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
                <th><?php echo \Neptune\MessageResources::i18n("physicalActivityForm.name");?>
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
                    <td><?php echo $_smarty_tpl->tpl_vars['pa']->value->getName();?>
</td> 
                    <td>
                        <a class="editRow" title="<?php echo \Neptune\MessageResources::i18n("link.edit");?>
" href="/physical/activity/edit/<?php echo $_smarty_tpl->tpl_vars['pa']->value->getId();?>
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
        <?php echo \Neptune\MessageResources::i18n("physicalActivityForm.empty.list.message");?>

    </div>
<?php }?>
<br/><br/>



<?php
}
}
/* {/block 'content'} */
}
