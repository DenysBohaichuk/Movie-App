function addCastField() {
    const castFields = document.getElementById('cast-fields');
    const newField = document.createElement('div');
    newField.className = 'flex space-x-4 mb-2 cast-entry';
    newField.innerHTML = `
            <input type="text" name="cast_names[]" placeholder="Name (UA)" class="form-input border-gray-300 rounded-md focus:ring focus:ring-blue-200 focus:border-blue-300" required>
            <input type="text" name="cast_names_en[]" placeholder="Name (EN)" class="form-input border-gray-300 rounded-md focus:ring focus:ring-blue-200 focus:border-blue-300" required>
            <select name="cast_types[]" class="form-select border-gray-300 rounded-md focus:ring focus:ring-blue-200 focus:border-blue-300" required>
                <option value="Director">Director</option>
                <option value="Writer">Writer</option>
                <option value="Actor">Actor</option>
                <option value="Composer">Composer</option>
            </select>
            <input type="file" name="cast_photos[]" class="form-input border-gray-300 rounded-md focus:ring focus:ring-blue-200 focus:border-blue-300" required>
            <button type="button" onclick="removeCastField(this)" class="bg-red-500 text-white px-2 rounded">X</button>
        `;
    castFields.appendChild(newField);
}

function removeCastField(button) {
    button.closest('.cast-entry').remove();
}
