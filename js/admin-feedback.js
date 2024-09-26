function toggleFeedback(element) {
    const shortFeedback = element.querySelector('.short-feedback');
    const fullFeedback = element.querySelector('.full-feedback');

    if (shortFeedback.style.display === 'none') {
        shortFeedback.style.display = 'inline';
        fullFeedback.style.display = 'none';
    } else {
        shortFeedback.style.display = 'none';
        fullFeedback.style.display = 'inline';
    }
}

function deleteFeedback(id, button) {
    const row = button.closest('tr');
    row.remove();

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "PHP/delete_feedback.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            console.log(xhr.responseText);
        }
    };
    xhr.send("id=" + id);    
}

document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.status.post').forEach(function(button) {
        button.addEventListener('click', function() {
            const reviewId = this.closest('tr').dataset.reviewId;
            postFeedback(reviewId);
        });
    });
});

function postFeedback(reviewId) {
    fetch('PHP/post_feedback.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'id=' + reviewId
    })
    .then(response => {
        if (response.ok) {
            return response.text();
        } else {
            return response.json().then(data => {
                throw new Error(data.error);
            });
        }
    })
    .then(data => {
        if (data => 'success') {
            alert('Feedback Status - ' + data);
        }
    })
    .catch(error => {
        console.error('Review Already Posted');
    });
}
