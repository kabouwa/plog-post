// Go to view
const toview = (e,url,table=false) => {
    if(table && e.target.closest('td:last-child')) return
    window.location.href = url
}
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
    btn.click(e=>{
        window.scrollTo(0,0)
    })
    const checkScrollY = e => {
        const limit = 200
        const delay = 500
        if(window.scrollY > limit){
            btn.slideDown(delay)
        }else{
            btn.slideUp(delay)
        }
    }
    checkScrollY()
    $(document).scroll(checkScrollY)
})();

// Keyboard Events
(function (){
    let viewLink, editLink, delBtn
    const handleShortcut = e => {
        const key = e.key
        switch(key){
            case "Escape":
                window.location.href = 'https://www.google.com'
                break
            case "v":   
                if(viewLink) window.location.href = viewLink         
                break
            case "e":   
                if(editLink) window.location.href = editLink         
                break
            case "d":
            case "Delete":
                if(delBtn) delBtn.click()         
                break
        }
    }
    $(document).keyup(handleShortcut)
    $('.card').mouseover(e => {
        // Find link of editing
        viewLink = $(e.currentTarget).data('view-link')
        // Find link of editing
        const links = $(e.currentTarget).find('.edit-link')
        editLink = links.first().attr('href')    
        // Find delete button  
        const btns = $(e.currentTarget).find('.del-btn')
        delBtn = btns.first()
    })
})();