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
            <div class="col-md-3" style="border-right: 1px solid #ebecec !important;"> 
              <div class="card-header">
                <div class="card-title" style="font-size: 17px;color: #1572e8!important;">Pendaftaran</div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="card-body">
                    <div class="row"> 
                      <div class="col-md-12">


                        <div class="form-group form-inline">
                          <label for="inlineinput" class="col-md-3 col-form-label">Nama:</label>
                          <div class="col-md-12 p-0">
                            <input type="hidden" class="form-control input-full" name="member_id" id="member_id" value="<?php echo $_GET['id']; ?>" readonly>
                            <input type="text" class="form-control input-full" name="member_name" id="member_name" readonly>
                          </div>
                        </div>

                        <div class="form-group form-inline">
                          <label for="inlineinput" class="col-md-3 col-form-label">No Telepon:</label>
                          <div class="col-md-12 p-0">
                            <input type="text" class="form-control input-full" name="member_phone" id="member_phone" readonly>
                          </div>
                        </div>

                        <div class="form-group form-inline">
                          <label for="inlineinput" class="col-md-3 col-form-label">Tipe Member:</label>
                          <div class="col-md-12 p-0">
                            <select class="form-control input-full js-example-basic-single" id="class_member_type" name="class_member_type">
                              <option value="">-- Pilih Tipe Member --</option>
                              <!-- <option value="Non Member / Harian (GYM)">Non Member / Harian (GYM)</option> -->
                              <option value="Kelas Only">Kelas Only</option>
                              <option value="Member">Member (GYM)</option>  
                              <option value="Member (GYM) + Kelas">Member (GYM) + Kelas</option> 
                            </select>
                          </div>
                        </div>

                        <div class="form-group form-inline">
                          <label for="inlineinput" class="col-md-3 col-form-label">Paket Promo:</label>
                          <div class="col-md-12 p-0">
                            <select class="form-control input-full js-example-basic-single" id="class_package_promo" name="class_package_promo">
                              <option value="">-- Pilih Paket --</option>
                              <?php foreach ($data['promo_list'] as $row) { ?>
                                <option value="<?php echo $row->ms_promo_id; ?>"><?php echo $row->ms_pormo_name; ?></option>  
                              <?php } ?>
                            </select>
                          </div>
                        </div>


                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>



            <div class="col-md-3" id="membergymdiv"> 
              <div class="card-header">
                <div class="card-title" style="font-size: 17px;color: #1572e8!important;">Member GYM</div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="card-body">
                    <div class="row">   
                      <div class="form-group form-inline">
                        <div class="row">
                          <div class="col-md-12">
                            <label for="inlineinput" class="col-md-3 col-form-label">Periode Mulai:</label>
                            <div class="col-md-12 p-0">
                              <input type="date" class="form-control input-full" name="gym_sessions_start" id="gym_sessions_start" value="<?php echo date('Y-m-d');?>">
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="form-group form-inline">
                        <div class="row">
                          <div class="col-md-12">
                            <label for="inlineinput" class="col-md-3 col-form-label">Paket Gym:</label>
                            <div class="col-md-12 p-0">
                              <select class="form-control input-full js-example-basic-single" id="total_member_month" name="total_member_month">
                                <option value="">-- Pilih Paket GYM --</option>
                                <?php foreach ($data['gym_package'] as $row) { ?>
                                  <option value="<?php echo $row->ms_gym_package_id ; ?>"><?php echo $row->ms_gym_package_name; ?></option>  
                                <?php } ?>
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="form-group form-inline">
                        <div class="row">
                          <div class="col-md-12">
                            <label for="inlineinput" class="col-md-3 col-form-label">Periode Akhir:</label>
                            <div class="col-md-12 p-0">
                              <input type="date" class="form-control input-full" name="gym_sessions_end" id="gym_sessions_end" value="2027-01-01" readonly>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="form-group form-inline">
                        <div class="row">
                          <div class="col-md-12">
                            <label for="inlineinput" class="col-md-3 col-form-label">Harga Perbulan:</label>
                            <div class="col-md-12 p-0">
                              <input type="text" class="form-control input-full" name="gym_price" id="gym_price" placeholder="Harga" value="0">
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="form-group form-inline">
                        <div class="row">
                          <div class="col-md-12">
                            <label for="inlineinput" class="col-md-3 col-form-label">Diskon:</label>
                            <div class="col-md-12 p-0">
                              <input type="text" class="form-control input-full" name="discount_class" id="discount_class" value="0" readonly>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="form-group form-inline">
                        <div class="row">
                          <div class="col-md-12">
                            <label for="inlineinput" class="col-md-3 col-form-label">Total:</label>
                            <div class="col-md-12 p-0">
                              <input type="text" class="form-control input-full" name="gym_total" id="gym_total" value="0" readonly>
                            </div>
                          </div>
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

            <div class="col-md-3" id="kelasdiv"> 
              <div class="card-header">
                <div class="card-title" style="font-size: 17px;color: #1572e8!important;">Kelas</div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="card-body">
                    <div class="row"> 
                      <div class="col-md-12">

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
                        <label for="inlineinput" class="col-md-3 col-form-label">Kelas:</label>
                        <div class="col-md-12 p-0">
                          <select class="form-control input-full js-example-basic-single" id="class_package" name="class_package">
                            <option value="">-- Pilih Kelas --</option>
                            <option value="All">Semua</option>
                            <?php foreach ($data['class_list'] as $row) { ?>
                              <option value="<?php echo $row->class_id; ?>"><?php echo $row->class_name; ?></option>  
                            <?php } ?>
                          </select>
                        </div>
                      </div>  

                      <div class="form-group form-inline">
                        <label for="inlineinput" class="col-md-3 col-form-label">Harga Kelas:</label>
                        <div class="col-md-12 p-0">
                          <input type="text" class="form-control input-full" name="class_price" id="class_price" placeholder="Harga" value="0">
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
                        <label for="inlineinput" class="col-md-3 col-form-label">Total:</label>
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

          <div class="row" id="PTdiv">
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
                              <option value="">-- Pilih Personal Training --</option>
                              <?php foreach ($data['pt_list'] as $row) { ?>
                                <option value="<?php echo $row->coach_id; ?>"><?php echo $row->coach_name; ?></option>  
                              <?php } ?>
                            </select>
                          </div>
                        </div>

                        <div class="form-group form-inline">
                          <label for="inlineinput" class="col-md-3 col-form-label">Harga Sesi:</label>
                          <div class="col-md-12 p-0">
                            <input type="text" class="form-control input-full" name="pt_price" id="pt_price" placeholder="Harga" value="0" readonly>
                          </div>
                        </div>

                        <div class="form-group form-inline">
                          <div class="row">
                            <div class="col-md-12">
                              <label for="inlineinput" class="col-md-3 col-form-label">Jumlah Sesi:</label>
                              <div class="col-md-12 p-0">
                                <select class="form-control input-full" id="pt_session_unit" name="pt_session_unit">
                                  <option value="">-- Pilih Sesi --</option>
                                  <?php foreach ($data['pt_package'] as $row) { ?>
                                    <option value="<?php echo $row->ms_pt_package_session; ?>"><?php echo $row->ms_pt_package_session; ?> Sesi</option>  
                                  <?php } ?>
                                </select>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="form-group form-inline">
                          <div class="row">
                            <div class="col-md-4">
                              <label for="inlineinput" class="col-md-3 col-form-label">Masa Berlaku:</label>
                              <div class="col-md-12 p-0">
                                <input type="text" class="form-control input-full" name="pt_session_month" id="pt_session_month" value="0" readonly>
                              </div>
                            </div>
                            <div class="col-md-8">
                              <label for="inlineinput" class="col-md-3 col-form-label" style="margin-top:20px;"></label>
                              <div class="col-md-12 p-0">
                                <input type="text" class="form-control input-full" name="pt_session_month" id="pt_session_month" value="Bulan" readonly>
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
            <div class="col-md-9"> 
             <div class="col-md-12" id="step2"> 
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
          </div>
        </div>

          <!-- 
          <div class="col-md-3" > 
            <div class="card-header">
              <div class="card-title" style="font-size: 17px;color: #1572e8!important;">Pembayaran</div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="card-body">
                  <div class="row"> 
                    <div class="form-group form-inline">
                      <div class="row">
                        <div class="col-md-12">
                          <label for="inlineinput" class="col-md-3 col-form-label">Pembayaran:</label>
                          <div class="col-md-12 p-0">
                            <select class="form-control input-full js-example-basic-single" id="payment" name="payment">
                              <option value="">-- Pilih Pembayaran --</option>
                              <option value="Transfer BCA">Transfer BCA</option>
                              <option value="Transfer BNI">Transfer BNI</option>
                              <option value="Qris BCA">Qris BCA</option>
                              <option value="Qris BNI">Qris BNI</option>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="form-group form-inline">
                      <div class="row">
                        <div class="col-md-12">
                          <label for="inlineinput" class="col-md-3 col-form-label">Diskon:</label>
                          <div class="col-md-12 p-0">
                            <input type="text" class="form-control input-full" name="discount" id="discount" value="0" readonly>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="form-group form-inline">
                      <div class="row">
                        <div class="col-md-12">
                          <label for="inlineinput" class="col-md-3 col-form-label">Total:</label>
                          <div class="col-md-12 p-0">
                            <input type="text" class="form-control input-full" name="total" id="total" value="0" readonly>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        -->
        <div class="row card-action">
          <div class="col-md-9"></div>
          <div class="col-md-3">
            <div class="row">
              <div class="col-md-12">
                <div class="card-body">
                  <div class="row"> 
                    <div class="form-group form-inline">
                      <div class="row">
                        <div class="col-md-4">
                          <label for="inlineinput" class="col-md-3 col-form-label">Pembayaran:</label>
                        </div>
                        <div class="col-md-8">
                          <div class="col-md-12 p-0">
                            <select class="form-control input-full js-example-basic-single" id="payment" name="payment">
                              <option value="">-- Pilih Pembayaran --</option>
                              <option value="Transfer BCA">Transfer BCA</option>
                              <option value="Transfer BNI">Transfer BNI</option>
                              <option value="Qris BCA">Qris BCA</option>
                              <option value="Qris BNI">Qris BNI</option>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="form-group form-inline">
                      <div class="row">
                        <div class="col-md-4">
                          <label for="inlineinput" class="col-md-3 col-form-label">Diskon:</label>
                        </div>
                        <div class="col-md-8">
                          <div class="col-md-12 p-0">
                            <input type="text" class="form-control input-full" name="discount" id="discount" value="0" readonly>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="form-group form-inline">
                      <div class="row">
                        <div class="col-md-4">
                          <label for="inlineinput" class="col-md-3 col-form-label">Total:</label>
                        </div>
                        <div class="col-md-8">
                          <div class="col-md-12 p-0">
                            <input type="text" class="form-control input-full" name="total" id="total" value="0" readonly>
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

    let member_id = $('#member_id').val();
    $.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>register/get_member_info",
      dataType: "json",
      data: {id:member_id},
      success : function(data){
        if (data.code == "200"){
          let row = data.result.get_member_info[0];
          $('#member_name').val(row.member_name);
          $('#member_phone').val(row.member_phone);
        } else {
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Data Tidak Di Temukan',
          })
        }
      }
    });

    $('#step2').hide();
    $('#membergymdiv').hide();
    $('#kelasdiv').hide();
    $('#PTdiv').hide();

  });

  let class_price = new AutoNumeric('#class_price', {
    currencySymbol : 'Rp. ',
    decimalCharacter : ',',
    decimalPlaces: 0,
    decimalPlacesShownOnFocus: 0,
    digitGroupSeparator : '.',
  });

  let pt_price = new AutoNumeric('#pt_price', {
    currencySymbol : 'Rp. ',
    decimalCharacter : ',',
    decimalPlaces: 0,
    decimalPlacesShownOnFocus: 0,
    digitGroupSeparator : '.',
  });

  let gym_price = new AutoNumeric('#gym_price', {
    currencySymbol : 'Rp. ',
    decimalCharacter : ',',
    decimalPlaces: 0,
    decimalPlacesShownOnFocus: 0,
    digitGroupSeparator : '.',
  });

  let gym_total = new AutoNumeric('#gym_total', {
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

  let discount_class = new AutoNumeric('#discount_class', {
    suffixText: "%",
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
      $('#membergymdiv').show();
      $('#kelasdiv').hide();
    }else if(this.value == 'Member (GYM) + Kelas'){
      $('#membergymdiv').show();
      $('#kelasdiv').show();
    }else{
      $('#kelasdiv').show();
      $('#membergymdiv').hide();
    }
  });


  $('#pt_package').on('change', function() {
    if(this.value == 'Ya'){
      $('#PTdiv').show();
      $('#step2').show();
    }else{
      $('#PTdiv').hide();
      $('#step2').hide();
    }
  });

  $('#class_package').on('change', function() {
    var id = this.value;
    $.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>register/get_class_info",
      dataType: "json",
      data: {id:id},
      success : function(data){
        if (data.code == "200"){
          let row = data.result.get_class_info[0];
          class_price.set(row.class_price);
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


  $('#PT').on('change', function() {
    var id = this.value;
    $.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>register/get_pt_info",
      dataType: "json",
      data: {id:id},
      success : function(data){
        if (data.code == "200"){
          let row = data.result.get_pt_info[0];
          pt_price.set(row.ms_pt_price_price);
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

  $('#pt_session_unit').on('change', function() {
    let id = this.value;
    let price = pt_price.get();
    pt_total.set(id * price);
    $.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>register/get_pt_info_month",
      dataType: "json",
      data: {id:id},
      success : function(data){
        if (data.code == "200"){
          let row = data.result.get_pt_info_month[0];
          $('#pt_session_month').val(row.ms_pt_package_month);
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

  $('#class_session_unit').on('change', function() {
    let id = this.value;
    let price = class_price.get();
    class_total.set(id * price);
  });

  $('#total_member_month').on('change', function() {
    let id = this.value;
    let price = gym_price.get();
    gym_total.set(id * price);
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
          let row = data.result.get_promo_info[0];
          if(row.ms_promo_category == 'GYM'){
            $('#class_member_type').val("Member");
            $('#class_member_type').trigger('change');
          }else if(row.ms_promo_category == 'Kelas'){
            $('#class_member_type').val("Kelas Only");
            $('#class_member_type').trigger('change');
          }else{
            $('#class_member_type').val("Member (GYM) + Kelas");
            $('#class_member_type').trigger('change');
          }

          if(row.ms_promo_pt == 'Y'){
            $('#PTdiv').show();
            $('#step2').show();
            $('#pt_package').val("Ya");
            $('#pt_package').trigger('change');
            
          }else{
            $('#PTdiv').hide();
            $('#step2').hide();
            $('#pt_package').val("Tidak");
            $('#pt_package').trigger('change');
          }
          if(row.ms_promo_class == 'Y'){
            $('#kelasdiv').show();
          }else{
            $('#kelasdiv').hide();
          }
          $('#total_member_month').val(row.ms_promo_member_month);
          $('#total_member_month').trigger('change');
          gym_price.set(row.ms_gym_package_month_price);

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
    var member_id                 = $("#member_id").val();
    var class_member_type         = $("#class_member_type").val();
    var class_package_promo       = $("#class_package_promo").val();
    var gym_sessions_start        = $("#gym_sessions_start").val();
    var total_member_month        = $("#total_member_month").val();

    /*
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
    var crfe_m_4_desc             = $("#crfe_m_4_desc").val();*/

    $.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>register/save_register",
      dataType: "json",
      data: {member_id:member_id, class_member_type:class_member_type, class_package_promo:class_package_promo, gym_sessions_start:gym_sessions_start, total_member_month:total_member_month},
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



</script>