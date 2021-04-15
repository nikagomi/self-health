<?php
/* Smarty version 3.1.34-dev-7, created on 2021-04-15 13:10:02
  from '/var/www/oecs/src/smarty/templates/security/error/errorPage.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_60783b2a2ab703_75092364',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ea5203537505ca17cc911b1d5c658d06de481b36' => 
    array (
      0 => '/var/www/oecs/src/smarty/templates/security/error/errorPage.tpl',
      1 => 1612289983,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60783b2a2ab703_75092364 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>



<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_182590269560783b2a2a62d8_81499645', 'styles');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_111347015760783b2a2a7d29_92363439', 'jquery');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_125754046560783b2a2a87e4_84904841', 'content');
$_smarty_tpl->inheritance->endChild($_smarty_tpl, "base/body.tpl");
}
/* {block 'styles'} */
class Block_182590269560783b2a2a62d8_81499645 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'styles' => 
  array (
    0 => 'Block_182590269560783b2a2a62d8_81499645',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    
        .denied{
            text-transform: uppercase;
            font-variant:small-caps;
            color:#DD0000;
            text-align:left;
            padding-top:100px;
            font-size:2.0rem;
            font-weight:bold;
            font-family:Helvetica;
        }
        
    
<?php
}
}
/* {/block 'styles'} */
/* {block 'jquery'} */
class Block_111347015760783b2a2a7d29_92363439 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'jquery' => 
  array (
    0 => 'Block_111347015760783b2a2a7d29_92363439',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    
        $("form#errorDetailForm").on("valid",function(){
            var $div = $('<div>',{class:"overlay"});
                $div.height($(document).height());
                $div.css("padding-top",$(window).height()/2+"px");
                $div.append("<img src='/images/newloader.gif'/><br/><b>Sending Error Details...</b>");
                $div.appendTo("body")
        });
    
<?php
}
}
/* {/block 'jquery'} */
/* {block 'content'} */
class Block_125754046560783b2a2a87e4_84904841 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_125754046560783b2a2a87e4_84904841',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


    <div class="row">
        <div class="medium-12 end columns" >
            <span class="denied">Application Error</span><br/>
        </div>
    </div>
    <div class="row">
        <div class="medium-12 end columns" >
            <span style="font-size:1.2rem;font-variant:normal;line-height:24px;font-family:Verdana;">
                The application has encountered an error.
                
                <br/><br/>
                    <span style="font-size:1.0rem;color:#FF0000;font-family:courier;"> 
                        <?php echo $_smarty_tpl->tpl_vars['msg']->value;?>

                    </span>
                <br/><br/>  
                
                In order for the developers to suitable address this error, please provide the 
                details of what you were trying to do when the error occurred <i><b> (please provide as much detail as possible)</b></i>. 
                <br/><br/>
                Please note that you may:<br/>
                &nbsp;(1)&nbsp;submit the error details or<br/>
                &nbsp;(2)&nbsp;continue to use other aspects of the application via the menu if available.
                <br/><br/>If details for this error have already been submitted, please do not submit it again. 
                <br/>Thank you.
            </span>
        </div>
    </div>
    <div>
        <form data-abide name="errorDetailForm" id="errorDetailForm" action="/process/error/detail" method="POST" autocomplete="off">
            <div class="row">
                <div class="medium-6 end columns" >
                    <label>
                        <span class="required">Details:</span>
                        <textarea name="details" id="details" wrap="physical" cols="30" rows="8" required></textarea>
                    </label>
                </div>
                <div class="medium-6 end columns" >
                    <input type="hidden" name="code" value="<?php echo $_smarty_tpl->tpl_vars['exception']->value->getStatusCode();?>
"/>
                    <input type="hidden" name="line" value="<?php echo $_smarty_tpl->tpl_vars['exception']->value->getLine();?>
"/>
                    <input type="hidden" name="file" value="<?php echo $_smarty_tpl->tpl_vars['exception']->value->getFile();?>
"/>
                    <input type="hidden" name="message" value="<?php echo $_smarty_tpl->tpl_vars['exception']->value->getMessage();?>
"/>
                </div>
            </div>
            <div class="row">
                <div class="medium-6 end columns" >
                    <label>
                        <input type="submit" name="submit" value="Submit" class="button"/>
                    </label>
                </div>
            </div>
        </form>
    </div>
    
    
<?php
}
}
/* {/block 'content'} */
}
