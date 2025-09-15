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
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Instruktur</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>

                      <div class="modal-body">
                        <div class="row">
                          <div class="col-md-6 border-right">
                            <div class="form-group form-inline">
                              <label for="inlineinput" class="col-md-3 col-form-label">Kode Instruktur</label>
                              <div class="col-md-12 p-0">
                                <input type="text" class="form-control input-full" id="coach_code" value="Auto" readonly>
                              </div>
                            </div>

                            <div class="form-group form-inline">
                              <label for="inlineinput" class="col-md-3 col-form-label">Nama</label>
                              <div class="col-md-12 p-0">
                                <input type="text" class="form-control input-full" id="coach_name" placeholder="Nama Instruktur">
                              </div>
                            </div>

                            <div class="form-group form-inline">
                              <label for="inlineinput" class="col-md-3 col-form-label">No Hp</label>
                              <div class="col-md-12 p-0">
                                <input type="text" class="form-control input-full" id="coach_phone" placeholder="No Hp">
                              </div>
                            </div>

                            <div class="form-group form-inline">
                              <label for="inlineinput" class="col-md-3 col-form-label">Alamat</label>
                              <div class="col-md-12 p-0">
                                <textarea class="form-control input-full" id="coach_address" rows="4"></textarea>
                              </div>
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group form-inline">
                              <label for="inlineinput" class="col-md-3 col-form-label">No KTP</label>
                              <div class="col-md-12 p-0">
                                <input type="text" class="form-control input-full" id="coach_identity" placeholder="No KTP">
                              </div>
                            </div>

                            <div class="form-group form-inline">
                              <label for="inlineinput" class="col-md-3 col-form-label">Spesialis / Title</label>
                              <div class="col-md-12 p-0">
                                <input type="text" class="form-control input-full" id="coach_title" placeholder="Spesialis / Title">
                              </div>
                            </div>

                            <div class="form-group form-inline">
                              <label for="inlineinput" class="col-md-3 col-form-label">Gaji Pokok</label>
                              <div class="col-md-12 p-0">
                                <input type="text" class="form-control input-full" id="coach_salary" placeholder="Gaji Pokok">
                              </div>
                            </div>

                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Batal</button>
                        <button type="button" id="btnsave" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- end popup add member -->

                <!-- pop up edit member -->
                <div class="modal fade bd-example-modal-lg editmodal" id="exampleModaledit" tabindex="-1" role="dialog" aria-labelledby="exampleModaleditLabel" >
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Member</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>

                      <div class="modal-body">
                        <div class="row">
                          <div class="col-md-6 border-right">
                            <div class="form-group form-inline">
                              <label for="inlineinput" class="col-md-3 col-form-label">Kode Member</label>
                              <div class="col-md-12 p-0">
                                <input type="hidden" class="form-control input-full" id="member_id_edit" readonly>
                                <input type="text" class="form-control input-full" id="member_code_edit" value="Auto" readonly>
                              </div>
                            </div>

                            <div class="form-group form-inline">
                              <label for="inlineinput" class="col-md-3 col-form-label">Nama Member</label>
                              <div class="col-md-12 p-0">
                                <input type="text" class="form-control input-full" id="member_name_edit" placeholder="Nama member">
                              </div>
                            </div>

                            <div class="form-group form-inline">
                              <label for="inlineinput" class="col-md-3 col-form-label">Tgl. Lahir</label>
                              <div class="col-md-12 p-0">
                                <input type="date" class="form-control input-full" id="member_dob_edit" >
                              </div>
                            </div>

                            <div class="form-group form-inline">
                              <label for="inlineinput" class="col-md-3 col-form-label">Jenis Kelamin</label>
                              <div class="col-md-12 p-0">
                                <select class="form-select form-control" id="member_gender_edit">
                                  <option value="Pria">Pria</option>
                                  <option value="Wanita">Wanita</option>
                                </select>
                              </div>
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group form-inline">
                              <label for="inlineinput" class="col-md-3 col-form-label">No Telp</label>
                              <div class="col-md-12 p-0">
                                <input type="text" class="form-control input-full" id="member_address_phone_edit" placeholder="No Telp">
                              </div>
                            </div>

                            <div class="form-group form-inline">
                              <label for="inlineinput" class="col-md-3 col-form-label">Email</label>
                              <div class="col-md-12 p-0">
                                <input type="text" class="form-control input-full" id="member_address_email_edit" placeholder="Email">
                              </div>
                            </div>

                            <div class="form-group form-inline">
                              <label for="inlineinput" class="col-md-3 col-form-label">Alamat</label>
                              <div class="col-md-12 p-0">
                                <textarea class="form-control" id="member_address_edit" rows="4"></textarea>
                              </div>
                            </div>

                          </div>
                        </div>
                      </div>


                      <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Batal</button>
                        <button type="button" id="btnedit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
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
              <table
              id="basic-datatables"
              class="display table table-striped table-hover"
              >
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

                <?php foreach($data['coach_list'] as $row){ ?>
                  <tr>
                    <td><?php echo $row->coach_code; ?></td>
                    <td><?php echo $row->coach_name; ?></td>
                    <td><?php echo $row->coach_phone; ?></td>
                    <td><?php echo $row->coach_address; ?></td>
                    <td><?php $date = date_create($row->coach_register);  echo date_format($date,"d-M-Y"); ?></td>
                    <td><?php echo $row->coach_title; ?></td>
                    <td>
                      <?php if($row->coach_status == 'Aktif'){
                          echo '<span class="badge badge-success">Aktif</span>'; 
                        }else if($row->coach_status == 'Non Aktif'){ 
                          echo '<span class="badge badge-danger">Tidak Aktif</span>'; 
                        }else{
                          echo '<span class="badge badge-warning">Cuti</span>'; 
                        } ?>
                    </td>
                    
                    <td>
                      <?php if($data['check_auth'][0]->view == 'N'){ ?>
                        <a href="<?php echo base_url();?>Masterdata/detailcoach?id=<?php echo $row->coach_id; ?>" data-fancybox data-type="iframe"><button type="button" class="btn btn-icon btn-primary btn-sm mb-2-btn"><i class="fas fa-eye sizing-fa" disabled="disabled"></i></button></a>
                      <?php }else{ ?> 
                        <a href="<?php echo base_url();?>Masterdata/detailcoach?id=<?php echo $row->coach_id; ?>" data-fancybox data-type="iframe"><button type="button" class="btn btn-icon btn-primary btn-sm mb-2-btn"><i class="fas fa-eye sizing-fa"></i></button></a>
                      <?php } ?>
                      <?php if($data['check_auth'][0]->delete == 'N'){ ?>
                        <button type="button" class="btn btn-icon btn-danger delete btn-sm mb-2-btn" data-id="<?php echo $row->coach_id; ?>" data-name="<?php echo $row->coach_name; ?>"><i class="fas fa-trash-alt sizing-fa" disabled="disabled"></i></button>
                      <?php }else{ ?> 
                        <button type="button" class="btn btn-icon btn-danger delete btn-sm mb-2-btn" data-id="<?php echo $row->coach_id; ?>" data-name="<?php echo $row->coach_name; ?>"><i class="fas fa-trash-alt sizing-fa"></i></button>
                      <?php } ?>
                      <?php if($data['check_auth'][0]->edit == 'N'){ ?>
                        <button type="button" class="btn btn-icon btn-warning btn-sm mb-2-btn edit" data-id="<?php echo $row->coach_id; ?>" data-name="<?php echo $row->coach_name; ?>" data-bs-toggle="modal" data-bs-target="#exampleModaledit" disabled="disabled"><i class="far fa-edit sizing-fa"></i></button>
                      <?php }else{ ?> 
                        <button type="button" class="btn btn-icon btn-warning btn-sm mb-2-btn edit" data-id="<?php echo $row->coach_id; ?>" data-name="<?php echo $row->coach_name; ?>" data-bs-toggle="modal" data-bs-target="#exampleModaledit"><i class="far fa-edit sizing-fa"></i></button>
                      <?php } ?>
                    </td>
                  </tr>
                <?php } ?>
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

  $(".delete").click(function (e) {
    var id = $(this).attr("data-id");
    var name = $(this).attr("data-name");
    Swal.fire({
      title: 'Konfirmasi?',
      text: "Apakah Anda Yakin Menghapus '"+name+"' ?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Hapus'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          type: "POST",
          url: "<?php echo base_url(); ?>Masterdata/delete_member",
          dataType: "json",
          data: {id:id},
          success : function(data){
            if (data.code == "200"){
              location.reload();
              Swal.fire('Saved!', '', 'success'); 
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
  });



  $('#btnsave').click(function(e){
    e.preventDefault();
    var coach_name              = $("#coach_name").val();
    var coach_phone             = $("#coach_phone").val();
    var coach_address           = $("#coach_address").val();
    var coach_identity          = $("#coach_identity").val();
    var coach_title             = $("#coach_title").val();
    var coach_salary            = $("#coach_salary").val();

    $.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>Masterdata/save_coach",
      dataType: "json",
      data: {coach_name:coach_name, coach_phone:coach_phone, coach_address:coach_address, coach_identity:coach_identity, coach_title:coach_title, coach_salary:coach_salary},
      success : function(data){
        if (data.code == "200"){
          window.location.href = "<?php echo base_url(); ?>Masterdata/coach";
          Swal.fire('Saved!', '', 'success');
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


  $('#btnedit').click(function(e){
    e.preventDefault();
    var member_id               = $("#member_id_edit").val();
    var member_code             = $("#member_code_edit").val();
    var member_name             = $("#member_name_edit").val();
    var member_dob              = $("#member_dob_edit").val();
    var member_gender           = $("#member_gender_edit").val();
    var member_address          = $("#member_address_edit").val();
    var member_address_phone    = $("#member_address_phone_edit").val();
    var member_address_email    = $("#member_address_email_edit").val();
  
    $.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>Masterdata/edit_member",
      dataType: "json",
      data: {member_id:member_id, member_code:member_code, member_name:member_name, member_dob:member_dob, member_gender:member_gender, member_address:member_address, member_address_phone:member_address_phone, member_address_email:member_address_email, member_dob:member_dob, member_gender:member_gender},
      success : function(data){
        if (data.code == "200"){
          window.location.href = "<?php echo base_url(); ?>Masterdata/member";
          Swal.fire('Saved!', '', 'success');
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
    var id   = button.data('id')
    var name = button.data('name')
    var modal = $(this)
    $.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>Masterdata/get_member_id",
      dataType: "json",
      data: {id:id},
      success : function(data){
        if (data.code == "200"){
          let member_data = data.result.get_member_by_id;
          for (let i = 0; i < member_data.length; i++) {
            modal.find('.modal-title').text('Edit ' + member_data[i].member_name)
            modal.find('#member_id_edit').val(member_data[i].member_id)
            modal.find('#member_code_edit').val(member_data[i].member_code)
            modal.find('#member_name_edit').val(member_data[i].member_name)
            modal.find('#member_dob_edit').val(member_data[i].member_dob)
            modal.find('#member_gender_edit').val(member_data[i].member_gender)
            modal.find('#member_address_edit').val(member_data[i].member_address)
            modal.find('#member_address_phone_edit').val(member_data[i].member_phone)
            modal.find('#member_address_email_edit').val(member_data[i].member_email)
          }
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