<?php
/* Smarty version 3.1.34-dev-7, created on 2021-03-15 20:05:45
  from '/var/www/oecs/src/smarty/templates/clinical/foodGroup.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_604fbe1902b5d6_81887368',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e759248691b26a1c805acdaa1df5ad7dc5ba9870' => 
    array (
      0 => '/var/www/oecs/src/smarty/templates/clinical/foodGroup.tpl',
      1 => 1615048519,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_604fbe1902b5d6_81887368 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>



<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1222378066604fbe190154c0_12209343', 'styles');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1283582313604fbe19015f42_70183088', 'jquery');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_2089531457604fbe19017120_58822084', 'dataTable');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1075100711604fbe19017817_30074731', 'content');
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "base/body.tpl");
}
/* {block 'styles'} */
class Block_1222378066604fbe190154c0_12209343 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'styles' => 
  array (
    0 => 'Block_1222378066604fbe190154c0_12209343',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    
        
        .modalHeader{
            background-color:#ffc42c; 
            color:#464646; 
            font-size:1.0rem; 
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
            background: #333333;
            color: #FFFFFF;
            line-height: 25px;
            position: absolute;
            font-family: 'Poppins', sans-serif;
            font-size:0.9rem;
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
        
        /*.inputfile-6 + label span {
            width: 150px !important;
            min-height: 1em;
            display: inline-block;
            text-overflow: ellipsis;
            white-space: nowrap;
            overflow: hidden;
            vertical-align: top;
        }*/
        
        .inputfile + label {
            max-width: 100%;
            font-size: 0.9rem;
            font-weight: 700;
            text-overflow: ellipsis;
            white-space: nowrap;
            cursor: pointer;
            display: inline-block;
            overflow: hidden;
            padding: 0px;
        }
    
<?php
}
}
/* {/block 'styles'} */
/* {block 'jquery'} */
class Block_1283582313604fbe19015f42_70183088 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'jquery' => 
  array (
    0 => 'Block_1283582313604fbe19015f42_70183088',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    
        
        var smallScreen = window.matchMedia("(max-width: 40.0625em)");
        var chgModalWidth = (smallScreen.matches) ? "98%" : "400px";
    
        $("div.table-toolbar").html("<?php echo \Neptune\MessageResources::i18n("foodGroupForm.recorded.list");?>
").css({
            "margin-left" : "26px",
            "font-family": "'Poppins', sans-serif",
            "font-size" : "1.2rem",
            "font-weight" : 500,
            "color": "#464646"
        });
        
        lightbox.option({
            'resizeDuration': 400,
            'wrapAround': true
        });
        
        /*********************************
         Form submit file validation
        **********************************/
        $("form#foodGroupUploadForm").submit( function(e) {
        
            $(this).find("button[type='submit']").css("display", "none");
            $(this).find(".wait_tip").css("display", "inline-block");
            
            var ficheros = $("#foodGroupFile")[0].files;
            for (var i = 0; i < ficheros.length; i++) {
                var fichero = ficheros[i];

                // Check the file type and size.
                if (!fichero.type.match('image/jpeg') && !fichero.type.match('image/png') && !fichero.type.match('image/heic')) { // && !fichero.type.match('application/pdf') 
                    e.preventDefault();
                    $(this).find("button[type='submit']").css("display", "inline-block");
                    $(this).find(".wait_tip").css("display", "none");

                    $(this).find("div.err").html(fichero.name+" is not of type jpg or png");
                    return false;
                } else if (fichero.size > 1048576) {
                    e.preventDefault();
                    $(this).find("button[type='submit']").css("display", "inline-block");
                    $(this).find(".wait_tip").css("display", "none");

                    $(this).find("div.err").html("The file size: "+Math.round((fichero.size/(1048576)), 2)+" MB exceeds 1 MB");

                    return false;
                }
            }
            $(this).submit();
        });
        
        
        /****************************************
         Functionality for file upload box
        *****************************************/
        $(".inputfile").change(function(e){
           
            var label = $(this).next("label");
            var labelVal = label.text();

            var fileName = '';
         
            if(this.files && this.files.length > 1 ) {
                var placeholder = $(this).attr('data-multiple-caption');
                fileName = placeholder.replace( "{count}", this.files.length );
            } else {
                fileName = e.target.value.split( '\\' ).pop();
            }

            if( fileName.length > 0) {
                label.find('span').html(fileName);
            } else {
                label.text(labelVal);
            }
        });
        
        /******************************
         Show modal file upload form
        *******************************/
        $(".imageUpload").click(function(e){
            var foodGroupId = $(this).attr("data-id");
            var foodGroupName = $(this).attr("data-name");
            
            $('div#basic-modal-content').find("#foodGroupId").val(foodGroupId);
            $('div#basic-modal-content').find("div.modalHeader").html("<span style='font-variant:normal;font-weight:normal;'>Upload image for:</span>&nbsp;" + foodGroupName);
            
            $.modal($('div#basic-modal-content'), {
            close:true,
            containerCss: {'width':chgModalWidth, 'height':'250px'},
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
        
    
<?php
}
}
/* {/block 'jquery'} */
/* {block 'dataTable'} */
class Block_2089531457604fbe19017120_58822084 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'dataTable' => 
  array (
    0 => 'Block_2089531457604fbe19017120_58822084',
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
class Block_1075100711604fbe19017817_30074731 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_1075100711604fbe19017817_30074731',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    
    <?php echo $_smarty_tpl->tpl_vars['msg']->value;?>

    
    <div class="listTableCaption_simpleTable" style="font-variant:normal;font-weight: 500;margin-top:2px;margin-bottom:2px;color:#414042;font-family:'Poppins', sans-serif;font-size:1.3rem;">
        <?php echo \Neptune\MessageResources::i18n("foodGroupForm.legend");?>

    </div>
    <div style="margin-left:15px;margin-top:2px;">
        <form data-abide name="foodGroupForm" id="foodGroupForm" action="<?php echo $_smarty_tpl->tpl_vars['actionPage']->value;?>
" method="POST"  autocomplete="off">


                <input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['foodGroup']->value->getId();?>
"/>
                <div class="row">
                    <div class="medium-4 end columns">
                        <label><span class="required"><?php echo \Neptune\MessageResources::i18n("foodGroupForm.name");?>
</span>
                            <input tabindex="1" autofocus maxlength="40" type="text" id="name" name="name" value="<?php echo $_smarty_tpl->tpl_vars['foodGroup']->value->getName();?>
" placeholder="" required>
                        </label>
                    </div>
                </div>
                
                <div class="row">
                    <div class="medium-4 end columns" style="padding-top:8px;">
                        <a href="/food/group" tabindex="3" class="reset"><?php echo \Neptune\MessageResources::i18n("link.reset");?>
</a>&nbsp;
                        <?php echo \Neptune\HtmlElementTag::submitBtn(2);?>

                    </div>
                    <?php if ($_smarty_tpl->tpl_vars['foodGroup']->value->getId() != '') {?>
                        <div class="medium-4 end columns" style="padding-top:8px;">
                            <?php echo \Neptune\MessageResources::i18n("checkbox.confirm");?>
&nbsp;<input tabindex="4" id="confirmDelete" type="checkbox"/>
                            <?php echo \Neptune\HtmlElementTag::deleteBtn(5,"/food/group/delete/".((string)$_smarty_tpl->tpl_vars['foodGroup']->value->getId()));?>

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
                <th><?php echo \Neptune\MessageResources::i18n("foodGroupForm.name");?>
</th> 
                <th><?php echo \Neptune\MessageResources::i18n("foodGroupForm.image.file");?>
</th> 
                <th width="10%">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['list']->value, 'fg');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['fg']->value) {
?> 
                <tr>                           
                    <td><?php echo $_smarty_tpl->tpl_vars['fg']->value->getName();?>
</td> 
                    <td>
                        <a href="#" class="imageUpload" data-id="<?php echo $_smarty_tpl->tpl_vars['fg']->value->getId();?>
" data-name="<?php echo $_smarty_tpl->tpl_vars['fg']->value->getName();?>
" onclick="return false;" title="Upload image associated to the food group">
                            <i class="fas fa-file-upload" style="font-size:1.4rem;color:#93c83e;"></i>
                        </a>
                        <?php if (trim($_smarty_tpl->tpl_vars['fg']->value->getImageName()) != '') {?>
                            &nbsp;
                            <a href="/utility/imageConvert.php?id=<?php echo $_smarty_tpl->tpl_vars['fg']->value->getId();?>
" style="color:#109cca;" data-lightbox="foodGroup" data-title="<?php echo $_smarty_tpl->tpl_vars['fg']->value->getOriginalImageName();?>
">
                                <?php echo $_smarty_tpl->tpl_vars['fg']->value->getOriginalImageName();?>

                            </a>
                            &nbsp;
                            <a href="/food/group/image/delete/<?php echo $_smarty_tpl->tpl_vars['fg']->value->getId();?>
" title="delete associated image">
                                <i class="fas fa-trash-alt" style="color:#ff0000;font-size:1.2rem;"></i>
                            </a>
                        <?php }?>
                    </td> 
                    <td>
                        <a class="editRow" title="<?php echo \Neptune\MessageResources::i18n("link.edit");?>
" href="/food/group/edit/<?php echo $_smarty_tpl->tpl_vars['fg']->value->getId();?>
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
        <?php echo \Neptune\MessageResources::i18n("foodGroupForm.empty.list.message");?>

    </div>
<?php }?>

  <!-- modal content for uploading facility emblem -->
    <div id="basic-modal-content" align='center'>
        <a href="#" onclick="return false;" class="close simplemodal-close">X</a>
        <div class='modalHeader' align="center" >Upload Food Group Image</div>                   
        <form data-abide name="foodGroupUploadForm" id="foodGroupUploadForm" action="/food/group/image/upload" method="post" enctype="multipart/form-data">
            <input type="hidden" id="foodGroupId" name="foodGroupId" value=""/>
            <div class="err" align="left" style="padding-left:5px;padding-right:5px;color:#FF0000;font-size:0.9rem;font-family:'Poppins', sans-serif;"></div>
            <div class="row" >
                <div class="row">
                    <div class="medium-12 end columns" style="padding-top: 20px;">
                        <input tabindex="1"  type="file" id="foodGroupFile" name="foodGroupFile"  class='inputfile inputfile-6'/>
                        <label for="foodGroupFile"><span></span> <strong><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg>Select file&hellip;</strong></label>          
                    </div>
                </div>
            </div>
             <div class="row" >
                <div class="medium-12 end columns text-left">
                    <?php echo \Neptune\HtmlElementTag::submitBtn(2,"Upload");?>

                </div>
            </div>
             <div class="row text-left" >
                <div class="medium-12 end columns" style="font-weight:normal;color:#777777;">
                    <i>*<?php echo \Neptune\MessageResources::i18n("foodGroup.image.sizeTypeWarning");?>
</i>
                </div>
            </div>
        </form>			
    </div>
<br/><br/>



<?php
}
}
/* {/block 'content'} */
}
