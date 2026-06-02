# CLAUDE.md — Proje Notları (Sonraki Asistan İçin)

Bu dosya, projede çalışacak bir sonraki asistanın bilmesi gereken kalıcı bilgileri tutar.
Kod yapısından/git geçmişinden anlaşılmayan, ama çalışırken gereken bilgileri buraya yaz.

---

## 0. ÖNEMLİ ÇALIŞMA KURALI (kullanıcı talimatı)

- Kullanıcı **"bitti, sonra devam ederiz"** yazdığında **veya sadece "claude.md"** yazdığında:
  → O ana kadar yapılan işlerden ve öğrenilen önemli bilgilerden sonraki asistanın bilmesi
  gerekenleri **bu CLAUDE.md dosyasına not al** (gerekirse güncelle), sonra commit + push et.
- Bu kuralın kendisi de CLAUDE.md içinde kalmalı (kullanıcının açık isteği).
- Kullanıcı Türkçe konuşuyor; cevaplar ve commit mesajları Türkçe.

---

## 1. Proje Özeti

- **Tür:** Laravel **8.83.27** (PHP ^7.3|^8.0) tabanlı, CMS benzeri kurumsal site (lego/paket teması).
- **Frontend:** **Sadece Blade.** Vue/React/Livewire/Inertia YOK, Tailwind YOK, **Vite YOK**.
  - Build aracı: **Laravel Mix (webpack)** — `webpack.mix.js`. Ama `resources/css` ve `resources/js`
    boş; CSS/JS doğrudan `public/assets/` altında elle yönetiliyor.
  - **Sunucuda `npm run build` GEREKMEZ.** Derlenmiş asset'ler repoda `public/assets/` içinde commit'li.
- **Veri kaynağı:** Yerel DB tablosu YOK (sadece varsayılan Laravel tabloları var). Tüm içerik
  **uzaktaki yönetim panelinden** (`yonetimpaneli.net`) **API ile** çekiliyor.

## 2. GitHub / Git

- **Repo:** https://github.com/gkhnds/legosite (**private**), dal: **main**.
- **`.env` ve `vendor/`** `.gitignore`'da olmasına rağmen `-f` ile **repoya commit'lendi** (repo private).
  ⚠️ Repo **public yapılırsa** `.env` içindeki gizli bilgiler (API token, DB şifresi) açığa çıkar —
  o durumda önce anahtarları/şifreleri yenile.
- İş bitince kullanıcı genelde commit + push istiyor. Commit mesajları Türkçe, kısa ve açıklayıcı.

## 3. Mimari (içerik nasıl geliyor)

- `app/Models/Connections.php` → panel API çağrıları (ladders/components).
  Örn: `LaddersDataList()`, `LadderGetAll()`, `LaddersSlugSingle()`, `LadderAndDatas()` →
  `…/api/ladders/{APP_UUID}/…/{lang}/?token=…`
- API'den dönen her kayıt:
  - `->dynamic->...` = dile bağlı alanlar (örn: `resim`, `liste_resmi`, `baslik`, `baslik2`, `spot`,
    `buton_baslik`, `buton_link` …)
  - `->static->...` = dilden bağımsız alanlar (örn: `slug`)
  - `->component->...` = bağlı bileşen (slug, uuid)
- **Resimler:** `Helpers::CacheImageLink($path, ['ThumbsMode'=>bool, 'Mime'=>'webp', 'Resize'=>[...]])`
  (`app/Helpers/Helpers.php`).
  - `ThumbsMode=true` → `ThumbsImage()` yola `thumbs/` ekler (uzakta `.../thumbs/<dosya>`).
  - `ImageFragmentation()` başına `settings.SERVER_ADDRESS` ekler → tam uzak URL.
  - İndirilip yerelde **webp** cache'lenir. Resim boş/200 değilse `/lego/main/img/ImageNull.png`.
- **API base URL & token:** `config/settings.php` (`SERVER_ADDRESS`, `APP_UUID`, token). Kimlik bilgisi paylaşma.

## 4. Tema / Dosya Yapısı

- Tema kökü: `resources/views/theme/`
  - `theme/modules/` → ana sayfa modülleri (Slider, Services, about, galeri, sayac, news … — **dosya
    adları büyük/küçük harfe duyarlı**, örn `Slider.blade.php`, `Services.blade.php`).
  - `theme/partials/` → `head.blade.php`, `header.blade.php`, `footer.blade.php`, `scripts.blade.php`.
  - `theme/route/`, `theme/ladders/`, `theme/extra/`, `theme/partials/{multiple,single}/`.
- Görsel/tasarım işi çoğunlukla `theme/modules/` + `theme/partials/` + `public/assets/css/`.

## 5. CSS / JS — ÖNEMLİ

- **Canlıda yüklenen (head/scripts):** `public/assets/css/style.css` (minify) + `public/assets/js/main.js` (minify).
- **Okunabilir kopyalar (mirror):** `style-nonminify.css`, `main-nonminify.js`. Bunlar SADECE okumak için —
  canlı dosya minify olandır. (Ayrıca `style-yed-07-2025.css` ESKİ/yüklenmiyor.)
- **Tercih edilen düzeltme yöntemi:** Büyük minify CSS'i elle düzenlemek yerine, ilgili Blade
  modülünün/partial'ın içine **scope'lu `<style>` bloğu** eklemek (bu projede zaten var olan kalıp).
  Avantaj: tek dosya, iki CSS kopyasının senkron derdi yok, riski düşük.
- Renk/font değişkenleri `head.blade.php` içinde inline `:root` ile panelden geliyor
  (`--color-primary`, `--color-primary-2` = `#0B4DF5`, `--color-primary-alta` vb.).

## 6. Çalıştırma / Dağıtım Notları

- **Yerelde `php artisan` ÇALIŞMIYOR:** sunucu cache driver'ı **memcached** ve yerelde `Memcached`
  PHP eklentisi yok → "Class Memcached not found". Sürüm vb. için `composer.lock`'a bak.
- **Dağıtım:** `.cpanel.yml` YOK, webhook YOK → dağıtım manuel (cPanel Git pull / FTP).
- Blade değişiklikleri sunucu pull alınca etkili olur. Site view cache kullanıyorsa pull sonrası
  **`php artisan view:clear`** gerekebilir.

## 7. Şimdiye Kadar Yapılan İşler (commit geçmişi)

1. `a2df7e8` — ilk yükleme (repoya ilk push).
2. `7053456` — `.env` + `vendor/` force-add.
3. `0cffae9` — **Slider mobil hero düzeltmesi**: `theme/modules/Slider.blade.php` içine scope'lu
   `<style>` (≤991px): `.bg_banner-three` min-height 520/480px, `<img>` height:100%+object-fit:cover,
   `::after` koyu overlay, metin üstte ve beyaz. Desktop'a dokunulmadı.
4. `f8fd78a` — **Hamburger ikon düzeltmesi**: `theme/partials/header.blade.php` scope'lu `<style>`
   (`.header-two #menu-btn`). Resting: `menu-light.png` `filter:brightness(0)` (koyu, gold zeminde okunur),
   hover: beyaz (filtresiz). Chunky `menu.png` gizlendi. PNG dosyalarına dokunulmadı.
5. `6a6844c` — **Services thumb alanı**: `theme/modules/Services.blade.php` satır 29-30,
   `$data->dynamic->resim` → `$data->dynamic->liste_resmi`.
6. `932cbfc` — **FOUC düzeltmesi**: `head.blade.php`, `bootstrap.min.css` + `style.css` artık
   render-blocking (normal `<link>`). Diğer CSS'ler (swiper/fontawesome/animate/unicons) hâlâ
   `media="print" onload` ile async. `<noscript>` fallback'ten bootstrap+style.css çıkarıldı.

## 8. Bilinen / Açık Konular (gerçek hata değil, bilgi)

- **FOUC öncesi görünen "Turkey Time: Loading..."**: `header.blade.php:20-23` statik metin,
  `scripts.blade.php` `updateTurkeyTime()` ile **tarayıcı saatinden** (`new Date().toLocaleTimeString`,
  ağ çağrısı YOK) güncelleniyor. FOUC sebebi değildi.
- **`GET https://static…` isteği**: kod tabanında YOK. Muhtemelen Cloudflare
  (`static.cloudflareinsights.com/beacon.min.js`, edge'de otomatik enjekte) veya panelden enjekte edilen
  analytics (`head.blade.php:10-26`: `tagmanager_head`, `pixel`, `yandex`, `google`, `istatistik`).
  Async, render-blocking değil.
- `Slider.blade.php` markup'ında Swiper pagination/navigation elementleri yok; `main.js`'teki ilgili
  selektörler boşta (layout hatası değil).
