@extends('admin.layouts.layout')
<style>
    input, label {
        display: block;
    }
    textarea, label {
        display: block;
    }
    .modalInput {
        width: 100%;
        background-color : #F6C163;
        border-right: none;
        border-top: none;
        border-left: none;
        outline: none;
        color: #FFF;
        /*background-color: lightgrey;*/
    }
    .modalInput::placeholder{
        color: #FFF;
    }
    .modalInput:focus{
        font-weight: bold;
    }
    .encabezado {
        color: #FFF;
        font-size: 18px;
    }
</style>
@section('content')
<div class="be-content">
    <div class="page-head">
        <h2 class="page-head-title">Consultas</h2>
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb page-head-nav">
                <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Inicio</a></li>
                <li class="breadcrumb-item active">Consultas</li>
            </ol>
        </nav>
    </div>
    
    <div class="main-content container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-border-color card-border-color-primary">
                    <div class="card-header card-header-divider">
                        Manejador de Consultas Test
                        <span class="card-subtitle"></span>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-2" align="center">
                                <h3>Seleccionar un consulta:</h3>
                                <select id="query_selector">
                                    <option value="0" description="" query="" selected>-</option>
                                    @foreach ($queries as $query)
                                        <option value="{{ $query->id }}" description="{{ $query->description }}" query="{{ $query->query }}">{{ $query->title }}</option>
                                    @endforeach
                                </select>    
                            </div>
                            <div class="col-6" style="height: 100px;">
                                <h4 id="query_description"></h4>
                            </div>
                            <div class="col-4" style="border-style: solid; border-color: #4185F4;" align="center">
                                <h3>Exportar consulta a:</h3>
                                <div class="row" style="margin-left: 150px;">
                                    <form action="{{ url('/admin/export-query-xlsx') }}" method="POST" id="exportToXlsx" autocomplete="off">
                                        {{ csrf_field() }}
                                        <input type="hidden" class="hidden_query" name="export_query_xlsx" id="export_query_xlsx">
                                        <button type="submit" class="btn btn-space btn-warning" id="exportar_xlsx">XLSX</button> 
                                    </form>
                                    <form action="{{ url('/admin/export-query-csv') }}" method="POST" id="exportToCsv" autocomplete="off">
                                        {{ csrf_field() }}
                                        <input type="hidden" class="hidden_query" name="export_query_csv" id="export_query_csv">
                                        <button type="submit" class="btn btn-space btn-danger" id="exportar_csv">CSV</button> 
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                        <div>
                            <form id="form_consulta_manual"
                                data-parsley-validate=""
                                novalidate="">

                                {{ csrf_field() }}
                                <div class="form-group row">
                                    <div class="col-12">
                                        <textarea class="form-control" id="query" class="query" placeholder="Escribe la Consulta" style="min-height: 250px;" required></textarea>
                                    </div>
                                </div>
                                <div class="row pt-3">
                                    <div class="col-sm-12">
                                        <p class="text-right">
                                            <input type="hidden" name="encode_query" id="encode_query">
                                            {{-- <button class="btn btn-space btn-success md-trigger" data-modal="full-success" id="almacena_consulta" type="button">Almacenar</button> --}}
                                            {{-- <button class="btn btn-space btn-success" data-toggle="modal" data-target="#mod-success" id="almacena_consulta" type="button">Success</button> --}}

                                            <button class="btn btn-space btn-warning md-trigger" data-modal="full-warning" id="almacena_consulta" type="button" onclick="openModal()">Almacenar Consulta</button>
                                            
                                            <button class="btn btn-space btn-primary" id="consulta_manual">Consultar</button>
                                        </p>
                                    </div>
                                </div>
                            </form>
                                {{-- <div class="modal-container modal-full-color modal-full-color-success modal-effect-8"  id="full-success"> --}}
                                    
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="card card-table">
                        <div class="card-header">
                            Resultado
                        </div>
                        <div class="card-body">
                            <div class="col-12">
                                <div class="accordion" id="accordion">
                                    <div class="card">
                                        <div class="card-header" id="headingOne">
                                        <button class="btn" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><i class="icon mdi mdi-chevron-right"></i> Table</button>
                                        </div>
                                        <div class="collapse show" id="collapseOne" aria-labelledby="headingOne" data-parent="#accordion" style="">
                                            <div class="card-body">
                                                <h4 class="total"></h4>
                                                <div class="table-responsive noSwipe" id="json_table">
                            
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="headingTwo">
                                            <button class="btn" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapsetwo"><i class="icon mdi mdi-chevron-right"></i> JSON</button>
                                        </div>
                                        <div class="collapse" id="collapseTwo" aria-labelledby="headingTwo" data-parent="#accordion">
                                            <div class="card-body">
                                                <div class="table-responsive noSwipe">
                                                    <h4 class="total"></h4>
                                                    <table id="json"></table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal-container modal-full-color modal-full-color-warning modal-effect-8" id="full-warning" style="perspective: 1300px;">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close modal-close" id="close-modal" type="button" data-dismiss="modal" aria-hidden="true" onclick="closeModal()"><span class="mdi mdi-close"></span></button>
            </div>
            <div class="modal-body">
                <div class="text-center"><span class="modal-main-icon mdi mdi-playlist-plus"></span>
                  <h3>Almacenar Consulta</h3>
                  <form id="store_new_query" method="post" action="">
                      {{ csrf_field() }}
                      <div class="mt-8">
                          <label class="encabezado" for="title">Título: </label>
                          <input type="text" name="title" class="modalInput" id="title" placeholder="Título" required>
                      </div>
                      <div class="mt-8">
                          <label class="encabezado" for="description">Descripción: </label>
                          <input type="text" name="description" class="modalInput" id="description" placeholder="Descripción" required>
                      </div>
                      <div class="mt-8">
                          <label class="encabezado" for="query">Query: </label>
                          <input type="hidden" name="encode_storing_query" id="encode_storing_query">
                          <textarea name="query" class="modalInput" id="new_query" cols="95" rows="5" placeholder="Query"></textarea>
                      </div>
                      
                      <div class="mt-8">
                          <button class="btn btn-success btn-space modal-close" type="button" data-dismiss="modal" id="cancel_store" onclick="closeModal()">Cancel</button>
                          <button class="btn btn-secondary btn-space modal-close" type="button" data-dismiss="modal" id="store_query">Almacenar</button>
                      </div>    
                  </form>
                </div>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script type="text/javascript">
        var secUrl      = '{{ secure_url('') }}';
        var token       = "{{ csrf_token() }}";

        function setbg(color) {
            document.getElementById("query").style.background=color
        }

        /**
         * Opens Modal 
         */
        function openModal() {
            let modal = document.getElementById('full-warning');
            modal.classList.add('modal-show');
            modal.style["perspective"] = "none";
        }

        /**
         * Closes Modal and clears its values
         */
        function closeModal() {
            // Clear inputs before closing
            document.getElementById('title').value = '';
            document.getElementById('description').value = '';
            document.getElementById('new_query').value = '';

            // Close modal
            let modal = document.getElementById('full-warning');
            modal.classList.remove('modal-show');
            modal.style["perspective"] = "1300px";
        }
    </script>

    <script>
        $( document ).ready(function() {
            // Store Query
            $("#store_query").on('click', function(){
                // Encode query to make it able to store it
                $('#encode_storing_query').val( encodeURI( $('#new_query').val() ) );

                $.ajax({
                    data:  $( "#store_new_query" ).serialize(), //datos que se envian a traves de ajax
                    url:   secUrl + '/admin/store_query', //archivo que recibe la peticion
                    type:  'post', //método de envio
                    success:  function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                       location.reload();
                    },
                    error: function(response){
                        // sw_error('Ocurrió un error inesperado.');
                        alert('Falla guardado de consulta');
                    }
                });
            });

            // Show selected query
            $("#query_selector").on("change", function(){
                let description = $('option:selected', this).attr('description');
                $("#query_description").text(description);

                let query = decodeURIComponent($('option:selected', this).attr('query'));
                $("#query").val(query);
                queryChange();
                queryChange2();
            });

            // 
            $('#exportToXlsx').submit(function(event) {
                event.preventDefault(); //this will prevent the default submit

                 $(this).unbind('submit').submit(); // continue the submit unbind preventDefault
            });

            $('#query').bind('input propertychange',function(){
                $('#export_query_csv').val( encodeURI( $(this).val() ) );
                $('#export_query_xlsx').val( encodeURI( $(this).val() ) ); 
            });

            function queryChange()
            {
                $('#export_query_csv').val( encodeURI( $("#query").val() ) );
            }

            function queryChange2()
            {
                $('#export_query_xlsx').val( encodeURI( $('#query').val() ) );
            }

            // 
            $('#exportToCsv').submit(function(event) {
                event.preventDefault(); //this will prevent the default submit

                $('#exportToCsv').attr("action", $('#exportToCsv').attr("action") +"?"+ Math.floor(Math.random() * 9999999) );
 
                 $(this).unbind('submit').submit(); // continue the submit unbind preventDefault
            });
        });
    </script>

    <script src="{{ asset('/assets_admin/js/query_admin.js') }}"></script>
@endsection
