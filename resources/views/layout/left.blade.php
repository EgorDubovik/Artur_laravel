<div id="layoutSidenav_nav">
    <nav class="sidenav shadow-right sidenav-light">
        <div class="sidenav-menu">
            <div class="nav accordion" id="accordionSidenav">
                <a class="nav-link" href="/dashboard">
                    <div class="nav-link-icon">
                      <i class="fas fa-align-center"></i>
                    </div>
                    Dashboard
                </a>
                <a class="nav-link" href="/fba">
                    <div class="nav-link-icon">
                      <i class="fas fa-truck-loading"></i>
                    </div>
                    FBA Сервис
                </a>
                <a class="nav-link" href="/fbm">
                    <div class="nav-link-icon">
                      <i class="fas fa-warehouse"></i>
                    </div>
                    FBM Сервис
                </a>
            </div>
        </div>
        <div class="sidenav-footer">
            <div class="sidenav-footer-content">
                <div class="sidenav-footer-subtitle">Logged in as:</div>
                <div class="sidenav-footer-title">
                    @if($user->first_name==null) FirstName
                    @else {{$user->first_name}}
                    @endif

                    @if($user->last_name==null) LastName
                    @else {{$user->last_name}}
                    @endif
                </div>
            </div>
        </div>
    </nav>
</div>