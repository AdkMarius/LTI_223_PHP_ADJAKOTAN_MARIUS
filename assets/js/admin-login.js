let email = document.getElementById('email');
let password = document.getElementById('password');
let emailError = document.getElementById('emailError');
let passwordError = document.getElementById('passwordError');
let button = document.querySelector('form button');

button.disabled = true;

let isValid =
    {
        email: false,
        password: false
    };

email.addEventListener('change', (event) => {

    try {
        let container = "";
        let regexEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        if (!regexEmail.test(event.target.value))
        {
            container = `
                <div id="error" style="margin-top: 10px;">
                    <p style="color: red">Veuillez bien renseigner l'adresse email !</p>
                </div>
            `;
            emailError.innerHTML = container;
            isValid.email = false;
        }
        else
        {
            isValid.email = true;
            emailError.innerHTML = "";
        }
        checkformValidity();
    } catch (error) {
        console.log('Error : ' + error.message);
    }
});

password.addEventListener("change", (event) => {
    try {
        let container = "";
        let passwordValid=  /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,}$/;
        console.log(passwordValid.test(event.target.value));
        if (!passwordValid.test(event.target.value))
        {
            container = `
                <div id="error" style="margin-top: 10px;">
                    <p style="color: red">Veuillez renseigner un mode de passe fort (8 caractères min., au moins une lettre miniscule, majuscule, un chiffre et un caractère spécial !</p>
                </div>
            `;
            passwordError.innerHTML = container;
            isValid.password = false;
        }
        else
        {
            passwordError.innerHTML = "";
            isValid.password = true;
        }
        checkformValidity();
    } catch (error) {
        console.log('Error : ' + error.message);
    }
});

function checkformValidity()
{
    if (isValid.email && isValid.password) {
        button.disabled = false;
    } else {
        button.disabled = true;
    }
}
