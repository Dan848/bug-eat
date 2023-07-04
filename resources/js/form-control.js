
const registerForm = document.getElementById('register_form');
const form = document.querySelector('.form-crud');


//funzione per controllare che le password inserite combacino
function checkPassword(e) {
    e.preventDefault();
    const password = document.getElementById('password');
    const passwordConfirm = document.getElementById('password-confirm');
    if (password !== passwordConfirm) {
        printError('Le password inserite non coincidono');
    }
}

//avvio della funzione checkPassword al submit del form della register
if (registerForm) {
    registerForm.addEventListener('submit', checkPassword);
}

const messageBox = document.getElementById('message_box');


//funzione che stampa i messaggi passandogli il messaggio che si vuole stampare
function printError(errorMessage) {
    messageBox.classList.remove('d-none');
    const paragraph = document.createElement('p');
    paragraph.classList.add('par-error');
    paragraph.innerText = errorMessage;
    messageBox.appendChild(paragraph);
}


function clearError() {
    messageBox.classList.add('d-none');
    const paragraphs = document.querySelectorAll('.par-error');
    for (let i = 0; i < paragraphs.length; i++){
        paragraphs[i].remove();
    }
}

//funzione che controlla se il numero di telefono è
function checkPhoneNum() {
    const numberBox = document.getElementById('phone_num');
    const phoneParsed = parseInt(numberBox.value);
    let isValid = true;
    if (isNaN(phoneParsed) && numberBox.value == '') {
        printError('Inserisci un numero valido. Es: 3470000000');
        scrollToTop();
        isValid = false;
    }
    return isValid;
}

function checkTypes() {
    const checkboxes = document.querySelectorAll('input[type="checkbox"]');
    for (let i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i].checked) {
            return true;
        }
    }
    printError('Seleziona almeno una Tipologia');
    scrollToTop();
    return false;
}

if (form) {
    form.addEventListener('submit', (e) => {
        e.preventDefault();
        clearError();
        const isPhoneNumValid = checkPhoneNum();
        const isTypesValid = checkTypes();
        if (isPhoneNumValid && isTypesValid) {
            form.submit();
            console.log('submit');
        }
    });
}

function scrollToTop() {
  document.documentElement.scrollTop = 0;
  document.body.scrollTop = 0;
}
