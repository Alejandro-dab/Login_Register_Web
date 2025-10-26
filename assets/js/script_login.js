//Alternancia entre Login-Register

//Botones
const register_btn = document.getElementById('register_btn--go');
const login_btn = document.getElementById('login_btn--go')

//Formularios
const form_login = document.getElementById('form__login')
const form_register = document.getElementById('form__register')

//Alternar Login-Registro
function mostrar_registro(){
    //Ocultar login
    form_login.classList.add('oculto');
    //Mostrar register
    form_register.classList.remove('oculto');
}
function mostrar_login(){
    //Ocultar registro
    form_register.classList.add('oculto');
    //Mostrar login
    form_login.classList.remove('oculto');
}

//Alternancia al dar click
if(register_btn){
    register_btn.addEventListener('click', mostrar_registro);
}
if(login_btn){
    login_btn.addEventListener('click', mostrar_login);
}

