@extends('adminlte::page')

@section('title', 'Siswa Management')

@section('content_header')
    <h1>Siswa Management</h1>
@stop

@section('content')
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <button class="btn btn-primary" id="createSiswa">Add Siswa</button>

    <table id="siswaTable" class="table table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Nama Siswa</th>
            <th>NIS</th>
            <th>Tanggal Lahir</th>
            <th>Kelas</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($siswa as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->nis }}</td>
                <td>{{ $item->tanggal_lahir->format('d-m-Y') }}</td>
                <td>{{ $item->kelas->nama }}</td>
                <td>
                    <button class="btn btn-warning editSiswa" data-id="{{ $item->id }}">Edit</button>
                    <form action="{{ route('siswa.destroy', $item->id) }}" method="POST" style="display:inline;">
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
    <div class="modal fade" id="siswaModal" tabindex="-1" role="dialog" aria-labelledby="siswaModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="siswaModalLabel">Add Siswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="siswaForm">
                        @csrf
                        <input type="hidden" name="_method" id="method" value="POST">
                        <input type="hidden" name="id" id="id_siswa">

                        <div class="form-group">
                            <label for="nama_siswa">Nama Siswa</label>
                            <input type="text" class="form-control" name="nama" id="nama_siswa" required>
                        </div>
                        <div class="form-group">
                            <label for="nis">NIS</label>
                            <input type="text" class="form-control" name="nis" id="nis" required>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_lahir">Tanggal Lahir</label>
                            <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir" required>
                        </div>
                        <div class="form-group">
                            <label for="id_kelas">Kelas</label>
                            <select class="form-control" name="kelas_id" id="id_kelas" required>
                                @foreach ($kelas as $kelasItem)
                                    <option value="{{ $kelasItem->id }}">{{ $kelasItem->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('#siswaTable').DataTable();

            $('#createSiswa').click(function() {
                $('#siswaForm')[0].reset();
                $('#method').val('POST');
                $('#siswaModalLabel').text('Add Siswa');
                $('#siswaModal').modal('show');
            });

            $('.editSiswa').click(function() {
                const id = $(this).data('id');
                $.get(`/siswa/${id}/edit`, function(data) {
                    $('#id_siswa').val(data.id);
                    $('#nama_siswa').val(data.nama);
                    $('#nis').val(data.nis);
                    let tanggalLahir = new Date(data.tanggal_lahir).toISOString().split('T')[0];
                    $('#tanggal_lahir').val(tanggalLahir);
                    $('#id_kelas').val(data.kelas_id);
                    $('#method').val('PUT');
                    $('#siswaModalLabel').text('Edit Siswa');
                    $('#siswaModal').modal('show');
                });
            });

            $('#filterForm').on('submit', function(e) {
                e.preventDefault();
                const filterNama = $('#filter_nama').val();
                $.ajax({
                    url: '{{ route("kelas.index") }}',
                    type: 'GET',
                    data: { nama: filterNama },
                    success: function(response) {
                        // Replace table body with filtered results
                        $('tbody').html(response);
                        $('#filterModal').modal('hide');
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });
        });
    </script>
@stop
