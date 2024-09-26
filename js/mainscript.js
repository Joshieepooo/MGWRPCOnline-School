document.addEventListener("DOMContentLoaded", function() {
    let slider = document.querySelector('.slider .list');
    let items = document.querySelectorAll('.slider .list .item');
    let next = document.getElementById('next');
    let prev = document.getElementById('prev');
    let dots = document.querySelectorAll('.slider .dots li');

    let lengthItems = items.length - 1;
    let active = 0;

    next.onclick = function() {
        active = active + 1 <= lengthItems ? active + 1 : 0;
        reloadSlider();
    }

    prev.onclick = function() {
        active = active - 1 >= 0 ? active - 1 : lengthItems;
        reloadSlider();
    }

    let refreshInterval = setInterval(()=> {next.click()}, 3000);

    function reloadSlider() {
        slider.style.left = -active * items[0].offsetWidth + 'px';
        let last_active_dot = document.querySelector('.slider .dots li.active');
        last_active_dot.classList.remove('active');
        dots[active].classList.add('active');
        clearInterval(refreshInterval);
        refreshInterval = setInterval(()=> {next.click()}, 12000);
    }

    dots.forEach((li, key) => {
        li.addEventListener('click', () => {
            active = key;
            reloadSlider();
        });
    });
});


document.addEventListener('DOMContentLoaded', function() {
    const search = document.querySelector('.input-group input'),
    table_rows = document.querySelectorAll('tbody tr'),
    table_headings = document.querySelectorAll('thead th');

    search.addEventListener('input', searchTable);

    function searchTable() {
        table_rows.forEach((row, i) => {
            let table_data = row.textContent.toLowerCase(),
                search_data = search.value.toLowerCase();

            row.classList.toggle('hide', table_data.indexOf(search_data) < 0);
            row.style.setProperty('--delay', i / 25 + 's');
        })

        document.querySelectorAll('tbody tr:not(.hide)').forEach((visible_row, i) => {
            visible_row.style.backgroundColor = (i % 2 == 0) ? 'transparent' : '#0000000b';
        });
    }

    table_headings.forEach((head, i) => {
        let sort_asc = true;
        head.onclick = () => {
            table_headings.forEach(head => head.classList.remove('active'));
            head.classList.add('active');

            document.querySelectorAll('td').forEach(td => td.classList.remove('active'));
            table_rows.forEach(row => {
                row.querySelectorAll('td')[i].classList.add('active');
            })

            head.classList.toggle('asc', sort_asc);
            sort_asc = head.classList.contains('asc') ? false : true;

            sortTable(i, sort_asc);
        }
    })

    function sortTable(column, sort_asc) {
        [...table_rows].sort((a, b) => {
            let first_row = a.querySelectorAll('td')[column].textContent.toLowerCase(),
                second_row = b.querySelectorAll('td')[column].textContent.toLowerCase();

            return sort_asc ? (first_row < second_row ? 1 : -1) : (first_row < second_row ? -1 : 1);
        })
            .map(sorted_row => document.querySelector('tbody').appendChild(sorted_row));
    }
});

document.addEventListener('DOMContentLoaded', () => {
    const reserveNowBtn = document.getElementById('reserveNowBtn');
    const reserveModal = document.getElementById('reserveModal');
    const successModal = document.getElementById('successModal');
    const closeBtns = document.querySelectorAll('.close-btn');
    const confirmBtn = document.getElementById('confirmBtn');
    const cancelBtn = document.getElementById('cancelBtn');
    const goBackBtn = document.getElementById('goBackBtn');

    // Show reservation modal
    reserveNowBtn.addEventListener('click', () => {
        reserveModal.style.display = 'block';
    });

    // Close modals
    closeBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            reserveModal.style.display = 'none';
            successModal.style.display = 'none';
        });
    });

    // Confirm reservation
    confirmBtn.addEventListener('click', () => {
        reserveModal.style.display = 'none';
        successModal.style.display = 'block';
        closeBtns.forEach(btn => btn.style.display = 'none'); 
    });

    // Go back to main modal
    goBackBtn.addEventListener('click', () => {
        successModal.style.display = 'none';
        reserveModal.style.display = 'none';
        closeBtns.forEach(btn => btn.style.display = 'block');
    });

    // Cancel reservation
    cancelBtn.addEventListener('click', () => {
        reserveModal.style.display = 'none';
    });
});
