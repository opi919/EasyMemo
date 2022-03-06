<!DOCTYPE html>
<html dir="{{ config('easy_panel.rtl_mode') ? 'rtl' : 'ltr' }}" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{ __('EasyPanel') }} - {{ $title ?? __('Home') }}</title>

    {{-- Scripts which must load before full loading --}}
    @style('https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css')
    @script('https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js')
    @script('https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js')
    @script('https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.2/dist/alpine.min.js')
    @script("/assets/admin/js/ckeditor.min.js")

    {{-- Styles --}}
    @livewireStyles
    @style("/assets/admin/css/style.min.css")
    @if (config('easy_panel.rtl_mode'))
        @style("/assets/admin/css/rtl.css")
        @style("https://cdn.jsdelivr.net/gh/rastikerdar/vazir-font@v27.2.1/dist/font-face.css")
    @endif
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
</head>

<body>

    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>

    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">

        <!-- Topbar header - style you can find in pages.scss -->
        <header class="topbar" data-navbarbg="skin6">
            <nav class="navbar top-navbar navbar-expand-md">
                <div class="navbar-header" data-logobg="skin6">
                    <!-- This is for the sidebar toggle which is visible on mobile only -->
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i
                            class="ti-menu ti-close"></i></a>

                    <!-- Logo -->
                    <div class="navbar-brand">
                        <a href="@route(getRouteName().'.home')">
                            <span class="logo-text">EasyMemo</span>
                        </a>
                    </div>
                    <!-- End Logo -->

                    <!-- ============================================================== -->
                    <!-- Toggle which is visible on mobile only -->
                    <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)"
                        data-toggle="collapse" data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i
                            class="ti-more"></i></a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->

                <div class="navbar-collapse collapse d-flex justify-content-center" id="navbarSupportedContent">
                    <!-- Right side toggle and nav items -->
                    {{-- <ul class="navbar-nav float-right">
                    <li class="nav-item d-none d-md-block">
                        <a class="nav-link" href="javascript:void(0)">
                            <div class="customize-input">
                                <select id="langChanger" class="form-control bg-white custom-shadow border-0 h-25" style="border-radius: 6px">
                                    @foreach (\EasyPanel\Services\LangManager::get() as $key => $value)
                                        <option value="{{ $key }}" {{ \Illuminate\Support\Facades\App::getLocale() === $key ? 'selected' : '' }}>{{ $value }}</option>
                                    @endforeach
                                </select>
                                <script>
                                    document.getElementById('langChanger').addEventListener('change', function (){
                                        window.location.href = "{{ route('admin.setLang') }}?lang=" + this.value;
                                    });
                                </script>
                            </div>
                        </a>
                    </li>

                    <!-- User profile and search -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="javascript:void(0)" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">
                                <span class="ml-2 d-none d-lg-inline-block"><span>{{ __('Hello') }},</span> <span
                                        class="text-dark">@user('name')</span> <i data-feather="chevron-down"
                                                                                  class="svg-icon"></i></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right user-dd animated pb-0 flipInY">
                            <a class="dropdown-item" href="{{ route('logout') }}"><i
                                    data-feather="power"
                                    class="svg-icon mr-2 ml-1"></i>
                                {{ __('Logout') }}</a>
                            <form id="logout" action="{{ route('logout') }}" method="post"> @csrf </form>
                        </div>
                    </li>
                    <!-- User profile and search -->
                </ul> --}}
                    <input type="search" name="live_search" id="live_search" class="form-control px-3"
                        placeholder="Search" style="border-radius:100rem;width:50%;">
                </div>
            </nav>
        </header>
        <!-- End Topbar header -->

        <!-- Left Sidebar -->
        @include('admin::layouts.sidebar')
        <!-- End Left Sidebar -->


        <!-- Page wrapper  -->
        <div class="page-wrapper">

            <!-- Container -->
            <div class="container-fluid" id="container-fluid">

                @yield('content')

            </div>
            <div class="container-fluid" id="live_search_list">
                <div class="live_search_list">
                    <table class="table" id="search_table">
                        <h2 id="error" class="text-danger text-center"></h2>
                        <tbody id="search_new"></tbody>
                    </table>
                </div>
            </div>
            <!-- End Container fluid  -->
        </div>
    </div>
    <!-- End Wrapper -->

    <!-- All Scripts -->
    @script("/assets/admin/js/jquery.min.js")
    @script("/assets/admin/js/popper.min.js")
    @script("/assets/admin/js/bootstrap.min.js")
    @script("/assets/admin/js/perfect-scrollbar.jquery.min.js")
    @script("/assets/admin/js/app-style-switcher.min.js")
    @script("/assets/admin/js/feather.min.js")
    @script("/assets/admin/js/sidebarmenu.min.js")
    @script("/assets/admin/js/custom.min.js")

    @livewireScripts
    <script>
        window.addEventListener('show-message', function(event) {
            let type = event.detail.type;
            let message = event.detail.message;
            if (document.querySelector('.notification')) {
                document.querySelector('.notification').remove();
            }
            let body = document.querySelector('#main-wrapper');
            let child = document.createElement('div');
            child.classList.add('notification', 'notification-' + type, 'animate__animated',
                'animate__jackInTheBox');
            child.innerHTML = `<p>${message}</p>`;

            body.appendChild(child);

            setTimeout(function() {
                body.removeChild(child);
            }, 3000);
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        @if (Session('message'))
            toastr.options.closeButton = true;
            toastr.options.showMethod = 'slideDown';
            toastr.options.hideMethod = 'slideUp';
            toastr.options.closeMethod = 'slideUp';
            toastr.success("{{ Session('message') }}")
        @endif
    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $('#delete').click(function(e) {
            e.preventDefault();
            let url = $(this).attr('href');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            })
        });
    </script>
    <script>
        $('#live_search').on('keyup', function() {
            var data = $(this).val();
            // console.log(data);
            if (data == '') {
                $('#container-fluid').show();
                $('#live_search_list').hide();
            } else {
                $.ajax({
                    type: 'get',
                    url: '/live-search/{data}',
                    data: {
                        'data': data
                    },
                    success: function(data) {
                        $('#container-fluid').hide();
                        $('#live_search_list').show();
                        // console.log(data)
                        $('#search_new').empty();
                        $('#error').empty();
                        if (data.status) {
                            $('#error').html(data.message);
                        } else {
                            $.each(data, function(index, value) {
                                $.each(value, function(index2, value2) {
                                    if (value2.name) {
                                        $('#search_new').append(
                                            '<tr>' +
                                            '<td>' + value2.order_no +
                                            '</td>' +
                                            '<td>' + value2.name +
                                            '</td>' +
                                            '<td>' + value2.email +
                                            '</td>' +
                                            '<td>' + value2.phone +
                                            '</td>' +
                                            '<td>' + value2.address +
                                            '</td>' +
                                            '<td>' + value2.order_date +
                                            '</td>' +
                                            '<td>' + value2.order_time +
                                            '</td>' +
                                            '</tr>'
                                        );
                                    } 
                                    else if(value2.customer_name){
                                        $('#search_new').append(
                                        '<tr>' +
                                            '<td>' + value2.order_no +
                                            '</td>' +
                                            '<td>' + value2.customer_name +
                                            '</td>' +
                                            '<td>' + value2.customer_email +
                                            '</td>' +
                                            '<td>' + value2.customer_phone +
                                            '</td>' +
                                            '<td>' + value2.customer_address +
                                            '</td>' +
                                            '<td>' + value2.amount +
                                            '</td>' +
                                            '</tr>'
                                        );
                                    }
                                    else if(value2.price) {
                                        $('#search_new').append(
                                            '<tr>' +
                                            '<td>' + value2.product_name +
                                            '</td>' +
                                            '<td>' + value2.price +
                                            '</td>' +
                                            '<td>' + value2.tax +
                                            '</td>' +
                                            '</tr>'
                                        );
                                    }
                                });
                            });
                        }

                    }

                });
            }
        });
    </script>

</body>

</html>
