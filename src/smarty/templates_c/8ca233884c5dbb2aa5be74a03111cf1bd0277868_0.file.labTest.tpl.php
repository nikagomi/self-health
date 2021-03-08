<?php
/* Smarty version 3.1.34-dev-7, created on 2021-03-08 16:11:49
  from '/var/www/oecs/src/smarty/templates/clinical/labTest.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_60464cc5542f57_16083565',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8ca233884c5dbb2aa5be74a03111cf1bd0277868' => 
    array (
      0 => '/var/www/oecs/src/smarty/templates/clinical/labTest.tpl',
      1 => 1613764631,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60464cc5542f57_16083565 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>



<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_154665617860464cc5532e67_56006372', 'jquery');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_44564683660464cc5534c27_45803704', 'dataTable');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_128290742460464cc55354f1_56172602', 'content');
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "base/body.tpl");
}
/* {block 'jquery'} */
class Block_154665617860464cc5532e67_56006372 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'jquery' => 
  array (
    0 => 'Block_154665617860464cc5532e67_56006372',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    
        $("div.table-toolbar").html("<?php echo \Neptune\MessageResources::i18n("labTestForm.recorded.list");?>
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
class Block_44564683660464cc5534c27_45803704 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'dataTable' => 
  array (
    0 => 'Block_44564683660464cc5534c27_45803704',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    
        'iDisplayLength':25,
        paging: true,
       
        
        "dom": "<'row'<'large-4 medium-4 columns collapsed table-toolbar'><'large-3 medium-3 columns collapsed'l><'large-4 medium-4 columns end small-text-left medium-text-right collapsed 'f>>"+
            "t"+
            "<'row'<'small-12 medium-6 columns'><'small-12 medium-6 columns'p>>"
    
<?php
}
}
/* {/block 'dataTable'} */
/* {block 'content'} */
class Block_128290742460464cc55354f1_56172602 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_128290742460464cc55354f1_56172602',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    
    <?php echo $_smarty_tpl->tpl_vars['msg']->value;?>

    
    <div class="listTableCaption_simpleTable" style="font-variant:normal;font-weight: 500;margin-top:2px;margin-bottom:2px;color:#414042;font-family:'Poppins', sans-serif;font-size:1.3rem;">
        <?php echo \Neptune\MessageResources::i18n("labTestForm.legend");?>

    </div>
    <div style="margin-left:15px;margin-top:2px;">
        <form data-abide name="labTestForm" id="labTestForm" action="<?php echo $_smarty_tpl->tpl_vars['actionPage']->value;?>
" method="POST" autocomplete="off">

                <input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['labTest']->value->getId();?>
"/>
                <div class="row">
                    <div class="medium-3 end columns">
                        <label><span class="required"><?php echo \Neptune\MessageResources::i18n("labTestForm.name");?>
</span>
                            <input tabindex="1" class="medium" autofocus type="text" id="name" name="name" value="<?php echo $_smarty_tpl->tpl_vars['labTest']->value->getName();?>
" placeholder="" required>
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="medium-3 end columns">
                        <label><span class="required"><?php echo \Neptune\MessageResources::i18n("labTestForm.unit");?>
</span>
                            <input tabindex="2" class="medium" maxlength="10" type="text" id="unit" name="unit" value="<?php echo $_smarty_tpl->tpl_vars['labTest']->value->getUnit();?>
" required>
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="medium-3 end columns">
                        <label><span class=""><?php echo \Neptune\MessageResources::i18n("labTestForm.numeric");?>
</span>
                            <div class="switch"  style="padding-bottom:2px;margin-bottom: 2px;"> 
                                <input name="numeric" id="numeric" tabindex="3" type="checkbox" value="1" <?php if ($_smarty_tpl->tpl_vars['labTest']->value->isNumeric()) {?> checked <?php }?>> 
                                <label for="numeric"></label> 
                            </div> 
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="medium-3 end columns" style="padding-top:8px;">
                        <a href="/lab/test/form" tabindex="5" class="reset"><?php echo \Neptune\MessageResources::i18n("link.reset");?>
</a>&nbsp;
                        <?php echo \Neptune\HtmlElementTag::submitBtn(4);?>

                    </div>
                    <?php if ($_smarty_tpl->tpl_vars['labTest']->value->getId() != '') {?>
                        <div class="medium-3 end columns" style="padding-top:8px;">
                            <?php echo \Neptune\MessageResources::i18n("checkbox.confirm");?>
&nbsp;<input tabindex="6" id="confirmDelete" type="checkbox"/>
                            <?php echo \Neptune\HtmlElementTag::deleteBtn(7,"/lab/test/delete/".((string)$_smarty_tpl->tpl_vars['labTest']->value->getId()));?>

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
                <th><?php echo \Neptune\MessageResources::i18n("labTestForm.name");?>
</th> 
                <th><?php echo \Neptune\MessageResources::i18n("labTestForm.unit");?>
</th> 
                <th><?php echo \Neptune\MessageResources::i18n("labTestForm.numeric");?>
</th> 
                <th width="10%">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['list']->value, 'lt');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['lt']->value) {
?> 
                <tr>                           
                    <td><?php echo $_smarty_tpl->tpl_vars['lt']->value->getName();?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['lt']->value->getUnit();?>
</td> 
                    <td><?php echo \Neptune\DbMapperUtility::booleanYesNo($_smarty_tpl->tpl_vars['lt']->value->isNumeric());?>
</td> 
                    <td>
                        <a class="editRow" title="<?php echo \Neptune\MessageResources::i18n("link.edit");?>
" href="/lab/test/edit/<?php echo $_smarty_tpl->tpl_vars['lt']->value->getId();?>
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
        <?php echo \Neptune\MessageResources::i18n("labTestForm.empty.list.message");?>

    </div>
<?php }?>
<br/><br/>



<?php
}
}
/* {/block 'content'} */
}
