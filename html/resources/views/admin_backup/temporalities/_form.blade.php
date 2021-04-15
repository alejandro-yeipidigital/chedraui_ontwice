<div class="row">

    <div class="col-lg-2">
        <label for="start_at">Temp</label>
        <input type="number" name="number" class="form-control" value="{{ old("start_date_at", $temporality->number ) }}">
    </div>

    <div class="col-lg-5">
        <label for="start_at">Fecha Inicio</label>
        <div class="row">
            <div class="col">
                <input type="text" class="form-control datepicker" name="start_date_at" placeholder="Fecha Inicio" required value="{{ old("start_date_at", $temporality->start_at_separated['date'] ) }}">
            </div>
            <div class="col">
                <input type="time" class="form-control" name="start_time_at" placeholder="Hora Inicio" required value="{{ old("start_date_at", $temporality->start_at_separated['time']) }}">
            </div>
        </div>
        
        @error('start_at')
            <small class="error">{{ $message }}</small>
        @enderror
    </div>

    <div class="col-lg-5">
        <label for="finish_at">Fecha Fin</label>
        <div class="row">
            <div class="col">
                <input type="text" class="form-control datepicker" name="finish_date_at" placeholder="Fecha Fin" required value="{{ old("start_date_at", $temporality->finish_at_separated['date'] ) }}">
            </div>
            <div class="col">
                <input type="time" class="form-control" name="finish_time_at" placeholder="Hora Inicio" required  value="{{ old("finish_time_at", $temporality->finish_at_separated['time']) }}">
            </div>
        </div>
        @error('finish_at')
            <small class="error">{{ $message }}</small>
        @enderror
    </div>
</div>

<div align='center'>
    <br>
    <button type="submit" class="btn btn-danger">
        <i class="fas fa-save"></i> {{ $btn }} 
    </button>
</div>

@section('js')
    <script>
        $(function(){
            $( ".datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
        })
    </script>
@endsection