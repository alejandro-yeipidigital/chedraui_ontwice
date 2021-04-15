@extends('admin.layouts.main')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Temporalidades') }}</div>
                    <div class="card-body">                 

                        <div class="row  justify-content-md-center">
                            <div class="col-md-4">
                                <select name="temporality" id="temporality" class="form-control temporalitySelect">
                                    <option value="0">- Seleccione Temporalidad -</option>
                                    @for ($c = 1; $c <= $temporality ; $c++)
                                        <option value="{{ $c }}">Temporalidad {{ $c }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>

                        <br>

                        <table class="table table-striped table-sm">
                            <thead class="thead-dark">
                                <tr>
                                    <th>User ID</th>
                                    <th>Name</th>
                                    <th>E-mail</th>
                                    <th>Points</th>
                                    <th>
                                        <div align='right'>Ganador</div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="tbody">
                                <tr>
                                    <td colspan='8'>
                                        <h3 align='center'>No se encontraron coincidencias</h3>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('js')
    <script>
        var winners     = {!! json_encode($usersByTemporality) !!};
        var url         = "{{ url("/") }}";

        $(function(){
            // rad event when select change
            $('.temporalitySelect').on('change', function(){
                let temporality = $(this).val();
                if ( temporality != 0 ) {
                    prinTableWinners( temporality );
                }
            });
            console.log(winners[0].users[0].user);
        })

        let prinTableWinners = function(temporality = -1) {
            if ( temporality >= 0 ) {
                let users   = winners[ temporality - 1 ].users

                if ( users.length > 0 ) {    
                    $('.tbody').html('');

                    for ( user of users ) {
                        let html    = `<tr>
                                            <th>${ user.user.id }</th>
                                            <th>${ user.user.name }</th>
                                            <th>${ user.user.email }</th>
                                            <th>${ user.validated_points.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") }</th>
                                            <th>
                                                <div align='right'>
                                                    <a href='${ url }/admin/winners/${ user.id }/changeStatus' class="btn btn-${ ( user.winner == 1) ? 'success' : 'outline-secondary' }">
                                                        <i class="fas fa-toggle-on"></i>
                                                    </a>
                                                </div>
                                            </th>
                                        </tr>`

                        $('.tbody').append(html);
                    }

                } else {
                    $('.tbody').html(`  <tr>
                                            <td colspan='8'>
                                                <h3 align='center'>No se encontraron coincidencias</h3>
                                            </td>
                                        </tr>`);
                }
            }
        }

        @if ( session('status') )
            Swal.fire({
                text: '{{ session('status')['message'] }}',
                icon: '{{ session('status')['status'] }}',
                showConfirmButton: false,
                timer: 2000
            })
        @endif
    </script>    
@endsection
