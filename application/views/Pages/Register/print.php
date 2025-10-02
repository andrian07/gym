<?php 
define('DOC_ROOT_PATH', $_SERVER['DOCUMENT_ROOT'].'/');
require DOC_ROOT_PATH . $this->config->item('header');
?>
</div>
<style type="text/css">
  @page {
    size: A4;
    margin: 0;
  }

  .card .card-invoice{
    size: A4;
  }
  @media print {
    body {
      margin: 0;
      padding: 0;
      visibility: hidden;
    }
    #section-to-print {
      visibility: visible;
      position: absolute;
      left: 0;
      top: 0;
      margin-left: -250px;
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

            <h3 class="fw-bold mb-3">Invoice #<?php echo $data['get_register'][0]->transaction_register_inv ?></h3>
          </div>
          <div class="col-auto">
            <a href="#" class="btn btn-light btn-border">
              Download
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
                <?php foreach($data['get_register'] as $row){ ?>
                  <div class="row">
                    <div class="col-md-4 info-invoice">
                      <h5 class="sub">Member</h5>
                      <p>
                        <?php echo $row->member_name; ?> <br />
                        <?php echo $row->member_address; ?> <br />
                        <?php echo $row->member_phone; ?>
                      </p>
                    </div>
                    <div class="col-md-4 info-invoice">
                      <h5 class="sub">Invoice ID</h5>
                      <p><?php echo $row->transaction_register_inv; ?></p>
                    </div>
                    <div class="col-md-4 info-invoice">
                      <h5 class="sub">Tanggal</h5>
                      <?php $date = date_create($row->transaction_register_date);  ?>
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
                                <td class="text-center"><strong>Kelas</strong></td>
                                <td class="text-center"><strong>Harga</strong></td>
                                <td class="text-center"><strong>Qty</strong></td>
                                <td class="text-center"><strong>Periode</strong></td>
                                <td class="text-center"><strong>Coach</strong></td>
                                <td class="text-center"><strong>Total</strong></td>
                              </tr>
                            </thead>
                            <tbody>
                              <?php foreach($data['get_detail_register'] as $rows){ ?>
                                <tr>
                                  <td class="text-center"><?php echo $rows->class_name ?></td>
                                  <td class="text-center"><?php echo 'Rp. '.number_format($rows->class_price) ?></td>
                                  <td class="text-center"><?php echo $rows->transaction_register_session ?> <?php echo $rows->transaction_register_session_unit ?></td>
                                  <?php $date_start = date_create($rows->transaction_register_start_date);  ?>
                                  <?php $date_end = date_create($rows->transaction_register_end_date);  ?>
                                  <td class="text-center"><?php echo date_format($date_start,"d/m/Y"); ?> s/d <?php echo date_format($date_end,"d/m/Y"); ?></td>
                                  <td class="text-center"><?php echo $rows->coach_name ?></td>
                                  <td class="text-center"><?php echo 'Rp. '.number_format($rows->transaction_register_subtotal) ?></td>
                                </tr>
                              <?php } ?>
                              <?php foreach($data['get_register'] as $rowse){ ?>
                                <tr>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td class="text-center"><strong>Diskon</strong></td>
                                  <td class="text-center"><?php echo 'Rp. '.number_format($rowse->transaction_register_discount) ?></td>
                                </tr>
                                <tr>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td class="text-center"><strong>Total</strong></td>
                                  <td class="text-center"><?php echo 'Rp. '.number_format($rowse->transaction_register_total ) ?></td>
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
                      <div><span>Account Name:</span><span>CV Elaia Olahraga Sehat</span></div>
                      <div><span>Account Number:</span><span>1460098895688</span></div>
                      <div><span>BANK:</span><span>Mandiri</span></div>
                    </div>
                  </div>
                  <?php foreach($data['get_register'] as $rowse){ ?>
                    <div class="col-sm-5 col-md-7 transfer-total">
                      <h5 class="sub">Total Nota</h5>
                      <div class="price"><?php echo 'Rp. '.number_format($rowse->transaction_register_total ) ?></div>
                    </div>
                  <?php } ?>
                </div>
                <div class="separator-solid"></div>

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

