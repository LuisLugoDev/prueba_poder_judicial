@extends('layouts.app')

@section('template_title')
Factura Nro. {{ $factura->id }}
@endsection

@section('content')
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="mb-2 float-left">
                <a class="btn btn-primary btn-sm float-right" href="{{ URL::previous() }}">{{ __('Back') }}</a>
            </div>
            <div class="card">
                <div class="card-header">
                </div>

                <div class="card-body">

                    <table id='tabla_facturas' class="table table-striped" style="width:100%;">
                        <h1>Factura Nro. {{ $factura->id }}</h1>
                        <thead>
                            <tr>
                                <th class="text-start" scope="col">Usuario</th>
                                <th class="text-start" scope="col">Monto Total</th>
                                <th class="text-start" scope="col">Impuesto Total</th>
                                <th class="text-start" scope="col">Detalle</th>
                            </tr>
                        </thead>
                        <tbody>
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
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</section>
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
            buttons: [{
                extend: 'pdfHtml5',
                title: `Factura Nro. {{ $factura->id }}`,
            }],
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
            }
        });
    });
</script>