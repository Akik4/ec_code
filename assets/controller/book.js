    
function addElement() {
    let sel = document.querySelector('#book')
    return (
        `<td><div class="flex flex-col gap-2">
            <a class="leading-none font-medium text-sm text-gray-900 hover:text-primary" href="#">
                ${sel.options[sel.selectedIndex].text}
            </a>
            <span class="text-2sm text-gray-700 font-normal leading-3">
            ${document.querySelector('#description').value}
        </span>
        </div></td><td class="text-end">Maitenant</td>`
    )
}

function addToDabase() {
    let form = new FormData(document.querySelector("#test"));
    form = Object.fromEntries(form);
    console.log(form);

    $.ajax({
        url: '/request/',
        data: form,
        dataType: "JSON",
        type: "POST"
    })
    // console.log(e);
    // fetch('/request/', {
    //     body: new FormData(e),
    //     method: "POST"
    // })
    // .then(response => console.log(response))
    // .then(json => console.log(json));
}

document.querySelector("#test").addEventListener('submit', (e) => { 
// function connect(e) {
    e.preventDefault();
    addToDabase(e.target);
    let test = document.querySelector("#book_modal")
    var modal = KTModal.getInstance(test);
    if (modal) {
        modal.toggle(test);
    }

    $('tbody')[0].innerHTML = addElement() + $('tbody')[0].innerHTML;
    return false;
})


