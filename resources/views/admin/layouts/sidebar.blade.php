  <!-- partial:partials/_sidebar.html -->
  <nav class="sidebar">
      <div class="sidebar-header">
          <a href="#" class="sidebar-brand">
              Molla<span>EM</span>
          </a>
          <div class="sidebar-toggler not-active">
              <span></span>
              <span></span>
              <span></span>
          </div>
      </div>
      <div class="sidebar-body">
          <ul class="nav">
              <li class="nav-item nav-category">Main</li>
              <li class="nav-item">
                  <a href="{{ route('admin.dashboard') }}"
                      class="nav-link @if (Request::segment(2) == 'dashboard') active @endif">
                      <i class="link-icon" data-feather="box"></i>
                      <span class="link-title">Dashboard</span>
                  </a>
              </li>
              <li class="nav-item">
                  <a href="{{ route('admin.admin_list.index') }}"
                      class="nav-link @if (Request::segment(2) == 'admin') active @endif">
                      <i class="link-icon" data-feather="box"></i>
                      <span class="link-title">Admin</span>
                  </a>
              </li>
              <li class="nav-item">
                  <a href="{{ route('admin.slider.index') }}"
                      class="nav-link @if (Request::segment(2) == 'slider') active @endif">
                      <i class="link-icon" data-feather="box"></i>
                      <span class="link-title">Slider</span>
                  </a>
              </li>
              <li class="nav-item">
                  <a href="{{ route('admin.category.index') }}"
                      class="nav-link @if (Request::segment(2) == 'category') active @endif">
                      <i class="link-icon" data-feather="box"></i>
                      <span class="link-title">Category</span>
                  </a>
              </li>
              <li class="nav-item">
                  <a href="{{ route('admin.sub_category.index') }}"
                      class="nav-link @if (Request::segment(2) == 'sub_category') active @endif">
                      <i class="link-icon" data-feather="box"></i>
                      <span class="link-title">Sub Category</span>
                  </a>
              </li>
              <li class="nav-item">
                  <a href="{{ route('admin.brand.index') }}"
                      class="nav-link @if (Request::segment(2) == 'brand') active @endif">
                      <i class="link-icon" data-feather="box"></i>
                      <span class="link-title">Brand</span>
                  </a>
              </li>
              <li class="nav-item">
                  <a href="{{ route('admin.product.index') }}"
                      class="nav-link @if (Request::segment(2) == 'product') active @endif">
                      <i class="link-icon" data-feather="box"></i>
                      <span class="link-title">Product</span>
                  </a>
              </li>

          </ul>
      </div>
  </nav>

  <!-- partial -->
