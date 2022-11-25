@extends('layouts.app')

@section('title', 'Home-admin')

@section('content')

@if (session('status'))
<div class="alert alert-success" role="alert">
  {{ session('status') }}
</div>
@endif
<h1 class="text-center">Bienvenido {{ Auth::user()->name }} </h1>
<div class="col-md-6 offset-md-3">
  <form method="POST" id="form_productos" action="{{ route('generarFactura.create') }}">
    @csrf
    <button type="submit" class="btn btn-primary col-md-6 offset-md-3">Procesar Facturas</button>
  </form>
</div>

@if($facturas->isEmpty())
<h2 class="text-center">No hay facturas procesadas</h2>
@else
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <table id='tabla_facturas' class="table table-striped" style="width:100%;">
        <h1>Lista de Facturas</h1>
        <thead>
          <tr>
            <th class="text-start" scope="col">Usuario</th>
            <th class="text-start" scope="col">Monto Total</th>
            <th class="text-start" scope="col">Impuesto Total</th>
            <th class="text-start" scope="col">Detalle</th>
            <th class="text-start" scope="col">Acción</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($facturas as $factura)
          <tr>
            <th scope="row">{{ $factura->user->name }}</th>
            <td class="text-center">{{ $factura->monto_total }}</td>
            <td class="text-center">{{ $factura->impuesto_total }}</td>
            <td>
              @foreach($factura->compras as $compra)
              <ul class="list-group list-group-flush">
                <li class="list-group-item"> Nombre: {{$compra->productos[0]->nombre}} Precio:{{$compra->productos[0]->precio}} Impuesto: {{$compra->productos[0]->impuesto}}</li>
              </ul>
                @endforeach
            </td>
            <td> 
            <a class="btn btn-sm btn-primary " href="{{ route('facturas.show',$factura->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endif


@endsection
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
@extends('layouts.footer')
<script type="text/javascript">
  $(document).ready(function() {
    $('#tabla_facturas').DataTable({
      dom: 'Bfrtip',
        buttons: [
             'pdf', 'print'
        ],
      "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
      }
    });
  });
</script>