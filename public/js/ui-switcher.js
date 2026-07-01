(function (){
    let ui_used = "cards";
    $("#ui-switcher").click(()=>{
        if(ui_used === "cards"){
            if ( $("#posts-table").hasClass("d-none") ) $("#posts-table").removeClass("d-none");
            $("#posts-table").slideDown(500);
            $("#posts-cards").slideUp(500)
            ui_used = "table";
        }else if(ui_used === "table"){
            $("#posts-table").slideUp(500);
            $("#posts-cards").slideDown(500)
            ui_used = "cards";
        }
    })
})()