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
      <?php foreach($data['get_member_by_id'] as $row){ ?>
      <div class="row">
        <div class="col-md-6">
          <img src="<?php echo base_url(); ?>assets/member/<?php echo $row->member_image; ?>" style="height: 250px; width: 350px;">
        </div>
        <div class="col-md-5">
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
        <div class="col-md-1">
        </div>

      </div>
      <?php } ?>

    </div>
  </div>
</body>

</html>  


