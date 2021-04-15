$( document ).ready(function() {

    function sw_error( error )
    {
        return swal("Error", error, "error");
    }

    $('#table').change(function() {
        $('#columns').empty().append('<option disabled selected> Cargando . . . </option>');
        $.getJSON(secUrl + '/admin/get_columns/' + $('#table').val(), function(data) {
            // $('#columns');
            // $('#columns').empty().append('<option disabled> Seleccione las columnas requeridas </option>');
            $('#columns').empty().append('<option  value="select_all"> * </option>');
            $.each(data, function(id, column) {
                $('#columns').append('<option value="' + column + '"">' + column + '</option>');
            });
        });
    });

    // Resalta la sintaxis de un JSON de acuerdo al tipo de dato
    function syntaxHighlight(json) {
        if (typeof json != 'string') {
             json = JSON.stringify(json, undefined, 2);
        }
        json = json.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
        return json.replace(/("(\\u[a-zA-Z0-9]{4}|\\[^u]|[^\\"])*"(\s*:)?|\b(true|false|null)\b|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?)/g, function (match) {
            var cls = 'number';
            if (/^"/.test(match)) {
                if (/:$/.test(match)) {
                    cls = 'key';
                } else {
                    cls = 'string';
                }
            } else if (/true|false/.test(match)) {
                cls = 'boolean';
            } else if (/null/.test(match)) {
                cls = 'null';
            }
            return '<span class="' + cls + '">' + match + '</span>';
        });
    }

    // Recibe un JSON y genera una tabla a partir de el
    function json_to_table( respuesta )
    {
        // EXTRACT VALUE FOR HTML HEADER. 
        // ('Book ID', 'Book Name', 'Category' and 'Price')
        var col = [];
        for (var i = 0; i < respuesta.length; i++) {
            for (var key in respuesta[i]) {
                if (col.indexOf(key) === -1) {
                    col.push(key);
                }
            }
        }

        // CREATE DYNAMIC TABLE.
        var table = document.createElement("table");
        table.setAttribute('class', 'table table-sm table-hover table-bordered table-striped');

        // CREATE HTML TABLE HEADER ROW USING THE EXTRACTED HEADERS ABOVE.

        var tr = table.insertRow(-1);                   // TABLE ROW.

        for (var i = 0; i < col.length; i++) {
            var th = document.createElement("th");      // TABLE HEADER.
            th.innerHTML = col[i];
            tr.appendChild(th);
        }

        // ADD JSON DATA TO THE TABLE AS ROWS.
        for (var i = 0; i < respuesta.length; i++) {

            tr = table.insertRow(-1);

            for (var j = 0; j < col.length; j++) {
                var tabCell = tr.insertCell(-1);
                tabCell.innerHTML = respuesta[i][col[j]];
            }
        }

        // FINALLY ADD THE NEWLY CREATED TABLE WITH JSON DATA TO A CONTAINER.
        var divContainer = document.getElementById("json_table");
        divContainer.innerHTML = "";
        divContainer.appendChild(table);


        return true;
    }

    // Realizar consulta visual
    $('#consultar').on("click", function(e) {
        e.preventDefault();
        // Validar tabla
        if( $('#table').val() == '' || $('#table').val() == null ) {
            sw_error('Debe seleccionar una tabla');
            return false;
        }

        // Validar columnas
        if( $('#columns').val() == 0) {
            sw_error('Debe seleccionar al menos una columna');
            return false;
        }

        // Envía datos para realizar la consulta
        $.ajax({
            data:  $( "#form_consulta" ).serialize(), //datos que se envian a traves de ajax
            url:   secUrl + '/admin/execute_query', //archivo que recibe la peticion
            type:  'post', //método de envio
            // beforeSend: function () {
            //         $("#resultado").html("Procesando, espere por favor...");
            // },
            success:  function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                let encabezado = response.columnas;
                let respuesta = response.resultado.resultado;

                $(".total").html( "Total de resultados: " + response.total_resultados);
                $('#json').empty();

                var trHTML = '';
                $.each(respuesta, function (i, item) {
                    trHTML += '<tr><td>' + syntaxHighlight( JSON.stringify(item, null, 2) ) + '</td></tr>';
                });
                $('#json').append(trHTML);

                // DESPLEGAR JSON EN TABLA
                json_to_table( respuesta );
            },
            error: function(response){
                sw_error('Ocurrió un error inesperado.');
            }
        });
    });

    // Realizar consulta manual
    $('#consulta_manual').on("click", function(e) {
        e.preventDefault();
        // Válida que el textarea no esté vacío
        if( $('#query').val() == '' ) {
            sw_error('Debe generar una consulta a la BD.');
            return false;
        }

        // Url encode query
        $('#encode_query').val( encodeURI( $('#query').val() ) );

        // Envía datos para realizar la consulta
        $.ajax({
            data:  $( "#form_consulta_manual" ).serialize(), //datos que se envian a traves de ajax
            url:   secUrl + '/admin/execute_manual_query', //archivo que recibe la peticion
            type:  'post', //método de envio
            // beforeSend: function () {
            //         $("#resultado").html("Procesando, espere por favor...");
            // },
            success:  function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                // Limpiar tabla
                $('#json').empty();
                $('#json_table').empty();
                $('.total').empty();

                if (response.success == true) {
                    // Desplegar total de resultados
                    $(".total").html( "Total de resultados: " + response.total_resultados);

                    // Llenar tabla
                    let respuesta = response.resultado;
                    var trHTML = '';
                    $.each(respuesta, function (i, item) {
                        trHTML += '<tr><td>' + syntaxHighlight( JSON.stringify(item, null, 2) ) + '</td></tr>';
                    });
                    $('#json').append(trHTML);

                    // DESPLEGAR JSON EN TABLA
                    json_to_table( respuesta );

                } else { 
                    sw_error( response.resultado );
                }   
            },
             error: function(response){
                sw_error('Ocurrió un error inesperado.');
            }
        });
    });
});