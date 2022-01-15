/*jslint white: true */
const sign_in_btn = document.querySelector("#sign-in-btn");
const sign_up_btn = document.querySelector("#sign-up-btn");
const container = document.querySelector(".container");

sign_up_btn.addEventListener("click", () => {
  container.classList.add("sign-up-mode");
});

sign_in_btn.addEventListener("click", () => {
  container.classList.remove("sign-up-mode");
});

const username = document.getElementById('usernamee');
const password = document.getElementById('passworde');
const captcha = document.getElementById('captchaa');

function checkInputs(form) {
    // trim to remove the whitespaces
    const usernameValue = username.value.trim();
    const passwordValue = password.value.trim();
    const captchaValue = captcha.value.trim();

    if(usernameValue === '') {
        // setErrorFor(username, 'Username cannot be blank');
        const formControl = username.parentElement;
        const small = formControl.querySelector('small');
        formControl.className = 'input-field error';
        small.innerText = 'Username cannot be blank';
    } else {
        // setSuccessFor(username);
        const formControl = username.parentElement;
        formControl.className = 'input-field success';
    }

    if(passwordValue === '') {
        // setErrorFor(password, 'Password cannot be blank');
        const formControl = password.parentElement;
        const small = formControl.querySelector('small');
        formControl.className = 'input-field error';
        small.innerText = 'Password cannot be blank';
    } else {
        // setSuccessFor(password);
        const formControl = password.parentElement;
        formControl.className = 'input-field success';
    }

    if(captchaValue === '') {
        const formControl = captcha.parentElement;
        const small = formControl.querySelector('small');
        formControl.className = 'input-field error';
        small.innerText = 'Wrong Captcha';
    } else {
        const formControl = captcha.parentElement;
        formControl.className = 'input-field success';
    }

    if(usernameValue !== '' && passwordValue !== '' && captchaValue !== '')
    {
        return true;
    }else{
        return false;
    }
}

// function setErrorFor(input, message) {
//     const formControl = input.parentElement;
//     const small = formControl.querySelector('small');
//     formControl.className = 'input-field error';
//     small.innerText = message;
// }

// function setSuccessFor(input) {
//     const formControl = input.parentElement;
//     formControl.className = 'input-field success';
// }

// function isEmail(email) {
//     return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email);
// }

const usernamee = document.getElementById('usernameee');
const emaile = document.getElementById('emaile');
const passworde = document.getElementById('passwordee');

function checkInputse(form) {
    // trim to remove the whitespaces
    var a = 1;
    const usernameValue = usernamee.value.trim();
    const emailValue = emaile.value.trim();
    const passwordValue = passworde.value.trim();

    if(usernameValue === '') {
        // setErrorFor(username, 'Username cannot be blank');
        const formControl = usernamee.parentElement;
        const small = formControl.querySelector('small');
        formControl.className = 'input-field error';
        small.innerText = 'Username cannot be blank';
    } else {
        // setSuccessFor(username);
        const formControl = usernamee.parentElement;
        formControl.className = 'input-field success';
    }

    if(emailValue === '') {
        const formControl = emaile.parentElement;
        const small = formControl.querySelector('small');
        formControl.className = 'input-field error';
        small.innerText = 'Email cannot be blank';
    } else {
        const formControl = emaile.parentElement;
        formControl.className = 'input-field success';
        a = 0;
    }

    if(passwordValue === '') {
        // setErrorFor(password, 'Password cannot be blank');
        const formControl = passworde.parentElement;
        const small = formControl.querySelector('small');
        formControl.className = 'input-field error';
        small.innerText = 'Password cannot be blank';
    } else {
        // setSuccessFor(password);
        const formControl = passworde.parentElement;
        formControl.className = 'input-field success';
    }

    if(usernameValue !== '' && passwordValue !== '' && emailValue !== '' && a == 0)
    {
        return true;
    }else{
        return false;
    }
}
