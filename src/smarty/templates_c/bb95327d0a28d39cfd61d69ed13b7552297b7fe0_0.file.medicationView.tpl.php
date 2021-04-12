<?php
/* Smarty version 3.1.34-dev-7, created on 2021-04-12 16:51:28
  from '/var/www/oecs/src/smarty/templates/patient/medicationView.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_60747a907475a2_72368853',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'bb95327d0a28d39cfd61d69ed13b7552297b7fe0' => 
    array (
      0 => '/var/www/oecs/src/smarty/templates/patient/medicationView.tpl',
      1 => 1618002234,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60747a907475a2_72368853 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>



<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_39639967660747a90736e21_73870268', 'styles');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_173448530060747a907387e2_79195213', 'scripts');
?>



<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_106782438860747a907391c4_46799908', 'jquery');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_77021721560747a90739bf2_46367768', 'content');
?>



<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_95945600460747a90746ce9_65227540', "auxScripts");
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "base/contentBody.tpl");
}
/* {block 'styles'} */
class Block_39639967660747a90736e21_73870268 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'styles' => 
  array (
    0 => 'Block_39639967660747a90736e21_73870268',
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
        
        table#medTable th {
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
class Block_173448530060747a907387e2_79195213 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'scripts' => 
  array (
    0 => 'Block_173448530060747a907387e2_79195213',
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
class Block_106782438860747a907391c4_46799908 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'jquery' => 
  array (
    0 => 'Block_106782438860747a907391c4_46799908',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    
        
        $(function(){
            $(".hotspot").tipTip({maxWidth: "200px", edgeOffset: 3, defaultPosition: "top", delay: 200, fadeOut: 400});
        });
        
        $("div.medDateRangeFilter").css({"color":"#666666","font-size":"0.9rem"}).html('<span style="float:left;display:inline-block;padding-top:8px;">Date Filter:&nbsp;</span><input type="text" class="short" style="float:left;width:110px !important;" id="rmin" /><span style="float:left;display:inline-block;padding-top:8px;">&nbsp;-&nbsp;</span><input type="text" style="float:left;width:110px !important;"  class="short" id="rmax" />');
        $("#rmin, #rmax").datepicker({
            format:"M dd, yyyy", 
            clearBtn:true,
            autoclose: true
        }).on('changeDate', function (ev) {
            medTable.draw();
        }).data('datepicker');
       
    
<?php
}
}
/* {/block 'jquery'} */
/* {block 'content'} */
class Block_77021721560747a90739bf2_46367768 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_77021721560747a90739bf2_46367768',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    
    <div>
    <div class="listTableCaption_simpleTable" style="font-variant:normal;font-weight: 500;margin-top:2px;margin-bottom:2px;color:#414042;font-family:'Poppins', sans-serif;font-size:1.3rem;">
        Medication Record
    </div>
    <div id="" <?php if (count($_smarty_tpl->tpl_vars['medications']->value) == 0) {?> style="display:none;" <?php }?>>
      
        <table align="left" id="medTable" class="displayTable_simpleTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th><?php echo \Neptune\MessageResources::i18n("patientMedicationForm.medicationId");?>
</th> 
                    <th><?php echo \Neptune\MessageResources::i18n("patientMedicationForm.quantityConsumed");?>
</th>
                    <th><?php echo \Neptune\MessageResources::i18n("patientMedicationForm.dateTaken");?>
</th>
                    <th><?php echo \Neptune\MessageResources::i18n("patientMedicationForm.timeTaken");?>
</th>
                    <th><?php echo \Neptune\MessageResources::i18n("patientMedicationForm.comments");?>
</th>
                    <th class="never">&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['medications']->value, 'pmed');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['pmed']->value) {
?> 
                    <tr>                           
                        <td><?php echo $_smarty_tpl->tpl_vars['pmed']->value->getMedication()->getLabel();?>
</td> 
                        <td><?php echo $_smarty_tpl->tpl_vars['pmed']->value->getQuantityAmount();?>
 <?php echo $_smarty_tpl->tpl_vars['pmed']->value->getQuantityTakenUnit()->getLabel();?>
</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['pmed']->value->displayDateTaken();?>
</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['pmed']->value->displayTimeTaken();?>
</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['pmed']->value->getComments();?>
</td>
                        <td><?php echo strtotime($_smarty_tpl->tpl_vars['pmed']->value->getDateTaken());?>
</td>
                    </tr>
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </tbody>
        </table>  
     </div>    
        
    
    <?php if (count($_smarty_tpl->tpl_vars['medications']->value) == 0) {?>
        <div class="emptyListMessage"><?php echo \Neptune\MessageResources::i18n("patientMedicationForm.empty.list.message");?>
</div>
    <?php }?>
</div>


<?php
}
}
/* {/block 'content'} */
/* {block "auxScripts"} */
class Block_95945600460747a90746ce9_65227540 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'auxScripts' => 
  array (
    0 => 'Block_95945600460747a90746ce9_65227540',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    
        $.fn.dataTable.ext.search.push(
            function (settings, data, dataIndex) {
                var min = ($.trim($('#rmin').val()) != '') ? moment($('#rmin').val(), "MMM D, YYYY") : null;
                var max = ($.trim($('#rmax').val()) != '') ? moment($('#rmax').val(), "MMM D, YYYY") : null;
                var startDate = moment(data[2], "MMM D, YYYY");

                if (min == null && min == null) { return true; }
                if (min == null && startDate.isSameOrBefore(max)) { return true;}
                if (max == null && startDate.isSameOrAfter(min)) {return true;}
                if (startDate.isSameOrBefore(max) && startDate.isSameOrAfter(min)) { return true; }
                return false;
            }
        );

        var medTable = $("#medTable").DataTable({
            "paging":false,
            "iDisplayLength": 100,
            responsive: true,
            "dom": "<'row'<'medium-11 columns end text-left medDateRangeFilter'>>"+
                "t"+
                "<'row'<'small-12 medium-7 text-left columns end'p>>",
            order: [
                [0, 'asc'], [2, 'desc']
            ],
            'columnDefs': [
                { 'orderData':[5], 
                  'targets': [2], 
                },
                {
                  'targets': [5],
                  'visible': false,
                  'searchable': false,
                },
                {
                    className: 'control',
                    orderable: false,
                    targets:   '0'
                }
            ]
        });

        /*************  Column header filter  ************/
        sarmsHeaderDataTableColumnFilterMulti(medTable, [0]);

         
    
<?php
}
}
/* {/block "auxScripts"} */
}
