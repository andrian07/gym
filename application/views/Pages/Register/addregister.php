<?php 
define('DOC_ROOT_PATH', $_SERVER['DOCUMENT_ROOT'].'/');
require DOC_ROOT_PATH . $this->config->item('header');
?>
</div>

<div class="container">
  <div class="page-inner">
    <div class="page-header">

    </div>
    <div class="row">
      <div class="col-md-12">
        <h3 class="fw-bold mb-3" style="margin-left:1%;">Pendaftaran Member Baru</h3>
        <div class="card">
          <div class="card-header">
            <div class="card-title" style="font-size: 17px;color: #1572e8!important;">Data Member</div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-3 border-right">
                <div class="form-group form-inline">
                  <div class="proof">
                    <div class="imgArea" data-title="">
                      <input type="file" name="screenshoot" id="screenshoot" hidden accept="image/*" />
                      <i class="fa-solid fa-cloud-arrow-up"></i>
                      <h4>upload foto member</h4>
                      <p>image size must be less than <span>2MB</span></p>
                    </div>
                    <button class="selectImage" type="button">Select Image</button>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group form-inline">
                  <label for="inlineinput" class="col-md-3 col-form-label">Kode Member</label>
                  <div class="col-md-12 p-0">
                    <input type="text" class="form-control input-full" name="member_code" id="member_code" value="Auto" readonly>
                  </div>
                </div>

                <div class="form-group form-inline">
                  <label for="inlineinput" class="col-md-3 col-form-label">Nama</label>
                  <div class="col-md-12 p-0">
                    <input type="text" class="form-control input-full" name="member_name" id="member_name" placeholder="Nama Member">
                  </div>
                </div>

                <div class="form-group form-inline">
                  <label for="inlineinput" class="col-md-3 col-form-label">No HP</label>
                  <div class="col-md-12 p-0">
                    <input type="text" class="form-control input-full" name="member_phone" id="member_phone" placeholder="No HP">
                  </div>
                </div>

                <div class="form-group form-inline">
                  <label for="inlineinput" class="col-md-3 col-form-label">Nik</label>
                  <div class="col-md-12 p-0">
                    <input type="text" class="form-control input-full" name="member_nik" id="member_nik" placeholder="NIK">
                  </div>
                </div>

                <div class="form-group form-inline">
                  <label for="inlineinput" class="col-md-3 col-form-label">Tgl Lahir</label>
                  <div class="col-md-12 p-0">
                    <input type="date" class="form-control input-full" name="member_dob" id="member_dob">
                  </div>
                </div>
              </div>

              <div class="col-md-3">
                <div class="form-group form-inline">
                  <label for="inlineinput" class="col-md-3 col-form-label">Email</label>
                  <div class="col-md-12 p-0">
                    <input type="text" class="form-control input-full" name="member_email" id="member_email" placeholder="Email">
                  </div>
                </div>

                <div class="form-group form-inline">
                  <label for="inlineinput" class="col-md-3 col-form-label">Alamat</label>
                  <div class="col-md-12 p-0">
                    <textarea class="form-control" id="member_address" name="member_address" rows="5"></textarea>
                  </div>
                </div>

                <div class="form-group form-inline">
                  <label for="inlineinput" class="col-md-3 col-form-label">Jenis Kelamin</label>
                  <div class="col-md-12 p-0">
                    <select class="form-select form-control" id="member_gender" name="member_gender">
                      <option value="Pria">Pria</option>
                      <option value="Wanita">Wanita</option>
                    </select>
                  </div>
                </div>

                <div class="form-group form-inline">
                  <label for="inlineinput" class="col-md-3 col-form-label">Kontak Darurat Yang Dapat Dihubungi</label>
                  <div class="col-md-12 p-0">
                    <input type="text" class="form-control input-full" name="member_urgent_phone" id="member_urgent_phone" placeholder="Kontak Darurat">
                  </div>
                </div>

              </div>

              <div class="col-md-3">

                <div class="form-group form-inline">
                  <label for="inlineinput" class="col-md-3 col-form-label">Hubungan</label>
                  <div class="col-md-12 p-0">
                    <input type="text" class="form-control input-full" name="member_urgent_sibiling" id="member_urgent_sibiling" placeholder="Hubungan">
                  </div>
                </div>

                <div class="form-group form-inline">
                  <label for="inlineinput" class="col-md-3 col-form-label">Keterangan (alergi / penyakit bawaan /dll):</label>
                  <div class="col-md-12 p-0">
                    <textarea class="form-control" id="member_desc" name="member_desc" rows="5"></textarea>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-7"> 
              <div class="card-header">
                <div class="card-title" style="font-size: 17px; color: #1572e8!important;">Data Kelas</div>
              </div>
              <div class="card-body">
                <div class="form-group row">
                  <label for="noinvoice" class="col-sm-3 col-form-label text-right">Nama Kelas :</label>
                  <div class="col-sm-5">
                    <input id="hd_input_stock_invoice" name="hd_input_stock_invoice" type="text" class="form-control" value="">
                  </div>
                  <div class="col-md-4"></div>
                </div>

                <div class="form-group row">
                  <label for="noinvoice" class="col-sm-3 col-form-label text-right">Instruktur / PT:</label>
                  <div class="col-sm-5">
                    <input id="hd_input_stock_invoice" name="hd_input_stock_invoice" type="text" class="form-control" value="">
                  </div>
                  <div class="col-md-4"></div>
                </div>

                <div class="form-group row">
                  <label for="noinvoice" class="col-sm-3 col-form-label text-right">Jadwal:</label>
                  <div class="col-sm-5">
                    <input id="hd_input_stock_invoice" name="hd_input_stock_invoice" type="text" class="form-control" value="">
                  </div>
                  <div class="col-md-4"></div>
                </div>

                <div class="form-group row">
                  <label for="noinvoice" class="col-sm-3 col-form-label text-right">Paket Pertemuan:</label>
                  <div class="col-sm-5">
                    <input id="hd_input_stock_invoice" name="hd_input_stock_invoice" type="text" class="form-control" value="">
                  </div>
                  <div class="col-md-4"></div>
                </div>
              </div>
            </div>

            <div class="col-md-5"> 
              <div class="card-header">
                <div class="card-title" style="font-size: 17px; color: #1572e8!important;">Pembayaran</div>
              </div>
              <div class="card-body">
                <div class="form-group row">
                  <div class="col-md-4"></div>
                  <label for="noinvoice" class="col-sm-3 col-form-label text-right">Sub Total :</label>
                  <div class="col-sm-5">
                    <input id="hd_input_stock_invoice" name="hd_input_stock_invoice" type="text" class="form-control" value="" readonly>
                  </div>
                </div>

                <div class="form-group row">

                  <div class="col-md-4"></div>
                  <label for="noinvoice" class="col-sm-3 col-form-label text-right">Discount:</label>
                  <div class="col-sm-5">
                    <input id="hd_input_stock_invoice" name="hd_input_stock_invoice" type="text" class="form-control" value="">
                  </div>
                </div>

                <div class="form-group row">

                  <div class="col-md-4"></div>
                  <label for="noinvoice" class="col-sm-3 col-form-label text-right">PPN:</label>
                  <div class="col-sm-5">
                    <input id="hd_input_stock_invoice" name="hd_input_stock_invoice" type="text" class="form-control" value="">
                  </div>
                </div>

                <div class="form-group row">

                  <div class="col-md-4"></div>
                  <label for="noinvoice" class="col-sm-3 col-form-label text-right">Grand Total:</label>
                  <div class="col-sm-5">
                    <input id="hd_input_stock_invoice" name="hd_input_stock_invoice" type="text" class="form-control" value="">
                  </div>
                </div>

                <div class="form-group row">

                  <div class="col-md-4"></div>
                  <label for="noinvoice" class="col-sm-3 col-form-label text-right">Jenis Pembayaran:</label>
                  <div class="col-sm-5">
                    <input id="hd_input_stock_invoice" name="hd_input_stock_invoice" type="text" class="form-control" value="">
                  </div>
                </div>

              </div>
            </div>

          </div>

          <div class="card-action" style="text-align: right;">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Batal</button>
            <button type="submit" class="btn btn-primary" ><i class="fas fa-save"></i> Simpan</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php 
require DOC_ROOT_PATH . $this->config->item('footer');
?>

<script>



</script>