function editVehicle(id) {
    fetch('../processes/get_Vehicle.php?vehicleID=' +id)
                 .then(response => {
                     if (!response.ok) {
                         throw new Error('network response was not ok ' + response.statusText);
                     }
                return response.json();
                 })

                .then(data => {

                    console.log(data[0]['vehicleID']);

                    let vehicle = data[0];
                    // document.getElementById('vehicleID').value=vehicle['vehicleID'];
                     document.getElementById('model').value=vehicle['model'];
                     document.getElementById('brand').value=vehicle['brand'];
                     document.getElementById('description').value=vehicle['description'];
                     document.getElementById('price').value=vehicle['price'];
                    //  document.getElementById('image').value=vehicle['image'];
                     document.getElementById('fuel').value=vehicle['fuel'];
                     document.getElementById('seats').value=vehicle['seats'];
                     document.getElementById('doors').value=vehicle['doors'];
                     document.getElementById('categoryID').selectedIndex=vehicle['categoryID'];

                    //  document.getElementById('features').value=vehicle['features'];


                    document.getElementById('editVehicleModal').classList.remove('hidden');
                })
                .catch(error => {
                    console.error('fetch problem:', error);
                });

}