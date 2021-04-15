var justOne     = false;
var limitPoints = 400

/*
* Metodo que se usa para poder avisar que ya esta terminado el juego
*/
function setValueP(data = 0) 
{
    console.log(data)
    /* set points */
    if ( !justOne ) {
        justOne = true
        gData = data;
        endGData();
    }
}

function setValueEveryPoint(data) 
{
    console.log(data)
    if ( data < limitPoints ) {
        gData = data;
    } else {
        gData = data;
        endGData();
    }
}