<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item">
        <a class="nav-link" href="{{route('dashboard')}}">
          <i class="mdi mdi-grid-large menu-icon"></i>
          <span class="menu-title"><b>Dashboard</b></span>
        </a>
      </li>
      <li class="nav-item ">
        <a class="nav-link" href="{{route('sale.index')}}">
          <i class="menu-icon mdi mdi-cart-outline"></i>
          <span class="menu-title"><b>POS</b></span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('purchase.index')}}">
          <i class="menu-icon mdi mdi-cash-multiple"></i>
          <span class="menu-title"><b>Purchases</b></span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
          <i class="menu-icon mdi mdi-clipboard-text"></i>
          <span class="menu-title"><b>Reports</b></span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-basic">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{route('purchase-report.generate')}}">Purchase Report</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{route('sale-report.generate')}}">Sales Report</a></li>
            <li class="nav-item"> <a class="nav-link"  href="{{route('stock.index')}}">Stocks</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#pay" aria-expanded="false" aria-controls="pay">
          <i class="menu-icon mdi mdi-cash-usd"></i>
          <span class="menu-title"><b>Payments</b></span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="pay">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{route('supplierPayment.index')}}">Supplier Payment</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{route('customerPayment.index')}}">Customer Payment</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('customers.index')}}">
          <i class="menu-icon mdi mdi-account-multiple-outline"></i>
          <span class="menu-title"><b>Customers</b></span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{route('suppliers.index')}}">
          <i class="menu-icon mdi mdi-account-multiple"></i>
          <span class="menu-title"><b>Suppliers</b></span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('products.index')}}">
          <i class="menu-icon mdi mdi-package-variant-closed"></i>
          <span class="menu-title"><b>Products</b></span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('categories.index')}}">
          <i class="menu-icon mdi mdi-lan"></i>
          <span class="menu-title"><b>Categories</b></span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('return.create')}}">
          <i class="menu-icon mdi mdi-undo-variant"></i>
          <span class="menu-title"><b>Customer Return Check</b></span>
        </a>
      </li>
     
      <li class="nav-item">
        <a class="nav-link" href="{{route('supplierReturn.create')}}">
          <i class="menu-icon mdi mdi-undo-variant"></i>
          <span class="menu-title"><b>Supplier Return Check</b></span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('user.index')}}">
          <i class="menu-icon mdi mdi-account-key"></i>
          <span class="menu-title"><b>User</b></span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('role.index')}}">
          <i class="menu-icon mdi mdi-key"></i>
          <span class="menu-title"><b>Role</b></span>
        </a>
      </li>
    </ul>
  </nav>
