function editCatName(categoryID) {
    const input = document.getElementById(`catName${categoryID}`);
    const button = document.getElementById(`btn-${categoryID}`);
    input.readOnly = false;
    input.focus();
    button.style.display = 'block';
}
