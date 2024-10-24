@extends('adminlte::page')

@section('title', 'Siswa Management')

@section('content_header')
    <h1>Siswa Management</h1>
@stop

@section('content')
    @if (session('success'))
        <x-adminlte-alert theme="success" title="Success!" dismissable>
            {{ session('success') }}
        </x-adminlte-alert>
    @endif

    <x-adminlte-button label="Add Siswa" id="createSiswa" theme="primary" />

    <x-adminlte-datatable id="siswaTable" class="table table-bordered" :heads="['ID', 'Nama Siswa', 'NIS', 'Tanggal Lahir', 'Kelas', 'Actions']">
        @foreach ($siswa as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->siswa }}</td>
                <td>{{ $item->nis }}</td>
                <td>{{ $item->tanggal_lahir->format('d-m-Y') }}</td>
                <td>{{ $item->kelas->nama_kelas }}</td>
                <td>
                    <x-adminlte-button class="editSiswa" data-id="{{ $item->id_siswa }}" label="Edit" theme="warning" />
                    <form action="{{ route('siswa.destroy', $item->id_siswa) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <x-adminlte-button type="submit" label="Delete" theme="danger" />
                    </form>
                </td>
            </tr>
        @endforeach
    </x-adminlte-datatable>

    <!-- Create/Edit Modal -->
    <x-adminlte-modal id="siswaModal" title="Add Siswa" size="lg">
        <form id="siswaForm">
            @csrf
            <input type="hidden" name="_method" id="method" value="POST">
            <input type="hidden" name="id_siswa" id="id_siswa">

            <div class="form-group">
                <label for="nama_siswa">Nama Siswa</label>
                <x-adminlte-input name="nama_siswa" id="nama_siswa" required />
            </div>
            <div class="form-group">
                <label for="nis">NIS</label>
                <x-adminlte-input name="nis" id="nis" required />
            </div>
            <div class="form-group">
                <label for="tanggal_lahir">Tanggal Lahir</label>
                <x-adminlte-input name="tanggal_lahir" id="tanggal_lahir" type="date" required />
            </div>
            <div class="form-group">
                <label for="id_kelas">Kelas</label>
                <x-adminlte-select name="id_kelas" id="id_kelas" required>
                    @foreach ($kelas as $kelasItem)
                        <option value="{{ $kelasItem->id_kelas }}">{{ $kelasItem->nama_kelas }}</option>
                    @endforeach
                </x-adminlte-select>
            </div>
            <x-adminlte-button type="submit" label="Save" theme="primary" />
        </form>
    </x-adminlte-modal>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('#siswaTable').DataTable();

            // Open modal for creating siswa
            $('#createSiswa').click(function() {
                $('#siswaForm')[0].reset();
                $('#method').val('POST');
                $('#siswaModal').modal('show');
            });

            // Open modal for editing siswa
            $('.editSiswa').click(function() {
                const id = $(this).data('id');
                $.get(`/siswa/${id}/edit`, function(data) {
                    $('#id_siswa').val(data.id_siswa);
                    $('#nama_siswa').val(data.nama_siswa);
                    $('#nis').val(data.nis);
                    $('#tanggal_lahir').val(data.tanggal_lahir);
                    $('#id_kelas').val(data.id_kelas);
                    $('#method').val('PUT');
                    $('#siswaModal').modal('show');
                });
            });

            // Handle form submission
            $('#siswaForm').on('submit', function(e) {
                e.preventDefault();
                const method = $('#method').val();
                const id = $('#id_siswa').val();
                const url = method === 'POST' ? '/siswa' : `/siswa/${id}`;
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
        });
    </script>
@stop
