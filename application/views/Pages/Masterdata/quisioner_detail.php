<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title></title>

  <link rel="stylesheet" href="<?php echo base_url(); ?>dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="<?php echo base_url(); ?>dist/css/plugins.min.css" />
  <link rel="stylesheet" href="<?php echo base_url(); ?>dist/css/kaiadmin.min.css" />
  <script src="<?php echo base_url(); ?>dist/js/plugin/webfont/webfont.min.js"></script>
  <script>
    WebFont.load({
      google: { families: ["Public Sans:300,400,500,600,700"] },
      custom: {
        families: [
          "Font Awesome 5 Solid",
          "Font Awesome 5 Regular",
          "Font Awesome 5 Brands",
          "simple-line-icons",
        ],
        urls: ["<?php echo base_url(); ?>dist/css/fonts.min.css"],
      },
      active: function () {
        sessionStorage.fonts = true;
      },
    });
  </script>
  <style type="text/css">
    .title-detail{
      text-align: right;
    }
    .row {
      --bs-gutter-x: 0 !important;
    }
    body{
      background: #fff;
    }
  </style>
</head>
<body>
  <div class="card" style="padding:15px;">
    <div class="d-flex align-items-left">
      <div>
        <h3 class="fw-bold mb-3">Member Informasi</h3>
      </div>
      <div class="ms-md-auto py-2 py-md-0">
      </div>
    </div>
    <div class="card-body" style="padding:0;">


      <div class="row">
        <div class="col-md-12">
          <div class="card-header">
            <div class="card-title" style="font-size: 17px; color: #1572e8!important;">Physical Activity Readiness Questionnaire (PARQ)</div>
          </div>
          <?php if($data['get_quisioner_member2_by_id'] != null){ ?>
            <?php foreach($data['get_quisioner_member_by_id'] as $row){ ?>
              <div class="card-body">
                <p>1.) Apakah dokter Anda pernah mengatakan bahwa Anda memiliki kondisi jantung dan Anda hanya boleh melakukan aktivitas fisik yang direkomendasikan oleh dokter?  <?php if($row->parq_q1 == 'N'){echo '<span class="badge badge-danger">Tidak</span>';}else{echo '<span class="badge badge-success">Ya</span>';}?></p>
                <p>2.) Apakah Anda merasakan nyeri dada saat melakukan aktivitas fisik?  <?php if($row->parq_q2 == 'N'){echo '<span class="badge badge-danger">Tidak</span>';}else{echo '<span class="badge badge-success">Ya</span>';}?></p>
                <p>3.) Dalam sebulan terakhir, apakah Anda merasakan nyeri dada saat tidak melakukan aktivitas fisik apa pun ?  <?php if($row->parq_q3 == 'N'){echo '<span class="badge badge-danger">Tidak</span>';}else{echo '<span class="badge badge-success">Ya</span>';}?></p>
                <p>4.) Apakah Anda memiliki masalah tulang atau sendi yang dapat menjadi buruk diakibatkan aktivitas fisik Anda ?  <?php if($row->parq_q4 == 'N'){echo '<span class="badge badge-danger">Tidak</span>';}else{echo '<span class="badge badge-success">Ya</span>';}?></p>
                <p>5.) Apakah Anda saat ini mengkonsumsi obat untuk tekanan darah Anda atau untuk kondisi jantung Anda ?  <?php if($row->parq_q5 == 'N'){echo '<span class="badge badge-danger">Tidak</span>';}else{echo '<span class="badge badge-success">Ya</span>';}?></p>
                <p>6.) Apakah Anda tahu alasan lain mengapa Anda tidak boleh melakukan aktivitas fisik ?  <?php if($row->parq_q6 == 'N'){echo '<span class="badge badge-danger">Tidak</span>';}else{echo '<span class="badge badge-success">Ya</span>';}?></p>
              </div>
            <?php } }else{ ?>
              <div class="card-body"> <p> Data Belum Di Isi </p></div>
            <?php } ?>
          </div>

          <div class="col-md-12">
            <div class="card-header">
              <div class="card-title" style="font-size: 17px; color: #1572e8!important;">Client Readiness For Exercise</div>
            </div>
            <?php if($data['get_quisioner_member2_by_id'] != null){ ?>
              <?php foreach($data['get_quisioner_member2_by_id'] as $row){ ?>
                <div class="card-body">
                  <label for="noinvoice" class="col-sm-12 col-form-label" style="color:#E77D22 !important">Pekerjaan</label>
                  <p>1.) Apa pekerjaan anda sekarang ? <?php echo '<span class="badge badge-primary">'.$row->crfe_w_1.'</span>' ?></p>
                  <p>2.) Apakah pekerjaan Anda membutuhkan waktu duduk yang lama ? <?php if($row->crfe_w_2 == 'N'){echo '<span class="badge badge-danger">Tidak</span>';}else{echo '<span class="badge badge-success">Ya</span>';}?></p>
                  <p>3.) Apakah pekerjaan Anda memerlukan gerakan berulang? Jika Ya, mohon di jelaskan ? <?php if($row->crfe_w_3 == 'N'){echo '<span class="badge badge-danger">Tidak</span>';}else{echo '<span class="badge badge-success">Ya</span>';}?>  <?php echo '/ <span class="badge badge-primary">'.$row->crfe_w_3_desc.'</span>' ?></p>
                  <p>4.) Apakah pekerjaan Anda mengharuskan Anda memakai sepatu berhak? (misalnya Sepatu Formal) <?php if($row->crfe_w_4 == 'N'){echo '<span class="badge badge-danger">Tidak</span>';}else{echo '<span class="badge badge-success">Ya</span>';}?></p>
                  <p>5.) Apakah pekerjaan Anda menyebabkan Anda stres mental ? <?php if($row->crfe_w_5 == 'N'){echo '<span class="badge badge-danger">Tidak</span>';}else{echo '<span class="badge badge-success">Ya</span>';}?></p>

                  <label for="noinvoice" class="col-sm-12 col-form-label" style="color:#E77D22 !important">Rekreasional</label>
                  <p>1.) Apakah Anda melakukan aktivitas fisik rekreasi (golf, ski, dll.)? Jika ya, mohon dijelaskan. <?php if($row->crfe_r_1 == 'N'){echo '<span class="badge badge-danger">Tidak</span>';}else{echo '<span class="badge badge-success">Ya</span>';}?>  <?php echo '/ <span class="badge badge-primary">'.$row->crfe_r_1_desc.'</span>' ?></p>
                  <p>2.) Apakah Anda memiliki hobi tambahan (membaca, bermain video game, dll.)? (Jika ya, mohon dijelaskan) <?php if($row->crfe_r_2 == 'N'){echo '<span class="badge badge-danger">Tidak</span>';}else{echo '<span class="badge badge-success">Ya</span>';}?>  <?php echo '/ <span class="badge badge-primary">'.$row->crfe_r_2_desc.'</span>' ?></p>

                  <label for="noinvoice" class="col-sm-12 col-form-label" style="color:#E77D22 !important">Medical</label>
                  <p>1.) Pernahkah Anda mengalami cedera atau nyeri kronis? (jika YA, mohon dijelaskan) <?php if($row->crfe_m_1 == 'N'){echo '<span class="badge badge-danger">Tidak</span>';}else{echo '<span class="badge badge-success">Ya</span>';}?>  <?php echo '/ <span class="badge badge-primary">'.$row->crfe_m_1_desc.'</span>' ?></p>
                  <p>2.) Pernahkah Anda menjalani operasi? (jika YA, mohon dijelaskan) <?php if($row->crfe_m_2 == 'N'){echo '<span class="badge badge-danger">Tidak</span>';}else{echo '<span class="badge badge-success">Ya</span>';}?>  <?php echo '/ <span class="badge badge-primary">'.$row->crfe_m_2_desc.'</span>' ?></p>
                  <p>3.) Pernahkah dokter mendiagnosis Anda menderita penyakit kronis, seperti penyakit jantung, hipertensi, kolesterol tinggi, atau diabetes? (Jika YA, jelaskan) <?php if($row->crfe_m_3 == 'N'){echo '<span class="badge badge-danger">Tidak</span>';}else{echo '<span class="badge badge-success">Ya</span>';}?>  <?php echo '/ <span class="badge badge-primary">'.$row->crfe_m_3_desc.'</span>' ?></p>
                  <p>4.) Apakah Anda sedang mengonsumsi obat apa pun? (Jika YA, mohon dijelaskan) <?php if($row->crfe_m_4 == 'N'){echo '<span class="badge badge-danger">Tidak</span>';}else{echo '<span class="badge badge-success">Ya</span>';}?>  <?php echo '/ <span class="badge badge-primary">'.$row->crfe_m_4_desc.'</span>' ?></p>
                </div>
              <?php } }else{ ?>
                <div class="card-body"> <p> Data Belum Di Isi </p></div>
              <?php } ?>
            </div>
          </div>

        </div>
      </div>
    </div>
  </body>

  </html>  


