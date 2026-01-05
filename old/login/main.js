
function fitApp() {
    let w = window.innerWidth;
    let h = window.innerHeight;

    let divGlobal = document.getElementById('divGlobal');

    let scale = Math.min(w / 640.0, h / 960.0);

    let tx = w / 2 - 640 / 2;
    let ty = h / 2 - 960 / 2;

    divGlobal.style.transform = "translateX(" + tx + "px) translateY(" + ty + "px) scale(" + scale + ")";
}

window.onload = () => {
    fitApp();
    document.onresize = () => { fitApp(); }
    window.onresize = () => { fitApp(); }

    let input = document.getElementById('divInput');

    let divLogin = document.getElementById('divLogin');
    divLogin.onclick = () => {
        fetch(`../php/login.php?user=${input.value}`, { 
            method: 'POST'
        })
        .then(response => response.text())
        .then(data => {
            const obj = JSON.parse(data);
            if(obj.success) {
                let url = window.location.href;
                const elems = url.split('/login');
                window.location.href = elems[0] + `?user=${input.value}`;
            }
        });
    };
}