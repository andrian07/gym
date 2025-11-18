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
        <div class="card">
          <div class="card-header">
            <div class="d-flex align-items-left">
              <div>
                <h3 class="fw-bold mb-3">Transaksi Pendaftaran</h3>
              </div>
              <div class="ms-md-auto py-2 py-md-0">
                <button class="btn btn-info" id="reload"><span class="btn-label"><i class="fas fa-sync"></i></span> Reload</button>
                <?php if($data['check_auth'][0]->add == 'N'){ ?>
                  <button class="btn btn-primary" disabled="disabled"><span class="btn-label"><i class="fa fa-plus"></i></span> Tambah</button>
                <?php }else{ ?>
                  <a href="<?php echo base_url(); ?>Register/addregister"><button class="btn btn-primary"><span class="btn-label"><i class="fa fa-plus"></i></span> Tambah</button></a>
                <?php } ?>
              </div>
              <!-- pop up edit member -->
              <div class="modal fade bd-example-modal-md editmodal" id="exampleModaledit" tabindex="-1" role="dialog" aria-labelledby="exampleModaleditLabel" >
                <div class="modal-dialog modal-md" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Pembayaran</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group form-inline">
                            <label for="inlineinput" class="col-md-3 col-form-label">Invoice</label>
                            <div class="col-md-12 p-0">
                              <input type="hidden" class="form-control input-full" name="transaction_id" id="transaction_id" readonly>
                              <input type="text" class="form-control input-full" name="transaction_inv" id="transaction_inv" value="" readonly>
                            </div>
                          </div>

                          <div class="form-group form-inline">
                            <label for="inlineinput" class="col-md-3 col-form-label">Total Pembayaan</label>
                            <div class="col-md-12 p-0">
                              <input type="text" class="form-control input-full" name="transaction_payment_total" id="transaction_payment_total"  value="0">
                            </div>
                          </div>

                          <div class="form-group form-inline">
                            <label for="inlineinput" class="col-md-3 col-form-label">Jenis Pembayaran</label>
                            <div class="col-md-12 p-0">
                              <select class="form-control input-full" id="transaction_payment_type">
                                <?php foreach($data['payment_list'] as $row){ ?>
                                  <option value="<?php echo $row->payment_id; ?>"><?php echo $row->payment_name; ?></option>
                                <?php } ?>
                              </select>
                            </div>
                          </div>

                          <div class="form-group form-inline">
                            <label for="inlineinput" class="col-md-3 col-form-label">Keterangan</label>
                            <div class="col-md-12 p-0">
                              <textarea class="form-control input-full" name="transaction_payment_desc" id="transaction_payment_desc"></textarea>
                            </div>
                          </div>

                        </div>
                      </div>
                    </div>

                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Batal</button>
                      <button id="savepayment" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- end popup edit member -->
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="register-list" class="display table table-striped table-hover">
                <thead>
                  <tr>
                    <th>No Invoice</th>
                    <th>Nama Member</th>
                    <th>Tanggal</th>
                    <th>Tipe</th>
                    <th>Diskon</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Transaksi</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody></tbody>
              </table>
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

  new bootstrap.Modal(document.getElementById('exampleModaledit'), {backdrop: 'static', keyboard: false})  
  let transaction_payment_total = new AutoNumeric('#transaction_payment_total', {
    currencySymbol : 'Rp. ',
    decimalCharacter : ',',
    decimalPlaces: 0,
    decimalPlacesShownOnFocus: 0,
    digitGroupSeparator : '.',
  });

  $(document ).ready(function() {
    table_register_list();
  });

  function table_register_list(){
    $('#register-list').DataTable({
      serverSide: true,
      search: true,
      processing: true,
      ordering: false,
      ajax: {
        url: '<?php echo base_url(); ?>Register/register_list',
        type: 'POST',
        data:  {},
      },
      columns: 
      [
      {data: 0},
      {data: 1},
      {data: 2},
      {data: 3},
      {data: 4},
      {data: 5},
      {data: 6},
      {data: 7},
      {data: 8}
      ]
    });
  }

  $('#exampleModaledit').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var id   = button.data('id')
    var inv = button.data('inv')
    var total = button.data('total')
    var modal = $(this)
    modal.find('#transaction_id').val(id)
    modal.find('#transaction_inv').val(inv)
    transaction_payment_total.set(total)
  })

  $('#savepayment').click(function(e){
    e.preventDefault();
    var transaction_id               = $("#transaction_id").val();
    var transaction_inv              = $("#transaction_inv").val();
    var transaction_payment_total    = $("#transaction_payment_total").val();
    var transaction_payment_type     = $("#transaction_payment_type").val();
    var transaction_payment_desc     = $("#transaction_payment_desc").val();

    $.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>register/savepayment",
      dataType: "json",
      data: {transaction_id:transaction_id, transaction_inv:transaction_inv, transaction_payment_total:transaction_payment_total, transaction_payment_type:transaction_payment_type, transaction_payment_desc:transaction_payment_desc},
      success : function(data){
        if (data.code == "200"){
          let title = 'Pembayaran';
          let message = 'Berhasil Melakukan Pembayaran';
          let state = 'info';
          notif_success(title, message, state);
          $("#exampleModaledit").modal('hide');
          $('#register-list').DataTable().ajax.reload();
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

  $('#reload').click(function(e){
    e.preventDefault();
    location.reload();
  });
</script>