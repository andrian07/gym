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
<body style="padding:15px;">
  <div class="card" style="padding:0;">
    <div class="d-flex align-items-left">
      <div>
        <h3 class="fw-bold mb-3">Member Informasi</h3>
      </div>
      <div class="ms-md-auto py-2 py-md-0">
      </div>
    </div>
    <div class="card-body" style="padding:0;">
      <?php foreach($data['get_class_by_member_id'] as $row){ ?>
        <div class="row">
          <div class="col-md-12">
            <div class="table-responsive">
              <table class="table table-bordered">
                <tbody>
                  <tr>
                    <th scope="col" class="productinfo-text-right">Kode Member:</th>
                    <td colspan="4"><?php echo $row->member_code; ?></td>
                  </tr>
                  <tr>
                    <th scope="col" class="productinfo-text-right">Nama:</th>
                    <td colspan="4"><?php echo $row->member_name; ?></td>
                  </tr>
                  <tr>
                    <th scope="col" class="productinfo-text-right">No Hp:</th>
                    <td colspan="4"><?php echo $row->member_phone; ?></td>
                  </tr>
                  <tr>
                    <th scope="col" class="productinfo-text-right">Tgl Lahir:</th>
                    <td colspan="4"><?php echo $row->member_dob; ?></td>
                  </tr>
                  <tr>
                    <th scope="col" class="productinfo-text-right">Jensi Kelamin:</th>
                    <td colspan="4"><?php echo $row->member_gender; ?></td>
                  </tr>
                  <tr>
                    <th scope="col" class="productinfo-text-right">Alamat:</th>
                    <td colspan="4"><?php echo $row->member_address; ?></td>
                  </tr>
                  <tr>
                    <th scope="col" class="productinfo-text-right">Kontak Darurat Yang Dapat Dihubungi:</th>
                    <td colspan="4"><?php echo $row->member_urgent_phone; ?></td>
                  </tr>
                  <tr>
                    <th scope="col" class="productinfo-text-right">Hubungan:</th>
                    <td colspan="4"><?php echo $row->member_urgent_sibiling; ?></td>
                  </tr>
                  <tr>
                    <th scope="col" class="productinfo-text-right">Keterangan (alergi / penyakit bawaan /dll)::</th>
                    <td colspan="4"><?php echo $row->member_desc; ?></td>
                  </tr>
                  <tr>
                    <th scope="col" class="productinfo-text-right">Status:</th>
                    <td colspan="4">
                      <?php if($row->member_active == 'Y'){
                        echo '<span class="badge badge-success">Aktif</span>';
                      }else{
                        echo '<span class="badge badge-danger multi-badge">Tidak Aktif</span>';
                      } ?>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="row border-top">

          <div class="col-md-3">
          </div>

          <div class="col-md-9">
            <div class="table-responsive">
              <h2>Jadwal Kelas</h2>
              <table class="display table table-striped table-hover schedule-list" style="width: 100%;">
                <thead>
                  <tr>
                    <th>Hari</th>
                    <th>Jam</th>
                    <th>Instruktur</th>
                    <th>Kelas</th>
                  </tr>
                </thead>
                <tbody id="schedulelistbody">
                  <tr>
                    <th>Senin</th>
                    <th>07:00 - 09:00</th>
                    <th>Doni</th>
                    <th>Zumba</th>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      <?php } ?>

    </div>
  </div>
</body>

</html>  


