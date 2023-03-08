<nav class="sidebar" >
    
    <div class="d-flex align-items-start flex-column h-100 parent">
        <div class="top">
            <ul class="nav flex-column" id="navbarMenu">
                
                @include('components.menu')
            
            </ul>
        </div>
        <div class="mt-auto bottom d-flex flex-wrap">
            <div class="d-grid row-gap-2 w-100 my-2 button-add hideOnScroll" id="buttonSideBar">
            </div>

            <div class="profile-dropdown align-self-end">
                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{ url('img/default-ava.svg') }}" alt="" width="32" height="32" class="rounded-circle me-2">
                    <strong>TK Paud</strong>
                    <small>Bunga Matahari</small>
                </a>                
            </div>
        </div>
    </div>
</nav>