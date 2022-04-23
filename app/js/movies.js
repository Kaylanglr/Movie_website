const API_KEY = "c33d70bbca407d688c0cd40fe9970a7d";
const BASE_URL = "https://api.themoviedb.org/3";
const IMAGE_URL = "https://image.tmdb.org/t/p/w500";
const MAIN = document.getElementById('films');
const FILTERBOX = document.getElementById('filter-box');
const FORM = document.getElementById('form');
const SEARCHBAR = document.getElementById('searchMovie');

// API urls
const MOVIES_IN_THEATRES = BASE_URL+"/discover/movie?sort_by=popularity.desc&api_key="+API_KEY+"&language=en-EN";
const SEARCH_URL = BASE_URL+"/search/movie?api_key="+API_KEY;

getMovies(MOVIES_IN_THEATRES);

function getMovies(url) {
    fetch(url).then(res => res.json()).then(data => {
        showMovies(data.results);
    })
}


function showMovies(data) {
    MAIN.innerHTML = "";

    data.forEach(movie => {
        const {title, poster_path, overview,vote_average, id, popularity} = movie;
        if (poster_path != null) {
            if (popularity > 10) {
                const movieEl = document.createElement('div');
                movieEl.classList.add('card');
                movieEl.innerHTML = `
                    <a href="details.php?movie=${id}">
                        <div class="card-photo">
                        <img src="${IMAGE_URL+poster_path}" alt="${title}">
                        </div>
                        <div class="card-title">
                            <p>${title}</p>
                        </div>
                        <div class="rating ${getColour(vote_average)}">
                            <p>${vote_average}</p>
                        </div>
                        <div class="overview">
                            <h2>overview</h2>
                            <p>${overview}</p>
                        </div>      
                    </a>
                `
                MAIN.appendChild(movieEl);
            }
        }
    })
}

function getColour(score) {

    if (score >= 7 ) {
        return "green";
    }
    else if (score >= 5) {
        return "orange";
    }
    else if (score == 0) {
        return "tba";
    }
    else {
        return "red";
    }
}

function filter() {
    
    if (FILTERBOX.style.transform == "translateX(101%)") {
        FILTERBOX.style.transform = "translateX(0%)";
    }else {
        FILTERBOX.style.transform = "translateX(101%)";
    }
    
}

FORM.addEventListener('submit', (e) => {
    e.preventDefault();
    const SEARCHTERM = SEARCHBAR.value;
    if(SEARCHTERM == "") {
        getMovies(MOVIES_IN_THEATRES);
    }

    if (SEARCHTERM) {
        getMovies(SEARCH_URL+"&query="+SEARCHTERM+"&sort_by=vote_average.desc")
    }
})