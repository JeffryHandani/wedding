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
    (function(){
        const prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        if(prefersReduced) return;
        const c = document.getElementById('introCanvas');
        if(!c) return;
        const ctx = c.getContext('2d');
        let w = c.width = window.innerWidth, h = c.height = window.innerHeight;
        let ambientAlpha = 0.35;
        let running = true;
        const blobs = [];
        const palette = ['#ffadbc','#ffd1dc','#fff0f5','#ff7aa2','#b03060'];
        for(let i=0;i<22;i++){
            const r = 18 + Math.random()*36;
            const x = Math.random()*w;
            const y = Math.random()*h;
            const ang = Math.random()*Math.PI*2;
            const spd = 0.2 + Math.random()*0.6;
            const col = palette[Math.floor(Math.random()*palette.length)];
            blobs.push({x,y,r,ang,spd,col,tw: Math.random()*Math.PI*2});
        }
        function draw(){
            if(!running) return;
            ctx.clearRect(0,0,w,h);
            const grd = ctx.createRadialGradient(w*0.5,h*0.3,10,w*0.5,h*0.5, Math.max(w,h)*0.7);
            grd.addColorStop(0,'rgba(255,235,243,0.6)');
            grd.addColorStop(0.5,'rgba(255,245,250,0.4)');
            grd.addColorStop(1,'rgba(255,255,255,0.2)');
            ctx.fillStyle = grd;
            ctx.fillRect(0,0,w,h);
            for(const b of blobs){
                b.tw += 0.01;
                b.ang += (Math.sin(b.tw)*0.008);
                b.x += Math.cos(b.ang)*b.spd;
                b.y += Math.sin(b.ang)*b.spd;
                if(b.x < -120) b.x = w+120;
                if(b.x > w+120) b.x = -120;
                if(b.y < -120) b.y = h+120;
                if(b.y > h+120) b.y = -120;
                ctx.globalAlpha = ambientAlpha;
                const rg = ctx.createRadialGradient(b.x,b.y,0,b.x,b.y,b.r);
                rg.addColorStop(0, b.col);
                rg.addColorStop(1, 'transparent');
                ctx.fillStyle = rg;
                ctx.beginPath();
                ctx.arc(b.x, b.y, b.r, 0, Math.PI*2);
                ctx.fill();
            }
            requestAnimationFrame(draw);
        }
        window.addEventListener('resize', ()=>{ w = c.width = window.innerWidth; h = c.height = window.innerHeight; });
        window.setIntroAmbientAlpha = function(a){ ambientAlpha = a; };
        window.stopIntroAmbient = function(){ running = false; try { ctx.clearRect(0,0,w,h); } catch{} c.style.display = 'none'; };
        // draw();
    })();
    (function(){
        const audio = document.getElementById('bgMusic');
        const toggle = document.getElementById('musicToggle');
        const iconPath = document.getElementById('musicIconPath');
        if(!audio || !toggle) return;
        audio.autoplay = false;
        audio.volume = 0.55;
        audio.muted = false;
        let userActivated = false;
        const iconOn = 'M14 3.23v17.54a1 1 0 0 1-1.64.77L7.6 17H4a1 1 0 0 1-1-1v-8a1 1 0 0 1 1-1h3.6l4.76-4.54A1 1 0 0 1 14 3.23zM17.5 8.5a1 1 0 0 1 1.41 0A4.98 4.98 0 0 1 20.5 12a4.98 4.98 0 0 1-1.59 3.5 1 1 0 1 1-1.36-1.46A2.99 2.99 0 0 0 18.5 12a2.99 2.99 0 0 0-.95-2.04 1 1 0 0 1-.05-1.46z';
        const iconMuted = 'M14 3.23v17.54a1 1 0 0 1-1.64.77L7.6 17H4a1 1 0 0 1-1-1v-8a1 1 0 0 1 1-1h3.6l4.76-4.54A1 1 0 0 1 14 3.23zM17.71 8.29a1 1 0 0 1 0 1.42L15.41 12l2.3 2.29a1 1 0 1 1-1.42 1.42L14 13.41l-2.29 2.3a1 1 0 0 1-1.42-1.42l2.3-2.29-2.3-2.29a1 1 0 1 1 1.42-1.42L14 10.59l2.29-2.3a1 1 0 0 1 1.42 0z';

        function setToggleState(){
            const muted = audio.muted;
            toggle.classList.toggle('muted', muted);
            toggle.setAttribute('aria-label', muted ? 'Unmute music' : 'Mute music');
            toggle.setAttribute('title', muted ? 'Unmute music' : 'Mute music');
            if(iconPath){ iconPath.setAttribute('d', muted ? iconMuted : iconOn); }
        }

        function tryPlay(){
            if(document.hidden) return;
            let p;
            try { p = audio.play(); } catch(_) { p = null; }
            if(p && typeof p.catch === 'function'){
                p.catch(()=>{});
            }
        }

        function startMusicFromGesture(){
            userActivated = true;
            audio.muted = false;
            setToggleState();
            tryPlay();
        }
        function startMusicWithVideo(){
            tryPlay();
        }

        toggle.addEventListener('click', ()=>{
            userActivated = true;
            audio.muted = !audio.muted;
            setToggleState();
            if(!audio.muted){ tryPlay(); }
        });
        window.startBackgroundMusic = startMusicFromGesture;
        window.startBackgroundMusicAuto = startMusicWithVideo;

        document.addEventListener('visibilitychange', ()=>{
            if(document.hidden){
                audio.pause();
                return;
            }
            if(userActivated){ tryPlay(); }
        });

        window.addEventListener('focus', ()=>{ if(!document.hidden && userActivated) tryPlay(); });
        window.addEventListener('pageshow', ()=>{ if(!document.hidden && userActivated) tryPlay(); });
        setToggleState();
    })();
    (function(){
        const prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        const hero = document.querySelector('.hero');
        const openInvitationBtn = document.getElementById('openInvitationBtn');
        if(document.body){ document.body.classList.add('pre-invite'); }
        if(prefersReduced){
            if(hero){ hero.classList.add('hero-seq'); }
            if(openInvitationBtn){
                openInvitationBtn.addEventListener('click', ()=>{
                    if(document.body){ document.body.classList.remove('pre-invite'); }
                    openInvitationBtn.style.display = 'none';
                });
            }
            return;
        }
        const bookIntro = document.getElementById('bookIntro');
        const openingVideo = document.getElementById('openingVideo');
        const bookEnter = document.getElementById('bookEnter');
        let invitationOpened = false;
        let closed = false;
        let readyToEnter = false;
        let introVideoInitialized = false;
        let introVideoEnded = false;
        function setEnterReady(v){
            readyToEnter = !!v;
            if(bookEnter){ bookEnter.disabled = !readyToEnter; }
        }
        function showBook(){
            if(!bookIntro) return;
            bookIntro.style.display = 'flex';
            const setAlpha = window.setIntroAmbientAlpha || null;
            if(setAlpha) setAlpha(0.6);
            if(openingVideo){
                setEnterReady(false);
                bookIntro.classList.remove('show-names');
                openingVideo.loop = false;
                // Best-effort autoplay (some phones require a user gesture even if muted).
                openingVideo.muted = true;
                openingVideo.defaultMuted = true;
                openingVideo.autoplay = true;
                openingVideo.volume = 0;
                openingVideo.playsInline = true;
                openingVideo.setAttribute('muted', '');
                openingVideo.setAttribute('playsinline', '');
                openingVideo.setAttribute('webkit-playsinline', '');

                const trySeekStart = () => { try { openingVideo.currentTime = 0; } catch(_) {} };
                const gestureEvents = ['pointerdown', 'touchstart', 'touchend', 'mousedown', 'keydown'];
                let playAttempts = 0;
                let gestureBound = false;

                const bindGestureToPlay = () => {
                    if(gestureBound) return;
                    gestureBound = true;
                    const handler = () => { tryPlay('gesture'); };
                    gestureEvents.forEach((ev)=>{
                        window.addEventListener(ev, handler, { once:true, passive:true, capture:true });
                    });
                };

                const tryPlay = (_reason) => {
                    playAttempts += 1;
                    let p;
                    try { p = openingVideo.play(); } catch(_) { p = null; }
                    if(!p || typeof p.then !== 'function'){
                        bindGestureToPlay();
                        return;
                    }
                    p.catch(()=>{
                        // Keep the user out of a "press play" requirement: start on first tap anywhere.
                        bindGestureToPlay();
                        if(playAttempts < 6){
                            const delay = Math.min(1500, 150 * playAttempts * playAttempts);
                            setTimeout(()=>{ if(openingVideo.paused) tryPlay('retry'); }, delay);
                        } else {
                            // Last-resort: don't trap users forever if a device blocks playback completely.
                            setTimeout(()=>{
                                if(openingVideo.paused){
                                    bookIntro.classList.add('show-names');
                                    setEnterReady(true);
                                }
                            }, 1200);
                        }
                    });
                };

                if(!introVideoInitialized){
                    introVideoInitialized = true;
                    // Initialize only once so the intro video never restarts automatically.
                    try { openingVideo.pause(); } catch(_) {}
                    try { openingVideo.load(); } catch(_) {}
                    trySeekStart();
                    openingVideo.addEventListener('loadedmetadata', trySeekStart, { once:true });
                    openingVideo.addEventListener('canplay', ()=>{ if(!introVideoEnded && openingVideo.paused) tryPlay('canplay'); });
                    document.addEventListener('visibilitychange', ()=>{
                        if(document.hidden){
                            try { openingVideo.pause(); } catch(_) {}
                            return;
                        }
                        if(invitationOpened && !introVideoEnded && openingVideo.paused){
                            tryPlay('resume');
                        }
                    });
                    tryPlay('init');
                }
            } else {
                setTimeout(()=>{ bookIntro.classList.add('show-names'); }, 16000);
                setEnterReady(true);
            }
        }
        function closeBook(){
            if(closed) return;
            closed = true;
            bookIntro.style.opacity = '1';
            bookIntro.style.transition = 'opacity .6s ease';
            bookIntro.style.opacity = '0';
            const setAlpha = window.setIntroAmbientAlpha || null;
            setTimeout(()=>{
                bookIntro.style.display = 'none';
                if(hero){ hero.classList.add('hero-seq'); }
                if(setAlpha) setAlpha(0.0);
                if(window.stopIntroAmbient) window.stopIntroAmbient();
            }, 600);
        }
        if(openingVideo){
            const startMusicOnVideoStart = () => {
                if(window.startBackgroundMusicAuto){ window.startBackgroundMusicAuto(); }
            };
            openingVideo.addEventListener('play', startMusicOnVideoStart);
            openingVideo.addEventListener('playing', startMusicOnVideoStart);
            openingVideo.addEventListener('timeupdate', ()=>{
                if(openingVideo.currentTime >= 18){
                    bookIntro.classList.add('show-names');
                }
            });
            openingVideo.addEventListener('ended', ()=>{
                introVideoEnded = true;
                bookIntro.classList.add('show-names');
                setEnterReady(true);
            });
        }
        if(openInvitationBtn){
            openInvitationBtn.addEventListener('click', ()=>{
                if(invitationOpened) return;
                invitationOpened = true;
                const wrap = document.querySelector('.wrap');
                if(wrap && bookIntro && bookIntro.parentElement !== wrap){
                    wrap.prepend(bookIntro);
                }
                if(document.body){
                    document.body.classList.remove('pre-invite');
                    document.body.classList.add('scrollable-video');
                }
                openInvitationBtn.style.display = 'none';
                if(window.startBackgroundMusic){ window.startBackgroundMusic(); }
                showBook();
            });
        }
        if(bookEnter){
            bookEnter.disabled = true;
            bookEnter.addEventListener('click', ()=>{
                if(!readyToEnter) return;
                closeBook();
            });
        }
    })();
    document.getElementById('wishForm').addEventListener('submit', function(e){
        e.preventDefault();
        const notice = document.getElementById('wishNotice');
        postForm(this, '{{ route('wishes.store') }}', notice, (res)=>{
            const w = res.wish;
            const initials = (w.name || '')
                .trim()
                .split(/\s+/)
                .slice(0, 2)
                .map((p)=> (p[0] || '').toUpperCase())
                .join('') || 'G';
            const msg = (w.message || '');
            const lower = msg.toLowerCase();
            const isAbsent = lower.includes('tidak hadir') || lower.includes('not attending') || lower.includes('cannot attend') || lower.includes('can not attend');
            const dt = w.created_at ? new Date(w.created_at) : new Date();
            const timeText = dt.toLocaleString('en-GB', {
                day: 'numeric',
                month: 'long',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                hour12: false
            }).replace(',', ' at').replace(':', '.');
            const div = document.createElement('div');
            div.className = 'wish-card';
            div.innerHTML = `
                <div class="wish-avatar">${initials}</div>
                <div class="wish-body">
                    <div class="wish-head">
                        <span class="wish-name">${w.name || ''}</span>
                        <span class="wish-badge${isAbsent ? ' absent' : ''}">${isAbsent ? 'Tidak Hadir' : 'Hadir'}</span>
                    </div>
                    <div class="wish-text">${msg}</div>
                    <div class="wish-time">${timeText}</div>
                </div>
            `;
            document.getElementById('wishList').prepend(div);
            if(window.refreshWishPagination){
                window.refreshWishPagination(true);
            }
        });
    });
    (function(){
        const list = document.getElementById('wishList');
        const pager = document.getElementById('wishPagination');
        const prev = document.getElementById('wishPrev');
        const next = document.getElementById('wishNext');
        const info = document.getElementById('wishPageInfo');
        if(!list || !pager || !prev || !next || !info) return;
        const pageSize = 5;
        let currentPage = 1;
        function cards(){
            return Array.from(list.querySelectorAll('.wish-card'));
        }
        function emptyState(){
            return list.querySelector('.wish-empty');
        }
        function render(){
            const items = cards();
            const empty = emptyState();
            if(empty){ empty.style.display = items.length ? 'none' : ''; }
            const totalPages = Math.max(1, Math.ceil(items.length / pageSize));
            if(currentPage > totalPages){ currentPage = totalPages; }
            if(currentPage < 1){ currentPage = 1; }
            const start = (currentPage - 1) * pageSize;
            const end = start + pageSize;
            items.forEach((el, i)=>{
                el.style.display = (i >= start && i < end) ? '' : 'none';
            });
            pager.style.display = items.length > pageSize ? 'flex' : 'none';
            info.textContent = `${currentPage} / ${totalPages}`;
            prev.disabled = currentPage <= 1;
            next.disabled = currentPage >= totalPages;
        }
        prev.addEventListener('click', ()=>{ currentPage -= 1; render(); });
        next.addEventListener('click', ()=>{ currentPage += 1; render(); });
        window.refreshWishPagination = function(resetToFirst){
            if(resetToFirst){ currentPage = 1; }
            render();
        };
        render();
    })();
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
        async function copyText(value){
            const text = (value || '').trim();
            if(!text) return false;
            try {
                if(navigator.clipboard && window.isSecureContext){
                    await navigator.clipboard.writeText(text);
                    return true;
                }
            } catch(_) {}
            try {
                const ta = document.createElement('textarea');
                ta.value = text;
                ta.setAttribute('readonly', '');
                ta.style.position = 'fixed';
                ta.style.top = '-9999px';
                document.body.appendChild(ta);
                ta.select();
                ta.setSelectionRange(0, text.length);
                const ok = document.execCommand('copy');
                document.body.removeChild(ta);
                return !!ok;
            } catch(_) {
                return false;
            }
        }
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
                cp.onclick = async ()=>{
                    const num = document.getElementById('giftAccount')?.textContent || '';
                    if(num){
                        const ok = await copyText(num);
                        cp.textContent = ok ? 'Copied' : 'Copy failed';
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
        const g = document.getElementById('gallery');
        const lb = document.getElementById('galleryLightbox');
        const lbi = document.getElementById('galleryLightboxImg');
        if(g && lb && lbi){
            g.addEventListener('click', (e)=>{
                const t = e.target;
                if(t && t.tagName === 'IMG'){
                    lbi.src = t.dataset.full;
                    lb.style.display = 'flex';
                }
            });
            lb.addEventListener('click', ()=>{ lb.style.display = 'none'; });
        }
    })();
    (function(){
        const prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        if(prefersReduced) return;
        const gm = document.querySelector('.gift-magic');
        if(!gm) return;
        const scroller = document.querySelector('.wrap');
        const io = new IntersectionObserver((entries)=>{
            entries.forEach(en=>{
                if(en.isIntersecting){
                    gm.classList.add('open');
                    io.unobserve(gm);
                }
            });
        }, { threshold: 0.2, root: scroller || null });
        io.observe(gm);
    })();
    (function(){
        const prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        if(prefersReduced) return;
        const io = new IntersectionObserver((entries)=>{
            entries.forEach(en=>{
                const el = en.target;
                if(en.isIntersecting){
                    el.classList.add('in');
                    if(el.id === 'gallery'){
                        const imgs = Array.from(el.querySelectorAll('img'));
                        imgs.forEach((im, i)=>{ im.classList.add('reveal'); im.style.transitionDelay = `${i*60}ms`; im.classList.add('in'); });
                    }
                    io.unobserve(el);
                }
            });
        }, { threshold: 0.15 });
        const targets = Array.from(document.querySelectorAll('.hero, .section, .event-card, .person, .wishes-wrap, .rsvp-wrap, .gift-magic, #gallery'));
        targets.forEach((el,i)=>{ el.classList.add('reveal'); el.style.transitionDelay = `${Math.min(i*40,400)}ms`; io.observe(el); });
    })();
</script>
