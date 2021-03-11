<?php
/* Smarty version 3.1.34-dev-7, created on 2021-03-11 15:27:37
  from '/var/www/oecs/src/smarty/templates/self_report/patientVitals.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_604a36e903ff51_22218064',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f23c4d263327dd0f1fe2a57c7eb2321877075bb9' => 
    array (
      0 => '/var/www/oecs/src/smarty/templates/self_report/patientVitals.tpl',
      1 => 1614624990,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_604a36e903ff51_22218064 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>



<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_777913113604a36e901a115_82817582', 'jquery');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1536978597604a36e901b7c2_13813695', 'styles');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1800716351604a36e901bf42_22632027', 'dataTable');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_585543436604a36e901c5f6_52478280', 'content');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_2126739679604a36e903f5a9_04090669', "foundation");
?>


<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "base/body.tpl");
}
/* {block 'jquery'} */
class Block_777913113604a36e901a115_82817582 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'jquery' => 
  array (
    0 => 'Block_777913113604a36e901a115_82817582',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    
        var smallScreen = window.matchMedia("(max-width: 40.0625em)");
        var chgPwdWidth = (smallScreen.matches) ? "100%" : "440px";
    
        $("div.table-toolbar").html("<?php echo \Neptune\MessageResources::i18n("patientVitalForm.recorded.list");?>
").css({
            "margin-left" : "26px",
            "font-family": "'Poppins', sans-serif",
            "font-size" : "1.2rem",
            "font-weight" : 500,
            "color": "#464646"
        });
        
        $("#recordDate").datepicker({
            format:"M dd, yyyy",
            autoclose: true,
            clearBtn: true,
            endDate: '0d'
        }).data("datepicker");
        
        var timePickiOptions = {
            tincrease_direction: 'up',
            disable_keyboard_mobile: true
        };
        
        $("#recordTime").timepicki(timePickiOptions);
        $("#patientPosition").chosen();
        
        $("#calc").click(function(e){
            $.modal($('div#register-modal-content'), {
            close:true,
            containerCss: {'width':chgPwdWidth, 'height':'350px'},
                onOpen: function (dialog) {
                    dialog.overlay.fadeIn('slow', function () {
                        dialog.data.hide();
                        dialog.container.fadeIn('slow', function () {
                                dialog.data.slideDown('slow');	 
                        });
                    });
                }
            });
        });
        
        //Unit conversion calculator
        //Temperature conversion
        $("#calcT").click(function(){
            var farenheit = $.trim($("#farenheit").val());
            if (farenheit != '' && $.isNumeric(parseFloat(farenheit)) ) {
                $("#farenheit").removeClass("error");
                var conv = (parseFloat(farenheit) - 32) * 0.556;
                $("#celsius").val(round(conv,1));
            } else {
                $("#farenheit").addClass("error");
                 $("#celsius").val("");
            }
        });
        //Weight conversion
        $("#calcW").click(function(){
            var lbs = $.trim($("#pound").val());
            if (lbs != '' && $.isNumeric(parseFloat(lbs)) ) {
                $("#pound").removeClass("error");
                var conv = parseFloat(lbs) / 2.205;
                $("#kilogram").val(round(conv,1));
            } else {
                $("#pound").addClass("error");
                $("#kilogram").val("");
            }
        });
        //Height conversion
        $("#calcH").click(function(){
            var feet = $.trim($("#feet").val());
            var inches = $.trim($("#inches").val());
            if (feet!= '' && $.isNumeric(parseFloat(feet)) && inches!= '' && $.isNumeric(parseFloat(inches))) {
                $("#feet").removeClass("error");
                $("#inches").removeClass("error");
                var conv = ((parseFloat(feet) * 12) + parseFloat(inches)) * 2.54;
                $("#centimeter").val(round(conv,1));
            } else if (feet == '' || !$.isNumeric(parseFloat(feet)) ) {
                $("#feet").addClass("error");
                $("#centimeter").val("");
            } else if (inches == '' || !$.isNumeric(parseFloat(inches)) ) {
                $("#inches").addClass("error");
                $("#centimeter").val("");
            }
        });
    
<?php
}
}
/* {/block 'jquery'} */
/* {block 'styles'} */
class Block_1536978597604a36e901b7c2_13813695 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'styles' => 
  array (
    0 => 'Block_1536978597604a36e901b7c2_13813695',
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
        
        .modalHeader{
            background-color:#ffc42c; 
            color:#464646; 
            font-size:1.2rem; 
            line-height:1.4rem;
            font-weight:bold;
            height:40px; 
            padding-top:3px;
            font-family:'Poppins', sans-serif;;
            vertical-align: middle;
            font-variant:small-caps;
            border-radius: 0px;
            padding-bottom:3px;
            padding-top:8px;
        }
        
        .close {
            background: #444444;
            color: #FFFFFF;
            line-height: 25px;
            position: absolute;
            right: -12px;
            text-align: center;
            top: -10px;
            width: 24px;
            text-decoration: none;
            font-weight: bold;
            border-radius: 12px;
            -webkit-border-radius: 12px;
            -moz-border-radius: 12px;
            box-shadow: 1px 1px 3px #000000;
            -webkit-box-shadow: 1px 1px 3px #000000;
            -moz-box-shadow: 1px 1px 3px #000000;
            font-family: sans-serif arial helvetica;
        }
    
<?php
}
}
/* {/block 'styles'} */
/* {block 'dataTable'} */
class Block_1800716351604a36e901bf42_22632027 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'dataTable' => 
  array (
    0 => 'Block_1800716351604a36e901bf42_22632027',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    
        paging: true,
        "dom": "<'row'<'large-4 medium-4 columns collapsed table-toolbar'><'large-7 medium-7 columns end small-text-left medium-text-right collapsed 'f>>"+
            "t"+
            "<'row'<'small-12 medium-6 columns'><'small-12 medium-6 columns'p>>"
    
<?php
}
}
/* {/block 'dataTable'} */
/* {block 'content'} */
class Block_585543436604a36e901c5f6_52478280 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_585543436604a36e901c5f6_52478280',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/var/www/oecs/vendor/smarty/smarty/libs/plugins/function.html_options.php','function'=>'smarty_function_html_options',),));
?>

    
    <?php echo $_smarty_tpl->tpl_vars['msg']->value;?>

    
    <div class="listTableCaption_simpleTable" style="font-variant:normal;font-weight: 500;margin-top:2px;margin-bottom:2px;color:#414042;font-family:'Poppins', sans-serif;font-size:1.3rem;">
        <?php echo \Neptune\MessageResources::i18n("patientVitalForm.legend");?>
&ensp;<a href="#" onclick="return false;" id="calc" ><i class="fas fa-calculator" style="font-size:1.2rem;color:#008cba;cursor:pointer;"></i></a>
    </div>
    <div style="margin-left:15px;margin-top:2px;">
        <form data-abide name="patientVitalForm" id="patientVitalForm" action="<?php echo $_smarty_tpl->tpl_vars['actionPage']->value;?>
" method="POST" autocomplete="off">

                <input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['patientVital']->value->getId();?>
"/>
                <input type="hidden" name="patientId" value="<?php echo $_SESSION['patientId'];?>
"/>
                <div class="row">
                    <div class="medium-3 end columns">
                        <label><span class="required"><?php echo \Neptune\MessageResources::i18n("patientVitalForm.recordDate");?>
</span>
                            <input tabindex="1" class="medium" type="text" id="recordDate" name="recordDate" value="<?php echo $_smarty_tpl->tpl_vars['patientVital']->value->displayRecordDate();?>
" placeholder="MMM dd, yyyy" required>
                        </label>
                    </div>
                    <div class="medium-3 end columns">
                        <label><span class="required"><?php echo \Neptune\MessageResources::i18n("patientVitalForm.recordTime");?>
</span>
                            <input tabindex="2" class="short" type="text" id="recordTime" name="recordTime" value="<?php echo $_smarty_tpl->tpl_vars['patientVital']->value->displayRecordTime();?>
" required>
                        </label>
                    </div>
                    <div class="medium-3 end columns">
                        <label><span class="required"><?php echo \Neptune\MessageResources::i18n("patientVitalForm.patientPosition");?>
</span><br/>
                            <select name="patientPosition" id="patientPosition" tabindex="3" style="width:120px !important;" required>
                                <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['patientPositions']->value,'selected'=>$_smarty_tpl->tpl_vars['patientVital']->value->getPatientPosition()),$_smarty_tpl);?>

                            </select>
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="medium-9 end columns">
                        <ul class="medium-block-grid-3 small-block-grid-1">
                            <?php if (count($_smarty_tpl->tpl_vars['bpTests']->value) == 2) {?>
                                <li>
                                    <label><span>Blood Pressure</span><br/>
                                        <input class="shorter vTest" type="text" id="" pattern="positive_integer" maxlength="3" name="vt_<?php echo $_smarty_tpl->tpl_vars['bpTests']->value[0]->getId();?>
" value="<?php echo $_smarty_tpl->tpl_vars['item']->value->getByRecordAndVitalTestId($_smarty_tpl->tpl_vars['patientVital']->value->getId(),$_smarty_tpl->tpl_vars['bpTests']->value[0]->getId())->getTestResult();?>
" style="float:left;"/>
                                        <span style="float:left;padding-top:8px;">&nbsp;/&nbsp;</span>
                                        <input class="shorter vTest" type="text" id="" pattern="positive_integer" maxlength="3" name="vt_<?php echo $_smarty_tpl->tpl_vars['bpTests']->value[1]->getId();?>
" value="<?php echo $_smarty_tpl->tpl_vars['item']->value->getByRecordAndVitalTestId($_smarty_tpl->tpl_vars['patientVital']->value->getId(),$_smarty_tpl->tpl_vars['bpTests']->value[1]->getId())->getTestResult();?>
" style="float:left;"/>
                                        <span style="float:left;padding-top:8px;color:#000000;font-size:0.95rem;">&nbsp;<?php echo $_smarty_tpl->tpl_vars['bpTests']->value[0]->getUnit();?>
</span>
                                    </label>
                                </li>
                            <?php }?>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['nonBPTests']->value, 'nbt');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['nbt']->value) {
?>
                                <li>
                                    <label><span><?php echo $_smarty_tpl->tpl_vars['nbt']->value->getLabel();?>
</span><br/>
                                        <input class="shorter vTest" type="text" id="" pattern="positive_number" maxlength="5" name="vt_<?php echo $_smarty_tpl->tpl_vars['nbt']->value->getId();?>
" 
                                               value="<?php if ($_smarty_tpl->tpl_vars['item']->value->getByRecordAndVitalTestId($_smarty_tpl->tpl_vars['patientVital']->value->getId(),$_smarty_tpl->tpl_vars['nbt']->value->getId())->getTestResult() == '' && $_smarty_tpl->tpl_vars['nbt']->value->isBmiHeightComponent()) {
echo $_smarty_tpl->tpl_vars['patient']->value->getLastRecordedHeight();
} else {
echo $_smarty_tpl->tpl_vars['item']->value->getByRecordAndVitalTestId($_smarty_tpl->tpl_vars['patientVital']->value->getId(),$_smarty_tpl->tpl_vars['nbt']->value->getId())->getTestResult();
}?>" style="float:left;"/>
                                        <span style="float:left;padding-top:8px;color:#000000;font-size:0.95rem;">&nbsp;<?php echo $_smarty_tpl->tpl_vars['nbt']->value->getUnit();?>
</span>
                                    </label>
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
                        <a href="/patient/vitals/form" tabindex="8" class="reset"><?php echo \Neptune\MessageResources::i18n("link.reset");?>
</a>&nbsp;
                        <?php echo \Neptune\HtmlElementTag::submitBtn(7);?>

                    </div>
                    <?php if ($_smarty_tpl->tpl_vars['patientVital']->value->getId() != '') {?>
                        <div class="medium-3 end columns" style="padding-top:8px;">
                            <?php echo \Neptune\MessageResources::i18n("checkbox.confirm");?>
&nbsp;<input tabindex="9" id="confirmDelete" type="checkbox"/>
                            <?php echo \Neptune\HtmlElementTag::deleteBtn(10,"/patient/vitals/delete/".((string)$_smarty_tpl->tpl_vars['patientVital']->value->getId()));?>

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
                <th><?php echo $_smarty_tpl->tpl_vars['nbpt']->value->getLabel();?>
<br/><span style="font-size:0.9rem;font-weight:normal;">[<?php echo $_smarty_tpl->tpl_vars['nbpt']->value->getUnit();?>
]</span></th>
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                <th><?php echo \Neptune\MessageResources::i18n("patientVitalForm.BMI");?>
</th>
                <th width="10%">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['list']->value, 'pvr');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['pvr']->value) {
?> 
                <tr>  
                    <td><?php echo $_smarty_tpl->tpl_vars['pvr']->value->displayRecordDate();?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['pvr']->value->displayRecordTime();?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['pvr']->value->getPatientPosition();?>
</td>
                    <?php if (count($_smarty_tpl->tpl_vars['bpTests']->value) == 2) {?>
                        <td><?php echo $_smarty_tpl->tpl_vars['item']->value->getByRecordAndVitalTestId($_smarty_tpl->tpl_vars['pvr']->value->getId(),$_smarty_tpl->tpl_vars['bpTests']->value[0]->getId())->getTestResult();?>
 / <?php echo $_smarty_tpl->tpl_vars['item']->value->getByRecordAndVitalTestId($_smarty_tpl->tpl_vars['pvr']->value->getId(),$_smarty_tpl->tpl_vars['bpTests']->value[1]->getId())->getTestResult();?>
</td>
                    <?php }?>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['nonBPTests']->value, 'nbpt');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['nbpt']->value) {
?>
                        <td><?php echo $_smarty_tpl->tpl_vars['item']->value->getByRecordAndVitalTestId($_smarty_tpl->tpl_vars['pvr']->value->getId(),$_smarty_tpl->tpl_vars['nbpt']->value->getId())->getTestResult();?>
</td>
                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    <td><?php echo $_smarty_tpl->tpl_vars['pvr']->value->calculateBMI();?>
</td>
                    <td>
                        <a class="editRow" title="<?php echo \Neptune\MessageResources::i18n("link.edit");?>
" href="/patient/vitals/edit/<?php echo $_smarty_tpl->tpl_vars['pvr']->value->getId();?>
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
        <?php echo \Neptune\MessageResources::i18n("patientVitalForm.empty.list.message");?>

    </div>
<?php }?>

<!-- modal content for conversion calculator -->
    <div id="register-modal-content">
        <a href="#" onclick="return false;" class="close simplemodal-close"></a>
        <div class='modalHeader' align="center">Conversion Calculator</div>      
            <br/>
            <div class='row' style="margin: 0px 0px;">
                <div class="small-12 end columns">
                    <label style="font-weight:500;font-family:'Poppins', sans-serif;font-size:1.2rem;"><span class="">&nbsp;Temperature</span></label>
                </div>
            </div>
            <div class='row' style="margin:0px 0px;padding-bottom:8px;">
                <div class="small-6 end columns ">
                    <span style="float:right;padding-top:8px;display:inline-block;">&nbsp;&deg;F</span>
                    <input tabindex="1" type="text" class="shorter" id="farenheit" autocomplete="off" value="" style="float:right;display:inline-block;"/>
                    
                </div>
                <div class="small-2 end columns text-center">
                    <button type="button" style="font-size:1.4rem;font-weight:bold;width:90%;" class="button" id="calcT"> = </button>
                </div>
                <div class="small-4 end columns text-left">
                    <input tabindex="2" type="text" class="shorter" id="celsius" autocomplete="off" value="" style="float:left;display:inline-block;"/>
                    <span style="float:left;padding-top:8px;display:inline-block;">&nbsp;&deg;C</span>
                </div>
            </div>
                        
            <div class='row' style="background-color:#EEEEEE;margin: 0px 0px;">
                <div class="small-12 end columns">
                    <label style="font-weight:500;font-family:'Poppins', sans-serif;font-size:1.2rem;"><span class="">&nbsp;Weight</span></label>
                </div>
            </div>
            <div class='row' style="background-color:#EEEEEE;margin:0px 0px;padding-bottom:8px;">
                <div class="small-6 end columns ">
                    <span style="float:right;padding-top:8px;display:inline-block;">&nbsp;lbs</span>
                    <input tabindex="3" type="text" class="shorter" id="pound" autocomplete="off" value="" style="float:right;display:inline-block;"/>
                    
                </div>
                <div class="small-2 end columns text-center">
                    <button type="button" style="font-size:1.4rem;font-weight:bold;width:90%;" class="button" id="calcW"> = </button>
                </div>
                <div class="small-4 end columns text-left">
                    <input tabindex="4" type="text" class="shorter" id="kilogram" autocomplete="off" value="" style="float:left;display:inline-block;"/>
                    <span style="float:left;padding-top:8px;display:inline-block;">&nbsp;kg</span>
                </div>
            </div>
                        
            <div class='row'>
                <div class="small-12 end columns" style="margin: 0px 0px;">
                    <label style="font-weight:500;font-family:'Poppins', sans-serif;font-size:1.2rem;"><span class="">&ensp;&ensp;Height</span></label>
                </div>
            </div>
            <div class='row' style="margin:0px 0px;padding-bottom:8px;">
                <div class="small-3 end columns ">
                    <input tabindex="5" type="number" class="shortest" id="feet" min="0" max="8" autocomplete="off" value="" style="float:left;display:inline-block;"/>
                    <span style="float:left;padding-top:8px;display:inline-block;">&nbsp;ft.</span>
                </div>
                <div class="small-3 end columns ">
                    <input tabindex="6" type="number" class="shortest" id="inches" min="0" max="11" autocomplete="off" value="0" style="float:left;display:inline-block;"/>
                    <span style="float:left;padding-top:8px;display:inline-block;">&nbsp;in.</span>
                </div>
                <div class="small-2 end columns text-center">
                    <button type="button" style="font-size:1.4rem;font-weight:bold;width:90%;" class="button" id="calcH"> = </button>
                </div>
                <div class="small-4 end columns text-left">
                    <input tabindex="7" type="text" class="shorter" id="centimeter" autocomplete="off" value="" style="float:left;display:inline-block;"/>
                    <span style="float:left;padding-top:8px;display:inline-block;">&nbsp;cm</span>
                </div>
            </div>
    </div>

<br/><br/>



<?php
}
}
/* {/block 'content'} */
/* {block "foundation"} */
class Block_2126739679604a36e903f5a9_04090669 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'foundation' => 
  array (
    0 => 'Block_2126739679604a36e903f5a9_04090669',
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
