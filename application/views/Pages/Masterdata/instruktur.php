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
                <h3 class="fw-bold mb-3">Daftar Instruktur</h3>
              </div>
              <div class="ms-md-auto py-2 py-md-0">
                <button class="btn btn-info" id="reload"><span class="btn-label"><i class="fas fa-sync"></i></span> Reload</button>
                <?php if($check_auth[0]->add == 'N'){ ?>
                  <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target=".bd-example-modal-xl" disabled="disabled"><span class="btn-label"><i class="fa fa-plus"></i></span> Tambah</button>
                <?php }else{ ?>
                 <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target=".bd-example-modal-xl"><span class="btn-label"><i class="fa fa-plus"></i></span> Tambah</button>
               <?php } ?>
               
               <div class="modal fade bd-example-modal-xl" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" >
                <div class="modal-dialog modal-xl">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Tambah Instruktur</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form name="save_coach_form" id="save_coach_form" enctype="multipart/form-data" action="<?php echo base_url(); ?>Masterdata/save_coach" method="post">
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
                          <div class="col-md-4">
                            <div class="form-group form-inline">
                              <label for="inlineinput" class="col-md-3 col-form-label">Kode Instruktur</label>
                              <div class="col-md-12 p-0">
                                <input type="text" class="form-control input-full" name="coach_code" id="coach_code" placeholder="Kode Instruktur">
                                <input type="hidden" class="form-control input-full" name="coach_type" id="coach_type" value="Instruktur">
                              </div>
                            </div>

                            <div class="form-group form-inline">
                              <label for="inlineinput" class="col-md-3 col-form-label">Nama</label>
                              <div class="col-md-12 p-0">
                                <input type="text" class="form-control input-full" name="coach_name" id="coach_name" placeholder="Nama Instruktur">
                              </div>
                            </div>

                            <div class="form-group form-inline">
                              <label for="inlineinput" class="col-md-3 col-form-label">No HP</label>
                              <div class="col-md-12 p-0">
                                <input type="text" class="form-control input-full" name="coach_phone" id="coach_phone" placeholder="No HP">
                              </div>
                            </div>

                            <div class="form-group form-inline">
                              <label for="inlineinput" class="col-md-3 col-form-label">Email</label>
                              <div class="col-md-12 p-0">
                                <input type="text" class="form-control input-full" name="coach_email" id="coach_email" placeholder="Email">
                              </div>
                            </div>

                            <div class="form-group form-inline">
                              <label for="inlineinput" class="col-md-3 col-form-label">Nik</label>
                              <div class="col-md-12 p-0">
                                <input type="text" class="form-control input-full" name="coach_identity" id="coach_identity" placeholder="NIK">
                              </div>
                            </div>

                            <div class="form-group form-inline">
                              <label for="inlineinput" class="col-md-3 col-form-label">Tgl Lahir</label>
                              <div class="col-md-12 p-0">
                                <input type="date" class="form-control input-full" name="coach_dob" id="coach_dob">
                              </div>
                            </div>

                          </div>
                          <div class="col-md-4">

                            <div class="form-group form-inline">
                              <label for="inlineinput" class="col-md-3 col-form-label">Jenis Kelamin</label>
                              <div class="col-md-12 p-0">
                                <select class="form-select form-control" id="coach_gender" name="coach_gender">
                                  <option value="Pria">Pria</option>
                                  <option value="Wanita">Wanita</option>
                                </select>
                              </div>
                            </div>
                            
                            <div class="form-group form-inline">
                              <label for="inlineinput" class="col-md-3 col-form-label">Alamat</label>
                              <div class="col-md-12 p-0">
                                <textarea class="form-control" id="coach_address" name="coach_address" rows="5"></textarea>
                              </div>
                            </div>

                            <div class="form-group form-inline">
                              <label for="inlineinput" class="col-md-3 col-form-label">Spesialist</label>
                              <div class="col-md-12 p-0">
                                <input type="text" class="form-control input-full" name="coach_title" id="coach_title" placeholder="Spesialist">
                              </div>
                            </div>

                            <div class="form-group form-inline">
                              <label for="inlineinput" class="col-md-3 col-form-label">Fee / Sesi</label>
                              <div class="col-md-12 p-0">
                                <input type="text" class="form-control input-full" name="coach_salary" id="coach_salary" placeholder=">Fee / Sesi" value="0">
                                <input type="hidden" class="form-control input-full" name="coach_extra_charge" id="coach_extra_charge" placeholder="Extra Charge" value="0">
                              </div>
                            </div>

                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Batal</button>
                        <button type="submit" class="btn btn-primary" ><i class="fas fa-save"></i> Simpan</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>

              <div class="modal fade bd-example-modal-xl editmodal" id="exampleModaledit" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" >
                <div class="modal-dialog modal-xl" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModaledit">Edit Instruktur</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form name="edit_coach_form" id="edit_coach_form" enctype="multipart/form-data" action="<?php echo base_url(); ?>Masterdata/edit_coach" method="post">
                      <div class="modal-body">
                        <div class="row">
                          <div class="col-md-4 border-right">
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
                          <div class="col-md-4">
                            <div class="form-group form-inline">
                              <label for="inlineinput" class="col-md-3 col-form-label">Kode Instruktur</label>
                              <div class="col-md-12 p-0">
                                <input type="hidden" class="form-control input-full" name="coach_id_edit" id="coach_id_edit">
                                <input type="text" class="form-control input-full" name="coach_code_edit" id="coach_code_edit" value="Auto" readonly>
                              </div>
                            </div>

                            <div class="form-group form-inline">
                              <label for="inlineinput" class="col-md-3 col-form-label">Nama</label>
                              <div class="col-md-12 p-0">
                                <input type="text" class="form-control input-full" name="coach_name_edit" id="coach_name_edit" placeholder="Nama Member">
                              </div>
                            </div>

                            <div class="form-group form-inline">
                              <label for="inlineinput" class="col-md-3 col-form-label">No HP</label>
                              <div class="col-md-12 p-0">
                                <input type="text" class="form-control input-full" name="coach_phone_edit" id="coach_phone_edit" placeholder="No HP">
                              </div>
                            </div>

                            <div class="form-group form-inline">
                              <label for="inlineinput" class="col-md-3 col-form-label">Email</label>
                              <div class="col-md-12 p-0">
                                <input type="text" class="form-control input-full" name="coach_email_edit" id="coach_email_edit" placeholder="Email">
                              </div>
                            </div>

                            <div class="form-group form-inline">
                              <label for="inlineinput" class="col-md-3 col-form-label">Nik</label>
                              <div class="col-md-12 p-0">
                                <input type="text" class="form-control input-full" name="coach_identity_edit" id="coach_identity_edit" placeholder="NIK">
                              </div>
                            </div>

                            <div class="form-group form-inline">
                              <label for="inlineinput" class="col-md-3 col-form-label">Tgl Lahir</label>
                              <div class="col-md-12 p-0">
                                <input type="date" class="form-control input-full" name="coach_dob_edit" id="coach_dob_edit">
                              </div>
                            </div>

                          </div>
                          <div class="col-md-4">

                            <div class="form-group form-inline">
                              <label for="inlineinput" class="col-md-3 col-form-label">Jenis Kelamin</label>
                              <div class="col-md-12 p-0">
                                <select class="form-select form-control" id="coach_gender_edit" name="coach_gender_edit">
                                  <option value="Pria">Pria</option>
                                  <option value="Wanita">Wanita</option>
                                </select>
                              </div>
                            </div>
                            
                            <div class="form-group form-inline">
                              <label for="inlineinput" class="col-md-3 col-form-label">Alamat</label>
                              <div class="col-md-12 p-0">
                                <textarea class="form-control" id="coach_address_edit" name="coach_address_edit" rows="5"></textarea>
                              </div>
                            </div>

                            <div class="form-group form-inline">
                              <label for="inlineinput" class="col-md-3 col-form-label">Spesialist</label>
                              <div class="col-md-12 p-0">
                                <input type="text" class="form-control input-full" name="coach_title_edit" id="coach_title_edit" placeholder="NIK">
                              </div>
                            </div>

                            <div class="form-group form-inline">
                              <label for="inlineinput" class="col-md-3 col-form-label">Fee / Sesi</label>
                              <div class="col-md-12 p-0">
                                <input type="text" class="form-control input-full" name="coach_salary_edit" id="coach_salary_edit" placeholder="Fee / Sesi">
                                <input type="hidden" class="form-control input-full" name="coach_extra_charge_edit" id="coach_extra_charge_edit" placeholder="Extra Charge">
                              </div>
                            </div>

                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Batal</button>
                          <button type="submit" class="btn btn-primary" ><i class="fas fa-save"></i> Simpan</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table id="coach-list" class="display table table-striped table-hover">
             <thead>
              <tr>
                <th>Kode</th>
                <th>Nama</th>
                <th>Telp</th>
                <th>Alamat</th>
                <th>Join</th>
                <th>Spesialis</th>
                <th>Status</th>
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
  

  let coach_salary = new AutoNumeric('#coach_salary', {
    currencySymbol : 'Rp. ',
    decimalCharacter : ',',
    decimalPlaces: 0,
    decimalPlacesShownOnFocus: 0,
    digitGroupSeparator : '.',
  });

  let coach_extra_charge = new AutoNumeric('#coach_extra_charge', {
    currencySymbol : 'Rp. ',
    decimalCharacter : ',',
    decimalPlaces: 0,
    decimalPlacesShownOnFocus: 0,
    digitGroupSeparator : '.',
  });

  let coach_salary_edit = new AutoNumeric('#coach_salary_edit', {
    currencySymbol : 'Rp. ',
    decimalCharacter : ',',
    decimalPlaces: 0,
    decimalPlacesShownOnFocus: 0,
    digitGroupSeparator : '.',
  });

  let coach_extra_charge_edit = new AutoNumeric('#coach_extra_charge_edit', {
    currencySymbol : 'Rp. ',
    decimalCharacter : ',',
    decimalPlaces: 0,
    decimalPlacesShownOnFocus: 0,
    digitGroupSeparator : '.',
  });

  $(document ).ready(function() {
    table_coach_list();
  });

  function table_coach_list(){
    $('#coach-list').DataTable({
      serverSide: true,
      search: true,
      processing: true,
      ordering: false,
      ajax: {
        url: '<?php echo base_url(); ?>Masterdata/coach_list',
        type: 'POST',
        data:  {type:'Instruktur'},
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
        {data: 7}
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

  $('#edit_coach_form').on('submit',(function(e) {
    e.preventDefault();
    var formData              = new FormData(this);
    var coach_name            = $("#coach_name_edit").val();
    var coach_phone           = $("#coach_phone_edit").val();
    var coach_email           = $("#coach_email_edit").val();
    var coach_identity        = $("#coach_identity_edit").val();
    var coach_dob             = $("#coach_dob_edit").val();
    var coach_gender          = $("#coach_gender_edit").val();
    var coach_address         = $("#coach_address_edit").val();
    var coach_title           = $("#coach_title_edit").val();
    var coach_salary          = $("#coach_salary_edit").val();
    var coach_extra_charge    = $("#coach_extra_charge_edit").val();

    if(coach_name == ''){
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Silahkan Isi Nama Instruktur',
      })
    }else if(coach_phone == ''){
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Silahkan Isi No HP',
      })
    }else if(coach_email == ''){
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Silahkan Isi Email',
      })
    }else if(coach_identity == ''){
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Silahkan Isi NIK',
      })
    }else if(coach_dob == ''){
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Silahkan Isi Tanggal Lahir',
      })
    }else if(coach_address == ''){
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Silahkan Isi Alamat',
      })
    }else if(coach_salary == ''){
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Silahkan Isi Gaji Pokok',
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
            window.location.href = "<?php echo base_url(); ?>Masterdata/instruktur";
            Swal.fire('Saved!', '', 'success');
          } 
        }
      });
    }
  }));

  $('#save_coach_form').on('submit',(function(e) {
    e.preventDefault();
    var formData              = new FormData(this);
    var coach_name            = $("#coach_name").val();
    var coach_phone           = $("#coach_phone").val();
    var coach_email           = $("#coach_email").val();
    var coach_identity        = $("#coach_identity").val();
    var coach_dob             = $("#coach_dob").val();
    var coach_gender          = $("#coach_gender").val();
    var coach_address         = $("#coach_address").val();
    var coach_title           = $("#coach_title").val();
    var coach_salary          = $("#coach_salary").val();
    var coach_extra_charge    = $("#coach_extra_charge").val();

    if(coach_name == ''){
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Silahkan Isi Nama Instruktur',
      })
    }else if(coach_phone == ''){
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Silahkan Isi No HP',
      })
    }else if(coach_email == ''){
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Silahkan Isi Email',
      })
    }else if(coach_identity == ''){
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Silahkan Isi NIK',
      })
    }else if(coach_dob == ''){
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Silahkan Isi Tanggal Lahir',
      })
    }else if(coach_address == ''){
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Silahkan Isi Alamat',
      })
    }else if(coach_salary == ''){
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Silahkan Isi Gaji Pokok',
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
            window.location.href = "<?php echo base_url(); ?>Masterdata/instruktur";
            Swal.fire('Saved!', '', 'success');
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
    modal.find('.modal-title').text('Edit Instruktur ' + name)
    $.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>Masterdata/get_edit_coach",
      dataType: "json",
      data: {id:id},
      success : function(data){
        if (data.code == "200"){
          document.getElementById("active-image").innerHTML = "";
          let row = data.result[0];
          modal.find('#coach_id_edit').val(row.coach_id)
          modal.find('#coach_code_edit').val(row.coach_code)
          modal.find('#coach_name_edit').val(row.coach_name)
          modal.find('#coach_phone_edit').val(row.coach_phone)
          modal.find('#coach_email_edit').val(row.coach_email)
          modal.find('#coach_identity_edit').val(row.coach_identity)
          modal.find('#coach_dob_edit').val(row.coach_dob)
          modal.find('#coach_gender_edit').val(row.coach_gender)
          modal.find('#coach_address_edit').val(row.coach_address)
          modal.find('#coach_title_edit').val(row.coach_title)
          coach_salary_edit.set(row.coach_salary);
          coach_extra_charge_edit.set(row.coach_extra_charge)
          var elem = document.createElement("img");
          document.getElementById("active-image").appendChild(elem);
          elem.src = '<?php echo base_url(); ?>assets/coach/'+row.coach_image;
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


  $('#reload').click(function(e){
    e.preventDefault();
    location.reload();
  });

</script>