import Chart from 'chart.js/auto';
const chartOrders = document.getElementById('myOrders');
const chartRestaurants = document.getElementById('myRestaurants');
const chartEarns = document.getElementById('myEarns');

const arrayData = [];

const orders = document.querySelectorAll('.ordini');
for (let i = 0; i < 12; i++){
    arrayData.push(orders[i].getAttribute('data-item-date'))
}

let restaurants = [];
let index = 0;
orders.forEach((order) => {
    const rest_name = order.getAttribute('data-item-restaurant');
    if (!restaurants.some(restaurant => restaurant.name == rest_name)) {
        let newRestaurant = {
            name: '',
            ordersCount: [],
            totalPrice: []
        }
        newRestaurant.name = rest_name;
        newRestaurant.ordersCount.push(parseInt(order.getAttribute('data-item-count'), 10));
        newRestaurant.totalPrice.push(parseFloat(order.getAttribute('data-item-price')));
        restaurants.push(newRestaurant);
        index++;
    } else {
        restaurants[index-1].ordersCount.push(parseInt(order.getAttribute('data-item-count'), 10));
        restaurants[index-1].totalPrice.push(parseFloat(order.getAttribute('data-item-price')));
    }
});



if (chartOrders) {
    // Utilizza i dati ottenuti come valori per il grafico
    new Chart(chartOrders, {
        type: 'bar',
        data: {
            labels: arrayData,
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
            labels: arrayData,
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

const totalOrdersCount = [];
const restaurantNames = [];

for (let i = 0; i < restaurants.length; i++) {
    let sum = 0;
    for (let j = 0; j < restaurants[i].ordersCount.length; j++) {
        sum += restaurants[i].ordersCount[j];
    }
    totalOrdersCount.push(sum);
    restaurantNames.push(restaurants[i].name);
}

if (chartRestaurants) {
    new Chart(chartRestaurants, {
        type: 'doughnut',
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

