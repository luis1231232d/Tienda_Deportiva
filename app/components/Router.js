import Login from './login/Login.js';

const Router = () => {
    let { hash } = location;
    const $main = document.getElementById("main");
    $main.innerHTML = null;

    if( !hash || hash === "#/" ){
        Login();
    }else if(true){

    }
}

export default Router;