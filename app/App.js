import Router from './components/Router.js';

const App = () => {
    const $root = document.getElementById("root");

    $root.innerHTML = null;
    Router();
}


export default App;