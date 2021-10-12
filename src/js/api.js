// Clé de l'API
mapboxgl.accessToken = 'pk.eyJ1IjoiMHZlcmRyYXciLCJhIjoiY2t1ZHFna2k4MWQ1YzMybDlzOWMxbnI2ZyJ9.UBRgQa9a0LYDml-i4GjR0Q';

const map = new mapboxgl.Map({
    container: 'map',
    style: 'mapbox://styles/mapbox/streets-v11',
    center: [2.2997429, 49.8775471], // Initialisation de la longitude et de la latitude
    zoom: 1
});

//var time = setInterval(function(){
    try{
        fetch('src/api/coordonnee.php', {
            method: 'post'
        }).then(function(response){
            return response.json();        
        }).then(function (data){
            for(var i = 0; i < data.length; i++){
                marker(data[i], map);
            }
        })
    }catch (error){
        console.error(error);
    }        
//}, 10000);

function marker(data, map){
    var id = data["id"];
    var longitude = data["longitude"];
    var latitude = data["latitude"];
    var date = data["date"];
    var color = data["color"];

    // Création du marker
    var el = document.createElement('div');
    el.className = 'marker';
    el.style.backgroundColor = color;
    el.style.border = "solid black 1px";
    el.style.borderRadius = '10px'
    el.style.width = '15px';
    el.style.height = '15px';
    el.style.backgroundSize = '100%';

    // Ajoute le marker sur la map.
    new mapboxgl.Marker(el).setLngLat([longitude, latitude]).addTo(map);
}
