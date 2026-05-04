<style>
    :root { --text:#2c1b1f; --muted:#6b4c55; --border:#e7d7de; --primary:#b03060; --bg1:#fff0f5; --bg2:#f9f1f7; --bg3:#ffffff; --bg4:#f5f7ff; --bg5:#f1fbf7; --bg6:#fffdf2; --bg7:#f8f0ff; --teal:#55949a; --mobile-wrap:500px; }
    * { box-sizing:border-box; }
    body { margin:0; color:var(--text); background:#fff; font-family:Poppins, system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif; }
    .wrap { width:100%; max-width:none; margin:0; padding:0; }
    .desktop-left { display:none; }
    .hero { position:relative; text-align:center; width:100vw; margin-left:calc(50% - 50vw); margin-right:calc(50% - 50vw); line-height:0; overflow:hidden; background:var(--bg1); }
    .hero-mobile { position:relative; display:block; height:100vh; min-height:100vh; }
    .hero-mobile picture { display:block; width:100%; height:100%; }
    .hero-bg { width:100%; height:100%; object-fit:cover; object-position:center; display:block; }
    .hero-desktop { display:none; }
    .hero-left img, .hero-right-bg { width:100%; height:100%; object-fit:cover; display:block; }
    .hero-right { position:relative; overflow:hidden; }
    .title { font-family: Cinzel, Playfair Display, serif; font-size: 20px; letter-spacing:6px; text-transform:uppercase; }
    .names { font-family: Great Vibes, Playfair Display, serif; font-size: clamp(3.4rem, 13vw, 7rem); line-height:1; color:#644E33; margin-top:12px; }
    .date { margin-top:16px; letter-spacing:8px; font-weight:700; font-size:1.2rem; text-transform:uppercase; }
    .hero-copy { position:absolute; text-align:center; line-height:normal; z-index:2; }
    .hero-copy-mobile { left:50%; top:12%; transform:translate(-50%,-50%); width:94vw; }
    .hero-copy-desktop { left:50%; top:52%; transform:translate(-50%,-50%); width:88%; }
    .hero-copy-desktop .title { font-size:clamp(1rem, 1.3vw, 1.25rem); letter-spacing:3px; color:#8b646a; }
    .hero-copy-desktop .names { font-size:clamp(2.4rem, 4vw, 3.8rem); margin-top:8px; }
    .hero-copy-desktop .date { font-size:clamp(.82rem, .95vw, 1rem); letter-spacing:4px; margin-top:10px; color:#6b4c55; }
    @media (min-width: 861px) {
        body { overflow:hidden; background:#101317; }
        .desktop-left { display:block; position:fixed; inset:0 var(--mobile-wrap) 0 0; background:url('{{ $invite['assets']['hero_desktop'] ?? '/images/hero_bg.svg' }}') center/cover no-repeat; }
        .wrap { position:fixed; top:0; right:0; width:var(--mobile-wrap); max-width:var(--mobile-wrap); height:100vh; overflow-y:auto; overflow-x:hidden; background:#fff; z-index:2; box-shadow:-14px 0 34px rgba(0,0,0,0.25); }
        .hero, .section { width:100%; margin-left:0; margin-right:0; }
        .section { min-height:auto; padding:44px 18px; }
        .hero-desktop { display:none; }
        .hero-mobile { display:block; }
        .hero-mobile picture { display:none; }
        .hero-mobile { height:100vh; min-height:100vh; background:url('{{ $invite['assets']['hero_mobile'] ?? ($invite['assets']['hero_desktop'] ?? '/images/hero_bg.svg') }}') center/cover no-repeat; }
        .hero-copy-mobile { width:90%; top:14%; }
        .hero-copy-mobile .title { font-size:1.05rem; letter-spacing:3px; }
        .hero-copy-mobile .names { font-size:clamp(2.5rem, 9vw, 3.6rem); margin-top:8px; }
        .hero-copy-mobile .date { font-size:.92rem; letter-spacing:4px; margin-top:10px; }
        .two { grid-template-columns:1fr; }
        .proto { grid-template-columns:repeat(2, 1fr); }
        .couple-grid { grid-template-columns:1fr; gap:28px; }
        .person-photo { width:140px; height:140px; margin-bottom:50px; }
        .person-photo::after { width:160px; height:90px; bottom:-42px; }
        .bg-gallery { padding:14px 0; min-height:auto; }
        .gallery, .gallery.full { grid-template-columns:repeat(2, 1fr); }
        .gallery.full { gap:8px; padding:8px; }
        .gallery.full img { grid-column:span 1 !important; aspect-ratio:3 / 4; min-height:180px; border-radius:10px; }
    }
    .hero .title, .hero .names, .hero .date { opacity:0; transform:translateY(14px); }
    .hero.hero-seq .title, .hero.hero-seq .names, .hero.hero-seq .date { animation: heroTextIn .8s ease forwards; }
    .hero.hero-seq .title { animation-delay:.2s; }
    .hero.hero-seq .names { animation-delay:.7s; }
    .hero.hero-seq .date { animation-delay:1.2s; }
    @keyframes heroTextIn { from { opacity:0; transform:translateY(14px); } to { opacity:1; transform:none; } }
    @media (prefers-reduced-motion: reduce) { .hero .title, .hero .names, .hero .date { opacity:1; transform:none; animation:none; } }
    .section { margin:0; padding:8vh 8vw; border-top:1px solid var(--border); background:#fff; width:100vw; margin-left:calc(50% - 50vw); margin-right:calc(50% - 50vw); min-height:70vh; display:flex; flex-direction:column; justify-content:center; }
    .bg-couple { background: var(--bg3); }
    .bg-events { background: #9fa1a4; color:#ffffff; }
    .bg-protocol { background: var(--bg5); }
    .bg-rsvp { background: var(--bg6); }
    .bg-gifts { background: var(--teal); color:#fff; min-height:56vh; }
    .bg-gifts h2, .bg-gifts div { color:#fff; }
    .bg-wishes { background: var(--bg3); }
    .floral-theme { position:relative; background:url('/images/background.webp') center/cover no-repeat !important; }
    .floral-theme::before { content:""; position:absolute; inset:0; background:rgba(255,255,255,0.78); pointer-events:none; }
    .floral-theme > * { position:relative; z-index:1; }
    .floral-theme.bg-events .events-title,
    .floral-theme.bg-events .events-date,
    .floral-theme.bg-events .card h3,
    .floral-theme.bg-events .venue,
    .floral-theme.bg-events .addr,
    .floral-theme.bg-events .start { color:#3d2a30 !important; opacity:1 !important; }
    .floral-theme.bg-gifts, .floral-theme.bg-gifts h2, .floral-theme.bg-gifts div { color:var(--text) !important; }
    .floral-theme.bg-events .event-card { background:rgba(255,255,255,0.72); border:2px solid #efcfd9; box-shadow:0 8px 18px rgba(143,93,112,0.10); }
    .bg-gallery { background: var(--bg3); padding: 2vh 0; min-height: 100vh; }
    .gallery { display:grid; grid-template-columns: repeat(3, 1fr); gap:12px; }
    .gallery.full { grid-template-columns: repeat(12, 1fr); grid-auto-flow:dense; gap:10px; padding:10px; }
    @media (max-width: 860px) { .gallery { grid-template-columns: repeat(2, 1fr); } .gallery.full { grid-template-columns: repeat(2, 1fr); gap:8px; padding:8px; } }
    .gallery img { width:100%; height:200px; object-fit:cover; border-radius:12px; border:1px solid var(--border); cursor:pointer; box-shadow:0 6px 18px rgba(0,0,0,0.04); }
    .gallery.full img { height:100%; min-height:220px; border-radius:14px; border:none; box-shadow:none; }
    .gallery.full img:nth-child(1) { grid-column: span 7; aspect-ratio: 16 / 9; }
    .gallery.full img:nth-child(2) { grid-column: span 5; aspect-ratio: 3 / 4; }
    .gallery.full img:nth-child(3) { grid-column: span 4; aspect-ratio: 4 / 5; }
    .gallery.full img:nth-child(4) { grid-column: span 8; aspect-ratio: 21 / 9; }
    .gallery.full img:nth-child(5) { grid-column: span 6; aspect-ratio: 1 / 1; }
    .gallery.full img:nth-child(6) { grid-column: span 6; aspect-ratio: 4 / 3; }
    .gallery.full img:nth-child(7) { grid-column: span 5; aspect-ratio: 3 / 4; }
    .gallery.full img:nth-child(8) { grid-column: span 7; aspect-ratio: 16 / 10; }
    @media (max-width: 860px) { .gallery.full img { grid-column: span 1 !important; aspect-ratio: 3 / 4; min-height:180px; border-radius:10px; } }
    .lightbox { position:fixed; inset:0; background:rgba(0,0,0,0.7); display:none; align-items:center; justify-content:center; z-index:1000; }
    .lightbox img { max-width:90vw; max-height:80vh; border-radius:12px; box-shadow:0 30px 60px rgba(0,0,0,0.5); }
    .gift-magic { position:relative; width:clamp(170px, 36vw, 260px); margin:14px auto 12px; padding:16px; border-radius:28px; background:linear-gradient(180deg, rgba(255,255,255,0.72) 0%, rgba(255,245,250,0.72) 100%); border:1px solid #f2d8e3; box-shadow:0 10px 24px rgba(172,122,146,0.18); }
    .gift-magic img { position:relative; display:block; z-index:2; width:100%; filter: drop-shadow(0 10px 16px rgba(0,0,0,0.20)) saturate(1.1) hue-rotate(-8deg); }
    .gift-magic .glow { position:absolute; left:50%; top:46%; width:280px; height:280px; transform:translate(-50%,-50%); border-radius:50%; background: radial-gradient(circle at 50% 50%, rgba(255,188,221,0.95), rgba(255,232,242,0.62) 55%, rgba(255,245,250,0.25) 100%); filter:blur(36px); z-index:1; animation: pulse 3.6s ease-in-out infinite; }
    .gift-magic .star { position:absolute; width:10px; height:10px; border-radius:50%; background: radial-gradient(circle, #fff 0%, rgba(255,255,255,0.7) 50%, transparent 100%); opacity:0; animation: twinkle 2.4s ease-in-out infinite; }
    .gift-magic .s1 { left:-6px; top:16px; animation-delay:.1s; }
    .gift-magic .s2 { left:18px; top:-6px; animation-delay:.5s; }
    .gift-magic .s3 { right:8px; top:2px; animation-delay:.9s; }
    .gift-magic .s4 { right:-8px; bottom:20px; animation-delay:1.2s; }
    .gift-magic .s5 { left:2px; bottom:-4px; animation-delay:1.6s; }
    .gift-magic .lid { position:absolute; top:6%; left:50%; transform:translateX(-50%); width:68%; height:18%; background: linear-gradient(180deg,#fff6fa 0%, #ffd9e8 100%); border:2px solid rgba(157,95,125,0.78); border-radius:10px; box-shadow:0 10px 16px rgba(0,0,0,0.18); z-index:3; transform-origin:50% 100%; }
    .gift-magic.open .lid { animation: lidLift 1.9s cubic-bezier(.18,.82,.2,1) forwards; }
    .gift-magic.open img { animation: boxReveal 1.5s ease both; }
    .gift-magic.open .star { animation-duration: 2s; }
    @keyframes pulse { 0% { transform:translate(-50%,-50%) scale(0.98);} 50% { transform:translate(-50%,-50%) scale(1.02);} 100% { transform:translate(-50%,-50%) scale(0.98);} }
    @keyframes twinkle { 0% { opacity:0; transform:scale(0.6) translateY(8px);} 50% { opacity:1; transform:scale(1) translateY(0);} 100% { opacity:0; transform:scale(0.6) translateY(-8px);} }
    @keyframes lidLift {
        0% { transform:translateX(-50%) rotate(0) translateY(0); }
        35% { transform:translateX(-50%) rotate(-8deg) translateY(-18px); }
        70% { transform:translateX(-50%) rotate(-18deg) translateY(-44px); }
        100% { transform:translateX(-50%) rotate(-15deg) translateY(-40px); }
    }
    @keyframes boxReveal {
        0% { transform:translateY(10px) scale(0.95) rotate(-1deg); filter:saturate(.95); }
        45% { transform:translateY(0) scale(1.05) rotate(1deg); filter:saturate(1.15); }
        100% { transform:none; filter:none; }
    }
    #openGift.btn { margin-top:10px; min-width:188px; border-radius:16px; padding:13px 24px; letter-spacing:5px; border:1px solid #cf8fad; color:#fff; background:linear-gradient(180deg,#d17aa2 0%, #b85d88 100%); box-shadow:0 10px 22px rgba(166,85,126,0.32); font-weight:800; }
    #openGift.btn:hover { filter:brightness(1.03); transform:translateY(-1px); }
    #openGift.btn:active { transform:translateY(0); }
    .wishes-wrap { max-width:560px; margin:0 auto; text-align:center; }
    .wishes-kicker { letter-spacing:6px; font-weight:700; font-size:0.92rem; margin-bottom:6px; color:#1f2330; text-transform:uppercase; }
    .wishes-title { font-family: Playfair Display, serif; font-size: clamp(3.2rem, 12vw, 4.8rem); letter-spacing:3px; margin-bottom:8px; color:#2b1e2b; line-height:1; }
    .wishes-desc { color:#6f4f60; letter-spacing:3px; font-size:12px; margin-bottom:18px; text-transform:uppercase; }
    .wishes-form label { display:block; text-align:left; letter-spacing:4px; font-weight:700; font-size:0.82rem; margin:14px 0 8px; color:#1f2330; text-transform:uppercase; }
    .wishes-form input, .wishes-form textarea { background:rgba(255,255,255,0.84); border:1px solid #f0d8e2; border-radius:12px; color:#202431; padding:10px 14px; margin:6px 0 10px; }
    .wishes-form input::placeholder, .wishes-form textarea::placeholder { color:#9ba7b5; letter-spacing:3px; text-transform:uppercase; }
    .btn-teal { background:linear-gradient(180deg,#d17aa2 0%, #b85d88 100%); color:#fff; border-color:#cf8fad; }
    .wishes-form .btn-teal { display:block; margin:16px auto 0; min-width:170px; border-radius:16px; padding:12px 24px; letter-spacing:5px; color:#fff; border:1px solid #9f5379; background:linear-gradient(180deg,#bf5f8e 0%, #9f3f6d 100%); box-shadow:0 10px 20px rgba(138,56,95,0.34); }
    .wishes-notice { color:var(--primary); margin-top:8px; }
    .wishes-list { max-width:520px; margin:16px auto 0; text-align:center; }
    .wishes-wrap hr { border:0; border-top:1px solid #eed6df; margin:16px 0 14px; }
    .wishes-list .wish-empty { color:#3a2a35; font-size:2rem; font-family: Playfair Display, serif; border-bottom:0; padding:22px 0 8px; }
    .wish-card { display:flex; gap:12px; text-align:left; background:#fff; border:1px solid #edf0f2; border-radius:12px; padding:12px; margin-bottom:10px; box-shadow:0 4px 10px rgba(0,0,0,0.04); }
    .wish-avatar { width:38px; height:38px; border-radius:50%; display:flex; align-items:center; justify-content:center; font-weight:700; font-size:0.9rem; color:#1d2430; flex-shrink:0; background:#f2d9ff; }
    .wish-body { min-width:0; flex:1; }
    .wish-head { display:flex; align-items:center; gap:8px; flex-wrap:wrap; }
    .wish-name { font-weight:700; font-size:1.05rem; line-height:1.2; color:#0f172a; }
    .wish-badge { padding:2px 10px; border-radius:999px; font-size:0.78rem; font-weight:700; letter-spacing:.3px; background:#c8f1f7; color:#0c5661; }
    .wish-badge.absent { background:#bfe6f0; color:#0b4a57; }
    .wish-text { margin-top:4px; color:#111827; line-height:1.4; }
    .wish-time { margin-top:6px; color:#374151; font-size:0.95rem; }
    .wish-pagination { display:flex; align-items:center; justify-content:center; gap:10px; margin-top:14px; }
    .wish-page-btn { border:1px solid #e2bfd0; background:#fff8fc; color:#7a4e64; border-radius:999px; padding:6px 12px; font-weight:700; cursor:pointer; }
    .wish-page-btn:disabled { opacity:.45; cursor:not-allowed; }
    .wish-page-info { color:#4b5563; font-size:0.92rem; min-width:84px; text-align:center; }
    .rsvp-wrap { max-width:560px; margin:0 auto; text-align:center; }
    .rsvp-kicker { letter-spacing:4px; font-weight:700; font-size:0.9rem; margin-bottom:6px; }
    .rsvp-title { font-family: Playfair Display, serif; font-size: clamp(2.2rem, 7vw, 3.2rem); letter-spacing:4px; margin-bottom:8px; }
    .rsvp-desc { color:var(--muted); letter-spacing:2px; font-size:0.95rem; margin-bottom:16px; }
    .rsvp-script { font-family: Great Vibes, Playfair Display, serif; font-size: 38px; color:#7a4e64; line-height:1.08; margin:0 0 18px; }
    .rsvp-form label { display:block; text-align:left; letter-spacing:4px; font-weight:700; font-size:0.82rem; margin:14px 0 8px; color:#1f2330; text-transform:uppercase; }
    .rsvp-form input, .rsvp-form select, .rsvp-form textarea { background:rgba(255,255,255,0.84); border:1px solid #f0d8e2; border-radius:12px; color:#202431; padding:10px 14px; margin:6px 0 10px; }
    .rsvp-form input::placeholder, .rsvp-form textarea::placeholder { color:#9ba7b5; letter-spacing:3px; text-transform:uppercase; }
    .rsvp-form .btn-teal { display:block; margin:16px auto 0; padding:12px 18px; letter-spacing:3px; text-transform:uppercase; border-radius:10px; }
    .rsvp-notice { color:var(--primary); margin-top:8px; }
    .attend-toggle { display:grid; grid-template-columns: 1fr 1fr; gap:8px; margin-bottom:8px; }
    .attend-toggle .toggle { padding:8px 10px; border-radius:10px; border:1px solid #e2bfd0; background:#fff8fc; letter-spacing:3px; font-weight:700; color:#7a4e64; }
    .attend-toggle .toggle.active { background:linear-gradient(180deg,#d17aa2 0%, #b85d88 100%); color:#fff; border-color:#cf8fad; }
    .btn-gray { background:linear-gradient(180deg,#d17aa2 0%, #b85d88 100%); color:#fff; border-color:#cf8fad; }
    .rsvp-form .btn-gray { margin:16px auto 0; min-width:150px; border-radius:16px; padding:12px 24px; letter-spacing:5px; color:#fff; border:1px solid #9f5379; background:linear-gradient(180deg,#bf5f8e 0%, #9f3f6d 100%); box-shadow:0 10px 20px rgba(138,56,95,0.34); }
    .section h2 { margin:0 0 10px; font-family:Cinzel, Playfair Display, serif; letter-spacing:4px; font-size:1.3rem; text-align:center; text-transform:uppercase; }
    .two { display:grid; grid-template-columns: 1fr 1fr; gap:28px; }
    @media (max-width: 860px) { .two { grid-template-columns: 1fr; } }
    .card { padding:32px; border:1px solid var(--border); border-radius:16px; }
    .card h3 { margin:0 0 6px; font-family:Cinzel, Playfair Display, serif; letter-spacing:4px; font-size:1.1rem; text-align:center; text-transform:uppercase; }
    .scripture-card { max-width: 760px; margin: 0 auto; padding: 16px 20px; background: rgba(255,255,255,0.85); border:1px solid var(--border); border-radius:14px; box-shadow:0 8px 18px rgba(0,0,0,0.06); }
    .scripture { text-align:center; font-family: Playfair Display, serif; font-size:1rem; color:#4b3c42; line-height:1.6; }
    .couple-head { text-align:center; margin-bottom:24px; }
    .couple-title { font-family:Cinzel, Playfair Display, serif; letter-spacing:4px; font-size:clamp(1.2rem, 2vw, 1.7rem); color:#9ba1a7; text-transform:uppercase; }
    .couple-grid { display:grid; grid-template-columns:repeat(2, minmax(240px, 360px)); gap:52px; justify-content:center; align-items:start; }
    .couple-item { text-align:center; }
    .person-photo { position:relative; width:200px; height:200px; margin:0 auto 66px; border-radius:999px; overflow:visible; border:1px solid #d9dde2; box-shadow:0 10px 24px rgba(0,0,0,0.08); background:#f2f2f2; }
    .person-photo img { position:relative; z-index:1; width:100%; height:100%; object-fit:cover; display:block; border-radius:999px; }
    .person-photo::after { content:""; position:absolute; left:50%; bottom:-58px; transform:translateX(-50%); width:220px; height:120px; background:url('/images/flower-profile.webp') center/contain no-repeat; pointer-events:none; z-index:2; }
    .person-name { font-family: Playfair Display, serif; font-size:2rem; color:#6f7174; line-height:1.1; margin-bottom:6px; }
    .role { font-family:Poppins, sans-serif; text-transform:uppercase; font-size:.78rem; font-weight:700; letter-spacing:1.4px; color:#8a8f96; }
    .parents { color:#666d75; margin-top:4px; font-size:.86rem; line-height:1.45; }
    .person-social { margin-top:10px; color:#7a7f86; line-height:1; }
    .person-social svg { width:14px; height:14px; fill:currentColor; vertical-align:middle; }
    @media (max-width: 860px) { .couple-grid { grid-template-columns:1fr; gap:28px; } .person-photo { width:140px; height:140px; margin-bottom:50px; } .person-photo::after { width:160px; height:90px; bottom:-42px; } }
    .event { text-align:center; }
    .venue { font-family: Playfair Display, serif; font-size:1.2rem; }
    .addr { color:var(--muted); margin-top:10px; font-size:1rem; line-height:1.7; }
    .start { margin-top:12px; font-weight:700; letter-spacing:1px; }
    .proto { display:grid; grid-template-columns: repeat(4, 1fr); gap:18px; margin-top:18px; }
    @media (max-width: 860px) { .proto { grid-template-columns: repeat(2, 1fr); } }
    .proto .p { text-align:center; border:1px solid var(--border); border-radius:16px; padding:18px; background:#fff; }
    .p .emoji { font-size:2rem; }
    .btn { display:inline-block; padding:12px 18px; border-radius:12px; border:1px solid #e2bfd0; background:#fff8fc; text-decoration:none; color:#7a4e64; font-weight:700; letter-spacing:4px; text-transform:uppercase; box-shadow:0 6px 14px rgba(166,85,126,0.12); transition:transform .15s ease, filter .15s ease; }
    .btn:hover { filter:brightness(1.02); transform:translateY(-1px); }
    .btn:active { transform:translateY(0); }
    .btn-primary { background:linear-gradient(180deg,#d17aa2 0%, #b85d88 100%); color:#fff; border-color:#cf8fad; }
    .event-card { border:3px solid #ffffff; background: rgba(255,255,255,0.06); min-height:52vh; display:flex; align-items:center; justify-content:center; flex-direction:column; }
    .event-icon { width:104px; height:104px; margin-bottom:16px; padding:14px; border-radius:999px; background:linear-gradient(180deg,#fff9fb 0%, #fdeef4 100%); border:1px solid #efcfd9; box-shadow:0 8px 18px rgba(143,93,112,0.10); }
    .bg-events .card h3, .bg-events .venue, .bg-events .addr, .bg-events .start { color:#ffffff; }
    .bg-events .addr { opacity:.9; }
    .events-title { text-align:center; font-family:Cinzel, Playfair Display, serif; letter-spacing:6px; text-transform:uppercase; font-size:1.8rem; margin-bottom:8px; color:#ffffff; }
    .events-date { text-align:center; letter-spacing:6px; text-transform:uppercase; color:#ffffff; opacity:.9; margin-bottom:24px; }
    .list { margin-top:16px; }
    .wish { border-bottom:1px solid var(--border); padding:12px 0; font-size:1rem; }
    .form input, .form select, .form textarea { width:100%; padding:14px 16px; margin:8px 0 14px; border:1px solid var(--border); border-radius:12px; }
    .form textarea { min-height:120px; }
    .reveal { opacity:0; transform:translateY(24px) scale(0.98); transition:opacity .6s ease, transform .6s ease; will-change:opacity, transform; }
    .reveal.in { opacity:1; transform:none; }
    .fade-up { transform:translateY(28px); }
    .slide-left { transform:translateX(-28px); }
    .slide-right { transform:translateX(28px); }
    .zoom-in { transform:scale(0.92); }
    #introCanvas { position:fixed; inset:0; z-index:100; pointer-events:none; }
    #bookIntro { position:fixed; inset:0; z-index:110; display:none; align-items:center; justify-content:center; background:#000; overflow:hidden; }
    .opening-video { width:100vw; height:100vh; object-fit:cover; display:block; }
    .opening-overlay { position:absolute; left:50%; transform:translateX(-50%) translateY(10px); width:min(92vw, 980px); text-align:center; color:#fff; opacity:0; transition:opacity .6s ease, transform .6s ease; text-shadow:0 4px 18px rgba(36,14,25,.62), 0 1px 0 rgba(255,255,255,.2); filter:drop-shadow(0 10px 22px rgba(117,62,87,.28)); }
    #bookIntro.show-names .opening-overlay { opacity:1; transform:translateX(-50%) translateY(0); }
    .opening-kicker { font-family:Cinzel, Playfair Display, serif; font-size:clamp(1rem, 2.2vw, 1.5rem); letter-spacing:4px; text-transform:uppercase; color:#7f4f63; text-shadow:0 4px 14px rgba(28,10,18,.58), 0 0 1px rgba(255,255,255,.28); }
    .opening-names { margin-top:8px; font-family:Great Vibes, Playfair Display, serif; font-size:clamp(2.6rem, 8vw, 5.2rem); line-height:1; color:#644e33; text-shadow:0 6px 18px rgba(40,12,26,.65), 0 0 2px rgba(255,255,255,.28); -webkit-text-stroke:1px rgba(45,18,30,.18); }
    .opening-date { margin-top:8px; letter-spacing:6px; font-weight:700; font-size:clamp(.9rem, 2vw, 1.2rem); text-transform:uppercase; color:#74475a; text-shadow:0 4px 14px rgba(28,10,18,.58), 0 0 1px rgba(255,255,255,.30); }
    .book { position:relative; width:clamp(320px, 80vw, 980px); height:clamp(220px, 60vh, 560px); perspective:1200px; display:flex; align-items:center; justify-content:center; }
    .page { position:relative; width:50%; height:70%; background:#fff; border:1px solid #e7d7de; box-shadow:0 20px 40px rgba(0,0,0,0.18); transform-style:preserve-3d; }
    .page.left { transform-origin: left center; transform: rotateY(90deg); border-right:none; border-top-left-radius:18px; border-bottom-left-radius:18px; }
    .page.right { transform-origin: right center; transform: rotateY(-90deg); border-left:none; border-top-right-radius:18px; border-bottom-right-radius:18px; }
    .page .inner { position:absolute; inset:0; display:flex; align-items:center; justify-content:center; padding:24px; }
    .page.left .inner img { width:100%; height:100%; object-fit:cover; border-top-left-radius:18px; border-bottom-left-radius:18px; }
    .intro-duo { width:100%; height:100%; display:block; }
    .intro-duo img { width:100%; height:100%; object-fit:cover; border-radius:14px; display:block; }
    .page.right .names { font-family: Great Vibes, Playfair Display, serif; font-size: clamp(2.2rem, 7vw, 5rem); color:#b03060; line-height:1; text-align:center; }
    .page.right .sub { margin-top:8px; font-family:Poppins; color:#6b4c55; letter-spacing:4px; font-weight:700; text-align:center; }
    .book.open .page.left { animation: openLeft 1.2s cubic-bezier(.2,.8,.2,1) forwards; }
    .book.open .page.right { animation: openRight 1.2s cubic-bezier(.2,.8,.2,1) .05s forwards; }
    .book-enter { margin-top:18px; padding:12px 18px; border-radius:999px; background:linear-gradient(180deg,#d17aa2 0%, #b85d88 100%); color:#fff; border:1px solid #cf8fad; font-weight:700; box-shadow:0 12px 26px rgba(166,85,126,0.32); letter-spacing:2px; }
    .book-enter:disabled { opacity:.55; cursor:not-allowed; box-shadow:none; }
    .hero-open-btn {
        position:absolute;
        left:50%;
        bottom:calc(20px + env(safe-area-inset-bottom));
        transform:translateX(-50%);
        min-width:220px;
        z-index:5;
    }
    body.pre-invite .hero-open-btn {
        position:fixed;
        left:50%;
        bottom:24px;
        transform:translateX(-50%);
    }
    @media (min-width: 861px) {
        body.pre-invite .hero-open-btn {
            position:absolute;
            left:50%;
            top:22%;
            bottom:auto;
            transform:translateX(-50%);
        }
    }
    body.pre-invite .section { display:none; }
    body.pre-invite .music-toggle { display:none; }
    body.pre-invite .hero .title,
    body.pre-invite .hero .names,
    body.pre-invite .hero .date { opacity:1; transform:none; animation:none; }
    body.scrollable-video #bookIntro { position:relative; top:auto; left:auto; width:100%; height:100vh; pointer-events:none; z-index:1; }
    body.scrollable-video #bookIntro .opening-video,
    body.scrollable-video #bookIntro .opening-overlay { pointer-events:none; }
    body.scrollable-video #bookEnter { display:none; }
    body.scrollable-video .hero-mobile  { display:none !important; }
    .music-toggle { 
        position:fixed; right:14px; bottom:18px; z-index:140;
        width:48px; height:48px; border-radius:999px; border:1px solid #cf8fad;
        background:linear-gradient(180deg,#d17aa2 0%, #b85d88 100%);
        color:#fff; display:flex; align-items:center; justify-content:center;
        box-shadow:0 12px 24px rgba(166,85,126,.35); cursor:pointer;
    }
    .music-toggle svg { width:22px; height:22px; display:block; fill:currentColor; }
    .music-toggle.muted {
        background:linear-gradient(180deg,#f4d3e1 0%, #e7b8cc 100%);
        color:#7a4e64; border-color:#d8a9bf;
    }
    @keyframes openLeft { 0% { transform: rotateY(90deg);} 100% { transform: rotateY(0);} }
    @keyframes openRight { 0% { transform: rotateY(-90deg);} 100% { transform: rotateY(0);} }
    .lang { text-align:center; margin-top:8px; }
    .lang a { margin:0 6px; }
    @media (min-width: 861px) {
        .wrap .hero-desktop { display:none !important; }
        .wrap .hero-mobile { display:block !important; height:100vh !important; min-height:100vh !important; background:url('{{ $invite['assets']['hero_mobile'] ?? ($invite['assets']['hero_desktop'] ?? '/images/hero_bg.svg') }}') center/cover no-repeat !important; }
        .wrap .hero-mobile picture { display:none !important; }
        .wrap .hero-copy-mobile { width:90% !important; top:14% !important; }
        .wrap .hero-copy-mobile .title { font-size:1.05rem !important; letter-spacing:3px !important; }
        .wrap .hero-copy-mobile .names { font-size:clamp(2.5rem, 9vw, 3.6rem) !important; margin-top:8px !important; }
        .wrap .hero-copy-mobile .date { font-size:.92rem !important; letter-spacing:4px !important; margin-top:10px !important; }
        .wrap .hero, .wrap .section { width:100% !important; margin-left:0 !important; margin-right:0 !important; }
        .wrap .section { min-height:auto !important; padding:44px 18px !important; }
        .wrap .two { grid-template-columns:1fr !important; }
        .wrap .proto { grid-template-columns:repeat(2, 1fr) !important; }
        .wrap .couple-grid { grid-template-columns:1fr !important; gap:28px !important; }
        .wrap .person-photo { width:140px !important; height:140px !important; margin-bottom:50px !important; }
        .wrap .person-photo::after { width:160px !important; height:90px !important; bottom:-42px !important; }
        .wrap .bg-gallery { padding:14px 0 !important; min-height:auto !important; }
        .wrap .gallery, .wrap .gallery.full { grid-template-columns:repeat(2, 1fr) !important; }
        .wrap .gallery.full { gap:8px !important; padding:8px !important; }
        .wrap .gallery.full img { grid-column:span 1 !important; aspect-ratio:3 / 4 !important; min-height:180px !important; border-radius:10px !important; }
        #bookIntro { left:auto !important; right:0 !important; width:var(--mobile-wrap) !important; }
        #bookIntro .opening-video { width:100% !important; height:100% !important; }
        #bookIntro .opening-overlay { width:90% !important; }
        body.scrollable-video #bookIntro { left:0 !important; right:auto !important; width:100% !important; }
    }
</style>
