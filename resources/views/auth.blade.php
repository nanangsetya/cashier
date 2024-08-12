@extends('master')

@section('content')
<!-- ============================================-->
<!-- <section> begin ============================-->
<section class="pb-5 pt-8">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card card-span mb-3 shadow-lg">
                    <div class="card-body py-0">
                        <div class="row justify-content-center">
                            <div class="col-md-5 col-xl-7 col-xxl-8 g-0 order-0 order-md-1"><img class="img-fluid w-100 fit-cover h-100 rounded-top rounded-md-end rounded-md-top-0" src="{{ asset('assets/assets/img/gallery/cashier.jpg') }}" alt="..." /></div>
                            <div class="col-md-7 col-xl-5 col-xxl-4 p-4 p-lg-5">
                                <h1 class="card-title mt-xl-5 mb-4">Login to <span class="text-primary"> Proceed</span></h1>
                                <livewire:auth />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- end of .container-->
</section>
<!-- <section> close ============================-->
<!-- ============================================-->
@endsection
