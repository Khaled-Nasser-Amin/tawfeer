@section('title',__('text.Home'))
@push('css')
    @livewireStyles
@endpush

    <x-front.dashboard.latest-products :latestProducts="$latestProducts"/>
    <x-front.dashboard.special-products :specialProducts="$specialProducts"/>

@push('script')
    @livewireScripts

    @if (LaravelLocalization::getCurrentLocale() == 'ar')
        <script>
            $('.owl-carousel').owlCarousel({
                rtl:true,
                loop:false,
                margin:10,
                nav:true,
                navClass:["owl-next","owl-prev"],
                responsive:{
                    0:{
                        items:1
                    },
                    600:{
                        items:3
                    },
                    1000:{
                        items:5
                    },
                }
            })

            $('.owl-next').html('<i class="fa fa-angle-right" aria-hidden="true"></i>')
            $('.owl-prev').html('<i class="fa fa-angle-left" aria-hidden="true"></i>')
        </script>
    @endif
@endpush
