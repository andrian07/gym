<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title></title>

  <link rel="stylesheet" href="<?php echo base_url(); ?>dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="<?php echo base_url(); ?>dist/css/plugins.min.css" />
  <link rel="stylesheet" href="<?php echo base_url(); ?>dist/css/kaiadmin.min.css" />
  <link rel="stylesheet" href="<?php echo base_url(); ?>dist/css/style.css" />
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

    .fancybox__content, 
    .fancybox__iframe,
    #fancybox__iframe_1_0{
      height: 518px !important;
    }

    .header-details p{
      line-height: 10px;
    }

    .header-details{
      padding-top: 15px;
      padding-left: 1%;
    }
  </style>
</head>
<body>
  <div class="row">
    <div class="col-md-12 header-detail">
      <h2>Detail Pendaftaran</h2>
    </div>
  </div>

  <?php foreach($get_transaction_by_id as $row){ ?>
    <div class="row header-details">
      <div class="col-md-4">
        <p class="detail-company"><b><?php echo company ?> </b></p>
        <p><?php echo $row['member_name']; ?> / <b><?php echo $row['member_code']; ?></b></p>
        <p><?php echo $row['member_phone']; ?></p>
        <p><?php echo $row['member_address']; ?></p>
      </div>
      <div class="col-md-4">
        <p class="detail-invoice"><?php echo $row['transaction_register_inv']; ?></p>
      </div>
      <div class="col-md-4">
        <p>Pembayaran: <b><?php echo $row['payment_name']; ?></b></p>
        <p>Status: 
          <b>
            <?php 
            if($row['transaction_payment_status'] == 'Lunas'){
              echo '<span class="badge badge-success">Lunas</span>';
            }else{
              echo '<span class="badge badge-danger">Belum Lunas</span>';
            }
            ?>
          </b>
        </p>
        <p>Tanggal: <b><?php $date = date_create($row['transaction_register_date']);  echo date_format($date,"d-M-Y"); ?></b></p>
      </div>
    </div>


    <div class="row">
      <div class="col-md-12"> 
        <table class="table table-striped mt-3" style="border:none !important; font-weight:500;">
          <thead>
            <tr>
              <th scope="col">Keterangan</th>
              <th scope="col">Diskon</th>
              <th scope="col">Total</th>
            </tr>
          </thead>
          <tbody>
            <?php if($row['member_gym'] == 'Y'){  ?>
              <tr>
                <td><?php echo $row['ms_gym_package_name']; ?></td>
                <td><?php echo $row['transaction_gym_discount']; ?> %</td>
                <td><?php echo 'Rp. '.number_format($row['transaction_gym_total_price']) ?></td>
              </tr>
            <?php } ?>
            <?php if($row['transaction_pt'] == 'Y'){  ?>
              <tr>
                <td><?php echo 'Paket Gym '.$row['transaction_pt_month']. ' Bulan' ?></td>
                <td><?php echo $row['transaction_pt_discount']; ?> %</td>
                <td><?php echo 'Rp. '.number_format($row['transaction_pt_total_price']) ?></td>
              </tr>
            <?php } ?>
            <?php if($row['transaction_class'] == 'Y'){  ?>
              <tr>
                <td><?php echo $row['ms_class_package_name']; ?></td>
                <td><?php echo $row['transaction_class_discount']; ?> %</td>
                <td><?php echo 'Rp. '.number_format($row['transaction_class_total_price']) ?></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
    <p style="margin-left: 15px; font-size: 15px;">Logs:</p>
    <div class="row">
      <div class="col-md-4">
        <table class="table table-hover" style="border:none !important;">
          <tbody>

            <tr>
              <td scope="col"><b>Action</b></td>
              <td scope="col"><b>User</b></td>
              <td scope="col"><b>Created At</b></td>
            </tr>
            <tr>
              <td scope="col"><b>Dibuat</b></td>
              <td scope="col"><b><?php echo $row['user_name']; ?></b></td>
              <td scope="col"><b><?php $date = date_create($row['transaction_register_date']);  echo date_format($date,"d-M-Y"); ?></b></td>
            </tr>

          </tbody>
        </table>
      </div>

      <div class="col-md-4">

      </div>

      <div class="col-md-4">
        <table class="table" style="border:none !important; text-align:right;">
          <tbody>
            <tr>
              <td scope="col"><b>Grand Total: </b></td>
              <td scope="col">Rp. <?php echo number_format($row['transaction_payment_total']); ?></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

  <?php } ?>
</body>

</html>