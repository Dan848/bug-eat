import Chart from 'chart.js/auto';
const chartOrders = document.getElementById('myOrders');
const chartRestaurants = document.getElementById('myRestaurants');
const chartEarns = document.getElementById('myEarns');
const orders = document.querySelectorAll('.orders');

// Get data from php
// Get Data to Pie Chart
const totalOrdersCount = [];
const restaurantNames = [];


//Array of Object
let restaurants = [];
let index = 0;
orders.forEach((order) => {
    const rest_name = order.getAttribute('data-item-restaurant');
    if (!restaurants.some(restaurant => restaurant.name == rest_name)) {
        let newRestaurant = {
            name: '',
            ordersCount: [],
            totalPrice: [],
            arrayMonth:[]
        }
        newRestaurant.name = rest_name;
        newRestaurant.ordersCount.push(parseInt(order.getAttribute('data-item-count'), 10));
        newRestaurant.totalPrice.push(parseFloat(order.getAttribute('data-item-price')));
        newRestaurant.arrayMonth.push(order.getAttribute('data-item-date'));
        restaurants.push(newRestaurant);
        index++;
    } else {
        restaurants[index-1].ordersCount.push(parseInt(order.getAttribute('data-item-count'), 10));
        restaurants[index-1].totalPrice.push(parseFloat(order.getAttribute('data-item-price')));
        restaurants[index-1].arrayMonth.push(order.getAttribute('data-item-date'));
    }
});

let maxDateLength = 0;
let labelDate = [];

for (let i = 0; i < restaurants.length; i++) {
  if (restaurants[i].arrayMonth.length > maxDateLength) {
    maxDateLength = restaurants[i].arrayMonth.length;
    labelDate = restaurants[i].arrayMonth;
  }
}

/////////////////////////////////////////
for (let i = 0; i < restaurants.length; i++) {
    let missingDates = [];

    // Trova le date mancanti nell'array "dates"
    for (let j = 0; j < labelDate.length; j++) {
      if (!restaurants[i].arrayMonth.includes(labelDate[j])) {
        missingDates.push(labelDate[j]);
      }
    }

    // Ordina le date mancanti in ordine crescente
    missingDates.sort();

    // Inserisci i valori zero corrispondenti nelle posizioni corrette degli array "ordersCount" e "totalPrice"
    for (let k = 0; k < missingDates.length; k++) {
      const index = labelDate.indexOf(missingDates[k]);
      restaurants[i].arrayMonth.splice(index, 0, missingDates[k]);
      restaurants[i].ordersCount.splice(index, 0, 0);
      restaurants[i].totalPrice.splice(index, 0, 0);
    }
}
console.log(restaurants);

// For to Pie Chart total orders in a Year
for (let i = 0; i < restaurants.length; i++) {
    let sum = 0;
    for (let j = 0; j < restaurants[i].ordersCount.length; j++) {
        sum += restaurants[i].ordersCount[j];
    }
    totalOrdersCount.push(sum);
    restaurantNames.push(restaurants[i].name);
}


if (chartOrders) {
    new Chart(chartOrders, {
        type: 'bar',
        data: {
            labels: labelDate,
            datasets: restaurants.map((restaurant) => ({
                label: restaurant.name,
                data: restaurant.ordersCount,
                borderWidth: 1
            })),
          },
          options: {
            scales: {
              y: {
                beginAtZero: true
              }
            }
          }
        });
}


if (chartEarns) {
    new Chart(chartEarns, {
        type: 'line',
        data: {
            labels: labelDate,
            datasets: restaurants.map((restaurant) => ({
                label: restaurant.name,
                data: restaurant.totalPrice,
                borderWidth: 1
            })),
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}

if (chartRestaurants) {
    new Chart(chartRestaurants, {
        type: 'pie',
        data: {
            labels: restaurantNames,
            datasets: [{
                label: 'Numero ordini',
                data: totalOrdersCount,
                borderWidth: 1
            }]
        },
    });
}

