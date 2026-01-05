
window.onload = function () {

    let inputs = [];
    let questions = [];

    let num_weeks = 20;

    let inputCounter = document.getElementById('inputCounter');
    let divOutput = document.getElementById('divOutput');

    let get_week_str = (index) => {
        let date = new Date(2024, 9, 28);
        date.setDate(date.getDate() + 7 * index);
        return date.toLocaleDateString('en-us', { day:"numeric", month:"short"});
    };

    let tb = document.getElementById('tbCriticalNumber');
    for(let i=0; i<num_weeks; ++i) {
        let row = document.createElement('tr');

        let td0 = document.createElement('td');
        td0.innerHTML = i + ':';

        let td1 = document.createElement('td');
        td1.innerHTML = get_week_str(i);

        let input = document.createElement('input');

        let td2 = document.createElement('td');
        td2.appendChild(input);

        let question = document.createElement('input'); 
        question.style.width = '300px';
        let td3 = document.createElement('td');
        td3.appendChild(question);

        row.appendChild(td0);
        row.appendChild(td1);
        row.appendChild(td2);
        row.appendChild(td3);
        tb.appendChild(row);

        inputs.push(input);
        questions.push(question);
    }

    function clean_input(input) {
        let e = parseInt(input.value);
        if(!Number.isInteger(e) || isNaN(e) || e < 0)
            e = 0;
        input.value = e;
    }

    function clean_inputs() {
        clean_input(inputCounter);
        for(let input of inputs) 
            clean_input(input);

        //make sure 'inputs' is always increasing
        let max_val = 0;
        for(let input of inputs) {
            let val = parseInt(input.value);
            max_val = Math.max(val, max_val);
            input.value = max_val;
        }
    }

    clean_inputs();

    inputCounter.addEventListener("change", (e) => { clean_inputs(); });
    for(let input of inputs)
        input.addEventListener("change", (e) => { clean_inputs(); });

    let btnStore = document.getElementById("btnStore");
    btnStore.addEventListener("click", (e) => {

        divOutput.innerHTML = '';

        let vals = [];
        let prev_val = 0;
        for(let e of inputs) {
            let val = parseInt(e.value);
            vals.push(val - prev_val);
            prev_val = val;
        }

        let qs = [];
        for(let e of questions)
            qs.push(e.value);

        // let qs = e["questions"];
        // for(let i=0; i<questions.length; ++i)
        //     questions[i].value = (i < qs.length) ? qs[i] : "you!";

        let data = { 
            "counter_number" : parseInt(inputCounter.value),
            "critical_numbers" : vals,
            "questions" : qs
        };
        
        var fd = new FormData()
        fd.append('data', JSON.stringify(data));
        fetch('store_vals.php', { 
            method: 'POST',
            body: fd
        })
        .then(response => response.text())
        .then(data => {
            // console.log(data);
            divOutput.innerHTML = data;
        })
    });

    fetch('load_vals.php')
    .then(response => response.text())
    .then(data => {
        const e = JSON.parse(data);
        inputCounter.value = e["counter_number"];
        let cs = e["critical_numbers"];
        let sum_val = 0;
        for(let i=0; i<inputs.length; ++i) {
            // inputs[i].value = (i < cs.length) ? cs[i] : 0;
            let delta = (i < cs.length) ? cs[i] : 0;
            sum_val += delta;
            inputs[i].value = sum_val;
        }

        let qs = e["questions"];
        if(!qs)
            qs = [];
        for(let i=0; i<questions.length; ++i)
            questions[i].value = (i < qs.length) ? qs[i] : "you!";

        clean_inputs();
    })
    .catch(error => console.error('Error:', error));
};