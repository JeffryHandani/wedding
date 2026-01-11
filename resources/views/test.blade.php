<!DOCTYPE html>
<html lang="{{ $locale }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $invite['couple']['groom'] }} & {{ $invite['couple']['bride'] }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;600&family=Great+Vibes&display=swap" rel="stylesheet">
    <style>
        :root { --text:#2c1b1f; --muted:#6b4c55; --border:#e7d7de; --primary:#b03060; --bg1:#fff0f5; --bg2:#f9f1f7; --bg3:#ffffff; --bg4:#f5f7ff; --bg5:#f1fbf7; --bg6:#fffdf2; --bg7:#f8f0ff; --teal:#55949a; }
        * { box-sizing:border-box; }
        body { margin:0; color:var(--text); background:#fff; font-family:Poppins, system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif; }
        .wrap { width:100vw; max-width:none; margin:0; padding:0; }
        .hero { text-align:center; padding: 8vh 6vw 6vh; width:100vw; margin-left:calc(50% - 50vw); margin-right:calc(50% - 50vw); min-height: 70vh; display:flex; flex-direction:column; align-items:center; justify-content:center; background:var(--bg1); }
        .title { font-family: Cinzel, Playfair Display, serif; font-size: clamp(1.8rem, 6vw, 3rem); letter-spacing:6px; text-transform:uppercase; }
        .names { font-family: Great Vibes, Playfair Display, serif; font-size: clamp(3.4rem, 13vw, 7rem); line-height:1; color:var(--primary); margin-top:12px; }
        .date { margin-top:16px; letter-spacing:8px; font-weight:700; font-size:1.2rem; text-transform:uppercase; }
        .section { margin:0; padding:8vh 8vw; border-top:1px solid var(--border); background:#fff; width:100vw; margin-left:calc(50% - 50vw); margin-right:calc(50% - 50vw); min-height:70vh; display:flex; flex-direction:column; justify-content:center; }
        .bg-scripture { background: var(--bg2); }
        .bg-couple { background: var(--bg3); }
        .bg-events { background: #9fa1a4; color:#ffffff; }
        .bg-protocol { background: var(--bg5); }
        .bg-rsvp { background: var(--bg6); }
        .bg-gifts { background: var(--teal); color:#fff; min-height:56vh; }
        .bg-gifts h2, .bg-gifts div { color:#fff; }
        .bg-wishes { background: var(--bg3); }
        .gift-magic { position:relative; width:clamp(140px, 18vw, 220px); margin:12px auto 8px; }
        .gift-magic img { position:relative; display:block; z-index:2; filter: drop-shadow(0 8px 16px rgba(0,0,0,0.3)); }
        .gift-magic .glow { position:absolute; left:50%; top:50%; width:260px; height:260px; transform:translate(-50%,-50%); border-radius:50%; background: radial-gradient(circle at 50% 50%, rgba(255,220,230,0.8), rgba(255,240,248,0.6)); filter:blur(42px); z-index:1; animation: pulse 4s ease-in-out infinite; }
        .gift-magic .star { position:absolute; width:8px; height:8px; border-radius:50%; background: radial-gradient(circle, #fff 0%, rgba(255,255,255,0.6) 50%, transparent 100%); opacity:0; animation: twinkle 3s ease-in-out infinite; }
        .gift-magic .s1 { left:-10px; top:20px; animation-delay:.2s; }
        .gift-magic .s2 { left:20px; top:-10px; animation-delay:.6s; }
        .gift-magic .s3 { right:10px; top:0; animation-delay:1s; }
        .gift-magic .s4 { right:-12px; bottom:12px; animation-delay:1.4s; }
        .gift-magic .s5 { left:0; bottom:-8px; animation-delay:1.8s; }
        .gift-magic .lid { position:absolute; top:6%; left:50%; transform:translateX(-50%); width:68%; height:18%; background: linear-gradient(180deg,#f3f3f3 0%, #e9e9e9 100%); border:2px solid rgba(46,46,46,0.9); border-radius:8px; box-shadow:0 10px 16px rgba(0,0,0,0.28); z-index:3; transform-origin:50% 100%; }
        .gift-magic.open .lid { animation: lidLift 1.1s cubic-bezier(.2,.8,.2,1) forwards; }
        .gift-magic.open img { animation: boxReveal .9s ease both; }
        .gift-magic.open .star { animation-duration: 2s; }
        @keyframes pulse { 0% { transform:translate(-50%,-50%) scale(0.98);} 50% { transform:translate(-50%,-50%) scale(1.02);} 100% { transform:translate(-50%,-50%) scale(0.98);} }
        @keyframes twinkle { 0% { opacity:0; transform:scale(0.6) translateY(8px);} 50% { opacity:1; transform:scale(1) translateY(0);} 100% { opacity:0; transform:scale(0.6) translateY(-8px);} }
        @keyframes lidLift { 0% { transform:translateX(-50%) rotate(0) translateY(0);} 40% { transform:translateX(-50%) rotate(-10deg) translateY(-26px);} 100% { transform:translateX(-50%) rotate(-6deg) translateY(-22px);} }
        @keyframes boxReveal { 0% { transform:translateY(6px) scale(0.98);} 50% { transform:translateY(0) scale(1.02);} 100% { transform:none; }}
        .wishes-wrap { max-width:520px; margin:0 auto; text-align:center; }
        .wishes-kicker { letter-spacing:4px; font-weight:700; font-size:0.9rem; margin-bottom:6px; }
        .wishes-title { font-family: Playfair Display, serif; font-size: clamp(2.2rem, 7vw, 3.2rem); letter-spacing:4px; margin-bottom:8px; }
        .wishes-desc { color:var(--muted); letter-spacing:2px; font-size:0.95rem; margin-bottom:16px; }
        .wishes-form label { display:block; text-align:left; letter-spacing:2px; font-weight:700; font-size:0.8rem; margin:12px 0 6px; color:#333; }
        .wishes-form input, .wishes-form textarea { background:#efefef; border:1px solid #e5e5e5; border-radius:8px; }
        .wishes-form input::placeholder, .wishes-form textarea::placeholder { color:#9aa0a6; letter-spacing:2px; }
        .btn-teal { background:var(--teal); color:#fff; border-color:transparent; }
        .wishes-form .btn-teal { display:block; margin:16px auto 0; padding:12px 18px; letter-spacing:3px; text-transform:uppercase; border-radius:10px; }
        .wishes-notice { color:var(--primary); margin-top:8px; }
        .wishes-list { max-width:520px; margin:16px auto 0; text-align:center; }
        .rsvp-wrap { max-width:520px; margin:0 auto; text-align:center; }
        .rsvp-kicker { letter-spacing:4px; font-weight:700; font-size:0.9rem; margin-bottom:6px; }
        .rsvp-title { font-family: Playfair Display, serif; font-size: clamp(2.2rem, 7vw, 3.2rem); letter-spacing:4px; margin-bottom:8px; }
        .rsvp-desc { color:var(--muted); letter-spacing:2px; font-size:0.95rem; margin-bottom:16px; }
        .rsvp-script { font-family: Great Vibes, Playfair Display, serif; font-size: clamp(2rem, 7vw, 3rem); color: var(--muted); margin-bottom:14px; }
        .rsvp-form label { display:block; text-align:left; letter-spacing:2px; font-weight:700; font-size:0.8rem; margin:12px 0 6px; color:#333; }
        .rsvp-form input, .rsvp-form select, .rsvp-form textarea { background:#efefef; border:1px solid #e5e5e5; border-radius:8px; }
        .rsvp-form input::placeholder, .rsvp-form textarea::placeholder { color:#9aa0a6; letter-spacing:2px; }
        .rsvp-form .btn-teal { display:block; margin:16px auto 0; padding:12px 18px; letter-spacing:3px; text-transform:uppercase; border-radius:10px; }
        .rsvp-notice { color:var(--primary); margin-top:8px; }
        .attend-toggle { display:grid; grid-template-columns: 1fr 1fr; gap:8px; margin-bottom:8px; }
        .attend-toggle .toggle { padding:10px 12px; border-radius:10px; border:1px solid #cfd2d6; background:#f1f1f1; letter-spacing:3px; font-weight:700; color:#6b7075; }
        .attend-toggle .toggle.active { background:#8f8f92; color:#fff; border-color:transparent; }
        .btn-gray { background:#8f8f92; color:#fff; border-color:transparent; }
        .section h2 { margin:0 0 10px; font-family:Cinzel, Playfair Display, serif; letter-spacing:4px; font-size:1.3rem; text-align:center; text-transform:uppercase; }
        .two { display:grid; grid-template-columns: 1fr 1fr; gap:28px; }
        @media (max-width: 860px) { .two { grid-template-columns: 1fr; } }
        .card { padding:32px; border:1px solid var(--border); border-radius:16px; }
        .card h3 { margin:0 0 6px; font-family:Cinzel, Playfair Display, serif; letter-spacing:4px; font-size:1.1rem; text-align:center; text-transform:uppercase; }
        .scripture { text-align:center; font-family: Playfair Display, serif; font-size:1.3rem; color:#4b3c42; line-height:1.8; }
        .person { text-align:center; }
        .role { font-family:Cinzel, Playfair Display, serif; letter-spacing:4px; font-size:1.1rem; text-transform:uppercase; }
        .person-name { font-family: Great Vibes, Playfair Display, serif; font-size:2.6rem; color:var(--primary); line-height:1; }
        .parents { color:var(--muted); margin-top:8px; letter-spacing:0.5px; }
        .event { text-align:center; }
        .venue { font-family: Playfair Display, serif; font-size:1.2rem; }
        .addr { color:var(--muted); margin-top:10px; font-size:1rem; line-height:1.7; }
        .start { margin-top:12px; font-weight:700; letter-spacing:1px; }
        .proto { display:grid; grid-template-columns: repeat(4, 1fr); gap:18px; margin-top:18px; }
        @media (max-width: 860px) { .proto { grid-template-columns: repeat(2, 1fr); } }
        .proto .p { text-align:center; border:1px solid var(--border); border-radius:16px; padding:18px; background:#fff; }
        .p .emoji { font-size:2rem; }
        .btn { display:inline-block; padding:12px 18px; border-radius:12px; border:1px solid var(--border); background:#fff; text-decoration:none; color:#6b7075; font-weight:700; letter-spacing:4px; text-transform:uppercase; }
        .btn-primary { background:linear-gradient(180deg, var(--primary) 0%, #9a234e 100%); color:#fff; border-color:transparent; }
        .event-card { border:3px solid #ffffff; background: rgba(255,255,255,0.06); min-height:52vh; display:flex; align-items:center; justify-content:center; flex-direction:column; }
        .event-icon { width:120px; height:120px; margin-bottom:16px; opacity:.95; }
        .bg-events .card h3, .bg-events .venue, .bg-events .addr, .bg-events .start { color:#ffffff; }
        .bg-events .addr { opacity:.9; }
        .events-title { text-align:center; font-family:Cinzel, Playfair Display, serif; letter-spacing:6px; text-transform:uppercase; font-size:1.8rem; margin-bottom:8px; color:#ffffff; }
        .events-date { text-align:center; letter-spacing:6px; text-transform:uppercase; color:#ffffff; opacity:.9; margin-bottom:24px; }
        .list { margin-top:16px; }
        .wish { border-bottom:1px solid var(--border); padding:12px 0; font-size:1rem; }
        .form input, .form select, .form textarea { width:100%; padding:14px 16px; margin:8px 0 14px; border:1px solid var(--border); border-radius:12px; font-size:1rem; }
        .form textarea { min-height:120px; }
        .lang { text-align:center; margin-top:8px; }
        .lang a { margin:0 6px; }
    </style>
</head>
<body>
    <div class="wrap">
        <div class="lang">
            @foreach($languages as $lang)
                <a href="{{ route('lang.switch', ['locale' => $lang]) }}">{{ strtoupper($lang) }}</a>
            @endforeach
        </div>
        <div class="hero" style="background-image:url('{{ $invite['assets']['hero_desktop'] ?? '/images/hero_bg.svg' }}'); background-size:cover; background-position:center;">
            <div class="title">Bride & Groom</div>
            <div class="names">{{ $invite['couple']['groom'] }} & {{ $invite['couple']['bride'] }}</div>
            <div class="date">{{ \Carbon\Carbon::parse($invite['event']['date'])->format('d') }} • {{ \Carbon\Carbon::parse($invite['event']['date'])->format('F') }} • {{ \Carbon\Carbon::parse($invite['event']['date'])->format('Y') }}</div>
        </div>

        <div class="section bg-scripture">
            <div class="scripture">{{ $invite['scripture'] ?? '' }}</div>
        </div>

        <div class="section bg-couple two">
            <div class="card person">
                <div class="role">Groom</div>
                <div class="person-name">{{ $invite['couple']['groom'] }}</div>
                <div class="parents">Second Son of<br>{{ $invite['families']['groom_parents'][0] ?? '' }}<br>&<br>{{ $invite['families']['groom_parents'][1] ?? '' }}</div>
            </div>
            <div class="card person">
                <div class="role">Bride</div>
                <div class="person-name">{{ $invite['couple']['bride'] }}</div>
                <div class="parents">First Daughter of<br>{{ $invite['families']['bride_parents'][0] ?? '' }}<br>&<br>{{ $invite['families']['bride_parents'][1] ?? '' }}</div>
            </div>
        </div>

        <div class="section bg-events">
            <div class="events-title">The Wedding</div>
            <div class="events-date">{{ \Carbon\Carbon::parse($invite['event']['date'])->format('d') }} • {{ \Carbon\Carbon::parse($invite['event']['date'])->format('F') }} • {{ \Carbon\Carbon::parse($invite['event']['date'])->format('Y') }}</div>
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
                    @if(!empty($ev0['watch_url']))
                    <a class="btn" target="_blank" href="{{ $ev0['watch_url'] }}" style="margin-left:18px;">Watch Live</a>
                    @endif
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

        <div class="section bg-protocol">
            <h2>Say You’ll Be There</h2>
            <div style="text-align:center; color:var(--muted); margin-top:6px;">Health Protocol</div>
            <div class="proto">
                <div class="p"><div class="emoji">↔️</div><div>Keep distance physically</div></div>
                <div class="p"><div class="emoji">🧼</div><div>Wash and disinfect hands regularly</div></div>
                <div class="p"><div class="emoji">😷</div><div>Always use face mask</div></div>
                <div class="p"><div class="emoji">❤️</div><div>Please kindly RSVP your attendance</div></div>
            </div>
        </div>

        <div class="section bg-rsvp">
            <div class="rsvp-wrap">
                <div class="rsvp-kicker">PLEASE KINDLY RSVP YOUR ATTENDANCE</div>
                <div class="rsvp-title" style="display:none;">RSVP</div>
                <div class="rsvp-desc"></div>
                <div class="rsvp-script">We would be honored by your presence</div>
                <form id="rsvpForm" class="form rsvp-form">
                    <label>FULL NAME</label>
                    <input type="text" name="name" placeholder="TYPE FULL NAME" required>
                    <label>PHONE</label>
                    <input type="text" name="phone" placeholder="TYPE PHONE">
                    <label>CONFIRMATION OF ATTENDANCE</label>
                    <label>ATTENDING</label>
                    <div class="attend-toggle">
                        <button type="button" class="toggle active" data-attend="1">YES</button>
                        <button type="button" class="toggle" data-attend="0">NO</button>
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

        <div class="section bg-gifts">
            <h2>Send Us Some Love</h2>
            <div style="text-align:center;color:var(--muted);">Thank you for your gift!</div>
            <div style="text-align:center; margin-top:16px;">
                <div class="gift-magic">
                    <span class="glow"></span>
                    <img src="{{ $invite['assets']['gift_illustration'] ?? '/images/gift_magic.svg' }}" alt="Gift">
                    <span class="lid"></span>
                    <span class="star s1"></span>
                    <span class="star s2"></span>
                    <span class="star s3"></span>
                    <span class="star s4"></span>
                    <span class="star s5"></span>
                </div>
                <button id="openGift" class="btn">Send Gift</button>
            </div>
        </div>

        <div class="section bg-wishes">
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
                <div id="wishList" class="list wishes-list">
                    @forelse($wishes as $wish)
                        <div class="wish"><strong>{{ $wish->name }}</strong> — {{ $wish->message }}</div>
                    @empty
                        <div class="wish">No wishes found</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <script>
        function postForm(formEl, url, noticeEl, listUpdater){
            const formData = new FormData(formEl);
            const payload = {};
            formData.forEach((v,k)=>{ payload[k]=v; });
            noticeEl.textContent = '';
            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify(payload)
            }).then(r=>r.json()).then(res=>{
                if(res.ok){
                    noticeEl.textContent = 'Saved';
                    if(listUpdater) listUpdater(res);
                    formEl.reset();
                } else {
                    noticeEl.textContent = 'Failed';
                }
            }).catch(()=>{ noticeEl.textContent = 'Error'; });
        }
        document.getElementById('rsvpForm').addEventListener('submit', function(e){
            e.preventDefault();
            const notice = document.getElementById('rsvpNotice');
            postForm(this, '{{ route('rsvp.store') }}', notice);
        });
        (function(){
            const form = document.getElementById('rsvpForm');
            if(!form) return;
            const toggles = form.querySelectorAll('.attend-toggle .toggle');
            const select = form.querySelector('select[name="attending"]');
            const guestsWrap = document.getElementById('guestsWrap');
            function update(v){
                select.value = v;
                if(v === '1'){ guestsWrap.style.display = ''; }
                else { guestsWrap.style.display = 'none'; }
            }
            toggles.forEach(btn=>{
                btn.addEventListener('click', ()=>{
                    toggles.forEach(b=>b.classList.remove('active'));
                    btn.classList.add('active');
                    update(btn.dataset.attend);
                });
            });
            update(select.value || '1');
        })();
        document.getElementById('wishForm').addEventListener('submit', function(e){
            e.preventDefault();
            const notice = document.getElementById('wishNotice');
            postForm(this, '{{ route('wishes.store') }}', notice, (res)=>{
                const w = res.wish;
                const div = document.createElement('div');
                div.className = 'wish';
                div.innerHTML = `<strong>${w.name}</strong> — ${w.message}`;
                document.getElementById('wishList').prepend(div);
            });
        });
        (function(){
            const open = document.getElementById('openGift');
            if(!open) return;
            const modal = document.createElement('div');
            modal.id = 'giftModal';
            modal.innerHTML = `
            <div style="position:fixed; inset:0; background:rgba(0,0,0,0.6); display:flex; align-items:center; justify-content:center; z-index:1000;">
                <div style="background:#fff; width:92vw; max-width:620px; border-radius:16px; box-shadow:0 20px 40px rgba(0,0,0,0.2); overflow:hidden;">
                    <div style="display:flex; align-items:center; justify-content:space-between; padding:18px 20px; border-bottom:1px solid #e7d7de;">
                        <div style="font-family:Cinzel, Playfair Display, serif; letter-spacing:4px; font-size:1.6rem;">SEND GIFT</div>
                        <button id="giftClose" style="border:none;background:none;font-size:1.4rem;line-height:1;color:#6b7075;">✕</button>
                    </div>
                    <div style="padding:14px 20px; color:#6b4c55; letter-spacing:1px;">Please scan the following QR code or copy the bank account number.</div>
                    <div style="display:flex; gap:8px; padding:0 20px;">
                        @foreach(($invite['gifts_modal'] ?? []) as $i => $opt)
                        <button class="gift-tab{{ $i===0 ? ' active' : '' }}" data-index="{{ $i }}" style="flex:1; padding:10px; border:none; border-bottom:3px solid {{ $i===0 ? '#b03060' : '#e7d7de' }}; background:#fff; font-weight:700; letter-spacing:2px;">{{ $opt['label'] }}</button>
                        @endforeach
                    </div>
                    <div id="giftBody" style="padding:20px; text-align:center;">
                        @php $first = ($invite['gifts_modal'][0] ?? null); @endphp
                        @if($first)
                        @if(!empty($first['logo']))
                        <img src="{{ $first['logo'] }}" alt="" style="max-width:240px; margin:10px auto;">
                        @endif
                        @if(!empty($first['qr_image']))
                        <img src="{{ $first['qr_image'] }}" alt="QR" style="width:220px; height:220px; object-fit:contain; margin:10px auto;">
                        @endif
                        @if(!empty($first['account_name']))
                        <div style="font-weight:700; margin-top:8px;">{{ $first['account_name'] }}</div>
                        @endif
                        @if(!empty($first['account_number']))
                        <div id="giftAccount" style="margin-top:4px; letter-spacing:1px;">{{ $first['account_number'] }}</div>
                        <button id="copyGift" class="btn" style="margin-top:12px;">Copy Number</button>
                        @endif
                        @endif
                    </div>
                </div>
            </div>`;
            modal.style.display = 'none';
            document.body.appendChild(modal);
            function setActive(i){
                const opts = @json($invite['gifts_modal'] ?? []);
                const body = document.getElementById('giftBody');
                const o = opts[i];
                if(!o){ return; }
                body.innerHTML = `
                    ${o.logo ? `<img src="${o.logo}" alt="" style="max-width:240px; margin:10px auto;">` : ''}
                    ${o.qr_image ? `<img src="${o.qr_image}" alt="QR" style="width:220px; height:220px; object-fit:contain; margin:10px auto;">` : ''}
                    ${o.account_name ? `<div style="font-weight:700; margin-top:8px;">${o.account_name}</div>` : ''}
                    ${o.account_number ? `<div id="giftAccount" style="margin-top:4px; letter-spacing:1px;">${o.account_number}</div><button id="copyGift" class="btn" style="margin-top:12px;">Copy Number</button>` : ''}
                `;
                const tabs = document.querySelectorAll('.gift-tab');
                tabs.forEach((t,idx)=>{
                    t.classList.toggle('active', idx===i);
                    t.style.borderBottomColor = idx===i ? '#b03060' : '#e7d7de';
                });
                const cp = document.getElementById('copyGift');
                if(cp){
                    cp.onclick = ()=>{
                        const num = document.getElementById('giftAccount')?.textContent || '';
                        if(num){
                            navigator.clipboard.writeText(num);
                            cp.textContent = 'Copied';
                            setTimeout(()=>{ cp.textContent = 'Copy Number'; }, 1200);
                        }
                    };
                }
            }
            open.addEventListener('click', ()=>{
                modal.style.display = 'block';
                setActive(0);
            });
            modal.addEventListener('click', (e)=>{
                if(e.target && e.target.id === 'giftModal'){ modal.style.display = 'none'; }
            });
            document.addEventListener('click', (e)=>{
                const close = document.getElementById('giftClose');
                if(close && e.target === close){ modal.style.display = 'none'; }
                const tab = e.target.closest('.gift-tab');
                if(tab){ setActive(parseInt(tab.dataset.index)); }
            });
        })();
        (function(){
            const prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
            if(prefersReduced) return;
            const gm = document.querySelector('.gift-magic');
            if(!gm) return;
            const io = new IntersectionObserver((entries)=>{
                entries.forEach(en=>{
                    if(en.isIntersecting){ gm.classList.add('open'); }
                });
            }, { threshold: 0.45 });
            io.observe(gm);
        })();
    </script>
</body>
</html>
