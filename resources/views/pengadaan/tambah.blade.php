<!-- Modal -->
<div class="modal fade" id="pengadaanModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Pengadaan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="/tambahPengadaan" method="post" role="form" enctype="multipart/form-data">
        <div class="modal-body">
          <!-- form start -->
          {{csrf_field()}}
          <div class="card-body">
            <div class="form-group">
              <label for="nama_pengadaan">Nama Pengadaan</label>
              <input type="text" class="form-control" name="nama_pengadaan" id="nama_pengadaan" placeholder="Masukkan Nama Pengadaan">
            </div>
            <div class="form-group">
              <label for="deskripsi">Deskripsi</label>
              <textarea class="form-control" name="deskripsi" id="deskripsi" rows="3" placeholder="Deskripsi Pengadaan"></textarea>
            </div>
            <div class="form-group">
              <label for="gambar">Gambar</label>
              <input type="file" class="form-control" name="gambar" id="gambar" accept="image/png, image/jpg, image/gif">
            </div>
            <div class="form-group">
              <label for="anggaran">Anggaran <input type="" name="" class="label_rp text-right" style="border: none; background-color: white; color: black" disabled="true"> </label>
              <input type="text" class="form-control" name="anggaran" id="anggaran" placeholder="Masukkan Anggaran" onkeyup="currency()">
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