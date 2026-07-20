(function (){
    const API_URL = window.location.origin + '/api/v1/users/'
    const field = $("#search")
    const output = $('#search-results')
    async function getUsers(search='')
    {
        let query = '?q=' + search
        const res = await fetch(API_URL + query)
        const data = await res.json()
        const users = data.data
        return users
    }
    const hideOutput = _ => { output.css({opacity : '0',visibility : 'hidden'}); output.html('');}
    const showOutput = _ => { output.css({opacity : '1',visibility : 'visible'}) }
    async function renderUsersResults()
    {
        const q = field.val()
        if(!q.length){
            hideOutput()
            return
        }
        const users = await getUsers(q)
        if(users.length){
            output.html(
                users.map(user => `<li class="w-100"><a class="dropdown-item" href="/users/${user.id}">${user.name}</a></li>`).join('')
            )
            showOutput()
        }else{
            hideOutput()
        }
    }
    field.keyup(renderUsersResults)
})();