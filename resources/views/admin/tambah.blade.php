<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Administrator</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="/tambahAdmin" method="post" role="form">
        <div class="modal-body">
          <!-- form start -->
          {{csrf_field()}}
          <div class="card-body">
            <div class="form-group">
              <label for="nama">Nama Lengkap</label>
              <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukkan Nama Lengkap">
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" class="form-control" name="email" id="email" placeholder="Masukkan Alamat Email">
            </div>
            <div class="form-group">
              <label for="alamat">Alamat</label>
              <textarea class="form-control" name="alamat" id="alamat" rows="3" placeholder="Alamat Tempat Tinggal"></textarea>
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" class="form-control" name="password" id="password" placeholder="Masukkan Password">
            </div>
          </div>
          <!-- /.card-body -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-window-close"> Batal</i></button>
          <button type="submit" class="btn btn-success"><i class="fas fa-save"> Simpan</i></button>
        </div>
      </form>
    </div>
    </div>
  </div>
</div>
