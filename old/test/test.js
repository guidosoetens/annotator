let snapshot_data_uri = "";

function makeSnapshot() {

    let w = 200;

    var canvas = document.createElement('canvas');
    canvas.width = 200;
    canvas.height = 200;
    var ctx = canvas.getContext('2d');
    

    // var video = document.getElementById('divSnapshotVideo');
    // let w = Math.min(video.videoWidth, video.videoHeight);
    // ctx.drawImage(video, (video.videoWidth - w) / 2, (video.videoHeight - w) / 2, w, w, 0, 0, 800, 800);

    let divPlaatje = document.getElementById('divPlaatje');
    ctx.drawImage(divPlaatje, 0, 0, w, w);

    snapshot_data_uri = canvas.toDataURL('image/jpeg');

    return snapshot_data_uri;
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


window.onload = function () {

    let body = document.getElementById('body');
    let userData = {};

    let set_like = (user, photo, to_like) => {
        let script = to_like ? 'like' : 'unlike';
        fetch(`./php/${script}Photo.php?user=${user}&photo=${photo}`)
        .then(response => response.text())
        .then(data => {
            // console.log(data);
        });
    };

    let deletePhoto = (user, photo) => {
        fetch(`./php/deletePhoto.php?user=${user}&photo=${photo}`)
        .then(response => response.text())
        .then(data => {
            // console.log(data);
        });
    };

    let set_user = (user) => {
        body.style.visibility = 'collapse';
        let divItems = document.getElementById('divItems');

        fetch('./php/login.php?user=' + user)
        .then(response => response.text())
        .then(data => {
            userData = JSON.parse(data);
            
            fetch('./php/getUserData.php?user=' + user)
            .then(response => response.text())
            .then(data => {

                divItems.innerHTML = '';
                let total_stars = 3;
                const obj = JSON.parse(data);
                for(let e of obj) {
                    let d = document.createElement('div');
                    let own = e['user_id'] == userData['id'];
                    let star = e['liked'] ? '★' : '☆';
                    if(own)
                        star = '';
                    if(e['liked'])
                        total_stars--;
                    d.innerHTML = `${star} ` + e['photo_id'];
                    if(own)
                        d.onclick = () => { deletePhoto(user, e['photo_id']); set_user(user); };
                    else
                        d.onclick = () => { if(total_stars > 0) set_like(user, e['photo_id'], !e['liked']); set_user(user); };
                    divItems.appendChild(d);
                }

                body.style.visibility = 'visible';
            });
        })
        .catch(error => console.error('Error:', error));

    };
    
    let idUsers = document.getElementById('idUsers');
    let idx = 1;
    idUsers.onchange = (e) => {
        ++idx;
        set_user(idUsers.value);
        let divPlaatje = document.getElementById('divPlaatje');
        divPlaatje.src = 'https://loremflickr.com/200/200?random=' + idx;
    };
    set_user(idUsers.value);


    let divOutput = document.getElementById('divOutput');


    let btnUpload = document.getElementById("btnUpload");
    btnUpload.addEventListener("click", (e) => {
        var formData = new FormData();
        let uri = makeSnapshot();
        formData.append('file', dataURItoBlob(uri));
        formData.append("caption", 'Dit wordt de caption van de Form Data');
        var xhttp = new XMLHttpRequest();
        xhttp.open("POST", "./php/uploadPhoto.php?user=" + idUsers.value, true);
        xhttp.onreadystatechange = function() {
           if (this.readyState == 4 && this.status == 200) {
                divOutput.innerHTML = this.responseText;
                set_user(idUsers.value);
           }
        };
        xhttp.send(formData);
    });

};