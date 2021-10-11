var time = setInterval(function(){
    try{
        fetch('src/api/coordonnee.php', {
            method: 'post'
        }).then(function(response){
            return response.json();        
        }).then(function (data){
            var latitude = data[0];
            var longitude = data[1];
        })
    }catch (error){
        console.error(error);
    }        
}, 1000);