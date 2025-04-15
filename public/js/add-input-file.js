function addFileInput() {

    const inputsContainer = document.getElementById('file-inputs');

    let createFileInput = document.createElement('input');

    createFileInput.className = 'form-control my-2';
    createFileInput.type = 'file';
    createFileInput.name ='images[]';
    createFileInput.accept = 'image/*';
    createFileInput.multiple = true;

    inputsContainer.append(createFileInput);
    
}