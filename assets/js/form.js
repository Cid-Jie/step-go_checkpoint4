if (document.getElementById('button-save-message')) {

const buttonActionForm = document.getElementById('button-save-message');
//buttonActionForm.setAttribute('disabled', 'disabled');

const inputEmail = document.querySelector('.input-email');
const inputEmailValue = document.querySelector('.input-email').value;

function stateHandle() {
    if (inputEmailValue === "") {
        buttonActionForm.removeAttribute('disabled', 'disabled');
    } else {
        buttonActionForm.setAttribute('disabled', 'disabled');
    }
}

inputEmail.addEventListener("change", stateHandle);

const buttonActionModal = document.getElementById('button-save-message');
if (buttonActionForm.disabled = false) {
    //Function to open the modal
    buttonActionModal.addEventListener('click', () => {
        const modalContainer = document.querySelector('.modal-container');
        const modalTriggers = document.querySelectorAll('.modal-trigger');
        modalTriggers.forEach(trigger => trigger.addEventListener('click', toggleModal))

        function toggleModal() {
            modalContainer.classList.add('active');
        }
    });

    //Function to redirect after close the modal
    const buttonCloseModal = document.getElementById('close-modal');
    buttonCloseModal.addEventListener('click', () => {
        document.location.href="/";
    });
}

}




