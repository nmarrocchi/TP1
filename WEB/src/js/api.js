// Clé de l'API
mapboxgl.accessToken = 'pk.eyJ1IjoiMHZlcmRyYXciLCJhIjoiY2t1ZHFna2k4MWQ1YzMybDlzOWMxbnI2ZyJ9.UBRgQa9a0LYDml-i4GjR0Q';

const map = new mapboxgl.Map({
    container: 'map',
    style: 'mapbox://styles/mapbox/streets-v11',
    center: [2.2997429, 49.8775471], // Initialisation de la longitude et de la latitude
    zoom: 1
});

var time = setInterval(function(){
    try{
        fetch('src/api/coordonnee.php', {
            method: 'post'
        }).then(function(response){
            return response.json();        
        }).then(function (data){

            const point = {
                'type': 'geojson',
                'data': {
                    'type': 'Feature',
                    'properties': {},
                    'geometry': {
                        'type': 'LineString',
                        'coordinates': []
                    }
                }
            };

            for(var i = 0; i < data.length; i++){
                marker(data[i], map, point);
                color = data[i]["color"];
            }

            const trace = {
                'id': 'trace',
                'type': 'line',
                'source': 'trace',
                'paint': {
                    'line-color': color,
                    'line-opacity': 0.75,
                    'line-width': 5
                }
            };
            
            map.addSource('trace', point);
            map.addLayer(trace);
        })
    }catch (error){
        console.error(error);
    }        
}, 1000);

function marker(data, map, point){
    var id = data["id"];
    var idBoat = data["idBoat"];
    var name = data["name"];
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

    const popup = new mapboxgl.Popup({ offset: 25 }).setHTML(
        '<h3>['+longitude+', '+latitude+']</h3><p>ID Bateau: '+idBoat+'</p><p>Nom Bateau: '+name+'</p><p>Date: '+date+'</p>'
    );
    // Ajoute le marker sur la map.
    new mapboxgl.Marker(el).setLngLat([longitude, latitude]).setPopup(popup).addTo(map);

    point.data.geometry.coordinates.push([longitude, latitude]);
}