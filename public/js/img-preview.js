(function (){
    const input = $('[type="file"]')
    const output = $('#preview img')
    const default_path = output.attr('src')    
    const renderUploadedImg = e =>{
        let file = e.currentTarget.files[0]  
        let img_url = file.type.startsWith('image/') ? URL.createObjectURL(file) : default_path
        output.attr('src',img_url)
    }
    input.change(renderUploadedImg)
})();