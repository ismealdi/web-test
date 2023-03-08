<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.26.0/ui/trumbowyg.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css" />       
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/orgchart/3.4.0/css/jquery.orgchart.min.css"/>

    <link rel="stylesheet" href="{{ url('css/setalis.css') }}" type="text/css"/> 
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">   

    <meta name="msapplication-TileColor" content="#101010">
    <meta name="msapplication-TileImage" content="{{ url('img/setalis.svg') }}">
    <meta name="theme-color" content="#101010">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="{{ url('img/setalis.svg') }}" sizes="any" type="image/svg+xml">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css"/>
    
    @stack('header') 
    
    <title>@yield("title") · {{ config('app.name')}}</title>


  </head>
  <body id="body">
    <div class="d-none" id="defaultAva" data-ava="{{ url('/img/default-ava.svg') }}"></div>
    
    <div class="d-flex" id="wrapper">
      <!-- Sidebar-->
      <div id="sidebar-wrapper">
          <div class="navbar-brand px-3">
            <a data-route="{{ route('students.index') }}" data-title="Dashboard" class="targetMenu">
                <img src="{{ url('img/setalis.svg') }}" alt="Icon Setalis Digital">
                {{ config('app.name') }}
                <small>Student Management</small>
            </a>  
    
            <button id="sidebarToggle" class="bi navbar-hide hideOnScroll">
              <i class="bi bi-chevron-left close"></i>
              <i class="bi bi-list"></i>
            </button>
          </div>
          
          @include('components.sidebar')
      </div>      
      <div id="page-content-wrapper">          
      </div>

  </div>

    <!-- Modal Delete Form -->
    <div class="modal modal-sm modal-data fade modal-preview modal-delete" id="confirmDeleteDialog" data-bs-keyboard="true" aria-labelledby="confirmDeleteDialogLabel" aria-hidden="true">
      <div class="modal-dialog">
          {!! Form::open(['class' => 'modal-content', 'id' => 'formDelete']) !!}
              <div class="modal-header">
                  <h1 class="modal-title" id="levelDialogLabel">Konfirmasi Hapus Data</h1>
              </div>
              <div class="modal-body">
                  Anda tidak akan dapat memulihkan kembali datanya.
              </div>
              <div class="modal-footer">
                <label class="text-error me-auto" id="errorLevelDialog"></label>
                  <button type="button" class="btn btn-default" id="dismissButtonDelete">Batal</button>
                  <button type="submit" class="btn btn-danger">Konfirmasi</button>                
              </div>
          {!! Form::close() !!}
      </div>
    </div>

  <div class="loading-dialog page d-none" id="loadingpage">
      <div class="loader">
          <div class="spinner-border" role="status">
            <span class="visually-hidden">Loading...</span>
          </div>
      </div>
  </div>

  <div class="loading-dialog d-none">
      <div class="loader">
          <div class="spinner-border" role="status">
            <span class="visually-hidden">Loading...</span>
          </div>
      </div>
  </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>  
    <script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>  
    <script src="https://cdn.datatables.net/scroller/2.1.0/js/dataTables.scroller.min.js"></script>  
    <script src="https://cdn.datatables.net/select/1.6.0/js/dataTables.select.min.js"></script>  
    <script src="https://gyrocode.github.io/jquery-datatables-checkboxes/1.2.7/js/dataTables.checkboxes.min.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.3/jquery.inputmask.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js" type="text/javascript" ></script>           

    {{-- <script src="{{ url('js/pace.min.js') }}"></script>   --}}
    <script src="{{ url('js/daterangepicker.min.js') }}"></script> 
    <script src="{{ url('js/setalis.js') }}"></script> 
      
    @stack('script')
  </body>
</html>