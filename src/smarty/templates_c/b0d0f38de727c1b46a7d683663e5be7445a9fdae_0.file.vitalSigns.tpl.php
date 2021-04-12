<?php
/* Smarty version 3.1.34-dev-7, created on 2021-04-12 16:51:32
  from '/var/www/oecs/src/smarty/templates/patient/vitalSigns.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_60747a941081a2_35869195',
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
function content_60747a941081a2_35869195 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>



<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_38146807160747a940f14a9_55682927', 'styles');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_155749944960747a940f2068_32910683', 'scripts');
?>



<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_41796947460747a940f28a6_27128541', 'jquery');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_175462161460747a940f3050_15768649', 'content');
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "base/contentBody.tpl");
}
/* {block 'styles'} */
class Block_38146807160747a940f14a9_55682927 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'styles' => 
  array (
    0 => 'Block_38146807160747a940f14a9_55682927',
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
class Block_155749944960747a940f2068_32910683 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'scripts' => 
  array (
    0 => 'Block_155749944960747a940f2068_32910683',
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
class Block_41796947460747a940f28a6_27128541 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'jquery' => 
  array (
    0 => 'Block_41796947460747a940f28a6_27128541',
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
class Block_175462161460747a940f3050_15768649 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_175462161460747a940f3050_15768649',
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
