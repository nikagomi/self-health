<?php
/* Smarty version 3.1.34-dev-7, created on 2021-04-12 16:51:26
  from '/var/www/oecs/src/smarty/templates/patient/physicalActivityView.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_60747a8e733117_99405117',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2485bad6b4c515e7787b058acf472e5e06366bac' => 
    array (
      0 => '/var/www/oecs/src/smarty/templates/patient/physicalActivityView.tpl',
      1 => 1618002169,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60747a8e733117_99405117 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>



<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_131738147760747a8e727f68_67493733', 'styles');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_33401893960747a8e729136_99656712', 'scripts');
?>



<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_44151407960747a8e7299f6_83738592', 'jquery');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_182946366160747a8e72a138_47609976', 'content');
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "base/contentBody.tpl");
}
/* {block 'styles'} */
class Block_131738147760747a8e727f68_67493733 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'styles' => 
  array (
    0 => 'Block_131738147760747a8e727f68_67493733',
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
class Block_33401893960747a8e729136_99656712 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'scripts' => 
  array (
    0 => 'Block_33401893960747a8e729136_99656712',
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
class Block_44151407960747a8e7299f6_83738592 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'jquery' => 
  array (
    0 => 'Block_44151407960747a8e7299f6_83738592',
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
        $("table#physicalActivityTable").DataTable({
            responsive: true,
            "searching":false,
            "info": false,
            "paging": false,
            "fixedHeader": false,
            order: [
                [2, 'desc'],
                [3,'desc'],
                [0, 'asc']
            ],
            'columnDefs': [
                { 'orderData':[5], 
                  'targets': [2], 
                },
                { 'orderData':[6], 
                  'targets': [3], 
                },
                {
                  'targets': [5,6],
                  'visible': false,
                  'searchable': false,
                }
            ]
        });
    
<?php
}
}
/* {/block 'jquery'} */
/* {block 'content'} */
class Block_182946366160747a8e72a138_47609976 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_182946366160747a8e72a138_47609976',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    
    <div>
    <div class="listTableCaption_simpleTable" style="font-variant:normal;font-weight: 500;margin-top:2px;margin-bottom:2px;color:#414042;font-family:'Poppins', sans-serif;font-size:1.3rem;">
        Physical Activity Records
    </div>
    <div id="" <?php if (count($_smarty_tpl->tpl_vars['activities']->value) == 0) {?> style="display:none;" <?php }?>>
      
         <table align="left" id="physicalActivityTable" class="displayTable_simpleTable" style="" width="99%" cellspacing="1">
             <thead>
                <tr>
                   <th><?php echo \Neptune\MessageResources::i18n("patientPhysicalActivityForm.physicalActivityId");?>
</th> 
                   <th><?php echo \Neptune\MessageResources::i18n("patientPhysicalActivityForm.durationInMinutes");?>
</th>
                    <th><?php echo \Neptune\MessageResources::i18n("patientPhysicalActivityForm.datePerformed");?>
</th>
                    <th><?php echo \Neptune\MessageResources::i18n("patientPhysicalActivityForm.timeStarted");?>
</th>
                    <th><?php echo \Neptune\MessageResources::i18n("patientPhysicalActivityForm.notes");?>
</th>
                   <th class="never">&nbsp;</th> 
                   <th class="never">&nbsp;</th>
                </tr>
             </thead>
            <tbody>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['activities']->value, 'act');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['act']->value) {
?> 
                    <tr> 
                        <td><?php echo $_smarty_tpl->tpl_vars['act']->value->getPhysicalActivity()->getLabel();?>
 </td>
                        <td><?php echo $_smarty_tpl->tpl_vars['act']->value->getDurationInMinutes();?>
</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['act']->value->displayDatePerformed();?>
</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['act']->value->displayTimeStarted();?>
</td>
                        
                        <td><?php echo $_smarty_tpl->tpl_vars['act']->value->getNotes();?>
</td>
                        <td><?php echo strtotime($_smarty_tpl->tpl_vars['act']->value->getDatePerformed());?>
</td>
                        <td><?php echo strtotime($_smarty_tpl->tpl_vars['act']->value->getTimeStarted);?>
</td>
                    </tr>
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </tbody>
         </table> 
     </div>    
        
    
    <?php if (count($_smarty_tpl->tpl_vars['activities']->value) == 0) {?>
        <div class="emptyListMessage"><?php echo \Neptune\MessageResources::i18n("patientPhysicalActivityForm.empty.list.message");?>
</div>
    <?php }?>
</div>


<?php
}
}
/* {/block 'content'} */
}