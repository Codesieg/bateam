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

// const apiBaseUrl = 'https://localhost:8080';

let search = document.querySelector('#search');
search.addEventListener('click', handleResult);

let nationality = document.querySelector('#nationality');
nationality.addEventListener('click', handleResult);

let year = document.querySelector('#year');
year.addEventListener('click', handleResult);

let lastBroadcast = document.querySelector('#lastBroadcast');
lastBroadcast.addEventListener('click', handleResult);

function handleResult(event) {
    event.preventDefault();

    let fetchOptions = {
        method: 'GET',
        mode: 'cors',
        cache: 'no-cache'
    };

    let endpoint = app.apiBaseUrl + 'http://localhost:8080/browseSearch?search=' + search.value + '&year=' + year.value + '&nationality=' + nationality.value + '&lastBroadcast=' + lastBroadcast.value;

    console.log(endpoint);



}
console.log(nationality);