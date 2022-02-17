<header id="header" class="header-effect-shrink">
    <div class="header-body border-top-0 bg-dark box-shadow-none" style="height: 50px;">
        <div class="header-container container px-4 pt-1" style="min-height: 50px !important;">
            <div class="header-row">
                <div class="header-column">
                    <div class="header-row">
                        <div class="header-logo">
                            <a href="#">
                                <img alt="Porto" width="80" height="32" data-sticky-width="82"
                                     data-sticky-height="40" src="{{asset('/')}}img/logo-dark.png">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="header-column justify-content-end">
                    <div class="header-row">
                        <div class="header-nav-features header-nav-features-no-border header-nav-features-lg-show-border order-1 order-lg-2">
                            <div class="header-nav-feature header-nav-features-search d-inline-flex">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a onclick="event.preventDefault();this.closest('form').submit();"
                                       class="header-nav-features-toggle text-color-white d-flex" data-focus="headerSearch">
                                        <i class="icon-logout icons header-nav-top-icon text-color-white mt-2 mr-1"></i>ログアウト
                                    </a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
