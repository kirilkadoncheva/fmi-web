const regForm = document.getElementById('form');
const grow_rate=55;


function getFormValues() {
    const formElements = Array.from(regForm.querySelectorAll('input, select'));
    return formElements.reduce((acc, el) => {
        acc[el.id] = el.value;
        return acc;
    }, {})
}

function containersGrow() {
    const container1 = document.getElementById('form_container');
    const container2 = document.getElementById('container_body');

    let size1 = window.getComputedStyle(container1).height;
    let size2 = window.getComputedStyle(container2).height;

    size1 = size1.slice(0, -2);
    size2 = size2.slice(0, -2);

    let size1_num = parseInt(size1);
    let size2_num = parseInt(size2);

    size1_num+=grow_rate;
    size2_num+=grow_rate;

    size1 = size1_num.toString() + "px";
    size2 = size2_num.toString() + "px";

    container1.style.height = size1;
    container2.style.height = size2;

    console.info( window.getComputedStyle(container1).height + " " + window.getComputedStyle(container2).height);
    
}

function containersShrink() {
    const container1 = document.getElementById('form_container');
    const container2 = document.getElementById('container_body');

    let size1 = window.getComputedStyle(container1).height;
    let size2 = window.getComputedStyle(container2).height;

    size1 = size1.slice(0, -2);
    size2 = size2.slice(0, -2);

    let size1_num = parseInt(size1);
    let size2_num = parseInt(size2);

    size1_num-=grow_rate;
    size2_num-=grow_rate;

    size1 = size1_num.toString() + "px";
    size2 = size2_num.toString() + "px";

    container1.style.height = size1;
    container2.style.height = size2;
    
}

function renderInvalidMessage(i) {
    
    let invalidMessageName = null;
    let containerName = null;
    if(i===0) {
        invalidMessageName = "invalid_username";
        containerName = "username_container";
    } else if(i===1) {
        
        invalidMessageName = "invalid_password";
        containerName = "password_container";

    } else if(i===2) {
        
        invalidMessageName = "invalid_phone";
        containerName = "phone_container";

    } else if(i===3) {
        
        invalidMessageName = "invalid_email";
        containerName = "email_container";
    } else if(i===4) {
        
        invalidMessageName = "invalid_no";
        containerName = "no_container";
    }
    containersGrow();
    const invalidMessage = document.getElementById(invalidMessageName);
    const container = document.getElementById(containerName);
    invalidMessage.style.display = 'block';
    container.style.borderColor = '#b0706d';
    
}

function hideInvalidMessage(i) {

    let invalidMessageName = null;
    let containerName = null;
    if(i===0) {
        invalidMessageName = "invalid_username";
        containerName = "username_container";
    } else if(i===1) {
        
        invalidMessageName = "invalid_password";
        containerName = "password_container";

    } else if(i===2) {
        
        invalidMessageName = "invalid_phone";
        containerName = "phone_container";
    } else if(i===3) {
        
        invalidMessageName = "invalid_email";
        containerName = "email_container";
    } else if(i===4) {
        
        invalidMessageName = "invalid_no";
        containerName = "no_container";
    }

    const invalidMessage = document.getElementById(invalidMessageName);
    let display = window.getComputedStyle(invalidMessage).display;

    if(display.toString() === "none") { 
        return; 
    }

    const container = document.getElementById(containerName);
    invalidMessage.style.display = "none";
    container.style.borderColor = '#c3cdc0';

    containersShrink();
    
}

function hideInvalidMessages(n) {
    for(let i = 0; i< n; i++) {
        hideInvalidMessage(i);
    }
}

function validateUsername(username) {
    if(username===null) return false;
    if(username.length < 3 || username.length > 10) return false;

    //потребитеслите имена огат да съдържат само букви от латинската азбука и знака "_"; дълги са между 3 и 10 символа
    const regex=/^[a-zA-Z0-9_]*$/g;

    if(!username.match(regex)) return false;

    return true;
}

function validatePassword(password) {
    if(password===null) return false;
    //паролата трябва да съдържа поне 8 символа
    if(password.length <8) return false;

    return true;
}

function validatePhone(phone) {
    if(phone===null) return false;

    //приемат се само телефонни номера в един от следните формати:  0xxxxxxxxx / +359xxxxxxxxx, където x е цифра
    let regex = 1;
    if(phone.length === 10) {
        regex = /^[0]{1}[0-9]{9}$/g;
    }

    if(phone.length === 13) {
        regex = /^[+]{1}359[0-9]{9}$/g;
    }

    if(regex==1) return false;

    console.info(phone);

    if(!phone.match(regex)) return false;

    
    return true;
}

function validateEmail(email) {
    //това го взех наготово
    let regex = /(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/g;

    if(email===null) return false;

    return regex.test(email); 
}

function validateNo(no) {
    //валиден номер е например 158А -> число + буква от латинската азбука 
    let regex = /^[0-9]+[A-Z]{1}$/g;
    if(no===null) return false;
    if(no.length > 5) return false;

    return regex.test(no);
}
function validate(formValues) {

    let valid = true;
    if(!validateUsername(formValues.username)) {
        renderInvalidMessage(0);
        valid=false;
    }

    if(!validatePassword(formValues.password)) {
        renderInvalidMessage(1);
        valid=false;
    }

    if(!validatePhone(formValues.phone)) {
        renderInvalidMessage(2);
        valid=false;
    }

    if(!validateEmail(formValues.email)) {
        renderInvalidMessage(3);
        valid=false;
    }

    if(!validateNo(formValues.app_num)) {
        renderInvalidMessage(4);
        console.info(validateEmail(formValues.app_num));
        valid=false;
    }

    return valid;
}

regForm.addEventListener('submit', (event) => {

    hideInvalidMessages(5);

    const formValues = getFormValues();
    var valid = validate(formValues);

    event.preventDefault();
})