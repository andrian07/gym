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
              <div class="col-md-4">
                <div class="form-group form-inline">
                  <label for="inlineinput" class="col-md-3 col-form-label">Kode Member</label>
                  <div class="col-md-12 p-0">
                    <input type="text" class="form-control input-full" name="member_code" id="member_code" placeholder="Kode Member" value="AUTO" readonly>
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
                <div class="form-groups row">
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

                <div class="form-groups row">
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

                <div class="form-groups row">
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

                <div class="form-groups row">
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

                <div class="form-groups row">
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


                <div class="form-groups row">
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
            <div class="card-action" style="text-align: right;">
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Batal</button>
              <button id="btn_save" class="btn btn-primary" ><i class="fas fa-save"></i> Simpan</button>
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

    $.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>register/save_register",
      dataType: "json",
      data: {member_name:member_name, member_phone:member_phone, member_nik:member_nik, member_dob:member_dob, member_email:member_email, member_address:member_address, member_gender:member_gender, member_urgent_phone:member_urgent_phone, member_nik:member_nik,member_urgent_name:member_urgent_name, member_urgent_sibiling:member_urgent_sibiling, member_desc:member_desc, parq_q1:parq_q1, parq_q2:parq_q2, parq_q3:parq_q3, parq_q4:parq_q4, parq_q5:parq_q5, parq_q6:parq_q6},
      success : function(data){
        if (data.code == "200"){
          let member_id = data.member;
          window.location.href = "<?php echo base_url(); ?>register/addregisterpayment?id="+member_id;
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