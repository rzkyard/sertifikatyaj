<!-- partial -->
<div class="main-panel">        
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Edit Certificate</h4>
                  <p class="card-description">
                  </p>
                  <form action="<?= base_url('admin/sertifikat/fungsi_edit') ?>" method="post" class="forms-sample">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Participant Name</label>
                      <input type="hidden" class="form-control" id="exampleInputUsername1" name="certificate_id" value="<?= $certificate->certificate_id ?>" placeholder="" readonly>
                      <input type="text" class="form-control" id="exampleInputUsername1" name="participant_name" value="<?= $certificate->participant_name ?>" placeholder="participant_name">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputUsername1">Event Name</label>
                      <input type="text" class="form-control" id="exampleInputUsername1" name="event_name" value="<?= $certificate->event_name ?>" placeholder="Event Name">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Event Date</label>
                      <input type="date" class="form-control" id="exampleInputUsername1" name="event_date" value="<?= $certificate->event_date ?>" placeholder="Event Date">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Certificate Text</label>
                      <input type="text" class="form-control" id="exampleInputUsername1" name="certificate_text" value="<?= $certificate->certificate_text ?>" placeholder="certificate_text">
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                    <a href="<?= base_url('admin/generate_certificate') ?>" class="btn btn-light">Cancel</a>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->