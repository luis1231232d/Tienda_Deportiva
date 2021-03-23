

const ajax = ({url, method, cbSuccess, data}) => {
    fetch(url , {
        body:data,
        method
    })
      .then( res => res.ok ? res.json() : Promise.reject(res))
      .then( data => cbSuccess(data) )
      .catch( err => {
        let messague = err.statusText || "ocurrio un error";
        document.getElementById('main').innerHTML = 
        `
            <div class="error">
                <p> ${err.status} -- ${messague} </p>
            </div>
        `;

        document.querySelector('.Loader').style.display = "none";
        console.log(err);
      });
}

export default ajax;