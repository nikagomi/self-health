<?php
/* Smarty version 3.1.34-dev-7, created on 2021-04-12 17:38:21
  from '/var/www/oecs/src/smarty/templates/admin/allergyType.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_6074858d7500e4_16480521',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'cfc47f20ee561146339e6e15a44066ced5c30a80' => 
    array (
      0 => '/var/www/oecs/src/smarty/templates/admin/allergyType.tpl',
      1 => 1618249100,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6074858d7500e4_16480521 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>



<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_304386176074858d740d99_44099306', 'jquery');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_14168306866074858d742470_63862616', 'dataTable');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_20777598416074858d742d66_54051615', 'content');
?>


<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "base/body.tpl");
}
/* {block 'jquery'} */
class Block_304386176074858d740d99_44099306 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'jquery' => 
  array (
    0 => 'Block_304386176074858d740d99_44099306',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    
        $("div.table-toolbar").html("<?php echo \Neptune\MessageResources::i18n("allergyTypeForm.recorded.list");?>
").css({
            "margin-left" : "26px",
            "font-family": "'Poppins', sans-serif",
            "font-size" : "1.1rem",
            "font-weight" : 500,
            "color": "#464646"
        });
    
<?php
}
}
/* {/block 'jquery'} */
/* {block 'dataTable'} */
class Block_14168306866074858d742470_63862616 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'dataTable' => 
  array (
    0 => 'Block_14168306866074858d742470_63862616',
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
class Block_20777598416074858d742d66_54051615 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_20777598416074858d742d66_54051615',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    
    <?php echo $_smarty_tpl->tpl_vars['msg']->value;?>

    
    <div class="listTableCaption_simpleTable" style="font-variant:normal;font-weight: 500;margin-top:2px;margin-bottom:2px;color:#414042;font-family:'Poppins', sans-serif;font-size:1.3rem;">
        <?php echo \Neptune\MessageResources::i18n("allergyTypeForm.legend");?>

    </div>
    <div style="margin-left:15px;margin-top:2px;">
        <form data-abide name="allergyTypeForm" id="allergyTypeForm" action="<?php echo $_smarty_tpl->tpl_vars['actionPage']->value;?>
" method="POST" autocomplete="off">


                <input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['allergyType']->value->getId();?>
"/>
                <div class="row">
                    <div class="medium-4 end columns">
                        <label><span class="required"><?php echo \Neptune\MessageResources::i18n("allergyTypeForm.name");?>
</span>
                            <input tabindex="1" autofocus type="text" id="name" name="name" maxlength="45" value="<?php echo $_smarty_tpl->tpl_vars['allergyType']->value->getName();?>
" placeholder="" required>
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="medium-4 end columns" style="padding-top:8px;">
                        <a href="/allergy/type" tabindex="3" class="reset"><?php echo \Neptune\MessageResources::i18n("link.reset");?>
</a>&nbsp;
                        <?php echo \Neptune\HtmlElementTag::submitBtn(2);?>

                    </div>
                    <?php if ($_smarty_tpl->tpl_vars['allergyType']->value->getId() != '') {?>
                        <div class="medium-4 end columns" style="padding-top:8px;">
                            <?php echo \Neptune\MessageResources::i18n("checkbox.confirm");?>
&nbsp;<input tabindex="4" id="confirmDelete" type="checkbox"/>
                            <?php echo \Neptune\HtmlElementTag::deleteBtn(5,"/allergy/type/delete/".((string)$_smarty_tpl->tpl_vars['allergyType']->value->getId()));?>

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
                <th><?php echo \Neptune\MessageResources::i18n("allergyTypeForm.name");?>
</th> 
                <th width="10%">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['list']->value, 'aType');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['aType']->value) {
?> 
                <tr>                           
                    <td><?php echo $_smarty_tpl->tpl_vars['aType']->value->getName();?>
</td> 
                    <td>
                        <a class="editRow" title="<?php echo \Neptune\MessageResources::i18n("link.edit");?>
" href="/allergy/type/edit/<?php echo $_smarty_tpl->tpl_vars['aType']->value->getId();?>
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
        <?php echo \Neptune\MessageResources::i18n("allergyTypeForm.empty.list.message");?>

    </div>
<?php }?>
<br/><br/>



<?php
}
}
/* {/block 'content'} */
}
