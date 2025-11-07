<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container mt-5">
        <h2>Edit User</h2>

        <!-- Tambahkan ini -->
        <?php if (isset($validation)) : ?>
            <div class="alert alert-danger">
                <?= $validation->listErrors() ?>
            </div>
        <?php endif; ?>
        <!-- Sampai sini -->

        <form action="/users/update/<?= $user['id'] ?>" method="post">
            <div class="mb-3">
                <label>Nama</label>
                <input type="text" name="name" value="<?= $user['name'] ?>" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" value="<?= $user['email'] ?>" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Role</label>
                <select name="role" class="form-control">
                    <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                    <option value="kaprodi" <?= $user['role'] == 'kaprodi' ? 'selected' : '' ?>>Kaprodi</option>
                    <option value="dosen" <?= $user['role'] == 'dosen' ? 'selected' : '' ?>>Dosen</option>
                </select>
            </div>
            <button class="btn btn-success">Update</button>
            <a href="/users" class="btn btn-secondary">Kembali</a>
        </form>
    </div>

</body>

</html>
