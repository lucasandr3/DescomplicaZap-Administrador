function showProductEdit() {

    let id = document.querySelector('#product_edit_id').value;
    let cat = categorias;
    let html = '';
    let cate = '';

    fetch('http://localhost/zapdevelop/portal/menu/productid/'+id)
    .then((r) => r.json())
    .then((res) => {
console.log(res)
        let status = '';

        if(res.produto.status === 'PACTIVE' ) {
            status = 'Publicado';
        } else {
            status = 'Não Publicado';
        }   

        document.querySelector('#cate-atual').innerHTML = `<option value="${res.produto.category}">${res.produto.category}</option>`;
        document.querySelector('#n-produto').value = res.produto.name_product;
        document.querySelector('#i-produto').value = res.produto.description;
        document.querySelector('#p-produto').value = res.produto.price;
        document.querySelector('#sp-produto').value = res.produto.promo_price;
        document.querySelector('#p-id').value = res.produto.id;
        document.querySelector('#im-produto').innerHTML = `<img src="${res.produto.image}" style="width: 200px;height: auto;border: 2px solid #f74f57;border-radius: 8px;"/>`;
        document.querySelector('#s-atual').innerHTML = `<option value="${res.produto.status}">${status}</option>`;

        document.querySelector('#btnedit').removeAttribute('disabled')
    })
}

document.querySelector('#alter-cat').addEventListener('click', (e) => {

    e.preventDefault();
    document.querySelector('#a-categoria').style.display = 'none';
    document.querySelector('#v-categoria').style.display = 'block';
});

document.querySelector('#alter-st').addEventListener('click', (e) => {

    e.preventDefault();
    document.querySelector('#a-sta').style.display = 'none';
    document.querySelector('#s-alter').style.display = 'block';
});