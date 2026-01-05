<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>
<style>
table, th, td {
  border: 1px solid black;
}

.photo_block {
    /* width: 300px;
    height: 300px; */
    background-color: lavender;
    margin: 20px;
    border-radius: 10px;
    padding:10px;
    max-width:200px;
}

.photo {
    width: 200px;
    height: 200px;
    background-size: cover;
    border-radius: 2px;
}
</style>
<script type="module"> 

function get_likes(p, users, likes) {
    let liked_by = [];
    for(let l of likes) {
        if(l.photo_id == p.id) {
            let name = '';
            for(let user of users) {
                if(user.id == l.user_id)
                    name = user.name;
            }
            liked_by.push(name);
        }
    }
    return liked_by;
}

function generatePhotoElement(p, users, likes) {
    let e = document.createElement('div');
    e.classList.add("photo_block");
    let img = document.createElement('div');
    img.style.backgroundImage = `url(../data/pictures/image_${p.id}.jpg)`;
    img.classList.add("photo");
    e.appendChild(img);
    let cap = document.createElement('div');
    cap.innerHTML = `"${p.caption}"`;
    cap.style.textAlign = 'center';
    cap.style.fontWeight = 'bold';
    e.appendChild(cap);

    let liked_by = get_likes(p, users, likes);

    let str = `likes (${liked_by.length})`;
    for(let l of liked_by)
        str += `, ${l}`

    e.appendChild(document.createTextNode(str));

    return e;
}

function generateTable(data) {

    const obj = JSON.parse(data);

    let table = document.createElement('table');
    document.getElementById('divContainer').appendChild(table);
    let header = document.createElement('tr');
    table.appendChild(header);

    let add_header = (str) => {
        let e = document.createElement('th');
        e.appendChild(document.createTextNode(str));
        header.appendChild(e);
    };

    let create_cell = (row) => {
        let e = document.createElement('td');
        row.appendChild(e);
        return e;
    };

    let add_text_cell = (str, row) => {
        let e = create_cell(row);
        e.appendChild(document.createTextNode(str));
    };

    let add_link_cell = (key, row) => {

        let a = document.createElement('a');
        a.href = '../?user=' + key;
        a.innerHTML = `https://xmas.tover.care?user=${key}`;
        a.target = '_blank';
        a.style.textAlign = 'right';

        let btn = document.createElement('button');
        btn.innerHTML = 'COPY';
        btn.onclick = () => {
            navigator.clipboard.writeText(a.innerHTML);
        };

        let e = create_cell(row);
        e.appendChild(a);

        e = create_cell(row);
        e.appendChild(btn);
    };

    add_header('User');
    add_header('Link');
    add_header('Copy');
    for(let i=0; i<=obj.week_id; ++i)
        add_header(`week ${i}`);

    for(let user of obj.users) {

        let row = document.createElement('tr');
        table.appendChild(row);

        add_text_cell(user.name, row);
        add_link_cell(user.key, row);

        for(let i=0; i<=obj.week_id; ++i) {
            let e = create_cell(row);
            for(let p of obj.photos) {
                if(p.owner_id == user.id && p.week == i) {
                    e.appendChild(generatePhotoElement(p, obj.users, obj.likes));
                    break;
                }
            }
        }
    }

    let winner_row = document.createElement('tr');
    table.appendChild(winner_row);
    add_text_cell('Winner', winner_row);
    create_cell(winner_row);
    create_cell(winner_row);
    for(let i=0; i<=obj.week_id; ++i) {
        let e = create_cell(winner_row);
        let max_likes = -1;
        let min_time = 0;
        let winner_pic = {};
        for(let p of obj.photos) {
            if(p.week != i)
                continue;
            let liked_by = get_likes(p, obj.users, obj.likes);
            if(liked_by.length > max_likes) {
                max_likes = liked_by.length;
                min_time = p.timestamp;
                winner_pic = p;
            }
            else if(liked_by.length == max_likes && p.timestamp < min_time) {
                min_time = p.timestamp;
                winner_pic = p;
            }
        }

        if(max_likes >= 0) {
            for(let user of obj.users) {
                if(user.id == winner_pic.owner_id) {
                    e.innerHTML = user.name;
                    break;
                }
            }
        }
    }
}

window.onload = function () {
    fetch('../php/getDashboard.php?password=pikkebaas')
    .then(response => response.text())
    .then(data => {
        console.log('result: ', data);
        generateTable(data);
    });
}

</script>
</head>
<body>

<div id="divContainer">
    Data Table:
</div>

</body>
</html>