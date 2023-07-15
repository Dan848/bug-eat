import Chart from 'chart.js/auto';
const chartOrders = document.getElementById('myOrders');
const chartRestaurants = document.getElementById('myRestaurants');
const chartEarns = document.getElementById('myEarns');

const arrayData = [];
const arrayCount = [];
const arrayPrice = [];
let totalOrders = 0;

const orders = document.querySelectorAll('.ordini');
orders.forEach((order) => {
    arrayData.push(order.getAttribute('data-item-date'));
    arrayCount.push(order.getAttribute('data-item-count'));
    arrayPrice.push(order.getAttribute('data-item-price'));
});

for (let i = 0; i < arrayCount; i++){
    totalOrders = totalOrders + arrayCount[i];
}

if (chartOrders) {
        // Utilizza i dati ottenuti come valori per il grafico
    new Chart(chartOrders, {
        type: 'bar',
        data: {
            labels: arrayData,
            datasets: [{
              label: 'Ordini',
              data: arrayCount,
              borderWidth: 1
            }]
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
            datasets: [{
                label: 'Ristorante 1',
                data: arrayPrice,
                borderWidth: 1
            },]
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
        type: 'doughnut',
        data: {
            labels: ['Il mio ristorante'],
            datasets: [{
                label: 'Numero ordini',
                data: totalOrders,
                borderWidth: 1
            }]
        },

    });
}

