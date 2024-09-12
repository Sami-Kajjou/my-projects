let data = fetch("../main/get-info.php").then(result => result.json()).then(data => {
    if (data.userInfo.image !== null) {
        document.querySelector(".header .user a").innerHTML = `
        <img src="${data.userInfo.image}"></img>
        `;
    }
});

function get(data) {
    if (data.info.image === null) {
        let img = document.createElement('i');
        img.className = "fa fa-user-circle";
        document.querySelector(".image").appendChild(img);
    }
    if (data.info.image !== null) {
        let img = document.createElement('img');
        data.info.image = data.info.image;
        img.src = `${data.info.image}`;
        document.querySelector(".image").appendChild(img);
    }
    let pen = document.createElement('i');
    pen.className = "fa fa-pencil-alt";
    document.querySelector(".image").appendChild(pen);
    document.querySelector('.name').innerHTML = `${data.info.name}`;
    document.querySelector('.books-div h2').innerHTML = `${data.info.name}'s library`;
    document.querySelector('.email').innerHTML = `${data.info.email}`;
    data.books.forEach(e => {
        fetch("../main/books.json").then(r => r.json()).then(d => {
            if (d.books === null) {
                let text = document.querySelector('p');
                text.className = "text";
                text.innerHTML = "it had no books";
                document.querySelector('.main-con .books').appendChild(text);
            } else {
                d.books.forEach(element => {
                    if (element.id === e) {

                        let book = document.createElement('div');
                        book.className = "book";
                        let image = document.createElement('div');
                        image.className = "image";
                        let p = document.createElement('p');
                        let img = document.createElement('img');
                        let checking = element.image.slice();
                        if (checking[0] === "n") {
                            element.image = '..\\' + element.image;
                        }
                        img.src = `${element.image}`;
                        p.innerHTML = element.title;
                        image.appendChild(img);
                        book.appendChild(image);
                        book.appendChild(p);
                        book.setAttribute('value', element.id);
                        document.querySelector('.main-con .books').appendChild(book);
                    }
                })
            }

        })
    });
}

let id = sessionStorage.getItem('id');
fetch('load-user.php').then(result => result.json()).then(data => get(data))

function load(eid) {
    fetch("../main/books.json")
        .then(content => content.json())
        .then(value => value.books.forEach((e) => {
            if (e.id === eid) {
                sessionStorage.setItem("book", JSON.stringify(e));
                window.location.href = "../book/";
            }
        }))
}
window.document.body.addEventListener('click', (e) => {
        if (e.target.matches('.book p')) {
            const id = e.target.parentElement.getAttribute('value');
            load(id);
        }
        if (e.target.matches('.book img')) {
            const id = e.target.parentElement.parentElement.getAttribute('value');
            load(id);
        }
        if (e.target.matches('i.fa-pencil-alt')) {
            let divForm = document.createElement('div');
            divForm.className = 'div-form';
            divForm.innerHTML = `
        <h2>add image to your account</h2>
        <form>
            <div class="box">
                <input type="file" id="image" name="image" required>
                <input type="submit" class="submit" value="add">
            </div>
            <a class="exit">exit</a>
        </form>
        `;
            document.querySelector('.main-con').appendChild(divForm);
        }
        if (e.target.matches('.div-form .exit')) {
            let Form = e.target.closest('.div-form');
            Form.style.display = 'none';
        }
    })
    //for user browse

window.document.body.addEventListener('submit', (e) => {
    if (e.target.matches('.div-form form')) {
        const target = document.querySelector('.div-form form');
        let form = new FormData(target);
        e.preventDefault();
        fetch("add-image.php", {
            method: "POST",
            body: form,
        }).then(result => result.text()).then(data => {
            console.log(data);
            if (data === "true") {
                location.reload()
            } else {
                alert('try agin');
            }
        });
    }
})