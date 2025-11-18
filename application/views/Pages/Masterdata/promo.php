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

                            <div class="row">
                              <div class="col-md-4">
                                <div class="form-group form-inline">
                                  <label for="inlineinput" class="col-md-3 col-form-label">Include Member(GYM)</label>
                                  <div class="d-flex">
                                    <div class="form-check">
                                      <input class="form-check-input" type="radio" name="includemember" id="includemember1" value="Y">
                                      <label class="form-check-label" for="flexRadioDefault1"> Ya </label>
                                    </div>
                                    <div class="form-check">
                                      <input class="form-check-input" type="radio" name="includemember" id="includemember2" value="N" checked="">
                                      <label class="form-check-label" for="flexRadioDefault2"> Tidak </label>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-group form-inline">
                                  <label for="inlineinput" class="col-md-3 col-form-label">Paket Gym</label>
                                  <div class="col-md-12 p-0">
                                    <select class="form-control input-full" id="member_session_unit" name="member_session_unit">
                                      <option value="">-- Pilih Paket --</option>
                                      <?php foreach ($data['list_gym_package'] as $row) { ?>
                                        <option value="<?php echo $row->ms_gym_package_id ; ?>"><?php echo $row->ms_gym_package_name; ?></option>  
                                      <?php } ?>
                                    </select>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-group form-inline">
                                  <label for="inlineinput" class="col-md-3 col-form-label">Potongan / disc Member Gym</label>
                                  <div class="col-md-12 p-0">
                                    <input type="text" class="form-control input-full" name="promo_disc_member" id="promo_disc_member" value="0">
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-md-4">
                                <div class="form-group form-inline">
                                  <label for="inlineinput" class="col-md-3 col-form-label">Include PT</label>
                                  <div class="d-flex">
                                    <div class="form-check">
                                      <input class="form-check-input" type="radio" name="includept" id="includept1" value="Y">
                                      <label class="form-check-label" for="flexRadioDefault1"> Ya </label>
                                    </div>
                                    <div class="form-check">
                                      <input class="form-check-input" type="radio" name="includept" id="includept2" value="N" checked="">
                                      <label class="form-check-label" for="flexRadioDefault2"> Tidak </label>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-group form-inline">
                                  <label for="inlineinput" class="col-md-3 col-form-label">Jumlah Sesi</label>
                                  <div class="col-md-12 p-0">
                                    <select class="form-control input-full" id="pt_session_unit" name="pt_session_unit">
                                      <option value="">-- Pilih Sesi --</option>
                                      <?php foreach ($data['list_pt_package_price'] as $row) { ?>
                                        <option value="<?php echo $row->ms_pt_package_price_id ; ?>"><?php echo $row->ms_pt_package_price_name; ?></option> 
                                      <?php } ?>
                                    </select>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-group form-inline">
                                  <label for="inlineinput" class="col-md-3 col-form-label">Potongan / disc Personal Training</label>
                                  <div class="col-md-12 p-0">
                                    <input type="text" class="form-control input-full" name="promo_disc_pt" id="promo_disc_pt" value="0">
                                  </div>
                                </div>
                              </div>
                            </div>


                            <div class="row">
                              <div class="col-md-4">
                                <div class="form-group form-inline">
                                  <label for="inlineinput" class="col-md-3 col-form-label">Include Kelas</label><br>
                                  <div class="d-flex">
                                    <div class="form-check">
                                      <input class="form-check-input" type="radio" name="includekelas" id="includekelas1" value="Y">
                                      <label class="form-check-label" for="flexRadioDefault1"> Ya </label>
                                    </div>
                                    <div class="form-check">
                                      <input class="form-check-input" type="radio" name="includekelas" id="includekelas2" value="N" checked="">
                                      <label class="form-check-label" for="flexRadioDefault2"> Tidak </label>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-group form-inline">
                                  <label for="inlineinput" class="col-md-3 col-form-label">Paket Kelas</label>
                                  <div class="col-md-12 p-0">
                                    <select class="form-control input-full" id="class_session_unit" name="class_session_unit">
                                      <option value="">-- Pilih Paket --</option>
                                      <?php foreach ($data['list_class_package'] as $row) { ?>
                                        <option value="<?php echo $row->ms_class_package_id; ?>"><?php echo $row->ms_class_package_name; ?></option>  
                                      <?php } ?>
                                    </select>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-group form-inline">
                                  <label for="inlineinput" class="col-md-3 col-form-label">Potongan / disc Kelas</label>
                                  <div class="col-md-12 p-0">
                                    <input type="text" class="form-control input-full" name="promo_disc_class" id="promo_disc_class" value="0">
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="form-group form-inline" style="display: none;">
                              <label for="inlineinput" class="col-md-3 col-form-label">Kategori</label>
                              <div class="col-md-12 p-0">
                                <select class="form-control input-full" id="promo_category" name="promo_category">
                                  <option value="">-- Pilih Kategori --</option>
                                  <option value="GYM">GYM</option>
                                  <option value="Kelas">Kelas</option>
                                  <option value="GYM & Kelas">GYM & Kelas</option>
                                </select>
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
                        <h5 class="modal-title" id="exampleModalLabel">Edit Promo</h5>
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
                            <div class="row">
                              <div class="col-md-4">
                                <div class="form-group form-inline">
                                  <label for="inlineinput" class="col-md-3 col-form-label">Include Member(GYM)</label>
                                  <div class="d-flex">
                                    <div class="form-check">
                                      <input class="form-check-input" type="radio" name="includemember_edit" id="includemember1_edit" value="Y">
                                      <label class="form-check-label" for="flexRadioDefault1"> Ya </label>
                                    </div>
                                    <div class="form-check">
                                      <input class="form-check-input" type="radio" name="includemember_edit" id="includemember2_edit" value="N" checked="">
                                      <label class="form-check-label" for="flexRadioDefault2"> Tidak </label>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-group form-inline">
                                  <label for="inlineinput" class="col-md-3 col-form-label">Jumlah Bulan</label>
                                  <div class="col-md-12 p-0">
                                    <select class="form-control input-full" id="member_session_unit_edit" name="member_session_unit_edit">
                                      <option value="">-- Pilih Bulan --</option>
                                      <?php foreach ($data['list_gym_package'] as $row) { ?>
                                        <option value="<?php echo $row->ms_gym_package_id ; ?>"><?php echo $row->ms_gym_package_name; ?></option> 
                                      <?php } ?>
                                    </select>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-group form-inline">
                                  <label for="inlineinput" class="col-md-3 col-form-label">Potongan / disc Member Gym</label>
                                  <div class="col-md-12 p-0">
                                    <input type="text" class="form-control input-full" name="promo_disc_member_edit" id="promo_disc_member_edit" value="0">
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-4">
                                <div class="form-group form-inline">
                                  <label for="inlineinput" class="col-md-3 col-form-label">Include PT</label>
                                  <div class="d-flex">
                                    <div class="form-check">
                                      <input class="form-check-input" type="radio" name="includept_edit" id="includept1_edit" value="Y">
                                      <label class="form-check-label" for="flexRadioDefault1"> Ya </label>
                                    </div>
                                    <div class="form-check">
                                      <input class="form-check-input" type="radio" name="includept_edit" id="includept2_edit" value="N" checked="">
                                      <label class="form-check-label" for="flexRadioDefault2"> Tidak </label>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-group form-inline">
                                  <label for="inlineinput" class="col-md-3 col-form-label">Jumlah Sesi</label>
                                  <div class="col-md-12 p-0">
                                    <select class="form-control input-full" id="pt_session_unit_edit" name="pt_session_unit_edit">
                                      <option value="">-- Pilih Sesi --</option>
                                      <?php foreach ($data['list_pt_package_price'] as $row) { ?>
                                        <option value="<?php echo $row->ms_pt_package_price_id ; ?>"><?php echo $row->ms_pt_package_price_name; ?></option> 
                                      <?php } ?>
                                    </select>
                                  </div>
                                </div>
                              </div>

                              <div class="col-md-4">
                                <div class="form-group form-inline">
                                  <label for="inlineinput" class="col-md-3 col-form-label">Potongan / disc Personal Training</label>
                                  <div class="col-md-12 p-0">
                                    <input type="text" class="form-control input-full" name="promo_disc_pt_edit" id="promo_disc_pt_edit" value="0">
                                  </div>
                                </div>
                              </div>
                            </div>


                            <div class="row">
                              <div class="col-md-4">
                                <div class="form-group form-inline">
                                  <label for="inlineinput" class="col-md-3 col-form-label">Include Kelas</label><br>
                                  <div class="d-flex">
                                    <div class="form-check">
                                      <input class="form-check-input" type="radio" name="includekelas_edit" id="includekelas1_edit" value="Y">
                                      <label class="form-check-label" for="flexRadioDefault1"> Ya </label>
                                    </div>
                                    <div class="form-check">
                                      <input class="form-check-input" type="radio" name="includekelas_edit" id="includekelas2_edit" value="N" checked="">
                                      <label class="form-check-label" for="flexRadioDefault2"> Tidak </label>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-group form-inline">
                                  <label for="inlineinput" class="col-md-3 col-form-label">Paket Kelas</label>
                                  <div class="col-md-12 p-0">
                                    <select class="form-control input-full" id="class_session_unit_edit" name="class_session_unit_edit">
                                      <option value="">-- Pilih Paket --</option>
                                      <?php foreach ($data['list_class_package'] as $row) { ?>
                                        <option value="<?php echo $row->ms_class_package_id; ?>"><?php echo $row->ms_class_package_name; ?></option>  
                                      <?php } ?>
                                    </select>
                                  </div>
                                </div>
                              </div>

                              <div class="col-md-4">
                                <div class="form-group form-inline">
                                  <label for="inlineinput" class="col-md-3 col-form-label">Potongan / disc Kelas</label>
                                  <div class="col-md-12 p-0">
                                    <input type="text" class="form-control input-full" name="promo_disc_class_edit" id="promo_disc_class_edit" value="0">
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="form-group form-inline" style="display: none;">
                              <label for="inlineinput" class="col-md-3 col-form-label">Kategori</label>
                              <div class="col-md-12 p-0">
                                <select class="form-control input-full" id="promo_category_edit" name="promo_category_edit">
                                  <option value="">-- Pilih Kategori --</option>
                                  <option value="GYM">GYM</option>
                                  <option value="Kelas">Kelas</option>
                                  <option value="GYM & Kelas">GYM & Kelas</option>
                                </select>
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
                    <th>Include Member</th>
                    <th>Paket Gym</th>
                    <th>Include PT</th>
                    <th>Paket PT</th>
                    <th>Include Kelas</th>
                    <th>Paket Kelas</th>
                    <th>Kategori</th>
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

  let promo_disc_member = new AutoNumeric('#promo_disc_member', {
    suffixText: "%",
    decimalCharacter : ',',
    decimalPlaces: 0,
    decimalPlacesShownOnFocus: 0,
    digitGroupSeparator : '.',
  });

  let promo_disc_pt = new AutoNumeric('#promo_disc_pt', {
    suffixText: "%",
    decimalCharacter : ',',
    decimalPlaces: 0,
    decimalPlacesShownOnFocus: 0,
    digitGroupSeparator : '.',
  });

  let promo_disc_class = new AutoNumeric('#promo_disc_class', {
    suffixText: "%",
    decimalCharacter : ',',
    decimalPlaces: 0,
    decimalPlacesShownOnFocus: 0,
    digitGroupSeparator : '.',
  });

  let promo_disc_member_edit = new AutoNumeric('#promo_disc_member_edit', {
    suffixText: "%",
    decimalCharacter : ',',
    decimalPlaces: 0,
    decimalPlacesShownOnFocus: 0,
    digitGroupSeparator : '.',
  });

  let promo_disc_pt_edit = new AutoNumeric('#promo_disc_pt_edit', {
    suffixText: "%",
    decimalCharacter : ',',
    decimalPlaces: 0,
    decimalPlacesShownOnFocus: 0,
    digitGroupSeparator : '.',
  });

  let promo_disc_class_edit = new AutoNumeric('#promo_disc_class_edit', {
    suffixText: "%",
    decimalCharacter : ',',
    decimalPlaces: 0,
    decimalPlacesShownOnFocus: 0,
    digitGroupSeparator : '.',
  });


  $(document ).ready(function() {
    $('#pt_session_unit').prop('disabled', true);
    $('#class_session_unit').prop('disabled', true);
    $('#member_session_unit').prop('disabled', true);
    $('#pt_session_unit_edit').prop('disabled', true);
    $('#class_session_unit_edit').prop('disabled', true);
    $('#member_session_unit_edit').prop('disabled', true);

    $('#promo_disc_member').prop('disabled', true);
    $('#promo_disc_pt').prop('disabled', true);
    $('#promo_disc_class').prop('disabled', true);

    $('#promo_disc_member_edit').prop('disabled', true);
    $('#promo_disc_pt_edit').prop('disabled', true);
    $('#promo_disc_class_edit').prop('disabled', true);

    table_class_list();
  });



  $("input[name='includemember']").on("click",function()
  { 
    var val = this.value;
    if(val == 'Y'){
      $('#member_session_unit').prop('disabled', false);
      $('#promo_disc_member').prop('disabled', false);
    }else{
      $('#member_session_unit').prop('disabled', true);
      $("#member_session_unit").val("");
      $('#member_session_unit').trigger('change');
      $('#promo_disc_member').prop('disabled', true);
      promo_disc_member.set(0);
    }
  });

  $("input[name='includept']").on("click",function()
  { 
    var val = this.value;
    if(val == 'Y'){
      $('#pt_session_unit').prop('disabled', false);
      $('#promo_disc_pt').prop('disabled', false);
    }else{
      $('#pt_session_unit').prop('disabled', true);
      $("#pt_session_unit").val("");
      $('#pt_session_unit').trigger('change');
      $('#promo_disc_pt').prop('disabled', true);
      promo_disc_pt.set(0);
    }
  });

  $("input[name='includekelas']").on("click",function()
  { 
    var val = this.value;
    if(val == 'Y'){
      $('#class_session_unit').prop('disabled', false);
      $('#promo_disc_class').prop('disabled', false);
    }else{
      $('#class_session_unit').prop('disabled', true);
      $("#class_session_unit").val("");
      $('#class_session_unit').trigger('change');
      $('#promo_disc_class').prop('disabled', true);
      promo_disc_class.set(0);
    }
  });

  $("input[name='includemember_edit']").on("click",function()
  { 
    var val = this.value;
    if(val == 'Y'){
      $('#member_session_unit_edit').prop('disabled', false);
      $('#promo_disc_member_edit').prop('disabled', false);
    }else{
      $('#member_session_unit_edit').prop('disabled', true);
      $("#member_session_unit_edit").val("");
      $('#member_session_unit_edit').trigger('change');
      $('#promo_disc_member_edit').prop('disabled', true);
      promo_disc_member_edit.set(0);
    }
  });

  $("input[name='includept_edit']").on("click",function()
  { 
    var val = this.value;
    if(val == 'Y'){
      $('#pt_session_unit_edit').prop('disabled', false);
      $('#promo_disc_pt_edit').prop('disabled', false);
    }else{
      $('#pt_session_unit_edit').prop('disabled', true);
      $("#pt_session_unit_edit").val("");
      $('#pt_session_unit_edit').trigger('change');
      $('#promo_disc_pt_edit').prop('disabled', true);
      promo_disc_pt_edit.set(0);
    }
  });

  $("input[name='includekelas_edit']").on("click",function()
  { 
    var val = this.value;
    if(val == 'Y'){
      $('#class_session_unit_edit').prop('disabled', false);
      $('#promo_disc_class_edit').prop('disabled', false);
    }else{
      $('#class_session_unit_edit').prop('disabled', true);
      $("#class_session_unit_edit").val("");
      $('#class_session_unit_edit').trigger('change');
      $('#promo_disc_class_edit').prop('disabled', true);
      promo_disc_class_edit.set(0);
    }
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
      {data: 2},
      {data: 3},
      {data: 4},
      {data: 5},
      {data: 6},
      {data: 7},
      {data: 8}
      ]
    });
  }

  $('#exampleModaledit').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var id   = button.data('id')
    var name = button.data('name')
    var modal = $(this)
    modal.find('.modal-title').text('Edit Promo ' + name)
    $.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>Masterdata/get_promo_id",
      dataType: "json",
      data: {id:id},
      success : function(data){
        console.log(data);
        if (data.code == "200"){
          let row = data.result.get_promo_id[0];
          modal.find('#promo_id_edit').val(row.ms_promo_id)
          modal.find('#promo_name_edit').val(row.ms_pormo_name)

          if(row.ms_promo_member == 'Y'){
            modal.find('#includemember1_edit').prop("checked", true);
            modal.find('#member_session_unit_edit').prop('disabled', false);
            modal.find('#promo_disc_member_edit').prop('disabled', false);
            modal.find('#member_session_unit_edit').val(row.ms_promo_member_month)
            promo_disc_member_edit.set(row.ms_promo_member_promo);
          }
          

          if(row.ms_promo_pt == 'Y'){
            modal.find('#includept1_edit').prop("checked", true);
            modal.find('#pt_session_unit_edit').prop('disabled', false);
            modal.find('#promo_disc_pt_edit').prop('disabled', false);
            modal.find('#pt_session_unit_edit').val(row.ms_promo_pt_sesi)
            promo_disc_pt_edit.set(row.ms_promo_pt_promo);
          }

          if(row.ms_promo_class == 'Y'){
            modal.find('#includekelas1_edit').prop("checked", true);
            modal.find('#class_session_unit_edit').prop('disabled', false);
            modal.find('#promo_disc_class_edit').prop('disabled', false);
            modal.find('#class_session_unit_edit').val(row.ms_promo_class_month)
            promo_disc_class_edit.set(row.ms_promo_pt_promo);
          }
          
          modal.find('#promo_category_edit').val(row.ms_promo_category)
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


  function delete_promo(id)
  {
    Swal.fire({
      title: 'Konfirmasi?',
      text: "Apakah Anda Yakin Menghapus Data Promo ?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Hapus'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          type: "POST",
          url: "<?php echo base_url(); ?>Masterdata/delete_promo",
          dataType: "json",
          data: {id:id},
          success : function(data){
            if (data.code == "200"){
              let title = 'Hapus Promo';
              let message = 'Berhasil Hapus Promo';
              let state = 'info';
              notif_success(title, message, state);
              $('#promo-list').DataTable().ajax.reload();
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

  $('#save').click(function(e){
    e.preventDefault();
    var promo_name             = $("#promo_name").val();
    var promo_disc_val         = promo_disc.get();
    var promo_member           = $("input[name='includemember']:checked").val();
    var member_session_unit    = $("#member_session_unit").val();
    var promo_pt               = $("input[name='includept']:checked").val();
    var pt_session_unit        = $("#pt_session_unit").val();
    var promo_kelas            = $("input[name='includekelas']:checked").val();
    var class_session_unit     = $("#class_session_unit").val();
    var promo_category         = $("#promo_category").val();
    var promo_disc_member_val  = promo_disc_member.get();
    var promo_disc_pt_val      = promo_disc_pt.get();
    var promo_disc_class_val   = promo_disc_class.get();

    $.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>Masterdata/save_promo",
      dataType: "json",
      data: {promo_name:promo_name, promo_disc_val:promo_disc_val, promo_member:promo_member, member_session_unit:member_session_unit, promo_pt:promo_pt, pt_session_unit:pt_session_unit, promo_kelas:promo_kelas, class_session_unit:class_session_unit, promo_category:promo_category, promo_disc_member_val:promo_disc_member_val, promo_disc_pt_val:promo_disc_pt_val, promo_disc_class_val:promo_disc_class_val},
      success : function(data){
        if (data.code == "200"){
          let title = 'Tambah Data';
          let message = 'Data Berhasil Di Tambah';
          let state = 'info';
          notif_success(title, message, state);
          $('#promo-list').DataTable().ajax.reload();
          $("#myModal").modal("hide");
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


  $('#edit').click(function(e){
    e.preventDefault();
    var promo_id_edit          = $("#promo_id_edit").val();
    var promo_name             = $("#promo_name_edit").val();
    var promo_disc_val         = promo_disc_edit.get();
    var promo_member           = $("input[name='includemember_edit']:checked").val();
    var member_session_unit    = $("#member_session_unit_edit").val();
    var promo_pt               = $("input[name='includept_edit']:checked").val();
    var pt_session_unit        = $("#pt_session_unit_edit").val();
    var promo_kelas            = $("input[name='includekelas_edit']:checked").val();
    var class_session_unit     = $("#class_session_unit_edit").val();
    var promo_category         = $("#promo_category_edit").val();
    var promo_disc_member_val  = promo_disc_member_edit.get();
    var promo_disc_pt_val      = promo_disc_pt_edit.get();
    var promo_disc_class_val   = promo_disc_class_edit.get();

    $.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>Masterdata/edit_promo",
      dataType: "json",
      data: {promo_id_edit:promo_id_edit, promo_name:promo_name, promo_disc_val:promo_disc_val, promo_member:promo_member, member_session_unit:member_session_unit, promo_pt:promo_pt, pt_session_unit:pt_session_unit, promo_kelas:promo_kelas, class_session_unit:class_session_unit, promo_category:promo_category, promo_disc_member_val:promo_disc_member_val, promo_disc_pt_val:promo_disc_pt_val, promo_disc_class_val:promo_disc_class_val},
      success : function(data){
        if (data.code == "200"){
          let title = 'Edit Data';
          let message = 'Data Berhasil Di Edit';
          let state = 'info';
          notif_success(title, message, state);
          $('#promo-list').DataTable().ajax.reload();
          $("#exampleModaledit").modal("hide");
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