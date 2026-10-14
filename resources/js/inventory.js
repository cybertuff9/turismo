import Swiper from 'swiper';
import { Navigation, Pagination, Autoplay } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';

// Hero slider
if (document.querySelector('.hero-swiper')) {
    new Swiper('.hero-swiper', {
        modules: [Navigation, Pagination, Autoplay],
        loop: true,
        autoplay: { delay: 5000, disableOnInteraction: false },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        pagination: { el: '.swiper-pagination', clickable: true },
    });
}

// Filter + pencarian
const cards = document.querySelectorAll('.card');
const tabs = document.querySelectorAll('.tab');
const search = document.getElementById('search');
const empty = document.getElementById('empty');

let filter = 'all';
let keyword = '';

function apply() {
    let visible = 0;

    cards.forEach((card) => {
        const okSegment = filter === 'all' || card.dataset.segment === filter;
        const okName = card.dataset.name.includes(keyword);
        const show = okSegment && okName;
        card.style.display = show ? '' : 'none';
        if (show) visible++;
    });

    tabs.forEach((t) => {
        const active = t.dataset.filter === filter;
        t.classList.toggle('border-red-600', active);
        t.classList.toggle('text-black', active);
        t.classList.toggle('border-transparent', !active);
        t.classList.toggle('text-neutral-500', !active);
    });

    if (empty) empty.classList.toggle('hidden', visible > 0);
}

tabs.forEach((t) =>
    t.addEventListener('click', () => {
        filter = t.dataset.filter;
        apply();
    })
);

if (search) {
    search.addEventListener('input', (e) => {
        keyword = e.target.value.toLowerCase().trim();
        apply();
    });
}

// Tombol "Explore Collections" langsung memfilter sesuai seri
document.querySelectorAll('[data-explore]').forEach((link) =>
    link.addEventListener('click', () => {
        filter = link.dataset.explore;
        apply();
    })
);

if (tabs.length) apply();