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

<li class="nav-item has-sub {{(request()->is('admin/m/*'))? ' open' : ''}}">
    <a href="#" class="d-flex align-items-center" target="_self">
        <i data-feather="tag"></i>
        <span class="menu-title text-truncate">Master Data</span>
    </a>
    <ul class="menu-content">
        <li class="nav-item {{(request()->is('jenis-admin'))? 'active' : ''}}">
            <a href="{{route('jenis-admin')}}" class="d-flex align-items-center" target="_self">
                <i data-feather="briefcase"></i>
                <span class="menu-title text-truncate">Kategori Dagangan</span>
            </a>
        </li>
        <li class="{{(request()->is('admin/m/lokasi'))? 'active' : ''}}">
            <a href="{{route('lokasi-admin')}}" class="d-flex align-items-center" target="_self">
                <i data-feather="map-pin"></i>
                <span class="menu-title text-truncate">Data Pasar</span>
            </a>
        </li>
    </ul>
</li>
@foreach ($lokasi_pasars as $pas)
<li class="nav-item has-sub {{(request()->is('admin/pc/*'))? ' open' : ''}}">
    <a href="#" class="d-flex align-items-center" target="_self">
        <i data-feather="shopping-bag"></i>
        <span class="menu-title text-truncate">{{$pas->nama}}</span>
    </a>
    <ul class="menu-content">
        <li class="{{(request()->is('tagihan-admin'))? 'active' : ''}}">
            <a href="{{route('tagihan-admin',['id'=>$pas->id])}}" class="d-flex align-items-center" target="_self">
                <i data-feather="credit-card"></i>
                <span class="menu-title text-truncate">Data Tagihan</span>
            </a>
        </li>
        <li class="{{(request()->is('admin/d/pedagang'))? 'active' : ''}}">
            <a href="{{route('pedagang-admin',['id'=>$pas->id])}}" class="d-flex align-items-center" target="_self">
                <i data-feather="shopping-bag"></i>
                <span class="menu-title text-truncate">Data Pedagang</span>
            </a>
        </li>
        <li class="{{(request()->is('admin/m/blok'))? 'active' : ''}}">
            <a href="{{route('blok-admin',['id'=>$pas->id])}}" class="d-flex align-items-center" target="_self">
                <i data-feather="briefcase"></i>
                <span class="menu-title text-truncate">Data Kios</span>
            </a>
        </li>
        <li class="{{(request()->is('admin/d/petugas'))? 'active' : ''}}">
            <a href="{{route('petugas-admin',['id'=>$pas->id])}}" class="d-flex align-items-center" target="_self">
                <i data-feather="users"></i>
                <span class="menu-title text-truncate">Data Petugas Pasar</span>
            </a>
        </li>
        <li class="{{(request()->is('admin/denah'))? 'active' : ''}}">
            <a href="{{route('denah',['id'=>$pas->id])}}" class="d-flex align-items-center" target="_self">
                <i data-feather="map"></i>
                <span class="menu-title text-truncate">Denah Pasar</span>
            </a>
        </li>
        <li class="{{(request()->is('admin/p/pembayaran'))? 'active' : ''}}">
            <a href="{{route('pembayaran-admin',['id'=>$pas->id])}}" class="d-flex align-items-center" target="_self">
                <i data-feather="briefcase"></i>
                <span class="menu-title text-truncate">Data Retribusi</span>
            </a>
        </li>
        <li class=" {{(request()->is('admin/l/bulan'))? 'active' : ''}}">
            <a href="{{ route('bulan-admin', ['bulan' => 'default','tahun'=>'default','id'=>$pas->id]) }}" class="d-flex align-items-center" target="_self">
                <i data-feather="mail"></i>
                <span class="menu-title text-truncate">Laporan</span>
            </a>
        </li>
    </ul>
</li>
@endforeach
<li class="nav-item {{(request()->is('info-admin'))? 'active' : ''}}">
    <a href="{{route('info-admin')}}" class="d-flex align-items-center" target="_self">
        <i data-feather="info"></i>
        <span class="menu-title text-truncate">Informasi</span>
    </a>
</li>
<li class="nav-item {{(request()->is('admin/pengunjung'))? 'active' : ''}}">
    <a href="{{route('pengunjung-admin')}}" class="d-flex align-items-center" target="_self">
        <i data-feather="user-plus"></i>
        <span class="menu-title text-truncate">Pengunjung</span>
    </a>
</li>
@elseif (auth()->user()->role=='petugas')
<li class="nav-item {{(request()->is('admin'))? 'active' : ''}}">
    <a href="{{route('dashboard-admin')}}" class="d-flex align-items-center" target="_self">
        <i data-feather="home"></i>
        <span class="menu-title text-truncate">Dashboard</span>
    </a>
</li>
<li class="nav-item {{(request()->is('jenis-admin'))? 'active' : ''}}">
    <a href="{{route('jenis-admin')}}" class="d-flex align-items-center" target="_self">
        <i data-feather="briefcase"></i>
        <span class="menu-title text-truncate">Kategori Dagangan</span>
    </a>
</li>
@foreach ($lokasi_pasars as $pas)
<li class="nav-item has-sub {{(request()->is('admin/pc/*'))? ' open' : ''}}">
    <a href="#" class="d-flex align-items-center" target="_self">
        <i data-feather="shopping-bag"></i>
        <span class="menu-title text-truncate">{{$pas->nama}}</span>
    </a>
    <ul class="menu-content">
        <li class="{{(request()->is('tagihan-admin'))? 'active' : ''}}">
            <a href="{{route('tagihan-admin',['id'=>$pas->id])}}" class="d-flex align-items-center" target="_self">
                <i data-feather="credit-card"></i>
                <span class="menu-title text-truncate">Data Tagihan</span>
            </a>
        </li>
        <li class="{{(request()->is('admin/d/pedagang'))? 'active' : ''}}">
            <a href="{{route('pedagang-admin',['id'=>$pas->id])}}" class="d-flex align-items-center" target="_self">
                <i data-feather="shopping-bag"></i>
                <span class="menu-title text-truncate">Data Pedagang</span>
            </a>
        </li>
        <li class="{{(request()->is('admin/m/blok'))? 'active' : ''}}">
            <a href="{{route('blok-admin',['id'=>$pas->id])}}" class="d-flex align-items-center" target="_self">
                <i data-feather="briefcase"></i>
                <span class="menu-title text-truncate">Data Kios</span>
            </a>
        </li>
        <li class="{{(request()->is('admin/d/petugas'))? 'active' : ''}}">
            <a href="{{route('petugas-admin',['id'=>$pas->id])}}" class="d-flex align-items-center" target="_self">
                <i data-feather="users"></i>
                <span class="menu-title text-truncate">Data Petugas Pasar</span>
            </a>
        </li>
        <li class="{{(request()->is('admin/denah'))? 'active' : ''}}">
            <a href="{{route('denah',['id'=>$pas->id])}}" class="d-flex align-items-center" target="_self">
                <i data-feather="map"></i>
                <span class="menu-title text-truncate">Denah Pasar</span>
            </a>
        </li>
        <li class="{{(request()->is('admin/p/pembayaran'))? 'active' : ''}}">
            <a href="{{route('pembayaran-admin',['id'=>$pas->id])}}" class="d-flex align-items-center" target="_self">
                <i data-feather="briefcase"></i>
                <span class="menu-title text-truncate">Data Retribusi</span>
            </a>
        </li>
        <li class=" {{(request()->is('admin/l/bulan'))? 'active' : ''}}">
            <a href="{{ route('bulan-admin', ['bulan' => 'default','tahun'=>'default','id'=>$pas->id]) }}" class="d-flex align-items-center" target="_self">
                <i data-feather="mail"></i>
                <span class="menu-title text-truncate">Laporan</span>
            </a>
        </li>
    </ul>
</li>
@endforeach
<li class="nav-item {{(request()->is('info-admin'))? 'active' : ''}}">
    <a href="{{route('info-admin')}}" class="d-flex align-items-center" target="_self">
        <i data-feather="info"></i>
        <span class="menu-title text-truncate">Informasi</span>
    </a>
</li>
<li class="nav-item {{(request()->is('admin/pengunjung'))? 'active' : ''}}">
    <a href="{{route('pengunjung-admin')}}" class="d-flex align-items-center" target="_self">
        <i data-feather="user-plus"></i>
        <span class="menu-title text-truncate">Pengunjung</span>
    </a>
</li>
@elseif (auth()->user()->role=='pedagang')
<li class="nav-item {{(request()->is('pedagang'))? 'active' : ''}}">
    <a href="{{route('dashboard-pedagang')}}" class="d-flex align-items-center" target="_self">
        <i data-feather="home"></i>
        <span class="menu-title text-truncate">Dashboard</span>
    </a>
</li>
<li class="nav-item {{(request()->is('blok-pedagang'))? 'active' : ''}}">
    <a href="{{route('blok-pedagang')}}" class="d-flex align-items-center" target="_self">
        <i data-feather="home"></i>
        <span class="menu-title text-truncate">Data Sewa Kios</span>
    </a>
</li>
@foreach ($lokasi_pasars as $pas)
<li class="nav-item has-sub {{(request()->is('admin/pc/*'))? ' open' : ''}}">
    <a href="#" class="d-flex align-items-center" target="_self">
        <i data-feather="shopping-bag"></i>
        <span class="menu-title text-truncate">{{$pas->nama}}</span>
    </a>
    <ul class="menu-content">
        <li class="{{(request()->is('tagihan-admin'))? 'active' : ''}}">
            <a href="{{route('tagihan-admin',['id'=>$pas->id])}}" class="d-flex align-items-center" target="_self">
                <i data-feather="credit-card"></i>
                <span class="menu-title text-truncate">Data Tagihan</span>
            </a>
        </li>
        <li class="{{(request()->is('admin/d/pedagang'))? 'active' : ''}}">
            <a href="{{route('pedagang-admin',['id'=>$pas->id])}}" class="d-flex align-items-center" target="_self">
                <i data-feather="shopping-bag"></i>
                <span class="menu-title text-truncate">Data Pedagang</span>
            </a>
        </li>
        <li class="{{(request()->is('admin/m/blok'))? 'active' : ''}}">
            <a href="{{route('blok-admin',['id'=>$pas->id])}}" class="d-flex align-items-center" target="_self">
                <i data-feather="briefcase"></i>
                <span class="menu-title text-truncate">Data Kios</span>
            </a>
        </li>
        <li class="{{(request()->is('admin/d/petugas'))? 'active' : ''}}">
            <a href="{{route('petugas-admin',['id'=>$pas->id])}}" class="d-flex align-items-center" target="_self">
                <i data-feather="users"></i>
                <span class="menu-title text-truncate">Data Petugas Pasar</span>
            </a>
        </li>
        <li class="{{(request()->is('admin/denah'))? 'active' : ''}}">
            <a href="{{route('denah',['id'=>$pas->id])}}" class="d-flex align-items-center" target="_self">
                <i data-feather="map"></i>
                <span class="menu-title text-truncate">Denah Pasar</span>
            </a>
        </li>
    </ul>
</li>
@endforeach
<li class="nav-item {{(request()->is('info-admin'))? 'active' : ''}}">
    <a href="{{route('info-admin')}}" class="d-flex align-items-center" target="_self">
        <i data-feather="info"></i>
        <span class="menu-title text-truncate">Informasi</span>
    </a>
</li>
@endif