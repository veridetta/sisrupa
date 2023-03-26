<li class="navigation-header">
    <span>Menu</span>
    <i data-feather="more-horizontal"></i>
  </li>

@if (auth()->user()->role=='admin')
<li class="nav-item {{(request()->is('admin'))? 'active' : ''}}">
    <a href="{{route('dashboard-admin')}}" class="d-flex align-items-center" target="_self">
        <i data-feather="home"></i>
        <span class="menu-title text-truncate">Dashboard</span>
    </a>
</li>
<li class="nav-item {{(request()->is('info-admin'))? 'active' : ''}}">
    <a href="{{route('info-admin')}}" class="d-flex align-items-center" target="_self">
        <i data-feather="info"></i>
        <span class="menu-title text-truncate">Informasi</span>
    </a>
</li>
<li class="nav-item has-sub {{(request()->is('admin/m/*'))? ' open' : ''}}">
    <a href="#" class="d-flex align-items-center" target="_self">
        <i data-feather="briefcase"></i>
        <span class="menu-title text-truncate">Master Data</span>
    </a>
    <ul class="menu-content">
        <li class="{{(request()->is('admin/m/jenis'))? 'active' : ''}}">
            <a href="{{route('jenis-admin')}}" class="d-flex align-items-center" target="_self">
                <i data-feather="briefcase"></i>
                <span class="menu-title text-truncate">Jenis Pedagang</span>
            </a>
        </li>
        <li class="{{(request()->is('admin/m/lokasi'))? 'active' : ''}}">
            <a href="{{route('lokasi-admin')}}" class="d-flex align-items-center" target="_self">
                <i data-feather="briefcase"></i>
                <span class="menu-title text-truncate">Lokasi Pasar</span>
            </a>
        </li>
        <li class="{{(request()->is('admin/m/blok'))? 'active' : ''}}">
            <a href="{{route('blok-admin')}}" class="d-flex align-items-center" target="_self">
                <i data-feather="briefcase"></i>
                <span class="menu-title text-truncate">Data Blok</span>
            </a>
        </li>
        <li class="{{(request()->is('admin/m/tagihan'))? 'active' : ''}}">
            <a href="{{route('tagihan-admin')}}" class="d-flex align-items-center" target="_self">
                <i data-feather="briefcase"></i>
                <span class="menu-title text-truncate">Data Tagihan</span>
            </a>
        </li>
    </ul>
</li>
<li class="nav-item has-sub {{(request()->is('admin/d/*'))? ' open' : ''}}">
    <a href="#" class="d-flex align-items-center" target="_self">
        <i data-feather="users"></i>
        <span class="menu-title text-truncate">Master User</span>
    </a>
    <ul class="menu-content">
        <li class="{{(request()->is('admin/d/petugas'))? 'active' : ''}}">
            <a href="{{route('petugas-admin')}}" class="d-flex align-items-center" target="_self">
                <i data-feather="users"></i>
                <span class="menu-title text-truncate">Petugas Pasar</span>
            </a>
        </li>
        <li class="{{(request()->is('admin/d/pedagang'))? 'active' : ''}}">
            <a href="{{route('pedagang-admin')}}" class="d-flex align-items-center" target="_self">
                <i data-feather="users"></i>
                <span class="menu-title text-truncate">Pedagang</span>
            </a>
        </li>
    </ul>
</li>
<li class="nav-item has-sub {{(request()->is('admin/p/*'))? ' open' : ''}}">
    <a href="#" class="d-flex align-items-center" target="_self">
        <i data-feather="check-circle"></i>
        <span class="menu-title text-truncate">Penyewaan</span>
    </a>
    <ul class="menu-content">
        <li class=" {{(request()->is('admin/r/penyewaan'))? 'active' : ''}}">
            <a href="{{route('penyewaan-admin')}}" class="d-flex align-items-center" target="_self">
                <i data-feather="mail"></i>
                <span class="menu-title text-truncate">Data Kontrakan</span>
            </a>
        </li>
        <li class=" {{(request()->is('admin/r/pembayaran'))? 'active' : ''}}">
            <a href="{{route('pembayaran-admin')}}" class="d-flex align-items-center" target="_self">
                <i data-feather="users"></i>
                <span class="menu-title text-truncate">Pembayaran</span>
            </a>
        </li>
    </ul>
</li>
<li class="nav-item has-sub {{(request()->is('admin/r/*'))? ' open' : ''}}">
    <a href="#" class="d-flex align-items-center" target="_self">
        <i data-feather="check-circle"></i>
        <span class="menu-title text-truncate">Laporan</span>
    </a>
    <ul class="menu-content">
        <li class=" {{(request()->is('admin/l/bulan'))? 'active' : ''}}">
            <a href="{{ route('bulan-admin', ['bulan' => 'default','tahun'=>'default']) }}" class="d-flex align-items-center" target="_self">
                <i data-feather="mail"></i>
                <span class="menu-title text-truncate">Bulanan</span>
            </a>
        </li>
        <li class=" {{(request()->is('admin/l/harian'))? 'active' : ''}}">
            <a href="{{ route('harian-admin', ['tanggal' => 'default']) }}" class="d-flex align-items-center" target="_self">
                <i data-feather="users"></i>
                <span class="menu-title text-truncate">Harian</span>
            </a>
        </li>
    </ul>
</li>
@elseif (auth()->user()->role=='petugas')
<li class="nav-item {{(request()->is('admin'))? 'active' : ''}}">
    <a href="{{route('dashboard-admin')}}" class="d-flex align-items-center" target="_self">
        <i data-feather="home"></i>
        <span class="menu-title text-truncate">Dashboard</span>
    </a>
</li>
<li class="nav-item {{(request()->is('admin/d/pedagang'))? 'active' : ''}}">
    <a href="{{route('pedagang-admin')}}" class="d-flex align-items-center" target="_self">
        <i data-feather="users"></i>
        <span class="menu-title text-truncate">Data Pedagang</span>
    </a>
</li>
<li class="nav-item has-sub {{(request()->is('admin/p/*'))? ' open' : ''}}">
    <a href="#" class="d-flex align-items-center" target="_self">
        <i data-feather="check-circle"></i>
        <span class="menu-title text-truncate">Penyewaan</span>
    </a>
    <ul class="menu-content">
        <li class=" {{(request()->is('admin/r/penyewaan'))? 'active' : ''}}">
            <a href="{{route('penyewaan-admin')}}" class="d-flex align-items-center" target="_self">
                <i data-feather="mail"></i>
                <span class="menu-title text-truncate">Data Kontrakan</span>
            </a>
        </li>
        <li class=" {{(request()->is('admin/r/pembayaran'))? 'active' : ''}}">
            <a href="{{route('pembayaran-admin')}}" class="d-flex align-items-center" target="_self">
                <i data-feather="users"></i>
                <span class="menu-title text-truncate">Pembayaran</span>
            </a>
        </li>
    </ul>
</li>
<li class="nav-item has-sub {{(request()->is('admin/r/*'))? ' open' : ''}}">
    <a href="#" class="d-flex align-items-center" target="_self">
        <i data-feather="check-circle"></i>
        <span class="menu-title text-truncate">Laporan</span>
    </a>
    <ul class="menu-content">
        <li class=" {{(request()->is('admin/l/bulan'))? 'active' : ''}}">
            <a href="{{ route('bulan-admin', ['bulan' => 'default','tahun'=>'default']) }}" class="d-flex align-items-center" target="_self">
                <i data-feather="mail"></i>
                <span class="menu-title text-truncate">Bulanan</span>
            </a>
        </li>
        <li class=" {{(request()->is('admin/l/harian'))? 'active' : ''}}">
            <a href="{{ route('harian-admin', ['tanggal' => 'default']) }}" class="d-flex align-items-center" target="_self">
                <i data-feather="users"></i>
                <span class="menu-title text-truncate">Harian</span>
            </a>
        </li>
    </ul>
</li>
@elseif (auth()->user()->role=='pedagang')
<li class="nav-item {{(request()->is('pedagang'))? 'active' : ''}}">
    <a href="{{route('dashboard-pedagang')}}" class="d-flex align-items-center" target="_self">
        <i data-feather="home"></i>
        <span class="menu-title text-truncate">Dashboard</span>
    </a>
</li>
<li class="{{(request()->is('admin/m/lokasi'))? 'active' : ''}}">
    <a href="{{route('lokasi-admin')}}" class="d-flex align-items-center" target="_self">
        <i data-feather="briefcase"></i>
        <span class="menu-title text-truncate">Lokasi Pasar</span>
    </a>
</li>
<li class="{{(request()->is('admin/m/blok'))? 'active' : ''}}">
    <a href="{{route('blok-admin')}}" class="d-flex align-items-center" target="_self">
        <i data-feather="briefcase"></i>
        <span class="menu-title text-truncate">Data Blok</span>
    </a>
</li>
@endif