{*Author: Randal Neptune*}
{*Project: EduRecord*}


{extends file="base/body.tpl"}

{block name=styles}
    {literal}
        .shorter {
          width: 70px !important;
        }
        .shortest {
          width: 50px !important;
        }
    {/literal}
{/block}

{block name=jquery}
    {literal}
        $("form").find("select").chosen();
        $("span.hotspot").tipTip({maxWidth: "200px", edgeOffset: 3, defaultPosition: "top", delay: 200, fadeOut: 400});
        
        
        $(function(){
            $(".hotspot").tipTip({maxWidth: "400px", edgeOffset: 3, defaultPosition: "top", delay: 200, fadeOut: 400});
        });
        
        $("div.table-toolbar").html("Search Results").css({
            "margin-left" : "17px",
            "font-family": "'Poppins', sans-serif",
            "font-size" : "1.2rem",
            "font-weight" : 500,
            "color": "#464646"
        });
    {/literal}
{/block}

{block name=dataTable}
    {literal}
        "paging":true,
        "dom": "<'row'<'small-12 medium-4 columns table-toolbar'><'small-12 medium-7 columns text-right'f>>"+
            "t"+
            "<'row'<'small-12 medium-6 columns'i><'small-12 medium-6 columns'p>>"
    {/literal}
{/block}

{block name=content}
{nocache}
    
{$msg} 
<div class="row">
    <div class="medium-12 columns end">
        <form data-abide name="searchForm" id="searchForm" action="{$actionPage}" method="POST" autocomplete="off">
            <div class="listTableCaption_simpleTable" style="font-variant:normal;font-weight: 500;margin-top:2px;margin-bottom:2px;color:#414042;font-family:'Poppins', sans-serif;font-size:1.3rem;">
                Patient Search&nbsp;<small style="font-size:12px;margin-left:15px;color:#003399;">[{PropertyService::getProperty("maximum.returned.search.results","100")} results max] </small>
            </div>
                <div class="row">
                    <div class="medium-4 columns">
                        <label><span class="required">First name</span><small class="error">required</small>
                            <input tabindex="1" type="text" id="firstName" name="firstName" value="{$firstName}" required />
                        </label>
                    </div>
                
                    <div class="medium-4 end columns">
                        <label><span class="required">Last name</span><small class="error">required</small>
                            <input tabindex="2" type="text" id="lastName" name="lastName" value="{$lastName}" required/>
                        </label>
                    </div>
                </div>
                 <div class="row">
                    
                    <div class="medium-4 end columns" style="margin-top:3px;">
                        <span class="text-left left">
                            <font color="#888">Sex: </font>&ensp;<font color="#464646"><br>
                                {assign var="tabindex" value="2"}
                                {foreach from=$genders item=gender}
                                   <input type="radio" tabindex="{$tabindex}" id="{$gender->getName()}" name="genderId" value="{$gender->getId()}" {if $gender->getId() == $genderId} checked {/if}/> 
                                   <label style="color:#464646;" for="{$gender->getName()}">{$gender->getName()}</label>&nbsp;
                                   {assign var="tabindex" value="{$tabindex + 1}"}
                                {/foreach}
                            </font>
                        </span>
                    </div>
                   
                    <div class="medium-4 end columns" style="margin-top:3px;">
                        <label>
                            <span style="color:#777;">Age range (yrs): <small class="error" id="ageRangeError"></small></span>&ensp;<br>
                            <input style="display:inline-block;float:left;margin-right:16px;" tabindex="{$tabindex}" data-abide-validator="ageRangeValidator" type="text" class="shorter" maxlength="3" pattern="number" id="aStart" name="aStart" value="{$aStart}" placeholder=""/> 
                            {assign var="tabindex" value="{$tabindex + 1}"}
                            <span style="display:inline-block;float:left;margin-right:16px;"> - </span>
                            <input style="display:inline-block;float:left;" tabindex="{$tabindex}" data-abide-validator="ageRangeValidator" type="text" class="shorter" maxlength="3" pattern="number" id="aEnd" name="aEnd" value="{$aEnd}" placeholder=""/> 
                            {assign var="tabindex" value="{$tabindex + 1}"}
                            </label>
                    </div>
                     <div class="medium-4 end columns">
                        <label><span class="">Country:</span>
                            <select name="countryId" id="countryId" style="max-width:80%;" tabindex="{$tabindex}">
                                {html_options options=$countries selected=$countryId}
                            </select>
                        </label>
                        {assign var="tabindex" value="{$tabindex + 1}"}
                    </div>
                </div>
                
                <br/>
                <div class="row">
                    <div class="medium-5 end columns" style="">
                        <a href="/patient/search/form" tabindex="{$tabindex}" class="reset">Reset</a>
                        {assign var="tabindex" value="{$tabindex + 1}"}
                        <input tabindex="{$tabindex}" type="submit" name="submit" class="button" value="Search"/>&nbsp;
                    </div>
                    <div class="medium-7 end columns medium-text-right small-text-left" style="padding-top:7px;">
                        <span style="font-size:0.9rem;color:#555; font-variant:small-caps;">
                            total registered patients: <b>{DbMapperUtility::patientCount()}</b>{*&nbsp;<a href="/patient/search/all">view all</a>*}
                        </span>
                    </div>
                </div>
         
        </form> 
    </div>
    
</div>
<div class="row">
    <div class="medium-12 end columns">
        <hr width="99%" style="margin:7px 3px;"/>
    </div>
</div>
{if $searchResults|count gt 0}
    <br/>
    <table align="left" id="listTable" class="displayTable" width="95%" cellspacing="0" style="margin-left:5px !important;">
        <thead>
            <tr>
                <th class="all">Last name</th>
                <th class="all">First name</th>
                <th class="all">Sex</th>
                <th class="min-tablet-l">Age</th>
                <th class="all">Date of birth</th>
                <th class="">Contact #</th>
                <th class="">Country</th>
                <th class="none">Email</th>
                <th class="all" width="8%">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
          {foreach from=$searchResults item=patient}

                <tr> 
                    <td>{$patient->getLastName()}</td>
                    <td>{$patient->getFirstName()}</td>
                    <td>{$patient->getGender()->getName()}</td>
                    <td>{$patient->displayAge()}</td>
                    <td>{$patient->getDateOfBirth()|date_format:"%b %e, %Y"}</td>
                    
                    <td>{$patient->getContactNumber()}</td>
                    <td>{$patient->getCountry()->getName()}</td>
                    <td>{$patient->getUser()->getEmail()}</td>
                    
                    <td>
                        <a class="" title="{Messages::i18n('link.view')}" href="/patient/summary/{$patient->getId()}">
                            view
                        </a>
                    </td>
                </tr>
           {/foreach}
        </tbody>
    </table> 
{else}
     <div align="left" class="emptyListMessage">
         {if $searched} There are no results to display {/if}
     </div>
{/if}



{/nocache}
{/block}


{block name="foundation"}
    {literal}
        abide: {
            validators: {
                /*requiredIf: function (el, required, parent) {
                    try{
                        if($.trim($("#registrationNumber").val()) == ''){
                            if($.trim(el.value) == ""){
                                return false;
                            }else{
                                return true;
                            }
                        }else{
                            return true;
                        }
                    }catch(e){
                        return false;
                    }    
                    //other rules can go here
                    return true;
                },*/
                
                ageRangeValidator: function (el, required, parent) {
                    var min = 0;
                    var max = 120;
                    var maxDiff = 30;
                    var aStart = $.trim($("#aStart").val());
                    var aEnd = $.trim($("#aEnd").val());
                    
                    try {
                    
                        if (aStart != '' && aEnd == '' || aStart == '' && aEnd != '') {
                            $("#ageRangeError").text("use both values or none");
                            return false;
                        } else {
                            if ((aStart != '' || aEnd != '') && (!isPositiveInteger(aStart) || !isPositiveInteger(aEnd))) {
                                $("#ageRangeError").text("use positive values");
                                return false;
                            } else {
                                if (aStart != '' && aEnd != '' && (parseInt(aStart) < min || parseInt(aEnd) > max)) {
                                    $("#ageRangeError").text("range limits: "+min+" - "+max);
                                    return false;
                                } else {
                                    if (aStart != '' && aEnd != '' && parseInt(aStart) > parseInt(aEnd)) {
                                        $("#ageRangeError").text("range end > start");
                                        return false;
                                    } else {
                                        if (aStart != '' && aEnd != '' && (parseInt(aEnd) - parseInt(aStart) > maxDiff)) {
                                            $("#ageRangeError").text("range diff <= "+maxDiff);
                                            return false;
                                        }
                                    }
                                }
                            }
                        }
                    } catch (e) {
                        //alert(e.message);
                        return false;
                    }
                    return true;
                }
            }
        } 
    {/literal}
{/block}
