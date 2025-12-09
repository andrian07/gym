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
                <h3 class="fw-bold mb-3">Transaksi Harian</h3>
              </div>
              <div class="ms-md-auto py-2 py-md-0">
                <button class="btn btn-info" id="reload"><span class="btn-label"><i class="fas fa-sync"></i></span> Reload</button>
                <?php if($data['check_auth'][0]->add == 'N'){ ?>
                  <button class="btn btn-primary" disabled="disabled"><span class="btn-label"><i class="fa fa-plus"></i></span> Tambah</button>
                <?php }else{ ?>
                  <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target=".bd-example-modal-xl"><span class="btn-label"><i class="fa fa-plus"></i></span>Tambah</button>
                <?php } ?>
              </div>
              <div class="modal fade bd-example-modal-xl" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" >
                <div class="modal-dialog modal-xl">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Tambah Transaksi Harian</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <div class="row">
                        <div class="col-md-6 border-right">
                          <div class="form-group form-inline">
                            <label for="inlineinput" class="col-md-3 col-form-label">Kode Member:</label>
                            <div class="col-md-12 p-0">
                              <input type="hidden" class="form-control input-full" name="member_id" id="member_id" readonly>
                              <input type="text" class="form-control input-full" name="member_code" id="member_code" value="Auto" readonly>
                            </div>
                          </div>
                          <div class="form-group form-inline">
                            <label for="inlineinput" class="col-md-3 col-form-label">Nama Member:</label>
                            <div class="col-md-12 p-0">
                              <input id="member_name" name="member_name" type="text" class="form-control ui-autocomplete-input" placeholder="ketikkan nama member" value="" required="" autocomplete="off">
                            </div>
                          </div>
                          <div class="form-group form-inline">
                            <label for="inlineinput" class="col-md-3 col-form-label">No HP:</label>
                            <div class="col-md-12 p-0">
                              <input type="text" class="form-control input-full" name="member_phone" id="member_phone" placeholder="No HP">
                            </div>
                          </div>
                          <div class="form-group form-inline">
                            <label for="inlineinput" class="col-md-3 col-form-label">Gender:</label>
                            <div class="col-md-12 p-0">
                              <select class="form-control input-full" id=member_gender name="member_gender">
                                <option value="Wanita">Wanita</option>
                                <option value="Pria">Pria</option>
                              </select>
                            </div>
                          </div>
                          <div class="form-group form-inline">
                            <label for="inlineinput" class="col-md-3 col-form-label">Alamat:</label>
                            <div class="col-md-12 p-0">
                              <textarea class="form-control input-full" name="member_address" id="member_address"></textarea>
                            </div>
                          </div>
                          <div class="form-group form-inline">
                            <label for="inlineinput" class="col-md-3 col-form-label">Informasi Elluna Dari:</label>
                            <div class="col-md-12 p-0">
                              <input type="text" class="form-control input-full" name="ellunainfo" id="ellunainfo" placeholder="Teman/Sosmed/Iklan/DLL">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group form-inline">
                            <label for="inlineinput" class="col-md-3 col-form-label">Kelas:</label>
                            <div class="col-md-12 p-0">
                              <select class="form-control input-full js-example-basic-single" id=schedule_class_id name="schedule_class_id">
                                <option value="">-- Pilih Kelas --</option>
                                <?php foreach ($data['class_list'] as $row) { ?>
                                  <?php $date = date_create($row->schedule_time_start); ?>
                                  <option value="<?php echo $row->schedule_class_id ?>"><?php echo $row->class_name ?> (<?php echo $row->schedule_day ?> / <?php echo date_format($date,"H:i") ?> / <?php echo $row->coach_name; ?>)</option>
                                <?php } ?>
                              </select>
                            </div>
                          </div>

                          <div class="form-group form-inline">
                            <label for="inlineinput" class="col-md-3 col-form-label">Nama Instruktur:</label>
                            <div class="col-md-12 p-0">
                              <input type="text" class="form-control input-full" name="coach_name" id="coach_name" readonly>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group form-inline">
                                <label for="inlineinput" class="col-md-3 col-form-label">Hari:</label>
                                <div class="col-md-12 p-0">
                                  <input type="text" class="form-control input-full" name="class_day" id="class_day" readonly>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group form-inline">
                                <label for="inlineinput" class="col-md-3 col-form-label">Jam:</label>
                                <div class="col-md-12 p-0">
                                  <input type="time" class="form-control input-full" name="class_hour" id="class_hour" readonly>
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="form-group form-inline">
                            <label for="inlineinput" class="col-md-3 col-form-label">Harga:</label>
                            <div class="col-md-12 p-0">
                              <input type="text" class="form-control input-full" name="class_price" id="class_price" value="0" readonly>
                            </div>
                          </div>

                          <div class="form-group form-inline">
                            <label for="inlineinput" class="col-md-3 col-form-label">Pembayaran:</label>
                            <div class="col-md-12 p-0">
                              <select class="form-control input-full js-example-basic-single" id="payment" name="payment">
                                <option value="">-- Pilih Pembayaran --</option>
                                <?php foreach ($data['payment_list'] as $row) { ?>
                                  <option value="<?php echo $row->payment_id; ?>"><?php echo $row->payment_name; ?></option>
                                <?php } ?>
                              </select>
                            </div>
                          </div>

                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Batal</button>
                      <button id="save" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                    </div>
                  </div>
                </div>
              </div>
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
                <tbody>

                </tbody>
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

  $(document ).ready(function() {
    table_register_list();
  });

  let class_price = new AutoNumeric('#class_price', {
    currencySymbol : 'Rp. ',
    decimalCharacter : ',',
    decimalPlaces: 0,
    decimalPlacesShownOnFocus: 0,
    digitGroupSeparator : '.',
  });

  $('#schedule_class_id').on('change', function() {
    var id = this.value;
    $.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>transaction/get_class_info",
      dataType: "json",
      data: {id:id},
      success : function(data){
        if (data.code == "200"){
          let row = data.result.get_schedule_class_info[0];
          $('#coach_name').val(row.coach_name);
          $('#class_day').val(row.schedule_day);
          $('#class_hour').val(row.schedule_time_start);
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

  $('#save').click(function(e){
    e.preventDefault();
    var titles                = $("#titlehide").val();
    var member_id             = $("#member_id").val();
    var member_name           = $("#member_name").val();
    var member_phone          = $("#member_phone").val();
    var member_address        = $("#member_address").val();
    var member_gender         = $("#member_gender").val();
    var ellunainfo            = $("#ellunainfo").val();
    var schedule_class_id     = $("#schedule_class_id").val();
    var class_price_val       = class_price.get();
    var payment               = $("#payment").val();

    $.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>register/daily_save",
      dataType: "json",
      data: {member_id:member_id, member_name:member_name, member_phone:member_phone, member_address:member_address, member_gender:member_gender, ellunainfo:ellunainfo, schedule_class_id:schedule_class_id, class_price_val:class_price_val, payment:payment},
      success : function(data){
        if (data.code == "200"){
          let title_save = 'Tambah Data';
          let message    = 'Data Berhasil Di Tambah';
          let state      = 'info';
          notif_success(title_save, message, state);
          $("#myModal").modal('hide');
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

  function table_register_list(){
    $('#register-list').DataTable({
      serverSide: true,
      search: true,
      processing: true,
      ordering: false,
      ajax: {
        url: '<?php echo base_url(); ?>Register/register_daily_list',
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

  $('#member_name').autocomplete({ 
    minLength: 2,
    source: function(req, add) {
      $.ajax({
        url: '<?php echo base_url(); ?>/transaction/search_member',
        dataType: 'json',
        type: 'GET',
        data: req,
        success: function(res) {
          if (res.success == true) {
            add(res.data);
          }else{
            $('#member_name').val('');
          }
        },
      });
    },
    select: function(event, ui) {
      let id = ui.item.id;
      let member_code = ui.item.member_code;
      let member_phone = ui.item.member_phone;
      let member_name = ui.item.member_name;
      let member_gender = ui.item.member_gender;
      let member_address = ui.item.member_address;

      $('#member_id').val(id);
      $('#member_code').val(member_code);
      $('#member_phone').val(member_phone);
      $('#member_name').val(member_name);
      $('#member_gender').val(member_gender);
      $('#member_address').val(member_address);
    },
  });


  $('#reload').click(function(e){
    e.preventDefault();
    location.reload();
  });
</script>