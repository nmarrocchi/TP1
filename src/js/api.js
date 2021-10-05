function coordonnee(){
    fetch('coordonnée.php').then((resp) => resp.json()).then(function(data) {
        console.log(data);
    })
    .catch(function(error) {
    console.log(error);
    });
   }
