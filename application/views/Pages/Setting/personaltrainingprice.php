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
                <h3 class="fw-bold mb-3">Daftar Harga PT</h3>
              </div>
              <div class="ms-md-auto py-2 py-md-0">
                <button class="btn btn-info" id="reload"><span class="btn-label"><i class="fas fa-sync"></i></span> Reload</button>
                <?php if($data['check_auth'][0]->add == 'N'){ ?>
                  <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target=".bd-example-modal-md" disabled="disabled"><span class="btn-label"><i class="fa fa-plus"></i></span> Tambah</button>
                <?php }else{ ?>
                  <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target=".bd-example-modal-md"><span class="btn-label"><i class="fa fa-plus"></i></span> Tambah</button>
                  <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg"><span class="btn-label"><i class="fa fa-plus"></i></span> Sesi</button>
                <?php } ?>
                <!-- pop up add member -->
                <div class="modal fade bd-example-modal-lg" id="myModalsesion" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" >
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Sesi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                          <div class="col-md-5">
                            <div class="form-group form-inline">
                              <label for="inlineinput" class="col-md-3 col-form-label">Jumlah Sesi</label>
                              <div class="col-md-12 p-0">
                                <input type="hidden" class="form-control input-full" name="pt_package_id " id="pt_package_id">
                                <input type="number" class="form-control input-full" name="pt_session" id="pt_session" placeholder="Jumlah Sesi">
                              </div>
                            </div>
                          </div>
                          <div class="col-md-5">
                            <div class="form-group form-inline">
                              <label for="inlineinput" class="col-md-3 col-form-label">Masa Aktif</label>
                              <div class="col-md-12 p-0">
                                <input type="number" class="form-control input-full" name="pt_session_month" id="pt_session_month" placeholder="Masa Aktif">
                              </div>
                            </div>
                          </div>
                          <div class="col-md-2">
                            <button id="btnadd_temp" class="btn btn-md btn-primary rounded-circle float-right btn-add-temp" style="margin-top: 37px;"><i class="fas fa-plus"></i></button>
                          </div>
                          <div class="col-md-12">
                            <div class="card-body">
                              <div class="table-responsive">
                                <table id="session-list" class="display table table-striped table-hover" style="width: 100%;">
                                  <thead>
                                    <tr>
                                      <th>Jumlah Sesi</th>
                                      <th>Masa Aktif</th>
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
                      <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Batal</button>
                        <button type="button" id="save" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- end popup add member -->

                <!-- pop up add member -->
                <div class="modal fade bd-example-modal-md" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" >
                  <div class="modal-dialog modal-md">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Jenis Personal Training</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group form-inline">
                              <label for="inlineinput" class="col-md-3 col-form-label">Nama LVL PT</label>
                              <div class="col-md-12 p-0">
                                <input type="text" class="form-control input-full" name="pt_price_name" id="pt_price_name" placeholder="Nama LVL PT">
                              </div>
                            </div>

                            <div class="form-group form-inline">
                              <label for="inlineinput" class="col-md-3 col-form-label">Harga Per Sesi</label>
                              <div class="col-md-12 p-0">
                                <input type="text" class="form-control input-full" name="pt_price" id="pt_price" placeholder="Harga Per Sesi" value="0">
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
                        <h5 class="modal-title" id="exampleModalLabel">Edit Pembayaran</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group form-inline">
                              <label for="inlineinput" class="col-md-3 col-form-label">Nama LVL PT</label>
                              <div class="col-md-12 p-0">
                                <input type="hidden" class="form-control input-full" name="pt_price_id_edit" id="pt_price_id_edit">
                                <input type="text" class="form-control input-full" name="pt_price_name_edit" id="pt_price_name_edit" placeholder="Nama LVL PT">
                              </div>
                            </div>

                            <div class="form-group form-inline">
                              <label for="inlineinput" class="col-md-3 col-form-label">Harga Per Sesi</label>
                              <div class="col-md-12 p-0">
                                <input type="text" class="form-control input-full" name="pt_price_edit" id="pt_price_edit" placeholder="Harga Per Sesi" value="0">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Batal</button>
                        <button type="button" id="edit" class="btn btn-primary"><i class="fas fa-save"></i> Edit</button>
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
              <table id="pt-level-list" class="display table table-striped table-hover">
                <thead>
                  <tr>
                    <th>Nama Level PT</th>
                    <th>Harga</th>
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


  let pt_price = new AutoNumeric('#pt_price', {
    currencySymbol : 'Rp. ',
    decimalCharacter : ',',
    decimalPlaces: 0,
    decimalPlacesShownOnFocus: 0,
    digitGroupSeparator : '.',
  });

  let pt_price_edit = new AutoNumeric('#pt_price_edit', {
    currencySymbol : 'Rp. ',
    decimalCharacter : ',',
    decimalPlaces: 0,
    decimalPlacesShownOnFocus: 0,
    digitGroupSeparator : '.',
  });

  $(document ).ready(function() {
    table_class_list();
    table_session_list();
  });

  function table_class_list(){
    $('#pt-level-list').DataTable({
      serverSide: true,
      search: true,
      processing: true,
      ordering: false,
      ajax: {
        url: '<?php echo base_url(); ?>Setting/personaltrainingprice_list',
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

  function table_session_list(){
    $('#session-list').DataTable({
      serverSide: true,
      search: true,
      processing: true,
      ordering: false,
      ajax: {
        url: '<?php echo base_url(); ?>Setting/session_list',
        type: 'POST',
        data:  {},
      },
      columns: 
      [
        {data: 0},
        {data: 1},
        {data: 2},
      ]
    });
  }

  


  $('#exampleModaledit').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var id    = button.data('id')
    var name  = button.data('name')
    var price = button.data('price')
    var modal = $(this)
    modal.find('.modal-title').text('Edit Pembayaran ' + name)
    modal.find('#pt_price_id_edit').val(id)
    modal.find('#pt_price_name_edit').val(name)
    pt_price_edit.set(price);
  }) 

  $('#save').click(function(e){
    e.preventDefault();
    var pt_price_name   = $("#pt_price_name").val();
    var pt_price_val    = pt_price.get();
    $.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>Setting/save_personaltrainingprice",
      dataType: "json",
      data: {pt_price_name:pt_price_name, pt_price:pt_price_val},
      success : function(data){
        if (data.code == "200"){
          let title = 'Tambah Data';
          let message = 'Data Berhasil Di Tambah';
          let state = 'info';
          notif_success(title, message, state);
          $("#myModal").modal('hide');
          $('#pt_price_name').val('');
          pt_price.set(0  );
          $('#pt-level-list').DataTable().ajax.reload();
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

  function delete_personaltrainingprice(id)
  {
    Swal.fire({
      title: 'Konfirmasi?',
      text: "Apakah Anda Yakin Menghapus Data ?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Hapus'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          type: "POST",
          url: "<?php echo base_url(); ?>Setting/delete_personaltrainingprice",
          dataType: "json",
          data: {id:id},
          success : function(data){
            if (data.code == "200"){
              let title = 'Hapus Jenis PT';
              let message = 'Berhasil Hapus Jenis PT';
              let state = 'info';
              notif_success(title, message, state);
              $('#pt-level-list').DataTable().ajax.reload();
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


  $('#edit').click(function(e){
    e.preventDefault();
    var pt_price_id     = $("#pt_price_id_edit").val();
    var pt_price_name   = $("#pt_price_name_edit").val();
    var pt_price_val    = pt_price_edit.get();
    $.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>Setting/edit_personaltrainingprice",
      dataType: "json",
      data: {pt_price_id:pt_price_id, pt_price_name:pt_price_name, pt_price_val:pt_price_val},
      success : function(data){
        if (data.code == "200"){
          let title = 'Tambah Data';
          let message = 'Data Berhasil Di Edit';
          let state = 'info';
          notif_success(title, message, state);
          $("#exampleModaledit").modal('hide');
          $('#pt-level-list').DataTable().ajax.reload();
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

  $('#btnadd_temp').click(function(e){
    e.preventDefault();
    var pt_package_id     = $("#pt_package_id").val();
    var pt_session        = $("#pt_session").val();
    var pt_session_month  = $("#pt_session_month").val();
    $.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>Setting/save_session",
      dataType: "json",
      data: {pt_package_id:pt_package_id, pt_session:pt_session, pt_session_month:pt_session_month},
      success : function(data){
        if (data.code == "200"){
          let title = 'Tambah Data';
          let message = 'Data Berhasil Di Edit / Tambah';
          let state = 'info';
          notif_success(title, message, state);
          //$("#myModalsesion").modal('hide');
          
          $("#pt_package_id").val('');
          $("#pt_session").val('');
          $("#pt_session_month").val('');
          
          $('#session-list').DataTable().ajax.reload();
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
  

  function edit_sesion(id, session, month)
  {
    $("#pt_package_id").val(id);
    $("#pt_session").val(session);
    $("#pt_session_month").val(month);
  }
  

  $('#reload').click(function(e){
    e.preventDefault();
    location.reload();
  });
</script>