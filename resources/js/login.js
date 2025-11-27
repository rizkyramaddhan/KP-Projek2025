const icon =  document.getElementById("icon-password");
const inputPassword = document.getElementById("inputPassword");
const inputUsernameOrEmail = document.getElementById("inputUsernameOrEmail");
const form = document.getElementById("formLogin");


icon.addEventListener('click', () => {
    if(document.getElementsByClassName('bi-eye-slash-fill')[0].style.display == 'none'){
        document.getElementsByClassName('bi-eye-slash-fill')[0].style.display = 'block';
        document.getElementsByClassName('bi-eye-fill')[0].style.display = 'none';
        document.getElementById('inputPassword').setAttribute('type', 'password');
    }else{
        document.getElementsByClassName('bi-eye-slash-fill')[0].style.display = 'none';
        document.getElementsByClassName('bi-eye-fill')[0].style.display = 'block';
        document.getElementById('inputPassword').setAttribute('type', 'text');
    }
})

form.addEventListener('submit', (event) => {
    // event.preventDefault();
})


