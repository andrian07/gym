<?php 
define('DOC_ROOT_PATH', $_SERVER['DOCUMENT_ROOT'].'/');
require DOC_ROOT_PATH . $this->config->item('header');
?>
</div>
<style type="text/css">
  @page {
    margin: 0;
    size: A4;
  }
  .card .card-invoice{
    size: A4;
  }
  .card-invoice .card-header {
    padding: 10px 10px;
    border: 0 !important;
    width: 90%;
    margin: auto;
  }
  .card-invoice .invoice-header .invoice-title {
    font-size: 22px;
    font-weight: 400;
  }
  .card-invoice .card-body {
    padding: 0;
    border: 0 !important;
    width: 90%;
    margin: auto;
  }
  .card-invoice .card-footer {
    padding: 5px 0 50px;
    border: 0 !important;
    width: 90%;
    margin: auto;
  }
  @media print {
    .card-invoice .invoice-header .invoice-title {
      font-size: 17px;
      font-weight: 400;
    }
    .card-invoice .transfer-total .price {
      font-size: 22px;
    }
    body {
      margin: 0;
      padding: 0;
      visibility: hidden;
      size: A4;
      zoom: 95%;
      font-size: 1em;
    }
    #section-to-print {
      visibility: visible;
      position: absolute;
      margin-top: -150px;
      margin-left: -300px;
      width:150%;
      height: 800px;
      border: none;
    }
    * {
      page-break-before: avoid;
      page-break-after: avoid;
      page-break-inside: avoid;
    }
  }
</style>
<div class="container">
  <div class="page-inner">
    <div class="row justify-content-center">
      <div class="col-12 col-lg-10 col-xl-9">
        <div class="row align-items-center">
          <div class="col">
            <h6 class="page-pretitle">
              Payments
            </h6>
          </div>
          <div class="col-auto">
            <a onclick="print_page()" class="btn btn-light btn-border">
              Download / Cetak
            </a>
          </div>
        </div>
        <div class="page-divider"></div>
        <div class="row" id="section-to-print">
          <div class="col-md-12">
            <div class="card card-invoice">
              <div class="card-header">
                <div class="invoice-header">
                  <h3 class="invoice-title">
                    Invoice
                    <br />
                    #<?php echo $get_transaction_by_id[0]['transaction_register_inv']; ?>
                  </h3>
                  <div class="invoice-logo">
                    <img src="<?php echo base_url(); ?>assets/logo.png" alt="logo">
                  </div>
                </div>
                <div class="invoice-desc">
                  Jl. Jenderal Ahmad Yani, Bansir Laut<br>
                  Kota Pontianak, Kalimantan Barat
                </div>
              </div>
              <div class="card-body">
                <div class="separator-solid"></div>
                <?php foreach($get_transaction_by_id as $row){ ?>
                  <div class="row">
                    <div class="col-4 info-invoice">
                      <h5 class="sub">Member</h5>
                      <p>
                        <?php echo $row['member_name']; ?> <br />
                        <?php echo $row['member_address']; ?> <br />
                        <?php echo $row['member_phone']; ?>
                      </p>
                    </div>
                    <div class="col-4 info-invoice">

                    </div>
                    <div class="col-4 info-invoice">
                      <h5 class="sub">Tanggal</h5>
                      <?php $date = date_create($row['transaction_register_date']);  ?>
                      <p><?php echo date_format($date,"d-m-Y"); ?></p>
                    </div>
                  </div>
                <?php } ?>

                <div class="row">
                  <div class="col-md-12">
                    <div class="invoice-detail">
                      <div class="invoice-top">
                        <h3 class="title"><strong>Keterangan Kelas</strong></h3>
                      </div>
                      <div class="invoice-item">
                        <div class="table-responsive">
                          <table class="table table-striped">
                            <thead>
                              <tr>
                                <td class="text-center"><strong>Keterangan</strong></td>
                                <td class="text-center"><strong>Diskon</strong></td>
                                <td class="text-center"><strong>Total</strong></td>
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
                    </div>  
                    <div class="separator-solid  mb-3"></div>
                  </div>  
                </div>
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-sm-7 col-md-5 mb-3 mb-md-0 transfer-to">
                    <h5 class="sub">Bank Transfer</h5>
                    <div class="account-transfer">
                      <div><span>Atas Nama:</span><span>CV Elaia Olahraga Sehat</span></div>
                      <div><span>No Rek:</span><span>1460098895688</span></div>
                      <div><span>BANK:</span><span>Mandiri</span></div>
                    </div>
                  </div>
                  <?php foreach($get_transaction_by_id as $rowse){ ?>
                    <div class="col-sm-5 col-md-7 transfer-total">
                      <h5 class="sub">Total Nota</h5>
                      <div class="price"><?php echo 'Rp. '.number_format($rowse['transaction_payment_total'] ) ?></div>
                    </div>
                  <?php } ?>
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
<script type="text/javascript">
  function print_page()
  {
    window.print();
  }
</script>
