function previewPoster(event) {
    const posterPreview = document.getElementById('poster-preview');

    if (posterPreview) {
        posterPreview.src = URL.createObjectURL(event.target.files[0]);
    } else {
        const img = document.createElement('img');
        img.id = 'poster-preview';
        img.src = URL.createObjectURL(event.target.files[0]);
        img.className = 'preview-image';

        const removeButton = document.createElement('button');
        removeButton.type = 'button';
        removeButton.className = 'delete-button';
        removeButton.innerText = window.translations.deletePoster;
        removeButton.onclick = removePoster;

        const div = document.createElement('div');
        div.className = 'poster-card';
        div.id = 'current-poster';
        div.appendChild(img);
        div.appendChild(removeButton);
        document.querySelector('input[name="poster"]').parentElement.appendChild(div);
    }

    document.getElementById('delete-poster').value = 0;
}

function removePoster() {
    document.getElementById('poster-preview').src = '';
    document.getElementById('delete-poster').value = 1;
    document.querySelector('input[name="poster"]').value = '';
    document.getElementById('current-poster').remove();
}

function previewScreenshots(event) {
    const screenshotsContainer = document.getElementById('screenshots-container');

    Array.from(event.target.files).forEach((file, index) => {
        const container = document.createElement('div');
        container.classList.add('screenshot-card');
        container.dataset.index = `new-${index}`;

        const img = document.createElement('img');
        img.src = URL.createObjectURL(file);
        img.className = 'preview-image';

        const removeButton = document.createElement('button');
        removeButton.type = 'button';
        removeButton.className = 'delete-button';
        removeButton.innerText = window.translations.deleteScreenshot;
        removeButton.onclick = () => container.remove();

        container.appendChild(img);
        container.appendChild(removeButton);
        screenshotsContainer.appendChild(container);
    });
}

function removeScreenshot(index) {
    const container = document.querySelector(`.screenshot-card[data-index="${index}"]`);
    if (container) {
        container.remove();
    }
}
