document.addEventListener('DOMContentLoaded', function() {
    var searchInput = document.getElementById('searchInput');
    var searchButton = document.getElementById('searchButton');
    var eventsList = document.getElementById('events-list');

    searchButton.addEventListener('click', async function(event) {
        event.preventDefault(); // Prevent the form from submitting traditionally

        var query = searchInput.value.trim();

        try {
            const response = await fetch(`/search?query=${query}`);

            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            const data = await response.json();
            console.log(data);

            // Clear previous search results
            eventsList.innerHTML = '';

            // Generate HTML for each search result
            data.forEach(event => {
                const eventCard = `
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="gallery-item h-100">
                            <img src="${event.media_url}" class="img-fluid" alt="" style="width: 500px;height:350px;object-fit:cover;">
                            <div class="gallery-links d-flex align-items-center justify-content-center">
                                <a href="../user/home/${event.id}" class="details-link"><i class="bi bi-eye"></i></a>
                            </div>
                        </div>
                    </div>`;
                eventsList.insertAdjacentHTML('beforeend', eventCard);
            });
        } catch (error) {
            console.error('Error:', error);
        }
    });
});







function filterByCategory(categoryId) {
    var events = document.querySelectorAll('[data-ref="mixitup-target"]');
    var notFoundMessage = document.getElementById('not-found-message');
    var visibleCount = 0;

    events.forEach(function(event) {
        var eventCategory = event.getAttribute('data-category');

        if (!categoryId || eventCategory == categoryId) {
            event.style.display = 'block';
            visibleCount++;
        } else {
            event.style.display = 'none';
        }
    });

    if (visibleCount === 0) {
        notFoundMessage.style.display = 'block';
    } else {
        notFoundMessage.style.display = 'none';
    }
}