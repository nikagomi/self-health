<?php
/* Smarty version 3.1.34-dev-7, created on 2021-03-08 16:39:57
  from '/var/www/oecs/src/smarty/templates/security/error/unauthorizedAccessPage.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_6046535d696a30_98850464',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f5e6c2a3ccbcf6334e5fef2b4fb81af02275c295' => 
    array (
      0 => '/var/www/oecs/src/smarty/templates/security/error/unauthorizedAccessPage.tpl',
      1 => 1613864083,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6046535d696a30_98850464 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>



<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_18728414136046535d693fc5_70827999', 'styles');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_2962939926046535d6950e9_79453013', 'content');
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "base/body.tpl");
}
/* {block 'styles'} */
class Block_18728414136046535d693fc5_70827999 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'styles' => 
  array (
    0 => 'Block_18728414136046535d693fc5_70827999',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    
        .denied{
            font-style:uppercase;
            font-variant:small-caps;
            color:#DD0000;
            text-align:left;
            padding-top:100px;
            font-size:70px;
            font-weight:bold;
            font-family:Verdana;
        }
        .errorSpan{
            font-weight:bold;
            font-size:1.1rem;
            font-variant:small-caps;
            line-height:28px;
            font-family:Verdana;
        }
    
<?php
}
}
/* {/block 'styles'} */
/* {block 'content'} */
class Block_2962939926046535d6950e9_79453013 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_2962939926046535d6950e9_79453013',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <div class="row">
        <div class="medium-3 columns" >
            <img src="/images/access_denied.png">
        </div>
        
        <div class="medium-8 end columns" >
            <span class="denied">ACCESS DENIED</span><br/>
            <span>
                <?php if ($_smarty_tpl->tpl_vars['errorMessage']->value != '') {?>
                    <?php echo $_smarty_tpl->tpl_vars['errorMessage']->value;?>

                <?php } else { ?>
                    You are on this page because you have tried to access a page / url that you are not authorized to access.
                <?php }?>
            </span>
        </div>
        
    </div>
    
    
<?php
}
}
/* {/block 'content'} */
}
