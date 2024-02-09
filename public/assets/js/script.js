fetch('https://127.0.0.1:8000/api/produits')
    .then((res) => res.json())
    .then(data => {
        console.dir(data);
        let output = '';
        data['hydra:member'].forEach(item => {
            output += `
     <div class="oneuser">
     <h4>${item.nom}</h4>
     <img src="${item.image}">
     <h5>${item.prix}</h5>
     </div>
      `;
        });
        document.getElementById("user").innerHTML = output;
    })
    .catch((error) => { console.log(error); })