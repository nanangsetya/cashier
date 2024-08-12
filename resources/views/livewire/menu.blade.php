@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.3/dist/sweetalert2.min.css">
@endpush

<div class="row">
    <div class="col-9">
        <div class="row mb-3">
            <div class="col-12">
                <form class="row gx-2 gy-2 align-items-center">
                    <div class="col">
                        <div class="input-group-icon"><i class="fas fa-search text-danger input-box-icon"></i>
                            <label class="visually-hidden" for="inputDelivery">Find</label>
                            <input class="form-control input-box form-foodwagon-control" id="inputMenu" type="text" placeholder="Find Menu" onkeyup="menuFilter()" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row gx-3 align-items-center" id="menu-list">
            @foreach($products as $p)
                <div class="col-sm-3 col-md-2 col-xl-2 mb-5 h-100">
                    <div class="card card-span h-100 rounded-3"><img class="img-fluid rounded-3 h-100" src="{{ $p->image ? $p->image : asset('assets/assets/img/gallery/cheese-burger.png') }}" alt="..." />
                        <div class="card-body ps-0">
                            <h5 class="fw-bold text-1000 text-truncate mb-1">{{ $p->name }}</h5>
                            <span class="text-warning fw-bold float-end">Rp {{ number_format($p->price,0,",",".") }}</span>
                        </div>
                    </div>
                    <div class="d-grid gap-2"><button type="button" wire:click="storeCart({{ $p->id }})" class="btn btn-lg btn-danger" role="button" style="padding: 0.5rem 1rem"><i class="fa fa-shopping-cart"></i> Add to Cart</button></div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="col-3" style="border-left: 1px solid #ececec;">
        <div class="row">
            <div class="col-12">
                <h2>Cart</h2>
            </div>
            @foreach($carts as $c)
                <div class="col-12 mt-3">
                    <div class="row">
                        <div class="col-12">
                            <div class="pl-2">
                                <div class="row">
                                    <div class="col-6">
                                        <h4>{{ $c->name }}</h4>
                                        <h5 class="text-danger">Rp {{ number_format($c->price,0,",",".") }}</h5>
                                    </div>
                                    <div class="col-6 align-middle">
                                        <button type="button" wire:click="add({{ $c->id }})" class="btn btn-warning btn-sm float-end px-2 mx-3"><i class="fa fa-plus"></i></button>
                                        <h4 class="float-end">{{ $c->quantity }}</h4>
                                        <button type="button" wire:click="reduce({{ $c->id }})" class="btn btn-warning btn-sm float-end px-2 mx-3"><i class="fa fa-minus"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr style="width: 90%; margin: auto; height: 0.5px; color: #ececec;" style="py-2">
            @endforeach
            <div class="col-12">
                <div class="row mt-4">
                    <div class="col-6">
                        <h3>Total</h3>
                    </div>
                    <div class="col-6">
                        <h4 class="text-danger float-end">Rp {{ number_format(Cart::getSubTotal(),0,",",".") }}</h4>
                    </div>
                    <div class="col-12">
                        @if($carts->count() > 0)
                            <button type="button" class="btn btn-sm btn-warning" style="width:100%" onclick="storeOrder()"><i class="fas fa-file-invoice-dollar"></i> Buat Transaksi</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script src="{{ asset('assets/js/foodFilter.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.3/dist/sweetalert2.all.min.js"></script>
    <script>
        function storeOrder() {
            Swal.fire({
                title: "Pesanan sudah sesuai ?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, simpan transaksi!"
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.dispatch('store-order')
                }
            });
        }

        window.addEventListener('notification', (e) => {
            Swal.fire({
                icon: e.detail[0].icon,
                title: e.detail[0].message,
                showConfirmButton: e.detail[0].icon == 'success' ? false : true,
                timer: 1500
            });
            if (e.detail[0].icon == 'success') {
                delay(2000).then(() => location.reload())
            }
        });

    </script>
@endpush
