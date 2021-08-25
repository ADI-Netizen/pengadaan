<!-- Modal -->
<div class="modal fade" id="pengajuanModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Pengajuan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="/tambahPengajuan" method="post" role="form" enctype="multipart/form-data">
        <div class="modal-body">
          <!-- form start -->
          {{csrf_field()}}
          <div class="card-body">
            <div class="form-group">
              <label for="nama_pengadaan">Nama Pengadaan</label>
              <input type="hidden" name="id_pengadaan" id="id_pengadaan" class="id_pengadaan">
              <input type="text" class="form-control nama_pengadaan" name="nama_pengadaan" id="nama_pengadaan" placeholder="Masukkan Nama Pengadaan" disabled>
            </div>
            <div class="form-group">
              <label for="anggaran">Anggaran <input type="" name="" class="label_rp text-right" style="border: none; background-color: white; color: black" disabled="true"> </label>
              <input type="text" class="form-control anggaran" name="anggaran" id="anggaran" placeholder="Masukkan Anggaran" onkeyup="currency()">
            </div>
            <div class="form-group">
              <label for="gambar">Proposal</label>
              <input type="file" class="form-control" name="proposal" id="proposal" accept="application/pdf">
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