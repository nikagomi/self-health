{extends file="base/body.tpl"}

{block name=jquery}
    {literal}
        /**********************************************
         Edit the property value inline
        ***********************************************/
        $("body").on("click", ".editRow", function(e) {
            var parTr = $(this).closest("tr");
            var valueCell = parTr.find("td.value");
            var propertyVal = valueCell.html();
            
            //put text input in value cell
            var $txtInput = $("<input>", {type:"text"});
            $txtInput.val(propertyVal);
            valueCell.html($txtInput);
            valueCell.append("<input type='hidden' class='txtHolder' value='"+propertyVal+"'/>");
            //Now change the last row
            var saveCancelRow = "<a href='#' onclick='return false;' class='saveRow' title='{/literal}{Messages::i18n("link.save")}{literal}'><i class='fas fa-save' style='font-size:1.5rem;color:green;'></i></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href='#' onclick='return false;' class='cancelRow' title='{/literal}{Messages::i18n("link.cancel")}{literal}'><i class='fas fa-undo' style='font-size:1.5rem;color:orangered;'></i></a>";
            parTr.find("td:last-child").html(saveCancelRow);
        });
        
        /************************************************
         Cancel an edit action
        *************************************************/
        $("body").on("click", ".cancelRow", function(e) {
            var parTr = $(this).closest("tr");
            var valueCell = parTr.find("td.value");
            var previousVal = valueCell.find("input[type='hidden']").val();
            
            valueCell.html(previousVal);
            
            var editRow = "<a href='#' onclick='return false;' class='editRow' title='{/literal}{Messages::i18n("link.edit")}{literal}'><i class='fas fa-edit' style='font-size:1.5rem;color:#008cba;'></i></a>";
            parTr.find("td:last-child").html(editRow);
        });
        
        
        /**********************************************
         Save an edited / updated property value
        ***********************************************/
        $("body").on("click", ".saveRow", function(e) {
            var parTr = $(this).closest("tr");
            var valueCell = parTr.find("td.value");
            var newVal = valueCell.find("input[type='text']").val();
            
            if ($.trim(newVal) == "") {
                valueCell.find("input[type='text']").addClass("error");
                return false;
            }else {
                valueCell.find("input[type='text']").removeClass("error");
            }
            
            var lineNumber = parseInt(parTr.find("input[type='hidden'].lineNumber").val());
            var key = parTr.find("td.key").text();
            var noEdit = parTr.find("input[type='hidden'].noEdit").val();
            
            /* Put overlay in to ensure user doesn't do anything while waiting*/
            var $div = $('<div>',{class:"overlay"});
            $div.height($(document).height());
            $div.css("padding-top",$(window).height()/2+"px");
            $div.append("<img src='/images/newloader.gif'/><br/><b>Working...</b>");
            $div.appendTo("body");
            
            $.ajax({
                type:"POST",
                url:"/ajax/property/file/update",
                data:{lineNumber:lineNumber, property:key, val:newVal, noEdit:noEdit},
                dataType: 'json',
                success: function(data) {
                    $div.remove();
                    if (data) {
                        valueCell.html(newVal);
                        var editRow = "<a href='#' onclick='return false;' class='editRow' title='{/literal}{Messages::i18n("link.edit")}{literal}'><i class='fas fa-edit' style='font-size:1.5rem;color:#008cba;'></i></a>";
                        parTr.find("td:last-child").html(editRow);
                    }else {
                        sweetAlert("Update Error", "Could not update the selected property", "error");
                    }
                }
            });
            
            
        });
    {/literal}
{/block}
    

{block name=scripts}
    {literal}
        
    {/literal}
{/block}

{block name=dataTable}
    "paging":true,
    "searching": true,
    "info": true
{/block}

{block name=content}
    {nocache}
        {$msg}
    
        <div class=" pageTitle" style="margin-top:3px;"><b>Manage SM@RT Property File </b></div> 
        <table id="" class="listTable displayTable_simpleTable" border="0" width="94%" cellspacing="0" cellpadding="0">
        <thead>
            <tr>
               
                <th>Description</th>
                <th>Property</th>
                <th>Value</th>
                <th width="20%">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            {foreach from=$displayLines item=line key=number}
                {if ($user->isSystem() && $line['noEdit'] == 1) || $line['noEdit'] == 0}
                    <tr>
                        <td>
                            {$line['comments']} 
                            <input type='hidden' class='lineNumber' value='{$number}'/> 
                            <input type='hidden' class='noEdit' value='{$line['noEdit']}'/>
                        </td>
                        <td class="key"><b>{$line['property']}</b></td>
                        <td class='value'>{$line['value']}</td>
                        <td width='12%'>
                            <a class='editRow' href='#' onclick='return false;'>
                                <i class='fas fa-edit' style='font-size:1.5rem;color:#008cba;'></i>
                            </a>
                        </td>
                    </tr> 
                {/if}
            {/foreach}
        </tbody>
    </table>
    {/nocache}
{/block}
