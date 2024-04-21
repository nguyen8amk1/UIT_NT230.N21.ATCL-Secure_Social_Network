var key = localStorage.getItem('key');

if (key === null || key.length !== 16) 
{
    key = prompt('Enter your keys');
    key = (key + "aaaaaaaaaaaaaaaa").substring(0, 16);
    localStorage.setItem('key', key);
}

const encrypt = (content, password) => CryptoJS.AES.encrypt(JSON.stringify({ content }), password).toString()
const decrypt = (crypted, password) => JSON.parse(CryptoJS.AES.decrypt(crypted, password).toString(CryptoJS.enc.Utf8)).content

let nameElement = document.getElementById('name');
let contentElement = document.getElementById('content');
try {
    let name = decrypt(nameElement.value, key);
    let content = decrypt(contentElement.value, key);
    nameElement.value = name;
    contentElement.value = content;
} catch (error) {
    nameElement.value = ":Flag:";
    contentElement.value = "Chúc may mắn :)";
}
