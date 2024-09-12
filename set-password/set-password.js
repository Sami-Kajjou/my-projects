window.document.body.addEventListener('submit', (e) => {
    if (e.target.matches('.form form')) {
        let form = e.target;
        fetch('mail.php', {
            method: 'POST',
            body: form,
        }).then(result => result.text()).then(data => {
            if (data.result) {
                document.querySelector('.form').className = "chicking";
                let form = document.querySelector('.chicking form');
                form.innerHTML = ` 
                <label for="num">We Send You A Code To Your Email </label>
                <input type="number" name="num" placeholder="Inter The Code">
                <input type="submit" value="send">

                `;
            }
        })
    }
    if (e.target.matches('.chicking form')) {
        let form = e.target;
        fetch('chick.php', {
            method: 'POST',
            body: form,
        }).then(result => result.json()).then(data => {
            if (data.currecte) {
                document.querySelector('.form').className = "get-password";
                let form = document.querySelector('.get-password form');
                form.innerHTML = ` 
                <input type="password" name="pass" placeholder="Inter Your New Password">
                <input type="submit" value="send">
                `;
            }
        })
    }
    if (e.target.matches('.get-password form')) {
        let form = e.target;
        fetch('set.php', {
            method: 'POST',
            body: form,
        }).then(result => result.json()).then(data => {
            if (data.done) {
                location.href = "../login/";
            } else {
                console.error('error');
            }
        })
    }

})