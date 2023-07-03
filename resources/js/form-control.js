const registerForm = document.getElementById('register_form');
const createForm = document.getElementById('create_form');

function checkPassword(e) {
    e.preventDefault();
    const password = document.getElementById('password');
    const passwordConfirm = document.getElementById('password-confirm');
    if (password !== passwordConfirm) {
        printError('Le password inserite non coincidono');
    }
}

if (registerForm) {
    registerForm.addEventListener('submit', checkPassword);
}


function printError(errorMessage) {
    const messageBox = document.getElementById('message_box');
    messageBox.classList.remove('d-none');
    messageBox.innerText = errorMessage;
}

function checkPhoneNum(e) {
    e.preventDefault();
    const numberBox = document.getElementById('phone_num');
    const phoneParsed = parseInt(numberBox);
    if (isNaN(phoneParsed)) {
        printError('Inserisci solo numeri. Es: 3470000000');
        scrollToTop();
    }
}

if (createForm) {
    createForm.addEventListener('submit', checkPhoneNum);
}

function scrollToTop() {
  document.documentElement.scrollTop = 0;
  document.body.scrollTop = 0;
}
