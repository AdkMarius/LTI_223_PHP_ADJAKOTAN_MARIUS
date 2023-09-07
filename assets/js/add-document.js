/*
document.addEventListener('DOMContentLoaded', () => {

});
*/


let bookTitle = document.getElementById('title');
let bookTopic = document.getElementById('topic');
let bookfile = document.getElementById('fileToUpload')
let bookSummary = document.getElementById('summary');
let buttonSubmit = document.getElementById('submitForm');
let buttonAuthor = document.getElementById('addAuthor');
let bookKeywords = document.getElementById('keywords');
let parentElement = document.getElementById('error');

let isValid =
    {
        title: false,
        topic: false,
        authorName: false,
        summary: false,
        keyword: false,
        file: false
    };

buttonSubmit.disabled = true;

function errorMessage()
{
    let container = "";
    container = `
            <div style="margin-top: 10px;">
                <p style="color: red">Veuillez bien renseigner les champs de texte avec (*) !</p>
            </div>
        `;
    parentElement.innerHTML = container;
    return (container);
}

function checkformValidity()
{
    const values = Object.values(isValid);
    let valid = 1;
    for (const value of values) {
        if (value == false)
        {
            valid = 0;
            errorMessage();
            buttonSubmit.disabled = true;
            break;
        }
    }

    if (valid == 1)
    {
        parentElement = "";
        buttonSubmit.disabled = false;
    }
}

try {
    let container = "";

    buttonAuthor.addEventListener('click', () => {
        let element = document.getElementById('author--field');

        let divContainer = document.createElement('div');
        divContainer.classList.add('form__container');

        let nameAuthorDiv = document.createElement('div');
        nameAuthorDiv.classList.add('form__field');
        nameAuthorDiv.classList.add('form__field--input');
        nameAuthorDiv.innerHTML = `
            <label for="author">Auteurs</label>
            <input type="text" class="authorName" name="authorName[]" placeholder="Nom *">
        `;

        let firstNameAuthorDiv = document.createElement('div');
        firstNameAuthorDiv.classList.add('form__field');
        firstNameAuthorDiv.classList.add('form__field--input');
        firstNameAuthorDiv.innerHTML = `
            <input type="text" class="firstAuthorName" name="authorFirstName[]" placeholder="Prénom(s)">
        `;

        divContainer.appendChild(nameAuthorDiv);
        divContainer.appendChild(firstNameAuthorDiv);

        element.appendChild(divContainer);
    });

    let authorNameField = document.getElementsByClassName('authorName');

    for (let i = 0; i < authorNameField.length; i++)
    {
        authorNameField[i].addEventListener('change', (event) => {
            if (authorNameField[i].value.trim() !== "")
                isValid.authorName = true;
            else
                isValid.authorName = false;
            checkformValidity();
        });
    }

    bookTitle.addEventListener('change', (event) => {
        if (bookTitle.value.trim() !== "")
            isValid.title = true;
        else
            isValid.title = false;
        checkformValidity();
    });

    bookTopic.addEventListener('change', (event) => {
        if (bookTopic.value.trim() !== "")
            isValid.topic = true;
        else
            isValid.topic = false;
        checkformValidity();
    });

    bookSummary.addEventListener('change', (event) => {
        if (bookSummary.value.trim() !== "")
            isValid.summary = true;
        else
            isValid.summary = false;
        checkformValidity();
    });

    bookKeywords.addEventListener('change', () => {
        if (bookKeywords.value.trim() !== "")
            isValid.keyword = true;
        else
            isValid.keyword = false;
        checkformValidity();
    });

    bookfile.addEventListener('change', () => {
        if (bookfile.value.trim() !== "")
            isValid.file = true;
        else
            isValid.file = false;
        checkformValidity();
    });

} catch (error) {
    console.log('Error : ' + error.message);
}