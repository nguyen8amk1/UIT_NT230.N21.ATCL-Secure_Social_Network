var key = localStorage.getItem('key');

if (key === null || key.length !== 16) 
{
    key = prompt('Enter your keys');
    key = (key + "aaaaaaaaaaaaaaaa").substring(0, 16);
    localStorage.setItem('key', key);
}

const encrypt = (content, password) => CryptoJS.AES.encrypt(JSON.stringify({ content }), password).toString()
const decrypt = (crypted, password) => JSON.parse(CryptoJS.AES.decrypt(crypted, password).toString(CryptoJS.enc.Utf8)).content

document.getElementById("submit_form").addEventListener("submit", (event) => {
    event.preventDefault();
    let name = document.getElementById('name').value;
    let content = document.getElementById('content').value;
    fetch('/create', {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-Token": document.getElementsByTagName('input')[0].value
        },
        credentials: "same-origin",
        body: JSON.stringify({
            name: encrypt(name, key),
            content: encrypt(content, key)
        })
    })
    .then(resp => resp.json())
    .then(data => {
        let msg = document.getElementById("msg");
        msg.hidden = false;
        msg.className = data.status ? "alert alert-success" : "alert alert-danger";
        msg.innerHTML = data.msg;
    });
}); 

