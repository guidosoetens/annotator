
function fitApp() {
    let w = window.innerWidth;
    let h = window.innerHeight;

    let divGlobal = document.getElementById('divGlobal');

    let scale = Math.min(w / 1920.0, h / 1080.0);

    let tx = w / 2 - 1920 / 2;
    let ty = h / 2 - 1080 / 2;

    divGlobal.style.transform = "translateX(" + tx + "px) translateY(" + ty + "px) scale(" + scale + ")";
}

let page_index = 0;
let session_id = 0;

function setPage(index) {
    const max_index = 2;
    index = Math.max(0, Math.min(max_index, index));
    page_index = index;

    let imgs = [ 'profile-icon-square.png', 'banner.jpg', 'bg.jpg' ];
    document.getElementById('divBackground').style.backgroundImage = `url(./resources/${imgs[index]})`;

    document.getElementById('btnPrev').disabled = index <= 0;
    document.getElementById('btnNext').disabled = index >= max_index;

    fetch(`./php/updateSession.php?session=${session_id}&slide=${index}`, {  method: 'POST' });
}

function startSession() {
    setVisible('divLoginOverlay', false);
    setVisible('divAnnotationsContainer', true);
    setPage(0);
}

function update(dt) {
    //...
}

function setVisible(elem, visible) {
    document.getElementById(elem).style.visibility = visible ? "inherit" : "collapse";
    document.getElementById(elem).style.display = visible ? "inline-block" : "none";
}

function sanitizeString(str){
    str = str.replace(/[^a-z0-9\.\?\!,-\s]/gim,"");
    return str.trim().substring(0, 20);
}

window.onload = () => {

    document.onresize = () => { fitApp(); }
    window.onresize = () => { fitApp(); }

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

    const urlParams = new URLSearchParams(window.location.search);
    let password = urlParams.get('password');

    fetch(`./php/startSession.php?password=${password}`, { 
        method: 'POST'
    })
    .then(response => response.text())
    .then(data => {
        // console.log('result: ', data);
        console.log("dit is de data", data)
        const obj = JSON.parse(data);
        if(obj.success) {

            session_id = obj.session_id;

            const qrcode = new QRCode(document.getElementById('divLoginCode'), {
                text: 'http://192.168.1.4/annotator/phone?session=' + session_id,
                width: 512,
                height: 512,
                colorDark : '#000',
                colorLight : '#fff',
                correctLevel : QRCode.CorrectLevel.H
            });

            setVisible('divGlobal', true);


            console.log("password correct!");
        }
        else {
            console.log("password incorrect!");
        }
    });

    document.getElementById('btnStart').onclick = (e) => { startSession(); };
    document.getElementById('btnPrev').onclick = (e) => { setPage(page_index - 1); };
    document.getElementById('btnNext').onclick = (e) => { setPage(page_index + 1); };
}