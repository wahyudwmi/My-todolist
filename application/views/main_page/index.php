<div class="container">
          <div class="card mt-4 text-center bg-dark text-white border border-secondary">
                    <div class="card-header border-bottom border-secondary">
                              To Do List
                    </div>
                    <div class="card-body ">
                              <h5 class="card-title">Jadwalkan Kegiatan Mu</h5>
                              <p class="card-text">24 Jam Sehari, Ayo lakukan suatu hal yang bermanfaat!!</p>

                              <div class="row">
                                        <div class="col-lg-8 mx-auto">
                                                  <form action="<?= base_url('todolist/add') ?>" method="post">
                                                            <div class="input-group mb-2">
                                                                      <input type="text" class="form-control" id="kegiatan" name="kegiatan" placeholder="Nama Kegiatan">
                                                                      <span class="input-group-btn ml-2">
                                                                                <button class="btn btn-warning" type="submit" id="submit" name="submit">Jadwalkan!</button>
                                                                      </span>
                                                            </div>

                                                            <small class="text text-danger"><?= validation_errors(); ?></small>

                                                  </form>
                                        </div>
                              </div>
                    </div>

                    <?php if ($kegiatan) : ?>
                              <div class="row">
                                        <div class="col-lg-12">
                                                  <?= $this->session->flashdata('messege'); ?>
                                                  <div class="card mt-1 mx-auto bg-dark border-secondary" style="max-width: 30rem;">
                                                            <div class="card-header border-bottom border-warning text-light">Kegiatan Hari ini</div>
                                                            <div class=" card-body">
                                                                      <!-- Button trigger modal -->
                                                                      <?php foreach ($kegiatan as $k) : ?>
                                                                                <button type="button" class="btn btn-secondary btn-sm btn-block detailData" data-toggle="modal" data-target="#exampleModal" data-id="<?= $k['id']; ?>">
                                                                                          <?= ucfirst($k['nama']); ?>
                                                                                </button>
                                                                      <?php endforeach; ?>
                                                            </div>

                                                  </div>
                                        </div>
                              </div>
                    <?php endif; ?>

                    <hr>

                    <?php if ($selesai) : ?>
                              <div class="row">
                                        <div class="col-lg-12">
                                                  <div class="card mb-4 mt-3 mx-auto bg-dark border-secondary" style="max-width: 30rem;">
                                                            <div class="card-header bg-info text-light font-weight-bold"">Telah Selesai</div>
                                                  <div class=" card-body text-warning">
                                                                      <!-- Button trigger modal -->
                                                                      <?php foreach ($selesai as $s) : ?>
                                                                                <button type="button" class="btn btn-secondary btn-sm btn-block detailData" data-toggle="modal" data-target="#exampleModal" data-id="<?= $s['id']; ?>">
                                                                                          <?= ucfirst($s['nama']); ?>
                                                                                </button>
                                                                      <?php endforeach; ?>
                                                            </div>

                                                  </div>
                                        </div>
                              </div>
                    <?php endif; ?>
          </div>



          <!-- Modal -->
          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                              <div class="modal-content">
                                        <div class="modal-header">
                                                  <h5 class="modal-title" id="exampleModalLabel">Informasi Kegiatan</h5>
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                  </button>
                                        </div>
                                        <div class="modal-body">
                                                  <form action="<?= base_url('todolist/update'); ?>" method="post">
                                                            <input type="hidden" name="id" id="id">
                                                            <div class="input-group mb-3">
                                                                      <div class="input-group-prepend">
                                                                                <span class="input-group-text" id="basic-addon1">Nama</span>
                                                                      </div>
                                                                      <input type="text" class="form-control" id="nama" name="nama">
                                                            </div>
                                                            <div class="input-group mb-3">
                                                                      <div class="input-group-prepend">
                                                                                <span class="input-group-text" id="basic-addon1">Tanggal</span>
                                                                      </div>
                                                                      <input type="text" class="form-control" id="waktu" name="waktu" readonly>
                                                            </div>
                                                            <div class="input-group mb-3">
                                                                      <div class="input-group-prepend">
                                                                                <span class="input-group-text">Deskripsi</span>
                                                                      </div>
                                                                      <textarea class="form-control" id="deskripsi" name="deskripsi" placeholder="..."></textarea>
                                                            </div>
                                                            <div class="input-group">
                                                                      <div class="input-group-prepend">
                                                                                <label class="input-group-text" for="status">Status</label>
                                                                      </div>
                                                                      <select class="custom-select" id="status" name="status">
                                                                                <option value="1">Aktif</option>
                                                                                <option value="0">Selesai</option>
                                                                      </select>
                                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                  <button type="submit" class="btn btn-danger deleteData" data-dismiss="modal" data-id="a">Delete</button>
                                                  <button type="submit" class="btn btn-primary">Update</button>
                                                  </form>
                                        </div>
                              </div>
                    </div>
          </div>