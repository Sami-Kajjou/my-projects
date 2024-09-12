let books = [];
let data = fetch("../main/get-info.php").then(result => result.json()).then(data => {
    if (data.userInfo.image !== null) {
        document.querySelector(".header .user a").innerHTML = `
        <img src="${data.userInfo.image}"></img>
        `;
    }
    data.userInfo.books.forEach(e => {
        books.push(e);
    })
});
window.onload = function() {
    let title = document.querySelector('title');
    document.querySelectorAll('.container .info li a').forEach(e => {
        if (e.innerHTML == title.innerHTML) {
            e.parentElement.classList.add("active");
        }
    })

    //getting the books from API
    let prom = fetch('../main/books.json').then(Respon => Respon.json());
    let con = document.createElement('div');
    con.classList.add('con');
    prom.then(value => {
        value.books.forEach((e) => {
            let content = document.createElement('div');
            content.classList.add('content');
            let bool = books.includes(e.id);
            if (!bool) {
                let i = document.createElement('i');
                i.className = 'fa fa-square-plus not-added';
                content.appendChild(i);
            }
            let about = document.createElement('div');
            about.classList.add('about');
            for (let key in e) {
                if (e.hasOwnProperty(key)) {
                    let box = document.createElement('div');
                    box.classList.add('box');
                    value = e[key];
                    if (key === 'subtitle') {
                        continue;
                    } else if (key === 'id') {
                        content.setAttribute('value', value);
                    } else if (key === 'url') {
                        let a = document.createElement('a');
                        a.href = `${value}`;
                        a.innerHTML = 'Get The Book';
                        about.appendChild(a);
                    } else if (key === 'image') {
                        let img = document.createElement('img');
                        img.src = `${value}`;
                        let image = document.createElement('div');
                        image.classList.add('image');
                        image.appendChild(img);
                        content.appendChild(image);
                    } else if (key === 'title') {
                        let h4 = document.createElement('h4');
                        h4.innerHTML = `${value}`;
                        about.appendChild(h4);
                    } else {
                        let span = document.createElement('span');
                        let p = document.createElement('p');
                        span.innerHTML = key;
                        let arr = value.split(',');
                        p.innerHTML = arr[0];
                        box.appendChild(span);
                        box.appendChild(p);
                        about.appendChild(box);
                    }
                    content.appendChild(about);
                    con.appendChild(content);
                    document.querySelector('.main').appendChild(con);
                }
            }
        });
    });
}

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
setTimeout(() => {
    let add = document.querySelectorAll(".content i");
    add.forEach((Element) => {
        Element.addEventListener('click', () => {
            Element.classList.remove("not-added");
            Element.classList.add("added");
            const id = Element.parentElement.getAttribute('value');
            fetch("add.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json; charset=UTF-8"
                    },
                    body: id
                })
                .then(response => response.text())
                .then(data => {
                    books.push(id);
                    alert(data);
                    location.reload();
                })
                .catch(error => console.error(error))
        })
    }, { once: true });

    document.body.addEventListener('click', (event) => {
        if (event.target.matches('.header .user a i.fa-user-circle') || event.target.matches('.header .user a img')) {
            window.location.href = "../profile";
        }
    });
    document.body.addEventListener('submit', (Event) => {
        if (Event.target.matches(".add-form-div form")) {
            let form = document.querySelector(".add-form-div form");
            let info = new FormData(form)
            Event.preventDefault();
            fetch("add-book-to-db.php", {
                method: "POST",
                body: info,
            }).then(result => result.text()).then(data => alert(data));
        }

    })
    let content = document.querySelectorAll(".con .content .about h4");
    let img = document.querySelectorAll(".content .image img");
    content.forEach((Element) => {
        Element.addEventListener('click', () => {
            let eid = Element.parentElement.parentElement.getAttribute('value');
            load(eid);
        })
    })
    img.forEach((Element) => {
        Element.addEventListener('click', () => {
            let eid = Element.parentElement.parentElement.getAttribute('value');
            load(eid);
        })
    })
}, 1000)