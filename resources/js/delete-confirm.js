const trashForms = document.querySelectorAll('.trash-form');
trashForms.forEach(form => {
    form.addEventListener('submit', (event) => {
        event.preventDefault();
        const confirm = window.confirm('Vuoi spostare il messaggio nel cestino?')
        if (confirm) form.submit();
    })
})

const deleteForms = document.querySelectorAll('.delete-form');
deleteForms.forEach(form => {
    form.addEventListener('submit', (event) => {
        event.preventDefault();
        const confirm = window.confirm('Sei sicuro che vuoi eliminare definitivamente il messaggio?')
        if (confirm) form.submit();
    })
})