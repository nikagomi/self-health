{*Author: Randal Neptune*}
{*Project: EduRecord*}

{extends file="base/body.tpl"}

{block name=styles}
    {literal}
        
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
    {/literal}
{/block}

{block name=jquery}
    {literal}
        
        var smallScreen = window.matchMedia("(max-width: 40.0625em)");
        var chgModalWidth = (smallScreen.matches) ? "98%" : "400px";
    
        $("div.table-toolbar").html("{/literal}{Messages::i18n("foodGroupForm.recorded.list")}{literal}").css({
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
        
    {/literal}
{/block}

{block name=dataTable}
    {literal}
        paging: true,
        "dom": "<'row'<'large-4 medium-4 columns collapsed table-toolbar'><'large-7 medium-7 columns end small-text-left medium-text-right collapsed 'f>>"+
            "t"+
            "<'row'<'small-12 medium-6 columns'><'small-12 medium-6 columns'p>>"
    {/literal}
{/block}

{block name=content}
    {nocache}
    {$msg}
    
    <div class="listTableCaption_simpleTable" style="font-variant:normal;font-weight: 500;margin-top:2px;margin-bottom:2px;color:#414042;font-family:'Poppins', sans-serif;font-size:1.3rem;">
        {Messages::i18n("foodGroupForm.legend")}
    </div>
    <div style="margin-left:15px;margin-top:2px;">
        <form data-abide name="foodGroupForm" id="foodGroupForm" action="{$actionPage}" method="POST"  autocomplete="off">


                <input type="hidden" name="id" value="{$foodGroup->getId()}"/>
                <div class="row">
                    <div class="medium-4 end columns">
                        <label><span class="required">{Messages::i18n("foodGroupForm.name")}</span>
                            <input tabindex="1" autofocus maxlength="40" type="text" id="name" name="name" value="{$foodGroup->getName()}" placeholder="" required>
                        </label>
                    </div>
                </div>
                
                <div class="row">
                    <div class="medium-4 end columns" style="padding-top:8px;">
                        <a href="/food/group" tabindex="3" class="reset">{Messages::i18n("link.reset")}</a>&nbsp;
                        {ElementTag::submitBtn(2)}
                    </div>
                    {if $foodGroup->getId() != ''}
                        <div class="medium-4 end columns" style="padding-top:8px;">
                            {Messages::i18n("checkbox.confirm")}&nbsp;<input tabindex="4" id="confirmDelete" type="checkbox"/>
                            {ElementTag::deleteBtn(5, "/food/group/delete/`$foodGroup->getId()`")}
                        </div>
                    {/if}
                </div>

        </form> 
    </div>       

{if $list|count gt 0}
    <br/>
    <table align="left" id="listTable" class="displayTable" width="95%" cellspacing="0">
        <thead>
            <tr>
                <th>{Messages::i18n("foodGroupForm.name")}</th> 
                <th>{Messages::i18n("foodGroupForm.image.file")}</th> 
                <th width="10%">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            {foreach from=$list item=fg} 
                <tr>                           
                    <td>{$fg->getName()}</td> 
                    <td>
                        <a href="#" class="imageUpload" data-id="{$fg->getId()}" data-name="{$fg->getName()}" onclick="return false;" title="Upload image associated to the food group">
                            <i class="fas fa-file-upload" style="font-size:1.4rem;color:#93c83e;"></i>
                        </a>
                        {if $fg->getImageName()|trim != ''}
                            &nbsp;
                            <a href="/utility/imageConvert.php?id={$fg->getId()}" style="color:#109cca;" data-lightbox="foodGroup" data-title="{$fg->getOriginalImageName()}">
                                {$fg->getOriginalImageName()}
                            </a>
                            &nbsp;
                            <a href="/food/group/image/delete/{$fg->getId()}" title="delete associated image">
                                <i class="fas fa-trash-alt" style="color:#ff0000;font-size:1.2rem;"></i>
                            </a>
                        {/if}
                    </td> 
                    <td>
                        <a class="editRow" title="{Messages::i18n("link.edit")}" href="/food/group/edit/{$fg->getId()}">
                            <i class='fas fa-edit' style='font-size:1.5rem;color:#008cba;'></i>
                        </a>
                    </td>
                </tr>
            {/foreach}
        </tbody>
    </table> 
{else}
    <div class="emptyListMessage">
        {Messages::i18n("foodGroupForm.empty.list.message")}
    </div>
{/if}

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
                    {ElementTag::submitBtn(2,"Upload")}
                </div>
            </div>
             <div class="row text-left" >
                <div class="medium-12 end columns" style="font-weight:normal;color:#777777;">
                    <i>*{Messages::i18n("foodGroup.image.sizeTypeWarning")}</i>
                </div>
            </div>
        </form>			
    </div>
<br/><br/>


{/nocache}
{/block}
