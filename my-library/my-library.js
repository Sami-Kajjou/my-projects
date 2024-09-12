let data = fetch("../main/get-info.php").then(result => result.json()).then(data => {
    if (data.userInfo.image !== null) {
        document.querySelector(".header .user a").innerHTML = `
        <img src="${data.userInfo.image}"></img>
        `;
    }
});
window.onload = function() {
    let title = document.querySelector('title');
    document.querySelectorAll('.container .info li a').forEach(e => {
        if (e.innerHTML == title.innerHTML) {
            e.parentElement.classList.add("active");
        }
    })
    fetch("info.php").then(result => result.json())
        .then(data => {
            if (data.massage) {
                document.querySelector(".books-info").innerHTML = `
                <p class="massage">${data.massage}</p>
                `;
            } else {
                data.forEach(e => {
                    fetch("../main/books.json").then(result => result.json())
                        .then(data => {
                            data.books.forEach(ele => {
                                if (ele.id == e[0]) {
                                    let checking = ele.image.slice();

                                    if (checking[0] === "n") {
                                        ele.image = '..\\' + ele.image;
                                    }
                                    let book = document.createElement('div');
                                    book.className = 'book';
                                    book.setAttribute('value', ele.id);
                                    book.innerHTML = `
                                <div class="image">
                                    <img src="${ele.image}">
                                </div>
                                <div class="book-con">
                                <h3>${ele.title}</h3>
                                <i>${ele.authors}</i>
                                <p>${ele.subtitle}</p>
                                <a href="${ele.url}">get the book</a>
                                <button class="remove">X</button>
                                </div>
                            `
                                    document.querySelector(".books-info").appendChild(book);
                                }
                            })
                        })
                });
            }

        })

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
document.body.addEventListener('click', e => {
    if (e.target.matches(".remove")) {
        let id = e.target.parentElement.parentElement.getAttribute('value');
        fetch("remove.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json; charset=UTF-8"
                },
                body: id,
            }).then(result => result.text()).then(data => {
                alert(data);
            })
            .then(() => { setTimeout(window.location.reload(), 1000) });
    }
    if (e.target.matches('.header .user a i.fa-user-circle') || e.target.matches('.header .user a img')) {
        window.location.href = "../profile";
    }
    if (e.target.matches(".image img") || e.target.matches(".book-con h3")) {
        const eid = e.target.parentElement.parentElement.getAttribute('value');
        load(eid);
    }
})