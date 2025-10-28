<?php 
define('DOC_ROOT_PATH', $_SERVER['DOCUMENT_ROOT'].'/');
require DOC_ROOT_PATH . $this->config->item('header');
?>
</div>
<style type="text/css">
  .page-with-aside .page-aside .aside-header {
    padding: 24px 22px !important;
  }
  #schedule{
    width:130px !important;
  }

  

  .page-with-aside .page-aside .aside-nav .nav>li>a {
    font-size: 14px !important;
  }


  .mail-wrapper .mail-content .inbox-body {
    padding: 0 !important;
  }

  .mail-wrapper .mail-content .inbox-body .email-list .email-list-item .email-list-detail .msg {
    margin-bottom: 0;
    margin-top: 0 !important;
  }


</style>
<div class="container">
  <div class="page-inner">
    <div class="page-header">

    </div>
    <div class="row">
      <div class="col-md-12">
        <h3 class="fw-bold mb-3" style="margin-left:1%;">Absensi Harian</h3>
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
                <div class="aside-nav collapse" id="email-app-nav" style="border-top: 1px solid #f1f1f1 !important;">
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
                      <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target=".bd-example-modal-xl"><span class="btn-label"><i class="fa fa-plus"></i></span>
                        Tambah
                      </button>
                      <div class="btn-group">
                        <div class="aside-compose"></div>

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

                        <div class="modal fade bd-example-modal-sm editmodal" id="exampleModaledit" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" >
                          <div class="modal-dialog modal-sm" role="document">
                            <div class="modal-content">
                              <div class="card card-profile">
                                <div class="card-header" style="background-image: url('<?php echo base_url(); ?>dist/img/blogpost.jpg')">
                                  <div class="profile-picture">
                                    <div class="avatar avatar-xl">
                                      <img src="<?php echo base_url(); ?>assets/default.png" alt="..." class="avatar-img rounded-circle">
                                    </div>
                                  </div>
                                </div>
                                <div class="card-body">
                                  <div class="user-profile text-center">
                                    <input type="hidden" name="memberid_abs" id="memberid_abs">
                                    <input type="hidden" name="membername_abs" id="membername_abs">
                                    <input type="hidden" name="membertype_abs" id="membertype_abs">
                                    <input type="hidden" name="classid_abs" id="classid_abs">
                                    <input type="hidden" name="scheduleid_abs" id="scheduleid_abs">
                                    <div class="name">Nama</div>
                                    <div class="job">Zumba</div>
                                    <div class="desc">Member</div>
                                    <div class="view-profile">
                                      <a href="#" class="btn btn-secondary w-100" id="save_abssence">Absensi kehadiran</a>
                                    </div>
                                  </div>
                                </div>
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
                    <div class="email-filters">
                      <div class="chk-all">
                        <div class="btn-group">
                          <div class="form-check">
                            <label class="form-checkbox">
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="btn-group">
                        <select class="form-control input-full js-example-basic-single schedule" id="schedule" name="schedule"></select>
                      </div>
                      <div class="btn-group">
                        <input type="hidden" class="form-control" id="titlehide">
                        <input type="text" placeholder="Cari Nama..." class="form-control" id="searchname">
                        <div class="input-group-append" style="height: 1;">
                          <span class="input-group-text" style="height: 42px;">
                            <i class="fa fa-search search-icon"></i>
                          </span>
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

  new bootstrap.Modal(document.getElementById('myModal'), {backdrop: 'static', keyboard: false})  

  $(document ).ready(function() {
    var title = 'Gym';
    getdatamember(title);
    check_absence();
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

  $('#searchname').on('input', function() {
    var id = this.value;
    let name = id;
    let title = $("#titlehide").val();
    getdatamember(title, name);
    check_absence();
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
      url: "<?php echo base_url(); ?>transaction/daily_save",
      dataType: "json",
      data: {member_id:member_id, member_name:member_name, member_phone:member_phone, member_address:member_address, member_gender:member_gender, ellunainfo:ellunainfo, schedule_class_id:schedule_class_id, class_price_val:class_price_val, payment:payment},
      success : function(data){
        if (data.code == "200"){
          let title_save = 'Tambah Data';
          let message    = 'Data Berhasil Di Tambah';
          let state      = 'info';
          notif_success(title_save, message, state);
          $("#myModal").modal('hide');
          getdatamember(titles);
          check_absence();
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


  $('#save_abssence').click(function(e){
    e.preventDefault();
    var titles                = $("#titlehide").val();
    var memberid_abs          = $("#memberid_abs").val();
    var membername_abs        = $("#membername_abs").val();
    var membertype_abs        = $("#membertype_abs").val();
    var classid_abs           = $("#classid_abs").val();
    var scheduleid_abs        = $("#scheduleid_abs").val();

    $.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>transaction/save_abssence",
      dataType: "json",
      data: {memberid_abs:memberid_abs, membername_abs:membername_abs, membertype_abs:membertype_abs, classid_abs:classid_abs, scheduleid_abs:scheduleid_abs},
      success : function(data){
        if (data.code == "200"){
          let title_save  = 'Tambah Data';
          let message     = 'Absensi Berhasil';
          let state       = 'info';
          notif_success(title_save, message, state);
          $("#exampleModaledit").modal('hide');
          getdatamember(titles)
          check_absence();
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

  $('#exampleModaledit').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var memberid   = button.data('memberid')
    var membername = button.data('membername')
    var membertype = button.data('membertype')
    var classid = button.data('classid')
    var scheduleid = button.data('scheduleid')
    var modal = $(this)
    modal.find('#memberid_abs').val(memberid)
    modal.find('#membername_abs').val(membername)
    modal.find('#membertype_abs').val(membertype)
    modal.find('#classid_abs').val(classid)
    modal.find('#scheduleid_abs').val(scheduleid)
  })

  function check_absence(){
    let title = $("#titlehide").val();
    $.ajax({
      url: '<?php echo base_url(); ?>transaction/get_absence',
      type: 'POST',
      dataType: "json",
      data: {title: title},
      success: function(data) {
        for (let i = 0; i < data.result.get_absence.length; i++) {
          let member_id = data.result.get_absence[i].absence_member_id;
          let class_name = data.result.get_absence[i].class_name;
          $('#star'+member_id+class_name).prop("checked", true);
        }
      }
    });
  }

  function absence(member_id, title, type_member, schedule_class_id, ms_class_id){
    console.log(schedule_class_id);
  }

  function getdatamember(title, name=null) {
    $('#'+title+'').addClass("active");
    $.ajax({
      url: '<?php echo base_url(); ?>transaction/get_member_class',
      type: 'POST',
      dataType: "json",
      data: {title: title, name:name},
      success: function(data) {
        $('#titlemember').html('Anggota Kelas '+title);
        let text_temp = "";
        for (let i = 0; i < data.result.get_member_class.length; i++) {
          let row = data.result.get_member_class;
          var member_types = '<span class="date float-end" style="color:#f25961!important;"><i class="fas fa-users paperclip"></i> Member</span>';
          if(row[i].type_member == 'Non'){
            var member_types = '<span class="date float-end" style="color:#48abf7!important;">Daily</span>';
          } 

          text_temp += '<div class="email-list-item unread" data-bs-toggle="modal" data-bs-target="#exampleModaledit" data-memberid="'+row[i].member_id+'" data-membername="'+row[i].member_name+'" data-membertype="'+row[i].type_member+'" data-classid="'+row[i].class_id+'" data-scheduleid="'+row[i].schedule_class_id+'"><div class="email-list-actions"><div class="d-flex"><label class="form-checkbox"><span class="form-check-label"></span></label><span class="rating rating-sm me-3"><input type="checkbox" id="star'+row[i].member_id+title+'" readonly><label for="star1"><span class="fa fa-star"></span></label></span></div></div><div class="email-list-detail">'+member_types+'<span class="from">'+row[i].member_name+'</span><p class="msg">'+row[i].member_phone+'</p></div></div>';
        }
        $('#datamember').html(text_temp);
        const activeLis = document.querySelectorAll("li.active");
        activeLis.forEach(li => {
          li.classList.remove("active");
        }); 
        $('#'+title).addClass("active");
        $('#titlehide').val(title);
        check_absence();
      }
    });

    $.ajax({
      url: '<?php echo base_url(); ?>transaction/get_class_schedule',
      type: 'POST',
      dataType: "json",
      data: {class_name: title},
      success: function(data) {
        let text_temps = "";
        text_temps += '<option value="">--Semua Sesi--</option>';
        for (let i = 0; i < data.result.get_class_schedule.length; i++) {
          text_temps += '<option value="'+data.result.get_class_schedule[i].schedule_time_start+'">'+data.result.get_class_schedule[i].schedule_time_start+'</option>';
        }
        $('#schedule').html(text_temps);
      }
    });
  }
</script>