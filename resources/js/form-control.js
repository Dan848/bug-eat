
const registerForm = document.getElementById('register_form');
const form = document.querySelector('.form-crud');
const btnSub = document.getElementById('btn-sub');
const messageBox = document.getElementById('message_box');

function scrollToTop() {
    document.documentElement.scrollTop = 0;
    document.body.scrollTop = 0;
}

//funzione per controllare che le password inserite combacino
function checkPassword() {
    const password = document.getElementById('password');
    const passwordConfirm = document.getElementById('password-confirm');
    let isValid = true;

    if (password.value !== passwordConfirm.value) {
        printError('Le password inserite non coincidono');
        isValid = false;
    }

    return isValid
}

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
    for (let i = 0; i < paragraphs.length; i++) {
        paragraphs[i].remove();
    }
}

//funzione che controlla se il numero di telefono è
function checkNum() {
    const numberBox = document.getElementById('phone_num');
    const pivaBox = document.getElementById('p_iva');
    let isValid = true;
    if (isNaN(numberBox.value)) {
        printError('Inserisci un numero valido. Es: 3470000000');
        scrollToTop();
        isValid = false;
    }

    if (isNaN(pivaBox.value)) {
        printError('Inserisci una partita iva valida. Es: 12345678901');
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

function checkRadio() {
    const radioButtons = document.querySelectorAll('.radio-btn');
    for (let i = 0; i < radioButtons.length; i++){
        if (radioButtons[i].checked) {
            return true;
        }
    }
    printError('Seleziona un\'immagine');
    scrollToTop();
    return false;
}

//clear errors
if (btnSub) {
    btnSub.addEventListener('click', () => {
        clearError();
    })
}

// avvio della funzione checkPassword al submit del form della register
if (registerForm) {
    registerForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const isPasswordValid = checkPassword();

        if (isPasswordValid) {
            registerForm.submit();
        }
    });
}

// errors of restaurant's create and edit
if (form) {
    form.addEventListener('submit', (e) => {
        e.preventDefault();
        const isPhoneNumValid = checkNum();
        const isTypesValid = checkTypes();
        const isRadioValid = checkRadio();
        if (isPhoneNumValid && isTypesValid && isRadioValid) {
            form.submit();
            console.log('submit');
        }
    });
}




