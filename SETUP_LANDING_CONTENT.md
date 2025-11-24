# Setup Landing Page Content Management

## ✅ Yang Sudah Dibuat

### 1. Model
- ✅ `app/Models/LandingContentModel.php` - Model untuk konten landing page

### 2. Controller
- ✅ `app/Controllers/CmsController.php` - Ditambahkan methods:
  - `landingContents()` - List konten
  - `editLandingContent($section)` - Edit konten per section
  - `updateLandingContent($section)` - Update konten

### 3. Routes
- ✅ `/landing-contents` - List konten landing page
- ✅ `/landing-contents/edit/deskripsi` - Edit deskripsi
- ✅ `/landing-contents/edit/program` - Edit program
- ✅ `/landing-contents/edit/kontak` - Edit kontak

### 4. Folder Upload
- ✅ `public/uploads/landing` - Untuk gambar konten landing

## 📋 Langkah Setup

### STEP 1: Buat Tabel Database

Buka **phpMyAdmin** dan jalankan SQL dari file `CREATE_LANDING_CONTENT_TABLE.sql`:

```sql
CREATE TABLE `landing_contents` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `section` varchar(50) NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `content` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `button_text` varchar(100) DEFAULT NULL,
  `button_url` varchar(255) DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert data default
INSERT INTO `landing_contents` (`section`, `title`, `subtitle`, `content`, `order`, `is_active`, `created_at`) VALUES
('deskripsi', 'Tentang Kampus Berkelanjutan', 'Komitmen Kami', '<p>Konten deskripsi...</p>', 1, 1, NOW()),
('program', 'Program Kampus Berkelanjutan', 'Inisiatif Kami', '<p>Konten program...</p>', 2, 1, NOW()),
('kontak', 'Hubungi Kami', 'Tim Kampus Berkelanjutan', '<p>Konten kontak...</p>', 3, 1, NOW());
```

### STEP 2: Buat View Files Manually

Karena ada issue dengan file system, tolong buat file ini **manual**:

#### File: `app/Views/cms/landing/index.php`
```php
<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('content') ?>
<div class="container-fluid">
    <h1 class="h3 mb-4">Konten Landing Page</h1>
    
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>
    
    <div class="row">
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <i class="fas fa-info-circle"></i> Deskripsi
                </div>
                <div class="card-body">
                    <p>Edit konten section Deskripsi di landing page</p>
                    <a href="<?= base_url('landing-contents/edit/deskripsi') ?>" class="btn btn-primary btn-sm">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <i class="fas fa-list-ul"></i> Program
                </div>
                <div class="card-body">
                    <p>Edit konten section Program di landing page</p>
                    <a href="<?= base_url('landing-contents/edit/program') ?>" class="btn btn-success btn-sm">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <i class="fas fa-envelope"></i> Kontak
                </div>
                <div class="card-body">
                    <p>Edit konten section Kontak di landing page</p>
                    <a href="<?= base_url('landing-contents/edit/kontak') ?>" class="btn btn-info btn-sm">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
```

#### File: `app/Views/cms/landing/edit.php`
```php
<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Edit Konten: <?= ucfirst($section) ?></h1>
        <a href="<?= base_url('landing-contents') ?>" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card shadow">
        <div class="card-body">
            <form action="<?= base_url('landing-contents/update/' . $section) ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                
                <div class="form-group">
                    <label for="title">Judul *</label>
                    <input type="text" class="form-control" id="title" name="title" 
                           value="<?= old('title', $content['title'] ?? '') ?>" required>
                </div>

                <div class="form-group">
                    <label for="subtitle">Subtitle</label>
                    <input type="text" class="form-control" id="subtitle" name="subtitle" 
                           value="<?= old('subtitle', $content['subtitle'] ?? '') ?>">
                </div>

                <div class="form-group">
                    <label for="content">Konten *</label>
                    <textarea class="form-control" id="content" name="content" rows="10" required><?= old('content', $content['content'] ?? '') ?></textarea>
                    <small class="text-muted">Gunakan HTML untuk formatting</small>
                </div>

                <div class="form-group">
                    <label for="image">Gambar</label>
                    <?php if (!empty($content['image'])): ?>
                        <div class="mb-2">
                            <img src="<?= base_url('uploads/landing/' . $content['image']) ?>" !
ari CMSpage d landing ola kontenmengelarang bisa 
Admin sek Selesai!
ktif

## ✨s aktif/nonatu*: Sta*Is Active*al)
- * CTA (opsion: URL tomboltton URL**
- **Buonal)A (opsiCTxt tombol ext**: Te**Button Tsional)
- ction (opbar semage**: Gam**IML)
- port HT utama (supnten**: Koontentnal)
- **Ciobtitle (opstle**: Su*Subtition
- **: Judul sec **Title*:
-ion punyasectiap a

Set Datuktur 📝 Strtting

##maML forrt HTe
- ✅ Suppoe togglive/inactiv✅ Actstom
-  cuext dan URL dengan tto Action)CTA (Call bah tombol 
- ✅ Tamnap sectiosetiar untuk  Upload gamb
- ✅ontakdan Kam, ogrsi, Prkript konten Des

- ✅ Ediur
## 🎯 Fitn
 simpat konten danntak
4. Edii/Program/Koa Deskrips"Edit" padol ik tombnts`
3. Kling-contend8080/lat://localhoshttp:. Akses: `in
2ebagai admogin s
1. LP 4: Test

### STE/li>
```
>
<    </anding
Konten Laobe"></i> gl"fas fa-<i class=        ) ?>">
s'ng-contentndie_url('la="<?= basnk" hrefass="nav-li cl   <aem">
 ss="nav-itcla<li ``php
 menu:

`bahkanhp`, tamau `main.p atphp`/dashboard.ayoutss/lapp/Viewfile `

Edit ar di Sideb Tambah MenuP 3:### STE
```

 ?>dSection()his->en>
<?= $t
</div</div>      </div>
       </form>
     a>
      >Batal</condary""btn btn-se" class=') ?>contentsding-rl('lan base_uf="<?= hre      <a        /button>
             <
     </i> Simpana-save">ss="fas f  <i cla        
          ary">-primn btn"btss=submit" clape="ty    <button             

iv>     </d      bel>
     >Aktif</la"is_active"abel" for=-check-llass="formlabel c       <           ?>>
   hecked' : '' == 1) ? 'c 1)tive'] ??tent['is_ac, $conve'ld('is_acti (o <?=               
             value="1"tive"name="is_acive"  id="is_actinput"k-orm-chec"fs=laseckbox" ct type="ch <inpu               ">
     mb-3checkss="form-cla     <div          

       </div>          v>
    </di            
        </div>                   ) ?>">
  '' ?? on_url']['butt', $contentutton_url<?= old('b   value="                                _url" 
="buttonurl" namen_="buttontrol" id-coass="form cl"text"pe=t tynpu <i                          </label>
 ">URL Tombolutton_urlr="b   <label fo                  ">
       form-groupiv class="         <d           ">
    ="col-md-6<div class                 
    </div>            v>
          </di                    >">
 '] ?? '') ?_texton'buttontent[t', $con_texold('butt"<?=  value=                            " 
      on_textbuttame="xt" nbutton_te"ontrol" id=rm-cclass="foxt"  type="te<input                     
       </label>>Text Tomboln_text"="butto <label for                       ">
    rm-groupfoclass="  <div                  
     ">-6="col-mdlassv c        <di         ow">
   "riv class= <d          
     v>
     </di      ">
     e/*ag"imcept=" acname="imagemage" " id="introl-filem-co"fore" class=type="fil    <input            ?>
       endif;   <?php          v>
         </di                      0px;">
idth: 20="max-w" stylenailumb="img-thlass       c                        
  