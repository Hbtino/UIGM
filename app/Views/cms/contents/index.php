<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Manajemen Konten Landing Page</h1>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    <?php endif; ?>

    <div class="row">
        <?php 
        $sections = [
            'hero' => 'Hero Section', 
            'about' => 'About Section', 
            'services' => 'Services Section', 
            'contact' => 'Contact Section'
        ];
        
        foreach ($sections as $key => $label): 
            $content = null;
            if (!empty($contents)) {
                foreach ($contents as $c) {
                    if (isset($c['section']) && $c['section'] === $key) {
                        $content = $c;
                        break;
                    }
                }
            }
        ?>
        <div class="col-lg-6 mb-4">
            <div class="card shadow h-100">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary"><?= $label ?></h6>
                    <button class="btn btn-sm btn-primary" onclick="editContent('<?= $key ?>')">
                        <i class="fas fa-edit"></i> Edit
                    </button>
                </div>
                <div class="card-body">
                    <?php if ($content): ?>
                        <h5><?= esc($content['title'] ?? 'No Title') ?></h5>
                        <p class="text-muted">
                            <?php 
                            $contentText = $content['content'] ?? '';
                            echo esc(strlen($contentText) > 150 ? substr($contentText, 0, 150) . '...' : $contentText);
                            ?>
                        </p>
                        <?php if (!empty($content['image'])): ?>
                            <img src="<?= base_url('uploads/contents/' . $content['image']) ?>" 
                                 class="img-fluid rounded mt-2" alt="<?= $label ?>" style="max-height: 150px;">
                        <?php endif; ?>
                    <?php else: ?>
                        <p class="text-muted">Belum ada konten</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Konten</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form id="editForm" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <input type="hidden" name="section" id="section">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Judul</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="form-group">
                        <label>Konten</label>
                        <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Gambar</label>
                        <input type="file" class="form-control-file" id="image" name="image" accept="image/*">
                        <small class="text-muted">Kosongkan jika tidak ingin mengubah gambar</small>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" checked>
                        <label class="form-check-label">Aktif</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
const contents = <?= json_encode($contents ?? []) ?>;

function editContent(section) {
    const content = contents.find(c => c.section === section);
    
    document.getElementById('section').value = section;
    document.getElementById('title').value = content ? (content.title || '') : '';
    document.getElementById('content').value = content ? (content.content || '') : '';
    document.getElementById('is_active').checked = content ? (content.is_active == 1) : true;
    
    const form = document.getElementById('editForm');
    form.action = content 
        ? '<?= base_url('contents/update/') ?>' + content.id
        : '<?= base_url('contents/store') ?>';
    
    $('#editModal').modal('show');
}
</script>
<?= $this->endSection() ?>
