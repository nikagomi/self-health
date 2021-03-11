<?php
/* Smarty version 3.1.34-dev-7, created on 2021-03-11 15:26:59
  from '/var/www/oecs/src/smarty/templates/self_report/patientLabRecord.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_604a36c3c178f2_91421453',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '30955c524f2e5c70384698b2351f98ca9ee91f0c' => 
    array (
      0 => '/var/www/oecs/src/smarty/templates/self_report/patientLabRecord.tpl',
      1 => 1613865704,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_604a36c3c178f2_91421453 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>



<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1543892861604a36c3c00cc7_45438060', 'jquery');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_614676898604a36c3c02894_11733333', 'styles');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1280698294604a36c3c030d0_51925435', 'dataTable');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_85640863604a36c3c039d1_89244973', 'content');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_325182602604a36c3c17175_30503152', "foundation");
?>


<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "base/body.tpl");
}
/* {block 'jquery'} */
class Block_1543892861604a36c3c00cc7_45438060 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'jquery' => 
  array (
    0 => 'Block_1543892861604a36c3c00cc7_45438060',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    
        
        $(function(){
            $(".hotspot").tipTip({maxWidth: "200px", edgeOffset: 3, defaultPosition: "top", delay: 200, fadeOut: 400});
        });
        
        $("div.table-toolbar").html("<?php echo \Neptune\MessageResources::i18n("patientLabRecordForm.recorded.list");?>
").css({
            "margin-left" : "17px",
            "font-family": "'Poppins', sans-serif",
            "font-size" : "1.2rem",
            "font-weight" : 500,
            "color": "#464646"
        });
        
        $("#testDate").datepicker({
            format:"M dd, yyyy",
            autoclose: true,
            clearBtn: true,
            endDate: '0d'
        }).data("datepicker");
        
       
        
        $("input.lt").click(function() {
            var parLi = $(this).closest("li");
            if ($(this).prop("checked")) {
                parLi.find("input.labResult").prop("disabled", false);
            } else {
                parLi.find("input.labResult").prop("disabled", true).val("");
            }
        });
        
        /*****************************************
         Interrupt form submit to make sure that 
         at least one food group is selected
        ******************************************/
        $("#patientLabRecordForm").submit(function(e){
            if( $('input[name="labTestId[]"]:checked').length == 0){
                e.preventDefault();
                $("div#err").html("At least one lab test must be selected");
            }else{
                $("div#err").html("");
                var errorCnt = 0;
                $('input[name="labTestId[]"]:checked').each(function() {
                    var parLi = $(this).closest("li");
                    if ($.trim(parLi.find("input.labResult").val()) == '') {
                        errorCnt++;
                        parLi.find("input.labResult").addClass("error");
                    } else{
                        parLi.find("input.labResult").removeClass("error");
                    }
                });
                if (errorCnt > 0) {
                    e.preventDefault();
                    return false;
                }
            }
        });
   
    
<?php
}
}
/* {/block 'jquery'} */
/* {block 'styles'} */
class Block_614676898604a36c3c02894_11733333 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'styles' => 
  array (
    0 => 'Block_614676898604a36c3c02894_11733333',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    
        .shorter {
          width: 70px !important;
        }
        .shortest {
          width: 50px !important;
        }
        
    
<?php
}
}
/* {/block 'styles'} */
/* {block 'dataTable'} */
class Block_1280698294604a36c3c030d0_51925435 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'dataTable' => 
  array (
    0 => 'Block_1280698294604a36c3c030d0_51925435',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    
        paging: true,
        "dom": "<'row'<'large-4 medium-4 columns collapsed table-toolbar'><'large-7 medium-7 columns end small-text-left medium-text-right collapsed 'f>>"+
            "t"+
            "<'row'<'small-12 medium-5 end columns'><'small-12 medium-6 end columns'p>>"
    
<?php
}
}
/* {/block 'dataTable'} */
/* {block 'content'} */
class Block_85640863604a36c3c039d1_89244973 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_85640863604a36c3c039d1_89244973',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    
    <?php echo $_smarty_tpl->tpl_vars['msg']->value;?>

    
    <div class="listTableCaption_simpleTable" style="font-variant:normal;font-weight: 500;margin-top:2px;margin-bottom:2px;color:#414042;font-family:'Poppins', sans-serif;font-size:1.3rem;">
        <?php echo \Neptune\MessageResources::i18n("patientLabRecordForm.legend");?>

    </div>
    <div style="margin-left:15px;margin-top:2px;">
        <form data-abide name="patientLabRecordForm" id="patientLabRecordForm" action="<?php echo $_smarty_tpl->tpl_vars['actionPage']->value;?>
" method="POST" autocomplete="off">

                <input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['patientLabRecord']->value->getId();?>
"/>
                <input type="hidden" name="patientId" value="<?php echo $_SESSION['patientId'];?>
"/>
                <div class="row">
                    <div class="medium-3 end columns">
                        <label><span class="required"><?php echo \Neptune\MessageResources::i18n("patientLabRecordForm.testDate");?>
</span>
                            <input tabindex="1" class="medium" type="text" id="testDate" name="testDate" value="<?php echo $_smarty_tpl->tpl_vars['patientLabRecord']->value->displayTestDate();?>
" placeholder="MMM dd, yyyy" required>
                        </label>
                    </div>
                </div>
                <div class="row" style="margin-top:15px;margin-bottom:15px;">
                    <div class="medium-12 end columns">
                        <strong>Please enter relevant lab results (and optional details) of the tests done on the date you indicated above.</strong>
                    </div>
                </div>
                                <div class="row">
                    <div class="medium-12 end columns">
                        <ul class="medium-block-grid-3 small-block-grid-1">
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['labTests']->value, 'lbt');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['lbt']->value) {
?>
                                <li>
                                    <label for="<?php echo $_smarty_tpl->tpl_vars['lbt']->value->getId();?>
" style="display:inline-block;padding-top:8px;font-weight:600;color:#464646;float:left;"><input class="lt" <?php if (\Neptune\DbMapperUtility::isObjectInArray($_smarty_tpl->tpl_vars['lbt']->value,$_smarty_tpl->tpl_vars['associatedLabTests']->value)) {?> checked <?php }?> type="checkbox" id="<?php echo $_smarty_tpl->tpl_vars['lbt']->value->getId();?>
" name="labTestId[]" value="<?php echo $_smarty_tpl->tpl_vars['lbt']->value->getId();?>
" style=""/><?php echo $_smarty_tpl->tpl_vars['lbt']->value->getLabel();?>
</label>
                                    <input class="shorter labResult" <?php if ($_smarty_tpl->tpl_vars['lbt']->value->isNumeric()) {?> maxlength="5" pattern="positive_number"<?php }?>type="text" value="<?php echo $_smarty_tpl->tpl_vars['labTestResult']->value->getResultByRecordAndLabTest($_smarty_tpl->tpl_vars['patientLabRecord']->value->getId(),$_smarty_tpl->tpl_vars['lbt']->value->getId())->getTestResult();?>
" name="result_<?php echo $_smarty_tpl->tpl_vars['lbt']->value->getId();?>
" <?php if (!\Neptune\DbMapperUtility::isObjectInArray($_smarty_tpl->tpl_vars['lbt']->value,$_smarty_tpl->tpl_vars['associatedLabTests']->value)) {?> disabled <?php }?>  style="border-radius:5px;margin-left:6px;float:left;padding-top:4px;color:#000000;font-size:0.9rem;display:inline-block;"/>
                                    <span style="margin-left:6px;float:left;padding-top:8px;color:#444444;font-size:0.85rem;display:inline-block;"><?php echo $_smarty_tpl->tpl_vars['lbt']->value->getUnit();?>
</span>
                                </li>
                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </ul>
                    </div>
                </div>
                            
                            
                <div class="row">
                    <div class="medium-3 end columns" style="padding-top:8px;">
                        <a href="/patient/lab/record/form" tabindex="5" class="reset"><?php echo \Neptune\MessageResources::i18n("link.reset");?>
</a>&nbsp;
                        <?php echo \Neptune\HtmlElementTag::submitBtn(4);?>

                    </div>
                    <?php if ($_smarty_tpl->tpl_vars['patientLabRecord']->value->getId() != '') {?>
                        <div class="medium-3 end columns" style="padding-top:8px;">
                            <?php echo \Neptune\MessageResources::i18n("checkbox.confirm");?>
&nbsp;<input tabindex="6" id="confirmDelete" type="checkbox"/>
                            <?php echo \Neptune\HtmlElementTag::deleteBtn(7,"/patient/lab/record/delete/".((string)$_smarty_tpl->tpl_vars['patientLabRecord']->value->getId()));?>

                        </div>
                    <?php }?>
                </div>
                <div class="row">
                    <div class="medium-9 end columns">
                        <div id="err" class="error"></div>
                    </div>
                </div>
        </form> 
    </div>       

<?php if (count($_smarty_tpl->tpl_vars['list']->value) > 0) {?>
    <br/>
    <table align="left" id="listTable" class="displayTable" width="90%" cellspacing="0">
        <thead>
            <tr>
                <th><?php echo \Neptune\MessageResources::i18n("patientLabRecordForm.testDate");?>
</th>
                <th>Lab Results</th>
                <th width="10%">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['list']->value, 'labr');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['labr']->value) {
?> 
                <tr>  
                    <td><?php echo $_smarty_tpl->tpl_vars['labr']->value->displayTestDate();?>
</td>
                    <td>
                        <span <?php if (count($_smarty_tpl->tpl_vars['labr']->value->getResultListingArray()) > 0) {?> class="hotspot" title="<?php echo join('<br/>',$_smarty_tpl->tpl_vars['labr']->value->getResultListingArray());?>
" <?php }?>>
                            <?php echo count($_smarty_tpl->tpl_vars['labr']->value->getResultListingArray());?>
 results recorded
                        </span>
                    </td>
                    <td>
                        <a class="editRow" title="<?php echo \Neptune\MessageResources::i18n("link.edit");?>
" href="/patient/lab/record/edit/<?php echo $_smarty_tpl->tpl_vars['labr']->value->getId();?>
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
        <?php echo \Neptune\MessageResources::i18n("patientLabRecordForm.empty.list.message");?>

    </div>
<?php }?>
<br/><br/>



<?php
}
}
/* {/block 'content'} */
/* {block "foundation"} */
class Block_325182602604a36c3c17175_30503152 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'foundation' => 
  array (
    0 => 'Block_325182602604a36c3c17175_30503152',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    
        abide : {
            patterns: {
              positive_integer: /^\d+$/,
              positive_number: /^\d*\.{0,1}\d+$/
            }
        }
    
<?php
}
}
/* {/block "foundation"} */
}
