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

    let used_ui = localStorage.getItem('used_ui') ?? "cards" ;
    used_ui === "table"
        ? $("#posts-table").removeClass("d-none")
        : $("#posts-cards").removeClass("d-none")

    const switchUi = () => {
        let delay = 600;
        if(used_ui === "cards"){
            if ( $("#posts-table").hasClass("d-none") ) $("#posts-table").removeClass("d-none");
            $("#posts-table").slideDown(delay);
            $("#posts-cards").slideUp(delay)
            used_ui = "table";
            localStorage.setItem("used_ui",used_ui)
        }else if(used_ui === "table"){
            if ( $("#posts-cards").hasClass("d-none") ) $("#posts-cards").removeClass("d-none");
            $("#posts-table").slideUp(delay);
            $("#posts-cards").slideDown(delay)
            used_ui = "cards";
            localStorage.setItem("used_ui",used_ui)
        }
    }
    $("#ui-switcher").click(switchUi)

})()
