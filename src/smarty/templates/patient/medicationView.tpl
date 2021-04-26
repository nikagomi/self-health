{*Author: Randal Neptune*}
{*Project: EduRecord*}

{extends file="base/contentBody.tpl"}

{block name=styles}
    {literal}
        .viewLabel, label{
            font-size: 0.9rem !important;
        }
        
        .chosen-container .chosen-drop {
            width: 300px;
        }
        
        .canceled {
            text-decoration:line-through;
        }
        
        table#medTable th {
            font-variant:normal !important;
            font-weight:500 !important;
            color:#FFFFFF !important;
            font-size:0.9rem !important;
            text-align:left !important;
            font-family: "Poppins", sans-serif !important;
        }
    {/literal}
{/block}

{block name=scripts}
    {literal}
        function truncateText(text, val){
            var newLength = val - 3;
            return (text.length > val) ? text.substring(0, newLength) + "..." : text; 
        }
    {/literal}
{/block}


{block name=jquery}
    {literal}
        
        $(function(){
            $(".hotspot").tipTip({maxWidth: "200px", edgeOffset: 3, defaultPosition: "top", delay: 200, fadeOut: 400});
        });
        
        $("div.medDateRangeFilter").css({"color":"#666666","font-size":"0.9rem"}).html('<span style="float:left;display:inline-block;padding-top:8px;">Date Filter:&nbsp;</span><input type="text" class="short" style="float:left;width:110px !important;" id="rmin" /><span style="float:left;display:inline-block;padding-top:8px;">&nbsp;-&nbsp;</span><input type="text" style="float:left;width:110px !important;"  class="short" id="rmax" />');
        $("#rmin, #rmax").datepicker({
            format:"M dd, yyyy", 
            clearBtn:true,
            autoclose: true
        }).on('changeDate', function (ev) {
            medTable.draw();
        }).data('datepicker');
       
    {/literal}
{/block}

{block name=content}
    {nocache}
    <div>
    <div class="listTableCaption_simpleTable" style="font-variant:normal;font-weight: 500;margin-top:2px;margin-bottom:2px;color:#414042;font-family:'Poppins', sans-serif;font-size:1.3rem;">
        Medication Record
    </div>
    <div id="" {if $medications|count == 0} style="display:none;" {/if}>
      
        <table align="left" id="medTable" class="displayTable_simpleTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>{Messages::i18n("patientMedicationForm.medicationId")}</th>
                    <th>{Messages::i18n("patientMedicationForm.otherMedication")}</th> 
                    <th>{Messages::i18n("patientMedicationForm.quantityConsumed")}</th>
                    <th>{Messages::i18n("patientMedicationForm.dateTaken")}</th>
                    <th>{Messages::i18n("patientMedicationForm.timeTaken")}</th>
                    <th>{Messages::i18n("patientMedicationForm.comments")}</th>
                    <th class="never">&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                {foreach from=$medications item=pmed} 
                    <tr>                           
                        <td>{$pmed->getMedication()->getLabel()}</td> 
                        <td>{$pmed->getOtherMedication()}</td> 
                        <td>{$pmed->getQuantityAmount()} {$pmed->getQuantityTakenUnit()->getLabel()}</td>
                        <td>{$pmed->displayDateTaken()}</td>
                        <td>{$pmed->displayTimeTaken()}</td>
                        <td>{$pmed->getComments()}</td>
                        <td>{$pmed->getDateTaken()|strtotime}</td>
                    </tr>
                {/foreach}
            </tbody>
        </table>  
     </div>    
        
    
    {if $medications|count == 0}
        <div class="emptyListMessage">{Messages::i18n("patientMedicationForm.empty.list.message")}</div>
    {/if}
</div>

{/nocache}
{/block}


{block name="auxScripts"}
    {literal}
        $.fn.dataTable.ext.search.push(
            function (settings, data, dataIndex) {
                var min = ($.trim($('#rmin').val()) != '') ? moment($('#rmin').val(), "MMM D, YYYY") : null;
                var max = ($.trim($('#rmax').val()) != '') ? moment($('#rmax').val(), "MMM D, YYYY") : null;
                var startDate = moment(data[3], "MMM D, YYYY");

                if (min == null && min == null) { return true; }
                if (min == null && startDate.isSameOrBefore(max)) { return true;}
                if (max == null && startDate.isSameOrAfter(min)) {return true;}
                if (startDate.isSameOrBefore(max) && startDate.isSameOrAfter(min)) { return true; }
                return false;
            }
        );

        var medTable = $("#medTable").DataTable({
            "paging":false,
            "iDisplayLength": 100,
            responsive: true,
            "dom": "<'row'<'medium-11 columns end text-left medDateRangeFilter'>>"+
                "t"+
                "<'row'<'small-12 medium-7 text-left columns end'p>>",
            order: [
                [0, 'asc'], [3, 'desc']
            ],
            'columnDefs': [
                { 'orderData':[6], 
                  'targets': [3], 
                },
                {
                  'targets': [6],
                  'visible': false,
                  'searchable': false,
                },
                {
                    className: 'control',
                    orderable: false,
                    targets:   '0'
                }
            ]
        });

        /*************  Column header filter  ************/
        sarmsHeaderDataTableColumnFilterMulti(medTable, [0]);

         
    {/literal}
{/block}
