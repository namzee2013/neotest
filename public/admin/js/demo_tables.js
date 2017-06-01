
    function delete_row(row){

        var box = $("#mb-remove-row");
        box.addClass("open");

        box.find(".mb-control-yes").on("click",function(){
            box.removeClass("open");
            $("#"+row).hide("slow",function(){
              $(this).remove();
            });
        });

    }

    function confirm_delete (msg) {
    	if (window.confirm(msg)) {
    		return true;
    	}
    	return false;
    }
