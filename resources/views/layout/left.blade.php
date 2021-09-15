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
                @if(!Auth::user()->is_admin)
                    <a class="nav-link" href="/table">
                        <div class="nav-link-icon">
                            <i class="fas fa-table"></i>
                        </div>
                        Work tables
                    </a>
                @endif
                @if(Auth::user()->is_admin)
                    <a class="nav-link" href="/admin/users">
                        <div class="nav-link-icon">
                            <i class="far fa-address-card"></i>
                        </div>
                        Users
                    </a>
                @endif
                @if(Auth::user()->is_admin)
                    <a class="nav-link" href="/admin/pricelist">
                        <div class="nav-link-icon">
                            <i class="fab fa-buffer"></i>
                        </div>
                        Price list
                    </a>
                @endif
                @if(Auth::user()->is_admin)
                    <a class="nav-link" href="/admin/gallery">
                        <div class="nav-link-icon">
                            <i class="far fa-image"></i>
                        </div>
                        Gallery
                    </a>
                @endif
                @if(Auth::user()->is_admin)
                    <a class="nav-link" href="/admin/random/links">
                        <div class="nav-link-icon">
                            <i class="fas fa-link"></i>
                        </div>
                        Link list
                    </a>
                @endif
                <a class="nav-link" target="_blank" href="https://just-prep.com">
                    <div class="nav-link-icon">
                      <i class="fas fa-tv"></i>
                    </div>
                    back to site
                </a>                
            </div>
        </div>
        <div class="sidenav-footer">
            <div class="sidenav-footer-content">
                <div class="sidenav-footer-subtitle">Logged in as:</div>
                <div class="sidenav-footer-title">
                    @if(Auth::user()->first_name==null) FirstName
                    @else {{Auth::user()->first_name}}
                    @endif

                    @if(Auth::user()->last_name==null) LastName
                    @else {{Auth::user()->last_name}}
                    @endif
                </div>
            </div>
        </div>
    </nav>
</div>