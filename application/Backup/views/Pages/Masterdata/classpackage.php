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
                <h3 class="fw-bold mb-3">Daftar Harga Paket Kelas</h3>
              </div>
              <div class="ms-md-auto py-2 py-md-0">
                <button class="btn btn-info" id="reload"><span class="btn-label"><i class="fas fa-sync"></i></span> Reload</button>
                <?php if($data['check_auth'][0]->add == 'N'){ ?>
                  <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target=".bd-example-modal-xl" disabled="disabled"><span class="btn-label"><i class="fa fa-plus"></i></span> Tambah</button>
                <?php }else{ ?>
                  <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target=".bd-example-modal-xl"><span class="btn-label"><i class="fa fa-plus"></i></span> Tambah</button>
                <?php } ?>
                <!-- pop up add promo -->
                <div class="modal fade bd-example-modal-xl" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" >
                  <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Paket Kelas</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <form name="save_class_package_form" id="save_class_package_form" enctype="multipart/form-data" action="<?php echo base_url(); ?>Masterdata/save_class_package" method="post">
                        <div class="modal-body">
                          <div class="row">
                            <div class="col-md-4 border-right">
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
                            <div class="col-md-3 border-right">
                              <div class="form-group form-inline">
                                <label for="inlineinput" class="col-md-3 col-form-label">Nama Paket</label>
                                <div class="col-md-12 p-0">
                                  <input type="text" class="form-control input-full" name="paket_name" id="paket_name" placeholder="Nama Paket">
                                </div>
                              </div>

                              <div class="form-group form-inline">
                                <label for="inlineinput" class="col-md-3 col-form-label">Harga Harian</label>
                                <div class="col-md-12 p-0">
                                  <input type="text" class="form-control input-full" name="daily_price" id="daily_price" value="0">
                                </div>
                              </div>

                              <div class="form-group form-inline">
                                <label for="inlineinput" class="col-md-3 col-form-label">Harga Bulanan</label>
                                <div class="col-md-12 p-0">
                                  <input type="text" class="form-control input-full" name="monthly_price" id="monthly_price" value="0">
                                </div>
                              </div>

                              <div class="form-group form-inline">
                                <label for="inlineinput" class="col-md-3 col-form-label">Harga Tahunan</label>
                                <div class="col-md-12 p-0">
                                  <input type="text" class="form-control input-full" name="yearly_price" id="yearly_price" value="0">
                                </div>
                              </div>

                              <div class="form-group form-inline">
                                <label for="inlineinput" class="col-md-3 col-form-label">Tipe Paket</label>
                                <div class="col-md-12 p-0">
                                  <select class="form-control input-full" name="paket_type" id="paket_type">
                                    <option value="">-- Pilih Paket --</option>
                                    <option value="Hari">Harian</option>
                                    <option value="Bulan">Bulan</option>
                                    <option value="Tahun">Tahun</option>
                                  </select>
                                </div>
                              </div>
                              <div class="form-group form-inline">
                                <label for="inlineinput" class="col-md-3 col-form-label">Masa Berlaku</label>
                                <div class="col-md-12 p-0">
                                  <input type="number" class="form-control input-full" name="paket_qty" id="paket_qty" value="0">
                                </div>
                              </div>
                            </div>

                            <div class="col-md-5 border-right">
                              <div class="form-group form-inline">
                                <div class="row">
                                  <div class="col-md-10">
                                    <label for="inlineinput" class="col-md-3 col-form-label">Kelas</label>
                                    <div class="col-md-12 p-0">
                                      <select class="form-control input-full" name="class_package_ins" id="class_package_ins">
                                        <option value="">-- Pilih Kelas --</option>
                                        <?php foreach($data['class_list'] as $row){ ?>
                                          <option value="<?php echo $row->class_id; ?>"><?php echo $row->class_name; ?></option>
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


                                <div class="row" style="margin-top:50px;">
                                  <div class="col-md-12">
                                    <div class="table-responsive">
                                      <table class="display table table-striped table-hover schedule-list" style="width: 100%;">
                                        <thead>
                                          <tr>
                                            <th>Kelas</th>
                                            <th>Aksi</th>
                                          </tr>
                                        </thead>
                                        <tbody id="class_package">
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
                          <button id="save" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <!-- end popup add promo -->
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="class-package-list" class="display table table-striped table-hover">
                <thead>
                  <tr>
                    <th>Nama Paket</th>
                    <th>Harga Harian</th>
                    <th>Harga Bulanan</th>
                    <th>Harga Tahunan</th>
                    <th>Masa Berlaku</th>
                    <th>Image</th>
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

  let daily_price = new AutoNumeric('#daily_price', {
    currencySymbol : 'Rp. ',
    decimalCharacter : ',',
    decimalPlaces: 0,
    decimalPlacesShownOnFocus: 0,
    digitGroupSeparator : '.',
  });


  let monthly_price = new AutoNumeric('#monthly_price', {
    currencySymbol : 'Rp. ',
    decimalCharacter : ',',
    decimalPlaces: 0,
    decimalPlacesShownOnFocus: 0,
    digitGroupSeparator : '.',
  });


  let yearly_price = new AutoNumeric('#yearly_price', {
    currencySymbol : 'Rp. ',
    decimalCharacter : ',',
    decimalPlaces: 0,
    decimalPlacesShownOnFocus: 0,
    digitGroupSeparator : '.',
  });




  $(document ).ready(function() {
    table_class_list();
    load_table_class();
  });

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


 

function table_class_list(){
  $('#class-package-list').DataTable({
    serverSide: true,
    search: true,
    processing: true,
    ordering: false,
    ajax: {
      url: '<?php echo base_url(); ?>Masterdata/class_package_list',
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
    {data: 6}
    ]
  });
}

$('#save_class_package_form').on('submit',(function(e) {
  e.preventDefault();
  var formData           = new FormData(this);
  var paket_name         = $("#paket_name").val();
  var daily_price_val    = daily_price.get();
  var monthly_price_val  = monthly_price.get();
  var yearly_price_val   = yearly_price.get();
  var paket_type         = $("#paket_type").val();
  var paket_qty          = $("#paket_qty").val();

  if(paket_name == ''){
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'Silahkan Isi Nama Paket',
    })
  }else if(paket_type == ''){
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'Silahakn Isi Tipe Paket',
    })
  }else if(paket_qty <= 0){
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'Silahakn Isi Masa Berlaku',
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
          let title = 'Tambah Data';
          let message = 'Data Berhasil Di Tambah';
          let state = 'info';
          notif_success(title, message, state);
          $("#myModal").modal('hide');
          $('#paket_name').val('');
          daily_price.set(0);
          monthly_price.set(0);
          yearly_price.set(0);
          $('#class-package-list').DataTable().ajax.reload();
        } 
      }
    });
  }
}));


$('#edit_member_form').on('submit',(function(e) {
  e.preventDefault();
  var formData           = new FormData(this);
  var paket_name         = $("#paket_name_edit").val();
  var daily_price_val    = daily_price_edit.get();
  var monthly_price_val  = monthly_price_edit.get();
  var yearly_price_val   = yearly_price_edit.get();
  var paket_type         = $("#paket_type_edit").val();
  var paket_qty         = $("#paket_qty_edit").val();

  if(paket_name == ''){
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'Silahkan Isi Nama Paket',
    })
  }else if(paket_type == ''){
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'Silahakn Isi Tipe Paket',
    })
  }else if(paket_qty <= 0){
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'Silahakn Isi Masa Berlaku',
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
          let title = 'Edit Data';
          let message = 'Data Berhasil Di Edit';
          let state = 'info';
          notif_success(title, message, state);
          $("#exampleModaledit").modal('hide');
          $('#paket_name_edit').val('');
          daily_price_edit.set(0);
          monthly_price_edit.set(0);
          yearly_price_edit.set(0);
          $('#class-package-list').DataTable().ajax.reload();
        } 
      }
    });
  }
}));


function delete_class_package(id)
{
  Swal.fire({
    title: 'Konfirmasi?',
    text: "Apakah Anda Yakin Menghapus Data Paket Kelas ?",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Hapus'
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>Masterdata/delete_class_package",
        dataType: "json",
        data: {id:id},
        success : function(data){
          if (data.code == "200"){
            let title = 'Hapus Paket Kelas';
            let message = 'Berhasil Hapus Paket Kelas';
            let state = 'info';
            notif_success(title, message, state);
            $('#class-package-list').DataTable().ajax.reload();
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

function load_table_class()
{
  $.ajax({
    type: "POST",
    url: "<?php echo base_url(); ?>Masterdata/get_package_class_temp",
    dataType: "json",
    data: {},
    success : function(data){
      if (data.code == "200"){
        let text = "";
        let lenght = data.result.length;
        let table_row_data = data.result;
        for (let i = 0; i < lenght; i++) {
          text += '<tr><th>'+table_row_data[i].class_name+'</th><th><button type="button" class="btn btn-icon btn-danger delete btn-sm mb-2-btn" onclick="delete_class_package_temp('+table_row_data[i].temp_class_package_class_id +')"><i class="fas fa-trash-alt sizing-fa"></i></button></th></tr>';
        }
        document.getElementById("class_package").innerHTML = text;
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



$('#btnadd_temp').on('click',(function(e) {
  e.preventDefault();
  let class_package_ins = $('#class_package_ins').val();
  $.ajax({
    type: "POST",
    url: "<?php echo base_url(); ?>Masterdata/add_class_package",
    dataType: "json",
    data: {class_package:class_package_ins},
    success : function(data){
      if (data.code == "200"){
        let title = 'Tambah Paket Kelas';
        let message = 'Berhasil Tambah Paket Kelas';
        let state = 'info';
        notif_success(title, message, state);
        load_table_class();
        $('#class_package_ins').val('');
        $('#class_package_ins').trigger('change');
      } else {
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: data.result,
        })
      }
    }
  });
}));


function delete_class_package_temp(id)
{
  $.ajax({
    type: "POST",
    url: "<?php echo base_url(); ?>Masterdata/delete_class_package_temp",
    dataType: "json",
    data: {id:id},
    success : function(data){
      if (data.code == "200"){
        let title = 'Hapus Paket Kelas';
        let message = 'Berhasil Hapus Paket Kelas';
        let state = 'info';
        notif_success(title, message, state);
        load_table_class();
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

$('#reload').click(function(e){
  e.preventDefault();
  location.reload();
});
</script>