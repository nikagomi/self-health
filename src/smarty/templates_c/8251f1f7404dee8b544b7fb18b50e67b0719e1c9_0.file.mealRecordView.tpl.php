<?php
/* Smarty version 3.1.34-dev-7, created on 2021-03-11 15:23:29
  from '/var/www/oecs/src/smarty/templates/patient/mealRecordView.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_604a35f11650f5_92960735',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8251f1f7404dee8b544b7fb18b50e67b0719e1c9' => 
    array (
      0 => '/var/www/oecs/src/smarty/templates/patient/mealRecordView.tpl',
      1 => 1613939321,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_604a35f11650f5_92960735 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>



<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_852022037604a35f1157b09_60522037', 'styles');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_381752932604a35f1158b03_45662680', 'scripts');
?>



<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1108192117604a35f115a403_37451429', 'jquery');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_257827585604a35f115acc6_13199283', 'content');
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "base/contentBody.tpl");
}
/* {block 'styles'} */
class Block_852022037604a35f1157b09_60522037 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'styles' => 
  array (
    0 => 'Block_852022037604a35f1157b09_60522037',
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
        
        th {
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
class Block_381752932604a35f1158b03_45662680 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'scripts' => 
  array (
    0 => 'Block_381752932604a35f1158b03_45662680',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    
        function truncateText(text, val){
            var newLength = val - 3;
            return (text.length > val) ? text.substring(0, newLength) + "..." : text; 
        }
        
        var foodGroupsQty = <?php echo count($_smarty_tpl->tpl_vars['foodGroups']->value);?>
;
        var col1 = foodGroupsQty + 1;
        var col2 = foodGroupsQty + 2;
    
<?php
}
}
/* {/block 'scripts'} */
/* {block 'jquery'} */
class Block_1108192117604a35f115a403_37451429 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'jquery' => 
  array (
    0 => 'Block_1108192117604a35f115a403_37451429',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    
        
        $(function(){
            $(".hotspot").tipTip({maxWidth: "200px", edgeOffset: 3, defaultPosition: "top", delay: 200, fadeOut: 400});
        });
        
        
        
        /*********************************
         DataTable configuration options
        **********************************/
        $("table#mealRecordTable").DataTable({
            responsive: true,
            "searching":false,
            "info": false,
            "paging": false,
            "fixedHeader": false,
            order: [
                [1, 'desc'],
                [2,'desc'],
                [0, 'asc']
            ]
        });
    
<?php
}
}
/* {/block 'jquery'} */
/* {block 'content'} */
class Block_257827585604a35f115acc6_13199283 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_257827585604a35f115acc6_13199283',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    
    <div>
    <div class="listTableCaption_simpleTable" style="font-variant:normal;font-weight: 500;margin-top:2px;margin-bottom:2px;color:#414042;font-family:'Poppins', sans-serif;font-size:1.3rem;">
        Meal Records
    </div>
    <div id="" <?php if (count($_smarty_tpl->tpl_vars['meals']->value) == 0) {?> style="display:none;" <?php }?>>
      
         <table align="left" id="mealRecordTable" class="displayTable_simpleTable" style="" width="99%" cellspacing="1">
             <thead>
                <tr>
                    <th class='all'><?php echo \Neptune\MessageResources::i18n("patientMealForm.mealTypeId");?>
</th>
                    <th style="width:15%;" class='all'><?php echo \Neptune\MessageResources::i18n("patientMealForm.dateConsumed");?>
</th>
                    <th style="width:20%;"  class='all'><?php echo \Neptune\MessageResources::i18n("patientMealForm.timeConsumed");?>
</th>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['foodGroups']->value, 'fg');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['fg']->value) {
?>
                        <th class=''><?php echo $_smarty_tpl->tpl_vars['fg']->value->getLabel();?>
</th>
                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                   </tr>
             </thead>
            <tbody>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['meals']->value, 'meal');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['meal']->value) {
?> 
                    <tr> 
                        <td><?php echo $_smarty_tpl->tpl_vars['meal']->value->getMealType()->getLabel();?>
 </td>
                        <td><?php echo $_smarty_tpl->tpl_vars['meal']->value->displayDateConsumed();?>
</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['meal']->value->displayTimeConsumed();?>
</td>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['foodGroups']->value, 'fg');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['fg']->value) {
?>
                            <td><?php echo $_smarty_tpl->tpl_vars['mealFoodGroup']->value->getByMealRecordAndFoodGroupId($_smarty_tpl->tpl_vars['meal']->value->getId(),$_smarty_tpl->tpl_vars['fg']->value->getId())->getDetails();?>
</td>
                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                            </tr>
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </tbody>
         </table> 
     </div>    
        
    
    <?php if (count($_smarty_tpl->tpl_vars['meals']->value) == 0) {?>
        <div class="emptyListMessage"><?php echo \Neptune\MessageResources::i18n("patientMealForm.empty.list.message");?>
</div>
    <?php }?>
</div>


<?php
}
}
/* {/block 'content'} */
}