  <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('admin/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">

        </div>
        <div class="info">
          <a href="" class="d-block">
            <a href="#" class="d-block">{{ session("name") }}</a>
          </a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <!-- DASHBOARD PAGE -->
          <li class="nav-item">
            <a href="/dashboard" class="nav-link {{ Request::is('dashboard') ? 'active' : ''}}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <span class="right badge badge-danger"></span>
              </p>
            </a>
          </li>

             <!-- Promo -->

             <li class="nav-item">
            <a href="/customer" class="nav-link {{ Request::is('customer') ? 'active' : ''}}">
              <i class="nav-icon fas fa-users"></i>
              <p>
               Customer
              </p>
            </a>
          </li>

          {{-- reques slado --}}

          <li class="nav-item">
            <a href="/request" class="nav-link {{ Request::is('request') ? 'active' : ''}}">
              <i class="nav-icon fas fa-wallet"></i>
              <p>
               Request Saldo
              </p>
            </a>
          </li>


             <!-- Keuntungan -->
          <li class="nav-item">
            <a href="/store" class="nav-link {{ Request::is('store') ? 'active' : ''}}">
              <i class="nav-icon fas fa-store-alt"></i>
              <p>
               Store
              </p>
            </a>
          </li>




          <!-- PANDUAN SISTEM -->
          <li class="nav-item">
            <a href="/drivers" class="nav-link {{ Request::is('drivers') ? 'active' : ''}}">
              <i class="nav-icon fas fa-motorcycle"></i>
              <p>
               Driver
              </p>
            </a>
          </li>

          <!-- PANDUAN SISTEM -->
          <li class="nav-item">
            <a href="/transaksi" class="nav-link {{ Request::is('transaksi') ? 'active' : ''}}">
              <i class="nav-icon fas fa-book"></i>
              <p>
               Transaksi Pelanggan
              </p>
            </a>
          </li>

          <!-- SIDEBAR SISTEM -->
          {{-- <li class="nav-item">
            <a href="/testing" class="nav-link {{ Request::is('testing') ? 'active' : ''}}">
              <i class="nav-icon fas fa-book"></i>
              <p>
               TESTING
              </p>
            </a>
          </li> --}}

          <li class="nav-item">
            <a href="/setting" class="nav-link {{ Request::is('setting') ? 'active' : ''}}">
              <i class="nav-icon fas fa-user-cog"></i>
              <p>
               SETTING
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="/promo" class="nav-link {{ Request::is('promo') ? 'active' : ''}}">
              <i class="nav-icon fas fa-chart-bar"></i>
              <p>
               PROMO
              </p>
            </a>
          </li>
          {{-- <li class="nav-item">
            <a href="/listPromo" class="nav-link {{ Request::is('listPromo') ? 'active' : ''}}">
              <i class="nav-icon fas fa-spinner"></i>
              <p>
               LIST PROMO
              </p>
            </a>
          </li> --}}
          <!-- Data Sistem -->
          {{-- <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-sitemap"></i>
              <p>
               Product
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right"></span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="fas fa-table nav-icon"></i>
                  <p>Data Product</p>
                </a>
              </li>
               <li class="nav-item">
                <a href=" class="nav-link">
                  <i class="fas fa-plus nav-icon"></i>
                  <p>Tambah Data Product</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="fas fa-tags nav-icon"></i>
                  <p>Kategori Product</p>
                </a>
              </li>
            </ul>
          </li> --}}

          <!-- Data Sistem -->
          {{-- <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-lock"></i>
              <p>
                Data Sistem/Admin
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right"></span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="fas fa-table nav-icon"></i>
                  <p>Data Sistem Administrator</p>
                </a>
              </li>
               <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="fas fa-plus nav-icon"></i>
                  <p>Tambah Data Sistem Administrator</p>
                </a>
              </li>
            </ul>
          </li> --}}

           <!-- Data User -->
          {{-- <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user-alt"></i>
              <p>
                Data User
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right"></span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="fas fa-table nav-icon"></i>
                  <p>Data User</p>
                </a>
              </li>
               <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="fas fa-plus nav-icon"></i>
                  <p>Tambah Data User</p>
                </a>
              </li>
            </ul>
          </li> --}}



           <!-- LOGOUT -->
          <li class="nav-item">
            <a href="/logout" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
               Logout
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
