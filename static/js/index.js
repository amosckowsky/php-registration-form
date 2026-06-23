const formSteps = document.querySelectorAll(".form-step");
let step = 0;
const maxStep = formSteps.length-1;
const nextButton = document.querySelector("#next-button");
const prevButton = document.querySelector("#prev-button");
const submitButton = document.querySelector("#submit-button");
const registrationForm = document.querySelector("#registration-form");
const errorsDiv = document.querySelector(".errors");

// Switch form steps
function changeStep(x){
    if (x > 0) {
        // If steps move forward - check validation
        for (let p of formSteps[step].children) {
            if (!p.lastChild.reportValidity()) {
                return
            }
        }
    }
    step += x;
    if (step > maxStep) {
        step = maxStep;
    }
    if (step < 0) {
        step = 0;
    }

    for (formStep of formSteps) {
        formStep.classList.add("hidden");
    }
    formSteps[step].classList.remove("hidden");

    if (step !== 0) {
        prevButton.classList.remove("hidden");
    } else {
        prevButton.classList.add("hidden");
    }

    if (step === maxStep) {
        nextButton.classList.add("hidden");
        submitButton.classList.remove("hidden");
    } else {
        nextButton.classList.remove("hidden");
        submitButton.classList.add("hidden");
    }
}

nextButton.addEventListener("click", ()=>{
    changeStep(1);
})

prevButton.addEventListener("click", ()=>{
    changeStep(-1);
})

// Send form
submitButton.addEventListener("click", (event)=>{
    event.preventDefault();
    let xhr = new XMLHttpRequest();
    xhr.open("post", window.location.href);
    xhr.onload = ()=>{
        if (xhr.status === 200 && xhr.readyState === 4) {
            while (errorsDiv.children.length !== 0) {
                errorsDiv.firstChild.remove();
            }
            let data = JSON.parse(xhr.response);
            for (const [key, value] of Object.entries(data)) {
                let p = document.createElement('p');
                p.textContent = `${key}: ${value}`;
                errorsDiv.appendChild(p);
            }
        }
    }
    let formData = new FormData(registrationForm);
    xhr.send(formData);
})