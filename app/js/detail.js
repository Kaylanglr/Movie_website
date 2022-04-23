const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);
const MOVIE_ID = urlParams.get('movie');
const MAIN = document.getElementById('main');
const NO_PROFILE = "https://m.media-amazon.com/images/G/01/imdbpro/help/outline._CB1537462849_.png";

//API CONST
const API_KEY = "api_key=c33d70bbca407d688c0cd40fe9970a7d";
const BASE_URL = "https://api.themoviedb.org/3";
const IMAGE_URL = "https://image.tmdb.org/t/p/w500";


//API URLS
const GET_DETAILS = BASE_URL+"/movie/"+MOVIE_ID+"?"+API_KEY;
const GET_CAST = BASE_URL+"/movie/"+MOVIE_ID+"/credits?"+API_KEY;
const GET_VIDEO = BASE_URL+"/movie/"+MOVIE_ID+"/videos?"+API_KEY

window.onload = (event) =>{
    getDetails(GET_DETAILS);
    setTimeout(function() { getCast(GET_CAST);; }, 500);
    setTimeout(function() { getVideo(GET_VIDEO);; }, 500);

}


function getDetails(url) {
    fetch(url).then(res => res.json()).then(data => {
        showDetails(data);
    })
}

function getCast(url) {
    fetch(url).then(res => res.json()).then(data => {
        showActors(data.cast);
    })
}

function getVideo(url) {
    fetch(url).then(res => res.json()).then(data => {
        videoKey(data.results);
    })
}

function showDetails(data) {
    const {title, overview, release_date, revenue, budget, runtime, poster_path , vote_average} = data
    MAIN.innerHTML = "";
    document.title = title;
    const movieInfo = document.createElement('section');
    movieInfo.classList.add('movie-info');
    movieInfo.innerHTML = `
        <div class="info-top">
            <img src="${IMAGE_URL+poster_path}" alt="${title}">
            <iframe width="800" height="500" src="" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen id="trailer"></iframe>
        </div>
        <div class="buttons">
            <div id="removeFav" class="removeFav"><a href="" class="fav"><i class="fas fa-heart"></i></a></div>
            <div id="addFav" class="addFav"><a href="" class="fav"><i class="far fa-heart"></i></a></div>
            <div id="removeButton" class="removeButton"><a href="app/php/kijklijst.verwerk.php?movieID=${MOVIE_ID}&action=remove">Remove from watchlist <i class="fas fa-times"></i></a></div>
            <div id="addButton" class="addButton"><a href="app/php/kijklijst.verwerk.php?movieID=${MOVIE_ID}&action=add">Add to watchlist <i class="fas fa-plus"></i></a></div>
        </div>
        <div class="info">
            <div class="title">
                <p class="${getColour(vote_average)}">${vote_average}</p>
                <h1>${title}</h1>
            </div>
            <div class="overview">
                <h2>overview</h2>
                <p>
                    ${overview}
                </p>
                <h2>info</h2>
                <p><b>Release date:</b> ${release_date}</p>
                <p><b>Runtime:</b> ${runtime}min</p>
                <p><b>Budget:</b> € ${budget}</p>
                <p><b>Revenue:</b> € ${revenue}</p>
            </div>
        </div>
        <div class="cast">
            <h2>Cast</h2>
            <div class="actor-img" id="actor-img">
            </div>
        </div>
    `;

    MAIN.appendChild(movieInfo);
}




function showActors(data) {
    const ACTOR_LIST = document.getElementById('actor-img');
    ACTOR_LIST.innerHTML = "";
    data.forEach(actor => {
        const {name, profile_path, character} = actor;
        const actorEl = document.createElement('div');
        actorEl.classList.add('actor');
        actorEl.innerHTML = `
            <img src="${profile_path? IMAGE_URL+profile_path: NO_PROFILE}" alt="${name}">
            <p>${name}</p>
            <p class="character">${character}</p>
        `;
        
        ACTOR_LIST.appendChild(actorEl);
    })

}


function videoKey(data) {
    let trailerFound = false;
    while(trailerFound != true) {
        let randomTrailer = data[Math.floor(Math.random()*data.length)]
        const {type, key} = randomTrailer;
        if (type == "Trailer") {
            trailerFound = true;
            document.getElementById('trailer').src = "https://www.youtube.com/embed/"+key;
        }
    }
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