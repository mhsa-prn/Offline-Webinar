

<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-body-tertiary sidebar collapse">
    <div class="position-sticky pt-3 sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{in_array(\Illuminate\Support\Facades\Route::currentRouteName(),
                    ['admin.users.index','admin.users.edit']) ? "active" : ""}}" aria-current="page" href="{{route('admin.users.index')}}">
                    <span data-feather="home" class="align-text-bottom"></span>
                    کاربران
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{in_array(\Illuminate\Support\Facades\Route::currentRouteName(),
                    ['admin.categories.index','admin.categories.edit','admin.categories.create']) ? "active" : ""}}" href="{{route('admin.categories.index')}}">
                    <span data-feather="file" class="align-text-bottom"></span>
                    دسته بندی ها
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{in_array(\Illuminate\Support\Facades\Route::currentRouteName(),
                    ['admin.webinars.index','admin.webinars.edit','admin.webinars.create']) ? "active" : ""}}" href="{{route('admin.webinars.index')}}">
                    <span data-feather="file" class="align-text-bottom"></span>
                    وبینارها
                </a>
            </li>

        </ul>


    </div>
</nav>
