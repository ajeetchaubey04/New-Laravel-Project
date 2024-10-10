        <!-- Navabr -->
        <nav class="navbar navbar-expand-xl Custom_Navbar">
            <div class="container align-items-center align-items-xl-end">

                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample"
                    aria-controls="offcanvasExample" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <a class="navbar-brand" href="/">
                    <img src="{{ asset('website/img/logo-colour.webp') }}" loading="eager" alt="Logo">
                </a>
            </div>
            <div class="offcanvas offcanvas-start custom-offcanvas-nav mt-2" tabindex="-1" id="offcanvasExample"
                aria-labelledby="offcanvasExampleLabel">
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                <ul class="navbar-nav custom-nav-menu mt-2 text-center" style="font-size: 20px;">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('services') }}">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contact') }}">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('blogs', ['slug' => 'example-blog-slug']) }}">Blog</a>
                        <!-- 'slug' can be replaced with a dynamic value -->
                    </li>

                </ul>
            </div>

        </nav>
        <!-- Navbar End -->
