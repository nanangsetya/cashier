<div>
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                <h2>Transaksi</h2>
            </div>
            <div class="col-12">
                <div class="row">
                    <div class="col-md-6">
                        <select name="" class="form-control" wire:model='month' wire:change="showTable($event.target.value)" wire:ignore>
                            @foreach($months as $m => $v)
                                <option value="{{ $m }}">{{ $v }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <select name="" class="form-control" wire:model='year' wire:change="showTable($event.target.value)">
                            @foreach($years as $y)
                                <option value="{{ $y }}">{{ $y }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-12" wire:ignore>
                <table id="example" class="table table-hover" style="width:100%">
                    <thead class="table-dark">
                        <tr>
                            <th>Datetime</th>
                            <th>Product</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $d)
                            <tr>
                                <td align="left">{{ $d->created_at }}</td>
                                <td>{{ $d->product->name }}</td>
                                <td align="right">{{ number_format($d->qty,0,",",".") }}</td>
                                <td align="right">{{ number_format($d->price,0,",",".") }}</td>
                                <td align="right">{{ number_format($d->price * $d->qty,0,",",".") }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="table-dark">
                        <tr>
                            <th>Datetime</th>
                            <th>Product</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th>Total</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
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

        document.addEventListener('renderTable', (e) => {
            table.rows().remove().draw();
            table.rows.add(JSON.parse(e.detail[0].item)).draw()
        })

    </script>
@endpush
