<!DOCTYPE html>
<html lang="{{ $locale }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ __('invite.title') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;600;700&family=Great+Vibes&display=swap" rel="stylesheet">
    <style>
        :root { --bg:#fff7fa; --card:rgba(255,255,255,0.8); --border:#f2dce5; --text:#2c1b1f; --muted:#6b4c55; --primary:#b03060; --primary-2:#ff7aa2; --radius:16px; }
        * { box-sizing:border-box; }
        body { margin:0; color:var(--text); background:radial-gradient(1200px 600px at 80% -100px, #ffe3ec 0%, transparent 50%), linear-gradient(180deg,#fffafc 0%, #ffeaf1 50%, #fff7fa 100%); font-family:Poppins, system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif; }
        .container { max-width: 1080px; margin: 0 auto; padding: 24px; }
        header { position:relative; text-align:center; padding:72px 24px; }
        header::before { content:''; position:absolute; inset:0; background:radial-gradient(800px 300px at 20% -40px, #ffd1dc 0%, transparent 60%), radial-gradient(900px 400px at 120% 40%, #fff3f7 0%, transparent 50%); z-index:-1; }
        h1 { margin:0; font-size: 3rem; font-family: Playfair Display, serif; letter-spacing:0.5px; color:var(--primary); }
        .sub { margin-top:8px; font-size:1rem; color:var(--muted); }
        .guest { margin-top:12px; color:var(--primary); font-weight:600; }
        .lang { margin-top:16px; }
        .lang a { display:inline-block; margin-right:8px; padding:8px 12px; border-radius:999px; border:1px solid var(--border); background:#fff; color:var(--muted); text-decoration:none; transition:all .2s ease; }
        .lang a:hover { color:var(--primary); border-color:var(--primary-2); box-shadow:0 8px 20px rgba(176,48,96,0.08); transform:translateY(-1px); }
        .grid { display:grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        @media (max-width: 860px) { .grid { grid-template-columns: 1fr; } header { padding:56px 16px; } h1 { font-size:2.4rem; } }
        .section { position:relative; background:var(--card); border:1px solid var(--border); border-radius:var(--radius); padding:20px; backdrop-filter:saturate(140%) blur(10px); box-shadow:0 12px 30px rgba(176,48,96,0.08); }
        .section h2 { margin:0 0 12px; font-size:1.2rem; font-weight:700; letter-spacing:0.3px; color:#3a2a2f; }
        .lead { font-size:1.05rem; line-height:1.7; color:#533a41; }
        .actions a, .actions button { display:inline-block; margin:8px 10px 0 0; padding:12px 16px; border-radius:12px; border:1px solid var(--border); background:#fff; text-decoration:none; color:#3a2a2f; font-weight:600; transition:all .2s ease; }
        .btn-primary { background:linear-gradient(180deg, var(--primary) 0%, #9a234e 100%); color:#fff; border-color:transparent; box-shadow:0 10px 24px rgba(176,48,96,0.28); }
        .actions a:hover, .actions button:hover { transform:translateY(-1px); box-shadow:0 10px 24px rgba(0,0,0,0.08); }
        .btn-primary:hover { filter:brightness(1.05); box-shadow:0 14px 32px rgba(176,48,96,0.38); }
        form input, form select, form textarea { width:100%; padding:12px 14px; margin:8px 0 14px; border:1px solid var(--border); border-radius:12px; background:#fff; color:#2c1b1f; outline:none; transition:border-color .2s ease, box-shadow .2s ease; }
        form input:focus, form select:focus, form textarea:focus { border-color:var(--primary-2); box-shadow:0 8px 20px rgba(176,48,96,0.08); }
        iframe { width:100%; height:360px; border:0; border-radius:16px; box-shadow:0 12px 30px rgba(0,0,0,0.06); }
        video { width:100%; height:auto; border-radius:16px; box-shadow:0 12px 30px rgba(0,0,0,0.06); }
        .countdown { display:flex; gap:12px; }
        .tile { flex:1; text-align:center; background:linear-gradient(180deg,#fff 0%, #fff6fa 100%); padding:16px; border-radius:12px; min-width:80px; border:1px solid var(--border); box-shadow:0 6px 18px rgba(0,0,0,0.04); }
        .tile div { font-size:2rem; font-weight:700; color:var(--primary); font-family:Poppins; }
        .tile small { display:block; margin-top:2px; color:#72555d; letter-spacing:0.4px; }
        table { width:100%; border-collapse:collapse; }
        th, td { border-bottom:1px solid #eee; padding:8px; text-align:left; font-size: 0.95rem; }
        .notice { margin-top:6px; color:var(--primary); font-weight:600; }
        .hero { margin-top:16px; overflow:hidden; border-radius:20px; border:1px solid var(--border); box-shadow:0 20px 40px rgba(176,48,96,0.08); }
        .hero img { width:100%; display:block; }
        .gallery { display:grid; grid-template-columns: repeat(3, 1fr); gap:12px; }
        @media (max-width: 860px) { .gallery { grid-template-columns: repeat(2, 1fr); } }
        .gallery img { width:100%; height:180px; object-fit:cover; border-radius:12px; border:1px solid var(--border); cursor:pointer; transition:transform .2s ease, box-shadow .2s ease; box-shadow:0 6px 18px rgba(0,0,0,0.04); }
        .gallery img:hover { transform:translateY(-2px); box-shadow:0 12px 28px rgba(0,0,0,0.08); }
        .lightbox { position:fixed; inset:0; background:rgba(0,0,0,0.7); display:none; align-items:center; justify-content:center; z-index:100; }
        .lightbox.active { display:flex; }
        .lightbox img { max-width:90vw; max-height:80vh; border-radius:12px; box-shadow:0 30px 60px rgba(0,0,0,0.5); }
        .wedding-title { text-align:center; letter-spacing:6px; font-weight:700; color:#3a2a2f; margin:28px 0 12px; }
        .event-grid { display:grid; grid-template-columns: 1fr 1fr; gap:20px; }
        @media (max-width: 860px) { .event-grid { grid-template-columns: 1fr; } }
        .event-card { text-align:center; background:var(--card); border:1px solid var(--border); border-radius:20px; padding:24px; box-shadow:0 12px 30px rgba(176,48,96,0.08); }
        .event-card h3 { font-family: Playfair Display, serif; font-size:2rem; margin:12px 0; color:#2f2327; letter-spacing:1px; }
        .event-card .venue { font-family: Playfair Display, serif; font-size:1.2rem; color:#5a454c; }
        .event-card .addr { color:#6b4c55; margin-top:8px; }
        .event-card .dt { margin-top:12px; font-weight:600; color:#2f2327; }
        .btn-map { display:inline-block; margin-top:16px; padding:12px 16px; border-radius:12px; background:#4aa38b; color:#fff; text-decoration:none; font-weight:700; }
        #coupleIntro { position:fixed; inset:0; z-index:100; display:none; align-items:center; justify-content:center; background: radial-gradient(1200px 800px at 50% 0%, rgba(255,235,243,0.95) 0%, rgba(255,247,250,0.9) 50%, rgba(255,255,255,0.7) 100%); backdrop-filter:saturate(140%) blur(6px); }
        .intro-wrap { position:relative; text-align:center; padding:24px; }
        .intro-names { font-family: Great Vibes, Playfair Display, serif; font-size: clamp(2.6rem, 9vw, 7rem); line-height:1; color:#b03060; letter-spacing:2px; text-shadow: 0 8px 24px rgba(176,48,96,0.2); }
        .intro-amp { display:inline-block; margin:0 18px; font-size: .8em; opacity:.7; }
        .intro-sub { margin-top:10px; font-family:Poppins; color:#6b4c55; letter-spacing:4px; font-weight:700; }
        .intro-glow { position:absolute; left:50%; top:50%; width:520px; height:520px; transform:translate(-50%,-50%); border-radius:50%; filter:blur(80px); background: radial-gradient(circle at 50% 50%, rgba(255,200,220,0.8), rgba(255,240,248,0.6)); z-index:-1; }
        .intro-btn { margin-top:20px; padding:12px 18px; border-radius:999px; background:#b03060; color:#fff; border:none; font-weight:700; box-shadow:0 14px 30px rgba(176,48,96,0.3); }
        .intro-letter { display:inline-block; opacity:0; transform:translateY(24px) scale(0.98); }
        .intro-letter.show { opacity:1; transform:none; transition: transform .5s cubic-bezier(.2,.8,.2,1), opacity .5s; }
        #introCanvas { position:fixed; inset:0; z-index:99; pointer-events:none; }
    </style>
</head>
<body>
    <canvas id="introCanvas"></canvas>
    <div id="coupleIntro">
        <div class="intro-wrap">
            <div class="intro-glow"></div>
            <div id="introNames" class="intro-names"></div>
            <div class="intro-sub">CELEBRATING LOVE</div>
            <button id="introSkip" class="intro-btn">Enter</button>
        </div>
    </div>
    <header>
        <div class="container">
            <h1>{{ __('invite.title') }}</h1>
            <div class="sub">{{ $invite['event']['date'] }} {{ $invite['event']['time'] }} ({{ $invite['event']['timezone'] }}) • {{ $invite['event']['venue_name'] }}</div>
            @if($guestName)
            <div class="guest">Dear {{ $guestName }}, you're invited</div>
            @endif
            <div class="lang" style="margin-top:12px;">
                @foreach($languages as $lang)
                    <a href="{{ route('lang.switch', ['locale' => $lang]) }}">{{ strtoupper($lang) }}</a>
                @endforeach
            </div>
        </div>
    </header>

    <main class="container">
        @if(!empty($invite['media']['hero_image_url']))
        <div class="hero">
            <img src="{{ $invite['media']['hero_image_url'] }}" alt="Wedding banner">
        </div>
        @endif
        @if(!empty($invite['events']) && is_array($invite['events']))
        <div class="wedding-title">THE WEDDING</div>
        <div class="event-grid" style="margin-bottom:16px;">
            @foreach($invite['events'] as $ev)
            <div class="event-card">
                <img src="https://placehold.co/120x60?text=Icon" alt="" style="opacity:.7;">
                <h3>{{ strtoupper($ev['title']) }}</h3>
                <div class="venue">{{ $ev['venue_name'] }}<br>{{ $ev['venue_room'] }}</div>
                <div class="addr">{{ $ev['address_line1'] }}<br>{{ $ev['address_line2'] }}</div>
                <div class="dt">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i', ($ev['date'] ?? '') . ' ' . ($ev['time'] ?? ''), $ev['timezone'] ?? 'UTC')->format('l, d F Y') }}<br>at {{ $ev['time'] }}</div>
                @if(!empty($ev['maps_url']))
                <a class="btn-map" target="_blank" href="{{ $ev['maps_url'] }}">OPEN MAPS</a>
                @endif
            </div>
            @endforeach
        </div>
        @endif
        <div class="grid">
            <div class="section">
                <h2>{{ __('invite.date_time') }}</h2>
                <p>{{ $invite['event']['date'] }} {{ $invite['event']['time'] }} ({{ $invite['event']['timezone'] }})</p>
                <h2 style="margin-top:16px;">{{ __('invite.venue') }}</h2>
                <p><strong>{{ $invite['event']['venue_name'] }}</strong><br>{{ $invite['event']['venue_address'] }}</p>
                <h2 style="margin-top:16px;">{{ __('invite.info') }}</h2>
                <p class="lead">{{ $invite['event']['general_info'] }}</p>
                <div class="actions" style="margin-top:8px;">
                    <a class="btn-primary" href="{{ route('calendar.ics') }}">{{ __('invite.calendar') }}</a>
                </div>
            </div>

            <div class="section">
                <h2>{{ __('invite.countdown') }}</h2>
                <div class="countdown" id="countdown">
                    <div class="tile"><div id="cd-days">0</div><small>{{ __('invite.days') }}</small></div>
                    <div class="tile"><div id="cd-hours">0</div><small>{{ __('invite.hours') }}</small></div>
                    <div class="tile"><div id="cd-min">0</div><small>{{ __('invite.minutes') }}</small></div>
                    <div class="tile"><div id="cd-sec">0</div><small>{{ __('invite.seconds') }}</small></div>
                </div>
                <h2 style="margin-top:16px;">Wedding Video</h2>
                @if(!empty($invite['media']['video_file_url']))
                    <video controls src="{{ $invite['media']['video_file_url'] }}"></video>
                @else
                    <iframe src="{{ $invite['media']['video_embed_url'] }}" allowfullscreen></iframe>
                @endif
            </div>
        </div>

        @if(!empty($invite['media']['gallery']) && is_array($invite['media']['gallery']))
        <div class="section" style="margin-top:16px;">
            <h2>Photo Gallery</h2>
            <div class="gallery" id="gallery">
                @foreach($invite['media']['gallery'] as $img)
                    <img src="{{ $img['url'] }}" alt="{{ $img['alt'] ?? 'Photo' }}" data-full="{{ $img['url'] }}">
                @endforeach
            </div>
        </div>
        <div class="lightbox" id="lightbox"><img id="lightboxImg" alt=""></div>
        @endif

        <div class="grid" style="margin-top:16px;">
            <div class="section">
                <h2>{{ __('invite.rsvp') }}</h2>
                <form id="rsvpForm">
                    <input type="text" name="name" placeholder="{{ __('invite.name') }}" required>
                    <input type="email" name="email" placeholder="{{ __('invite.email') }}">
                    <input type="text" name="phone" placeholder="{{ __('invite.phone') }}">
                    <label>{{ __('invite.attending') }}</label>
                    <select name="attending">
                        <option value="1">{{ __('invite.yes') }}</option>
                        <option value="0">{{ __('invite.no') }}</option>
                    </select>
                    <input type="number" name="guests_count" placeholder="{{ __('invite.guests') }}" value="1" min="1" max="20">
                    <textarea name="message" placeholder="{{ __('invite.message') }}"></textarea>
                    <button type="submit" class="btn-primary">{{ __('invite.submit') }}</button>
                    <div id="rsvpNotice" class="notice"></div>
                </form>
            </div>

            <div class="section">
                <h2>{{ __('invite.wishes') }}</h2>
                <form id="wishForm">
                    <input type="text" name="name" placeholder="{{ __('invite.name') }}" required>
                    <textarea name="message" placeholder="{{ __('invite.message') }}" required></textarea>
                    <button type="submit" class="btn-primary">{{ __('invite.add_wish') }}</button>
                    <div id="wishNotice" class="notice"></div>
                </form>
                <div id="wishList" style="margin-top:12px;">
                    @foreach($wishes as $wish)
                        <p><strong>{{ $wish->name }}</strong>: {{ $wish->message }}</p>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="grid" style="margin-top:16px;">
            <div class="section">
                <h2>{{ __('invite.map') }}</h2>
                <iframe src="{{ $invite['media']['map_embed_url'] }}"></iframe>
            </div>
            <div class="section">
                <h2>{{ __('invite.gifts') }}</h2>
                <div class="actions">
                    @foreach($invite['gifts'] as $g)
                        <a href="{{ $g['url'] }}" target="_blank">{{ $g['label'] }}</a>
                    @endforeach
                </div>
                <h2 style="margin-top:16px;">{{ __('invite.actions') }}</h2>
                <div class="actions">
                    @foreach($invite['custom_actions'] as $a)
                        <a href="{{ $a['url'] }}" target="_blank">{{ $a['label'] }}</a>
                    @endforeach
                </div>
            </div>
        </div>

    </main>

    <script>
        const eventTs = {{ $eventTimestamp }} * 1000;
        function updateCountdown(){
            const now = Date.now();
            let diff = Math.max(0, eventTs - now);
            const d = Math.floor(diff / (1000*60*60*24));
            diff -= d*(1000*60*60*24);
            const h = Math.floor(diff / (1000*60*60));
            diff -= h*(1000*60*60);
            const m = Math.floor(diff / (1000*60));
            diff -= m*(1000*60);
            const s = Math.floor(diff / 1000);
            document.getElementById('cd-days').textContent = d;
            document.getElementById('cd-hours').textContent = h;
            document.getElementById('cd-min').textContent = m;
            document.getElementById('cd-sec').textContent = s;
        }
        setInterval(updateCountdown, 1000);
        updateCountdown();

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
        document.getElementById('wishForm').addEventListener('submit', function(e){
            e.preventDefault();
            const notice = document.getElementById('wishNotice');
            postForm(this, '{{ route('wishes.store') }}', notice, (res)=>{
                const w = res.wish;
                const p = document.createElement('p');
                p.innerHTML = `<strong>${w.name}</strong>: ${w.message}`;
                document.getElementById('wishList').prepend(p);
            });
        });

        const adminToggle = document.getElementById('adminToggle');
        const adminPanel = document.getElementById('adminPanel');
        function loadAdminData(){
            fetch('{{ route('admin.data') }}').then(r=>r.json()).then(res=>{
                if(res.ok){
                    const d = res;
                    let html = '<div class=\"admin-section\"><h4>RSVPs</h4><table class=\"admin-table\"><thead><tr><th>Name</th><th>Email</th><th>Phone</th><th>Attending</th><th>Guests</th><th>Message</th><th>Created</th></tr></thead><tbody>';
                    d.rsvps.forEach(r=>{
                        const created = r.created_at ? new Date(r.created_at).toLocaleString() : '';
                        html += `<tr><td>${r.name||''}</td><td>${r.email||''}</td><td>${r.phone||''}</td><td>${r.attending ? 'Yes' : 'No'}</td><td>${r.guests_count||0}</td><td>${r.message||''}</td><td>${created}</td></tr>`;
                    });
                    html += '</tbody></table></div><div class=\"admin-section\"><h4>Wishes</h4><table class=\"admin-table\"><thead><tr><th>Name</th><th>Message</th><th>Created</th></tr></thead><tbody>';
                    d.wishes.forEach(w=>{
                        const created = w.created_at ? new Date(w.created_at).toLocaleString() : '';
                        html += `<tr><td>${w.name||''}</td><td>${w.message||''}</td><td>${created}</td></tr>`;
                    });
                    html += '</tbody></table></div>';
                    const dataEl = document.getElementById('adminData');
                    if(dataEl) dataEl.innerHTML = html;
                }
            });
        }
        const prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        if(!prefersReduced){
            const coupleIntro = document.getElementById('coupleIntro');
            const introNames = document.getElementById('introNames');
            const introSkip = document.getElementById('introSkip');
            const introCanvas = document.getElementById('introCanvas');
            const couple = { groom: "{{ $invite['couple']['groom'] ?? 'Groom' }}", bride: "{{ $invite['couple']['bride'] ?? 'Bride' }}" };
            function splitLetters(text){
                const frag = document.createDocumentFragment();
                const amp = document.createElement('span');
                amp.className = 'intro-amp intro-letter';
                amp.textContent = '&';
                const parts = [ ...text.groom ], tail = [ ...text.bride ];
                const mk = ch => { const s = document.createElement('span'); s.className = 'intro-letter'; s.textContent = ch; return s; };
                parts.forEach(ch=>frag.appendChild(mk(ch)));
                frag.appendChild(amp);
                tail.forEach(ch=>frag.appendChild(mk(ch)));
                return frag;
            }
            function showCoupleIntro(){
                if(!coupleIntro || !introNames) return;
                coupleIntro.style.display = 'flex';
                introNames.textContent = '';
                introNames.appendChild(splitLetters(couple));
                const letters = Array.from(introNames.querySelectorAll('.intro-letter'));
                letters.forEach((el,i)=>{ setTimeout(()=>el.classList.add('show'), 120 + i*80); });
                launchFireworks();
                setTimeout(closeIntro, 5200);
            }
            function closeIntro(){
                if(!coupleIntro) return;
                coupleIntro.style.opacity = '1';
                coupleIntro.style.transition = 'opacity .6s ease';
                coupleIntro.style.opacity = '0';
                setTimeout(()=>{ coupleIntro.style.display = 'none'; if(window.stopFireworks) window.stopFireworks(); }, 600);
            }
            setTimeout(showCoupleIntro, 300);
            if(introSkip){ introSkip.addEventListener('click', closeIntro); }
            function launchFireworks(){
                const c = document.getElementById('introCanvas');
                if(!c) return;
                const ctx = c.getContext('2d');
                let w = c.width = window.innerWidth, h = c.height = window.innerHeight;
                let particles = [];
                let running = true;
                const colors = ['#ffadbc','#ff6f91','#ffd1dc','#fff0f5','#b03060','#ff7aa2'];
                function burst(x,y){
                    for(let i=0;i<60;i++){
                        const ang = Math.random()*Math.PI*2;
                        const spd = 2+Math.random()*5;
                        particles.push({ x, y, vx: Math.cos(ang)*spd, vy: Math.sin(ang)*spd, life: 60+Math.random()*30, r: 2+Math.random()*2, c: colors[Math.floor(Math.random()*colors.length)] });
                    }
                }
                burst(w*0.4,h*0.45); burst(w*0.6,h*0.45); burst(w*0.5,h*0.35);
                function step(){
                    if(!running) return;
                    ctx.clearRect(0,0,w,h);
                    for(let i=particles.length-1;i>=0;i--){
                        const p = particles[i];
                        p.life -= 1;
                        if(p.life<=0){ particles.splice(i,1); continue; }
                        p.vy += 0.04;
                        p.x += p.vx;
                        p.y += p.vy;
                        ctx.globalAlpha = Math.max(0, p.life/90);
                        ctx.fillStyle = p.c;
                        ctx.beginPath();
                        ctx.arc(p.x, p.y, p.r, 0, Math.PI*2);
                        ctx.fill();
                    }
                    requestAnimationFrame(step);
                }
                window.addEventListener('resize', ()=>{ w = c.width = window.innerWidth; h = c.height = window.innerHeight; });
                step();
                c.addEventListener('click', e=>{ burst(e.clientX, e.clientY); });
                window.stopFireworks = function(){ running = false; ctx.clearRect(0,0,w,h); };
            }
        }
        if(adminToggle && adminPanel){
            @if(session('open_admin'))
            adminPanel.classList.add('active');
            @if(session('admin'))
            loadAdminData();
            @endif
            @endif
            adminToggle.addEventListener('click', ()=>{
                adminPanel.classList.toggle('active');
                @if(session('admin'))
                if(adminPanel.classList.contains('active')){ loadAdminData(); }
                @endif
            });
        }
        const galleryEl = document.getElementById('gallery');
        const lightbox = document.getElementById('lightbox');
        const lightboxImg = document.getElementById('lightboxImg');
        if(galleryEl && lightbox && lightboxImg){
            galleryEl.addEventListener('click', (e)=>{
                const t = e.target;
                if(t && t.tagName === 'IMG'){
                    lightboxImg.src = t.dataset.full;
                    lightbox.classList.add('active');
                }
            });
            lightbox.addEventListener('click', ()=>{ lightbox.classList.remove('active'); });
        }
    </script>
</body>
</html>
