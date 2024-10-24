@extends('adminlte::page')

@section('title', 'Kelas Management')

@section('content_header')
    <h1>Kelas Management</h1>
@stop

@section('content')
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <button class="btn btn-primary" id="createKelas">Add Kelas</button>
    <button class="btn btn-secondary" id="filterKelas">Filter Kelas</button>

    <table id="kelasTable" class="table table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Nama Kelas</th>
            <th>Jumlah Siswa</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($kelas as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->siswa_count }}</td>
                <td>
                    <button class="btn btn-warning editKelas" data-id="{{ $item->id }}">Edit</button>
                    <form action="{{ route('kelas.destroy', $item->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <!-- Create/Edit Modal -->
    <div class="modal fade" id="kelasModal" tabindex="-1" role="dialog" aria-labelledby="kelasModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="kelasModalLabel">Add Kelas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="kelasForm">
                        @csrf
                        <input type="hidden" name="_method" id="method" value="POST">
                        <input type="hidden" name="id" id="id_kelas">

                        <div class="form-group">
                            <label for="nama">Nama Kelas</label>
                            <input type="text" class="form-control" name="nama" id="nama_kelas" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="filteredKelasModal" tabindex="-1" role="dialog" aria-labelledby="filteredKelasModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="filteredKelasModalLabel">Classes Without Students</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Kelas</th>
                        </tr>
                        </thead>
                        <tbody id="filteredKelasTable">
                        <!-- Filtered data will be inserted here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('#kelasTable').DataTable();

            $('#createKelas').click(function() {
                $('#kelasForm')[0].reset();
                $('#method').val('POST');
                $('#kelasModalLabel').text('Add Kelas');
                $('#kelasModal').modal('show');
            });

            $('.editKelas').click(function() {
                const id = $(this).data('id');
                $.get(`/kelas/${id}/edit`, function(data) {
                    $('#id_kelas').val(data.id);
                    $('#nama_kelas').val(data.nama);
                    $('#method').val('PUT');
                    $('#kelasModalLabel').text('Edit Kelas');
                    $('#kelasModal').modal('show');
                });
            });

            $('#kelasForm').on('submit', function(e) {
                e.preventDefault();
                const method = $('#method').val();
                const id = $('#id_kelas').val();
                const url = method === 'POST' ? '/kelas' : `/kelas/${id}`;
                $.ajax({
                    type: method,
                    url: url,
                    data: $(this).serialize(),
                    success: function(response) {
                        location.reload();
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });
            $('#createKelas').click(function() {
                $('#kelasForm')[0].reset();
                $('#method').val('POST');
                $('#kelasModalLabel').text('Add Kelas');
                $('#kelasModal').modal('show');
            });
            $('#filterKelas').click(function() {
                $.ajax({
                    url: '{{ route("kelas.index") }}',
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        let html = '';
                        response.data.forEach(function(kelas) {
                            html += `
                                <tr>
                                    <td>${kelas.id}</td>
                                    <td>${kelas.nama}</td>
                                </tr>
                            `;
                        });

                        $('#filteredKelasTable').html(html);
                        $('#filteredKelasModal').modal('show');
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            });
        });
    </script>
@stop
