@php
    $locale = app()->getLocale();
    $tr = [
        'en' => [
            'wedding_of' => 'The Wedding Of',
            'open_invitation' => 'Open Invitation',
            'bride_groom' => 'Bride & Groom',
            'photo_gallery' => 'Photo Gallery',
            'the_wedding' => 'The Wedding',
            'holy_matrimony' => 'Holy Matrimony',
            'wedding_reception' => 'Wedding Reception',
            'second_son_of' => 'Second Son of',
            'daughter_of' => 'Daughter of',
            'starts_at' => 'Starts at',
            'open_maps' => 'Open Maps',
            'rsvp_script' => 'We would be honored by your presence',
            'full_name' => 'FULL NAME',
            'attending' => 'ATTENDING',
            'yes' => 'Yes',
            'no' => 'No',
            'guests' => 'NUMBER OF GUESTS',
            'message' => 'MESSAGE',
            'optional_message' => 'OPTIONAL MESSAGE',
            'submit' => 'SUBMIT',
            'send_love' => 'Send Us Some Love',
            'thanks_gift' => 'Thank you for your gift!',
            'send_gift' => 'Send Gift',
            'share_your' => 'SHARE YOUR',
            'wishes' => 'WISHES',
            'wishes_desc' => 'WE ARE VERY DELIGHTFUL TO HAVE YOUR IMPRINT TO OUR SPECIAL DAY!',
            'your_wishes' => 'YOUR WISHES',
            'send_wishes' => 'SEND WISHES',
            'type_full_name' => 'TYPE FULL NAME',
            'type_number' => 'TYPE NUMBER',
            'type_your_wishes' => 'TYPE YOUR WISHES',
            'saved' => 'Saved',
            'failed' => 'Failed',
            'error' => 'Error',
            'present' => 'Present',
            'absent' => 'Not Attending',
            'send_gift_title' => 'SEND GIFT',
            'send_gift_desc' => 'Please scan the following QR code or copy the bank account number.',
            'copy_number' => 'Copy Number',
            'copied' => 'Copied',
            'copy_failed' => 'Copy failed',
            'prev' => 'Prev',
            'next' => 'Next',
        ],
        'id' => [
            'wedding_of' => 'Pernikahan',
            'open_invitation' => 'Buka Undangan',
            'bride_groom' => 'Mempelai',
            'photo_gallery' => 'Galeri Foto',
            'the_wedding' => 'Acara Pernikahan',
            'holy_matrimony' => 'Pemberkatan',
            'wedding_reception' => 'Resepsi Pernikahan',
            'second_son_of' => 'Putra Kedua dari',
            'daughter_of' => 'Putri dari',
            'starts_at' => 'Dimulai pukul',
            'open_maps' => 'Buka Peta',
            'rsvp_script' => 'Kami akan merasa terhormat atas kehadiran Anda',
            'full_name' => 'NAMA LENGKAP',
            'attending' => 'KEHADIRAN',
            'yes' => 'Ya',
            'no' => 'Tidak',
            'guests' => 'JUMLAH TAMU',
            'message' => 'PESAN',
            'optional_message' => 'PESAN OPSIONAL',
            'submit' => 'KIRIM',
            'send_love' => 'Kirimkan Cinta',
            'thanks_gift' => 'Terima kasih atas hadiahnya!',
            'send_gift' => 'Kirim Hadiah',
            'share_your' => 'BAGIKAN',
            'wishes' => 'UCAPAN',
            'wishes_desc' => 'KAMI SANGAT SENANG MENERIMA JEJAK DOA DI HARI SPESIAL KAMI!',
            'your_wishes' => 'UCAPAN ANDA',
            'send_wishes' => 'KIRIM UCAPAN',
            'type_full_name' => 'TULIS NAMA LENGKAP',
            'type_number' => 'TULIS JUMLAH',
            'type_your_wishes' => 'TULIS UCAPAN ANDA',
            'saved' => 'Tersimpan',
            'failed' => 'Gagal',
            'error' => 'Terjadi kesalahan',
            'present' => 'Hadir',
            'absent' => 'Tidak Hadir',
            'send_gift_title' => 'KIRIM HADIAH',
            'send_gift_desc' => 'Silakan scan QR code berikut atau salin nomor rekening.',
            'copy_number' => 'Salin Nomor',
            'copied' => 'Tersalin',
            'copy_failed' => 'Gagal salin',
            'prev' => 'Sebelum',
            'next' => 'Berikut',
        ],
    ];
    $t = fn(string $key) => $tr[$locale][$key] ?? $tr['en'][$key] ?? $key;
@endphp
<!DOCTYPE html>
<html lang="{{ $locale }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="/favicon.png">
    <title>{{ $invite['couple']['groom'] }} & {{ $invite['couple']['bride'] }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;600&family=Great+Vibes&display=swap" rel="stylesheet">
    @include('partials.test-styles')
</head>
<body>
    <canvas id="introCanvas"></canvas>
    <audio id="bgMusic" loop preload="auto">
        <source src="/images/background-music.mp3" type="audio/mpeg">
    </audio>
    <button id="musicToggle" class="music-toggle" type="button" aria-label="Mute music" title="Mute music">
        <svg viewBox="0 0 24 24" aria-hidden="true">
            <path id="musicIconPath" d="M14 3.23v17.54a1 1 0 0 1-1.64.77L7.6 17H4a1 1 0 0 1-1-1v-8a1 1 0 0 1 1-1h3.6l4.76-4.54A1 1 0 0 1 14 3.23zM17.5 8.5a1 1 0 0 1 1.41 0A4.98 4.98 0 0 1 20.5 12a4.98 4.98 0 0 1-1.59 3.5 1 1 0 1 1-1.36-1.46A2.99 2.99 0 0 0 18.5 12a2.99 2.99 0 0 0-.95-2.04 1 1 0 0 1-.05-1.46z"/>
        </svg>
    </button>
    <div class="desktop-left" aria-hidden="true"></div>
    <div id="bookIntro">
        <video id="openingVideo" class="opening-video" autoplay muted playsinline webkit-playsinline preload="auto">
            <source src="/images/Tema-Blossom.mp4" type="video/mp4">
        </video>
        <div class="opening-overlay">
            <div class="opening-kicker">{{ $t('wedding_of') }}</div>
            <div class="opening-names">{{ $invite['couple']['groom'] }} & {{ $invite['couple']['bride'] }}</div>
            <div class="opening-date">{{ \Carbon\Carbon::parse($invite['event']['date'])->format('d') }} {{ \Carbon\Carbon::parse($invite['event']['date'])->format('F') }} {{ \Carbon\Carbon::parse($invite['event']['date'])->format('Y') }}</div>
        </div>
    </div>
    <div class="wrap">
        {{-- language switcher disabled: landing page is fixed language --}}
        <div class="hero">
            <div class="hero-desktop">
                <div class="hero-left">
                    <img src="{{ $invite['assets']['hero_desktop'] ?? '/images/hero_bg.svg' }}" alt="Hero desktop">
                </div>
                <div class="hero-right">
                    <img class="hero-right-bg" src="{{ $invite['assets']['hero_mobile'] ?? ($invite['assets']['hero_desktop'] ?? '/images/hero_bg.svg') }}" alt="Hero side">
                    <div class="hero-copy hero-copy-desktop">
                        <div class="title">{{ $t('wedding_of') }}</div>
                        <div class="names">{{ $invite['couple']['groom'] }} & {{ $invite['couple']['bride'] }}</div>
                        <div class="date">{{ \Carbon\Carbon::parse($invite['event']['date'])->format('d') }} • {{ \Carbon\Carbon::parse($invite['event']['date'])->format('F') }} • {{ \Carbon\Carbon::parse($invite['event']['date'])->format('Y') }}</div>
                    </div>
                </div>
            </div>
            <div class="hero-mobile">
                <picture>
                    <source media="(max-width: 860px)" srcset="{{ $invite['assets']['hero_mobile'] ?? ($invite['assets']['hero_desktop'] ?? '/images/hero_bg.svg') }}">
                    <img class="hero-bg" src="{{ $invite['assets']['hero_desktop'] ?? '/images/hero_bg.svg' }}" alt="Hero background">
                </picture>
                <div class="hero-copy hero-copy-mobile">
                    @if(!empty($guestName))
                        <div class="hero-guest">To: {{ $guestName }}</div>
                    @endif
                    <div class="title">{{ $t('wedding_of') }}</div>
                    <div class="names">{{ $invite['couple']['groom'] }} & {{ $invite['couple']['bride'] }}</div>
                    <div class="date">{{ \Carbon\Carbon::parse($invite['event']['date'])->format('d') }} {{ \Carbon\Carbon::parse($invite['event']['date'])->format('F') }} {{ \Carbon\Carbon::parse($invite['event']['date'])->format('Y') }}</div>
                    <button id="openInvitationBtn" type="button" class="btn btn-primary hero-open-btn">{{ $t('open_invitation') }}</button>
                </div>
            </div>
        </div>

        <div class="section bg-couple floral-theme">
            <div class="couple-head">
                <div class="couple-title">{{ $t('bride_groom') }}</div>
            </div>
            <div class="couple-grid">
                <div class="couple-item">
                    <div class="person-photo">
                        <img src="{{ $invite['couple']['groom_photo'] ?? ($invite['media']['hero_image_url'] ?? '/images/hero_bg.svg') }}" alt="{{ $invite['couple']['groom'] }} photo">
                    </div>
                    <div class="person-name">{{ $invite['couple']['groom_name'] }}</div>
                    <div class="role">{{ $t('second_son_of') }}</div>
                    <div class="parents">{{ $invite['families']['groom_parents'][0] ?? '' }} & {{ $invite['families']['groom_parents'][1] ?? '' }}</div>
                </div>
                <div class="couple-item">
                    <div class="person-photo">
                        <img src="{{ $invite['couple']['bride_photo'] ?? ($invite['media']['hero_image_url'] ?? '/images/hero_bg.svg') }}" alt="{{ $invite['couple']['bride'] }} photo">
                    </div>
                    <div class="person-name">{{ $invite['couple']['bride_name'] }}</div>
                    <div class="role">{{ $t('daughter_of') }}</div>
                    <div class="parents">{{ $invite['families']['bride_parents'][0] ?? '' }} & {{ $invite['families']['bride_parents'][1] ?? '' }}</div>
                </div>
            </div>
        </div>

        <div class="section bg-gallery floral-theme">
            <h2>{{ $t('photo_gallery') }}</h2>
            <div class="gallery full" id="gallery">
                @foreach(($invite['media']['gallery'] ?? []) as $img)
                    <img src="{{ $img['url'] }}" alt="{{ $img['alt'] ?? 'Photo' }}" data-full="{{ $img['url'] }}">
                @endforeach
            </div>
            </div>
        <div class="lightbox" id="galleryLightbox"><img id="galleryLightboxImg" alt=""></div>

        <div class="section bg-events floral-theme">
            <div class="events-title">{{ $t('the_wedding') }}</div>
            <div class="events-date">{{ \Carbon\Carbon::parse($invite['event']['date'])->format('d') }} {{ \Carbon\Carbon::parse($invite['event']['date'])->format('F') }} {{ \Carbon\Carbon::parse($invite['event']['date'])->format('Y') }}</div>
            <div class="two">
            @php $ev0 = $invite['events'][0] ?? null; $ev1 = $invite['events'][1] ?? null; @endphp
            @if($ev0)
            <div class="card event event-card">
                <img class="event-icon" src="{{ $invite['assets']['icon_matrimony'] ?? '/images/icon_rings.svg' }}" alt="">
                <h3>{{ $t('holy_matrimony') }}</h3>
                <div class="venue">{{ $ev0['venue_name'] }}<br>{{ $ev0['venue_room'] }}</div>
                <div class="addr">{{ $ev0['address_line1'] }}<br>{{ $ev0['address_line2'] }}</div>
                <div class="start">{{ $t('starts_at') }} {{ $ev0['time'] }} {{ $ev0['timezone'] }}</div>
                @if(!empty($ev0['maps_url']))
                <div style="margin-top:16px;">
                    <a class="btn" target="_blank" href="{{ $ev0['maps_url'] }}">{{ $t('open_maps') }}</a>
                </div>
                @endif
            </div>
            @endif
            @if($ev1)
            <div class="card event event-card">
                <img class="event-icon" src="{{ $invite['assets']['icon_reception'] ?? '/images/icon_glasses.svg' }}" alt="">
                <h3>{{ $t('wedding_reception') }}</h3>
                <div class="venue">{{ $ev1['venue_name'] }}<br>{{ $ev1['venue_room'] }}</div>
                <div class="addr">{{ $ev1['address_line1'] }}<br>{{ $ev1['address_line2'] }}</div>
                <div class="start">{{ $t('starts_at') }} {{ $ev1['time'] }} {{ $ev1['timezone'] }}</div>
                @if(!empty($ev1['maps_url']))
                <div style="margin-top:10px;"><a class="btn" target="_blank" href="{{ $ev1['maps_url'] }}">{{ $t('open_maps') }}</a></div>
                @endif
            </div>
            @endif
            </div>
        </div>

        <div class="section bg-rsvp floral-theme">
            <div class="rsvp-wrap">
                <div class="rsvp-title" style="display:none;">RSVP</div>
                <div class="rsvp-desc"></div>
                <div class="rsvp-script">{{ $t('rsvp_script') }}</div>
                <form id="rsvpForm" class="form rsvp-form">
                    <label>{{ $t('full_name') }}</label>
                    <input type="text" name="name" placeholder="{{ $t('type_full_name') }}" required>
                    <label>{{ $t('attending') }}</label>
                    <div class="attend-toggle">
                        <button type="button" class="toggle active" data-attend="1">{{ $t('yes') }}</button>
                        <button type="button" class="toggle" data-attend="0">{{ $t('no') }}</button>
                    </div>
                    <select name="attending" style="display:none;">
                        <option value="1" selected>YES</option>
                        <option value="0">NO</option>
                    </select>
                    <div id="guestsWrap">
                        <label>{{ $t('guests') }}</label>
                        <select name="guests_count" required>
                            <option value="1" selected>1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                    </div>
                    <label>{{ $t('message') }}</label>
                    <textarea name="message" placeholder="{{ $t('optional_message') }}"></textarea>
                    <button type="submit" class="btn btn-gray">{{ $t('submit') }}</button>
                    <div id="rsvpNotice" class="rsvp-notice"></div>
                </form>
            </div>
        </div>

     

        <div class="section bg-gifts floral-theme">
            <h2>{{ $t('send_love') }}</h2>
            <div style="text-align:center;color:var(--muted);">{{ $t('thanks_gift') }}</div>
            <div style="text-align:center; margin-top:16px;">
                <div class="gift-magic">
                    <span class="glow"></span>
                    <img src="/images/gift.png" alt="Gift">
                    <span class="star s1"></span>
                    <span class="star s2"></span>
                    <span class="star s3"></span>
                    <span class="star s4"></span>
                    <span class="star s5"></span>
                </div>
                <button id="openGift" class="btn">{{ $t('send_gift') }}</button>
            </div>
        </div>

        <div class="section bg-wishes floral-theme">
            <div class="wishes-wrap">
                <div class="wishes-kicker">{{ $t('share_your') }}</div>
                <div class="wishes-title">{{ $t('wishes') }}</div>
                <div class="wishes-desc">{{ $t('wishes_desc') }}</div>
                <form id="wishForm" class="form wishes-form">
                    <label>{{ $t('full_name') }}</label>
                    <input type="text" name="name" placeholder="{{ $t('type_full_name') }}" required>
                    <label>{{ $t('your_wishes') }}</label>
                    <textarea name="message" placeholder="{{ $t('type_your_wishes') }}" required></textarea>
                    <button type="submit" class="btn btn-teal">{{ $t('send_wishes') }}</button>
                    <div id="wishNotice" class="wishes-notice"></div>
                </form>
                <hr>
                <div id="wishList" class="list wishes-list">
                    @forelse($wishes as $wish)
                        @php
                            $nameParts = preg_split('/\s+/', trim($wish->name));
                            $initials = strtoupper(substr($nameParts[0] ?? '', 0, 1) . substr($nameParts[1] ?? '', 0, 1));
                            $isAbsent = \Illuminate\Support\Str::contains(\Illuminate\Support\Str::lower($wish->message ?? ''), ['tidak hadir', 'not attending', 'cannot attend', 'can not attend']);
                        @endphp
                        <div class="wish-card">
                            <div class="wish-avatar">{{ $initials ?: 'G' }}</div>
                            <div class="wish-body">
                                <div class="wish-head">
                                    <span class="wish-name">{{ $wish->name }}</span>
                                </div>
                                <div class="wish-text">{{ $wish->message }}</div>
                                <div class="wish-time">{{ optional($wish->created_at)->format('j F Y \a\t H.i') }}</div>
                            </div>
                        </div>
                    @empty
                        {{-- <div class="wish wish-empty">No wishes found</div> --}}
                    @endforelse
                </div>
                <div id="wishPagination" class="wish-pagination" style="display:none;">
                    <button id="wishPrev" type="button" class="wish-page-btn">{{ $t('prev') }}</button>
                    <span id="wishPageInfo" class="wish-page-info">1 / 1</span>
                    <button id="wishNext" type="button" class="wish-page-btn">{{ $t('next') }}</button>
                </div>
            </div>
        </div>
    </div>
    @include('partials.test-scripts')
</body>
</html>
