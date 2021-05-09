<div class="topbar-menu-area mx-0 px-0 row justify-content-center align-items-center w-100">
    <div class="container">
        <div class="topbar-menu left-menu">
            <ul>
                <li class="menu-item" >
                    @if (\App\Models\User::find(1)->phone)
                        <a title="Hotline: {{\App\Models\User::find(1)->phone}}" href="#" ><span class="icon label-before fa fa-mobile"></span>Hotline: {{\App\Models\User::find(1)->phone}}</a>
                    @endif
                </li>
            </ul>
        </div>
        <div class="topbar-menu right-menu">
            <ul>
        @guest('vendor')
            <li class="menu-item" ><a title="Register or Login" href="{{route('front.loginView')}}">{{__('text.Login')}}</a></li>
            <li class="menu-item" ><a title="Register or Login" href="{{route('front.registerView')}}">{{__('text.Register')}}</a></li>
        @endguest
        @auth('vendor')

                <li class="menu-item" >
                    <a href="#" onclick="event.preventDefault();document.getElementById('form-logout').submit()" >
                        <i class="fa fa-sign-out"></i>
                        <span>{{__('text.Logout')}}</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a  href="{{route('front.profile.show')}}" >
                        <img src="{{auth()->guard('vendor')->user()->image}}" alt="user-image" class="rounded-circle" style="width: 35px; height: 35px">
                        <span class="d-none d-sm-inline-block ml-1">{{ auth()->guard('vendor')->user()->name }}</span>
                    </a>
                </li>
        @endauth


        <li class="menu-item lang-menu menu-item-has-children parent">
            <a title="{{app()->getLocale() == 'ar' ? 'العربية' :'English'}}" href="#">
                <span class="img label-before">
                    <img style="width: 25px;height: 25px" src="{{app()->getLocale() == 'en' ? asset('front/images/lang-en.png'):asset('images/flags/arabic.png')}}" alt="lang-{{app()->getLocale()}}">
                </span>{{app()->getLocale() == 'en' ? 'English' :'العربية'}}
            <i class="fa fa-angle-down" aria-hidden="true"></i>
            </a>

            <ul class="submenu lang p-0 m-0" >
                <li class="menu-item p-0 m-0" >
                    <a href="{{App::getLocale() == 'ar' ? LaravelLocalization::getLocalizedURL('en', null, [], true) :   LaravelLocalization::getLocalizedURL('ar', null, [], true) }}" class="dropdown-item">
                        <span class="img label-before">
                        <img style="width: 25px;height: 25px" src="{{app()->getLocale() == 'ar' ? asset('front/images/lang-en.png') : asset('images/flags/arabic.png')}}" alt="user-image" class="mr-2 d-inline" height="12">
                        </span>{{app()->getLocale() == 'ar' ? 'English' :'العربية'}}
                    </a>
                </li>
            </ul>
        </li>
    </ul>
            <form method="POST" action="{{route('front.logout')}}"  id="form-logout">
                @method('post')
                @csrf
            </form>
        </div>
    </div>
</div>
