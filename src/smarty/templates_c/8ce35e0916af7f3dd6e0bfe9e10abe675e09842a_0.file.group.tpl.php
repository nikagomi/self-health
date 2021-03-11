<?php
/* Smarty version 3.1.34-dev-7, created on 2021-03-11 19:46:09
  from '/var/www/oecs/src/smarty/templates/security/group.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_604a7381ee8aa3_79805539',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8ce35e0916af7f3dd6e0bfe9e10abe675e09842a' => 
    array (
      0 => '/var/www/oecs/src/smarty/templates/security/group.tpl',
      1 => 1615491966,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_604a7381ee8aa3_79805539 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1726775353604a7381ece9c2_56320492', 'jquery');
?>



<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1211632361604a7381ed03b5_45395970', 'styles');
?>



<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1088813955604a7381ed0c86_08514203', 'dataTable');
?>



<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1868948345604a7381ed13e6_27979900', 'content');
$_smarty_tpl->inheritance->endChild($_smarty_tpl, "base/body.tpl");
}
/* {block 'jquery'} */
class Block_1726775353604a7381ece9c2_56320492 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'jquery' => 
  array (
    0 => 'Block_1726775353604a7381ece9c2_56320492',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    
        
        $("div.table-toolbar").html("<?php echo \Neptune\MessageResources::i18n("userGroupForm.recorded.list");?>
").css({
            "margin-left" : "26px",
            "font-family": "'Poppins', sans-serif",
            "font-size" : "1.2rem",
            "font-weight" : 500,
            "color": "#464646"
        });
        
        $(function(){
            $(".hotspot").tipTip({maxWidth: "200px", edgeOffset: 3, defaultPosition: "top", delay: 200, fadeOut: 400});
            $('input[name="perm[]"]').click(function(){
                if( $('input[name="perm[]"]:checked').length > 0){
                    $("div#err").html("");
                }else{
                    $("div#err").html("At least one permission must be selected");
                }
            });
        });

        $("#selectAll").click(function(){
            if($(this).is(":checked")){
                $("input[name='perm[]']").each(function(e){
                    $(this).prop('checked',true);
                });
                if( $('input[name="perm[]"]:checked').length > 0){
                    $("div#err").html("");
                }
            }else{
                $("input[name='perm[]']").each(function(e){
                    $(this).prop('checked',false);
                });
                if( $('input[name="perm[]"]:checked').length == 0){
                    $("div#err").html("At least one permission must be selected");
                }
            }
        });
        
        $("#groupForm").submit(function(e){
            if( $('input[name="perm[]"]:checked').length == 0){
                e.preventDefault();
                $("div#err").html("At least one permission must be selected");
            }else{
                $("div#err").html("");
            }
        });
    
<?php
}
}
/* {/block 'jquery'} */
/* {block 'styles'} */
class Block_1211632361604a7381ed03b5_45395970 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'styles' => 
  array (
    0 => 'Block_1211632361604a7381ed03b5_45395970',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    
        .block{
            margin-left: 25px;
        }
        
        .block li{
            padding: 0px;
        }
        
        li > label {
            color: #777777 !important;
        }
    
<?php
}
}
/* {/block 'styles'} */
/* {block 'dataTable'} */
class Block_1088813955604a7381ed0c86_08514203 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'dataTable' => 
  array (
    0 => 'Block_1088813955604a7381ed0c86_08514203',
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
class Block_1868948345604a7381ed13e6_27979900 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_1868948345604a7381ed13e6_27979900',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>



<?php echo $_smarty_tpl->tpl_vars['msg']->value;?>

    <div class="listTableCaption_simpleTable" style="font-variant:normal;font-weight: 500;margin-top:2px;margin-bottom:2px;color:#414042;font-family:'Poppins', sans-serif;font-size:1.3rem;">
        <?php echo \Neptune\MessageResources::i18n("userGroupForm.legend");?>

    </div>
    <div style="margin-left:15px;margin-top:2px;">
        <form data-abide name="groupForm" id="groupForm" action="<?php echo $_smarty_tpl->tpl_vars['actionPage']->value;?>
" method="POST" autocomplete="off">

            <input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['group']->value->getId();?>
"/>
           

            <div class="row">
                <div class="medium-6 large-4 end columns">
                    <label><span class="required"><?php echo \Neptune\MessageResources::i18n("userGroupForm.name");?>
</span>
                        <input type="text" name="name" id="name" value="<?php echo $_smarty_tpl->tpl_vars['group']->value->getName();?>
" required/>
                    </label>
                </div>

            </div>
            <div class="row">
                <div class="medium-6 large-4 end columns">
                    <label><span class="required"><?php echo \Neptune\MessageResources::i18n("userGroupForm.description");?>
</span>
                        <textarea name="description" rows="2" id="description" style="resize:none;"> <?php echo $_smarty_tpl->tpl_vars['group']->value->getDescription();?>
 </textarea>
                    </label>
                </div>
            </div>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['categories']->value, 'ctg');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['ctg']->value) {
?>
                <?php $_smarty_tpl->_assignInScope('permisos', $_smarty_tpl->tpl_vars['prm']->value->getByCategoryIdForFacility($_smarty_tpl->tpl_vars['facilityPerms']->value,$_smarty_tpl->tpl_vars['ctg']->value->getId()) ,true);?>
                <?php if (count($_smarty_tpl->tpl_vars['permisos']->value) > 0) {?>
                    <div class="row">
                        <div class="medium-12 columns">
                            <span class="permBlock">
                               <?php echo \Neptune\MessageResources::i18n($_smarty_tpl->tpl_vars['ctg']->value->getMessageResource());?>

                            </span>
                        </div>
                    </div>
                    <ul class="large-block-grid-3 medium-block-grid-2 small-block-grid-1 block"> 
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['permisos']->value, 'perm');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['perm']->value) {
?>
                            <li>
                                <label>
                                    <input type="checkbox" name="perm[]" value="<?php echo $_smarty_tpl->tpl_vars['perm']->value->getId();?>
" <?php if (in_array($_smarty_tpl->tpl_vars['perm']->value->getId(),$_smarty_tpl->tpl_vars['selectedPerms']->value)) {?> checked="checked" <?php }?>/>
                                    <?php echo \Neptune\MessageResources::i18n($_smarty_tpl->tpl_vars['perm']->value->getPermTextKey());?>

                                    <?php if ($_smarty_tpl->tpl_vars['perm']->value->getComments() != '') {?>
                                        <a href="#" class="hintanchorRow" onclick="return false;" onMouseover='showhint("<?php echo \Neptune\MessageResources::i18n($_smarty_tpl->tpl_vars['perm']->value->getComments());?>
", this, event, "180px")'>&nbsp;</a>
                                    <?php }?>
                                </label> 
                            </li>
                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    </ul>
                <?php }?>
            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>       
            <div class="row">
                <div class="medium-12 columns">
                  <hr width="100%" size="2" color="#D0E0F0" style="margin:0px;"/>
                </div>
            </div>

            <div class="row">
                <div class="medium-3 end columns selectAll">
                    <label><input type="checkbox" id="selectAll"/><span class="selectAll"><?php echo \Neptune\MessageResources::i18n("link.select.all");?>
</span></label>
                </div>
            </div>
            <div class="row">
                <div class="medium-4 end columns">
                    <a href="/security/group" class="reset"><?php echo \Neptune\MessageResources::i18n("link.reset");?>
</a>&nbsp;
                    <?php echo \Neptune\HtmlElementTag::submitBtn('');?>

                </div>
                <?php if ($_smarty_tpl->tpl_vars['group']->value->getId() != '') {?>
                    <div class="medium-4 end columns">
                        Confirm&nbsp;<input id="confirmDelete" type="checkbox"/>
                        <?php echo \Neptune\HtmlElementTag::deleteBtn('',"/security/group/delete/".((string)$_smarty_tpl->tpl_vars['group']->value->getId()));?>

                    </div>
                <?php }?>
            </div> 
            <div class="row">
                <div class="medium-8 end columns">
                   <div id="err" class="error"></div>
               </div>
           </div>
    
        </form>         
    </div>

    <?php if (count($_smarty_tpl->tpl_vars['list']->value) > 0) {?>
  
     <table align="left" id="listTable" class="displayTable" width="98%" cellspacing="0">
        <thead>
           <tr>
               <th class="all"><?php echo \Neptune\MessageResources::i18n("userGroupForm.name");?>
</th> 
               <th class="all"><?php echo \Neptune\MessageResources::i18n("userGroupForm.description");?>
</th>
               <th class="all" width="15%">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
          <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['list']->value, 'grp');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['grp']->value) {
?> 
               <tr>                           
                   <td><?php echo $_smarty_tpl->tpl_vars['grp']->value->getName();?>
</td> 
                   <td><span class="hotspot" title="<?php echo $_smarty_tpl->tpl_vars['grp']->value->getDescription();?>
"><?php echo $_smarty_tpl->tpl_vars['html']->value->truncateString($_smarty_tpl->tpl_vars['grp']->value->getDescription(),80);?>
</span></td>
                   <td>
                        <?php if ($_smarty_tpl->tpl_vars['grp']->value->getCreatedAtFacilityId() == $_SESSION['facilityId']) {?>
                            <a title="<?php echo \Neptune\MessageResources::i18n("link.edit");?>
" class="editRow" href="/security/group/edit/<?php echo $_smarty_tpl->tpl_vars['grp']->value->getId();?>
">
                                <i class='fas fa-edit' style='font-size:1.5rem;color:#008cba;'></i>
                            </a>
                        <?php }?>
                   </td>
                </tr>
           <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </tbody>
    </table> 
    <?php } else { ?>
     <div class="emptyListMessage"><?php echo \Neptune\MessageResources::i18n("userGroupForm.empty.list.message");?>
</div>
    <?php }?>


<?php
}
}
/* {/block 'content'} */
}
