<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $invite['couple']['groom'] }} & {{ $invite['couple']['bride'] }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;600&family=Great+Vibes&display=swap" rel="stylesheet">
    @include('partials.test-styles')
</head>
<body>
    <canvas id="introCanvas"></canvas>
    <audio id="bgMusic" loop preload="auto" autoplay>
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
            <div class="opening-kicker">The Wedding Of</div>
            <div class="opening-names">{{ $invite['couple']['groom'] }} & {{ $invite['couple']['bride'] }}</div>
            <div class="opening-date">{{ \Carbon\Carbon::parse($invite['event']['date'])->format('d') }} {{ \Carbon\Carbon::parse($invite['event']['date'])->format('F') }} {{ \Carbon\Carbon::parse($invite['event']['date'])->format('Y') }}</div>
            <div style="margin-top:14px;"><button id="bookEnter" class="book-enter">Enter</button></div>
        </div>
    </div>
    <div class="wrap">
        {{-- <div class="lang">
            @foreach($languages as $lang)
                <a href="{{ route('lang.switch', ['locale' => $lang]) }}">{{ strtoupper($lang) }}</a>
            @endforeach
        </div> --}}
        <div class="hero">
            <div class="hero-desktop">
                <div class="hero-left">
                    <img src="{{ $invite['assets']['hero_desktop'] ?? '/images/hero_bg.svg' }}" alt="Hero desktop">
                </div>
                <div class="hero-right">
                    <img class="hero-right-bg" src="{{ $invite['assets']['hero_mobile'] ?? ($invite['assets']['hero_desktop'] ?? '/images/hero_bg.svg') }}" alt="Hero side">
                    <div class="hero-copy hero-copy-desktop">
                        <div class="title">The Wedding Of</div>
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
                    <div class="title">The Wedding Of</div>
                    <div class="names">{{ $invite['couple']['groom'] }} & {{ $invite['couple']['bride'] }}</div>
                    <div class="date">{{ \Carbon\Carbon::parse($invite['event']['date'])->format('d') }} {{ \Carbon\Carbon::parse($invite['event']['date'])->format('F') }} {{ \Carbon\Carbon::parse($invite['event']['date'])->format('Y') }}</div>
                </div>
            </div>
        </div>

        <div class="section bg-couple floral-theme">
            <div class="couple-head">
                <div class="couple-title">Bride & Groom</div>
            </div>
            <div class="couple-grid">
                <div class="couple-item">
                    <div class="person-photo">
                        <img src="{{ $invite['couple']['groom_photo'] ?? ($invite['media']['hero_image_url'] ?? '/images/hero_bg.svg') }}" alt="{{ $invite['couple']['groom'] }} photo">
                    </div>
                    <div class="person-name">{{ $invite['couple']['groom'] }}</div>
                    <div class="role">Second Son of</div>
                    <div class="parents">{{ $invite['families']['groom_parents'][0] ?? '' }} & {{ $invite['families']['groom_parents'][1] ?? '' }}</div>
                </div>
                <div class="couple-item">
                    <div class="person-photo">
                        <img src="{{ $invite['couple']['bride_photo'] ?? ($invite['media']['hero_image_url'] ?? '/images/hero_bg.svg') }}" alt="{{ $invite['couple']['bride'] }} photo">
                    </div>
                    <div class="person-name">{{ $invite['couple']['bride'] }}</div>
                    <div class="role">Daughter of</div>
                    <div class="parents">{{ $invite['families']['bride_parents'][0] ?? '' }} & {{ $invite['families']['bride_parents'][1] ?? '' }}</div>
                </div>
            </div>
        </div>

        <div class="section bg-gallery floral-theme">
            <h2>Photo Gallery</h2>
            <div class="gallery full" id="gallery">
                @foreach(($invite['media']['gallery'] ?? []) as $img)
                    <img src="{{ $img['url'] }}" alt="{{ $img['alt'] ?? 'Photo' }}" data-full="{{ $img['url'] }}">
                @endforeach
            </div>
            </div>
        <div class="lightbox" id="galleryLightbox"><img id="galleryLightboxImg" alt=""></div>

        <div class="section bg-events floral-theme">
            <div class="events-title">The Wedding</div>
            <div class="events-date">{{ \Carbon\Carbon::parse($invite['event']['date'])->format('d') }} {{ \Carbon\Carbon::parse($invite['event']['date'])->format('F') }} {{ \Carbon\Carbon::parse($invite['event']['date'])->format('Y') }}</div>
            <div class="two">
            @php $ev0 = $invite['events'][0] ?? null; $ev1 = $invite['events'][1] ?? null; @endphp
            @if($ev0)
            <div class="card event event-card">
                <img class="event-icon" src="{{ $invite['assets']['icon_matrimony'] ?? '/images/icon_rings.svg' }}" alt="">
                <h3>Holy Matrimony</h3>
                <div class="venue">{{ $ev0['venue_name'] }}<br>{{ $ev0['venue_room'] }}</div>
                <div class="addr">{{ $ev0['address_line1'] }}<br>{{ $ev0['address_line2'] }}</div>
                <div class="start">Starts at {{ $ev0['time'] }} {{ $ev0['timezone'] }}</div>
                @if(!empty($ev0['maps_url']))
                <div style="margin-top:16px;">
                    <a class="btn" target="_blank" href="{{ $ev0['maps_url'] }}">Open Maps</a>
                </div>
                @endif
            </div>
            @endif
            @if($ev1)
            <div class="card event event-card">
                <img class="event-icon" src="{{ $invite['assets']['icon_reception'] ?? '/images/icon_glasses.svg' }}" alt="">
                <h3>Wedding Reception</h3>
                <div class="venue">{{ $ev1['venue_name'] }}<br>{{ $ev1['venue_room'] }}</div>
                <div class="addr">{{ $ev1['address_line1'] }}<br>{{ $ev1['address_line2'] }}</div>
                <div class="start">Starts at {{ $ev1['time'] }} {{ $ev1['timezone'] }}</div>
                @if(!empty($ev1['maps_url']))
                <div style="margin-top:10px;"><a class="btn" target="_blank" href="{{ $ev1['maps_url'] }}">Open Maps</a></div>
                @endif
            </div>
            @endif
            </div>
        </div>

        <div class="section bg-rsvp floral-theme">
            <div class="rsvp-wrap">
                <div class="rsvp-title" style="display:none;">RSVP</div>
                <div class="rsvp-desc"></div>
                <div class="rsvp-script">We would be honored by your presence</div>
                <form id="rsvpForm" class="form rsvp-form">
                    <label>FULL NAME</label>
                    <input type="text" name="name" placeholder="TYPE FULL NAME" required>
                    <label>ATTENDING</label>
                    <div class="attend-toggle">
                        <button type="button" class="toggle active" data-attend="1">Yes</button>
                        <button type="button" class="toggle" data-attend="0">No</button>
                    </div>
                    <select name="attending" style="display:none;">
                        <option value="1" selected>YES</option>
                        <option value="0">NO</option>
                    </select>
                    <div id="guestsWrap">
                        <label>NUMBER OF GUESTS</label>
                        <input type="number" name="guests_count" placeholder="TYPE NUMBER" value="1" min="1" max="20">
                    </div>
                    <label>MESSAGE</label>
                    <textarea name="message" placeholder="OPTIONAL MESSAGE"></textarea>
                    <button type="submit" class="btn btn-gray">SUBMIT</button>
                    <div id="rsvpNotice" class="rsvp-notice"></div>
                </form>
            </div>
        </div>

     

        <div class="section bg-gifts floral-theme">
            <h2>Send Us Some Love</h2>
            <div style="text-align:center;color:var(--muted);">Thank you for your gift!</div>
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
                <button id="openGift" class="btn">Send Gift</button>
            </div>
        </div>

        <div class="section bg-wishes floral-theme">
            <div class="wishes-wrap">
                <div class="wishes-kicker">SHARE YOUR</div>
                <div class="wishes-title">WISHES</div>
                <div class="wishes-desc">WE ARE VERY DELIGHTFUL TO HAVE YOUR IMPRINT TO OUR SPECIAL DAY!</div>
                <form id="wishForm" class="form wishes-form">
                    <label>FULL NAME</label>
                    <input type="text" name="name" placeholder="TYPE FULL NAME" required>
                    <label>YOUR WISHES</label>
                    <textarea name="message" placeholder="TYPE YOUR WISHES" required></textarea>
                    <button type="submit" class="btn btn-teal">SEND WISHES</button>
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
                        <div class="wish wish-empty">No wishes found</div>
                    @endforelse
                </div>
                <div id="wishPagination" class="wish-pagination" style="display:none;">
                    <button id="wishPrev" type="button" class="wish-page-btn">Prev</button>
                    <span id="wishPageInfo" class="wish-page-info">1 / 1</span>
                    <button id="wishNext" type="button" class="wish-page-btn">Next</button>
                </div>
            </div>
        </div>
    </div>
    @include('partials.test-scripts')
</body>
</html>
