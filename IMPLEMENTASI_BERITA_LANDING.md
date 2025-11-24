# Implementasi Berita di Landing Page

## ✅ Yang Sudah Dibuat

1. ✅ SQL untuk tambah section berita: `ADD_BERITA_SECTION.sql`
2. ✅ View index sudah diupdate dengan card Berita
3. ✅ File `edit_berita.php` sudah dibuat (kosong, perlu diisi manual)

## 📋 Langkah Implementasi

### STEP 1: Jalankan SQL

Buka phpMyAdmin dan jalankan:

```sql
-- Tambah section berita
INSERT INTO `landing_contents` (`section`, `title`, `subtitle`, `content`, `button_text`, `button_url`, `order`, `is_active`, `created_at`) 
VALUES ('berita', 'Berita Terkini', 'Update Kampus Berkelanjutan', '<p>Ikuti perkembangan terbaru program kampus berkelanjutan kami</p>', 'Lihat Semua Berita', '/news-admin', 3, 1, NOW());

-- Update order kontak
UPDATE `landing_contents` SET `order` = 4 WHERE `section` = 'kontak';
```

### STEP 2: Update Controller

Edit file `app/Controllers/CmsController.php`, cari method `editLandingContent` dan ganti dengan:

```php
public function editLandingContent($section)
{
    if (session()->get('role') !== 'admin') {
        return redirect()->to('/dashboard')->with('error', 'Akses ditolak.');
    }

    // Special handling for berita section
    if ($section === 'berita') {
        $content = $this->landingContentModel->getBySection($section);
        
        if (!$content) {
            $content = [
                'section' => 'berita',
                'title' => 'Berita Terkini',
                'subtitle' => 'Update Kampus Berkelanjutan',
                'content' => '<p>Ikuti perkembangan terbaru</p>',
                'button_text' => 'Lihat Semua Berita',
                'button_url' => '/news-admin',
                'order' => 3,
                'is_active' => 1
            ];
        }
        
        // Get published news (3 terbaru)
        $publishedNews = $this->newsModel
            ->where('is_published', 1)
            ->orderBy('published_at', 'DESC')
            ->findAll();
        
        $data = [
            'title' => 'Kelola Berita di Landing Page',
            'content' => $content,
            'section' => $section,
            'publishedNews' => $publishedNews
        ];
        
        return view('cms/landing/edit_berita', $data);
    }

    // Regular sections (deskripsi, program, kontak)
    $content = $this->landingContentModel->getBySection($section);
    
    if (!$content) {
        $content = [
            'section' => $section,
            'title' => ucfirst($section),
            'subtitle' => '',
            'content' => '',
            'image' => null,
            'button_text' => '',
            'button_url' => '',
            'order' => 0,
            'is_active' => 1
        ];
    }

    $data = [
        'title' => 'Edit Konten '
 page!di landingerita lola bengein bisa mdm
Sekarang ai!
esa📝 Sel# 

#) (hijauditampilkanna yang  mar beritaatoual indic- ✅ Visberita
it g ke edangsunLink lished
- ✅  Publemua beritatar silkan dafa
- ✅ Tampberitsi section skripul dan de judin bisa edit✅ Adm- ublished
ang Paru yrb teitaambil 3 bertomatis 
- ✅ O
 ✨ Fiturft

##shed/Dradi Publi menjaatus berita st ubah- Atau
   -admin`wsi `/neberita dublikasi nggal p- Edit ta
   ampilkan**: yang ditritaengubah betuk m*Un page
4. *ngdiilkan di lanitampatis derbaru otomrita t
   - 3 belishedita yang Pubbertar )
   - Dafle, dlltitsubudul, ta (jection beripengaturan s
   - Form elihat**:**M. 
3rita**ard Bedit" pada c**Klik "Ents`
2. ing-conte* `/landin akses*
1. **Admara Kerja
# 🎯 C
#
```
on() ?>Secti $this->end
<?=</div>
/div>
 </div>
     <    v>
     </di>
           </div          ?>
    if;   <?php end                  iv>
         </d              ru</a>
 erita baah b>">Tambate') ?ws-admin/crel('nee_ur"<?= bas <a href=                       
    lished. ta Pubrim ada be   Belu                     >
    ning"rt alert-wars="aleclas    <div                   lse: ?>
   ehp      <?p             
    </div>                   .
  asi berita publikgalit tangedngubah, tuk me     Un                     lkan. 
  is ditampiotomatan blished akbaru yang Pu berita terg> 3ps:</stronTig> <stron                         3">
  nfo mt-rt-iert ale class="al    <div                
                 
           able> </t                  ody>
           </tb           
           ach; ?>?php endfore         <                     
     </tr>                               </td>
                                       a>
             </                          >
        edit"></ifas fa-s="     <i clas                                  
         ">-primarybtn-sm "btn btn   class=                                            ]) ?>" 
$news['id'it/' . in/eds-admurl('newase_="<?= b   <a href                                           <td>
                                     td>
 ) ?></ated_at'])ws['creat'] ?? $ne['published_($newstrtotime Y', s date('d M <td><?=                               >
          </td                            
          >f; ?p endi        <?ph                                    span>
mpilkan</s">Ditadge-succes"badge baan class=        <sp                                        ): ?>
 if ($i < 3 <?php                                   
        tle']) ?>s['tisc($new <?= e                                         d>
           <t                               </td>
1 ?> + $i <td><?=                                
        ?>">ess' : '' -succable$i < 3 ? 't= <?r class=" <t                             
      s): ?>$i => $newas hedNews is ($publhp foreach?p    <                  
          body> <t                     >
      thead</                        </tr>
                           
         ksi</th> <th>A                             /th>
      al<>Tangg       <th                    
         /th>l Berita<uduh>J    <t                          /th>
      h>No<         <t                        <tr>
                                 >
  head         <t                 dered">
  borable-able tass="t <table cl                    ?>
    )):hedNewslis(!empty($pubp if   <?ph              
                            </p>
             u).
   rbar te(3mpilkan tis dita otomaong> akanished</strstrong>Publn status <rita denga Be                     
  ted">ss="text-mu    <p cla        ">
        ody"card-bv class=     <di         
  /div>         <     
  ge</h6> Landing Padimpilkan Ditaang 0">Berita yclass="m-  <h6        
           >rd-header"ass="ca <div cl            >
   dow"sha="card  class       <div    l-md-8">
 ass="co   <div cl
     div>
    </
      </div>     div>
           </        form>
            </         utton>
     </b                   an
 mpi> Si</save">s fa-"fa <i class=                         
  ">n-blockg bt-warnin="btn btnlass" cubmiton type="s <butt                    >

         </div                  bel>
ge</la Pangan di LandiTampilk">heck-label"form-cabel class=    <l                     
    : '' ?>>cked' ? 'che== 1ve'] ?? 1) tiis_actent['on<?= ($c                                
    lue="1"" va"is_activet" name=heck-inpurm-c" class="fooxe="checkb <input typ                     3">
      ck mb-s="form-checlas       <div           

           </div>                   ">
 a' ?>ihat Semu? 'L'] ?n_texttotent['butconue="<?= $     val                            
  _text" "buttonme=ontrol" na"form-c class=text"="type  <input                  >
         bol</labelel>Text Tom       <lab                   
  p">="form-grouass   <div cl                v>

     di        </               
 area>></text?? '' ?ent'] tent['conton?= $c">< rows="3"content"name=ontrol" -cass="formtextarea cl     <              >
         beli</laipseskr   <label>D                         up">
gross="form-<div cla                          </div>

                   ' ?>">
   itle'] ?? 'btnt['su"<?= $contealue=           v                   le" 
     tit="submeol" natrconrm-s="folase="text" ct typinpu    <                   abel>
     </ll>Subtitle     <labe               
        up">="form-gro class <div                       

    </div>            
        d>>" require Terkini' ?erita'] ?? 'Bitleontent['te="<?= $c     valu                        
      "title" rol" name=orm-cont" class="fxttype="teput       <in                 
     >n *</labelctio Seabel>Judul     <l                       -group">
="formdiv class          <              
                      ) ?>
  csrf_field(=    <?                 ost">
    hod="pmet" ') ?>eritadate/bontents/uplanding-c base_url('"<?=m action= <for          
         card-body">div class="        <>
             </div       </h6>
    taction Berigaturan Se0">Penclass="m-      <h6        >
       xt-white"g-warning te bard-headerlass="c  <div c             mb-4">
  dows="card sha<div clas     ">
       col-md-4"ss=    <div cla
    "row">s=as
    <div cl; ?>
php endif    <?</div>
ccess') ?>data('sugetFlashssion()->?= seccess"><alert-su"alert ss=v cladi        <>
 ?'success')):hdata(getFlason()->ssi?php if (se
    <</div>

    >/a
        <bali></i> Kemt"w-lefarross="fas fa-i cla      <      condary">
"btn btn-se" class=ts') ?>ng-contenndie_url('la="<?= bas     <a href>
   </h1geng Pa LandiBerita dila b-0">Kelos="h3 mclas<h1         
b-4">center ms-align-itement-between nttify-cojus="d-flex  classiv <dd">
   iner-fluintacoclass="

<div tent') ?>n('conthis->sectio $
<?=in') ?>layouts/ma('>extend
<?= $this-p```phphp`:

_berita.ng/editlandiViews/cms/pp/ni ke `ate kode i

Copy pasphpta.le edit_beri 3: Isi Fi### STEP

```
}
data);g/edit', $andin('cms/l view   return
 
    ];n
sectioection' => $
        'scontent,=> $' nt  'conte),
      st($section . ucfir