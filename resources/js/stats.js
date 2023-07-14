import Chart from 'chart.js/auto';
import { forEach } from 'lodash';
const chartOrders = document.getElementById('myOrders');
const chartRestaurants = document.getElementById('myRestaurants');
const chartEarns = document.getElementById('myEarns');

const orders = document.querySelectorAll('.ordini');
orders.forEach((order) => {
    const dataOrders = order.getAttribute('data-item-date');
    const countOrders = order.getAttribute('data-item-count');
    const priceOrders = order.getAttribute('data-item-price');
    console.log(dataOrders);
})


if (chartOrders) {
        // Utilizza i dati ottenuti come valori per il grafico
        new Chart(chartOrders, {
          type: 'bar',
          data: {
            labels: [],
            datasets: [{
              label: 'Ordini',
              data: [1,2,3,2],
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

if (chartRestaurants) {
    new Chart(chartRestaurants, {
        type: 'doughnut',
        data: {
            labels: ['Il mio ristorante', 'Il mio secondo ristorante', 'il mio terzo ristorante'],
            datasets: [{
                label: 'Numero ordini',
                data: [15, 30, 4],
                borderWidth: 1
            }]
        },

    });
}
if (chartEarns) {
    new Chart(chartEarns, {
        type: 'line',
        data: {
            labels: ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre'],
            datasets: [{
                label: 'Ristorante 1',
                data: [12000, 25000, 1000, 2500, 3000, 600, 15000, 21000, 35000, 4100, 2600, 9000],
                borderWidth: 1
            },
            {
                label: 'Ristorante 2',
                data: [2000, 5000, 1000, 2500, 300, 600, 1500, 2100, 3500, 410, 2600, 9000],
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

