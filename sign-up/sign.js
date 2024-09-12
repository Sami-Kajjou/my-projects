function errorMassage() {
    let span = document.createElement('span');
    span.innerHTML = 'Password Should Have appper letter ,number ,characters ,length more than 6,no space';
    document.querySelector('.con.pass').appendChild(span);
}

window.document.body.addEventListener('submit', (e) => {
    if (e.target.matches('.login')) {
        e.preventDefault();
        let pass = document.querySelector('input[type="password"]').value;
        let bool = false;
        if (pass.length >= 7) {
            for (let i = 0; i < pass.length; i++) {
                if (pass[i] != " ") {
                    bool = true;
                } else {
                    bool = false
                }
                if (65 <= pass[i].charCodeAt(0) <= 90) {
                    bool = true;
                } else {
                    bool = false
                }
                if (33 <= pass[i].charCodeAt(0) <= 47) {
                    bool = true;
                } else {
                    bool = false
                }
                if (48 <= pass[i].charCodeAt(0) <= 58) {
                    bool = true;
                } else {
                    bool = false
                }
            }
            if (bool === false) {
                errorMassage();
            }
        } else {
            errorMassage();
        }

        let form = new FormData(e.target);
        fetch("sign-up.php", {
            method: "POST",
            body: form,
        }).then(result => result.json()).then(data => {
            // console.log(data)
            if (data.sets) {
                // console.log(data.sets);
                location.href = "../home";
            } else {
                //console.log(data.sets);
                location.href = "../sign-up?msg=email-failed";
            }
        })

    }
})