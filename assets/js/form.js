if (document.querySelector('.button-save-message')) {
/* 
    <form name='tip' method='post' action='tip.php'>
        Tip somebody: 
        <input name="tip_email" type="text" size="30" onfocus="tip_div(1);" onblur="tip_div(2);"/>
        <input type="submit" value="Skicka Tips"/>
        <input type="hidden" name="ad_id" />
    </form>

 */
    $('#submit').click(function() {
        $.ajax({
            url: 'send_email.php',
            type: 'POST',
            data: {
                email: 'email@example.com',
                message: 'hello world!'
            },
            success: function(msg) {
                alert('Email Sent');
            }               
        });
    });
    

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
                
                customBox.innerHTML = '<p>Merci pour votre message, nous vous répondrons très vite.</p>';
                customBox.innerHTML += '<button type="submit" id="modal-close">OK</button>';
                modalShow();
                e.preventDefault();
                //return false;
                //alert('Votre message a bien été envoyé, nous vous répondrons très vite.');
            });

        } else {
            buttonActionForm.setAttribute('disabled', 'disabled');
        }
    }

    var modalContainer = document.createElement('div');
    modalContainer.setAttribute('id', 'modal');

    var customBox = document.createElement('div');
    customBox.className = 'custom-box';

    function modalShow() {
        modalContainer.appendChild(customBox);
        document.body.appendChild(modalContainer);

        document.getElementById('modal-close').addEventListener('click', function() {
            modalClose();
        });

/*         if (document.getElementById('modal-confirm')) {
            document.getElementById('modal-confirm').addEventListener('click', function () {
            console.log('Confirmé !');
            modalClose();
            });
        } else if (document.getElementById('modal-submit')) {
            document.getElementById('modal-submit').addEventListener('click', function () {
                console.log(document.getElementById('modal-prompt').value);
                modalClose();
            });
        } */
    }

    function modalClose() {
        while (modalContainer.hasChildNodes()) {
            modalContainer.removeChild(modalContainer.firstChild);
        }
        document.body.removeChild(modalContainer);
        //window.location.reload(true);
        document.location.href ="/";

    } 
}



