<?php
/* Smarty version 3.1.34-dev-7, created on 2021-04-15 13:18:52
  from '/var/www/oecs/src/smarty/templates/utility/about.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_60783d3c533e41_38651164',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '63e4508df214dbcda11519864bb20d44581543ce' => 
    array (
      0 => '/var/www/oecs/src/smarty/templates/utility/about.tpl',
      1 => 1618492729,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60783d3c533e41_38651164 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>



<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_46163993560783d3c530e44_31531066', 'styles');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_97321318760783d3c5325d3_67441862', 'dataTable');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_142823377860783d3c533024_12625808', 'content');
?>



<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "base/body.tpl");
}
/* {block 'styles'} */
class Block_46163993560783d3c530e44_31531066 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'styles' => 
  array (
    0 => 'Block_46163993560783d3c530e44_31531066',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    
        .titleText {
            font-weight: 600;
            color: #464646;
            font-size: 1.6rem;
            font-family:'Poppins', sans-serif;
        }
        
        .bodyText {
            text-align: justify;
            color: #555555;
            margin-right: 10px;
        }
    
<?php
}
}
/* {/block 'styles'} */
/* {block 'dataTable'} */
class Block_97321318760783d3c5325d3_67441862 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'dataTable' => 
  array (
    0 => 'Block_97321318760783d3c5325d3_67441862',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    
        
    
<?php
}
}
/* {/block 'dataTable'} */
/* {block 'content'} */
class Block_142823377860783d3c533024_12625808 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_142823377860783d3c533024_12625808',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    
        <p class="titleText">
           About OECS PEHR 
        </p>
        <p class="bodyText">
            This web-based Patient-owned Electronic Health Record (PEHR) platform was developed under an initiative by the Organization of Eastern Caribbean States (OECS).<br/>
            The software facilitates usage by persons with diabetes in the OECS Member States. <br/>
            The design and implementation of the OECS PEHR platform focus on the digitization of key processes to support chronic disease management. 
        </p>
    
<?php
}
}
/* {/block 'content'} */
}
