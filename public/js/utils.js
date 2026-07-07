// Form Functions validations

const validateMinLength = (fields, min = 4) => {
    if(!Array.isArray(fields)){
        $error = "fields parameter must be an array instance !"
        console.error($error)
        alert($error)
        return
    }
    fields.forEach(field => {
        const isValid = field.val().trim().length >= min
        field.toggleClass('is-valid',  isValid)
        field.toggleClass('is-invalid',!isValid)
    })
}
const validateRequired = fields => {
    if(!Array.isArray(fields)){
        $error = "fields parameter must be an array instance !"
        console.error($error)
        alert($error)
        return
    }
    fields.forEach(field => {
        const isValid = field.val().trim() !== ''
        field.toggleClass('is-valid',  isValid)
        field.toggleClass('is-invalid',!isValid)
    })
}

// Delete all alert
const deleteAlerts = _ => {
    setTimeout(()=>{
        $('.alert-compo').fadeOut(600, 
            function () {
                $(this).slideUp(300, 
                    function () {
                    $(this).remove();
                });
        });
    },5000)
}

// Go to view
const toview = (e,url,table=false) => {
    if(table && e.target.closest('td:last-child')) return
    window.location.href = url
}

// Password  button toggler
(function(){
    const showIcon = `<i class="bi bi-eye-fill"></i>`
    const hideIcon = `<i class="bi bi-eye-slash-fill"></i>`
    const passwordToggler = e => {
        const toggler = $(e.currentTarget)
        const field = toggler.parent().find('input')
        const type = field.attr('type') === 'text' ? 'password' : 'text'
        field.attr('type', type)

        toggler.html(type === 'text' ? hideIcon : showIcon)
    }
    $('.password-toggler')
    .html(showIcon)
    .addClass('btn')
    .addClass('btn-outline-primary')
    .click(passwordToggler)
})();


// title
(function (){
    const titles = $('span.title')
    titles.attr('class','title bg-light rounded-2 p-2 position-absolute')
    titles.css({
        opacity : '0',
        margin : '20px 3px',
        visibility : 'hidden',
        transition : 'all 0.2s ease',
        zIndex : '800',
    })
    titles.parent().css('position','relative')
    const showTitle = e => {
        $(e.currentTarget).find('span').css({
            opacity : '1',
            visibility : 'visible'
        })
    }
    const hideTitle = e => {
        $(e.currentTarget).find('span').css({
            opacity : '0',
            visibility : 'hidden'
        })
    }
    titles.parent().mouseover(showTitle)
    titles.parent().mouseout(hideTitle)
})();