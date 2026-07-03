// Navigation header animation handler
(function (){
    const header = $('header')
    const limit = 300
    let lastScrollY = 0
    let visible = true
    const headerHandler = e => {
        const currentScrollY = window.scrollY;

        if(currentScrollY < limit) {
            if(!visible){
                header.slideDown(300)
                visible = true
            }
            lastScrollY = currentScrollY
            return
        }

        if(currentScrollY > lastScrollY){
            if(visible){
                header.slideUp(300)
                visible = false
            }
        }else{
            if(!visible){
                header.slideDown(300)
                visible = true
            }
        }

        lastScrollY = currentScrollY
    }

    $(document).scroll(headerHandler)
})();
