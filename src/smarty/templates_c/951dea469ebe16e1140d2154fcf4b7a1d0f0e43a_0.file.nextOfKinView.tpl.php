<?php
/* Smarty version 3.1.34-dev-7, created on 2021-04-13 13:10:03
  from '/var/www/oecs/src/smarty/templates/patient/nextOfKinView.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_6075982b05dcf8_22413226',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '951dea469ebe16e1140d2154fcf4b7a1d0f0e43a' => 
    array (
      0 => '/var/www/oecs/src/smarty/templates/patient/nextOfKinView.tpl',
      1 => 1618319359,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6075982b05dcf8_22413226 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>



<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_8265119986075982b0515a8_49668900', 'styles');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_17300085386075982b0539a6_52956984', 'scripts');
?>



<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_17912379016075982b054496_40022030', 'jquery');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_18587779666075982b055239_96039830', 'content');
?>




<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "base/contentBody.tpl");
}
/* {block 'styles'} */
class Block_8265119986075982b0515a8_49668900 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'styles' => 
  array (
    0 => 'Block_8265119986075982b0515a8_49668900',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    
        .viewLabel, label{
            font-size: 0.9rem !important;
        }
        
        .chosen-container .chosen-drop {
            width: 300px;
        }
        
        .canceled {
            text-decoration:line-through;
        }
        
        table#nokTable th {
            font-variant:normal !important;
            font-weight:500 !important;
            color:#FFFFFF !important;
            font-size:0.9rem !important;
            text-align:left !important;
            font-family: "Poppins", sans-serif !important;
        }
    
<?php
}
}
/* {/block 'styles'} */
/* {block 'scripts'} */
class Block_17300085386075982b0539a6_52956984 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'scripts' => 
  array (
    0 => 'Block_17300085386075982b0539a6_52956984',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    
        function truncateText(text, val){
            var newLength = val - 3;
            return (text.length > val) ? text.substring(0, newLength) + "..." : text; 
        }
    
<?php
}
}
/* {/block 'scripts'} */
/* {block 'jquery'} */
class Block_17912379016075982b054496_40022030 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'jquery' => 
  array (
    0 => 'Block_17912379016075982b054496_40022030',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    
        
        $(function(){
            $(".hotspot").tipTip({maxWidth: "200px", edgeOffset: 3, defaultPosition: "top", delay: 200, fadeOut: 400});
        });
        
    
<?php
}
}
/* {/block 'jquery'} */
/* {block 'content'} */
class Block_18587779666075982b055239_96039830 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_18587779666075982b055239_96039830',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    
    <div>
    <div class="listTableCaption_simpleTable" style="font-variant:normal;font-weight: 500;margin-top:2px;margin-bottom:2px;color:#414042;font-family:'Poppins', sans-serif;font-size:1.3rem;">
        Next of Kin
    </div>
    <div id="" <?php if (count($_smarty_tpl->tpl_vars['nextOfKins']->value) == 0) {?> style="display:none;" <?php }?>>
      
        <table align="left" id="nokTable" class="displayTable_simpleTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th><?php echo \Neptune\MessageResources::i18n("nextOfKinForm.name");?>
</th>
                    <th><?php echo \Neptune\MessageResources::i18n("nextOfKinForm.relationshipTypeId");?>
</th> 
                    <th><?php echo \Neptune\MessageResources::i18n("nextOfKinForm.contactNumber");?>
</th>
                </tr>
            </thead>
            <tbody>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['nextOfKins']->value, 'nok');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['nok']->value) {
?> 
                    <tr>   
                        <td><?php echo $_smarty_tpl->tpl_vars['nok']->value->getName();?>
</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['nok']->value->getRelationshipType()->getLabel();?>
</td> 
                        <td><?php echo $_smarty_tpl->tpl_vars['nok']->value->getContactNumber();?>
</td>
                    </tr>
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </tbody>
        </table>  
     </div>    
        
    
    <?php if (count($_smarty_tpl->tpl_vars['nextOfKins']->value) == 0) {?>
        <div class="emptyListMessage"><?php echo \Neptune\MessageResources::i18n("nextOfKinForm.empty.list.message");?>
</div>
    <?php }?>
</div>


<?php
}
}
/* {/block 'content'} */
}
