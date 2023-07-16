import Chart from 'chart.js/auto';
const chartOrders = document.getElementById('myOrders');
const chartRestaurants = document.getElementById('myRestaurants');
const chartEarns = document.getElementById('myEarns');

const arrayData = [];
const arrayCount = [];
const arrayPrice = [];
const restaurantName = [];

const orders = document.querySelectorAll('.ordini');
for (let i = 0; i < 12; i++){
    arrayData.push(orders[i].getAttribute('data-item-date'))
}

let restaurants = [];
let index = 0;
orders.forEach((order) => {
    const rest_name = order.getAttribute('data-item-restaurant');
    const rest_index = restaurants.findIndex(restaurant => restaurant.name == rest_name);
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

// restaurants.ordersCount = arrayCount.push(parseInt(order.getAttribute('data-item-count'), 10));
// arrayPrice.push(parseFloat(order.getAttribute('data-item-price')));
// restaurantName.push(order.getAttribute('data-item-restaurant'));

if (chartOrders) {
    // Utilizza i dati ottenuti come valori per il grafico
    new Chart(chartOrders, {
        type: 'bar',
        data: {
            labels: arrayData,
            datasets: [
                {
                label: restaurants[0].name,
                data: restaurants[0].ordersCount,
                borderWidth: 1
                },
                {
                label: restaurants[1].name,
                data: restaurants[1].ordersCount,
                borderWidth: 1
                },
            ]
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
            datasets: [
                {
                    label: restaurants[0].name,
                    data: restaurants[0].totalPrice,
                    borderWidth: 1
                },
                {
                    label: restaurants[1].name,
                    data: restaurants[1].totalPrice,
                    borderWidth: 1
                },
            ]
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
for (let i = 0; i < restaurants.length; i++){
    let sum = 0;
    for (let j = 0; j < restaurants[i].ordersCount.length; j++){
        sum += restaurants[i].ordersCount[j];
        console.log('secondo for');
    }
    totalOrdersCount.push(sum);
}
console.log(totalOrdersCount);
if (chartRestaurants) {
    new Chart(chartRestaurants, {
        type: 'doughnut',
        data: {
            labels: [restaurants[0].name, restaurants[1].name],
            datasets: [{
                label: 'Numero ordini',
                data: totalOrdersCount,
                borderWidth: 1
            }]
        },

    });
}

