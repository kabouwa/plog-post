// Keyboard Events and Card Events
(function (){
    editLink = $('#edit-link').attr('href')
    delBtn   = $('#del-btn')

    const handleShortcut = e => {
        const key = e.key
        switch(key){
            case "Escape":
                window.location.href = '/'
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
})();

deleteAlerts()