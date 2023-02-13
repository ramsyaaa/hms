<div class="mt-7 overflow-hidden">
    <ul class="nav nav-tabs mb-5 pb-1 overflow-auto flex-nowrap text-nowrap">
        <li class="nav-item position-relative me-7 mb-3">
            <a class="nav-link p-0 {{ (isset($sectionName) && $sectionName ==='cms' || Request::is('front-cms-settings*')) ? 'active' : ''}}" href="{{ route('front.settings.index', ['section' => 'cms']) }}">
                {{ __('messages.web_home.home') }}
            </a>
        </li>
        <li class="nav-item position-relative me-7 mb-3">
            <a class="nav-link p-0 {{ (isset($sectionName) && $sectionName === 'about-us') ? 'active' : ''}}"
               href="{{ route('front.settings.index', ['section' => 'about-us']) }}">
                {{ __('messages.web_home.about_us') }}
            </a>
        </li>
        <li class="nav-item position-relative me-7 mb-3">
            <a class="nav-link p-0 {{ (isset($sectionName) && $sectionName === 'appointment') ? 'active' : ''}}"
               href="{{ route('front.settings.index',['section' => 'appointment']) }}">
                {{ __('messages.web_menu.appointment') }}
            </a>
        </li>
        <li class="nav-item position-relative me-7 mb-3">
            <a class="nav-link p-0 {{ (isset($sectionName) && $sectionName === 'terms-and-conditions') ? 'active' : ''}}"
               href="{{ route('front.settings.index',['section' => 'terms-and-conditions']) }}">
                {{ __('messages.front_setting.terms_conditions') }}
            </a>
        </li>
    </ul>
</div>
