<li class="nav-item">
    <a class="nav-link toggle {{ (Request::is('page/students*') || Request::is('page/medicals*')) ? 'active' : 'collapsed' }}" data-bs-toggle="collapse" data-bs-target="#student-collapse" aria-expanded="true">
        <span class="bi bi-file-earmark-richtext align-text-bottom"></span>
        <label>Siswa</label>
    </a>

    <div class="collapse {{ (Request::is('page/students*') || Request::is('page/medicals*')) ? 'show' : '' }}" id="student-collapse" data-bs-parent="#navbarMenu">
        <ul class="btn-toggle-nav list-collapse">

            <li>
                <a data-route="{{ route('students.index') }}" data-title="Siswa" 
                class="targetMenu {{ Request::is('page/students*') ? 'active' : '' }}">
                    Daftar
                </a>
            </li>
            <li>
                <a data-route="{{ route('medicals.index') }}" data-title="Riwayat Check Up" 
                class="targetMenu {{ Request::is('page/medicals*') ? 'active' : '' }}">
                        Riwayat Medis
                </a>
            </li>
        </ul>
    </div>
</li>