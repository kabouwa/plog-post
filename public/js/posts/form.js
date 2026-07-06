// Validation
(function(){
    const handleFormFeedbacks = e => {
        validateMinLength([
            $("input[name='title']"),
            $("textarea[name='description']"),
        ])
    }
    $('form').on('input',handleFormFeedbacks)
})();
