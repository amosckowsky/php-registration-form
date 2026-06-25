const formSteps = document.querySelectorAll(".form-step");
let step = 0;
const maxStep = formSteps.length-1;
const nextButton = document.querySelector("#next-button");
const prevButton = document.querySelector("#prev-button");
const submitButton = document.querySelector("#submit-button");
const registrationForm = document.querySelector("#registration-form");
const errorsDiv = document.querySelector(".errors");
const buttonsDiv = document.querySelector(".buttons");
const linksDiv = document.querySelector(".links");
const metaEmailChecker = document.querySelector('meta[name="email_checker"]');
const membersCount = document.querySelector('#members-count');

const today = new Date();
const year = today.getFullYear();
const month = String(today.getMonth() + 1).padStart(2, '0');
const day = String(today.getDate()).padStart(2, '0');

const maxDate = `${year}-${month}-${day}`;

document.getElementById('birthdate').max = maxDate;

// Switch form steps
function changeStep(x){
    let errors = document.querySelectorAll(".error");
    for (let error of errors) {
        error.remove();
    }
    let is_valid = true
    if (x > 0) {
        // If steps move forward - check validation
        for (let p of formSteps[step].children) {
            if (p.classList.contains("error")) {
                continue;
            }

            let inputElement = p.querySelector("input, select, textarea");

            if (!inputElement) {
                continue;
            }
            if (!inputElement.checkValidity()) {
                is_valid = false
                let error = document.createElement('p');
                error.classList.add("error");
                error.innerHTML = p.lastElementChild.validationMessage;
                p.after(error);
            }
            if (inputElement.id == "email") {
                let is_email_invalid = false;
                let xhr = new XMLHttpRequest();
                xhr.open('post', metaEmailChecker.content, false);
                let formData = new FormData();
                formData.append('email', p.lastChild.value);
                formData.append('action', 'email');
                xhr.send(formData);
                if (xhr.status == 200 && xhr.readyState == 4) {
                    is_email_invalid = JSON.parse(xhr.response)['is_email'];
                }
                if (is_email_invalid) {
                    let error = document.createElement('p');
                    error.classList.add("error");
                    error.textContent = 'email already in use';
                    p.after(error);
                    is_valid = false
                }
            }
        }
    }
    if (!is_valid) {
        return
    }
    step += x;
    if (step > maxStep) {
        step = maxStep;
    }
    if (step < 0) {
        step = 0;
    }

    for (let formStep of formSteps) {
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
            console.log(xhr.response)
            let data = JSON.parse(xhr.response);
            console.log(data);
            for (const [key, value] of Object.entries(data)) {
                let p = document.createElement('p');
                p.classList.add("error");
                p.textContent = `${key}: ${value}`;
                errorsDiv.appendChild(p);
            }
            if (new Boolean(data)) {
                for (let formStep of formSteps) {
                    formStep.classList.add("hidden");
                }
                linksDiv.classList.remove("hidden");
                buttonsDiv.classList.add("hidden");
            }
        }
        let xhr2 = new XMLHttpRequest();
        xhr2.open('post', metaEmailChecker.content, false);
        let formData2 = new FormData();
        formData2.append('action', 'count');
        xhr2.send(formData2);
        membersCount.textContent = JSON.parse(xhr2.response)['count'];
    }
    let formData = new FormData(registrationForm);
    xhr.send(formData);

})