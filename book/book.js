function Comment(id) {
    fetch("get-comments.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json; charset:UTF-8"
        },
        body: id,
    }).then(result => result.json()).then(data => {
        try {
            data.comments.forEach(element => {
                let allComments = document.createElement('div');
                allComments.className = "allComments";
                let comment = document.createElement('div');
                comment.className = "comment";
                comment.setAttribute('value', element.userId);
                let image = document.createElement('div');
                image.className = "image";
                let userInfo = document.createElement('div');
                userInfo.className = "user-info";
                let name = document.createElement('span');
                name.className = "user-name";
                name.innerHTML = `${element.userName}`;
                let thePost = document.createElement('div');
                thePost.className = "the-post";
                thePost.innerHTML = `${element.comment}`;
                if (element.userImage !== null) {
                    let img = document.createElement('img');
                    img.src = `${element.userImage}`;
                    image.appendChild(img);
                } else {
                    let img = document.createElement('i');
                    id.className = "fa fa-user-circle";
                    image.appendChild(img);
                }
                comment.appendChild(image);
                userInfo.appendChild(name);
                userInfo.appendChild(thePost);
                comment.appendChild(userInfo);
                allComments.appendChild(comment);
                document.querySelector('.main-content .comments').appendChild(allComments);
            });
        } catch {
            let text = document.createElement('p');
            text.className = "text";
            text.innerHTML = "no comments";
            document.querySelector('.main-content .comments').appendChild(text);
        }

    });

}
let data = fetch("../main/get-info.php").then(result => result.json()).then(data => {
    if (data.userInfo.image !== null) {
        document.querySelector(".header .user a").innerHTML = `
        <img src="${data.userInfo.image}"></img>
        `;
    }
});

let book = document.querySelector('.book');
let rec = JSON.parse(sessionStorage.getItem("book"));
Comment(rec.id);

book.setAttribute('value', rec.id);
const check = rec.image.slice();
if (check[0] === 'n') {
    document.querySelector('.book .image img').src = '..\\' + rec.image;
} else {
    document.querySelector('.book .image img').src = rec.image;
}
document.querySelector('.book .book-info h2').innerHTML = rec.title;
document.querySelector('.book .book-info i').innerHTML = rec.authors;
document.querySelector('.book .book-info a').href = rec.url;
document.querySelector('.book .book-info p').innerHTML = rec.subtitle;
let e = document.querySelector('.button');
e.addEventListener('click', () => {
    const id = e.parentElement.getAttribute('value');
    fetch("../add.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json; charset=UTF-8"
            },
            body: id
        })
        .then(response => response.text())
        .then(data => alert(data))
})
window.document.body.addEventListener('click', (e) => {
    if (e.target.matches('.header .user a i.fa-user-circle') || e.target.matches('.header .user a img')) {
        window.location.href = "../profile";
    }

})
window.document.body.addEventListener('submit', (e) => {
    if (e.target.matches(".main-content .comments form")) {
        e.preventDefault();
        let comment = document.querySelector(".main-content .comments form textarea")
        if (comment.innerHTML === "") {
            alert("you did not wrote anything");
        } else {
            let id = document.querySelector(".book").getAttribute("value");
            let form = new FormData(e.target);
            form.append("bookid", id);
            fetch('set-comment.php', {
                method: "POST",
                body: form,
            }).then(result => result.json()).then(data => {
                if (data.massage) {
                    location.reload()
                } else {
                    alert("some thing wrong try again");
                }
            });
        }
    }
})