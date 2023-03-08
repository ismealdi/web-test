<nav class="navbar navbar-expand-lg fixed-top hideOnScroll">
<div class="container-fluid">

    @hasSection('headerbar')
    <div class="navbar-navigation w-100 mx-2">
        <div class="content pe-md-2">
            <div class="d-flex justify-content-between w-100">
                <div class="flex-grow-1 w-100">
                    <div class="input-group ms-auto searchbar">
                    <span class="input-group-text" for="topbar-search"><i class="bi bi-search"></i></span>
                    <input type="search" class="form-control" id="topbar-search" placeholder="Search" aria-describedby="topbar-search"/>
                    </div>
                </div>

                <div class="collapse" id="navbarSupportedContent">
                    @yield('headerbar')
                </div>
            </div>
        </div>
    </div>
    <button class="navbar-toggler collapsed m-0" type="button" data-bs-toggle="collapse" 
        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" 
        aria-expanded="false" aria-label="Toggle navigation">
        <i class="bi bi-filter"></i>
        <i class="bi bi-x"></i>
    </button>
    @endif

</div>
</nav>