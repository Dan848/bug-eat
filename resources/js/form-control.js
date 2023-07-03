const registerForm = document.getElementById('register_form');

function checkPassword(e) {
    e.preventDefault();
    const password = document.getElementById('password');
    const passwordConfirm = document.getElementById('password-confirm');
    if (password !== passwordConfirm) {
        printError('Le password inserite non coincidono');
    }
}

registerForm.addEventListener('submit', checkPassword);


function printError(errorMessage) {
    const messageBox = document.getElementById('message_box');
    messageBox.classList.remove('d-none');
    messageBox.innerText = errorMessage;
}
