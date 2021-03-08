{*Author: Randal Neptune*}
{*Project: EduRecord*}

{literal}
    
    $(function(){
        //Get json data
        $.ajax({
            type: 'POST',
            url: "/ajax/user/notification/get",
            success: function(alerts){
              $.jGrowl.defaults.pool = 2;
              $.jGrowl.defaults.closer = false;
              $.jGrowl.defaults.position = 'bottom-right';
              
              //Date manilpulation requires date.js
              for(var i =0 ; i < alerts.length;i++){
                var createdTime = alerts[i].createdTime;
                var id = alerts[i].id;
                var divGrowl = '<div class="jGrowler" style="padding:2px 3px;"><span style="font-size:0.8rem;font-weight:bold;">'+ createdTime+ '</span><br/>' 
                    + alerts[i].content+ '<br/>'
                    + '<div class="row replyCont" style="width:100%;padding:0;display:none;"><textarea rows="3" maxlength="160"></textarea></div>'
                    + '<div class="row" style="width:100%;padding:0;">'
                    + '<div class="small-8 column end text-left" style="color:#111;font-size:0.8rem;font-weight:bold;">' 
                    + alerts[i].sender+ '</div>';
                    if (alerts[i].isReplyEnabled) {
                    divGrowl += '<div class="small-4 columns text-right"><a style="color:purple;font-size:0.85rem;" class="repNotify"><i class="fas fa-reply" style="font-size:1.5rem;"></i></a></div>';
                    }
                    divGrowl += '</div></div>';
                
                $.jGrowl(divGrowl, {
                    
                    myId: id,
                    openDuration: 2000,
                    closeDuration: 500,
                    
                    sticky: true,
                    closeTemplate:"[OK]",
                    header: '<span style="font-variant:small-caps;">' + alerts[i].subject + '</span>',
                    close: function(e, m, o){
                        var respuesta = $.trim($(this).closest(".jGrowl-notification").find("div.jGrowler").find("textarea").val());
                        $.ajax({
                            type: 'POST',
                            url: '/ajax/user/notification/close',
                            data:{'id': o.myId, 'reply': respuesta},
                            success: function(data){
                                if(!data.status){
                                    //maybe a sweetAlert Message
                                }
                            }
                        });
                    }
                });
              }
             },
            dataType: 'json'
        });
    
    });
    
    $("body").on("click", "a.repNotify", function() {
       
        var jGrowlerDiv = $(this).closest("div.jGrowler");
        if (jGrowlerDiv.find("div.replyCont").is(":visible")) {
            jGrowlerDiv.find("div.replyCont").hide();
        } else {
            jGrowlerDiv.find("div.replyCont").show();
        }
    });
    
{/literal}

