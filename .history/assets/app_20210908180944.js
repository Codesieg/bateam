/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

import 'bootswatch/dist/darkly/bootstrap.min.css';

// start the Stimulus application
import './bootstrap';

const apiBaseUrl: 'https://localhost:8080',

    let searchForm = document.querySelector('#searchForm');
let year = document.querySelector('#year').value;

let nationality = document.querySelector('#nationality');
nationality.addEventListener('click', handleNationality);

function handleNationality(event) {
    event.preventDefault();

    let fetchOptions = {
        method: 'GET',
        mode: 'cors',
        cache: 'no-cache'
    };

}
console.log(nationality);