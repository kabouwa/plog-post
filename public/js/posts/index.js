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
    let delay = 200;

    const switchUi = () => {
        if(used_ui === "cards"){
            $("#posts-cards").fadeOut(delay, function (){
                $(this).addClass("d-none");
                $("#posts-table").removeClass("d-none").hide().fadeIn(delay);
            })
            used_ui = "table";
            localStorage.setItem("used_ui",used_ui)
        }else if(used_ui === "table"){
            $("#posts-table").fadeOut(delay, function () {
                $(this).addClass("d-none");
                $("#posts-cards").removeClass("d-none").hide().fadeIn(delay);
            });
            used_ui = "cards";
            localStorage.setItem("used_ui",used_ui)
        }
    }
    $("#ui-switcher").click(switchUi)
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

// Keyboard Events and Card Events
(function (){
    let cards = $('.card')
    let cardsBody = $(".card-body")
    // Animation 
    cardsBody.mouseover(e =>{
        $(e.currentTarget).parent().css('transform','translateY(-5px)')
    })
    cardsBody.mouseout(e =>{
        $(e.currentTarget).parent().css('transform','translateY(0px)')
    })


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
    cards.click(e => {
        cards.removeClass('selected')
        $(e.currentTarget).addClass('selected')

        // Find link of editing
        viewLink = $(e.currentTarget).data('view-link')
        // Find link of editing
        const links = $(e.currentTarget).find('.edit-link')
        editLink = links.first().attr('href')    
        // Find delete button  
        const btns = $(e.currentTarget).find('.del-btn')
        delBtn = btns.first()
    })

    $('inpuy[name="q"]').focus( e => {
        cards.removeClass('selected')
        viewLink = null
        editLink = null
        delBtn  = null
    })
})();

deleteAlerts()