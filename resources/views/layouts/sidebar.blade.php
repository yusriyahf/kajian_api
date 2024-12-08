<ul id="sidebarnav">
    <li class="nav-small-cap">
      <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
      <span class="hide-menu">Menu</span>
    </li>
   
    <li class="sidebar-item">
        <a class="sidebar-link" href="/" aria-expanded="false">
            <span>
                <i class="ti ti-dashboard"></i>
            </span>
            <span class="hide-menu">Dashboard</span>
        </a>
    </li>
    <li class="sidebar-item">
        <a class="sidebar-link {{ Request::is('user*') ? 'active' : '' }}" href="/user" aria-expanded="false">
          <span>
            <i class="ti ti-home"></i>
          </span>
          <span class="hide-menu">User</span>
        </a>
    </li>
    <li class="sidebar-item">
        <a class="sidebar-link {{ Request::is('kajian*') ? 'active' : '' }}" href="/kajian" aria-expanded="false">
          <span>
            <i class="ti ti-home"></i>
          </span>
          <span class="hide-menu">Kajian</span>
        </a>
    </li>
    <li class="sidebar-item">
        <a class="sidebar-link {{ Request::is('pembayaran*') ? 'active' : '' }}" href="/pembayaran" aria-expanded="false">
          <span>
            <i class="ti ti-home"></i>
          </span>
          <span class="hide-menu">Pembayaran</span>
        </a>
    </li>
    <li class="sidebar-item">
        <a class="sidebar-link {{ Request::is('tiket*') ? 'active' : '' }}" href="/tiket" aria-expanded="false">
          <span>
            <i class="ti ti-home"></i>
          </span>
          <span class="hide-menu">Tiket</span>
        </a>
    </li>
    

    <li class="nav-small-cap">
      <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
      <span class="hide-menu">AKUN</span>
    </li>
 

  
    <li class="sidebar-item">
     
      <form action="/logout" method="POST">
        @csrf
        <button type="submit" class="sidebar-link" style="background: none; border: none; font: inherit; color: inherit; cursor: pointer;">
            <span>
                <i class="ti ti-login"></i>
            </span>
            <span class="hide-menu">Logout</span>
        </button>
    </form>

    </li>

  </ul>
