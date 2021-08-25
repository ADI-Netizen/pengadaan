<!-- Modal -->
<div class="modal fade" id="ubahPengadaanModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ubah Data Pengadaan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="/ubahPengadaan" method="post" role="form" enctype="multipart/form-data">
        <div class="modal-body">
          <!-- form start -->
          {{csrf_field()}}
          <div class="card-body">
            <input type="hidden" class="form-control id_pengadaan" name="id_pengadaan" id="id_pengadaan">
            <div class="form-group">
              <label for="nama_pengadaan">Nama Pengadaan</label>
              <input type="text" class="form-control nama_pengadaan" name="u_nama_pengadaan" id="u_nama_pengadaan" placeholder="Masukkan Nama Pengadaan">
            </div>
            <div class="form-group">
              <label for="deskripsi">Deskripsi</label>
              <textarea class="form-control deskripsi" name="u_deskripsi" id="u_deskripsi" rows="3" placeholder="Deskripsi Pengadaan"></textarea>
            </div>
            <div class="form-group">
              <label for="u_anggaran">Anggaran <input type="" name="" class="label_rp text-right" style="border: none; background-color: white; color: black" disabled="true"> </label>
              <input type="text" class="form-control anggaran" name="u_anggaran" id="u_anggaran" placeholder="Masukkan Anggaran" onkeyup="u_currency()">
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