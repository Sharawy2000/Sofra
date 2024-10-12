<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link">
      <img src="{{ asset('admin/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light"><strong>{{ __('messages.sofra') }}</strong></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('admin/dist/img/admin.png')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          @auth
          <a href="{{ route('profile') }}" class="d-block">{{ Auth::user()->name }}</a>
          @endauth
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="{{ __('messages.search') }}" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          
          <li class="nav-header">{{ __('messages.user_pages') }}</li>

          <li class="nav-item">
            <a href="{{ route('users.index') }}" class="nav-link">
              <i class="nav-icon fas fa-users-cog"></i>
              <p>
                {{ __('messages.users') }}
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('roles.index') }}" class="nav-link">
              <i class="nav-icon fas fa-briefcase"></i>
              <p>
                {{ __('messages.roles') }}
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('clients.index') }}" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                {{ __('messages.clients') }}
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('restaurants.index') }}" class="nav-link">
              <i class="nav-icon fas fa-utensils"></i>
              <p>
                {{ __('messages.restaurants') }}
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('orders.index') }}" class="nav-link">
              <i class="nav-icon fas fa-clipboard-list"></i>
              <p>
                {{ __('messages.orders') }}
              </p>
            </a>
          </li>
          {{-- <li class="nav-header">Extra</li> --}}
          <li class="nav-item">
            <a href="{{ route('cities.index') }}" class="nav-link">
              <i class="nav-icon far fa-city"></i>
              <p>
                {{ __('messages.cities') }}
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('neighborhoods.index') }}" class="nav-link">
              <i class="nav-icon fas fa-map-marker-alt"></i>
              <p>
                {{ __('messages.neighborhoods') }}
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('categories.index') }}" class="nav-link">
              <i class="nav-icon fas fa-list-alt"></i>
              <p>
                {{ __('messages.categories') }}
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('payments.index') }}" class="nav-link">
              <i class="nav-icon fas fa-wallet"></i>
              <p>
                {{ __('messages.payments') }}
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('offers.index')  }}" class="nav-link">
              <i class="nav-icon fas fa-tags"></i>
              <p>
                {{ __('messages.offers') }}
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('payment-methods.index')  }}" class="nav-link">
              <i class="nav-icon fas fa-credit-card"></i>
              <p>
                {{ __('messages.payment_methods') }}
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('contacts.index')  }}" class="nav-link">
              <i class="nav-icon far fa-comment"></i>
              <p>
                {{ __('messages.contact_messages') }}
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('settings.edit',1) }}" class="nav-link">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                {{ __('messages.settings') }}
              </p>
            </a>
          </li>
        </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>

      <!-- Main Footer -->
      <footer class="main-footer">
        <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
          <b>Version</b> 3.2.0
        </div>
      </footer>
    </div>
    <!-- ./wrapper -->