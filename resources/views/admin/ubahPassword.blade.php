<!-- Modal -->
<div class="modal fade" id="ubahPassAdm">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">UBAH PASSWORD</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/ubahPassAdm" method="post" role="form">
        <div class="modal-body">
          <!-- form start -->
          {{csrf_field()}}
          <div class="card-body">
            <div class="form-group">
              <label for="password">Masukkan Password Lama</label>
              <input type="password" class="form-control" name="passwordlama" id="passwordlama" placeholder="Password Lama">
            </div>
            <div class="form-group">
              <label for="password">Masukkan Password Baru</label>
              <input type="password" class="form-control" name="password" id="password" placeholder="Password Baru">
            </div>
            <div class="form-group">
              <label for="retype">Masukkan Ulang Password Baru</label>
              <input type="password" class="form-control" name="retype" id="retype" placeholder="Ulangi Password Baru">
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