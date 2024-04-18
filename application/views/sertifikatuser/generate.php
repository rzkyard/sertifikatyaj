<!-- partial -->
<div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Generate Table</h4>
                  
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th class="text-center" style="width: 60px;">ID</th>
                          <th class="text-center">Certificate ID</th>
                          <th class="text-center">User ID</th>
                          <th class="text-center">Event ID</th>
                          <th class="text-center">Assigned At</th>
                          <th class="text-center" style="width: 140px;">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $no = 1;
                        foreach($generate as $generate){
                        ?>
                        <tr>
                          <td class="text-center"><?= $no++ ?></td>
                          <td class="text-center"><?= $generate->certificate_id ?></td>
                          <td class="text-center"><?= $generate->user_id ?></td>
                          <td class="text-center"><?= $generate->event_id ?></td>
                          <td class="text-center"><?= $generate->assigned_at ?></td>
                          <td class="text-center">
                            <label class="badge badge-warning" style="margin-right: 3px;"><a class="text-warning" style="text-decoration: none;" href="<?= base_url('generate/download/' . $generate->assignment_id) ?>">Download</a></label><!-- <label class="badge badge-info" style="margin: 3px;"><a class="text-info" style="text-decoration: none;" href="<?= base_url('edit_generate/' . $generate->assignment_id) ?>">Edit</a></label> --></td>
                        </tr>
                        <?php
                        }
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        