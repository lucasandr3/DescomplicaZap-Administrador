const API = 'http://localhost/zapdevelop/portal';

function CloseStore(status) {

    fetch(`${API}/store/closeStore/${status}`)
        .then((r) => r.json())
        .then((result) => {
            window.location.reload();
        });
}

function OpenStore(status) {

    fetch(`${API}/store/openStore/${status}`)
        .then((r) => r.json())
        .then((result) => {
            window.location.reload();
        });
}