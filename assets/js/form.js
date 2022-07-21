if (document.getElementById('button-save-user')) {

    const buttonActionForm = document.querySelector('.button-save-message');
    buttonActionForm.setAttribute('disabled', 'disabled');

    const inputEmail = document.querySelector('.input-email');
    const inputEmailValue = document.querySelector('.input-email').value;

    inputEmail.addEventListener("change", stateHandle);

    function stateHandle() {
        const buttonActionForm = document.querySelector('.button-save-message');
        if (inputEmailValue === "") {
            buttonActionForm.removeAttribute('disabled', 'disabled');
            buttonActionForm.addEventListener('click', () => {
                alert('Votre message a bien été envoyé');
                document.location.href="/";
            });

        } else {
            buttonActionForm.setAttribute('disabled', 'disabled');
        }
    }

}



