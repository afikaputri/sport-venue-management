<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        @php
            $role = strtolower(auth()->user()->role);
            $isOwner = $role === 'pemilik' || $role === 'owner';
            $isStaff = $role === 'staff';
            $isMember = $role === 'member';
        @endphp

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('dashboard') ? '' : 'collapsed' }}" href="{{ route('dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>

        @if($isMember)
        <li class="nav-heading">Pemesanan</li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('member.venues*') || request()->routeIs('member.courts*') ? '' : 'collapsed' }}" href="{{ route('member.venues') }}">
                <i class="bi bi-geo-alt"></i>
                <span>Daftar Venue</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('member.bookings*') ? '' : 'collapsed' }}" href="{{ route('member.bookings') }}">
                <i class="bi bi-journal-check"></i>
                <span>Booking Saya</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('member.payments*') ? '' : 'collapsed' }}" href="{{ route('member.payments') }}">
                <i class="bi bi-cash-coin"></i>
                <span>Pembayaran Saya</span>
            </a>
        </li>
        @endif

        @if($isStaff)
        <li class="nav-heading">Operasional</li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('members.*') ? '' : 'collapsed' }}" href="{{ route('members.index') }}">
                <i class="bi bi-people"></i>
                <span>Member</span>
            </a>
        </li>
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
        @endif

        @if($isOwner)
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
                <i class="bi bi-dribbble"></i>
                <span>Lapangan</span>
            </a>
        </li>

        <li class="nav-heading">Laporan & Pantauan</li>
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#reports-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-bar-chart"></i><span>Laporan</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="reports-nav" class="nav-content collapse {{ request()->is('reports*') ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
                <li><a href="{{ route('reports.booking') }}" class="{{ request()->routeIs('reports.booking') ? 'active' : '' }}"><i class="bi bi-circle"></i><span>Laporan Booking</span></a></li>
                <li><a href="{{ route('reports.payment') }}" class="{{ request()->routeIs('reports.payment') ? 'active' : '' }}"><i class="bi bi-circle"></i><span>Laporan Pembayaran</span></a></li>
            </ul>
        </li>

        <li class="nav-heading">Sistem</li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('settings.*') ? '' : 'collapsed' }}" href="{{ route('settings.index') }}">
                <i class="bi bi-gear"></i>
                <span>Pengaturan</span>
            </a>
        </li>
        @endif

        <li class="nav-heading">Akun</li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('profile.*') ? '' : 'collapsed' }}" href="{{ route('profile.index') }}">
                <i class="bi bi-person"></i>
                <span>Profil</span>
            </a>
        </li>
        
        <li class="nav-item">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="nav-link collapsed w-100 border-0 bg-transparent text-danger">
                    <i class="bi bi-box-arrow-right text-danger"></i>
                    <span>Logout</span>
                </button>
            </form>
        </li>
    </ul>
</aside>
