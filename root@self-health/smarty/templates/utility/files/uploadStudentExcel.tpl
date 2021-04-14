{*Author: Randal Neptune*}
{*Project: EduRecord*}

{extends file="base/body.tpl"}

{block name=jquery}
    {literal}
       
        $("#academicYearId,#academicYearClassGroupId").chosen();

        /****************************************************
         AJAX to get class groups depending on academic year
        ****************************************************/
        $("#academicYearId").chosen().change(function(){
            $.ajax({
                type: 'POST',
                url: "/ajax/academic/year/class/group/get",
                data: {academicYearId: $("#academicYearId").val()},
                dataType: 'json',
                success: function(data){
                  var listItems = '';
                  if(data.length > 0){
                    listItems += "<option value='' style='font-size:smaller;'>-- Please select --</option>";
                    for(var i =0; i < data.length; i++){
                        listItems += "<option value='" +data[i].id + "'>" + data[i].name + "</option>";
                    }
                  }
                  $("#academicYearClassGroupId").html(listItems).trigger("chosen:updated");
                }
                
           });
        });
    {/literal}
{/block}

{block name=styles}
    {literal}
        th {
            color: #000000 !important;
        }
    {/literal}
{/block}

{block name=dataTable}
    {literal}
        paging: false,
        searching: false,
        info: false,
        iDisplayLength: 'all',
        columnDefs: [
            { orderable: true, "targets": "*" }
        ]
    {/literal}
{/block}


{block name=content}
{nocache}

{$msg}
  
    <fieldset style="width:90%;">
        <legend>Upload Students Via Excel</legend>
        <p>
            This page allows a user to upload <b>NEW</b> students to the SM@RT database <br/><br/>
            <i>
                <b>Before uploading the file please be advised that the excel columns should be ordered in the order that follows (exactly):</b><br/>
            
            (1) First Name (<font color='#FF0000'>required</font>)<br/>
            (2) Middle Names<br/>
            (3) Last Name (<font color='#FF0000'>required</font>)<br/>
            (4) Sex (<font color='#FF0000'>required</font>. Options are: male, female)<br/>
            (5) Birth Date (<font color='#FF0000'>required</font>. Format as date: m/d/yyyy)<br/>
            (6) {Messages::i18n("student.identifier.name")} {if PropertyService::getProperty("student.identifier.format","")|trim != ''}  (Format: {PropertyService::getProperty("student.identifier.format")}: where 0 represents a number and S represents a letter){/if}<br/>
            (7) Birth Country  (Must already exist in SM@RT)<br/>
            (8) Address <br/>
            (9) {Messages::i18n("districtForm.name")} (<font color='#FF0000'>required</font>. Must already exist in SM@RT)<br/>
            (10) Primary Phone (<font color='#FF0000'>required</font>)<br/>
           (11) Other Phone<br/>
           (12) Religion (Must already exist in SM@RT)<br/>
           (13) Sports House (Must already exist in SM@RT. Will be saved only if at educational facility)<br/>
           <br/>
           <b>Other considerations:</b><br/>
           * The first row should contain the column headers.<br/>
           * A maximum of 150 rows of students can be uploaded at once.<br/>
           * File must be in EXCEL format<br/>
           <font color='#003366'>* Students will be automatically assigned to this facility if it is an educational facility</font>
           </i></p>
            <div class="row">
                <div class="medium-12 columns">
                  <hr width="99%" size="4" color="#D0E0F0" style="margin:10px;"/>
                </div>
            </div>
            <form data-abide name="studentExcelUploadForm" id="studentExcelUploadForm" enctype="multipart/form-data" action="{$actionPage}" method="POST" autocomplete="off">
                
                {if $smarty.session.isEducational}
                    <div style="font-size:0.9rem;color:#777777;font-style:italic;">You may <b>OPTIONALLY</b> select the class group that you want the students (listed in the chosen file) to be assigned to.
                        <br/>Please note that <b>ALL</b> students in the uploaded file will be assigned to the chosen class group.</div>
                    <br/>
                <div class="row">
                    <div class="medium-4 end columns">
                       <label class=''><span>Academic Year:</span> 
                            <select id='academicYearId'>
                                {html_options options=$academicYears}
                            </select>
                       </label>          
                    </div>
                </div>
                <div class="row">
                    <div class="medium-4 end columns">
                       <label class=''><span>Target Class Group:</span> 
                           <select id='academicYearClassGroupId' name='academicYearClassGroupId'>
                               <option value=''>Select a year first</option>
                            </select>
                       </label>          
                    </div>
                </div>
                {/if}
                <div class="row">
                    <div class="medium-8 end columns">
                        <input tabindex="1"  type="file" id="studentFile" name="studentFile"  class='inputfile inputfile-6' data-multiple-caption="{literal}{count}{/literal} files selected" required>
                        <label for="studentFile"><span></span> <strong><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg>Select Excel&reg; file&hellip;</strong></label>          
                    </div>
                </div>
                <div class='row'>
                     <div class="medium-4 end columns">
                        <label>
                            <button tabindex="2" type="submit" name="submit" class="button">
                                <i class='fas fa-upload' style='font-size:1rem;'></i>&nbsp;&nbsp;Upload
                            </button>
                        </label>
                    </div>
                </div>
            </form>
    </fieldset>
     {* <input type="file" name="studentFile" id="studentFile" class="inputfile inputfile-6" data-multiple-caption="{literal}{count}{/literal} files selected" />
					<label for="file-7"><span></span> <strong><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> Choose a file&hellip;</strong></label>     *}     
    {if $errors|count gt 0}
        <div class="listTableCaption">The following errors were identified in the chosen file</div> 
        <table align="left" id="listTable" class="displayTable" width="98%" cellspacing="0">
            <thead>
                <tr style='background-color:#ffb3b3;'>
                    <th>Row #</th>
                    <th>First Name</th>
                    <th>Middle Names</th>
                    <th>Last Name</th>
                    <th>Sex</th>
                    <th>Birth Date</th>
                     <th>{Messages::i18n("student.identifier.name")}</th>
                    <th>Birth Country</th>
                    <th>Address</th>
                    <th>{Messages::i18n("districtForm.name")}</th>
                    <th>Primary Phone</th>
                    <th>Other Phone</th>
                    <th>Religion</th>
                    <th>Sports House</th>
                </tr>
            </thead>
            <tbody>
                {foreach from=$errors item=err} 
                    <tr>                           
                        <td>{$err['rowDetails']['rowNumber']}</td>
                        <td>{$err['rowDetails']['first_name']}</td> 
                        <td>{$err['rowDetails']['middle_names']}</td> 
                        <td>{$err['rowDetails']['last_name']}</td> 
                        <td>{$err['rowDetails']['sex']}</td> 
                        <td>{$err['rowDetails']['date_of_birth']}</td> 
                        <td>{$err['rowDetails']['national_identifier']}</td>
                        <td>{$err['rowDetails']['country_of_birth']}</td> 
                        <td>{$err['rowDetails']['address']}</td> 
                        <td>{$err['rowDetails']['district']}</td> 
                        <td>{$err['rowDetails']['primary_contact']}</td> 
                        <td>{$err['rowDetails']['other_contact']}</td> 
                        <td>{$err['rowDetails']['religion']}</td> 
                        <td>{$err['rowDetails']['sports_house']}</td> 
                    </tr>
                {/foreach}
            </tbody>
        </table> 
    {/if}
    
    {$errorText}
    <br/><br/>

{/nocache}
{/block}

