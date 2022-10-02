<div class="mx-auto mt-5 shadow shadow-lg pb-5" style="width: 800px">
    <form class="form  p-4" action="/save_user" method="post">
        <span class="text-secondary text-xxl pb-3">For Demonstration Add User</span>
        <div class="mb-3 mt-4">
            <label for="username" class="form-label">User Name</label>
            <input type="text" required class="form-control" name="username" id="username">
            <div id="emailHelp" class="form-text">Add User Name</div>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" required class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">Add Email Address.</div>
        </div>
        <div class="mb-3">
            <label for="exampleInputAmount" class="form-label">Amount</label>
            <input type="text" name="amount" required class="form-control" id="exampleInputAmount">
        </div>
        <div class="mb-3 mt-1">
            <button type="submit" class="btn btn-primary float-end">Submit</button>
        </div>
    </form>
</div>