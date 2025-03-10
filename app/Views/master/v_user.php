<?= $this->include('templates/v_header') ?>

<div class="main-content content margin-t-4">
    <div class="card p-x shadow-sm w-100 rounded">
        <div class="card-header d-flex align-center justify-between">
            <div class="d-flex" style="padding-bottom: 10px;">
                <button class="btn btn-primary dflex align-center" id="btn-add">
                    <i class="bx bx-plus-circle margin-r-2"></i>
                    <span class="fw-normal fs-7">Add New</span>
                </button>
            </div>
        </div>
        <div class="table-responsive margin-t-14p">
            <table class="table table-bordered table-mastered w-100"> 
                <thead>
                    <tr>
                        <td>Name</td>
                        <td>Email</td>
                        <td>Created Date</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Tambah User</h5>
            </div>
            <div class="modal-body">
                <form id="addUserForm">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="text" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" id="btn-close">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        loadTable();

        $('#btn-close').click(function(){
            $('#addUserModal').modal('hide');
        });

        $('#btn-add').click(function(){
            $('#addUserModal').modal('show');
            $('#addUserForm')[0].reset();
            $('#addUserForm').data('action', 'add');
        });

        $('#addUserForm').submit(function(event) {
            event.preventDefault();
            const action = $(this).data('action');
            if (action === 'add') {
                sendData();
            } else if (action === 'edit') {
                updateData();
            }
        });

        $(document).on('click', '.btn-delete', destroy);
        $(document).on('click', '.btn-edit', edit);
    });

    function loadTable(){
        $.ajax({
            url: 'http://127.0.0.1:8000/api/users',
            type: 'GET',
            dataType: 'json',
            success: function(item){
                let data = item.data;
                let html = '';
                data.forEach(function(item){
                    html += `
                        <tr>
                            <td>${item.name}</td>
                            <td>${item.email}</td>
                            <td>${item.created_at}</td>
                            <td>
                                <button class="btn btn-warning btn-edit" data-id="${item.id}">Edit</button>
                                <button class="btn btn-danger btn-delete" data-id="${item.id}">Delete</button>
                            </td>
                        </tr>
                    `;
                });
                $('.table-mastered tbody').html(html);
            }
        });
    }

    function sendData() {
        const name = $('#name').val();
        const email = $('#email').val();
        const password = $('#password').val();

        $.ajax({
            url: 'http://127.0.0.1:8000/api/users',
            type: 'POST',
            dataType: 'json',
            data: {
                name: name,
                email: email,
                password: password
            },
            success: function(response) {
                $('#addUserModal').modal('hide');
                loadTable();
                alert('User added successfully');
            },
            error: function(xhr, status, error) {
                alert('Error: ' + error);
            }
        });
    }

    function updateData() {
        const id = $('#addUserForm').data('id');
        const name = $('#name').val();
        const email = $('#email').val();
        const password = $('#password').val();

        $.ajax({
            url: `http://127.0.0.1:8000/api/users/${id}`,
            type: 'PUT',
            dataType: 'json',
            data: {
                name: name,
                email: email,
                password: password
            },
            success: function(response) {
                $('#addUserModal').modal('hide');
                loadTable();
                alert('User updated successfully');
            },
            error: function(xhr, status, error) {
                alert('Error: ' + error);
            }
        });
    }

    function destroy(){
        const id = $(this).data('id');
        $.ajax({
            url: `http://127.0.0.1:8000/api/users/${id}`,
            type: 'DELETE',
            dataType: 'json',
            success: function(response) {
                loadTable();
                alert('User deleted successfully');
            },
            error: function(xhr, status, error) {
                alert('Error: ' + error);
            }
        });
    }

    function edit(){
        const id = $(this).data('id');
        $.ajax({
            url: `http://127.0.0.1:8000/api/users/${id}`,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                const user = response.data;
                $('#name').val(user.name);
                $('#email').val(user.email);
                $('#password').val(user.password);
                $('#addUserForm').data('id', user.id);
                $('#addUserForm').data('action', 'edit');
                $('#addUserModal').modal('show');
            },
            error: function(xhr, status, error) {
                alert('Error: ' + error);
            }
        });
    }
</script>

<?= $this->include('templates/v_footer') ?>