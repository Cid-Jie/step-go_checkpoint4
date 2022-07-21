

//function to open the modal
const buttonActionForm = document.getElementById('button-save-message');
buttonActionForm.addEventListener('click', () => {
    const modalContainer = document.querySelector('.modal-container');
    const modalTriggers = document.querySelectorAll('.modal-trigger');
    modalTriggers.forEach(trigger => trigger.addEventListener('click', toggleModal))

    function toggleModal() {
        modalContainer.classList.add('active')
    }
});

//function to close the modal
const buttonCloseModal = document.getElementById('close-modal');
buttonCloseModal.addEventListener('click', () => {
    const modalContainer = document.querySelector('.modal-container');
    const modalTriggers = document.querySelectorAll('.modal-trigger');
    modalTriggers.forEach(trigger => trigger.addEventListener('click', toggleModal))

    function toggleModal() {
        modalContainer.classList.remove('active');
        document.location.href="/"; 
    }
    
});
