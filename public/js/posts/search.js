(function (){
    const API_URL = window.location.origin + '/api/v1/posts/'
    const field = $("#search")
    const output = $('#search-results')
    async function getPosts(search='')
    {
        let query = '?q=' + search
        const res = await fetch(API_URL + query)
        const data = await res.json()        
        const posts = data.data
        return posts
    }
    const hideOutput = _ => { output.css({opacity : '0',visibility : 'hidden'}); output.html('');}
    const showOutput = _ => { output.css({opacity : '1',visibility : 'visible'}) }
    async function renderPostsResults()
    {
        const q = field.val()
        if(!q.length){
            hideOutput()
            return
        }
        const posts = await getPosts(q)
        if(posts.length){
            output.html(
                posts.map(post => `<li class="w-100"><a class="dropdown-item" href="/posts/${post.id}">${post.title}</a></li>`).join('')
            )
            showOutput()
        }else{
            hideOutput()
        }
    }
    field.keyup(renderPostsResults)
})();