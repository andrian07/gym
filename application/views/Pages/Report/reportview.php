<?php 
define('DOC_ROOT_PATH', $_SERVER['DOCUMENT_ROOT'].'/');
require DOC_ROOT_PATH . $this->config->item('header');
?>
</div>

<div class="container">
  <div class="page-inner">
    <div
    class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4"
    >
    <div>
      <h3 class="fw-bold mb-3">Laporan</h3>
    </div>
    <div class="ms-md-auto py-2 py-md-0">

    </div>
  </div>
  <div class="row">
    <div class="col-md-4">
      <div class="card">
        <div class="card-header">
          <div class="card-head-row card-tools-still-right">
            <div class="card-title"><h4 class="text-info fw-bold">Laporan</h4></div>
          </div>
        </div>
        <ul class="list-group list-group-bordered">
          <a href=""><li class="list-group-item">Laporan Member</li></a>
          <li class="list-group-item">Laporan Kelas</li>
          <li class="list-group-item">Laporan Pendaftaran Member</li>
        </ul>
      </div>
    </div>
  </div>
</div>


</div>
</div>
<?php 
require DOC_ROOT_PATH . $this->config->item('footer');
?>
