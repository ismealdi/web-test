<div class="btn-group text-links dropstart">
    <button class="btn btn-default btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-three-dots"></i></button>
    
    <ul class="dropdown-menu">
        <li>            
            <a data-id="{{ $data->id }}" data-item="{{ $data }}" data-route="{{ route('students.update', $data->id) }}" data-method="PUT"
            class="dropdown-item" data-bs-toggle="modal" data-bs-target="#addDialog">Ubah</a></li>
        @if(!$data->top)
        <li><hr class="dropdown-divider"></li>
        <li>
            <a data-id="{{ $data->id }}" data-route="{{ route('students.destroy', $data->id) }}" data-method="DELETE"
                class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteDialog">Hapus</a>
        </li>
        @endif
    </ul>
</div>