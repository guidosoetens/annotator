
function fitApp() {
    let w = window.innerWidth;
    let h = window.innerHeight;

    let divGlobal = document.getElementById('divGlobal');

    let scale = Math.min(w / 1920.0, h / 1080.0);

    let tx = w / 2 - 1920 / 2;
    let ty = h / 2 - 1080 / 2;

    divGlobal.style.transform = "translateX(" + tx + "px) translateY(" + ty + "px) scale(" + scale + ")";
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
    let session = urlParams.get('session');

    document.getElementById('divGlobal').innerHTML = `Session ID: ${session}`;
    setVisible('divGlobal', true);

    fetch(`../php/joinSession.php?session=${session}`, { 
        method: 'POST'
    })
    .then(response => response.text())
    .then(data => {
        // console.log('result: ', data);
        console.log("dit is de data", data)
        const obj = JSON.parse(data);
        if(obj.success) {

            setVisible('divGlobal', true);

            console.log("session correct!");
        }
        else {
            console.log("session incorrect!");
        }
    });
}