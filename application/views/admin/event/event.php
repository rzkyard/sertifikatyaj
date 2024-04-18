<div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
          <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">EVENT</h4>
                  <p class="card-description">
                    <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    TAMBAH DATA EVENT
                    </button>
                    <?= $this->session->flashdata('pesan'); ?>
                  </p>
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>
                            ID
                          </th>
                          <th>
                            Event Name
                          </th>
                          <th>
                            Event Date
                          </th>
                          <th>
                            Location
                          </th>
                          <th>
                            Organizer
                          </th>
                          <th>
                            Created At
                          </th>
                          <th>
                            Action
                          </th>
                        </tr>
                        <tbody>
                        <?php
                        $no = 1;
                        foreach($event as $event){
                        ?>
                        <tr>
                          <td class="text-center"><?= $no++ ?></td>
                          <td class="text-center"><?= $event->event_name ?></td>
                          <td class="text-center"><?= $event->event_date ?></td>
                          <td class="text-center"><?= $event->location ?></td>
                          <td class="text-center"><?= $event->organizer ?></td>
                          <td class="text-center"><?= $event->created_at ?></td>
                          <td class="text-center"><label class="badge badge-info" style="margin-right: 3px;"><a class="text-info" style="text-decoration: none" href="<?= base_url('admin/event/e_edit/' . $event->event_id) ?>">Edit</a></label><label class="badge badge-danger" style="margin-left: 3px;"><a class="text-danger" style="text-decoration: none;" href="<?= base_url('admin/event/fungsi_hapus/' . $event->event_id) ?>">Delete</a></label></td>
                        </tr>
                        <?php
                        }
                        ?>
                      </thead>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- row end -->
          <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">TAMBAH DATA EVENT</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form action="<?= base_url('admin/event/fungsi_tambah') ?>" method="post">
              <div class="modal-body">
                    <div class="form-group">
                        <label for="inputAddress" class="form-label">Event Name</label>
                        <input type="text" class="form-control" id="inputAddress" name="event_name" placeholder="Event Name" required>
                    </div>
                    <div class="form-group">
                        <label for="inputAddress2" class="form-label">Event Date</label>
                        <input type="date" class="form-control" id="exampleInputUsername1" name="event_date" placeholder="Event Date">
                    </div>
                    <div class="form-group">
                        <label for="inputAddress2" class="form-label">Location</label>
                        <input type="text" class="form-control" id="exampleInputUsername1" name="location" placeholder="Location">
                    </div>
                    <div class="form-group">
                        <label for="inputAddress2" class="form-label">Organizer</label>
                        <input type="text" class="form-control" id="exampleInputUsername1" name="organizer" placeholder="Organizer">
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary">Reset</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </div>
                </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>