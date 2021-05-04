<div class="topbar-menu-area">
    <div class="container">
        <div class="topbar-menu left-menu">
            <ul>
                <li class="menu-item" >
                    <a title="Hotline: (+123) 456 789" href="#" ><span class="icon label-before fa fa-mobile"></span>Hotline: (+123) 456 789</a>
                </li>
            </ul>
        </div>
        <div class="topbar-menu right-menu">
    <ul>
        <li class="menu-item" ><a title="Register or Login" href="{{route('front.loginView')}}">Login</a></li>
        <li class="menu-item" ><a title="Register or Login" href="{{route('front.registerView')}}">Register</a></li>
        <li class="menu-item lang-menu menu-item-has-children parent">
            <a title="{{app()->getLocale() == 'ar' ? 'العربية' :'English'}}" href="#">
                <span class="img label-before">
                    <img style="width: 25px;height: 25px" src="{{app()->getLocale() == 'en' ? asset('front/images/lang-en.png'):asset('images/flags/arabic.png')}}" alt="lang-{{app()->getLocale()}}">
                </span>{{app()->getLocale() == 'en' ? 'English' :'العربية'}}
            <i class="fa fa-angle-down" aria-hidden="true"></i>
            </a>
            <ul class="submenu lang" >
                <li class="menu-item" >
                    <a href="{{App::getLocale() == 'ar' ? LaravelLocalization::getLocalizedURL('en', null, [], true) :   LaravelLocalization::getLocalizedURL('ar', null, [], true) }}" class="dropdown-item">
                        <span class="img label-before">
                        <img style="width: 25px;height: 25px" src="{{app()->getLocale() == 'ar' ? asset('front/images/lang-en.png') : asset('images/flags/arabic.png')}}" alt="user-image" class="mr-2 d-inline" height="12">
                        </span>{{app()->getLocale() == 'ar' ? 'English' :'العربية'}}
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</div>
    </div>
</div>
