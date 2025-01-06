function showCarDetails(vehicleID) {
    const modal = document.getElementById(`modal-${vehicleID}`);
    if (modal) modal.classList.remove('hidden');
}

function closeModal(vehicleID) {
    const modal = document.getElementById(`modal-${vehicleID}`);
    if (modal) modal.classList.add('hidden');
}


const BookNowBtw = document.querySelectorAll('#book-now-btn').forEach( function (btn) {
    btn.onclick = () => {
        window.location.href = `reservation.php?vehicleID=${vehicleID}`;
    }

} )






























//  const carsData = {
//     luxury: [
//         {
//             id: 'bmw-7',
//             name: 'BMW 7 Series',
//             category: 'Luxury Sedan',
//             price: 199,
//             image: '../img/car1.jpeg',
//             fuel: 'Petrol',
//             seats: 5,
//             doors: 4,
//             description: 'Ultimate luxury sedan with advanced features and premium comfort.',
//             features: ['Leather seats', 'Panoramic roof', 'Advanced driver assistance', 'Premium sound system'  ],
//             specs: {
//                 engine: '3.0L Twin-Turbo',
//                 power: '335 hp',
//                 transmission: '8-speed automatic',
//                 acceleration: '0-60 mph in 5.3s'
//             }
//         }, 
        
        
//     ],
//     sports: [
//         {
//             id: 'bmw-800',
//             name: 'BMW 8 Series',
//             category: 'Sports',
//             price: 199,
//             image: '../img/car1.jpeg',
//             fuel: 'Petrol',
//             seats: 5,
//             doors: 4,
//             description: 'Ultimate luxury sedan with advanced features and premium comfort.',
//             features: ['Leather seats', 'Panoramic roof', 'Advanced driver assistance', 'Premium sound system'  ],
//             specs: {
//                 engine: '3.0L Twin-Turbo',
//                 power: '335 hp',
//                 transmission: '8-speed automatic',
//                 acceleration: '0-60 mph in 5.3s'
//             }
//         }, 

        
//     ],
//     electric: [
//         {
//             id: 'bmw-800',
//             name: 'BMW 8 Series',
//             category: 'Electrics',
//             price: 199,
//             image: '../img/car1.jpeg',
//             fuel: 'Petrol',
//             seats: 5,
//             doors: 4,
//             description: 'Ultimate luxury sedan with advanced features and premium comfort.',
//             features: ['Leather seats', 'Panoramic roof', 'Advanced driver assistance', 'Premium sound system'  ],
//             specs: {
//                 engine: '3.0L Twin-Turbo',
//                 power: '335 hp',
//                 transmission: '8-speed automatic',
//                 acceleration: '0-60 mph in 5.3s'
//             }
//         },
//     ],
//     suv: [
//         {
//             id: 'bmw-800',
//             name: 'BMW 8 Series',
//             category: 'SUV',
//             price: 199,
//             image: '../img/car1.jpeg',
//             fuel: 'Petrol',
//             seats: 5,
//             doors: 4,
//             description: 'Ultimate luxury sedan with advanced features and premium comfort.',
//             features: ['Leather seats', 'Panoramic roof', 'Advanced driver assistance', 'Premium sound system'  ],
//             specs: {
//                 engine: '3.0L Twin-Turbo',
//                 power: '335 hp',
//                 transmission: '8-speed automatic',
//                 acceleration: '0-60 mph in 5.3s'
//             }
//         },
//     ]
// };

// function displayCars(category = 'all') {
//     const carsGrid = document.getElementById('cars-grid');
//     carsGrid.innerHTML = '';

//     let carsToShow = [];
//     if (category === 'all') {
//         carsToShow = Object.values(carsData).flat();
//     } else {
//         carsToShow = carsData[category] || [];
//     }

//         carsToShow.forEach(car => {
//             const carCard = `
//                 <div class="group rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 cursor-pointer"
//                     onclick="showCarDetails('${car.id}')">
//                     <div class="relative">
//                         <img src="${car.image}" alt="${car.name}" 
//                             class="w-full h-64 object-cover transform group-hover:scale-105 transition-transform duration-300" />
//                         <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full">
//                             <span class="text-blue-600 font-semibold">$${car.price}/day</span>
//                         </div>
//                     </div>
//                     <div class="p-6 bg-white">
//                         <div class="flex justify-between items-start mb-4">
//                             <div>
//                                 <h3 class="text-xl font-bold text-gray-900">${car.name}</h3>
//                                 <p class="text-gray-500">${car.category}</p>
//                             </div>
//                         </div>
//                         <div class="flex items-center gap-4 text-sm text-gray-500 mb-4">
//                             <span>🛢️ ${car.fuel}</span>
//                             <span>🪑 ${car.seats} Seats</span>
//                             <span>🚪 ${car.doors} Doors</span>
//                         </div>
//                         <p class="text-gray-600 mb-6">${car.description}</p>
//                         <button class="w-full bg-blue-600 text-white py-2.5 rounded-xl hover:bg-blue-700 transition-colors">
//                             View Details
//                         </button>
//                     </div>
//                 </div>
//             `;
//             carsGrid.insertAdjacentHTML('beforeend', carCard);
//         });
//     }

//     function showCarDetails(carId) {
//         const modal = document.getElementById('car-modal');
//         const modalContent = document.getElementById('modal-content');
//         const car = Object.values(carsData)
//             .flat()
//             .find(c => c.id === carId);

//         if (!car) return;

//         const content = `
//             <div class="relative">
//                 <button onclick="closeModal()" 
//                         class="absolute right-0 top-0 text-gray-500 hover:text-gray-700">
//                     <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
//                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
//                     </svg>
//                 </button>
//                 <img src="${car.image}" alt="${car.name}" class="w-full h-64 object-cover rounded-lg mb-6">
//                 <h2 class="text-2xl font-bold mb-4">${car.name}</h2>
//                 <div class="grid grid-cols-2 gap-4 mb-6">
//                     <div class="bg-gray-50 p-4 rounded-lg">
//                         <h3 class="font-bold mb-2">Specifications</h3>
//                         <ul class="space-y-2">
//                             ${Object.entries(car.specs).map(([key, value]) => 
//                                 `<li class="text-sm"><span class="text-gray-500">${key}:</span> ${value}</li>`
//                             ).join('')}
//                         </ul>
//                     </div>
//                     <div class="bg-gray-50 p-4 rounded-lg">
//                         <h3 class="font-bold mb-2">Features</h3>
//                         <ul class="space-y-2">
//                             ${car.features.map(feature => 
//                                 `<li class="text-sm">• ${feature}</li>`
//                             ).join('')}
//                         </ul>
//                     </div>
//                 </div>
//                 <button class="w-full bg-blue-600 text-white py-3 rounded-xl hover:bg-blue-700 transition-colors">
//                     Book Now
//                 </button>
//             </div>
//         `;

//     modalContent.innerHTML = content;
//     modal.classList.remove('hidden');
//     modal.classList.add('flex');
// }

// function closeModal() {
//     const modal = document.getElementById('car-modal');
//     modal.classList.add('hidden');
//     modal.classList.remove('flex');
// }

// document.querySelectorAll('.category-card').forEach(card => {
//     card.addEventListener('click', () => {
//         const category = card.dataset.category;
//         displayCars(category);
        
//         document.querySelectorAll('.category-card').forEach(c => 
//             c.classList.remove('ring-2', 'ring-blue-500'));
//         card.classList.add('ring-2', 'ring-blue-500');
//     });
// });

// document.getElementById('car-modal').addEventListener('click', (e) => {
//     if (e.target === e.currentTarget) {
//         closeModal();
//     }
// });

// displayCars();
