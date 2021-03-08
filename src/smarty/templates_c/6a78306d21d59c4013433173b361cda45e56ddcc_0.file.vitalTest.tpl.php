<?php
/* Smarty version 3.1.34-dev-7, created on 2021-03-01 18:10:13
  from '/var/www/oecs/src/smarty/templates/clinical/vitalTest.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_603d2e053fd919_61160449',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6a78306d21d59c4013433173b361cda45e56ddcc' => 
    array (
      0 => '/var/www/oecs/src/smarty/templates/clinical/vitalTest.tpl',
      1 => 1614622209,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_603d2e053fd919_61160449 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>



<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_125321659603d2e053dd996_46003869', 'jquery');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1322829917603d2e053e03b4_11635817', 'dataTable');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_167639042603d2e053e1046_15006169', 'content');
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "base/body.tpl");
}
/* {block 'jquery'} */
class Block_125321659603d2e053dd996_46003869 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'jquery' => 
  array (
    0 => 'Block_125321659603d2e053dd996_46003869',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    
        $("div.table-toolbar").html("<?php echo \Neptune\MessageResources::i18n("vitalTestForm.recorded.list");?>
").css({
            "margin-left" : "17px",
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
class Block_1322829917603d2e053e03b4_11635817 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'dataTable' => 
  array (
    0 => 'Block_1322829917603d2e053e03b4_11635817',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    
        paging: true,
        order:[[7,"asc"]],
        "dom": "<'row'<'large-4 medium-4 columns collapsed table-toolbar'><'large-7 medium-7 columns end small-text-left medium-text-right collapsed 'f>>"+
            "t"+
            "<'row'<'small-12 medium-6 columns'><'small-12 medium-6 columns'p>>"
    
<?php
}
}
/* {/block 'dataTable'} */
/* {block 'content'} */
class Block_167639042603d2e053e1046_15006169 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_167639042603d2e053e1046_15006169',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/var/www/oecs/vendor/smarty/smarty/libs/plugins/function.html_options.php','function'=>'smarty_function_html_options',),));
?>

    
    <?php echo $_smarty_tpl->tpl_vars['msg']->value;?>

    
    <div class="listTableCaption_simpleTable" style="font-variant:normal;font-weight: 500;margin-top:2px;margin-bottom:2px;color:#414042;font-family:'Poppins', sans-serif;font-size:1.3rem;">
        <?php echo \Neptune\MessageResources::i18n("vitalTestForm.legend");?>

    </div>
    <div style="margin-left:15px;margin-top:2px;">
        <form data-abide name="vitalTestForm" id="vitalTestForm" action="<?php echo $_smarty_tpl->tpl_vars['actionPage']->value;?>
" method="POST" autocomplete="off">

                <input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['vitalTest']->value->getId();?>
"/>
                <div class="row">
                    <div class="medium-3 end columns">
                        <label><span class="required"><?php echo \Neptune\MessageResources::i18n("vitalTestForm.name");?>
</span>
                            <input tabindex="1" class="medium" autofocus type="text" id="name" name="name" value="<?php echo $_smarty_tpl->tpl_vars['vitalTest']->value->getName();?>
" placeholder="" required>
                        </label>
                    </div>
                    <div class="medium-3 end columns">
                        <label><span class="required"><?php echo \Neptune\MessageResources::i18n("vitalTestForm.abbreviation");?>
</span>
                            <input tabindex="2" class="short" maxlength="5" type="text" id="abbreviation" name="abbreviation" value="<?php echo $_smarty_tpl->tpl_vars['vitalTest']->value->getAbbreviation();?>
" required>
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="medium-3 end columns">
                        <label><span class="required"><?php echo \Neptune\MessageResources::i18n("vitalTestForm.unit");?>
</span>
                            <input tabindex="3" class="medium" maxlength="10" type="text" id="unit" name="unit" value="<?php echo $_smarty_tpl->tpl_vars['vitalTest']->value->getUnit();?>
" required>
                        </label>
                    </div>
                    <div class="medium-3 end columns">
                        <label><span class=""><?php echo \Neptune\MessageResources::i18n("vitalTestForm.numeric");?>
</span>
                            <div class="switch"  style="padding-bottom:2px;margin-bottom: 2px;"> 
                                <input name="numeric" id="numeric" tabindex="4" type="checkbox" value="1" <?php if ($_smarty_tpl->tpl_vars['vitalTest']->value->isNumeric()) {?> checked <?php }?>> 
                                <label for="numeric"></label> 
                            </div> 
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="medium-3 end columns">
                        <label><span class=""><?php echo \Neptune\MessageResources::i18n("vitalTestForm.bpTest");?>
</span>
                            <div class="switch" style="padding-bottom:2px;margin-bottom: 5px;"> 
                                <input name="bpTest" id="bpTest" tabindex="5" type="checkbox" value="1" <?php if ($_smarty_tpl->tpl_vars['vitalTest']->value->isBpTest()) {?> checked <?php }?>> 
                                <label for="bpTest"></label> 
                            </div> 
                        </label>
                    </div>
                    <div class="medium-3 end columns">
                        <label><span class=""><?php echo \Neptune\MessageResources::i18n("vitalTestForm.bpTestOrder");?>
</span><br/>
                            <select name="bpTestOrder" id="bpTestOrder" style="width:100px;" tabindex="6">
                                <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['componentOrder']->value,'selected'=>$_smarty_tpl->tpl_vars['vitalTest']->value->getBpTestOrder()),$_smarty_tpl);?>

                            </select>
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="medium-3 end columns">
                        <label><span class=""><?php echo \Neptune\MessageResources::i18n("vitalTestForm.bmiHeightComponent");?>
</span>
                            <div class="switch" style="padding-bottom:2px;margin-bottom: 5px;"> 
                                <input name="bmiHeightComponent" id="bmiHeightComponent" tabindex="5" type="checkbox" value="1" <?php if ($_smarty_tpl->tpl_vars['vitalTest']->value->isBmiHeightComponent()) {?> checked <?php }?>> 
                                <label for="bmiHeightComponent"></label> 
                            </div> 
                        </label>
                    </div>
                    <div class="medium-3 end columns">
                        <label><span class=""><?php echo \Neptune\MessageResources::i18n("vitalTestForm.bmiWeightComponent");?>
</span>
                            <div class="switch" style="padding-bottom:2px;margin-bottom: 5px;"> 
                                <input name="bmiWeightComponent" id="bmiWeightComponent" tabindex="5" type="checkbox" value="1" <?php if ($_smarty_tpl->tpl_vars['vitalTest']->value->isBmiWeightComponent()) {?> checked <?php }?>> 
                                <label for="bmiWeightComponent"></label> 
                            </div> 
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="medium-3 end columns">
                        <label><span class="required"><?php echo \Neptune\MessageResources::i18n("vitalTestForm.sortOrder");?>
</span>
                            <input tabindex="7" class="short" maxlength="4" type="text" id="sortOrder" name="sortOrder" value="<?php echo $_smarty_tpl->tpl_vars['vitalTest']->value->getSortOrder();?>
" required>
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="medium-3 end columns" style="padding-top:8px;">
                        <a href="/vital/test/form" tabindex="9" class="reset"><?php echo \Neptune\MessageResources::i18n("link.reset");?>
</a>&nbsp;
                        <?php echo \Neptune\HtmlElementTag::submitBtn(8);?>

                    </div>
                    <?php if ($_smarty_tpl->tpl_vars['vitalTest']->value->getId() != '') {?>
                        <div class="medium-3 end columns" style="padding-top:8px;">
                            <?php echo \Neptune\MessageResources::i18n("checkbox.confirm");?>
&nbsp;<input tabindex="10" id="confirmDelete" type="checkbox"/>
                            <?php echo \Neptune\HtmlElementTag::deleteBtn(11,"/vital/test/delete/".((string)$_smarty_tpl->tpl_vars['vitalTest']->value->getId()));?>

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
                <th><?php echo \Neptune\MessageResources::i18n("vitalTestForm.name");?>
</th> 
                <th><?php echo \Neptune\MessageResources::i18n("vitalTestForm.abbreviation");?>
</th> 
                <th><?php echo \Neptune\MessageResources::i18n("vitalTestForm.unit");?>
</th> 
                <th><?php echo \Neptune\MessageResources::i18n("vitalTestForm.numeric");?>
</th> 
                <th><?php echo \Neptune\MessageResources::i18n("vitalTestForm.bpTest");?>
</th> 
                <th><?php echo \Neptune\MessageResources::i18n("vitalTestForm.bmiHeightComponent");?>
</th> 
                <th><?php echo \Neptune\MessageResources::i18n("vitalTestForm.bmiWeightComponent");?>
</th> 
                <th><?php echo \Neptune\MessageResources::i18n("vitalTestForm.sortOrder");?>
</th> 
                <th width="10%">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['list']->value, 'vt');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['vt']->value) {
?> 
                <tr>                           
                    <td><?php echo $_smarty_tpl->tpl_vars['vt']->value->getName();?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['vt']->value->getAbbreviation();?>
</td> 
                    <td><?php echo $_smarty_tpl->tpl_vars['vt']->value->getUnit();?>
</td> 
                    <td><?php echo \Neptune\DbMapperUtility::booleanYesNo($_smarty_tpl->tpl_vars['vt']->value->isNumeric());?>
</td> 
                    <td>
                        <?php echo \Neptune\DbMapperUtility::booleanYesNo($_smarty_tpl->tpl_vars['vt']->value->isBpTest());?>

                        <?php if ($_smarty_tpl->tpl_vars['vt']->value->isBpTest()) {?>
                            <span style="font-size:0.85rem;">&nbsp;[BP - <?php echo $_smarty_tpl->tpl_vars['vt']->value->getBpTestOrder();?>
]</span>
                        <?php }?>
                    </td> 
                    <td><?php echo \Neptune\DbMapperUtility::booleanYesNo($_smarty_tpl->tpl_vars['vt']->value->isBmiHeightComponent());?>
</td>
                    <td><?php echo \Neptune\DbMapperUtility::booleanYesNo($_smarty_tpl->tpl_vars['vt']->value->isBmiWeightComponent());?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['vt']->value->getSortOrder();?>
</td> 
                    <td>
                        <a class="editRow" title="<?php echo \Neptune\MessageResources::i18n("link.edit");?>
" href="/vital/test/edit/<?php echo $_smarty_tpl->tpl_vars['vt']->value->getId();?>
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
        <?php echo \Neptune\MessageResources::i18n("vitalTestForm.empty.list.message");?>

    </div>
<?php }?>
<br/><br/>



<?php
}
}
/* {/block 'content'} */
}
