# Dashboard Horizontal Layout

## Perubahan yang Dilakukan

Mengubah layout stat cards dari grid vertikal (2 kolom) menjadi horizontal (4 kolom dalam 1 baris).

### Before (Vertikal)

```
[Card 1] [Card 2]
[Card 3] [Card 4]
```

### After (Horizontal)

```
[Card 1] [Card 2] [Card 3] [Card 4]
```

## Detail Perubahan

### 1. Grid Layout

**Before:**

```css
grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
```

**After:**

```css
grid-template-columns: repeat(4, 1fr);
```

### 2. Card Styling

- Padding: 25px → 20px (lebih compact)
- Gap: 20px → 15px (jarak antar card lebih rapat)
- Min-height: 120px (tinggi minimum untuk konsistensi)

### 3. Icon Size

- Width/Height: 65px → 60px
- Font-size: 28px → 24px
- Border-radius: 15px → 12px
- Tambah `flex-shrink: 0` (agar icon tidak mengecil)

### 4. Typography

- H3 font-size: 32px → 28px
- P font-size: 14px → 13px
- P margin-top: 8px → 6px

### 5. Responsive Breakpoints

- **Desktop (> 1400px)**: 4 kolom
- **Tablet (992px - 1400px)**: 2 kolom
- **Mobile (< 992px)**: 2 kolom
- **Small Mobile (< 768px)**: 1 kolom

## Hasil

- Stat cards sekarang tampil dalam 1 baris horizontal
- Lebih compact dan efisien penggunaan space
- Tetap responsive di layar kecil
- Visual lebih modern dan clean

## Testing

1. Buka dashboard
2. Lihat 4 stat cards sekarang dalam 1 baris horizontal
3. Resize browser untuk test responsive:
   - Desktop: 4 cards horizontal
   - Tablet: 2 cards per baris
   - Mobile: 1-2 cards per baris

## Screenshot Layout

```
┌─────────────────────────────────────────────────────────────────┐
│  [📊 80%]  [🏆 #176]  [🚩 #26]  [🍃 6]                          │
│  Target    Ranking    Ranking   Kriteria                        │
│  Skor      Dunia      Indonesia Keberlanjutan                   │
└─────────────────────────────────────────────────────────────────┘
```
