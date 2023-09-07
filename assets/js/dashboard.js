fetch('../../../assets/js/json/dashboard.json')
    .then((response) => response.json())
    .then((informations) => {
        let divElement = document.getElementById('main-container');

        let k = 0;
        for (let i = 0; i < (informations.length / 3 + 1); i++)
        {
            let row = document.createElement('div');
            row.classList.add('container__row');
            for (let j = 0; j < 3; j++)
            {
                let col = document.createElement('div');
                col.classList.add('container__col');
                col.classList.add('box-shadow');

                let title = document.createElement('h2');
                title.innerText = informations[k].title;
                title.classList.add('mg-10');

                let divImg = document.createElement('div');
                divImg.style.width = '300px';
                divImg.style.height = '300px';

                let picture = document.createElement('img');
                picture.src = informations[k].picture;
                picture.alt = informations[k].altText;
                picture.style.width = '300px';
                picture.style.height = '300px';

                divImg.appendChild(picture);

                let divText = document.createElement('div');
                divText.classList.add('pd-30');

                let text = document.createElement('p');
                text.innerText = informations[k].text;

                divText.appendChild(text);

                let link = document.createElement('a');
                link.href = informations[k].link;
                link.innerText = informations[k].linkText;
                link.classList.add('mg-10');

                col.appendChild(divImg);
                col.appendChild(title);
                col.appendChild(divText);
                col.appendChild(link);

                row.appendChild(col);
                k++;
            }

            divElement.appendChild(row);
        }
    });
