function scriptDoLoadDialog(scriptUrl, scriptPos, scriptArgs) {
	$('#dialogContent').dialog({
	    autoOpen : false,
	    width : 900,
	    height : 600,
	    title : 'Seo Panel',
	    modal : true,
	    close : function() {
	    	$("#dialogContent").html('');
	    	needPopup = false;
	    },
	    open : function() {  
	    	var dataVals = {
	                "method" : "get",
	                "dataType" : "html",
	                "url" : scriptUrl,
	                "data" : scriptArgs + "&fromPopUp=1",
	                beforeSend: function(){
	                	$("#dialogContent").html('<div id="loading_content"></div>');
	                },
	                success : function(response) {
	        	    	needPopup = true;
	                	$("#dialogContent").html(response);
	                	$("#dialogContent").show();
	                },
	                error : function(xhr, status, error) {
	                },
	                complete : function() {
	                }
	            }
	            $.ajax(dataVals);
	    }
	});
	$('#dialogContent').dialog("open");
}

function scriptDoLoadPostDialog(scriptUrl, scriptForm, scriptPos, scriptArgs, noLoading) {
	if(!scriptArgs) { var scriptArgs = ''; }
	var loadingContent = showLoadingIcon(scriptPos, noLoading);
	var scriptPos = (scriptPos == "content") ? "#dialogContent" : "#dialogContent #" + scriptPos;
	var dataVals = {
            "method" : "post",
            "dataType" : "html",
            "url" : scriptUrl,
            "data" : $('#dialogContent #'+scriptForm).serialize() + scriptArgs + "&fromPopUp=1",
            beforeSend: function(){
            	$(scriptPos).html(loadingContent);
            },
            success : function(response) {
    	    	needPopup = true;
            	$(scriptPos).html(response);
            	$(scriptPos).show();
            },
            error : function(xhr, status, error) {
            },
            complete : function() {
            }
        }
	$.ajax(dataVals);
}

function scriptDoLoadGetDialog(scriptUrl, scriptPos, scriptArgs, noLoading) {
	if(!scriptArgs){ var scriptArgs = ''; }
	var loadingContent = showLoadingIcon(scriptPos, noLoading);
	var scriptPos = "#dialogContent #" + scriptPos;
	var dataVals = {
            "method" : "get",
            "dataType" : "html",
            "url" : scriptUrl,
            "data" : scriptArgs + "&fromPopUp=1",
            beforeSend: function(){
            	$(scriptPos).html(loadingContent);
            },
            success : function(response) {
    	    	needPopup = true;
            	$(scriptPos).html(response);
            	$(scriptPos).show();
            },
            error : function(xhr, status, error) {
            },
            complete : function() {
            }
        }
	$.ajax(dataVals);
}