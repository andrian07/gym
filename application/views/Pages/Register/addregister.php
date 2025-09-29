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
        <div class="card" id="step1">
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
                  <label for="inlineinput" class="col-md-3 col-form-label">Nama Kontak Darurat</label>
                  <div class="col-md-12 p-0">
                    <input type="text" class="form-control input-full" name="member_urgent_name" id="member_urgent_name" placeholder="Nama Kontak Darurat">
                  </div>
                </div>

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
                        <input class="form-check-input" type="radio" name="parq_q1" id="parq_q1_y" value="Y">
                        <label class="form-check-label" for="flexRadioDefault1"> Ya </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="parq_q1" id="parq_q1_n" value="N">
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
                        <input class="form-check-input" type="radio" name="parq_q2" id="parq_q2_y" value="Y">
                        <label class="form-check-label" for="flexRadioDefault1"> Ya </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="parq_q2" id="parq_q2_n" value="N">
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
                        <input class="form-check-input" type="radio" name="parq_q3" id="parq_q3_y" value="Y">
                        <label class="form-check-label" for="flexRadioDefault1"> Ya </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="parq_q3" id="parq_q3_n" value="N">
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
                        <input class="form-check-input" type="radio" name="parq_q4" id="parq_q4_y" value="Y">
                        <label class="form-check-label" for="flexRadioDefault1"> Ya </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="parq_q4" id="parq_q5_n" value="N">
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
                        <input class="form-check-input" type="radio" name="parq_q5" id="parq_q5_y" value="Y">
                        <label class="form-check-label" for="flexRadioDefault1"> Ya </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="parq_q5" id="parq_q5_n" value="N">
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
                        <input class="form-check-input" type="radio" name="parq_q6" id="parq_q6_y" value="Y">
                        <label class="form-check-label" for="flexRadioDefault1"> Ya </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="parq_q6" id="parq_q6_n" value="N">
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
                    <input type="text" class="form-control input-full" name="crfe_w_1" id="crfe_w_1" style="margin-left: 2%; width: 80% !important;">
                  </div>
                </div>

                <div class="form-group row">
                  <label for="noinvoice" class="col-sm-9 col-form-label">2.) Apakah pekerjaan Anda membutuhkan waktu duduk yang lama ?</label>
                  <div class="col-sm-2">
                    <div class="d-flex">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="crfe_w_2" id="crfe_w_2_y" value="Y">
                        <label class="form-check-label" for="flexRadioDefault1"> Ya </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="crfe_w_2" id="crfe_w_2_n" value="N">
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
                        <input class="form-check-input" type="radio" name="crfe_w_3" id="crfe_w_3_y" value="Y" onchange="crfe_w_3_change(this)">
                        <label class="form-check-label" for="flexRadioDefault1"> Ya </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="crfe_w_3" id="crfe_w_3_n" value="N" onchange="crfe_w_3_change(this)">
                        <label class="form-check-label" for="flexRadioDefault2"> Tidak </label>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-9 p-0">
                    <input type="text" class="form-control input-full" name="crfe_w_3_desc" id="crfe_w_3_desc" style="margin-left: 2%; width: 80% !important;" readonly>
                  </div>

                </div>

                <div class="form-group row">
                  <label for="noinvoice" class="col-sm-9 col-form-label">4.) Apakah pekerjaan Anda mengharuskan Anda memakai sepatu berhak? (misalnya Sepatu Formal)</label>
                  <div class="col-sm-2">
                    <div class="d-flex">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="crfe_w_4" id="crfe_w_4_y" value="Y">
                        <label class="form-check-label" for="flexRadioDefault1"> Ya </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="crfe_w_4" id="crfe_w_4_n" value="N">
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
                        <input class="form-check-input" type="radio" name="crfe_w_5" id="crfe_w_5_y" value="Y">
                        <label class="form-check-label" for="flexRadioDefault1"> Ya </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="crfe_w_5" id="crfe_w_5_n" value="N">
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
                        <input class="form-check-input" type="radio" name="crfe_r_1" id="crfe_r_1_y" value="Y" onchange="crfe_r_1_change(this)">
                        <label class="form-check-label" for="flexRadioDefault1"> Ya </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="crfe_r_1" id="crfe_r_N" value="N" onchange="crfe_r_1_change(this)">
                        <label class="form-check-label" for="flexRadioDefault2"> Tidak </label>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-9 p-0">
                    <input type="text" class="form-control input-full" name="crfe_r_1_desc" id="crfe_r_1_desc" style="margin-left: 2%; width: 80% !important;" readonly>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="noinvoice" class="col-sm-9 col-form-label">2.) Apakah Anda memiliki hobi tambahan (membaca, bermain video game, dll.)? (Jika ya, mohon dijelaskan)</label>
                  <div class="col-sm-2">
                    <div class="d-flex">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="crfe_r_2" id="crfe_r_2_y" value="Y" onchange="crfe_r_2_change(this)">
                        <label class="form-check-label" for="flexRadioDefault1"> Ya </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="crfe_r_2" id="crfe_r_2_n" value="N" onchange="crfe_r_2_change(this)">
                        <label class="form-check-label" for="flexRadioDefault2"> Tidak </label>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-9 p-0">
                    <input type="text" class="form-control input-full" name="crfe_r_2_desc" id="crfe_r_2_desc" style="margin-left: 2%; width: 80% !important;" readonly>
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
                        <input class="form-check-input" type="radio" name="crfe_m_1" id="crfe_m_1_y" value="Y" onchange="crfe_m_1_change(this)">
                        <label class="form-check-label" for="flexRadioDefault1"> Ya </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="crfe_m_1" id="crfe_m_1_n" value="N" onchange="crfe_m_1_change(this)">
                        <label class="form-check-label" for="flexRadioDefault2"> Tidak </label>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-9 p-0">
                    <input type="text" class="form-control input-full" name="crfe_m_1_desc" id="crfe_m_1_desc" style="margin-left: 2%; width: 80% !important;" readonly>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="noinvoice" class="col-sm-9 col-form-label">2.) Pernahkah Anda menjalani operasi? (jika YA, mohon dijelaskan)</label>
                  <div class="col-sm-2">
                    <div class="d-flex">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="crfe_m_2" id="crfe_m_2_y" value="Y" onchange="crfe_m_2_change(this)">
                        <label class="form-check-label" for="flexRadioDefault1"> Ya </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="crfe_m_2" id="crfe_m_2_n" value="N" onchange="crfe_m_2_change(this)">
                        <label class="form-check-label" for="flexRadioDefault2"> Tidak </label>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-9 p-0">
                    <input type="text" class="form-control input-full" name="crfe_m_2_desc" id="crfe_m_2_desc" style="margin-left: 2%; width: 80% !important;" readonly>
                  </div>
                </div>


                <div class="form-group row">
                  <label for="noinvoice" class="col-sm-9 col-form-label">
                  3.) Pernahkah dokter mendiagnosis Anda menderita penyakit kronis, seperti penyakit jantung, hipertensi, kolesterol tinggi, atau diabetes? (Jika YA, jelaskan)</label>
                  <div class="col-sm-2">
                    <div class="d-flex">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="crfe_m_3" id="crfe_m_2_y" value="Y" onchange="crfe_m_3_change(this)">
                        <label class="form-check-label" for="flexRadioDefault1"> Ya </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="crfe_m_3" id="crfe_m_3_n" value="N" onchange="crfe_m_3_change(this)">
                        <label class="form-check-label" for="flexRadioDefault2"> Tidak </label>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-9 p-0">
                    <input type="text" class="form-control input-full" name="crfe_m_3_desc" id="crfe_m_3_desc" style="margin-left: 2%; width: 80% !important;" readonly>
                  </div>
                </div>


                <div class="form-group row">
                  <label for="noinvoice" class="col-sm-9 col-form-label">
                  4.) Apakah Anda sedang mengonsumsi obat apa pun? (Jika YA, mohon dijelaskan)</label>
                  <div class="col-sm-2">
                    <div class="d-flex">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="crfe_m_4" id="crfe_m_4_y" value="Y" onchange="crfe_m_4_change(this)">
                        <label class="form-check-label" for="flexRadioDefault1"> Ya </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="crfe_m_4" id="crfe_m_4_n" value="N" onchange="crfe_m_4_change(this)">
                        <label class="form-check-label" for="flexRadioDefault2"> Tidak </label>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-9 p-0">
                    <input type="text" class="form-control input-full" name="crfe_m_4_desc" id="crfe_m_4_desc" style="margin-left: 2%; width: 80% !important;" readonly>
                  </div>
                </div>


              </div>

            </div>
          </div>

          <div class="card-action" style="text-align: right;">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Batal</button>
            <button id="btn_save" class="btn btn-primary" ><i class="fas fa-save"></i> Simpan</button>
          </div>
        </div>

        <div class="card" id="step2">
          <div class="row">
            <div class="col-md-6">
              <div class="card-header">
                <div class="card-title" style="font-size: 17px;color: #1572e8!important;">Register Kelas</div>
              </div>
              <div class="card-body">
                <div class="row"> 
                  <div class="col-md-12">
                    <div class="form-group form-inline">
                      <label for="inlineinput" class="col-md-3 col-form-label">Kelas:</label>
                      <div class="col-md-12 p-0">
                        <input type="text" class="form-control input-full" name="class_package" id="class_package" placeholder="Kelas">
                      </div>
                    </div>

                    <div class="form-group form-inline">
                      <label for="inlineinput" class="col-md-3 col-form-label">Harga:</label>
                      <div class="col-md-12 p-0">
                        <input type="text" class="form-control input-full" name="class_price" id="class_price" placeholder="Harga">
                      </div>
                    </div>

                    <div class="form-group form-inline">
                      <label for="inlineinput" class="col-md-3 col-form-label">Paket Promo:</label>
                      <div class="col-md-12 p-0">
                        <input type="text" class="form-control input-full" name="class_price" id="class_price" placeholder="Harga">
                      </div>
                    </div>

                    <div class="form-group form-inline">
                      <label for="inlineinput" class="col-md-3 col-form-label">Paket Promo:</label>
                      <div class="col-md-12 p-0">
                        <input type="text" class="form-control input-full" name="class_price" id="class_price" placeholder="Harga">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="card-header">
                <div class="card-title" style="font-size: 17px;color: #1572e8!important;">Personal Trainer</div>
              </div>
              <div class="card-body">
                <div class="row"> 
                  <div class="col-md-12">
                    <div class="form-group form-inline">
                      <label for="inlineinput" class="col-md-3 col-form-label">Nama Personal Traine:</label>
                      <div class="col-md-12 p-0">
                        <input type="text" class="form-control input-full" name="class_package" id="class_package" placeholder="Kelas">
                      </div>
                    </div>

                    <div class="form-group form-inline">
                      <label for="inlineinput" class="col-md-3 col-form-label">Harga / Pertemuan:</label>
                      <div class="col-md-12 p-0">
                        <input type="text" class="form-control input-full" name="class_price" id="class_price" placeholder="Harga">
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-12">
              <div class="card-header">

              </div>
              <div class="card-body">
                <div class="row"> 
                  <div class="col-md-6"></div>
                  <div class="col-md-6">
                    <div class="form-group form-inline">
                      <div class ="row">
                        <div class="col-md-6"><label for="inlineinput" class="col-md-12 col-form-label text-right">Sub Total:</label></div>
                        <div class="col-md-6">
                          <div class="col-md-12 p-0">
                            <input type="text" class="form-control input-full" name="class_package" id="class_package" placeholder="Kelas">
                          </div>
                        </div>
                      </div>

                      
                    </div>

                  </div>
                </div>
              </div>
            </div>

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


  $(document ).ready(function() {
    //$('#step2').hide();
  });


  function crfe_w_3_change(radio) {
    if(radio.value == 'Y'){
      $('#crfe_w_3_desc').prop('readonly', false);
    }else{
      $('#crfe_w_3_desc').prop('readonly', true);
    }
  }

  function crfe_r_1_change(radio) {
    if(radio.value == 'Y'){
      $('#crfe_r_1_desc').prop('readonly', false);
    }else{
      $('#crfe_r_1_desc').prop('readonly', true);
    }
  }

  function crfe_r_2_change(radio) {
    if(radio.value == 'Y'){
      $('#crfe_r_2_desc').prop('readonly', false);
    }else{
      $('#crfe_r_2_desc').prop('readonly', true);
    }
  }


  function crfe_m_1_change(radio) {
    if(radio.value == 'Y'){
      $('#crfe_m_1_desc').prop('readonly', false);
    }else{
      $('#crfe_m_1_desc').prop('readonly', true);
    }
  }

  function crfe_m_2_change(radio) {
    if(radio.value == 'Y'){
      $('#crfe_m_2_desc').prop('readonly', false);
    }else{
      $('#crfe_m_2_desc').prop('readonly', true);
    }
  }

  function crfe_m_3_change(radio) {
    if(radio.value == 'Y'){
      $('#crfe_m_3_desc').prop('readonly', false);
    }else{
      $('#crfe_m_3_desc').prop('readonly', true);
    }
  }

  function crfe_m_4_change(radio) {
    if(radio.value == 'Y'){
      $('#crfe_m_4_desc').prop('readonly', false);
    }else{
      $('#crfe_m_4_desc').prop('readonly', true);
    }
  }






  $('#btn_save').click(function(e){
    e.preventDefault();
    var member_name               = $("#member_name").val();
    var member_phone              = $("#member_phone").val();
    var member_nik                = $("#member_nik").val();
    var member_dob                = $("#member_dob").val();
    var member_email              = $("#member_email").val();
    var member_address            = $("#member_address").val();
    var member_gender             = $("#member_gender").val();
    var member_urgent_phone       = $("#member_urgent_phone").val();
    var member_nik                = $("#member_nik").val();
    var member_urgent_name        = $("#member_urgent_name").val();
    var member_urgent_sibiling    = $("#member_urgent_sibiling").val();
    var member_urgent_name        = $("#member_urgent_name").val();
    var member_desc               = $("#member_desc").val();
    var parq_q1                   = $('input[name="parq_q1"]:checked').val();
    var parq_q2                   = $('input[name="parq_q2"]:checked').val();
    var parq_q3                   = $('input[name="parq_q3"]:checked').val();
    var parq_q4                   = $('input[name="parq_q4"]:checked').val();
    var parq_q5                   = $('input[name="parq_q5"]:checked').val();
    var parq_q6                   = $('input[name="parq_q6"]:checked').val();
    var crfe_w_1                  = $("#crfe_w_1").val();
    var crfe_w_2                  = $('input[name="crfe_w_2"]:checked').val();
    var crfe_w_3                  = $('input[name="crfe_w_3"]:checked').val();
    var crfe_w_3_desc             = $("#crfe_w_3").val();
    var crfe_w_4                  = $('input[name="crfe_w_4"]:checked').val();
    var crfe_w_5                  = $('input[name="crfe_w_5"]:checked').val();
    var crfe_r_1                  = $('input[name="crfe_r_1"]:checked').val();
    var crfe_r_1_desc             = $("#crfe_r_1_desc").val();
    var crfe_r_2                  = $('input[name="crfe_r_2"]:checked').val();
    var crfe_r_2_desc             = $("#crfe_r_2_desc").val();
    var crfe_m_1                  = $('input[name="crfe_m_1"]:checked').val();
    var crfe_m_1_desc             = $("#crfe_m_1_desc").val();
    var crfe_m_2                  = $('input[name="crfe_m_2"]:checked').val();
    var crfe_m_2_desc             = $("#crfe_m_2_desc").val();
    var crfe_m_3                  = $('input[name="crfe_m_3"]:checked').val();
    var crfe_m_3_desc             = $("#crfe_m_3_desc").val();
    var crfe_m_4                  = $('input[name="crfe_m_4"]:checked').val();
    var crfe_m_4_desc             = $("#crfe_m_4_desc").val();

    $.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>register/save_register",
      dataType: "json",
      data: {member_name:member_name, member_phone:member_phone, member_nik:member_nik, member_dob:member_dob, member_email:member_email, member_address:member_address, member_gender:member_gender, member_urgent_phone:member_urgent_phone, member_nik:member_nik,member_urgent_name:member_urgent_name, member_urgent_sibiling:member_urgent_sibiling, member_desc:member_desc, parq_q1:parq_q1, parq_q2:parq_q2, parq_q3:parq_q3, parq_q4:parq_q4, parq_q5:parq_q5, parq_q6:parq_q6, crfe_w_1:crfe_w_1, crfe_w_2:crfe_w_2, crfe_w_3:crfe_w_3, crfe_w_3_desc:crfe_w_3_desc, crfe_w_4:crfe_w_4, crfe_w_5:crfe_w_5, crfe_r_1:crfe_r_1, crfe_r_1_desc:crfe_r_1_desc, crfe_r_2:crfe_r_2, crfe_r_2_desc:crfe_r_2_desc, crfe_m_1:crfe_m_1, crfe_m_1_desc:crfe_m_1_desc, crfe_m_2:crfe_m_2, crfe_m_2_desc:crfe_m_2_desc, crfe_m_3:crfe_m_3, crfe_m_3_desc:crfe_m_3_desc, crfe_m_4:crfe_m_4, crfe_m_4_desc:crfe_m_4_desc},
      success : function(data){
        if (data.code == "200"){
          let title = 'Tambah Data';
          let message = 'Data Berhasil Di Tambah';
          let state = 'info';
          notif_success(title, message, state);
          $('#step1').hide();
          $('#step2').slideUp();
        } else {
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: data.result,
          })
        }
      }
    });
  });

</script>