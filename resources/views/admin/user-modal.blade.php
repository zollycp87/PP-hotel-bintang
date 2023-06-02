<!-- Modal ADD USer -->
<form action="kelola-pegawai" method="post" class="row g-3">
    <div class="modal fade" id="add-user" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Menambah Data User</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="col-12">
                        <label for="nip" class="form-label">Nomor Induk Pegawai</label>
                        <input type="text" class="form-control" id="nip" name="nip" maxlength="6"
                            value="{{ Session::get('nip') }}">
                    </div>
                    <div class="col-12">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama"
                            value="{{ Session::get('nama_pegawai') }}">
                    </div>
                    <div class="col-12">
                        <label for="nama" class="form-label">Divisi</label>
                        <select class="form-select" id="divisi" name="divisi" value="{{ Session::get('divisi') }}">
                            <option selected>Pilih Divisi</option>
                            <option value="1">Cleaning Service</option>
                            <option value="2">Security</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form><!-- Vertical Form -->
{{-- END --}}