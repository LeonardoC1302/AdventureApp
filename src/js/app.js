let step = 1;
const start = 1;
const end = 3;

document.addEventListener('DOMContentLoaded', () => {
    startApp();
});


function startApp() {
    showSection();
    tabs();
    pagination();
    next();
    prev();
}

function showSection(){

    // Hide all sections
    const prevSection = document.querySelector('.show');
    if(prevSection)
        prevSection.classList.remove('show');

    // Show the section
    const stepSelector = `#step${step}`;
    const section = document.querySelector(stepSelector);
    console.log(section);
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