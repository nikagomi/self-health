<?php
/* Smarty version 3.1.34-dev-7, created on 2021-04-12 19:55:41
  from '/var/www/oecs/src/smarty/templates/patient/allergyView.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_6074a5bd4ec377_58400973',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '93ee03e65d92e705276590dee2a1965e307a8ff6' => 
    array (
      0 => '/var/www/oecs/src/smarty/templates/patient/allergyView.tpl',
      1 => 1618257338,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6074a5bd4ec377_58400973 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>



<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_16116101216074a5bd4dd031_55066665', 'styles');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1018831776074a5bd4de6c2_62444081', 'scripts');
?>



<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_4506432096074a5bd4df649_90500082', 'jquery');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_4477921906074a5bd4e0a43_68547372', 'content');
?>



<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "base/contentBody.tpl");
}
/* {block 'styles'} */
class Block_16116101216074a5bd4dd031_55066665 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'styles' => 
  array (
    0 => 'Block_16116101216074a5bd4dd031_55066665',
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
        
        table#allergyTable th {
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
class Block_1018831776074a5bd4de6c2_62444081 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'scripts' => 
  array (
    0 => 'Block_1018831776074a5bd4de6c2_62444081',
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
class Block_4506432096074a5bd4df649_90500082 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'jquery' => 
  array (
    0 => 'Block_4506432096074a5bd4df649_90500082',
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
class Block_4477921906074a5bd4e0a43_68547372 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_4477921906074a5bd4e0a43_68547372',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    
    <div>
    <div class="listTableCaption_simpleTable" style="font-variant:normal;font-weight: 500;margin-top:2px;margin-bottom:2px;color:#414042;font-family:'Poppins', sans-serif;font-size:1.3rem;">
        Allergy Record
    </div>
    <div id="" <?php if (count($_smarty_tpl->tpl_vars['allergies']->value) == 0) {?> style="display:none;" <?php }?>>
      
        <table align="left" id="medTable" class="displayTable_simpleTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th><?php echo \Neptune\MessageResources::i18n("patientAllergyForm.allergyTypeId");?>
</th> 
                    <th><?php echo \Neptune\MessageResources::i18n("patientAllergyForm.allergen");?>
</th>
                    <th><?php echo \Neptune\MessageResources::i18n("patientAllergyForm.notes");?>
</th>
                </tr>
            </thead>
            <tbody>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['allergies']->value, 'allergy');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['allergy']->value) {
?> 
                    <tr>                           
                        <td><?php echo $_smarty_tpl->tpl_vars['allergy']->value->getAllergyType()->getLabel();?>
</td> 
                        <td><?php echo $_smarty_tpl->tpl_vars['allergy']->value->getAllergen();?>
</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['allergy']->value->getNotes();?>
</td>
                    </tr>
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </tbody>
        </table>  
     </div>    
        
    
    <?php if (count($_smarty_tpl->tpl_vars['allergies']->value) == 0) {?>
        <div class="emptyListMessage"><?php echo \Neptune\MessageResources::i18n("patientAllergyForm.empty.list.message");?>
</div>
    <?php }?>
</div>


<?php
}
}
/* {/block 'content'} */
}
