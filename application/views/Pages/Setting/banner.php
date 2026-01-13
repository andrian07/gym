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
                <h3 class="fw-bold mb-3">Daftar Banner</h3>
              </div>
              <div class="ms-md-auto py-2 py-md-0">
                <button class="btn btn-info" id="reload"><span class="btn-label"><i class="fas fa-sync"></i></span> Reload</button>
                <?php if($check_auth[0]->add == 'N'){ ?>
                  <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target=".bd-example-modal-md" disabled="disabled"><span class="btn-label"><i class="fa fa-plus"></i></span> Tambah</button>
                <?php }else{ ?>
                  <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target=".bd-example-modal-md"><span class="btn-label"><i class="fa fa-plus"></i></span> Tambah</button>
                <?php } ?>
                <!-- pop up add member -->
                <div class="modal fade bd-example-modal-md" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" >
                  <div class="modal-dialog modal-md">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Banner</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group form-inline">
                              <label for="inlineinput" class="col-md-3 col-form-label">Nama Banner</label>
                              <div class="col-md-12 p-0">
                                <input type="text" class="form-control input-full" name="banner_name" id="banner_name" placeholder="Nama Banner">
                              </div>
                            </div>

                            <div class="form-group form-inline">
                              <label for="inlineinput" class="col-md-3 col-form-label">Image</label>
                              <div class="col-md-12 p-0">
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
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Batal</button>
                        <button type="button" id="save" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- end popup add member -->

                <!-- pop up edit member -->
                <div class="modal fade bd-example-modal-md editmodal" id="exampleModaledit" tabindex="-1" role="dialog" aria-labelledby="exampleModaleditLabel" >
                  <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Banner</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group form-inline">
                              <label for="inlineinput" class="col-md-3 col-form-label">Nama Banner</label>
                              <div class="col-md-12 p-0">
                                <input type="hidden" class="form-control input-full" name="banner_id_edit" id="banner_id_edit" placeholder="Nama Banner">
                                <input type="text" class="form-control input-full" name="banner_name_edit" id="banner_name_edit" placeholder="Nama Banner">
                              </div>
                            </div>

                            <div class="form-group form-inline">
                              <label for="inlineinput" class="col-md-3 col-form-label">Image</label>
                              <div class="col-md-12 p-0">
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
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Batal</button>
                        <button type="button" id="edit_banner" class="btn btn-primary"><i class="fas fa-save"></i> Edit</button>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- end popup edit member -->
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="banner-list" class="display table table-striped table-hover">
                <thead>
                  <tr>
                    <th>Nama Banner</th>
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


  $(document ).ready(function() {
    table_class_list();
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

  function table_class_list(){
    $('#banner-list').DataTable({
      serverSide: true,
      search: true,
      processing: true,
      ordering: false,
      ajax: {
        url: '<?php echo base_url(); ?>Setting/banner_list',
        type: 'POST',
        data:  {},
      },
      columns: 
      [
      {data: 0},
      {data: 1},
      {data: 2}
      ]
    });
  }


  $('#exampleModaledit').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var id   = button.data('id')
    var name = button.data('name')
    var modal = $(this)
    modal.find('.modal-title').text('Edit Banner ' + name)
    $.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>Setting/get_edit_banner",
      dataType: "json",
      data: {id:id},
      success : function(data){
        if (data.code == "200"){
          document.getElementById("active-image").innerHTML = "";
          let row = data.result[0];
          console.log(row);
          modal.find('#banner_id_edit').val(row.banner_id)
          modal.find('#banner_name_edit').val(row.banner_name)
          var elem = document.createElement("img");
          document.getElementById("active-image").appendChild(elem);
          elem.src = '<?php echo base_url(); ?>assets/banner/'+row.banner_image;
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



  $('#save').click(function(e){
    e.preventDefault();
    var banner_name = $("#banner_name").val();
    var file_data    = $('#screenshoot')[0].files[0];

    if(banner_name == ''){
      Swal.fire('Oops','Nama banner wajib diisi','warning');
      return;
    }

    if(!file_data){
      Swal.fire('Oops','Image wajib di upload','warning');
      return;
    }

    var formData = new FormData();
    formData.append('banner_name', banner_name);
    formData.append('image', file_data);

    $.ajax({
      url: "<?php echo base_url(); ?>Setting/save_banner",
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function(data){
        if(data.code == 200){
          notif_success('Tambah Banner','Banner berhasil disimpan','info');
          $('#myModal').modal('hide');
          $('#banner_name').val('');
          $('#screenshoot').val('');
          $('.imgArea').removeClass('active').html('<i class="fa-solid fa-cloud-arrow-up"></i><h4>upload screenshoot</h4><p>image size must be less than <span>2MB</span></p>');
          $('#banner-list').DataTable().ajax.reload();
        }else{
          Swal.fire('Error',data.msg,'error');
        }
      }
    });
  });

  function delete_banner(id)
  {
    Swal.fire({
      title: 'Konfirmasi?',
      text: "Apakah Anda Yakin Menghapus Data Banner ?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Hapus'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          type: "POST",
          url: "<?php echo base_url(); ?>Setting/delete_banner",
          dataType: "json",
          data: {id:id},
          success : function(data){
            if (data.code == "200"){
              let title = 'Hapus Banner';
              let message = 'Berhasil Hapus Banner';
              let state = 'info';
              notif_success(title, message, state);
              $('#banner-list').DataTable().ajax.reload();
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

  $('#edit_banner').click(function(e){
    e.preventDefault();
    var banner_id   = $("#banner_id_edit").val();
    var banner_name = $("#banner_name_edit").val();
    var image_file  = $('#screenshoot_edit')[0].files[0];
    if(banner_name == ''){
      Swal.fire('Oops','Nama banner wajib diisi','warning');
      return;
    }
    var formData = new FormData();
    formData.append('banner_id', banner_id);
    formData.append('banner_name', banner_name);
    if(image_file){
      formData.append('image', image_file);
    }
    $.ajax({
      url: "<?php echo base_url(); ?>Setting/edit_banner",
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      dataType: "json",
      success : function(data){
        if (data.code == 200){
          notif_success('Edit Banner','Banner berhasil diupdate','info');
          $("#exampleModaledit").modal('hide');
          $('#banner-list').DataTable().ajax.reload();
        } else {
          Swal.fire('Error', data.msg, 'error');
        }
      }
    });
  });

  $('#reload').click(function(e){
    e.preventDefault();
    location.reload();
  });
</script>