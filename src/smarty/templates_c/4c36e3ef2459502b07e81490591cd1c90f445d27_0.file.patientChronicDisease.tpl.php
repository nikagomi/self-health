<?php
/* Smarty version 3.1.34-dev-7, created on 2021-04-12 21:33:22
  from '/var/www/oecs/src/smarty/templates/self_report/patientChronicDisease.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_6074bca2501c31_24354125',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4c36e3ef2459502b07e81490591cd1c90f445d27' => 
    array (
      0 => '/var/www/oecs/src/smarty/templates/self_report/patientChronicDisease.tpl',
      1 => 1618263198,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6074bca2501c31_24354125 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>



<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_14623354626074bca24f3137_97242523', 'jquery');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_14331812666074bca24f4103_24117857', 'styles');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_10592464666074bca24f4d55_85706605', 'dataTable');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_20820458436074bca24f5856_49777873', 'content');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_4149085636074bca2501357_80298076', "foundation");
?>



<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "base/body.tpl");
}
/* {block 'jquery'} */
class Block_14623354626074bca24f3137_97242523 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'jquery' => 
  array (
    0 => 'Block_14623354626074bca24f3137_97242523',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    
        var smallScreen = window.matchMedia("(max-width: 40.0625em)");
        var chgPwdWidth = (smallScreen.matches) ? "100%" : "440px";
    
        $("form").find("select").chosen();
        
        $("input.cd").click(function() {
            var parLi = $(this).closest("li");
            if ($(this).prop("checked")) {
                parLi.find("select").prop("disabled", false).trigger("chosen:updated");
            } else {
                parLi.find("select").prop("disabled", true).val("").trigger("chosen:updated");
            }
        });
        
        /*****************************************
         Interrupt form submit to make sure that 
         at least one chronic disease is selected
        ******************************************/
        $("#patientChronicDiseaseForm").submit(function(e){
            if( $('input[name="chronicDiseaseId[]"]:checked').length == 0){
                e.preventDefault();
                $("div#err").html("At least one chronic disease must be selected to proceed");
            }
        });
   
    
<?php
}
}
/* {/block 'jquery'} */
/* {block 'styles'} */
class Block_14331812666074bca24f4103_24117857 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'styles' => 
  array (
    0 => 'Block_14331812666074bca24f4103_24117857',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    
        .shorter {
          width: 90px !important;
        }
        .shortest {
          width: 50px !important;
        }
        
        div#err {
            color #DD0000;
            font-size: 1rem;
            font-family: 'Poppins', sans-serif;
            font-weight:500;
            padding-top:5px;
        }
        
    
<?php
}
}
/* {/block 'styles'} */
/* {block 'dataTable'} */
class Block_10592464666074bca24f4d55_85706605 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'dataTable' => 
  array (
    0 => 'Block_10592464666074bca24f4d55_85706605',
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
class Block_20820458436074bca24f5856_49777873 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_20820458436074bca24f5856_49777873',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/var/www/oecs/vendor/smarty/smarty/libs/plugins/function.html_options.php','function'=>'smarty_function_html_options',),));
?>

    
    <?php echo $_smarty_tpl->tpl_vars['msg']->value;?>

    
    <div class="listTableCaption_simpleTable" style="font-variant:normal;font-weight: 500;margin-top:2px;margin-bottom:2px;color:#414042;font-family:'Poppins', sans-serif;font-size:1.3rem;">
        <?php echo \Neptune\MessageResources::i18n("patientChronicDiseaseForm.legend");?>

    </div><br/>
    <div style="margin-left:15px;margin-top:2px;">
        <form data-abide name="patientChronicDiseaseForm" id="patientChronicDiseaseForm" action="<?php echo $_smarty_tpl->tpl_vars['actionPage']->value;?>
" method="POST" autocomplete="off">

                <input type="hidden" name="patientId" value="<?php echo $_SESSION['patientId'];?>
"/>
                
                <?php $_smarty_tpl->_assignInScope('tabIndex', "1" ,true);?>
                <div class="row">
                    <div class="medium-9 end columns">
                        <ul class="medium-block-grid-3 small-block-grid-2">
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['chronicDiseases']->value, 'cd');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['cd']->value) {
?>
                                <li>
                                    <div>
                                        <label for="<?php echo $_smarty_tpl->tpl_vars['cd']->value->getId();?>
" style="font-size:1.1rem;font-family:'Poppins', sans-serif;font-weight:600;color:#464646;margin-bottom:0px !important;padding-bottom:1px !important;"> 
                                        <input class="cd" <?php if (\Neptune\DbMapperUtility::isObjectInArray($_smarty_tpl->tpl_vars['cd']->value,$_smarty_tpl->tpl_vars['associatedChronicDiseases']->value)) {?> checked <?php }?> type="checkbox" id="<?php echo $_smarty_tpl->tpl_vars['cd']->value->getId();?>
" name="chronicDiseaseId[]" value="<?php echo $_smarty_tpl->tpl_vars['cd']->value->getId();?>
" style=""/>
                                        <?php echo $_smarty_tpl->tpl_vars['cd']->value->getLabel();?>
 </label>
                                       <br/>
                                        <span style="display:inline-block;float:left;font-size:0.85rem;color:#777777;">
                                            Diagnosed since? &ensp;
                                        </span>
                                        <select class="shorter" name="year_<?php echo $_smarty_tpl->tpl_vars['cd']->value->getId();?>
" <?php if (!\Neptune\DbMapperUtility::isObjectInArray($_smarty_tpl->tpl_vars['cd']->value,$_smarty_tpl->tpl_vars['associatedChronicDiseases']->value)) {?> disabled <?php }?> style="display:inline-block;float:left;">
                                            <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['yearIds']->value,'selected'=>$_smarty_tpl->tpl_vars['pcd']->value->getByPatientAndDisease($_SESSION['patientId'],$_smarty_tpl->tpl_vars['cd']->value->getId())->getDiagnosedSinceYear()),$_smarty_tpl);?>

                                        </select>
                                       
                                    </div>
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
                        <?php echo \Neptune\HtmlElementTag::submitBtn(4);?>

                    </div>
                </div>
                <div class="row">
                    <div class="medium-9 end columns">
                        <div id="err" class="error"></div>
                    </div>
                </div>
        </form> 
    </div>       
<br/><br/>



<?php
}
}
/* {/block 'content'} */
/* {block "foundation"} */
class Block_4149085636074bca2501357_80298076 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'foundation' => 
  array (
    0 => 'Block_4149085636074bca2501357_80298076',
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
