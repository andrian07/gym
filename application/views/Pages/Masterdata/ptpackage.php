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
                <h3 class="fw-bold mb-3">Daftar Harga Paket Personal Training</h3>
              </div>
              <div class="ms-md-auto py-2 py-md-0">
                <button class="btn btn-info" id="reload"><span class="btn-label"><i class="fas fa-sync"></i></span> Reload</button>
                <?php if($data['check_auth'][0]->add == 'N'){ ?>
                  <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg" disabled="disabled"><span class="btn-label"><i class="fa fa-plus"></i></span> Tambah</button>
                <?php }else{ ?>
                  <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg"><span class="btn-label"><i class="fa fa-plus"></i></span> Tambah</button>
                <?php } ?>
                <!-- pop up add promo -->
                <div class="modal fade bd-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" >
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Paket PT</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <form name="save_member_form" id="save_member_form" enctype="multipart/form-data" action="<?php echo base_url(); ?>Masterdata/save_pt_package" method="post">
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
                            <div class="col-md-6">
                              <div class="form-group form-inline">
                                <label for="inlineinput" class="col-md-3 col-form-label">Nama Paket</label>
                                <div class="col-md-12 p-0">
                                  <input type="text" class="form-control input-full" name="paket_name" id="paket_name" placeholder="Nama Paket">
                                </div>
                              </div>

                              <div class="form-group form-inline">
                                <label for="inlineinput" class="col-md-3 col-form-label">Jumlah Sesi</label>
                                <div class="col-md-12 p-0">
                                  <select class="form-control input-full" name="paket_session" id="paket_session">
                                    <option value="">-- Pilih Sesi --</option>
                                    <?php foreach($data['pt_package'] as $row){ ?>
                                      <option value="<?php echo $row->ms_pt_package_id ;?>"><?php echo $row->ms_pt_package_session ;?></option>
                                    <?php } ?>
                                  </select>
                                </div>
                              </div>

                              <div class="form-group form-inline">
                                <label for="inlineinput" class="col-md-3 col-form-label">LVL</label>
                                <div class="col-md-12 p-0">
                                  <select class="form-control input-full" name="paket_lvl" id="paket_lvl">
                                    <option value="">-- Pilih LVL --</option>
                                    <?php foreach($data['pt_price'] as $row){ ?>
                                      <option value="<?php echo $row->ms_pt_price_id ;?>"><?php echo $row->ms_pt_price_name ;?></option>
                                    <?php } ?>
                                  </select>
                                </div>
                              </div>

                              <div class="form-group form-inline">
                                <label for="inlineinput" class="col-md-3 col-form-label">Harga</label>
                                <div class="col-md-12 p-0">
                                  <input type="text" class="form-control input-full" name="price" id="price" value="0">
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

                <!-- pop up edit promo -->
                <div class="modal fade bd-example-modal-lg editmodal" id="exampleModaledit" tabindex="-1" role="dialog" aria-labelledby="exampleModaleditLabel" >
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Paket PT</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <form name="edit_member_form" id="edit_member_form" enctype="multipart/form-data" action="<?php echo base_url(); ?>Masterdata/edit_pt_package" method="post">
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
                            <div class="col-md-6">
                              <div class="form-group form-inline">
                                <label for="inlineinput" class="col-md-3 col-form-label">Nama Paket</label>
                                <div class="col-md-12 p-0">
                                  <input type="hidden" class="form-control input-full" name="paket_id_edit" id="paket_id_edit" placeholder="Nama Paket">
                                  <input type="text" class="form-control input-full" name="paket_name_edit" id="paket_name_edit" placeholder="Nama Paket">
                                </div>
                              </div>

                              <div class="form-group form-inline">
                                <label for="inlineinput" class="col-md-3 col-form-label">Jumlah Sesi</label>
                                <div class="col-md-12 p-0">
                                  <select class="form-control input-full" name="paket_session_edit" id="paket_session_edit">
                                    <option value="">-- Pilih Sesi --</option>
                                    <?php foreach($data['pt_package'] as $row){ ?>
                                      <option value="<?php echo $row->ms_pt_package_id ;?>"><?php echo $row->ms_pt_package_session ;?></option>
                                    <?php } ?>
                                  </select>
                                </div>
                              </div>

                              <div class="form-group form-inline">
                                <label for="inlineinput" class="col-md-3 col-form-label">LVL</label>
                                <div class="col-md-12 p-0">
                                  <select class="form-control input-full" name="paket_lvl_edit" id="paket_lvl_edit">
                                    <option value="">-- Pilih LVL --</option>
                                    <?php foreach($data['pt_price'] as $row){ ?>
                                      <option value="<?php echo $row->ms_pt_price_id ;?>"><?php echo $row->ms_pt_price_name ;?></option>
                                    <?php } ?>
                                  </select>
                                </div>
                              </div>

                              
                              <div class="form-group form-inline">
                                <label for="inlineinput" class="col-md-3 col-form-label">Harga</label>
                                <div class="col-md-12 p-0">
                                  <input type="text" class="form-control input-full" name="price_edit" id="price_edit" value="0">
                                </div>
                              </div>

                            </div>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Batal</button>
                          <button id="edit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <!-- end popup edit promo -->
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="pt-package-list" class="display table table-striped table-hover">
                <thead>
                  <tr>
                    <th>Nama Paket</th>
                    <th>Jumlah Sesi</th>
                    <th>Lvl PT</th>
                    <th>Harga</th>
                    <th>Additional</th>
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
  new bootstrap.Modal(document.getElementById('exampleModaledit'), {backdrop: 'static', keyboard: false})  

  let price = new AutoNumeric('#price', {
    currencySymbol : 'Rp. ',
    decimalCharacter : ',',
    decimalPlaces: 0,
    decimalPlacesShownOnFocus: 0,
    digitGroupSeparator : '.',
  });

  let price_edit = new AutoNumeric('#price_edit', {
    currencySymbol : 'Rp. ',
    decimalCharacter : ',',
    decimalPlaces: 0,
    decimalPlacesShownOnFocus: 0,
    digitGroupSeparator : '.',
  });

  $(document ).ready(function() {
    table_pt_package_list();
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

function table_pt_package_list(){
  $('#pt-package-list').DataTable({
    serverSide: true,
    search: true,
    processing: true,
    ordering: false,
    ajax: {
      url: '<?php echo base_url(); ?>Masterdata/pt_package_list',
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

$('#save_member_form').on('submit',(function(e) {
  e.preventDefault();
  var formData           = new FormData(this);
  var paket_name         = $("#paket_name").val();
  var paket_session      = $("#paket_session").val();
  var paket_lvl          = $("#paket_lvl").val();
  var price_val          = price.get();

  if(paket_name == ''){
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'Silahkan Isi Nama Paket',
    })
  }else if(paket_session == ''){
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'Silahakn Isi Sesi',
    })
  }else if(paket_lvl == ''){
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'Silahakn Isi LVL',
    })
  }else if(price_val <= 0){
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'Silahakn Isi Harga',
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
          $('#paket_session').val('');
          $('#paket_session').trigger('change');
          $('#paket_lvl').val('');
          $('#paket_lvl').trigger('change');
          price.set(0);
          $('#pt-package-list').DataTable().ajax.reload();
        } 
      }
    });
  }
}));

$('#exampleModaledit').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var id   = button.data('id')
    var name = button.data('name')
    var modal = $(this)
    modal.find('.modal-title').text('Edit Member ' + name)
    $.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>Masterdata/get_edit_pt_package",
      dataType: "json",
      data: {id:id},
      success : function(data){
        if (data.code == "200"){
          document.getElementById("active-image").innerHTML = "";
          let row = data.result[0];
          modal.find('#paket_id_edit').val(row.ms_pt_package_price_id)
          modal.find('#paket_name_edit').val(row.ms_pt_package_price_name)
          modal.find('#paket_session_edit').val(row.ms_pt_package_id)
          $('#paket_session_edit').trigger('change');
          modal.find('#paket_lvl_edit').val(row.ms_pt_price_id)
          $('#paket_lvl_edit').trigger('change');
          price_edit.set(row.ms_pt_package_price)
          var elem = document.createElement("img");
          document.getElementById("active-image").appendChild(elem);
          elem.src = '<?php echo base_url(); ?>assets/pt/'+row.ms_pt_package_image;
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

$('#edit_member_form').on('submit',(function(e) {
  e.preventDefault();
  var formData           = new FormData(this);
  var paket_name         = $("#paket_name_edit").val();
  var paket_session      = $("#paket_session_edit").val();
  var paket_lvl          = $("#paket_lvl_edit").val();
  var price_val          = price_edit.get();

  if(paket_name == ''){
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'Silahkan Isi Nama Paket',
    })
  }else if(paket_session == ''){
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'Silahakn Isi Sesi',
    })
  }else if(paket_lvl == ''){
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'Silahakn Isi LVL',
    })
  }else if(price_val <= 0){
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'Silahakn Isi Harga',
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
          $('#paket_session_edit').val('');
          $('#paket_session_edit').trigger('change');
          $('#paket_lvl_edit').val('');
          $('#paket_lvl_edit').trigger('change');
          price_edit.set(0);
          $('#pt-package-list').DataTable().ajax.reload();
        } 
      }
    });
  }
}));


function delete_pt_package(id)
{
  Swal.fire({
    title: 'Konfirmasi?',
    text: "Apakah Anda Yakin Menghapus Data Paket PT ?",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Hapus'
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>Masterdata/delete_pt_package",
        dataType: "json",
        data: {id:id},
        success : function(data){
          if (data.code == "200"){
            let title = 'Hapus Paket PT';
            let message = 'Berhasil Hapus Paket PT';
            let state = 'info';
            notif_success(title, message, state);
            $('#pt-package-list').DataTable().ajax.reload();
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

$('#reload').click(function(e){
  e.preventDefault();
  location.reload();
});
</script>