@stack('header') 

@include('components.header')

<!-- Page content-->
<div class="container-fluid main-container hideOnScroll" id="maincontainer">
    <div class="row">
        <main class="d-flex align-content-between flex-wrap">
            <div class="d-flex justify-content-between flex-column flex-nowrap pb-2 mb-3 w-100 scroll-content control-form">
                @sectionMissing("bottomHide")
                    @hasSection("title")
                    <div class="col py-3">
                        <h1 class="title">@yield("title")</h1>
                    </div>
                    @endif

                @else
                    <div class="mt-3"></div>
                @endif
                @yield("content")
            </div>

            @sectionMissing("bottomHide")
            <div class="pagination-bottombar d-flex justify-content-center justify-content-md-between align-items-center hideOnScroll" id="bottombar">                
                <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('students.index') }}">Admin</a></li>
                    @foreach(Request::segments() as $segment)
                        @if ($loop->last)
                        <li class="breadcrumb-item active" aria-current="page"><span>{{ ucwords($segment) }}</span></li>
                        @else 
                        <li class="breadcrumb-item"><a href="#">{{ ucwords($segment) }}</a></li>  
                        @endif                    
                    @endforeach
                </ol>
                </nav>
                
                @yield("bottombar")            
            </div>
            @endif
        </main>
    </div>
</div>

<div id="buttonsPindah">
    @yield("buttonsidebar")
</div>

@stack('script')