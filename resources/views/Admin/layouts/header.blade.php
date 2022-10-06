<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CBD Logistics | Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('public/admin/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{asset('public/admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('public/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{asset('public/admin/plugins/jqvmap/jqvmap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('public/admin/dist/css/adminlte.min.css')}}">
  <link rel="stylesheet" href="{{asset('public/admin/dist/css/custom.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('public/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('public/admin/plugins/daterangepicker/daterangepicker.css')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{asset('public/admin/plugins/summernote/summernote-bs4.min.css')}}">

  <link rel="stylesheet" href="{{asset('public/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('public/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('public/admin/plugins/select2/css/select2.min.css')}}">>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
    </div>

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <!-- <li class="nav-item d-none d-sm-inline-block">
          <a href="index3.html" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="#" class="nav-link">Contact</a>
        </li> -->
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">
          <a class="nav-link" data-widget="navbar-search" href="#" role="button">
            <i class="fas fa-search"></i>
          </a>
          <div class="navbar-search-block">
            <form class="form-inline">
              <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                  <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                  </button>
                  <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </li>

        <!-- Messages Dropdown Menu -->

        <!-- Notifications Dropdown Menu -->

        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>

      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="{{url('admin/dashboard')}}" class="brand-link">
        <img src="{{asset('public/image/footer-logo.png')}}" alt="logo">
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="info">
            <a href="javascript:void(0)" class="d-block">{{Auth::user()->firstname}}</a>
          </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
              <a href="{{url('admin/dashboard')}}" class="nav-link">
                <p>
                  Dashboard
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="javascript:void(0)" class="nav-link">
                <p>
                  Banner
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{url('admin/banner')}}" class="nav-link">
                    <p>- Banner List</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{url('admin/banner/create')}}" class="nav-link">
                    <p>- Add New</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="javascript:void(0)" class="nav-link">
                <p>
                  FAQ
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{url('admin/faq')}}" class="nav-link">
                    <p>- FAQ List</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{url('admin/faq/create')}}" class="nav-link">
                    <p>- Add New</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="javascript:void(0)" class="nav-link">
                <p>
                  Pages
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{url('admin/page')}}" class="nav-link">
                    <p>- Pages List</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{url('admin/page/create')}}" class="nav-link">
                    <p>- Add New</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="javascript:void(0)" class="nav-link">
                <p>
                  Category
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{url('admin/category')}}" class="nav-link">
                    <p>- Category List</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{url('admin/category/create')}}" class="nav-link">
                    <p>- Add New</p>
                  </a>
                </li>
              </ul>
            </li>

            <li class="nav-item">
              <a href="javascript:void(0)" class="nav-link">
                <p>
                  Subcategory
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{url('admin/subcategory')}}" class="nav-link">
                    <p>- Subcategory List</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{url('admin/subcategory/create')}}" class="nav-link">
                    <p>- Add New</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="javascript:void(0)" class="nav-link">
                <p>
                  Attribute
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{url('admin/attribute')}}" class="nav-link">
                    <p>- Attribute List</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{url('admin/attribute/create')}}" class="nav-link">
                    <p>- Add New</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="javascript:void(0)" class="nav-link">
                <p>
                  Product
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{url('admin/product')}}" class="nav-link">
                    <p>- Product List</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{url('admin/product/create')}}" class="nav-link">
                    <p>- Add New</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{url('admin/product/attribute')}}" class="nav-link">
                    <p>- Attribute List</p>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>