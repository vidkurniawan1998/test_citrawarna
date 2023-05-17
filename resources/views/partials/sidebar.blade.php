<!-- ======= Header ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-heading">Fitur Admin</li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="bi bi-house"></i>
                <span>Halaman Utama</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-down"></i><span>Manajemen Barang</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li class="active">
                    <a href="{{ route('barangmasuk.list') }}">
                        <i class="bi bi-circle" class></i><span>Barang Masuk</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('barangkeluar.list') }}">
                        <i class="bi bi-circle"></i><span>Barang Keluar</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Forms Nav -->

    </ul>

</aside>
