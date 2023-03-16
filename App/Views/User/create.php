<form method="POST" action="/users/create">
    <div class="form-group">
        <label for="exampleInputEmail1">Username</label>
        <input type="text" class="form-control" name="username" placeholder="Enter email">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input type="email" class="form-control" name="email" placeholder="Enter email">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" class="form-control" name="password" placeholder="Password">
    </div>
    <div class="form-check">
        <label class="form-check-label" for="exampleCheck1">Administrateur ?</label>
        <input type="checkbox" class="form-check-input" id="exampleCheck1" name="is_admin">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>