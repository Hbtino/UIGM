<?= $this->extend('layouts/sidebar_layout') ?>

<?= $this->section('content') ?>
<style>
    .card {
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
      padding: 25px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 15px;
    }

    th,
    td {
      padding: 10px;
      text-align: left;
      border-bottom: 1px solid #e0e0e0;
    }

    th {
      background: #009b4c;
      color: #fff;
    }

    tr:hover {
      background: #f5fff8;
    }

    .btn {
      padding: 6px 12px;
      border: none;
      border-radius: 5px;
      color: #fff;
      cursor: pointer;
      text-decoration: none;
      display: inline-block;
    }

    .btn-add {
      background: #009b4c;
      margin-bottom: 10px;
    }

    .btn-edit {
      background: #f1c40f;
    }

    .btn-delete {
      background: #e74c3c;
    }
</style>

<div class="card">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
          <div>
            <input type="text" id="searchInput" placeholder="Cari nama atau email..." style="padding: 8px 15px; border: 1px solid #ddd; border-radius: 5px; width: 300px;">
          </div>
          <a href="<?= base_url('users/create') ?>" class="btn btn-add" style="background:#009b4c;color:#fff;">
            <i class="fa fa-plus"></i> Tambah User
          </a>
        </div>

        <?php if (session()->getFlashdata('success')): ?>
          <div style="color:green;"><?= session()->getFlashdata('success') ?></div>
        <?php elseif (session()->getFlashdata('error')): ?>
          <div style="color:red;"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <table>
          <thead>
            <tr>
              <th>ID</th>
              <th>Nama</th>
              <th>Email</th>
              <th>Role</th>
              <th>Unit/Prodi</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($users)): ?>
              <?php foreach ($users as $u): ?>
                <tr>
                  <td><?= esc($u['id']) ?></td>
                  <td><?= esc($u['name']) ?></td>
                  <td><?= esc($u['email']) ?></td>
                  <td>
                    <?php
                    $roleLabels = [
                      'admin' => '<span style="background:#dc3545;color:white;padding:2px 8px;border-radius:12px;font-size:11px;font-weight:600;">Admin Pusat</span>',
                      'admin_unit' => '<span style="background:#17a2b8;color:white;padding:2px 8px;border-radius:12px;font-size:11px;font-weight:600;">Admin Unit</span>',
                      'kaprodi' => '<span style="background:#ffc107;color:black;padding:2px 8px;border-radius:12px;font-size:11px;font-weight:600;">Kaprodi</span>',
                      'dosen' => '<span style="background:#28a745;color:white;padding:2px 8px;border-radius:12px;font-size:11px;font-weight:600;">Dosen</span>'
                    ];
                    echo $roleLabels[$u['role']] ?? esc($u['role']);
                    ?>
                  </td>
                  <td>
                    <?php if ($u['role'] === 'admin_unit' && !empty($u['unit'])): ?>
                      <span style="color:#17a2b8;font-weight:600;"><?= strtoupper($u['unit']) ?></span>
                    <?php elseif (in_array($u['role'], ['kaprodi', 'dosen']) && !empty($u['prodi_id'])): ?>
                      <?php
                      // Get prodi name from database
                      $db = \Config\Database::connect();
                      $prodi = $db->table('prodi')->where('id', $u['prodi_id'])->get()->getRowArray();
                      if ($prodi) {
                        echo '<span style="color:#28a745;font-weight:600;">' . esc($prodi['nama_prodi']) . '</span>';
                      } else {
                        echo '<span style="color:#6c757d;">-</span>';
                      }
                      ?>
                    <?php else: ?>
                      <span style="color:#6c757d;">-</span>
                    <?php endif; ?>
                  </td>
                  <td>
                    <?php if ($u['is_active']): ?>
                      <span style="background:#28a745;color:white;padding:2px 8px;border-radius:12px;font-size:11px;font-weight:600;">Aktif</span>
                    <?php else: ?>
                      <span style="background:#6c757d;color:white;padding:2px 8px;border-radius:12px;font-size:11px;font-weight:600;">Nonaktif</span>
                    <?php endif; ?>
                  </td>
                  <td>
                    <a href="<?= base_url('users/edit/' . $u['id']) ?>" class="btn btn-edit" title="Edit User"><i class="fa fa-edit"></i></a>
                    <?php if ($u['id'] != session()->get('user_id')): ?>
                      <a href="<?= base_url('users/delete/' . $u['id']) ?>" class="btn btn-delete" onclick="return confirm('Yakin ingin hapus user ini?')" title="Hapus User"><i class="fa fa-trash"></i></a>
                    <?php endif; ?>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="7" style="text-align:center;">Belum ada data user</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  </div>

  <script>
    // Simple search functionality
    const searchInput = document.getElementById('searchInput');
    const tableRows = document.querySelectorAll('tbody tr');

    searchInput.addEventListener('keyup', function() {
      const searchTerm = this.value.toLowerCase();
      let visibleCount = 0;

      tableRows.forEach(row => {
        // Skip "no data" row
        if (row.cells.length === 1) return;

        const name = row.cells[1].textContent.toLowerCase();
        const email = row.cells[2].textContent.toLowerCase();

        // Check search term
        if (searchTerm === '' || name.includes(searchTerm) || email.includes(searchTerm)) {
          row.style.display = '';
          visibleCount++;
        } else {
          row.style.display = 'none';
        }
      });

      // Show "no results" message if needed
      updateNoResultsMessage(visibleCount);
    });

    // Update no results message
    function updateNoResultsMessage(visibleCount) {
      const tbody = document.querySelector('tbody');
      let noResultsRow = document.getElementById('no-results-row');

      if (visibleCount === 0) {
        if (!noResultsRow) {
          noResultsRow = document.createElement('tr');
          noResultsRow.id = 'no-results-row';
          noResultsRow.innerHTML = '<td colspan="6" style="text-align:center; padding: 20px; color: #999;">Tidak ada data yang sesuai dengan pencarian</td>';
          tbody.appendChild(noResultsRow);
        }
        noResultsRow.style.display = '';
      } else {
        if (noResultsRow) {
          noResultsRow.style.display = 'none';
        }
      }
    }
  </script>
<?= $this->endSection() ?>