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
                <h3 class="fw-bold mb-3">Daftar Kelas</h3>
              </div>
              <div class="ms-md-auto py-2 py-md-0">
                <button class="btn btn-info" id="reload"><span class="btn-label"><i class="fas fa-sync"></i></span> Reload</button>
                <?php if($data['check_auth'][0]->add == 'N'){ ?>
                  <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg" disabled="disabled"><span class="btn-label"><i class="fa fa-plus"></i></span> Tambah</button>
                <?php }else{ ?>
                  <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg"><span class="btn-label"><i class="fa fa-plus"></i></span> Tambah</button>
                <?php } ?>
                <!-- pop up add member -->
                <div class="modal fade bd-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" >
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Kelas</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>

                      <form name="save_class_form" id="save_class_form" enctype="multipart/form-data" action="<?php echo base_url(); ?>Masterdata/save_class" method="post">
                        <div class="modal-body">
                          <div class="row">
                            <div class="col-md-6 border-right">
                              <div class="form-group form-inline">
                                <div class="proof">
                                  <div class="imgArea" data-title="">
                                    <input type="file" name="screenshoot" id="screenshoot" hidden accept="image/*" />
                                    <i class="fa-solid fa-cloud-arrow-up"></i>
                                    <h4>upload screenshoot</h4>
                                    <p>image size must be less than <span>2MB</span></p>

                                  </div>
                                  <button class="selectImage" type="button">Select Image</button>
                                </div>
                              </div>
                            </div>

                            <div class="col-md-6 border-right">
                              <div class="form-group form-inline">
                                <label for="inlineinput" class="col-md-3 col-form-label">Kode Kelas</label>
                                <div class="col-md-12 p-0">
                                  <input type="text" class="form-control input-full" id="class_code" value="Auto" readonly>
                                </div>
                              </div>

                              <div class="form-group form-inline">
                                <label for="inlineinput" class="col-md-3 col-form-label">Nama Kelas</label>
                                <div class="col-md-12 p-0">
                                  <input type="text" class="form-control input-full" name="class_name" id="class_name" placeholder="Nama Kelas">
                                </div>
                              </div>

                              <div class="form-group form-inline">
                                <label for="inlineinput" class="col-md-3 col-form-label">Keterangan</label>
                                <div class="col-md-12 p-0">
                                  <textarea class="form-control" name="class_desc" id="class_desc" rows="4"></textarea>
                                </div>
                              </div>

                              <div class="form-group form-inline">
                                <label for="inlineinput" class="col-md-3 col-form-label">Harga Kelas / Hari</label>
                                <div class="col-md-12 p-0">
                                  <input type="text" class="form-control input-full" name="class_price_day" id="class_price_day" placeholder="Harga Kelas / Hari" value="0">
                                </div>
                              </div>

                              <div class="form-group form-inline">
                                <label for="inlineinput" class="col-md-3 col-form-label">Harga Kelas / Bulan</label>
                                <div class="col-md-12 p-0">
                                  <input type="text" class="form-control input-full" name="class_price" id="class_price" placeholder="Harga Kelas / Bulan" value="0">
                                </div>
                              </div>

                              

                              <div class="form-group form-inline" style="display:none;">
                                <label for="inlineinput" class="col-md-3 col-form-label">Jenis Absensi</label>
                                <div class="col-md-12 p-0">
                                  <select class="form-select form-control" id="class_attend_type" name="class_attend_type">
                                    <option value="Jam">Jam</option>
                                    <option value="Hari">Hari</option>
                                    <option value="Bulan">Bulan</option>
                                    <option value="Pertemuan">Pertemuan</option>
                                  </select>
                                </div>
                              </div>
                            </div>

                          </div>
                        </div>


                        <div class="modal-footer">
                          <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Batal</button>
                          <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <!-- end popup add member -->

                <!-- pop up edit member -->
                <div class="modal fade bd-example-modal-lg editmodal" id="exampleModaledit" tabindex="-1" role="dialog" aria-labelledby="exampleModaleditLabel" >
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Kelas</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>

                      <form name="edit_class_form" id="edit_class_form" enctype="multipart/form-data" action="<?php echo base_url(); ?>Masterdata/edit_class" method="post">
                        <div class="modal-body">
                          <div class="row">
                            <div class="col-md-6 border-right">
                              <div class="form-group form-inline">
                                <div class="proof">
                                  <div class="imgArea_edit" data-title="">
                                    <input type="file" name="screenshoot_edit" id="screenshoot_edit" hidden accept="image/*" />
                                    <i class="fa-solid fa-cloud-arrow-up"></i>
                                    <h4>upload screenshoot</h4>
                                    <p>image size must be less than <span>2MB</span></p>
                                    <div id="active-image"></div>
                                  </div>
                                  <button class="selectImage_edit" type="button">Select Image</button>
                                </div>
                              </div>
                            </div>

                            <div class="col-md-6 border-right">
                              <div class="form-group form-inline">
                                <label for="inlineinput" class="col-md-3 col-form-label">Kode Kelas</label>
                                <div class="col-md-12 p-0">
                                  <input type="hidden" class="form-control input-full" name="class_id_edit" id="class_id_edit" readonly>
                                  <input type="text" class="form-control input-full" name="class_code_edit" id="class_code_edit" value="" readonly>
                                </div>
                              </div>

                              <div class="form-group form-inline">
                                <label for="inlineinput" class="col-md-3 col-form-label">Nama Kelas</label>
                                <div class="col-md-12 p-0">
                                  <input type="text" class="form-control input-full" name="class_name_edit" id="class_name_edit" placeholder="Nama Kelas">
                                </div>
                              </div>

                              <div class="form-group form-inline">
                                <label for="inlineinput" class="col-md-3 col-form-label">Keterangan</label>
                                <div class="col-md-12 p-0">
                                  <textarea class="form-control" name="class_desc_edit" id="class_desc_edit" rows="4"></textarea>
                                </div>
                              </div>

                              <div class="form-group form-inline">
                                <label for="inlineinput" class="col-md-3 col-form-label">Harga Kelas / Hari</label>
                                <div class="col-md-12 p-0">
                                  <input type="text" class="form-control input-full" name="class_price_day_edit" id="class_price_day_edit" placeholder="Harga Kelas / Hari" value="0">
                                </div>
                              </div>

                              <div class="form-group form-inline">
                                <label for="inlineinput" class="col-md-3 col-form-label">Harga Kelas / Bulan</label>
                                <div class="col-md-12 p-0">
                                  <input type="text" class="form-control input-full" name="class_price_edit" id="class_price_edit" placeholder="Harga Kelas / Bulan" value="0">
                                </div>
                              </div>

                              <div class="form-group form-inline" style="display:none;">
                                <label for="inlineinput" class="col-md-3 col-form-label">Jenis Absensi</label>
                                <div class="col-md-12 p-0">
                                  <select class="form-select form-control" id="class_attend_type_edit" name="class_attend_type_edit">
                                    <option value="Jam">Jam</option>
                                    <option value="Hari">Hari</option>
                                    <option value="Bulan">Bulan</option>
                                    <option value="Pertemuan">Pertemuan</option>
                                  </select>
                                </div>
                              </div>
                            </div>

                          </div>
                        </div>


                        <div class="modal-footer">
                          <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Batal</button>
                          <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <!-- end popup edit member -->

                <!-- popup Schedule member -->
                <div class="modal fade bd-example-modal-xl schedule" id="exampleModalschedule" tabindex="-1" role="dialog" aria-labelledby="exampleModaleditLabel" >
                  <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Set Jadwal</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                          <div class="col-md-3 border-right">
                            <div class="form-group form-inline">
                              <label for="inlineinput" class="col-md-3 col-form-label">Kode Kelas</label>
                              <div class="col-md-12 p-0">
                                <input type="hidden" class="form-control input-full" name="class_id_schedule" id="class_id_schedule" readonly>
                                <input type="text" class="form-control input-full" name="class_code_schedule" id="class_code_schedule" value="" readonly>
                              </div>
                            </div>

                            <div class="form-group form-inline">
                              <label for="inlineinput" class="col-md-3 col-form-label">Nama Kelas</label>
                              <div class="col-md-12 p-0">
                                <input type="text" class="form-control input-full" name="class_name_schedule" id="class_name_schedule" placeholder="Nama Kelas" readonly>
                              </div>
                            </div>
                          </div>

                          <div class="col-md-9 border-right">
                            <div class="form-group form-inline">
                              <div class="row">
                                <div class="col-md-3">
                                  <label for="inlineinput" class="col-md-3 col-form-label">Hari</label>
                                  <div class="col-md-12 p-0">
                                    <select class="form-control input-full js-example-basic-single" id="schedule_day" name="schedule_day">
                                      <option value="">-- Pilih Hari --</option>
                                      <option value="Senin">Senin</option> 
                                      <option value="Selasa">Selasa</option> 
                                      <option value="Rabu">Rabu</option> 
                                      <option value="Kamis">Kamis</option> 
                                      <option value="Jumat">Jumat</option> 
                                      <option value="Sabtu">Sabtu</option> 
                                      <option value="Minggu">Minggu</option> 
                                    </select>
                                  </div>
                                </div>
                                <div class="col-md-2">
                                  <label for="inlineinput" class="col-md-3 col-form-label">Jam Mulai</label>
                                  <div class="col-md-12 p-0">
                                    <input type="time" class="form-control input-full" name="schedule_time_start" id="schedule_time_start" value="">
                                  </div>
                                </div>

                                <div class="col-md-2">
                                  <label for="inlineinput" class="col-md-3 col-form-label">Jam Selesai</label>
                                  <div class="col-md-12 p-0">
                                    <input type="time" class="form-control input-full" name="schedule_time_end" id="schedule_time_end" value="">
                                  </div>
                                </div>

                                <div class="col-md-4">
                                  <label for="inlineinput" class="col-md-3 col-form-label">Instruktur</label>
                                  <div class="col-md-12 p-0">
                                    <select class="form-control input-full js-example-basic-single" id="schedule_coach" name="schedule_coach">
                                      <option value="">-- Pilih Instruktur --</option>
                                      <?php foreach($data['coach_list'] as $row){ ?>
                                        <option value="<?php echo $row->coach_id ?>"><?php echo $row->coach_name ?></option>
                                      <?php } ?>
                                    </select>
                                  </div>
                                </div>

                                <div class="col-md-1">
                                  <div class="form-group">
                                    <button id="btnadd_temp" class="btn btn-md btn-primary rounded-circle float-right btn-add-temp" style="margin-top:40px;"><i class="fas fa-plus"></i></button>
                                  </div>
                                </div>
                              </div>


                              <div class="row border-top" style="margin-top:50px;">
                                <div class="col-md-12">
                                  <div class="table-responsive">
                                    <table class="display table table-striped table-hover schedule-list" style="width: 100%;">
                                      <thead>
                                        <tr>
                                          <th>Hari</th>
                                          <th>Jam</th>
                                          <th>Instruktur</th>
                                          <th>Aksi</th>
                                        </tr>
                                      </thead>
                                      <tbody id="schedulelistbody">

                                      </tbody>
                                    </table>

                                  </div>  
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Batal</button>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- end popup Schedule member -->
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="class-list" class="display table table-striped table-hover">
                <thead>
                  <tr>
                    <th>Kode</th>
                    <th>Nama Kelas</th>
                    <th>Keterangan</th>
                    <th>Harga / Hari</th>
                    <th>Harga / Bulan</th>
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


  new bootstrap.Modal(document.getElementById('myModal'), {backdrop: 'static', keyboard: false})  
  new bootstrap.Modal(document.getElementById('exampleModaledit'), {backdrop: 'static', keyboard: false})  

  

  let class_price = new AutoNumeric('#class_price', {
    currencySymbol : 'Rp. ',
    decimalCharacter : ',',
    decimalPlaces: 0,
    decimalPlacesShownOnFocus: 0,
    digitGroupSeparator : '.',
  });

  let class_price_edit = new AutoNumeric('#class_price_edit', {
    currencySymbol : 'Rp. ',
    decimalCharacter : ',',
    decimalPlaces: 0,
    decimalPlacesShownOnFocus: 0,
    digitGroupSeparator : '.',
  });

  let class_price_day = new AutoNumeric('#class_price_day', {
    currencySymbol : 'Rp. ',
    decimalCharacter : ',',
    decimalPlaces: 0,
    decimalPlacesShownOnFocus: 0,
    digitGroupSeparator : '.',
  });

  let class_price_day_edit = new AutoNumeric('#class_price_day_edit', {
    currencySymbol : 'Rp. ',
    decimalCharacter : ',',
    decimalPlaces: 0,
    decimalPlacesShownOnFocus: 0,
    digitGroupSeparator : '.',
  });

  $(document ).ready(function() {
    table_class_list();
  });

  function table_class_list(){
    $('#class-list').DataTable({
      serverSide: true,
      search: true,
      processing: true,
      ordering: false,
      ajax: {
        url: '<?php echo base_url(); ?>Masterdata/class_list',
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
        {data: 5}
      ]
    });
  }


  /* image uplaod */
  const fileTypes = [
    "image/apng",
    "image/bmp",
    "image/gif",
    "image/jpeg",
    "image/pjpeg",
    "image/png",
    "image/svg+xml",
    "image/tiff",
    "image/webp",
    "image/x-icon",
    "image/avif",
  ];
  function validFileType(file) {
    return fileTypes.includes(file.type);
  }

  let inputHidden = document.querySelector("#screenshoot");
  let triggerInput = document.querySelector(".selectImage");
  let imgArea = document.querySelector(".imgArea");

  triggerInput.addEventListener("click",function(){
    inputHidden.click();
  })

  inputHidden.addEventListener("change",function(e){
    let image = e.target.files[0];
    if(!validFileType(image)){
      alert("invalid file type");
      return;
    }
    if(image.size > 2097152){
      alert("image size must be less than 2MB");
      return;
    }else{
      const reader = new FileReader();
      reader.addEventListener("load",function(){
        const allImgs = document.querySelectorAll(".imgArea img");
        allImgs.forEach((img) => {
          img.remove();
        })
        const imgUrl = reader.result;
        const img = document.createElement("img");
        img.src = imgUrl;
        imgArea.appendChild(img);
        imgArea.classList.add("active");
        imgArea.dataset.title = image.name;
      })
      reader.readAsDataURL(image);
    }
  })
  /* END IMAGE UPLOAD */


  // Edit Image //

  let inputHidden_edit = document.querySelector("#screenshoot_edit");
  let triggerInput_edit = document.querySelector(".selectImage_edit");
  let imgArea_edit = document.querySelector(".imgArea_edit");

  triggerInput_edit.addEventListener("click",function(){
    inputHidden_edit.click();
  })

  inputHidden_edit.addEventListener("change",function(e){
    let image = e.target.files[0];
    if(!validFileType(image)){
      alert("invalid file type");
      return;
    }
    if(image.size > 2097152){
      alert("image size must be less than 2MB");
      return;
    }else{
      const reader = new FileReader();
      reader.addEventListener("load",function(){
        const allImgs = document.querySelectorAll(".imgArea_edit img");
        allImgs.forEach((img) => {
          img.remove();
        })
        const imgUrl = reader.result;
        const img = document.createElement("img");
        img.src = imgUrl;
        imgArea_edit.appendChild(img);
        imgArea_edit.classList.add("active");
        imgArea_edit.dataset.title = image.name;
      })
      reader.readAsDataURL(image);
    }
  })

  // End Edit Image //
  $('#exampleModaledit').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var id   = button.data('id')
    var name = button.data('name')
    var modal = $(this)
    modal.find('.modal-title').text('Edit Instruktur ' + name)
    $.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>Masterdata/get_class_id",
      dataType: "json",
      data: {id:id},
      success : function(data){

        if (data.code == "200"){
          document.getElementById("active-image").innerHTML = "";
          let row = data.result.get_class_by_id[0];

          modal.find('#class_id_edit').val(row.class_id)
          modal.find('#class_code_edit').val(row.class_code)
          modal.find('#class_name_edit').val(row.class_name)
          modal.find('#class_desc_edit').val(row.class_desc)
          class_price_day_edit.set(row.class_price_day)
          class_price_edit.set(row.class_price)
          modal.find('#class_attend_type_edit').val(row.class_attend_type)
          var elem = document.createElement("img");
          document.getElementById("active-image").appendChild(elem);
          elem.src = '<?php echo base_url(); ?>assets/class/'+row.class_image;
        } else {
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: data.result,
          })
        }
      }
    });
  }) 


  $('#exampleModalschedule').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var id   = button.data('id')
    var name = button.data('name')
    var modal = $(this)
    modal.find('.modal-title').text('Edit Jadwal ' + name)
    $.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>Masterdata/get_class_id",
      dataType: "json",
      data: {id:id},
      success : function(data){
        if (data.code == "200"){
          document.getElementById("active-image").innerHTML = "";
          let row = data.result.get_class_by_id[0];
          let table_row = data.schedule.get_class_schedule.length;
          let table_row_data = data.schedule.get_class_schedule;
          modal.find('#class_id_schedule').val(row.class_id)
          modal.find('#class_code_schedule').val(row.class_code)
          modal.find('#class_name_schedule').val(row.class_name)
          load_table_schedule(table_row, table_row_data);
        } else {
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: data.result,
          })
        }
      }
    });
  })

  function load_table_schedule(table_row, table_row_data)
  {
    let text = "";
    for (let i = 0; i < table_row; i++) {
      text += '<tr><th>'+table_row_data[i].schedule_day+'</th><th>'+convertTimeFormat(table_row_data[i].schedule_time_start)+' - '+convertTimeFormat(table_row_data[i].schedule_time_end)+'</th><th>'+table_row_data[i].coach_name+'</th><th><button type="button" class="btn btn-icon btn-danger delete btn-sm mb-2-btn" onclick="delete_schedule('+table_row_data[i].schedule_class_id +', '+table_row_data[i].class_id +')"><i class="fas fa-trash-alt sizing-fa"></i></button></th></tr>';
    }
    document.getElementById("schedulelistbody").innerHTML = text;
  }

  function delete_schedule(id, class_id)
  {
    $.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>Masterdata/delete_schedule",
      dataType: "json",
      data: {id:id, class_id:class_id},
      success : function(data){
        if (data.code == "200"){
          let title = 'Tambah Data';
          let message = 'Data Berhasil Di Hapus';
          let state = 'info';
          notif_success(title, message, state);
          let table_row = data.schedule.get_class_schedule.length;
          let table_row_data = data.schedule.get_class_schedule;
          load_table_schedule(table_row, table_row_data);
          $("#schedule_day").val("null");
          $("#schedule_time_start").val("null");
          $("#schedule_time_end").val("null");
          $("#schedule_coach").val("null");
        } else {
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: data.result,
          })
        }
      }
    });
  }

  function delete_class(id)
  {
    Swal.fire({
      title: 'Konfirmasi?',
      text: "Apakah Anda Yakin Menghapus Data Kelas ?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Hapus'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          type: "POST",
          url: "<?php echo base_url(); ?>Masterdata/delete_class",
          dataType: "json",
          data: {id:id},
          success : function(data){
            if (data.code == "200"){
              let title = 'Hapus Kelas';
              let message = 'Berhasil Hapus Kelas';
              let state = 'info';
              notif_success(title, message, state);
              $('#class-list').DataTable().ajax.reload();
            } else {
              Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: data.msg,
              })
            }
          }
        });
      }
    })
  }

  function convertTimeFormat(time) {
    const parts = time.split(':');
    return parts[0] + ':' + parts[2];
  }

  $('#save_class_form').on('submit',(function(e) {
    e.preventDefault();
    var formData              = new FormData(this);
    var class_name            = $("#class_name").val();
    var class_desc            = $("#class_desc").val();
    var class_price           = $("#class_price").val();
    var class_attend_type     = $("#class_attend_type").val();

    if(class_name == ''){
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Silahkan Isi Nama Kelas',
      })
    }else if(class_price == ''){
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Silahkan Isi Harga Kelas',
      })
    }else{
      $.ajax({
        type:'POST',
        url: $(this).attr('action'),
        data:formData,
        cache:false,
        contentType: false,
        processData: false,
        dataType: "json",
        success:function(data){     
          if(data.code == 0){
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: data.result,
            })
          }else{
            window.location.href = "<?php echo base_url(); ?>Masterdata/class";
            Swal.fire('Saved!', '', 'success');
          } 
        }
      });
    }
  }));

  $('#edit_class_form').on('submit',(function(e) {
    e.preventDefault();
    var formData              = new FormData(this);
    var class_name            = $("#class_name_edit").val();
    var class_desc            = $("#class_desc_edit").val();
    var class_price_day       = $("#class_price_day_edit").val();
    var class_price           = $("#class_price_edit").val();
    var class_attend_type     = $("#class_attend_type_edit").val();

    if(class_name == ''){
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Silahkan Isi Nama Kelas',
      })
    }else if(class_price == ''){
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Silahkan Isi Harga Kelas',
      })
    }else{
      $.ajax({
        type:'POST',
        url: $(this).attr('action'),
        data:formData,
        cache:false,
        contentType: false,
        processData: false,
        dataType: "json",
        success:function(data){     
          if(data.code == 0){
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: data.result,
            })
          }else{
            window.location.href = "<?php echo base_url(); ?>Masterdata/class";
            Swal.fire('Saved!', '', 'success');
          } 
        }
      });
    }
  }));

  $('#btnadd_temp').click(function(e){
    e.preventDefault();
    var class_id_schedule      = $("#class_id_schedule").val();
    var schedule_day           = $("#schedule_day").val();
    var schedule_time_start    = $("#schedule_time_start").val();
    var schedule_time_end      = $("#schedule_time_end").val();
    var schedule_coach         = $("#schedule_coach").val();

    $.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>Masterdata/add_schedule",
      dataType: "json",
      data: {class_id_schedule:class_id_schedule, schedule_day:schedule_day, schedule_time_start:schedule_time_start, schedule_time_end:schedule_time_end, schedule_coach:schedule_coach},
      success : function(data){
        if (data.code == "200"){
          let title = 'Tambah Data';
          let message = 'Data Berhasil Di Tambah';
          let state = 'info';
          notif_success(title, message, state);
          let table_row = data.schedule.get_class_schedule.length;
          let table_row_data = data.schedule.get_class_schedule;
          load_table_schedule(table_row, table_row_data);
          $("#schedule_day").val("null");
          $("#schedule_time_start").val("null");
          $("#schedule_time_end").val("null");
          $("#schedule_coach").val("null");
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