<!-- Modal -->
<div class="modal fade" id="addBloodModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Blood Information:</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post" name="add_blood_type">
                <div class="modal-body">
                    <div class="form-label-group">
                        <label for="hosNewBlood">Enter the Blood Type:</label>
                        <input type="text" name="blood_type" id="hosNewBlood" placeholder="A+, O+, AB-, etc..." required />
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" name="submit" class="btn btn-primary" value="Submit" />
                </div>
            </form>
        </div>
  </div>
</div>