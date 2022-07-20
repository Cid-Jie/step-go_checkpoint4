



/* const inputs = document.querySelectorAll("input")
const textareas = document.querySelectorAll("textarea")

const checkValidity = (input) => {
    input.addEventListener('invalid', (e) => {
        e.preventDefault()
        if (!e.target.validity.valid) {
            e.target.parentElement.classList.add('error')
        }
    })

    input.addEventListener('input', (e) => {
        if (e.target.validity.valid) {
            e.target.parentElement.classList.remove('error')
        }
    })
}

Array.from(inputs).forEach(checkValidity);
Array.from(textareas).forEach(checkValidity);












const form = document.querySelector('form');

form.addEventListener('submit', (e) => {
    e.preventDefault()
    console.log('Nom:', e.target.lastname.value)
    console.log('Prénom:', e.target.firstname.value)
    console.log('Email:', e.target.email.value)
    console.log('Dance:', e.target.dance.value)
    console.log('Message:', e.target.message.value)
});

const lastname = document.querySelector('input[name="lastname"]')
lastname.addEventListener('invalid', (e) => {
    console.log(e.target.validity);
});

const firstname = document.querySelector('input[name="firstname"]')
firstname.addEventListener('invalid', (e) => {
    console.log(e.target.validity);
});

const email = document.querySelector('input[name="email"]')
email.addEventListener('invalid', (e) => {
    console.log(e.target.validity);
});

const message = document.querySelector('input[name="message"]')
message.addEventListener('invalid', (e) => {
    console.log(e.target.validity);
});

const inputs = document.querySelectorAll("input")
const checkValidity = (input) => {
    input.addEventListener('invalid', (e) => {
        e.preventDefault()
        if (!e.target.validity) {
            e.target.parentElement.classList.add('error')
        }

    input.addEventListener('input', (e) => {
        if (e.target.validity) {
            e.target.parentElement.classList.remove('error')
        }
    })

    })
}

Array.from(inputs).forEach(checkValidity);

 var fields = {};

document.addEventListener("DOMContentLoaded", function() {
    fields.firstName = document.getElementById('firstname');
    fields.lastName = document.getElementById('lastname');
    fields.email = document.getElementById('email');
    fields.dance = document.getElementById('dance');
    fields.message = document.getElementById('message');
})

//Vérifier que le champ n'est pas vide 
function isNotEmpty(value) {
    if (value == null || typeof value == 'undefined' ) return false;
    return (value.length > 0);
}

//Vérifier si une chaîne est un e-mail
function isEmail(email) {
    let regex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;
    return regex.test(String(email).toLowerCase());
}

//Fonction de validation de champ
function fieldValidation(field, validationFunction) {
    if (field == null) return false;
   
    let isFieldValid = validationFunction(field.value)
    if (!isFieldValid) {
    field.className = 'placeholderRed';
    } else {
    field.className = '';
    }
   
    return isFieldValid;
}

//fonction isValid - combiner toutes les vérifications
function isValid() {
    var valid = true;
    valid &= fieldValidation(fields.firstName, isNotEmpty);
    valid &= fieldValidation(fields.lastName, isNotEmpty);
    valid &= fieldValidation(fields.email, isEmail);
    valid &= fieldValidation(fields.dance, isNotEmpty);
    valid &= fieldValidation(fields.message, isNotEmpty);

    return valid;
}

class User {
    constructor(firstName, lastName, email, dance, message) {
    this.firstName = firstName;
    this.lastName = lastName;
    this.email = email;
    this.message = message;
    this.message = message;
    }
}

const buttonActionForm = document.getElementById('actionForm');
buttonActionForm.addEventListener('click', () => {
    if(isValid()) {
        let usr = new User(firstName.value, lastName.value, adress.value, country.value, email.value, newsletter.checked);

        alert(`${usr.firstName} merci pour votre message, nous vous répondrons dans les plus brefs délais.`)
    } else {
        alert('Une erreur a du se produire, nous ne pouvons envoyer votre demande. Veuillez recommencer !')
    }
});

const actionForm = document.getElementById('action-form');
actionForm.addEventListener('click', () => {
    alert('Votre message a bien été envoyé, nous vous répondrons dans les plus brefs délais.')
})

 */

/* const inputs = document.querySelectorAll("input")

const textareas = document.querySelectorAll("textarea")

const checkValidity = (input) => {
    input.addEventListener('invalid', (e) => {
        e.preventDefault()
        if (!e.target.validity.valid) {
            e.target.parentElement.classList.add('error')
        }
    })

    input.addEventListener('input', (e) => {
        if (e.target.validity.valid) {
            e.target.parentElement.classList.remove('error')
        }
    })
}

const actionForm = document.getElementById('action-form');
actionForm.addEventListener('click', () => {
    alert('Votre message a bien été envoyé, nous vous répondrons dans les plus brefs délais.')
}) */


