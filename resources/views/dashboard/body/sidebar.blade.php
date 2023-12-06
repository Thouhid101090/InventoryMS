<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item">
        <a class="nav-link" href="{{route('dashboard')}}">
          <i class="mdi mdi-grid-large menu-icon"></i>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>
      <li class="nav-item nav-category"></li>

      <li class="nav-item nav-category">Elements</li>

      <li class="nav-item">
        <a class="nav-link"  href="{{route('sale.index')}}">
          <i class="menu-icon mdi mdi-cart-outline"></i>
          <span class="menu-title"></span>
         <b>POS</b>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('purchase.index')}}">
          <i class="menu-icon mdi mdi-cash-multiple"></i>
          <span class="menu-title"></span>
          <b>Purchases</b>

        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('sale-report.generate')}}">
            <i class="menu-icon mdi mdi-clipboard-text"></i>
          <span class="menu-title"></span>
          <b>Sales Report</b>

        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('purchase-report.generate')}}">
            <i class="menu-icon mdi mdi-clipboard-text"></i>
          <span class="menu-title"></span>
          <b>Purchase Report</b>

        </a>
      </li>




      <li class="nav-item">
        <a class="nav-link"  href="{{route('customers.index')}}">
          <i class="menu-icon mdi mdi-account-multiple-outline
          "></i>
          <span class="menu-title"></span>
         <b>Customers</b>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('suppliers.index')}}">
          <i class="menu-icon mdi mdi-account-multiple"></i>
          <span class="menu-title"></span>
         <b>Suppliers</b>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('products.index')}}" >
          <i class="menu-icon mdi mdi-package-variant-closed
          "></i>
          <span class="menu-title"></span>
            <b>Products</b>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('categories.index')}}">
          <i class="menu-icon mdi mdi-lan"></i>
          <span class="menu-title"></span>
         <b>Categories</b>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('stock.index')}}" >
          <i class="menu-icon mdi mdi-database"></i>
          <span class="menu-title"></span>
            <b>Stocks</b>
        </a>
      </li>
      {{-- <li class="nav-item">
        <a class="nav-link" href="{{route('permission.list')}}" >
          <i class="menu-icon mdi mdi-database"></i>
          <span class="menu-title"></span>
            <b>Permission</b>
        </a>
      </li> --}}


      <li class="nav-item">
        <a class="nav-link" href="{{route('user.index')}}">
          <i class="menu-icon mdi mdi-account-key"></i>
          <b>User</b>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('role.index')}}" >
          <i class="menu-icon mdi mdi-key"></i>

            <b>Role</b>
        </a>
      </li>


    </ul>
  </nav>
