<?php 
define('DOC_ROOT_PATH', $_SERVER['DOCUMENT_ROOT'].'/');
require DOC_ROOT_PATH . $this->config->item('header');
?>
</div>
<style type="text/css">
  .page-with-aside .page-aside .aside-header {
    padding: 24px 22px !important;
  }
</style>
<div class="container">
  <div class="page-inner">
    <div class="page-header">

    </div>
    <div class="row">
      <div class="col-md-12">
        <h3 class="fw-bold mb-3" style="margin-left:1%;">Transaksi Kelas Harian</h3>
        <div class="card">
          <div class="page-inner page-inner-fill">
            <div class="page-with-aside mail-wrapper bg-white">
              <div class="page-aside">
                <div class="aside-header">
                  <div class="title">Kelas</div>
                  <div class="description">Jenis Kelas Dan Jadwal</div>
                  <a class="btn btn-primary toggle-email-nav" data-bs-toggle="collapse" href="#email-app-nav" role="button" aria-expanded="false" aria-controls="email-nav">
                    <i class="icon-menu me-2"></i>
                    Menu
                  </a>
                </div>
                <div class="aside-nav collapse" id="email-app-nav">
                  <ul class="nav">
                    <li class="active" id="Gym" onclick="getdatamember(this.id)">
                      <a href="#">
                        <i class="fas fa-dumbbell"></i> GYM
                        <span class="badge badge-primary float-end"></span>
                      </a>
                    </li>
                    <li id="Zumba" onclick="getdatamember(this.id)">
                      <a href="#">
                        <i class="fas fa-child"></i> Zumba
                      </a>
                    </li>
                    <li id="Striking" onclick="getdatamember(this.id)">
                      <a href="#">
                        <i class="fas fa-child"></i> Striking Class
                      </a>
                    </li>
                    <li id="Aerobic" onclick="getdatamember(this.id)">
                      <a href="#">
                        <i class="fas fa-child"></i> Aerobic
                      </a>
                    </li>
                    <li id="Poundfit" onclick="getdatamember(this.id)">
                      <a href="#">
                        <i class="fas fa-child"></i> Poundfit
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="page-content mail-content">
                <div class="inbox-head d-lg-flex d-block">
                  <h3 id="titlemember"></h3>
                  <form action="#" class="ms-auto">
                    <div class="input-group">
                      <div class="btn-group">
                        <div class="aside-compose"><a href="#" class="btn btn-primary w-100 fw-mediumbold" data-bs-toggle="modal" data-bs-target=".bd-example-modal-xl">Tambah Member Harian</a></div>

                        <div class="modal fade bd-example-modal-xl" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" >
                          <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tambah Member Baru</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>

                              <div class="modal-body">
                                <div class="row">
                                  <div class="col-md-6 border-right">
                                    <div class="form-group form-inline">
                                      <label for="inlineinput" class="col-md-3 col-form-label">Kode Member:</label>
                                      <div class="col-md-12 p-0">
                                        <input type="text" class="form-control input-full" name="member_code" id="member_code" value="Auto" readonly>
                                      </div>
                                    </div>
                                    <div class="form-group form-inline">
                                      <label for="inlineinput" class="col-md-3 col-form-label">Nama Member:</label>
                                      <div class="col-md-12 p-0">
                                        <input type="text" class="form-control input-full" name="member_name" id="member_name" placeholder="Nama Member">
                                      </div>
                                    </div>
                                    <div class="form-group form-inline">
                                      <label for="inlineinput" class="col-md-3 col-form-label">No HP:</label>
                                      <div class="col-md-12 p-0">
                                        <input type="text" class="form-control input-full" name="member_phone" id="member_phone" placeholder="No HP">
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
                                            <option value="<?php echo $row->schedule_class_id ?>"><?php echo $row->class_name ?> (<?php echo date_format($date,"H:i") ?> / <?php echo $row->coach_name; ?>)</option>
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
                                        <input type="text" class="form-control input-full" name="class_price" id="class_price" readonly>
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
                  </form>
                </div>
                <div class="inbox-body">
                  <div class="mail-option">
                    <div class="email-filters-left">
                      <div class="chk-all">
                        <div class="btn-group">
                          <div class="form-check">
                            <label class="form-checkbox">
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="btn-group">
                        <button data-bs-toggle="dropdown" type="button" class="btn btn-secondary btn-border dropdown-toggle" aria-expanded="false"> With selected </button>
                        <div role="menu" class="dropdown-menu" style=""><a href="#" class="dropdown-item">Mark as read</a><a href="#" class="dropdown-item">Mark as unread</a><a href="#" class="dropdown-item">Spam</a>
                          <div class="dropdown-divider"></div><a href="#" class="dropdown-item">Delete</a>
                        </div>
                      </div>
                      <div class="btn-group">
                        <button type="button" class="btn btn-secondary btn-border">Archive</button>
                        <button type="button" class="btn btn-secondary btn-border">Span</button>
                        <button type="button" class="btn btn-secondary btn-border">Delete</button>
                      </div>
                      <div class="btn-group">
                        <button data-bs-toggle="dropdown" type="button" class="btn btn-secondary btn-border dropdown-toggle" aria-expanded="false">Order by </button>
                        <div role="menu" class="dropdown-menu dropdown-menu-right"><a href="#" class="dropdown-item">Date</a><a href="#" class="dropdown-item">From</a><a href="#" class="dropdown-item">Subject</a>
                          <div class="dropdown-divider"></div><a href="#" class="dropdown-item">Size</a>
                        </div>
                      </div>
                    </div>

                  </div>
                  <div class="email-list" id="datamember">

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

<?php 
require DOC_ROOT_PATH . $this->config->item('footer');
?>

<script>


  $(document ).ready(function() {
    var title = 'Gym';
    getdatamember(title)
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
    var member_name           = $("#member_name").val();
    var member_phone          = $("#member_phone").val();
    var member_address        = $("#member_address").val();
    var ellunainfo            = $("#ellunainfo").val();
    var schedule_class_id     = $("#schedule_class_id").val();
    var class_price_val       = class_price.get();
    var payment               = $("#payment").val();

    $.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>transaction/daily_save",
      dataType: "json",
      data: {member_name:member_name, member_phone:member_phone, member_address:member_address, ellunainfo:ellunainfo, schedule_class_id:schedule_class_id, class_price_val:class_price_val, payment:payment},
      success : function(data){
        if (data.code == "200"){
          let title = 'Tambah Data';
          let message = 'Data Berhasil Di Tambah';
          let state = 'info';
          notif_success(title, message, state);
          window.location.href = "<?php echo base_url(); ?>/Register/1";
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

  function getdatamember(title) {
    $('#titlemember').html('Anggota Kelas '+title);
    $('#datamember').html('<div class="email-list-item"><div class="email-list-actions"></div><div class="email-list-detail"><span class="date float-end"><span class="badge badge-success">Hadir</span></span><span class="from">Lukas</span><p class="msg">#VIP007 / 085245139056</p></div></div><div class="email-list-item"><div class="email-list-actions"></div><div class="email-list-detail"><span class="date float-end"><span class="badge badge-success">Hadir</span></span><span class="from">Lukas</span><p class="msg">#VIP007 / 085245139056</p></div></div>');
    const activeLis = document.querySelectorAll("li.active");
    activeLis.forEach(li => {
      li.classList.remove("active");
    }); 
    $('#'+title+'').addClass("active");
    /*$.ajax({
      url: 'load_data.php',
      type: 'POST',
      data: { user: 'andrian', action: 'load' },
      success: function(response) {
        $('#datamember').html('<div class="email-list-item"><div class="email-list-actions"></div><div class="email-list-detail"><span class="date float-end"><span class="badge badge-success">Hadir</span></span><span class="from">Lukas</span><p class="msg">#VIP007 / 085245139056</p></div></div><div class="email-list-item"><div class="email-list-actions"></div><div class="email-list-detail"><span class="date float-end"><span class="badge badge-success">Hadir</span></span><span class="from">Lukas</span><p class="msg">#VIP007 / 085245139056</p></div></div>');
      }
    });*/
  }
</script>