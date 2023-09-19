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

    showSummary();
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
        showSummary();
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
        const url = 'http://localhost:3000/api/activities';
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
    // console.log(reservation);
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
            showAlert('We are not open on Sundays', 'error', '.form');
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
            showAlert('We are not open at this time', 'error', '.form');
        } else{
            reservation.time = time;
        }
    });
}

function showAlert(message, type, element, disappear = true){
    const prevAlert = document.querySelector('.alert');
    if(prevAlert) {
        prevAlert.remove();
    };

    const alert = document.createElement('DIV');
    alert.textContent = message;
    alert.classList.add('alert');
    alert.classList.add(type);

    const reference = document.querySelector(element);
    reference.appendChild(alert);

    if(disappear){
        setTimeout(() => {
            alert.remove();
        }, 3000);
    }
}

function showSummary(){
    const summary = document.querySelector('.summary-content');

    while(summary.firstChild){
        summary.removeChild(summary.firstChild);
    }


    if(Object.values(reservation).includes('')){
        showAlert('You must fill all the fields', 'error', '.summary-content', false);
    }else if(reservation.activities.length === 0){
        showAlert('You must select at least one activity', 'error', '.summary-content', false);
    } else{
        const {name, date, time, activities} = reservation;

        const clientName = document.createElement('P');
        clientName.innerHTML = `<span>Name: </span>${name}`;

        //Formatting the date
        const dateObj = new Date(date);
        const month = dateObj.getMonth();
        const day = dateObj.getDate() + 2;
        const year = dateObj.getFullYear();

        const dateUTC = new Date(Date.UTC(year, month, day));

        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        const formattedDate = dateUTC.toLocaleDateString('en-US', options);


        const reservationDate = document.createElement('P');
        reservationDate.innerHTML = `<span>Date: </span>${formattedDate}`;

        const reservationTime = document.createElement('P');
        reservationTime.innerHTML = `<span>Time: </span>${time}`;

        const activityHeading = document.createElement('H3');
        activityHeading.textContent = 'Activities Summary';
        summary.appendChild(activityHeading);

        total = 0;

        activities.forEach(activity => {
            const {id, name, price} = activity;
                const container = document.createElement('DIV');
                container.classList.add('activity-container');
                
                const activityText = document.createElement('P');
                activityText.textContent = name;

                const activityPrice = document.createElement('P');
                activityPrice.innerHTML = `<span>Price: </span>$${price}`;
                total += parseFloat(price);

                container.appendChild(activityText);
                container.appendChild(activityPrice);

                summary.appendChild(container);
        })

        const totalContainer = document.createElement('P');
        totalContainer.classList.add('total');
        totalContainer.innerHTML = `<span>Total Price: </span>$${total.toFixed(2)}`;
        summary.appendChild(totalContainer);

        const infoHeading = document.createElement('H3');
        infoHeading.textContent = 'Reservation Summary';
        summary.appendChild(infoHeading);

        // Send Button
        const sendButton = document.createElement('BUTTON');
        sendButton.classList.add('button');
        sendButton.textContent = 'Make Reservation';
        sendButton.onclick = makeReservation;

        summary.appendChild(clientName);
        summary.appendChild(reservationDate);
        summary.appendChild(reservationTime);
        summary.appendChild(sendButton);
    }
}

async function makeReservation(){
    const {name, date, time, activities} = reservation;
    const idActivities = activities.map(activity => activity.id);

    const data = new FormData();
    data.append('name', name);
    data.append('date', date);
    data.append('time', time);
    data.append('activities', idActivities);

    const url = 'http://localhost:3000/api/reservations';
    const answer = await fetch(url, {
        'method': 'POST',
        'body': data
    });

    const result = await answer.json(); 
}