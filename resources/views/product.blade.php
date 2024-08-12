@extends('master')

@section('content')
<!-- ============================================-->
<!-- <section> begin ============================-->
<section class="py-4 overflow-hidden">

    <div class="container">
        <div class="row h-100">
            <div class="col-12 mx-auto text-center mt-7 mb-5">
                <h5 class="fw-bold fs-3 fs-lg-5 lh-sm">Product</h5>
            </div>
            @include('alert')
            @if(isset($form))
                @if($form == 'store')
                    <livewire:add-product />
                @else
                    <livewire:edit-product :product="$product"/>
                @endif
            @else
                <livewire:product />
            @endif
        </div>
    </div><!-- end of .container-->

</section>
<!-- <section> close ============================-->
<!-- ============================================-->
@endsection
