@php
    $user = Auth::guard('web')->user();
@endphp

<!DOCTYPE html>
<html lang="en">

    <head>
        <link type="image/x-icon" href="{{ asset($setting->favicon) }}" rel="shortcut icon">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
        @yield('title')
        <title>{{ __('Login') }}</title>

        @include('website.provider.header', ['setting' => $setting])
        @stack('css')
        @include('admin.js-variables')
    </head>

    <body>
        <div id="app">
            <div class="main-wrapper">
                <div class="navbar-bg"></div>
                <nav class="navbar navbar-expand-lg main-navbar px-3 py-2">
                    <div class="me-2 form-inline">
                        <ul class="me-3 navbar-nav d-flex align-items-center">
                            <li><a class="nav-link nav-link-lg" data-toggle="sidebar" href="#"><i
                                        class="fas fa-bars"></i></a></li>
                            @if (Module::isEnabled('Language') && Route::has('set-locale') && allLanguages()?->where('status', 1)->count() > 1)
                                <li class="setLanguageHeader dropdown border rounded-2"><a
                                        class="nav-link dropdown-toggle nav-link-lg nav-link-user"
                                        data-bs-toggle="dropdown" href="javascript:;">
                                        <div class="d-sm-none d-lg-inline-block">
                                            {{ allLanguages()?->firstWhere('code', getSessionLanguage())?->name ?? __('Select language') }}
                                        </div>
                                    </a>
                                    <div class="dropdown-menu py-0 dropdown-menu-left">
                                        @forelse (allLanguages()?->where('status', 1) as $language)
                                            <a class="dropdown-item has-icon {{ getSessionLanguage() == $language->code ? 'bg-light' : '' }}"
                                                href="{{ getSessionLanguage() == $language->code ? 'javascript:;' : route('set-locale', ['locale' => $language->code]) }}">
                                                {{ $language->name }}
                                            </a>
                                        @empty
                                            <a class="dropdown-item has-icon {{ getSessionLanguage() == 'en' ? 'bg-light' : '' }}"
                                                href="javascript:;">
                                                {{ __('English') }}
                                            </a>
                                        @endforelse
                                    </div>
                                </li>
                            @endif
                            @if (Module::isEnabled('Currency') &&
                                    Route::has('set-currency') &&
                                    allCurrencies()?->where('status', 'active')->count() > 1)
                                <li class="set-currency-header dropdown border rounded-2 mx-2"><a
                                        class="nav-link dropdown-toggle nav-link-lg nav-link-user"
                                        data-bs-toggle="dropdown" href="javascript:;">
                                        <div class="d-sm-none d-lg-inline-block">
                                            {{ allCurrencies()?->firstWhere('currency_code', getSessionCurrency())?->currency_name ?? __('Select Currency') }}
                                        </div>
                                    </a>
                                    <div class="dropdown-menu py-0 dropdown-menu-left">
                                        @forelse (allCurrencies()?->where('status', 'active') as $currency)
                                            <a class="dropdown-item has-icon {{ getSessionCurrency() == $currency->currency_code ? 'bg-light' : '' }}"
                                                href="{{ getSessionCurrency() == $currency->currency_code ? 'javascript:;' : route('set-currency', ['currency' => $currency->currency_code]) }}">
                                                {{ $currency->currency_name }}
                                            </a>
                                        @empty
                                            <a class="dropdown-item has-icon {{ getSessionCurrency() == 'USD' ? 'bg-light' : '' }}"
                                                href="javascript:;">
                                                {{ __('USD') }}
                                            </a>
                                        @endforelse
                                    </div>
                                </li>
                            @endif
                        </ul>
                    </div>
                    <div class="mr-auto me-md-auto search-box position-relative">
                    </div>

                    <ul class="navbar-nav">
                        <li class="dropdown border rounded-2 mx-2 dropdown-list-toggle">
                            <a class="nav-link nav-link-lg" href="{{ route('home') }}" target="_blank">
                                <i class="fas fa-home"></i> {{ __('Visit Website') }}</i>
                            </a>
                        </li>

                        <li class="dropdown"><a
                                class="nav-link dropdown-toggle nav-link-lg nav-link-user" data-bs-toggle="dropdown"
                                href="javascript:;">
                                @if ($user->image)
                                    <img class="me-1 rounded-circle" src="{{ asset($user->image) }}" alt="image">
                                @else
                                    <img class="me-1 rounded-circle" src="{{ asset($setting->default_avatar) }}"
                                        alt="image">
                                @endif

                                <div class="d-sm-none d-lg-inline-block">{{ $user->name }}</div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item has-icon" href="{{ route('provider.my-profile') }}">
                                    <i class="far fa-user"></i>{{ __('My Profile') }}
                                </a>
                                <a class="dropdown-item has-icon" href="{{ route('provider.change-password') }}">
                                    <i class="fas fa-lock"></i>{{ __('Change Password') }}
                                </a>

                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item has-icon text-danger" href="{{ route('user.logout') }}">
                                    <i class="fas fa-sign-out-alt"></i>{{ __('Logout') }}
                                </a>
                                <form class="d-none" id="admin-logout-form" action="{{ route('user.logout') }}"
                                    method="POST">
                                    @csrf
                                </form>
                            </div>
                        </li>

                    </ul>
                </nav>

                @include('website.provider.sidebar', ['setting' => $setting])

                @yield('provider-content')

                <footer class="main-footer">
                    <div class="footer-left">
                        {{ $setting->copyright_text }}
                    </div>
                </footer>
            </div>
        </div>

        <div class="modal fade" id="deleteModal" data-bs-keyboard="false" data-bs-backdrop="static" role="dialog"
            tabindex="-1">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Item Delete Confirmation') }}</h5>
                        <button class="btn btn-danger btn-sm" data-dismiss="modal" type="button"
                            aria-label="{{ __('Close') }}">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>{{ __('Are You sure want to delete this item ?') }}</p>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <form id="deleteForm" action="" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" data-dismiss="modal"
                                type="button">{{ __('Close') }}</button>
                            <button class="btn btn-primary" type="submit">{{ __('Yes, Delete') }}</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>

        @include('website.provider.footer', ['setting' => $setting])

        @yield('message-box')

        @stack('js')

    </body>

</html>
