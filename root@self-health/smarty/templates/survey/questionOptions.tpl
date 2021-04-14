{*Author: Randal Neptune*}
{*Project: OECS*}

{extends file="base/body.tpl"}

{block name=styles}
    {literal}
        #listTable {
            padding-top: 0px !important;
            margin-top: 0px !important;
        }
        
        .row{
            margin-bottom: 0px !important;
        }
    {/literal}
{/block}

{block name=scripts}
    {literal}
        function updateSortOrder () {
            var ids = [];
            var orders = [];
            
            if ($("table.displayTable").find("tbody").find("tr:visible").length > 0) {
            
                //Reset the sort orders and populate the arrays
                $("table.displayTable").find("tbody").find("tr:visible").each(function(index) {
                    $(this).find("input.sortOrder").val(index + 1);
                    ids.push($(this).find("input.id").val());
                    orders.push(index + 1);
                });
            
                $.ajax({
                    url: "/ajax/question/option/update/sort/order",
                    type: "POST",
                    dataType: "json",
                    data: {questionId: $("#questionId").val(), ids: ids.join(","), orders: orders.join(",")}
                }).done(function(data){
                    console.log("Transaction was successful?" + data);
                });
            }
        }
    {/literal}
{/block}

{block name=jquery}
    {literal}
        
        var optEditor = false;;
        var optHolder = '';
        
        $("a#addOption").click(function(){
            var newTr = $("tr.tableInput").clone(true, true);
           
            $("table.displayTable").append(newTr);
            newTr.css("display","table-row");
            
            optHolder = '';
            optEditor = true;
        });
        
        /*************************************************
         Save a option on add or edit
        **************************************************/
        $("body").on("click", "a.saveOption", function(){
            var parTr = $(this).closest("tr");
            var parTd = $(this).closest("td");
            var id = $(this).attr("data-id");
            var optionText = $.trim(parTr.find("input.optionText").val());
            
            if (optionText == '') {
                parTr.find("input.optionText").addClass("error");
                return false;
            } else {
                parTr.find("input.optionText").removeClass("error");
                var sIndex = ($.trim(parTr.find("input.sortOrder").val()) == '') ? parTr.closest("tbody").find("tr:visible").length : $.trim(parTr.find("input.sortOrder").val());
               
                $.ajax({
                    url: "/ajax/question/option/save",
                    type: "POST",
                    dataType: "json",
                    data: {id:id, optionText: optionText, sortOrder: sIndex, questionId: $("#questionId").val()} 
                }).done (function (data) {
               
                    if (data.status) {
                        parTd.prev("td").find("input.optionText").replaceWith("<span>"+optionText+"</span>");
                        parTd.prev("td").find("input.sortOrder").val(sIndex);
                        parTd.prev("td").find("input.id").val(data.id);
                        var actionHTML = '<a href="#" onclick="return false;" data-id="'+data.id+'" class="editOption" title="Edit this option">' +
                                    '<i class="fas fa-edit" style="font-size:1.5rem;color:#008cba;"></i>' +
                                '</a>&ensp;' +
                                '<a href="#" onclick="return false;" data-id="'+data.id+'" class="removeOption" title="Remove this option">' +
                                    '<i class="fas fa-trash-alt" style="font-size:1.5rem;color:#FF0000;"></i>' +
                                '</a>';
                        parTd.html(actionHTML);
                        parTd.next("td").html("<a href='#' onclick='return false;' class='sortIcon'><i class='fas fa-arrows-alt' style='font-size:1.5rem;color:#AAAAAA;'></i></a>");
                        
                        optHolder = '';
                        optEditor = false;
                    } else {
                        swal("Operation Error", "An error occurred. Could not save the question option.","error");
                    }     
                });
            }
        });
        
        /***************************************************
         Edit an option
        ****************************************************/
        $("body").on("click",".editOption", function(e) {
        
            if (optEditor !== true) {
                var parTr = $(this).closest("tr");
                
                optHolder = parTr.clone(true,true);
                
                var parTd = $(this).closest("td");
                var id = $(this).attr("data-id");

                var txt = $.trim(parTr.find("td:first").find("span").text());
               
                parTr.find("td:first").find("span").replaceWith("<input type='text' class='optionText' value='"+txt+"'/>");
                parTd.html('<a href="#" onclick="return false;" data-id="'+id+'" class="saveOption" title="Save the entered option">' +
                                '<i class="fas fa-save" style="font-size:1.5rem;color:#73a81e;"></i>' +
                            '</a>&ensp;&nbsp;' +
                            '<a href="#" onclick="return false;" class="cancelOption" title="Cancel the operation">' +
                                '<i class="fas fa-undo" style="font-size:1.5rem;color:orangered;"></i>' +
                            '</a>');
                            
                optEditor = true;
                
            }
            
        });
        
        /***************************************************
         Cancel an option
        ****************************************************/
        $("body").on("click",".cancelOption", function(e) {
            var tr = $(this).closest("tr");
            
            if (optHolder == '') {
                tr.remove();
            } else {
                tr.replaceWith(optHolder);
            }
            optEditor = false;
        });
        
        /***************************************************
         Remove an option
        ****************************************************/
        $("body").on("click",".removeOption", function(e) {
            var id = $(this).attr("data-id");
            var parTr = $(this).closest("tr");
            $.ajax({
                url: "/ajax/question/option/remove/"+id,
                dataType: "json",
                type: "GET"
            }).done(function(result){
                if (result) {
                    //remove the row
                    parTr.remove();
                    updateSortOrder();
                }
            }).fail(function(xhr, status, error){
                swal("Operation Error", status + ': ' + error, "error");
            });
           
        });
        
        /**********************************************
         Make tbody trs draggable
        ***********************************************/
        $("tbody").sortable({
            items:"> tr",
            containment: "parent",
            axis: "y",
            cursor: "grab",
            handle: ".sortIcon",
            helper: function(e, tr){
		var $helper = tr.clone();
		return $helper;
            },
            stop: function(event, ui){
                
                /*ui.item.closest("tbody").find("tr:visible").each(function(index){
                    if ($(this).is(":visible")) {
                        $(this).find("input.sortOrder").val(index + 1);
                    }
                });*/
                
                updateSortOrder();
            }
        });
    {/literal}
{/block}

{block name=dataTable}
    {literal}
        "paging":false,
        info: false,
        searching:false,
        ordering: false
    {/literal}
{/block}

{block name=content}
    {nocache}
        {$msg}
            <div style="font-size: 1.3rem;font-weight:500;color:#5c5c5c;">Manage Question Options</div>
            <input type="hidden" id="questionId" value="{$question->getId()}" />
            <br/>
            <div class='row'>
                <div class='small-12 columns end text-left'>
                    <label style="font-weight:600;color:#777777;font-family:'Poppins', sans-serif;">
                        <span>Q:</span>&ensp;
                        <span style='font-size:1.3rem !important;color:#008cba;'><a style="font-family:'Poppins', sans-serif;" href="/question/form">{$question->getLabel()}</a></span>
                    </label>
                </div>
            </div>
            <table class='displayTable' border='0' width='80%' style='margin-top:2px !important;margin-left:15px !important;'>
                <thead>
                    <th width='80%'>Option Text</th>
                    <th width='10%'>Actions</th>
                    <th width='10%'><a href="#" onclick="return false;" id="addOption" style="font-variant:normal;color:orange;font-weight:600;font-family:'Poppins', sans-serif;font-size:1rem;">add</a></th>
                </thead>
                <tbody>
                    <tr class='tableInput' style='display:none;'>
                        <td>
                            <input type='text' class='optionText' value=''/>
                            <input type="hidden" class="sortOrder" value=""/>
                            <input type="hidden" class="id" value=""/>
                        </td>
                        <td class="actions">
                            <a href="#" onclick="return false;" data-id='' class="saveOption" title="Save the entered option">
                                <i class="fas fa-save" style="font-size:1.5rem;color:#73a81e;"></i>
                            </a>
                            &ensp;
                            <a href="#" onclick="return false;" class="cancelOption" title="Cancel the operation">
                                <i class="fas fa-undo" style="font-size:1.5rem;color:orangered;"></i>
                            </a>
                        </td>
                        <td class="sorter">&nbsp;</td>
                    </tr>
                    {if $options|count gt 0} 
                        {foreach from=$options item=opt}
                            <tr>
                                <td>
                                    <span>{$opt->getOptionText()}</span>
                                    <input type="hidden" class="sortOrder" value="{$opt->getSortOrder()}"/>
                                    <input type="hidden" class="id" value="{$opt->getId()}"/>
                                </td>
                                <td class="actions">
                                    <a href="#" onclick="return false;" data-id="{$opt->getId()}" class="editOption" title="Edit this option">
                                            <i class="fas fa-edit" style="font-size:1.5rem;color:#008cba;"></i>
                                        </a>
                                        &ensp;
                                        <a href="#" onclick="return false;" data-id="{$opt->getId()}" class="removeOption" title="Remove this option">
                                            <i class="fas fa-trash-alt" style="font-size:1.5rem;color:#FF0000;"></i>
                                        </a>
                                </td>
                                <td class="sorter">
                                    <a href='#' onclick='return false;' class='sortIcon'>
                                        <i class='fas fa-arrows-alt' style='font-size:1.5rem;color:#AAAAAA;'></i>
                                    </a>
                                </td>
                            </tr>
                        {/foreach}
                    {/if}
                </tbody>
            </table>
            
            <hr style="margin: 15px 0px 8px 0px;color:#5c5c5c;" width="100%" />      

    
    <br/><br/>
    {/nocache}
{/block}
