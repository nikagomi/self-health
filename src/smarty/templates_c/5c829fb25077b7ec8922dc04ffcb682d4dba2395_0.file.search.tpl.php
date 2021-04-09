<?php
/* Smarty version 3.1.34-dev-7, created on 2021-04-09 21:17:58
  from '/var/www/oecs/src/smarty/templates/patient/search.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_6070c4868f5c81_57443944',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5c829fb25077b7ec8922dc04ffcb682d4dba2395' => 
    array (
      0 => '/var/www/oecs/src/smarty/templates/patient/search.tpl',
      1 => 1617043268,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6070c4868f5c81_57443944 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>




<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_15246053256070c4868cbb52_18135090', 'styles');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_13490926616070c4868cf416_92802402', 'jquery');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1738192656070c4868d1335_63909815', 'dataTable');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_19301594776070c4868d2bc7_64298198', 'content');
?>



<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1523023326070c4868f4d34_75995255', "foundation");
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "base/body.tpl");
}
/* {block 'styles'} */
class Block_15246053256070c4868cbb52_18135090 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'styles' => 
  array (
    0 => 'Block_15246053256070c4868cbb52_18135090',
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
/* {block 'jquery'} */
class Block_13490926616070c4868cf416_92802402 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'jquery' => 
  array (
    0 => 'Block_13490926616070c4868cf416_92802402',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    
        $("form").find("select").chosen();
        $("span.hotspot").tipTip({maxWidth: "200px", edgeOffset: 3, defaultPosition: "top", delay: 200, fadeOut: 400});
        
        
        $(function(){
            $(".hotspot").tipTip({maxWidth: "400px", edgeOffset: 3, defaultPosition: "top", delay: 200, fadeOut: 400});
        });
        
        $("div.table-toolbar").html("Search Results").css({
            "margin-left" : "17px",
            "font-family": "'Poppins', sans-serif",
            "font-size" : "1.2rem",
            "font-weight" : 500,
            "color": "#464646"
        });
    
<?php
}
}
/* {/block 'jquery'} */
/* {block 'dataTable'} */
class Block_1738192656070c4868d1335_63909815 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'dataTable' => 
  array (
    0 => 'Block_1738192656070c4868d1335_63909815',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    
        "paging":true,
        "dom": "<'row'<'small-12 medium-4 columns table-toolbar'><'small-12 medium-7 columns text-right'f>>"+
            "t"+
            "<'row'<'small-12 medium-6 columns'i><'small-12 medium-6 columns'p>>"
    
<?php
}
}
/* {/block 'dataTable'} */
/* {block 'content'} */
class Block_19301594776070c4868d2bc7_64298198 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_19301594776070c4868d2bc7_64298198',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/var/www/oecs/vendor/smarty/smarty/libs/plugins/function.html_options.php','function'=>'smarty_function_html_options',),1=>array('file'=>'/var/www/oecs/vendor/smarty/smarty/libs/plugins/modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
?>


    
<?php echo $_smarty_tpl->tpl_vars['msg']->value;?>
 
<div class="row">
    <div class="medium-12 columns end">
        <form data-abide name="searchForm" id="searchForm" action="<?php echo $_smarty_tpl->tpl_vars['actionPage']->value;?>
" method="POST" autocomplete="off">
            <div class="listTableCaption_simpleTable" style="font-variant:normal;font-weight: 500;margin-top:2px;margin-bottom:2px;color:#414042;font-family:'Poppins', sans-serif;font-size:1.3rem;">
                Patient Search&nbsp;<small style="font-size:12px;margin-left:15px;color:#003399;">[<?php echo \Neptune\PropertyService::getProperty("maximum.returned.search.results","100");?>
 results max] </small>
            </div>
                <div class="row">
                    <div class="medium-4 columns">
                        <label><span class="required">First name</span><small class="error">required</small>
                            <input tabindex="1" type="text" id="firstName" name="firstName" value="<?php echo $_smarty_tpl->tpl_vars['firstName']->value;?>
" required />
                        </label>
                    </div>
                
                    <div class="medium-4 end columns">
                        <label><span class="required">Last name</span><small class="error">required</small>
                            <input tabindex="2" type="text" id="lastName" name="lastName" value="<?php echo $_smarty_tpl->tpl_vars['lastName']->value;?>
" required/>
                        </label>
                    </div>
                </div>
                 <div class="row">
                    
                    <div class="medium-4 end columns" style="margin-top:3px;">
                        <span class="text-left left">
                            <font color="#888">Sex: </font>&ensp;<font color="#464646"><br>
                                <?php $_smarty_tpl->_assignInScope('tabindex', "2" ,true);?>
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['genders']->value, 'gender');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['gender']->value) {
?>
                                   <input type="radio" tabindex="<?php echo $_smarty_tpl->tpl_vars['tabindex']->value;?>
" id="<?php echo $_smarty_tpl->tpl_vars['gender']->value->getName();?>
" name="genderId" value="<?php echo $_smarty_tpl->tpl_vars['gender']->value->getId();?>
" <?php if ($_smarty_tpl->tpl_vars['gender']->value->getId() == $_smarty_tpl->tpl_vars['genderId']->value) {?> checked <?php }?>/> 
                                   <label style="color:#464646;" for="<?php echo $_smarty_tpl->tpl_vars['gender']->value->getName();?>
"><?php echo $_smarty_tpl->tpl_vars['gender']->value->getName();?>
</label>&nbsp;
                                   <?php $_smarty_tpl->_assignInScope('tabindex', ((string)($_smarty_tpl->tpl_vars['tabindex']->value+1)) ,true);?>
                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                            </font>
                        </span>
                    </div>
                   
                    <div class="medium-4 end columns" style="margin-top:3px;">
                        <label>
                            <span style="color:#777;">Age range (yrs): <small class="error" id="ageRangeError"></small></span>&ensp;<br>
                            <input style="display:inline-block;float:left;margin-right:16px;" tabindex="<?php echo $_smarty_tpl->tpl_vars['tabindex']->value;?>
" data-abide-validator="ageRangeValidator" type="text" class="shorter" maxlength="3" pattern="number" id="aStart" name="aStart" value="<?php echo $_smarty_tpl->tpl_vars['aStart']->value;?>
" placeholder=""/> 
                            <?php $_smarty_tpl->_assignInScope('tabindex', ((string)($_smarty_tpl->tpl_vars['tabindex']->value+1)) ,true);?>
                            <span style="display:inline-block;float:left;margin-right:16px;"> - </span>
                            <input style="display:inline-block;float:left;" tabindex="<?php echo $_smarty_tpl->tpl_vars['tabindex']->value;?>
" data-abide-validator="ageRangeValidator" type="text" class="shorter" maxlength="3" pattern="number" id="aEnd" name="aEnd" value="<?php echo $_smarty_tpl->tpl_vars['aEnd']->value;?>
" placeholder=""/> 
                            <?php $_smarty_tpl->_assignInScope('tabindex', ((string)($_smarty_tpl->tpl_vars['tabindex']->value+1)) ,true);?>
                        </label>
                    </div>
                     <div class="medium-4 end columns">
                        <label><span class="">Country:</span>
                            <select name="countryId" id="countryId" style="max-width:80%;" tabindex="<?php echo $_smarty_tpl->tpl_vars['tabindex']->value;?>
">
                                <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['countries']->value,'selected'=>$_smarty_tpl->tpl_vars['countryId']->value),$_smarty_tpl);?>

                            </select>
                        </label>
                        <?php $_smarty_tpl->_assignInScope('tabindex', ((string)($_smarty_tpl->tpl_vars['tabindex']->value+1)) ,true);?>
                    </div>
                </div>
                
                <br/>
                <div class="row">
                    <div class="medium-5 end columns" style="">
                        <a href="/patient/search/form" tabindex="<?php echo $_smarty_tpl->tpl_vars['tabindex']->value;?>
" class="reset">Reset</a>
                        <?php $_smarty_tpl->_assignInScope('tabindex', ((string)($_smarty_tpl->tpl_vars['tabindex']->value+1)) ,true);?>
                        <input tabindex="<?php echo $_smarty_tpl->tpl_vars['tabindex']->value;?>
" type="submit" name="submit" class="button" value="Search"/>&nbsp;
                    </div>
                    <div class="medium-7 end columns medium-text-right small-text-left" style="padding-top:7px;">
                        <span style="font-size:0.9rem;color:#555; font-variant:small-caps;">
                            total registered patients: <b><?php echo \Neptune\DbMapperUtility::patientCount();?>
</b>                        </span>
                    </div>
                </div>
         
        </form> 
    </div>
    
</div>
<div class="row">
    <div class="medium-12 end columns">
        <hr width="99%" style="margin:7px 3px;"/>
    </div>
</div>
<?php if (count($_smarty_tpl->tpl_vars['searchResults']->value) > 0) {?>
    <br/>
    <table align="left" id="listTable" class="displayTable" width="95%" cellspacing="0" style="margin-left:5px !important;">
        <thead>
            <tr>
                <th class="all">Last name</th>
                <th class="all">First name</th>
                <th class="all">Sex</th>
                <th class="min-tablet-l">Age</th>
                <th class="all">Date of birth</th>
                <th class="">Contact #</th>
                <th class="">Country</th>
                <th class="none">Email</th>
                <th class="all" width="8%">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
          <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['searchResults']->value, 'patient');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['patient']->value) {
?>

                <tr> 
                    <td><?php echo $_smarty_tpl->tpl_vars['patient']->value->getLastName();?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['patient']->value->getFirstName();?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['patient']->value->getGender()->getName();?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['patient']->value->displayAge();?>
</td>
                    <td><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['patient']->value->getDateOfBirth(),"%b %e, %Y");?>
</td>
                    
                    <td><?php echo $_smarty_tpl->tpl_vars['patient']->value->getContactNumber();?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['patient']->value->getCountry()->getName();?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['patient']->value->getUser()->getEmail();?>
</td>
                    
                    <td>
                        <a class="" style="color:#008cba;" title="<?php echo \Neptune\MessageResources::i18n('link.view');?>
" href="/patient/summary/<?php echo $_smarty_tpl->tpl_vars['patient']->value->getId();?>
">
                            view
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
     <div align="left" class="emptyListMessage">
         <?php if ($_smarty_tpl->tpl_vars['searched']->value) {?> There are no results to display <?php }?>
     </div>
<?php }?>




<?php
}
}
/* {/block 'content'} */
/* {block "foundation"} */
class Block_1523023326070c4868f4d34_75995255 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'foundation' => 
  array (
    0 => 'Block_1523023326070c4868f4d34_75995255',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    
        abide: {
            validators: {
                /*requiredIf: function (el, required, parent) {
                    try{
                        if($.trim($("#registrationNumber").val()) == ''){
                            if($.trim(el.value) == ""){
                                return false;
                            }else{
                                return true;
                            }
                        }else{
                            return true;
                        }
                    }catch(e){
                        return false;
                    }    
                    //other rules can go here
                    return true;
                },*/
                
                ageRangeValidator: function (el, required, parent) {
                    var min = 0;
                    var max = 120;
                    var maxDiff = 30;
                    var aStart = $.trim($("#aStart").val());
                    var aEnd = $.trim($("#aEnd").val());
                    
                    try {
                    
                        if (aStart != '' && aEnd == '' || aStart == '' && aEnd != '') {
                            $("#ageRangeError").text("use both values or none");
                            return false;
                        } else {
                            if ((aStart != '' || aEnd != '') && (!isPositiveInteger(aStart) || !isPositiveInteger(aEnd))) {
                                $("#ageRangeError").text("use positive values");
                                return false;
                            } else {
                                if (aStart != '' && aEnd != '' && (parseInt(aStart) < min || parseInt(aEnd) > max)) {
                                    $("#ageRangeError").text("range limits: "+min+" - "+max);
                                    return false;
                                } else {
                                    if (aStart != '' && aEnd != '' && parseInt(aStart) > parseInt(aEnd)) {
                                        $("#ageRangeError").text("range end > start");
                                        return false;
                                    } else {
                                        if (aStart != '' && aEnd != '' && (parseInt(aEnd) - parseInt(aStart) > maxDiff)) {
                                            $("#ageRangeError").text("range diff <= "+maxDiff);
                                            return false;
                                        }
                                    }
                                }
                            }
                        }
                    } catch (e) {
                        //alert(e.message);
                        return false;
                    }
                    return true;
                }
            }
        } 
    
<?php
}
}
/* {/block "foundation"} */
}
