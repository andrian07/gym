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
              <!--
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
              -->
              <div class="col-md-4">
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
              <div class="col-md-4">
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
              <div class="col-md-4">

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
            <div class="col-md-8"> 
              <div class="card-header">
                <div class="card-title" style="font-size: 17px; color: #1572e8!important;">Data Kelas</div>
              </div>
              <div class="card-body">
                <div class="form-group row">
                  <label for="noinvoice" class="col-sm-3 col-form-label">Nama Kelas :</label>
                  <div class="col-sm-6">
                    <input id="hd_input_stock_invoice" name="hd_input_stock_invoice" type="text" class="form-control" value="">
                  </div>
                  <div class="col-md-3"></div>
                </div>

                <div class="form-group row">
                  <label for="noinvoice" class="col-sm-3 col-form-label">Instruktur / PT:</label>
                  <div class="col-sm-6">
                    <input id="hd_input_stock_invoice" name="hd_input_stock_invoice" type="text" class="form-control" value="">
                  </div>
                  <div class="col-md-3"></div>
                </div>

                <div class="form-group row">
                  <label for="noinvoice" class="col-sm-3 col-form-label">Paket:</label>
                  <div class="col-sm-6">
                    <input id="hd_input_stock_invoice" name="hd_input_stock_invoice" type="text" class="form-control" value="">
                  </div>
                  <div class="col-md-3"></div>
                </div>

                <div class="form-group row">
                  <label for="noinvoice" class="col-sm-3 col-form-label">Paket Pertemuan:</label>
                  <div class="col-sm-6">
                    <input id="hd_input_stock_invoice" name="hd_input_stock_invoice" type="text" class="form-control" value="">
                  </div>
                  <div class="col-md-3"></div>
                </div>
              </div>
            </div>
            <div class="col-md-4">
            </div>
          </div>


          <div class="row">
            <div class="col-md-12"> 
              <div class="card-header">
                <div class="card-title" style="font-size: 17px; color: #1572e8!important;">Physical Activity Readiness Questionnaire (PARQ)</div>
              </div>
              <div class="card-body">
                <div class="form-group row">
                  <label for="noinvoice" class="col-sm-9 col-form-label">1.) Apakah dokter Anda pernah mengatakan bahwa Anda memiliki kondisi jantung dan Anda hanya boleh melakukan aktivitas fisik yang direkomendasikan oleh dokter?</label>
                  <div class="col-sm-2">
                    <div class="d-flex">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                        <label class="form-check-label" for="flexRadioDefault1"> Ya </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                        <label class="form-check-label" for="flexRadioDefault2"> Tidak </label>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="noinvoice" class="col-sm-9 col-form-label">2.) Apakah Anda merasakan nyeri dada saat melakukan aktivitas fisik?</label>
                  <div class="col-sm-2">
                    <div class="d-flex">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                        <label class="form-check-label" for="flexRadioDefault1"> Ya </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                        <label class="form-check-label" for="flexRadioDefault2"> Tidak </label>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="noinvoice" class="col-sm-9 col-form-label">3.) Dalam sebulan terakhir, apakah Anda merasakan nyeri dada saat tidak melakukan aktivitas fisik apa pun ?</label>
                  <div class="col-sm-2">
                    <div class="d-flex">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                        <label class="form-check-label" for="flexRadioDefault1"> Ya </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                        <label class="form-check-label" for="flexRadioDefault2"> Tidak </label>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="noinvoice" class="col-sm-9 col-form-label">4.) Apakah Anda memiliki masalah tulang atau sendi yang dapat menjadi buruk diakibatkan aktivitas fisik Anda ?</label>
                  <div class="col-sm-2">
                    <div class="d-flex">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                        <label class="form-check-label" for="flexRadioDefault1"> Ya </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                        <label class="form-check-label" for="flexRadioDefault2"> Tidak </label>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="noinvoice" class="col-sm-9 col-form-label">5.) Apakah Anda saat ini mengkonsumsi obat untuk tekanan darah Anda atau untuk kondisi jantung Anda ?</label>
                  <div class="col-sm-2">
                    <div class="d-flex">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                        <label class="form-check-label" for="flexRadioDefault1"> Ya </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                        <label class="form-check-label" for="flexRadioDefault2"> Tidak </label>
                      </div>
                    </div>
                  </div>
                </div>


                <div class="form-group row">
                  <label for="noinvoice" class="col-sm-9 col-form-label">6.) Apakah Anda tahu alasan lain mengapa Anda tidak boleh melakukan aktivitas fisik ?</label>
                  <div class="col-sm-2">
                    <div class="d-flex">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                        <label class="form-check-label" for="flexRadioDefault1"> Ya </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                        <label class="form-check-label" for="flexRadioDefault2"> Tidak </label>
                      </div>
                    </div>
                  </div>
                </div>


                <div class="form-group row">
                  <p>*NB: Jika Anda menjawab "ya" untuk satu atau lebih pertanyaan di atas, <b><i>konsultasikan dengan dokter Anda sebelum melakukan aktivitas fisik</i></b>. Beri tahu dokter Anda pertanyaan mana yang Anda jawab "Ya". Setelah evaluasi medis, mintalah saran dari dokter Anda tentang jenis aktivitas yang sesuai dengan kondisi Anda saat ini.</p>
                </div>


              </div>
            </div>
          </div>


          <div class="row">
            <div class="col-md-12"> 
              <div class="card-header">
                <div class="card-title" style="font-size: 17px; color: #1572e8!important;">Client Readiness For Exercise</div>
              </div>
              <div class="card-body" style="padding-left: 3%;">
                <div class="form-group row">
                  <label for="noinvoice" class="col-sm-12 col-form-label" style="color:#E77D22 !important">Pekerjaan</label>
                </div>

                <div class="form-group row">
                  <label for="noinvoice" class="col-sm-9 col-form-label">1.) Apa pekerjaan anda sekarang ?</label>
                  <div class="col-md-9 p-0">
                    <input type="text" class="form-control input-full" name="member_code" id="member_code" style="margin-left: 2%; width: 80% !important;">
                  </div>
                </div>

                <div class="form-group row">
                  <label for="noinvoice" class="col-sm-9 col-form-label">2.) Apakah pekerjaan Anda membutuhkan waktu duduk yang lama ?</label>
                  <div class="col-sm-2">
                    <div class="d-flex">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                        <label class="form-check-label" for="flexRadioDefault1"> Ya </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                        <label class="form-check-label" for="flexRadioDefault2"> Tidak </label>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="noinvoice" class="col-sm-9 col-form-label">3.) Apakah pekerjaan Anda memerlukan gerakan berulang? Jika Ya, mohon di jelaskan ?</label>
                  <div class="col-sm-2">
                    <div class="d-flex">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                        <label class="form-check-label" for="flexRadioDefault1"> Ya </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                        <label class="form-check-label" for="flexRadioDefault2"> Tidak </label>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-9 p-0">
                    <input type="text" class="form-control input-full" name="member_code" id="member_code" style="margin-left: 2%; width: 80% !important;">
                  </div>

                </div>

                <div class="form-group row">
                  <label for="noinvoice" class="col-sm-9 col-form-label">4.) Apakah pekerjaan Anda mengharuskan Anda memakai sepatu berhak? (misalnya Sepatu Formal)</label>
                  <div class="col-sm-2">
                    <div class="d-flex">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                        <label class="form-check-label" for="flexRadioDefault1"> Ya </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                        <label class="form-check-label" for="flexRadioDefault2"> Tidak </label>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="noinvoice" class="col-sm-9 col-form-label">5.) Apakah pekerjaan Anda menyebabkan Anda stres mental ?</label>
                  <div class="col-sm-2">
                    <div class="d-flex">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                        <label class="form-check-label" for="flexRadioDefault1"> Ya </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                        <label class="form-check-label" for="flexRadioDefault2"> Tidak </label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="card-body" style="padding-left: 3%;">
                <div class="form-group row">
                  <label for="noinvoice" class="col-sm-12 col-form-label" style="color:#E77D22 !important">Rekreasional</label>
                </div>

                <div class="form-group row">
                  <label for="noinvoice" class="col-sm-9 col-form-label">1.) Apakah Anda melakukan aktivitas fisik rekreasi (golf, ski, dll.)? Jika ya, mohon dijelaskan.</label>
                  <div class="col-sm-2">
                    <div class="d-flex">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                        <label class="form-check-label" for="flexRadioDefault1"> Ya </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                        <label class="form-check-label" for="flexRadioDefault2"> Tidak </label>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-9 p-0">
                    <input type="text" class="form-control input-full" name="member_code" id="member_code" style="margin-left: 2%; width: 80% !important;">
                  </div>
                </div>

                <div class="form-group row">
                  <label for="noinvoice" class="col-sm-9 col-form-label">2.) Apakah Anda memiliki hobi tambahan (membaca, bermain video game, dll.)? (Jika ya, mohon dijelaskan)</label>
                  <div class="col-sm-2">
                    <div class="d-flex">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                        <label class="form-check-label" for="flexRadioDefault1"> Ya </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                        <label class="form-check-label" for="flexRadioDefault2"> Tidak </label>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-9 p-0">
                    <input type="text" class="form-control input-full" name="member_code" id="member_code" style="margin-left: 2%; width: 80% !important;">
                  </div>
                </div>
              </div>

              <div class="card-body" style="padding-left: 3%;">
                <div class="form-group row">
                  <label for="noinvoice" class="col-sm-12 col-form-label" style="color:#E77D22 !important">Medical</label>
                </div>

                <div class="form-group row">
                  <label for="noinvoice" class="col-sm-9 col-form-label">1.) Pernahkah Anda mengalami cedera atau nyeri kronis? (jika YA, mohon dijelaskan)</label>
                  <div class="col-sm-2">
                    <div class="d-flex">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                        <label class="form-check-label" for="flexRadioDefault1"> Ya </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                        <label class="form-check-label" for="flexRadioDefault2"> Tidak </label>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-9 p-0">
                    <input type="text" class="form-control input-full" name="member_code" id="member_code" style="margin-left: 2%; width: 80% !important;">
                  </div>
                </div>

                <div class="form-group row">
                  <label for="noinvoice" class="col-sm-9 col-form-label">2.) Pernahkah Anda menjalani operasi? (jika YA, mohon dijelaskan)</label>
                  <div class="col-sm-2">
                    <div class="d-flex">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                        <label class="form-check-label" for="flexRadioDefault1"> Ya </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                        <label class="form-check-label" for="flexRadioDefault2"> Tidak </label>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-9 p-0">
                    <input type="text" class="form-control input-full" name="member_code" id="member_code" style="margin-left: 2%; width: 80% !important;">
                  </div>
                </div>


                <div class="form-group row">
                  <label for="noinvoice" class="col-sm-9 col-form-label">
                    3.) Pernahkah dokter mendiagnosis Anda menderita penyakit kronis, seperti penyakit jantung, hipertensi, kolesterol tinggi, atau diabetes? (Jika YA, jelaskan)</label>
                  <div class="col-sm-2">
                    <div class="d-flex">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                        <label class="form-check-label" for="flexRadioDefault1"> Ya </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                        <label class="form-check-label" for="flexRadioDefault2"> Tidak </label>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-9 p-0">
                    <input type="text" class="form-control input-full" name="member_code" id="member_code" style="margin-left: 2%; width: 80% !important;">
                  </div>
                </div>


                <div class="form-group row">
                  <label for="noinvoice" class="col-sm-9 col-form-label">
                    4.) Apakah Anda sedang mengonsumsi obat apa pun? (Jika YA, mohon dijelaskan)</label>
                  <div class="col-sm-2">
                    <div class="d-flex">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                        <label class="form-check-label" for="flexRadioDefault1"> Ya </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                        <label class="form-check-label" for="flexRadioDefault2"> Tidak </label>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-9 p-0">
                    <input type="text" class="form-control input-full" name="member_code" id="member_code" style="margin-left: 2%; width: 80% !important;">
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