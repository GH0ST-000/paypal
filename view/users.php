<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Payment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="/charge" method="POST">
                  <div class="mb-3">
                      <label class="form-label">Amount</label>
                      <input class="form-control" type="text" value="" id="amount" name="amount">
                  </div>

                  <div class="mt-2 mb-3">
                      <label class="form-label">User Email</label>
                      <input class="form-control" type="text" value="" id="email" name="email">
                  </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Charge</button>
            </div>
              </form>
        </div>
    </div>
</div>
