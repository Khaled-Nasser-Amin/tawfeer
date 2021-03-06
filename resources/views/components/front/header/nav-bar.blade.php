<div class="w-100 p-0" >
    <div class="nav-section header-sticky ">
        <div class="primary-nav-section">

            <ul class="nav primary clone-main-menu" id="mercado_main" data-menuname="Main menu" >
                <li class="menu-item home-icon">
                    <a href="{{route('front.dashboard')}}" class="link-term mercado-item-title " ><i class="fa fa-home" aria-hidden="true"></i> {{__('text.Home')}}</a>
                </li>
                <li class="menu-item"><a href="{{route('front.shop')}}" class="link-term mercado-item-title">{{__('text.Shop')}}</a></li>

            @auth('vendor')
                    <li class="menu-item"><a href="{{route('front.myProducts')}}" class="link-term mercado-item-title">{{__('text.My Products')}}</a></li>
                    <li class="menu-item"><a href="{{route('front.profile.show')}}" class="link-term mercado-item-title">{{__('text.My Accounts')}}</a></li>
                @endauth
                @guest('vendor')
                <li class="menu-item"><a href="{{route('front.loginView')}}" class="link-term mercado-item-title">{{__('text.Login')}}</a></li>
                @endguest
            </ul>
        </div>
    </div>
</div>
