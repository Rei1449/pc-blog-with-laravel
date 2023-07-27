import './bootstrap';

import Alpine from 'alpinejs';


window.Alpine = Alpine;

Alpine.start();

const commentButton = document.getElementById('commentButton');
const commentForm = document.getElementById('commentForm');

commentButton.addEventListener('click', () => {
    commentForm.classList.toggle('hidden');
});