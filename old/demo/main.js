//global vars:
let user = 0;

class Polaroid {
    static base_angle = Math.random();
    static wobble_scale = 1;
    static anim_param = 0;

    container;
    picture;
    text;

    constructor(divName) {

        this.container = document.getElementById(divName);
        this.container.style.marginLeft = "100px";
        this.container.style.marginTop = "180px";
        this.container.style.width = "400px";
        this.container.style.backgroundColor = "white";
        this.container.style.padding = "20px 20px 60px 20px";
        this.container.style.transformOrigin = "center";
        this.container.style.transform = "rotate(-3deg)";
        this.container.style.boxShadow = "10px 10px 20px rgba(0,0,0,.3)";
        this.container.style.position = "absolute";


        this.picture = document.createElement('div');
        this.container.appendChild(this.picture);
        this.picture.style.width = "400px";
        this.picture.style.height = "400px";
        this.picture.style.background = "black";
        this.picture.style.overflow = "hidden";
        this.picture.style.backgroundSize = "contain";

        this.text = document.createElement('div');
        this.container.appendChild(this.text);
        this.text.style.fontFamily = "handwriting";
        this.text.style.width = "400px";
        this.text.style.textAlign = "center";
        this.text.style.color = "black";
        // this.text.style.background = "red";
        this.text.style.fontSize = '36px';
        this.text.style.position = 'absolute';
        this.text.style.marginTop = '10px';
        // this.text.innerHTML = 'HIER KOMT EEN TEKST';


        /*
            <div id="divPlrdWall" style="margin-left: 100px; margin-top: 180px; width:400px; 
            background-color: white; padding: 20px 20px 20px 20px; transform-origin: center; transform: rotate(-3deg); box-shadow: 10px 10px 20px rgba(0,0,0,.3);">
                <div id="divUserPicture2" style="width: 400px; height: 400px; background: black; overflow: hidden; background-size: contain;">
                </div>                     
            </div>
        */


        //create outline:
        // let border 

        //style="margin-left: 100px; margin-top: 180px; width:400px; background-color: white; padding: 20px 20px 20px 20px; transform-origin: center; transform: rotate(-3deg); box-shadow: 10px 10px 20px rgba(0,0,0,.3);
    }

    updateLayout() {
        let angle = Polaroid.base_angle + Math.sin(Polaroid.anim_param * 2 * Math.PI);
        this.container.style.transform = `rotate(${angle}deg) scale(${Polaroid.wobble_scale}, ${2 - Polaroid.wobble_scale})`;
    }

    setContent(url, txt) {
        this.picture.style.backgroundImage = `url(${url})`;
        this.text.innerHTML = (txt.length === 0) ? "" : `"${txt}"`;
    }

    setContentFromPicture(p) {
        this.setContent(p.url, p.caption);
    }
}

let plrd_awesome;
let plrd_preview;
let plrd_creation;
let plrd_wall;
let plrds;

function fitApp() {
    let w = window.innerWidth;
    let h = window.innerHeight;

    let divGlobal = document.getElementById('divGlobal');

    let scale = Math.min(w / 640.0, h / 1080.0);

    let tx = w / 2 - 640 / 2;
    let ty = h / 2 - 1080 / 2;

    divGlobal.style.transform = "translateX(" + tx + "px) translateY(" + ty + "px) scale(" + scale + ")";
}

let anim_param = 0;
let flash_fx = 0;
let target_base_angle = -5;
let plrd_wobble_anim_param = 1;
let lean_left = -1;
const max_flash_fx = .5;

let star_drop_param = 1;
function drop_star() {
    document.getElementById('divStar').style.opacity = 0;
    star_drop_param = 0;
}

function update(dt) {
    //...

    anim_param = (anim_param + dt / 40.0) % 1.0;
    flash_fx = Math.max(0, flash_fx - dt / 1.0);
    document.getElementById('divFlashOverlay').style.opacity = max_flash_fx * flash_fx;

    let divBanner = document.getElementById('divBanner');
    divBanner.style.backgroundPositionX = (anim_param * 612) + 'px';
    
    let divMariah = document.getElementById('divMariah');
    divMariah.style.transform = `rotate(${3 * Math.sin(5 * anim_param * 2 * Math.PI)}deg)`;

    let divNameTagPaper = document.getElementById('divNameTagPaper');
    divNameTagPaper.style.transform = `rotate(${1.5 * Math.cos(8 * anim_param * 2 * Math.PI)}deg)`;

    Polaroid.base_angle = .9 * Polaroid.base_angle + .1 * target_base_angle;
    Polaroid.anim_param = (Polaroid.anim_param + dt / 5.0) % 1.0;
    plrd_wobble_anim_param = Math.min(plrd_wobble_anim_param + dt / .3, 1);
    Polaroid.wobble_scale = (1 - .05 * Math.sin(plrd_wobble_anim_param * 5) * Math.pow(1 - plrd_wobble_anim_param, 1));
    for(let plrd of plrds)
        plrd.updateLayout();


    let v = [-200, -210];
    let ang_deg = Polaroid.base_angle + Math.sin(Polaroid.anim_param * 2 * Math.PI);
    let th = ang_deg * Math.PI / 180.0;
    v = [ v[0] * Math.cos(th) - v[1] * Math.sin(th), v[0] * Math.sin(th) + v[1] * Math.cos(th)];
    let divStar = document.getElementById('divStar');
    star_drop_param = Math.min(star_drop_param + dt / .5, 1.0);
    let star_scale_x = 1;
    let star_scale_y = 1;
    let star_alpha = 1;
    const drop_frac = .5;
    if(star_drop_param < drop_frac) {
        let t = star_drop_param / drop_frac;
        star_alpha = t;
        star_scale_x = star_scale_y = 3 - 2 * t;
    }
    else {
        let t = (star_drop_param - drop_frac) / (1 - drop_frac);
        star_scale_x = 1 + .1 * Math.sin(t * 10) * (1 - t);
        star_scale_y = 2 - star_scale_x;
    }
    divStar.style.opacity = star_alpha;
    ang_deg += -5 * Math.cos(Polaroid.anim_param * 2 * Math.PI);
    divStar.style.transform = `translateX(${v[0]}px) translateY(${v[1]}px) rotate(${ang_deg}deg) scale(${star_scale_x}, ${star_scale_y})`;
}

function wobblePolaroid() {
    target_base_angle = -target_base_angle;
    plrd_wobble_anim_param = 0;
}

let wall_index = 0;
let photos = [];

function setWallIndex(idx) {

    let n = photos.length;
    if(n > 0) {
        idx = idx % n;
        if(idx < 0)
            idx += n;

        wall_index = idx;
        let p = photos[wall_index];
        plrd_wall.setContentFromPicture(p);

        setVisible('divStar', p.liked);
        setVisible('divEmptyWall', false);
        setVisible('divWall', true);

        let btn = document.getElementById("btnStar");
        if(p.own_picture) {
            btn.style.pointerEvents = 'none';
            btn.style.opacity = 0.3;
        }
        else {
            btn.style.pointerEvents = 'auto';
            btn.style.opacity = 1.0;
        }

        if(p.liked) {
            btn.style.fontFamily = 'FontAwesomeRegular';
            // btn.style.color = 'rgba(255, 255, 255, .5)';
            // btn.innerHTML = "&#xf2ea"
        }
        else {
            btn.style.fontFamily = 'FontAwesomeSolid';
            // btn.style.color = 'rgba(255, 255, 255, 1)';
            // btn.innerHTML = "&#xf005"
        }
        
        let divNavBar = document.getElementById('divNavBar');
        divNavBar.innerHTML = '';

        let num_breaks = Math.floor(n / 16.0);
        let br_idx = Math.floor(n / (num_breaks + 1)) + 1;

        for(let i=0; i<n; ++i) {

            if(i > 0 && (i % br_idx == 0))
                divNavBar.appendChild(document.createElement('br'));

            let e = document.createElement('div');
            e.classList.add('nav_elem');
            e.innerHTML = photos[i].liked ? '&#xf192' : '&#xf111';
            if(i == idx)
                e.style.opacity = 1.0;
            divNavBar.appendChild(e);
        }
    }
    else {
        setVisible('divEmptyWall', true);
        setVisible('divWall', false);
    }
}

function starPicture() {
    let n = photos.length;
    if(n > 0 && wall_index < n) {
        let p = photos[wall_index];
        if(p.own_picture)
            return;

        if(p.liked) {
            
        }
        else {
            drop_star();
            for(let o of photos)
                o.liked = false;
        }

        p.liked = !p.liked;

        setWallIndex(wall_index);
    }
}

function populatePage() {

    photos = [];

    let push_pic = (file, caption) => {
        photos.push(
            {
                liked : false,
                url : `./images/${file}`,
                own_picture : false,
                caption : caption
            }
        );
    };

    push_pic('snack0.jpg', 'An apple a day...');
    push_pic('snack1.jpg', 'Smeuïg tot op de bodem');
    push_pic('snack2.png', 'Tante Lieeeeen');
    push_pic('yoga.png', 'Yoga Time');
    push_pic('snack3.jpg', 'Black Angus');
    push_pic('sleep.png', 'A power nap!');
    push_pic('snack4.jpg', 'Crompouce');

    setVisible('divAskForContent', true);
    setVisible('divShowContent', false);

    setWallIndex(wall_index);

    setVisible('divGlobal', true);
}


function setVisible(elem, visible) {
    document.getElementById(elem).style.visibility = visible ? "inherit" : "collapse";
    document.getElementById(elem).style.display = visible ? "inline-block" : "none";
}

let front_selfie_cam = false;
let snapshot_data_uri = "";
let caption = '';

function swapCamera() {
    front_selfie_cam = !front_selfie_cam;
    closeSnapshotCamera();
    openSnapshotCamera();
}

function openSnapshotCamera(force_back_cam = false) {

    if(force_back_cam)
        front_selfie_cam = false;

    caption = '';

    setVisible('divSnapshot', true);
    setVisible('divSnapshotApprove', false);
    setVisible('divSnapshotAwesome', false);

    var video = document.getElementById('divSnapshotVideo');
    video.setAttribute('playsinline', '');
    video.setAttribute('autoplay', '');
    video.setAttribute('muted', '');
    video.style.width = '500px';
    video.style.height = '500px';

    var constraints = {
        audio: false,
        video: { facingMode: front_selfie_cam ? 'user' : 'environment'  }
    };

    /* Stream it to video element */
    navigator.mediaDevices.getUserMedia(constraints).then(function success(stream) {
        video.srcObject = stream;
    });
}

function closeSnapshotCamera() {
    setVisible('divSnapshot', false);
    setVisible('divSnapshotApprove', false);
    setVisible('divSnapshotAwesome', false);

    var video = document.getElementById('divSnapshotVideo');
    video.srcObject.getTracks().forEach(function(track) {
        track.stop();
    });
}

function makeSnapshot() {

    var canvas = document.createElement('canvas');
    canvas.width = 800;
    canvas.height = 800;
    var ctx = canvas.getContext('2d');

    var video = document.getElementById('divSnapshotVideo');
    let w = Math.min(video.videoWidth, video.videoHeight);

    ctx.drawImage(video, (video.videoWidth - w) / 2, (video.videoHeight - w) / 2, w, w, 0, 0, 800, 800);

    //convert to desired file format
    snapshot_data_uri = canvas.toDataURL('image/jpeg');
    // let elem = document.getElementById('divSnapshotPreview');
    // elem.style.backgroundImage = 'url(' + snapshot_data_uri + ')';
    plrd_preview.setContent(snapshot_data_uri, '');
    plrd_awesome.setContent(snapshot_data_uri, '');

    // setVisible('divSnapshot', false);
    closeSnapshotCamera();

    document.getElementById('divFlashOverlay').style.opacity = max_flash_fx;
    flash_fx = 1.0;
    wobblePolaroid();
    setVisible('divSnapshotAwesome', true);
    
    setTimeout(() => {
        setVisible('divSnapshotAwesome', false);
        signCapture();
        wobblePolaroid();
        setVisible('divSnapshotApprove', true);
    }, 2000);
}

function sanitizeString(str){
    str = str.replace(/[^a-z0-9\.\?\!,-\s]/gim,"");
    return str.trim().substring(0, 20);
}

function signCapture() {
    caption = window.prompt('Add a caption to your picture!\n(max 20 characters)', '');
    if(!caption) 
        caption = "";

    caption = sanitizeString(caption);
    // document.getElementById('divCaption').innerHTML = `"${txt}"`;
    plrd_preview.setContent(snapshot_data_uri, caption);
}

function dataURItoBlob(dataURI) {
    var byteString;
    if (dataURI.split(',')[0].indexOf('base64') >= 0)
        byteString = atob(dataURI.split(',')[1]);
    else
        byteString = unescape(dataURI.split(',')[1]);

    var mimeString = dataURI.split(',')[0].split(':')[1].split(';')[0];

    var ia = new Uint8Array(byteString.length);
    for (var i = 0; i < byteString.length; i++) {
        ia[i] = byteString.charCodeAt(i);
    }

    return new Blob([ia], {type:mimeString});
}

function sendSnapshot() {

    photos.push(
        {
            url : snapshot_data_uri,
            caption : caption,
            own_picture : true,
            liked : false
        }
    );

    plrd_creation.setContent(snapshot_data_uri, caption);
    closeSnapshotCamera();
    wobblePolaroid()
    setVisible('divAskForContent', false);
    setVisible('divShowContent', true);
}

function setPage(idx) {

    let pages = [ 'divMainPage', 'divContentPage', 'divWallPage' ];

    let divPageButtons = document.getElementById('divPageButtons');
    let n = divPageButtons.children.length;
    for(let i=0; i<n; ++i) {
        let c = divPageButtons.children[i];
        c.style.borderWidth = (i == idx ? 6 : 2) + 'px';
        setVisible(pages[i], i == idx);
    }

    if(idx == 2)
        setWallIndex(wall_index);

    wobblePolaroid();
}

window.onload = () => {

    plrd_awesome = new Polaroid('divSnapshotPreview1');
    plrd_preview = new Polaroid('divSnapshotPreview2');
    plrd_creation = new Polaroid('divUserPicture');
    plrd_wall = new Polaroid('divPlrdWall');
    plrd_preview.container.style.marginTop = "100px";
    plrds = [ plrd_awesome, plrd_preview, plrd_creation, plrd_wall ];

    fitApp();
    document.onresize = () => { fitApp(); }
    window.onresize = () => { fitApp(); }

    let square_scale_vid = (name) => {
        document.getElementById(name).addEventListener( "loadedmetadata", function (e) {
            let vid = document.getElementById(name);
            let vid_scale = vid.videoWidth / vid.videoHeight;
            if(vid_scale < 1.)
                vid_scale = 1. / vid_scale;
            vid.style.transform = "scale(" + 1.05 * vid_scale + ")";
        }, false );
    };
    square_scale_vid('divSnapshotVideo');

    document.getElementById('divSwapCameraButton').addEventListener('click', () => { swapCamera(); } );
    document.getElementById('divButtonsSnap').addEventListener('click', () =>{ makeSnapshot(); });
    document.getElementById('divButtonsSnapCancel').addEventListener('click', () => { closeSnapshotCamera(); });
    document.getElementById('divButtonRetrySnapshot').addEventListener('click', () => { openSnapshotCamera(); });
    document.getElementById('divButtonSendSnapshot').addEventListener('click', () => { sendSnapshot(); } );
    document.getElementById('divSignCapture').addEventListener('click', () => { signCapture(); } );

    document.addEventListener('gesturestart', function (e) {
        e.preventDefault();
    });

    function hasTouch() {
        return 'ontouchstart' in document.documentElement
               || navigator.maxTouchPoints > 0
               || navigator.msMaxTouchPoints > 0;
    }
      
    if (hasTouch()) { // remove all the :hover stylesheets
        try { // prevent exception on browsers not supporting DOM styleSheets properly
            for (var si in document.styleSheets) {
            var styleSheet = document.styleSheets[si];
            if (!styleSheet.rules) continue;
        
            for (var ri = styleSheet.rules.length - 1; ri >= 0; ri--) {
                if (!styleSheet.rules[ri].selectorText) continue;
        
                if (styleSheet.rules[ri].selectorText.match(':hover')) {
                styleSheet.deleteRule(ri);
                }
            }
            }
        } catch (ex) {}
    }

    let lastTick = performance.now();
    function tick(nowish) {
        const delta = nowish - lastTick;
        lastTick = nowish;
        update(delta / 1000.0);
        window.requestAnimationFrame(tick);
    }

    window.requestAnimationFrame(tick);

    fitApp();

    document.getElementById('btnStartMakeSnapshot').onclick = () => { openSnapshotCamera(true); };
    document.getElementById('btnHome').onclick = () => { setPage(0); };
    document.getElementById('btnUpload').onclick = () => { setPage(1); };
    document.getElementById('btnStars').onclick = () => { setPage(2); };
    document.getElementById('btnLeft').onclick = () => { setWallIndex(wall_index - 1); wobblePolaroid(); };
    document.getElementById('btnRight').onclick = () => { setWallIndex(wall_index + 1); wobblePolaroid(); };
    document.getElementById('btnStar').onclick = () => { starPicture(); };

    document.getElementById('btnDeleteSnapshot').onclick = () => { 
        if (window.confirm('Are you sure you want to delete this picture?\nAll the stars it received will also be deleted.')) {
            photos.splice(photos.length - 1);
            setVisible('divAskForContent', true);
            setVisible('divShowContent', false);
        }
    };

    user = 'demo';
    // document.getElementById('divQuestion').innerHTML = 'a healthy snack!';
    document.getElementById('divNameTag').innerHTML = 'Tommie!';
    populatePage();
    setVisible('divGlobal', true);
}