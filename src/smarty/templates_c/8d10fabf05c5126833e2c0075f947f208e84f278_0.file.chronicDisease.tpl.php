<?php
/* Smarty version 3.1.34-dev-7, created on 2021-04-12 17:58:44
  from '/var/www/oecs/src/smarty/templates/admin/chronicDisease.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_60748a54e02c93_41940070',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8d10fabf05c5126833e2c0075f947f208e84f278' => 
    array (
      0 => '/var/www/oecs/src/smarty/templates/admin/chronicDisease.tpl',
      1 => 1618249954,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60748a54e02c93_41940070 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>



<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_6611881160748a54dedea2_50305388', 'jquery');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_211762586860748a54defbd9_11652921', 'dataTable');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_159021687860748a54df0c21_43060870', 'content');
?>



<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "base/body.tpl");
}
/* {block 'jquery'} */
class Block_6611881160748a54dedea2_50305388 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'jquery' => 
  array (
    0 => 'Block_6611881160748a54dedea2_50305388',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    
        $("div.table-toolbar").html("<?php echo \Neptune\MessageResources::i18n("chronicDiseaseForm.recorded.list");?>
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
class Block_211762586860748a54defbd9_11652921 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'dataTable' => 
  array (
    0 => 'Block_211762586860748a54defbd9_11652921',
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
class Block_159021687860748a54df0c21_43060870 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_159021687860748a54df0c21_43060870',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    
    <?php echo $_smarty_tpl->tpl_vars['msg']->value;?>

    
    <div class="listTableCaption_simpleTable" style="font-variant:normal;font-weight: 500;margin-top:2px;margin-bottom:2px;color:#414042;font-family:'Poppins', sans-serif;font-size:1.3rem;">
        <?php echo \Neptune\MessageResources::i18n("chronicDiseaseForm.legend");?>

    </div>
    <div style="margin-left:15px;margin-top:2px;">
        <form data-abide name="chronicDiseaseForm" id="chronicDiseaseForm" action="<?php echo $_smarty_tpl->tpl_vars['actionPage']->value;?>
" method="POST" autocomplete="off">


                <input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['chronicDisease']->value->getId();?>
"/>
                <div class="row">
                    <div class="medium-4 end columns">
                        <label><span class="required"><?php echo \Neptune\MessageResources::i18n("chronicDiseaseForm.name");?>
</span>
                            <input tabindex="1" autofocus type="text" id="name" name="name" maxlength="145" value="<?php echo $_smarty_tpl->tpl_vars['chronicDisease']->value->getName();?>
" placeholder="" required>
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="medium-4 end columns" style="padding-top:8px;">
                        <a href="/chronic/disease" tabindex="3" class="reset"><?php echo \Neptune\MessageResources::i18n("link.reset");?>
</a>&nbsp;
                        <?php echo \Neptune\HtmlElementTag::submitBtn(2);?>

                    </div>
                    <?php if ($_smarty_tpl->tpl_vars['chronicDisease']->value->getId() != '') {?>
                        <div class="medium-4 end columns" style="padding-top:8px;">
                            <?php echo \Neptune\MessageResources::i18n("checkbox.confirm");?>
&nbsp;<input tabindex="4" id="confirmDelete" type="checkbox"/>
                            <?php echo \Neptune\HtmlElementTag::deleteBtn(5,"/chronic/disease/delete/".((string)$_smarty_tpl->tpl_vars['chronicDisease']->value->getId()));?>

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
                <th><?php echo \Neptune\MessageResources::i18n("chronicDiseaseForm.name");?>
</th> 
                <th width="10%">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['list']->value, 'cd');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['cd']->value) {
?> 
                <tr>                           
                    <td><?php echo $_smarty_tpl->tpl_vars['cd']->value->getName();?>
</td> 
                    <td>
                        <a class="editRow" title="<?php echo \Neptune\MessageResources::i18n("link.edit");?>
" href="/chronic/disease/edit/<?php echo $_smarty_tpl->tpl_vars['cd']->value->getId();?>
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
        <?php echo \Neptune\MessageResources::i18n("chronicDiseaseForm.empty.list.message");?>

    </div>
<?php }?>
<br/><br/>



<?php
}
}
/* {/block 'content'} */
}
