function scriptDoLoadDialog(scriptUrl, scriptPos, scriptArgs) {
	$("#search_form").attr("id", "cont_search_form");
	$("#website_id").attr("id", "cont_website_id");
	$('#dialogContent').dialog({
	    autoOpen : false,
	    width : 800,
	    height : 400,
	    title : 'Keyword Position Report',
	    modal : true,
	    close : function() {
	    	$("#dialogContent").html("");
	    	$("#cont_search_form").attr("id", "search_form");
	    	$("#cont_website_id").attr("id", "website_id");
	    	needPopup = false;
	    },
	    open : function() {  
	    	var dataVals = {
	                "method" : "get",
	                "dataType" : "html",
	                "url" : scriptUrl,
	                "data" : scriptArgs,
	                beforeSend: function(){
	                	$("#dialogContent").html("");
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
	if(!scriptArgs){ var scriptArgs = ''; }
	var dataVals = {
            "method" : "post",
            "dataType" : "html",
            "url" : scriptUrl,
            "data" : $('#'+scriptForm).serialize() + scriptArgs,
            beforeSend: function(){
            	$("#dialogContent").html("");
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