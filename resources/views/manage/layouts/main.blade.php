<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
@include('manage.partials.head')
<body class="hold-transition sidebar-mini">
    <div id="app" class="wrapper">

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-12">
                <h1>
                  {{ $title ?? config('app.name', 'Laravel') }}
                </h1>
              </div>
            </div>
          </div>
        </section>
        <section class="content">  
            @include('manage.partials.messages')
            @yield('content')
        </section>

        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->

      <!-- Main Footer -->

    </div>
    <!-- ./wrapper -->    

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('javascript')
</body>
</html>
