<div>
    <div class="col-12"><a href="{{ route('add-product') }}" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Add Product</a></div>
    <div class="col-12">
        <table id="example" class="table table-hover" style="width:100%">
            <thead class="table-dark">
                <tr>
                    <th>Product</th>
                    <th>Tipe</th>
                    <th>Price</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $p)
                    <tr>
                        <td>{{ $p->name }}</td>
                        <td>{{ $p->type->name }}</td>
                        <td align="right">{{ number_format($p->price,0,",",".") }}</td>
                        <td align="right"><a href="{{ route('edit-product', ['id' => $p->id]) }}" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a></td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot class="table-dark">
                <tr>
                    <th>Product</th>
                    <th>Tipe</th>
                    <th>Price</th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.3/css/dataTables.bootstrap5.css">
@endpush

@push('scripts')
    <script src="https://cdn.datatables.net/2.1.3/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.3/js/dataTables.bootstrap5.js"></script>
    <script>
        var table = new DataTable('#example', {
            ordering: false
        });

    </script>
@endpush
