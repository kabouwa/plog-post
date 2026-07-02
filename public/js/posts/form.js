(function(){
    const handleFormFeedbacks = e => {
        validateMinLength([
            $("input[name='title']"),
            $("textarea[name='description']"),
        ])
        validateRequired([
            $("select[name='creator']"),
        ])
    }
    $('form').on('change',handleFormFeedbacks)
})();