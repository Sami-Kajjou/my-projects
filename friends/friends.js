let data = fetch("../main/get-info.php").then(result => result.json()).then(data => {
    if (data.userInfo.image !== null) {
        document.querySelector(".header .user a").innerHTML = `
        <img src="${data.userInfo.image}"></img>
        `;
    }
});
let friendsId = [];
window.onload = function() {
    let title = document.querySelector('title');
    document.querySelectorAll('.container .info li a').forEach(e => {
        if (e.innerHTML == title.innerHTML) {
            e.parentElement.classList.add("active");
        }
    })
    fetch("get-friends.php").then(result => result.json()).then(data => {

        if (data.friends.length !== 0) {
            let h2 = document.createElement('h2');
            h2.innerHTML = "friend";
            document.querySelector('.friends').appendChild(h2);
            data.friends.forEach(e => {
                friendsId.push(e['id']);
                let friend = document.createElement('div');
                friend.className = "friend";
                let userInfo = document.createElement('div');
                userInfo.className = 'person-info';
                let con = document.createElement('div');
                con.className = "con";
                let id = document.createElement('span');
                let name = document.createElement('p');
                if (e['image'] !== null) {
                    const image = document.createElement('div');
                    image.className = "image";
                    const threeDots = document.createElement('i');
                    threeDots.className = "fa fa-xmark ";
                    const img = document.createElement('img');
                    img.src = e.image;
                    image.appendChild(threeDots);
                    image.appendChild(img);
                    friend.appendChild(image);
                } else {
                    let img = document.createElement('i');
                    img.className = "fa fa-user-circle";
                    const threeDots = document.createElement('i');
                    threeDots.className = "fa fa-xmark";
                    const image = document.createElement('div');
                    image.className = "image";
                    image.appendChild(threeDots);
                    image.appendChild(img);
                    friend.appendChild(image);
                }
                id.innerHTML = `#${e['id']}`;
                name.innerHTML = `${e['user']}`;
                con.appendChild(id);
                con.appendChild(name);
                userInfo.appendChild(con);
                friend.appendChild(userInfo);
                friend.setAttribute('value', e['id']);
                document.querySelector('.friends').appendChild(friend);
            });
        } else {
            let p = document.createElement('p');
            p.innerHTML = "add some friends";
            p.className = "text";
            let h2 = document.createElement('h2');
            h2.innerHTML = "friend";
            document.querySelector('.friends').appendChild(h2);
            document.querySelector('.friends').appendChild(p);
        }
    })
}

function add(e, person, userInfo) {
    let id = document.createElement('span');
    let name = document.createElement('p');
    if (e['image'] !== null) {
        const image = document.createElement('div');
        image.className = "image";

        const img = document.createElement('img');
        img.src = e.image;

        image.appendChild(img);
        person.appendChild(image);
    } else {
        let img = document.createElement('i');
        img.className = "fa fa-user-circle";
        const image = document.createElement('div');
        image.className = "image";
        image.appendChild(img);
        person.appendChild(image);
    }
    id.innerHTML = `#${e['id']}`;
    name.innerHTML = `${e['user']}`;
    userInfo.appendChild(id);
    userInfo.appendChild(name);
    person.appendChild(userInfo);
    person.setAttribute('value', e['id']);
}
window.document.body.addEventListener('click', (e) => {
    //to search into database for person
    if (e.target.matches('.search-bar i')) {
        const userToSearch = document.querySelector('.search input').value;
        fetch('find-person.php', {
                method: 'POST',
                headers: {
                    "Content-Type": "application/json; charset=UTF-8"
                },
                body: userToSearch,
            })
            .then(result => result.json()).then((data) => {
                document.querySelector('.people').innerHTML = "";
                let bool = false;
                data.users.forEach(e => {
                    if (data.userId === e.id) {
                        return;
                    }
                    let bool = friendsId.includes(e.id);
                    if (bool === true) {
                        let person = document.createElement('div');
                        person.className = "person";
                        let userInfo = document.createElement('div');
                        userInfo.className = 'person-info';
                        add(e, person, userInfo);
                        document.querySelector('.people').appendChild(person);
                    }
                    if (bool === false) {
                        let person = document.createElement('div');
                        person.className = "person";
                        let userInfo = document.createElement('div');
                        userInfo.className = 'person-info';
                        add(e, person, userInfo);
                        let a = document.createElement('a');
                        a.className = "add-friend";
                        a.innerHTML = "add friend";
                        userInfo.appendChild(a)
                        document.querySelector('.people').appendChild(person);
                    }
                });
            })
            .catch(() => {
                let div = document.createElement('div');
                div.className = "not-found";
                let p = document.createElement('p');
                p.innerHTML = "not-found";
                div.appendChild(p);
                document.querySelector('.people').appendChild(div);
            })
    }
    if (e.target.matches('.add-friend')) {

        fetch('add-friend.php', {
            method: 'POST',
            headers: {
                "Content-Type": "application/json; charset=UTF-8"
            },
            body: e.target.parentElement.parentElement.getAttribute('value'),
        }).then(result => result.text()).then(data => {
            alert(data);
            location.reload();
        });
    }
    if (e.target.matches('.friend .person-info') || e.target.matches('.person .person-info')) {
        const val = e.target.parentElement.getAttribute('value');
        sessionStorage.setItem('id', val);
        window.location.href = "../user";
    }
    if (e.target.matches('.friend .image img') || e.target.matches('.friend .image i.fa.fa-user-circle') || e.target.matches('.person .image img') || e.target.matches('.person .image i')) {
        const val = e.target.parentElement.parentElement.getAttribute('value');
        sessionStorage.setItem('id', val);
        window.location.href = "../user";
    }
    if (e.target.matches('.header .user a i.fa-user-circle') || e.target.matches('.header .user a img')) {
        window.location.href = "../profile";
    }
    if (e.target.matches('.nav .friends .friend .image i.fa.fa-xmark')) {
        const id = e.target.parentElement.parentElement.getAttribute('value');
        let alertDiv = document.createElement('div');
        alertDiv.classList = "alertDiv";
        alertDiv.setAttribute('value', id);
        alertDiv.innerHTML = `
            <p>are you sure you want to unFriend </p>
            <div class="btn">
                <button id="yes">Yes</button>
                <button id="no">No</button>
            </div>
        `
        document.querySelector('.container').appendChild(alertDiv);
    }
    if (e.target.matches('.container .alertDiv #no')) {
        let div = e.target.closest(".container .alertDiv");
        div.style.display = "none";
    }
    if (e.target.matches('.container .alertDiv #yes')) {
        let id = e.target.parentElement.parentElement.getAttribute('value');
        fetch("delete-friend.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json; charset:UTF-8"
            },
            body: id,
        }).then(result => result.json()).then(data => {
            if (data.result) {
                let div = e.target.closest(".container .alertDiv");
                div.innerHTML = `
                <p class"text">You are not friend with it any more</p>
                `;
                setTimeout(() => {
                    location.reload();
                }, 1000);
            }
        });

    }
})
window.document.body.addEventListener('keydown', (e) => {
    if (e.key === 'Enter') {
        document.querySelector('.search-bar i').click();
    }
})