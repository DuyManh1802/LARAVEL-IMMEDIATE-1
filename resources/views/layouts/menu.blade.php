<div class=" px-0 col">
    <div class="offcanvas-header">
        <h6 class="offcanvas-title d-none d-sm-block">Menu</h6>
    </div>
    <ul class="nav flex-column mb-sm-auto mb-0 align-items-start" id="menu">
        <li class="dropdown">
            <a href="#" class="nav-link dropdown-toggle  text-truncate" id="dropdown" data-bs-toggle="dropdown"
                aria-expanded="false">
                <i class="fs-5 bi-bootstrap"></i><span class="ms-1 d-none d-sm-inline">User</span>
            </a>
            <ul class="dropdown-menu text-small " aria-labelledby="dropdown">
                <li><a class="dropdown-item" href="{{ route('user.list') }}">List User</a></li>
                <li><a class="dropdown-item" href="{{ route('user.create') }}">Create User</a></li>
            </ul>
        </li>
    </ul>
</div>
