<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('dashboard') ? '' : 'collapsed' }}" href="{{ route('dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-heading">Master Data</li>
        
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('venues.*') ? '' : 'collapsed' }}" href="{{ route('venues.index') }}">
                <i class="bi bi-building"></i>
                <span>Venue</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('court_types.*') ? '' : 'collapsed' }}" href="{{ route('court_types.index') }}">
                <i class="bi bi-tags"></i>
                <span>Jenis Lapangan</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('courts.*') ? '' : 'collapsed' }}" href="{{ route('courts.index') }}">
                <i class="bi bi-layers"></i>
                <span>Lapangan</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('members.*') ? '' : 'collapsed' }}" href="{{ route('members.index') }}">
                <i class="bi bi-people"></i>
                <span>Member</span>
            </a>
        </li>

        <li class="nav-heading">Transaksi</li>

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('bookings.*') ? '' : 'collapsed' }}" href="{{ route('bookings.index') }}">
                <i class="bi bi-calendar-check"></i>
                <span>Booking</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('payments.*') ? '' : 'collapsed' }}" href="{{ route('payments.index') }}">
                <i class="bi bi-cash-coin"></i>
                <span>Pembayaran</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('equipment_rentals.*') ? '' : 'collapsed' }}" href="{{ route('equipment_rentals.index') }}">
                <i class="bi bi-bag-plus"></i>
                <span>Penyewaan Peralatan</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('tournaments.*') || request()->routeIs('tournament_participants.*') ? '' : 'collapsed' }}" data-bs-target="#tournament-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-trophy"></i><span>Turnamen</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="tournament-nav" class="nav-content collapse {{ request()->routeIs('tournaments.*') || request()->routeIs('tournament_participants.*') ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('tournaments.index') }}" class="{{ request()->routeIs('tournaments.*') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Data Turnamen</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('tournament_participants.index') }}" class="{{ request()->routeIs('tournament_participants.*') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Peserta Turnamen</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-heading">Lainnya</li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#">
                <i class="bi bi-file-earmark-text"></i>
                <span>Laporan</span>
            </a>
        </li>
        
        <li class="nav-item">
            <a class="nav-link collapsed" href="#">
                <i class="bi bi-gear"></i>
                <span>Pengaturan</span>
            </a>
        </li>
        
        <li class="nav-item">
            <a class="nav-link collapsed" href="#">
                <i class="bi bi-person"></i>
                <span>Profil</span>
            </a>
        </li>

    </ul>
</aside>
