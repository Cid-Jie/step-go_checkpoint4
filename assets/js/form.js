if (document.querySelector('.button-save-message')) {

    const buttonActionForm = document.querySelector('.button-save-message');
    buttonActionForm.setAttribute('disabled', 'disabled');

    const inputEmail = document.querySelector('.input-email');
    const inputEmailValue = document.querySelector('.input-email').value;

    inputEmail.addEventListener("change", stateHandle);

    function stateHandle() {
        const buttonActionForm = document.querySelector('.button-save-message');
        if (inputEmailValue === "") {
            buttonActionForm.removeAttribute('disabled', 'disabled');
            buttonActionForm.addEventListener('click', (e) => {
                //e.preventDefault();
                /* customBox.innerHTML = '<p>Merci pour votre message, nous vous répondrons très vite.</p>';
                customBox.innerHTML += '<button id="modal-close">OK</button>';
                modalShow();
                return false; */
                alert('Votre message a bien été envoyé, nous vous répondrons très vite.');
            });

        } else {
            buttonActionForm.setAttribute('disabled', 'disabled');
        }
    }

/*     var modalContainer = document.createElement('div');
    modalContainer.setAttribute('id', 'modal');

    var customBox = document.createElement('div');
    customBox.className = 'custom-box';

    function modalShow() {
        modalContainer.appendChild(customBox);
        document.body.appendChild(modalContainer);

        document.getElementById('modal-close').addEventListener('click', function() {
            modalClose();
        });

        if (document.getElementById('modal-confirm')) {
            document.getElementById('modal-confirm').addEventListener('click', function () {
            console.log('Confirmé !');
            modalClose();
            });
        } else if (document.getElementById('modal-submit')) {
            document.getElementById('modal-submit').addEventListener('click', function () {
                console.log(document.getElementById('modal-prompt').value);
                modalClose();
            });
        }
    }

    function modalClose() {
        while (modalContainer.hasChildNodes()) {
            modalContainer.removeChild(modalContainer.firstChild);
        }
        document.body.removeChild(modalContainer);
        document.location.href = "/";

    }  */
}



