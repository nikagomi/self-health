<?php
/* Smarty version 3.1.34-dev-7, created on 2021-03-01 18:44:58
  from '/var/www/oecs/src/smarty/templates/patient/vitalSigns.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_603d362aaac994_86057026',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b0d0f38de727c1b46a7d683663e5be7445a9fdae' => 
    array (
      0 => '/var/www/oecs/src/smarty/templates/patient/vitalSigns.tpl',
      1 => 1614624058,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_603d362aaac994_86057026 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>



<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_179258248603d362aa96fc1_91377472', 'styles');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1294882035603d362aa98a58_34676672', 'scripts');
?>



<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1307778150603d362aa991c6_67712497', 'jquery');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_994484439603d362aa99886_59896669', 'content');
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "base/contentBody.tpl");
}
/* {block 'styles'} */
class Block_179258248603d362aa96fc1_91377472 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'styles' => 
  array (
    0 => 'Block_179258248603d362aa96fc1_91377472',
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
class Block_1294882035603d362aa98a58_34676672 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'scripts' => 
  array (
    0 => 'Block_1294882035603d362aa98a58_34676672',
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
class Block_1307778150603d362aa991c6_67712497 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'jquery' => 
  array (
    0 => 'Block_1307778150603d362aa991c6_67712497',
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
        $("table#vitalSignsTable").DataTable({
            responsive: true,
            "searching":false,
            "info": false,
            "paging": false,
            "fixedHeader": false,
            order: [
                [0, 'desc'],
                [1,'desc'],
                [2, 'asc']
            ]
        });
    
<?php
}
}
/* {/block 'jquery'} */
/* {block 'content'} */
class Block_994484439603d362aa99886_59896669 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_994484439603d362aa99886_59896669',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    
    <div>
    <div class="listTableCaption_simpleTable" style="font-variant:normal;font-weight: 500;margin-top:2px;margin-bottom:2px;color:#414042;font-family:'Poppins', sans-serif;font-size:1.3rem;">
        Vital Signs
    </div>
    <div id="" <?php if (count($_smarty_tpl->tpl_vars['vitals']->value) == 0) {?> style="display:none;" <?php }?>>
      
         <table align="left" id="vitalSignsTable" class="displayTable_simpleTable" style="" width="99%" cellspacing="1">
             <thead>
                <tr>
                    <th><?php echo \Neptune\MessageResources::i18n("patientVitalForm.recordDate");?>
</th>
                    <th><?php echo \Neptune\MessageResources::i18n("patientVitalForm.recordTime");?>
</th>
                    <th><?php echo \Neptune\MessageResources::i18n("patientVitalForm.patientPosition");?>
</th>
                    <?php if (count($_smarty_tpl->tpl_vars['bpTests']->value) == 2) {?>
                        <th>BP<br/><span style="font-size:0.9rem;font-weight:normal;">[<?php echo $_smarty_tpl->tpl_vars['bpTests']->value[0]->getUnit();?>
]</span></th>
                    <?php }?>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['nonBPTests']->value, 'nbpt');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['nbpt']->value) {
?>
                        <th><?php echo $_smarty_tpl->tpl_vars['nbpt']->value->getAbbreviation();?>
<br/><span style="font-size:0.9rem;font-weight:normal;">[<?php echo $_smarty_tpl->tpl_vars['nbpt']->value->getUnit();?>
]</span></th>
                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    <th><?php echo \Neptune\MessageResources::i18n("patientVitalForm.BMI");?>
</th>
                                   </tr>
             </thead>
            <tbody>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['vitals']->value, 'vital');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['vital']->value) {
?> 
                    <tr> 
                        <td><?php echo $_smarty_tpl->tpl_vars['vital']->value->displayRecordDate();?>
</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['vital']->value->displayRecordTime();?>
</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['vital']->value->getPatientPosition();?>
</td>
                        <?php if (count($_smarty_tpl->tpl_vars['bpTests']->value) == 2) {?>
                            <td><?php echo $_smarty_tpl->tpl_vars['item']->value->getByRecordAndVitalTestId($_smarty_tpl->tpl_vars['vital']->value->getId(),$_smarty_tpl->tpl_vars['bpTests']->value[0]->getId())->getTestResult();?>
 / <?php echo $_smarty_tpl->tpl_vars['item']->value->getByRecordAndVitalTestId($_smarty_tpl->tpl_vars['vital']->value->getId(),$_smarty_tpl->tpl_vars['bpTests']->value[1]->getId())->getTestResult();?>
</td>
                        <?php }?>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['nonBPTests']->value, 'nbpt');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['nbpt']->value) {
?>
                            <td><?php echo $_smarty_tpl->tpl_vars['item']->value->getByRecordAndVitalTestId($_smarty_tpl->tpl_vars['vital']->value->getId(),$_smarty_tpl->tpl_vars['nbpt']->value->getId())->getTestResult();?>
</td>
                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        <td><?php echo $_smarty_tpl->tpl_vars['vital']->value->calculateBMI();?>
</td>
                                            </tr>
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </tbody>
         </table> 
     </div>    
        
    
    <?php if (count($_smarty_tpl->tpl_vars['vitals']->value) == 0) {?>
        <div class="emptyListMessage"><?php echo \Neptune\MessageResources::i18n("patientVitalForm.empty.list.message");?>
</div>
    <?php }?>
</div>


<?php
}
}
/* {/block 'content'} */
}
