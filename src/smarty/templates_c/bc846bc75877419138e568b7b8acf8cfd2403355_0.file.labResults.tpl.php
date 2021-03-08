<?php
/* Smarty version 3.1.34-dev-7, created on 2021-02-23 02:07:02
  from '/var/www/oecs/src/smarty/templates/patient/labResults.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_60346346775e70_99792845',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'bc846bc75877419138e568b7b8acf8cfd2403355' => 
    array (
      0 => '/var/www/oecs/src/smarty/templates/patient/labResults.tpl',
      1 => 1613948270,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60346346775e70_99792845 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>



<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_996695208603463467632b0_46909249', 'styles');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_111265424560346346764317_04359062', 'scripts');
?>



<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_64789324160346346764f94_80029942', 'jquery');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_43428837360346346765ad8_76525035', 'content');
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "base/contentBody.tpl");
}
/* {block 'styles'} */
class Block_996695208603463467632b0_46909249 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'styles' => 
  array (
    0 => 'Block_996695208603463467632b0_46909249',
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
class Block_111265424560346346764317_04359062 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'scripts' => 
  array (
    0 => 'Block_111265424560346346764317_04359062',
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
class Block_64789324160346346764f94_80029942 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'jquery' => 
  array (
    0 => 'Block_64789324160346346764f94_80029942',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    
        
        $(function(){
            //$(".demo").tipTip({maxWidth: "200px", edgeOffset: 3, defaultPosition: "top", delay: 100, fadeOut: 200});
        });
        
        $(".demo").click(function(e) {
            var self = $(this);
            var content = $(this).attr("data-content");
            var date = $(this).attr("data-date");
            self.qtip({
                content:{
                    title: "<b>Lab Test Results for " + date +"</b>",
                    button: true,
                    text: content
                },
                show:{
                    event: 'click',
                    ready: true,
                    solo: true,
                    modal: true
                },
                style: {
                    classes: 'qtip-bootstrap',
                    width: '300px'
                },
                position: {
                    my: "bottom center",
                    at: "top center",
                    viewport: $(window),
                    adjust: {
                        method: 'shift shift',
                    }
                },
                hide:false
            });
        });
        
        /*********************************
         DataTable configuration options
        **********************************/
        $("table#labResultsTable").DataTable({
            responsive: true,
            "searching":false,
            "info": false,
            "paging": false,
            "fixedHeader": false,
            order: [
                [0, 'desc']
            ]
        });
    
<?php
}
}
/* {/block 'jquery'} */
/* {block 'content'} */
class Block_43428837360346346765ad8_76525035 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_43428837360346346765ad8_76525035',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    
    <div>
    <div class="listTableCaption_simpleTable" style="font-variant:normal;font-weight: 500;margin-top:2px;margin-bottom:2px;color:#414042;font-family:'Poppins', sans-serif;font-size:1.3rem;">
        Lab Test Results
    </div>
    <div id="" <?php if (count($_smarty_tpl->tpl_vars['results']->value) == 0) {?> style="display:none;" <?php }?>>
      
         <table align="left" id="labResultsTable" class="displayTable_simpleTable" style="" width="99%" cellspacing="1">
             <thead>
                <tr>
                    <th><?php echo \Neptune\MessageResources::i18n("patientLabRecordForm.testDate");?>
</th>
                    <th>Lab Results</th>
                                   </tr>
             </thead>
            <tbody>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['results']->value, 'result');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['result']->value) {
?> 
                    <tr> 
                       <td><?php echo $_smarty_tpl->tpl_vars['result']->value->displayTestDate();?>
</td>
                        <td>
                            <?php echo count($_smarty_tpl->tpl_vars['result']->value->getResultListingArray());?>
 results recorded
                            <?php if (count($_smarty_tpl->tpl_vars['result']->value->getResultListingArray()) > 0) {?> 
                                &ensp;
                                <span class="demo" data-date="<?php echo $_smarty_tpl->tpl_vars['result']->value->displayTestDate();?>
" data-content="<?php echo join('<br/>',$_smarty_tpl->tpl_vars['result']->value->getResultListingArray());?>
">
                                    <i title="Click/Touch for more information" class="fas fa-info-circle" style="font-size:1rem;color:#008cba;"></i>
                                </span>
                            <?php }?>
                        </td>
                                            </tr>
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </tbody>
         </table> 
     </div>    
        
    
    <?php if (count($_smarty_tpl->tpl_vars['results']->value) == 0) {?>
        <div class="emptyListMessage"><?php echo \Neptune\MessageResources::i18n("patientLabRecordForm.empty.list.message");?>
</div>
    <?php }?>
</div>


<?php
}
}
/* {/block 'content'} */
}
