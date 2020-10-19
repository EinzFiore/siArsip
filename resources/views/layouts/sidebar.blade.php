<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="index.html">siArsip</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="index.html">St</a>
    </div>
    <ul class="sidebar-menu">
      <li class="menu-header">Dashboard</li>
        <li><a class="nav-link" href="/dashboard"><i class="fas fa-tachometer-alt"></i> <span>Home</span></a></li>
      </li>
      @if (auth()->user()->role == 0)
      <li class="menu-header">Dokumen</li>
        <li class="nav-item dropdown">
          <a href="#" class="nav-link has-dropdown"><i class="fas fa-file-import"></i><span>Serah Terima</span></a>
          <ul class="dropdown-menu">
            <li><a class="nav-link" href="/serahTerima">List Data</a></li>
            <li><a class="nav-link" href="/serahTerima/create">Tambah Data</a></li>
          </ul>
        </li>
      </li>
      @endif
      <li class="menu-header">Jenis Dokumen</li>
          <li><a class="nav-link" href="/jenisDokumen"><i class="far fa-file-code"></i><span>Jenis Dokumen</span></a></li>
      </li>
      <li class="menu-header">Perusahaan</li>
          <li><a class="nav-link" href="/perusahaan"><i class="fas fa-folder-open"></i><span>List Perusahaan</span></a></li>
      </li>
        {{-- <li class="menu-header">Data Dokumen</li>
        <li class="nav-item dropdown">
          <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Dokumen</span></a>
          <ul class="dropdown-menu">
            <li><a class="nav-link" href="#">BC25</a></li>
            <li><a class="nav-link" href="#">Perizinan</a></li>
            <li class="active"><a class="nav-link" href="#">Penolakan</a></li>
          </ul>
        </li> --}}
        <li class="menu-header">Batch</li>
          <li><a class="nav-link" href="/batch"><i class="fas fa-file-alt"></i> <span>List Batch</span></a></li>
        </li>
    </ul>

      <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
        <a href="#" class="btn btn-primary btn-lg btn-block btn-icon-split">
          <i class="fas fa-sign-out-alt"></i> Logout
        </a>
      </div>
  </aside>