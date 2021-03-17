<?php
/* Smarty version 3.1.34-dev-7, created on 2021-03-17 14:33:06
  from '/var/www/oecs/src/smarty/templates/security/patientUser.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_605213223ec8a6_04355255',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9ba5a7bbc7594c5e3906eb924fb1c747074b6561' => 
    array (
      0 => '/var/www/oecs/src/smarty/templates/security/patientUser.tpl',
      1 => 1615991582,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_605213223ec8a6_04355255 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1622466952605213223db635_19532046', 'jquery');
?>



<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_57476963605213223dc243_08293941', 'styles');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1611355057605213223dcb87_03658129', 'scripts');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_752650487605213223dd317_04475472', 'dataTable');
?>



<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_720647230605213223dda81_54438332', 'content');
?>


<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "base/body.tpl");
}
/* {block 'jquery'} */
class Block_1622466952605213223db635_19532046 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'jquery' => 
  array (
    0 => 'Block_1622466952605213223db635_19532046',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    
        
        $(function(){
            $(".hotspot").tipTip({maxWidth: "400px", edgeOffset: 3, defaultPosition: "top", delay: 200, fadeOut: 400});   
        });
        
        $("div.table-toolbar").html("Manage Patient Users").css({
            "margin-left" : "26px",
            "font-family": "'Poppins', sans-serif",
            "font-size" : "1.2rem",
            "font-weight" : 500,
            "color": "#464646"
        });
        
        /*****************************************************
         Lock a patient user
        ******************************************************/
        $("body").on("click","a.lockUsr",function(e) {
            var id = $(this).attr("data-id");
            var self = $(this);
            var parTr = $(this).closest("tr");
            $.ajax({
                type: "GET",
                url: "/security/patient/user/lock/" + id,
                dataType: "json"
            }).done(function(success) {
                if (success) {
                    parTr.find("td:first").html('<i class="fas fa-lock" style="font-size:1rem;color:#FF0000;" title="Account currently locked"></i>');
                    self.replaceWith('<a href="#" data-id="'+id+'" onclick="return false;" class="unlockUsr" title="Un-lock the user account"><i class="fas fa-lock-open" style="font-size:1.4rem;color:#006423;"></i></a>');
                } else {
                    swal("Update Error", "An error occurred. Could not lock the user account. Please try again later or contact the application HelpDesk", "error");
                }
            })
        });
        
        /*****************************************************
         Un-Lock a patient user
        ******************************************************/
        $("body").on("click","a.unlockUsr",function(e) {
            var id = $(this).attr("data-id");
            var self = $(this);
            var parTr = $(this).closest("tr");
            $.ajax({
                type: "GET",
                url: "/security/patient/user/unlock/" + id,
                dataType: "json"
            }).done(function(success) {
                if (success) {
                    parTr.find("td:first").html('<i class="fas fa-unlock-alt" style="font-size:1rem;color:#006432;" title="Account currently un-locked"></i>');
                    self.replaceWith('<a href="#" data-id="'+id+'" onclick="return false;" class="lockUsr" title="Lock the user account"><i class="fas fa-user-lock" style="font-size:1.4rem;color:orangered;"></i></a>');
                } else {
                    swal("Update Error", "An error occurred. Could not un-lock the user account. Please try again later or contact the application HelpDesk", "error");
                }
            })
        });
        
        /*****************************************************
         Delete a patient user (along with patient)
        ******************************************************/
        /*$("a.deleteUsr").click(function(e) {
            var id = $(this).attr("data-id");
            var self = $(this);
            var parTr = $(this).closest("tr");
            $.ajax({
                type: "GET",
                url: "/security/patient/user/unlock/" + id,
                dataType: "json"
            }).done(function(success) {
                if (success) {
                    parTr.remove();
                } else {
                    swal("Update Error", "An error occurred. Could not delete the user account (and associated patient record). Please try again later or contact the application HelpDesk", "error");
                }
            })
        });*/
        
        /*****************************************************
         Delete a patient user (along with patient)
        ******************************************************/
        $("a.deleteUsr").click(function(){
            var id = $(this).attr("data-id");
            var self = $(this);
            var parTr = $(this).closest("tr");
            
            swal({
                text: 'Are you sure you want to delete this user and the associated patient record?',
                showCancelButton: true,
              })
            .then((value) => {
                return fetch("/security/patient/user/delete/"+id, {method: 'GET'});
            })
            .then(results => {
                return results.json();
            })
            .then(json => {
                if (json.status) {
                   parTr.remove();
                } else {
                    swal("Update Error", "An error occurred. Could not delete the user account (and associated patient record). Please try again later or contact the application HelpDesk", "error");
                }
            });
        });
        
    
<?php
}
}
/* {/block 'jquery'} */
/* {block 'styles'} */
class Block_57476963605213223dc243_08293941 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'styles' => 
  array (
    0 => 'Block_57476963605213223dc243_08293941',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    
        .deleteAcct {
            color: #DD0000;
        }
        
        .createAcct {
            color: #006432;
        }
        
    
<?php
}
}
/* {/block 'styles'} */
/* {block 'scripts'} */
class Block_1611355057605213223dcb87_03658129 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'scripts' => 
  array (
    0 => 'Block_1611355057605213223dcb87_03658129',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    
        function validateEmail(email){
            return /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))$/i.test(email);
        }
    
<?php
}
}
/* {/block 'scripts'} */
/* {block 'dataTable'} */
class Block_752650487605213223dd317_04475472 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'dataTable' => 
  array (
    0 => 'Block_752650487605213223dd317_04475472',
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
class Block_720647230605213223dda81_54438332 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_720647230605213223dda81_54438332',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

 


      
 
        <div id='holder'>
        <?php if (count($_smarty_tpl->tpl_vars['patientUsers']->value) > 0) {?>
            <table align="left" id="listTable" class="displayTable" width="95%" cellspacing="0" style='margin-left:15px !important;'>
                 <thead>
                    <tr height="30" style="">
                        <th class='all'>&nbsp;</th>
                        <th class="all">Last name</th>
                        <th class="all">First name</th> 
                        <th class="tablet-l desktop">Email</th>
                        <th class="all">Patient Name</th>
                        <th class="">Patient Sex</th>
                        <th class="">Patient Age</th>
                        <th class="">Patient Country</th>
                        <th class="">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['patientUsers']->value, 'pUsr');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['pUsr']->value) {
?> 
                        <?php $_smarty_tpl->_assignInScope('patient', $_smarty_tpl->tpl_vars['patient']->value->getByUserId($_smarty_tpl->tpl_vars['pUsr']->value->getId()) ,true);?>
                        <tr>     
                            <td>
                                <?php if ($_smarty_tpl->tpl_vars['pUsr']->value->isLocked()) {?>
                                    <i class="fas fa-lock" style='font-size:1rem;color:#FF0000;' title="Account currently locked"></i>
                                <?php } else { ?>
                                    <i class="fas fa-unlock-alt" style='font-size:1rem;color:#006432;' title="Account currently un-locked"></i>
                                <?php }?>
                            </td>
                            <td><?php echo $_smarty_tpl->tpl_vars['pUsr']->value->getLastName();?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['pUsr']->value->getFirstName();?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['pUsr']->value->getEmail();?>
</td>
                            <td>
                                <?php if (\Authentication\Model\PermissionManager::userHasPermission("SEARCH.PATIENTS",$_SESSION['userId'])) {?>
                                    <a style="color:#008cba;font-weight:400;" href='/patient/summary/<?php echo $_smarty_tpl->tpl_vars['patient']->value->getId();?>
'>
                                        <?php echo $_smarty_tpl->tpl_vars['patient']->value->getLabel();?>

                                    </a>
                                <?php } else { ?>
                                    <?php echo $_smarty_tpl->tpl_vars['patient']->value->getLabel();?>

                                <?php }?>
                            </td> 
                            <td><?php echo $_smarty_tpl->tpl_vars['patient']->value->getGender()->getName();?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['patient']->value->displayAge();?>
</td> 
                            <td><?php echo $_smarty_tpl->tpl_vars['patient']->value->getCountry()->getLabel();?>
</td>
                            <td>
                                <?php if ($_smarty_tpl->tpl_vars['pUsr']->value->isLocked()) {?>
                                    <a href="#" data-id="<?php echo $_smarty_tpl->tpl_vars['pUsr']->value->getId();?>
" onclick="return false;" class="unlockUsr" title="Un-lock the user's account">
                                        <i class="fas fa-lock-open" style="font-size:1.4rem;color:#006423;"></i>
                                    </a>
                                <?php } else { ?>
                                    <a href="#" data-id="<?php echo $_smarty_tpl->tpl_vars['pUsr']->value->getId();?>
" onclick="return false;" class="lockUsr" title="Lock the user's account">
                                        <i class="fas fa-user-lock" style='font-size:1.4rem;color:orangered;'></i>
                                    </a>
                                <?php }?>
                                &ensp;
                                <a href="#" data-id="<?php echo $_smarty_tpl->tpl_vars['pUsr']->value->getId();?>
" onclick="return false;" class="deleteUsr" title="Delete the user's account. The associated patient record will be deleted as well.">
                                    <i class="fas fa-trash-alt" style='font-size:1.4rem;color:#ff0000;'></i>
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
            <div class="emptyListMessage">No patient users are defined. This means that there have not been any registrations.</div>
        <?php }?>
    </div>


<?php
}
}
/* {/block 'content'} */
}
