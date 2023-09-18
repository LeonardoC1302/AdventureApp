let step = 1;
const start = 1;
const end = 3;

const reservation = {
    name: "",
    date: "",
    time: "",
    activities: []
}

document.addEventListener('DOMContentLoaded', () => {
    startApp();
});


function startApp() {
    showSection();
    tabs();
    pagination();
    next();
    prev();

    checkAPI();

    clientName();
    addDate();
    addTime();
}

function showSection(){

    // Hide all sections
    const prevSection = document.querySelector('.show');
    if(prevSection)
        prevSection.classList.remove('show');

    // Show the section
    const stepSelector = `#step${step}`;
    const section = document.querySelector(stepSelector);
    section.classList.add('show');

    // Update buttons
    const prevButton = document.querySelector('.active');
    if(prevButton)
        prevButton.classList.remove('active');

    const tab = document.querySelector(`[data-step="${step}"]`);
    tab.classList.add('active');
}


function tabs(){
    const buttons = document.querySelectorAll('.tabs button');
    
    buttons.forEach(button => {
        button.addEventListener('click', (e) => {
            step = parseInt(e.target.dataset.step);

            showSection();
            pagination();
        });
    });
}

function pagination(){
    const prevButton = document.querySelector('#prev');
    const nextButton = document.querySelector('#next');

    if(step === 1){
        nextButton.classList.remove('hide');
        prevButton.classList.add('hide');
    } else if(step === 3){
        prevButton.classList.remove('hide');
        nextButton.classList.add('hide');
    } else {
        prevButton.classList.remove('hide');
        nextButton.classList.remove('hide');
    }

    showSection();
}

function next(){
    const nextButton = document.querySelector('#next');

    nextButton.addEventListener('click', () => {
        if(step >= end) return;
        step++;
        pagination();
    });
}

function prev(){
    const prevButton = document.querySelector('#prev');

    prevButton.addEventListener('click', () => {
        if(step <= start) return;
        step--;
        pagination();
    });
}

async function checkAPI(){
    try {
        const url = 'http://localhost:3000/api/reservations';
        // Await stops the execution of the code until the promise is resolved
        const response = await fetch(url);
        const result = await response.json();
        showActivities(result);
    } catch (error) {
        console.log(error);
    }
}

function showActivities(activities){
    activities.forEach( activity => {
        const {id, name, description, price} = activity;
        
        const activityName = document.createElement('P');
        activityName.classList.add('activity-name');
        activityName.textContent = name;

        const activityDescription = document.createElement('P');
        activityDescription.classList.add('activity-description');
        activityDescription.classList.add('hidden');
        activityDescription.textContent = description;

        const activityPrice = document.createElement('P');
        activityPrice.classList.add('activity-price');
        activityPrice.textContent = `$${price}`;

        const activityDiv = document.createElement('DIV');
        activityDiv.classList.add('activity');
        activityDiv.dataset.idActivity = id;
        activityDiv.onclick = function() {
            selectActivity(activity);
        }

        activityDiv.appendChild(activityName);
        activityDiv.appendChild(activityDescription);   
        activityDiv.appendChild(activityPrice);

        document.querySelector('#activities').appendChild(activityDiv);
    });
}

function selectActivity(activity){
    const {id} = activity;
    const {activities} = reservation;

    const activityDiv = document.querySelector(`[data-id-activity="${id}"]`);

    if(activities.some( exists =>exists.id === id )){
        reservation.activities = activities.filter( data => data.id !== id);
        activityDiv.classList.remove('selected');
    } else{
        reservation.activities = [...activities, activity];
        activityDiv.classList.add('selected');
    }
    console.log(reservation);
}

function clientName(){
    reservation.name = document.querySelector('#name').value;
}

function addDate(){
    const inputDate = document.querySelector('#date');
    inputDate.addEventListener('input', (e) => {
        const day = new Date(e.target.value).getUTCDay();

        if([0].includes(day)){
            inputDate.value = '';
            showAlert('We are not open on Sundays', 'error');
        } else{
            reservation.date = e.target.value;
        }
    });
}

function addTime(){
    const inputTime = document.querySelector('#time');
    inputTime.addEventListener('input', (e) => {
        const time = e.target.value;
        const hour = time.split(':')[0];
        if(hour < 8 || hour > 18){
            inputTime.value = '';
            showAlert('We are not open at this time', 'error');
        } else{
            reservation.time = time;
        }
    });
}

function showAlert(message, type){
    const prevAlert = document.querySelector('.alert');
    if(prevAlert) return;

    const alert = document.createElement('DIV');
    alert.textContent = message;
    alert.classList.add('alert');
    alert.classList.add(type);

    const form = document.querySelector('.form');
    form.appendChild(alert);

    setTimeout(() => {
        alert.remove();
    }, 3000);
}