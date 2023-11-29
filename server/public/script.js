const removeWord = (id) => {
    fetch('https://kanfadon.ru/page/remove-word', {
        method: "POST",
        body: JSON.stringify({
            id
        }),
        headers: {
            "Content-type": "application/json; charset=UTF-8"
        }
    })
        .then(result => result.json())
        .then(data => {
            if (data?.status && data?.result) {
                location.reload();
            } else {
                alert('Произошла ошибка!');
            }
        });
};

const getSound = (text) => {
    fetch('https://kanfadon.ru/page/words', {
        method: "POST",
        body: JSON.stringify({
            text
        }),
        headers: {
            "Content-type": "application/json; charset=UTF-8"
        }
    })
        .then(result => result.text())
        .then(data => {
            var audio = new Audio('data:audio/x-wav;base64,' + data);
            audio.play();
        });
};

document.body.addEventListener('click', (e) => {
    if (e.target.id === 'remove-btn') {
        if (confirm("Удалить выбранное слово навсегда?")) {
            removeWord(+e.target.dataset.wordId);
        }
    }

    if (e.target.id === 'word') {
        getSound(e.target.innerHTML);
    }
});