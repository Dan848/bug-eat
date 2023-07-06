
const registerForm = document.getElementById('register_form');
const form = document.querySelector('.form-crud');
const btnSub = document.getElementById('btn-sub');
const messageBox = document.getElementById('message_box');
const imageSwitch = document.getElementById('imageSwitch');

//Scroll to Top
function scrollToTop() {
    document.documentElement.scrollTop = 0;
    document.body.scrollTop = 0;
}

//Check same Password at Register
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

//Print message
function printError(errorMessage) {
    messageBox.classList.remove('d-none');
    const paragraph = document.createElement('p');
    paragraph.classList.add('par-error');
    paragraph.innerText = errorMessage;
    messageBox.appendChild(paragraph);
}

//Clear
function clearError() {
    messageBox.classList.add('d-none');
    const paragraphs = document.querySelectorAll('.par-error');
    for (let i = 0; i < paragraphs.length; i++) {
        paragraphs[i].remove();
    }
}

//Check Numbers Phone and P_IVA
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

//Check Types Checkbox
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

//Check Radio Images
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

// Switch Function
function switchImage(){
    //Get col and input inside
    const radioCols = document.querySelectorAll(".radio-col");
    const uploadCol = document.querySelector(".upload-col");
    const uploadInput = document.getElementById("image");
    const radioButtons = document.querySelectorAll('.radio-btn');
    //Toggle visibility
    uploadCol.classList.toggle("d-none");
    for (let i = 0; i < radioCols.length; i++) {
        radioCols[i].classList.toggle("d-none");
        radioCols[i].classList.toggle("d-flex");
    }

    if (imageSwitch.checked) {
        uploadInput.removeAttribute('required');
    }
    else {
        uploadInput.setAttribute('required', 'required');
        for (let i = 0; i < radioButtons.length; i++){
            radioButtons[i].checked= false;
        }
    }
}

// CheckImage
// function checkImage(){
//  const imageFile = document.getElementById("image");
//  console.log(imageFile.value);
// }


// Switch toggle
if (imageSwitch) {
    imageSwitch.addEventListener("change", switchImage)
}

// Errors Clear
if (btnSub) {
    btnSub.addEventListener('click', clearError)
}

// Errors Register
if (registerForm) {
    registerForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const isPasswordValid = checkPassword();

        if (isPasswordValid) {
            registerForm.submit();
        }
    });
}

// Errors of restaurant's create and edit
if (form) {
    form.addEventListener('submit', (e) => {
        e.preventDefault();
        console.log(imageSwitch.checked)
        const isPhoneNumValid = checkNum();
        const isTypesValid = checkTypes();
        let isImageValid = true;
        if (imageSwitch.checked) {
            isImageValid = checkRadio();
        }
        if (isPhoneNumValid && isTypesValid && isImageValid) {
            form.submit();
            console.log('submit');
        }
    });
}




