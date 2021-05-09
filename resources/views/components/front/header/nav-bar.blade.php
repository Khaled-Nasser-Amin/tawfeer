<div class="w-100 p-0" >
    <div class="nav-section header-sticky ">
        <div class="primary-nav-section">

            <ul class="nav primary clone-main-menu" id="mercado_main" data-menuname="Main menu" >
                <li class="menu-item home-icon">
                    <a href="{{route('front.dashboard')}}" class="link-term mercado-item-title " ><i class="fa fa-home" aria-hidden="true"></i> {{__('text.Home')}}</a>
                </li>
                @auth('vendor')
                    <li class="menu-item"><a href="#" class="link-term mercado-item-title">{{__('text.My Products')}}</a></li>
                    <li class="menu-item"><a href="{{route('front.profile.show')}}" class="link-term mercado-item-title">{{__('text.My Accounts')}}</a></li>
                @endauth
                @guest('vendor')
                <li class="menu-item"><a href="{{route('front.loginView')}}" class="link-term mercado-item-title">{{__('text.Login')}}</a></li>
                <li class="menu-item"><a href="{{route('front.registerView')}}" class="link-term mercado-item-title">{{__('text.Register')}}</a></li>
                @endguest
            </ul>
        </div>
    </div>
</div>
