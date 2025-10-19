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
          <div class="row">
            <div class="col-md-3"> 
              <div class="card-header">
                <div class="card-title" style="font-size: 17px;color: #1572e8!important;">Pendaftaran</div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="card-body">
                    <div class="row"> 
                      <div class="col-md-12">

                        <div class="form-group form-inline">
                          <label for="inlineinput" class="col-md-3 col-form-label">Tipe Member:</label>
                          <div class="col-md-12 p-0">
                            <input type="hidden" class="form-control input-full" name="member_id" id="member_id" readonly>
                            <select class="form-control input-full js-example-basic-single" id="class_member_type" name="class_member_type">
                              <option value="">-- Pilih Tipe Member --</option>
                              <!-- <option value="Non Member / Harian (GYM)">Non Member / Harian (GYM)</option> -->
                              <option value="Kelas Only">Kelas Only</option>
                              <option value="Member">Member (GYM)</option>  
                              <option value="Member + Kelas">Member + Kelas</option> 
                            </select>
                          </div>
                        </div>

                        <div class="form-group form-inline">
                          <label for="inlineinput" class="col-md-3 col-form-label">Paket Promo:</label>
                          <div class="col-md-12 p-0">
                            <select class="form-control input-full js-example-basic-single" id="class_package_promo" name="class_package_promo">
                              <option value="">-- Pilih Paket --</option>
                              <?php foreach ($data['promo_list'] as $row) { ?>
                                <option value="<?php echo $row->ms_promo_id; ?>"><?php echo $row->ms_pormo_name; ?> ( Potongan <?php echo $row->ms_pormo_discount; ?> % )</option>  
                              <?php } ?>
                            </select>
                          </div>
                        </div>
                        <div class="form-group form-inline">
                          <label for="inlineinput" class="col-md-3 col-form-label">Personal Training:</label>
                          <div class="col-md-12 p-0">
                            <select class="form-control input-full js-example-basic-single" id="pt_package" name="pt_package">
                              <option value="">-- Personal Training --</option>
                              <option value="Ya">Ya</option>
                              <option value="Tidak">Tidak</option>
                            </select>
                          </div>
                        </div>

                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-3"> 
              <div class="card-header">
                <div class="card-title" style="font-size: 17px;color: #1572e8!important;">Periode</div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="card-body">
                    <div class="row">   

                      <div class="form-group form-inline">
                        <div class="row">
                          <div class="col-md-12">
                            <label for="inlineinput" class="col-md-3 col-form-label">Total Bulan:</label>
                            <div class="col-md-12 p-0">
                              <select class="form-control input-full js-example-basic-single" id="total_member_month" name="total_member_month">
                                <option value="">-- Total Bulan --</option>
                                <option value="3">3 Bulan</option>
                                <option value="6">6 Bulan</option>
                                <option value="12">12 Bulan</option>
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="form-group form-inline">
                        <div class="row">
                          <div class="col-md-12">
                            <label for="inlineinput" class="col-md-3 col-form-label">Periode Mulai:</label>
                            <div class="col-md-12 p-0">
                              <input type="date" class="form-control input-full" name="class_sessions_start" id="class_sessions_start" value="<?php echo date('Y-m-d');?>">
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="form-group form-inline">
                        <div class="row">
                          <div class="col-md-12">
                            <label for="inlineinput" class="col-md-3 col-form-label">Periode Akhir:</label>
                            <div class="col-md-12 p-0">
                              <input type="date" class="form-control input-full" name="class_sessions_end" id="class_sessions_end" value="2027-01-01" readonly>
                            </div>
                          </div>
                        </div>
                      </div>

                      
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-3" style="border-left: 1px solid #ebecec !important;"> 
              <div class="card-header">
                <div class="card-title" style="font-size: 17px;color: #1572e8!important;">Kelas</div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="card-body">
                    <div class="row"> 
                      <div class="col-md-12">

                        <div class="form-group form-inline">
                          <label for="inlineinput" class="col-md-3 col-form-label">Kelas:</label>
                          <div class="col-md-12 p-0">
                            <select class="form-control input-full js-example-basic-single" id="class_package" name="class_package">
                              <option value="">-- Pilih Kelas --</option>
                              <?php foreach ($data['class_list'] as $row) { ?>
                                <option value="<?php echo $row->class_id; ?>"><?php echo $row->class_name; ?></option>  
                              <?php } ?>
                            </select>
                          </div>
                        </div>

                        <div class="form-group form-inline">
                          <div class="row">
                            <div class="col-md-12">
                              <label for="inlineinput" class="col-md-3 col-form-label">Jumlah Bulan:</label>
                              <div class="col-md-12 p-0">
                                <select class="form-control input-full" id="class_session_unit" name="class_session_unit">
                                  <option value="">-- Pilih Bulan --</option>
                                  <option value="3">3 Bulan</option>
                                  <option value="6">6 Bulan</option>
                                  <option value="12">12 Bulan</option>
                                </select>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="form-group form-inline">
                          <label for="inlineinput" class="col-md-3 col-form-label">Total Kelas:</label>
                          <div class="col-md-12 p-0">
                            <input type="text" class="form-control input-full" name="class_total" id="class_total" placeholder="Harga" value="0" readonly>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-3"> 
              <div class="card-header">
                <div class="card-title" style="font-size: 17px;color: #1572e8!important;">Personal Training</div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="card-body">
                    <div class="row"> 
                      <div class="col-md-12">

                        <div class="form-group form-inline">
                          <label for="inlineinput" class="col-md-3 col-form-label">Nama Personal Training:</label>
                          <div class="col-md-12 p-0">
                            <select class="form-control input-full js-example-basic-single" id="PT" name="PT">
                              <option value="">-- Pilih Instruktur --</option>
                              <?php foreach ($data['coach_list'] as $row) { ?>
                                <option value="<?php echo $row->coach_id; ?>"><?php echo $row->coach_name; ?></option>  
                              <?php } ?>
                            </select>
                          </div>
                        </div>

                        <div class="form-group form-inline">
                          <label for="inlineinput" class="col-md-3 col-form-label">Harga Sesi/Bulan/Tahun:</label>
                          <div class="col-md-12 p-0">
                            <input type="text" class="form-control input-full" name="class_price" id="class_price" placeholder="Harga" value="0">
                          </div>
                        </div>

                        <div class="form-group form-inline">
                          <div class="row">
                            <div class="col-md-6">
                              <label for="inlineinput" class="col-md-3 col-form-label">Jumlah Sesi:</label>
                              <div class="col-md-12 p-0">
                                <select class="form-control input-full" id="pt_session_unit" name="pt_session_unit">
                                  <option value="">-- Pilih Sesi --</option>
                                  <option value="8">8 Sesi</option>
                                  <option value="12">12 Sesi</option>
                                  <option value="24">24 Sesi</option>
                                </select>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <label for="inlineinput" class="col-md-3 col-form-label">Sesi:</label>
                              <div class="col-md-12 p-0">
                                <select class="form-control input-full" id="class_session_unit" name="class_session_unit">
                                  <option value="Sesi">Sesi</option>
                                </select>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="form-group form-inline">
                          <label for="inlineinput" class="col-md-3 col-form-label">Total Personal Training:</label>
                          <div class="col-md-12 p-0">
                            <input type="text" class="form-control input-full" name="pt_total" id="pt_total" placeholder="Harga" value="0" readonly>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>



          </div>
          <!--
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
                  <label for="noinvoice" class="col-sm-9   col-form-label">
                  3.) Pernahkah dokter mendiagnosis Anda menderita penyakit kronis, seperti penyakit jantung, <br />hipertensi, kolesterol tinggi, atau diabetes? (Jika YA, jelaskan)</label>
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
          -->
          <div class="card-action" style="text-align: right;">
            <div class="row"> 
              <div class="form-group form-inline" style="margin-top:35px;">
                <div class ="row">
                  <div class="col-md-4"></div>
                  <div class="col-md-4"><label for="inlineinput" class="col-md-12 col-form-label text-right">Diskon:</label></div>
                  <div class="col-md-4">
                    <div class="col-md-12 p-0">
                      <input type="text" class="form-control input-full" name="discount" id="discount" value="0" readonly>
                    </div>
                  </div>
                </div>
              </div>

              <div class="form-group form-inline" style="margin-top:3px;">
                <div class ="row">
                  <div class="col-md-4"></div>
                  <div class="col-md-4"><label for="inlineinput" class="col-md-12 col-form-label text-right">Total:</label></div>
                  <div class="col-md-4">
                    <div class="col-md-12 p-0">
                      <input type="text" class="form-control input-full" name="total" id="total" value="0" readonly>
                    </div>
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
      </div>
    </div>
  </div>
</div>

<?php 
require DOC_ROOT_PATH . $this->config->item('footer');
?>

<script>

  $(document ).ready(function() {
    $('#pt_package').prop('disabled', true);
    $('#class_package').prop('disabled', true);
    $('#PT').prop('disabled', true);
    $('#class_price').prop('disabled', true);
    $('#class_session_unit').prop('disabled', true);
    $('#pt_session_unit').prop('disabled', true);
  });

  let class_price = new AutoNumeric('#class_price', {
    currencySymbol : 'Rp. ',
    decimalCharacter : ',',
    decimalPlaces: 0,
    decimalPlacesShownOnFocus: 0,
    digitGroupSeparator : '.',
  });


  let class_total = new AutoNumeric('#class_total', {
    currencySymbol : 'Rp. ',
    decimalCharacter : ',',
    decimalPlaces: 0,
    decimalPlacesShownOnFocus: 0,
    digitGroupSeparator : '.',
  });

  let pt_total = new AutoNumeric('#pt_total', {
    currencySymbol : 'Rp. ',
    decimalCharacter : ',',
    decimalPlaces: 0,
    decimalPlacesShownOnFocus: 0,
    digitGroupSeparator : '.',
  });

  let discount = new AutoNumeric('#discount', {
    currencySymbol : 'Rp. ',
    decimalCharacter : ',',
    decimalPlaces: 0,
    decimalPlacesShownOnFocus: 0,
    digitGroupSeparator : '.',
  });

  let total = new AutoNumeric('#total', {
    currencySymbol : 'Rp. ',
    decimalCharacter : ',',
    decimalPlaces: 0,
    decimalPlacesShownOnFocus: 0,
    digitGroupSeparator : '.',
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


  
  $('#class_member_type').on('change', function() {
    if(this.value == 'Member'){
      $('#pt_package').prop('disabled', false);
      $('#class_package').prop('disabled', true);
      $('#class_session_unit').prop('disabled', true);
      $("#class_package").val("");
      $('#class_package').trigger('change');
      $("#class_session_unit").val("");
      $('#class_session_unit').trigger('change');
    }else if(this.value == 'Member + Kelas'){
      $('#pt_package').prop('disabled', false);
      $('#class_package').prop('disabled', false);
      $('#class_session_unit').prop('disabled', false);
    }else if(this.value == 'Kelas Only'){
      $('#class_package').prop('disabled', false);
      $('#class_session_unit').prop('disabled', false);
    }else{
      $("#pt_package").val("");
      $('#pt_package').trigger('change');
      $('#pt_package').prop('disabled', true);
    }
  });

  $('#pt_package').on('change', function() {
      if(this.value == 'Ya'){
        $('#PT').prop('disabled', false);
        $('#class_price').prop('disabled', false);
        $('#pt_session_unit').prop('disabled', false);
      }else{
        $('#PT').prop('disabled', true);
        $('#PT').val("");
        $('#PT').trigger('change');
        $('#class_price').prop('disabled', true);
        class_price.set(0);
        $('#pt_session_unit').prop('disabled', true);
        $('#pt_session_unit').val("");
        $('#pt_session_unit').trigger('change');
      }
  });

  $('#class_package_promo').on('change', function() {
    var id = this.value;
    $.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>register/get_promo_info",
      dataType: "json",
      data: {id:id},
      success : function(data){
        if (data.code == "200"){
          let data = data.result.get_promo_info[0];
          if(data.ms_promo_category == 'GYM'){

          }
        } else {
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Data Tidak Di Temukan',
          })
        }
      }
    });
  });

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
    /*var crfe_w_1                  = $("#crfe_w_1").val();
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
    var crfe_m_4_desc             = $("#crfe_m_4_desc").val();*/

    $.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>register/save_register",
      dataType: "json",
      data: {member_name:member_name, member_phone:member_phone, member_nik:member_nik, member_dob:member_dob, member_email:member_email, member_address:member_address, member_gender:member_gender, member_urgent_phone:member_urgent_phone, member_nik:member_nik,member_urgent_name:member_urgent_name, member_urgent_sibiling:member_urgent_sibiling, member_desc:member_desc, parq_q1:parq_q1, parq_q2:parq_q2, parq_q3:parq_q3, parq_q4:parq_q4, parq_q5:parq_q5, parq_q6:parq_q6},
      success : function(data){
        if (data.code == "200"){
          let title = 'Tambah Data';
          let message = 'Data Berhasil Di Tambah';
          let state = 'info';
          notif_success(title, message, state);
          $("#member_id").val(data.member);
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


  $('#btn_save_class').click(function(e){
    e.preventDefault();
    var member_id             = $("#member_id").val();
    var class_package         = $("#class_package").val();
    var class_price_val       = class_price.get();
    var class_session_val     = class_session.get();
    var class_session_unit    = $("#class_session_unit").val();
    var class_total_val       = class_total.get();
    var PT                    = $("#PT").val();
    var class_sessions_start  = $("#class_sessions_start").val();
    var class_sessions_end    = $("#class_sessions_end").val();
    var class_package_promo   = $("#class_package_promo").val();
    var discount_val          = discount.get();
    var total_val             = total.get();

    $.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>register/save_transaction",
      dataType: "json",
      data: {member_id:member_id, class_package:class_package, class_price_val:class_price_val, class_session_val:class_session_val, class_session_unit:class_session_unit, class_total_val:class_total_val, PT:PT, class_sessions_start:class_sessions_start, class_sessions_end:class_sessions_end, class_package_promo:class_package_promo, discount_val:discount_val, total_val:total_val},
      success : function(data){
        if (data.code == "200"){
          let title = 'Tambah Data';
          let message = 'Data Berhasil Di Tambah';
          let state = 'info';
          notif_success(title, message, state);
          window.location.href = "<?php echo base_url(); ?>/Register/1";
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