const btnNewProdEl = document.getElementById('new_product');
const backdropEl = document.getElementById('backdrop');
const modalEl = document.getElementById('modal_new');
const bodyEl = document.querySelector('body');

const handleWindows = (e) => {
    if(modalEl.classList.contains('show') && e.key === 'Escape'){
        window.removeEventListener('keydown', handleWindows);
        handleModal(e);
    }
}

function handleModal (e) {
    e.preventDefault();
    backdropEl.classList.toggle('show');
    modalEl.classList.toggle('show');
    bodyEl.classList.toggle('scroll_no');

    if(modalEl.classList.contains('show')){
        window.addEventListener('keydown', handleWindows);
    }
}

btnNewProdEl.addEventListener('click', handleModal);
backdropEl.addEventListener('click', handleModal);
