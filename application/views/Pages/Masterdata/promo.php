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
                <h3 class="fw-bold mb-3">Daftar Promo</h3>
              </div>
              <div class="ms-md-auto py-2 py-md-0">
                <button class="btn btn-info" id="reload"><span class="btn-label"><i class="fas fa-sync"></i></span> Reload</button>
                <?php if($check_auth[0]->add == 'N'){ ?>
                  <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg" disabled="disabled"><span class="btn-label"><i class="fa fa-plus"></i></span> Tambah</button>
                <?php }else{ ?>
                  <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg"><span class="btn-label"><i class="fa fa-plus"></i></span> Tambah</button>
                <?php } ?>
                <!-- pop up add promo -->
                <div class="modal fade bd-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" >
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Promo</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>

                      <div class="modal-body">
                        <div class="row">
                          <div class="col-md-12 border-right">
                            <div class="form-group form-inline">
                              <label for="inlineinput" class="col-md-3 col-form-label">Nama Promo</label>
                              <div class="col-md-12 p-0">
                                <input type="text" class="form-control input-full" name="promo_name" id="promo_name" placeholder="Nama Promo">
                              </div>
                            </div>
                            <div class="form-group form-inline">
                              <label for="inlineinput" class="col-md-3 col-form-label">Potongan / disc</label>
                              <div class="col-md-12 p-0">
                                <input type="text" class="form-control input-full" name="promo_disc" id="promo_disc" placeholder="Potongan / disc" value="0">
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
                <!-- end popup add promo -->

                <!-- pop up edit promo -->
                <div class="modal fade bd-example-modal-lg editmodal" id="exampleModaledit" tabindex="-1" role="dialog" aria-labelledby="exampleModaleditLabel" >
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Kelas</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                          <div class="col-md-12 border-right">
                            <div class="form-group form-inline">
                              <label for="inlineinput" class="col-md-3 col-form-label">Nama Promo</label>
                              <div class="col-md-12 p-0">
                                <input type="hidden" class="form-control input-full" name="promo_id_edit" id="promo_id_edit">
                                <input type="text" class="form-control input-full" name="promo_name_edit" id="promo_name_edit" placeholder="Nama Promo">
                              </div>
                            </div>
                            <div class="form-group form-inline">
                              <label for="inlineinput" class="col-md-3 col-form-label">Potongan / disc</label>
                              <div class="col-md-12 p-0">
                                <input type="text" class="form-control input-full" name="promo_disc_edit" id="promo_disc_edit" placeholder="Potongan / disc" value="0">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Batal</button>
                        <button id="edit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- end popup edit promo -->
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="promo-list" class="display table table-striped table-hover">
                <thead>
                  <tr>
                    <th>Nama Promo</th>
                    <th>Diskon</th>
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

  

  let promo_disc = new AutoNumeric('#promo_disc', {
    suffixText: "%",
    decimalCharacter : ',',
    decimalPlaces: 0,
    decimalPlacesShownOnFocus: 0,
    digitGroupSeparator : '.',
  });

  let promo_disc_edit = new AutoNumeric('#promo_disc_edit', {
    suffixText: "%",
    decimalCharacter : ',',
    decimalPlaces: 0,
    decimalPlacesShownOnFocus: 0,
    digitGroupSeparator : '.',
  });


  $(document ).ready(function() {
    table_class_list();
  });

  function table_class_list(){
    $('#promo-list').DataTable({
      serverSide: true,
      search: true,
      processing: true,
      ordering: false,
      ajax: {
        url: '<?php echo base_url(); ?>Masterdata/promo_list',
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
    modal.find('.modal-title').text('Edit Instruktur ' + name)
    $.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>Masterdata/get_promo_id",
      dataType: "json",
      data: {id:id},
      success : function(data){
        if (data.code == "200"){
          let row = data.result.get_promo_id[0];
          modal.find('#promo_id_edit').val(row.ms_promo_id )
          modal.find('#promo_name_edit').val(row.ms_pormo_name)
          promo_disc_edit.set(row.ms_pormo_discount)
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

 

  $('#save').click(function(e){
    e.preventDefault();
    var promo_name             = $("#promo_name").val();
    var promo_disc_val         = promo_disc.get();

    $.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>Masterdata/save_promo",
      dataType: "json",
      data: {promo_name:promo_name, promo_disc_val:promo_disc_val},
      success : function(data){
        if (data.code == "200"){
          let title = 'Tambah Data';
          let message = 'Data Berhasil Di Tambah';
          let state = 'info';
          notif_success(title, message, state);
           $('#promo-list').DataTable().ajax.reload();
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