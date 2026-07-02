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
