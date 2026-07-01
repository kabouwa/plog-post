// Switch posts view
(function (){
    let used_ui = localStorage.getItem('used_ui') ?? "cards" ;    
    used_ui === "table"
        ? $("#posts-table").removeClass("d-none")
        : $("#posts-cards").removeClass("d-none")
    let delay = 600;

    const switchUi = () => {
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
})();

// Card animation
(function (){
    $(".card-body").mouseover(e =>{
        $(e.currentTarget).parent().css('transform','rotateZ(2deg)')
    })
    $(".card-body").mouseout(e =>{
        $(e.currentTarget).parent().css('transform','rotateZ(0deg)')
    })
})();

// Go up button
(function (){
    const btn = $('#go-up')
    btn.css('opavity','0')
    btn.click(e=>{
        window.scrollTo(0,0)
    })
    $(document).scroll(e=>{
        const limit = 500
        const delay = 500
        if(window.scrollY > limit){
            btn.slideDown(delay)
        }else{
            btn.slideUp(delay)
        }
    })
})();
