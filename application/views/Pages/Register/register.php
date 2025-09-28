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
                <h3 class="fw-bold mb-3">Transaksi Pendaftaran</h3>
              </div>
              <div class="ms-md-auto py-2 py-md-0">
                <button class="btn btn-info" id="reload"><span class="btn-label"><i class="fas fa-sync"></i></span> Reload</button>
                <?php if($data['check_auth'][0]->add == 'N'){ ?>
                  <button class="btn btn-primary" disabled="disabled"><span class="btn-label"><i class="fa fa-plus"></i></span> Tambah</button>
                <?php }else{ ?>
                  <a href="<?php echo base_url(); ?>Register/addregister"><button class="btn btn-primary"><span class="btn-label"><i class="fa fa-plus"></i></span> Tambah</button></a>
                <?php } ?>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="class-list" class="display table table-striped table-hover">
                <thead>
                  <tr>
                    <th>No Invoice</th>
                    <th>Nama Member</th>
                    <th>Diskon</th>
                    <th>PPN</th>
                    <th>Total</th>
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

  $(document ).ready(function() {
    table_class_list();
  });

  function table_class_list(){
    $('#register-list').DataTable({
      serverSide: true,
      search: true,
      processing: true,
      ordering: false,
      ajax: {
        url: '<?php echo base_url(); ?>Register/register_list',
        type: 'POST',
        data:  {},
      },
      columns: 
      [
      {data: 0},
      {data: 1},
      {data: 2},
      {data: 3},
      {data: 4}
      ]
    });
  }


  $('#reload').click(function(e){
    e.preventDefault();
    location.reload();
  });
</script>