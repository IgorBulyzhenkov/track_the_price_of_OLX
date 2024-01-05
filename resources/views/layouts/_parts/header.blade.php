<header data-scroll="60" data-scroll-show class="header">
    <div class="header__container">
        <div class="header__wrapper">
            <a href="https://laravel.com/" class="header__logo" target="_blank">php<span>laravel</span></a>
            <div class="header__wrap">
                <div class="header__block">
                    <div class="header__overlay"></div>
                    <nav class="header__menu menu">
                        <div class="menu__row">
                            <a href="" class="header__logo header__logo--menu">php<span>laravel</span></a>
                            <button type="button" class="header__close">
                                <div class="header__icon icon-menu"><span></span></div>
                            </button>
                        </div>
                        <ul class="menu__list">
                            @if(!empty(auth()->user()))
                                <div class="header__wrap">
                                    <div class="header__block">
                                    </div>
                                    <div class="header__info">
                                        <a href="{{ route('logout') }}" class="header__contact btn _icon-arrow-1">Вийти</a>
                                    </div>
                                </div>
                            @else
                                <li class="menu__item">
                                    <a href="{{ route('login') }}" class="menu__link">Вхід</a>
                                </li>

                                <li class="menu__item">
                                    <a href="{{ route('register')  }}" class="menu__link">Зареєструватися</a>
                                </li>
                            @endif
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>
